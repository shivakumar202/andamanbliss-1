<?php

namespace App\Http\Controllers;

use App\Models\HotelBookings;
use App\Models\PassengerDetails;
use App\Models\RazorpayTransactions;
use Barryvdh\DomPDF\Facade\Pdf;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Addon;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\HotelRoomType;
use App\Services\TboHotelService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Razorpay\Api\Api;
use App\Jobs\CheckTboHotelBookingStatus; // ✅ Add this line
use App\Models\GoogleReview;
use App\Models\ReviewImage;
use Illuminate\Support\Facades\Redirect;


class HotelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $tboHotelService;

    public function __construct(TboHotelService $tboHotelService)
    {
        $this->tboHotelService = $tboHotelService;
    }

    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $reviews = GoogleReview::orderBy('review_date','DESC')->where('comment','!=',null)->where('rating',5)->take(10)->get();
        $review_images = ReviewImage::all();

        $review = GoogleReview::all();
        $rating = [
            'total_reviews' => $review->count(),
            'average_rating' => $review->avg('rating'),
            '5' => $review->where('rating', 5)->count(),
            '4' => $review->where('rating', 4)->count(),
            '3' => $review->where('rating', 3)->count(),
            '2' => $review->where('rating', 2)->count(),
            '1' => $review->where('rating', 1)->count(),
        ];
        return view('hotels.index-hotel',compact('reviews','review_images','rating'));
    }

    public function SearchHotel()
    {

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    // HotelController.php

    public function show(Request $request)
    {
        // Filter hotel codes from DB based on search input
        $hotelCodes = Hotel::where(function ($query) use ($request) {
            $query->where('hotel_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('city_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('address', 'like', '%' . $request->keyword . '%');
        })->pluck('hotel_code')->toArray();

        return view('hotels.new-search', [
            'hotelCodes' => $hotelCodes,
            'searchParams' => $request->all()
        ]);
    }

    public function fetchAllChunks(Request $request, TboHotelService $tboHotelService)
    {
        $allCodes = $request->input('codes', []);
        $params = $request->input('searchParams', []);

        // chunk into 100 hotels each
        $chunks = array_chunk($allCodes, 100);

        $paxRooms = collect($params['PaxRooms'] ?? [])->map(function ($room) {
            return [
                'Adults' => (int) $room['Adults'],
                'Children' => (int) $room['Children'],
                'ChildrenAges' => isset($room['ChildrenAges']) && is_array($room['ChildrenAges'])
                    ? array_map('intval', $room['ChildrenAges'])
                    : null
            ];
        })->toArray();

        $basePayload = [

            'CheckIn' => Carbon::parse($params['checkin'])->format('Y-m-d'),
            'CheckOut' => Carbon::parse($params['checkout'])->format('Y-m-d'),

            'GuestNationality' => 'IN',
            'PaxRooms' => $paxRooms,
            'ResponseTime' => 23.0,
            'IsDetailedResponse' => true,
            'Filters' => [
                'Refundable' => true,
                'NoOfRooms' => count($paxRooms) > 1 ? count($paxRooms) : 0,
                'MealType' => 'All_Inclusive_All_Meal',
                'OrderBy' => 0,
                'StarRating' => 0
            ]
        ];

        // this will fire ALL requests at the exact same time
        $allResponses = $tboHotelService->searchMultipleChunksParallel($chunks, $basePayload);

        $allHotels = collect($allResponses)->flatMap(function ($response) use ($params) {
            return $this->mapApiResults($response, $params);
        });

        $html = view('hotels.partials.chunk', ['hotels' => $allHotels])->render();

        return response()->json(['html' => $html]);
    }



    public function fetchChunk(Request $request, TboHotelService $tbohotelservice)
    {
        $codes = $request->input('codes', []);
        $params = $request->input('searchParams', []);

        $paxRooms = collect($params['PaxRooms'] ?? [])->map(function ($room) {
            return [
                'Adults' => (int) $room['Adults'],
                'Children' => (int) $room['Children'],
                'ChildrenAges' => isset($room['ChildrenAges']) && is_array($room['ChildrenAges'])
                    ? array_map('intval', $room['ChildrenAges'])
                    : null
            ];
        })->toArray();

        $payload = [
            'CheckIn' => \Carbon\Carbon::createFromFormat('m/d/Y', $params['checkin'])->format('Y-m-d'),
            'CheckOut' => \Carbon\Carbon::createFromFormat('m/d/Y', $params['checkout'])->format('Y-m-d'),
            'HotelCodes' => implode(',', $codes),
            'GuestNationality' => 'IN',
            'PaxRooms' => $paxRooms,
            'ResponseTime' => 23.0,
            'IsDetailedResponse' => true,
            'Filters' => [
                'Refundable' => true,
                'NoOfRooms' => count($paxRooms) > 1 ? count($paxRooms) : 0,
                'MealType' => 'All_Inclusive_All_Meal',
                'OrderBy' => 0,
                'StarRating' => 0
            ]
        ];

        $response = $tbohotelservice->searchHotelsParallel($codes, $payload);

        $hotels = $this->mapApiResults($response, $params);

        $html = view('hotels.partials.chunk', compact('hotels'))->render();

        return response()->json(['html' => $html]);
    }

    private function mapApiResults(array $response, array $params)
    {
        if (!isset($response['HotelResult']) || empty($response['HotelResult'])) {
            return collect();
        }

        $hotelResults = collect($response['HotelResult']);
        $hotelCodes = $hotelResults->pluck('HotelCode')->toArray();
        $dbHotels = Hotel::whereIn('hotel_code', $hotelCodes)->get()->keyBy('hotel_code');

        return $hotelResults->map(function ($hotelData) use ($dbHotels, $params) {
            $code = $hotelData['HotelCode'];
            $rooms = $hotelData['Rooms'] ?? [];

            $sortedRooms = collect($rooms)->sortBy(function ($room) {
                return $room['DayRates'][0][0]['BasePrice'] ?? PHP_INT_MAX;
            })->values();

            $cheapestRoom = $sortedRooms->first();
            $dbHotel = $dbHotels[$code] ?? null;

            return [
                'hotel_code' => $code,
                'hotel_name' => $dbHotel?->hotel_name ?? 'N/A',
                'hotel_image' => !empty($dbHotel?->hotel_image)
                    ? $dbHotel->hotel_image
                    : asset('site/img/hotel_image.png'),
                'slug' => $dbHotel?->slug,
                'hotel_rating' => $dbHotel?->hotel_rating,
                'star_count' => match ($dbHotel?->hotel_rating) {
                    'OneStar' => 1,
                    'TwoStar' => 2,
                    'ThreeStar' => 3,
                    'FourStar' => 4,
                    'FiveStar', 'All' => 5,
                    default => null,
                },
                'city_name' => $dbHotel?->city_name,
                'description' => $dbHotel?->description,
                'address' => $dbHotel?->address,
                'booking_code' => $cheapestRoom['BookingCode'] ?? null,
                'total_fare' => $cheapestRoom['TotalFare'] ?? null,
                'total_tax' => $cheapestRoom['TotalTax'] ?? null,
                'base_price' => $cheapestRoom['DayRates'][0][0]['BasePrice'] ?? null,
                'room_name' => $cheapestRoom['Name'][0] ?? null,
                'inclusion' => $cheapestRoom['Inclusion'] ?? null,
                'promotion' => $cheapestRoom['RoomPromotion'][0] ?? null,
                'is_refundable' => $cheapestRoom['IsRefundable'] ?? null,
                'meal_type' => $cheapestRoom['MealType'] ?? null,
                'other_rooms' => $rooms,
                'selected_room' => $cheapestRoom,
                'query' => [
                    'checkin' => $params['checkin'] ?? null,
                    'checkout' => $params['checkout'] ?? null,
                    'room' => $params['room'] ?? null,
                    'adult' => $params['adult'] ?? null,
                    'child' => $params['child'] ?? null,
                    'childAge' => $params['childAge'] ?? [],
                    'PaxRooms' => $params['PaxRooms'] ?? [],
                ]
            ];
        });
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        //
    }



    public function static(string $slug, Request $request)
    {
        $bookingCode = $request->input('booking_code');
        $otherRooms = json_decode(base64_decode($request->input('other_rooms')), true) ?? [];
        $selectedRoom = null;
        foreach ($otherRooms as $key => $room) {
            if (isset($room['BookingCode']) && $room['BookingCode'] === $bookingCode) {
                $selectedRoom = $room;
                break;
            }
        }

        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        $hotels = Hotel::where('city_name', $hotel->city_name)->inRandomOrder()->take(100)->get();
        $requests = $request->only(['checkin', 'checkout', 'room', 'adult', 'child']);
        $requests['PaxRooms'] = $request->input('PaxRooms', []);
        $requests['childAge'] = $request->input('childAge', []);
        return view('hotels.static.index')->with(compact(
            'hotel',
            'hotels',
            'bookingCode',
            'selectedRoom',
            'otherRooms',
            'requests',
        ));
    }



    public function paymentReview(Request $request, TboHotelService $tbohotelservice)
    {
       $logged = null;


       if(auth()->check())
       {
        $logged = [
         'name' => auth()->user()->name,
         'mobile' => auth()->user()->mobile,
         'email' => auth()->user()->email,         
        ];
       }

        $bookingCode = $request['booking_code'];
        $dates = [
            "checkin" => $request->checkin,
            "checkout" => $request->checkout,
            "room" => $request->room,
        ];
        $guests = $request['PaxRooms'];
        $nationality = 'IN';
        $payload = [
            'BookingCode' => $bookingCode,
            'PaymentMode' => 'Limit'
        ];

        $existingFile = collect(Storage::files('hotel-responses'))
            ->sortDesc()
            ->first(function ($file) use ($bookingCode) {
                $content = json_decode(Storage::get($file), true);
                return isset($content['request']['BookingCode']) &&
                    $content['request']['BookingCode'] == $bookingCode &&
                    isset($content['response']['Status']['Code']) &&
                    $content['response']['Status']['Code'] == 200;
            });

        if ($existingFile) {
            $existingResponse = json_decode(Storage::get($existingFile), true);
            $response = $existingResponse['response'];
        } else {
            $response = $tbohotelservice->preBook($payload);
            $timestamp = now()->format('Y-m-d_H-i-s');
            $filePath = "hotel-booking-responses/request_prebook_response_{$timestamp}.json";
            Storage::put($filePath, json_encode([
                'request' => $payload,
                'response' => $response
            ], JSON_PRETTY_PRINT));

            $files = Storage::files('hotel-booking-responses');
            $now = now();

            foreach ($files as $file) {
                $lastModified = \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file));
                if ($lastModified->diffInMinutes($now) > 30) {
                    Storage::delete($file);
                }
            }
        }

        if (isset($response['Status']['Code']) && !in_array($response['Status']['Code'], [200])) {
            $errorMessage = $response['Status']['Description'] ?? 'No hotel data returned by API.';
            return response($errorMessage, 400);
        }


        $coupons = [];

        $HotelResult = $response['HotelResult'];
        $hotel = Hotel::where('hotel_code', $HotelResult[0]['HotelCode'])->firstOrFail();
        $validation = $response['ValidationInfo'] ?? [];
        $guestDetails = [
            'PAN' => null,
            'Passport' => null,
            'GST' => null,
        ];

        if (isset($validation['PanMandatory']) && $validation['PanMandatory'] === true) {
            $guestDetails['PAN'] = $request->input('PAN', null);
        }
        if (isset($validation['PassportMandatory']) && $validation['PassportMandatory'] === true) {
            $guestDetails['Passport'] = $request->input('Passport', null);
        }
        if (isset($validation['GSTAllowed']) && $validation['GSTAllowed'] === true) {
            $guestDetails['GST'] = $request->input('GST', null);
        }
        if ($nationality === 'IN' && isset($validation['PanMandatory']) && $validation['PanMandatory'] === false) {
            $guestDetails['PAN'] = null;
        }
        return view('hotels.static.book-now', compact('HotelResult', 'hotel', 'dates', 'coupons', 'nationality', 'guests', 'guestDetails', 'validation','logged'));
    }


    public function updatePayment(Request $request)
    {
        Log::info('[Payment] Initiating payment update', ['booking_id' => $request->booking_id]);

        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);
            Log::info('[Payment] Signature verified', ['payment_id' => $request->razorpay_payment_id]);

            $order = $api->order->fetch($request->razorpay_order_id);

            $transaction = RazorpayTransactions::where('booking_id', $request->booking_id)
                ->where('order_id', $request->razorpay_order_id)
                ->first();

            if (!$transaction) {
                Log::error('[Payment] Transaction not found', ['booking_id' => $request->booking_id]);
                return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
            }

            $transaction->update([
                'payment_id' => $request->razorpay_payment_id,
                'json_response' => json_encode($order),
                'status' => 'completed',
            ]);

            Log::info('[Payment] Transaction updated', ['transaction_id' => $transaction->id]);

            $booking = HotelBookings::find($request->booking_id);

            if (!$booking) {
                Log::warning('[Booking] Booking not found', ['booking_id' => $request->booking_id]);
                return response()->json(['success' => false, 'message' => 'Booking not found.']);
            }

            Log::info('[Booking] Initiating TBO booking', ['booking_id' => $booking->id]);

            $bookResponse = $this->getBooking($booking->id, $this->tboHotelService);

            Log::info('[Booking] Received TBO response', [
                'booking_id' => $booking->id,
                'response_status' => $bookResponse['BookResult']['ResponseStatus'] ?? null,
            ]);

            if (
                isset($bookResponse['BookResult']) &&
                $bookResponse['BookResult']['ResponseStatus'] === 1
            ) {
                $bookResult = $bookResponse['BookResult'];

                $booking->update([
                    'BookingId' => $bookResult['BookingId'] ?? null,
                    'TraceId' => $bookResult['TraceId'] ?? null,
                    'HotelBookingStatus' => $bookResult['HotelBookingStatus'] ?? null,
                    'Status' => $bookResult['Status'] ?? null,
                ]);

                Log::info('[Booking] Booking updated in DB', [
                    'booking_id' => $booking->id,
                    'HotelBookingStatus' => $booking->HotelBookingStatus,
                ]);

                dispatch((new \App\Jobs\CheckTboHotelBookingStatus($booking->id))->delay(now()->addSeconds(120)));

                Log::info('[Booking] Booking status check job dispatched', ['booking_id' => $booking->id]);

                return response()->json([
                    'success' => true,
                    'message' => 'Booking in progress. Confirmation will be sent shortly.'
                ]);
            }

            $errorMessage = $bookResponse['BookResult']['Error']['ErrorMessage'] ?? 'Booking confirmation failed.';
            $errorCode = $bookResponse['BookResult']['Error']['ErrorCode'] ?? null;

            Log::error('[Booking] Booking confirmation failed', ['booking_id' => $booking->id]);
            return response()->json(['success' => false, 'message' => $errorMessage]);
        } catch (\Exception $e) {


            Log::error('[Payment] Exception occurred during verification', [
                'error' => $e->getMessage(),
                'booking_id' => $request->booking_id
            ]);
            return response()->json(['success' => false, 'message' => $errorMessage], 400);
        }
    }



    protected function getBooking($bookingId, TboHotelService $tboHotelService)
    {
        $HotelBookings = HotelBookings::with(['passengerDetails', 'paymentDetails'])->find($bookingId);

        if (!$HotelBookings) {
            throw new \Exception('Booking not found');
        }

        $ipAddress = request()->header('X-Forwarded-For')
            ? trim(explode(',', request()->header('X-Forwarded-For'))[0])
            : request()->ip();

        $paymentDetails = $HotelBookings->paymentDetails->first();
        $grouped = $HotelBookings->passengerDetails->groupBy('group');

        $hotelRoomsDetails = [];

        foreach ($grouped as $room => $guests) {
            $roomPassengers = [];

            foreach ($guests as $index => $guest) {
                $passenger = [
                    "Title" => $guest->prefix,
                    "FirstName" => $guest->name,
                    "MiddleName" => $guest->m_name,
                    "LastName" => $guest->last_name,
                    "Email" => $paymentDetails->email,
                    "PaxType" => $guest->type,
                    "LeadPassenger" => (bool) $guest->lead,
                    "Age" => $guest->type == 2 ? ($guest->age ?? 0) : 0,
                    "PassportNo" => $guest->pass_no,
                    "PassportIssueDate" => $guest->pass_issue,
                    "PassportExpDate" => $guest->pass_exp,
                    "Phoneno" => $paymentDetails->phone,
                    "GSTNumber" => $paymentDetails->gst,
                    "GSTCompanyAddress" => $paymentDetails->gst_company_address,
                    "GSTCompanyContactNumber" => $paymentDetails->gst_company_contact,
                    "GSTCompanyName" => $paymentDetails->gst_company_name,
                    "GSTCompanyEmail" => $paymentDetails->gst_company_email,
                    "PaxId" => $index,
                    "PAN" => $guest->id_no,
                ];

                $roomPassengers[] = array_filter($passenger, fn($v) => !is_null($v));
            }

            $hotelRoomsDetails[] = [
                "HotelPassenger" => $roomPassengers
            ];
        }

        $payload = [
            "BookingCode" => $HotelBookings->booking_code,
            "IsVoucherBooking" => true,
            "GuestNationality" => 'IN',
            "EndUserIp" => $ipAddress,
            "TokenId" => Cache::get('tbo_token_id'),
            "RequestedBookingMode" => 5,
            "NetAmount" => $HotelBookings->net_amt,
            "HotelRoomsDetails" => $hotelRoomsDetails
        ];

        $confirmBook = $tboHotelService->confirmRoom($payload);


        return $confirmBook;
    }






    public function hotelPaymentVoucher(Request $request, $book_id)
    {
        $bookingDetail = HotelBookings::with(['passengerDetails', 'hotel', 'paymentDetails'])->find($book_id);
        if (!$bookingDetail) {
            return Redirect::back()->withInput()->withErrors(['error' => 'Booking not found'])
                ?: redirect('/hotels');
        }
        $pdf = Pdf::loadView('hotels.static.voucher', ['bookingDetail' => $bookingDetail]);

        return $pdf->stream('voucher.pdf');
    }



    public function hotelPackagePaymentVoucher(Request $request, $book_id)
    {
        $bookingDetail = HotelBookings::with(['passengerDetailPackage', 'hotel', 'PackagepaymentDetails'])->find($book_id);

        if (!$bookingDetail) {
            return Redirect::back()->withInput()->withErrors(['error' => 'Booking not found'])
                ?: redirect('/hotels');
        }

        $pdf = Pdf::loadView('hotels.static.package_voucher', ['bookingDetail' => $bookingDetail]);

        return $pdf->stream('voucher.pdf');
    }




    public function paymentSubmit(Request $request, TboHotelService $tbohotelservice)
    {

        Log::info('Hotel booking submission started');

        $HotelResult = unserialize(base64_decode($request->HotelResult));
        Log::debug('HotelResult decoded', ['HotelResult' => $HotelResult]);

        $checkIn = Carbon::parse($request->input('checkin'));
        $checkOut = Carbon::parse($request->input('checkout'));
        $nights = $checkIn->diffInDays($checkOut);
        Log::info('Check-in and check-out parsed', ['nights' => $nights]);

        $roomInfo = $HotelResult[0]['Rooms'][0];


        // Create booking with pending status
        $booking = HotelBookings::create([
            'booking_code' => $request['booking_code'],
            'hotel_code' => $HotelResult[0]['HotelCode'],
            'room_name' => implode(',', $roomInfo['Name']),
            'nights' => $nights,
            'user_id' => auth()->user()->id ?? null,
            'per_day_cost' => $roomInfo['DayRates'][0][0]['BasePrice'],
            'total_cost' => $roomInfo['TotalFare'],
            'gst_no' => $request['gst'],
            'check_in' => $request['checkin'],
            'check_out' => $request['checkout'],
            'amenities' => isset($roomInfo['Amenities']) && is_array($roomInfo['Amenities']) ? implode(', ', $roomInfo['Amenities']) : null,
            'inclusion' => $roomInfo['Inclusion'],
            'total_tax' => $roomInfo['TotalTax'],
            'net_amt' => $roomInfo['NetAmount'],
            'net_tax' => $roomInfo['NetTax'],
            'rooms' => count($roomInfo['Name']),
            'status' => 'pending' // Initial status
        ]);

        Log::info('Hotel booking record created', ['booking_id' => $booking->id]);

        foreach ($request['guests'] as $roomKey => $roomData) {
            foreach ($roomData as $group => $passengers) {
                foreach ($passengers as $pax) {

                    $passenger = PassengerDetails::create([
                        'booking_id' => $booking->id,
                        'purpose' => 'Hotel Booking',
                        'prefix' => $pax['Title'],
                        'm_name' => $pax['MiddleName'],
                        'last_name' => $pax['LastName'],
                        'name' => $pax['FirstName'],
                        'age' => $pax['PaxType'] == 2 ? ($pax['Age'] ?? 0) : 0,
                        'group' => $roomKey,
                        'ticket_no' => null,
                        'type' => $pax['PaxType'] == 1 ? 1 : 2,
                        'gender' => $pax['Title'] == 'Mr' ? 'Male' : 'Female',
                        'seat_no' => null,
                        'pass_no' => $pax['PassportNo'] ?? null,
                        'pass_exp' => $pax['PassportExpDate'] ?? null,
                        'pass_issue' => $pax['PassportIssueDate'] ?? null,
                        'tier' => null,
                        'lead' => (int) $pax['LeadPassenger'],
                        'class' => null,
                        'id_no' => $pax['PAN'] ?? null,
                        'nationality' => 'IN',
                    ]);

                    Log::debug('Passenger saved', [
                        'name' => $passenger->name,
                        'type' => $passenger->type,
                        'age' => $passenger->age,
                        'lead' => $passenger->lead,
                    ]);
                }
            }
        }

        Log::info('All passengers saved for booking', ['booking_id' => $booking->id]);

        $walletBlance = $tbohotelservice->getWalletBalance();
        Log::info(['wallet' => $walletBlance]);
        if ($roomInfo['TotalFare'] >= $walletBlance) {
            $passengers = PassengerDetails::where('booking_id', $booking->id)->where('purpose', 'Hotel Booking')->get();
            $this->sendLowBalanceMail($booking, $HotelResult, $passengers);

            return back()->with('success', 'enquiry sent sucessfully with in 24 hrs team will connect with you ');
        }

        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        try {
            Log::info('Initiating Razorpay order creation', [
                'booking_id' => $booking->id,
                'hotel_id' => $request->hotel_id,
                'booking_code' => $request->booking_code,
                'amount' => $roomInfo['TotalFare'],
                'tax' => $roomInfo['TotalTax'],
                'customer' => $request['billing']
            ]);

            $order = $api->order->create([
                'amount' => (int) $roomInfo['TotalFare'] * 100,
                'currency' => 'INR',
                'payment_capture' => 1,
                'notes' => [
                    'hotel_id' => $request->hotel_id,
                    'booking_id' => $booking->id,
                    'booking_code' => $request->booking_code
                ]
            ]);

            $transaction = RazorpayTransactions::create([
                'purpose' => 'Hotel Booking',
                'booking_id' => $booking->id,
                'name' => $request['billing']['name'],
                'email' => $request['billing']['email'],
                'phone' => $request['billing']['phone'],
                'address' => $request['billing']['address'],
                'payment_id' => null,
                'gst' => $request['billing']['gst'] ?? null,
                'gst_company_name' => $request['billing']['gst_company_name'] ?? null,
                'gst_company_email' => $request['billing']['gst_company_email'] ?? null,
                'gst_company_contact' => $request['billing']['gst_company_contact'] ?? null,
                'gst_company_address' => $request['billing']['gst_company_address'] ?? null,
                'order_id' => $order->id,
                'mode' => 'online',
                'json_response' => json_encode($order),
                'currency' => 'INR',
                'amount' => $roomInfo['TotalFare'],
                'tax' => $roomInfo['TotalTax'],
                'status' => 'pending'
            ]);

            Log::info('Razorpay order and transaction created successfully', [
                'booking_id' => $booking->id,
                'order_id' => $order->id,
                'transaction_id' => $transaction->id,
                'razorpay_order' => $order
            ]);

            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $booking->delete();

            return response()->json([
                'success' => false,
                'message' => 'Order creation failed'
            ], 500);
        }

    }

    protected function sendLowBalanceMail($booking, $hotelResult, $passengers)
    {

        $hotel = Hotel::where('hotel_code', $hotelResult[0]['HotelCode'])->first();
        $mailData['subject'] = 'Hotel Booking Failed - Low Wallet Balance';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'shivakumar@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'Andaman Bliss');
        $mailData['body'] = "";

        $mailData['body'] .= "Booking Code: {$booking->booking_code}<br/>";
        $mailData['body'] .= "Hotel: {$hotel['hotel_name']}<br/>";
        $mailData['body'] .= "Hotel Code: {$booking->hotel_code}<br/>";
        $mailData['body'] .= "Check-in: {$booking->check_in}<br/>";
        $mailData['body'] .= "Check-out: {$booking->check_out}<br/>";
        $mailData['body'] .= "Nights: {$booking->nights}<br/>";
        $mailData['body'] .= "Total Fare: ₹" . number_format($booking->total_cost, 2) . "<br/>";
        $mailData['body'] .= "Amenities: " . implode(', ', $room['Amenities'] ?? []) . "<br/>";
        $mailData['body'] .= "<hr/>";

        $mailData['body'] .= "<strong>Guest Details:</strong><br/>";
        foreach ($passengers as $pax) {
            $mailData['body'] .= "{$pax->prefix} {$pax->name} ({$pax->gender}, Age: {$pax->age})<br/>";
        }

        $mailData['body'] .= "<hr/>";
        $mailData['body'] .= "Booking failed due to low wallet balance. Please top up the wallet to retry.<br/>";
        $mailData['body'] .= "Booking ID: {$booking->id}<br/>";

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                ->to(['shivakumar@andamanbliss.com']);
        });
    }







    public function Devstatic(string $slug, string $subslug = null)
    {
        $hotel = Service::with(['hotelPhotos', 'hotelRoomTypes', 'category', 'facilities', 'policies', 'faqs', 'reviews', 'addon'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'hotel')
                    ->where('slug', $slug);
            })
            ->where('type', 'hotel')
            ->firstWhere('slug', $subslug);
        if ($subslug && !$hotel) {
            abort(404, 'Page not found.');
        }
        $addons = Addon::with(['addonPhotos'])->get();
        if ($hotel && $hotel->addons) {
            $addonIds = explode(',', $hotel->addons);
            $hotel->addon_names = Addon::whereIn('id', $addonIds)->get();
        }
        $hotels = Service::with(['hotelPhotos', 'hotelRoomTypes'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'hotel')
                    ->where('slug', $slug);
            })
            ->where('type', 'hotel')
            // ->whereNot('slug', $subslug)
            ->inRandomOrder()
            ->take(10)
            ->get();


        return view('pages.dev.hotels.static.index')
            ->with(compact('hotel', 'addons', 'hotels', 'addons'));
    }


    public function sendMailToGuest($bookingId)
    {
        Log::info("Initiating hotel confirmation email process...", ['bookingId' => $bookingId]);

        $bookingDetail = HotelBookings::with([
            'passengerDetails',  
            'hotel',
            'paymentDetails'
        ])
            ->where('id', $bookingId)
            ->orWhere('package_id', $bookingId)
            ->first();



        if (!$bookingDetail) {
            Log::error("Hotel booking not found", ['bookingId' => $bookingId]);
            return false;
        }
        $hotel = $bookingDetail->hotel ?? null;
        $payment = $bookingDetail->passengerDetails[0] ?? null;
        $paymentDet = $bookingDetail->paymentDetails[0] ?? null;

        Log::info("Hotel Data Retrieved", ['hotel' => $hotel]);
        Log::info("passenger Data Retrieved", ['passenger' => $payment]);
        Log::info("Payment Data Retrieved", ['payment' => $paymentDet]);


        if (!$payment) {
            Log::error("Hotel or payment detail missing", [
                'payment' => $payment
            ]);
            return false;
        }

        Log::info("Hotel and payment details loaded", [
            'hotel' => $hotel->hotel_name ?? null,
            'city' => $hotel->city_name ?? null,
            'payer' => $paymentDet->name ?? null,
            'email' => $paymentDet->email ?? null
        ]);

        // Generate PDF voucher
        Log::info("Generating hotel PDF voucher...");
        $pdf = \PDF::loadView('hotels.static.voucher', [
            'bookingDetail' => $bookingDetail
        ]);
        Log::info("Hotel PDF voucher generated successfully.");

        // Prepare mail content
        $mailData = [
            'subject' => 'Your Hotel Booking is Confirmed!',
            'email' => $paymentDet->email,
            'name' => $paymentDet->name,
            'body' => "
            Dear {$paymentDet->name},<br><br>

            Thank you for booking with <strong>Andaman Bliss</strong>!<br><br>

            Here are your hotel booking details:<br><br>

            <strong>Hotel:</strong> {$hotel->hotel_name}<br>
            <strong>Location:</strong> {$hotel->city_name}<br>
            <strong>Check-in:</strong> {$bookingDetail->check_in}<br>
            <strong>Check-out:</strong> {$bookingDetail->check_out}<br>
            <strong>Room:</strong> {$bookingDetail->room_name}<br>
            <strong>Inclusions:</strong> {$bookingDetail->inclusion}<br>
            <strong>Total Amount Paid:</strong> ₹" . number_format($bookingDetail->total_cost, 2) . "<br><br>

            Please find your hotel voucher attached with this email.<br><br>

            If you have any questions, feel free to contact us.<br><br>
        ",
            'info' => "This is an automated email confirmation. Please do not reply."
        ];

        try {
            Log::info("Sending hotel confirmation email...", ['to' => $paymentDet->email]);

            \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $pdf, $bookingDetail, $paymentDet) {
                $message->to($paymentDet->email)
                    ->cc('shivakumar@andamanbliss.com')
                    ->subject($mailData['subject'])
                    ->attachData($pdf->output(), 'Hotel-Voucher-' . $bookingDetail->booking_code . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
            });

            \Log::info("Hotel confirmation email sent successfully.", [
                'bookingId' => $bookingId,
                'email' => $paymentDet->email
            ]);

            return true;
        } catch (\Exception $e) {
            \Log::error("Failed to send hotel confirmation email", [
                'bookingId' => $bookingId,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

}
