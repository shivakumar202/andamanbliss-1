@extends('layouts.app')
@section('title', @$tour->metaHeadings[0]->meta_title ?? @$tour->package_name)
@section('keywords', @$tour->metaHeadings[0]->meta_keywords)
@section('description', @$tour->metaHeadings[0]->meta_description)
@section('meta_schema')
    {!! $tour->metaHeadings[0]->meta_schema ?? '' !!}
@endsection
@section('og_title', @$tour->metaHeadings[0]->og_title)
@section('og_description', @$tour->metaHeadings[0]->og_description)
@section('og_type', @$tour->metaHeadings[0]->og_type)
@section('og_image', @$tour->metaHeadings[0]->og_image)
@section('twitter_card', @$tour->metaHeadings[0]->twitter_card)
@section('twitter_title', @$tour->metaHeadings[0]->twitter_title)
@section('twitter_desc', @$tour->metaHeadings[0]->twitter_desc)
@section('twitter_image', @$tour->metaHeadings[0]->twitter_image)

@section('content')

<!--loader-->
<section id="page-loader" class="ab-loader-page" aria-label="Loading" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 1000; display: flex; justify-content: center; align-items: center;">
  <div class="loader-wrapper">
    <div class="loader-card" role="status" aria-live="polite" aria-busy="true">
      <div class="gloader" aria-hidden="true">
        <span class="g-dot blue"></span>
        <span class="g-dot red"></span>
        <span class="g-bar yellow"></span>
      </div>
      <h1 class="loader-title">Your opinion is very important to us</h1>
      <p class="loader-sub">Please wait while it's loading</p>
    </div>
  </div>
</section>
@include('common.login-modal')
<section class="tour-dynamic-section">
    <section class="container-fluid tour_rela_slide">
        <div class="multiple-items" id="multiple-items">
            @if (isset($tour->tourPhotos) && !empty($tour->tourPhotos))
                @foreach ($tour->tourPhotos as $photo)
                    <div><img src="{{ $photo->file ?? '' }}" class="img-fluid" alt="tour"></div>
                @endforeach
            @else
                <div><img src="https://via.placeholder.com/600x400?text=No+Image" class="img-fluid" alt="tour"></div>
            @endif
        </div>
    </section>

    <section class="tour-details">
        <div class="container">
            @if (!isset($tour))
                <div class="alert alert-danger">Tour data not found.</div>
                @return
            @endif
@php
$accommodations = $tour->TourItinerary->pluck('accommodation')->filter()->values();
$result = [];
$count = 1;

for ($i = 1; $i < $accommodations->count(); $i++) {
    if ($accommodations[$i] === $accommodations[$i - 1]) {
        $count++;
    } else {
        $result[] = ['nights' => $count, 'accommodation' => $accommodations[$i - 1]];
        $count = 1;
    }
}
$result[] = ['nights' => $count, 'accommodation' => $accommodations->last()];
@endphp

            <div class="row align-items-center">
                <div class="col-md-6 mb-md-0">
                    <h1 class="section-title">{{ ucwords($tour->package_name) ?: preg_replace('/(\d)(?=[A-Za-z])/', '$1 ', $tour->package_name ?? '') }} {{$cat->name ?? ''}} Tour Package 

                     </h1>
                     <span style="font-size:12px; font-weight:600;">
@foreach($result as $r)
    • {{ $r['nights'] }}N {{ $r['accommodation'] }} 
@endforeach
</span>
                    <h6 class="tour-location">
                        <i class="fas fa-map-marker-alt location-icon" aria-label="Location icon"></i>
                        {{ implode(', ', $tour->islands_covered ?? []) }}
                    </h6>
                </div>
                <div class="col-md-6">
                    <div class="tour-info d-flex flex-wrap gap-4">
                        <div class="tour-duration">
                            <i class="fas fa-clock info-icon" aria-label="Duration icon"></i>
                            <div>
                                <h6 class="info-label">Duration</h6>
                                <p class="info-text">{{ $tour->nights }} Nights {{ $tour->days }} Days</p>
                            </div>
                        </div>
                        <div class="tour-type">
                            <i class="fas fa-users info-icon" aria-label="Tour type icon"></i>
                            <div>
                                <h6 class="info-label">Tour Type</h6>
                                <p class="info-text">{{ $tour['tourCategory']->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-4 col-md-12">
                
                <div class="sticky-top tour-pricing-card mt-3 p-3 shadow-sm rounded bg-white">
                    <div class="text-start mb-3 price-header-background rounded p-2">
                        <p class="text-muted" style="font-size:12px">Starting from</p>
                       <strong>₹{{ optional($cat->pivot)->starts_from ? number_format($cat->pivot->starts_from, 2) : '0.00' }} / <small>Total Package</small></strong>

                        <div class="tour-pricing-note text-muted " style="font-size:10px;">Excluding applicable taxes*</div>
                    </div>
                    <div class="hotel-selection-group mb-3">
                        <div class="custom-option selected" onclick="document.getElementById('without_hotel').click()">
                            <input class="form-check-input p-1" type="radio" name="hotel_option" id="without_hotel" value="without_hotel" checked>
                            <label class="form-check-label option-label w-100" for="without_hotel">
                                Without Hotels
                            </label>
                        </div>
                       
                        <div class="custom-option" onclick="document.getElementById('with_hotel').click()">
                            <input class="form-check-input p-1" type="radio" name="hotel_option" id="with_hotel" value="with_hotel">
                            <label class="form-check-label option-label w-100" for="with_hotel">
                                With Hotels
                            </label>
                        </div>
                    </div>
                    <div class="tour-pricing-cta d-grid mb-3">
                @if(Auth::check()) 
                        <button class="btn btn-primary fw-bold d-flex justify-content-center" id="bookNowBtn">SEARCH NOW</button>
                @else
                        <button type="button" class="btn btn-primary fw-bold d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">SEARCH NOW</button>
                @endif
                    </div>
                    <h6 class=" mt-3 fs-6">Select Your Package</h6>
                    <div class="tour-pricing-emi p-3 bg-light rounded mb-3">
                        <div class="row g-2 tour-type-cat-lst">
                            @php
                                $baseUrl = url()->current();
                                $query = request()->getQueryString();
                                $currentCategory = request()->segment(1);
                            @endphp
@foreach ($tour->subCategories->sortBy('rating') as $subcat)
                                @php
                                    $subSlug = Str::slug($subcat->name);
                                    $withSubcatUrl = url($subSlug . '/' . basename($baseUrl));
                                    if ($query) {
                                        $withSubcatUrl .= '?' . $query;
                                    }
                                    $isActive = $subSlug === $currentCategory;
                                @endphp
                                <div class="col-4">
                                    <a href="{{ $withSubcatUrl }}" class="pkg-cat-list-section d-block text-center {{ $isActive ? 'pkg-cata-active' : '' }}">
                                        <div class="fw-bold">{{ $subcat->name }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tour-pricing-emi p-3 bg-light rounded mb-3">
                        <div>
                            <ul>
</li>
                                <li class="fw-bold"><i class="fa-solid fa-location-dot"></i> Places to Visit : 
                                    @foreach($result as $r)
    • {{ $r['nights'] }}N {{ $r['accommodation'] }} 
@endforeach
                                </li>
                            </ul>
                            <hr>
                        </div>
                        <h3 class="fs-6 text-center"><span class=" price-inclu-title">Package Inclusions</span></h3>
                        <div class="d-flex gap-2 justify-content-between align-items-center mt-2">
                            <div class="text-center">
                                <img src="{{ asset('site/img/hotel-1.svg') }}" class="img-fluid rounded"
                                            alt="hotel">
                                            <span class="pkg-list-inclu">Hotels</span>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('site/img/transfer-1.svg') }}" class="img-fluid rounded"
                                            alt="Transfer">
                                            <span class="pkg-list-inclu">Transfer</span>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('site/img/sightseeing-1.svg') }}" class="img-fluid rounded"
                                            alt="hotel">
                                            <span class="pkg-list-inclu">Sightseeing</span>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('site/img/meal-1.svg') }}" class="img-fluid rounded"
                                            alt="Meal">
                                            <span class="pkg-list-inclu">Meal</span>
                            </div>
                            
                        </div>
                    </div>
                    <div>
                        <div class="d-flex gap-2 price-header-background rounded p-3">
                            <div>
                               <i class="fa-solid fa-headset"></i>
                            </div>
                            <div>
                                <h3 class="fs-6 fw-bold">Need Help?</h3>
                               <a class="fw-bold" href="tel:8900909900">Call us: 8900909900</a>,
