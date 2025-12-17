<?php

namespace App\Http\Controllers;

use App\Jobs\SendCabBookingMail;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Addon;
use App\Models\Booking;
use App\Models\CabBookings;
use App\Models\CabPackages;
use App\Models\CabPricing;
use App\Models\CabPricings;
use App\Models\Cabs;
use App\Models\GoogleReview;
use App\Models\IslandLocation;
use App\Models\Pricing;
use App\Models\RazorpayTransactions;
use App\Models\ReviewImage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class CabController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->input('cabtripType');
        $reviews = GoogleReview::orderBy('review_date', 'DESC')->where('comment', '!=', null)->take(10)->get();

        $cabPrices = [];
        switch ($type) {
            case 'airport':
                $transfer_type = $request->input('transfer_type_airport');
                $location = $request->input('location_airport');
                $pickup_location = $transfer_type === 'pickup'
                    ? $request->input('airport')
                    : $request->input('pickup_location_airport');
                $drop_location = $transfer_type === 'pickup'
                    ? $request->input('drop_location_airport')
                    : $request->input('airport');
                $travel_date = $request->input('travel_date_airport');
                break;

            case 'jetty':
                $transfer_type = $request->input('transfer_type_jetty');
                $location = $request->input('jetty_select');
                $pickup_location = $transfer_type == 'pickup' ? $request->input('jetty_select') . ' Jetty' : $request->input('pickup_location_jetty');
                $drop_location = $transfer_type == 'pickup' ? $request->input('drop_location_jetty') : $request->input('jetty_select') . ' Jetty';
                $travel_date = $request->input('travel_date_jetty');
                break;

            case 'local':
                $transfer_type = 'local';
                $location = $request->input('cab_location_local');
                $pickup_location = $request->input('pickup_local');
                $drop_location = $request->input('drop_local');
                $travel_date = $request->input('travel_date_local');
                break;

            case 'outstation':
                $transfer_type = 'outstation';
                $location = $request->input('cab_location_outstation');
                $pickup_location = $request->input('pickup_outstation');
                $drop_location = $request->input('drop_outstation');
                $travel_date = $request->input('travel_date_outstation');
                break;

            default:

                $reviews = GoogleReview::orderBy('review_date', 'DESC')->where('comment', '!=', null)->where('rating', 5)->take(10)->get();
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

                return view('cabs.bookings.index', compact('cabPrices', 'reviews', 'review_images', 'rating'));
        }

        $rawpacks = CabPricing::with('cabs.cabPhotos')->get();

        $packages = $rawpacks->filter(function ($pricing) use ($type, $location, $transfer_type, $drop_location) {
            return $pricing->location === $location
                && $pricing->category === $type
                && stripos($pricing->name, $transfer_type) !== false
                || stripos($pricing->name, $drop_location) !== false;
        });


        $cabPrices = $packages->map(function ($pricing) use ($pickup_location, $travel_date, $transfer_type, $drop_location, $type) {
            if ($pricing->cabs) {
                $cab = $pricing->cabs;
                $cab->type = $type;
                $cab->trip_type = $transfer_type;
                $cab->base_price = $pricing->base_price;
                $cab->location = $pricing->location;
                $cab->pick = $pricing->name;
                $cab->distance_covered = $pricing->distance_covered;
                $cab->extra_fare = $pricing->extra_fare;
                $cab->pick_up = $pickup_location ?? $pricing->name;
                $cab->drop_location = $drop_location;
                $cab->pickup_date = $travel_date;
                $cab->pricing_id = $pricing->id;
                return $cab;
            }
        })->filter();


        return view('cabs.bookings.index', compact('cabPrices'));
    }



    public function search(Request $request)
    {
        Log::info('Starting cab search', ['request' => $request->all()]);

        $validated = $request->validate([
            'package_type' => 'required|in:Local,OutStanding',
            'pickup' => 'required_if:package_type,Local|string|nullable',
            'package_id' => 'required_if:package_type,Local|string|nullable',
            'from_location' => 'required_if:package_type,OutStanding|string',
            'to_location' => 'required_if:package_type,OutStanding|string',
            'trip_type' => 'required_if:package_type,OutStanding|in:One Way,Round Trip',
            'pickupdate' => 'required|date_format:d-m-Y',
            'pickuptime' => 'required|string',
            'return_date' => 'nullable|required_if:trip_type,Round Trip|date_format:d-m-Y|after_or_equal:pickupdate',
            'return_time' => 'nullable|required_if:trip_type,Round Trip|string',
        ]);

        Log::info('Validation passed');

        if ($request->package_type === 'OutStanding') {
            $selectedPackage = CabPackages::where('from_location', $request->from_location)
                ->where('to_location', $request->to_location)
                ->first();
            Log::info('Selected package by OutStanding route', ['package' => $selectedPackage]);
        } else {
            $selectedPackage = CabPackages::find($request->package_id);
            Log::info('Selected package by Local route', ['package' => $selectedPackage]);
        }

        if (!$selectedPackage) {
            Log::warning('Package not found');
            return response()->json(['error' => 'Package not found'], 404);
        }

        $cabIds = json_decode($selectedPackage->cab_ids, true) ?? [];
        Log::info('Decoded cab IDs', ['cab_ids' => $cabIds]);

        $cabs = Service::where('type', 'cab')
            ->with('cabPhotos', 'pricing')
            ->whereIn('id', $cabIds)
            ->get();
        Log::info('Fetched cabs', ['count' => $cabs->count()]);

        if ($cabs->isEmpty()) {
            Log::warning('No cabs available for the selected package');
            return response()->json(['error' => 'No cabs available for the selected package'], 404);
        }

        $fareMultiplier = $request->trip_type === 'Round Trip' ? 2 : 1;
        Log::info('Fare multiplier set', ['fare_multiplier' => $fareMultiplier]);

        $formattedCabs = $cabs->map(function ($cab) use ($selectedPackage, $fareMultiplier) {
            $seatType = $cab->pricing[0]->seat ?? null;
            Log::info('Processing cab', ['cab_id' => $cab->id, 'seat_type' => $seatType, 'location' => $selectedPackage]);

            $location = CabPricings::find($selectedPackage->name)?->name;

            $locationPrice = CabPricings::where('location', $selectedPackage->location)
                ->where('seat_type', $seatType)
                ->where('name', $location)
                ->value('base_price');

            Log::info('Fetched location price', ['locationPrice' => $locationPrice]);

            $price = $locationPrice ? $locationPrice * $fareMultiplier : 0;

            return [
                'name' => $cab->name,
                'price' => '₹' . $price,
                'image' => $cab->cabPhotos->first()->file ?? asset('site/img/cab/default.jpg'),
                'seats' => $seatType ?? 0,
                'package_id' => $selectedPackage->id,
                'cab_id' => $cab->id,
                'inclusions' => ['Fuel Charges', 'Driver Allowance', 'Base Fare for 150 km', '24/7 Customer Support'],
                'exclusions' => ['Toll Taxes', 'Parking Charges', 'Extra Km (₹14.3/km)', 'Night Charges (if applicable)'],
                'details' => [
                    ['icon' => 'fa-road', 'text' => 'Extra km fare - ₹' . $selectedPackage->extra_fare . '/km after ' . $selectedPackage->distance_limit . ' kms'],
                    ['icon' => 'fa-gas-pump', 'text' => 'Fuel Type - Diesel with refill breaks'],
                    ['icon' => 'fa-ban', 'text' => 'Cancellation - Free till 1 hour of departure'],
                ],
            ];
        });

        Log::info('Returning formatted cabs', ['count' => $formattedCabs->count()]);

        return response()->json($formattedCabs);
    }

    public function cabs(Request $request)
    {

        $cabs = Service::with('category')
            ->where('type', 'cab')
            ->whereHas('category', function ($query) use ($request) {
                $query->when(!empty($request->categories), function ($q) use ($request) {
                    $q->whereIn('slug', $request->categories);
                })
                    ->when(!empty($request->category), function ($q) use ($request) {
                        $q->where('slug', $request->category);
                    });
            })
            ->when(!empty($request->ratings), function ($query) use ($request) {
                $query->whereIn('ratings', $request->ratings);
            })
            ->when($request->featured == 1, function ($query) use ($request) {
                $query->where('featured', 1);
            })
            ->when($request->best_seller == 1, function ($query) use ($request) {
                $query->where('best_seller', 1);
            })
            ->when(!empty($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when(!empty($request->min_price), function ($query) use ($request) {
                $query->where('adult_price', '>=', $request->min_price);
            })
            ->when(!empty($request->max_price), function ($query) use ($request) {
                $query->where('adult_price', '<=', $request->max_price);
            })
            ->when(!empty($request->keyword), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', "%{$request->keyword}%")
                        ->orWhere('description', 'like', "%{$request->keyword}%");
                });
            })
            ->get();

        $categories = Category::where('type', 'cab')->get();


        return view('cabs.index')->with(compact('cabs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cab = json_decode($request->input('cabs'), true);
        $paying = $request->input('payment');
        $data = [
            'name' => $request->input('title') . ' ' . $request->input('f_name') . ' ' . $request->input('l_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('tel_code') . '-' . $request->input('tel_no'),
            'pickup_location' => $request->input('pickup_location'),
            'drop_location' => $request->input('drop_location'),
            'cab' => $cab['name'],
            'user_id' => auth()->user()->id ?? '',
            'total_amt' => $cab['total_amount'],
            'tax' => $cab['tax'],
            'paid' => 0,
            'pay_part' => $request->input('payment'),
            'base_amt' => $cab['base_price'],
            'pickup_date' => \Carbon\carbon::parse($cab['pickup_date']),
            'extra_fare' => $cab['additional_charge'],
            'cab_id' => $cab['id'],
            'package_id' => $cab['pricing_id'],
            'trip_type' => $cab['type'] . ' ' . $cab['trip_type'],
        ];
        $payment_amt = $paying == 'token' ? $cab['payable'] : $cab['total_amount'];
        $cabBook = CabBookings::create($data);
        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        $order = $api->order->create([
            'amount' => (int) $payment_amt * 100,
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);
        $payment = [
            'purpose' => 'Cab Booking',
            'booking_id' => $cabBook->id,
            'name' => $cabBook->name,
            'email' => $cabBook->email,
            'phone' => $cabBook->phone,
            'tax' => $cabBook->tax,
            'payment_id' => null,
            'order_id' => $order->id,
            'method' => 'online',
            'currency' => 'INR',
            'amount' => $payment_amt,
            'json_response' => json_encode($order),
            'status' => 0,
            'mode' => 'online',
        ];
        RazorpayTransactions::create($payment);
        return response()->json([
            'success' => true,
            'booking_id' => $cabBook->id,
            'order_id' => $order->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('cabs.show');
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



    public function booking(Request $request)
    {

        $statusCode = 404;
        if ($request->ajax()) {
            $latestBooking = Booking::max('booking_id') ?? 0;
            $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

            $service = Service::find($request->id);

            $booking = new Booking;
            $booking->booking_id = $formattedBookingId;
            $booking->table_id = $request->id;
            $booking->table_type = 'services';
            $booking->type = 'cab';
            $booking->room_id = null;
            $booking->food_choice = null;
            $booking->user_id = auth()->user()->id ?? null;
            $booking->name = $request->name;
            $booking->surname = null;
            $booking->mobile = $request->mobile;
            $booking->email = $request->email;
            $booking->address = null;
            $booking->rate = $rate = $service?->adult_price ?? 0.00;
            $booking->quantity = $quantity = $request->adultCount;
            $booking->price = $rate * $quantity;
            $booking->adult = $request->adultCount;
            $booking->child = 0;
            $booking->start_at = date('Y-m-d', strtotime($request->start_at));
            $booking->end_at = null;
            $booking->location = $request->location;
            $booking->destination = null;
            $booking->note = null;
            $booking->status = 'active';
            $booking->save();

            if (!empty($request->addons)) {
                foreach ($request->addons as $key => $value) {
                    $addon = Addon::find($value);

                    $booking = new Booking;
                    $booking->booking_id = $formattedBookingId;
                    $booking->table_id = $value;
                    $booking->table_type = 'addons';
                    $booking->type = 'cab';
                    $booking->room_id = null;
                    $booking->food_choice = null;
                    $booking->user_id = auth()->user()->id ?? null;
                    $booking->name = $request->name;
                    $booking->surname = null;
                    $booking->mobile = $request->mobile;
                    $booking->email = $request->email;
                    $booking->address = null;
                    $booking->rate = $rate = $addon->price ?? 0.00;
                    $booking->quantity = $quantity = 1;
                    $booking->price = $rate * $quantity;
                    $booking->adult = 0;
                    $booking->child = 0;
                    $booking->start_at = date('Y-m-d', strtotime($request->start_at));
                    $booking->end_at = null;
                    $booking->location = $request->location;
                    $booking->destination = null;
                    $booking->note = null;
                    $booking->status = 'active';
                    $booking->save();
                }
            }

            $statusCode = 200;
            return response()->json([
                'status' => $statusCode,
                'message' => __('Booking enquiry form submitted successfully!'),
                'data' => Booking::where('booking_id', $formattedBookingId)->get(),
            ], $statusCode);
        }
    }

    public function paymentConfirm(Request $request)
    {
        if ($request->isMethod('post')) {
            $orderId = $request->input('order_id');
            $paymentId = $request->input('payment_id');
            $signature = $request->input('signature');
            $status = $request->input('status', 'success');

            Log::info('Payment POST received', [
                'order_id' => $orderId,
                'payment_id' => $paymentId,
                'signature' => $signature,
                'status' => $status
            ]);

            if (!$orderId || !$paymentId || !$signature) {
                Log::error('Payment data missing', ['request' => $request->all()]);
                return response()->json(['success' => false, 'message' => 'Payment data missing'], 400);
            }

            $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

            try {
                $attributes = [
                    'razorpay_order_id' => $orderId,
                    'razorpay_payment_id' => $paymentId,
                    'razorpay_signature' => $signature,
                ];
                $api->utility->verifyPaymentSignature($attributes);
                Log::info('Payment signature verified', ['order_id' => $orderId]);

                $order = $api->order->fetch($orderId);
                Log::info('Razorpay order fetched', ['order' => $order]);

                $payment = RazorpayTransactions::where('order_id', $orderId)->first();
                if (!$payment) {
                    Log::error('Transaction not found', ['order_id' => $orderId]);
                    return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
                }

                $payment->update([
                    'payment_id' => $paymentId,
                    'json_response' => json_encode($order),
                    'status' => $status,
                ]);
                Log::info('Payment updated in database', ['payment_id' => $paymentId, 'status' => $status]);

                $billingDetails = CabBookings::with('payment')->find($payment->booking_id);
                $billingDetails->update([
                    'paid' => $payment->amount,
                    'status' => $status,
                ]);
                session(['billing_id' => $billingDetails->id]);
                Log::info('Billing details stored in session', ['billing_id' => $billingDetails->id]);
                $booking = $billingDetails;
                $this->sendPaymentConfirmation($booking);
                $this->sendBookingConfirmationEmail($booking);
                SendCabBookingMail::dispatch($booking->id)->delay(now()->addMinutes(2));

                return response()->json([
                    'success' => true,
                    'redirect_url' => route('cab.confirm')
                ]);
            } catch (SignatureVerificationError $e) {
                Log::error('Invalid signature', ['exception' => $e->getMessage()]);
                return response()->json(['success' => false, 'message' => 'Invalid signature passed'], 400);
            }
        }

        $billingId = session('billing_id');
        if ($billingId) {
            $billingDetails = CabBookings::with('payment')->find($billingId);
            $cab = Cabs::find($billingDetails->cab_id);
            return view('cabs.bookings.confirm', compact('billingDetails', 'cab'));
        }

        Log::warning('No billing ID in session, redirecting to home');
        return redirect('/');
    }



    // public function bookingSuccess($id)
    // {
    //     $booking = CabBookings::with('payment')->findOrFail($id);

    //     $this->sendPaymentConfirmation($booking);
    //     $this->sendBookingConfirmationEmail($booking);

    //     SendCabBookingMail::dispatch($booking->id)->delay(now()->addMinutes(2));
    // }



    protected function sendPaymentConfirmation($booking)
    {
        $billingDetails = CabBookings::with(['payment'])
            ->find($booking->id);

        $cab = Cabs::where('id', $billingDetails->cab_id)
            ->first();

        $mailData = [
            'subject' => '✅ Payment Successful- Your Cab Booking is Confirmed',
            'email'   => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name'    => env('MAIL_FROM_NAME', 'Andaman Bliss'),
            'billingDetails' => $billingDetails,
            'cab' => $cab,
        ];
        \Mail::send('emails.cab_payment', $mailData, function ($message) use ($mailData, $billingDetails) {
            $message->from($mailData['email'], $mailData['name'])
                ->to($billingDetails->payment->email)
                ->subject($mailData['subject']);
        });
    }




    protected function sendBookingConfirmationEmail($booking)
    {
        if (is_string($booking->name) && preg_match('/<[^>]*>/', $booking->name)) {
            session()->flash('error', 'Spam detected. HTML tags are not allowed in the name field.');
            return;
        }

        $bookingId = $booking->id;


        $billingDetails = CabBookings::with(['payment'])->find($bookingId);


        $pdf = Pdf::loadView('cabs.bookings.bill', compact('billingDetails'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        // Prepare email data
        $mailData = [
            'subject' => '✅ Cab Booking Confirmation',
            'email' => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
            'body' => '',
        ];

        $mailData['body'] .= "Name: " . strip_tags(trim($booking->name)) . "<br/>";
        $mailData['body'] .= "Email: " . strip_tags(trim($booking->email)) . "<br/>";
        $mailData['body'] .= "Mobile: " . strip_tags(trim($booking->phone)) . "<br/>";
        $mailData['body'] .= "Trip Type: " . strip_tags(trim($booking->trip_type)) . "<br/>";
        $mailData['body'] .= "Cab: " . strip_tags(trim($booking->cab)) . "<br/>";
        $mailData['body'] .= "Pickup Date & Time: " . $booking->pickup_date . "<br/>";
        $mailData['body'] .= "Pickup Location: " . $booking->pickup_location . "<br/>";
        $mailData['body'] .= "Drop Location: " . $booking->drop_location . "<br/>";

        $mailData['body'] .= "Total Fare: INR " . $booking->total_amt . "<br/>";
        $mailData['body'] .= "Paid Amount: INR " . $booking->paid . "<br/>";
        $mailData['body'] .= "Booking ID: " . $booking->id . "<br/>";
        $mailData['body'] .= "Note: Confirmation Voucher is attached below.";


        // Send email using Laravel's Mail facade
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $pdf) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com')
                ->attachData($pdf->output(), 'Andaman_Bliss_Cab_Rental.pdf');
        });

        session()->flash('success', 'Booking confirmed and email sent successfully!');
    }

    public function cabVoucher($bookingId)
    {
        $billingDetails = CabBookings::with(['payment'])->find($bookingId);

        if (!$billingDetails) {
            abort(404, 'Booking not found');
        }

        $pdf = Pdf::loadView('cabs.bookings.bill', compact('billingDetails'))
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

        return $pdf->stream('cab-booking-voucher.pdf');
    }





    public function cabLocations(Request $request)
    {
        $category = $request->input('cabtripType');
        $location = $request->input('location');
        $Locations = CabPricing::where('category', $category)->where('location', $location)->groupBy('name')->pluck('name');
        return response()->json($Locations);
    }



    public function checkout(Request $request)
    {

        if ($request->isMethod('post')) {

            $logged = null;

            if (auth()->check()) {
                $name = explode(' ', auth()->user()->name);
                $logged = [
                    'f_name' => $name[0],
                    'l_name' => $name[1] ?? '',
                    'mobile' => auth()->user()->mobile,
                    'email' => auth()->user()->email

                ];
            }


            $cabs = json_decode($request->input('request'));
            $pricing_id = CabPricing::find($cabs->pricing_id);
            $cab = Cabs::with('cabPhotos')->find($cabs->id);
            $type = $cabs->type;
            $locations = Cache::rememberForever('island_locations', function () {
                return IslandLocation::get();
            });

            switch ($type) {
                case 'airport':
                case 'jetty':
                    $transfer_type = $cabs->trip_type;
                    $location = $cabs->location;
                    $drop_location = $transfer_type === 'pickup' ? $cabs->drop_location : $cabs->pick_up;
                    break;
                default:
                    $drop_location = null;
            }

            if (in_array($cabs->type, ['airport', 'jetty'])) {
                $drop_dist = $locations->first(fn($loc) => stripos($loc->name, $drop_location) !== false);

                if (!$drop_dist) {
                    abort(404, 'Drop location not found');
                }

                $base_payable = property_exists($cabs, 'payable') ? $cabs->payable : ($cabs->base_price ?? 0);
                $additional_charge = $pricing_id->extra_fare ?? 0;
                $extra_km = max(0, $drop_dist->distance_km - 5);
                $total_amount = $base_payable + ($additional_charge * $extra_km);
            } else {
                $drop_dist = null;
                $base_payable = $cabs->base_price ?? 0;
                $additional_charge = 0;
                $extra_km = 0;
                $total_amount = $base_payable;
            }

            $tax = 1.07;
            $total_amount_with_tax = $total_amount * $tax;

            $cabs->extra_fare = $additional_charge;
            $cabs->payable = 200;
            $cabs->tax = $tax;
            $cabs->drop = $drop_dist ?? $pricing_id->distance_covered;
            $cabs->total_amount = $total_amount_with_tax;
            $cabs->additional_charge = $additional_charge * $extra_km;


            return view('cabs.bookings.show', compact('cabs', 'cab', 'logged'));
        } else {
            $imagePath = public_path('site/img/etc/slipper-beat.gif');

            if (!file_exists($imagePath)) {
                abort(404);
            }

            return response()->file($imagePath);
        }
    }
}
