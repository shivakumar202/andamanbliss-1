<?php

namespace App\Livewire;

use App\Jobs\SendBikeRentConfirmation;
use App\Models\BikePickLocation;
use App\Models\IslandLocation;
use App\Models\RazorpayTransactions;
use App\Models\RentalBookings;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Razorpay\Api\Api;

class BikeBooking extends Component
{
    public $bikeId;
    public $location;
    public $pickupDate;
    public $pickupTime;
    public $dropoffDate;
    public $dropoffTime;
    public $bike;
    public $fullName = '';
    public $contact = '';
    public $email = '';
    public $bikeQuantity = 1;
    public $pickupOption = 'self';
    // public $pickupLocation = '';
    public $showPickupLocation = false;
    public $baseCost;
    public $totalCost;
    public $payNow;
    public $mapcordinate;
    public $distance = 0;
    public $params;
    public $pickupLocation = null;
    public $locations = [];

    public $payLater = 1400;
    public $photo;
    public $maps;

    public $activeSlot = 'morning';
    public $selectedTime = null;
    public $dropTime;


    public $times = [
        'morning' => [
            'times' => ['9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM'],
            'icon' => '<i class="fa-regular fa-sun"></i>'
        ],
        'afternoon' => [
            'times' => ['12:00 PM - 1:00 PM', '1:00 PM - 2:15 PM', '2:00 PM - 3:15 PM', '3:00 PM - 4:15 PM'],
            'icon' => '<i class="fa-solid fa-sun"></i>'
        ],
        'evening' => [
            'times' => ['5:00 PM - 6:00 PM', '6:00 PM - 7:00 PM', '8:00 PM - 9:00 PM'],
            'icon' => '<i class="fa-regular fa-moon"></i>'
        ]
    ];


    protected $rules = [
        'fullName' => 'required|string|max:255',
        'contact' => 'required|string|regex:/^[0-9]{10}$/', // Enforce 10-digit phone number
        'email' => 'required|email|max:255',
        'bikeQuantity' => 'required|integer|min:1|max:10',
        'pickupOption' => 'required|in:self,delivery',
        'pickupLocation' => 'required_if:pickupOption,delivery|string|max:255',
        'activeSlot' => 'required|string',
        'selectedTime' => 'required|string',
    ];

    protected $messages = [
        'contact.regex' => 'The contact number must be a valid 10-digit phone number.',
        'pickupLocation.required_if' => 'The delivery location is required when delivery is selected.',
        'selectedTime.required' => 'Please select Pickup Timing',
        'activeSlot.required' => 'Pleased select pickup slot'
    ];

    public function rules()
    {
        return array_merge($this->rules, [
            'distance' => $this->showPickupLocation
                ? 'required|numeric|min:0.01|max:' . $this->distance
                : 'nullable|numeric|min:0|max:' . $this->distance,
        ]);
    }



    public function mount($params)
    {
        $param = json_decode($params, true);


        // Initialize booking details from query parameters
        $this->bikeId = $param['bikeId'];
        $this->location = $param['location'];

        $this->pickupDate = $param['pickupdate'];
        $this->dropoffDate = $param['dropoffdate'];

        $searchLoc = $this->LocationNames($this->location);

        $this->locations = IslandLocation::where('island_name', $searchLoc)->orderBy('distance_km', 'ASC')->get(['id', 'name', 'latitude', 'longitude', 'distance_km'])->toArray();

        // Normalize location for search
        $locationSearch = str_replace('Port Blair', 'Portblair', $this->location);
        $this->mapcordinate = BikePickLocation::where('name', $this->location)->first();
        $this->maps = $this->mapcordinate;

        // Fetch bike details
        $bike = Service::where('type', 'bike')
            ->with(['bikePhotos', 'pricing'])
            ->where('address', 'LIKE', '%' . $locationSearch . '%')
            ->where('id', $this->bikeId)
            ->first();
        $this->bike = $bike;
        if ($bike && !empty($bike->bikePhotos)) {
            $this->photo = $bike->bikePhotos[0]->file;
            $price = optional(
                $bike->pricing->firstWhere('location', $locationSearch)
            )->price ?? $bike->adult_price;

            $this->baseCost = (int) $price;
        } else {
            $this->photo = null;
        }
        $this->updateCost();
        foreach ($this->times as $slot => $slots) {
            if (count($slots) > 0) {
                $this->activeSlot = $slot;
                $this->selectedTime = $slots['times'][0];
                $this->updateDropTime($this->selectedTime);
                break;
            }
        }

        if (auth()->check()) {
            $this->fullName = auth()->user()->name;
            $this->contact = auth()->user()->mobile;
            $this->email = auth()->user()->email;
        }
    }


