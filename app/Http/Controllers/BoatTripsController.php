<?php

namespace App\Http\Controllers;

use App\Jobs\SendBoatTripBookMail;
use App\Models\BoatTripBookings;
use App\Models\BoatTripLocations;
use App\Models\BoatTrips;
use App\Models\CategorySections;
use App\Models\GoogleReview;
use App\Models\PassengerDetails;
use App\Models\RazorpayTransactions;
use App\Models\ReviewImage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Illuminate\Support\Str;


use function PHPSTORM_META\map;

class BoatTripsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $url)
    {
        $trip = BoatTripLocations::with(['meta', 'faq', 'contentBlock', 'tripPhotos'])->where('page_url', $url)->first();
         if (!$trip) {
        Log::warning("BoatTrip page not found for URL: {$url}");
        
        abort(404, 'Boat trip not found');
    }
        $whyUs = $this->whyus();
        $how = $this->howItWorks();

        $reviews = GoogleReview::orderBy('review_date','DESC')->where('comment','!=',null)->where('rating',5)->take(10)->get();
        $review_images = ReviewImage::all();
        $readMoreSection = CategorySections::where([['type', 'boat_trip'],['category_id',$trip->id]])->first();
      
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

        return view('boat-trips.index', compact('trip', 'whyUs', 'how', 'reviews', 'rating', 'review_images','readMoreSection'));
    }

    public function locations(Request $request)
    {
        $trip_to = $request->input('trip_to');
        $trips = Cache::remember('trips', now()->addMinutes(10), fn() => BoatTrips::all());
        $trip = $trips->filter(function ($trip) use ($trip_to) {
            return stripos($trip->name, $trip_to) !== false;
        })->first();
        $timings = [];
        if ($trip && $trip->start_time && $trip->end_time && $trip->slot_interval) {
            $start = \Carbon\Carbon::createFromFormat('H:i:s', $trip->start_time);
            $end   = \Carbon\Carbon::createFromFormat('H:i:s', $trip->end_time);
            $interval = $trip->slot_interval;

            while ($start->lt($end)) {
                $timings[] = $start->format('H:i');
                $start->addMinutes($interval);
            }
        }
        return response()->json(['timings' => $timings]);
    }


    protected function whyus()
    {
        $why = [
            'title' => 'Why Book With Us?',
            'desc' => 'Experience hassle-free island hopping with our trusted service',
            'items' => [
                [
                    'icon' => '<i class="fa-solid fa-circle-check"></i>',
                    'title' => 'Instant Confirmation',
                    'desc' => 'Get your tickets confirmed immediately after booking with instant email confirmation',
                ],
                [
                    'icon' => '<i class="fa-solid fa-circle-check"></i>',
                    'title' => 'Secure Payment',
                    'desc' => '100% secure payment gateway with multiple payment options for your convenience',
                ],
                [
                    'icon' => '<i class="fa-solid fa-circle-check"></i>',
                    'title' => '24/7 Support',
                    'desc' => 'Round-the-clock customer support to assist you before, during, and after your trip',
                ],
                [
                    'icon' => '<i class="fa-solid fa-circle-check"></i>',
                    'title' => 'Best Prices',
                    'desc' => 'Competitive pricing with no hidden charges. What you see is what you pay'
                ]
            ],
        ];

        return $why;
    }


    protected function howItWorks()
    {
        $how = [
            'title' => 'How It Works',
            'desc' => 'Book your tickets in 3 simple steps',
            'items' => [
                [
                    'title' => 'Select Your Trip',
                    'desc' => 'Choose your preferred date, time, and number of passengers from the search form above',
                ],
                [
                    'title' => 'Enter Details',
                    'desc' => 'Fill in passenger information and contact details for booking confirmation',
                ],
                [
                    'title' => 'Confirm & Pay',
                    'desc' => 'Complete secure payment and receive instant confirmation via email',
                ],
            ],
        ];

        return $how;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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


  public function checkout(Request $request)
{
    $logged = null;
    $validated = $request->validate([
        'trip_to' => 'required|string|exists:boat_trips,name',
        'checkin' => 'required|date',
        'depart' => 'required|string',
        'adult' => 'required|integer|min:1',
        'child' => 'nullable|integer|min:0',
    ]);

    $tripDetail = BoatTrips::where('name', $validated['trip_to'])->firstOrFail();

    $adult = $validated['adult'];
    $infant = $validated['child'] ?? 0;
    $adult_cost = $adult * $tripDetail->adult_price;
    $infant_cost = $infant * ($tripDetail->infant_price ?? 0);
    $tax = $tripDetail->service_tax;
    $sum_total = $adult_cost + $infant_cost;
    $taxTotal = ($sum_total * $tax) / 100;
    $totalCost = $sum_total + $taxTotal;

    if(auth()->check())
    {
        $logged = [
            'name' => auth()->user()->name,
            'mobile' => auth()->user()->mobile,
            'email' => auth()->user()->email,
        ];
    }

    $data = [
        'trip_to' => $validated['trip_to'],
        'trip' => $tripDetail,
        'date' => $validated['checkin'],
        'depart' => $validated['depart'],
        'adult' => $adult,
        'infant' => $infant,
        'tax' => $tax,
        'sum_total' => $sum_total,
        'taxTotal' => $taxTotal,
        'totalCost' => $totalCost,
    ];

    return view('boat-trips.book-now', compact('data','logged'));
}


    public function pay(Request $request)
    {
        $data = $request->all();


        $adultCount = isset($data['guests']['adults'])
            ? count($data['guests']['adults'])
            : 0;

        $childCount = isset($data['guests']['children'])
            ? count($data['guests']['children'])
            : 0;
        $data['adults'] = $adultCount;
        $data['infants'] = $childCount;
        $data['trip_details'] = json_decode($data['trip_detail'], true);

        $tripBook = BoatTripBookings::create([
            'boat_trip_id' => $data['trip_details']['id'],
            'trip_name' => $data['trip_details']['name'],
            'slot_time' => $data['slot'],
            'user_id' => auth()->user()->id ?? '',
            'trip_date' => \Carbon\carbon::parse($data['date']),
            'adults' => $data['adults'],
            'infants' => $data['infants'],
            'base_cost' => $data['total_cost'] - $data['total_tax'],
            'tax' => $data['total_tax'],
            'total_amt' => $data['total_cost'],
        ]);


        foreach ($data['guests'] as $group => $paxes) {
            foreach ($paxes as $index => $pax) {
                PassengerDetails::create([
                    'booking_id'   => $tripBook->id,
                    'purpose'      => 'Boat Trip Booking',
                    'prefix'       => $pax['title'] ?? 'Mr',
                    'm_name'       => $pax['middle_name'] ?? null,
                    'last_name'    => $pax['last_name'] ?? null,
                    'name'         => $pax['first_name'] ?? $pax['name'],
                    'age'          => $pax['age'] ?? 0,
                    'group'        => $group,
                    'ticket_no'    => null,
                    'type'         => strtolower($group) === 'adults' ? 1 : 2,
                    'gender'       => $pax['gender'] ?? null,
                    'seat_no'      => null,
                    'pass_no'      => $pax['passport_no'] ?? null,
                    'pass_exp'     => $pax['passport_expiry'] ?? null,
                    'pass_issue'   => $pax['passport_issue'] ?? null,
                    'tier'         => null,
                    'lead'         => $index === 0 ? 1 : 0,
                    'class'        => null,
                    'id_no'        => $pax['id_no'] ?? null,
                    'nationality'  => $pax['nationality'] ?? 'IN',
                ]);
            }
        }

        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        $orderData = [
            'receipt' => (string) $tripBook['id'],
            'amount' => (int) round($data['total_cost'] * 100),
            'currency' => 'INR',
            'payment_capture' => 1
        ];


        $order = $api->order->create($orderData);

        $paymentDetail = RazorpayTransactions::create([
            'purpose' => 'Boat Trip Booking',
            'booking_id' => $tripBook['id'],
            'name' => $data['billing']['name'],
            'email' => $data['billing']['email'],
            'phone' => $data['billing']['phone'],
            'payment_id' => null,
            'order_id' => $order['id'],
            'currency' => 'INR',
            'amount' => $data['total_cost'],
            'mode' => app()->environment('production') ? 'live' : 'test',
            'json_response' => json_encode($orderData),
        ]);

        return response()->json([
            'success' => true,
            'booking_id' => $tripBook['id'],
            'order_id' => $order['id'],
            'amount' => (int) round($data['total_cost'] * 100),
        ]);
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

            $order = $api->order->fetch($request->razorpay_order_id);

            $transaction = RazorpayTransactions::where('booking_id', $request->booking_id)
                ->where('order_id', $request->razorpay_order_id)
                ->first();

            if (!$transaction) {
                Log::error('[Payment] Transaction not found', ['booking_id' => $request->booking_id]);
                return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
            }

            $trips = BoatTripBookings::find($request->booking_id);

            $trip = BoatTrips::find($trips->boat_trip_id);

           $locations = BoatTripLocations::whereRaw('LOWER(name) = ?', [strtolower($trip->location)])->first();

            $name = $locations?->page_url;

            $transaction->update([
                'payment_id' => $request->razorpay_payment_id,
                'status' => 'completed',
            ]);

            $trips->update([
                'status' => 'confirmed',
            ]);

            Log::info('[Payment] Transaction updated', ['transaction_id' => $transaction->id]);

            SendBoatTripBookMail::dispatch($request->booking_id)->delay(now()->addMinutes(1));
            $this->sendPaymentConfirmation($trips);
            $this->sendBookingConfirmationEmail($trips);
            return response()->json([
                'success' => true,
                'name' => $name,
                'message' => 'Payment successful. Redirecting...',
            ]);
        } catch (\Exception $e) {
            Log::error('[Payment] Exception occurred during verification', [
                'error' => $e->getMessage(),
                'booking_id' => $request->booking_id
            ]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

      protected function sendPaymentConfirmation($booking)
    {
        $billingDetails = BoatTripBookings::with(['payment'])
            ->find($booking->id);


        $mailData = [
            'subject' => '✅ Payment Successful- Your Boat Trip is Confirmed',
            'email'   => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name'    => env('MAIL_FROM_NAME', 'Andaman Bliss'),
            'billingDetails' => $billingDetails,
        ];
        \Mail::send('emails.boat_payment', $mailData, function ($message) use ($mailData, $billingDetails) {
            $message->from($mailData['email'], $mailData['name'])
                ->to($billingDetails->payment->email)
                ->subject($mailData['subject']);
        });
    }


    public function bookingVoucher($bookingId)
    {
        $billingDetails = BoatTripBookings::with(['payment'])->find($bookingId);
        $trip = BoatTrips::find($billingDetails->boat_trip_id);
        $pdf = Pdf::loadView('boat-trips.booking.bill', compact('billingDetails', 'trip'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream('Andaman_Bliss_Boat_trip_book.pdf');
    }







     protected function sendBookingConfirmationEmail($booking)
    {
        $bookingId = $booking->id;
        $billingDetails = BoatTripBookings::with(['payment'])->find($bookingId);
        $trip = BoatTrips::find($billingDetails->boat_trip_id);

        
        $pdf = Pdf::loadView('boat-trips.booking.bill', compact('billingDetails', 'trip'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        // Prepare email data
        $mailData = [
            'subject' => '✅Boat Trip Booking Confirmation',
            'email' => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
            'body' => '',
        ];

        $mailData['body'] .= "Name: " . strip_tags(trim($booking->payment->name)) . "<br/>";
        $mailData['body'] .= "Email: " . strip_tags(trim($booking->payment->email)) . "<br/>";
        $mailData['body'] .= "Mobile: " . strip_tags(trim($booking->payment->phone)) . "<br/>";
        $mailData['body'] .= "Trip To : " . strip_tags(trim($booking->trip_name)) . "<br/>";
        $mailData['body'] .= "Trip Date & Time Slot: " . $booking->trip_date . ' Slot '. $booking->slot_time . "<br/>";
        $mailData['body'] .= "Total Fare: INR " . $booking->total_amt . "<br/>";
        $mailData['body'] .= "Paid Amount: INR " . $booking->payment->amount . "<br/>";
        $mailData['body'] .= "Booking ID: " . $booking->id . "<br/>";
        $mailData['body'] .= "Note: Confirmation Voucher is attached below.";


        // Send email using Laravel's Mail facade
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $pdf) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com')
                ->attachData($pdf->output(), 'Andaman_Bliss_Boat_trip_book.pdf');
        });

        session()->flash('success', 'Booking confirmed and email sent successfully!');
    }

    
}
