@extends('admin.layouts.app')

@section('title', __('Tour'))

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <h1>{{ __('Tour') }}</h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="page-header float-right">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></li>
                            <li><a href="{{ url('admin/tours') }}">{{ __('Tour') }}</a></li>
                            <li class="active">{{ __('Package Itinerary') }}</li>
                        </ol>
                    </div>
                </div>
                <div class="col-sm-2">
                    <a href="{{ url('admin/tours') }}" class="btn btn-info float-right my-2 mx-3">
                        <i class="fa fa-undo fa-lg"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            @include('admin.layouts.alert')
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <strong class="card-title">{{ $tour ? __('Edit') : __('New') }}</strong>
                    </div>
       <form name="package-info"
      @if ($tour) action="{{ route('admin.tours.itinerary', ['tourId' => $tour->id, 'category' => 'premium']) }}"
      method="POST" @else action="#" method="POST" @endif
      id="form" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if ($tour)
        @method('PUT')
    @endif

    <div class="card-body">
        <div class="row g-3 justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="package_name" class="form-label">{{ __('Package Name') }} <span style="color:red;">*</span></label>
                    <input type="text" id="package_name" name="package_name" class="form-control"
                           placeholder="e.g., 3N/4D Andaman Adventure"
                           value="{{ old('package_name', $tour->package_name ?? '') }}"
                           readonly="readonly">
                    @error('package_name')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="duration" class="form-label">{{ __('Duration (Nights/Days)') }} <span style="color:red;">*</span></label>
                    <input type="text" id="duration" name="duration" class="form-control"
                           placeholder="e.g., 3 Nights / 3 Days"
                           value="{{ ($tour->nights ?? 0) . ' Nights / ' . ($tour->days ?? 0) . ' Days' }}"
                           readonly="readonly">
                    @error('duration')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
         
            <div class="col-md-3">
                <div class="form-group">
                    <label for="num_guests" class="form-label" hidden>{{ __('Number of Guests') }} <span style="color:red;">*</span></label>
                    <input type="number" id="num_guests" name="num_guests" class="form-control"
                           placeholder="e.g., 2" value="{{ old('num_guests', $tour->num_guests ?? 1) }}"
                           min="1" step="1" required readonly hidden>
                    @error('num_guests')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <h3 class="h5 text-dark mb-2">Itinerary</h3>
            </div>
            <div id="accordionDays">

            @for ($day = 0; $day < $tour['days']; $day++)
                <div class="col-md-12">
                    <div class="card day-entry" data-day="{{ $day }}">
                        <div class="card-header">
                           <h5 class="mb-0">
                <button class="btn btn-link text-left text-decoration-none " type="button" data-toggle="collapse" data-target="#collapseDay{{ $day }}" aria-expanded="{{ $day == 0 ? 'true' : 'false' }}" aria-controls="collapseDay{{ $day }}">
                    Day {{ $day + 1 }}
                </button>
            </h5>
                        </div>
                                <div id="collapseDay{{ $day }}" class="collapse {{ $day == 0 ? 'show' : '' }}" aria-labelledby="headingDay{{ $day }}" data-parent="#accordionDays">

                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label">Title</label>
                                <input type="text" class="day-title form-control"
                                       name="itinerary[{{ $day }}][title]"
                                       placeholder="e.g., {{ $day == 0 ? 'Arrival at Port Blair' : ($day == 1 ? 'Havelock Island – Radhanagar Beach' : 'Neil Island – Bharatpur Beach') }}"
                                       value="{{ old("itinerary.$day.title", isset($touritinerary[$day]) ? $touritinerary[$day]['title'] : '') }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Description</label>
                                <div class="day-description quill-editor" data-day="{{ $day }}" style="height: 120px;"></div>
                                <input type="hidden" class="day-description-hidden"
                                       name="itinerary[{{ $day }}][description]"
                                       value="{{ old("itinerary.$day.description", isset($touritinerary[$day]) ? $touritinerary[$day]['description'] : '') }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <i class="fa fa-map-marker fs-3 me-2" aria-hidden="true"></i>
                                        <label for="service_location_{{ $day }}" class="form-label">{{ __('Service Location') }} <span style="color:red;">*</span></label>
                                        <select id="service_location_{{ $day }}" class="service-location form-control"
                                                name="itinerary[{{ $day }}][service_location]" data-day="{{ $day }}">
                                            @foreach ($Servicelocations as $value)
                                                @php
                                                    $isSelected = old("itinerary.$day.service_location", $touritinerary[$day]['service_location'] ?? '') == $value;
                                                @endphp
                                                <option value="{{ $value }}" {{ $isSelected ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("itinerary.$day.service_location")
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="service_{{ $day }}" class="form-label">{{ __('Service') }} <span style="color:red;">*</span></label>
                                        <select id="service_{{ $day }}" class="service form-control"
                                                name="itinerary[{{ $day }}][service]">
                                            @foreach ($services as $service)
                                                @php
                                                    $service_location = (!empty($service->transfer) && $service->transfer !== '-' && strtolower($service->transfer) !== 'null')
                                                        ? $service->service_location . ' - to - ' . $service->transfer
                                                        : $service->service_location;
                                                @endphp
                                                <option
                                                    data-location="{{ $service_location }}"
                                                    data-service-cost="{{ $service->six_seater_xylo_ertiga }}"
                                                    value="{{ $service->id }}"
                                                    {{ old("itinerary.$day.service", isset($touritinerary[$day]) ? $touritinerary[$day]['service'] : '') == $service->id ? 'selected' : '' }}>
                                                    {{ $service->service }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("itinerary.$day.service")
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3">
                      @if ($day < $tour['days'] - 1)
                            <div class="accomodation mb-2">
                                <i class="fa fa-bed fs-2 me-2" aria-hidden="true"></i>
                                <label for="accomodation_{{ $day }}">Accomodation Location <span style="color:red;">*</span></label>
                                <div class="form-group">
                                    <select name="itinerary[{{ $day }}][accomodation]" class="accomodation-location form-control" id="accomodation_{{ $day }}" data-day="{{ $day }}">
                                        <option value="">Select Accomodation Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location }}"
                                                    {{ old("itinerary.$day.accommodation", isset($touritinerary[$day]) ? $touritinerary[$day]['accommodation'] : '') == $location ? 'selected' : '' }}>
                                                {{ $location }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("itinerary.$day.accomodation")
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            

                            <div class="d-flex flex-wrap">
                            @foreach ($tour->subCategories as $categories)
                            <div class="card rounded-0 col-4">
                                <div class="card-title">{{ $categories->name }}</div>
                                <div class="accomodation mb-2">
                                    <i class="fa fa-bed fs-2 me-2" aria-hidden="true"></i>
                                    <label for="accomodation_name_{{ $day }}_{{ $categories->id }}">{{ $categories->name }} Accomodation Preference <span style="color:red;">*</span></label>
                                    <div class="form-group">
                                        <select multiple name="itinerary[{{ $day }}][accomodation_name][{{ $categories->id }}][]" class="accomodation-name form-control" id="accomodation_name_{{ $day }}_{{ $categories->id }}" data-day="{{ $day }}" data-subcategory="{{ $categories->id }}">
                                            <option value="">Select Accommodations (up to 3)</option>
                                            @if (isset($accomodation) && !empty($accomodation))
                                                @foreach ($accomodation as $acc)
                                                    @php
                                                        $raw = $touritinerary[$day]['accomodation_name'] ?? [];
                                                        if (is_string($raw)) {
                                                            $raw = json_decode($raw, true) ?: [];
                                                        }
                                                        $selectedHotelsForCategory = [];
                                                        if (is_array($raw) && isset($raw[$categories->id])) {
                                                            $selectedHotelsForCategory = (array) $raw[$categories->id];
                                                        }
                                                        $selectedHotelsForCategory = array_values(array_filter($selectedHotelsForCategory));
                                                        $isSelected = in_array($acc->hotel_code, $selectedHotelsForCategory);
                                                    @endphp

                                                    <option value="{{ $acc->hotel_code }}"
                                                            data-location="{{ $acc->city_name }}"
                                                            {{ $isSelected ? 'selected' : '' }}>
                                                        {{ $acc->hotel_name }} {{ $acc->hotel_rating .'⭐' ?? 'N/A' }} ({{ $acc->city_name ?? 'N/A' }})
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error("itinerary.$day.accomodation_name.{$categories->id}")
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </div>
                            <hr class="my-3">
                        @endif
                            <div class="activities mb-2">
                                <label class="form-label">Activities</label>
                                <div class="form-group w-25 mb-2">
                                    <label for="activity_service_location_{{ $day }}" class="form-label">{{ __('Activity Location') }} <span style="color:red;">*</span></label>
                                    <select id="activity_service_location_{{ $day }}" class="activity-service-location form-service_locationcontrol"
                                            name="itinerary[{{ $day }}][activity_service_location]" data-day="{{ $day }}">
                                        @foreach ($activityLocation as $location)
                                            <option value="{{ $location }}"
                                                    {{ old("itinerary.$day.activity_service_location", isset($touritinerary[$day]) ? $touritinerary[$day]['activity_location'] : '') == $location ? 'selected' : '' }}>
                                                {{ $location }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("itinerary.$day.activity_service_location")
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="activity-list" style="{{ empty($touritinerary[$day]['activities']) ? 'display: none;' : '' }}">
                                    @if (isset($touritinerary[$day]) && !empty($touritinerary[$day]['activities']))
                                        @foreach ($touritinerary[$day]['activities'] as $index => $activity)
                                            <div class="activity-entry row mb-1">
                                                <div class="col-md-8">
                                                    <i class="fa fa-binoculars" aria-hidden="true"></i>
                                                    <label for="activity_name_{{ $day }}_{{ $index }}">Select Activity</label>
                                                    <select name="itinerary[{{ $day }}][activities][{{ $index }}][name]"
                                                            id="activity_name_{{ $day }}_{{ $index }}" class="activity form-control">
                                                        @foreach ($activities as $act)
                                                            <option value="{{ $act->id }}"
                                                                    data-location="{{ $act->location }}"
                                                                    data-price="{{ $act->adult_cost }}"
                                                                    {{ $activity['activity_id'] == $act->id ? 'selected' : '' }}>
                                                                {{ $act->service_name }} - {{ $act->location }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error("itinerary.$day.activities.$index.name")
                                                        <label class="error">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="activity_cost_{{ $day }}_{{ $index }}">Adult Cost/ per</label>
                                                    <input type="number" class="activity-price form-control"
                                                           name="itinerary[{{ $day }}][activities][{{ $index }}][price]"
                                                           placeholder="Price"
                                                           value="{{ old("itinerary.$day.activities.$index.price", $activity['price']) }}"
                                                           min="0" step="0.01">
                                                    @error("itinerary.$day.activities.$index.price")
                                                        <label class="error">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="remove-activity btn btn-sm btn-outline-danger mt-4">Remove</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="add-activity btn btn-sm btn-outline-primary mt-1">Add Activity</button>
                            </div>
                            <div class="transfers mb-2">
                                <i class="fa fa-ship" aria-hidden="true"></i>
                                <label class="form-label">Transfers (Ferry)</label>
                                <div class="transfer-list" style="{{ empty($touritinerary[$day]['transfers']) ? 'display: none;' : '' }}">
                                    @if (isset($touritinerary[$day]) && !empty($touritinerary[$day]['transfers']))
                                        @foreach ($touritinerary[$day]['transfers'] as $index => $transfer)
                                            <div class="transfer-entry row mb-1">
                                                <div class="col-12 d-flex flex-wrap">
                                                    <div class="col-md-4">
                                                        <select class="from-location form-control"
                                                                name="itinerary[{{ $day }}][transfers][{{ $index }}][from]">
                                                            @foreach ($fromLocations as $frmlocation)
                                                                <option value="{{ $frmlocation }}"
                                                                        {{ $transfer['from'] == $frmlocation ? 'selected' : '' }}>
                                                                    {{ $frmlocation }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error("itinerary.$day.transfers.$index.from")
                                                            <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="to-location form-control"
                                                                name="itinerary[{{ $day }}][transfers][{{ $index }}][to]">
                                                            @foreach ($toLocations as $tolocation)
                                                                <option value="{{ $tolocation }}"
                                                                        {{ $transfer['to'] == $tolocation ? 'selected' : '' }}>
                                                                    {{ $tolocation }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error("itinerary.$day.transfers.$index.to")
                                                            <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-wrap mt-1">
                                                    <div class="col-md-3">
                                                        <label for="itinerary[{{ $day }}][transfers][${{ $index }}][ferry]">Transfer Ferry</label>
                                                        <select class="ferry form-control"
                                                                name="itinerary[{{ $day }}][transfers][{{ $index }}][ferry]">
                                                            @foreach ($ferries as $ferry)
                                                                <option value="{{ $ferry->id }}"
                                                                        {{ $transfer['ferry_id'] == $ferry->id ? 'selected' : '' }}>
                                                                    {{ $ferry->ferry_name }} - {{ $ferry->class_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error("itinerary.$day.transfers.$index.ferry")
                                                            <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="transfer_time_{{ $day }}_{{ $index }}">Transfer Time</label>
                                                        <input type="time" class="transfer-time form-control"
                                                               name="itinerary[{{ $day }}][transfers][{{ $index }}][time]"
                                                               placeholder="e.g., 09:00"
                                                               value="{{ old("itinerary.$day.transfers.$index.time", $transfer['time'] ?? '') }}">
                                                        @error("itinerary.$day.transfers.$index.time")
                                                            <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="transfer_price_{{ $day }}_{{ $index }}">Price</label>
                                                        <input type="number" class="transfer-price form-control"
                                                               name="itinerary[{{ $day }}][transfers][{{ $index }}][price]"
                                                               placeholder="Price"
                                                               value="{{ old("itinerary.$day.transfers.$index.price", $transfer['price']) }}"
                                                               min="0" step="0.01" readonly>
                                                        @error("itinerary.$day.transfers.$index.price")
                                                            <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="remove-transfer btn btn-sm btn-outline-danger mt-4">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="add-transfer btn btn-sm btn-outline-primary mt-1">Add Transfer</button>
                            </div>
                        </div>
                    </div>
                        <div class="card-footer pricing-section">
                            <h5 class="mb-2">Price Breakup (Day {{ $day + 1 }})</h5>
                            <div class="row">
                                <div class="col-6 col-md-3"><strong>Cab Cost:</strong> <span id="service-cost-{{ $day }}">₹0.00</span></div>
                                <div class="col-6 col-md-3"><strong>Entry Tickets:</strong> <span id="activity-cost-{{ $day }}">₹0.00</span></div>
                                <div class="col-6 col-md-3"><strong>Ferries Cost:</strong> <span id="transfer-cost-{{ $day }}">₹0.00</span></div>
                                <div class="col-6 col-md-3"><strong>Total Day Cost:</strong> <span id="day-total-{{ $day }}">₹0.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
    </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Estimated Package Cost</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>Cab Total:</strong> <span id="total-service">₹0.00</span></p>
                        <p><strong>Activity Total:</strong> <span id="total-activity">₹0.00</span></p>
                        <p><strong>Ferry Transfer Cost:</strong> <span id="total-transfer">₹0.00</span></p>
                        <p><strong>Base Total:</strong> <span id="base-total">₹0.00</span></p>
                    </div>
       
                </div>
            </div>
            <div class="col-md-12">
                <input type="hidden" name="itinerary" id="itinerary">
                <input type="hidden" name="final_total" id="final_total">
            </div>
            <div class="col-md-2">
                <button type="submit" name="submit" id="submit" class="btn btn-block btn-success my-1">
                    <i class="fa fa-floppy-o fa-lg"></i> {{ __('Save') }}
                </button>
            </div>
            <div class="col-md-2">
                <button type="reset" name="reset" id="reset" class="btn btn-block btn-outline-danger my-1">
                    <i class="fa fa-refresh fa-lg"></i> {{ __('Reset') }}
                </button>
            </div>
        </div>
    </div>
</form>
                </div>

               @include('admin.tours.navigation');
            </div>
        </div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
        }

        .quill-editor {
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .ql-container {
            font-size: 1rem;
        }

        .ql-editor {
            min-height: 100px;
        }

        .card {
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card {
            border: 1px solid #dee2e6;
        }

        .card-body {
            padding: 0.75rem;
        }

        .form-group {
            margin-bottom: 0.5rem;
        }

        .activity-entry,
        .transfer-entry {
            margin-bottom: 0.25rem;
        }

        .pricing-section {
            border-top: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
        }

        .pricing-section h5 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .pricing-section .row>div,
        .pricing-section p {
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .quill-editor {
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .ql-container {
            font-size: 0.95rem;
        }

        .ql-editor {
            min-height: 100px;
        }

        .select2-container .select2-selection--single {
            height: 32px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px !important;
        }

        .pricing-section {
            border-left: 2px solid #dee2e6;
            padding-left: 1.5rem;
            border-radius: 0.25rem;
        }

        .pricing-section h5 {
            font-size: 1.1rem;
            color: #343a40;
        }

        .pricing-section p {
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .activity-entry,
        .transfer-entry {
            align-items: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .add-activity,
        .add-transfer {
            margin-top: 0.5rem;
        }

        @media (max-width: 767px) {
            .pricing-section {
                border-left: none;
                border-top: 2px solid #dee2e6;
                padding-top: 1rem;
                margin-top: 1rem;
            }
        }

        .transfer-entry>.col-12 {
            padding: 0px;

        }

        .transfer-entry {
            padding-bottom: 15px;
        }

        .card.day-entry {
    width: 100%;
}

.card-footer.pricing-section {
    width: 100%;
}

.accordion .card-header {
    width: 100%;
}
.card-header .btn {
    width: 100%;
    text-align: left;
}
#accordionDays{
    width: 100% !important;
}
    </style>
@endsection
@section('script')
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
   <script>
 $(document).ready(function() {
    const ferries = @json($ferries);
    const activities = @json($activities);
    const accomodation = @json($accomodation ?? []);
    const touritinerary = @json($touritinerary);
    const subCategoryIds = @json($tour->subCategories->pluck('id')->toArray());

    // Quill editor initialization
    const quillConfig = {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['link'],
                ['clean']
            ]
        },
        placeholder: 'Enter description here...'
    };

    $('.day-description').each(function() {
        const day = $(this).data('day');
        const quill = new Quill(this, quillConfig);
        const hiddenInput = $(this).siblings('.day-description-hidden');
        quill.root.innerHTML = hiddenInput.val();
        quill.on('text-change', () => hiddenInput.val(quill.root.innerHTML));
    });

    // Choices.js configuration
    const choicesConfig = {
        removeItemButton: true,
        placeholderValue: 'Select an option',
        searchEnabled: true,
        searchFloor: 2,
        noResultsText: 'No options found.'
    };

    const multiSelectConfig = {
        ...choicesConfig,
        maxItemCount: 3,
        maxItemText: (maxItemCount) => `You can only select up to ${maxItemCount} accommodations.`
    };

    // Initialize Choices.js and store instance
    function initializeChoices($select, isMulti = false) {
        if ($select[0].choices) {
            $select[0].choices.destroy();
        }
        $select[0].choices = new Choices($select[0], isMulti ? multiSelectConfig : choicesConfig);
        return $select[0].choices;
    }

    // Initialize all select elements
    $('.service-location, .service, .from-location, .to-location, .activity-service-location, .ferry, .activity')
        .each(function() {
            initializeChoices($(this));
        });
    $('.accomodation-location, .accomodation-name').each(function() {
        initializeChoices($(this), $(this).hasClass('accomodation-name'));
    });

    // Handle Accommodation Location change
    $('.accomodation-location').each(function() {
        const day = $(this).data('day');
        const $allAccomodationSelects = $(`.accomodation-name[data-day="${day}"]`);
        const $allAccomodationOptions = {};
        $allAccomodationSelects.each(function() {
            const subcategoryId = $(this).data('subcategory');
            $allAccomodationOptions[subcategoryId] = $(this).find('option').clone();
        });

        $(this).on('change', function() {
            const selectedLocation = $(this).val();
            $allAccomodationSelects.each(function() {
                const subcategoryId = $(this).data('subcategory');
                const $select = $(this);
                const currentValues = $select.val() || [];
                const filteredOptions = $allAccomodationOptions[subcategoryId].filter(function() {
                    const optionLocation = $(this).data('location')?.toString().trim().toLowerCase() || '';
                    const selected = selectedLocation?.toString().trim().toLowerCase() || '';
                    return optionLocation.includes(selected) || selected.includes(optionLocation);
                });

                $select.empty().append('<option value="">Select Accommodations (up to 3)</option>').append(filteredOptions);
                initializeChoices($select, true);
                const validValues = currentValues.filter(val => filteredOptions.filter(`[value="${val}"]`).length > 0);
                if (validValues.length > 0) {
                    $select.val(validValues);
                    if ($select[0].choices) {
                        $select[0].choices.setChoiceByValue(validValues);
                    }
                }
                if (filteredOptions.length === 0) {
                    $select.siblings('.error').text('No hotels available for this location. Please choose another.');
                } else {
                    $select.siblings('.error').text('');
                }
            });
            updateTotals();
        });
        if ($(this).val()) {
            $(this).trigger('change');
        }
    });

    // Handle Service Location change
    $('.service-location').each(function() {
        const day = $(this).data('day');
        const $serviceSelect = $(`#service_${day}`);
        const $allServiceOptions = $serviceSelect.find('option').clone();
        $(this).on('change', function() {
            const selectedLocation = $(this).val();
            const filteredOptions = $allServiceOptions.filter(function() {
                return $(this).data('location') === selectedLocation || $(this).val() === '';
            });
            $serviceSelect.empty().append(filteredOptions);
            initializeChoices($serviceSelect);
            $serviceSelect.val('').trigger('change');
            updateTotals();
        });
        if ($(this).val()) {
            $(this).trigger('change');
        }
    });

    // Handle Activity Service Location change
    $(document).on('change', '.activity-service-location', function() {
        const day = $(this).data('day');
        const selectedLocation = $(this).val();
        const $activityEntries = $(this).closest('.activities').find('.activity-entry');
        $activityEntries.each(function() {
            const $activitySelect = $(this).find('.activity');
            const currentValue = $activitySelect.val();
            const $activityPriceInput = $(this).find('.activity-price');
            if (!$activitySelect.data('all-options')) {
                $activitySelect.data('all-options', $activitySelect.find('option').clone());
            }
            const $allOptions = $activitySelect.data('all-options');
            const filteredOptions = $allOptions.filter(function() {
                return $(this).data('location') === selectedLocation || $(this).val() === '';
            });
            $activitySelect.empty().append('<option value="">Select Activity</option>').append(filteredOptions);
            initializeChoices($activitySelect);
            const selectedOption = $allOptions.filter(`[value="${currentValue}"]`);
            if (selectedOption.data('location') === selectedLocation && currentValue) {
                $activitySelect.val(currentValue).trigger('change');
                const price = parseFloat(selectedOption.data('price')) || 0;
                $activityPriceInput.val(price.toFixed(2));
            } else {
                $activitySelect.val('').trigger('change');
                $activityPriceInput.val('');
            }
        });
        updateTotals();
    });

    $('.activity-service-location').each(function() {
        if ($(this).val()) {
            $(this).trigger('change');
        }
    });

    // Add Activity
    $(document).on('click', '.add-activity', function() {
        const day = $(this).closest('.day-entry').data('day');
        const activityList = $(this).siblings('.activity-list');
        activityList.show();
        const activityIndex = activityList.find('.activity-entry').length;
        const selectedLocation = $(this).closest('.activities').find('.activity-service-location').val();
        let activityOptions = '<option value="">Select Activity</option>';
        activityOptions += activities
            .filter(activity => activity.location === selectedLocation)
            .map(activity =>
                `<option value="${activity.id}" data-location="${activity.location}" data-price="${activity.adult_cost || 0}">${activity.service_name} - ${activity.location}</option>`
            )
            .join('');
        activityList.append(
            `<div class="activity-entry row mb-1">
                <div class="col-md-8">
                    <label for="activity_name_${day}_${activityIndex}">Select Activity</label>
                    <select name="itinerary[${day}][activities][${activityIndex}][name]" id="activity_name_${day}_${activityIndex}" class="activity form-control">${activityOptions}</select>
                </div>
                <div class="col-md-3">
                    <label for="activity_cost_${day}_${activityIndex}">Adult Cost/ per</label>
                    <input type="number" class="activity-price form-control" name="itinerary[${day}][activities][${activityIndex}][price]" placeholder="Price" min="0" step="0.01">
                </div>
                <div class="col-md-1">
                    <button type="button" class="remove-activity btn btn-sm btn-outline-danger mt-4">Remove</button>
                </div>
            </div>`
        );
        const $newSelect = $(`#activity_name_${day}_${activityIndex}`);
        initializeChoices($newSelect);
        $newSelect.on('change', function() {
            const price = parseFloat($(this).find(':selected').data('price')) || 0;
            $(this).closest('.activity-entry').find('.activity-price').val(price.toFixed(2));
            updateTotals();
        });
        updateTotals();
    });

    // Remove Activity
    $(document).on('click', '.remove-activity', function() {
        const activityEntry = $(this).closest('.activity-entry');
        const activityList = activityEntry.closest('.activity-list');
        activityEntry.remove();
        if (activityList.find('.activity-entry').length === 0) {
            activityList.hide();
        }
        updateTotals();
    });

    // Add Transfer
    $(document).on('click', '.add-transfer', function() {
        const day = $(this).closest('.day-entry').data('day');
        const transferList = $(this).siblings('.transfer-list');
        transferList.show();
        const transferIndex = transferList.find('.transfer-entry').length;
        const fromLocations = @json($fromLocations);
        const toLocations = @json($toLocations);
        let fromOptions = fromLocations.map(location =>
            `<option value="${location}">${location}</option>`).join('');
        let toOptions = toLocations.map(location =>
            `<option value="${location}">${location}</option>`).join('');
        let ferryOptions = '<option value="">Select Ferry</option>';
        ferryOptions += ferries.map(ferry =>
            `<option value="${ferry.id}" data-price="${(parseFloat(ferry.adult_fare) + parseFloat(ferry.adult_psf)).toFixed(2)}">${ferry.ferry_name} - ${ferry.class_name}</option>`
        ).join('');
        transferList.append(
            `<div class="transfer-entry row mb-1">
                <div class="col-12 d-flex flex-wrap">
                    <div class="col-md-4">
                        <select class="from-location form-control" name="itinerary[${day}][transfers][${transferIndex}][from]">${fromOptions}</select>
                    </div>
                    <div class="col-md-4">
                        <select class="to-location form-control" name="itinerary[${day}][transfers][${transferIndex}][to]">${toOptions}</select>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap mt-1">
                    <div class="col-md-3">
                        <label for="itinerary[${day}][transfers][${transferIndex}][ferry]">Transfer Ferry</label>
                        <select class="ferry form-control" name="itinerary[${day}][transfers][${transferIndex}][ferry]">${ferryOptions}</select>
                    </div>
                    <div class="col-md-3">
                        <label for="transfer_time_${day}_${transferIndex}">Transfer Time</label>
                        <input type="time" class="transfer-time form-control" name="itinerary[${day}][transfers][${transferIndex}][time]" placeholder="e.g., 09:00">
                    </div>
                    <div class="col-md-3">
                        <label for="transfer_price_${day}_${transferIndex}">Price</label>
                        <input type="number" class="transfer-price form-control" name="itinerary[${day}][transfers][${transferIndex}][price]" placeholder="Price" min="0" step="0.01" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="remove-transfer btn btn-sm btn-outline-danger mt-4">Remove</button>
                    </div>
                </div>
            </div>
            <hr>`
        );
        const $newTransfer = transferList.find('.transfer-entry').last();
        $newTransfer.find('.from-location, .to-location, .ferry').each(function() {
            initializeChoices($(this));
        });
        updateTotals();
    });

    // Handle From Location change for Transfers
    $(document).on('change', '.from-location', function() {
        const transferEntry = $(this).parent().closest('.transfer-entry');
        const from = $(this).val();
        const toSelect = transferEntry.find('.to-location');
        const ferrySelect = transferEntry.find('.ferry');
        const currentTo = toSelect.val();
        const possibleTo = getPossibleTo(from);
        updateLocationOptions(toSelect, possibleTo);
        if (currentTo && possibleTo.includes(currentTo)) {
            toSelect.val(currentTo);
            if (toSelect[0].choices) {
                toSelect[0].choices.setChoiceByValue(currentTo);
            }
            const possibleFerries = getPossibleFerries(from, currentTo);
            updateFerryOptions(ferrySelect, possibleFerries);
        } else {
            updateFerryOptions(ferrySelect, []);
        }
    });

    // Handle To Location change for Transfers
    $(document).on('change', '.to-location', function() {
        const transferEntry = $(this).parent().closest('.transfer-entry');
        const to = $(this).val();
        const fromSelect = transferEntry.find('.from-location');
        const ferrySelect = transferEntry.find('.ferry');
        const from = fromSelect.val();
        if (from) {
            const possibleFerries = getPossibleFerries(from, to);
            updateFerryOptions(ferrySelect, possibleFerries);
        }
    });

    // Handle Ferry selection
    $(document).on('change', '.ferry', function() {
        const transferEntry = $(this).parent().closest('.transfer-entry');
        const priceInput = transferEntry.find('.transfer-price');
        const price = parseFloat($(this).find(':selected').data('price')) || 0;
        priceInput.val(price.toFixed(2));
        updateTotals();
    });

    // Handle Activity selection
    $(document).on('change', '.activity', function() {
        const price = parseFloat($(this).find(':selected').data('price')) || 0;
        $(this).closest('.activity-entry').find('.activity-price').val(price.toFixed(2));
        updateTotals();
    });

    $(document).on('change', '.transfer-time', function() {
        updateTotals();
    });

    function getPossibleTo(from) {
        const toSet = new Set();
        ferries.forEach(ferry => {
            if (ferry.from_location === from) {
                toSet.add(ferry.to_location);
            }
        });
        return Array.from(toSet);
    }

    function getPossibleFerries(from, to) {
        return ferries.filter(ferry => ferry.from_location === from && ferry.to_location === to);
    }

    function updateLocationOptions($select, locations) {
        if ($select[0].choices) {
            $select[0].choices.destroy();
        }
        $select.empty();
        locations.forEach(location => {
            $select.append(new Option(location, location));
        });
        initializeChoices($select);
    }

    function updateFerryOptions($select, ferries) {
        if ($select[0].choices) {
            $select[0].choices.destroy();
        }
        $select.empty().append('<option value="">Select Ferry</option>');
        ferries.forEach(ferry => {
            const $option = new Option(`${ferry.ferry_name} - ${ferry.class_name}`, ferry.id);
            $option.dataset.price = (parseFloat(ferry.adult_fare) + parseFloat(ferry.adult_psf)).toFixed(2);
            $select.append($option);
        });
        initializeChoices($select);
    }

    // Remove Transfer
    $(document).on('click', '.remove-transfer', function() {
        const transferEntry = $(this).parent().closest('.transfer-entry');
        const transferList = transferEntry.closest('.transfer-list');
        transferEntry.remove();
        if (transferList.find('.transfer-entry').length === 0) {
            transferList.hide();
        }
        updateTotals();
    });

    // Update totals on input changes
    $(document).on('input', '.activity-price, .transfer-price, #num_guests', function() {
        updateTotals();
    });

    // Update Totals
    function updateTotals() {
        let baseTotal = 0;
        const numGuests = parseInt($('#num_guests').val()) || 1;

        let totalServiceCost = 0;
        let totalActivityCost = 0;
        let totalTransferCost = 0;

        $('.day-entry').each(function(index) {
            let dayTotal = 0;
            let serviceCost = 0;
            let activityCost = 0;
            let transferCost = 0;

            const serviceSelect = $(this).find('.service');
            const selectedService = serviceSelect.find(':selected');
            const baseServiceCost = parseFloat(selectedService.data('service-cost')) || 0;
            const numCabs = Math.ceil(numGuests / 5);
            serviceCost = baseServiceCost * numCabs;
            dayTotal += serviceCost;

            $(this).find('.activity-entry').each(function() {
                const price = parseFloat($(this).find('.activity-price').val()) || 0;
                activityCost += price * numGuests;
                dayTotal += price * numGuests;
            });

            $(this).find('.transfer-entry').each(function() {
                const price = parseFloat($(this).find('.transfer-price').val()) || 0;
                transferCost += price * numGuests;
                dayTotal += price * numGuests;
            });

            baseTotal += dayTotal;
            totalServiceCost += serviceCost;
            totalActivityCost += activityCost;
            totalTransferCost += transferCost;

            $(`#service-cost-${index}`).text(`₹${serviceCost.toFixed(2)}`);
            $(`#activity-cost-${index}`).text(`₹${activityCost.toFixed(2)}`);
            $(`#transfer-cost-${index}`).text(`₹${transferCost.toFixed(2)}`);
            $(`#day-total-${index}`).text(`₹${dayTotal.toFixed(2)}`);
        });

        $('#total-service').text(`₹${totalServiceCost.toFixed(2)}`);
        $('#total-activity').text(`₹${totalActivityCost.toFixed(2)}`);
        $('#total-transfer').text(`₹${totalTransferCost.toFixed(2)}`);

        const finalTotal = baseTotal;
        $('#base-total').text(`₹${baseTotal.toFixed(2)}`);
        $('#final-total').text(`₹${finalTotal.toFixed(2)}`);
        $('#final_total').val(finalTotal.toFixed(2));

    }

    // Form Submission
    $('#form').on('submit', function(e) {
        const itinerary = [];
        let errors = [];

        $('.day-entry').each(function(index) {
            const dayNum = index + 1;

            const dayTitle = $(this).find('.day-title').val();
            const dayDescription = $(this).find('.day-description-hidden').val();
            const serviceLocation = $(this).find('.service-location').val();
            const service = $(this).find('.service').val();
            const activityServiceLocation = $(this).find('.activity-service-location').val();
            const accomodation = index < $('.day-entry').length - 1 ? $(this).find('.accomodation-location').val() : null;
            const accomodationName = index < $('.day-entry').length - 1 ? {} : null;

            if (index < $('.day-entry').length - 1) {
                $(this).find('.accomodation-name').each(function() {
                    const subcategoryId = $(this).data('subcategory');
                    const values = $(this).val() || [];
                    accomodationName[subcategoryId] = values;
                    if (values.length === 0) {
                        errors.push(`At least one accommodation must be selected for subcategory ${$(this).closest('.card').find('.card-title').text()} on Day ${dayNum}`);
                    } else if (values.length > 3) {
                        errors.push(`Maximum 3 accommodations allowed for subcategory ${$(this).closest('.card').find('.card-title').text()} on Day ${dayNum}`);
                    }
                });
            }

            if (!serviceLocation) errors.push(`Service Location is missing for Day ${dayNum}`);
            if (!service) errors.push(`Service is missing for Day ${dayNum}`);
            if (!activityServiceLocation) errors.push(`Activity Service Location is missing for Day ${dayNum}`);
            if (index < $('.day-entry').length - 1 && !accomodation) errors.push(`Accomodation Location is missing for Day ${dayNum}`);

            const activities = $(this).find('.activity-entry').map(function() {
                const name = $(this).find('.activity').val();
                const price = $(this).find('.activity-price').val();

                if (!name) errors.push(`Activity name missing in Day ${dayNum}`);
                if (!price) errors.push(`Activity price missing in Day ${dayNum}`);
                return {
                    name,
                    price: parseFloat(price) || ''
                };
            }).get().filter(a => a.name);

            const transfers = $(this).find('.transfer-entry').map(function() {
                const from = $(this).find('.from-location').val();
                const to = $(this).find('.to-location').val();
                const ferry = $(this).find('.ferry').val();
                const time = $(this).find('.transfer-time').val();
                const price = $(this).find('.transfer-price').val();

                if (!from) errors.push(`Transfer "from" location missing in Day ${dayNum}`);
                if (!to) errors.push(`Transfer "to" location missing in Day ${dayNum}`);
                if (!ferry) errors.push(`Ferry selection missing in Day ${dayNum}`);
                if (!time) errors.push(`Transfer time missing in Day ${dayNum}`);
                if (!price) errors.push(`Transfer price missing in Day ${dayNum}`);

                return { from, to, ferry, time, price: parseFloat(price) || '' };
            }).get().filter(t => t.from && t.to && t.ferry);

            itinerary.push({
                title: dayTitle,
                description: dayDescription,
                service_location: serviceLocation,
                service,
                activity_service_location: activityServiceLocation,
                accomodation,
                accomodation_name: accomodationName,
                activities,
                transfers
            });
        });

        if (!$('#package_name').val()) errors.push('Package Name is required');
        if (!$('#duration').val()) errors.push('Duration is required');
        if (!$('#num_guests').val()) errors.push('Number of Guests is required');

        if (errors.length > 0) {
            alert('Please fix the following errors:\n\n' + errors.join('\n'));
            e.preventDefault();
            return false;
        }

        $('#itinerary').val(JSON.stringify(itinerary));
    });

    // Initialize existing itinerary
    if (touritinerary && touritinerary.length > 0) {
        touritinerary.forEach((day, index) => {
            let serviceLocValue = day.transfer && day.transfer !== '-' && day.transfer !== 'null'
                ? `${day.service_location} - to - ${day.transfer}`
                : day.service_location;

            $(`#service_location_${index}`).val(serviceLocValue);
            if ($(`#service_location_${index}`)[0].choices) {
                $(`#service_location_${index}`)[0].choices.setChoiceByValue(serviceLocValue);
            }
            $(`#service_location_${index}`).trigger('change');
            $(`#service_${index}`).val(day.service);
            if ($(`#service_${index}`)[0].choices) {
                $(`#service_${index}`)[0].choices.setChoiceByValue(day.service);
            }
            $(`#service_${index}`).trigger('change');
            $(`#activity_service_location_${index}`).val(day.activity_location);
            if ($(`#activity_service_location_${index}`)[0].choices) {
                $(`#activity_service_location_${index}`)[0].choices.setChoiceByValue(day.activity_location);
            }
            $(`#activity_service_location_${index}`).trigger('change');
            if (index < touritinerary.length - 1 && day.accomodation) {
                $(`#accomodation_${index}`).val(day.accomodation);
                if ($(`#accomodation_${index}`)[0].choices) {
                    $(`#accomodation_${index}`)[0].choices.setChoiceByValue(day.accomodation);
                }
                $(`#accomodation_${index}`).trigger('change');
                setTimeout(() => {
                    Object.keys(day.accomodation_name || {}).forEach(subcategoryId => {
                        const values = Array.isArray(day.accomodation_name[subcategoryId])
                            ? day.accomodation_name[subcategoryId]
                            : [day.accomodation_name[subcategoryId]];
                        const $select = $(`#accomodation_name_${index}_${subcategoryId}`);
                        const availableOptions = $select.find('option').map((_, opt) => $(opt).val()).get();
                        const validValues = values.filter(val => availableOptions.includes(val));
                        console.log(`Day ${index} - Subcategory ${subcategoryId} - Setting accomodation_name:`, validValues);
                        if (validValues.length > 0) {
                            $select.val(validValues);
                            if ($select[0].choices) {
                                $select[0].choices.setChoiceByValue(validValues);
                            }
                        }
                    });
                }, 200);
            }

            $(`.day-entry[data-day="${index}"] .activity-entry`).each(function(i) {
                const activity = day.activities && day.activities[i];
                if (activity) {
                    const $activitySelect = $(this).find('.activity');
                    const $activityPriceInput = $(this).find('.activity-price');
                    $activitySelect.val(activity.name || activity.activity_id);
                    if ($activitySelect[0].choices) {
                        $activitySelect[0].choices.setChoiceByValue(activity.name || activity.activity_id);
                    }
                    const selectedActivity = activities.find(act => act.id == (activity.name || activity.activity_id));
                    if (selectedActivity) {
                        const price = parseFloat(selectedActivity.adult_cost) || 0;
                        $activityPriceInput.val(price.toFixed(2));
                    }
                    $activitySelect.trigger('change');
                }
            });

           $(`.day-entry[data-day="${index}"] .transfer-entry`).each(function(i) {
    const transfer = day.transfers && day.transfers[i];
    if (transfer) {
        const $fromSelect = $(this).find('.from-location');
        const $toSelect = $(this).find('.to-location');
        const $ferrySelect = $(this).find('.ferry');
        const $timeInput = $(this).find('.transfer-time');
        const $priceInput = $(this).find('.transfer-price');
        if (transfer.from) {
            $fromSelect.val(transfer.from);
            if ($fromSelect[0].choices) {
                $fromSelect[0].choices.setChoiceByValue(transfer.from);
            }
            $fromSelect.trigger('change');
            setTimeout(() => {
                if (transfer.to) {
                    const possibleTo = getPossibleTo(transfer.from);
                    if (possibleTo.includes(transfer.to)) {
                        $toSelect.val(transfer.to);
                        if ($toSelect[0].choices) {
                            $toSelect[0].choices.setChoiceByValue(transfer.to);
                        }
                        $toSelect.trigger('change');
                        setTimeout(() => {
                            if (transfer.ferry || transfer.ferry_id) {
                                const ferryId = transfer.ferry || transfer.ferry_id;
                                const possibleFerries = getPossibleFerries(transfer.from, transfer.to);
                                console.log(`Possible Ferries for ${transfer.from} to ${transfer.to}:`, possibleFerries);
                                console.log(`Ferries array:`, ferries);
                                const availableFerryIds = possibleFerries.map(f => f.id.toString()); // Ensure string comparison
                                const ferryIdStr = ferryId.toString(); // Convert ferryId to string
                                if (availableFerryIds.includes(ferryIdStr)) {
                                    $ferrySelect.val(ferryIdStr);
                                    if ($ferrySelect[0].choices) {
                                        $ferrySelect[0].choices.setChoiceByValue(ferryIdStr);
                                    }
                                    const selectedFerry = ferries.find(f => f.id.toString() == ferryIdStr);
                                    if (selectedFerry) {
                                        const price = (parseFloat(selectedFerry.adult_fare) + parseFloat(selectedFerry.adult_psf)).toFixed(2);
                                        $priceInput.val(price);
                                    }
                                } else {
                                    console.log(`Ferry ID ${ferryIdStr} not found in ${availableFerryIds}`);
                                    // Retry by re-triggering to-location change
                                    $toSelect.trigger('change');
                                    setTimeout(() => {
                                        if (availableFerryIds.includes(ferryIdStr)) {
                                            $ferrySelect.val(ferryIdStr);
                                            if ($ferrySelect[0].choices) {
                                                $ferrySelect[0].choices.setChoiceByValue(ferryIdStr);
                                            }
                                            const selectedFerry = ferries.find(f => f.id.toString() == ferryIdStr);
                                            if (selectedFerry) {
                                                const price = (parseFloat(selectedFerry.adult_fare) + parseFloat(selectedFerry.adult_psf)).toFixed(2);
                                                $priceInput.val(price);
                                            }
                                        }
                                    }, 200);
                                }
                            }
                            if (transfer.time) {
                                $timeInput.val(transfer.time);
                            }
                            console.log(`Day ${index} - Transfer ${i}:`, {
                                from: transfer.from,
                                to: transfer.to,
                                ferry: transfer.ferry || transfer.ferry_id,
                                time: transfer.time,
                                price: $priceInput.val()
                            });
                        }, 300);
                    }
                }
            }, 200);
        }
    }
});
        });
    }

    $(document).on('change', '.service', function() {
        updateTotals();
    });

    updateTotals();
});
</script>
@endsection