    public function LocationNames($location)
    {
        $locations = [
            'Port Blair' => 'Port Blair',
            'Neil Island' => 'Neil',
            'Havelock Island' => 'Havelock',
        ];

        return $locations[$location] ?? null;
    }


    public function resetForm()
    {
        $this->fullName = '';
        $this->contact = '';
        $this->email = '';
        $this->bikeQuantity = 1;
        $this->pickupOption = 'self';
        $this->pickupLocation = '';
        $this->showPickupLocation = false;
        $this->distance = 0;
        $this->activeSlot = 'morning';
        $this->selectedTime = $this->times['morning']['times'][0] ?? null;
        $this->updateDropTime($this->selectedTime);
        $this->updateCost();
    }

    public function locationSelected()
    {
        if (!$this->pickupLocation) return;

        $loc = collect($this->locations)
            ->firstWhere('id', (int)$this->pickupLocation);

        if (!$loc) return;

        $originLat = $this->maps['latitude'];
        $originLng = $this->maps['longitude'];

        $distance = 6371 * acos(
            cos(deg2rad($originLat)) *
                cos(deg2rad($loc['latitude'])) *
                cos(deg2rad($loc['longitude']) - deg2rad($originLng)) +
                sin(deg2rad($originLat)) *
                sin(deg2rad($loc['latitude']))
        );

        if ($distance > $this->maps['range_km']) {
            $this->addError('pickupLocation', 'Delivery not available for this location');
            return;
        }

        $this->distance = round($distance, 2);
        $this->updateCost();
    }



    public function selectSlot($slot)
    {
        $this->activeSlot = $slot;
        $this->selectedTime = isset($this->times[$slot]['times'][0]) ? $this->times[$slot]['times'][0] : null;
        $this->updateDropTime($this->selectedTime);
    }

    public function selectTime($time)
    {
        $this->selectedTime = $time;
        $this->updateDropTime($time);
    }

    private function updateDropTime($time)
    {
        if (!$time) {
            $this->dropTime = null;
            return;
        }
        $parts = explode('-', $time);
        $endTime = trim($parts[0] ?? '');
        $this->dropTime = $endTime ?: '';
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPickupDate()
    {
        $this->updateCost();
    }
    public function updatedDropoffDate()
    {
        $this->updateCost();
    }
    public function updatedBikeQuantity()
    {
        $this->updateCost();
    }

    public function updatePickupOption()
    {
        $this->showPickupLocation = $this->pickupOption === 'delivery';

        if (!$this->showPickupLocation) {
            $this->pickupLocation = '';
        }

        if ($this->showPickupLocation) {
            $this->dispatch('pickup-location-visible');
        }

        $this->validateOnly('pickupOption');

        $this->updateCost();
    }

    public function updatePickup($location, $distance)
    {
        $location = trim(preg_replace('/\s+/', ' ', $location));



        $this->pickupLocation = $location;
        $this->distance = $distance;
    }

    public function updateCost()
    {
        $baseCostPerBike = $this->baseCost;
        try {
            $pickup = Carbon::parse($this->pickupDate);
            $dropoff = Carbon::parse($this->dropoffDate);
            $days = $pickup->diffInDays($dropoff);
        } catch (\Exception $e) {
            $days = 1;
        }

        $totalDays = max(1, $days) + 1;

        $pickCost = 0;

        if ($this->showPickupLocation === true) {
            $pickCost = $this->bikeQuantity * 200;
        }
        $this->totalCost = $this->bikeQuantity * $baseCostPerBike * $totalDays + $pickCost;
        $this->payNow = $this->bikeQuantity * 200;
        $this->payLater = $this->totalCost - $this->payNow;
    }


    public function submit()
    {
        $this->validate();

        $data = [
            'vehicle_id' => $this->bikeId,
            'pickup' => $this->showPickupLocation ? 'Pickup Request' : 'Self Pickup',
            'pickup_date' => Carbon::createFromFormat('d-m-Y', $this->pickupDate)->format('Y-m-d'),
            'pickup_time' => $this->selectedTime,
            'return_date' => Carbon::createFromFormat('d-m-Y', $this->dropoffDate)->format('Y-m-d'),
            'return_time' => $this->selectedTime,
            'from_location' => $this->location,
            'to_location' => $this->location,
            'category' => 'Bike Rent',
            'package_type' => 'dayRent',
            'user_id' => auth()->user()->id ?? '',
            'pickup_location' => $this->pickupLocation,
            'travellers' => 1,
            'cab_quantity' => $this->bikeQuantity,
            'payable' => $this->payNow,
            'name' => $this->fullName,
            'email' => $this->email,
            'address' => 'N/A',
            'contact' => $this->contact,
            'total_fare' => $this->totalCost,
        ];


        // Enquiry MAil function 

        $mailData = [
            'subject' => '📩 Bike Rental Booking Enquiry',
            'email' => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
            'body' => '',
        ];

        $mailData['body'] .= "Name: " . strip_tags(trim($data['name'])) . "<br/>";
        $mailData['body'] .= "Email: " . strip_tags(trim($data['email'])) . "<br/>";
        $mailData['body'] .= "Mobile: " . strip_tags(trim($data['contact'])) . "<br/>";
        $mailData['body'] .= "Category: " . strip_tags(trim($data['category'])) . "<br/>";
        $mailData['body'] .= "Package Type: " . strip_tags(trim($data['package_type'])) . "<br/>";
        $mailData['body'] .= "Pickup Date: " . $data['pickup_date'] . "<br/>";
        $mailData['body'] .= "Pickup Time: " . $data['pickup_time'] . "<br/>";
        $mailData['body'] .= "Return Date: " . $data['return_date'] . "<br/>";
        $mailData['body'] .= "Return Time: " . $data['return_time'] . "<br/>";
        $mailData['body'] .= "Location: " . strip_tags(trim($data['from_location'])) . "<br/>";
        $mailData['body'] .= "Pickup Option: " . strip_tags(trim($data['pickup'])) . "<br/>";
        if ($data['pickup_location']) {
            $mailData['body'] .= "Pickup Location: " . strip_tags(trim($data['pickup_location'])) . "<br/>";
        }
        $mailData['body'] .= "Bike Quantity: " . $data['cab_quantity'] . "<br/>";
        $mailData['body'] .= "Total Fare: INR " . $data['total_fare'] . "<br/>";


        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com');
        });

