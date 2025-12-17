<div>
    <div id="loader-backdrop" class="loading-backdrop" wire:loading wire:loading.class="d-flex">
        <img src="{{ asset('site/gif/steer.gif') }}" alt="Loading..." class="loading-gif">
    </div>

    <div class="container">
        {{-- form-section --}}
        @if ($step == 1 && $Mtrip == 1)
        <div class="row">
            @include('common.cruise-search')
        </div>
        @else
        <div class="row mt-2 ">
            <ul class="progressbar d-flex justify-content-center">
                <li class="{{ $step > 1 ? 'active' : '' }}">
                    <p>Search</p>
                </li>
                <li class="{{ $step > 2 ? 'active' : '' }}">
                    <p>Select</p>
                </li>
                <li class="{{ $step > 3 ? 'active' : '' }}">
                    <p>Book</p>
                </li>
            </ul>
        </div>
        @endif
        {{-- end-form-section --}}

        @if ($step == 1)
        @if (!empty($ferry))
        @for ($i = 0; $i < $Mtrip; $i++) <div class="row ">
            <div class="col-md-12 col-lg-8 col-sm-12">
                <div class="row">
                    <div class="container-fluid timeline-container">
                        <div class="row mt-4 pb-1">
                            <div class="col-sm-1 d-none d-sm-block">
                                <div class="row">
                                    <div class="prev-btn" wire:click="prev">
                                        <span class="fas fa-angle-left"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-10">
                                <div class="timeline-list">
                                    @foreach ($timelineItems as $item)
                                    <div
                                        class="timeline-item {{ $activeDate == $item['date'] ? 'active' : '' }} {{ $activeDate }}">
                                        <div class="timeline-date" data-kt-materials-id="{{ $item['date'] }}"
                                            style="cursor: pointer;"
                                            wire:click="handleDateClick('{{ $item['date'] }}')">
                                            <span class="d-block"><strong>{{ $item['weekday'] }}</strong></span>
                                            <span class="d-block">{{ str_pad($item['day'], 2, '0', STR_PAD_LEFT) }}
                                                {{ $item['month'] }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-1 d-none d-sm-block">
                                <div class="row">
                                    <div class="next-btn" wire:click="nexttime">
                                        <span class="fas fa-angle-right"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h2 class="fw-semibold journey-sector"> Journey
                            {{ __('From :from to :to', ['from' => $from_location, 'to' => $to_location]) }}
                        </h2>
                    </div>
                    <section>
                        <div class="container">
                            <div>
                                @foreach ($ferry as $trip)
                                <div class="row bg-white border py-3 px-2 ferry-listing-main mt-3">
                                    <div class="col-md-12 col-sm-12 col-lg-8 col-xl-8 ferry-full-details">
                                        <div class="row mb-0 align-items-center">
                                            <div class="row mx-0 px-0 pb-2">
                                                <div class="col-6 text-start">
                                                    <h2 class="p-0 m-0 fw-bold fs-6">
                                                        {{ __($trip['ferry_name']) }}
                                                    </h2>
                                                    <p class="p-0 m-0 operated">Operated by
                                                        {{ __($trip['ferry_name']) }}
                                                    </p>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <ul>
                                                        <li class="badge badge-ferry">High Speed</li>
                                                        <li class="badge badge-ferry">A/C</li>
                                                        <li class="badge badge-ferry">Royal</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr class="py-0 my-0">
                                            <div class="d-flex cruise-list-timing">
                                                <div class="col-2">
                                                    <img src="{{ $trip['image'] }}" alt="Nautika logo"
                                                        class="img-fluid border rounded-1 p-2">
                                                </div>
                                                <div class="col-3">
                                                    <p class="cruise-time">
                                                        {{ $trip['departure'] }}
                                                    </p>
                                                    <span class="fw-semibold text-black ferry-loc">{{ $trip['from'] }}</span>
                                                </div>
                                                <div class="col-3 ferry-duration-time">
                                                    <img src="{{ asset('site/img/ferry-icon.png') }}" alt="ferry"
                                                        loading="lazy">
                                                    <div class="text-center">
                                                        @php
                                                        $departureTime = \Carbon\Carbon::createFromFormat('h:i A',
                                                        $trip['departure']);
                                                        $arrivalTime = \Carbon\Carbon::createFromFormat('h:i A',
                                                        $trip['arraival']);
                                                        $duration = $departureTime->diffInMinutes($arrivalTime);
                                                        @endphp
                                                        <span class="fw-bolder text-black ferry-time">{{ $duration }}
                                                            Mins</span>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="cruise-time">
                                                        {{ __(@$trip['arraival']) }}
                                                    </p>
                                                    <span class="fw-semibold text-black">{{ $trip['to'] }}</span>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <p>
                                                    <a href="#"
                                                        class="ferry-view-dtls"
                                                        wire:click="selectFerry({{ json_encode($trip) }})"
                                                        data-bs-toggle="modal" data-bs-target="#enquiryModal-price">
                                                        View Details
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="row align-items-center">
                                            <div class="col-6 mb-3">
                                                <div>
                                                    <div class="ferry-review-rating mb-1">
                                                        @for ($i = 0; $i <= 4; $i++)
                                                            <i class="fas fa-star star"></i>
                                                        @endfor
                                                    </div>
                                                    <div>
                                                        @php
                                                            $discountPrice = 0;
                                                            $amt = 0;
                                                            $price = $trip['fare'] ?? 0;
                                                            $farediscount = $farediscount ?? 0;
                                                            $discountPrice = ($price / 100) * $farediscount;
                                                            $amt = $price - $discountPrice;
                                                        @endphp
                                                        <span class="cruise-price-per-person {!! $farediscount > 0 ? 'fs-5' : '' !!}">
                                                            ₹ @if (isset($trip['fare']))
                                                                {{ number_format($amt, 2) }}
                                                                @if ($farediscount > 0)
                                                                    <span class="text-danger fs-6 text-decoration-line-through">
                                                                        ₹ {{ number_format($price, 2) }}
                                                                    </span>
                                                                @endif
                                                            @else
                                                                Not Available
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="cruise-price-per-person">
                                                        Per Adult
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end mb-3">
                                                 <button type="button"
                                                        class="ferry-lst-book-btn"
                                                        wire:click="selectFerry({{ json_encode($trip) }})"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#enquiryModal-price">
                                                    Book Now
                                                </button>   
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach

                                <!-- Modal -->
                                <div class="modal fade" id="enquiryModal-price" data-bs-backdrop="true"
                                    data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true" wire:ignore.self @if (empty($selectedFerry))
                                    style="display: none;" @endif>
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header py-1">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                    {{ ucwords(@$selectedFerry['ferry_name'] ?? 'Select a Ferry') }}
                                                </h1>
                                                <span aria-label="Close" role="button" data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </span>
                                            </div>
                                            <div class="modal-body">
                                                @if (!empty($selectedFerry))
                                                <div class="row mt-2 justify-content-center align-items-center">
                                                    @foreach ($selectedFerry['classes'] as $index => $class)
                                                    <div class="rounded-0 card ferry-card-custom col-12 col-lg-4 p-0 mb-1 {{ $selectedClass === $index ? 'card-selected' : '' }}"
                                                        id="class_{{ $index }}Card" onclick="selectCard({{ $index }})">
                                                        <div class="card-header">
                                                            <input type="radio" wire:model="selectedClass"
                                                                name="classSelection" id="class_{{ $index }}"
                                                                class="form-class px-2 me-2"
                                                                aria-label="Select {{ $class['class_name'] }} Class"
                                                                hidden>
                                                            <label for="class_{{ $index }}"
                                                                class="form-check-label fw-bold text-dark">
                                                                {{ $class['class_name'] }}
                                                            </label>
                                                            <h6 class="fw-semibold">{{ $class['seat_available'] }} Seats
                                                            </h6>
                                                        </div>
                                                        <ul class="list-group custom-li list-group-flush">
                                                            <li class="list-group-item">
                                                                {{ $class['class_name'] === 'Premium' ? 'Premium
                                                                Seating' : 'Standard Seating' }}
                                                            </li>
                                                            <li class="list-group-item">Air Conditioned</li>
                                                            <li class="list-group-item">High-Speed Ferry</li>
                                                        </ul>
                                                        <div class="card-footer">
                                                            <p class="ferry-price fw-bolder text-success">
                                                                ₹{{ number_format($class['adult_seat_rate'], 2) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @else
                                                <p class="text-center">Please select a ferry to view class options.</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer custom-footer justify-content-center py-1">
                                                <p class="py-1 m-0">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    Cancellation fees: ₹250 per person per ticket for cancellations over
                                                    48 hours before departure,
                                                    50% of the ticket price for 24-48 hours prior, and 100% for less
                                                    than 24 hours.
                                                </p>
                                                <button type="button" class="btn rounded-0 fw-bolder btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                @if (!empty($selectedFerry))
                                                <button type="button"
                                                    class="btn rounded-0 fw-bolder btn-yellow text-dark"
                                                    onclick="closeModal()">Proceed</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="col-md-12 col-lg-4 col-sm-12">
                <div class="row mt-3">
                    <div class="border p-3 bg-white py-5">
                        <h2><span class="fw-bold">Ferry Booking</span></h2>
                        <p>Please select a ferry to proceed with booking.</p>
                        <img src="{{ asset('site/img/trip-illustration.webp') }}" alt="ferry" loading="lazy">
                    </div>
                </div>
            </div>
    </div>
    @endfor
    @else
    @include('cruises.home')
    @endif
    @endif

    @if ($step == 2)
    @if (!empty($selectedClass))
    <div class="row flex-wrap mt-4">
        @if ($SelectedFerry['ferry_name'] == 'Nautika')
        <div class="col-12">
            @if ($selectedClass === 'Luxury')
            @include('cruises.nautika.luxury')
            @elseif ($selectedClass === 'Royal')
            @include('cruises.nautika.royal')
            @endif
        </div>
        @elseif ($SelectedFerry['ferry_name'] == 'Green Ocean 1')
        <div class="col-12">
            @if ($selectedClass === 'Economy')
            @include('cruises.greenocean.g1.economy')
            @elseif ($selectedClass === 'Premium')
            @include('cruises.greenocean.g1.premium')
            @elseif ($selectedClass === 'Royal')
            @include('cruises.greenocean.g1.royal')
            @endif
        </div>
        @elseif ($SelectedFerry['ferry_name'] == 'Green Ocean 2')
        <div class="col-12">
            @if ($selectedClass === 'Premium')
            @include('cruises.greenocean.g2.premium')
            @elseif ($selectedClass === 'Royal')
            @include('cruises.greenocean.g2.royal')
            @endif
        </div>
        @endif
    </div>
    @else
    <div class="fs-2 fw-bolder text-warning">Ferry Not Available</div>
    @endif
    @endif
    {{-- payment section --}}
    @if ($step == 3)
    <div class="row mt-4 justify-content-center flex-wrap flex-row-reverse">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card sticks">
                <div class="ferry-price-card-header">
                    <span> <i class="fa-solid fa-bolt"></i> You will receive your tickets instantly</span>
                </div>
                <div class="card-body  ">
                    
                    @foreach ($travelDetail as $detail)
                    <div class="row align-items-center mb-2 border-bottom">
                        <div class="col-3">
                            <p class="fw-semibold fs-6 m-0 p-0"><span class="text-yellow">Trip
                                    {{ $loop->iteration }}</span></p>
                        </div>
                        <div class="col-9">
                            <p class="fw-semibold text-black  m-0 p-0">
                                {{ $detail['ferryDetail']['from'] }} <i class="fa-solid fa-arrow-right"></i>
                                {{ $detail['ferryDetail']['to'] }}</p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-2 p-0">
                            <img src="{{ $detail['ferryDetail']['image'] }}" alt="Ferry logo"
                                class="img-fluid border rounded-1 p-2">
                        </div>
                        <div class="col-10 d-flex flex-wrap align-items-center">
                            <div class="col-6">
                                <p class="m-0 p-0 fs-6 fw-bolder text-yellow">
                                    {{ ucwords($detail['ferryDetail']['ferry_name']) }}</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0 p-0 fw-semibold"><img src="{{ asset('site/img/icon/seat.png') }}"
                                        class="img-fluid " style="height:15px; " alt="">
                                    {{ $detail['selectedClass'] }}
                                    @if (isset($detail['selectedSeats']) && is_array($detail['selectedSeats']))
                                    @foreach ($detail['selectedSeats'] as $seatIndex => $seat)
                                    {{ $seat['seatno'] . ',' }}
                                    @endforeach
                                    @endif
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="m-0 p-0 fw-semibold"><i class="fa-regular fa-calendar-days"></i>
                                    {{ $detail['travelDate'] }}</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0 p-0 fw-semibold"><i class="fa-regular fa-clock"></i>
                                    {{ $detail['ferryDetail']['departure'] }}
                                    -
                                    {{ $detail['ferryDetail']['arraival'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="billing-detail">
                        <p class="text-dark fw-bold">Billing Detail</p>
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            @foreach ($travelDetail as $detail)
                            <div class="accordion-item border-bottom rounded-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button custom-accordion-button " type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"
                                        aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                        <div class="d-flex justify-content-between w-100">
                                            <p class="text-yellow fw-bolder mb-0">Trip
                                                {{ $loop->iteration }}
                                            </p>
                                        </div>
                                        <p class="trip-cost fw-bolder px-2">
                                            ₹{{ number_format($detail['tripCost'], 2) }}</p>
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse show "
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body row p-0 m-0">
                                        <div class="col-6 p-0 text-start">
                                            <p class="m-0 p-0">Price for
                                                {{ $detail['adult'] }}
                                                adult</p>
                                            @if (!empty($child))
                                            <p class="m-0 p-0">Price for 1 Infant</p>
                                            @endif
                                            <p class="m-0 p-0">Port Service Fee</p>
                                            <p class="m-0 p-0">Trip Cost</p>
                                        </div>
                                        <div class="col-6 p-0 text-end">
                                            <p class="m-0 p-0">
                                                ₹{{ number_format((float) ($detail['adult'] ?? 0) * (float)
                                                ($detail['baseFare'] ?? 0), 2) }}
                                            </p>
                                            @if (!empty($child))
                                            <p class="m-0 p-0">
                                                ₹{{ number_format($child * $childFares, 2) }}</p>
                                            @endif
                                            <p class="m-0 p-0">
                                                ₹{{ number_format($detail['adult'] * $portFee, 2) }}
                                            </p>
                                            <p class="m-0 p-0 fw-bolder">
                                                ₹{{ number_format($detail['tripCost'], 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row flex-wrap">
                        <div class="col-6  text-start">
                            <p class="text-dark fw-bold">Total Cost</p>
                        </div>
                        <div class="col-6  text-end">
                            <p class="fw-bolder text-dark">₹ {{ number_format($totalCost, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 mt-2">
            <div class="container">
                @if (!empty($child))
                <h5>Infant Details</h5>
                @for ($i = 1; $i <= $child; $i++) <div class="row border rounded-0 pt-4 py-2  mb-2">
                    <div class="col-12 col-md-2">
                        <div class="form-floating mb-3">
                            <select id="Infant-prefix-{{ $i }}" class="form-select rounded-0"
                                wire:model="InfantDetails.{{ $i }}.prefix">
                                <option value="">Select</option>
                                <option value="Infant">Infant</option>
                            </select>
                            <label for="Infant-prefix-{{ $i }}">Title</label>
                        </div>
                        @error("InfantDetails.$i.prefix")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" id="Infant-name-{{ $i }}" class="form-control rounded-0"
                                placeholder="Infant Name" wire:model="InfantDetails.{{ $i }}.name" required>
                            <label for="Infant-name-{{ $i }}">Infant Name</label>
                        </div>
                        @error("InfantDetails.$i.name")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-floating mb-3">
                            <select id="Infant-gender-{{ $i }}" class="form-select rounded-0"
                                wire:model="InfantDetails.{{ $i }}.gender">
                                <option value="" selected>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="Infant-gender-{{ $i }}">Gender</label>
                        </div>
                        @error("InfantDetails.$i.gender")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            @php
                            $maxDate = \Carbon\Carbon::now()->format('Y-m-d');
                            $minDate = \Carbon\Carbon::now()->subYear()->addDay()->format('Y-m-d');
                            @endphp
                            <input type="date" id="Infant-dob-{{ $i }}" class="form-control rounded-0"
                                wire:model="InfantDetails.{{ $i }}.dob" min="{{ $minDate }}" max="{{ $maxDate }}"
                                required>
                            <label for="Infant-dob-{{ $i }}">Date of Birth</label>
                        </div>
                        @error("InfantDetails.$i.dob")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            <select id="Infant-nationality-{{ $i }}" class="form-select rounded-0"
                                wire:model="InfantDetails.{{ $i }}.nationality" required>
                                <option value="" selected>Nationality</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            <label for="Infant-nationality-{{ $i }}">Nationality</label>
                        </div>
                        @error("InfantDetails.$i.nationality")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" id="Infant-idNumber-{{ $i }}" class="form-control rounded-0"
                                placeholder="ID Number" wire:model="InfantDetails.{{ $i }}.idNumber" required>
                            <label for="Infant-idNumber-{{ $i }}">ID Number</label>
                        </div>
                        @error("InfantDetails.$i.idNumber")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            @endfor
            @endif
            <h5>Passenger Details</h5>
            @for ($index = 1; $index <= $adult; $index++) <div class="row border rounded-0 pt-4  py-2  mb-2 ">
                <div class="col-12 col-md-2">
                    <div class="form-floating mb-3">
                        <select id="passenger-prefix-{{ $index }}" class="form-select rounded-0"
                            wire:model="passengerDetails.{{ $index }}.prefix">
                            <option value="" selected>Select</option>
                            <option value="Mr">Mr</option>
                            <option value="Miss">Miss</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Master">Master</option>
                            <option value="Doctor">Doctor</option>
                        </select>
                        <label for="passenger-prefix-{{ $index }}">Title</label>
                    </div>
                    @error("passengerDetails.$index.prefix")
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" id="passenger-name-{{ $index }}" class="form-control rounded-0"
                            placeholder="Passenger Name" wire:model="passengerDetails.{{ $index }}.name" required>
                        <label for="passenger-name-{{ $index }}">Passenger Name</label>
                    </div>
                    @error("passengerDetails.$index.name")
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-floating mb-3">
                        <select id="passenger-gender-{{ $index }}" class="form-select rounded-0"
                            wire:model="passengerDetails.{{ $index }}.gender">
                            <option value="" selected>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="passenger-gender-{{ $index }}">Gender</label>
                    </div>
                    @error("passengerDetails.$index.gender")
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-floating mb-3">
                        <input type="number" id="passenger-age-{{ $index }}" class="form-control rounded-0"
                            placeholder="Age" min="1" wire:model="passengerDetails.{{ $index }}.age" required>
                        <label for="passenger-age-{{ $index }}">Age</label>
                    </div>
                    @error("passengerDetails.$index.age")
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating mb-3">
                        <select id="passenger-nationality-{{ $index }}" class="form-select rounded-0"
                            wire:model="passengerDetails.{{ $index }}.nationality" required>
                            <option value="" selected>Nationality</option>
                            @foreach ($countries as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                        <label for="passenger-nationality-{{ $index }}">Nationality</label>
                    </div>
                    @error("passengerDetails.$index.nationality")
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" id="passenger-idNumber-{{ $index }}" class="form-control rounded-0"
                            placeholder="ID Number" wire:model="passengerDetails.{{ $index }}.idNumber" required>
                        <label for="passenger-idNumber-{{ $index }}">ID Number</label>
                    </div>
                    @error("passengerDetails.$index.idNumber")
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>
        @endfor
        <h5>Billing Details</h5>
        <div class="row border rounded-0 pt-4  py-2  mb-2">
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" id="billing-name" class="form-control rounded-0" placeholder="Billing Name"
                        wire:model="billingName" required>
                    <label for="billing-name">Billing Name</label>
                </div>
                @error('billingName')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="email" id="billing-email" class="form-control rounded-0" placeholder="Billing Email"
                        wire:model="billingEmail" required>
                    <label for="billing-email">Email Address</label>
                </div>
                @error('billingEmail')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" id="billing-mobile" class="form-control rounded-0" placeholder="Billing Mobile"
                        wire:model="billingMobile" required>
                    <label for="billing-mobile">Mobile Number</label>
                </div>
                @error('billingMobile')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" id="billing-gst" class="form-control rounded-0" placeholder="GSTIN (Optional)"
                        wire:model="billingGst">
                    <label for="billing-gst">GSTIN</label>
                </div>
                @error('billingGst')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
@endif
@if (($step > 1 && !empty($ferry)) || $this->step > 1)
@if ($step != 3)
<div class="d-flex justify-content-evenly mt-4 footer_btn">
    <button type="button" class="btn btn-danger  btn-lg text-white fw-semibold rounded-0"
        wire:click="ResetStep">Discard</button>
    <button type="button" class="btn btn-primary btn-lg text-white fw-semibold rounded-0"
        wire:click="next">Proceed</button>
</div>
@endif
@if ($step == 3)
<div class="d-flex justify-content-around mt-4 footer_btn">
    <button type="button" class="btn btn-danger  btn-lg text-white fw-semibold rounded-0"
        wire:click="ResetStep">Discard</button>
    <button type="button" class="btn btn-primary btn-lg text-white fw-semibold rounded-0 ms-auto"
        wire:click="next">Proceed To Pay <i class="fa fa-wallet"></i></button>
</div>
@endif
@endif
</div>
</div>
@push('styles')
<style>
    .form-floating {
       width: 100% !important;
    }
    .badge-ferry{
        background-color:#FF5722;
    }
    .ferry-lst-book-btn{
        background-color:#FF5722;
        color:#fff;
        font-weight:500;
        border:none;
        border-radius:30px;
        padding: 5px 15px;
    }
    .ferry-lst-book-btn:hover{
        color:#f1f1f1;
    }
    .ferry-view-dtls{
        color:#03A9F4;
        font-weight:bold !important;
    }
    .ferry-loc{
        font-size:1rem;
    }
    .journey-sector{
        font-size:1.5rem;
    }
    .ferry-time{
        font-size:0.8rem;
    }
    .ferry-price-card-header{
        background-color:#01B46C;
        color:#fff;
        font-size:12px;
        border-radius:10px 10px 0 0;
        padding:5px;
    }


</style>
@endpush
@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Initialize modal on DOM load to ensure Bootstrap is ready
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('enquiryModal-price');
        if (modalElement) {
            new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true
            });
        }
    });

    // Debug modal rendering
    Livewire.hook('element.updated', (el, component) => {
        if (document.getElementById('enquiryModal-price')) {
            console.log('Modal element rendered in DOM');
        }
        // Debug backdrop presence after render
        if (document.querySelector('.modal-backdrop')) {
            console.warn('Modal backdrop detected after DOM update');
        }
    });

    function closeModal() {
        let modalElement = document.getElementById('enquiryModal-price');
        let modalInstance = bootstrap.Modal.getInstance(modalElement);
        
        if (modalInstance) {
            modalInstance.hide();
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });
                document.body.classList.remove('modal-open');
                document.body.style.overflow = 'auto';
                document.body.style.paddingRight = '';
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.style.overflow = '';
                    modal.style.paddingRight = '';
                });
                if (!document.querySelector('.modal-backdrop')) {
                    console.log('Modal backdrop successfully removed');
                } else {
                    console.warn('Modal backdrop still present after cleanup');
                }
                @this.call('Proceed');
            }, 350); 
        } else {
            console.warn('Modal instance not found, cleaning up anyway');
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                backdrop.remove();
            });
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '';
            @this.call('Proceed');
        }
    }

    function changedateFormat(index) {
        var inputElement = document.getElementById('multi_Date_' + index);
        var dateValue = inputElement.value;
        var formattedDate = formatDate(dateValue);
        inputElement.setAttribute('value', formattedDate);
        console.log(inputElement);
        console.log('Formatted Date:', formattedDate);
        @this.set('trips.' + index + '.departure', formattedDate);
    }

    function formatDate(dateStr) {
        var parts = dateStr.split('-');
        var year = parts[0];
        var month = parts[1];
        var day = parts[2];
        return day + '-' + month + '-' + year;
    }

    function changeCardBg(cardId) {
        document.querySelectorAll('.ferry-card-custom').forEach((card) => {
            card.classList.remove('card-selected');
            document.getElementById(`class_${cardId}`).checked = true;
        });

        const selectedCard = document.getElementById(`${cardId}Card`);
        if (selectedCard) {
            selectedCard.classList.add('card-selected');
            const radioInput = selectedCard.querySelector('input[type="radio"]');
            if (radioInput) radioInput.checked = true;
        }
    }

    function selectCard(cardId) {
        @this.set('selectedClass', cardId);
        changeCardBg(cardId);
    }

    function resetSelectedCards() {
        $('.ferry-card-custom').each(function() {
            $(this).removeClass('card-selected');
            $(this).find('input[type="radio"]').prop('checked', false);
        });
    }

    function initializeDatepickers() {
        $('.date').datepicker({
            startDate: new Date(),
            format: 'dd-mm-yyyy',
            autoclose: true
        }).on('changeDate', function() {
            var index = $(this).data('index');
            var selectedDate = $(this).val();
            @this.call('updateDeparture', index, selectedDate);
        });
    }

    document.addEventListener('livewire:init', function() {
        initializeDatepickers();
        Livewire.on('alert', (message) => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: message,
                footer: '<a href="#">Happy Travel :) </a>'
            });
        });

        Livewire.on('OpenPaymentSdk', (data) => {
            if (!data || !data[0] || !data[0].order || !data[0].userDetails) {
                console.error('Order or User Details are undefined.');
                return;
            }
            const order = data[0].order;
            const UserDeta = data[0].userDetails;

            var options = {
                "key": UserDeta.razorpay_key,
                "amount": order.amount,
                "currency": order.currency,
                "order_id": order.id,
                "handler": function(response) {
                    @this.call('paymentSuccess', ([response.razorpay_payment_id, response.razorpay_order_id, response.razorpay_signature]));
                },
                "modal": {
                    "ondismiss": function() {
                        @this.call('paymentFailedSessionAlert');
                    }
                },
                "prefill": {
                    "name": UserDeta.name || "Default Name",
                    "email": UserDeta.email || "default@example.com",
                    "contact": UserDeta.contact || "0000000000"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        });
            @if(!empty($ferry))
                        console.log('Ferries loaded, initializing inactivity timer');
                        document.addEventListener('mousemove', resetInactivityTimer);
                        document.addEventListener('keypress', resetInactivityTimer);
                        document.addEventListener('click', resetInactivityTimer);
                        window.onload = resetInactivityTimer;

                        document.addEventListener('visibilitychange', () => {
                            clearTimeout(visibilityChangeTimer);
                            if (document.hidden) {
                                console.log('Page hidden, starting visibility timer');
                                visibilityChangeTimer = setTimeout(() => {
                                    console.log('Visibility timeout, calling ResetStep');
                                    @this.call('ResetStep');
                                }, inactivityLimit);
                            } else {
                                console.log('Page visible, resetting inactivity timer');
                                resetInactivityTimer();
                            }
                        });
                    @endif
        $('#travel_date').datepicker({
            startDate: new Date(),
            format: 'dd-mm-yyyy',
            autoclose: true
        }).on('changeDate', function() {
            @this.set('travel_date', $(this).val());
        });

        Livewire.on('pagerefres', () => {
            location.reload();
        });

        Livewire.on('reinitialize-timeline', function() {
            const timelineList = $(".timeline-list");
            if (timelineList.length) {
                const activeItem = $(".timeline-list .active");
                if (activeItem.length) {
                    const activeOffset = activeItem.position().left + activeItem.width() / 2;
                    const listWidth = timelineList.width() / 2;
                    const scrollPosition = activeOffset - listWidth;
                    timelineList.animate({
                        scrollLeft: scrollPosition
                    }, "slow");
                }
            }
        });

        $(".prev-btn").click(() => {
            const timelineList = $(".timeline-list");
            const scrollAmount = 255;
            timelineList.animate({
                scrollLeft: `-=${scrollAmount}`
            }, "slow");
        });

        $(".next-btn").click(() => {
            const timelineList = $(".timeline-list");
            const scrollAmount = 255;
            timelineList.animate({
                scrollLeft: `+=${scrollAmount}`
            }, "slow");
        });

        $(".timeline-list").on("click", ".timeline-item", function() {
            $(".timeline-item").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>
@endpush