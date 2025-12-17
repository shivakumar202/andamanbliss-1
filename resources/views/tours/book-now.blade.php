@extends('layouts.app')

@section('title', 'Tour Package Booking and Payment')

@section('content')
<div id="booking-loader"
    style="
                    display: none;
                    position: fixed;
                    z-index: 9999;
                    top: 0;
                    left: 0;
                    height: 100vh;
                    width: 100vw;
                    background: rgba(255, 255, 255, 0.7);
                    backdrop-filter: blur(2px);
                    justify-content: center;
                    align-items: center;
                    font-size: 1.5rem;
                    color: #000;
                    font-weight: bold;
                ">
    Processing your booking...
</div>

<form method="POST" action="{{ route('tour.pay') }}" class="mt-5" enctype="multipart/form-data" id="booking-form">
    @csrf
    @php

    $jsonValue = htmlentities(json_encode($tempItineraries), ENT_QUOTES, 'UTF-8');
    @endphp
    <input type="hidden" name="hotel_response" value="{{ $jsonValue }}">
    <section class="booking-review-section">
        <div class="container p-0">
            <div class="booking-steps mb-2 pt-5 d-flex flex-nowrap p-3">
                <div class="step active">
                    <span class="step-number">1</span>
                    <span class="step-text">Traveller Details</span>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <span class="step-text">Payment</span>
                </div>
            </div>

            <div class="row g-0">
                <div class="col-lg-8 col-md-7 p-1 ">
                    <div class=" rounded p-3 tour-package-left shadow ">
                        <h3>
                            <strong>{{ $tempItineraries[0]->tour->package_name }} {{ $tempItineraries[0]->category }}</strong>
                            <span
                                class="tour-package-badge ms-2 fw-bolder">{{ $tempItineraries[0]->tour->tourCategory->name }} Tour Package</span>
                        </h3>
                        <p class="text-muted mb-1">
                            <i class="fa fa-map-marker me-2 text-gradient" aria-hidden="true"></i>
                            {{ implode(', ', $tempItineraries[0]->tour->islands_covered) }}

                        </p>

                        <div class="d-flex justify-content-between py-1 border-top border-bottom my-1">
                            <div class="jour-main">
                                <strong class="date-list">START DATE</strong><br>
                                {{ \Carbon\Carbon::parse($tempItineraries[0]->start_date)->format('D') }}
                                <strong class="date-list">{{ \Carbon\Carbon::parse($tempItineraries[0]->start_date)->format('d-m-Y') }}</strong><br>
                            </div>
                            <div class="text-center align-self-center">
                                <strong class="date-list">{{ $tempItineraries[0]->tour->nights }} NIGHTS -
                                    {{ $tempItineraries[0]->tour->days }} DAYS</strong>
                            </div>
                            @php

                            $end_date = \Carbon\Carbon::parse($tempItineraries[0]->start_date)
                            ->addDays($tempItineraries[0]->tour->nights)
                            ->format('d-m-Y');

                            @endphp
                            <div class="jour-main">
                                <strong class="date-list">END DATE</strong><br>
                                Mon <strong class="date-list">{{ $end_date }}</strong><br>
                            </div>
                        </div>
                        @php
                        $roomGuests = json_decode($tempItineraries[0]->guest, true) ?? [];
                        $wh = $tempItineraries[0]->wh;
                        $totalAdults = 0;
                        $totalChildren = 0;
                        $totalRooms = count($roomGuests);

                        foreach ($roomGuests as $room) {
                        $totalAdults += (int) ($room['Adults'] ?? 0);
                        $totalChildren += (int) ($room['Children'] ?? 0);
                        }
                        @endphp
                        <p class="fw-bold guest-count-dtls">{{ $tempItineraries[0]->tour->days }} Days | {{ $totalAdults }} Adults
                            {{ $totalChildren }} Children {{ $wh == 1 ? ', ' . $totalRooms . ' Rooms' : '' }}
                        </p>
                        <hr>
                        <h3 class="fw-bold fs-6"> {{ $wh == 1 ? 'Room &' : '' }}  Guest Details</h3>
                        @php
                        $roomGuests = json_decode($tempItineraries[0]->guest, true) ?? [];
                        @endphp

                        @foreach ($roomGuests as $roomIndex => $room)
                        <div class=" mb-3 bg-light">
                            @if($wh == 1)
                            <h4 class="mb-3 room-ty">Room {{ $roomIndex + 1 }}</h4>
                            @endif
                            {{-- Adults --}}
                            @for ($i = 1; $i <= $room['Adults']; $i++)
                                <div class="mb-3">
                                <label class="form-label d-block">Adult {{ $i }}</label>
                                <div class="row g-1">
                                    <div class="col-md-2">
                                        <select
                                            name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][title]"
                                            class="form-control rounded-0" required>
                                            <option value="">Title</option>
                                            <option>Mr</option>
                                            <option>Mrs</option>
                                            <option>Miss</option>
                                            <option>Master</option>
                                            <option>Dr</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"
                                            name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][first_name]"
                                            class="form-control rounded-0" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"
                                            name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][middle_name]"
                                            class="form-control rounded-0" placeholder="Middle Name">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"
                                            name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][last_name]"
                                            class="form-control rounded-0" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-md-2">
                                        <select
                                            name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][gender]"
                                            class="form-control rounded-0" required>
                                            <option value="">Gender</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number"
                                            name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][age]"
                                            class="form-control rounded-0" placeholder="Age" required>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <input type="text" name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][id_no]" class="form-control rounded-0" placeholder="AADHAR Number" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="guests[{{ $roomIndex }}][adults][{{ $i - 1 }}][id_file]" class="form-control rounded-0" accept=".jpg,.jpeg,.png,.pdf" required>
                                    </div> -->
                                </div>
                        </div>
                        @endfor

                        {{-- Children --}}
                        @foreach ($room['ChildrenAges'] ?? [] as $j => $childAge)
                        <div class="mb-3">
                            <label class="form-label d-block">Child {{ $j + 1 }}</label>
                            <div class="row g-1">
                                <div class="col-md-2">
                                    <select
                                        name="guests[{{ $roomIndex }}][children][{{ $i - 1 }}][title]"
                                        class="form-control rounded-0" required>
                                        <option value="">Title</option>
                                        <option>Mr</option>
                                        <option>Mrs</option>
                                        <option>Ms</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text"
                                        name="guests[{{ $roomIndex }}][children][{{ $j }}][name]"
                                        class="form-control rounded-0" placeholder="Full Name" required>
                                </div>
                                <div class="col-md-2">
                                    <select
                                        name="guests[{{ $roomIndex }}][children][{{ $j }}][gender]"
                                        class="form-control rounded-0" required>
                                        <option value="">Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control rounded-0"
                                        name="guests[{{ $roomIndex }}][children][{{ $j }}][age]"
                                        value="{{ $childAge }}" readonly>
                                </div>
                                {{-- <div class="col-md-3">
                                                    <input type="text"
                                                        name="guests[{{ $roomIndex }}][children][{{ $j }}][id_no]"
                                class="form-control rounded-0" placeholder="AADHAAR Number" required>
                            </div>
                            <div class="col-md-4">
                                <input type="file"
                                    name="guests[{{ $roomIndex }}][children][{{ $j }}][id_file]"
                                    class="form-control rounded-0" accept=".jpg,.jpeg,.png,.pdf"
                                    required>
                            </div> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <hr>
                <h3 class="fs-6 fw-bold">Billing Details</h3>
                <div class="row g-1">
                    <div class="col-md-6"><input type="text" name="billing[name]" value="{{ $logged['name'] ?? ''  }}" class="form-control rounded-0" placeholder="Full Name" required></div>
                    <div class="col-md-6"><input type="email" name="billing[email]" value="{{ $logged['email'] ?? ''  }}" class="form-control rounded-0" placeholder="Email" required></div>
                <div class="col-md-6"><input type="text" name="billing[phone]" value="{{ $logged['phone'] ?? ''  }}" onkeydown="return ! ['e','-', 'E', '+' , '.'].includes(event.key)" class="form-control rounded-0" placeholder="Phone Number" required></div>
                    <div class="col-md-6"><input type="text" name="billing[gst]" class="form-control rounded-0" placeholder="GST Number (optional)"></div>
                    <div class="col-12"><input type="text" name="billing[address]" class="form-control rounded-0" placeholder="Billing Address" required></div>
                    <input type="hidden" name="total_cost" id="total_cost" value="{{ $tempItineraries[0]['total_cost'] }}">
                    <input type="hidden" name="search_hash" id="search_hash" value="{{ $tempItineraries[0]['search_hash'] }}">
                </div>

                <hr>


                <!-- Download Button -->
                <div class="mb-3 d-flex justify-content-between">
                    <h3 class="fs-6 fw-bold">Day-wise Itinerary</h3>
                    <a href="{{ route('travel-itinerary', ['trip_code' => $tempItineraries[0]['search_hash']]) }}"
                        id="download-itinerary" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-download me-2"></i>Download Itinerary
                    </a>

                </div>

                <div class="accordion tour-package-accordion" id="itineraryAccordion">
                    @php
                    $tourItinerary = optional($tempItineraries[0]->tour)->TourItinerary ?? [];
                    $wh = $tempItineraries[0]->wh;
                    @endphp
                    @foreach ($tourItinerary as $index => $itinerary)

                    @php
                    $dayNum = $index + 1;
                    $dateFormatted = \Carbon\Carbon::parse(
                    $tempItineraries[$index]['start_date'] ?? now(),
                    )->format('d M');

                    $activities = $itinerary['activities'] ?? [];
                    $tempDay = $tempItineraries[$index] ?? null;
                    $hotel = $wh == 0 ? null : ($tempDay && $tempDay->accomodation ? $tempDay->accomodation->toArray() : null);
                    $ferriesJson = $tempDay->ferry ?? '[]';
                    $ferries = is_string($ferriesJson)
                    ? json_decode($ferriesJson, true)
                    : $ferriesJson;
                    @endphp



                    <div class="accordion-item">
                        <h2 class="accordion-header" id="day{{ $dayNum }}Heading">
                            <button class="accordion-button rounded-0 border shadow-none" type="button"
                                data-bs-toggle="collapse" data-bs-target="#day{{ $dayNum }}"
                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                aria-controls="day{{ $dayNum }}">
                                <span style="font-size:14px; color:#FF5722; font-weight:600">Day {{ $dayNum }} - <span>{{ $dateFormatted }}</span> : </span>
                                <span class="px-1" style="color:#002246; font-weight:bold;font-size:12px;">{{ $itinerary['title'] ?? 'Service' }} </span>
                            </button>
                        </h2>

                        <div id="day{{ $dayNum }}"
                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                            aria-labelledby="day{{ $dayNum }}Heading"
                            data-bs-parent="#itineraryAccordion">
                            <div class="accordion-body p-1">

                                {{-- Hotel --}}
                                @if ($hotel)
                                <div class="card mb-3 border shadow-sm">
                                    <div class="row g-0">
                                        <div
                                            class="col-md-2 d-flex align-items-center justify-content-center p-2">
                                            <img src="{{ $hotel['hotel_image'] ?? 'https://via.placeholder.com/100' }}"
                                                class="img-fluid rounded"
                                                alt="{{ $hotel['hotel_name'] ?? 'Hotel' }}"
                                                style="max-height: 60px;">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body py-2">
                                                <div
                                                    class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h4 class="card-title mb-1" style="font-size:14px; color:#002246">
                                                            {{ $hotel['room']['Name'][0] ?? 'N/A' }}
                                                        </h4>
                                                        <h4 class="card-title mb-1" style="font-size:12px; color:#002246">
                                                            {{ $hotel['hotel_name'] ?? 'N/A' }}
                                                        </h4>
                                                        <p class=" mb-1 small" style="color:#002246">
                                                            {{ $hotel['hotel_name'] ?? 'N/A' }}>
                                                            {{ $hotel['address'] ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                    <div class="text-end">
                                                        <p class="mb-1 small text-muted">Day:
                                                            {{ $dayNum }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center mt-2">
                                                    <p class="mb-0 small">
                                                        Inclusions:
                                                        <strong>{{ $hotel['room']['Inclusion'] ?? 'N/A' }}</strong>
                                                    </p>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center mt-2">
                                                    <p class="mb-0 small">
                                                        Meal Plan:
                                                        <strong>Breakfast Only</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif


                                {{-- Ferries --}}
                                @foreach ($ferries as $ferryItem)
                                @php
                                $ferryData = is_string($ferryItem['ferry'] ?? '')
                                ? json_decode($ferryItem['ferry'], true)
                                : $ferryItem['ferry'] ?? [];
                                @endphp

                                <div class="card mb-3 border shadow-sm">
                                    <div class="row g-0">
                                        <div
                                            class="col-md-2 d-flex align-items-center justify-content-center p-2">
                                            <img src="{{ $ferryData['image'] ?? '' }}"
                                                class="img-fluid rounded" alt="Ferry Logo"
                                                style="max-height: 60px;">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body py-2">
                                                <div
                                                    class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h3 class="card-title mb-1" style="font-size:14px;color:#002246;">
                                                            {{ $ferryData['ferry_name'] ?? '' }}
                                                        </h3>
                                                        <p class="text-muted mb-1 small">
                                                            {{ $ferryData['from'] ?? '' }} →
                                                            {{ $ferryData['to'] ?? '' }}
                                                        </p>
                                                    </div>
                                                    <div class="text-end">
                                                        <p class="mb-1 small text-muted">Departure:
                                                            {{ $ferryData['departure'] ?? '' }}
                                                        </p>
                                                        <p class="mb-0 small text-muted">Arrival:
                                                            {{ $ferryData['arraival'] ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center mt-2">
                                                    <p class="mb-0 small">
                                                        Class:
                                                        <strong>{{ $ferryData['classes'][0]['class_name'] ?? '' }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>




                <hr>

                <h5 class="pay-heading-title">Terms & Conditions</h5>
                <ol class="payement-terms-condition-inner">
                    <li>The standard check in time at the hotel is 11:00 PM and the check out time is 08:00 AM. Request for early check in or late check out depends entirely on the hotel policy and room availability.</li>
                    <li>A maximum group of 3 adults are allowed in one room. The third occupant will be provided with a mattress bed as per hotel policy.</li>
                    <li>The itinerary that is provided is fixed and it will not be modified further. Vehicles will be arranged as per the itinerary and will not remain available for any personal or unlimited use.</li>
                    <li>If a paid activity cannot be conducted due to unforeseen reasons, then the refund will be processed within 30 days.</li>
                    <li>Complimentary inclusion that is free of charge will not be eligible for any refund if unavailable.</li>
                    <li>The package cost does not include monument, entry fees, parking charges or guide charges.</li>
                    <li>Expenses of personal use like laundry, telephone calls, room services, alcoholic drinks, minibar usage and tips are not included.</li>
                    <li>Costs related to ticket deviation, rescheduling or trip extensions are also excluded.</li>
                    <li>Flight tickets are not included in the package. Guests are required to book and arrange their own flights to and from the Andaman islands.</li>
                    <li>Ferries operating in the Andaman island are highly dependent on weather and operational conditions. Delays or cancellations due to weather are beyond our control.</li>
                    <li>If a passenger has booked a specific ferry but it becomes non operational due to some unforeseen reason, the passenger will either be provided with a rescheduled booking or an alternative ferry service of similar standard, subject to availability.</li>
                    <li>Prices are dynamic and can be changed without prior notice. Ferry tickets and hotel rooms are always subject to real time availability.</li>
                    <li>Pricing of the booking is calculated based on the accurate age of travelers, providing incorrect details may result in penalties at the time of travel.</li>
                    <li>If the preferred hotel is not available, then similar category accommodation will be arranged.</li>
                    <li>Some hotels may collect a refundable security deposit during check in, as per their internal policy.</li>
                    <li>In case your package needs to be cancelled due to any natural calamity, bad weather conditions or government restrictions, Andaman Bliss ensures the maximum possible refund subject to the agreement with the trade partner/vendor.</li>
                    <li>Andaman Bliss has the right to revise or adjust itineraries due to reasons like weather conditions, local restrictions or operational challenges. Alternative options will be arranged wherever possible. Claims for refund or compensation will not be entertained.</li>
                    <li>Our packages do not include mandatory festive or gala dinner charges (e.g., Christmas, New Year or other occasion) in the hotels. Guests will be informed in advance wherever possible, however such charges are payable directly at the hotel.</li>
                    <li>All the water sports activities are subject to safety and weather conditions. Such activities may be cancelled without prior notice. Complimentary activities cannot be refunded.</li>
                    <li>All legal disputes shall be subject under the jurisdiction of the court in Port Blair, Andaman & Nicobar Islands.</li>
                    <li>Andaman Bliss has the rights to modify these Terms & Conditions at any time without prior notification.</li>
                    <li>Foreign nationals are required to obtain a Restricted Area Permit upon arrival at the airport from the immigration authorities.</li>
                    <li>Andaman Bliss has the rights to cancel any services like cabs, ferry bookings, tour packages or activity arrangements at any time due to operational, safety or unforeseen circumstances.</li>
                    <li>In case, the cancellation of any services or packages are done from our side, guests will receive a full refund within 7 working days.</li>
                </ol>

                <h5 class="pay-heading-title">Amendment & Cancellation Policy</h5>
                <ol class="payement-terms-condition-inner">
                    <li>Cancellations initiated within 24 hours prior to departure – a cancellation fee of ₹7000 shall be levied.</li>
                    <li>Cancellations initiated after 24 hours prior to departure – the amount paid shall be irrevocably non-refundable.</li>
                </ol>


            </div>
        </div>

        <div class="col-lg-4 col-md-5 p-2">
            <div class="tour-package-sticky-sidebar">
                <div class="tbook-card">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <div class="tbook-subtitle">GRAND TOTAL - {{ $totalAdults }} Adult , {{ $totalChildren }} Child</div>
                            <div class="tbook-price">₹{{ number_format($pricing->grand_total ?? 0, 2) }}</div>
                        </div>
                        @if ($pricing->total_with_discount != $pricing->total_with_markup)
                        <span class="tbook-discount">{{ number_format($pricing->discount,0) }}% OFF</span>
                        @else
                        <span class="tbook-discount">Limited</span>
                        @endif
                    </div>

                    <div class="tbook-option tbook-option-active mb-1" onclick="selectPayment(this)">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="partial_pay" id="bookLater" checked>
                            <label class="form-check-label fw-semibold" for="bookLater">Book Now Pay Later</label>
                        </div>
                        <div class="tbook-paylater-details">
                            <div class="d-flex justify-content-between">
                                <span>Pay to Book</span>
                                <strong>₹{{ number_format($pricing->payable_amt, 2) }}</strong>
                            </div>
                            <small>Amount to pay now to reserve</small>
                            <div class="d-flex justify-content-between mt-2">
                                <span>On Arrival <span class="fw-bolder">{{ \Carbon\Carbon::parse($tempItineraries->first()->start_date)->format('d M Y') }}</span></span>
                                <strong>₹{{ number_format($pricing->grand_total - $pricing->payable_amt, 2) }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="tbook-option mb-3" onclick="selectPayment(this)">
                        <div class="form-check d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="full_pay" id="payFull">
                                <label class="form-check-label fw-bolder ms-2 my-0" for="payFull">Pay Full Amount Now</label>
                            </div>
                            <strong>₹{{ number_format($pricing->grand_total, 2) }}</strong>
                        </div>
                    </div>



                    <div class="mb-3">
                        <h6 class="fw-bold">Fare Breakup</h6>
                        <div class="tbook-farebox">
                            <div class="d-flex justify-content-between">
                                <span>Total Basic Cost</span>
                                <strong>₹{{ number_format($pricing->total_with_markup ?? 0, 2) }}</strong>
                            </div>
                            <small class="text-muted">{{ $totalAdults }} Adults , {{ $totalChildren }} Child x
                                {{ $tempItineraries[0]->tour->nights }} Nights</small>
                            @if ($pricing->total_with_discount != $pricing->total_with_markup)
                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <span>Coupon Discount <span class="tbook-coupon ms-2">HAPPYTRAVEL</span></span>
                                <strong class="text-danger">-₹{{ number_format($pricing->total_with_markup - $pricing->total_with_discount ) }} </strong>
                            </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Services & Taxes</span>
                                <strong>+₹{{ number_format($pricing->gst_amount, 2) }}</strong>
                            </div>
                        </div>
                    </div>

                    <p class="tbook-emi" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="EMI Available on all payment modes">EMI Available on all payment modes</p>

                    <!-- <div class="mt-3">
                        <h6 class="fw-bold">Important Information</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirm" checked>
                            <label class="form-check-label" for="confirm">
                                I confirm that I have read and I accept
                                <a href="#" class="tbook-link">Cancellation Policy</a>,
                                <a href="#" class="tbook-link">Terms & Condition</a>, and
                                <a href="#" class="tbook-link">Privacy Policy</a> of Andaman Bliss
                            </label>
                        </div>
                    </div> -->
                        <hr>
                    <div class="d-grid mt-2">
                        <button type="button" id="rzp-button" class="btn btn-primary d-flex justify-content-center">
                            Pay Now
                        </button>
                        <div>
                            <ul class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
                                <li><img src="{{ asset('site/img/google-pay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="google-pay"></li>
                                <li><img src="{{ asset('site/img/phonepe-1.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="phonepe-1"></li>
                                <li><img src="{{ asset('site/img/rupay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="rupay"></li>
                                <li><img src="{{ asset('site/img/visa.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="visa"></li>
                                <li><img src="{{ asset('site/img/mastercard-4.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="mastercard-4"></li>
                                <li><img src="{{ asset('site/img/paypal-3.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="paypal-3"></li>
                            </ul>
                        </div>
                    </div>
                    

                  



                </div>
            </div>
            <div class="mobile-pay-now d-lg-none">
                <button type="button" id="rzp-button-mobile" class="btn btn-primary w-100 d-flex justify-content-center">
                    Pay Now
                </button>
                <div>
                    <ul class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
                        <li><img src="{{ asset('site/img/google-pay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="google-pay"></li>
                        <li><img src="{{ asset('site/img/phonepe-1.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="phonepe-1"></li>
                        <li><img src="{{ asset('site/img/rupay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="rupay"></li>
                        <li><img src="{{ asset('site/img/visa.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="visa"></li>
                        <li><img src="{{ asset('site/img/mastercard-4.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="mastercard-4"></li>
                        <li><img src="{{ asset('site/img/paypal-3.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="paypal-3"></li>
                    </ul>
                </div>
            </div>

        </div>
        </div>
    </section>
</form>

@push('styles')
<style>
    .step {
        background: linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%);
        padding: 5px;
        border-radius: 10px;
    }

    .step-text {
        font-size: 14px;
    }

    .payement-terms-condition-inner li {
        font-size: 10px !important;
    }

    .pay-heading-title {
        font-size: 14px;
    }

    .tour-package-left h3 {
        font-size: 16px;
    }

    .date-list {
        font-size: 12px;
    }

    .booking-steps>span {
        font-size: 14px;
    }

    .jour-main {
        font-size: 12px;
    }

    .guest-count-dtls {
        font-size: 14px;
    }

    .room-ty {
        font-size: 14px;
    }

    #footers {
        display: none !important;
    }

    #expert-btn {
        display: none !important;
    }

    #booking-loader {
        pointer-events: none;

    }

    /* Desktop: sticky sidebar */
    @media(min-width: 992px) {
        .tour-package-sticky-sidebar {
            position: sticky;
            top: 80px;
            /* adjust based on header height */
        }
    }



    /* Mobile: sticky bottom pay button */
    @media(max-width: 991px) {
        .mobile-pay-now {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background: #fff;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.15);
            z-index: 999;
        }

        /* hide the original button on mobile */
        #rzp-button {
            display: none !important;
        }

        .tour-package-sticky-sidebar {
            position: relative;
            bottom: 35px;
        }
    }

    @media (max-width: 576px) {
        .tour-package-left {
            position: relative;
            bottom: 30px;
        }
    }

    /* payment section styling */
    .tbook-card {
        max-width: 520px;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 24px;
    }

    .tbook-subtitle {
        font-size: 0.7rem;
        color: #6c757d;
    }

    .tbook-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #222;
    }

    .tbook-discount {
        font-size: 0.75rem;
        background: #ff4d4f;
        padding: 4px 8px;
        border-radius: 4px;
        color: #fff;
        font-weight: 600;
    }

    /* Radio sections */
    .tbook-option {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 16px;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s;
    }

    .tbook-option:hover {
        background: #f9fafc;
    }

    .tbook-option-active {
        border-color: #0d6efd;
        background-color: #eef4ff;
    }

    .tbook-paylater-details {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px 16px;
        margin-top: 10px;
    }

    .tbook-paylater-details small {
        font-size: 0.8rem;
        color: #6c757d;
    }

    /* Fare section */
    .tbook-farebox {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 16px;
    }

    .tbook-farebox hr {
        margin: 10px 0;
    }

    .tbook-coupon {
        background-color: #d1fae5;
        color: #065f46;
        font-size: 0.75rem;
        padding: 3px 6px;
        border-radius: 4px;
        font-weight: 600;
    }

    /* EMI banner */
    .tbook-emi {
        color: #000000ff;
        text-align: start;
        border-radius: 8px;
        padding: 0;
        font-size: 0.9rem;
        margin-top: 0;
    }

    /* Links */
    .tbook-link {
        color: #0d6efd;
        text-decoration: none;
    }

    .tbook-link:hover {
        text-decoration: underline;
    }

    .form-check-input {
        padding: 0 !important;
    }
</style>
@endpush

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    
function selectPayment(block) {
    document.querySelectorAll('.tbook-option').forEach(el => {
        el.classList.remove('tbook-option-active');
        const radio = el.querySelector('input[type="radio"]');
        if (radio) radio.checked = false;
    });
    block.classList.add('tbook-option-active');
    const radio = block.querySelector('input[type="radio"]');
    if (radio) radio.checked = true;
}   
    document.addEventListener('DOMContentLoaded', function() {

        const loader = document.getElementById('booking-loader');
        const form = document.getElementById('booking-form');

        

        async function handlePaymentClick(e) {
            e.preventDefault();

            // Expand any invalid accordion fields
            const invalidFields = form.querySelectorAll(':invalid');
            invalidFields.forEach(field => {
                const accordionItem = field.closest('.accordion-collapse');
                if (accordionItem && !accordionItem.classList.contains('show')) {
                    const accordionButton = document.querySelector(`[data-bs-target="#${accordionItem.id}"]`);
                    if (accordionButton) accordionButton.click();
                }
            });

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            loader.style.display = 'flex';

            // Prepare form data
            const formData = new FormData(form);
            const obj = {};
            formData.forEach((value, key) => {
                // Handles arrays and objects from inputs
                if (key.includes('[')) {
                    const keys = key.replace(/\]/g, '').split('[');
                    let temp = obj;
                    keys.forEach((k, i) => {
                        if (i === keys.length - 1) temp[k] = value;
                        else temp[k] = temp[k] || {};
                        temp = temp[k];
                    });
                } else obj[key] = value;
            });

            try {
                // Step 1: Create Razorpay order
                const orderRes = await fetch("{{ route('tour.pay') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(obj)
                });
                const orderData = await orderRes.json();

                if (!orderData.success) {
                    alert(orderData.message || "Order creation failed");
                    loader.style.display = 'none';
                    document.body.style.pointerEvents = '';
                    return;
                }

                // Step 2: Open Razorpay

                const options = {
                    key: "{{ config('services.razorpay.key') }}",
                    amount: orderData.amount,
                    currency: "INR",
                    name: "Andaman Bliss",
                    description: "Tour Package Booking",
                    order_id: orderData.order_id,
                    handler: async function(response) {
                        try {
                            // Step 3: Verify payment
                            const verifyRes = await fetch("{{ route('tour.success') }}", {
                                method: 'POST',
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    booking_id: orderData.booking_id,
                                    razorpay_payment_id: response
                                        .razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature,
                                })
                            });
                            const successData = await verifyRes.json();
                            if (successData.success) {
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action = '/booking-thank-you';

                                // CSRF token
                                const token = document.createElement('input');
                                token.type = 'hidden';
                                token.name = '_token';
                                token.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                form.appendChild(token);

                                // Booking ID
                                const bookingIdInput = document.createElement('input');
                                bookingIdInput.type = 'hidden';
                                bookingIdInput.name = 'booking_id';
                                bookingIdInput.value = orderData.booking_id;
                                form.appendChild(bookingIdInput);

                                document.body.appendChild(form);
                                form.submit(); // Submits POST to /booking-thank-you
                            } else {
                                alert("Payment verification failed: " + successData.message);
                                loader.style.display = 'none';
                                document.body.style.pointerEvents = '';
                            }
                        } catch (err) {
                            alert("Error verifying payment. Please contact support.");
                            loader.style.display = 'none';
                            document.body.style.pointerEvents = '';
                        }
                    },
                    prefill: {
                        name: obj.billing?.name || '',
                        email: obj.billing?.email || '',
                        contact: obj.billing?.phone || ''
                    },
                    theme: {
                        color: "#3399cc"
                    },
                    modal: {
                        ondismiss: function() {
                            console.log("Razorpay modal was closed by the user.");
                            loader.style.display = 'none';
                            document.body.style.pointerEvents = '';
                        },
                        escape: true, // allow escape key to close
                        backdropclose: false // prevent click outside to close
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();

            } catch (err) {
                alert("Something went wrong. Please try again.");
                loader.style.display = 'none';
                document.body.style.pointerEvents = '';
            }
        }

        const payButton = document.getElementById('rzp-button');
        const payButtonMobile = document.getElementById('rzp-button-mobile');

        if (payButton) payButton.addEventListener('click', handlePaymentClick);
        if (payButtonMobile) payButtonMobile.addEventListener('click', handlePaymentClick);
    });
</script>

@endsection