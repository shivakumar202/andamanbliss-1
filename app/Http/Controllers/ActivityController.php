<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\RazorpayTransactions;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Addon;
use App\Models\Booking;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Jobs\SendActivityConfirmation;
use App\Models\GoogleReview;
use App\Models\ReviewImage;

class ActivityController extends Controller
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
        $validated = $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'string',
            'category' => 'nullable|string',
            'ratings' => 'nullable|array',
            'ratings.*' => 'integer|min:1|max:5',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'keyword' => 'nullable|string|max:255',
            'featured' => 'nullable|boolean',
            'best_seller' => 'nullable|boolean',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $activities = Activities::with(['category', 'activityPhotos'])
            ->whereHas('category', function ($query) use ($request) {
                $query->when(!empty($request->categories), function ($q) use ($request) {
                    $q->whereIn('slug', (array) $request->categories);
                })->when(!empty($request->category) && empty($request->categories), function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            })
            ->when(!empty($request->keyword), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('service_name', 'like', "%{$request->keyword}%")
                        ->orWhere('description', 'like', "%{$request->keyword}%");
                });
            })
            ->orderBy('featured', 'ASC')->paginate(15);

        if ($request->ajax()) {
            try {
                return response()->json([
                    'activities' => $activities->items(),
                    'next_page' => $activities->nextPageUrl(),
                    'has_more' => $activities->hasMorePages()
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to load activities'], 500);
            }
        }

        $categories = Category::where('type', 'activity')->get();
        return view('activities.index')->with(compact('activities', 'categories'));
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
    public function show(string $slug)
    {
        return view('activities.static.show');
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


    public function dev(string $slug)
    {
        if ($slug === 'game-fishing') {
            return redirect()->route('game-fishing');
        }

        if ($slug === 'charter-boat') {
            return redirect('/charter-boat');
        }

        $activity = Service::with(['activityPhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'activity')->where('slug', $slug);
            })
            ->where('type', 'activity')->first();

        $addons = Addon::where('type', 'activity')->get();
        if ($activity && $activity->addons) {
            $addonIds = explode(',', $activity->addons);
            $activity->addon_names = Addon::whereIn('id', $addonIds)->get();
        }

        $activities = Service::with(['activityPhotos'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'activity')->where('slug', $slug);
            })
            ->where('type', 'activity')
            ->inRandomOrder()
            ->take(10)
            ->get();

        $page = $activity->category->slug ?? null;
        if ($page && view()->exists("activities.static.$page.index")) {
            return view("activities.static.$page.index", compact('activity', 'addons', 'activities'));
        }

        abort(404);
    }


    public function view(string $slug, string $subslug)
    {

        if ($slug === 'charter-boat') {
            return redirect('/charter-boat');
        }

        $activity = Service::with(['activityPhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews'])
            ->where('type', 'activity')->where('slug', $subslug)->first();
        if ($subslug && !$activity) {
            abort(404, 'Page not found.');
        }
        $addons = Addon::where('type', 'activity')->get();
        if ($activity && $activity->addons) {
            $addonIds = explode(',', $activity->addons);
            $activity->addon_names = Addon::whereIn('id', $addonIds)->get();
        }
        $activities = Service::with(['activityPhotos'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'activity')
                    ->where('slug', $slug);
            })
            ->where('type', 'activity')
            // ->whereNot('slug', $subslug)
            ->inRandomOrder()
            ->take(10)
            ->get();
        return view('activities.static.show')
            ->with(compact('activity', 'addons', 'activities'));  // show fr pages
    }

    public function viewDev(string $slug, string $subslug)
    {
        $activity = Service::with(['activityPhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews'])
            ->where('type', 'activity')->where('slug', $subslug)->first();
        if ($subslug && !$activity) {
            abort(404, 'Page not found.');
        }
        $addons = Addon::where('type', 'activity')->get();
        if ($activity && $activity->addons) {
            $addonIds = explode(',', $activity->addons);
            $activity->addon_names = Addon::whereIn('id', $addonIds)->get();
        }

        $activities = Service::with(['activityPhotos'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'activity')
                    ->where('slug', $slug);
            })
            ->where('type', 'activity')
            // ->whereNot('slug', $subslug)
            ->inRandomOrder()
            ->take(10)
            ->get();
        return view('pages.dev.activities.static.index')
            ->with(compact('activity', 'addons', 'activities'));  // show fr pages
    }
    public function static(string $slug, string $subslug = null)
    {
        $activity = Service::with(['activityPhotos', 'category', 'facilities', 'policies', 'faqs', 'reviews'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'activity')
                    ->where('slug', $slug);
            })
            ->where('type', 'activity')
            ->firstWhere('slug', $subslug);
        if ($subslug && !$activity) {
            abort(404, 'Page not found.');
        }

        $addons = Addon::where('type', 'activity')->get();
        if ($activity && $activity->addons) {
            $addonIds = explode(',', $activity->addons);
            $activity->addon_names = Addon::whereIn('id', $addonIds)->get();
        }
        $activities = Service::with(['activityPhotos'])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('type', 'activity')
                    ->where('slug', $slug);
            })
            ->where('type', 'activity')
            // ->whereNot('slug', $subslug)
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('activities.static.index')
            ->with(compact('activity', 'addons', 'activities'));
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
            $booking->type = 'activity';
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
                    $booking->type = 'activity';
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






    public function devIndex(Request $request, $slug)
    {
        if ($slug === 'game-fishing') {
            return redirect()->route('game-fishing');
        }

        if ($slug === 'charter-boat') {
            return redirect('/charter-boat');
        }
        $category = Category::with([
            'categorySection',
            'metaHeadings',
            'facilities',
            'faqs',
            'reviews.categoryReview',
            'tourCategoryPhotos'
        ])->where('slug', $slug)->firstOrFail();

        $activities = Activities::with(['category', 'activityPhotos', 'facilities'])
            ->where('category_id', $category->id)
            ->get();

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


        return view("activities.dev.index", compact('category', 'activities', 'reviews', 'rating', 'review_images'));
    }

    public function dynamic(string $url)
{
    $activity = Activities::with([
        'activityPhotos', 'category', 'facilities', 'policies',
        'faqs', 'reviews', 'highlights', 'slots', 'meta'
    ])
    ->where('url', $url)
    ->orWhere('slug', $url)
    ->firstOrFail();

    $addons = Addon::where('type', 'activity')->get();

    if ($activity->addons) {
        $addonIds = explode(',', $activity->addons);
        $activity->addon_names = Addon::whereIn('id', $addonIds)->get();
    }

    $reviews = GoogleReview::whereNotNull('comment')
        ->where('rating', 5)
        ->latest('review_date')
        ->take(10)
        ->get();

    $review_images = ReviewImage::all();

    $allReviews = GoogleReview::all();
    $rating = [
        'total_reviews' => $allReviews->count(),
        'average_rating' => $allReviews->avg('rating'),
        '5' => $allReviews->where('rating', 5)->count(),
        '4' => $allReviews->where('rating', 4)->count(),
        '3' => $allReviews->where('rating', 3)->count(),
        '2' => $allReviews->where('rating', 2)->count(),
        '1' => $allReviews->where('rating', 1)->count(),
    ];

    return view('activities.dev.show', compact('activity', 'reviews', 'rating', 'review_images'));
}

    public function PaymentReview(Request $request)
    {
        $data = session('activity_booking_data');
        $activity = Activities::with('category', 'activityPhotos')->find($data['activity_id']);

        if (!$data) {
            return redirect()->back()->with('error', 'Booking session expired. Please try again.');
        }

        $logged = null;

        if (auth()->check()) {
            $name = explode(' ', auth()->user()->name);
            $logged = [
                'first_name' => $name[0],
                'last_name' => $name[1] ?? '',
                'mobile' => auth()->user()->mobile,
                'email' => auth()->user()->email,
            ];
        }

        // Process or show the booking review page
        return view('activities.booking', compact('data', 'activity', 'logged'));
    }

    public function Paymentsubmit(Request $request)
    {
        $data = json_decode($request->input('data'), true);

        $latestBooking = Booking::max('booking_id') ?? 0;
        $formattedBookingId = str_pad($latestBooking + 1, 20, '0', STR_PAD_LEFT);

        $activity = Activities::findOrFail($request->activity);

        $booking = new Booking();
        $booking->fill([
            'booking_id' => $formattedBookingId,
            'table_id' => $request->activity,
            'table_type' => 'activity',
            'type' => 'activity',
            'room_id' => null,
            'food_choice' => null,
            'user_id' => auth()->user()->id ?? null,
            'name' => $request->first_name . ' ' . $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'rate' => $activity->adult_cost ?? 0.00,
            'address' => $activity->location,
            'location' => $activity->location,
            'quantity' => ($data['guest'] ?? 0) + ($data['child'] ?? 0),
            'price' => $request->activity_cost,
            'adult' => $data['guest'] ?? 0,
            'child' => $data['child'] ?? 0,
            'start_at' => \Carbon\Carbon::parse($data['arrival_date'])->format('Y-m-d'),
            'end_at' => isset($data['time_slot']) && strpos($data['time_slot'], '-') !== false
                ? \Carbon\Carbon::createFromFormat('H:i', trim(explode('-', $data['time_slot'])[0]))->format('H:i')
                : null,


            'status' => 'pending',
        ]);
        $booking->save();


        $lastTwoDigits = substr($booking->mobile, -2);
        $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');
        $prefix = 'AB';
        $ticketcode = $prefix . $bdate . $lastTwoDigits . $booking->id;


        $api = new \Razorpay\Api\Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        $orderData = [
            'amount' => ((float) $request->total_cost * 100), // in paisa
            'currency' => 'INR',
            'receipt' => 'order_rcptid_' . $booking->booking_id,
            'payment_capture' => 1,
        ];

        $order = $api->order->create($orderData);

        RazorpayTransactions::create([
            'purpose' => 'Activity Booking',
            'booking_id' => $booking->booking_id,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->mobile,
            'payment_id' => null,
            'order_id' => $order['id'],
            'tax' => $request->gst,
            'currency' => 'INR',
            'amount' => $request->total_cost,
            'mode' => 'test',
            'json_response' => json_encode($order),
        ]);

        return response()->json([
            'success' => true,
            'booking_id' => $booking->booking_id,
            'ticket_code' => $ticketcode,
            'order_id' => $order->id,
        ]);
    }


    public function updatePayment(Request $request)
    {
        Log::info('Updating payment details', ['booking_id' => $request->booking_id]);
        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            $api->utility->verifyPaymentSignature($attributes);
            Log::info('Razorpay payment signature verified', ['payment_id' => $request->razorpay_payment_id]);
            // Fetch full order details from Razorpay
            $order = $api->order->fetch($request->razorpay_order_id);
            // Step 1: Find the transaction first
            $transaction = RazorpayTransactions::where('booking_id', $request->booking_id)
                ->where('order_id', $request->razorpay_order_id)
                ->first();
            if (!$transaction) {
                Log::error('Transaction not found', [
                    'booking_id' => $request->booking_id,
                    'razorpay_order_id' => $request->razorpay_order_id
                ]);
                return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
            }

            // Step 2: Update transaction
            $transaction->update([
                'payment_id' => $request->razorpay_payment_id,
                'json_response' => json_encode($order),
                'status' => 'completed'
            ]);

            // Step 3: Update booking
            $booking = Booking::where('booking_id', $request->booking_id)->first();

            if (!$booking) {
                Log::error('Booking not found', ['booking_id' => $request->booking_id]);
                return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
            }

            $booking->update([
                'status' => 'active'
            ]);

            Log::info('Booking and transaction updated', [
                'booking_id' => $booking->id,
                'payment_id' => $request->razorpay_payment_id,
            ]);


            $lastTwoDigits = substr($booking->mobile, -2);
            $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');

            $prefix = 'AB';
            $ticketcode = $prefix . $bdate . $lastTwoDigits . $booking->id;
            SendActivityConfirmation::dispatch($booking->id);

            return response()->json([
                'success'    => true,
                'ticketcode' => $ticketcode
            ]);
        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'error' => $e->getMessage(),
                'booking_id' => $request->booking_id,
                'razorpay_order_id' => $request->razorpay_order_id
            ]);
            return response()->json(['success' => false, 'message' => 'Payment verification failed'], 400);
        }
    }


    public function ActivityPaymentVoucher(Request $request, $book_id)
    {

        $ab = substr($book_id, 0, 2);
        $date = substr($book_id, 2, 4);
        $pno = substr($book_id, 6, 2);
        $id = substr($book_id, 8);

        $prebooking = Booking::where('id', $id)->firstOrFail();
        $lastTwoDigits = substr($prebooking->mobile, -2);
        $bdate = \Carbon\Carbon::parse($prebooking->start_date)->format('dm');
        if ($lastTwoDigits !== $pno) {
            abort(404, 'Mobile digits mismatch. Expected: ' . $lastTwoDigits . ', Found in code: ' . $pno);
        }

        if ($bdate !== $date) {
            abort(404, 'Date mismatch. Expected: ' . $bdate . ', Found in code: ' . $date);
        }


        $booking = Booking::where('id', $id)->firstOrFail();
        $lastTwoDigits = substr($booking->mobile, -2);
        $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');

        $prefix = 'AB';
        $ticketcode = $prefix . $bdate . $lastTwoDigits . $booking->id;
        $booking['ticket_code'] = $ticketcode;

        $activity = Activities::findOrFail($booking->table_id);

        $payment = RazorpayTransactions::where('booking_id', $booking->booking_id)
            ->where('status', 'completed')
            ->where('purpose', 'Activity Booking')
            ->first();



        $qrData = route('activity.payment.voucher', ['book_id' => $ticketcode]);
        $qrCode = QrCode::size(200)->generate($qrData);


        return view('activities.ticket', compact('booking', 'activity', 'payment', 'qrCode'));
    }

    protected function generateVoucher($book_id)
    {
        $booking = Booking::where('id', $book_id)->firstOrFail();
        $activity = Activities::findOrFail($booking->table_id);

        $payment = RazorpayTransactions::where('booking_id', $booking->booking_id)
            ->where('status', 'completed')
            ->where('purpose', 'Activity Booking')
            ->first();

        $lastTwoDigits = substr($booking->mobile, -2);
        $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');

        $ticketcode = "AB{$bdate}{$lastTwoDigits}{$booking->id}";
        $booking['ticket_code'] = $ticketcode;

        $qrCode = base64_encode(QrCode::generate(
            route('activity.payment.voucher', [$ticketcode])
        ));

        $pdf = Pdf::loadView('activities.voucher', compact('booking', 'payment', 'activity', 'qrCode'))->output();
        return $pdf;
    }


    public function ActivityPackagePaymentVoucher($ticketcode)
    {
        $ab = substr($ticketcode, 0, 2);
        $date = substr($ticketcode, 2, 4);
        $pno = substr($ticketcode, 6, 2);
        $id = substr($ticketcode, 8);

        $booking = Booking::where('id', $id)->firstOrFail();
        $activity = Activities::findOrFail($booking->table_id);

        $payment = RazorpayTransactions::where('booking_id', $booking->booking_id)
            ->where('status', 'completed')
            ->where('purpose', 'Activity Booking')
            ->first();

        $lastTwoDigits = substr($booking->mobile, -2);
        $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');

        $ticketcode = "AB{$bdate}{$lastTwoDigits}{$booking->id}";
        $booking['ticket_code'] = $ticketcode;

        $qrCode = base64_encode(QrCode::generate(
            route('activity.payment.voucher', [$ticketcode])
        ));


        $pdf = Pdf::loadView('activities.voucher', compact('booking', 'payment', 'activity', 'qrCode'));
        return $pdf->stream('Activity-Voucher-' . $ticketcode . '.pdf');
    }




    public function activityEnquiry($book_id)
    {
        $booking = Booking::find($book_id);
        $lastTwoDigits = substr($booking->mobile, -2);
        $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');
        $prefix = 'AB';
        $ticketcode = $prefix . $bdate . $lastTwoDigits . $booking->id;

        $activity = Activities::find($booking->table_id);
        $payment = RazorpayTransactions::where('booking_id', $booking->booking_id)->first();

        $pdf = $this->generateVoucher($booking->id);

        // 🟡 Update: subject includes activity name and ticket code
        $mailData['subject'] = '✅ Activity Booking Confirmation - ' . $activity->service_name . ' [' . $ticketcode . ']';

        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'AndamanBliss');
        $mailData['body'] = "";

        $mailData['body'] .= "<strong>Activity Name:</strong> {$activity->service_name}<br/>";
        $mailData['body'] .= "<strong>Location:</strong> {$activity->location}<br/>";
        $mailData['body'] .= "<strong>Name:</strong> {$booking->name}<br/>";
        $mailData['body'] .= "<strong>Email:</strong> {$booking->email}<br/>";
        $mailData['body'] .= "<strong>Phone:</strong> {$booking->mobile}<br/>";
        $mailData['body'] .= "<strong>Amount:</strong> {$payment->amount}<br/>";
        $mailData['body'] .= "<strong>Date of Activity:</strong> " . \Carbon\Carbon::parse($booking->start_at)->format('d M, Y') . "<br/>";
        $mailData['body'] .= "Guest: Adult: {$booking->adult}, Child: {$booking->child}<br/><br/> <hr/>";
        $mailData['body'] .= "Payment Voucher is attached with this email.<br/>";

        $mailData['info'] = "Note: Don’t share your login credentials. Keep them confidential.";

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $pdf, $ticketcode) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com')->attachData($pdf, 'Your-Activity-Voucher-' . $ticketcode . '.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });
    }



    public function sendActivityConfirmationToGuest($book_id)
    {
        $booking = Booking::findOrFail($book_id);
        $activity = Activities::findOrFail($booking->table_id);
        $payment = RazorpayTransactions::where('booking_id', $booking->booking_id)->where('status', 'completed')->first();

        // Generate PDF voucher
        \Log::info("Generating PDF voucher...");
        $pdf = $this->generateVoucher($booking->id);
        \Log::info("PDF voucher generated successfully");

        $amount = number_format($payment->amount, 2);
        $method = $payment->method ?? 'Card';
        $paymentId = $payment->payment_id ?? 'N/A';
        $paidOn = \Carbon\Carbon::parse($payment->created_at)->format('d M, Y h:i:s A T');
        $email = $booking->email;
        $mobile = $booking->mobile;
        $activity_name = ucwords($activity->service_name);
        $activity_date = \Carbon\Carbon::parse($booking->start_at)->format('d M, Y');
        $location = $booking->location;
        $lastTwoDigits = substr($booking->mobile, -2);
        $bdate = \Carbon\Carbon::parse($booking->start_date)->format('dm');
        $prefix = 'AB';
        $ticketcode = $prefix . $bdate . $lastTwoDigits . $booking->id;

        $mailData = [
            'amount' => '₹' . $amount,
            'method' => $method,
            'activity' => $activity_name,
            'activity_date' => $activity_date,
            'location' => $location,
            'payment_id' => $paymentId,
            'paid_on' => $paidOn,
            'email' => $email,
            'mobile' => $mobile,
        ];

        \Log::info("Preparing to send email to guest...", ['to' => $email]);
        $subject = "Your {$activity_name} Booking is Confirmed! [Ticket #{$ticketcode}]";


        \Mail::send('emails.template_activity', $mailData, function ($message) use ($email, $booking, $pdf, $subject) {
            $message->subject($subject)
                ->to($email, $booking->name)
                ->attachData($pdf, 'Your-Activity-Voucher-' . $booking->booking_id . '.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });

        \Log::info("Email sent successfully to guest", ['email' => $email]);
    }

    public function SendEnquiry(Request $request)
    {
        $endata = json_decode($request->data, true);
        $activity = Activities::find($request->input('activity'))->first();
        $data = [
            'activity' => $activity->service_name,
            'location' => $activity->location,
            'adult' => $endata['guest'],
            'infant' => $endata['child'],
            'activity_date' => $endata['arrival_date'],
            'time_slot' => $endata['time_slot'],
            'total_cost' => $endata['total_cost'],
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'amount' => $request->input('total_cost'),
        ];

        $mailData['subject'] = $data['activity'] . ' - Activity Booking Enquiry';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'Andaman Bliss');
        $mailData['body'] = "";

        $mailData['body'] .= "<strong>Activity Name:</strong> {$data['activity']}<br/>";
        $mailData['body'] .= "<strong>Location:</strong> {$data['location']}<br/>";
        $mailData['body'] .= "<strong>Name:</strong> {$data['name']}<br/>";
        $mailData['body'] .= "<strong>Email:</strong> {$data['email']}<br/>";
        $mailData['body'] .= "<strong>Phone:</strong> {$data['mobile']}<br/>";
        $mailData['body'] .= "<strong>Amount:</strong> {$data['amount']}<br/>";
        $mailData['body'] .= "<strong>Date of Activity:</strong> " . \Carbon\Carbon::parse($data['activity_date'])->format('d M, Y') . "<br/>";
        $mailData['body'] .= "Guest: Adult: {$data['adult']}, Infant: {$data['infant']}<br/><br/> <hr/>";

        $mailData['info'] = "Note: Live booking is disabled for this activity.";
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])->to('info@andamanbliss.com')->cc('amitmandal@andamanbliss.com');
        });

        return response()->json([
            'success' => true,
            'redirect_url' => route('activities.index')
        ]);
    }


//    public function sendforceConfirmation($id)
// {
//     logger('Force confirmation started', ['id' => $id]);

//     // Step 1: Dispatch job
//     logger('Dispatching SendActivityConfirmation job', ['id' => $id]);
//     SendActivityConfirmation::dispatch($id);
//     logger('SendActivityConfirmation job dispatched', ['id' => $id]);

// }

}
