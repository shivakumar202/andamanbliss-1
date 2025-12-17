@extends('layouts.app')

@section('title', 'Hotel Booking and Payment')

@section('content')
    <div id="payment-loader"
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
        Initializing Payment...
    </div>

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
        Processing Booking...
    </div>

    <!-- Hotel Booking Review Section -->
    <form method="POST" action="{{ route('hotel.book.submit') }}" id="booking-form">
        @csrf
        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
        <input type="hidden" name="checkin" value="{{ $dates['checkin'] }}">
        <input type="hidden" name="checkout" value="{{ $dates['checkout'] }}">
        <input type="hidden" name="HotelResult" value="{{ base64_encode(serialize($HotelResult)) }}">
        <input type="hidden" name="guests_data" value="{{ base64_encode(serialize($guests)) }}">
        <input type="hidden" name="booking_code" value="{{ $HotelResult[0]['Rooms'][0]['BookingCode'] }}">
        <section class="booking-review-section">
            <div class="container mt-3">
                <div class="booking-steps mb-3">
                   
                </div>

                <div class="container my-4">
                    <div class="row">
                        <div class="col-lg-8 mb-4">
                            <div class="border rounded p-3 hotel-book-left">
                                <h5>
                                    <strong>{{ ucwords($hotel->hotel_name) }}</strong>
                                 @php
                                    $firstRoom = $HotelResult[0]['Rooms'][0] ?? null;
                                @endphp

                               

                                </h5>
                                <p class="text-muted mb-1">
                                    <i class="fa fa-map-marker me-2 text-gradient" aria-hidden="true"></i>
                                    {{ $hotel->address . ' | ' . $hotel->city_name }}
                                </p>

                                @php
                                    $rooms = $HotelResult[0]['Rooms'] ?? [];
                                    $checkIn = \Carbon\Carbon::parse($dates['checkin']);
                                    $checkOut = \Carbon\Carbon::parse($dates['checkout']);
                                    $nights = $checkIn->diffInDays($checkOut);
                                    $adults = session('adult_count', 2);
                                    $rateConditions = $HotelResult[0]['RateConditions'] ?? [];

                                    $checkInBegin = '10:00 AM';
                                    $checkInEnd = '12:00 PM';
                                    $checkOutTime = '10:00 AM';

                                    foreach ($rateConditions as $line) {
                                        if (str_contains($line, 'CheckIn Time-Begin')) {
                                            preg_match('/CheckIn Time-Begin:\s*([^\n\r]+?)(?=CheckIn Time-End|CheckOut Time|CheckIn Instructions|$)/', $line, $matches);
                                            if (!empty($matches[1])) {
                                                $checkInBegin = trim($matches[1]);
                                            }
                                        }
                                        if (str_contains($line, 'CheckIn Time-End')) {
                                            preg_match('/CheckIn Time-End:\s*([^\n\r]+?)(?=CheckOut Time|CheckIn Instructions|$)/', $line, $matches);
                                            if (!empty($matches[1])) {
                                                $checkInEnd = trim($matches[1]);
                                            }
                                        }
                                        if (str_contains($line, 'CheckOut Time')) {
                                            preg_match('/CheckOut Time:\s*([^\n\r]+?)(?=CheckIn Instructions|$)/', $line, $matches);
                                            if (!empty($matches[1])) {
                                                $checkOutTime = trim($matches[1]);
                                            }
                                        }
                                    }
                                @endphp

                                <div class="d-flex justify-content-between py-2 border-top border-bottom my-2">
                                    <div>
                                        <strong>CHECK IN</strong><br>
                                        {{ $checkIn->format('D') }} <strong>{{ $checkIn->format('d M Y') }}</strong><br>
                                        <small>{{ $checkInBegin }} - {{ $checkInEnd }}</small>
                                    </div>
                                    <div class="text-center align-self-center">
                                        <strong>{{ $nights }} NIGHT{{ $nights > 1 ? 'S' : '' }}</strong>
                                    </div>
                                    <div>
                                        <strong>CHECK OUT</strong><br>
                                        {{ $checkOut->format('D') }} <strong>{{ $checkOut->format('d M Y') }}</strong><br>
                                        <small>{{ $checkOutTime }}</small>
                                    </div>
                                </div>

                                <strong>{{ $nights }} Nights | {{ $adults }} Adults | {{ count($HotelResult[0]['Rooms'][0]['Name']) }}
                                    Room{{ count($rooms) > 1 ? 's' : '' }}</strong>

                                @foreach ($rooms as $roomIndex => $room)
                                    @php
                                        $roomCount = count($room['Name']);
                                        $cancelUntil = !empty($room['LastCancellationDeadline'])
                                            ? \Carbon\Carbon::createFromFormat(
                                                'd-m-Y H:i:s',
                                                $room['LastCancellationDeadline'],
                                            )
                                            : null;
                                    @endphp

                                    <hr>

                                <div class="card rounded-0 mb-3" style="width: 100%; border-radius: 0 !important;">
                                    <div class="card-header rounded-0 fw-semibold">
                                        Room Details
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        @php
                                            $rooms = $HotelResult[0]['Rooms'][0]; // first "Rooms" object
                                            $count = count($rooms['Name']); // number of room entries
                                        @endphp

                                        @for ($i = 0; $i < $count; $i++)
                                            <li class="list-group-item">
                                                <div class="fw-bold d-flex justify-content-between align-items-center">
                                                    <span>Room {{ $i + 1 }} : {{ $rooms['Name'][$i] }}  @if (!empty($rooms['RoomPromotion'][$i]))
                                                    <div class="text-danger medium fw-bold">
                                                        {{ rtrim($rooms['RoomPromotion'][$i], '|') }}
                                                    </div>
                                                @endif </span>
                                                    
                                                    <span>
                                                        <i class="bi bi-people"></i>
                                                        {{ $guests[$i]['Adults'] }} Adult(s)
                                                        @if($guests[$i]['Children'] > 0)
                                                            , {{ $guests[$i]['Children'] }} Child(s)
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="text-muted small">
                                                    <strong class="text-dark">Meal:</strong> {{ $rooms['MealType'] }}
                                                </div>

                                                {{-- Inclusion --}}
                                                <div class="text-muted small">
                                                    <strong class="text-dark">Inclusions:</strong>
                                                    @php
                                                        $inclusions = explode(',', $rooms['Inclusion']); // split string into array
                                                    @endphp
                                                    @foreach (array_slice($inclusions, 0, 1) as $item)
                                                        {{ trim($item) }}@if (!$loop->last), @endif
                                                    @endforeach
                                                    @if (count($inclusions) > 1)
                                                        <span id="more-inclusions-{{ $i }}" style="display:none;">
                                                            , @foreach (array_slice($inclusions, 1) as $item)
                                                                {{ trim($item) }}@if (!$loop->last), @endif
                                                            @endforeach
                                                        </span>
                                                        <a href="javascript:void(0)" id="toggle-inclusions-{{ $i }}" style="color:blue;">See more+</a>
                                                    @endif
                                                </div>

                                               

                                                {{-- Amenities --}}
                                               <div class="text-muted small">
    <strong class="text-dark">Amenities:</strong>
    @if (!empty($rooms['Amenities']) && is_array($rooms['Amenities']))
        @foreach (array_slice($rooms['Amenities'], 0, 5) as $a)
            {{ $a }}@if (!$loop->last), @endif
        @endforeach

        @if (count($rooms['Amenities']) > 5)
            <span id="more-amenities-{{ $i }}" style="display:none;">
                , @foreach (array_slice($rooms['Amenities'], 5) as $a)
                    {{ $a }}@if (!$loop->last), @endif
                @endforeach
            </span>
            <a href="javascript:void(0)" id="toggle-amenities-{{ $i }}" style="color:blue;">See more+</a>
        @endif
    @else
        <span class="text-muted">No amenities listed</span>
    @endif
