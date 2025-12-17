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
                            <h1 class="section-title">
                                {{ ucwords($tour->package_name) ?: preg_replace('/(\d)(?=[A-Za-z])/', '$1 ', $tour->package_name ?? '') }} {{$cat->name ?? ''}} Tour Package 
                            </h1>
                            <span style="font-size:12px; font-weight:600">
@foreach($result as $r)
    • {{ $r['nights'] }}N {{ $r['accommodation'] }} 
@endforeach</span>
                            <h6 class="tour-location">
                                <i class="fas fa-map-marker-alt location-icon" aria-label="Location icon"></i>
                                {{ implode(', ', $tour->islands_covered ?? []) }}
                            </h6>
                        </div>
                        @php
                            $name = $tour->package_name ?? '';
                            preg_match('/(\d+)\s*(?:Nights|N)[\s–-]*(\d+)\s*(?:Days|D)/i', $name, $matches) ||
                                preg_match('/(\d+)\s*(?:Days|D)[\s–-]*(\d+)\s*(?:Nights|N)/i', $name, $matches);
                            $days = $matches[1] ?? 'N/A';
                            $nights = $matches[2] ?? 'N/A';
                        @endphp
                        <div class="col-md-6">
                            <div class="tour-info d-flex flex-wrap gap-4">
                                <div class="tour-duration">
                                    <i class="fas fa-clock info-icon" aria-label="Duration icon"></i>
                                    <div>
                                        <h6 class="info-label">Duration</h6>
                                        <p class="info-text">{{ $tour->nights }} Nights {{ $tour->days }} Days </p>
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
                        <div class="sticky-top" style="background-color: none !important; ">
                            <div class="tour-pricing-card mt-3 p-3 shadow-sm rounded bg-white">
                
                            <div class="text-start  price-header-background rounded p-2">
                            <div>
                        <p class="text-muted" style="font-size:12px">Book Now</p>
                    </div>
                    @if($priceBreakdown['total_with_markup'] != $priceBreakdown['total_with_discount'])
                    <div class="tour-pricing-original text-muted  fs-6"><span class="tour-pricing-discount text-danger fw-semibold mb-1">{{ $priceBreakdown['discount'] }}% OFF</span></div>
                @endif
                @php
                    $numAdults = $inputs['PaxRooms']['Adults'] ?? 1;
                @endphp
                <input type="hidden" id="num-adults" value="{{ $numAdults }}">
                <input type="hidden" id="price-break" value='@json($priceBreakdown)'>
                @if($priceBreakdown)
                <div class="tour-pricing-final fs-5 fw-bold">
                    ₹{{ number_format($priceBreakdown['total_with_markup'], 2) }} <small class="text-muted" style="font-size:12px;">Total Package</small>
                </div>
                @endif
                    <div class="tour-pricing-note text-muted" style="font-size:0.6rem">Excluding applicable taxes*</div>
            </div>

            
             <div class="tour-pricing-cta d-grid mb-3">
                <a href="" class="d-md-none text-primary fw-bolder text-decoration-underline" style="text-align: end;" id="paycontrol"><i class="fa-solid fa-angles-down"></i> hide</a>

                <div class="mt-1 " id="payOptions">
                   
                     <div class="tbook-option tbook-option-active mb-1" onclick="selectPayment(this)">
    <div class="form-check d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <input class="form-check-input p-2" type="radio" name="wh" value="0" id="wh1" checked>
            <label role="button" class="form-check-label fw-semibold ms-2 my-0" for="wh1">Without Hotels</label>
        </div>
        <div class="d-flex flex-column">
            <small class="text-decoration-line-through text-muted final-price">₹{{ number_format($priceBreakdown['total_with_markup'], 2) }}</small>
            <strong class="without-hotel">₹{{ number_format($whcost, 2) }}</strong>
        </div>
    </div>
</div> 
<div class="tbook-option mb-1" onclick="selectPayment(this)">
    <div class="form-check d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <input class="form-check-input p-2" type="radio" name="wh" value="1" id="wh2" >
            <label role="button" class="form-check-label fw-bolder ms-2 my-0" for="wh2">With Hotels</label>
        </div>
        <strong class="final-price">₹{{ number_format($priceBreakdown['total_with_markup'], 2) }}</strong>
    </div>
</div>                
            </div>
    @if ($livebook == 1)
        <button class="btn btn-primary fw-bold d-flex justify-content-center" id="proceedToPaymentBtn" style="font-size:14px;">
            PROCEED TO PAYMENT
        </button>
        <div>
        <ul class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
            <li><img  src="{{ asset('site/img/google-pay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="google-pay"></li>
            <li><img src="{{ asset('site/img/phonepe-1.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="phonepe-1"></li>
            <li><img src="{{ asset('site/img/rupay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="rupay"></li>
            <li><img src="{{ asset('site/img/visa.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="visa"></li>
            <li><img src="{{ asset('site/img/mastercard-4.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="mastercard-4"></li>
            <li><img src="{{ asset('site/img/paypal-3.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="paypal-3"></li>
        </ul>
   </div>
    @else
     <button class="btn btn-primary fw-bold d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#enquiryModal" id="getQuoteBtn" style="font-size:14px;">
        GET A QUOTE
    </button>
    @endif   
</div>



            <h6 class="fw-bold mt-3">Select Your Package</h6>
             <div class="tour-pricing-emi p-3 bg-light rounded mb-3">
                        <div class="row g-2 tour-type-cat-lst">
                            @php
                    $currentPath = request()->path();
                    $query = request()->getQueryString();
                @endphp

              @foreach ($tour->subCategories->sortBy('rating') as $subcat)

                    @php
                        $subSlug = Str::slug($subcat->name);
                        $segments = explode('/', $currentPath);
                        if (count($segments) > 1) {
                            $segments[0] = $subSlug;
                        } else {
                            array_unshift($segments, $subSlug);
                        }

                        $routeParams = [
                            'category' => $subSlug,
                            'slug' => $tour->tourCategory->slug,
                            'subslug' => $tour->slug ?? '',
                        ];

                        $isActive = request()->segment(1) === $subSlug;
                    @endphp

                                                <div class="col-4">
                                                <form method="POST" action="{{ route('tour.itinerary', $routeParams) }}">
                            @csrf
                            @php
                    $renderHiddenInputs = function($key, $value) use (&$renderHiddenInputs) {
                        if (is_array($value)) {
                            foreach ($value as $subKey => $subValue) {
                                $renderHiddenInputs($key . '[' . $subKey . ']', $subValue);
                            }
                        } else {
                            echo '<input type="hidden" name="' . e($key) . '" value="' . e($value) . '">';
                        }
                    };
                @endphp

                @foreach(request()->except('_token') as $key => $value)
                    {!! $renderHiddenInputs($key, $value) !!}
                @endforeach


                  <button type="submit" class="pkg-cat-list-section d-block text-center w-100 {{ $isActive ? 'pkg-cata-active' : '' }}">
                <div class="fw-bold">{{ $subcat->name }}</div>
            </button>
        </form>
                                </div>
                            @endforeach
                        </div>

             


            </div>
<div class="tour-pricing-emi p-3 bg-light rounded mb-3">
                        <div>
                            <ul>
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

           @if(isset($priceBreakdown['discount']) && $priceBreakdown['discount'] > 0)
        <div class="tour-pricing-coupon mb-3 mt-3">
            <h6 class="fw-bold">Coupons & Offers</h6>

            <div class="tour-pricing-applied border rounded p-2 d-flex justify-content-between align-items-start bg-light">
                
                <div>
                    <div class="fw-bold text-primary">HAPPYTRAVEL</div>
                    <div class="text-muted small">
                        Get <span class="text-success">{{ $priceBreakdown['discount'] ?? 0 }}%</span> off on your booking above ₹{{ number_format($priceBreakdown['discount_above'] ?? 0) }}
                    </div>
                </div>
            
            </div>
        </div>
@endif

        </div>
    </div>

                </div>
                <div class="col-lg-8 col-md-12 mt-4">
                    <div class="sticky-top">
                            <div class="hotel-search-form-wrapper  rounded-3">
                                <div class="container">
                                    <div class="hotel-search-form-container ">
                                        <div class="hotel-search-form-main rounded-3" id="hotelSearchForm">
                                        <div class="hotel-search-form-row">
                        <div class="hotel-search-field-group col-md-3 col-12">
                            <label class="hotel-search-label text-start text-white">TOUR PACKAGE</label>
                            <div class="hotel-search-input-wrapper">
                                <span class="hotel-search-input">
                                    {{ $inputs['package'] ?? ($tour->package_name ?? '') }}
                                </span>
                                <i class="fas fa-map-marker-alt hotel-search-icon"></i>
                            </div>
                        </div>

                        <div class="hotel-search-field-group col-md-3 col-12">
                            <label class="hotel-search-label text-start text-white">TRAVEL DATE</label>
                            <div class="hotel-search-input-wrapper date-input-wrapper">
                                <span class="hotel-search-input hotel-date-input">
                                    {{ $inputs['travel_date'] ?? \Carbon\Carbon::now()->format('Y-m-d') }}
                                </span>
                            </div>
                        </div>

                        <div class="hotel-search-field-group col-md-4 col-12 ">
                            <label class="hotel-search-label" for="guestSummary">Room & Guest</label>
                            <div class="position-relative">
                                <div class="guest-selector-wrapper">
                                    <span class="hotel-search-input room-guest bg-white rounded-1 w-100 py-1">
                        @if(!empty($inputs['PaxRooms']) && is_array($inputs['PaxRooms']))
                            @foreach($inputs['PaxRooms'] as $index => $room)
                                Room {{ $index + 1 }} – 
                                {{ $room['Adults'] ?? 0 }} Adult{{ ($room['Adults'] ?? 0) > 1 ? 's' : '' }}
                                @if(!empty($room['Children']) && $room['Children'] > 0)
                                    , {{ $room['Children'] }} Child{{ $room['Children'] > 1 ? 'ren' : '' }}
                                @endif
                                @if(!$loop->last); @endif
                            @endforeach
                        @else
                            Room 1 – 1 Adult
                        @endif
                    </span>

                                <i class="fas fa-person hotel-search-icon"></i>


                                </div>
                            </div>
                        </div>

                        <div class="hotel-search-button-group mt-2 col-md-2 col-12">
                            <button class="hotel-search-btn" id="bookNowBtn"><i class="fa fa-pen "></i> MODIFY</button>
                        </div>
                    </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modify-search-box">
    <span>{{ $inputs['package'] ?? '' }}</span>
    <span>•</span>
<span>
    @php
        $adults = collect($inputs['PaxRooms'] ?? [])->sum('Adults');
        $children = collect($inputs['PaxRooms'] ?? [])->sum('Children');
    @endphp

    {{ $adults }} Adult{{ $adults > 1 ? 's' : '' }}
    @if($children > 0)
        , {{ $children }} Child
    @endif
</span>

    <span>•</span>
    <span>{{ \Carbon\carbon::parse($inputs['travel_date'])->format('d M') ?? '' }}</span>
    <span class="modify" id="modify">MODIFY</span>
