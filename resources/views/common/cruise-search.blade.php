<div class="andaman-search-container position-relative mt-0 pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="search-wrapper ">
                    <div class="search-navigation d-flex align-items-center border-bottom mb-0">
                        <div class="nav-tabs-wrapper d-flex flex-grow-1 overflow-x-auto justify-content-center">
                            @php
                            use App\Models\BoatTrips;
                           $trips = Cache::remember('boatTrips', now()->addMinutes(10), fn() => BoatTrips::all());

                            $rossTrip = $trips->filter(function ($trip) {
                                return strtolower($trip->location) === 'ross island northbay';
                            })->values();

                            $elephantTrip = $trips->filter(function ($trip) {
                                return strtolower($trip->location) === 'elephanta beach';
                            })->values();

                            $searchTypes = [
                            [
                            'label' => 'inter-island',
                            'icon' => 'fa-ship',
                            'route' => 'ferry-booking',
                            'action' => 'ferry-booking',
                            ],
                            [
                            'label' => 'ross-and-northbay',
                            'icon' => 'fa-sailboat',
                            'route' => 'boat-trips/ross-island-northbay-booking',
                            'action' => 'boat-trip-checkout',
                            ],
                            [
                            'label' => 'elephant-beach',
                            'icon' => 'fa-sailboat',
                            'route' => 'boat-trips/elephanta-beach-booking',
                            'action' => 'boat-trip-checkout',
                            ],
                            ];
                            $activeIndex = -1;
                            foreach ($searchTypes as $i => $type) {
                            if (request()->is($type['route'])) {
                            $activeIndex = $i;
                            break;
                            }
                            }
                            if ($activeIndex > -1) {
                            $active = $searchTypes[$activeIndex];
                            unset($searchTypes[$activeIndex]);
                            $searchTypes = array_values($searchTypes);
                            array_unshift($searchTypes, $active);
                            }
                            $activeFound = $activeIndex > -1;
                            @endphp
                            @foreach ($searchTypes as $type)
                            <button
                                class="nav-tab {{ request()->is($type['route']) || (!$activeFound && $loop->first) ? 'active' : '' }}"
                                data-target="{{ strtolower($type['label']) }}-search">
                                <i class="fas {{ $type['icon'] }}"></i>
                                <span>{{ ucwords(str_replace('-',' ',$type['label'])) }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="search-content-panels p-3">
                        @foreach ($searchTypes as $type)
                        <div
                            class="search-panel {{ strtolower($type['label']) }}-search {{ request()->is($type['route']) || (!$activeFound && $loop->first) ? 'active' : '' }}">
                            <form class="" method="GET" action="{{ url(strtolower($type['action'])) }}" id="SearchForm">
                                <div class="row g-3">
                                    @switch(strtolower($type['label']))
                                    @case('inter-island')
                                    <div class="d-flex ferry-search" id="tripTabs" role="tablist"
                                        aria-label="Trip Type Tabs">
                                        <div class="form-check mx-1">
                                            <input class="form-check-input" type="radio" name="tripType[]"
                                                id="oneWay-tab" value="one" checked>
                                            <label class="form-check-label" aria-labelledby="oneWay-tab"
                                                for="oneWay-tab" data-bs-toggle="tab"
                                                data-bs-target="#OneWay"><i class="fa-solid fa-arrow-up"></i> One Way</label>
                                        </div>
                                        <div class="form-check mx-1">
                                            <input class="form-check-input" type="radio" name="tripType[]"
                                                id="multiTrip-tab" value="multi">
                                            <label class="form-check-label" aria-labelledby="multiTrip-tab"
                                                for="multiTrip-tab" data-bs-toggle="tab"
                                                data-bs-target="#MultiTrip"><i class="fa-solid fa-up-down"></i> Multi Way</label>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-3" id="cruiseTabContent">
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
                                                            value=""
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
                                                                            <label
                                                                                class="form-label">Children</label>
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
                                            $mfrom = request('mfrom', $fromOptions);
                                            $mto = request('mto', $toOptions);
                                            $mdeparture = request('mdeparture', []);
                                            $madult = request('madult', [1]);
                                            $mchild = request('mchild', [0]);
                                            @endphp
                                            @foreach (range(0, 2) as $index)
                                            <div class="row g-3 mb-1 mb-0">
                                                <div class="col-12 col-lg-3">
                                                    <div class="form-floating">
                                                        <select class="form-select select2-input rounded-0"
                                                            name="mfrom[]" required>
                                                            <option value="" disabled>Select From
                                                            </option>
                                                            @foreach ($fromOptions as $from)
                                                            <option value="{{ $from }}"
                                                                {{ (is_array($mfrom) && isset($mfrom[$index]) && $mfrom[$index] == $from) ? 'selected' : '' }}>
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
                                                                {{ (is_array($mto) && isset($mto[$index]) && $mto[$index] == $to) ? 'selected' : '' }}>
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
                                                            name="mdeparture[]" required readonly
                                                            value="{{ is_array($mdeparture) ? $mdeparture[$index] ?? '' : '' }}">
                                                        <label>Departure Date</label>
                                                    </div>
                                                </div>
                                                @if ($index == 0)
                                                <div class="col-12 col-lg-3">
                                                    <div
                                                        class="form-floating traveler-selection-container">
                                                        @php
                                                        $madultValue = is_array($madult) ? $madult[0] ?? 1 : $madult ?? 1;
                                                        $mchildValue = is_array($mchild) ? $mchild[0] ?? 0 : $mchild ?? 0;
                                                        @endphp
                                                        <input type="text"
                                                            value=""
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
                                                                                    value="{{ $madultValue }}"
                                                                                    min="1"
                                                                                    readonly>
                                                                                <button
                                                                                    class="btn btn-sm adult-plus"
                                                                                    type="button">+</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label
                                                                                class="form-label">Children</label>
                                                                            <div
                                                                                class="input-group my-1 justify-content-center">
                                                                                <button
                                                                                    class="btn btn-sm child-minus"
                                                                                    type="button">-</button>
                                                                                <input type="number"
                                                                                    name="mchild[]"
                                                                                    class="form-control text-center child-count"
                                                                                    value="{{ $mchildValue }}"
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
                                    @case('ross-and-northbay')
                                    @php
                                    $adult = request('adult', 1);
                                    $child = request('child', 0);
                                    @endphp
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating">
                                            <select
                                                class="form-control rounded-0 border-dark-subtle"
                                                id="trip_to" placeholder="Trip To"
                                                name="trip_to" required
                                                value="{{ request('location', '') }}">
                                                <option value="">Select Trip</option>
                                                @foreach($rossTrip as $trip)
                                                <option value="{{$trip->name}}">{{$trip->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="trip_to">Trip To</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control datepicker position-relative rounded-0 border-dark-subtle"
                                                id="ross-date" name="checkin" placeholder="Activity Date"
                                                value="{{ request('checkin', '') }}" required readonly>
                                            <label for="ross-date">Date</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating">
                                           <select name="depart" class="form-control rounded-0 border-dark-subtle" id="ross_depart" required>
                                            <option value="">Select Time</option>
                                           </select>
                                            <label for="ross_trip_to">Depart Time</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating traveler-selection-container">
                                            <input type="text"
                                                value=""
                                                class="form-control shadow-none border-dark-subtle rounded-0"
                                                placeholder="Select Travelers" readonly>
                                            <div class="traveler-dropdown-form">
                                                <div class="card mt-2">
                                                    <div class="card-body p-0">
                                                        <div class="row gx-1 pb-1">
                                                            <div class="col-6">
                                                                <label class="form-label">Adults</label>
                                                                <div class="input-group my-1 justify-content-center">
                                                                    <button class="btn btn-sm adult-minus" type="button">-</button>
                                                                    <input type="number" name="adult"
                                                                        class="form-control text-center adult-count"
                                                                        value="1" min="1" readonly>
                                                                    <button class="btn btn-sm adult-plus" type="button">+</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label">Infant <span style="color: red; font-size:10px;">Age (0-3 Yr's)</span></label>
                                                                <div class="input-group my-1 justify-content-center">
                                                                    <button class="btn btn-sm child-minus" type="button">-</button>
                                                                    <input type="number" name="child"
                                                                        class="form-control text-center child-count"
                                                                        value="0" min="0" readonly>
                                                                    <button class="btn btn-sm child-plus" type="button">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span role="button" class="btn btn-primary btn-sm w-100 save-travelers justify-content-center">Apply</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <label>Travellers</label>
                                        </div>
                                    </div>
                                    @break
                                    @case('elephant-beach')
                                    @php
                                    $adult = request('adult', 1);
                                    $child = request('child', 0);
                                    @endphp
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating">
                                            <select
                                                class="form-control rounded-0 border-dark-subtle"
                                                id="trip_to" placeholder="Trip To"
                                                name="trip_to" required
                                                value="{{ request('location', '') }}">
                                                <option value="">Select Trip</option>
                                                @foreach($elephantTrip as $trip)
                                                <option value="{{$trip->name}}">{{$trip->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="trip_to">Trip To</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control datepicker position-relative rounded-0 border-dark-subtle"
                                                id="ele-date" name="checkin" placeholder="Activity Date"
                                                value="{{ request('checkin', '') }}" required readonly>
                                            <label for="ele-date">Date</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating">
                                           <select name="depart" class="form-control rounded-0 border-dark-subtle" id="ele_depart" required>
                                            <option value="">Select Time</option>
                                           </select>
                                            <label for="ross_trip_to">Depart Time</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="form-floating traveler-selection-container">
                                            <input type="text"
                                                value=""
                                                class="form-control shadow-none border-dark-subtle rounded-0"
                                                placeholder="Select Travelers" readonly>
                                            <div class="traveler-dropdown-form">
                                                <div class="card mt-2">
                                                    <div class="card-body p-0">
                                                        <div class="row gx-1 pb-1">
                                                            <div class="col-6">
                                                                <label class="form-label">Adults</label>
                                                                <div class="input-group my-1 justify-content-center">
                                                                    <button class="btn btn-sm adult-minus" type="button">-</button>
                                                                    <input type="number" name="adult"
                                                                        class="form-control text-center adult-count"
                                                                        value="1" min="1" readonly>
                                                                    <button class="btn btn-sm adult-plus" type="button">+</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label">Infant <span style="color: red; font-size:10px;">Age (0-3 Yr's)</span></label>
                                                                <div class="input-group my-1 justify-content-center">
                                                                    <button class="btn btn-sm child-minus" type="button">-</button>
                                                                    <input type="number" name="child"
                                                                        class="form-control text-center child-count"
                                                                        value="0" min="0" readonly>
                                                                    <button class="btn btn-sm child-plus" type="button">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span role="button" class="btn btn-primary btn-sm w-100 save-travelers justify-content-center">Apply</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <label>Travellers</label>
                                        </div>
                                    </div>
                                    @break
                                    @default
                                    <div class="col-12 text-center">
                                        <p class="text-muted">Coming Soon</p>
                                    </div>
                                    @endswitch
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-md search-submit">
                                            Search {{ Str::replace('-',' ',$type['label']) }}
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

    .ferry-search input[type="radio"]:checked+label {
        background-color: #FF5722;
        color: #fff;
    }
</style>
@endpush
@push('scripts')
<script>
    $(function() {

        let $tabs = $('.nav-tab');
        let $panels = $('.search-panel');
        let activeTab = $('.nav-tab.active');

        if (activeTab.length) {
            activeTab.parent().prepend(activeTab);
        }

        $tabs.on('click', function() {
            $tabs.removeClass('active');
            $panels.removeClass('active');
            $(this).addClass('active');
            $('.' + $(this).data('target')).addClass('active');
            let tabName = $(this).find('span').text().trim();            
            $(this).parent().prepend($(this));
            setTimeout(initDatepickers, 100);  
        });



        var today = new Date();
        if (!$('#datepicker-backdrop').length) {
            $('body').append('<div id="datepicker-backdrop" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:998;"></div>');
        }

        function showBackdrop() {
            $('body').addClass('no-scroll');
            $('#datepicker-backdrop').fadeIn(200);
        }

        function hideBackdrop() {
            $('body').removeClass('no-scroll');
            $('#datepicker-backdrop').fadeOut(200);
        }

        function initDatepickers() {
            $('.datepicker').each(function() {
                $(this).datepicker('destroy');
                var minDate = today;
                if ($(this).closest('#MultiTrip').length) {
                    var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
                    var idx = rows.index($(this).closest('.row.g-3'));
                    if (idx > 0) {
                        var prevDate = rows.eq(idx - 1).find('.datepicker').first().datepicker('getDate');
                        if (prevDate) {
                            minDate = new Date(prevDate.getTime());
                            minDate.setDate(minDate.getDate() + 1);
                        }
                    }
                }
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: minDate,
                    changeMonth: true,
                    changeYear: true,
                    showAnim: 'fadeIn',
                    beforeShow: showBackdrop,
                    onClose: hideBackdrop,
                    onSelect: function() {
                        if ($(this).closest('#MultiTrip').length) {
                            var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
                            var idx = rows.index($(this).closest('.row.g-3'));
                            if (idx + 1 < rows.length) {
                                var next = rows.eq(idx + 1).find('.datepicker').first();
                                var selDate = $(this).datepicker('getDate');
                                if (selDate) {
                                    var newMin = new Date(selDate.getTime());
                                    newMin.setDate(newMin.getDate() + 1);
                                    next.datepicker('option', 'minDate', newMin);
                                    var nextDate = next.datepicker('getDate');
                                    if (nextDate && nextDate < newMin) next.val('');
                                }
                            }
                        }
                    }
                });
            });
        }
        initDatepickers();
        var deletedTrips = [];
        $(document).on('click', '.remove-trip', function() {
            var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
            if (rows.length > 1) {
                var row = $(this).closest('.row.g-3');
                deletedTrips.push({
                    index: rows.index(row),
                    html: row.prop('outerHTML')
                });
                row.remove();
                initDatepickers();
            }
            if ($('#MultiTrip').closest('.tab-pane').find('.row.g-3').length === 1) $('#oneWay-tab').trigger('click');
        });
        $('input[name="tripType[]"]').on('change', function() {
            $('#cruiseTabContent .tab-pane').removeClass('show active');
            if (this.id === 'oneWay-tab') $('#OneWay').addClass('show active');
            else if (this.id === 'multiTrip-tab') {
                $('#MultiTrip').addClass('show active');
                if (deletedTrips.length) {
                    var rows = $('#MultiTrip').closest('.tab-pane').find('.row.g-3');
                    deletedTrips.sort((a, b) => a.index - b.index).forEach(t => rows.length > t.index ? $(rows[t.index]).before(t.html) : $('#MultiTrip').closest('.tab-pane').append(t.html));
                    deletedTrips = [];
                    initDatepickers();
                }
            }
        });
        // Traveler handlers
        $(document).on('click', '.adult-plus', function() {
            var $input = $(this).siblings('.adult-count');
            $input.val(parseInt($input.val()));
            updateTravelerSummary($input.closest('.traveler-dropdown-form'));
        });
        $(document).on('click', '.adult-minus', function() {
            var $input = $(this).siblings('.adult-count');
            if (parseInt($input.val()) > 1) {
                $input.val(parseInt($input.val()) );
                updateTravelerSummary($input.closest('.traveler-dropdown-form'));
            }
        });
        $(document).on('click', '.child-plus', function() {
            var $input = $(this).siblings('.child-count');
            $input.val(parseInt($input.val()));
            updateTravelerSummary($input.closest('.traveler-dropdown-form'));
        });
        $(document).on('click', '.child-minus', function() {
            var $input = $(this).siblings('.child-count');
            if (parseInt($input.val()) > 0) {
                $input.val(parseInt($input.val()) );
                updateTravelerSummary($input.closest('.traveler-dropdown-form'));
            }
        });

        function updateTravelerSummary($dropdown) {
            var $summary = $dropdown.closest('.traveler-selection-container').find('input[type="text"]');
            var adult = $dropdown.find('.adult-count').val();
            var child = $dropdown.find('.child-count').val();
            $summary.val(adult + ' Adult, ' + child + ' Child');
        }
        $(document).on('click', '.save-travelers', function() {
            updateTravelerSummary($(this).closest('.traveler-dropdown-form'));
            $(this).closest('.traveler-dropdown-form').hide(); // Assuming dropdown hides on save
        });
        // Show dropdown on focus
        $('.traveler-selection-container input[type="text"]').on('focus', function() {
            $(this).next('.traveler-dropdown-form').show();
        });
        $('form').on('submit', function(e) {
            e.preventDefault();
            let $form = $(this),
                valid = true;
            $form.find('input[required]:visible, select[required]:visible').each(function() {
                if (!$(this).val()) {
                    valid = false;
                    $(this).focus();
                    return false;
                }
            });
            if (valid) {
                $form.off('submit').submit();
            }
        });

    $(document).on('change', 'select[name="trip_to"]', function() {
    let activeTabName = $('.nav-tab.active span').text().trim();
    let tabname, selectId;

    let tripTo = $(this).val();
    console.log("Selected tripTo:", tripTo);

    switch (activeTabName) {
        case 'Ross And Northbay':
            tabname = 'ross-north';
            selectId = '#ross_depart';
            break;
        case 'Elephant Beach':
            tabname = 'elephanta-beach';
            selectId = '#ele_depart';
            break;
        default:
            console.warn("No matching tab found");
            return;
    }

    $.ajax({
        url: "{{ route('boat-locations') }}",
        method: "GET",
        data: {
            tab: tabname,      // ✅ use tabname for location
            trip_to: tripTo    // ✅ send tripTo separately if needed
        },
        dataType: "json",
        success: function(response) {
            if (response.timings && response.timings.length > 0) {
                const $select = $(selectId);
                $select.empty().append(`<option value="">Select Time</option>`);
                response.timings.forEach(time => {
                    const [hour, minute] = time.split(':');
                    let h = parseInt(hour, 10);
                    const ampm = h >= 12 ? 'PM' : 'AM';
                    h = h % 12 || 12;
                    const formatted = `${h}:${minute} ${ampm}`;
                    $select.append(`<option value="${time}">${formatted}</option>`);
                });
            }
        },
        error: function() {
            console.error("Error loading timings");
        }
    });
});


    });
   
</script>
@endpush