<a class="fw-bold" href="tel:9933202248">9933202248</a>
<br>
<a class="fw-bold" href="mailto:info@andamanbliss.com">Mail us: info@andamanbliss.com</a>

                            </div>
                        </div>
                    </div>
                </div>         
            </div>

            <div class="col-lg-8 col-md-12 mt-4">
                <div class="sticky-top ">
                    <div class="hotel-search-form-wrapper rounded-3">
                        <div class="container">
                            <div class="hotel-search-form-container">
                                <form method="POST" action="{{ route('tour.itinerary', ['category' => Str::slug($cat->name ?? ''),'slug'=> $tour->tourCategory->slug,'subslug'  => $tour->slug ?? '']) }}"id="hotelSearchForm">
                                    @csrf
                                    <div class="hotel-search-form-row">
                                        <div class="hotel-search-field-group col-3">
                                            <label class="hotel-search-label">TOUR PACKAGE</label>
                                            <div class="hotel-search-input-wrapper">
                                                <select name="package" id="package" class="hotel-search-input">
                                                    @foreach($tours as $package)
                                                    <option value="{{ $package->slug }}" {{ $package->slug == $tour->slug ? 'selected' : ''}}>
                                                        {{ $package->package_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <i class="fas fa-map-marker-alt hotel-search-icon"></i>
                                            </div>
                                        </div>
                                        @php
                                        $twoMonthsLater = \Carbon\Carbon::now()->addMonths(2)->format('d-m-Y');
                                        @endphp
                                        <div class="hotel-search-field-group col-3">
                                            <label class="hotel-search-label">TRAVEL DATE</label>
                                            <div class="hotel-search-input-wrapper date-input-wrapper">
                                                <input type="text" class="hotel-search-input hotel-date-input datepicker"
                                                    min="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" id="travelDate" name="travel_date"
                                                    placeholder="{{ $twoMonthsLater }}" required readonly>
                                            </div>
                                        </div>
                                        <div class="hotel-search-field-group col-3">
                                            <label class="hotel-search-label" for="guestSummary">Room & Guest</label>
                                            <div class="position-relative">
                                                <input type="text" id="guestSummary" class="hotel-search-input bg-white rounded-1"
                                                    placeholder="Room & Guest" readonly required>
                                                <div class="guest-dropdown-box position-absolute bg-white border rounded p-2 shadow mt-1 w-100"
                                                    style="z-index: 1000; display: none;">
                                                    <div class="d-grid" style="grid-template-columns: 1fr 80px;">
                                                        <div class="d-flex align-items-center">
                                                            <label class="fw-semibold small">Room</label>
                                                        </div>
                                                        <div>
                                                            <select id="roomSelect" class="form-select form-select-sm py-1">
                                                                @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="roomsContainer" class="mt-2"></div>
                                                    <button type="button" id="guestApplyBtn"
                                                        class="btn btn-primary w-100 mt-2 py-1 small d-flex justify-content-center">APPLY</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hotel-search-button-group mt-4 col-2">
                                        @if(Auth::check())
                                        <button type="submit" class="hotel-search-btn">SEARCH NOW</button>
                                        @else
                                        <button type="button" class="hotel-search-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">SEARCH NOW</button>
                                        @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <div class="modify-search-box ">
                        <span>{{$tour->package_name}}</span>
                        <span>•</span>
                        <span>2 Adults</span>
                        <span>•</span>
                        <span>{{ \Carbon\Carbon::now()->addMonth()->format('d M') }}</span>
                        <span class="modify" id="modify">MODIFY</span>
                    </div>
                    
                </div>
                <div class="section-header d-flex align-items-center mb-4 mt-3">
                    <div class="section-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="section-title mb-0 fs-6 text-uppercase">PACKAGE Details</h2>
                </div>
                <div>
                    <div class="read-more-container">
                        <div class="overview-description" id="overviewContent" style="text-align:justify">
                            @php
                                $overview = html_entity_decode($tour->description);
                                if (preg_match('/<p\b[^>]*>.*?<\/p>/is', $overview, $match)) {
                                    $first = $match[0];
                                    $rest = trim(str_replace($first, '', $overview));
                                } else {
                                    $split = preg_split('/(\. )/', $overview, 2, PREG_SPLIT_DELIM_CAPTURE);
                                    $first = ($split[0] ?? '') . ($split[1] ?? '');
                                    $rest = $split[2] ?? '';
                                }
                            @endphp
                            {!! $first !!}
                            @if (!empty($rest))
                                <div class="more-text">{!! $rest !!}</div>
                            @endif
                        </div>
                        <button id="toggleBtn" class="mt-2 p-0" style="font-size: 12px">Read more</button>
                    </div>
                </div>
                <!-- <div class="overview-highlights">
                    <div class="overview-highlight">
                        <div class="highlight-icon"><i class="fas fa-hotel"></i></div>
                        <div class="highlight-text">Luxury Accommodation</div>
                    </div>
                    <div class="overview-highlight">
                        <div class="highlight-icon"><i class="fas fa-utensils"></i></div>
                        <div class="highlight-text">Breakfast & Dinner</div>
                    </div>
                    <div class="overview-highlight">
                        <div class="highlight-icon"><i class="fas fa-car"></i></div>
                        <div class="highlight-text">All Transfers</div>
                    </div>
                </div> -->
                <section class="journey-timeline-section mt-3">
                    <div class="container">
                        <div class="journey-header">
                            <h2 class="section-title">Detailed Itinerary: <span class="text-gradient">{{ $tour->nights }} Nights {{ $tour->days }} Days</span></h2>
                        </div>
      <div class="accordion" id="journeyAccordion">
    @php
        $currentCategoryId = $cat->id;
    @endphp

  @foreach ($tour->TourItinerary as $dayIndex => $day)
    @php
        $accommodationMap = json_decode($day['accomodation_name'], true) ?? [];
        $hotelCodeForCategory = $accommodationMap[$currentCategoryId][0] ?? null;
        $hotelForCategory = $hotelCodeForCategory ? \App\Models\Hotel::where('hotel_code', $hotelCodeForCategory)->first() : null;
    @endphp
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{ $dayIndex }}">
            <button class="accordion-button {{ $dayIndex === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $dayIndex }}" aria-expanded="{{ $dayIndex === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $dayIndex }}">
                Day {{ $dayIndex+1 }} - {{ $day['title'] }} 
            </button>
        </h2>

        <div id="collapse{{ $dayIndex }}" class="accordion-collapse collapse {{ $dayIndex === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $dayIndex }}" data-bs-parent="#journeyAccordion">
            <div class="accordion-body">
                <p>{!! $day['description'] ?? '' !!}</p>

                @if ($day['activities']->isNotEmpty())
                    <div class="tour-hotel-display mb-3" style="display: none;">
                        <h4 class="tour-hotel-heading mb-2"><i class="fa-solid fa-person-hiking me-2"></i> Activities</h4>
                        <div class="tour-hotel-card d-flex flex-wrap flex-column rounded shadow-sm p-2 align-items-start">
                            @foreach ($day['activities'] as $item)
                                @php
                                    $activity = $item['activity'] ?? null;
                                @endphp
                                @if ($activity)
                                    <div class="mb-1">
                                        <p style="font-size:14px;" class="fw-bold">{{ $activity['service_name'] ?? 'No name' }}</p>
                                        @if (!empty($activity['location']))
                                            <span class="text-muted" style="font-size:10px;"> — {{ $activity['location'] }}</span>
                                        @endif
                                        @if (!empty($activity['duration']))
                                            <span class="text-muted"> | Duration: {{ $activity['duration'] }}</span>
                                        @endif
                                       
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
@if ($hotelForCategory)
    <div class="tour-hotel-display mb-3">
        <h4 class="tour-hotel-heading mb-2">
            <i class="fa-solid fa-hotel me-2"></i> Accommodation
        </h4>

        <div class="tour-hotel-card d-flex rounded shadow-sm p-2 align-items-start position-relative mb-2">
          @php
    $gallery = json_decode($hotelForCategory->hotel_gallery, true);
    $galleryImage = !empty($gallery[0]) ? preg_replace('#https://www\.tboholidays\.com//?#', 'https://www.tboholidays.com/', $gallery[0]) : null;
    $imageUrl = $hotelForCategory->hotel_image
        ?: ($galleryImage ?: 'https://andamanbliss.com/storage/hotel_photo/photo-20240921-050325-1060733771.jpg');
@endphp

<img src="{{ $imageUrl }}"
     alt="{{ $hotelForCategory->hotel_name ?? 'No hotel selected' }}"
     class="tour-hotel-image me-3">


            <div class="tour-hotel-info">
                <h6 class="mb-1 tour-hotel-name">{{ $hotelForCategory->hotel_name ?? 'No hotel selected' }}</h6>
                <p class="selected-hotel-address mb-1">{{ $hotelForCategory->address ?? '' }}</p>
                <small class="text-danger" style="font-size:12px;">or similar subject to availability</small>
            </div>
        </div>
    </div>
@endif


@if ($day['transfers']->isNotEmpty())
    <div class="tour-hotel-display mb-3">
        <h4 class="tour-hotel-heading mb-2 "><i class="fa-solid fa-ship me-2"></i> Transfers</h4>
        @foreach ($day['transfers'] as $transfer)
            
            <div class="tour-hotel-card d-flex rounded shadow-sm p-2 align-items-start position-relative mb-2">
                <img src="{{ asset('site/logos/mak-fleet.jpg') }}" 
                     alt="Transfer Ferry" 
                     class="tour-hotel-image me-3">

                <div class="tour-hotel-info">
                    <h6 class="mb-1 tour-hotel-name">Makruzz</h6>
                    <p class="mb-1 text-muted">{{ $transfer->from ?? '' }} to {{ $transfer->to ?? '' }}</p>
                    <p class="mb-1">Departure: {{ \Carbon\carbon::parse($transfer->time)->format('h:i A') ?? 'N/A' }} | Arrival: {{ $transfer->time ? date('h:i A', strtotime($transfer->time . ' +1 hour 30 minutes')) : 'N/A' }}</p>
                    <p class="mb-1">Class: Premium</p>
                </div>
            </div>
        @endforeach
    </div>
@endif

            </div>
        </div>
    </div>
@endforeach

</div>

                    </div>
                </section>
                <div class="package-details">
                    <div class="package-column inclusion">
                        <div class="package-header">
                            <div class="package-header-icon"><i class="fas fa-check-circle" aria-label="Included icon"></i></div>
                            <h3>What's Included</h3>
                        </div>
                        <ul class="package-list">
                            @php
                                $inclusions = $tour->inclusions->where('type', 'inclusion');
                                $exclusions = $tour->inclusions->where('type', 'exclusion');
                            @endphp
                            @foreach ($inclusions as $inclusion)
                                <li>{!! $inclusion['icon'] ?? '' !!}<span>{{ $inclusion['description'] }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="package-column exclusions">
                        <div class="package-header">
                            <div class="package-header-icon"><i class="fas fa-times-circle" aria-label="Not included icon"></i></div>
                            <h3>What's Not Included</h3>
                        </div>
                        <ul class="package-list">
                            @foreach ($exclusions as $exclusion)
                                <li>{!! $exclusion['icon'] !!}<span>{{ $exclusion['description'] }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- <div class="seo-section pt-0">
                    <div class="seo-content">
                        @php
                            $title = $tour->facilities[0]['title'] ?? '';
                            $titleParts = explode('|', $title, 2);
                        @endphp
                        <h3 class="section-title">{{ $titleParts[0] ?? '' }} @if (!empty($titleParts[1])) <span class="text-gradient">{{ $titleParts[1] }}</span> @endif</h3>
                        <div class="seo-grid">
                            @foreach ($tour->facilities as $facility)
                                <div class="seo-card">
                                    <div class="seo-card-icon">{!! $facility->icon !!}</div>
                                    <div class="seo-card-content">
                                        <h3 class="seo-card-title">{{ $facility->name }}</h3>
                                        <p class="seo-card-description" style="text-align:justify">{!! $facility->description !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> -->
                 <div class="container my-5 benefits">
      <div class="row g-4">
        <div class="col-md-3 col-6 text-center">
          <div class="benefit-item">
            <div class="benefit-icon-wrap">
              <img src="{{ asset('site/img/icon/travller.png') }}" alt="50,000+ Travellers" />
            </div>
            <div class="benefit-title">50,000+ Travellers</div>
            <div class="benefit-text small">Thousands of guests have trusted us with their Andaman journey.</div>
          </div>
        </div>
        <div class="col-md-3 col-6 text-center">
          <div class="benefit-item">
            <div class="benefit-icon-wrap">
              <img src="{{ asset('site/img/icon/experience2.png') }}" alt="8+ Years of Experience" />
            </div>
            <div class="benefit-title">8+ Years of Experience</div>
            <div class="benefit-text small">Since 2017, we have designed unforgettable Andaman holiday experience.</div>
          </div>
        </div>
        <div class="col-md-3 col-6 text-center">
          <div class="benefit-item">
            <div class="benefit-icon-wrap">
              <img src="{{ asset('site/img/icon/rating.png') }}" alt="Rating - 4.9/5" />
            </div>
            <div class="benefit-title">Rating - 4.9/5</div>
            <div class="benefit-text small">Loved by guests, with over 3,200+ Google reviews praising our service and support.</div>
          </div>
        </div>
        <div class="col-md-3 col-6 text-center">
          <div class="benefit-item">
            <div class="benefit-icon-wrap">
              <img src="{{ asset('site/img/icon/support.png') }}" alt="24x7 Support" />
            </div>
            <div class="benefit-title">24x7 Support</div>
            <div class="benefit-text small">Our team will assist you in every step - before, during and after your trip.</div>
          </div>
        </div>
      </div>
    </div>
            </div>
            
        </div>

        <div class="rev-container mt-3">
    <div class="rev-rating-box flex-wrap">
        <div class="col-lg-6 col-12">
            <div class="rev-stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <h1 class="rev-rating-value">{{ number_format($rating['average_rating'],1) }}</h1>
            <p class="rev-rating-sub">From 70+ countries</p>
        </div>
        <div class="col-lg-6 col-12">
            <div class="rev-rating-row">
                <span>5 ★</span>
                <div class="rev-bar"><div style="width:95%"></div></div>
                <span>{{ $rating[5] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>4 ★</span>
                <div class="rev-bar"><div style="width:30%"></div></div>
                <span>{{ $rating[4] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>3 ★</span>
                <div class="rev-bar"><div style="width:3%"></div></div>
                <span>{{ $rating[3] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>2 ★</span>
                <div class="rev-bar"><div style="width:2%"></div></div>
                <span>{{ $rating[2] }}</span>
            </div>

            <div class="rev-rating-row">
                <span>1 ★</span>
                <div class="rev-bar"><div style="width:4%"></div></div>
                <span>{{ $rating[1] }}</span>
            </div>
          

        </div>
    </div>

    <h3 class="rev-gallery-title fs-5">Traveller Image Gallery</h3>
<div class="rev-gallery-grid">

    @php $first = $review_images->first(); @endphp

    @if($first)

        {{-- BIG IMAGE --}}
        <a href="{{ $first->image_url }}" data-lightbox="gallery" class="rev-big-wrap">
            <img src="{{ $first->image_url }}" class="rev-big-img">
            <span class="rev-view-all"><i class="fa fa-camera"></i> View All ({{ $review_images->count() }})</span>
        </a>

        @foreach($review_images->skip(1)->take(6) as $img)
            <a href="{{ $img->image_url }}" data-lightbox="gallery">
                <img src="{{ $img->image_url }}" class="rev-small-img">
            </a>
        @endforeach

    @endif

    {{-- HIDDEN: ALL IMAGES FOR LIGHTBOX --}}
    <div style="display:none;">
        @foreach($review_images as $img)
            <a href="{{ $img->image_url }}" data-lightbox="gallery"></a>
        @endforeach
    </div>

</div>



  @foreach($reviews as $review)
<div class="rev-review-card   mt-2 flex-wrap">
    <img src="{{ $review['reviewer_profile_photo_url'] }}" class="rev-avatar">

    <div class="rev-review-content col-10">
        <h4 class="rev-name">{{ $review['reviewer_name'] }}</h4>
        <p class="rev-date">Reviewed: {{ \Carbon\Carbon::parse($review['review_date'])->format('M Y') }}</p>
        <p class="mt-1" style="text-align: justify;">{{ $review['comment'] }}</p>
        </div>

    <div class="rev-rating-badge">
        ⭐ {{ number_format($review['rating'],1) }}
    </div>
</div>

@endforeach
</div>  


<!-- End Review -->
        <div class="search-modal-overlay" id="searchModal" style="display: none;">
            <div class="search-modal-container">
                <div class="search-modal-header">
                    <h3>Search your travel date and number of travelers</h3>
                    <button type="button" class="btn-close text-reset" onclick="document.getElementById('searchModal').style.display='none'" aria-label="Close"></button>
                </div>
                <div class="search-modal-form">
                    <form id="modalSearchForm" method="POST" action="{{ route('tour.itinerary', ['category' => Str::slug($cat->name ?? ''), 'slug' => $tour->tourCategory->slug, 'subslug' => $tour->slug ?? '']) }}">
                        @csrf
                        <div class="modal-form-row">
                            <div class="modal-field-group">
                                <label class="modal-field-label">PACKAGE</label>
                                <div class="modal-input-wrapper">
                                      <select name="package" id="package" class="modal-search-input">
                                                    @foreach($tours as $package)
                                                        <option value="{{ $package->slug }}" {{ $package->slug == $tour->slug ? 'selected' : '' }}>
                                                            {{ $package->package_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                    <i class="fas fa-map-marker-alt modal-input-icon"></i>
                                </div>
                            </div>
                            <div class="modal-field-group">
                                <label class="modal-field-label">TRAVEL DATE</label>
                                <div class="modal-input-wrapper">
                                    <input type="text" class="modal-search-input modal-date-input datepicker" min="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" id="modalTravelDate" placeholder="Select Travel Date" name="travel_date" required readonly>
                                    <i class="fas fa-calendar modal-input-icon"></i>

                                </div>
                            </div>
                            <div class="modal-field-group">
                                <label class="modal-field-label" for="modalGuestSummary">Room & Guest</label>
                                <div class="position-relative">
                                    <input type="text" id="modalGuestSummary" class="modal-search-input bg-white rounded-1" placeholder="Room & Guest" readonly required>
                                <div class="modal-guest-dropdown-box position-absolute bg-white border rounded p-2 shadow mt-1 w-100" style="z-index: 1000; display: none; overflow: auto; height: 33vh; scrollbar-width: none; -ms-overflow-style: none;">
                                        <div class="d-grid" style="grid-template-columns: 1fr 80px;">
                                            <div class="d-flex align-items-center">
                                                <label class="fw-semibold small">Room</label>
                                            </div>
                                            <div>
                                                <select id="modalRoomSelect" class="form-select form-select-sm py-1">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div id="modalRoomsContainer" class="mt-2"></div>
                                        <button type="button" id="modalGuestApplyBtn" class="btn btn-primary w-100 mt-2 py-1 small d-flex justify-content-center">APPLY</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="search-modal-footer">
                    <button type="button" class="modal-next-btn" id="modalSearchSubmit">SEARCH</button>
                </div>
            </div>
        </div>
      
        
    </div>
</section>

<style>
    .modal-guest-dropdown-box::-webkit-scrollbar {
    display: none;
}

    .price-inclu-title{
        background-color:#D7F0FF;
        padding:2px 15px;
        border-radius:15px;
        margin-bottom:20px;
    }
    .pkg-list-inclu{font-size:10px;}
    #expert-btn{display: none !important;}
.sticky-top { top: 72px; background-color: none !important; }
.modify-search-box {display: none;}
/* .tour-dynamic-section { position: relative; top: 66px; } */
.section-title { font-size: 1.2rem; font-weight: 600; color: #333; margin-bottom: 3px; }
.text-gradient { background: linear-gradient(to right, #f44336, #f9680f); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.tour-pricing-card { max-width: 400px; margin: auto; background-color: #fff; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
.tour-pricing-cta button { width: 100%; }
.price-header-background { background: linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%); }
.pkg-cat-list-section { background-color: #d9faff; padding: 5px 10px; color: #119DD5; border: 1px solid #119DD5; border-radius: 3px; text-align: center; transition: all 0.3s ease; }
.pkg-cat-list-section:hover { background-color: #119DD5; color: #fff; }
.pkg-cata-active { background-color: #119DD5; color: #fff; }
.tour-hotel-display { background-color: #f8f9fa; border-radius: 8px; padding: 12px; margin-bottom: 16px; }
.tour-hotel-heading { font-size:12px; font-weight: 600; color: #333; border-left: 3px solid #0d6efd; padding-left: 8px; margin-bottom: 10px; }
.tour-hotel-card { display: flex; gap: 12px; border: 1px solid #e9ecef; border-radius: 8px; background-color: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.05); padding: 12px; }
.tour-hotel-image { width: 100px; height: 75px; object-fit: cover; border-radius: 6px; }
.tour-hotel-info { flex: 1; }
.tour-hotel-name { font-size: 0.875rem; font-weight: 600; color: #212529; margin-bottom: 4px; }
.selected-hotel-address { font-size: 0.85rem; color: #6c757d; }
.inclusion { background-color: #EAFAEA; }
.inclusion i { color: #63C266; }
.exclusions { background-color: #FBEBEB; }
.exclusions i { color: red; }
.seo-content { max-width: 100%; }
.seo-detailed-highlight {  background:linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%); }
.seo-detailed-highlight i { color:#002246; }
.seo-card-icon i { color: white; }
.seo-detailed-image { max-width: 100%; height: auto; }
.hotel-search-form-wrapper { background: #119DD5; padding: 10px 0; position: sticky; top: 65px; z-index: 500; }
.hotel-search-form-row { display: flex; gap: 10px; flex-wrap: wrap; }
.hotel-search-field-group { flex: 1; min-width: 200px; position: relative; }
.hotel-search-button-group { flex: 0 0 auto; }
.hotel-search-label { color: white; font-size: 10px; font-weight: 600; letter-spacing: 0.5px; margin-bottom: 3px; text-transform: uppercase; }
.hotel-search-input-wrapper { position: relative; background: white; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
.hotel-search-input { width: 100%; padding: 8px 35px 8px 10px; border: none; outline: none; font-size: 12px; font-weight: 500; color: #333; }
.hotel-search-input:focus { outline: 1px solid #60a5fa; }
.hotel-search-icon { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #666; font-size: 14px; }
.hotel-date-input { cursor: pointer; }
.hotel-date-input::-webkit-calendar-picker-indicator { opacity: 0; position: absolute; right: 0; width: 100%; height: 100%; cursor: pointer; }
.date-input-wrapper::after { content: '\f073'; font-family: 'Font Awesome 5 Free'; font-weight: 900; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #666; font-size: 14px; }
.hotel-search-btn { background: linear-gradient(93deg, #0a223d, #0a223d); color: white; border: none; padding: 10px 20px; border-radius: 30px; font-size: 12px; font-weight: 600; min-width: 100px; }
.hotel-search-btn:hover { background: #0a223d; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(96,165,250,0.4); }
.guest-dropdown-box, .modal-guest-dropdown-box { z-index: 1000; display: none; }
.guest-dropdown-box.show, .modal-guest-dropdown-box.show { display: block; }
.search-modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); backdrop-filter: blur(10px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 10px; }
.search-modal-container { background: linear-gradient(135deg, #03A9F4 0%, #00BCD4 100%); border-radius: 15px; padding: 20px; max-width: 800px; width: 100%; box-shadow: 0 25px 50px rgba(0,0,0,0.3); }
.search-modal-header { text-align: center; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
.search-modal-header h3 { color: white; font-size: 16px; font-weight: 600; }
.search-modal-form { margin-bottom: 20px; }
.modal-form-row { display: flex; gap: 10px; flex-wrap: wrap; }
.modal-field-group { flex: 1; min-width: 200px; }
.modal-field-label { color: white; font-size: 10px; font-weight: 600; letter-spacing: 1px; margin-bottom: 8px; text-transform: uppercase; }
.modal-input-wrapper { position: relative; background: white; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
.modal-search-input { width: 100%; padding: 12px 40px 12px 12px; border: none; outline: none; font-size: 13px; font-weight: 500; color: #333; overflow: hidden !important; }
.modal-search-input:focus { outline: 2px solid #60a5fa; }
.modal-input-icon { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #666; font-size: 14px; }
.modal-date-input { cursor: pointer; overflow: hidden !important;}
.modal-date-input::-webkit-calendar-picker-indicator { opacity: 0; position: absolute; right: 0; width: 100%; height: 100%; cursor: pointer; }
.modal-date-wrapper::after { font-family: 'Font Awesome 5 Free'; font-weight: 900; position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #666; font-size: 14px; overflow: hidden !important; }
.search-modal-footer { display: flex; justify-content: center; }
.modal-next-btn { padding: 10px 25px; border: none; border-radius: 30px; font-size: 13px; font-weight: 600; text-transform: uppercase; min-width: 120px; background: linear-gradient(93deg, #0A223D, #0A223D); color: #fff; }
.modal-next-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(96,165,250,0.4); }
.journey-timeline-section { position: relative; overflow: hidden; }
.journey-header { margin: 20px 0; }
.journey-header>.section-title { font-size: 16px; }
.accordion-item { margin-bottom: 8px; }
.accordion-button { font-size: 12px; font-weight: 600; color:#FF5722; background: #ffffff; border: 1px solid #e9ecef; border-radius: 6px; padding: 10px 15px; }
.accordion-button:not(.collapsed) { background: #d1e7ff; color: #002246; }
.accordion-button:focus { box-shadow: none; }
.accordion-body { padding: 12px; background: #ffffff; border: 1px solid #e9ecef; border-top: none; border-radius: 0 0 6px 6px; }
.is-invalid { border: 1px solid red !important; }
@media (max-width: 768px) {
    .tour-dynamic-section { top: 0; }
    .tour-pricing-card { max-width: 100%; }
    .tour-pricing-cta { display: flex; gap: 10px; margin-bottom: 0% !important; }
    .hotel-search-form-wrapper { display: none;}
    .modify-search-box {display: flex; height: 5vh; background: linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%); width: 100%;}

    .hotel-search-form-row { flex-direction: column; gap: 8px; }
    .hotel-search-field-group { min-width: 100%; }
    .hotel-search-input { font-size: 11px; padding: 6px 30px 6px 8px; }
    .hotel-search-label { font-size: 8px; }
    .hotel-search-btn { width: 100%; padding: 8px; font-size: 11px; }
    .search-modal-container { padding: 15px; margin: 10px; }
    .modal-form-row { flex-direction: column; gap: 10px; }
    .modal-field-group { min-width: 100%; }
    .modal-search-input { font-size: 12px; padding: 10px 35px 10px 10px; }
    .modal-field-label { font-size: 9px; }
    .search-modal-footer { flex-direction: column; gap: 10px; }
    .modal-next-btn { width: 100%; font-size: 12px; }
    .tour-hotel-card { flex-direction: column; align-items: stretch; }
    .tour-hotel-image { width: 100%; height: 120px; }
    .seo-grid { grid-template-columns: 1fr; }
    .tour-pricing-cta { position: fixed; bottom: 0; left: 0; right: 0; background: #fff; padding: 10px; z-index: 1000; display: none; }
    .sticky-top{background-color: none !important;}

}
@media (max-width: 480px) {
    .section-title { font-size: 1.2rem; }
    .tour-hotel-heading { font-size: 0.8rem; }
    .tour-hotel-name { font-size: 0.75rem; }
    .hotel-search-input { font-size: 10px; padding: 5px 25px 5px 6px; }
    .hotel-search-label { font-size: 7px; }
    .hotel-search-btn { font-size: 10px; }
    .modal-search-input { font-size: 11px; }
    .modal-field-label { font-size: 8px; }
    .sticky-top{background-color: none !important;}
}
@media only screen and (max-width: 600px) and (min-width: 300px) {
    .sticky-top{background-color: transparent !important;}

}

    .custom-option {
                            border: 1px solid #dee2e6;
                            border-radius: 8px;
                            padding: 12px 15px;
                            cursor: pointer;
                            transition: all 0.2s;
                            display: flex;
                            align-items: center;
                            margin-bottom: 10px;
                            background: #fff;
                        }
                        .custom-option.selected {
                            background-color: #eef5ff;
                            border-color: #119DD5;
                        }
                        .custom-option .form-check-input {
                            margin-right: 12px;
                            margin-top: 0;
                            width: 1.2em;
                            height: 1.2em;
                            cursor: pointer;
                        }
                        .custom-option .form-check-input:checked {
                            background-color: #fd7e14;
                            border-color: #fd7e14;
                        }
                        .custom-option .form-check-input:focus {
                            box-shadow: 0 0 0 0.25rem rgba(253, 126, 20, 0.25);
                        }
                        .option-label {
                            font-weight: 600;
                            color: #333;
                            margin-bottom: 0;
                            cursor: pointer;
                        }


</style>

@push('styles')
<style>
:root {
    --ct-text: #0f172a;
  
    --ct-muted: #6b7280;
    
    --ct-border: #e8edf3;
    
    --ct-panel: #ffffff;
 
    --ct-shadow: 0 8px 24px rgba(0, 0, 0, .06);
    --ct-green: #2e7d32;
   
    --ct-green-300: #a7e0b1;
    
    --ct-orange: #e06a22;
    
    --ct-orange-300: #ffc38d;
   
    --ct-rail-ok-pos: 14%;
    
    --ct-rail-no-pos: 78%;
 
}


.pkg-terms-wrap {
    padding: 20px 0 36px;
    margin-top: 20px;
}

.pkg-terms-wrap .container {
    max-width: 1024px
}
.terms-content {
    visibility: hidden;
    opacity: 0;
    position: absolute;
    left: 0;
    top: 100%;
    z-index: 1000;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: var(--ct-shadow);
    min-width: 800px;
    transition: visibility 0s, opacity 0.3s ease;
}
.terms-trigger:hover .terms-content {
    visibility: visible;
    opacity: 1;
}
.terms-trigger {
    position: relative;
    display: inline-block;
}
.terms-hover {
    font-size: 12px !important;
    cursor: pointer;
    display: inline-block;
    margin: 0;
}

.ct-title {
    font-weight: 800;
    font-size: 2.1rem;
    margin: 0 0 8px;
    color: var(--ct-text)
}

.ct-subtitle {
    font-weight: 800;
    font-size: 1.6rem;
    margin: 0 0 12px;
    color: var(--ct-text)
}

.ct-lead {
    margin: 2px 0;
    color: var(--ct-muted)
}

.ct-lead.success {
    color: #2f7d34;
    font-weight: 700
}

.ct-lead.muted strong {
    font-weight: 800
}


.ct-rail {
    position: relative;
    height: 12px;
    border-radius: 10px;
    background: linear-gradient(90deg, #89cf97 0%, #cce39a 40%, #ffd59e 70%, #f1b07f 100%);
    box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .04);
    margin: 18px 0 16px
}

.ct-rail__marker {
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    box-shadow: 0 6px 14px rgba(0, 0, 0, .15), 0 0 0 4px #fff
}

.ct-rail__marker i {
    font-size: 14px;
    line-height: 1
}

.ct-rail__marker.ok {
    left: var(--ct-rail-ok-pos);
    background: var(--ct-green)
}

.ct-rail__marker.no {
    left: var(--ct-rail-no-pos);
    background: var(--ct-orange)
}


.ct-rail-labels {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin: 6px 0 18px
}

.lbl-title {
    font-weight: 700;
    color: #12313b;
    font-size:12px;
}

.lbl-title.bad {
    color: #a2381a
}

.lbl-sub {
    margin-top: 2px;
    color: var(--ct-muted)
}

.lbl-sub.muted {
    color: #8b5d53
}


.ct-notes {
    background: #f3f6f9;
    border: 1px solid var(--ct-border);
    border-radius: 12px;
    padding: 18px;
    box-shadow: var(--ct-shadow)
}

.ct-bullets {
    margin: 0;
    padding: 0;
    list-style: none;
    color: var(--ct-text)
}

.ct-bullets li {
    position: relative;
    padding-left: 22px;
    margin: 12px 0;
    color: #455568;
    line-height: 1.6
}

.ct-bullets li::before {
    content: "";
    position: absolute;
    left: 0;
    top: .55em;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #37a043;
    box-shadow: 0 0 0 3px rgba(55, 160, 67, .15)
}

/* Responsive */
@media (max-width: 768px) {
    .ct-title {
        font-size: 1.7rem
    }

    .ct-subtitle {
        font-size: 1.35rem
    }

    .ct-rail__marker {
        width: 26px;
        height: 26px
    }
    .terms-content {
        min-width: 300px;
        padding: 15px;
    }
}

@media (max-width: 576px) {
    .pkg-terms-wrap {
        padding: 16px 0 26px
    }

    .ct-rail {
        height: 12px
    }

    .ct-rail__marker {
        width: 24px;
        height: 24px
    }

    .ct-rail-labels {
        gap: 16px
    }
}
#footers{
    position: relative;
    top: 10vh;
}
 .modify-search-box {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border: 1px solid #dcdcdc;
      border-radius: 50px;
      padding: 6px 16px;
      background: #fff;
      font-size: 14px;
      font-weight: 500;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      width: fit-content;
    }
    .modify-search-box span {
      margin-right: 10px;
      color: #333;
    }
    .modify-search-box .modify {
      color: #007bff;
      font-weight: 600;
      cursor: pointer;
    }
    .modify-search-box .modify:hover {
      text-decoration: underline;
    }
</style>
@endpush

@push('scripts')
<script>
    
if (typeof $ === 'undefined' || typeof $.fn.slick === 'undefined') {
    console.error('jQuery or Slick Carousel is not loaded.');
} else {
    $('.multiple-items').slick({
        dots: false,
        arrows: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        variableWidth: true,
        prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fa fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fa fa-chevron-right"></i></button>'
    });
}
  document.addEventListener('DOMContentLoaded', function() {
                            const options = document.querySelectorAll('input[name="hotel_option"]');
                            options.forEach(option => {
                                option.addEventListener('change', function() {
                                    document.querySelectorAll('.custom-option').forEach(el => el.classList.remove('selected'));
                                    if(this.checked) {
                                        this.closest('.custom-option').classList.add('selected');
                                    }
                                });
                            });
                        });
document.addEventListener('DOMContentLoaded', function() {
    const loader = document.getElementById('page-loader');
    if (loader) {
        loader.style.display = 'flex';
        window.addEventListener('load', () => {
            loader.style.opacity = '0';
            loader.style.transition = 'opacity 0.3s ease';
            setTimeout(() => loader.style.display = 'none', 300);
        });
    }

    // Responsive pricing card for mobile
    function togglePricingCard() {
        const pricingCta = document.querySelector('.tour-pricing-cta');
        if (window.innerWidth <= 768) {
            pricingCta.style.display = 'flex';
        } else {
            pricingCta.style.display = 'none';
        }
    }
    window.addEventListener('resize', togglePricingCard);
    togglePricingCard();

    function getMaxChildrenAllowed(adults) {
        if (adults === 1) return 2;
        if (adults === 2) return 3;
        if (adults >= 3) return 1;
        return 0;
    }

    function generateRoomFields(containerId, roomSelectId, roomCount) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';
        for (let r = 0; r < roomCount; r++) {
            const roomDiv = document.createElement('div');
            roomDiv.className = 'border-top pt-2';
            roomDiv.innerHTML = `
                <div class="small fw-semibold mb-1">Room ${r + 1}</div>
                <div class="row">
                    <div class="col">
                        <label class="small mb-0">Adults</label>
                        <select class="${containerId === 'roomsContainer' ? 'adult-count' : 'modal-adult-count'} form-select form-select-sm py-1" data-room="${r}">
                            ${Array.from({ length: 4 }, (_, i) => `<option value="${i + 1}">${i + 1}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col">
                        <label class="small mb-0">Children</label>
                        <select class="${containerId === 'roomsContainer' ? 'child-count' : 'modal-child-count'} form-select form-select-sm py-1" data-room="${r}">
                            <option value="0">0</option>
                        </select>
                    </div>
                </div>
                <div class="row ${containerId === 'roomsContainer' ? 'child-ages' : 'modal-child-ages'} mt-1" id="${containerId}-child-ages-room-${r}"></div>
            `;
            container.appendChild(roomDiv);
        }
        attachRoomListeners(containerId, roomSelectId);
    }

    function attachRoomListeners(containerId, roomSelectId) {
        const adultClass = containerId === 'roomsContainer' ? '.adult-count' : '.modal-adult-count';
        const childClass = containerId === 'roomsContainer' ? '.child-count' : '.modal-child-count';
        const adultSelects = document.querySelectorAll(adultClass);
        const childSelects = document.querySelectorAll(childClass);
        adultSelects.forEach(select => {
            select.addEventListener('change', () => {
                const room = select.dataset.room;
                const adults = parseInt(select.value || 1);
                const childSelect = document.querySelector(`${childClass}[data-room="${room}"]`);
                const maxChildren = getMaxChildrenAllowed(adults);
                childSelect.innerHTML = Array.from({ length: maxChildren + 1 }, (_, i) => `<option value="${i}">${i}</option>`).join('');
                childSelect.dispatchEvent(new Event('change'));
            });
        });
        childSelects.forEach(select => {
            select.addEventListener('change', () => {
                const room = select.dataset.room;
                const container = document.getElementById(`${containerId}-child-ages-room-${room}`);
                container.innerHTML = '';
                const count = parseInt(select.value);
                for (let i = 0; i < count; i++) {
                    const col = document.createElement('div');
                    col.className = 'col-6 mb-1';
                    const maxAge = (i === 0) ? 17 : 5;
                    col.innerHTML = `
                        <label class="small mb-0">Child ${i + 1} Age</label>
                        <select class="form-select form-select-sm py-1" name="PaxRooms[${room}][ChildrenAges][]">
                            ${Array.from({ length: maxAge + 1 }, (_, age) => `<option value="${age}">${age} yrs</option>`).join('')}
                        </select>
                    `;
                    container.appendChild(col);
                }
            });
        });
    }

    function applyRoomSelection(summaryId, containerId, roomSelectId, formId, applyBtnId) {
        const roomSelect = document.getElementById(roomSelectId);
        const applyBtn = document.getElementById(applyBtnId);
        const form = document.getElementById(formId);
        const summaryInput = document.getElementById(summaryId);
        const dropdown = document.querySelector(`#${summaryId} ~ .${containerId === 'roomsContainer' ? 'guest-dropdown-box' : 'modal-guest-dropdown-box'}`);

        if (applyBtn) {
            applyBtn.addEventListener('click', () => {
                const roomCount = parseInt(roomSelect.value);
                let summary = [];
                document.querySelectorAll(`.${containerId === 'roomsContainer' ? 'hidden-room-input' : 'modal-hidden-room-input'}`).forEach(el => el.remove());
                let numAdults = 0;
                for (let r = 0; r < roomCount; r++) {
                    const adult = document.querySelector(`#${containerId} .${containerId === 'roomsContainer' ? 'adult-count' : 'modal-adult-count'}[data-room="${r}"]`)?.value || 1;
                    const child = document.querySelector(`#${containerId} .${containerId === 'roomsContainer' ? 'child-count' : 'modal-child-count'}[data-room="${r}"]`)?.value || 0;
                    numAdults += parseInt(adult);
                    let line = `Room ${r + 1} – ${adult} Adult${adult > 1 ? 's' : ''}`;
                    if (child > 0) line += `, ${child} Child${child > 1 ? 'ren' : ''}`;
                    summary.push(line);
                    const hiddenAdult = document.createElement('input');
                    hiddenAdult.type = 'hidden';
                    hiddenAdult.name = `PaxRooms[${r}][Adults]`;
                    hiddenAdult.value = adult;
                    hiddenAdult.className = containerId === 'roomsContainer' ? 'hidden-room-input' : 'modal-hidden-room-input';
                    form.appendChild(hiddenAdult);
                    const hiddenChild = document.createElement('input');
                    hiddenChild.type = 'hidden';
                    hiddenChild.name = `PaxRooms[${r}][Children]`;
                    hiddenChild.value = child;
                    hiddenChild.className = containerId === 'roomsContainer' ? 'hidden-room-input' : 'modal-hidden-room-input';
                    form.appendChild(hiddenChild);
                    const ageSelects = document.querySelectorAll(`#${containerId}-child-ages-room-${r} select`);
                    ageSelects.forEach((select, index) => {
                        const hiddenAge = document.createElement('input');
                        hiddenAge.type = 'hidden';
                        hiddenAge.name = `PaxRooms[${r}][ChildrenAges][${index}]`;
                        hiddenAge.value = select.value;
                        hiddenAge.className = containerId === 'roomsContainer' ? 'hidden-room-input' : 'modal-hidden-room-input';
                        form.appendChild(hiddenAge);
                    });
                }
                summaryInput.value = summary.join('; ');
                dropdown.style.display = 'none';
                document.getElementById('num-adults').value = numAdults;
            });
        }
    }

   function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        let errors = [];
        const travelDate = form.querySelector('#' + (formId === 'hotelSearchForm' ? 'travelDate' : 'modalTravelDate'));
        const guestSummary = form.querySelector('#' + (formId === 'hotelSearchForm' ? 'guestSummary' : 'modalGuestSummary'));
        const packageSelect = form.querySelector('#' + (formId === 'hotelSearchForm' ? 'package' : 'modalPackage'));

        if (!travelDate.value) {
            errors.push("Please select a travel date.");
            travelDate.classList.add('is-invalid');
        } else {
            travelDate.classList.remove('is-invalid');
        }

        if (!guestSummary.value) {
            errors.push("Please select rooms and guests.");
            guestSummary.classList.add('is-invalid');
        } else {
            guestSummary.classList.remove('is-invalid');
        }

        if (errors.length > 0) {
            alert(errors.join("\n"));
            return;
        }

        if (packageSelect) {
            const selectedPackage = packageSelect.value;
            let action = form.getAttribute('action');
            action = action.replace(/tour-[^/]+\/itinerary$/, 'tour-' + selectedPackage + '/itinerary');
            form.setAttribute('action', action);
        }

        if (typeof loader !== 'undefined' && loader) {
            loader.style.display = 'flex';
            loader.style.opacity = '1';
        }

        // Close modal if it is a modal form
        if (formId === 'modalSearchForm') {
            const modalEl = document.getElementById('yourModalId'); // replace with your modal's ID
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
        }

        form.submit();
    });
}

validateForm('hotelSearchForm');
validateForm('modalSearchForm');

    const enquiryForm = document.getElementById('enquiryForm');
    if (enquiryForm) {
        enquiryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const name = enquiryForm.querySelector('input[name="name"]');
            const email = enquiryForm.querySelector('input[name="email"]');
            const phone = enquiryForm.querySelector('input[name="phone"]');
            const message = enquiryForm.querySelector('textarea[name="message"]');
            let errors = [];
            
            if (!name.value.trim()) errors.push("Please enter your name.");
            if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) errors.push("Please enter a valid email.");
            if (!phone.value.match(/^\+?\d{10,}$/)) errors.push("Please enter a valid phone number.");
            if (!message.value.trim()) errors.push("Please enter your message.");
            
            if (errors.length > 0) {
                alert(errors.join("\n"));
                return;
            }
            
            if (loader) {
                loader.style.display = 'flex';
                loader.style.opacity = '1';
            }
            enquiryForm.submit();
        });
    }

    const guestSummary = document.getElementById('guestSummary');
    const guestDropdown = document.querySelector('.guest-dropdown-box');
    const roomSelect = document.getElementById('roomSelect');
    const modalGuestSummary = document.getElementById('modalGuestSummary');
    const modalGuestDropdown = document.querySelector('.modal-guest-dropdown-box');
    const modalRoomSelect = document.getElementById('modalRoomSelect');

    if (roomSelect) {
        roomSelect.addEventListener('change', () => {
            const roomCount = parseInt(roomSelect.value);
            generateRoomFields('roomsContainer', 'roomSelect', roomCount);
        });
    }

    if (modalRoomSelect) {
        modalRoomSelect.addEventListener('change', () => {
            const roomCount = parseInt(modalRoomSelect.value);
            generateRoomFields('modalRoomsContainer', 'modalRoomSelect', roomCount);
        });
    }

    applyRoomSelection('guestSummary', 'roomsContainer', 'roomSelect', 'hotelSearchForm', 'guestApplyBtn');
    applyRoomSelection('modalGuestSummary', 'modalRoomsContainer', 'modalRoomSelect', 'modalSearchForm', 'modalGuestApplyBtn');

    if (guestSummary) {
        guestSummary.addEventListener('click', (e) => {
            e.stopPropagation();
            guestDropdown.style.display = 'block';
        });
    }

    if (modalGuestSummary) {
        modalGuestSummary.addEventListener('click', (e) => {
            e.stopPropagation();
            modalGuestDropdown.style.display = 'block';
        });
    }

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.modal-field-group') && !event.target.closest('.hotel-search-field-group')) {
            guestDropdown.style.display = 'none';
            modalGuestDropdown.style.display = 'none';
        }
    });

    document.getElementById('bookNowBtn').addEventListener('click', () => {
        document.getElementById('searchModal').style.display = 'flex';
    });

    document.getElementById('modify').addEventListener('click', () => {
        document.getElementById('searchModal').style.display = 'flex';
    });

    document.getElementById('modalSearchSubmit')?.addEventListener('click', () => {
        document.getElementById('modalSearchForm').dispatchEvent(new Event('submit'));
    });

    document.getElementById('enquirySubmit')?.addEventListener('click', () => {
        document.getElementById('enquiryForm').dispatchEvent(new Event('submit'));
    });

    if (roomSelect) generateRoomFields('roomsContainer', 'roomSelect', parseInt(roomSelect.value) || 1);
    if (modalRoomSelect) generateRoomFields('modalRoomsContainer', 'modalRoomSelect', parseInt(modalRoomSelect.value) || 1);

    const toggleBtn = document.getElementById('toggleBtn');
    const moreText = document.querySelector('.more-text');
    if (toggleBtn && moreText) {
        toggleBtn.addEventListener('click', () => {
            if (moreText.style.display === 'none' || !moreText.style.display) {
                moreText.style.display = 'block';
                toggleBtn.textContent = 'Read less';
            } else {
                moreText.style.display = 'none';
                toggleBtn.textContent = 'Read more';
            }
        });
    }
});
</script>
@endpush

<!--loader-->
@push('styles')
<style>
:root{
  --ld-blue:#1a73e8;   
  --ld-red:#ea4335;    
  --ld-yellow:#fbbc04; 
  --ld-shadow:0 10px 30px rgba(0,0,0,.15);
}

/* dotted background */
.ab-loader-page{
  position:relative;
  min-height: calc(100vh - 140px);
  display:flex;align-items:center;justify-content:center;
  padding: 60px 16px;
  background:
    radial-gradient(circle at 1px 1px, #cfd8e3 1px, transparent 1px) 0 0/22px 22px,
    radial-gradient(circle at 1px 1px, #e6edf5 1px, transparent 1px) 11px 11px/22px 22px;
}
.loader-wrapper{display:flex;align-items:center;justify-content:center;width:100%;}

/* Card */
.loader-card{
  width:min(560px, 92vw);
  background:#fff;border-radius:14px;box-shadow:var(--ld-shadow);
  padding:28px 26px;text-align:center;
}

/* Loader visual (two dots + elongated bar) */
.gloader{height:38px;display:inline-grid;grid-template-columns:28px 28px 64px;align-items:center;gap:10px;margin:6px 0 18px;}
.g-dot{width:16px;height:16px;border-radius:50%;}
.g-dot.blue{background:var(--ld-blue);animation:floatY 1.2s ease-in-out infinite;}
.g-dot.red{background:var(--ld-red);animation:floatY 1.2s ease-in-out .15s infinite;}
.g-bar{width:56px;height:12px;border-radius:6px;background:var(--ld-yellow);position:relative;overflow:hidden;}
.g-bar::before{content:"";position:absolute;inset:0;background:linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.7) 45%, rgba(255,255,255,0) 100%);transform:translateX(-100%);animation:sweep 1.2s ease-in-out infinite;}


.loader-title{font-weight:700;color:#111827;font-size:1.25rem;margin:0 0 .35rem;}
.loader-sub{color:#6b7280;margin:0;font-size:.98rem;}


@keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
@keyframes sweep{0%{transform:translateX(-100%)}60%{transform:translateX(100%)}100%{transform:translateX(100%)}}


.reduce-motion .g-dot{animation:none !important}
.reduce-motion .g-bar::before{animation:none !important}

@media (max-width:480px){
  .gloader{grid-template-columns:24px 24px 56px;gap:8px}
  .loader-title{font-size:1.05rem}
}
</style>
@endpush

@push('scripts')
<script>
(function(){
  function onReady(fn){ if(document.readyState==='loading'){document.addEventListener('DOMContentLoaded',fn);} else {fn();} }
  onReady(function(){
    
    try{
      if(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches){
        document.documentElement.classList.add('reduce-motion');
      }
    }catch(e){}
  });
})();
</script>
@endpush
@endsection