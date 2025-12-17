<?php

namespace App\Livewire;

use App\Models\CabPackages;
use App\Models\CabPricings;
use App\Models\RazorpayTransactions;
use App\Models\RentalBookings;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Razorpay\Api\Api;

class CabReview extends Component
{
    public $carId;
    public $packageId;
    public $pickup;
    public $from_location;
    public $to_location;
    public $pickupdate;
    public $pickuptime;
    public $trip_type;
    public $return_date;
    public $return_time;
    public $pickup_location;
    public $travellers = 1;
    public $selectedPackage;
    public $car;
    public $payableAmt = 100;
    public $cab_quantity = 1;
    public $package_type;
    public $name;
    public $contact;
    public $email;
    public $address;
    public $formattedData;

    protected $queryString = [
        'carId' => ['except' => ''],
        'packageId' => ['except' => ''],
        'pickup' => ['except' => ''],
        'from_location' => ['except' => ''],
        'to_location' => ['except' => ''],
        'pickupdate' => ['except' => ''],
        'pickuptime' => ['except' => ''],
        'trip_type' => ['except' => ''],
        'return_date' => ['except' => ''],
        'return_time' => ['except' => ''],
        'package_type' => ['except' => ''],
    ];

    protected $listeners = [
        'paymentSuccess' => 'handlePaymentSuccess',

    ];
    public function mount()
    {
        $validator = Validator::make(request()->all(), [
            'carId' => 'required|exists:services,id',
            'packageId' => 'required|exists:cab_packages,id',
            'pickup' => 'nullable|string',
            'from_location' => 'nullable|string',
            'to_location' => 'nullable|string',
            'pickupdate' => 'required|date_format:d-m-Y',
            'pickuptime' => 'required|string',
            'trip_type' => 'nullable|in:One Way,Round Trip',
            'return_date' => 'nullable|date_format:d-m-Y|after_or_equal:pickupdate',
            'return_time' => 'nullable|string',
            'package_type' => 'nullable|in:Local,OutStanding',
        ]);

        if ($validator->fails()) {
            abort(404, 'Invalid request parameters');
        }

        $this->carId = request()->query('carId');
        $this->packageId = request()->query('packageId');
        $this->pickup = request()->query('pickup');
        $this->from_location = request()->query('from_location');
        $this->to_location = request()->query('to_location');
        $this->pickupdate = request()->query('pickupdate');
        $this->pickuptime = request()->query('pickuptime');
        $this->trip_type = request()->query('trip_type') ?? 'One Way';
        $this->return_date = request()->query('return_date');
        $this->return_time = request()->query('return_time');
        $this->package_type = request()->query('package_type') ?? 'Local';

        $this->updateFormattedData();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['travellers', 'cab_quantity', 'pickup_location', 'name', 'email', 'address'])) {
            $maxSeats = $this->formattedData['carSeats'] ?? 1;
            $travellers = $this->travellers ?? 1;

            $this->validateOnly($propertyName, [
                'pickup_location' => 'required|string|max:255',
                'travellers' => 'required|integer|min:1',
                'cab_quantity' => 'required|integer|min:1',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:500',
            ]);

            $minCabs = max(1, ceil($travellers / $maxSeats));

            if ($this->cab_quantity < $minCabs || $propertyName === 'travellers') {
                $this->cab_quantity = $minCabs;
            }

            $this->calculatePrices();
            $this->updateFormattedData();
        }
    }







    public function submit()
    {
        $this->validate([
            'pickup_location' => 'required|string|max:255',
            'travellers' => 'required|integer|min:1|max:' . ($this->formattedData['carSeats'] * 3),
            'cab_quantity' => 'required|integer|min:1|max:3',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|integer',
            'address' => 'required|string|max:500',
        ]);

        $pickup_date = \Carbon\Carbon::createFromFormat('d-m-Y', $this->pickupdate)->format('Y-m-d');
        $return_date = $this->return_date ? \Carbon\Carbon::createFromFormat('d-m-Y', $this->return_date)->format('Y-m-d') : null;

        $data = [
            'vehicle_id' => $this->carId,
            'package_id' => $this->packageId,
            'pickup' => $this->pickup,
            'from_location' => $this->from_location,
            'to_location' => $this->to_location,
            'pickup_date' => $pickup_date,
            'pickup_time' => $this->pickuptime,
            'trip_type' => $this->trip_type,
            'return_date' => $return_date,
            'return_time' => $this->return_time,
            'package_type' => $this->package_type,
            'pickup_location' => $this->pickup_location,
            'travellers' => $this->travellers,
            'cab_quantity' => $this->cab_quantity,
            'name' => $this->name,
            'category' => 'Cab Rent',
            'email' => $this->email,
            'contact' => $this->contact,
            'address' => $this->address,
            'payable' => $this->payableAmt,
            'total_fare' => $this->formattedData['totalFare'],
        ];

        $bookNow = RentalBookings::create($data);

        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        $orderData = [
            'amount' => $this->payableAmt * 100,
            'currency' => 'INR',
            'receipt' => 'order_rcptid_' . $bookNow->id,
            'payment_capture' => 1,
        ];

        $UserDeta = [
            'name' => $this->name,
            'email' => $this->email,
            'contact' => 7430809911,
            'razorpay_key' => env('RAZORPAY_API_KEY'),
        ];
        $order = $api->order->create($orderData);


        $transaction = RazorpayTransactions::create([
            'purpose' => 'Cab Booking',
            'booking_id' => $bookNow->id,
            'name' => $bookNow->name,
            'email' => $bookNow->email,
            'phone' => 7430809911,
            'payment_id' => null,
            'order_id' => $order['id'],
            'currency' => 'INR',
            'amount' => $bookNow->payable,
            'mode' => 'test',
            'json_response' => json_encode($order),
        ]);

        $this->dispatch('OpenPaymentSdk', [
            'order' => $order->toArray(),
            'userDetails' => $UserDeta,
        ]);
    }

    private function calculatePrices()
    {
        $selectedPackage = $this->selectedPackage;
        $car = $this->car;
        $fareMultiplier = ($this->trip_type === 'Round Trip') ? 2 : 1;

        $location = CabPricings::find($selectedPackage->name)?->name;

        $locationPrice = CabPricings::where('location', $selectedPackage->location)
            ->where('seat_type', $car->pricing[0]->seat ?? null)
            ->where('name', $location)
            ->value('base_price');

        $this->payableAmt = 100 * $this->cab_quantity;

        if ($selectedPackage->price_type === 'per_person') {
            $baseFare = $locationPrice * $this->travellers * $fareMultiplier + $this->payableAmt;
        } else {
            $baseFare = $locationPrice * $this->cab_quantity * $fareMultiplier + $this->payableAmt;
        }

        $totalFare = $baseFare;

        return [
            'baseFare' => $baseFare,
            'totalFare' => $totalFare,
        ];
    }




    private function updateFormattedData()
    {
        $car = Service::with(['cabPhotos', 'pricing'])->findOrFail($this->carId);
        $selectedPackage = CabPackages::findOrFail($this->packageId);

        $this->selectedPackage = $selectedPackage;
        $this->car = $car;
        $prices = $this->calculatePrices();

        $this->formattedData = [
            'carName' => $this->sanitize($car->name),
            'carPrice' => '₹' . number_format($prices['totalFare'], 2),
            'carImage' => $car->cabPhotos->first()->file ?? asset('site/img/cab/default.jpg'),
            'carSeats' => $car->pricing[0]->seat ?? 4,
            'fuelType' => $car->fuel_type ?? 'Diesel',
            'smallBags' => $car->small_bags ?? '2 Small Bags',
            'Package' => $this->sanitize($selectedPackage->name) ?? 'Not Available',
            'inclusions' => ['Fuel Charges', 'Driver Allowance', 'Base Fare for 150 km', '24/7 Customer Support'],
            'exclusions' => ['Toll Taxes', 'Parking Charges', 'Extra Km (₹14.3/km)', 'Night Charges (if applicable)'],
            'pickup' => $this->sanitize($this->pickup) ?? 'Not Available',
            'from_location' => $this->sanitize($this->from_location) ?? 'Not Available',
            'to_location' => $this->sanitize($this->to_location) ?? 'Not Available',
            'pickupdate' => $this->pickupdate,
            'pickuptime' => $this->pickuptime,
            'trip_type' => $this->trip_type,
            'return_date' => $this->return_date ?? '',
            'return_time' => $this->return_time ?? '',
            'pickup_location' => $this->pickup_location,
            'travellers' => $this->travellers,
            'cab_quantity' => $this->cab_quantity,
            'package_type' => $this->package_type,
            'fare' => $prices['baseFare'],
            'totalFare' => $prices['totalFare'],
            'details' => [
                'Extra km fare - ₹' . $selectedPackage->extra_fare . '/km after ' . $selectedPackage->distance_limit . ' kms',
                'Cancellation - Free till 1 hour of departure',
            ],
            'carId' => $this->carId,
            'packageId' => $this->packageId,
        ];
    }

    private function sanitize($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    public function paymentFailedSessionAlert()
    {
        session()->flash('error', 'Payment was canceled or dismissed by the user.');
    }


    public function paymentSuccess($response)
    {
        [$paymentId, $orderId, $signature] = $response;
        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));

        try {
            $payment = $api->payment->fetch($paymentId);

            if ($this->processPayment($payment, $paymentId)) {
                $redirectUrl = $this->handleBooking($payment->order_id);

                if ($redirectUrl) {
                    return redirect($redirectUrl); // ✅ perform redirect
                } else {
                    session()->flash('error', "Booking not found.");
                }
            } else {
                session()->flash('error', "Payment Failed Try Again");
            }
        } catch (\Exception $e) {
            session()->flash('error', "Payment Failed Try Again");
        }
    }


    protected function processPayment($payment, $paymentId)
    {
        if ($payment->status === 'authorized' && !$payment->captured) {
            $payment->capture(['amount' => $payment->amount]);
            return true;
        }

        if ($payment->status === 'captured') {
            return true;
        }

        return false;
    }

    protected function handleBooking($orderId)
    {
        $transaction = DB::table('razorpay_transactions')->where('order_id', $orderId)->first();

        if ($transaction) {
            DB::table('razorpay_transactions')
                ->where('order_id', $orderId)
                ->update([
                    'status' => 'Captured',
                ]);


            $booking = DB::table('rental_bookings')->where('id', $transaction->booking_id)->first();
            if ($booking) {
                DB::table('rental_bookings')->where('id', $transaction->booking_id)->update([
                    'status' => 'confirmed',
                ]);
                $this->sendBookingConfirmationEmail($booking);
                return route('booking.bill', ['bookId' => $booking->id]);
            }
        } else {
            session()->flash('error', "Payment Failed Try Again");
        }
    }

    protected function sendBookingConfirmationEmail($booking)
{
    // Single check for HTML tags in the name field to prevent spam
    if (is_string($booking->name) && preg_match('/<[^>]*>/', $booking->name)) {
        session()->flash('error', 'Spam detected. HTML tags are not allowed in the name field.');
        return;
    }

    // Prepare email data
    $mailData = [
        'subject' => 'Cab Booking Confirmation',
        'email' => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
        'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
        'body' => '',
    ];

    // Fetch additional details for the email
    $car = Service::find($booking->vehicle_id);
    $package = CabPackages::find($booking->package_id);

    // Build email body with booking details
    $mailData['body'] .= "Name: " . strip_tags(trim($booking->name)) . "<br/>";
    $mailData['body'] .= "Email: " . strip_tags(trim($booking->email)) . "<br/>";
    $mailData['body'] .= "Mobile: " . strip_tags(trim($booking->contact)) . "<br/>";
    $mailData['body'] .= "Category: " . strip_tags(trim($booking->category)) . "<br/>";
    $mailData['body'] .= "Package Type: " . strip_tags(trim($booking->package_type)) . "<br/>";
    $mailData['body'] .= "Car Name: " . ($car ? strip_tags(trim($car->name)) : 'N/A') . "<br/>";
    $mailData['body'] .= "Package Name: " . ($package ? strip_tags(trim($package->name)) : 'N/A') . "<br/>";
    $mailData['body'] .= "Pickup Date: " . $booking->pickup_date . "<br/>";
    $mailData['body'] .= "Pickup Time: " . $booking->pickup_time . "<br/>";
    if ($booking->trip_type === 'Round Trip') {
        $mailData['body'] .= "Return Date: " . $booking->return_date . "<br/>";
        $mailData['body'] .= "Return Time: " . $booking->return_time . "<br/>";
    }
    $mailData['body'] .= "Trip Type: " . strip_tags(trim($booking->trip_type)) . "<br/>";
    $mailData['body'] .= "From Location: " . strip_tags(trim($booking->from_location)) . "<br/>";
    $mailData['body'] .= "To Location: " . strip_tags(trim($booking->to_location)) . "<br/>";
    $mailData['body'] .= "Pickup Option: " . strip_tags(trim($booking->pickup)) . "<br/>";
    if ($booking->pickup_location) {
        $mailData['body'] .= "Pickup Location: " . strip_tags(trim($booking->pickup_location)) . "<br/>";
    }
    $mailData['body'] .= "Travellers: " . $booking->travellers . "<br/>";
    $mailData['body'] .= "Cab Quantity: " . $booking->cab_quantity . "<br/>";
    $mailData['body'] .= "Total Fare: INR " . $booking->total_fare . "<br/>";
    $mailData['body'] .= "Paid Amount: INR " . $booking->payable . "<br/>";
    $mailData['body'] .= "Booking ID: " . $booking->id . "<br/>";
    $mailData['body'] .= "LEAD URL: " . route('booking.bill', ['bookId' => $booking->id]) . "<br/>";
    $mailData['body'] .= "Note: Thank you for booking with AndamanBliss. Please keep this confirmation for your records.";

    // Send email using Laravel's Mail facade
    try {
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $booking) {
            $message->subject($mailData['subject'])
                    ->to('info@andamanbliss.com')
                    ->cc('amitmandal@andamanbliss.com')
                    ->bcc($booking->email); // Send a copy to the customer's email
        });
        session()->flash('success', 'Booking confirmed and email sent successfully!');
    } catch (\Exception $e) {
        session()->flash('error', 'Booking confirmed, but failed to send email.');
        Log::error('Email sending failed: ' . $e->getMessage());
    }
}
    public function render()
    {
        return view('livewire.cab-review');
    }
}