</div>

                    </div>
                    <div class="section-header d-flex align-items-center mb-4 mt-3">
        <div class="section-icon">
            <i class="fas fa-info-circle"></i>
        </div>
        <h2 class="section-title mb-0  fs-5">PACKAGE OVERVIEW</h2>
    </div>

    <div>
        <div class="read-more-container">
            <div class="overview-description" id="overviewContent" style="text-align:justify">
            @php
    $overview = html_entity_decode($tour->description);

    // Match the first <p>...</p>
    if (preg_match('/<p\b[^>]*>.*?<\/p>/is', $overview, $match)) {
        $first = $match[0];
        $rest = trim(str_replace($first, '', $overview));
    } else {
        // Fallback: no <p>, split by first period
        $split = preg_split('/(\. )/', $overview, 2, PREG_SPLIT_DELIM_CAPTURE);
        $first = ($split[0] ?? '') . ($split[1] ?? '');
        $rest = $split[2] ?? '';
    }
    @endphp

    {!! $first !!}
    @if (!empty($rest))
        <div class="more-text">
            {!! $rest !!}
        </div>
    @endif



            </div>

            <button id="toggleBtn" class="mt-2 p-0" style="font-size: 12px">Read more</button>
        </div>
    </div>

     <div class="modal fade" id="enquiryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-0">
      
      <div class="modal-body  p-2">
      <form method="POST" action="{{ route('contact') }}" class="custom-form row g-1">
                            @csrf
                           

                            <div class="col-12 ">
                                <div class="px-2 mb-3">
                                    <div class="modal-header my-1 text-center bg-white py-1 px-0">
                                        <div class="d-flex justify-content-center">
                                            <h3 class="modal-title fw-bold text-center fs-5" id="staticBackdropLabel">Get
                                                Best Holiday Deals

                                            </h3>
                                        </div>
                                        <i type="button" data-bs-dismiss="modal" aria-label="Close"
                                            class="fa-solid fa-xmark text-dark" role="button"></i>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="duration">Package Name</label>
                                        <input type="text" name="package" id="duration" class="form-control" value="{{$tour->package_name .'-'. $cat->name .'-'. $tour['tourCategory']->name .'- Package' }}" readonly>
                                       
                                        @error('package')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <h6>Personal Details</h6>
                                    <hr>
                                    <div class="col-12 mb-3 mt-3">
                                        <input type="text" name="website" id="website" hidden>
                                        
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                            required>
                                        @error('name')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <input type="text" name="url" id="url" class="form-control d-none" value="{{ url()->current() }}" readonly>
                                    <div class="col-12  mb-3 mt-3 input-group">
                                        <select class="form-select form-select-sm rounded-0" name="code"
                                            id="contact_pre" aria-label="Country Code" required>
                                            <option value="+91" selected>+91</option>
                                            <option value="+1">+1</option>
                                            <option value="+7">+7</option>
                                            <option value="+20">+20</option>
                                            <option value="+27">+27</option>
                                            <option value="+30">+30</option>
                                            <option value="+31">+31</option>
                                            <option value="+32">+32</option>
                                            <option value="+33">+33</option>
                                            <option value="+34">+34</option>
                                            <option value="+36">+36</option>
                                            <option value="+39">+39</option>
                                            <option value="+40">+40</option>
                                            <option value="+41">+41</option>
                                            <option value="+43">+43</option>
                                            <option value="+44">+44</option>
                                            <option value="+45">+45</option>
                                            <option value="+46">+46</option>
                                            <option value="+47">+47</option>
                                            <option value="+48">+48</option>
                                            <option value="+49">+49</option>
                                            <option value="+51">+51</option>
                                            <option value="+52">+52</option>
                                            <option value="+53">+53</option>
                                            <option value="+54">+54</option>
                                            <option value="+55">+55</option>
                                            <option value="+56">+56</option>
                                            <option value="+57">+57</option>
                                            <option value="+58">+58</option>
                                            <option value="+60">+60</option>
                                            <option value="+61">+61</option>
                                            <option value="+62">+62</option>
                                            <option value="+63">+63</option>
                                            <option value="+64">+64</option>
                                            <option value="+65">+65</option>
                                            <option value="+66">+66</option>
                                            <option value="+81">+81</option>
                                            <option value="+82">+82</option>
                                            <option value="+84">+84</option>
                                            <option value="+86">+86</option>
                                            <option value="+90">+90</option>
                                            <option value="+91">+91</option>
                                            <option value="+92">+92</option>
                                            <option value="+93">+93</option>
                                            <option value="+94">+94</option>
                                            <option value="+95">+95</option>
                                            <option value="+98">++98</option>
                                           
                                        </select>
                                        <input type="text" name="mobile" id="mobile" placeholder="Contact Number"
                                            class="form-control" required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="pCount d-flex justify-content-between">
                                            <div class="pCountall adult">
                                                <span>Adult</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="adult" value="{{ old('adult', 1) }}"
                                                        id="adult" class="quantity__input" aria-label="Quantity"
                                                        readonly>
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                            <div class="pCountall child">
                                                <span>Child (2-5 yr's)</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="child" value="{{ old('child', 0) }}"
                                                        id="child" class="quantity__input" aria-label="Quantity"
                                                        readonly>
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                            <div class="pCountall infant">
                                                <span>Infant (0-2 yr's)</span>
                                                <div class="quantity">
                                                    <a href="#" class="quantity__minus"><span>-</span></a>
                                                    <input type="text" name="infant" value="{{ old('infant', 0) }}"
                                                        id="infant" class="quantity__input" aria-label="Quantity">
                                                    <a href="#" class="quantity__plus"><span>+</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <input type="text" name="checkin" placeholder="dd-mm-yyyy" id="tourcheckin"
                                            class="form-control" readonly>
                                        @error('date')
                                        <span class="invalid-feedback error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    

                                    <div class=" mt-3">
                                        <button type="submit"
                                            class="btn btn-lg default-btn fs-6 rounded-0 w-100 fw-bolder text-light justify-content-center">Enquire
                                            Now</button>
                                        <a type="button" href="tel:+918900909900"
                                            class="btn btn-lg call-btn fs-6 rounded-0 w-100 fw-bolder text-light mt-1 justify-content-center"><i
                                                class="fa-solid fa-phone"></i> +91 8900909900 </a>
                                    </div>
                                </div>
                            </div>
                        </form>
      </div>

    </div>
  </div>
</div>
                    <!-- <div class="overview-highlights">
                        <div class="overview-highlight">
                            <div class="highlight-icon">
                                <i class="fas fa-hotel"></i>
                            </div>
                            <div class="highlight-text">Luxury Accommodation</div>
                        </div>
                        <div class="overview-highlight">
                            <div class="highlight-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="highlight-text">Breakfast & Dinner</div>
                        </div>
                        <div class="overview-highlight">
                            <div class="highlight-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="highlight-text">All Transfers</div>
                        </div>
                    </div> -->

                    
                    <section class="journey-timeline-section mt-3">
                        <div class="container">
                            <div class="journey-header">
                                <h2 class="section-title">Detailed Itinerary: <span class="text-gradient fs-6">{{ $tour->nights }}
                                        Nights {{ $tour->days }} Days</span></h2>
                                @if(isset($totalAmt))
                                    <div class="mt-2">
                                        <span class="badge bg-primary fs-6">Trip Total: ₹{{ number_format($totalAmt, 2) }}</span>
                                    </div>
                                @endif
                            </div>


                            <div class="accordion" id="journeyAccordion">
                                @foreach ($itineraries as $dayIndex => $day)
                                    @php
                                        $accommodation = $day['accommodation'] ?? null;
                                        $hotelsForDay = $day['hotels'] ?? [];
                                        $totals = $day['totals'] ?? [];
                                        
                                        // Debug: Log day data for troubleshooting
                                        if (empty($totals)) {
                                            \Log::warning("Day {$dayIndex} has no totals", [
                                                'day_data' => $day,
                                                'accommodation' => $accommodation,
                                                'hotels_count' => count($hotelsForDay)
                                            ]);
                                        }
                                    @endphp
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $day['dayNumber'] }}">
                                            <button class="accordion-button {{ $dayIndex === 0 ? '' : 'collapsed' }}" data-date="{{ $day['date'] }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $day['dayNumber'] }}"
                                                aria-expanded="{{ $dayIndex === 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $day['dayNumber'] }}">
                                                Day {{ $day['dayNumber'] }} - {{ \Carbon\Carbon::parse($day['date'])->format('d M') }} : <p class="ps-1 fw-bold"> {{ $day['title'] }}</p> 
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $day['dayNumber'] }}"
                                            class="accordion-collapse collapse {{ $dayIndex === 0 ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $day['dayNumber'] }}" data-bs-parent="#journeyAccordion">
                                            <div class="accordion-body">
                                                <p>{!! $day['description'] !!}</p>
                                                @if (!empty($day['activities']))
                                                    <div class="tour-hotel-display mb-3" style="display: none;">
                                                        <h4 class="tour-hotel-heading mb-2 fs-6"><i class="fa-solid fa-person-hiking me-2"></i> Activities</h4>
                                                        <div class="tour-hotel-card d-flex flex-wrap flex-column rounded shadow-sm p-2 align-items-start">
                                                            @foreach ($day['activities'] as $activity)
                                                                <div class="mb-1">
                                                                    <p style="font-size:14px;" class="fw-bold">{{ $activity['name'] }}</p>
                                                                    @if(!empty($activity['location']))<span class="text-muted" style="font-size:10px;"> — {{ $activity['location'] }}</span>@endif
                                                                    @if(isset($activity['price']))<span class="ms-2">₹{{ number_format($activity['price'], 2) }}</span>@endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (!empty($accommodation))
                                                
                                                    <div class="tour-hotel-display hotel-lists mb-3">
                                                        <h5 class="tour-hotel-heading mb-2"><i class="fa-solid fa-hotel me-2"></i> Accommodation @if(!empty($accommodation['location'])) In {{ $accommodation['location'] }} @endif</h5>
                                                        <div class="tour-hotel-card d-flex rounded shadow-sm p-2 align-items-start position-relative">
                                                            <img src="{{ $accommodation['hotel_image'] ?? 'https://andamanbliss.com/storage/hotel_photo/photo-20240921-050325-1060733771.jpg' }}" id="selected-hotel-image-{{ $dayIndex }}" loading="eager" decoding="async"
                                                                alt="{{ $accommodation['hotel_name'] ?? 'No hotel selected' }}"
                                                                class="tour-hotel-image me-3">
                                                            <div class="tour-hotel-info">
                                                                <h6 class="mb-1 tour-hotel-name selected-hotel-name" id="selected-hotel-name-{{ $dayIndex }}">
                                                                    {{ $accommodation['hotel_name'] ?? 'No hotel selected' }}
                                                                </h6>
                                                                @if(!empty($accommodation['address']))
                                                                    <p class="selected-hotel-address mb-1" id="selected-hotel-address-{{ $dayIndex }}">{{ $accommodation['address'] }}</p>
                                                                @endif
                                                                <div class="mb-1">
                                                                    <span class="small fw-semibold">Room Category: </span>
                                                                    <span class="selected-room-name" id="selected-room-name-{{ $dayIndex }}">
                                                                        {{ $accommodation['selected_room']['Name'][0] ?? 'No room selected' }}
                                                                    </span>
                                                                </div>
                                                                <div class="mb-1" style="font-size: 12px;">
                                                                    <span class="small fw-semibold">Meal Plan: </span>
                                                                    <span class="selected-room-meal" id="selected-room-meal-{{ $dayIndex }}">
                                                                        Breakfast Only
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <span id="selected-hotel-price-{{ $dayIndex }}" class="d-none">{{ $accommodation['selected_room']['TotalFare'] ?? 0 }}</span>
                                                            <span id="selected-room-price-{{ $dayIndex }}" class="d-none">{{ $accommodation['selected_room']['TotalFare'] ?? 0 }}</span>
                                                            <input type="hidden" name="selected_hotels[{{ $dayIndex }}]" id="selected-hotel-id-{{ $dayIndex }}"
                                                                value="{{ $accommodation['selected_room']['BookingCode'] ?? '' }}">
                                                            <input type="hidden" name="selected_hotel_prices[{{ $dayIndex }}]" id="selected-hotel-price-input-{{ $dayIndex }}"
                                                                value="{{ $accommodation['selected_room']['TotalFare'] ?? 0 }}">
                                                            <input type="hidden" name="selected_room_id[{{ $dayIndex }}]" id="selected-room-id-{{ $dayIndex }}"
                                                                value="{{ $accommodation['selected_room']['BookingCode'] ?? '' }}">
                                                            <input type="hidden" name="selected_room_price[{{ $dayIndex }}]" id="selected-room-price-input-{{ $dayIndex }}"
                                                                value="{{ $accommodation['selected_room']['TotalFare'] ?? 0 }}">
                                                            <input type="hidden" name="selected_hotel_codes[{{ $dayIndex }}]" id="selected-hotel-code-{{ $dayIndex }}"
                                                                value="{{ $accommodation['hotel_code'] ?? '' }}">
                                                            <div class="d-flex flex-column">
                                                                <button type="button" class="btn btn-outline-primary btn-sm"
                                                                    data-day-index="{{ $dayIndex }}"
                                                                    data-hotels='@json($day["hotels"] ?? [])'
                                                                    onclick="openOffcanvas(this, 'hotel')"
                                                                    data-debug="hotels: {{ count($day['hotels'] ?? []) }}">
                                                                    Change Hotel ({{ count($day['hotels'] ?? []) }})
                                                                </button>
                                                                <button type="button" style="display: none;" class="btn btn-outline-secondary btn-sm mt-1 hidden"
                                                                    data-day-index="{{ $dayIndex }}"
                                                                    data-hotel-code="{{ $accommodation['hotel_code'] ?? '' }}"
                                                                    data-hotels='@json($day["hotels"] ?? [])'
                                                                    onclick="openOffcanvas(this, 'room')">
                                                                    Change Room
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (!empty($day['ferries']))
                                                    <div class="tour-hotel-display mb-3">
                                                        <h5 class="tour-hotel-heading mb-2"><i class="fa-solid fa-ship me-2"></i> Transfers</h5>
                                                        @foreach ($day['ferries'] as $transferKey => $transfer)
                                                            @php $sf = $transfer['selected_ferry'] ?? null; @endphp
                                                            <div class="tour-hotel-card d-flex rounded shadow-sm p-2 align-items-start position-relative mb-2">
                                                                <img src="{{ $sf->image ?? '' }}" loading="eager" decoding="async"
                                                                    alt="{{ $sf->ferry_name ?? 'No Ferry' }}" class="tour-hotel-image me-3">
                                                                <div class="tour-hotel-info">
                                                                    <h6 class="mb-1 tour-hotel-name">
                                                                        {{ $sf->ferry_name ?? 'No Ferry Selected' }}
                                                                    </h6>
                                                                    <p class="mb-1 text-muted">
                                                                        {{ $transfer['from'] ?? '' }} to {{ $transfer['to'] ?? '' }}
                                                                    </p>
                                                                    <p class="mb-1">
                                                                        Departure: {{ $sf->departure ?? 'N/A' }} |
                                                                        Arrival: {{ $sf->arraival ?? 'N/A' }}
                                                                    </p>
                                                                    <p class="mb-1">
                                                                        Class: {{ $sf->classes[0]->class_name ?? 'N/A' }}
                                                                    </p>
                                                                    @php $fare = (float) ($sf->fare ?? 0) + (float) ($sf->port_fee ?? 0); @endphp
                                                                    <p class="mb-0 fw-semibold" style="display: none;">₹{{ number_format($fare, 2) }}</p>
                                                                </div>
                                                                <input type="hidden" class="tour-ferry-name"
                                                                    name="selected_ferry[{{ $dayIndex }}][{{ $transferKey }}]"
                                                                    value='@json($sf)'>
                                                                <input type="hidden" name="selected_ferry_fares[{{ $dayIndex }}][{{ $transferKey }}]"
                                                                    value="{{ $fare }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                @if (!empty($totals))
                                                    <div class="border rounded p-2 bg-light" style="display: none;">
                                                        <div class="d-flex flex-wrap gap-3 small">
                                                            <div><strong>Hotel:</strong> <span id="day-hotel-total-text-{{ $dayIndex }}">₹{{ number_format($totals['hotelTotal'] ?? 0, 2) }}</span></div>
                                                            <div><strong>Ferry:</strong> <span id="day-ferry-total-text-{{ $dayIndex }}">₹{{ number_format($totals['ferryTotal'] ?? 0, 2) }}</span></div>
                                                            <div><strong>Activities:</strong> <span id="day-activity-total-text-{{ $dayIndex }}">₹{{ number_format($totals['activityTotal'] ?? 0, 2) }}</span></div>
                                                            <div><strong>Services:</strong> <span id="day-service-total-text-{{ $dayIndex }}">₹{{ number_format($totals['serviceTotal'] ?? 0, 2) }}</span></div>
                                                            <div class="ms-auto"><strong>Day Total:</strong> <span id="day-total-text-{{ $dayIndex }}">₹{{ number_format($totals['dayTotal'] ?? 0, 2) }}</span></div>
                                                        </div>
                                                        <input type="hidden" id="day-hotel-total-{{ $dayIndex }}" value="{{ (float)($totals['hotelTotal'] ?? 0) }}">
                                                        <input type="hidden" id="day-ferry-total-{{ $dayIndex }}" value="{{ (float)($totals['ferryTotal'] ?? 0) }}">
                                                        <input type="hidden" id="day-activity-total-{{ $dayIndex }}" value="{{ (float)($totals['activityTotal'] ?? 0) }}">
                                                        <input type="hidden" id="day-service-total-{{ $dayIndex }}" value="{{ (float)($totals['serviceTotal'] ?? 0) }}">
                                                        <input type="hidden" id="day-total-{{ $dayIndex }}" value="{{ (float)($totals['dayTotal'] ?? 0) }}">
                                                    </div>
                                                @else
                                                    <div class="border rounded p-2 bg-warning" style="display: none;">
                                                        <small class="text-muted">Debug: No totals for day {{ $dayIndex }}</small>
                                                        <div class="small">
                                                            Day data: {{ json_encode($day) }}
                                                        </div>
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


                    <section class="pkg-terms-wrap" aria-labelledby="ctTitle">
                        <div class="container">
                            <div class="terms-trigger">
                                <h3 class="ct-subtitle fs-6 terms-hover border p-3" role="button" tabindex="0" aria-expanded="false">
                                    <span class="terms-title fw-bold">*Package Cancellation Policy</span>
                                    <span class="terms-arrow" aria-hidden="true"><i class="fa-solid fa-chevron-down"></i></span>
                                </h3>
                                
                                <div class="terms-content">
