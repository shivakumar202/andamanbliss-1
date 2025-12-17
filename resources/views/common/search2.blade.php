<div class="andaman-search-container position-relative mt-0 pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="search-wrapper ">
                    <!-- Professional Navigation Tabs -->
                    <div class="search-navigation d-flex align-items-center border-bottom mb-0">
                        <div class="nav-tabs-wrapper d-flex flex-grow-1 overflow-x-auto">
                            @php
                                $searchTypes = [
                                    [
                                        'label' => 'Tours',
                                        'icon' => 'fa-map-marked-alt',
                                        'route' => 'tours*',
                                        'action' => 'andaman-tour-packages',
                                    ],
                                    [
                                        'label' => 'Cruises',
                                        'icon' => 'fa-ship',
                                        'route' => 'ferry-booking',
                                        'action' => 'ferry-booking',
                                    ],
                                    [
                                        'label' => 'Hotels',
                                        'icon' => 'fa-hotel',
                                        'route' => 'hotels*',
                                        'action' => 'hotels/search',
                                    ],
                                    [
                                        'label' => 'Activities',
                                        'icon' => 'fa-car',
                                        'route' => 'activities*',
                                        'action' => 'activities',
                                    ],
                                    [
                                        'label' => 'Bikes',
                                        'icon' => 'fa-motorcycle',
                                        'route' => 'bikes*',
                                        'action' => 'bikes',
                                    ],
                                    ['label' => 'Cabs', 'icon' => 'fa-car', 'route' => 'cabs*', 'action' => 'cabs'],
                                ];

                                $activeFound = false;
                                foreach ($searchTypes as $type) {
                                    if (request()->is($type['route'])) {
                                        $activeFound = true;
                                        break;
                                    }
                                }

                            @endphp

                            @foreach ($searchTypes as $type)
                                <button
                                    class="nav-tab  {{ request()->is($type['route']) || (!$activeFound && $loop->first) ? 'active' : '' }}"
                                    data-target="{{ strtolower($type['label']) }}-search">
                                    <i class="fas {{ $type['icon'] }}"></i>
                                    <span>{{ $type['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Search Content Panels -->
                    <div class="search-content-panels p-3">
                        @foreach ($searchTypes as $type)
                            <div
                                class="search-panel {{ strtolower($type['label']) }}-search  {{ request()->is($type['route']) || (!$activeFound && $loop->first) ? 'active' : '' }}">
                                <form class="" method="GET" action="{{ url(strtolower($type['action'])) }}" autocomplete="off">
                                    <div class="row g-3">
                                        @switch(strtolower($type['label']))
                                            @case('tours')
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-floating">
                                                        <select name="category" class="form-select select2-input rounded-0"
                                                            id="tours-destination" placeholder="Tour Package" required>
                                                            <option value="" selected disabled>Select Package</option>
                                                            @php
                                                                $categories = \App\Models\Category::where(
                                                                    'type',
                                                                    'tour',
                                                                )->get();
                                                            @endphp
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->slug }}"
                                                                    @selected($category->slug == request('category'))>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="tours-destination">Tour Package</label>
                                                    </div>

                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-floating position-relative">
                                                        <input type="text" name="checkin"
                                                            class="form-control  shadow-none border-dark-subtle rounded-0"
                                                            id="tours-date" value="{{ request('checkin') }}"
                                                            placeholder="Travel Date" readonly>
                                                        <label for="tours-date">Travel Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-3 position-relative">
                                                <div class="form-floating guest-selector-wrapper">
                                                    <input type="text" class="guestSummary form-control shadow-none border-dark-subtle rounded-0"
                                                        placeholder="Room Guest" readonly>
                                                    <label>Room & Guest</label>

                                                    <div class="guest-dropdown-box position-absolute z-3 bg-white border rounded p-2 shadow mt-1 w-100" style="display:none;">
                                                        <div class="d-grid" style="grid-template-columns: 1fr 80px;">
                                                            <div class="d-flex align-items-center">
                                                                <label class="fw-semibold small">Room</label>
                                                            </div>
                                                            <div>
                                                                <select class="roomSelect form-select form-select-sm py-1">
                                                                    @for ($i = 1; $i <= 4; $i++)
                                                                        <option value="{{ $i }}" {{ request('room') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="roomsContainer mt-2"></div>
                                                        <button type="button" class="guestApplyBtn rounded-pill btn-primary w-100 mt-2 py-1 small">APPLY</button>
                                                    </div>
                                                </div>
                                            </div>

                                            @break

                                            @case('hotels')
                                                <div class="col-12 col-lg-3">
                                                    <div class="form-floating">
                                                       <select name="keyword" class="form-select select2-input border-dark-subtle rounded-0" id="hotels-name" required>
                                                            <option value="" disabled {{ request('keyword') ? '' : 'selected' }}>Select a Location</option>
                                                            <option value="Port Blair" {{ request('keyword') == 'Port Blair' ? 'selected' : '' }}>Best Hotels in Port Blair</option>
                                                            <option value="Havelock Island" {{ request('keyword') == 'Havelock Island' ? 'selected' : '' }}>Best Hotels in Havelock Island</option>
                                                            <option value="Neil Island" {{ request('keyword') == 'Neil Island' ? 'selected' : '' }}>Best Hotels in Neil Island</option>
                                                        </select>

                                                        <label for="hotels-name">Select Location</label>
                                                        
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-floating">
                                                        <input type="text" name="checkin" value="{{ request('checkin') }}"
                                                            class="form-control position-relative shadow-none rounded-0 border-dark-subtle"
                                                            id="hotels-checkin" placeholder="Check-in" required readonly>
                                                        <label for="hotels-checkin">Check-in</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-floating">
                                                        <input type="text" name="checkout" value="{{ request('checkout') }}"
                                                            class="form-control position-relative shadow-none rounded-0 border-dark-subtle"
                                                            id="hotels-checkout" placeholder="Check-out" required readonly>
                                                        <label for="hotels-checkout">Check-out</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2">
                                                    <div class="form-floating">
                                                        <select name="nationality" aria-label="nationality selector"
                                                            class="form-select position-relative shadow-none rounded-0 border-dark-subtle"
                                                            id="hotels-nationality" required>
                                                            <option value="">Nationality</option>
                                                            <option value="IN" selected>INDIAN</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-3 position-relative">
                <div class="form-floating guest-selector-wrapper">
                    <input type="text" class="guestSummary form-control shadow-none border-dark-subtle rounded-0"
                        placeholder="Room Guest" value="@foreach(request('PaxRooms', []) as $index => $room)
                    Room {{ $index + 1 }} - {{ $room['Adults'] ?? 0 }} Adults: {{ $room['Adults'] ?? 0 }}, {{ $room['Children'] ?? 0 }} Child
            @endforeach
            " readonly>
        <label>Room & Guest</label>

        <div class="guest-dropdown-box position-absolute z-3 bg-white border rounded p-2 shadow mt-1 w-100" style="display:none;">
            <div class="d-grid" style="grid-template-columns: 1fr 80px;">
                <div class="d-flex align-items-center">
                    <label class="fw-semibold small">Room</label>
                </div>
                <div>
                    <select class="roomSelect form-select form-select-sm py-1">
                        @for ($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ request('room') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="roomsContainer mt-2"></div>
            <button type="button" class="guestApplyBtn rounded-pill btn-primary w-100 mt-2 py-1 small">APPLY</button>
        </div>
    </div>
</div>

                                            @break

                                            @case('cruises')
                                                <div class="d-flex ferry-search" id="tripTabs" role="tablist"
                                                    aria-label="Trip Type Tabs">
                                                    <div class="form-check mx-1">
                                                        <input class="form-check-input" type="radio" name="tripType[]"
                                                            id="oneWay-tab" value="one" checked>
                                                        <label class="form-check-label" aria-labelledby="oneWay-tab"
                                                            for="oneWay-tab" data-bs-toggle="tab"
                                                            data-bs-target="#OneWay">One Way</label>
                                                    </div>

                                                    <div class="form-check mx-1">
                                                        <input class="form-check-input" type="radio" name="tripType[]"
                                                            id="multiTrip-tab" value="multi">
                                                        <label class="form-check-label" aria-labelledby="multiTrip-tab"
                                                            for="multiTrip-tab" data-bs-toggle="tab"
                                                            data-bs-target="#MultiTrip">Multi Way</label>
                                                    </div>
                                                </div>

                                                <div class="tab-content mt-3">
                                                    <div class="tab-pane fade show active" id="OneWay" role="tabpanel">
                                                        <div class="row g-3 align-items-center">
                                                            <div class="col-12 col-lg-3">
                                                                <div class="form-floating">
                                                                    <select class="form-select select2-input rounded-0"
                                                                        id="cruise-from" name="from[]"
                                                                        placeholder="Cruise From" required>
                                                                        <option @selected(in_array('Port Blair', (array) request('from', [])))
                                                                            value="Port Blair">Port Blair
                                                                        </option>
                                                                        <option @selected(in_array('Swaraj Dweep', (array) request('from', [])))
                                                                            value="Swaraj Dweep">Swaraj Dweep
                                                                        </option>
                                                                        <option @selected(in_array('Shaheed Dweep', (array) request('from', [])))
                                                                            value="Shaheed Dweep">Shaheed
                                                                            Dweep</option>

                                                                    </select>
                                                                    <label>From</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div class="form-floating">
                                                                    <select class="form-select select2-input rounded-0"
                                                                        name="to[]" id="cruise-destination"
                                                                        placeholder="Cruise Destination" required>
                                                                        <option @selected(in_array('Swaraj Dweep', (array) request('to', [])))
                                                                            value="Swaraj Dweep">Swaraj Dweep
                                                                        </option>
                                                                        <option @selected(in_array('Port Blair', (array) request('to', [])))
                                                                            value="Port Blair">Port Blair
                                                                        </option>

                                                                        <option @selected(in_array('Shaheed Dweep', (array) request('to', [])))
                                                                            value="Shaheed Dweep">Shaheed
                                                                            Dweep</option>
                                                                    </select>
                                                                    <label>Destination</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div class="form-floating">
                                                                    <input type="text"
                                                                        class="form-control datepicker position-relative rounded-0 border-dark-subtle"
                                                                        placeholder="Departure Date" name="departure[]"
                                                                        value="{{ is_array(request('departure')) ? request('departure')[0] ?? '' : request('departure', '') }}"
                                                                        readonly>

                                                                    <label>Departure Date</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div class="form-floating traveler-selection-container">
                                                                    @php
                                                                        $adult = request('adult', [1]);
                                                                        $child = request('child', [0]);

                                                                        $adultValue = is_array($adult)
                                                                            ? $adult[0] ?? 1
                                                                            : $adult;
                                                                        $childValue = is_array($child)
                                                                            ? $child[0] ?? 0
                                                                            : $child;
                                                                    @endphp

                                                                    <input type="text"
                                                                        value="{{ (string) $adultValue }} Adult, {{ (string) $childValue }} Child"
                                                                        class="form-control shadow-none border-dark-subtle rounded-0"
                                                                        placeholder="Select Travelers" readonly>

                                                                    <div class="traveler-dropdown-form">
                                                                        <div class="card mt-2">
                                                                            <div class="card-body p-0">
                                                                                <div class="row gx-1 pb-1">
                                                                                    <div class="col-6">
                                                                                        <label
                                                                                            class="form-label">Adults</label>
                                                                                        <div
                                                                                            class="input-group my-1 justify-content-center">
                                                                                            <button
                                                                                                class="btn btn-sm adult-minus"
                                                                                                type="button">-</button>
                                                                                            <input type="number"
                                                                                                name="adult[]"
                                                                                                class="form-control text-center adult-count"
                                                                                                value="{{ $adultValue }}"
                                                                                                min="1" readonly>
                                                                                            <button
                                                                                                class="btn btn-sm adult-plus"
                                                                                                type="button">+</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <label class="form-label">Children<span class="text-danger fw-semibold" style="font-size: 7px;"> age (0-2 yr's)</span></label>
                                                                                        <div
                                                                                            class="input-group my-1 justify-content-center">
                                                                                            <button
                                                                                                class="btn btn-sm child-minus"
                                                                                                type="button">-</button>
                                                                                            <input type="number"
                                                                                                name="child[]"
                                                                                                class="form-control text-center child-count"
                                                                                                value="{{ $childValue }}"
                                                                                                min="0" readonly>
                                                                                            <button
                                                                                                class="btn btn-sm child-plus"
                                                                                                type="button">+</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <span role="button"
                                                                                    class="btn btn-primary btn-sm w-100 save-travelers justify-content-center">Apply</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <label>Travellers</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="MultiTrip" role="tabpanel">
                                                        @php
                                                            $fromOptions = [
                                                                'Port Blair',
                                                                'Swaraj Dweep',
                                                                'Shaheed Dweep',
                                                            ];
                                                            $toOptions = [
                                                                'Swaraj Dweep',
                                                                'Shaheed Dweep',
                                                                'Port Blair',
                                                            ];
                                                        @endphp

                                                        @foreach (range(0, 2) as $index)
                                                            <div class="row g-3  mt-1  mb-0 ">
                                                                <div class="col-12 col-lg-3">
                                                                    <div class="form-floating">
                                                                        <select class="form-select select2-input rounded-0"
                                                                            name="mfrom[]" required>
                                                                            <option value="" disabled>Select From
                                                                            </option>
                                                                            @foreach ($fromOptions as $from)
                                                                                <option value="{{ $from }}"
                                                                                    {{ $from == $fromOptions[$index] ? 'selected' : '' }}>
                                                                                    {{ $from }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <label>From</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-3">
                                                                    <div class="form-floating">
                                                                        <select class="form-select select2-input rounded-0"
                                                                            name="mto[]" required>
                                                                            <option value="" disabled>Select Destination
                                                                            </option>
                                                                            @foreach ($toOptions as $to)
                                                                                <option value="{{ $to }}"
                                                                                    {{ $to == $toOptions[$index] ? 'selected' : '' }}>
                                                                                    {{ $to }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <label>Destination</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-3">
                                                                    <div class="form-floating">
                                                                        <input type="text"
                                                                            class="form-control datepicker position-relative rounded-0 border-dark-subtle"
                                                                            name="mdeparture[]" required readonly>
                                                                        <label>Departure Date</label>
                                                                    </div>
                                                                </div>
                                                                @if ($index == 0)
                                                                    <div class="col-12 col-lg-3">
                                                                        <div
                                                                            class="form-floating traveler-selection-container">
                                                                            <input type="text"
                                                                                value="{{ is_array(request('madult')) ? request('madult')[0] ?? 1 : request('madult', 1) }} Adult, 
                                                                                    {{ is_array(request('mchild')) ? request('mchild')[0] ?? 0 : request('mchild', 0) }} Child"
                                                                                class="form-control shadow-none border-dark-subtle rounded-0"
                                                                                placeholder="Select Travelers" readonly>

                                                                            <div class="traveler-dropdown-form">
                                                                                <div class="card mt-2">
                                                                                    <div class="card-body p-0">
                                                                                        <div class="row gx-1 pb-1">
                                                                                            <div class="col-6">
                                                                                                <label
                                                                                                    class="form-label">Adults</label>
                                                                                                <div
                                                                                                    class="input-group my-1 justify-content-center">
                                                                                                    <button
                                                                                                        class="btn btn-sm adult-minus"
                                                                                                        type="button">-</button>
                                                                                                    <input type="number"
                                                                                                        name="madult[]"
                                                                                                        class="form-control text-center adult-count"
                                                                                                        value="1"
                                                                                                        min="1"
                                                                                                        readonly>
                                                                                                    <button
                                                                                                        class="btn btn-sm adult-plus"
                                                                                                        type="button">+</button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <label class="form-label">Children<span class="text-danger fw-semibold" style="font-size: 7px;"> age (0-2 yr's)</span></label>
                                                                                                    
                                                                                                <div
                                                                                                    class="input-group my-1 justify-content-center">
                                                                                                    <button
                                                                                                        class="btn btn-sm child-minus"
                                                                                                        type="button">-</button>
                                                                                                    <input type="number"
                                                                                                        name="mchild[]"
                                                                                                        class="form-control text-center child-count"
                                                                                                        value="0"
                                                                                                        min="0"
                                                                                                        readonly>
                                                                                                    <button
                                                                                                        class="btn btn-sm child-plus"
                                                                                                        type="button">+</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span role="button"
                                                                                            class="btn btn-primary btn-sm w-100 save-travelers justify-content-center">Apply</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <label>Travellers</label>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-2 d-flex align-items-center">
                                                                        <button type="button"
                                                                            class="btn btn-danger rounded-0 remove-trip">
                                                                            <i class="fa-solid fa-xmark"></i> </button>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @break

                                            @case('activities')
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-floating">
                                                        <select type="text"
                                                            class="form-control rounded-0 border-dark-subtle"
                                                            id="activities-location" placeholder="Activity Location"
                                                            name="location" required>
                                                            <option value="" disabled {{ request('location') ? '' : 'selected' }}>Select a Location</option>
                                                    <option value="Port Blair" {{ request('location') == 'Port Blair' ? 'selected' : '' }}>popular activities in Port Blair</option>
                                                    <option value="Havelock Island" {{ request('location') == 'Havelock Island' ? 'selected' : '' }}>popular activities in Havelock Island</option>
                                                    <option value="Neil Island" {{ request('location') == 'Neil Island' ? 'selected' : '' }}>popular activities in Neil Island</option>
                                                        </select>
                                                        <label for="activities-location">Location</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-floating">

                                                        <select name="keyword" id="activities-type"
                                                            class="form-control select2-input rounded-0 border-dark-subtle"
                                                            required>
                                                            <option value="" disabled selected>Select Activity</option>
                                                              @php
                                                                $activities = \App\Models\Category::where('status',1)->where('type','activity')->pluck('name');
                                                            @endphp
                                                            @foreach($activities as $act)
                                                           <option value="{{ $act }}" @selected(request('keyword') == $act)>
                                                                {{ $act }}
                                                            </option>

                                                            @endforeach
                                                        </select>

                                                        <label for="activities-type">Activity Type</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            class="form-control datepicker position-relative rounded-0 border-dark-subtle"
                                                            id="activities-date" name="checkin" value="{{request('checkin')}}" placeholder="Activity Date"
                                                            required readonly>
                                                        <label for="activities-date">Date</label>
                                                    </div>
                                                </div>
                                            @break

                                            @case('bikes')
                                                <div class="col-12 col-lg-4">
                                                    <div class="form-floating">

                                                        <select name="location" id="location" class="form-control select2-input rounded-0 border-dark-subtle"
                                                            aria-label="Select Location" required>
                                                            <option value="" {{ request('location') == '' ? 'selected' : '' }} >Location</option>
                                                            <option value="Port Blair" {{ request('location') == 'Port Blair' ? 'selected' : '' }} >Port Blair</option>
                                                            <option value="Neil Island" {{ request('location') == 'Neil Island' ? 'selected' : '' }} >Neil Island</option>
                                                            <option value="Havelock Island" {{ request('location') == 'Havelock Island' ? 'selected' : '' }}>Havelock Island</option>
                                                        </select>

                                                        <label for="bike-location">Pickup Location</label>
                                                    </div>
                                                </div>
                                                 <div class="col-12 col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            class="form-control position-relative rounded-0 border-dark-subtle"
                                                            id="pickup-date" name="pickupdate" value="{{ request('pickupdate') }}" placeholder="Rental Date" required readonly>
                                                        <label for="pickup-date">Rental Date</label>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-4">
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            class="form-control position-relative rounded-0 border-dark-subtle"
                                                            id="drop-date" name="dropdate" value="{{ request('dropdate') }}" placeholder="Drop Off Date" required readonly>
                                                        <label for="drop-date">Drop Off Date</label>
                                                    </div>
                                                </div>

                                            @break

                                             @case('cabs')
                                       @php
                                            $cabType = request('cabtripType', 'airport');
                                        @endphp

                                        <div class="cab-search flex-wrap p-1" id="cabTripTabs" role="tablist">

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cabtripType"
                                                    id="airport" value="airport"
                                                    {{ $cabType === 'airport' ? 'checked' : '' }}>
                                                <label class="form-check-label {{ $cabType === 'airport' ? 'active' : '' }}"
                                                    for="airport" data-bs-toggle="tab" data-bs-target="#Airport">
                                                    Airport Transfer
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cabtripType"
                                                    id="jetty" value="jetty"
                                                    {{ $cabType === 'jetty' ? 'checked' : '' }}>
                                                <label class="form-check-label {{ $cabType === 'jetty' ? 'active' : '' }}"
                                                    for="jetty" data-bs-toggle="tab" data-bs-target="#Jetty">
                                                    Jetty Transfer
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cabtripType"
                                                    id="local" value="local"
                                                    {{ $cabType === 'local' ? 'checked' : '' }}>
                                                <label class="form-check-label {{ $cabType === 'local' ? 'active' : '' }}"
                                                    for="local" data-bs-toggle="tab" data-bs-target="#Local">
                                                    Local Trip
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cabtripType"
                                                    id="outstation" value="outstation"
                                                    {{ $cabType === 'outstation' ? 'checked' : '' }}>
                                                <label class="form-check-label {{ $cabType === 'outstation' ? 'active' : '' }}"
                                                    for="outstation" data-bs-toggle="tab" data-bs-target="#Outstation">
                                                    Outstation
                                                </label>
                                            </div>

                                        </div>
                                        @php
                                            $hasCabType = request()->has('cabtripType');
                                            $cabType = request('cabtripType');
                                        @endphp

                                        <div class="tab-content mt-3" id="cabTabContent">
                                            <div class="tab-pane fade  {{ (!$hasCabType || $cabType === 'airport') ? 'show active' : '' }}" id="Airport" role="tabpanel">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-select rounded-0 border-dark-subtle" name="transfer_type_airport" id="airport-type" required>
                                                                <option value="pickup" {{request('transfer_type_airport') == 'pickup' ? 'selected' : '' }} >Airport Pickup</option>
                                                                <option value="drop" {{request('transfer_type_airport') == 'drop' ? 'selected' : '' }} >Airport Drop</option>
                                                            </select>
                                                            <label for="airport-type">Airport Transfer</label>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="location_airport" value="Port Blair" hidden>
                                                    <div class="col-12 col-lg-3 autocomplete" id="airport-pickup-group" style="display: none;">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control rounded-0 border-dark-subtle locationInput" name="pickup_location_airport" value="{{ request('pickup_location_airport') }}" id="airport-pickup" placeholder="Hotels/Restaurant/Seight Location">
                                                            <label for="airport-pickup">Pickup Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-select rounded-0 border-dark-subtle" name="airport" id="airport" required>
                                                                <option value="Veer Savarkar Airport" selected>Veer Savarkar Airport</option>
                                                            </select>
                                                            <label for="airport">Airport</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3 autocomplete" id="airport-drop-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control rounded-0 border-dark-subtle locationInput" name="drop_location_airport" value="{{ request('drop_location_airport') }}" id="airport-drop" placeholder="Drop Location">
                                                            <label for="airport-drop">Drop Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control position-relative rounded-0 border-dark-subtle datetime-select" id="airport-date" name="travel_date_airport" value="{{ request('travel_date_airport') }}" placeholder="Travel Date" required readonly>
                                                            <label for="airport-date">Travel Date & Time</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade {{ $cabType === 'jetty' ? 'show active' : '' }}" id="Jetty" role="tabpanel">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-select rounded-0 border-dark-subtle" name="transfer_type_jetty" id="jetty-type" required>
                                                                <option value=""selected>Select Option</option>
                                                                <option value="pickup" {{ request('transfer_type_jetty') == 'pickup' ? 'selected' : '' }} >Jetty Pickup</option>
                                                                <option value="drop" {{ request('transfer_type_jetty') == 'drop' ? 'selected' : '' }} >Jetty Drop</option>
                                                            </select>
                                                            <label for="jetty-type">Jetty Transfer</label>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="location_jetty" value="Port Blair" hidden>
                                                    <div class="col-12 col-lg-3" id="jetty-pickup-group" style="display: none;">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control rounded-0 border-dark-subtle locationInput" name="pickup_location_jetty" value="{{ request('pickup_location_jetty') }}" id="jetty-pickup" placeholder="Pickup Location">
                                                            <label for="jetty-pickup">Pickup Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-select rounded-0 border-dark-subtle" name="jetty_select" id="jetty-select" required>
                                                                <option value="" {{ request('jetty_select') == '' ? 'selected' : '' }}>Select Jetty</option>
                                                                <option value="Port Blair" {{ request('jetty_select') == 'Port Blair' ? 'selected' : '' }}>Chatam Jetty</option>
                                                                <option value="Havelock Island" {{ request('jetty_select') == 'Havelock Island' ? 'selected' : '' }}>Havelock Jetty</option>
                                                                <option value="Neil Island" {{ request('jetty_select') == 'Neil Island' ? 'selected' : '' }}>Neil Jetty</option>
                                                            </select>
                                                            <label for="jetty-select">Jetty Point</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3" id="jetty-drop-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control rounded-0 border-dark-subtle locationInput" value="{{ request('drop_location_jetty') }}" name="drop_location_jetty" id="jetty-drop" placeholder="Drop Location">
                                                            <label for="jetty-drop">Drop Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control datetime-select position-relative rounded-0 border-dark-subtle" id="jetty-date" value="{{ request('travel_date_jetty') }}" name="travel_date_jetty" placeholder="Travel Date" required readonly>
                                                            <label for="jetty-date">Travel Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade {{ $cabType === 'local' ? 'show active' : '' }}" id="Local" role="tabpanel">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-select rounded-0 border-dark-subtle" name="cab_location_local" id="cab-location" required>
                                                                <option value="" {{request('cab_location_local') == '' ? 'selected' : ''}} >Select Location</option>
                                                                <option value="Port Blair" {{request('cab_location_local') == 'Port Blair' ? 'selected' : ''}} >Port Blair</option>
                                                                <option value="Havelock" {{request('cab_location_local') == 'Havelock' ? 'selected' : ''}} >Havelock Island</option>
                                                                <option value="Neil Island" {{request('cab_location_local') == 'Neil Island' ? 'selected' : ''}} >Neil Island</option>
                                                            </select>
                                                            <label for="cab-location">Location</label>
                                                        </div>
                                                    </div>
                                                     <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-control rounded-0 border-dark-subtle" name="drop_local"  id="local-drop" placeholder="Drop Location" required>
                                                                <option value="" selected disabled>Select Trip</option>
                                                            </select>
                                                            <label for="local-drop">Trip To</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control rounded-0 border-dark-subtle locationInput" name="pickup_local" value="{{ request('pickup_local') }}" id="local-pickup" placeholder="Pickup Location" required>
                                                            <label for="local-pickup">Pickup Point</label>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control datetime-select position-relative rounded-0 border-dark-subtle" id="local-date" name="travel_date_local" value="{{ request('travel_date_local') }}" placeholder="Travel Date" required readonly>
                                                            <label for="local-date">Travel Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade {{ $cabType === 'outstation' ? 'show active' : '' }}" id="Outstation" role="tabpanel">
                                                <div class="row g-3 mb-0">
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-select rounded-0 border-dark-subtle" name="cab_location_outstation" id="outstation-location" required>
                                                                <option value="" {{ request('cab_location_outstation') == '' ? 'selected' : '' }}>Select Location</option>
                                                                <option value="Port Blair" {{ request('cab_location_outstation') == 'Port Blair' ? 'selected' : '' }}>Port Blair</option>
                                                                <option value="Havelock" {{ request('cab_location_outstation') == 'Havelock' ? 'selected' : '' }}>Havelock Island</option>
                                                                <option value="Neil Island" {{ request('cab_location_outstation') == 'Neil Island' ? 'selected' : '' }}>Neil Island</option>
                                                            </select>
                                                            <label for="outstation-location">Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <select class="form-control rounded-0 border-dark-subtle" name="drop_outstation" id="outstation-drop" placeholder="Drop Location" required>
                                                                <option value="" selected disabled>Select Trip</option>
                                                            </select>
                                                            <label for="outstation-drop">Trip To</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control rounded-0 border-dark-subtle locationInput" name="pickup_outstation" value="{{ request('pickup_outstation') }}" id="outstation-pickup" placeholder="Pickup Location" required>
                                                            <label for="outstation-pickup">Pickup Point</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12 col-lg-3">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control datetime-select rounded-0 border-dark-subtle" id="outstation-date" name="travel_date_outstation" value="{{ request('travel_date_outstation') }}" placeholder="Travel Date" required readonly>
                                                            <label for="outstation-date">Travel Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @break 

                                            @default
                                                <div class="col-12 text-center">
                                                    <p class="text-muted">Coming Soon</p>
                                                </div>
                                        @endswitch

                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn  btn-md search-submit">

                                                Search {{ $type['label'] }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
<style type="text/css">
  .cab-search {
    display: flex;
    background-color: #f8f9fa;
    border-radius: 30px;
    overflow: hidden;
}

.cab-search .form-check {
    margin: 0;
    padding-left: 2px;
}

.cab-search input[type="radio"] {
    display: none;
}

.cab-search label {
    cursor: pointer;
    padding: 6px 18px;
    font-size: 14px;
    font-weight: 500;
    color: #555;
    border-radius: 25px;
    transition: all 0.2s ease;
    margin: 0px;
}

@media all and (max-width: 558px) {
  .cab-search label {  
    padding: 6px 12px;
    font-size: 9px;  
}
}

.cab-search input[type="radio"]:checked + label {
    background-color: #FF5722;
    color: #fff;
}

.ferry-search {
    display: flex;
    background-color: #f8f9fa;
    border-radius: 30px;
    overflow: hidden;
}

.ferry-search .form-check {
    margin: 0;
    padding-left: 2px;
}

.ferry-search input[type="radio"] {
    display: none;
}

.ferry-search label {
    cursor: pointer;
    padding: 6px 18px;
    font-size: 14px;
    font-weight: 500;
    color: #555;
    border-radius: 25px;
    transition: all 0.2s ease;
    margin: 0px;
}

.ferry-search input[type="radio"]:checked + label {
    background-color: #FF5722;
    color: #fff;
}
.autocomplete { position: relative; display: inline-block; width: auto;}
.autocomplete input { width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; }
.autocomplete-items { position: absolute; border: 1px solid #ccc; border-top: none; z-index: 99; max-height: 150px; overflow-y: auto; background-color: #fff; border-radius: 0 0 5px 5px; }
.autocomplete-item { padding: 10px; cursor: pointer; }
.autocomplete-item:hover, .autocomplete-active { background-color: #f0f0f0; }
</style>
@endpush



@push('scripts')
<script>

    $(function(){
    $('.guest-selector-wrapper').each(function(){
        var $wrapper = $(this);
        var $guestSummary = $wrapper.find('.guestSummary');
        var $guestDropdown = $wrapper.find('.guest-dropdown-box');
        var $roomSelect = $wrapper.find('.roomSelect');
        var $roomsContainer = $wrapper.find('.roomsContainer');
        var $guestApplyBtn = $wrapper.find('.guestApplyBtn');

        function attachChildListeners(){
            $wrapper.find('.child-count').off('change').on('change', function(){
                var room = $(this).data('room');
                var container = $wrapper.find('#child-ages-room-' + room).empty();
                var cnt = +$(this).val();
                for(var i=0;i<cnt;i++){
                    container.append(`<div class="col-6 mb-1">
                        <label class="small mb-0">Child ${i+1} Age</label>
                        <select class="form-select form-select-sm py-1" name="PaxRooms[${room}][ChildrenAges][]">
                            ${Array.from({length:18},(_,age)=>`<option value="${age}">${age} yrs</option>`).join('')}
                        </select>
                    </div>`);
                }
            });
        }

        $roomSelect.on('change', function(){
            $roomsContainer.empty();
            var count = +$(this).val();
            for(var r=0; r<count; r++){
                $roomsContainer.append(`<div class="border-top pt-2">
                    <div class="small fw-semibold mb-1">Room ${r+1}</div>
                    <div class="row">
                        <div class="col">
                            <label class="small mb-0">Adults</label>
                            <select name="PaxRooms[${r}][Adults]" class="form-select form-select-sm py-1 adult-count" data-room="${r}">
                                ${Array.from({length:10},(_,i)=>`<option value="${i+1}">${i+1}</option>`).join('')}
                            </select>
                        </div>
                        <div class="col">
                            <label class="small mb-0">Children</label>
                            <select name="PaxRooms[${r}][Children]" class="form-select form-select-sm py-1 child-count" data-room="${r}">
                                ${Array.from({length:7},(_,i)=>`<option value="${i}">${i}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                    <div class="row child-ages mt-1" id="child-ages-room-${r}"></div>
                </div>`);
            }
            attachChildListeners();
        });

        $guestApplyBtn.on('click', function(){
            var count = +$roomSelect.val();
            var lines = [];
            for(var r=0; r<count; r++){
                var a = $wrapper.find(`select[name="PaxRooms[${r}][Adults]"]`).val();
                var c = $wrapper.find(`select[name="PaxRooms[${r}][Children]"]`).val();
                var line = `Room ${r+1} – ${a} Adult${a>1?'s':''}${c>0?', '+c+' Child'+(c>1?'ren':''):''}`;
                lines.push(line);
            }
            $guestSummary.val(lines.join('\n'));
            $guestDropdown.hide();
        });

        $guestSummary.on('focus', ()=>$guestDropdown.show());
        $(document).on('click', function(e){
            if(!$(e.target).closest($wrapper).length) $guestDropdown.hide();
        });

        $roomSelect.trigger('change');
    });
});

$(function() {
     function updateRequired() {
        $('.tab-pane').each(function() {
            const isActive = $(this).hasClass('show active');
            $(this).find('[data-required-original]').each(function() {
                if (isActive) {
                    $(this).attr('required', true).prop('readonly', false);
                    if ($(this).data('name-original')) {
                        $(this).attr('name', $(this).data('name-original'));
                    }
                } else {
                    if (!$(this).data('name-original')) {
                        $(this).data('name-original', $(this).attr('name'));
                    }
                    $(this).removeAttr('required').prop('readonly', true).removeAttr('name');
                }
            });
        });
    }

        $('.cabs-search [required], .cab-search [required]').attr('data-required-original', 'true');

    $('input[name="cabtripType"]').on('change', function() {
        $('#cabTabContent .tab-pane').removeClass('show active');
        const targetId = this.value.charAt(0).toUpperCase() + this.value.slice(1);
        $('#' + targetId).addClass('show active');
        updateRequired();
    });

    function togglePickupDrop(typeSelector, pickupGroup, dropGroup) {
        $(typeSelector).on('change', function() {
            if ($(this).val() === 'drop') {
                $(pickupGroup).show();
                $(dropGroup).hide();
            } else {
                $(pickupGroup).hide();
                $(dropGroup).show();
            }
            updateRequired();
        });
    }

    togglePickupDrop('#airport-type', '#airport-pickup-group', '#airport-drop-group');
    togglePickupDrop('#jetty-type', '#jetty-pickup-group', '#jetty-drop-group');

    if ($('.cabs-search, .cab-search').hasClass('active')) updateRequired();


   
    $('.nav-tab').on('click', function () {
        $('.nav-tab, .search-panel').removeClass('active');
        $(this).addClass('active');
        $('.' + $(this).data('target')).addClass('active');
        updateRequired();
    });

    var today = new Date();
    if (!$('#datepicker-backdrop').length) {
        $('body').append('<div id="datepicker-backdrop" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:998;"></div>');
    }

    function showBackdrop(){ $('body').addClass('no-scroll'); $('#datepicker-backdrop').fadeIn(200); }
    function hideBackdrop(){ $('body').removeClass('no-scroll'); $('#datepicker-backdrop').fadeOut(200); }

    function initDatepickers() {
        $('.datepicker').each(function() {
            $(this).datepicker('destroy');
            var minDate = today;
            if ($(this).closest('#MultiTrip').length) {
                var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
                var idx = rows.index($(this).closest('.row.g-3'));
                if (idx > 0) {
                    var prevDate = rows.eq(idx-1).find('.datepicker').first().datepicker('getDate');
                    if(prevDate){ minDate = new Date(prevDate.getTime()); minDate.setDate(minDate.getDate()+1); }
                }
            }
            $(this).datepicker({
                dateFormat:'dd-mm-yy',
                minDate:minDate,
                changeMonth:true,
                changeYear:true,
                showAnim:'fadeIn',
                beforeShow:showBackdrop,
                onClose:hideBackdrop,
                onSelect:function(){
                    if($(this).closest('#MultiTrip').length){
                        var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
                        var idx = rows.index($(this).closest('.row.g-3'));
                        if(idx+1 < rows.length){
                            var next = rows.eq(idx+1).find('.datepicker').first();
                            var selDate = $(this).datepicker('getDate');
                            if(selDate){
                                var newMin = new Date(selDate.getTime());
                                newMin.setDate(newMin.getDate()+1);
                                next.datepicker('option','minDate',newMin);
                                var nextDate = next.datepicker('getDate');
                                if(nextDate && nextDate < newMin) next.val('');
                            }
                        }
                    }
                }
            });
        });
    }

    initDatepickers();

    var deletedTrips = [];
    $(document).on('click', '.remove-trip', function () {
        var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
        if(rows.length>1){
            var row = $(this).closest('.row.g-3');
            deletedTrips.push({index:rows.index(row), html: row.prop('outerHTML')});
            row.remove();
            initDatepickers();
        }
        if($('#MultiTrip').closest('.tab-pane').find('.row.g-3').length===1) $('#oneWay-tab').trigger('click');
    });

    $('input[name="tripType[]"]').on('change', function () {
        $('#cruiseTabContent .tab-pane').removeClass('show active');
        if(this.id==='oneWay-tab') $('#OneWay').addClass('show active');
        else if(this.id==='multiTrip-tab') {
            $('#MultiTrip').addClass('show active');
            if(deletedTrips.length){
                var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
                deletedTrips.sort((a,b)=>a.index-b.index).forEach(t=>rows.length>t.index?$(rows[t.index]).before(t.html):$('#MultiTrip').closest('.tab-pane').append(t.html));
                deletedTrips=[];
                initDatepickers();
            }
        }
    });

   
    $('form').on('submit', function(e){
        e.preventDefault();
        updateRequired();
        let $form=$(this), valid=true;
        $form.find('input[required]:visible, select[required]:visible').each(function(){ if(!$(this).val()){ valid=false; $(this).focus(); return false; }});
        if(valid) { $form.off('submit').submit(); }
    });
});


 $('#cab-location, #outstation-location').on('change', function () {
        const selectedLocation = $(this).val();
        const selectedType = $('input[name="cabtripType"]:checked').val(); 

        if (selectedLocation) {
            console.log('Selected Location:', selectedLocation);
            console.log('Selected Cab Trip Type:', selectedType);

            $.ajax({
                url: "{{ route('cab.locationChange') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cabtripType: selectedType,
                    location: selectedLocation
                },
                success: function(response) {
                    if(selectedType === 'outstation') {
                $('#outstation-drop').empty().append('<option value="">Select Trip</option>');
                $.each(response, function(index, trip) {
                    let optionText = `${trip}`;
                    $('#outstation-drop').append(`<option value="${trip}">${optionText}</option>`);
                });
            } else if(selectedType === 'local')

            $('#local-drop').empty().append('<option value="">Select Trip</option>');
                            $.each(response, function(index, trip) {
                                let optionText = `${trip}`;
                                $('#local-drop').append(`<option value="${trip}">${optionText}</option>`);
                            });

            },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
           
        }
    });


        const debounceDelay = 300;

        document.querySelectorAll('.locationInput').forEach(input => {
            let currentFocus = -1, debounceTimer;

         input.addEventListener("input", function() {
    clearTimeout(debounceTimer);
    const val = this.value;
    const selectedType = document.querySelector('input[name="cabtripType"]:checked')?.value || '';
    const nameMap = {
        airport: 'location_airport',
        jetty: 'jetty_select',
        local: 'cab_location_local',
        outstation: 'cab_location_outstation'
    };
    const field = document.querySelector(`[name="${nameMap[selectedType]}"]`);
    let locationParam = '';
    if(field){
        locationParam = field.tagName.toLowerCase() === 'select' 
            ? field.options[field.selectedIndex]?.value || '' 
            : field.value || '';
    }

    debounceTimer = setTimeout(() => {
        closeAllLists(input);
        if (!val) return false;

        // Create one container div (reused)
        let container = document.createElement("DIV");
        container.setAttribute("class","autocomplete-items");
        input.parentNode.appendChild(container);

        // Show loading while fetch is in progress
        const loadingDiv = document.createElement("DIV");
        loadingDiv.setAttribute("class","autocomplete-item");
        loadingDiv.textContent = "Loading...";
        container.appendChild(loadingDiv);

        const url = `/get-locations?q=${encodeURIComponent(val)}&cabtripType=${encodeURIComponent(selectedType)}&location=${encodeURIComponent(locationParam)}`;

        fetch(url)
            .then(r => r.json())
            .then(data => {
                // Clear container
                container.innerHTML = "";

                const locations = Object.values(data || []);
                if(locations.length === 0){
                    const emptyDiv = document.createElement("DIV");
                    emptyDiv.setAttribute("class","autocomplete-item");
                    emptyDiv.textContent = val;
                    container.appendChild(emptyDiv);
                    return;
                }

                locations.forEach(item => {
                    const b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + item.name.substr(0, val.length) + "</strong>" + item.name.substr(val.length);
                    b.setAttribute("class","autocomplete-item");
                    b.addEventListener("click", () => {
                        input.value = item.name;
                        closeAllLists(input);
                    });
                    container.appendChild(b);
                });
            })
            .catch(err => {
                console.error(err);
                container.innerHTML = '<div class="autocomplete-item">Error loading data</div>';
            });
    }, debounceDelay);
});



        input.addEventListener("keydown", function(e) {
            let x = input.parentNode.querySelector(".autocomplete-items");
            if(x) x = x.getElementsByClassName("autocomplete-item");
            if(e.keyCode==40){ currentFocus++; addActive(x); }
            else if(e.keyCode==38){ currentFocus--; addActive(x); }
            else if(e.keyCode==13){ e.preventDefault(); if(currentFocus>-1 && x) x[currentFocus].click(); }

            function addActive(x){ if(!x) return false; removeActive(x); if(currentFocus>=x.length) currentFocus=0; if(currentFocus<0) currentFocus=x.length-1; x[currentFocus].classList.add("autocomplete-active"); }
            function removeActive(x){ for(let i=0;i<x.length;i++) x[i].classList.remove("autocomplete-active"); }
        });
    });

    function closeAllLists(elmnt){
        document.querySelectorAll(".autocomplete-items").forEach(list=>{
            if(elmnt && list.parentNode.contains(elmnt) && elmnt==list.previousSibling) return;
            if(list.parentNode) list.parentNode.removeChild(list);
        });
    }

    document.addEventListener("click", e=>{ closeAllLists(e.target); });

    function submitLocations(){
        const values = Array.from(document.querySelectorAll('.locationInput')).map(i=>i.value);
        alert("Selected or typed locations: " + values.join(", "));
    }
        document.addEventListener('DOMContentLoaded', function () {

            const dropLocal = @json(request('drop_local'));

            if (dropLocal) {

                const $select = $('#local-drop');
                if ($select.find(`option[value="${dropLocal}"]`).length === 0) {
                    // Create new option
                    $select.append(
                        `<option value="${dropLocal}" selected>${dropLocal}</option>`
                    );
                } else {
                    // Select existing option
                    $select.val(dropLocal);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const checked = document.querySelector('input[name="cabtripType"]:checked');
            if (checked) checked.dispatchEvent(new Event('change'));
        });




</script>
@endpush
