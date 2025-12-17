<?php

namespace App\Livewire\Ferry;

use App\Models\FerryBookings;
use App\Models\PassengerDetails;
use App\Models\RazorpayTransactions;
use App\Services\MakruzzApiService;
use App\Services\SealinkService;
use App\Services\GreenOceanService;
use App\Services\RazorpayServices;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class FerryOperationsPage extends Component
{
    protected $sealinkService;
    protected $makruzzApiService;
    protected $greenOceanService;
    public $ferry = [];
    public $sectors;
    public $selectedFerry;
    public $from_location, $to_location, $travel_date, $adult = 1, $child = 0, $no_of_passenger;
    public $selectedClass = null;
    public $totalStep = 3;
    public $step = 1;
    public $TravelData;
    public $SelectedFerry;
    public $childFares;
    public $selectedSeats = [];
    public $travelDetail = [];
    public $timelineItems = [];
    public $passengerDetails = [];
    public $TripCost;
    public $travelData;
    public $baseFare;
    public $bookingData;
    public $isSubmitted = false;
    public $billingName, $billingEmail, $billingMobile, $billingGst;
    public $totalCost = 0;
    public $InfantDetails = [];
    public $discount = 0;
    public $farediscount = 0;
    public $portFee = 50;
    public $Mtrip = 1;
    public $tripIndexToCheck = 0;
    public $class_id;
    public $sittingLayout = null;
    public $activeDate = null;
    public $bookingDatas = null;
    public $trips;
    public $tripType;

    public $countries = [
        "India",
        "Afghanistan",
        "Albania",
        "Algeria",
        "Andorra",
        "Angola",
        "Antigua and Barbuda",
        "Argentina",
        "Armenia",
        "Australia",
        "Austria",
        "Azerbaijan",
        "Bahamas",
        "Bahrain",
        "Bangladesh",
        "Barbados",
        "Belarus",
        "Belgium",
        "Belize",
        "Benin",
        "Bhutan",
        "Bolivia",
        "Bosnia and Herzegovina",
        "Botswana",
        "Brazil",
        "Brunei",
        "Bulgaria",
        "Burkina Faso",
        "Burundi",
        "Cabo Verde",
        "Cambodia",
        "Cameroon",
        "Canada",
        "Central African Republic",
        "Chad",
        "Chile",
        "China",
        "Colombia",
        "Comoros",
        "Congo",
        "Costa Rica",
        "Croatia",
        "Cuba",
        "Cyprus",
        "Czech Republic",
        "Democratic Republic of the Congo",
        "Denmark",
        "Djibouti",
        "Dominica",
        "Dominican Republic",
        "Ecuador",
        "Egypt",
        "El Salvador",
        "Equatorial Guinea",
        "Eritrea",
        "Estonia",
        "Eswatini",
        "Ethiopia",
        "Fiji",
        "Finland",
        "France",
        "Gabon",
        "Gambia",
        "Georgia",
        "Germany",
        "Ghana",
        "Greece",
        "Grenada",
        "Guatemala",
        "Guinea",
        "Guinea-Bissau",
        "Guyana",
        "Haiti",
        "Honduras",
        "Hungary",
        "Iceland",
        "India",
        "Indonesia",
        "Iran",
        "Iraq",
        "Ireland",
        "Israel",
        "Italy",
        "Jamaica",
        "Japan",
        "Jordan",
        "Kazakhstan",
        "Kenya",
        "Kiribati",
        "Korea (North)",
        "Korea (South)",
        "Kuwait",
        "Kyrgyzstan",
        "Laos",
        "Latvia",
        "Lebanon",
        "Lesotho",
        "Liberia",
        "Libya",
        "Liechtenstein",
        "Lithuania",
        "Luxembourg",
        "Madagascar",
        "Malawi",
        "Malaysia",
        "Maldives",
        "Mali",
        "Malta",
        "Marshall Islands",
        "Mauritania",
        "Mauritius",
        "Mexico",
        "Micronesia",
        "Moldova",
        "Monaco",
        "Mongolia",
        "Montenegro",
        "Morocco",
        "Mozambique",
        "Myanmar",
        "Namibia",
        "Nauru",
        "Nepal",
        "Netherlands",
        "New Zealand",
        "Nicaragua",
        "Niger",
        "Nigeria",
        "North Macedonia",
        "Norway",
        "Oman",
        "Pakistan",
        "Palau",
        "Panama",
        "Papua New Guinea",
        "Paraguay",
        "Peru",
        "Philippines",
        "Poland",
        "Portugal",
        "Qatar",
        "Romania",
        "Russia",
        "Rwanda",
        "Saint Kitts and Nevis",
        "Saint Lucia",
        "Saint Vincent and the Grenadines",
        "Samoa",
        "San Marino",
        "Sao Tome and Principe",
        "Saudi Arabia",
        "Senegal",
        "Serbia",
        "Seychelles",
        "Sierra Leone",
        "Singapore",
        "Slovakia",
        "Slovenia",
        "Solomon Islands",
        "Somalia",
        "South Africa",
        "South Sudan",
        "Spain",
        "Sri Lanka",
        "Sudan",
        "Suriname",
        "Sweden",
        "Switzerland",
        "Syria",
        "Taiwan",
        "Tajikistan",
        "Tanzania",
        "Thailand",
        "Timor-Leste",
        "Togo",
        "Tonga",
        "Trinidad and Tobago",
        "Tunisia",
        "Turkey",
        "Turkmenistan",
        "Tuvalu",
        "Uganda",
        "Ukraine",
        "United Arab Emirates",
        "United Kingdom",
        "United States",
        "Uruguay",
        "Uzbekistan",
        "Vanuatu",
        "Vatican City",
        "Venezuela",
        "Vietnam",
        "Yemen",
        "Zambia",
        "Zimbabwe"
    ];

    public $dates = [];
    public function FareDiscount()
    {
        $farediscount = 0;

        if (!empty($this->selectFerry)) {
            if ($this->selectFerry === 'Nautika') {
                $farediscount = 0;
            } elseif ($this->selectFerry === 'Makruzz') {
                $farediscount = 0;
            } elseif ($this->selectFerry === 'Green Ocean') {
                $farediscount = 0;
            }
        }

        if (!empty($this->from_location) && !empty($this->to_location)) {
            if ($this->from_location === 'Port Blair' && $this->to_location === 'Swaraj Dweep') {
                $farediscount = 0;
                if (!empty($this->selectFerry) && $this->selectFerry === 'Nautika') {
                    $farediscount = 0;
                }
            }
        }

        return $farediscount;
    }



    public function addDatePicker()
    {
        $this->dates[] = '';
    }
    public $currentTab = 'singletrip';

    public function boot(SealinkService $sealinkService, MakruzzApiService $makruzzApiService, GreenOceanService $greenOceanService)
    {
        $this->sealinkService = $sealinkService;
        $this->makruzzApiService = $makruzzApiService;
        $this->greenOceanService = $greenOceanService;
    }

    public function mount()
    {
        // Clear session data unless continuing a booking
        if (!session()->has('current_step') || session('current_step') == 1) {
            session()->forget([
                'current_step',
                'travelDetail',
                'from_location',
                'to_location',
                'adult',
                'child',
                'Mtrip',
                'trips',
                'totalCost',
                'TripCost',
                'tripIndexToCheck',
                'selectedSeats',
                'selectedFerry',
                'selectedClass',
                'childFares',
                'class_id',
                'TravelData'
            ]);
        }

        // Reset component properties
        $this->resetExcept(['timelineItems', 'activeDate', 'countries', 'sealinkService', 'makruzzApiService', 'greenOceanService']);
        $this->adult = 1;
        $this->child = 0;
        $this->Mtrip = 1;
        $this->step = 1;
        $this->tripIndexToCheck = 0;
        $this->from_location = 'Port Blair';
        $this->to_location = 'Swaraj Dweep';

        // Initialize from query parameters
        if (request()->has('tripType')) {
            $this->tripType = request()->input('tripType')[0] ?? null;
            if ($this->tripType === 'one') {
                $this->from_location = request()->input('from')[0] ?? 'Port Blair';
                $this->to_location = request()->input('to')[0] ?? 'Swaraj Dweep';
                $this->travel_date = request()->input('departure')[0] ?? null;
                $this->adult = (int) (request()->input('adult')[0] ?? 1);
                $this->child = (int) (request()->input('child')[0] ?? 0);
                $this->currentTab = 'singletrip';
                if ($this->travel_date && $this->from_location && $this->to_location) {
                    $this->searchFerry();
                }
            } else {
                $fromLocations = request()->input('mfrom', []);
                $toLocations = request()->input('mto', []);
                $departureDates = request()->input('mdeparture', []);
                $this->adult = (int) (request()->input('madult')[0] ?? 1);
                $this->child = (int) (request()->input('mchild')[0] ?? 0);
                $this->currentTab = 'multitrip';

                $trips = [];
                foreach ($fromLocations as $index => $from) {
                    $trips[] = [
                        'trip_type' => $this->tripType,
                        'from' => $from,
                        'to' => $toLocations[$index] ?? null,
                        'departure' => $departureDates[$index] ?? null,
                        'adult' => (int) (request()->input('madult')[$index] ?? 1),
                        'child' => (int) (request()->input('mchild')[$index] ?? 0),
                    ];
                }
                $this->trips = $trips;
                if (!empty($trips)) {
                    $this->multiFerry();
                }
            }
        }

        // Initialize passenger details
        if (empty($this->passengerDetails)) {
            for ($i = 1; $i <= $this->adult; $i++) {
                $this->passengerDetails[$i] = [
                    'prefix' => '',
                    'name' => '',
                    'gender' => '',
                    'age' => '',
                    'nationality' => 'India',
                    'idNumber' => '',
                ];
            }
        }

        if(auth()->check())
        {
            $this->billingName = auth()->user()->name ?? '';
            $this->billingEmail = auth()->user()->email ?? '';
            $this->billingMobile = auth()->user()->mobile ?? '';
        }

        // Generate timeline
        $this->generateTimeline();
    }


    protected $rules = [
        'passengerDetails.*.prefix' => 'required|string|max:255',
        'passengerDetails.*.name' => 'required|string|max:255',
        'passengerDetails.*.gender' => 'required|in:Male,Female',
        'passengerDetails.*.age' => 'required|integer|min:1',
        'passengerDetails.*.nationality' => 'required|string|max:255',
        'passengerDetails.*.idNumber' => 'required|string|max:50',
        'billingName' => 'required|string|max:255',
        'billingEmail' => 'required|email|max:255',
        'billingMobile' => 'required|digits:10',
        'billingGst' => 'nullable|string|max:15',
    ];

    protected $listeners = [
        'paymentSuccess' => 'handlePaymentSuccess',
        'paymentSuccess' => 'handlePaymentSuccess',
        'selectSeats' => 'selectSeat',
        'resetSteps' => 'ResetStep',
        'test' => 'test',

    ];


    public function updateDeparture($index, $date)
    {
        if (isset($this->trips[$index])) {
            $this->trips[$index]['departure'] = $date;
        }
    }
    public function updatedFromLocation($value)
    {
        if ($value == 'Port Blair') {
            $this->to_location = 'Swaraj Dweep';
        } elseif ($value == 'Swaraj Dweep') {
            $this->to_location = 'Shaheed Dweep';
        } elseif ($value == 'Shaheed Dweep') {
            $this->to_location = 'Port Blair';
        } else {
            $this->to_location = '';
        }
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
                $this->handleBooking($payment->order_id);
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


            $booking = DB::table('ferry_bookings')->where('bookno', $transaction->booking_id)->first();
            if ($booking) {
                DB::table('ferry_bookings')->where('bookno', $transaction->booking_id)->update([
                    'payment_status' => 1,
                ]);
                $this->ProceedBook();
            }
        } else {
            session()->flash('error', "Payment Failed Try Again");
        }
    }


    protected function ProceedBook()
    {
        $bookingDatas = $this->bookingDatas;
        $book_no = FerryBookings::where('id', $bookingDatas[0]['book_id'])->value('bookno');

        $successfulBookings = [];

        foreach ($bookingDatas as $bookingData) {

            $ferryService = $this->getFerryService($bookingData);

            if ($ferryService) {
                $pnr = $ferryService['pnr'] ?? null;
                $pdfBase64 = $ferryService['pdf_base64'] ?? null;
                $booking_id = $ferryService['booking_id'] ?? null;

                FerryBookings::find($bookingData['book_id'])
                        ?->update([
                        'pnr_no' => $pnr,
                        'base_code' => $pdfBase64,
                        'booking_id' => $booking_id,
                        'booking_status' => 1,
                        'payment_status' => 1,
                    ]);


                $successfulBookings[] = $ferryService;
            } else {
                session()->flash('error', "Booking failed for ferry: {$bookingData['ferry']}");
                Log::error("Booking failed for ferry: {$bookingData['ferry']}");
            }
        }

        if (!empty($successfulBookings)) {
            $this->ResetStep();
            $this->SentBookingConfirmMail($book_no);
            $this->SentBookingMail($book_no);

            $this->updatePid($book_no);

            $bookno = $book_no;

            return redirect()->route('booking-details', ['token' => $bookno]);
        } else {
            Log::warning("No successful bookings found. Aborting redirect.");
        }
    }



    public function updatePid($book_no)
    {
        $bookings = FerryBookings::where('bookno', $book_no)->with('passengerDetails')->whereIn('ferry', ['Green Ocean 1', 'Green Ocean 2'])->where('booking_status', 1)->get();
        
        foreach ($bookings as $book) {
            $bookingService = $this->greenOceanService->getTicketDetails($book->pnr_no);
            $apipassengers = $bookingService['active_passengers'];
            $dbpassengers = $book->passengerDetails;

            foreach ($dbpassengers as $dbpassenger) {
                foreach ($apipassengers as $apipassenger) {
                    if (trim(strtolower($dbpassenger->name)) === trim(strtolower($apipassenger['passenger_name']))) {
                        $dbpassenger->update([
                            'ticket_no' => $apipassenger['passenger_id']
                        ]);
                    }
                }
            }
        }
    }

    protected function SentBookingMail($book_no)
    {
        $bookings = FerryBookings::where('bookno', $book_no)
            ->where('booking_status', 1)
            ->get();

        if ($bookings->isEmpty()) {
            return back()->with('error', __('No confirmed bookings found.'));
        }

        $mailData['subject'] = 'Ferry Booking Success Full ✅';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = 'Andaman Bliss';
        $mailData['body'] = "";

        // Loop through all bookings to build the email body
        foreach ($bookings as $book) {
            if ($book->ferry) {
                $mailData['body'] .= "Ferry: {$book->ferry}<br/>";
            }
            if ($book->pnr_no) {
                $mailData['body'] .= "PNR No. : {$book->pnr_no}<br/>";
            }
            if ($book->from_location && $book->to_location) {
                $mailData['body'] .= "Sector: {$book->from_location} - {$book->to_location}<br/>";
            }
            if ($book->Adult) {
                $mailData['body'] .= "Adult: {$book->Adult}<br/>Infant: {$book->Infants}<br/>";
            }
            if ($book->travel_date && $book->embarkation) {
                $travelDate = \Carbon\Carbon::parse($book->travel_date)->format('d M Y');
                $embarkationTime = \Carbon\Carbon::parse($book->embarkation)->format('h:i A');
                $mailData['body'] .= "Travel Date: {$travelDate} - {$embarkationTime}<br/>";
            }
        }

        // Add ticket download and extra information
        $mailData['body'] .= "<br/>Please download your ticket from <a href='https://andamanbliss.com/booking-ticket/{$book_no}'>here</a><br/>";
        $mailData['body'] .= "Don't Share Confidential";

        // Send the email
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $bookings) {
            $message->subject($mailData['subject'])
                ->to(['info@andamanbliss.com']);
        });
    }



    protected function SentBookingConfirmMail($book_no)
    {
        $bookings = FerryBookings::where('bookno', $book_no)
            ->where('booking_status', 1)
            ->get();

        if ($bookings->isEmpty()) {
            return back()->with('error', __('No confirmed bookings found.'));
        }
        $subjectParts = [];

        foreach ($bookings as $book) {
            if ($book->ferry && $book->pnr_no) {
                $subjectParts[] = "{$book->ferry} - {$book->pnr_no}";
            }
        }

        $mailData['subject'] = 'Ferry Ticket Confirmation – ' . implode(' | ', $subjectParts);
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = $bookings[0]['name'];
        $mailData['body'] = "Thank you for choosing AndamanBliss.";
        $mailData['body'] = "We are pleased to confirm your ferry booking as per the details below: <br>";

        // Loop through all bookings to build the email body
        foreach ($bookings as $book) {
            if ($book->ferry) {
                $mailData['body'] .= "Ferry: {$book->ferry}<br/>";
            }
            if ($book->pnr_no) {
                $mailData['body'] .= "PNR No. : {$book->pnr_no}<br/>";
            }
            if ($book->from_location && $book->to_location) {
                $mailData['body'] .= "Sector: {$book->from_location} - {$book->to_location}<br/>";
            }
            if ($book->Adult) {
                $mailData['body'] .= "Passenger(s) : {$book->Adult} Adult , Infant: {$book->Infants}<br/>";
            }
            if ($book->travel_date && $book->embarkation) {
                $travelDate = \Carbon\Carbon::parse($book->travel_date)->format('d M Y');
                $embarkationTime = \Carbon\Carbon::parse($book->embarkation)->format('h:i A');
                $mailData['body'] .= "Travel Date: {$travelDate} - {$embarkationTime}<br/>";
            }
        }

        // Add ticket download and extra information
        $mailData['body'] .= "<br/>Please download your ticket from <a href='https://andamanbliss.com/booking-ticket/{$book_no}'>here</a><br/>";
        $mailData['body'] .= "Please arrive at the boarding point 45 minutes before departure.<br/>";
        $mailData['body'] .= "For assistance, contact our support team.<br/>";
        $mailData['body'] .= "Warm regards,<br/>Team Andaman Bliss";
        $mailData['body'] .= "<a href='https://andamanbliss.com'>Andaman Bliss </a>";
        // Send the email
        \Mail::send('emails.template', $mailData, function ($message) use ($mailData, $bookings) {
            $message->subject($mailData['subject'])
                ->to([$bookings[0]['email']]);
        });
    }








    protected function SendCombinedLowBalanceMail(array $trips, string $customerName, string $customerEmail, string $customerPhone)
    {
        $mailData['subject'] = '❌ Booking Failed - Multiple Ferry Providers Have Low Balance';
        $mailData['email'] = env('MAIL_FROM_ADDRESS', 'info@andamanbliss.com');
        $mailData['name'] = env('MAIL_FROM_NAME', 'Andaman Bliss');

        $mailData['body'] = "<strong>The following ferry booking attempts failed due to low API balance:</strong><br/><br/>";
        $mailData['body'] .= "Customer Name: {$customerName}<br/>";
        $mailData['body'] .= "Email: {$customerEmail}<br/>";
        $mailData['body'] .= "Phone: {$customerPhone}<br/><br/>";

        // Table with trips
        $mailData['body'] .= "<table border='1' cellspacing='0' cellpadding='6' style='border-collapse: collapse; font-family: Arial; font-size: 13px;'>";
        $mailData['body'] .= "<tr style='background:#f0f0f0'>
        <th>Provider</th>
        <th>From</th>
        <th>To</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Travel Date</th>
        <th>Trip Cost</th>
        <th>Available Balance</th>
    </tr>";

        foreach ($trips as $trip) {
            $mailData['body'] .= "<tr>
            <td>{$trip['provider']}</td>
            <td>{$trip['from']}</td>
            <td>{$trip['to']}</td>
            <td>{$trip['departure']}</td>
            <td>{$trip['arrival']}</td>
            <td>{$trip['travelDate']}</td>
            <td>₹{$trip['tripCost']}</td>
            <td>₹{$trip['balance']}</td>
        </tr>";
        }

        $mailData['body'] .= "</table><br/><strong>⚠️ Please top up the ferry provider accounts to enable bookings.</strong>";

        \Mail::send('emails.template', $mailData, function ($message) use ($mailData) {
            $message->subject($mailData['subject'])
                ->to(['info@andamanbliss.com']);
        });
    }




    protected function getFerryService($bookingData)
    {

        if ($bookingData['ferry'] === 'Nautika') {
            $bookingService = $this->sealinkService->bookSeats($bookingData);

            if (isset($bookingService[0]['seatStatus']) && $bookingService[0]['seatStatus']) {

                return [
                    'pnr' => $bookingService[0]['pnr'],
                    'pdf_base64' => $bookingService[0]['pdf_base64'] ?? null
                    // 'pnr' => 'TESTNAUT',
                    // 'pdf_base64' => 'ertyuitgh23y423hh' ?? null
                ];
            }

            $this->dispatch('alert', __('Nautika booking failed ' . ($bookingService['err'] ?? '')));
            Log::error('getFerryService: Nautika booking failed.', ['response' => $bookingService]);
            return false;
        }

        if ($bookingData['ferry'] === 'Green Ocean') {

            $bookingService = $this->greenOceanService->bookTicket($bookingData['bookingData']);

            if (isset($bookingService['status']) && $bookingService['status'] === 'success') {

                return [
                    'pnr' => $bookingService['pnr'],
                    'pdf_base64' => $bookingService['pdf_base64'] ?? null
                ];
            }

            $this->dispatch('alert', __('Green Ocean booking failed'));
            Log::error('getFerryService: Green Ocean booking failed.', ['response' => $bookingService]);
            return false;
        }

        if ($bookingData['ferry'] === 'Makruzz') {
            $savePassenger = $this->makruzzApiService->savePassengers($bookingData);

            if (!isset($savePassenger['data']['booking_id'])) {
                Log::error('Makruzz API: Failed to retrieve booking_id', ['response' => $savePassenger]);
                return false;
            }

            $bookingId = $savePassenger['data']['booking_id'];

            $confirmBooking = $this->makruzzApiService->confirmBooking($bookingId);
            $confirmBookingData = $confirmBooking->getData(true);

            if (!isset($confirmBookingData['data']['pnr'])) {
                Log::error('Makruzz API: Failed to retrieve PNR', [
                    'response' => $confirmBookingData,
                    'booking_id' => $bookingId
                ]);
                return false;
            }

            $pnr = $confirmBookingData['data']['pnr'];

            $getTicketResponse = $this->makruzzApiService->downloadTicket($bookingId);

            if (!$getTicketResponse) {
                Log::error('Makruzz API: Failed to download ticket.', ['booking_id' => $bookingId]);
                return false;
            }

            $pdfBase64 = $getTicketResponse->getContent();

            return [
                'pnr' => $pnr,
                'booking_id' => $bookingId,
                'pdf_base64' => $pdfBase64
            ];
        }

        $this->dispatch('alert', __('Makruzz booking failed'));
        Log::error('Makruzz: Unknown ferry type.', ['ferry' => $bookingData['ferry']]);
        return false;
    }








    public function selectSeat($seatNumber, $seatTier)
    {
        $tripId = $this->tripIndexToCheck;

        $seat = [
            'seatno' => $seatNumber,
            'tier' => $seatTier,
            'trip_id' => $tripId
        ];

        $seatIndex = array_search($seatNumber, array_column($this->selectedSeats, 'seatno'));

        if ($seatIndex === false) {
            $currentSeatsForTrip = array_filter($this->selectedSeats, function ($s) use ($tripId) {
                return $s['trip_id'] === $tripId;
            });

            if (count($currentSeatsForTrip) >= $this->adult) {
                $this->dispatch('alert', __('You can only select up to ' . $this->adult . ' seats for this trip.'));
                return;
            }

            $this->selectedSeats[] = $seat;
        } else {
            unset($this->selectedSeats[$seatIndex]);
            $this->selectedSeats = array_values($this->selectedSeats);
        }

        session()->put('selectedSeats', $this->selectedSeats);
    }




    public function next()
    {
        $errors = [];
        if ($this->step < $this->totalStep) {
            $tripId = $this->tripIndexToCheck;
            $requiredSeats = $this->adult;
            if ($this->selectedFerry['has_seat'] == 1) {
                $selectedSeats = array_filter($this->selectedSeats, fn($seat) => $seat['trip_id'] == $tripId);
                $selectedSeatsCount = count($selectedSeats);

                if ($selectedSeatsCount < $requiredSeats) {
                    $balance = $requiredSeats - $selectedSeatsCount;
                    $errors[] = __('Please select ' . $balance . ' more seats for trip ' . ($tripId + 1));
                } elseif ($selectedSeatsCount > $requiredSeats) {
                    $overSelected = $selectedSeatsCount - $requiredSeats;
                    $errors[] = __('You have selected ' . $overSelected . ' extra seats for trip ' . ($tripId + 1));
                }

                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        $this->dispatch('alert', $error);
                    }
                    return;
                }
            }

            $this->travelDetail = $this->travelDetail ?? [];

            if (count($this->travelDetail) < $this->Mtrip) {
                $this->CalculateCost();
                $this->travelDetail[] = $this->TravelData();
                session()->put('travelDetail', $this->travelDetail);
                $this->totalCost += $this->TripCost;
            }

            if ($this->Mtrip == 1) {
                $this->validate([
                    'selectedFerry' => 'required',
                    'selectedClass' => 'required',
                    'from_location' => 'required',
                    'to_location' => 'required|different:from_location',
                    'travel_date' => 'required|date|after_or_equal:today',
                    'adult' => 'required|integer|min:1',
                    'child' => 'nullable|integer|min:0',
                ]);
            }

            if ($this->tripIndexToCheck + 1 < $this->Mtrip) {
                $this->tripIndexToCheck++;
                $this->step = 1;
                $this->multiFerry();
            } elseif ($this->step <= $this->totalStep) {
                $this->NextStep();
            }
        } else {
            $this->NextStep();
        }
    }



    public function navigate($to, $mtrip = null)
    {
        if ($to > $this->step) {
            $this->dispatch('alert', __('Complete Current Details'));
            return;
        } else {
            if ($mtrip > 1) {
                $this->Mtrip = $mtrip;
            }
            $this->step = $to;
            $this->ResetStep();
        }
    }


    public function previous()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    protected function TravelData()
    {
        if ($this->SelectedFerry['has_seat'] == 0) {
            $filteredSeats = null;
        } else {
            $filteredSeats = array_filter($this->selectedSeats, function ($seat) {
                return isset($seat['trip_id']) && $seat['trip_id'] == $this->tripIndexToCheck;
            });

            $filteredSeats = array_values(array_unique($filteredSeats, SORT_REGULAR));
        }

        return [
            'ferryDetail' => is_array($this->SelectedFerry) ? $this->SelectedFerry : [],
            'travelDate' => $this->travel_date,
            'selectedClass' => $this->selectedClass,
            'baseFare' => is_array($this->baseFare) ? $this->baseFare : ($this->baseFare ?? []),
            'tripCost' => is_array($this->TripCost) ? $this->TripCost : ($this->TripCost ?? []),
            'selectedSeats' => $filteredSeats,
            'trip_id' => $this->tripIndexToCheck,
            'adult' => $this->adult,
            'infant' => $this->child,
        ];
    }

    protected function CalculateCost()
    {
        if ($this->SelectedFerry['has_seat'] == 0) {
            $filteredSeats = null;
        } else {
            $filteredSeats = array_filter($this->selectedSeats, function ($seat) {
                return isset($seat['trip_id']) && $seat['trip_id'] == $this->tripIndexToCheck;
            });

            $filteredSeats = array_values(array_unique($filteredSeats, SORT_REGULAR));
        }

        $selectedClass = strtolower($this->selectedClass);

        $classData = collect($this->SelectedFerry['classes'])
            ->firstWhere('class_name', ucfirst($selectedClass));

        $this->TripCost = $classData ? $classData['adult_seat_rate'] : 0;
        $this->baseFare = $classData ? $classData['adult_seat_rate'] : 0;
        $AdultFare = $this->TripCost;
        $childFare = $this->SelectedFerry['infant_fare'];
        $this->childFares = $childFare;

        $adults = ($this->SelectedFerry['has_seat'] == 0) ? $this->adult : count($filteredSeats);
        $ChildCost = $this->child * $childFare;
        $AdultCost = $adults * $AdultFare;



        $this->TripCost = $ChildCost + $AdultCost + ($this->adult * $this->portFee);
        session()->put('TripCost', $this->TripCost);
    }


    public function Proceed()
    {

        try {
            $this->validateOnly('selectedClass', [
                'selectedClass' => 'required|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('alert', __('Please Select Class'));
            $this->dispatch('error', $e->validator->errors()->first());
            return;
        }


        if (in_array($this->selectedFerry['ferry_name'], ['Green Ocean 1', 'Green Ocean 2'])) {


            $class_id = $this->selectedFerry['classes'][$this->selectedClass]['class_id'];
            $this->class_id = $class_id;
            session()->put('class_id', $class_id);

            $layoutData = [
                'ship_id' => $this->selectedFerry['ferry_id'],
                'route_id' => $this->selectedFerry['route_id'],
                'from_id' => $this->getLocationId($this->from_location),
                'dest_to' => $this->getLocationId($this->to_location),
                'class_id' => $class_id,
                'travel_date' => $this->travel_date,

            ];

            $layout = $this->greenOceanService->getSeatLayout($layoutData);

            if ($layout !== null) {
                $this->sittingLayout = $layout['data'];
            } else {
                dd('No layout found for the given ferry.');
            }
        }

        $selectedClass = $this->selectedFerry['classes'][$this->selectedClass]['class_name'];
        $this->selectedClass = $selectedClass;

        $data = [
            'SelectedFerry' => $this->selectedFerry,
            'SelectedClass' => $this->selectedClass,
            'from_location' => $this->from_location,
            'to_location' => $this->to_location,
            'travel_date' => $this->travel_date,
            'adult' => $this->adult,
            'child' => $this->child,

        ];




        $slug = uniqid('cruise_');
        $this->TravelData = $data;
        $this->selectedClass = $data['SelectedClass'];
        $this->SelectedFerry = $data['SelectedFerry'];
        $this->from_location = $data['from_location'];
        $this->to_location = $data['to_location'];
        $this->travel_date = $data['travel_date'];
        $this->adult = $data['adult'];
        $this->child = $data['child'];

        $this->childFares = $data['SelectedFerry']['infant_fare'];
        session()->put('childFares', $this->childFares);
        $this->NextStep();
    }



    public function getListeners()
    {
        return [
            'testDate' => 'testDate',
            'selectSeat' => 'selectSeat',
        ];
    }

    public function testDate($rawDate)
    {
        try {
            $dateTime = new DateTime($rawDate);
            $this->travel_date = $dateTime->format('d-m-Y');
            $this->activeDate = $dateTime;
            $this->searchFerry();
        } catch (\Exception $e) {
            Log::error('Error in testDate method:', ['error' => $e->getMessage()]);
        }
    }

    private function getLocationId($location)
    {
        $locations = [
            'Port Blair' => 1,
            'Swaraj Dweep' => 2,
            'Shaheed Dweep' => 3,
        ];

        return $locations[$location] ?? null;
    }


    public function searchFerry()
    {
        $this->farediscount = $this->FareDiscount();
        $from_location = $this->from_location;
        $to_location = $this->to_location;
        $travel_date = $this->travel_date;

        $this->activeDate = Carbon::parse($this->travel_date)->format('Y-m-d');

        $adult = $this->adult;
        $child = $this->child;
        $no_of_passenger = $this->adult + $this->child;

        // Prepare API request data
        $sealinkData = [
            'date' => Carbon::parse($travel_date)->format('d-m-Y'),
            'from' => $from_location,
            'to' => $to_location,
            'userName' => 'agent',
            'token' => config('services.sealink.token'),
        ];

        $makruzzData = [
            'trip_type' => 'single_trip',
            'from_location' => $this->getLocationId($from_location),
            'to_location' => $this->getLocationId($to_location),
            'no_of_passenger' => $no_of_passenger,
            'travel_date' => Carbon::parse($travel_date)->format('Y-m-d'),
        ];

        $greenoceanData = [
            'from_id' => $this->getLocationId($this->from_location),
            'dest_to' => $this->getLocationId($this->to_location),
            'number_of_adults' => $adult,
            'number_of_infants' => $child,
            'travel_date' => $travel_date,
        ];

        $ferries = [];

        try {


            // Initialize ferry data
            $sealinkFerryData = [];
            $makruzzFerryData = [];
            $greenOceanFerryData = [];

            // Fetch Sealink data
            if ($this->sealinkService) {
                try {
                    $sealinkFerry = $this->sealinkService->getTripData($sealinkData);
                    $sealinkFerryData = isset($sealinkFerry['data']) && is_array($sealinkFerry['data']) ? $sealinkFerry['data'] : [];
                } catch (\Exception $e) {
                    Log::warning('Failed to fetch Sealink data', [
                        'exception' => $e->getMessage(),
                        'request' => $sealinkData,
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $sealinkFerryData = [];
                }
            } else {
                Log::notice('Sealink service not initialized');
            }

            // Fetch Makruzz data
            if ($this->makruzzApiService) {
                try {
                    $makruzzFerry = $this->makruzzApiService->searchSchedule($makruzzData);
                    $makruzzFerryData = isset($makruzzFerry['data']) && is_array($makruzzFerry['data']) ? $makruzzFerry['data'] : [];
                } catch (\Exception $e) {
                    Log::warning('Failed to fetch Makruzz data', [
                        'exception' => $e->getMessage(),
                        'request' => $makruzzData,
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $makruzzFerryData = [];
                }
            } else {
                Log::notice('Makruzz service not initialized');
            }

            if ($this->greenOceanService) {
                try {
                    $greenOceanFerry = $this->greenOceanService->searchFerry($greenoceanData);
                    $greenOceanFerryData = isset($greenOceanFerry['data']) && is_array($greenOceanFerry['data']) ? $greenOceanFerry['data'] : [];
                } catch (\Exception $e) {
                    Log::warning('Failed to fetch GreenOcean data', [
                        'exception' => $e->getMessage(),
                        'request' => $greenoceanData,
                        'trace' => $e->getTraceAsString(),
                    ]);
                    $greenOceanFerryData = [];
                }
            } else {
                Log::notice('GreenOcean service not initialized');
            }

            $SealinkTrips = [];
            foreach ($sealinkFerryData as $trip) {
                $SealinkTrips[] = [
                    'image' => url('site/img/nautika.png'),
                    'id' => $trip['id'],
                    'tripId' => $trip['tripId'],
                    'ferry_name' => 'Nautika',
                    'from' => $trip['from'],
                    'to' => $trip['to'],
                    'departure' => date('h:i A', strtotime("{$trip['dTime']['hour']}:{$trip['dTime']['minute']}")),
                    'arraival' => date('h:i A', strtotime("{$trip['aTime']['hour']}:{$trip['aTime']['minute']}")),
                    'vesselID' => $trip['vesselID'],
                    'infant_fare' => $trip['fares']['infantFare'],
                    'fare' => $trip['fares']['pBaseFare'] ?? 0,
                    'has_seat' => 1,
                    'service_provider' => 'nautika',
                    'seats' => [
                        'bClass' => $trip['bClass'],
                        'pClass' => $trip['pClass'],
                    ],
                    'classes' => array_values(array_filter([
                        [
                            'class_name' => 'Luxury',
                            'class_count' => count($trip['pClass'] ?? []),
                            'adult_seat_rate' => $trip['fares']['pBaseFare'] ?? 0,
                            'seat_available' => count(array_filter($trip['pClass'] ?? [], fn($seat) => !$seat['isBooked'] && !$seat['isBlocked'])),
                        ],
                        [
                            'class_name' => 'Royal',
                            'class_count' => count($trip['bClass'] ?? []),
                            'adult_seat_rate' => $trip['fares']['bBaseFare'] ?? 0,
                            'seat_available' => count(array_filter($trip['bClass'] ?? [], fn($seat) => !$seat['isBooked'] && !$seat['isBlocked'])),
                        ],
                    ], fn($class) => $class['class_count'] > 0))
                ];
            }
            // dd($SealinkTrips);
            // Process Makruzz trips
            $Mak = [];
            foreach ($makruzzFerryData as $trip) {
                $key = $trip['departure_time'] . $trip['arrival_time'] . $trip['ship_title'] . $trip['id'];
                if (!isset($Mak[$key])) {
                    $Mak[$key] = [
                        'departure' => date('h:i A', strtotime($trip['departure_time'])),
                        'arraival' => date('h:i A', strtotime($trip['arrival_time'])),
                        'ferry_name' => $trip['ship_title'],
                        'ferry_id' => $trip['ship_id'],
                        'route_id' => $trip['id'],
                        'seat_available' => $trip['seat'],
                        'adult_seat_rate' => $trip['ship_class_price'],
                        'port_fee' => $trip['psf'] ?? 0,
                        'fare' => $trip['ship_class_price'],
                        'image' => $trip['images'][0] ?? url('site/logos/makruzz-logo.png'),
                        'from' => $trip['source_name'],
                        'to' => $trip['destination_name'],
                        'Provider' => 3,
                        'departDate' => $travel_date,
                        'adult' => $adult,
                        'infant' => $child ?? 0,
                        'trip_id' => $trip['id'],
                        'infant_fare' => 0,
                        'has_seat' => 0,
                        'service_provider' => 'makruzz',
                        'classes' => [],
                    ];
                }
                $Mak[$key]['classes'][] = [
                    'class_name' => $trip['ship_class_title'],
                    'class_id' => $trip['ship_class_id'],
                    'seat_available' => $trip['seat'],
                    'adult_seat_rate' => $trip['ship_class_price'],
                ];
            }
            $Mak = array_values($Mak);

            // Process GreenOcean trips
            $GreenOceanTrips = [];
            if (is_array($greenOceanFerryData) || $greenOceanFerryData instanceof \Traversable) {
                foreach ($greenOceanFerryData as $trips) {
                    if (is_array($trips) || $trips instanceof \Traversable) {
                        foreach ($trips as $trip) {
                            $key = $trip['departure'] . $trip['arraival'] . $trip['ferry_name'] . $trip['route_id'];
                            if (!isset($GreenOceanTrips[$key])) {
                                $GreenOceanTrips[$key] = array_intersect_key($trip, array_flip([
                                    'departure',
                                    'arraival',
                                    'ferry_name',
                                    'route_id',
                                    'ferry_id',
                                    'port_fee',
                                    'seat_available',
                                    'adult_seat_rate'
                                ]));
                                $GreenOceanTrips[$key]['fare'] = $trip['adult_seat_rate'];
                                $GreenOceanTrips[$key]['image'] = url('site/img/green-ocean.jpeg');
                                $GreenOceanTrips[$key]['from'] = $this->from_location;
                                $GreenOceanTrips[$key]['to'] = $this->to_location;
                                $GreenOceanTrips[$key]['infant_fare'] = $trip['infant_seat_rate'] ?? 0;
                                $GreenOceanTrips[$key]['service_provider'] = 'green ocean';
                                $GreenOceanTrips[$key]['classes'] = [];
                                $GreenOceanTrips[$key]['has_seat'] = 1;
                            }
                            $GreenOceanTrips[$key]['classes'][] = array_intersect_key($trip, array_flip([
                                'class_name',
                                'class_id',
                                'seat_available',
                                'adult_seat_rate'
                            ]));
                        }
                    } else {
                        Log::warning('Invalid GreenOcean trips format', ['trips' => $trips]);
                    }
                }
            } else {
                Log::warning('Invalid GreenOcean ferry data format', ['data' => $greenOceanFerryData]);
            }
            $GreenOceanTrips = array_values($GreenOceanTrips);

            // Merge and sort ferries
            $ferries = array_merge($SealinkTrips, $Mak, $GreenOceanTrips);
            usort($ferries, function ($a, $b) {
                $timeA = strtotime($a['departure']);
                $timeB = strtotime($b['departure']);
                return $timeA <=> $timeB;
            });

            // Handle results
            if (empty($ferries)) {
                Log::notice('No ferry trips available', [
                    'sealink_count' => count($SealinkTrips),
                    'makruzz_count' => count($Mak),
                    'greenocean_count' => count($GreenOceanTrips),
                ]);
                $this->dispatch('alert', __('Trips not Available'));
                $this->ferry = [];
                $this->ResetStep();
            } else {
                $this->ferry = $ferries;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching ferry data', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'sealink_data' => $sealinkData,
                'makruzz_data' => $makruzzData,
                'greenocean_data' => $greenoceanData,
            ]);
            $this->ferry = [];
            session()->flash('error', 'There was an error fetching ferry data.');
        }
    }

    public function multiFerry()
    {
        $allFerryDataByTrip = [];
        foreach ($this->trips as $index => $trip) {
            $this->Mtrip = count($this->trips);
            $from_location = $trip['from'];
            $to_location = $trip['to'];
            $travel_date = $trip['departure'];
            $adult = $this->adult;
            $child = $this->child;

            if (empty($from_location) || empty($to_location) || empty($travel_date)) {
                session()->flash('error', 'Please fill all fields for each trip.');

                return;
            }

            $no_of_passenger = $adult + $child;

            $sealinkData = [
                'date' => $travel_date,
                'from' => $from_location,
                'to' => $to_location,
                'userName' => 'agent',
                'token' => config('services.sealink.token'),
            ];

            $makruzzData = [
                'trip_type' => 'single_trip',
                'from_location' => $from_location,
                'to_location' => $to_location,
                'no_of_passenger' => $no_of_passenger,
                'travel_date' => $travel_date,
            ];

            try {


                $sealinkFerryData = [];
                $makruzzFerryData = [];

                if ($this->sealinkService) {
                    $sealinkFerry = $this->sealinkService->getTripData($sealinkData);
                    $sealinkFerryData = isset($sealinkFerry['data']) && is_array($sealinkFerry['data']) ? $sealinkFerry['data'] : [];
                } else {
                    Log::error('SealinkService is null when calling getTripData.');
                    session()->flash('error', 'SealinkService is unavailable.');
                    return;
                }

                if ($this->makruzzApiService) {
                    $makruzzFerry = $this->makruzzApiService->searchSchedule($makruzzData);
                    $makruzzFerryData = isset($makruzzFerry['data']) && is_array($makruzzFerry['data']) ? $makruzzFerry['data'] : [];
                } else {
                    Log::error('MakruzzApiService is null when calling searchSchedule.');
                    session()->flash('error', 'MakruzzApiService is unavailable.');
                    return;
                }

                $allFerryDataByTrip[$index] = [
                    'sealink' => $sealinkFerryData,
                    'makruzz' => $makruzzFerryData
                ];

                if ($index == $this->tripIndexToCheck) {
                    $this->from_location = $from_location;
                    $this->to_location = $to_location;
                    $this->travel_date = $travel_date;
                    $this->adult = $adult;
                    $this->child = $child;
                    $this->no_of_passenger = $no_of_passenger;

                    $this->searchFerry();
                }
            } catch (\Exception $e) {
                Log::error("Error fetching ferry data for trip $index", ['exception' => $e]);
                session()->flash('error', "There was an error fetching ferry data for trip $index.");
            }
        }
    }

    protected function NextStep()
    {
        if ($this->step < $this->totalStep) {
            if ($this->step == $this->totalStep - 1) {


                $this->step++;


                session()->put('current_step', $this->step);
                session()->put('from_location', $this->from_location);
                session()->put('to_location', $this->to_location);
                session()->put('adult', $this->adult);
                session()->put('child', $this->child);
                session()->put('totalCost', $this->totalCost);
                session()->put('Mtrip', $this->Mtrip);
                session()->put('trips', $this->trips);
            } else {

                if ($this->selectedFerry['has_seat'] == 0) {
                    $this->step++;
                    $this->next();
                } else {
                    $this->step++;
                }
            }
        } elseif ($this->step == $this->totalStep) {

            $this->submit();
        } else {
            $this->dispatch('alert', __('Steps Exceeded'));
            return;
        }
    }


    public static function FerryApiBalance()
    {
        $sealinkService = app()->make(SealinkService::class);
        $greenOceanService = app()->make(GreenOceanService::class);
        $makruzzService = app()->make(MakruzzApiService::class);

        $nautikaBalance = $sealinkService->getBalance();
        $greenResponse = $greenOceanService->getBalance();
        $greenOceanBalance = $greenResponse['data']['account_balance'] ?? 0;
        $makruzzBalance = $makruzzService->getBalance();
        $data = [
            'nautikaBalance' => $nautikaBalance,
            'greenOceanBalance' => $greenOceanBalance,
            'makruzzBalance' => $makruzzBalance
        ];

        return response()->json($data);
    }


    protected function submit()
    {
        return;
        $this->validate([
            'billingName' => 'required|string|max:255',
            'billingEmail' => 'required|email',
            'billingMobile' => 'required|string|min:10',
        ]);
        $balance = static::FerryApiBalance()->getData(true);

        $lowBalanceTrips = [];

        foreach ($this->travelDetail as $travel) {

            $provider = strtolower($travel['ferryDetail']['service_provider']);
            $tripCost = $travel['tripCost'];


            $currentBalance = match ($provider) {
                'nautika' => $balance['nautikaBalance'] ?? 0,
                'green ocean' => $balance['greenOceanBalance'] ?? 0,
                'makruzz' => $balance['makruzzBalance'] ?? 0,
                default => 0,
            };


            if ($tripCost > $currentBalance) {
                $tripInfo = [
                    'provider' => $travel['ferryDetail']['service_provider'],
                    'tripCost' => $tripCost,
                    'balance' => $currentBalance,
                    'from' => $travel['ferryDetail']['from'],
                    'to' => $travel['ferryDetail']['to'],
                    'departure' => $travel['ferryDetail']['departure'],
                    'arrival' => $travel['ferryDetail']['arraival'],
                    'travelDate' => $travel['travelDate'],
                ];
                $lowBalanceTrips[] = $tripInfo;
            }
        }

        if (!empty($lowBalanceTrips)) {
            $this->SendCombinedLowBalanceMail(
                $lowBalanceTrips,
                $this->billingName,
                $this->billingEmail,
                $this->billingMobile
            );
            $this->dispatch('alert', __('Booking Failed: One or more ferry providers have insufficient balance.'));
            return;
        }



        $lockKey = 'booking_lock_' . session()->getId();
        $lock = Cache::lock($lockKey, 10);
        $lockAcquired = $lock->get();

        if ($lockAcquired) {
            try {
                $this->validate();

                if ($this->child > 0) {
                    for ($i = 1; $i <= $this->child; $i++) {
                        $this->validate([
                            "InfantDetails.$i.prefix" => 'required|string',
                            "InfantDetails.$i.name" => 'required|string|max:255',
                            "InfantDetails.$i.gender" => 'required|in:Male,Female',
                            "InfantDetails.$i.dob" => 'required|date|before:today',
                            "InfantDetails.$i.nationality" => 'required|string',
                            "InfantDetails.$i.idNumber" => 'required|string',
                        ]);
                    }
                }

                $bookings = [];
                $bookNo = uniqid();
                foreach ($this->travelDetail as $travel) {

                    $bookingData = [
                        'trip_id' => $travel['ferryDetail']['id'] ?? $travel['ferryDetail']['ferry_id'] . '' . $travel['ferryDetail']['route_id'],
                        'bookno' => $bookNo,
                        'pnr_no' => null,
                        'name' => $this->billingName,
                        'phone' => $this->billingMobile,
                        'user_id' => auth()->user()->id ?? '',
                        'email' => $this->billingEmail,
                        'gst' => $this->billingGst ?? null,
                        'baseFare' => $travel['baseFare'],
                        'infantFare' => $this->childFares,
                        'totalCost' => $travel['tripCost'],
                        'Psf' => 50,
                        'Adult' => $travel['adult'],
                        'from_location' => $travel['ferryDetail']['from'],
                        'to_location' => $travel['ferryDetail']['to'],
                        'travel_date' => date('Y-m-d', strtotime($travel['travelDate'])),
                        'embarkation' => date('H:i:s', strtotime($travel['ferryDetail']['departure'])),
                        'disembarkation' => date('H:i:s', strtotime($travel['ferryDetail']['arraival'])),
                        'ferry' => $travel['ferryDetail']['ferry_name'],
                        'vesselId' => $travel['ferryDetail']['vesselID'] ?? $travel['ferryDetail']['ferry_id'],
                        'booking_mode' => 'Online',
                    ];



                    $bookingRecord = FerryBookings::create($bookingData);

                    if ($this->child > 0) {
                        $infantDetails = [];

                        foreach ($this->InfantDetails as $infant) {
                            $dob = Carbon::parse($infant['dob']);
                            $age = $dob->age;
                            $infantDetails[] = [
                                'booking_id' => $bookingRecord->id,
                                'prefix' => $infant['prefix'],
                                'name' => $infant['name'],
                                'group' => 'Infant',
                                'age' => $age,
                                'gender' => $infant['gender'],
                                'nationality' => $infant['nationality'],
                                'id_no' => $infant['idNumber'],
                            ];
                        }
                        foreach ($infantDetails as $infantDetail) {
                            PassengerDetails::create($infantDetail);
                        }
                    }


                    $seatIndex = 0;
                    $paxDetails = [];

                    if (isset($travel['selectedSeats']) && !empty($travel['selectedSeats'])) {
                        foreach ($this->passengerDetails as $pax) {
                            if ($seatIndex < count($travel['selectedSeats'])) {
                                $paxDetail = [
                                    'booking_id' => $bookingRecord->id,
                                    'prefix' => $pax['prefix'],
                                    'name' => $pax['name'],
                                    'age' => $pax['age'],
                                    'gender' => $pax['gender'],
                                    'class' => $travel['selectedClass'],
                                    'nationality' => $pax['nationality'],
                                    'id_no' => $pax['idNumber'],
                                    'seat_no' => $travel['selectedSeats'][$seatIndex]['seatno'],
                                    'tier' => $travel['selectedSeats'][$seatIndex]['tier'],
                                ];
                                PassengerDetails::create($paxDetail);
                                $seatIndex++;
                            }
                        }
                    }

                    $bookings[] = [
                        'bookingRecord' => $bookingRecord,
                        'travel' => $travel,
                        'paxDetails' => $this->passengerDetails,
                        'infantDetails' => $this->InfantDetails,
                    ];
                }

                $bookingDatas = $this->prepareBookingData($bookings);

                $this->bookingDatas = $bookingDatas;

                if ($bookingDatas) {
                    $payments = [
                        'name' => $this->billingName,
                        'mobile' => $this->billingMobile,
                        'email' => $this->billingEmail,
                        'amount' => $this->totalCost,
                        'purpose' => 'Ferry Booking',
                        'booking_id' => $bookNo,
                    ];
                    $UserDeta = [
                        'name' => $this->billingName,
                        'email' => $this->billingEmail,
                        'contact' => $this->billingMobile,
                        'razorpay_key' => env('RAZORPAY_API_KEY'),
                    ];
                    $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
                    $orderData = [
                        'amount' => $this->totalCost * 100,
                        'currency' => 'INR',
                        'receipt' => 'order_rcptid_' . $bookNo,
                        'payment_capture' => 1,
                    ];
                    $order = $api->order->create($orderData);
                    $transaction = RazorpayTransactions::create([
                        'purpose' => $payments['purpose'],
                        'booking_id' => $payments['booking_id'],
                        'name' => $payments['name'],
                        'email' => $payments['email'],
                        'phone' => $payments['mobile'],
                        'payment_id' => null,
                        'order_id' => $order['id'],
                        'currency' => 'INR',
                        'amount' => $payments['amount'],
                        'mode' => 'live',
                        'json_response' => json_encode($order),
                    ]);

                    $this->dispatch('OpenPaymentSdk', [
                        'order' => $order->toArray(),
                        'userDetails' => $UserDeta,
                    ]);
                } else {
                    dd('Some bookings failed. Payment will not proceed.');
                }
            } finally {
                if (isset($lock)) {
                    $lock->release();
                }
            }
        }
    }

    protected function prepareBookingData(array $bookings)
    {
        $preparedData = [];
        foreach ($bookings as $booking) {
            if (in_array($booking['travel']['ferryDetail']['ferry_name'], ['Nautika Seaways', 'Nautika'])) {
                $data = $this->SealinkBookingData($booking);
            } elseif (in_array($booking['travel']['ferryDetail']['ferry_name'], ['Green Ocean 1', 'Green Ocean 2'])) {
                $data = $this->GreenOceanBookingData($booking);
            } else if (str_starts_with(trim($booking['travel']['ferryDetail']['ferry_name']), 'Makruzz')) {
                $data = $this->MakruzzBookingData($booking);
            }
            if (!empty($data) && isset($data['bookingData'])) {
                $preparedData[] = $data;
            }
        }
        return $preparedData;
    }

    //stuck here

    protected function MakruzzBookingData(array $booking)
    {
        $travel = $booking['travel'];
        $bookingRecord = $booking['bookingRecord'];
        $from_id = $this->getLocationId($this->from_location);
        $dest_to = $this->getLocationId($this->to_location);

        $passengerData = [];
        $index = 1;



        foreach ($booking['paxDetails'] as $pax) {
            $passengerData[$index++] = [
                "title" => strtoupper($pax['prefix'] ?? 'MR'),
                "name" => $pax['name'] ?? 'Unknown',
                "age" => (string) ($pax['age'] ?? '0'),
                "sex" => strtolower($pax['gender'] ?? 'male'),
                "nationality" => strtolower($pax['nationality'] ?? 'indian'),
                "fcountry" => strtolower($pax['nationality'] ?? 'indian'),
                "fpassport" => $pax['idNumber'] ?? '',
                "fexpdate" => ""
            ];
        }
        if (!empty($booking['infantDetails'])) {
            foreach ($booking['infantDetails'] as $infant) {
                $passengerData[$index++] = [
                    "title" => strtoupper($infant['prefix'] ?? 'INFANT'),
                    "name" => $infant['name'] ?? 'Unknown',
                    "age" => 1,
                    "sex" => strtolower($infant['gender'] ?? 'male'),
                    "nationality" => strtolower($infant['nationality'] ?? 'indian'),
                    "fcountry" => strtolower($infant['nationality'] ?? 'indian'),
                    "fpassport" => $infant['idNumber'] ?? '',
                    "fexpdate" => ""
                ];
            }
        }




        foreach ($travel['ferryDetail']['classes'] as $class) {
            if ($class['class_name'] === $travel['selectedClass']) {
                $travel['selectedClass'] = (int) $class['class_id'];
                break;
            }
        }
        $preparedBookingData = [
            "passenger" => $passengerData,
            "c_name" => 'Pravin Kumar',
            "c_mobile" => '8900909900',
            "c_email" => 'info@andamanbliss.com',
            "p_contact" => '8900909900',
            "c_remark" => "live",
            "no_of_passenger" => (string) count($passengerData),
            "schedule_id" => $travel['ferryDetail']['trip_id'],
            "travel_date" => isset($travel['travelDate']) ? date('Y-m-d', strtotime($travel['travelDate'])) : date('Y-m-d'),
            "class_id" => $travel['selectedClass'],
            "fare" => $travel['baseFare'],
            "tc_check" => true
        ];

        return [
            "bookingData" => $preparedBookingData,
            'ferry' => 'Makruzz',
            'book_id' => $bookingRecord['id'],
        ];
    }

    protected function GreenOceanBookingData(array $booking)
    {
        $travel = $booking['travel'];
        $bookingRecord = $booking['bookingRecord'];
        $from_id = $this->getLocationId($this->from_location);
        $dest_to = $this->getLocationId($this->to_location);

        if (!empty($booking['infantDetails']) && is_array($booking['infantDetails'])) {
            foreach ($booking['infantDetails'] as &$infant) {
                if (!isset($infant['dob']))
                    continue;

                $dob = new DateTime($infant['dob']);
                $today = new DateTime();
                $age = $today->diff($dob)->y;
                $infant['age'] = $age;
            }
            unset($infant);
        }


        if (!empty($booking['infantDetails']) && is_array($booking['infantDetails'])) {
            foreach ($booking['infantDetails'] as &$infant) {
                if (!isset($infant['dob']))
                    continue;

                $dob = new DateTime($infant['dob']);
                $today = new DateTime();
                $age = $today->diff($dob)->y;
                $infant['age'] = $age;
            }
            unset($infant);
        }

        $preparedBookingData = [
            "ship_id" => (int) ($travel['ferryDetail']['ferry_id'] ?? 0),
            "from_id" => (int) $this->getLocationId($travel['ferryDetail']['from']),
            "dest_to" => (int) $this->getLocationId($travel['ferryDetail']['to']),
            "route_id" => (int) ($travel['ferryDetail']['route_id'] ?? 0),
            "class_id" => (int) ($this->class_id),
            "number_of_adults" => count($booking['paxDetails']),
            "number_of_infants" => isset($booking['infantDetails']) ? count($booking['infantDetails']) : 0,
            "passenger_prefix" => array_values(array_map(fn($pax) => $pax['prefix'] ?? 'Mr', $booking['paxDetails'])),
            "passenger_name" => array_values(array_map(fn($pax) => $pax['name'], $booking['paxDetails'])),
            "passenger_age" => array_values(array_map(fn($pax) => (string) $pax['age'], $booking['paxDetails'])),
            "gender" => array_values(array_map(fn($pax) => $pax['gender'], $booking['paxDetails'])),
            "nationality" => array_values(array_map(fn($pax) => $pax['nationality'], $booking['paxDetails'])),
            "passport_numb" => array_values(array_map(fn($pax) => $pax['idNumber'] ?? '', array: $booking['paxDetails'])),
            "passport_expairy" => array_values(array_fill(0, count($booking['paxDetails']), "")),
            "country" => array_values(array_fill(0, count($booking['paxDetails']), "")),
            "infant_prefix" => array_values(array_map(fn($infant) => $infant['prefix'] ?? 'Mr', $booking['infantDetails'] ?? [])),
            "infant_name" => array_values(array_map(fn($infant) => $infant['name'] ?? '', $booking['infantDetails'] ?? [])),
            "infant_age" => array_values(array_map(fn($infant) => isset($infant['age']) ? (string) $infant['age'] : '', $booking['infantDetails'] ?? [])),
            "infant_gender" => array_values(array_map(fn($infant) => $infant['gender'] ?? '', $booking['infantDetails'] ?? [])),
            "travel_date" => $travel['travelDate'] ?? date('d-m-Y'),
            "seat_id" => array_values(array_map(fn($seat) => (int) $seat['tier'], $travel['selectedSeats'] ?? [])),
        ];
        return [
            "bookingData" => $preparedBookingData,
            'ferry' => 'Green Ocean',
            'book_id' => $bookingRecord['id'],
        ];
    }



    protected function SealinkBookingData(array $booking)
    {
        $travel = $booking['travel'];
        $bookingRecord = $booking['bookingRecord'];
        $preparedBookingData = [
            [
                "bookingTS" => now()->timestamp,
                "id" => $travel['ferryDetail']['id'],
                "tripId" => $travel['ferryDetail']['tripId'],
                "vesselID" => $travel['ferryDetail']['vesselID'],
                "from" => $travel['ferryDetail']['from'],
                "to" => $travel['ferryDetail']['to'],
                "paxDetail" => [
                    "email" => 'info@andamanbliss.com',
                    "phone" => '8900909900',
                    "gstin" => $this->billingGst ?? '',
                    "pax" => array_map(function ($pax, $index) use ($travel) {
                        $seatDetail = $travel['selectedSeats'][$index] ?? [];
                        return [
                            "id" => $index + 1,
                            "name" => $pax['name'],
                            "age" => $pax['age'],
                            "gender" => substr($pax['gender'], 0, 1),
                            "nationality" => $pax['nationality'],
                            "passport" => $pax['idNumber'] ?? '',
                            "tier" => $seatDetail['tier'] ?? '',
                            "seat" => $seatDetail['seatno'] ?? '',
                            "isCancelled" => 0
                        ];
                    }, array_values($booking['paxDetails']), range(0, count($booking['paxDetails']) - 1)),
                    "infantPax" => array_map(function ($infant, $index) {
                        $dobTimestamp = strtotime($infant['dob']);
                        return [
                            "id" => $index + 1,
                            "name" => $infant['name'],
                            "dobTS" => $dobTimestamp,
                            "dob" => $infant['dob'],
                            "gender" => substr($infant['gender'], 0, 1),
                            "nationality" => $infant['nationality'],
                            "passport" => $infant['idNumber'],
                            "isCancelled" => 0
                        ];
                    }, $this->InfantDetails, array_keys($this->InfantDetails)),
                    "bClassSeats" => [],
                    "pClassSeats" => [],
                ],
                "userData" => [
                    "apiUser" => [
                        "userName" => env('SEALINK_API_USERNAME'),
                        "agency" => '',
                        "token" => config('services.sealink.token'),
                        "walletBalance" => 0,
                    ]
                ],
                "paymentData" => [
                    "gstin" => $this->billingGst ?? '',
                ]
            ]
        ];

        foreach ($travel['selectedSeats'] as $seat) {
            if ($seat['tier'] === "B") {
                $preparedBookingData[0]['paxDetail']['bClassSeats'][] = $seat['seatno'];
            } elseif ($seat['tier'] === "P") {
                $preparedBookingData[0]['paxDetail']['pClassSeats'][] = $seat['seatno'];
            }
        }

        return [
            "bookingData" => $preparedBookingData,
            "userName" => env('SEALINK_API_USERNAME'),
            "token" => config('services.sealink.token'),
            "ferry" => 'Nautika',
            'book_id' => $bookingRecord['id'],
        ];
    }





    public function ResetStep()
    {
        $sealinkService = session('sealinkService');
        $makruzzApiService = session('makruzzApiService');
        session()->forget(['current_step', 'travelDetail', 'from_location', 'class_id', 'to_location', 'child', 'adult', 'Mtrip', 'trips', 'totalCost', 'step', 'TripCost', 'tripIndexToCheck', 'selectedSeats', 'selectedFerry']);
        session(['sealinkService' => $sealinkService, 'makruzzApiService' => $makruzzApiService]);
        $this->resetExcept('timelineItems', 'activeDate');
        $this->dispatch('pagerefres');
        return redirect()->route('cruises');
    }




    public function increment($type, $index = null)
    {
        if ($index !== null) {
            if ($type === 'adult') {
                $this->trips[$index]['adult']++;
            } elseif ($type === 'child') {
                $this->trips[$index]['child']++;
            }
        } else {
            if ($type === 'adult') {
                $this->adult++;
            } elseif ($type === 'child') {
                $this->child++;
            }
        }
    }

    public function decrement($type, $index = null)
    {
        if ($index !== null) {
            if ($type === 'adult' && $this->trips[$index]['adult'] > 1) {
                $this->trips[$index]['adult']--;
            } elseif ($type === 'child' && $this->trips[$index]['child'] > 0) {
                $this->trips[$index]['child']--;
            }
        } else {
            if ($type === 'adult' && $this->adult > 1) {
                $this->adult--;
            } elseif ($type === 'child' && $this->child > 0) {
                $this->child--;
            }
        }
    }

    public function addTrip()
    {
        if (count($this->trips) < 3) {
            $this->trips[] = ['from' => '', 'to' => '', 'departure' => '', 'adult' => 1, 'child' => 0];
        }
        $this->dispatch('initializeDatepickers');
    }

    public function removeTrip($index)
    {
        unset($this->trips[$index]);
        $this->trips = array_values($this->trips);
    }

    public function selectFerry($ferry)
    {
        $this->reset('selectedClass');
        $this->selectedFerry = $ferry;
        session()->put('selectedFerry', $this->selectedFerry);
        $this->dispatch('open-modal');
    }
    public function switchTab($tab)
    {
        $this->currentTab = $tab;
        $this->reset('step', 'Mtrip', 'class_id', 'tripIndexToCheck', 'TravelData', 'from_location', 'to_location', 'travel_date', 'billingName', 'billingEmail', 'billingMobile', 'billingGst', 'TripCost', 'travelData', 'ferry', 'Mtrip', 'trips', 'selectedFerry');
    }

    public function generateTimeline()
    {

        $timelineItems = [];
        $daysToShow = 30;
        $startDate = now();

        $monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];

        for ($i = 0; $i < $daysToShow; $i++) {
            $currentDate = $startDate->copy()->addDays($i);
            $day = $currentDate->day;
            $month = $monthNames[$currentDate->month - 1];
            $weekday = $currentDate->shortDayName;

            $timelineItems[] = [
                'date' => $currentDate->toDateString(),
                'day' => $day,
                'month' => $month,
                'weekday' => $weekday,
                'isActive' => $i === 0
            ];
        }

        $this->timelineItems = $timelineItems;
    }
    public function handleDateClick($dateId)
    {
        try {
            $dateTime = new DateTime($dateId);
            $this->activeDate = $dateTime;
            $this->travel_date = $dateTime;
            $this->travel_date = $dateTime->format('d-m-Y');
            $this->activeDate = $dateId;
            $this->generateTimeline();
            $this->searchFerry();
        } catch (\Exception $e) {
            Log::error('Error in testDate method:', ['error' => $e->getMessage()]);
        }
    }
    public function prev()
    {
        $this->dispatch('reinitialize-timeline');
    }

    public function nexttime()
    {
        $this->dispatch('reinitialize-timeline');
    }
    public function render()
    {
        return view('livewire.ferry.ferry-operations-page', [
            'currentTab' => $this->currentTab,
        ]);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