@php
use Carbon\Carbon;

$cancellationDeadline = Carbon::now()->addDay();
$cancellationDeadlineFormatted = $cancellationDeadline->format('jS M y');
@endphp

<p class="ct-lead success">
    Cancellation Possible till {{ $cancellationDeadlineFormatted }}.*
</p>
                                    <p class="ct-lead muted">After that Package is <strong>Non-Refundable</strong>.</p>

                                    <div class="ct-rail" role="img" aria-label="Cancellation allowed until 5th Oct. After that non-refundable.">
                                        <span class="ct-rail__marker ok" aria-hidden="true">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <span class="ct-rail__marker no" aria-hidden="true">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </div>

                                    <div class="ct-rail-labels">
    <div class="ct-rail-left">
        <div class="lbl-title">CANCELLATIONS WITHIN 24 HOURS</div>
        <div class="lbl-sub">CANCELLATION CHARGE ₹7000</div>
    </div>
    <div class="ct-rail-right">
        <div class="lbl-title bad">CANCELLATIONS AFTER 24 HOURS</div>
        <div class="lbl-sub muted">NON REFUNDABLE</div>
    </div>
</div>


                                    <!-- Notes Box -->
                                    <div class="ct-notes" role="region" aria-label="Important notes">
                                        <ul class="ct-bullets">
                                            <li>These are non-refundable amounts as per the current components attached. In the case of component
                                                change/modifications, the policy will change accordingly.</li>
                                            <li>Please check the exact cancellation and date change policy on the review page before proceeding
                                                further.</li>
                                            <li>Please note, TCS once collected cannot be refunded in case of any cancellation / modification. You
                                                can claim the TCS amount as adjustment against Income Tax payable at the time of filing the return
                                                of income.</li>
                                            <li>Cancellation charges shown is exclusive of all taxes and taxes will be added as per applicable.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sharedOffcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel"></h5>
            <button type="button" class="btn-close text-reset" onclick="closeOffcanvas()" aria-label="Close">×</button>
        </div>
        <div class="offcanvas-body">
            <div id="hotelOptionsContainer" style="display: none;"></div>
            <div id="roomOptionsContainer" style="display: none;"></div>
        </div>
    </div>

    <!-- Test button for debugging -->
    <!-- Button trigger modal -->
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

<!-- Modal -->

    </div>
        </div>
    
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
                                <div class="modal-input-wrapper modal-date-wrapper">
                                    <input type="text" class="modal-search-input datepicker" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="travelDate" value=" {{ $inputs['travel_date'] ?? \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="choose travel date" name="travel_date" required readonly>
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
.modal-guest-dropdown-box::-webkit-scrollbar {
    display: none;
}

.hotel-lists {
     display: none;
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
        font-size: clamp(11px, 2vw, 18px);

    }
    .modify-search-box .modify {
      color: #007bff;
      font-weight: 600;
      cursor: pointer;
    }
    .modify-search-box .modify:hover {
      text-decoration: underline;
    }
    .modify-search-box {display: none;}



            #expert-btn {
             display: none !important;
            }
            .room-guest {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
    -ms-overflow-style: none;  /* IE & Edge */
    scrollbar-width: none;     /* Firefox */
                    font-size: 12px;

}
.payment-mode-lst-img{
width:100%;
}
.price-inclu-title {
    background-color: #D7F0FF;
    padding: 2px 15px;
    border-radius: 15px;
    margin-bottom: 20px;
}
.pkg-list-inclu {
    font-size: 10px;
}

.room-guest::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}
            
            .sticky-top {
        top: 72px !important;
            }
            .summary-bar-wrapper {
        background: #fff;
        padding: 10px 15px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 420px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }
    .tour-type-cata-lst li{
        background-color:#FF5722;
        padding:0px 15px;
        border-radius:25px;
        color:#fff;
    }
    .tour-type-cata-lst li a{
        color:#fff;
        text-decoration:none;
    }
    .pkg-cat-list-section{
        background-color:#d9faff;
        padding:5px 10px;
        color:#fff;
        box-size:border-box;
        border:1px solid #119DD5;
        color:#119DD5;
        border-radius:3px;
          text-align:center;
         transition: all 0.3s ease;
     font-size: 12px;

        
    }
    .pkg-cat-list-section:hover {
    background-color:#119DD5;
    color: #fff !important;
}
    .pkg-cata-active{
        background-color:#119DD5;
        color:#fff;
         border-radius:3px;
         text-align:center;

    }
    .exclusions{
        background-color:#FBEBEB;
       
    }
    .exclusions i {
        color:red !important;
    }
    .exclusions > .package-header-icon{
        width:20px;
        height:20px;
    }
    .inclusion{
        background-color:#EAFAEA;
        
    }
    .inclusion i {
        color:#63C266 !important;
    }