</div>

                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                                    @if ($room['IsRefundable'])
                                        <p class="text-success">
                                            <strong>✓ Free Cancellation before
                                                {{ optional($cancelUntil)->format('d M h:i A') }}</strong>
                                            <a href="#">Cancellation policy details</a>
                                        </p>
                                    @else
                                        <p class="text-danger"><strong>Non-refundable</strong></p>
                                    @endif
                                @endforeach

                                <div class="hotel-book-timeline-bar">
                                    <span class="hotel-book-bar-green"></span>
                                    <span class="hotel-book-bar-yellow"></span>
                                </div>

                                <div class="d-flex justify-content-between small text-muted mt-1">
                                    <div><strong>NOW</strong></div>
                                    <div>{{ now()->format('d M') }}<br>{{ now()->format('h:i A') }}</div>
                                    <div>{{ $checkIn->format('d M') }}<br>{{ $checkIn->format('h:i A') }}</div>
                                </div>

                                <hr>
                                <h6><strong>Guest Details</strong></h6>
                                <div class="accordion hotel-book-accordion" id="guestAccordion">
                                    @foreach ($guests as $index => $guest)
                                        @php
                                            $roomNumber = $index + 1;
                                            $adults = (int) $guest['Adults'];
                                            $children = (int) $guest['Children'];
                                            $totalGuests = $adults + $children;
                                        @endphp

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $roomNumber }}">
                                                <button
                                                    class="accordion-button rounded-0 border shadow-none {{ $loop->first ? '' : 'collapsed' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#room{{ $roomNumber }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                    aria-controls="room{{ $roomNumber }}">
                                                    Room {{ $roomNumber }} - {{ $totalGuests }}
                                                    Guest{{ $totalGuests > 1 ? 's' : '' }}
                                                </button>
                                            </h2>
                                            <div id="room{{ $roomNumber }}"
                                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading{{ $roomNumber }}"
                                                data-bs-parent="#guestAccordion">
                                                <div class="accordion-body p-1">
                                                    @for ($a = 0; $a < $adults; $a++)
                                                        <div class="guest-container"
                                                            data-guest="adult-{{ $roomNumber }}-{{ $a }}">
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <strong>Adult {{ $a + 1 }}</strong>
                                                                    @if ($a === 0)
                                                                        <span class="badge bg-primary ms-2">Lead</span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label
                                                                        for="adult_title_{{ $roomNumber }}_{{ $a }}"
                                                                        class="form-label">Title</label>
                                                                    <select
                                                                        id="adult_title_{{ $roomNumber }}_{{ $a }}"
                                                                        name="guests[room{{ $roomNumber }}][adult][{{ $a }}][Title]"
                                                                        class="form-select rounded-0 form-control-sm"
                                                                        required>
                                                                        <option value="">Select Title</option>
                                                                        @foreach (['Mr', 'Mrs', 'Miss', 'Ms'] as $title)
                                                                            <option value="{{ $title }}">
                                                                                {{ $title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="adult_firstname_{{ $roomNumber }}_{{ $a }}"
                                                                        class="form-label">First Name</label>
                                                                    <input type="text"
                                                                        id="adult_firstname_{{ $roomNumber }}_{{ $a }}"
                                                                        name="guests[room{{ $roomNumber }}][adult][{{ $a }}][FirstName]"
                                                                        class="form-control rounded-0 form-control-sm"
                                                                        placeholder="Enter First Name" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="adult_middlename_{{ $roomNumber }}_{{ $a }}"
                                                                        class="form-label">Middle Name (Optional)</label>
                                                                    <input type="text"
                                                                        id="adult_middlename_{{ $roomNumber }}_{{ $a }}"
                                                                        name="guests[room{{ $roomNumber }}][adult][{{ $a }}][MiddleName]"
                                                                        class="form-control rounded-0 form-control-sm"
                                                                        placeholder="Enter Middle Name">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label
                                                                        for="adult_lastname_{{ $roomNumber }}_{{ $a }}"
                                                                        class="form-label">Last Name</label>
                                                                    <input type="text"
                                                                        id="adult_lastname_{{ $roomNumber }}_{{ $a }}"
                                                                        name="guests[room{{ $roomNumber }}][adult][{{ $a }}][LastName]"
                                                                        class="form-control rounded-0 form-control-sm"
                                                                        placeholder="Enter Last Name" required>
                                                                </div>
                                                            @if ($validation['PanMandatory'] ?? false)
                                                                <div class="col-md-4">
                                                                    <label for="adult_pan_{{ $roomNumber }}_{{ $a }}" class="form-label">PAN Number</label>
                                                                    <input type="text" id="adult_pan_{{ $roomNumber }}_{{ $a }}"
                                                                           name="guests[room{{ $roomNumber }}][adult][{{ $a }}][PAN]"
                                                                           class="form-control rounded-0 form-control-sm pan-input"
                                                                           placeholder="e.g., GFEHL4354K" maxlength="10" required>
                                                                </div>
                                                            @endif
                                                               
                                                            </div>
                                                        @if ($validation['PassportMandatory'] ?? false)
                                                            <div class="passport-fields">
                                                                <div class="row g-3">
                                                                    <div class="col-md-4">
                                                                        <label for="adult_passportno_{{ $roomNumber }}_{{ $a }}" class="form-label">Passport Number</label>
                                                                        <input type="text" id="adult_passportno_{{ $roomNumber }}_{{ $a }}"
                                                                               name="guests[room{{ $roomNumber }}][adult][{{ $a }}][PassportNo]"
                                                                               class="form-control rounded-0 form-control-sm"
                                                                               placeholder="Enter Passport Number" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="adult_passportissue_{{ $roomNumber }}_{{ $a }}" class="form-label">Passport Issue Date</label>
                                                                        <input type="date" id="adult_passportissue_{{ $roomNumber }}_{{ $a }}"
                                                                               name="guests[room{{ $roomNumber }}][adult][{{ $a }}][PassportIssueDate]"
                                                                               class="form-control rounded-0 form-control-sm"
                                                                               placeholder="Select Issue Date" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="adult_passportexp_{{ $roomNumber }}_{{ $a }}" class="form-label">Passport Expiry Date</label>
                                                                        <input type="date" id="adult_passportexp_{{ $roomNumber }}_{{ $a }}"
                                                                               name="guests[room{{ $roomNumber }}][adult][{{ $a }}][PassportExpDate]"
                                                                               class="form-control rounded-0 form-control-sm"
                                                                               placeholder="Select Expiry Date" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                            <hr>
                                                            <input type="hidden"
                                                                name="guests[room{{ $roomNumber }}][adult][{{ $a }}][PaxType]"
                                                                value="1">
                                                            <input type="hidden"
                                                                name="guests[room{{ $roomNumber }}][adult][{{ $a }}][LeadPassenger]"
                                                                value="{{ $a === 0 ? '1' : '0' }}">
                                                        </div>
                                                    @endfor

                                                    @for ($c = 0; $c < $children; $c++)
                                                        <div class="guest-container"
                                                            data-guest="child-{{ $roomNumber }}-{{ $c }}">
                                                            <div class="row g-3">
                                                                <div class="col-12"><strong>Child
                                                                        {{ $c + 1 }}</strong></div>
                                                                <div class="col-md-2">
                                                                    <label
                                                                        for="child_title_{{ $roomNumber }}_{{ $c }}"
                                                                        class="form-label">Title</label>
                                                                    <select
                                                                        id="child_title_{{ $roomNumber }}_{{ $c }}"
                                                                        name="guests[room{{ $roomNumber }}][child][{{ $c }}][Title]"
                                                                        class="form-select rounded-0 form-control-sm"
                                                                        required>
                                                                        <option value="">Select Title</option>
                                                                        @foreach (['Mr', 'Miss'] as $title)
                                                                            <option value="{{ $title }}">
                                                                                {{ $title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="child_firstname_{{ $roomNumber }}_{{ $c }}"
                                                                        class="form-label">First Name</label>
                                                                    <input type="text"
                                                                        id="child_firstname_{{ $roomNumber }}_{{ $c }}"
                                                                        name="guests[room{{ $roomNumber }}][child][{{ $c }}][FirstName]"
                                                                        class="form-control rounded-0 form-control-sm"
                                                                        placeholder="Enter First Name" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="child_middlename_{{ $roomNumber }}_{{ $c }}"
                                                                        class="form-label">Middle Name (Optional)</label>
                                                                    <input type="text"
                                                                        id="child_middlename_{{ $roomNumber }}_{{ $c }}"
                                                                        name="guests[room{{ $roomNumber }}][child][{{ $c }}][MiddleName]"
                                                                        class="form-control rounded-0 form-control-sm"
                                                                        placeholder="Enter Middle Name">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label
                                                                        for="child_lastname_{{ $roomNumber }}_{{ $c }}"
                                                                        class="form-label">Last Name</label>
                                                                    <input type="text"
                                                                        id="child_lastname_{{ $roomNumber }}_{{ $c }}"
                                                                        name="guests[room{{ $roomNumber }}][child][{{ $c }}][LastName]"
                                                                        class="form-control rounded-0 form-control-sm"
                                                                        placeholder="Enter Last Name" required>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label
                                                                        for="child_age_{{ $roomNumber }}_{{ $c }}"
                                                                        class="form-label">Age</label>
                                                                    @php
    $childAge = $guest['ChildrenAges'][$c] ?? '';
@endphp
<input type="number"
    id="child_age_{{ $roomNumber }}_{{ $c }}"
    name="guests[room{{ $roomNumber }}][child][{{ $c }}][Age]"
    class="form-control rounded-0 form-control-sm"
    placeholder="Enter Age (1-12)" min="1"
    max="12" required
    value="{{ $childAge }}" readonly>

                                                                </div>
                                                                
                                                            </div>
                                                            @if ($validation['PassportMandatory'] ?? false)
                                                            <div class="passport-fields">
                                                                <div class="row g-3">
                                                                    <div class="col-md-4">
                                                                        <label for="child_passportno_{{ $roomNumber }}_{{ $c }}" class="form-label">Passport Number</label>
                                                                        <input type="text" id="child_passportno_{{ $roomNumber }}_{{ $c }}"
                                                                               name="guests[room{{ $roomNumber }}][child][{{ $c }}][PassportNo]"
                                                                               class="form-control rounded-0 form-control-sm"
                                                                               placeholder="Enter Passport Number" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="child_passportissue_{{ $roomNumber }}_{{ $c }}" class="form-label">Passport Issue Date</label>
                                                                        <input type="date" id="child_passportissue_{{ $roomNumber }}_{{ $c }}"
                                                                               name="guests[room{{ $roomNumber }}][child][{{ $c }}][PassportIssueDate]"
                                                                               class="form-control rounded-0 form-control-sm"
                                                                               placeholder="Select Issue Date" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="child_passportexp_{{ $roomNumber }}_{{ $c }}" class="form-label">Passport Expiry Date</label>
                                                                        <input type="date" id="child_passportexp_{{ $roomNumber }}_{{ $c }}"
                                                                               name="guests[room{{ $roomNumber }}][child][{{ $c }}][PassportExpDate]"
                                                                               class="form-control rounded-0 form-control-sm"
                                                                               placeholder="Select Expiry Date" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                            <hr>
                                                            <input type="hidden"
                                                                name="guests[room{{ $roomNumber }}][child][{{ $c }}][PaxType]"
                                                                value="2">
                                                            <input type="hidden"
                                                                name="guests[room{{ $roomNumber }}][child][{{ $c }}][LeadPassenger]"
                                                                value="0">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <hr>
                                <h6><strong>Billing Details</strong></h6>
                                <div class="row g-2">
                                    <div class="col-md-6"><input type="text" name="billing[name]" value="{{ $logged['name'] ?? '' }}" class="form-control rounded-0" placeholder="Full Name" required></div>
                                    <div class="col-md-6"><input type="email" name="billing[email]" value="{{ $logged['email'] ?? '' }}" class="form-control rounded-0" placeholder="Email" required></div>
                                    <div class="col-md-6"><input type="text" name="billing[phone]" value="{{ $logged['mobile'] ?? '' }}" class="form-control rounded-0" placeholder="Phone Number" required></div>
                                    <div class="col-12"><input type="text" name="billing[address]" class="form-control rounded-0" placeholder="Billing Address" required></div>

                                <h6><strong>Optional</strong></h6>
                                            <hr>
                                  @if ($validation['GSTAllowed'] ?? false)
    <div class="col-md-6">
        <input type="text" name="billing[gst]" class="form-control rounded-0" placeholder="GST Number (optional)">
    </div>

    <div class="col-md-6">
        <input type="text" name="billing[gst_company_name]" class="form-control rounded-0" placeholder="GST Company Name">
    </div>

    <div class="col-md-6">
        <input type="email" name="billing[gst_company_email]" class="form-control rounded-0" placeholder="GST Company Email">
    </div>

    <div class="col-md-6">
        <input type="text" name="billing[gst_company_contact]" class="form-control rounded-0" placeholder="GST Company Contact Number">
    </div>

    <div class="col-12">
        <input type="text" name="billing[gst_company_address]" class="form-control rounded-0" placeholder="GST Company Address">
    </div>
@endif

                                  
                                </div>

                                <hr>
                                <h6><strong>Important Information</strong></h6>
                                <ol>
                                    @foreach ($HotelResult[0]['RateConditions'] as $line)
                                        <li>{{ $line }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="hotel-book-sticky-sidebar">
                                <div class="border rounded p-3">
                                    <h6><strong>Price Breakup</strong></h6>
                                    <div class="d-flex justify-content-between"><span>{{ count($rooms['Name']) }} Rooms x
                                            {{ $nights }}
                                            Nights</span><strong>₹{{ number_format($HotelResult[0]['Rooms'][0]['TotalFare'] - $HotelResult[0]['Rooms'][0]['TotalTax'], 1) }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between"><span>Taxes & Service
                                            Fees</span><strong>₹{{ number_format($HotelResult[0]['Rooms'][0]['TotalTax'], 1) }}</strong>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between"><strong>Total Amount to be
                                            paid</strong><strong>₹{{ number_format($HotelResult[0]['Rooms'][0]['TotalFare'], 1) }}</strong>
                                    </div>


                                    <div class="d-none d-md-flex justify-content-between mt-4">
                              <div class="w-100"> 
                                <button type="button" id="rzp-button" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-credit-card me-2"></i>Pay Now ₹{{ number_format($HotelResult[0]['Rooms'][0]['TotalFare'], 1) }}
                                </button>
                                </div>
                            </div>
                               <div class="d-md-none d-block mobile-sticky-footer">
    <button type="button" id="rzp-button-mobile" class="btn btn-primary w-100">
        <i class="fa-solid fa-credit-card me-2"></i>Pay Now ₹{{  number_format($HotelResult[0]['Rooms'][0]['TotalFare'], 1) }}
    </button>
</div>
                                            
                                </div>
                                @if (!empty($coupons))
                                    <div class="border rounded p-3 mt-3">
                                        <h6><strong>Coupon Codes</strong> <a href="#" class="float-end">View All</a>
                                        </h6>
                                        <div class="hotel-book-coupon-active mb-2">
                                            <label><input type="radio" name="coupon" checked>
                                                <strong>MMTHOMEOFFER</strong> <span class="text-success">₹
                                                    1,389</span><br><small>Congratulations! Discount of INR 1389
                                                    Applied</small></label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </form>


    <style>
        /* Hotel Booking Review Styles */
        .booking-review-section {
            padding: 20px 0;
            background: linear-gradient(135deg, #e6f0ff 0%, #f8fafc 100%);
        }

         .mobile-sticky-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 10px 15px;
    background-color: #fff;
    z-index: 999;
    box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
    border-top: 1px solid #ddd;
}
        
        #footers {
            display: none;
        }
        #expert-btn{
            display: none;
        }
        .form-label {
            text-align: left !important;
        }

        /* Booking Steps */
        .booking-steps {
            display: flex;
            justify-content: center;
            padding: 10px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .step {
            display: flex;
            align-items: center;
            margin: 0 15px;
            color: #4b5e7b;
            font-weight: 500;
            font-size: 14px;
        }

        .step.active {
            color: #1e40af;
            font-weight: 600;
        }

        .step-number {
            width: 24px;
            height: 24px;
            background: #e2e8f0;
            border-radius: 50%;
            margin-right: 6px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2d3748;
        }

        .step.active .step-number {
            background: #1e40af;
            color: #fff;
        }

        .hotel-book-left {
            background-color: white;
        }

        .hotel-book-badge {
            background-color: #e9f5ff;
            padding: 3px 8px;
            font-size: 14px;
            border-radius: 5px;
        }

        .hotel-book-sticky-sidebar {
            position: sticky;
            top: 20px;
            background: #fff;
            z-index: 100;
        }

        .hotel-book-coupon-active {
            border: 1px solid #0d6efd;
            border-radius: 10px;
            padding: 10px;
            background: #e9f5ff;
        }

        .hotel-book-timeline-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .hotel-book-timeline-bar span {
            flex: 1;
            height: 6px;
            border-radius: 5px;
        }

        .hotel-book-bar-green {
            background-color: #28a745;
        }

        .hotel-book-bar-yellow {
            background-color: #ffc107;
        }

        .hotel-book-mobile-pay {
            display: none;
        }

        @media (max-width: 767.98px) {
            .hotel-book-mobile-pay {
                display: block;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: #fff;
                padding: 1rem;
                border-top: 1px solid #ccc;
                z-index: 1050;
                text-align: center;
            }
        }
    </style>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function () {
             window.addEventListener('pageshow', function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            window.location.reload();
        }
    });
        @for ($i = 0; $i < $count; $i++)
            const toggleIncl{{ $i }} = document.getElementById('toggle-inclusions-{{ $i }}');
            const moreIncl{{ $i }} = document.getElementById('more-inclusions-{{ $i }}');
            if (toggleIncl{{ $i }}) {
                toggleIncl{{ $i }}.addEventListener('click', function () {
                    const isHidden = moreIncl{{ $i }}.style.display === 'none';
                    moreIncl{{ $i }}.style.display = isHidden ? 'inline' : 'none';
                    this.textContent = isHidden ? 'Less' : 'See more+';
                });
            }

            const toggleAmen{{ $i }} = document.getElementById('toggle-amenities-{{ $i }}');
            const moreAmen{{ $i }} = document.getElementById('more-amenities-{{ $i }}');
            if (toggleAmen{{ $i }}) {
                toggleAmen{{ $i }}.addEventListener('click', function () {
                    const isHidden = moreAmen{{ $i }}.style.display === 'none';
                    moreAmen{{ $i }}.style.display = isHidden ? 'inline' : 'none';
                    this.textContent = isHidden ? 'Less' : 'See more+';
                });
            }
        @endfor
    });

        document.addEventListener('DOMContentLoaded', function() {
        


            const modal = document.getElementById('staticBackdrop');
        if (modal) {
            modal.remove(); // Or modal.style.display = 'none';
        }
            // Function to toggle passport and PAN fields based on nationality
            function toggleFields(select) {
                const guestContainer = select.closest('.guest-container');
                if (!guestContainer) {
                    console.error('Guest container not found for select:', select.id);
                    return;
                }

                const passportFields = guestContainer.querySelector('.passport-fields');
                const panInput = guestContainer.querySelector('.pan-input');

                if (!passportFields) {
                    console.error('Passport fields not found for select:', select.id);
                    return;
                }

                console.log('Toggling fields for select:', select.id, 'Value:', select.value);

                if (select.value !== 'IN') {
                    passportFields.style.display = 'flex';
                    passportFields.style.justifyContent = 'space-between';
                    passportFields.querySelectorAll('input').forEach(input => {
                        input.setAttribute('required', 'required');
                    });
                    if (panInput) {
                        panInput.removeAttribute('required');
                        panInput.value = '';
                    }
                } else {
                    passportFields.style.display = 'none';
                    passportFields.querySelectorAll('input').forEach(input => {
                        input.removeAttribute('required');
                        input.value = '';
                    });
                    if (panInput) {
                        panInput.setAttribute('required', 'required');
                    }
                }
            }


            // Select all nationality dropdowns
            const nationalitySelects = document.querySelectorAll('.nationality-select');

            // Initialize fields based on current selection
            nationalitySelects.forEach(select => {
                toggleFields(select);
                // Add change event listener
                select.addEventListener('change', function() {
                    toggleFields(this);
                });
            });

            // Payment button handler
            const payButton = document.getElementById('rzp-button');
        const payMobile = document.getElementById('rzp-button-mobile');

            const loader = document.getElementById('payment-loader');

               function handlePayment(e) {
                    e.preventDefault();

                    const form = document.getElementById('booking-form');
                    if (!form) {
                        alert('Form not found. Please try again or contact support.');
                        return;
                    }

                    // Show invalid fields by opening their accordion
                    const invalidFields = form.querySelectorAll(':invalid');
                    invalidFields.forEach(field => {
                        const accordionItem = field.closest('.accordion-collapse');
                        if (accordionItem && !accordionItem.classList.contains('show')) {
                            const accordionId = accordionItem.id;
                            const accordionButton = document.querySelector(
                                `[data-bs-target="#${accordionId}"]`);
                            if (accordionButton) accordionButton.click();
                        }
                    });

                    // Validate PAN numbers for Indian guests
                    const panRegex = /^[A-Z]{3}[ABCFGHLPJT][A-Z][0-9]{4}[A-Z]$/;
                    let panValid = true;
                    let panErrorMsg = '';

                    const adultPANInputs = form.querySelectorAll('input[name*="[adult]"][name*="[PAN]"]');
                    adultPANInputs.forEach(input => {
                        const guestContainer = input.closest('.guest-container');
                        if (!guestContainer) {
                            console.error('Guest container not found for PAN input:', input.id);
                            return;
                        }
                        const nationalitySelect = guestContainer.querySelector('.nationality-select');
                        if (nationalitySelect && nationalitySelect.value === 'IN') {
                            const pan = input.value.trim().toUpperCase();
                            input.value = pan;
                            if (!panRegex.test(pan)) {
                                panValid = false;
                                input.classList.add('is-invalid');
                                panErrorMsg = 'Please enter a valid PAN number (e.g., GFEHL4354K).';
                            } else {
                                input.classList.remove('is-invalid');
                            }
                        }
                    });

                    if (!panValid) {
                        alert(panErrorMsg);
                        return;
                    }

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    const razorpayKey = "{{ config('services.razorpay.key') }}";
                    if (!razorpayKey) {
                        alert('Payment configuration error. Please contact support.');
                        return;
                    }

                    const formData = new FormData(form);
                    if (loader) loader.style.display = 'flex';
                    document.body.style.pointerEvents = 'none';

                    fetch('{{ route('hotel.book.submit') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.order_id && data.booking_id) {
                                var options = {
                                    "key": razorpayKey,
                                    "amount": {{ $HotelResult[0]['Rooms'][0]['TotalFare'] * 100 }},
                                    "currency": "INR",
                                    "description": "Hotel Booking Payment",
                                    "order_id": data.order_id,
                                    "handler": function(response) {
                                                
                                                const bookingLoader = document.getElementById('booking-loader');
                                                if (bookingLoader) bookingLoader.style.display = 'flex';

                                                // Optional: hide any previous loader
                                                if (loader) loader.style.display = 'none';
                                                document.body.style.pointerEvents = 'none';

                                                fetch('{{ route('hotel.payment.update') }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify({
                                                        booking_id: data.booking_id,
                                                        razorpay_payment_id: response.razorpay_payment_id,
                                                        razorpay_order_id: response.razorpay_order_id,
                                                        razorpay_signature: response.razorpay_signature
                                                    })
                                                })
                                                .then(updateResponse => updateResponse.json())
                                                .then(updateData => {
                                            if (updateData.success) {
                                                 
                                                 if (bookingLoader) bookingLoader.style.display = 'none';

                                                Swal.fire({
                                                    title: "Success!",
                                                    text: `${updateData.message}`,
                                                    icon: "success"
                                                });

                                                setTimeout(() => {
                                                    window.location.replace('/hotels'); 
                                                    window.history.pushState(null, '', '/hotels'); 
                                                    window.onpopstate = function () {
                                                        window.history.go(1); 
                                                    };
                                                }, 6000); 
                                            }
                                            else {
                                                Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: `${updateData.message}`,
                                                footer: '<span class="text-info">If payment has been made, it will be returned within 2–3 working days.</span>'
                                                });                                        
                                                if (bookingLoader) bookingLoader.style.display = 'none';
                                                document.body.style.pointerEvents = 'auto';
                                            }
                                        })

                                                .catch(error => {
                                                    console.error('Error updating payment:', error);
                                                    alert('An error occurred while updating payment.');
                                                    if (bookingLoader) bookingLoader.style.display = 'none';
                                                    document.body.style.pointerEvents = 'auto';
                                                });
                                            },
                                     "prefill": {
                                        "name": document.querySelector('input[name="billing[name]"]')
                                            .value,
                                        "email": document.querySelector('input[name="billing[email]"]')
                                            .value,
                                        "contact": document.querySelector(
                                            'input[name="billing[phone]"]').value
                                    },
                                    "theme": {
                                        "color": "#3399cc"
                                    }
                                };
                                var rzp = new Razorpay(options);
                                rzp.open();
                            } else {
                                alert('Failed to create booking or order. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        })
                        .finally(() => {
                            if (loader) loader.style.display = 'none';
                            document.body.style.pointerEvents = 'auto';
                        });
                };

                if (payButton) payButton.addEventListener('click', handlePayment);
if (payMobile) payMobile.addEventListener('click', handlePayment);
            
        });
    </script>


@endsection