        // RentalBookings::create($data);
        // $bookNow = RentalBookings::create($data);


        // $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        // $orderData = [
        //     'amount' => $this->payNow * 100,
        //     'currency' => 'INR',
        //     'receipt' => 'order_rcptid_' . $bookNow->id,
        //     'payment_capture' => 1,
        // ];

        // $UserDeta = [
        //     'name' => $this->fullName,
        //     'email' => $this->email,
        //     'contact' => $this->contact,
        //     'razorpay_key' => env('RAZORPAY_API_KEY'),
        // ];
        // $order = $api->order->create($orderData);


        // $transaction = RazorpayTransactions::create([
        //     'purpose' => 'Bike Booking',
        //     'booking_id' => $bookNow->id,
        //     'name' => $bookNow->name,
        //     'email' => $bookNow->email,
        //     'phone' => $this->contact,
        //     'payment_id' => null,
        //     'order_id' => $order['id'],
        //     'currency' => 'INR',
        //     'amount' => $bookNow->payable,
        //     'mode' => 'test',
        //     'json_response' => json_encode($order),
        // ]);

        // $this->dispatch('OpenPaymentSdk', [
        //     'order' => $order->toArray(),
        //     'userDetails' => $UserDeta,
        // ]);
        session()->flash('message', 'Booking submitted successfully.');
        return redirect('bikes')->with('success', 'Enquiry Submitted');
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
                $bookingId = $this->handleBooking($payment->order_id); // returns ID, not redirect