.price-header-background{
    background:linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%);
}
    .summary-bar-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .summary-info {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        font-size: 14px;
        font-weight: 500;
        gap: 4px;
    }

    .summary-item {
        color: #000;
        white-space: nowrap;
    }

    .dot-separator {
        font-size: 14px;
        color: #888;
    }

    .modify-btn {
        background: #fff;
        border: 2px solid #2196f3;
        color: #2196f3;
        padding: 4px 10px;
        font-size: 13px;
        font-weight: bold;
        border-radius: 20px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .modify-btn:hover {
        background: #2196f3;
        color: #fff;
    }

            #page-loader {
        transition: opacity 0.3s ease;
    }
            .tour-hotel-display {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 16px;
    }
    .seo-detailed-highlight {
        background:linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%) !important;
    }

    .seo-detailed-highlight i{
    color: #002246 !important;
    }
    .seo-detailed-highlight span{
    color: #002246 !important;
    }
    .seo-card-icon i{
    color: white !important;
    }
    .tour-dynamic-section {
        position: relative;
        top: 66px;
    }

    .tour-hotel-heading {
        font-size: 0.825rem;
        font-weight: 600;
        color: #333;
        border-left: 3px solid #0d6efd;
        padding-left: 8px;
        margin-bottom: 10px;
    }

    .tour-hotel-card {
        display: flex;
        gap: 12px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        padding: 12px;
        align-items: flex-start;
        position: relative;
    }

    .tour-hotel-image {
        width: 100px;
        height: 75px;
        object-fit: cover;
        border-radius: 6px;
    }

    #hotelSelectCanvas{
    width: 40% !important;
    }
    #sharedOffcanvas{
    width: 60% !important;
    }

    .offcanvas-header {
        padding: 12px 16px;
        border-bottom: 1px solid #e9ecef;
        position: sticky;
        top: 0;
        background: #fff;
        z-index: 2;
    }

    .offcanvas-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .offcanvas-body {
        padding: 16px;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        flex: 1 1 auto;
    }

    /* Fallback offcanvas styles in case Bootstrap is not loaded */
    .offcanvas {
        position: fixed;
        top: 0;
        right: 0;
        z-index: 1045;
        width: 60%;
        height: 100vh;
        background-color: #fff;
        border-left: 1px solid #dee2e6;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        visibility: hidden;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
    }

    .offcanvas.show {
        transform: translateX(0) !important;
        visibility: visible !important;
        display: block !important;
    }

    .offcanvas-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
    }

    .offcanvas.show + .offcanvas-backdrop {
        display: block;
    }

    .offcanvas-open {
        overflow: hidden;
    }

    /* Force show when needed */
    .offcanvas[style*="display: none"] {
        display: block !important;
    }

    .offcanvas.show[style*="display: none"] {
        display: block !important;
    }

    /* Emergency override styles */
    .offcanvas.show {
        display: block !important;
        visibility: visible !important;
        transform: translateX(0) !important;
        opacity: 1 !important;
        z-index: 9999 !important;
    }

    /* Debug styles */
    .offcanvas {
        border: 2px solid red !important;
    }

    .offcanvas.show {
        border: 2px solid green !important;
    }

    @media (max-width: 768px) {
        .offcanvas {
            width: 100%;
        }
        .tour-hotel-name {
        font-size: 0.75rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }
    }
    @media only screen and (max-width: 1002px){
        #sharedOffcanvas{
    width: 100% !important;
    }
    }
    .tour-hotel-info {
        flex: 1;
    }

    .tour-hotel-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }

    .tour-hotel-amenities {
        margin-top: 10px;
        color: #6c757d;
    }

    .tour-hotel-amenities li {
        margin-right: 15px;
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .selected-hotel-address {
        font-size: 0.85rem;
        color: #6c757d;
        line-height: 1.3;
    }

    .tour-hotel-card span {
        font-weight: 600;
        color: #212529;
        /* position: absolute; */
        top: 15px;
        right: 15px;
        font-size:12px
    }

    .tour-hotel-card .btn {
    width: 100%;
    height: 28px;
    font-size: 0.75rem;
    }

    .tour-activity-list p {
        margin-bottom: 5px;
        padding-left: 25px;
        position: relative;
    }

    .tour-activity-list p::before {
        content: "🎯";
        position: absolute;
        left: 0;
        top: 2px;
    }

    @media (max-width: 576px) {
        .tour-hotel-card {
            flex-direction: column;
            align-items: stretch;
                    gap: 8px;
        }

        .tour-hotel-image {
            width: 100%;
                    height: 120px;
                    object-fit: cover;
        }

        .tour-hotel-card span,
        .tour-hotel-card .btn {
            position: static;
                    margin-top: 8px;
                }

                .tour-hotel-display {
                    padding: 8px;
                    margin-bottom: 12px;
                }

                .accordion-body {
                    padding: 8px;
                }

                .hotel-selection-image {
                    width: 100%;
                    height: 100px;
                }

                .hotel-selection-card {
                    padding: 8px;
                    margin-bottom: 8px;
        }
    }

            .tour-pricing-card {
        max-width: 400px;
        margin: auto;
        background-color: #fff;
    }

    .tour-pricing-discount {
        text-decoration: line-through;
    }

    .tour-pricing-final {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .tour-pricing-cta button {
        width: 100%;
    }

    .tour-pricing-applied {
        border-color: #dee2e6;
    }

            .hotel-search-form-wrapper {
                background: #119DD5;
                padding: 10px 0;
                position: sticky;
                top: 65px;
                z-index: 1000;
                height: 80px;
                display: flex;
                align-items: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }

            .hotel-search-form-main {
                width: 100%;
                height: 100%;
            }

            .hotel-search-form-row {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: nowrap;
                height: 100%;
            }

            .hotel-search-field-group {
                flex: 1;
                position: relative;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .hotel-search-button-group {
                flex: 0 0 auto;
                height: 100%;
                display: flex;
                align-items: center;
            }

            .hotel-search-label {
                display: block;
                color: white;
                font-size: 9px;
                font-weight: 600;
                letter-spacing: 0.5px;
                margin-bottom: 3px;
                text-transform: uppercase;
                line-height: 1;
            }

            .hotel-search-input-wrapper {
                position: relative;
                background: white;
                border-radius: 4px;
                overflow: hidden;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
                /* height: 40px; */
            }

           .hotel-search-input {
    display: inline-block;
    width: 100%;
    padding: 6px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: #fff;
    height: 30px;
}

.hotel-search-input {
    display: block;
    font-size:12px;
    width: 100%;
}


            .hotel-search-input::placeholder {
                color: #666;
                font-size: 12px;
            }

            .hotel-search-input:focus {
                outline: 1px solid #60a5fa;
            }

            .hotel-search-icon {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: #666;
                font-size: 14px;
                pointer-events: none;
            }

            .hotel-date-input {
                cursor: pointer;
                position: relative;
            }

            .hotel-date-input::-webkit-calendar-picker-indicator {
                opacity: 0;
                position: absolute;
                right: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .hotel-date-input::-moz-calendar-picker-indicator {
                opacity: 0;
                position: absolute;
                right: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .date-input-wrapper::after {
                content: '\f073';
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: #666;
                font-size: 14px;
                pointer-events: none;
                z-index: 1;
            }

            .hotel-search-btn {
                background: linear-gradient(93deg, #0a223d, #0a223d);
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 30px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 0.5px;
                cursor: pointer;
                transition: all 0.3s ease;
                text-transform: uppercase;
                min-width: 100px;
                height: 40px;
            }

            .hotel-search-btn:hover {
                background: #0a223d;
                transform: translateY(-1px);
                box-shadow: 0 2px 8px rgba(96, 165, 250, 0.4);
            }

            .guest-dropdown-box {
                z-index: 1000;
                display: none;
            }

            .guest-dropdown-box.show {
                display: block;
            }
.search-modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); backdrop-filter: blur(10px); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 10px; }
.search-modal-container { background: linear-gradient(135deg, #03A9F4 0%, #00BCD4 100%); border-radius: 15px; padding: 20px; max-width: 800px; width: 100%; box-shadow: 0 25px 50px rgba(0,0,0,0.3); }
.search-modal-header { text-align: center; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
.search-modal-header h3 { color: white; font-size: 16px; font-weight: 600; }
.search-modal-form { margin-bottom: 20px; }
.modal-form-row { display: flex; gap: 10px; flex-wrap: wrap; }
.modal-field-group { flex: 1; min-width: 200px; }
.modal-field-label { color: white; font-size: 10px; font-weight: 600; letter-spacing: 1px; margin-bottom: 8px; text-transform: uppercase; }
.modal-input-wrapper { position: relative; background: white; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
.modal-search-input { width: 100%; padding: 12px 40px 12px 12px; border: none; outline: none; font-size: 13px; font-weight: 500; color: #333; }
.modal-search-input:focus { outline: 2px solid #60a5fa; }
.modal-input-icon { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #666; font-size: 14px; }
.modal-date-input { cursor: pointer; }
.modal-date-input::-webkit-calendar-picker-indicator { opacity: 0; position: absolute; right: 0; width: 100%; height: 100%; cursor: pointer; }
.modal-date-wrapper::after { content: '\f073'; font-family: 'Font Awesome 5 Free'; font-weight: 900; position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #666; font-size: 14px; }
.search-modal-footer { display: flex; justify-content: center; }
.modal-next-btn { padding: 10px 25px; border: none; border-radius: 30px; font-size: 13px; font-weight: 600; text-transform: uppercase; min-width: 120px; background: linear-gradient(93deg, #0A223D, #0A223D); color: #fff; }
.modal-next-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(96,165,250,0.4); }

            /* .search-modal-form {
                margin-bottom: 30px;
            } */

            .modal-form-row {
                display: flex;
                gap: 20px;
                align-items: end;
                flex-wrap: wrap;
            }

            .modal-field-group {
                flex: 1;
                min-width: 200px;
                position: relative;
            }

           .modal-field-label { color: white; font-size: 10px; font-weight: 600; letter-spacing: 1px; margin-bottom: 8px; text-transform: uppercase; }

            .modal-input-wrapper {
                position: relative;
                background: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

             .modal-guest-wrapper {
    background: white;
    border-radius: 8px;
   
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);

}


           .modal-search-input { width: 100%; padding: 12px 40px 12px 12px; border: none; outline: none; font-size: 13px; font-weight: 500; color: #333; }
.modal-search-input:focus { outline: 2px solid #60a5fa; }

            .modal-input-icon {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #666;
                font-size: 16px;
                pointer-events: none;
            }

            .modal-date-input {
                cursor: pointer;
                position: relative;
            }

            .modal-date-input::-webkit-calendar-picker-indicator {
                opacity: 0;
                position: absolute;
                right: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .modal-date-input::-moz-calendar-picker-indicator {
                opacity: 0;
                position: absolute;
                right: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .modal-date-wrapper::after {
                content: '\f073';
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #666;
                font-size: 16px;
                pointer-events: none;
                z-index: 1;
            }

            .modal-guests-dropdown {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border-radius: 8px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                padding: 20px;
                margin-top: 8px;
                display: none;
                border: 1px solid #e5e7eb;
            }

            .modal-guests-dropdown.show {
                display: block;
            }

            .modal-guests-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px 0;
                border-bottom: 1px solid #f3f4f6;
            }

            .modal-guests-row:last-child {
                border-bottom: none;
            }

            .modal-guests-label {
                font-size: 16px;
                font-weight: 500;
                color: #333;
            }

            .modal-guests-counter {
                display: flex;
                align-items: center;
                gap: 20px;
            }

            .modal-counter-btn {
                width: 36px;
                height: 36px;
                border: 2px solid #d1d5db;
                background: white;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                font-size: 18px;
                font-weight: 600;
                color: #374151;
                transition: all 0.2s ease;
            }

            .modal-counter-btn:hover {
                background: #f9fafb;
                border-color: #9ca3af;
            }

            .modal-counter-btn:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .modal-counter-value {
                font-size: 16px;
                font-weight: 600;
                color: #333;
                min-width: 25px;
                text-align: center;
            }

            .search-modal-footer {
                display: flex;
                justify-content: center;
                gap: 20px;
            }


            @media (max-width: 768px) {
                .search-modal-container {
                    padding: 20px;
                    margin: 10px;
                }

                .modal-form-row {
                    flex-direction: column;
                    gap: 15px;
                }

                .modal-field-group {
                    min-width: 100%;
                }
            @media (max-width: 768px) {
        
         .hotel-search-form-wrapper { display: none;}
             .modify-search-box {display: flex; height: 5vh; background: linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%); width: 100%;}

    }


                .search-modal-footer {
                    flex-direction: column;
                    gap: 15px;
                }

                .modal-skip-btn,
                .modal-next-btn {
                    width: 100%;
                }

                .hotel-search-form-wrapper {
                    height: 100px;
                    padding: 5px 0;
                }

                .hotel-search-form-row {
                    flex-direction: column;
                    gap: 8px;
                    height: 100%;
                    justify-content: center;
                }

                .hotel-search-field-group {
                    height: auto;
                }

                .hotel-search-button-group {
                    width: 100%;
                    height: auto;
                }

                .hotel-search-btn {
                    width: 100%;
                    padding: 8px;
                    height: 35px;
                    font-size: 11px;
                }

              

                .hotel-search-input {
                    font-size: 11px;
                    padding: 6px 30px 6px 8px;
                }

                .hotel-search-label {
                    font-size: 8px;
                    margin-bottom: 2px;
                }
            }
           
            .modal-title{
                color: #000000 !important;
            }
            @media (max-width: 480px) {
                .search-modal-header h3 {
                    font-size: 16px;
                }

                .modal-search-input {
                    padding: 12px 40px 12px 12px;
                    font-size: 13px;
                }

                .modal-field-label {
                    font-size: 10px;
                }

             

              

                .hotel-search-form-row {
                    gap: 6px;
                }

                .hotel-search-input {
                    font-size: 10px;
                    padding: 5px 25px 5px 6px;
                }

                .hotel-search-label {
                    font-size: 7px;
                    margin-bottom: 1px;
                }

                .hotel-search-icon {
                    font-size: 12px;
                    right: 8px;
                }

                .hotel-search-btn {
                    height: 30px;
                    font-size: 10px;
                    min-width: 80px;
                }
                    .section-title{
                    font-size: 1.2rem !important;
                }
                .tour-location{
                    font-size:12px;
                }
            }

            .seo-content {
                max-width: 100% !important;
            }

            .tour-hotel-offcanvas {
                width: 50% !important;
            }

            @media only screen and (max-width: 768px) {
                .tour-hotel-offcanvas {
                    width: 90% !important;
                }
 .tour-pricing-cta {position:fixed; bottom: 0; left: 0; right: 0; background: #fff; padding: 10px; z-index: 1000; display: none; }

            }

            .tour-hotel-display {
                border-top: 1px solid #f0f0f0;
                padding-top: 12px;
            }

            /* Additional minimal styling */
            .section-title {
                font-size: 1.2rem;
                font-weight: 600;
                color: #333;
                
            }

            .text-gradient {
                background: linear-gradient(135deg, #FF5722, #F44336)
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .badge {
                font-size: 0.75rem;
                padding: 4px 8px;
                border-radius: 4px;
            }

            .btn-link {
                text-decoration: none;
                border: none;
                background: none;
                color: #0d6efd;
                padding: 0;
                font-size: 0.8rem;
            }

            .btn-link:hover {
                color: #0a58ca;
                text-decoration: underline;
            }

            .tour-hotel-card {
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 12px;
                overflow: hidden;
                display: flex;
                gap: 16px;
                padding: 16px;
            }

            .tour-hotel-image {
                width: 120px;
                height: 90px;
                object-fit: cover;
                border-radius: 8px;
            }

            .tour-hotel-info {
                flex: 1;
            }

            .tour-hotel-name {
                font-size: 0.825rem;
                font-weight: 600;
            }

            .tour-hotel-stars {
                font-size: 0.9rem;
            }

            .tour-hotel-change-btn {
                font-size: 0.85rem;
                text-decoration: underline;
                color: #007bff;
                border: none;
                background: none;
            }

            .tour-hotel-modal .modal-title {
                font-weight: 600;
            }

            .tour-hotel-option {
                background-color: #fff;
                border: 1px solid #e9ecef;
                border-radius: 8px;
                transition: all 0.2s ease;
            }

            .tour-hotel-option:hover {
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                border-color: #0d6efd;
            }

            /* Offcanvas hotel/room selection styling */
            .hotel-selection-card {
                border: 1px solid #e9ecef;
                border-radius: 8px;
                padding: 12px;
                margin-bottom: 12px;
                background: #fff;
                transition: all 0.2s ease;
            }

            .hotel-selection-card:hover {
                border-color: #0d6efd;
                box-shadow: 0 2px 8px rgba(13, 110, 253, 0.1);
            }

            .hotel-selection-image {
                width: 200px;
                height: 130px;
                object-fit: cover;
                border-radius: 6px;
            }

            .hotel-selection-info h6 {
                font-size: 0.95rem;
                font-weight: 600;
                margin-bottom: 6px;
            }

            .hotel-selection-info p {
                font-size: 0.85rem;
                color: #6c757d;
                margin-bottom: 4px;
            }

            .price-difference {
                font-size: 0.9rem;
                font-weight: 600;
            }

            .price-difference.positive {
                color: #dc3545;
            }

            .price-difference.negative {
                color: #198754;
            }

            /* Pagination styles */
            .pagination-controls {
                background: #f8f9fa;
                border-radius: 8px;
                padding: 12px;
                margin-bottom: 16px;
            }

            .pagination-controls h6 {
                margin-bottom: 4px;
                color: #333;
            }

            .pagination-controls small {
                color: #6c757d;
            }

            .pagination-controls .btn {
                font-size: 0.8rem;
                padding: 4px 8px;
            }

            .pagination-controls .btn:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .search-filter {
                margin-bottom: 16px;
            }

            .search-filter .form-control {
                font-size: 0.9rem;
                border-radius: 6px;
            }

            .search-filter .btn {
                font-size: 0.8rem;
                padding: 6px 12px;
            }

            .tour-hotel-option-img {
                width: 100px;
                height: 75px;
                object-fit: cover;
                border-radius: 6px;
            }

            .tour-hotel-option-name {
                font-weight: 600;
            }

            .journey-timeline-section {
                position: relative;
                overflow: hidden;
            }

            .journey-header {
                margin-top:20px;
                margin-bottom: 20px;
                position: relative;
            }
            .journey-header > .section-title{
                font-size:16px;
            }

            .journey-title {
                font-size: 2.5rem;
                font-weight: 700;
                color: #1e3a8a;
                text-transform: uppercase;
                position: relative;
                padding: 10px 20px;
                background: #d1e7ff;
                border: 2px solid #1e3a8a;
                border-radius: 10px;
                display: inline-block;
            }

            .accordion {
                position: relative;
                padding: 0;
            }

            .accordion-item {
                margin-bottom: 8px;
            }

            .accordion-button {
                font-size:14px !important;
                font-weight: 600;
                color: #FF5722;
                background: #ffffff;
                border: 1px solid #e9ecef;
                border-radius: 6px;
                box-shadow: none;
                padding: 10px 15px;
                flex-wrap: wrap;
            }

            .accordion-button:not(.collapsed) {
                background: #d1e7ff;
                color: #FF5722;
                box-shadow: none;
            }

            .accordion-button:focus {
                box-shadow: none !important;
            }

            .accordion-body {
                padding: 12px;
                background: #ffffff;
                border: 1px solid #e9ecef;
                border-top: none;
                border-radius: 0 0 6px 6px;
            }

            .step-description {
                font-size: 1.1rem;
                color: #333;
                margin-bottom: 15px;
            }

            .stay-card {
                border: 1px solid #ced4da;
                border-radius: 8px;
                padding: 10px;
                background: #fff;
                margin-top: 10px;
            }

            .stay-image {
                border-radius: 8px;
                max-height: 100px;
                object-fit: cover;
                width: 100%;
            }

            .stay-details {
                padding: 5px 0;
            }

            .stay-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 5px;
            }

            .stay-name {
                font-size: 1.2rem;
                margin: 0;
                color: #1e3a8a;
            }

            .stay-rating {
                background: #28a745;
                color: white;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.9rem;
            }

            .stay-location {
                font-size: 0.9rem;
                color: #555;
                margin-bottom: 5px;
            }

            .stay-amenities {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-top: 5px;
                font-size: 0.9rem;
            }

            .stay-amenity {
                display: flex;
                align-items: center;
                gap: 4px;
                color: #555;
            }

            .modify-stay-btn {
                margin-top: 5px;
                font-size: 0.9rem;
                padding: 4px 8px;
            }

            .stay-option {
                cursor: pointer;
                transition: transform 0.3s;
            }

            .stay-option:hover {
                transform: translateY(-3px);
            }

            .modal-guest-dropdown-box {
    display: none;
    position: absolute;
    z-index: 1000;
    width: 100%;
    background: white;
    border: 1px solid #ddd;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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
.terms-hover {
    font-size: 12px !important;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 0;
}
/* Show content on toggle instead of hover */
.terms-trigger.open .terms-content {
    visibility: visible;
    opacity: 1;
}

.terms-arrow {
    display: inline-flex;
    transition: transform 0.2s ease;
}

.terms-trigger.open .terms-arrow {
    transform: rotate(180deg);
}


.terms-trigger {
    position: relative;
    margin-top:20px;
    
}
.terms-hover {
    font-size: 12px !important;
    cursor: pointer;
    display: flex !important;
    align-items: center;
    justify-content: space-between !important;
    margin: 0;
}
/* .pkg-terms-wrap {
    padding: 20px 0 36px;
    margin-top: 20px;
} */
/* Show content on toggle instead of hover */
.terms-trigger.open .terms-content {
    visibility: visible;
    opacity: 1;
}

/* .terms-arrow {
    display: inline-flex;
    transition: transform 0.2s ease;
} */

.terms-trigger.open .terms-arrow {
    transform: rotate(180deg);
}
.pkg-terms-wrap .container {
    max-width: 1024px
}


.ct-title {
    font-weight: 800;
    font-size: 2.1rem;
    margin: 0 0 8px;
    color: var(--ct-text)
}

.ct-subtitle {
    font-weight: 400;
    font-size: 1.6rem;
    margin: 0 0 12px;
    color: var(--ct-text)
    display: flex;
    justify-content: space-between;
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
    color: var(--ct-muted);
    font-size: 12px;
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

@media (max-width: 768px) {}
    .tour-dynamic-section { top: 0; }
    .sticky-top { top: 0; }
    .tour-pricing-card { max-width: 100%; }
    .tour-pricing-cta { display: flex; gap: 2px; margin-bottom: 0% !important; }
   
    .tour-pricing-cta {bottom: 0; left: 0; right: 0; background: #fff; z-index: 1000; display: none; }

        </style>
    @push('scripts')
   <script>
    const inputs = @json($inputs);
    const category = @json($cat->name); // safe for JS
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('hotelSearchForm');
    const travelDate = document.getElementById('travelDate');
    const guestSummary = document.getElementById('guestSummary');
    const modal = document.getElementById('searchModal');
    const modalGuestSummary = document.getElementById('modalGuestSummary');
    const modalGuestDropdown = document.querySelector('.modal-guest-dropdown-box');
    const modalRoomSelect = document.getElementById('modalRoomSelect');
    const modalRoomsContainer = document.getElementById('modalRoomsContainer');
    const modalGuestApplyBtn = document.getElementById('modalGuestApplyBtn');
    const modalSearchForm = document.getElementById('modalSearchForm');
    const guestDropdown = document.querySelector('.guest-dropdown-box');
    const roomSelect = document.getElementById('roomSelect');
    const roomsContainer = document.getElementById('roomsContainer');
    const guestApplyBtn = document.getElementById('guestApplyBtn');

     document.getElementById('bookNowBtn').addEventListener('click', () => {
        document.getElementById('searchModal').style.display = 'flex';
    });

    document.getElementById('bookNowBtn').addEventListener('click', () => {
    const modal = document.getElementById('searchModal');
    modal.style.display = 'flex';

    const roomCount = inputs.PaxRooms ? inputs.PaxRooms.length : 1;
    modalRoomSelect.value = roomCount;
    generateModalRoomFields(roomCount);
    preselectModalRoomFields();
});

 document.getElementById('bookNowBtn').addEventListener('click', () => {
    const modal = document.getElementById('searchModal');
    modal.style.display = 'flex';

    const roomCount = inputs.PaxRooms ? inputs.PaxRooms.length : 1;
    modalRoomSelect.value = roomCount;
    generateModalRoomFields(roomCount);
    preselectModalRoomFields();
});

 document.getElementById('modify').addEventListener('click', () => {
    const modal = document.getElementById('searchModal');
    modal.style.display = 'flex';

    const roomCount = inputs.PaxRooms ? inputs.PaxRooms.length : 1;
    modalRoomSelect.value = roomCount;
    generateModalRoomFields(roomCount);
    preselectModalRoomFields();
});


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

    function generateModalRoomFields(roomCount) {
        modalRoomsContainer.innerHTML = '';
        for (let r = 0; r < roomCount; r++) {
            const roomDiv = document.createElement('div');
            roomDiv.className = 'border-top pt-2';
            roomDiv.innerHTML = `
                <div class="small fw-semibold mb-1">Room ${r + 1}</div>
                <div class="row">
                    <div class="col">
                        <label class="small mb-0">Adults</label>
                        <select name="PaxRooms[${r}][Adults]" class="form-select form-select-sm py-1 modal-adult-count" data-room="${r}">
                            ${Array.from({ length: 4 }, (_, i) => `<option value="${i + 1}">${i + 1}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col">
                        <label class="small mb-0">Children</label>
                        <select name="PaxRooms[${r}][Children]" class="form-select form-select-sm py-1 modal-child-count" data-room="${r}">
                            ${Array.from({ length: getMaxChildrenAllowed(1) + 1 }, (_, i) => `<option value="${i}">${i}</option>`).join('')}
                        </select>
                    </div>
                </div>
                <div class="row modal-child-ages mt-1" id="modal-child-ages-room-${r}"></div>
            `;
            modalRoomsContainer.appendChild(roomDiv);
        }
        attachModalAdultChildListeners();
    }

    function preselectModalRoomFields() {
        if (!inputs.PaxRooms) return;
        inputs.PaxRooms.forEach((room, index) => {
            const adultSelect = document.querySelector(`select[name="PaxRooms[${index}][Adults]"]`);
            const childSelect = document.querySelector(`select[name="PaxRooms[${index}][Children]"]`);
            if (adultSelect) adultSelect.value = room.Adults || 1;
            if (childSelect) {
                const adults = parseInt(adultSelect?.value || 1);
                childSelect.innerHTML = Array.from({ length: getMaxChildrenAllowed(adults) + 1 }, (_, i) => 
                    `<option value="${i}">${i}</option>`
                ).join('');
                childSelect.value = room.Children || 0;
                childSelect.dispatchEvent(new Event('change'));
            }
            const childAges = room.ChildrenAges || [];
            const container = document.getElementById(`modal-child-ages-room-${index}`);
            container.innerHTML = '';
            childAges.forEach((age, i) => {
                const col = document.createElement('div');
                col.className = 'col-6 mb-1';
                col.innerHTML = `
                    <label class="small mb-0">Child ${i + 1} Age</label>
                    <select class="form-select form-select-sm py-1" name="PaxRooms[${index}][ChildrenAges][]">
                        ${Array.from({ length: 18 }, (_, a) => `<option value="${a}" ${a == age ? 'selected' : ''}>${a} yrs</option>`).join('')}
                    </select>
                `;
                container.appendChild(col);
            });
        });
        let summary = inputs.PaxRooms.map((room, r) => {
            let line = `Room ${r + 1} – ${room.Adults} Adult${room.Adults > 1 ? 's' : ''}`;
            if (room.Children > 0) line += `, ${room.Children} Child${room.Children > 1 ? 'ren' : ''}`;
            return line;
        });
        modalGuestSummary.value = summary.join('; ');
    }

    function attachModalAdultChildListeners() {
        const adultSelects = document.querySelectorAll('.modal-adult-count');
        const childSelects = document.querySelectorAll('.modal-child-count');
        adultSelects.forEach(select => {
            select.addEventListener('change', () => {
                const room = select.dataset.room;
                const adults = parseInt(select.value) || 1;
                const childSelect = document.querySelector(`.modal-child-count[data-room="${room}"]`);
                const maxChildren = getMaxChildrenAllowed(adults);
                childSelect.innerHTML = Array.from({ length: maxChildren + 1 }, (_, i) => 
                    `<option value="${i}">${i}</option>`
                ).join('');
                childSelect.dispatchEvent(new Event('change'));
            });
        });
        childSelects.forEach(select => {
            select.addEventListener('change', () => {
                const room = select.dataset.room;
                const container = document.getElementById(`modal-child-ages-room-${room}`);
                container.innerHTML = '';
                const count = parseInt(select.value) || 0;
                for (let i = 0; i < count; i++) {
                    const col = document.createElement('div');
                    col.className = 'col-6 mb-1';
                    col.innerHTML = `
                        <label class="small mb-0">Child ${i + 1} Age</label>
                        <select class="form-select form-select-sm py-1" name="PaxRooms[${room}][ChildrenAges][]">
                            ${Array.from({ length: 18 }, (_, age) => `<option value="${age}">${age} yrs</option>`).join('')}
                        </select>
                    `;
                    container.appendChild(col);
                }
            });
        });
    }

    function generateRoomFields(roomCount) {
        roomsContainer.innerHTML = '';
        for (let r = 0; r < roomCount; r++) {
            const roomDiv = document.createElement('div');
            roomDiv.className = 'border-top pt-2';
            roomDiv.innerHTML = `
                <div class="small fw-semibold mb-1">Room ${r + 1}</div>
                <div class="row">
                    <div class="col">
                        <label class="small mb-0">Adults</label>
                        <select name="PaxRooms[${r}][Adults]" class="form-select form-select-sm py-1 adult-count" data-room="${r}">
                            ${Array.from({ length: 10 }, (_, i) => `<option value="${i + 1}" ${inputs.PaxRooms && inputs.PaxRooms[r] && inputs.PaxRooms[r].Adults == i + 1 ? 'selected' : ''}>${i + 1}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col">
                        <label class="small mb-0">Children</label>
                        <select name="PaxRooms[${r}][Children]" class="form-select form-select-sm py-1 child-count" data-room="${r}">
                            ${Array.from({ length: 7 }, (_, i) => `<option value="${i}" ${inputs.PaxRooms && inputs.PaxRooms[r] && inputs.PaxRooms[r].Children == i ? 'selected' : ''}>${i}</option>`).join('')}
                        </select>
                    </div>
                </div>
                <div class="row child-ages mt-1" id="child-ages-room-${r}"></div>
            `;
            roomsContainer.appendChild(roomDiv);
        }
        attachChildCountListeners();
        inputs.PaxRooms?.forEach((room, index) => {
            const childSelect = document.querySelector(`select[name="PaxRooms[${index}][Children]"]`);
            if (childSelect && room.Children > 0) {
                childSelect.dispatchEvent(new Event('change'));
                const container = document.getElementById(`child-ages-room-${index}`);
                const childAges = room.ChildrenAges || [];
                childAges.forEach((age, i) => {
                    const select = container.querySelectorAll('select')[i];
                    if (select) select.value = age;
                });
            }
        });
        let summary = inputs.PaxRooms.map((room, r) => {
            let line = `Room ${r + 1} – ${room.Adults} Adult${room.Adults > 1 ? 's' : ''}`;
            if (room.Children > 0) line += `, ${room.Children} Child${room.Children > 1 ? 'ren' : ''}`;
            return line;
        });
        guestSummary.value = summary.join('; ');
    }

    function attachChildCountListeners() {
        const childSelects = document.querySelectorAll('.child-count');
        childSelects.forEach(select => {
            select.addEventListener('change', () => {
                const room = select.dataset.room;
                const container = document.getElementById(`child-ages-room-${room}`);
                container.innerHTML = '';
                const count = parseInt(select.value);
                for (let i = 0; i < count; i++) {
                    const col = document.createElement('div');
                    col.className = 'col-6 mb-1';
                    col.innerHTML = `
                        <label class="small mb-0">Child ${i + 1} Age</label>
                        <select class="form-select form-select-sm py-1" name="PaxRooms[${room}][ChildrenAges][]">
                            ${Array.from({ length: 18 }, (_, age) => `<option value="${age}">${age} yrs</option>`).join('')}
                        </select>
                    `;
                    container.appendChild(col);
                }
            });
        });
    }

    modalRoomSelect.addEventListener('change', () => {
        const roomCount = parseInt(modalRoomSelect.value) || 1;
        generateModalRoomFields(roomCount);
        numAdults = Array.from(document.querySelectorAll('.modal-adult-count'))
            .reduce((sum, select) => sum + parseInt(select.value || 1), 0);
        document.getElementById('num-adults').value = numAdults;
        updatePricingCard();
        updateSubCard();
    });

    modalGuestApplyBtn.addEventListener('click', () => {
        const roomCount = parseInt(modalRoomSelect.value) || 1;
        let summary = [];
        document.querySelectorAll('.modal-hidden-room-input').forEach(el => el.remove());
        numAdults = 0;
        for (let r = 0; r < roomCount; r++) {
            const adult = document.querySelector(`.modal-adult-count[data-room="${r}"]`)?.value || 1;
            const child = document.querySelector(`.modal-child-count[data-room="${r}"]`)?.value || 0;
            numAdults += parseInt(adult);
            let line = `Room ${r + 1} – ${adult} Adult${adult > 1 ? 's' : ''}`;
            if (child > 0) line += `, ${child} Child${child > 1 ? 'ren' : ''}`;
            summary.push(line);
            modalSearchForm.insertAdjacentHTML('beforeend', `
                <input type="hidden" name="PaxRooms[${r}][Adults]" value="${adult}" class="modal-hidden-room-input">
                <input type="hidden" name="PaxRooms[${r}][Children]" value="${child}" class="modal-hidden-room-input">
            `);
            document.querySelectorAll(`#modal-child-ages-room-${r} select`).forEach((select, index) => {
                modalSearchForm.insertAdjacentHTML('beforeend', `
                    <input type="hidden" name="PaxRooms[${r}][ChildrenAges][${index}]" value="${select.value}" class="modal-hidden-room-input">
                `);
            });
        }
        modalGuestSummary.value = summary.join('; ');
        modalGuestDropdown.style.display = 'none';
        document.getElementById('num-adults').value = numAdults;
        updatePricingCard();
        updateSubCard();
    });

    modalGuestSummary.addEventListener('click', (e) => {
        e.stopPropagation();
        modalGuestDropdown.style.display = modalGuestDropdown.style.display === 'block' ? 'none' : 'block';
    });

    roomSelect.addEventListener('change', () => {
        const roomCount = parseInt(roomSelect.value);
        generateRoomFields(roomCount);
        numAdults = Array.from(document.querySelectorAll('select[name$="[Adults]"]'))
            .reduce((sum, select) => sum + parseInt(select.value || 1), 0);
        document.getElementById('num-adults').value = numAdults;
        updatePricingCard();
        updateSubCard();
    });

    guestApplyBtn.addEventListener('click', () => {
        const roomCount = parseInt(roomSelect.value);
        let summary = [];
        numAdults = 0;
        for (let r = 0; r < roomCount; r++) {
            const adult = document.querySelector(`select[name="PaxRooms[${r}][Adults]"]`).value;
            const child = document.querySelector(`select[name="PaxRooms[${r}][Children]"]`).value;
            numAdults += parseInt(adult);
            let line = `Room ${r + 1} – ${adult} Adult${adult > 1 ? 's' : ''}`;
            if (child > 0) line += `, ${child} Child${child > 1 ? 'ren' : ''}`;
            summary.push(line);
        }
        guestSummary.value = summary.join('; ');
        guestDropdown.style.display = 'none';
        document.getElementById('num-adults').value = numAdults;
        updatePricingCard();
        updateSubCard();
    });

    guestSummary.addEventListener('click', (e) => {
        e.stopPropagation();
        guestDropdown.style.display = 'block';
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.guest-selector-wrapper')) {
            guestDropdown.style.display = 'none';
        }
        if (!event.target.closest('.modal-field-group')) {
            modalGuestDropdown.style.display = 'none';
        }
    });

    roomSelect.value = inputs.PaxRooms ? inputs.PaxRooms.length : 1;
    roomSelect.dispatchEvent(new Event('change'));
    modalRoomSelect.dispatchEvent(new Event('change'));
    recalculateGrandTotalFromDays();
});

function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let errors = [];
        const travelDate = form.querySelector('#travelDate');
        const guestSummary = form.querySelector('#modalGuestSummary');
        const packageSelect = form.querySelector('#package');

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

        if (formId === 'modalSearchForm') {
            const modalEl = document.getElementById('searchModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
        }

        form.submit();
    });
}



validateForm('modalSearchForm');
document.getElementById('modalSearchSubmit')?.addEventListener('click', () => {
        document.getElementById('modalSearchForm').dispatchEvent(new Event('submit'));
    });

let initialHotelTotal = {{ $hotelTotal ?? 0 }};
let initialFerryTotal = {{ $ferryTotal ?? 0 }};
let initialActivityTotal = {{ $activityTotal ?? 0 }};
let initialServiceTotal = {{ $serviceTotal ?? 0 }};
let guest = {!! json_encode($guests ?? []) !!};
let pricing = {!! json_encode($priceBreakdown ?? []) !!};

@if (!empty($inputs['travel_date']))
let startDate = "{{ \Carbon\Carbon::parse($inputs['travel_date'])->format('d-m-Y') }}";
@else
let startDate = null;
@endif

let totalAdults = 0;
let totalChildren = 0;
let totalRooms = guest.length;
let numAdults = 0;

guest.forEach(room => {
    totalAdults += parseInt(room.Adults || 0);
    totalChildren += parseInt(room.Children || 0);
});

let hotelTotal = initialHotelTotal;
let totalCosts = hotelTotal + initialFerryTotal + initialActivityTotal + initialServiceTotal;

function updatePricingCard() {
    const pricingElement = document.querySelector('.tour-pricing-final');
    if (pricingElement && pricing.total_with_markup !== undefined) {
        pricingElement.innerHTML = `₹${Number(pricing.total_with_markup).toFixed(2)} <small class="text-muted" style="font-size:12px">Total Package</small>`;
    }
}

function updateSubCard() {
    
    const finalpricingElements = document.querySelectorAll('.final-price');
    const dayHotelSum = Array.from(document.querySelectorAll('[id^="day-hotel-total-"]'))
        .reduce((sum, input) => sum + Number(input.value || 0), 0);

    const whotelprice = document.querySelector('.without-hotel');

    if (finalpricingElements.length > 0 && pricing.total_with_markup !== undefined) {
        finalpricingElements.forEach(el => {
            el.innerHTML = `₹${Number(pricing.total_with_markup).toFixed(2)}`;
        });
       
}
}


function recalculateGrandTotalFromDays() {
    const dayTotals = Array.from(document.querySelectorAll('[id^="day-total-"]'));
    let baseTotal = 0;
    if (dayTotals.length > 0) {
        baseTotal = dayTotals.reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
    } else {
        const dayHotelSum = Array.from(document.querySelectorAll('[id^="day-hotel-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayFerrySum = Array.from(document.querySelectorAll('[id^="day-ferry-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayActivitySum = Array.from(document.querySelectorAll('[id^="day-activity-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayServiceSum = Array.from(document.querySelectorAll('[id^="day-service-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        baseTotal = dayHotelSum + dayFerrySum + dayActivitySum + dayServiceSum;
    }
    const markup = parseFloat(pricing?.markup ?? 0);
    let totalWithMarkup = baseTotal + (baseTotal * markup / 100);
    const discount = parseFloat(pricing?.discount ?? 0);
    const discountAbove = parseFloat(pricing?.discount_above ?? 0);
    let totalWithDiscount = totalWithMarkup;
    if (discount > 0 && totalWithMarkup >= discountAbove) {
        totalWithDiscount = totalWithMarkup - (totalWithMarkup * discount / 100);
    }
    const gstRate = parseFloat(pricing?.gst_rate ?? 7) / 100;
    const gstAmount = totalWithDiscount * gstRate;
    totalCosts = totalWithDiscount + gstAmount;
    pricing = {
        base_total: baseTotal,
        total_with_markup: totalWithMarkup,
        total_with_discount: totalWithDiscount,
        gst_rate: gstRate * 100,
        gst_amount: gstAmount,
        grand_total: totalCosts,
        markup: markup,
        discount: discount,
        discount_above: discountAbove
    };
    updatePricingCard();
    updateSubCard();
}

function recalculateHotelTotal() { recalculateGrandTotalFromDays(); }



function calculateFromVisibleDayTotals() {
    const dayTotalTexts = Array.from(document.querySelectorAll('[id^="day-total-text-"]'));
    if (dayTotalTexts.length > 0) {
        let grandTotal = 0;
        dayTotalTexts.forEach(element => {
            const text = element.textContent || '';
            const match = text.match(/₹([\d,]+\.?\d*)/);
            if (match) {
                const value = parseFloat(match[1].replace(/,/g, ''));
                if (!isNaN(value) && isFinite(value)) {
                    grandTotal += value;
                }
            }
        });
        if (grandTotal > 0) {
            totalCosts = grandTotal;
            updatePricingCard();
            updateSubCard();
            return;
        }
    }
    const dayHotelTexts = Array.from(document.querySelectorAll('[id^="day-hotel-total-text-"]'));
    const dayFerryTexts = Array.from(document.querySelectorAll('[id^="day-ferry-total-text-"]'));
    const dayActivityTexts = Array.from(document.querySelectorAll('[id^="day-activity-total-text-"]'));
    const dayServiceTexts = Array.from(document.querySelectorAll('[id^="day-service-total-text-"]'));
    let componentTotal = 0;
    const extractValue = (text) => {
        const match = text.match(/₹([\d,]+\.?\d*)/);
        return match ? parseFloat(match[1].replace(/,/g, '')) : 0;
    };
    dayHotelTexts.forEach(el => {
        const value = extractValue(el.textContent || '');
        if (!isNaN(value) && isFinite(value)) componentTotal += value;
    });
    dayFerryTexts.forEach(el => {
        const value = extractValue(el.textContent || '');
        if (!isNaN(value) && isFinite(value)) componentTotal += value;
    });
    dayActivityTexts.forEach(el => {
        const value = extractValue(el.textContent || '');
        if (!isNaN(value) && isFinite(value)) componentTotal += value;
    });
    dayServiceTexts.forEach(el => {
        const value = extractValue(el.textContent || '');
        if (!isNaN(value) && isFinite(value)) componentTotal += value;
    });
    if (componentTotal > 0) {
        totalCosts = componentTotal;
        updatePricingCard();
        updateSubCard();
    }
}

$('.multiple-items').slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    variableWidth: true,
    prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fa fa-chevron-right"></i></button>'
});

const loader = document.getElementById('page-loader');
if (loader) {
    loader.style.display = 'flex';
    loader.style.opacity = '1';
}

window.addEventListener('load', function () {
    if (loader) {
        loader.style.opacity = '0';
        loader.style.transition = 'opacity 0.3s ease';
        setTimeout(() => loader.style.display = 'none', 300);
    }
});


document.addEventListener("DOMContentLoaded", function() {
    const faqItems = document.querySelectorAll('.custom-faq-question');
    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.closest('.custom-faq-item');
            const targetId = item.getAttribute('data-faq-target');
            const answer = document.getElementById(targetId);
            document.querySelectorAll('.custom-faq-item.active').forEach(openItem => {
                if (openItem !== parent) {
                    openItem.classList.remove('active');
                }
            });
            parent.classList.toggle('active');
        });
    });
});


function openOffcanvas(button, type) {
    const dayIndex = button.getAttribute('data-day-index');
    const hotelCode = button.getAttribute('data-hotel-code') || null;
    const hotelsData = button.getAttribute('data-hotels');
    window.currentDayIndex = dayIndex;
    window.selectedHotel = null;
    window.currentHotelCode = hotelCode;
    window.currentHotelImage = null;
    window.currentHotelCity = null;
    window.currentHotelRating = null;
    let hotels = [];
    if (hotelsData && hotelsData.length > 0) {
        try {
            hotels = JSON.parse(hotelsData);
        } catch (error) {}
    }
    if (!hotels || hotels.length === 0) {
        hotels = window.currentHotels || [];
    }
    const offcanvasElement = document.getElementById('sharedOffcanvas');
    let offcanvas;
    try {
        offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
        if (offcanvas) {
            offcanvas.hide();
        }
        offcanvas = new bootstrap.Offcanvas(offcanvasElement);
    } catch (error) {
        offcanvasElement.classList.add('show');
        document.body.classList.add('offcanvas-open');
    }
    const hotelContainer = document.getElementById('hotelOptionsContainer');
    const roomContainer = document.getElementById('roomOptionsContainer');
    const offcanvasLabel = document.getElementById('offcanvasLabel');
    hotelContainer.style.display = 'none';
    roomContainer.style.display = 'none';
    if (type === 'hotel') {
        if (!hotels || hotels.length === 0) {
            alert('No hotels available for selection. Please try again later.');
            return;
        }
        offcanvasLabel.textContent = 'Select Hotel';
        hotelContainer.style.display = 'block';
        openHotelSelector(button, hotelContainer);
    } else if (type === 'room') {
        if (!hotels || hotels.length === 0) {
            alert('No rooms available for selection. Please try again later.');
            return;
        }
        const selectedCodeEl = document.getElementById(`selected-hotel-code-${dayIndex}`);
        const selectedCode = selectedCodeEl ? selectedCodeEl.value : null;
        if (!hotelCode || !selectedCode || hotelCode !== selectedCode) {
            alert('You can change rooms only for the currently selected hotel. Please select the hotel first.');
            return;
        }
        offcanvasLabel.textContent = 'Change Room';
        roomContainer.style.display = 'block';
        openRoomSelector(button, roomContainer);
    }
    offcanvasElement.style.display = 'block';
    offcanvasElement.style.visibility = 'visible';
    if (offcanvas && typeof offcanvas.show === 'function') {
        try {
            offcanvas.show();
        } catch (error) {
            offcanvasElement.classList.add('show');
            document.body.classList.add('offcanvas-open');
        }
    } else {
        offcanvasElement.classList.add('show');
        document.body.classList.add('offcanvas-open');
    }
    setTimeout(() => {
        if (!offcanvasElement.classList.contains('show')) {
            offcanvasElement.classList.add('show');
            offcanvasElement.style.transform = 'translateX(0)';
            offcanvasElement.style.visibility = 'visible';
        }
        const headerEl = offcanvasElement.querySelector('.offcanvas-header');
        const bodyEl = offcanvasElement.querySelector('.offcanvas-body');
        if (headerEl && bodyEl) {
            const headerHeight = headerEl.offsetHeight || 56;
            bodyEl.style.maxHeight = `calc(100vh - ${headerHeight}px)`;
            bodyEl.style.overflowY = 'auto';
            bodyEl.style.webkitOverflowScrolling = 'touch';
        }
        let backdrop = document.querySelector('.offcanvas-backdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'offcanvas-backdrop';
            backdrop.style.position = 'fixed';
            backdrop.style.top = '0';
            backdrop.style.left = '0';
            backdrop.style.zIndex = '1040';
            backdrop.style.width = '100vw';
            backdrop.style.height = '100vh';
            backdrop.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            backdrop.style.display = 'none';
            document.body.appendChild(backdrop);
        }
        backdrop.style.display = 'block';
        const outsideClickHandler = function(event) {
            const clickedInside = offcanvasElement.contains(event.target);
            if (!clickedInside) {
                closeOffcanvas();
                document.removeEventListener('mousedown', outsideClickHandler, true);
            }
        };
        document.addEventListener('mousedown', outsideClickHandler, true);
        backdrop.addEventListener('click', function() {
            closeOffcanvas();
            document.removeEventListener('mousedown', outsideClickHandler, true);
        }, { once: true });
    }, 100);
}

function openHotelSelector(button, container) {
    const dayIndex = button.getAttribute('data-day-index');
    const hotels = JSON.parse(button.getAttribute('data-hotels'));
    const selectedHotelName = document.getElementById(`selected-hotel-name-${dayIndex}`)?.textContent.trim();
    const selectedHotelPrice = document.getElementById(`selected-hotel-price-input-${dayIndex}`)?.value;
    const selectedHotelBookingCode = document.getElementById(`selected-hotel-id-${dayIndex}`)?.value.trim();
    window.currentSelectedHotelPrice = selectedHotelPrice ? parseFloat(selectedHotelPrice) : 0;
    window.currentSelectedHotelBookingCode = selectedHotelBookingCode || '';
    const selectedHotel = selectedHotelName && selectedHotelPrice && selectedHotelBookingCode ? {
        hotel_name: selectedHotelName,
        selected_room: {
            BookingCode: selectedHotelBookingCode,
            DayRates: [[{ BasePrice: parseFloat(selectedHotelPrice) || 0 }]]
        }
    } : null;
    container.innerHTML = '';
    const headerDiv = document.createElement('div');
    headerDiv.className = 'pagination-controls d-flex justify-content-between align-items-center';
    headerDiv.innerHTML = `
        <div>
            <h6 class="mb-0">Available Hotels: <span class="badge bg-primary">${hotels.length}</span></h6>
            <small class="text-muted">Showing <span id="hotel-start">1</span> to <span id="hotel-end">10</span> of ${hotels.length}</small>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary btn-sm" id="prev-hotel-page" onclick="changeHotelPage(-1)">
                <i class="fas fa-chevron-left"></i> Previous
            </button>
            <span class="d-flex align-items-center px-2">
                Page <span id="hotel-current-page">1</span> of <span id="hotel-total-pages">${Math.ceil(hotels.length / 10)}</span>
            </span>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="next-hotel-page" onclick="changeHotelPage(1)">
                Next <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    `;
    container.appendChild(headerDiv);
    const searchDiv = document.createElement('div');
    searchDiv.className = 'search-filter';
    searchDiv.innerHTML = `
        <div class="input-group">
            <input type="text" class="form-control" id="hotel-search" placeholder="Search hotels by name or city..." onkeyup="filterHotels()">
            <button class="btn btn-outline-secondary" type="button" onclick="clearHotelSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    container.appendChild(searchDiv);
    window.currentHotels = hotels;
    window.currentHotelPage = 1;
    window.hotelsPerPage = 10;
    window.filteredHotels = hotels;
    displayHotelPage(1);
}

function displayHotelPage(page) {
    const container = document.getElementById('hotelOptionsContainer');
    const hotels = window.filteredHotels || window.currentHotels;
    const hotelsPerPage = window.hotelsPerPage;
    const totalPages = Math.ceil(hotels.length / hotelsPerPage);
    const existingCards = container.querySelectorAll('.hotel-card-item');
    existingCards.forEach(card => card.remove());
    const startIndex = (page - 1) * hotelsPerPage;
    const endIndex = Math.min(startIndex + hotelsPerPage, hotels.length);
    const pageHotels = hotels.slice(startIndex, endIndex);
    document.getElementById('hotel-start').textContent = startIndex + 1;
    document.getElementById('hotel-end').textContent = endIndex;
    document.getElementById('hotel-current-page').textContent = page;
    document.getElementById('hotel-total-pages').textContent = totalPages;
    document.getElementById('prev-hotel-page').disabled = page <= 1;
    document.getElementById('next-hotel-page').disabled = page >= totalPages;
    pageHotels.forEach(hotel => {
        const hotelCard = document.createElement('div');
        hotelCard.className = 'hotel-card-item d-flex p-2 mb-2 hotel-selection-card align-items-stretch';
        const imageUrl = hotel.hotel_image || 'https://andamanbliss.com/storage/hotel_photo/photo-20240921-050325-1060733771.jpg';
        const currentPrice = hotel.selected_room?.TotalFare || 0;
        const selectedPrice = window.currentSelectedHotelPrice || 0;
        const isSelected = window.currentSelectedHotelBookingCode && hotel.selected_room &&
            window.currentSelectedHotelBookingCode === hotel.selected_room.BookingCode;
        let priceDiffHtml = '';
        if (isSelected) {
            priceDiffHtml = `<span class="badge bg-success mb-2">SELECTED</span>`;
        } else {
            const diff = (parseFloat(currentPrice) || 0) - (parseFloat(selectedPrice) || 0);
            const diffText = diff >= 0 ? `+ ₹${diff.toFixed(2)}` : `- ₹${Math.abs(diff).toFixed(2)}`;
            const diffColor = diff >= 0 ? 'danger' : 'success';
            priceDiffHtml = `
                <div class="fw-bold text-${diffColor} mb-1">${diffText}</div>
                <div class="small text-muted">vs Selected</div>
            `;
        }
        hotelCard.innerHTML = `
            <div class="me-3 flex-shrink-0" style="width: 200px;">
                <img src="${imageUrl}" class="hotel-selection-image">
            </div>
            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                <div class="mb-2">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-1 fw-semibold">${hotel.hotel_name}</h6>
                        <a href="#" class="text-primary small text-decoration-none">VIEW DETAILS</a>
                    </div>
                    <div class="text-muted small mb-1">${hotel.city || ''}</div>
                    <div class="small mb-1">Room: ${hotel.selected_room?.RoomTypeName || 'Standard Room'}</div>
                    ${isSelected ? `
                    <button type="button" class="small text-primary text-decoration-none btn-link p-0 change-room-btn"
                        data-day-index="${window.currentDayIndex}"
                        data-hotel-code="${hotel.hotel_code}">
                        CHANGE ROOM
                    </button>` : `
                    <span class="small text-muted">Select this hotel to change room</span>
                    `}
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <span class="badge bg-success">${hotel.hotel_rating || '3.7'}/5</span>
                    <div class="text-end">
                        ${priceDiffHtml}
                        ${!isSelected ? `
                            <button type="button" class="btn btn-primary btn-sm fw-bold select-hotel-btn"
                                data-bs-dismiss="offcanvas">
                                SELECT
                            </button>` : ''
                        }
                    </div>
                </div>
            </div>
        `;
        container.appendChild(hotelCard);
        if (isSelected) {
            const changeBtn = hotelCard.querySelector('.change-room-btn');
            if (changeBtn) {
                changeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    openOffcanvas(this, 'room');
                });
            }
        }
        const selectBtn = hotelCard.querySelector('.select-hotel-btn');
        if (selectBtn) {
            selectBtn.addEventListener('click', function(e) {
                e.preventDefault();
                selectHotel(hotel, window.currentDayIndex);
            });
        }
    });
}
function changeHotelPage(direction) {
    const currentPage = window.currentHotelPage;
    const newPage = currentPage + direction;
    const totalPages = Math.ceil((window.filteredHotels || window.currentHotels).length / window.hotelsPerPage);
    if (newPage >= 1 && newPage <= totalPages) {
        window.currentHotelPage = newPage;
        displayHotelPage(newPage);
    }
}

function filterHotels() {
    const searchTerm = document.getElementById('hotel-search').value.toLowerCase();
    const hotels = window.currentHotels;
    if (!searchTerm) {
        window.filteredHotels = hotels;
    } else {
        window.filteredHotels = hotels.filter(hotel => 
            hotel.hotel_name.toLowerCase().includes(searchTerm) ||
            (hotel.city && hotel.city.toLowerCase().includes(searchTerm))
        );
    }
    window.currentHotelPage = 1;
    displayHotelPage(1);
}

function clearHotelSearch() {
    document.getElementById('hotel-search').value = '';
    window.filteredHotels = window.currentHotels;
    window.currentHotelPage = 1;
    displayHotelPage(1);
}

function openRoomSelector(button, container) {
    const dayIndex = button.getAttribute('data-day-index');
    const hotelCode = button.getAttribute('data-hotel-code');
    const hotels = window.currentHotels || [];
    const selectedHotel = hotels.find(hotel => hotel.hotel_code === hotelCode);
    const rooms = selectedHotel.other_rooms || [];
    const selectedRoom = selectedHotel.selected_room;
    const selectedRoomName = document.getElementById(`selected-room-name-${dayIndex}`)?.textContent.trim() || selectedRoom.Name[0];
    const selectedRoomPrice = document.getElementById(`selected-room-price-${dayIndex}`)?.textContent.trim() || selectedRoom.TotalFare;
    const selectedRoomBookingCode = document.getElementById(`selected-room-id-${dayIndex}`)?.value.trim() || selectedRoom.BookingCode;
    container.innerHTML = '';
    const headerDiv = document.createElement('div');
    headerDiv.className = 'pagination-controls d-flex justify-content-between align-items-center';
    headerDiv.innerHTML = `
        <div>
            <h6 class="mb-0">Available Rooms: <span class="badge bg-primary">${rooms.length}</span></h6>
            <small class="text-muted">Showing <span id="room-start">1</span> to <span id="room-end">10</span> of ${rooms.length}</small>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary btn-sm" id="prev-room-page" onclick="changeRoomPage(-1)">
                <i class="fas fa-chevron-left"></i> Previous
            </button>
            <span class="d-flex align-items-center px-2">
                Page <span id="room-current-page">1</span> of <span id="room-total-pages">${Math.ceil(rooms.length / 10)}</span>
            </span>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="next-room-page" onclick="changeRoomPage(1)">
                Next <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    `;
    container.appendChild(headerDiv);
    const searchDiv = document.createElement('div');
    searchDiv.className = 'search-filter';
    searchDiv.innerHTML = `
        <div class="input-group">
            <input type="text" class="form-control" id="room-search" placeholder="Search rooms by name or type..." onkeyup="filterRooms()">
            <button class="btn btn-outline-secondary" type="button" onclick="clearRoomSearch()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    container.appendChild(searchDiv);
    window.currentRooms = rooms;
    window.currentRoomPage = 1;
    window.roomsPerPage = 10;
    window.filteredRooms = rooms;
    window.currentSelectedRoom = {
        name: selectedRoomName,
        price: selectedRoomPrice,
        bookingCode: selectedRoomBookingCode
    };
    window.currentHotelImage = selectedHotel.hotel_image || null;
    window.currentHotelCity = selectedHotel.city_name;
    window.currentHotelRating = selectedHotel.hotel_rating;
    displayRoomPage(1);
}

function displayRoomPage(page) {
    const container = document.getElementById('roomOptionsContainer');
    const rooms = window.filteredRooms || window.currentRooms;
    const roomsPerPage = window.roomsPerPage;
    const totalPages = Math.ceil(rooms.length / roomsPerPage);
    const existingCards = container.querySelectorAll('.room-card-item');
    existingCards.forEach(card => card.remove());
    const startIndex = (page - 1) * roomsPerPage;
    const endIndex = Math.min(startIndex + roomsPerPage, rooms.length);
    const pageRooms = rooms.slice(startIndex, endIndex);
    document.getElementById('room-start').textContent = startIndex + 1;
    document.getElementById('room-end').textContent = endIndex;
    document.getElementById('room-current-page').textContent = page;
    document.getElementById('room-total-pages').textContent = totalPages;
    document.getElementById('prev-room-page').disabled = page <= 1;
    document.getElementById('next-room-page').disabled = page >= totalPages;
    pageRooms.forEach(room => {
        const roomCard = document.createElement('div');
        roomCard.className = 'room-card-item d-flex p-2 mb-2 hotel-selection-card align-items-stretch';
        const imageUrl = window.currentHotelImage || 'https://andamanbliss.com/storage/hotel_photo/photo-20240921-050325-1060733771.jpg';
        const currentPrice = room.TotalFare || 0;
        const selectedPrice = parseFloat(window.currentSelectedRoom.price) || 0;
        const isSelected = window.currentSelectedRoom.bookingCode === room.BookingCode;
        let priceDiffHtml = '';
        if (isSelected) {
            priceDiffHtml = `<span class="badge bg-success mb-2">SELECTED</span>`;
        } else {
            const diff = (parseFloat(currentPrice) || 0) - (parseFloat(selectedPrice) || 0);
            const diffText = diff >= 0 ? `+ ₹${Math.abs(diff).toFixed(0)}` : `- ₹${Math.abs(diff).toFixed(0)}`;
            const diffColor = diff >= 0 ? 'danger' : 'success';
            priceDiffHtml = `
                <div class="fw-bold text-${diffColor} mb-1">${diffText}</div>
                <div class="small text-muted">vs Selected</div>
            `;
        }
        roomCard.innerHTML = `
            <div class="me-3 flex-shrink-0" style="width: 200px;">
                <img src="${imageUrl}" class="hotel-selection-image">
            </div>
            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                <div class="mb-2">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-1 fw-semibold">${room.Name[0]}</h6>
                        <a href="#" class="text-primary small text-decoration-none">VIEW DETAILS</a>
                    </div>
                    <div class="text-muted small mb-1">${window.currentHotelCity || ''}</div>
                    <div class="small mb-1">Inclusions: ${room.Inclusion || 'None'}</div>
                    <div class="small mb-1">Meal: ${room.MealType || 'None'}</div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <span class="badge bg-success">${window.currentHotelRating || '3.7'}/5</span>
                    <div class="text-end">
                        ${priceDiffHtml}
                        ${!isSelected ? `
                            <button type="button" class="btn btn-primary btn-sm fw-bold"
                                onclick='selectRoom(${JSON.stringify(room)}, ${window.currentDayIndex}, "${window.currentHotelCode}")'
                                data-bs-dismiss="offcanvas">
                                SELECT
                            </button>` : ''
                        }
                    </div>
                </div>
            </div>
        `;
        container.appendChild(roomCard);
    });
}

function changeRoomPage(direction) {
    const currentPage = window.currentRoomPage;
    const newPage = currentPage + direction;
    const totalPages = Math.ceil((window.filteredRooms || window.currentRooms).length / window.roomsPerPage);
    if (newPage >= 1 && newPage <= totalPages) {
        window.currentRoomPage = newPage;
        displayRoomPage(newPage);
    }
}

function filterRooms() {
    const searchTerm = document.getElementById('room-search').value.toLowerCase();
    const rooms = window.currentRooms;
    if (!searchTerm) {
        window.filteredRooms = rooms;
    } else {
        window.filteredRooms = rooms.filter(room => 
            room.Name[0].toLowerCase().includes(searchTerm) ||
            (room.RoomType && room.RoomType.toLowerCase().includes(searchTerm))
        );
    }
    window.currentRoomPage = 1;
    displayRoomPage(1);
}

function clearRoomSearch() {
    document.getElementById('room-search').value = '';
    window.filteredRooms = window.currentRooms;
    window.currentRoomPage = 1;
    displayRoomPage(1);
}

function selectHotel(hotel, dayIndex) {
    const nameElement = document.getElementById(`selected-hotel-name-${dayIndex}`);
    const priceElement = document.getElementById(`selected-hotel-price-${dayIndex}`);
    const idInput = document.getElementById(`selected-hotel-id-${dayIndex}`);
    const priceInput = document.getElementById(`selected-hotel-price-input-${dayIndex}`);
    const addressElement = document.getElementById(`selected-hotel-address-${dayIndex}`);
    const roomNameElement = document.getElementById(`selected-room-name-${dayIndex}`);
    const roomPriceElement = document.getElementById(`selected-room-price-${dayIndex}`);
    const roomIdInput = document.getElementById(`selected-room-id-${dayIndex}`);
    const roomPriceInput = document.getElementById(`selected-room-price-input-${dayIndex}`);
    const hotelCodeInput = document.getElementById(`selected-hotel-code-${dayIndex}`);
    const hotelImageElement = document.querySelector(`#selected-hotel-name-${dayIndex}`).closest('.tour-hotel-card').querySelector('.tour-hotel-image');
    if (!nameElement || !priceElement || !idInput || !priceInput || !addressElement || 
        !roomNameElement || !roomPriceElement || !roomIdInput || !roomPriceInput || !hotelCodeInput || !hotelImageElement) return;
    const hotelName = hotel.hotel_name || 'Hotel Name';
    const basePrice = hotel?.selected_room?.TotalFare || 0;
    const bookingCode = hotel?.selected_room?.BookingCode || '';
    const address = hotel.address || '';
    const roomName = hotel.selected_room?.Name[0] || 'Standard Room';
    const hotelCode = hotel.hotel_code || '';
    nameElement.textContent = hotelName;
    priceElement.textContent = basePrice;
    addressElement.textContent = address;
    idInput.value = bookingCode;
    priceInput.value = basePrice;
    roomNameElement.textContent = roomName;
    roomPriceElement.textContent = basePrice;
    roomIdInput.value = bookingCode;
    roomPriceInput.value = basePrice;
    hotelCodeInput.value = hotelCode;
    hotelImageElement.src = hotel.hotel_image;
    const dayHotelHidden = document.getElementById(`day-hotel-total-${dayIndex}`);
    const dayHotelText = document.getElementById(`day-hotel-total-text-${dayIndex}`);
    if (dayHotelHidden) dayHotelHidden.value = parseFloat(basePrice) || 0;
    if (dayHotelText) dayHotelText.textContent = `₹${(parseFloat(basePrice) || 0).toFixed(2)}`;
    const ferry = parseFloat(document.getElementById(`day-ferry-total-${dayIndex}`)?.value || 0);
    const act = parseFloat(document.getElementById(`day-activity-total-${dayIndex}`)?.value || 0);
    const svc = parseFloat(document.getElementById(`day-service-total-${dayIndex}`)?.value || 0);
    const dayTotal = (parseFloat(basePrice) || 0) + ferry + act + svc;
    const dayTotalHidden = document.getElementById(`day-total-${dayIndex}`);
    const dayTotalText = document.getElementById(`day-total-text-${dayIndex}`);
    if (dayTotalHidden) dayTotalHidden.value = dayTotal;
    if (dayTotalText) dayTotalText.textContent = `₹${dayTotal.toFixed(2)}`;
        window.currentSelectedHotelPrice = parseFloat(basePrice) || 0;
        window.currentSelectedHotelBookingCode = bookingCode || '';
        if (typeof displayHotelPage === 'function') {
            const currentPage = window.currentHotelPage || 1;
            displayHotelPage(currentPage);
        }

    
        recalculateHotelTotal();
    
}

function selectRoom(room, dayIndex, hotelCode) {
    const nameElement = document.getElementById(`selected-hotel-name-${dayIndex}`);
    const priceElement = document.getElementById(`selected-hotel-price-${dayIndex}`);
    const idInput = document.getElementById(`selected-hotel-id-${dayIndex}`);
    const priceInput = document.getElementById(`selected-hotel-price-input-${dayIndex}`);
    const addressElement = document.getElementById(`selected-hotel-address-${dayIndex}`);
    const roomNameElement = document.getElementById(`selected-room-name-${dayIndex}`);
    const roomPriceElement = document.getElementById(`selected-room-price-${dayIndex}`);
    const roomIdInput = document.getElementById(`selected-room-id-${dayIndex}`);
    const roomPriceInput = document.getElementById(`selected-room-price-input-${dayIndex}`);
    const hotelImageElement = document.querySelector(`#selected-hotel-name-${dayIndex}`).closest('.tour-hotel-card').querySelector('.tour-hotel-image');
    if (!nameElement || !priceElement || !idInput || !priceInput || !addressElement || 
        !roomNameElement || !roomPriceElement || !roomIdInput || !roomPriceInput || !hotelImageElement) return;
    const hotelName = nameElement.textContent.trim();
    const basePrice = room.TotalFare || 0;
    const bookingCode = room.BookingCode || '';
    const address = addressElement.textContent.trim();
    const roomName = room.Name[0] || 'Room Name';
    roomNameElement.textContent = roomName;
    roomPriceElement.textContent = basePrice;
    roomIdInput.value = bookingCode;
    roomPriceInput.value = basePrice;
    priceElement.textContent = basePrice;
    idInput.value = bookingCode;
    priceInput.value = basePrice;
    const rDayHotelHidden = document.getElementById(`day-hotel-total-${dayIndex}`);
    const rDayHotelText = document.getElementById(`day-hotel-total-text-${dayIndex}`);
    if (rDayHotelHidden) rDayHotelHidden.value = parseFloat(basePrice) || 0;
    if (rDayHotelText) rDayHotelText.textContent = `₹${(parseFloat(basePrice) || 0).toFixed(2)}`;
    const rFerry = parseFloat(document.getElementById(`day-ferry-total-${dayIndex}`)?.value || 0);
    const rAct = parseFloat(document.getElementById(`day-activity-total-${dayIndex}`)?.value || 0);
    const rSvc = parseFloat(document.getElementById(`day-service-total-${dayIndex}`)?.value || 0);
    const rDayTotal = (parseFloat(basePrice) || 0) + rFerry + rAct + rSvc;
    const rDayTotalHidden = document.getElementById(`day-total-${dayIndex}`);
    const rDayTotalText = document.getElementById(`day-total-text-${dayIndex}`);
    if (rDayTotalHidden) rDayTotalHidden.value = rDayTotal;
    if (rDayTotalText) rDayTotalText.textContent = `₹${rDayTotal.toFixed(2)}`;
    hotelImageElement.src = window.currentHotelImage;

        if (!window.currentSelectedRoom) window.currentSelectedRoom = {};
        window.currentSelectedRoom.price = parseFloat(basePrice) || 0;
        window.currentSelectedRoom.bookingCode = bookingCode || '';
        if (typeof displayRoomPage === 'function') {
        const currentRoomPage = window.currentRoomPage || 1;
        displayRoomPage(currentRoomPage);
    }

    if (typeof recalculateHotelTotal === 'function') {
        recalculateHotelTotal();
    }
    
}

function storeTempItineraryAndProceed() {
    const wh = document.querySelector('input[name="wh"]:checked').value;

    const itineraryDays = [];
    document.querySelectorAll('.accordion-item').forEach((item, index) => {
        const btn = item.querySelector('.accordion-button');
        const dayHeader = btn?.innerText.trim() || '';
        const dateAttr = btn?.getAttribute('data-date') || '';
        const dayMatch = dayHeader.match(/Day (\d+)/);

        const day = {
            dayNumber: dayMatch ? dayMatch[1] : index + 1,
            title: '',
            date: dateAttr
        };
        const accommodation = (() => {
            const nameEl = item.querySelector(`#selected-hotel-name-${index}`);
            const priceEl = item.querySelector(`#selected-hotel-price-${index}`);
            const addressEl = item.querySelector(`#selected-hotel-address-${index}`);
            const idInput = item.querySelector(`#selected-hotel-id-${index}`);
            const priceInput = item.querySelector(`#selected-hotel-price-input-${index}`);
            const roomNameEl = item.querySelector(`#selected-room-name-${index}`);
            const roomPriceEl = item.querySelector(`#selected-room-price-${index}`);
            const roomIdInput = item.querySelector(`#selected-room-id-${index}`);
            const roomPriceInput = document.getElementById(`selected-room-price-input-${index}`);
            const hotelCodeInput = document.getElementById(`selected-hotel-code-${index}`);
            if (!nameEl || !priceEl || !idInput || !roomNameEl || !roomPriceEl || !roomIdInput || !roomPriceInput) return null;
            return {
                name: nameEl.textContent.trim(),
                price: parseFloat(priceEl.textContent.trim() || 0),
                address: addressEl?.textContent.trim() || '',
                booking_code: idInput.value || '',
                base_price: parseFloat(priceInput?.value || 0),
                room_name: roomNameEl.textContent.trim(),
                room_price: parseFloat(roomPriceEl.textContent.trim() || 0),
                room_booking_code: roomIdInput.value || '',
                hotel_code: hotelCodeInput?.value || ''
            };
        })();
       const ferries = (() => {
    const displays = item.querySelectorAll('.tour-hotel-display');
    let ferryCards = [];
    displays.forEach(display => {
        // match the heading that actually exists in your HTML
        const heading = display.querySelector('h5.tour-hotel-heading');
        if (heading && heading.textContent.trim().includes('Transfers')) {
            // accumulate ferry cards instead of overwriting
            ferryCards.push(...display.querySelectorAll('.tour-hotel-card'));
        }
    });
    return Array.from(ferryCards).map(ferryCard => ({
        name: ferryCard.querySelector('.tour-hotel-name')?.innerText.trim() || '',
        ferry: ferryCard.querySelector('.tour-ferry-name')?.value || '',
        from: ferryCard.querySelector('p:nth-of-type(1)')?.innerText.trim() || '',
        time: ferryCard.querySelector('p:nth-of-type(2)')?.innerText.trim() || '',
        classInfo: ferryCard.querySelector('p:nth-of-type(3)')?.innerText.trim() || '',
        fare: parseFloat(ferryCard.querySelector('span')?.innerText.trim() || 0)
    }));
})();

        const dayHotelTotal = parseFloat(document.getElementById(`selected-hotel-price-input-${index}`)?.value || 0);
        const dayFerryTotal = Array.from(item.querySelectorAll(`input[name^="selected_ferry_fares[${index}]"]`))
            .reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayActivityTotal = parseFloat(document.getElementById(`day-activity-total-${index}`)?.value || 0);
        const dayServiceTotal = parseFloat(document.getElementById(`day-service-total-${index}`)?.value || 0);
        const dayTotal = (function() {
            const explicitDay = document.getElementById(`day-total-${index}`)?.value;
            if (explicitDay !== undefined && explicitDay !== null && explicitDay !== '') {
                return parseFloat(explicitDay) || 0;
            }
            return dayHotelTotal + dayFerryTotal + dayActivityTotal + dayServiceTotal;
        })();
        itineraryDays.push({
            day,
            accommodation,
            ferries,
            dayHotelTotal,
            dayFerryTotal,
            dayActivityTotal,
            dayServiceTotal,
            dayTotal
        });
    });
    const searchHashEl = document.getElementById('search-hash');
    const searchHash = searchHashEl ? searchHashEl.value.trim() : 'default_hash';
    const tourId = '{{ $tour->id }}';
    if (!searchHash) {
        console.error('Search hash is missing or empty');
        return;
    }
  $.ajax({
    url: '/store-temp-itinerary',
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        tour_id: tourId,
        category: category,
        itinerary: JSON.stringify(itineraryDays),
        guests: JSON.stringify(inputs.PaxRooms),
        pricing: JSON.stringify(pricing),
        wh : wh,
    },
    success: function(response) {
        if (response.status === 'success' && response.search_hash) {
            const form = $('<form>', {
                method: 'GET',
                action: '/travel-packages/preview/book'
            }).append($('<input>', {
                type: 'hidden',
                name: 'search_hash',
                value: response.search_hash
            }));
            $('body').append(form);
            form.submit();
        } else {
            alert(response.message || 'Failed to store temporary itinerary.');
        }
    },
    error: function(xhr, status, error) {
        console.error('AJAX Error:', error);
    }
});

}

document.getElementById('proceedToPaymentBtn').addEventListener('click', storeTempItineraryAndProceed);

function closeOffcanvas() {
    const offcanvasElement = document.getElementById('sharedOffcanvas');
    if (offcanvasElement) {
        offcanvasElement.classList.remove('show');
        offcanvasElement.style.transform = 'translateX(100%)';
        offcanvasElement.style.visibility = 'hidden';
        document.body.classList.remove('offcanvas-open');
    }
    const backdrop = document.querySelector('.offcanvas-backdrop');
    if (backdrop) {
        backdrop.style.display = 'none';
        backdrop.parentNode && backdrop.parentNode.removeChild(backdrop);
    }
    try {
        const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
        if (offcanvas) {
            offcanvas.hide();
        }
    } catch (error) {}
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeOffcanvas();
    }
});
   </script>
    @endpush

    @push('scripts')
<script>
    document.getElementById('paycontrol').addEventListener('click', function (e) {
    e.preventDefault();

    const payOptions = document.getElementById('payOptions');

    if (payOptions.style.display === "none") {
        payOptions.style.display = "block";
        this.innerHTML = '<i class="fa-solid fa-angles-down"></i> hide';
    } else {
        payOptions.style.display = "none";
        this.innerHTML = '<i class="fa-solid fa-angles-up"></i> show booking options';
    }
});

document.addEventListener('DOMContentLoaded', function() {
  var trigger = document.querySelector('.terms-trigger');
  if (!trigger) return;
  var header = trigger.querySelector('.terms-hover');

  function setExpanded(expanded) {
    header.setAttribute('aria-expanded', expanded ? 'true' : 'false');
  }

  function closeAll() {
    trigger.classList.remove('open');
    setExpanded(false);
  }

  function toggleOpen() {
    var willOpen = !trigger.classList.contains('open');
    trigger.classList.toggle('open');
    setExpanded(willOpen);
  }

  header.addEventListener('click', function(e) {
    e.stopPropagation();
    toggleOpen();
  });

  header.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      toggleOpen();
    }
  });

  document.addEventListener('click', function(e) {
    if (!trigger.contains(e.target)) {
      closeAll();
    }
  });

  
});
</script>
@endpush

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



function selectPayment(block) {
    const val = Number(block.querySelector('input[type="radio"]').value);

    document.querySelectorAll('.tbook-option input[type="radio"]').forEach(r => r.checked = false);
    document.querySelectorAll('.tbook-option').forEach(b => b.classList.remove('tbook-option-active'));

    block.classList.add('tbook-option-active');
    block.querySelector('input[type="radio"]').checked = true;
    
    const elems = document.getElementsByClassName('hotel-lists');
    if (val === 0) {

        for (let el of elems) {
            el.style.display = 'none';
        }
        const dayTotals = Array.from(document.querySelectorAll('[id^="day-total-"]'));
        let baseTotal = 0;  
        const dayFerrySum = Array.from(document.querySelectorAll('[id^="day-ferry-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayActivitySum = Array.from(document.querySelectorAll('[id^="day-activity-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayServiceSum = Array.from(document.querySelectorAll('[id^="day-service-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        baseTotal = dayFerrySum + dayActivitySum + dayServiceSum;
        const markup = parseFloat(pricing?.markup ?? 0);
        let totalWithMarkup = baseTotal + (baseTotal * markup / 100);
        const discount = parseFloat(pricing?.discount ?? 0);
        const discountAbove = parseFloat(pricing?.discount_above ?? 0);
        let totalWithDiscount = totalWithMarkup;
        if (discount > 0 && totalWithMarkup >= discountAbove) {
            totalWithDiscount = totalWithMarkup - (totalWithMarkup * discount / 100);
        }
        const gstRate = parseFloat(pricing?.gst_rate ?? 7) / 100;
        const gstAmount = totalWithDiscount * gstRate;
        totalCosts = totalWithDiscount + gstAmount;

        pricing = {
            base_total: baseTotal,
            total_with_markup: totalWithMarkup,
            total_with_discount: totalWithDiscount,
            gst_rate: gstRate * 100,
            gst_amount: gstAmount,
            grand_total: totalCosts,
            markup: markup,
            discount: discount,
            discount_above: discountAbove
        };
    }
     else {
        for (let el of elems) {
            el.style.display = 'block';
        }
         const dayTotals = Array.from(document.querySelectorAll('[id^="day-total-"]'));
    let baseTotal = 0;
    if (dayTotals.length > 0) {
        baseTotal = dayTotals.reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
    } else {
        const dayHotelSum = Array.from(document.querySelectorAll('[id^="day-hotel-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayFerrySum = Array.from(document.querySelectorAll('[id^="day-ferry-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayActivitySum = Array.from(document.querySelectorAll('[id^="day-activity-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        const dayServiceSum = Array.from(document.querySelectorAll('[id^="day-service-total-"]')).reduce((sum, input) => sum + parseFloat(input.value || 0), 0);
        baseTotal = dayHotelSum + dayFerrySum + dayActivitySum + dayServiceSum;
    }
    const markup = parseFloat(pricing?.markup ?? 0);
    let totalWithMarkup = baseTotal + (baseTotal * markup / 100);
    const discount = parseFloat(pricing?.discount ?? 0);
    const discountAbove = parseFloat(pricing?.discount_above ?? 0);
    let totalWithDiscount = totalWithMarkup;
    if (discount > 0 && totalWithMarkup >= discountAbove) {
        totalWithDiscount = totalWithMarkup - (totalWithMarkup * discount / 100);
    }
    const gstRate = parseFloat(pricing?.gst_rate ?? 7) / 100;
    const gstAmount = totalWithDiscount * gstRate;
    totalCosts = totalWithDiscount + gstAmount;
    pricing = {
        base_total: baseTotal,
        total_with_markup: totalWithMarkup,
        total_with_discount: totalWithDiscount,
        gst_rate: gstRate * 100,
        gst_amount: gstAmount,
        grand_total: totalCosts,
        markup: markup,
        discount: discount,
        discount_above: discountAbove
    };

    }
}

</script>
@endpush
    
    @endsection
