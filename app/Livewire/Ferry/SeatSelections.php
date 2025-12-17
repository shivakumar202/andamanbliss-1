<?php

namespace App\Livewire\Ferry;

use App\Services\MakruzzApiService;
use App\Services\SealinkService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SeatSelections extends Component
{
    protected $sealinkService;
    protected $makruzzApiService;
    public $TravelData;
    public $selectedClass, $SelectedFerry, $from_location, $to_location, $travel_date, $adult, $child, $childFares;
    public $selectedSeats = [];
    public $passengerDetails = [];
    public $travelData;
    public $baseFare;
    public $bookingData;
    public $isSubmitted = false;
    public $billingName, $billingEmail, $billingMobile, $billingGst;
    public $totalCost = 0;
    public $InfantDetails = [];
    public $discount = 0;
    public $portFee = 50;
    public $totalStep = 2;
    public $step = 1;


    public function boot(SealinkService $sealinkService, MakruzzApiService $makruzzApiService)
    {

        $this->sealinkService = $sealinkService;
        $this->makruzzApiService = $makruzzApiService;
    }

    public $countries = [
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


    protected $rules = [
        'billingName' => 'required|string|max:255',
        'billingEmail' => 'required|email|max:255',
        'billingMobile' => 'required|regex:/^[0-9]{10}$/',
        'billingGst' => 'nullable|sometimes|string|min:5|regex:/^[a-zA-Z0-9]+$/',


    ];
    protected $messages = [
        'billingGst.regex' => 'The GSTIN must contain only numbers and letters.',
    ];


    protected $listeners = [
        'selectSeats' => 'selectSeat',
    ];

    public function selectSeat($seatNumber, $seatTier)
    {
        $seat = ['seatno' => $seatNumber, 'tier' => $seatTier];
        $seatIndex = array_search($seat['seatno'], array_column($this->selectedSeats, 'seatno'));

        if ($seatIndex === false) {
            if (count($this->selectedSeats) >= $this->adult) {
                $this->dispatch('alert', __('You have already selected the required number of seats'));
                return;
            }

            $this->selectedSeats[] = $seat;
            $this->passengerDetails[] = [
                'seat_no' => $seatNumber,
                'name' => '',
                'gender' => '',
                'age' => '',
                'nationality' => 'India',
                'idType' => '',
                'idNumber' => ''
            ];
        } else {
            unset($this->selectedSeats[$seatIndex]);
            unset($this->passengerDetails[$seatIndex]);
            $this->selectedSeats = array_values($this->selectedSeats);
            $this->passengerDetails = array_values($this->passengerDetails);
        }

        $this->CalculateCost();
    }

    public function next()
    {
        if ($this->step == 2) {
            return;
        }
        $errors = [];

        if (count($this->selectedSeats) != $this->adult) {
            $balance = $this->adult - count($this->selectedSeats);
            $errors[] = __('Please select ' . $balance . ' more seats to proceed with booking...');
        }
        foreach ($this->passengerDetails as $index => $passenger) {
            if (empty($passenger['name'])) {
                $errors[] = __('Passenger ' . ($index + 1) . ' name is required.');
            }
            if (empty($passenger['gender'])) {
                $errors[] = __('Passenger ' . ($index + 1) . ' gender is required.');
            }
            if (empty($passenger['age']) || !is_numeric($passenger['age']) || $passenger['age'] <= 0) {
                $errors[] = __('Passenger ' . ($index + 1) . ' age must be a positive number.');
            }
            if (empty($passenger['nationality'])) {
                $errors[] = __('Passenger ' . ($index + 1) . ' nationality is required.');
            }
            if (empty($passenger['idNumber'])) {
                $errors[] = __('Passenger ' . ($index + 1) . ' ID number is required.');
            }
        }

        if ($this->child > 0) {
            foreach ($this->InfantDetails as $index => $infant) {
                if (empty($infant['name'])) {
                    $errors[] = __('Infant ' . ($index + 1) . ' name is required.');
                }
                if (empty($infant['gender'])) {
                    $errors[] = __('Infant ' . ($index + 1) . ' gender is required.');
                }
                if (empty($infant['dob'])) {
                    $errors[] = __('Infant ' . ($index + 1) . ' date of birth is required.');
                }
            }
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                $this->dispatch('alert', $error);
            }
            return;
        }
        $this->validate();
        if ($this->step <= $this->totalStep) {
            $this->step++;
        }
        session()->put('step', $this->step);
        session()->put('selectedSeats', $this->selectedSeats);
        session()->put('passengerDetails', $this->passengerDetails);
        session()->put('InfantDetails', $this->InfantDetails);
        session()->put('selectedClass', $this->selectedClass);
        session()->put('baseFare', $this->baseFare);
        session()->put('totalCost', $this->totalCost);

        $this->travelData = $this->TravelData();
    }

    public function previous()
    {
        if ($this->step > 1) {

            $this->step--;
            session()->put('step', $this->step);
            session()->put('selectedSeats', $this->selectedSeats);
            session()->put('passengerDetails', $this->passengerDetails);
            session()->put('InfantDetails', $this->InfantDetails);
            session()->put('selectedClass', $this->selectedClass);
            session()->put('baseFare', $this->baseFare);
            session()->put('totalCost', $this->totalCost);
        }
    }

    protected function TravelData()
    {
        $traveldata = [
            'ferryDetail' => is_array($this->SelectedFerry) ? $this->SelectedFerry : [],
            'passengerDetail' => is_array($this->passengerDetails) ? $this->passengerDetails : [],
            'infantDetail' => is_array($this->InfantDetails) ? $this->InfantDetails : [],
            'selectedClass' => is_array($this->selectedClass) ? $this->selectedClass : [],
            'baseFare' => is_array($this->baseFare) ? $this->baseFare : ($this->baseFare ?? []),
            'totalCost' => is_array($this->totalCost) ? $this->totalCost : ($this->totalCost ?? []),
            'billingDetail' => [
                'name' => $this->billingName ?? null,
                'mobile' => $this->billingMobile ?? null,
                'email' => $this->billingEmail ?? null,
                'gst' => $this->billingGst ?? null,
            ],
        ];

        return $traveldata;
    }

    public function submit()
    {
        $this->isSubmitted = true;
        $this->validate();
        $bookingData = $this->prepareBookingData();
        if($bookingData) {
            Log::info('sealink booking data', $bookingData);
            $sealinkService = $this->sealinkService->bookSeats($bookingData);            
        }
    }


    protected function prepareBookingData()
    {
        return [
            "bookingData" => [
                [
                    "bookingTS" => now()->timestamp,
                    "id" => uniqid(),
                    "tripId" => $this->SelectedFerry['tripId'],
                    "vesselID" => $this->SelectedFerry['vesselID'],
                    "from" => $this->from_location,
                    "to" => $this->to_location,
                    "paxDetail" => [
                        "email" => $this->billingEmail,
                        "phone" => $this->billingMobile,
                        "gstin" => $this->billingGst ?? null,
                        "pax" => array_map(function ($passenger) {
                            return [
                                "id" => uniqid(),
                                "name" => $passenger['name'],
                                "age" => $passenger['age'],
                                "gender" => substr($passenger['gender'], 0, 1),
                                "nationality" => $passenger['nationality'],
                                "passport" => $passenger['idNumber'] ?? "",
                                "tier" => $this->selectedClass,
                                "seat" => $passenger['seat_no'],
                                "isCancelled" => 0
                            ];
                        }, $this->passengerDetails),
                        "infantPax" => array_map(function ($infant, $index) {
                            $dobTimestamp = strtotime($infant['dob']);
                            return [
                                "id" => $index + 1,
                                "name" => $infant['name'],
                                "dobTS" => $dobTimestamp,
                                "dob" => $infant['dob'],
                                "gender" => substr($infant['gender'], 0, 1),
                                "nationality" => "India",
                                "passport" => "",
                                "isCancelled" => 0
                            ];
                        }, $this->InfantDetails, array_keys($this->InfantDetails)),
                        "bClassSeats" => $this->selectedClass === "B"
                            ? array_column($this->selectedSeats, 'seatno')
                            : [],
                        "pClassSeats" => $this->selectedClass === "P"
                            ? array_column($this->selectedSeats, 'seatno')
                            : []
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
                        "gstin" => $this->billingGst ?? null,
                    ]
                ]
            ],
            "userName" => env('SEALINK_API_USERNAME'),
            'token' => config('services.sealink.token')
        ];
    }

    public function mount($data)
    {
        $this->TravelData = $data;
        $this->selectedClass = $data['SelectedClass'];
        $this->SelectedFerry = $data['SelectedFerry'];
        $this->from_location = $data['from_location'];
        $this->to_location = $data['to_location'];
        $this->travel_date = $data['travel_date'];
        $this->adult = $data['adult'];
        $this->child = $data['child'];
        $this->childFares = $data['SelectedFerry']['fares']['infantFare'];

        for ($i = 1; $i <= $this->child; $i++) {
            $this->InfantDetails[$i] = ['name' => '', 'gender' => '', 'dob' => ''];
        }

        $this->CalculateCost();
    }

    protected function CalculateCost()
    {
        $selectedClass = strtolower($this->selectedClass);
        $fareKey = $selectedClass . 'BaseFare';
        $this->totalCost = $this->SelectedFerry['fares'][$fareKey];
        $this->baseFare = $this->SelectedFerry['fares'][$fareKey];
        $AdultFare = $this->totalCost;
        $childFare = $this->SelectedFerry['fares']['infantFare'];
        $adults = count($this->selectedSeats);
        $ChildCost = $this->child * $childFare;
        $AdultCost = $adults * $AdultFare;
       
        $this->totalCost = $ChildCost + $AdultCost + $this->portFee;
        
    }

    public function render()
    {
        return view('livewire.ferry.seat-selections');
    }
}