                if ($bookingId) {
                    $this->dispatch('paymentCompleted', $bookingId);
                } else {
                    session()->flash('error', "Booking not found.");
                    $this->dispatch('paymentError', 'Booking not found.');
                }
            } else {
                session()->flash('error', "Payment Failed. Try Again");
                $this->dispatch('paymentError', 'Payment verification failed.');
            }
        } catch (\Exception $e) {
            session()->flash('error', "Payment Failed. Try Again");
            $this->dispatch('paymentError', 'Payment Failed: ' . $e->getMessage());
        }
    }

    public function paymentFailed()
    {
        // Payment canceled by user
        $this->dispatch('paymentError', 'Payment was canceled.');
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
                ->update(['status' => 'Captured']);

            $booking = DB::table('rental_bookings')->where('id', $transaction->booking_id)->first();

            if ($booking) {
                DB::table('rental_bookings')
                    ->where('id', $transaction->booking_id)
                    ->update(['status' => 'confirmed']);

                $this->sendPaymentConfirmation($booking);
                $this->sendBookingConfirmationEmail($booking);
                SendBikeRentConfirmation::dispatch($booking->id)
                    ->delay(now()->addMinutes(2));
                return $booking->id;
            }
        }

        return null;
    }


    protected function sendPaymentConfirmation($booking)
    {
        $billingDetails = \App\Models\RentalBookings::with(['cabPackages.cabPricing', 'payment'])
            ->find($booking->id);

        $cab = \App\Models\Service::whereIn('type', ['cab', 'bike'])
            ->where('id', $billingDetails->vehicle_id)
            ->first();

        $location = \App\Models\BikePickLocation::where('name', $billingDetails->from_location)->first();

        $mailData = [
            'subject' => '✅ Payment Successful- Your Bike Rental Booking is Confirmed',
            'email'   => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name'    => env('MAIL_FROM_NAME', 'Andaman Bliss'),
            'billingDetails' => $billingDetails,
            'cab' => $cab,
            'location' => $location,
        ];
        \Mail::send('emails.bike_payment', $mailData, function ($message) use ($mailData, $billingDetails) {
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


        $billingDetails = RentalBookings::with(['cabPackages.cabPricing', 'payment'])
            ->find($bookingId);

        $cab = Service::whereIn('type', ['cab', 'bike'])
            ->where('id', $billingDetails->vehicle_id)->first();
        $location = BikePickLocation::where('name', $billingDetails->from_location)->first();


        $pdf = Pdf::loadView('pages.bill', compact('billingDetails', 'cab', 'location'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        // Prepare email data
        $mailData = [
            'subject' => '✅ Bike Rental Booking Confirmation',
            'email' => env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com'),
            'name' => env('MAIL_FROM_NAME', 'AndamanBliss'),
            'body' => '',
        ];

        $mailData['body'] .= "Name: " . strip_tags(trim($booking->name)) . "<br/>";
        $mailData['body'] .= "Email: " . strip_tags(trim($booking->email)) . "<br/>";
        $mailData['body'] .= "Mobile: " . strip_tags(trim($booking->contact)) . "<br/>";
        $mailData['body'] .= "Category: " . strip_tags(trim($booking->category)) . "<br/>";
        $mailData['body'] .= "Package Type: " . strip_tags(trim($booking->package_type)) . "<br/>";
        $mailData['body'] .= "Pickup Date: " . $booking->pickup_date . "<br/>";
        $mailData['body'] .= "Pickup Time: " . $booking->pickup_time . "<br/>";
        $mailData['body'] .= "Return Date: " . $booking->return_date . "<br/>";
        $mailData['body'] .= "Return Time: " . $booking->return_time . "<br/>";
        $mailData['body'] .= "Location: " . strip_tags(trim($booking->from_location)) . "<br/>";
        $mailData['body'] .= "Pickup Option: " . strip_tags(trim($booking->pickup)) . "<br/>";
        if ($booking->pickup_location) {
            $mailData['body'] .= "Pickup Location: " . strip_tags(trim($booking->pickup_location)) . "<br/>";
        }
        $mailData['body'] .= "Bike Quantity: " . $booking->cab_quantity . "<br/>";
        $mailData['body'] .= "Total Fare: INR " . $booking->total_fare . "<br/>";
        $mailData['body'] .= "Paid Amount: INR " . $booking->payable . "<br/>";
        $mailData['body'] .= "Booking ID: " . $booking->id . "<br/>";
        $mailData['body'] .= "Note: Confirmation Voucher is attached below.";


        // Send email using Laravel's Mail facade
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $pdf) {
            $message->subject($mailData['subject'])
                ->to('info@andamanbliss.com')
                ->attachData($pdf->output(), 'Andaman_Bliss_Bike_Rental.pdf');
        });

        session()->flash('success', 'Booking confirmed and email sent successfully!');
    }


    public function getLocations($search)
    {
        if (!$search || strlen($search) < 2) {
            $this->locations = [];
            return;
        }

        $this->locations = IslandLocation::where('name', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get(['id', 'name', 'latitude', 'longitude'])
            ->toArray();
    }







    public function render()
    {
        return view('livewire.bike-booking', [
            'photo' => $this->photo,
        ]);
    }
}
