@extends('layouts.app')
@section('title', 'Private Boat Charter in Andaman Islands | Luxury Boat Rentals')
@section('keywords', 'Private Boat Charter, Andaman Islands, Luxury Boats, Island Hopping, Havelock Island, Port Blair,
Boat Rental, Yacht Charter')
@section('description', 'Experience the ultimate Andaman adventure with our private boat charters. Explore hidden
beaches, pristine waters, and stunning marine life with our fleet of luxury boats.')

@section('content')
<!-- Lightbox -->
<div class="lightbox" id="gallery-lightbox">
    <div class="lightbox-content">
        <img src="" alt="" class="lightbox-image">
    </div>
    <div class="lightbox-caption"></div>
    <div class="lightbox-close">
        <i class="fas fa-times"></i>
    </div>
    <div class="lightbox-nav lightbox-prev">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="lightbox-nav lightbox-next">
        <i class="fas fa-chevron-right"></i>
    </div>
</div>
<!-- Hero Section -->
<section class="boat-charter-hero position-relative overflow-hidden">
    <!-- Modern high-quality boat image from Unsplash -->
    <div class="hero-bg position-absolute w-100 h-100">
        <img src="{{ asset('site/img/pvt-boat-banner.jpg') }}" alt="Luxury Private Boat Charter"
            class="w-100 h-100 object-fit-cover">
        <!-- Improved overlay for better text visibility -->
        <div class="overlay-dark position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5);">
        </div>
    </div>

    <!-- Floating Elements for Visual Interest -->
    <div class="floating-elements d-none d-md-block">
        <div class="floating-bubble bubble-1"></div>
        <div class="floating-bubble bubble-2"></div>
        <div class="floating-bubble bubble-3"></div>
    </div>

    <div class="container position-relative py-5" style="z-index: 2;">
        <div class="row min-vh-75 align-items-center py-5">
            <div class="col-lg-8">
                <div class="hero-content">
                    <!-- Enhanced badges with better visibility -->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="hero-badge"><i class="fas fa-award me-2"></i> Premium Experience</span>
                        <span class="hero-badge"><i class="fas fa-shield-alt me-2"></i> Safety Assured</span>
                        <span class="hero-badge"><i class="fas fa-star me-2"></i> 5-Star Rated</span>
                    </div>

                    <!-- Enhanced heading with better visibility and modern typography -->
                    <h1 class="hero-title mb-4">Exclusive <span class="gradient-text">Private Boat Charter</span> in
                        Andaman Islands</h1>

                    <p class="hero-subtitle mb-4 text-white">Escape the ordinary and uncover the hidden treasures of the
                        Andaman Islands with a private boat charter from Andaman Bliss. Our tailored boat rental
                        services offer the ultimate way to explore this tropical paradise. Fill out our Quick Inquiry
                        form and start planning today</p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#charter-options" class="btn-hero-primary">
                            <span>View Charter Options</span>
                            <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                        <a href="#booking-form" class="btn-hero-secondary">
                            <i class="fas fa-calendar-check me-2"></i>
                            <span>Book Now</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Compact modern booking card -->
                <!-- New Modern Inquiry Form -->
                <div class="inquiry-card">
                    <div class="inquiry-card-header">
                        <h2 class="inquiry-title">Quick Inquiry</h2>
                        <p class="inquiry-subtitle">Get a personalized quote today</p>
                    </div>

                    <form id="booking-form" method="POST" action="{{ url('boat-activity/boat-chater/contact')}}"
                        class="inquiry-form">
                        @csrf
                        <div class=" row g-3 mb-3">
                            <div class="col-md-6 col-12">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-user input-icon"></i>
                                    <input type="text" class="form-control inquiry-input" name="fullName" id="fullName"
                                        placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-ship input-icon"></i>
                                    <select class="form-select inquiry-select" name="charterType" id="charterType"
                                        required>
                                        <option value="" selected disabled>Select an option</option>
                                        @foreach ($boatCharter as $charter)
                                        <option value="{{ $charter->name }}">{{ ucwords($charter->name . '-' .
                                        $charter->package_type) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down select-arrow"></i>
                                </div>
                            </div>

                        </div>

                        <div class="row g-3 mb-3">

                            <div class="col-md-6 col-12">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-calendar-alt input-icon"></i>
                                    <input type="text" name="preferredDate" onfocus="(this.type='date')"
                                        onblur="if(!this.value) this.type='text'" class="form-control inquiry-input"
                                        id="charterDate" placeholder="dd-mm-yyyy" required>
                                </div>
                            </div>
                            <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                autocomplete="off">

                            <div class="col-md-6 col-12">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-users input-icon"></i>
                                    <select class="form-select inquiry-select" name="guestCount" id="guestCount"
                                        required>
                                        <option value="" selected disabled>Select</option>
                                        <option value="1-4">1-4</option>
                                        <option value="5-8">5-8</option>
                                        <option value="9-10">9-10</option>
                                        <option value="10+">10+</option>
                                    </select>
                                    <i class="fas fa-chevron-down select-arrow"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-phone-alt input-icon"></i>
                                    <input type="tel" name="phoneNumber" class="form-control inquiry-input"
                                        id="phoneNumber" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="inquiry-input-wrapper">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input type="email" name="emailAddress" class="form-control inquiry-input"
                                        id="emailAddress" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input me-2" name="termsChecks" type="checkbox"
                                        id="termsCheck"
                                        style="width: 20px; height: 20px; border: 1px solid rgba(17, 157, 213, 0.3); border-radius: 4px;"
                                        required>
                                    <label class="form-check-label" for="termsCheck">
                                        I agree to the <a href="#"
                                            style="color: rgb(17, 157, 213); text-decoration: none; border-bottom: 1px dotted rgb(17, 157, 213);">terms
                                            and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-inquiry-submit">
                            <span>Send Inquiry</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>

                        <div class="inquiry-features">
                            <div class="feature-badge">
                                <i class="fas fa-bolt"></i>
                                <span>Instant Response</span>
                            </div>
                            <div class="feature-badge">
                                <i class="fas fa-lock"></i>
                                <span>Secure Booking</span>
                            </div>
                            <div class="feature-badge">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Free Cancellation</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Separator -->
    <div class="wave-separator">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
            </path>
        </svg>
    </div>
</section>

<!-- Key Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-md-3 col-6">
                <div class="feature-card text-center p-4 rounded-4 h-100 shadow-sm">
                    <div class="charter-feature-icon mb-3 mx-auto">
                        <i class="fas fa-ship"></i>
                    </div>
                    <h3 class="h5 mb-2">Premium Boats</h3>
                    <p class="mb-0 small">Well-maintained fleet with modern amenities</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-card text-center p-4 rounded-4 h-100 shadow-sm">
                    <div class="charter-feature-icon mb-3 mx-auto">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="h5 mb-2">Custom Routes</h3>
                    <p class="mb-0 small">Personalized itineraries to suit your preferences</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-card text-center p-4 rounded-4 h-100 shadow-sm">
                    <div class="charter-feature-icon mb-3 mx-auto">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="h5 mb-2">Expert Crew</h3>
                    <p class="mb-0 small">Professional captains and attentive staff</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="feature-card text-center p-4 rounded-4 h-100 shadow-sm">
                    <div class="charter-feature-icon mb-3 mx-auto">
                        <i class="fa-solid fa-shield"></i>
                    </div>
                    <h3 class="h5 mb-2">Safety First</h3>
                    <p class="mb-0 small">Complete safety equipment and procedures</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Charter Options Section -->
<section id="charter-options" class="py-5 charter-options-section">
    <div class="container">
        <div class="section-header">
            <h2 style="color: rgb(17, 157, 213);">Our Charter <span style="color: #f9680f;">Options</span></h2>
            <p>Choose from our premium charter boats to explore the Andaman Islands in a unique way</p>
        </div>

        <div class="charter-cards-container">
            @foreach($boatCharter as $boat)
            <div class="charter-card">
                <div class="charter-card-top">
                    <div class="charter-image">
                        @if (!empty($boat->boatImages) && isset($boat->boatImages[0]->file_name))
                        <img src="{{ asset('storage/' . $boat->boatImages[0]->file_name) }}"
                            alt="{{ ucwords($boat->name) }}">
                        @else
                        <img src="{{ asset('images/no-image.jpg') }}" alt="{{ ucwords($boat->name) }}">
                        @endif

                        {!! $boat->featured == '1' ? '<div class="charter-tag">Most Popular</div>' : '' !!}
                        <div class="badge">
                            <span>{{ $boat->package_type }}</span>
                        </div>
                    </div>
                    <div class="charter-info">
                        <h3>{{ ucwords($boat->name) }}</h3>
                        <div class="charter-specs">
                            <div class="spec-item"><i class="fas fa-users"></i> {{ $boat->pax }} + 2 Pax</div>
                            <div class="spec-item"><i class="fas fa-ruler"></i> 32 ft</div>
                            <div class="spec-item"><i class="fas fa-tachometer-alt"></i> High Speed</div>
                        </div>
                        <p>{!! Str::words($boat->description, 20) !!} <a href="#" role="button" type="button"
                                data-bs-toggle="modal" data-bs-target="#ItineraryModal-{{ $boat->id }}"
                                class="read-more ">read more</a></p>

                    </div>
                </div>
                <div class="charter-card-bottom">
                    @php
                    $minPrice = $boat->seasonalPrices->min('price');
                    $finalPrice = $minPrice ?? $boat->base_price;
                    @endphp
                    <div class="charter-price d-flex flex-column">
                        <div class="row d-flex flex-row">
                            <div class="amount">₹{{ number_format($finalPrice, 2) }} <span
                                    class="period text-gray fw-bolder">/{{ $boat->duration }}</span></div>
                        </div>
                        <div class="row">
                            @if($boat->permit_charges == '1')
                            <a href="#" type="button" role="button" class="permit-charges fw-bolder"
                                data-bs-toggle="modal" data-bs-target="#ItineraryModal-{{ $boat->id }}">+ Permit
                                Charges</a>
                            @endif
                        </div>
                    </div>
                    <a href="#booking-form" class="charter-book-btn">Book Now</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="view-more-container">
            <a href="#charter-options" class="view-more-btn">View All Options <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- Modal for each boat -->
@foreach($boatCharter as $boat)
<div class="modal fade" id="ItineraryModal-{{ $boat->id }}" tabindex="-1"
    aria-labelledby="ItineraryModalLabel-{{ $boat->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bolder text-dark" id="ItineraryModalLabel-{{ $boat->id }}">Permit Details
                    for {{
                    ucwords($boat->name) }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-gray">{{ strip_tags($boat->description) }}</p>
                <h5 class="mb-3 text-dark fw-bolder">Permit Charges</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Charges</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Local</td>
                            <td>₹{{ number_format($boat->local_permit ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Non-Local</td>
                            <td>₹{{ number_format($boat->non_local_permit ?? 0, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="mt-4">Inclusions</h5>
                <ul>
                    @foreach($boat->inclusions->where('type', 'inclusion') as $inclusion)
                    <li><i class="fa fa-check text-success pe-1"></i> {{ ucfirst($inclusion->description) }}</li>
                    @endforeach
                </ul>

                <h5 class="mt-4">Exclusions</h5>
                <ul>
                    @foreach($boat->inclusions->where('type', 'exclusion') as $exclusion)
                    <li><i class="fa fa-times text-danger pe-1"></i>{{ ucfirst($exclusion->description) }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Popular Routes Section -->
<section class="popular-routes-section py-5">
    <div class="container">
        <div class="section-header">
            <h2 style="color: rgb(17, 157, 213);">Popular <span style="color: #f9680f;">Routes</span></h2>
            <p>Explore the best of the Andaman Islands with our curated routes</p>
        </div>

        <div class="routes-container" style="text-align:justify">
            <!-- Route 1 -->
            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/havelock-boatcharter.jpg"
                        alt="Port Blair - Havelock - Port Blair">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Port Blair - Havelock - Port Blair</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Full day</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 45 km</div>
                    </div>
                    <p>Enjoy a private boat charter from Port Blair to Havelock. Perfect for small groups who wants to have a premium experience in Andaman. Travel in comfort & enjoy a smooth and unique journey across the Andaman sea.</p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/cinque-boatcharter.jpg"
                        alt="Port Blair - Cinque - Port Blair">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Port Blair - Cinque - Port Blair</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Full day</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 45 km</div>
                    </div>
                    <p>Take a charter boat from Port Blair to Cinque island known for its pristine blue water with beautiful marine life. Perfect for snorkeling and enjoy one of a kind experience. The boat trip to cinque islands allows a comfortable and luxury ride.
                    </p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/chidiyatapu-boatcharter.jpeg"
                        alt="Chidiyatapu - Cinque - Chidiyatapu">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Chidiyatapu - Cinque - Chidiyatapu</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Full day</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 45 km</div>
                    </div>
                    <p>Set off from Chidiyatapu to the serene beauty Cinque island and back. perfect for snorkeling, photography or a peaceful day on the water, as this private boat ride is powered by Andaman Bliss trusted premium services.</p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/long-boatcharter.webp"
                        alt="Port Blair - Long Island - Port Blair">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Port Blair - Long Island - Port Blair</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Full day</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 45 km</div>
                    </div>
                    <p>Sail from Port Blair to the calm & quiet long island for a peaceful getaway. Enjoy peaceful beaches and surroundings and enjoy a smooth journey with Andaman Bliss reliable private boat services.</p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/neil-boatcharter.jpg"
                        alt="Port Blair - Neil Island - Port Blair">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Port Blair - Neil Island - Port Blair</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Full day</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 45 km</div>
                    </div>
                    <p>Travel on a private boat from Port Blair to Neil Island, for a lovely relaxing journey. Visit peaceful beaches, amazing marine life and enjoy comfortable and familiar boat services by Andaman Bliss.
                    </p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/barren-boatcharter.jpg"
                        alt="Barren Island">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Barren Island</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Full day</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 45 km</div>
                    </div>
                    <p>Take a private boat trip to Barren Island, a home to one of the only active volcano in India. A trip to the island will allow plenty of beautiful views and amazing marine life & gives the opportunities to enjoy an awesome private boat services by Andaman Bliss.</p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/sunset-boatcharter.jpg"
                        alt="Private Charter Sunset Port Blair">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Private Charter Sunset Port Blair</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Evening</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 20 km</div>
                    </div>
                    <p>Take a private sunset boat trip from Port Blair & enjoy the scenic and beautiful sunset. This private trip is great for couples and is a relaxing ride that provides luxury and comfort with a trusted Andaman Bliss boat service
                    </p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <img src="/site/img/sunset-boatcharter-2.jpeg"
                        alt="Private Charter Sunset Chidiyatapu">
                    <div class="route-overlay"></div>
                </div>
                <div class="route-content">
                    <h3>Private Charter Sunset Chidiyatapu</h3>
                    <div class="route-details">
                        <div class="route-detail"><i class="fas fa-clock"></i> Evening</div>
                        <div class="route-detail"><i class="fas fa-map-marker-alt"></i> 20 km</div>
                    </div>
                    <p>Sail into a golden sunset of Chidiyatapu and enjoy the calm, peaceful vibe surrouding you. With stunning views a cozy, Andaman Bliss's private boat services will makes your evening feel truly special.
                    </p>
                    <a href="#booking-form" class="route-book-btn">Book This Route</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Photo Gallery Section -->
<section id="gallery" class="gallery-section py-5 position-relative">
    <!-- Background Elements -->
    <div class="gallery-bg-shape position-absolute top-0 start-0 d-none d-lg-block"
        style="width: 25%; height: 60%; background: linear-gradient(135deg, rgba(17, 157, 213, 0.03) 0%, rgba(0, 198, 255, 0.03) 100%); border-radius: 0 0 100px 0; z-index: 0;">
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="section-header-left">
                    <div class="section-tag mb-3 d-inline-block py-1 px-3"
                        style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                        <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i
                                class="fas fa-camera me-2"></i>VISUAL JOURNEY</span>
                    </div>
                    <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Experience <span
                            style="color: #f9680f;">Gallery</span></h2>
                    <p>Check out the gallery and look at the adventure at the Andaman Islands. Look at the images and find out what our boat charter offers. Get inspired by Andaman Bliss.</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="gallery-filter d-inline-flex flex-wrap gap-2">
                    <button class="filter-btn active px-3 py-2" data-filter="all"
                        style="background-color: rgb(17, 157, 213); color: white; border: none; border-radius: 30px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s ease;">
                        All Photos
                    </button>
                    <button class="filter-btn px-3 py-2" data-filter="boats"
                        style="background-color: rgba(17, 157, 213, 0.1); color: #333; border: none; border-radius: 30px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s ease;">
                        Our Boats
                    </button>
                    <button class="filter-btn px-3 py-2" data-filter="destinations"
                        style="background-color: rgba(17, 157, 213, 0.1); color: #333; border: none; border-radius: 30px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s ease;">
                        Destinations
                    </button>
                    <button class="filter-btn px-3 py-2" data-filter="activities"
                        style="background-color: rgba(17, 157, 213, 0.1); color: #333; border: none; border-radius: 30px; font-size: 0.9rem; font-weight: 500; transition: all 0.3s ease;">
                        Activities
                    </button>
                </div>
            </div>
        </div>

        <div class="gallery-container">
            <div class="row g-3">
                <!-- First Row -->
                <div class="col-lg-6 col-md-12 gallery-item" data-category="boats">
                    <div class="gallery-card position-relative overflow-hidden h-100"
                        style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                        <img src="https://images.unsplash.com/photo-1605281317010-fe5ffe798166?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                            alt="Premium Cruiser" class="w-100 h-100 gallery-image"
                            style="object-fit: cover; aspect-ratio: 16/9;">
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3"
                            style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%); transition: all 0.3s ease;">
                            <h3 class="text-white mb-1 fw-bold">Premium Cruiser</h3>
                            <p class="text-white mb-0 small d-none d-sm-block">Our flagship vessel with premium
                                amenities</p>
                            <div class="gallery-actions mt-2 d-flex gap-2">
                                <a href="https://images.unsplash.com/photo-1605281317010-fe5ffe798166?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                    class="btn btn-sm rounded-circle lightbox-trigger" data-title="Premium Cruiser"
                                    style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px);">
                                    <i class="fas fa-expand"></i>
                                </a>
                                <a href="#booking-form" class="btn btn-sm rounded-circle"
                                    style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px);">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="row g-3">
                        <!-- Top Row - Two Small Items -->
                        <div class="col-6 gallery-item" data-category="boats">
                            <div class="gallery-card position-relative overflow-hidden"
                                style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                                <img src="https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                    alt="Luxury Speedboat" class="w-100 gallery-image"
                                    style="aspect-ratio: 4/3; object-fit: cover;">
                                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-2"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%); transition: all 0.3s ease;">
                                    <h3 class="text-white mb-0 h6 fw-bold">Luxury Speedboat</h3>
                                    <div class="gallery-actions mt-1 d-flex gap-1">
                                        <a href="https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                            class="btn btn-sm rounded-circle lightbox-trigger"
                                            data-title="Luxury Speedboat"
                                            style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px); font-size: 0.7rem;">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 gallery-item" data-category="boats">
                            <div class="gallery-card position-relative overflow-hidden"
                                style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                                <img src="https://img.freepik.com/free-photo/long-shot-woman-boat_23-2149046434.jpg?t=st=1746687335~exp=1746690935~hmac=a2f6f1969eef479b032fa2de4c445c4ded28283d48ac9f4e5d032fc28b3840cf&w=996"
                                    alt="Sunset Yacht" class="w-100 gallery-image"
                                    style="aspect-ratio: 4/3; object-fit: cover;">
                                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-2"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%); transition: all 0.3s ease;">
                                    <h3 class="text-white mb-0 h6 fw-bold">Sunset Yacht</h3>
                                    <div class="gallery-actions mt-1 d-flex gap-1">
                                        <a href="https://img.freepik.com/free-photo/long-shot-woman-boat_23-2149046434.jpg?t=st=1746687335~exp=1746690935~hmac=a2f6f1969eef479b032fa2de4c445c4ded28283d48ac9f4e5d032fc28b3840cf&w=996"
                                            class="btn btn-sm rounded-circle lightbox-trigger" data-title="Sunset Yacht"
                                            style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px); font-size: 0.7rem;">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Row - Two Small Items -->
                        <div class="col-6 gallery-item" data-category="destinations">
                            <div class="gallery-card position-relative overflow-hidden"
                                style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                    alt="Havelock Island" class="w-100 gallery-image"
                                    style="aspect-ratio: 4/3; object-fit: cover;">
                                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-2"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%); transition: all 0.3s ease;">
                                    <h3 class="text-white mb-0 h6 fw-bold">Havelock Island</h3>
                                    <div class="gallery-actions mt-1 d-flex gap-1">
                                        <a href="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                            class="btn btn-sm rounded-circle lightbox-trigger"
                                            data-title="Havelock Island"
                                            style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px); font-size: 0.7rem;">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 gallery-item" data-category="destinations">
                            <div class="gallery-card position-relative overflow-hidden"
                                style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                                <img src="https://images.unsplash.com/photo-1468413253725-0d5181091126?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                    alt="Ross Island" class="w-100 gallery-image"
                                    style="aspect-ratio: 4/3; object-fit: cover;">
                                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-2"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%); transition: all 0.3s ease;">
                                    <h3 class="text-white mb-0 h6 fw-bold">Ross Island</h3>
                                    <div class="gallery-actions mt-1 d-flex gap-1">
                                        <a href="https://images.unsplash.com/photo-1468413253725-0d5181091126?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                            class="btn btn-sm rounded-circle lightbox-trigger" data-title="Ross Island"
                                            style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px); font-size: 0.7rem;">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Row - Two Medium Items -->
                <div class="col-md-6 gallery-item" data-category="activities">
                    <div class="gallery-card position-relative overflow-hidden"
                        style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                        <img src="https://images.unsplash.com/photo-1544551763-92ab472cad5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                            alt="Game Fishing" class="w-100 gallery-image"
                            style="aspect-ratio: 32/9; object-fit: cover;">
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3"
                            style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%); transition: all 0.3s ease;">
                            <h3 class="text-white mb-0 h5 fw-bold">Game Fishing</h3>
                            <div class="gallery-actions mt-2 d-flex gap-2">
                                <a href="https://images.unsplash.com/photo-1544551763-92ab472cad5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                    class="btn btn-sm rounded-circle lightbox-trigger" data-title="Game Fishing"
                                    style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px); font-size: 0.8rem;">
                                    <i class="fas fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 gallery-item" data-category="activities">
                    <div class="gallery-card position-relative overflow-hidden"
                        style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                        <img src="https://images.unsplash.com/photo-1682687982501-1e58ab814714?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                            alt="Snorkeling" class="w-100 gallery-image" style="aspect-ratio: 32/9; object-fit: cover;">
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3"
                            style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%); transition: all 0.3s ease;">
                            <h3 class="text-white mb-0 h5 fw-bold">Snorkeling</h3>
                            <div class="gallery-actions mt-2 d-flex gap-2">
                                <a href="https://images.unsplash.com/photo-1682687982501-1e58ab814714?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                    class="btn btn-sm rounded-circle lightbox-trigger" data-title="Snorkeling"
                                    style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.2); color: white; backdrop-filter: blur(5px); font-size: 0.8rem;">
                                    <i class="fas fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

<!-- Game Fishing Section -->
<section class="game-fishing-section py-5">
    <div class="container">
        <div class="section-header">
            <h2 style="color: rgb(17, 157, 213);">Game Fishing <span style="color: #f9680f;">Expedition</span></h2>
            <p>Experience the thrill of deep sea fishing in the beautiful waters of the Andaman Islands</p>
        </div>

        <div class="fishing-content-row">
            <!-- Left Column - Image -->
            <div class="fishing-image-col">
                <div class="fishing-image-slider">
                    <img src="https://images.unsplash.com/photo-1544551763-92ab472cad5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="Game Fishing in Andaman" class="active">
                    <img src="https://images.unsplash.com/photo-1595841696677-6489ff3f8cd1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="Fishing Catch">
                    <img src="https://images.unsplash.com/photo-1534043464124-3be32fe000c9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="Tuna Fish">
                    <div class="slider-controls">
                        <span class="slider-dot active"></span>
                        <span class="slider-dot"></span>
                        <span class="slider-dot"></span>
                    </div>
                </div>
                <div class="fishing-highlights">
                    <div class="charter-highlight-item">
                        <i class="fas fa-fish"></i>
                        <div class="highlight-text">
                            <span>15+ Fish Species</span>
                        </div>
                    </div>
                    <div class="charter-highlight-item">
                        <i class="fas fa-check-circle"></i>
                        <div class="highlight-text">
                            <span>Premium Equipment</span>
                        </div>
                    </div>
                    <div class="charter-highlight-item">
                        <i class="fas fa-user-tie"></i>
                        <div class="highlight-text">
                            <span>Expert Guides</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Content -->
            <div class="fishing-content-col">
                <div class="fishing-description">
                    <p>Take part in a full day thrilling fishing experience. This activity is priced at ₹40,500, it lets you experience thrill, top notch fishing gear, expert guidance and spend an amazing time on the waters. No matter if you are a pro or a first time traveler, Andaman Bliss will make sure that you will be having an amazing fishing experience.</p>
                </div>

                <div class="fishing-packages">
                    @foreach ($fishing as $pack)
                    <div class="fishing-package" id="package-{{ strtolower(str_replace(' ', '-', $pack->name)) }}"
                        onclick="selectFishingPackage('{{ strtolower(str_replace(' ', '-', $pack->name)) }}')">
                        <div class="package-tag">Popular</div>
                        <div class="package-header">
                            <h4>{{ ucwords($pack->name) }}</h4>
                            <div class="charter-package-price">₹{{ number_format($pack->base_price, 2) }}
                                <span>/{{ $pack->duration }}</span>
                            </div>
                        </div>
                        <div class="package-features">
                            <span><i class="fas fa-check"></i> Premium equipment</span>
                            <span><i class="fas fa-check"></i> Expert guide</span>
                            <span><i class="fas fa-check"></i> Refreshments</span>
                        </div>
                        <div class="package-select">
                            <span class="select-indicator"><i class="fas fa-check-circle"></i> Select</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="fishing-cta">
                    <a href="#booking-form" class="fishing-book-btn">Book a Fishing Charter</a>
                </div>

                <div class="fishing-species">
                    <h4>Popular Game Fish</h4>
                    <div class="species-tags">
                        <span>Sailfish</span>
                        <span>Yellowfin Tuna</span>
                        <span>Mahi-Mahi</span>
                        <span>Blue Marlin</span>
                        <span>Barracuda</span>
                        <span>Wahoo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inclusions & Exclusions Section -->
<section class="whats-included-section py-4">
    <div class="container">
        <div class="section-header">
            <h2 style="color: rgb(17, 157, 213);">What's <span style="color: #f9680f;">Included</span></h2>
        </div>

        <div class="inclusions-container">
            <div class="inclusion-tabs">
                <div class="tab-buttons">
                    <button class="tab-btn active" data-tab="inclusions">
                        <i class="fas fa-check-circle"></i> Inclusions
                    </button>
                    <button class="tab-btn" data-tab="exclusions">
                        <i class="fas fa-times-circle"></i> Exclusions
                    </button>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="inclusions">
                        <div class="row">
                            <p class="text-dark fw-bolder">Every private boat in Andaman with Andaman Bliss comes with
                            </p>
                        </div>
                        <div class="inclusion-items">

                            <div class="inclusion-item">
                                <div class="inclusion-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Professional Crew</h4>
                                    <p>Experienced captain and crew members</p>
                                </div>
                            </div>

                            <div class="inclusion-item">
                                <div class="inclusion-icon">
                                    <i class="fa-solid fa-shield"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Safety Gear</h4>
                                    <p>Life jackets, first aid kit, and emergency equipment</p>
                                </div>
                            </div>

                            <div class="inclusion-item">
                                <div class="inclusion-icon">
                                    <i class="fas fa-tint"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Refreshments</h4>
                                    <p>Bottled water and basic refreshments</p>
                                </div>
                            </div>

                            <div class="inclusion-item">
                                <div class="inclusion-icon">
                                    <i class="fas fa-swimmer"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Fishing gear (for game fishing charters)</h4>
                                    <p>Basic snorkeling equipment for underwater exploration</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p class="text-dark fw-bolder">Relax and enjoy, our team handles all the details for a
                                seamless experience.</p>
                        </div>
                    </div>

                    <div class="tab-pane" id="exclusions">
                        <div class="inclusion-items">
                            <div class="inclusion-item">
                                <div class="inclusion-icon exclusion">
                                    <i class="fas fa-shuttle-van"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Transportation</h4>
                                    <p>Hotel pick-up and drop-off services</p>
                                </div>
                            </div>

                            <div class="inclusion-item">
                                <div class="inclusion-icon exclusion">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Travel Insurance</h4>
                                    <p>Personal travel and accident insurance</p>
                                </div>
                            </div>

                            <div class="inclusion-item">
                                <div class="inclusion-icon exclusion">
                                    <i class="fas fa-cocktail"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Alcoholic Beverages</h4>
                                    <p>Alcoholic drinks are not included</p>
                                </div>
                            </div>

                            <div class="inclusion-item">
                                <div class="inclusion-icon exclusion">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Meals</h4>
                                    <p>Meals are not included unless specified</p>
                                </div>
                            </div>

                            <div class="inclusion-item">
                                <div class="inclusion-icon exclusion">
                                    <i class="fas fa-camera-retro"></i>
                                </div>
                                <div class="inclusion-text">
                                    <h4>Underwater Photography</h4>
                                    <p>Underwater photography equipment and services</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5 position-relative">
    <div class="testimonial-bg-shape position-absolute top-0 end-0 d-none d-lg-block"
        style="width: 35%; height: 100%; background-color: rgba(17, 157, 213, 0.05); border-radius: 0 0 0 100px; z-index: 0;">
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="section-header-left">
                    <div class="section-tag mb-3 d-inline-block py-1 px-3"
                        style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                        <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i
                                class="fas fa-comment-dots me-2"></i>TESTIMONIALS</span>
                    </div>
                    <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Customer <span
                            style="color: #f9680f;">Reviews</span></h2>
                    <p class="lead">See what our customers have to say about their private boat charter experiences.</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="testimonial-stats d-inline-flex align-items-center gap-4 p-3"
                    style="background-color: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="stat-item text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="display-6 fw-bold me-1" style="color: rgb(17, 157, 213);">4.9</span>
                            <i class="fas fa-star ms-1" style="color: #f9680f;"></i>
                        </div>
                        <p class="small text-muted mb-0">Average Rating</p>
                    </div>
                    <div class="stat-divider" style="width: 1px; height: 40px; background-color: #e0e0e0;"></div>
                    <div class="stat-item text-center">
                        <div class="fw-bold display-6 mb-2" style="color: rgb(17, 157, 213);">200+</div>
                        <p class="small text-muted mb-0">Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial-slider position-relative owl-carousel owl-theme">

            <!-- Slide 1 -->
            @foreach($testimonials as $testimonial)
            <div class="item">
                <div class="testimonial-card h-100 p-4 rounded-4 position-relative overflow-hidden"
                    style="background-color: white; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); border: 1px solid rgba(17, 157, 213, 0.1); transition: all 0.3s ease;">
                    <div class="testimonial-pattern position-absolute"
                        style="top: 0; right: 0; width: 80px; height: 80px; opacity: 0.05; z-index: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24"
                            fill="rgb(17, 157, 213)">
                            <path
                                d="M11.3,6.2H8.7c-0.2,0-0.3-0.1-0.3-0.3V3.3c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C11.6,6.1,11.5,6.2,11.3,6.2z M16.4,6.2h-2.6c-0.2,0-0.3-0.1-0.3-0.3V3.3c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C16.7,6.1,16.6,6.2,16.4,6.2z M11.3,11.3H8.7c-0.2,0-0.3-0.1-0.3-0.3V8.4c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C11.6,11.2,11.5,11.3,11.3,11.3z M16.4,11.3h-2.6c-0.2,0-0.3-0.1-0.3-0.3V8.4c0-0.2,0.1-0.3,0.3-0.3h2.6c0.2,0,0.3,0.1,0.3,0.3v2.6C16.7,11.2,16.6,11.3,16.4,11.3z">
                            </path>
                        </svg>
                    </div>
                    <div class="testimonial-content position-relative" style="z-index: 1;">
                        <div class="testimonial-rating mb-3 d-flex align-items-center">
                            <div class="stars me-2">
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                                <i class="fas fa-star" style="color: #f9680f;"></i>
                            </div>
                            <span class="small fw-semibold" style="color: #333;">5.0</span>
                        </div>
                        <div class="testimonial-quote mb-3" style="color: rgb(17, 157, 213);">
                            <i class="fas fa-quote-left fa-2x opacity-25"></i>
                        </div>
                        <p class="testimonial-text mb-4" style="font-size: 1rem; line-height: 1.6;">
                            "{{$testimonial['text']}}"</p>

                        <div class="testimonial-author d-flex align-items-center">
                            <div class="author-avatar me-3 position-relative">
                                <img src="{{$testimonial['avatar']}}" alt="Rahul Sharma" class="rounded-circle"
                                    width="60" height="60" style="border: 3px solid rgba(17, 157, 213, 0.2);">
                                <div class="verification-badge position-absolute"
                                    style="bottom: 0; right: 0; background-color: #f9680f; color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; border: 2px solid white;">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="h6 fw-bold mb-0">{{ ucwords($testimonial['name']) }}</h4>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt me-1 small" style="color: #f9680f;"></i>
                                    <p class="small mb-0">{{ ucwords($testimonial['location']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Add other testimonial items in same structure inside <div class="item">...</div> -->

        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 position-relative">
    <!-- Background Elements -->
    <div class="faq-bg-shape position-absolute bottom-0 start-0 d-none d-lg-block"
        style="width: 25%; height: 70%; background-color: rgba(17, 157, 213, 0.03); border-radius: 0 100px 0 0; z-index: 0;">
    </div>
    <div class="faq-bg-dots position-absolute top-0 end-0 d-none d-lg-block"
        style="width: 180px; height: 180px; z-index: 0; opacity: 0.4;">
        <svg width="100%" height="100%" viewBox="0 0 100 100">
            <pattern id="pattern-circles" x="0" y="0" width="14" height="14" patternUnits="userSpaceOnUse"
                patternContentUnits="userSpaceOnUse">
                <circle id="pattern-circle" cx="7" cy="7" r="2" fill="#f9680f"></circle>
            </pattern>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-circles)"></rect>
        </svg>
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="section-header-left">
                    <div class="section-tag mb-3 d-inline-block py-1 px-3"
                        style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                        <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i
                                class="fas fa-question-circle me-2"></i>SUPPORT</span>
                    </div>
                    <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Frequently Asked <span
                            style="color: #f9680f;">Questions</span></h2>
                    <p class="lead">Find answers to common questions about our private boat charter services.</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="faq-contact-card d-inline-flex align-items-center p-3"
                    style="background-color: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="faq-contact-icon me-3 p-3 rounded-circle"
                        style="background-color: rgba(17, 157, 213, 0.1);">
                        <i class="fas fa-headset fa-2x" style="color: rgb(17, 157, 213);"></i>
                    </div>
                    <div class="faq-contact-info text-start">
                        <p class="small mb-0" style="color: #f9680f; font-weight: 600;">Still have questions?</p>
                        <h4 class="mb-0">Call us at <a href="tel:+918900909900"
                                style="color: rgb(17, 157, 213); text-decoration: none;">+91 8900909900</a></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="text-align:justify">
            <div class="col-lg-6">
                <div class="faq-accordion-container p-4"
                    style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    What is the cancellation policy for private boat charters?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Our cancellation policy allows for a full refund if cancelled 7
                                            days or more before
                                            the scheduled date. Cancellations made 3-6 days before receive a 50% refund.
                                            Cancellations less than 3 days before the scheduled date are non-refundable.
                                            In case
                                            of adverse weather conditions, we offer rescheduling or a full refund.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Can we customize our boat charter itinerary?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Yes, we offer fully customizable itineraries for all our private
                                            boat charters. You
                                            can work with our team to design a route that includes your preferred
                                            destinations,
                                            activities, and time allocations. Please note that some locations may
                                            require
                                            special permits or have time restrictions.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    What should we bring for a private boat charter?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">We recommend bringing sunscreen, sunglasses, hat, swimwear,
                                            towel, change of clothes,
                                            camera (preferably waterproof), any personal medications, and cash for
                                            additional
                                            expenses. We provide water, basic refreshments, and all necessary safety
                                            equipment.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Is there a minimum or maximum group size for private charters?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Our boats accommodate different group sizes. The Luxury
                                            Speedboat can take up to 8
                                            passengers, the Premium Cruiser up to 12 passengers, and the Sunset Yacht up
                                            to 6
                                            passengers. For larger groups, we can arrange multiple boats. The minimum
                                            group size
                                            is 2 passengers.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    What is the best time of year for boat charters in Andaman?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">The best time for boat charters in the Andaman Islands is from
                                            October to May when
                                            the sea is calm and visibility is excellent. June and September have
                                            occasional rain
                                            but are still good. July and August should be avoided due to monsoon season
                                            with
                                            rough seas and reduced visibility.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="faq-accordion-container p-4"
                    style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 6 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq6"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Types of boat charter available in the Andaman Islands?

                                </button>
                            </h3>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">We at Andaman Bliss, do offer boat charter services in a range of options for traveler's based on their preference and budget. For island hopping you can take a speed boat, a catamaran for your family, you can take a luxury yacht for private events, or you can take a fishing boat for game fishing experiences. You might be planning a romantic getaway, group travel, or a special event such an anniversary or proposal, Andaman Bliss offers top-notch boat charter services around Port Blair, Havelock, Neil and more.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq7"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Can I hire or charter a Private Boat for Island Hopping?
                                </button>
                            </h3>
                            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Absolutely, you can hire or charter a Private Boat for Island Hopping, it is one of the most popular and exciting ways to explore all the nearby islands such as Neil Islands, Havelock Islands, Ross Island, North Bay Island, Baratang and Jolly Buoy as well. A private boat charter allows you to customize your itinerary, avoid crowds and enjoys various activities along the way like snorkeling, swimming or just relaxing.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 8 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq8"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Are boat charters in Andaman Islands safe and do they come with crew?    
                                </button>
                            </h3>
                            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Absolutely, All charter boats that are arranged by Andaman Bliss does come with best boat options, licensed operators, certified crew members and state of the art safety gear like life jackets and all emergency equipment. Additionally, most boats come with a knowledgeable guide or a knowledgable crew who will help you to understand the local marine life, history of islands and brief you will all the safety protocols.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 9 -->
                        <div class="accordion-item border-0 mb-3">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq9"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    What is the cost of a boat charter in Andaman Islands?
                                </button>
                            </h3>
                            <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Charter boats arranged through Andaman Bliss are priced based on the type of boat, timeline, number of guests and the route the guest would like to choose. A half-day yacht charter for a couple could range from ₹10,000 to ₹15,000 and a lavish yacht charter for a sunset cruise or celebration could cost above ₹40,000 to ₹1,00,000. We can do guest group charter as well, for island hopping and fishing charter at per person or whole charter boat fee.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 10 -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq10"
                                    style="background-color: rgba(17, 157, 213, 0.03); border-radius: 10px; font-weight: 600; color: #333;">
                                    <i class="fas fa-question-circle me-2" style="color: rgb(17, 157, 213);"></i>
                                    Can I hire a private charter boat to celebrate a private event?
                                </button>
                            </h3>
                            <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body p-3">
                                    <div class="faq-answer p-3"
                                        style="background-color: rgba(17, 157, 213, 0.02); border-radius: 10px; border-left: 3px solid rgb(17, 157, 213);">
                                        <p class="mb-0">Yes, you can hire a private charter boat from Andaman Bliss to celebrate private events like birthdays, anniversaries, pre-wedding shoots and proposals are frequently held on boat charters. You can choose packages that include decoration, onboard meals, music and even candlelight setups. The custom yacht events from Havelock or Port Blair are ideal for those looking to add a touch of luxury to your celebration.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="faq-more-help text-center mt-4">
                        <p class="small text-muted mb-2">Can't find what you're looking for?</p>
                        <a href="#contact-us" class="btn btn-sm px-4 py-2"
                            style="background-color: rgb(17, 157, 213); color: white; border-radius: 50px; font-weight: 600;">
                            <i class="fas fa-envelope me-2"></i> Contact Support
                        </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 position-relative">
    <div class="cta-bg position-absolute w-100 h-100 top-0 start-0">
        <img src="https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
            alt="Premium Cruiser" class="w-100 h-100 object-fit-cover" style="filter: brightness(0.9);">
        <div class="cta-overlay position-absolute w-100 h-100 top-0 start-0" style="background: rgba(0,0,0,0.3);"></div>
    </div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8 text-center">
                <div class="cta-text-container p-4" style="background-color: rgba(0,0,0,0.5); border-radius: 15px;">
                    <h2 class="display-4 fw-bold mb-4"
                        style="color: rgb(17, 157, 213); text-shadow: 0 2px 10px rgba(0,0,0,0.5);">Ready to <span
                            style="color: #f9680f;">Set Sail?</span></h2>
                    <p class="lead mb-4 text-white" style="text-shadow: 0 2px 5px rgba(0,0,0,0.8);">Book your private
                        boat charter
                        today and experience the beauty of Andaman Islands
                        in luxury and comfort.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="#booking-form" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold">Book Now</a>
                        <a href="tel:+918900909900" class="btn btn-light btn-lg rounded-pill px-4"><i
                                class="fas fa-phone-alt me-2"></i> Call Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Full Booking Form Section -->
<section id="booking-form" class="booking-section py-5 position-relative">
    <!-- Background Elements -->
    <div class="booking-bg-shape position-absolute top-0 end-0 d-none d-lg-block"
        style="width: 30%; height: 70%; background-color: rgba(17, 157, 213, 0.03); border-radius: 0 0 0 100px; z-index: 0;">
    </div>
    <div class="booking-bg-waves position-absolute bottom-0 start-0 d-none d-lg-block"
        style="width: 200px; height: 200px; z-index: 0; opacity: 0.2;">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="rgb(17, 157, 213)"
                d="M37.9,-65.5C46.1,-55.2,48.4,-39.5,55.3,-26.2C62.2,-12.9,73.8,-2.1,74.9,9.5C76,21.1,66.6,33.5,55.8,42.4C45,51.3,32.8,56.7,20.4,60.2C8,63.7,-4.7,65.3,-18.1,63.5C-31.5,61.7,-45.6,56.5,-54.6,46.6C-63.6,36.7,-67.5,22.1,-70.3,6.8C-73.1,-8.5,-74.8,-24.5,-68.2,-36.1C-61.6,-47.7,-46.7,-54.9,-32.9,-62.8C-19.1,-70.7,-6.3,-79.3,5.2,-78.1C16.7,-76.9,29.7,-75.8,37.9,-65.5Z"
                transform="translate(100 100)" />
        </svg>
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <div class="section-header-left">
                    <div class="section-tag mb-3 d-inline-block py-1 px-3"
                        style="background-color: rgba(17, 157, 213, 0.1); border-radius: 30px;">
                        <span class="small fw-semibold" style="color: rgb(17, 157, 213);"><i
                                class="fas fa-calendar-check me-2"></i>RESERVATION</span>
                    </div>
                    <h2 class="fw-bold mb-3" style="color: rgb(17, 157, 213);">Book Your <span
                            style="color: #f9680f;">Charter</span></h2>
                    <p class="lead">Fill out the form to book your private boat charter or request more information.</p>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                <div class="booking-benefits d-inline-flex flex-column p-4"
                    style="background-color: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <div class="benefit-header mb-3">
                        <h4 class="h5 mb-0" style="color: rgb(17, 157, 213);">Why Book With Us?</h4>
                    </div>
                    <div class="benefit-list">
                        <div class="benefit-item d-flex align-items-center mb-2">
                            <div class="benefit-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="small mb-0">Instant confirmation</p>
                        </div>
                        <div class="benefit-item d-flex align-items-center mb-2">
                            <div class="benefit-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="small mb-0">Free cancellation up to 7 days before</p>
                        </div>
                        <div class="benefit-item d-flex align-items-center">
                            <div class="benefit-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="small mb-0">Secure payment options</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="booking-form-container p-4"
                    style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                    <form method="POST" action="{{ url('boat-activity/boat-chater/contact') }}" id="bookingForm">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fullName" name="fullName"
                                        placeholder="Your Full Name"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="fullName" style="color: #666;">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="emailAddress" id="emailAddress"
                                        placeholder="Your Email Address"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="emailAddress" style="color: #666;">Email Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber"
                                        placeholder="Your Phone Number"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="phoneNumber" style="color: #666;">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="preferredDate" id="preferredDate"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                    <label for="preferredDate" style="color: #666;">Preferred Date</label>
                                </div>
                            </div>
                            <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                autocomplete="off">

                            <div class="col-12">
                                <div class="charter-options mb-4">
                                    <label class="form-label mb-3"
                                        style="color: rgb(17, 157, 213); font-weight: 600;">Select Charter Type</label>
                                    <div class="row g-3">
                                        @foreach($boatCharter as $boat)
                                        <div class="col-md-6 col-lg-3">
                                            <div class="charter-option-card">
                                                <input type="radio" name="charterType" value="{{$boat->name}}"
                                                    id="speedboat{{$loop->index}}" class="charter-option-input" hidden>
                                                <label for="speedboat{{$loop->index}}"
                                                    class="charter-option-label d-flex flex-column align-items-center p-3"
                                                    style="border: 1px solid rgba(17, 157, 213, 0.2); border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">
                                                    <div class="charter-icon mb-2"
                                                        style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: rgba(17, 157, 213, 0.1); border-radius: 50%;">
                                                        <i class="fas fa-ship" style="color: rgb(17, 157, 213);"></i>
                                                    </div>
                                                    <h6 class="charter-name mb-1 text-center">{{ ucwords($boat->name) }}
                                                    </h6>
                                                    @php
                                                    $minPrice = $boat->seasonalPrices->min('price');
                                                    $finalPrice = $minPrice ?? $boat->base_price;
                                                    @endphp
                                                    <p class="charter-price small mb-0" style="color: #f9680f;">₹{{
                                                        number_format($finalPrice, 2) }}
                                                        /{{ Str::lower($boat->duration) }}</p>
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="col-md-6 col-lg-3">
                                            <div class="charter-option-card">
                                                <input type="radio" name="charterType" id="custom"
                                                    class="charter-option-input" hidden>
                                                <label for="custom"
                                                    class="charter-option-label d-flex flex-column align-items-center p-3"
                                                    style="border: 1px solid rgba(17, 157, 213, 0.2); border-radius: 10px; cursor: pointer; transition: all 0.3s ease;">
                                                    <div class="charter-icon mb-2"
                                                        style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: rgba(17, 157, 213, 0.1); border-radius: 50%;">
                                                        <i class="fas fa-sliders-h"
                                                            style="color: rgb(17, 157, 213);"></i>
                                                    </div>
                                                    <h6 class="charter-name mb-1">Custom</h6>
                                                    <p class="charter-price small mb-0" style="color: #f9680f;">Contact
                                                        us</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="guestCount" id="guestCount"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                        <option selected disabled value="">Select an option</option>
                                        <option>1-2 Guests</option>
                                        <option>3-4 Guests</option>
                                        <option>5-8 Guests</option>
                                        <option>9-12 Guests</option>
                                        <option>13+ Guests</option>
                                    </select>
                                    <label for="guestCount" style="color: #666;">Number of Guests</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="tripDuration" id="tripDuration"
                                        style="border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);">
                                        <option selected disabled value="">Select an option</option>
                                        <option>2 - 3 Hours</option>
                                        <option>Half Day (4 - 5 Hours)</option>
                                        <option>Full Day (8 - 10 Hours)</option>
                                        <option>Custom Duration</option>
                                    </select>
                                    <label for="tripDuration" style="color: #666;">Trip Duration</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="specialRequests" id="specialRequests"
                                        style="height: 120px; border-radius: 10px; border: 1px solid rgba(17, 157, 213, 0.2);"
                                        placeholder="Any special requests or questions?"></textarea>
                                    <label for="specialRequests" style="color: #666;">Special Requests</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input me-2" name="termsChecks" type="checkbox"
                                        id="termsCheck"
                                        style="width: 20px; height: 20px; border: 1px solid rgba(17, 157, 213, 0.3); border-radius: 4px;"
                                        required>
                                    <label class="form-check-label" for="termsCheck">
                                        I agree to the <a href="#"
                                            style="color: rgb(17, 157, 213); text-decoration: none; border-bottom: 1px dotted rgb(17, 157, 213);">terms
                                            and conditions</a>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn w-100 py-3"
                                    style="background: linear-gradient(135deg, rgb(17, 157, 213) 0%, rgb(0, 198, 255) 100%); color: white; border-radius: 10px; font-weight: 600; box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);">
                                    <i class="fas fa-paper-plane me-2"></i> Submit Booking Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="booking-sidebar">
                    <div class="booking-summary p-4 mb-4"
                        style="background-color: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                        <h4 class="h5 mb-3" style="color: rgb(17, 157, 213);">What to Expect</h4>
                        <div class="summary-item d-flex align-items-start mb-3">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">Professional crew and captain with extensive local knowledge</p>
                            </div>
                        </div>
                        <div class="summary-item d-flex align-items-start mb-3">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">All safety equipment and life jackets provided</p>
                            </div>
                        </div>
                        <div class="summary-item d-flex align-items-start mb-3">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">Complimentary bottled water and refreshments</p>
                            </div>
                        </div>
                        <div class="summary-item d-flex align-items-start">
                            <div class="summary-icon me-3 mt-1" style="color: #f9680f;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="summary-text">
                                <p class="small mb-0">Customizable itinerary based on your preferences</p>
                            </div>
                        </div>
                    </div>

                    <div class="booking-contact p-4"
                        style="background: linear-gradient(135deg, rgba(17, 157, 213, 0.1) 0%, rgba(0, 198, 255, 0.1) 100%); border-radius: 20px; border-left: 4px solid rgb(17, 157, 213);">
                        <h4 class="h5 mb-3" style="color: rgb(17, 157, 213);">Need Help?</h4>
                        <p class="small mb-3">Our charter specialists are available to assist you with any questions.
                        </p>
                        <div class="contact-item d-flex align-items-center mb-2">
                            <div class="contact-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <a href="tel:+918900909900" style="color: #333; text-decoration: none;">+91 8900909900</a>
                        </div>
                        <div class="contact-item d-flex align-items-center">
                            <div class="contact-icon me-2" style="color: #f9680f;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="mailto:info@andamanbliss.com"
                                style="color: #333; text-decoration: none;">info@andamanbliss.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Lightbox Styles */
.lightbox {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 20px;
}

.lightbox.active {
    display: flex;
}

.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 80vh;
    margin: 0 auto;
}

.lightbox-image {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 5px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
}

.lightbox-caption {
    color: white;
    text-align: center;
    margin-top: 15px;
    font-size: 1.2rem;
    font-weight: 500;
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    color: white;
    font-size: 30px;
    cursor: pointer;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.lightbox-close:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: rotate(90deg);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 24px;
    cursor: pointer;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.lightbox-nav:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.lightbox-prev {
    left: 20px;
}

.lightbox-next {
    right: 20px;
}

:root {
    --primary-color: rgb(17, 157, 213);
    --secondary-color: rgb(255, 165, 0);
    --dark-color: #333;
    --light-color: #f8f9fa;
    --white: #fff;
    --transition: all 0.3s ease;
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --gradient-primary: linear-gradient(135deg, rgb(17, 157, 213) 0%, rgb(0, 198, 255) 100%);
    --gradient-secondary: linear-gradient(135deg, rgb(255, 165, 0) 0%, rgb(255, 120, 0) 100%);
}

/* Fishing Package Selection Styles */
.fishing-package {
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 15px;
    background-color: transparent;
}

/* FAQ Section Styles */
.faq-section {
    position: relative;
}

.fishing-package:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Remove default styling for the featured package */
.fishing-package.featured {
    border: none;
    background-color: transparent;
}

/* Selected state styling */
.fishing-package.selected {
    border: 2px solid rgb(17, 157, 213);
    background-color: rgba(17, 157, 213, 0.05);
}

.package-select {
    position: absolute;
    bottom: 15px;
    right: 15px;
    opacity: 0;
    transition: all 0.3s ease;
}

.fishing-package:hover .package-select {
    opacity: 0.7;
}

.fishing-package.selected .package-select {
    opacity: 1;
}

.select-indicator {
    display: inline-flex;
    align-items: center;
    font-size: 0.85rem;
    font-weight: 600;
    color: rgb(17, 157, 213);
}

.select-indicator i {
    margin-right: 5px;
}

/* Gallery Section Styles */
.gallery-section {
    position: relative;
    overflow: hidden;
}

.gallery-item {
    transition: all 0.5s ease;
}

.gallery-card {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.gallery-card img {
    transition: transform 0.5s ease;
}

.gallery-card:hover img {
    transform: scale(1.05);
}

.gallery-overlay {
    opacity: 0.7;
    transition: all 0.3s ease;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.filter-btn {
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    transform: translateY(-2px);
}

.filter-btn.active {
    background-color: rgb(17, 157, 213) !important;
    color: white !important;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.2);
}

.gallery-actions a {
    transition: all 0.3s ease;
}

.gallery-actions a:hover {
    background-color: rgba(255, 255, 255, 0.3) !important;
    transform: translateY(-2px);
}

/* Hero Section Styles */
.boat-charter-hero {
    min-height: 90vh;
    display: flex;
    align-items: center;
    position: relative;
}

.min-vh-75 {
    min-height: 75vh;
}

.hero-bg {
    overflow: hidden;
}

.hero-bg img {
    object-position: center;
    transition: transform 15s ease;
    transform: scale(1.05);
}

.boat-charter-hero:hover .hero-bg img {
    transform: scale(1);
}

.overlay-gradient {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.5) 100%);
    z-index: 1;
}

/* Floating Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    pointer-events: none;
}

.floating-bubble {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(5px);
    animation: float 8s infinite ease-in-out;
}

.bubble-1 {
    width: 80px;
    height: 80px;
    top: 15%;
    left: 10%;
    animation-delay: 0s;
}

.bubble-2 {
    width: 40px;
    height: 40px;
    top: 20%;
    right: 20%;
    animation-delay: 2s;
}

.bubble-3 {
    width: 60px;
    height: 60px;
    bottom: 30%;
    right: 10%;
    animation-delay: 4s;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-20px);
    }
}

/* Hero Content Styles */
.hero-content {
    color: var(--white);
    position: relative;
    z-index: 3;
}

.hero-badge {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 8px 16px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--white);
    display: inline-flex;
    align-items: center;
    transition: var(--transition);
}

.hero-badge:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    color: var(--white);
}

.gradient-text {
    color: rgb(17, 157, 213);
    display: inline-block;
    padding: 0 5px;
    position: relative;
    text-shadow: none;
}



.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
}

.btn-hero-primary {
    background: var(--gradient-primary);
    color: var(--white);
    border: none;
    border-radius: 50px;
    padding: 14px 28px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: var(--transition);
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

.btn-hero-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(17, 157, 213, 0.4);
    color: var(--white);
}

.btn-hero-secondary {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: var(--white);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    padding: 14px 28px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-hero-secondary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(17, 157, 213, 0.1);
    z-index: -1;
    transform: scale(0);
    transition: all 0.5s ease;
    border-radius: 50px;
}

.btn-hero-secondary:hover {
    background: #fff;
    transform: translateY(-3px);
    color: rgb(17, 157, 213);
    box-shadow: 0 0 25px rgba(255, 255, 255, 0.7);
    border-color: rgba(17, 157, 213, 0.5);
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }

    50% {
        box-shadow: 0 0 25px rgba(255, 255, 255, 0.8);
    }

    100% {
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
    }
}

.btn-hero-secondary:hover::before {
    transform: scale(1.5);
    opacity: 0;
}

.btn-hero-secondary:hover i {
    color: rgb(17, 157, 213);
    transform: scale(1.2);
    transition: all 0.3s ease;

}

/* Booking Card Styles */
.booking-card {
    background: var(--white);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
    position: relative;
    z-index: 3;
}

.booking-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.booking-card-header {
    background: var(--gradient-primary);
    padding: 15px 20px;
    color: var(--white);
    text-align: center;
}

.booking-title {
    font-weight: 700;
    margin-bottom: 0;
}

/* Compact Card Styles */
.compact-card {
    width: 100%;
    max-width: 350px;
    margin-left: auto;
    margin-right: auto;
    border-radius: 12px;
}

.compact-form {
    padding: 15px;
}

.form-control-sm,
.form-select-sm {
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    font-size: 0.85rem;
    padding-right: 30px;
}

.form-control-sm::placeholder {
    font-size: 0.85rem;
    opacity: 0.7;
}

.position-relative .form-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    opacity: 0.7;
    font-size: 0.85rem;
    pointer-events: none;
}

.btn-booking-submit {
    background: var(--gradient-primary);
    color: var(--white);
    border: none;
    border-radius: 50px;
    padding: 10px 20px;
    font-size: 0.9rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    transition: var(--transition);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

.btn-booking-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(17, 157, 213, 0.4);
}

.booking-features {
    display: flex;
    justify-content: space-between;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding-top: 10px;
}

.booking-features .feature-item {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
    color: var(--dark-color);
}

.booking-features .feature-item.small {
    font-size: 0.75rem;
}

.booking-features .feature-item i {
    color: var(--primary-color);
    margin-right: 5px;
    font-size: 0.85rem;
}

.wave-separator {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    line-height: 0;
    z-index: 2;
}

.wave-separator svg {
    width: 100%;
    height: 120px;
    filter: drop-shadow(0 -5px 5px rgba(0, 0, 0, 0.05));
}

/* Feature Cards */
.feature-card {
    transition: var(--transition);
    border: 1px solid rgba(0, 0, 0, 0.05);
    background-color: var(--white);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.charter-feature-icon {
    width: 70px;
    height: 70px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: var(--primary-color);
    transition: var(--transition);
}


.feature-card:hover .charter-feature-icon {
    background-color: var(--primary-color);
    color: var(--white);
}

/* Charter Cards */
.charter-card {
    transition: var(--transition);
}

.charter-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
}

.charter-specs {
    font-size: 14px;
}

.spec-item {
    background-color: rgba(17, 157, 213, 0.05);
    padding: 5px 10px;
    border-radius: 20px;
}

/* Responsive Styles */
@media (max-width: 1200px) {
    .hero-title {
        font-size: 3rem;
    }

    .booking-features {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
}

@media (max-width: 992px) {
    .boat-charter-hero {
        min-height: auto;
    }

    .min-vh-75 {
        min-height: auto;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .booking-card {
        margin-bottom: 30px;
    }

    .compact-card {
        max-width: 100%;
        margin: 0 auto;
    }
}

@media (max-width: 768px) {
    .charter-feature-icon {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }

    .charter-specs {
        flex-direction: column;
        gap: 10px;
    }

    .hero-title {
        font-size: 2.2rem;
    }

    .btn-hero-primary,
    .btn-hero-secondary {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }

    .booking-features {
        flex-direction: row;
    }

    .booking-features .feature-item {
        font-size: 0.75rem;
    }
}

@media (max-width: 576px) {
    .feature-card {
        padding: 15px !important;
    }

    .charter-feature-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }

    .hero-title {
        font-size: 1.8rem;
    }

    .hero-badge {
        font-size: 0.75rem;
        padding: 6px 12px;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .compact-card {
        max-width: 100%;
        margin: 0 auto;
    }

    .compact-form {
        padding: 12px;
    }

    .booking-features {
        flex-direction: row;
        gap: 5px;
    }

    .booking-features .feature-item.small {
        font-size: 0.7rem;
    }

    .booking-features .feature-item i {
        font-size: 0.8rem;
    }

    /* Adjust hero section padding on mobile */
    .boat-charter-hero .container {
        padding-top: 30px;
        padding-bottom: 30px;
    }
}

/* Additional Animations and Effects */
.route-card {
    transition: var(--transition);
}

.route-card:hover {
    transform: translateY(-10px);
}

.testimonial-card {
    transition: var(--transition);
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.accordion-button:not(.collapsed) {
    background-color: rgba(17, 157, 213, 0.1);
    color: var(--primary-color);
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(17, 157, 213, 0.1);
}

/* Animated Elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-content h1,
.hero-content p,
.hero-content .banner-badges,
.hero-content .d-flex {
    animation: fadeInUp 0.8s ease-out forwards;
}

.hero-content .banner-badges {
    animation-delay: 0.2s;
}

.hero-content h1 {
    animation-delay: 0.4s;
}

.hero-content p {
    animation-delay: 0.6s;
}

.hero-content .d-flex {
    animation-delay: 0.8s;
}

.booking-card {
    animation: fadeInUp 1s ease-out forwards;
    animation-delay: 1s;
}

/* Smooth Scrolling */
html {
    scroll-behavior: smooth;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: #0e8bc0;
}

/* New Modern Form Styles */
.inquiry-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    max-width: 380px;
    margin: 0 auto;
    position: relative;
    z-index: 10;
    border: 1px solid rgba(0, 0, 0, 0.08);
}

.inquiry-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

.inquiry-card-header {
    background: rgb(17, 157, 213);
    /* Skyblue color */
    padding: 20px;
    text-align: center;
    position: relative;
    border-radius: 16px 16px 0 0;
}

.inquiry-title {
    color: #ffffff;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.inquiry-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
    margin-bottom: 0;
}

.inquiry-form {
    padding: 20px;
}

.inquiry-input-wrapper {
    position: relative;
    margin-bottom: 0;
}

.inquiry-input,
.inquiry-select {
    width: 100%;
    height: 50px;
    padding: 10px 15px 10px 40px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background-color: #fff;
    font-size: 0.95rem;
    color: #333;
    transition: all 0.3s ease;
}

.inquiry-input:focus,
.inquiry-select:focus {
    border-color: rgb(17, 157, 213);
    /* Skyblue color */
    box-shadow: 0 0 0 3px rgba(17, 157, 213, 0.15);
    outline: none;
}

.input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 0.9rem;
    z-index: 1;
}

.inquiry-select {
    appearance: none;
    padding-right: 30px;
    background-color: #fff;
    cursor: pointer;
    background-image: none;
    /* Remove default arrow */
}

.select-arrow {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: rgb(17, 157, 213);
    /* Skyblue color */
    pointer-events: none;
    font-size: 0.8rem;
}

/* Fix for select text visibility */
.inquiry-select option {
    color: #333;
    font-size: 0.95rem;
    padding: 10px;
}

/* Fix for date input placeholder */
input[type="date"].inquiry-input::-webkit-datetime-edit {
    color: #333;
}

input[type="date"].inquiry-input::-webkit-calendar-picker-indicator {
    color: #20a9e0;
}

input[type="text"].inquiry-input::placeholder {
    color: #6c757d;
    opacity: 0.7;
}

.form-floating>.form-control:focus~label,
.form-floating>.form-select:focus~label {
    color: rgb(17, 157, 213);
    opacity: 0.8;
}

.custom-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23119DD5' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
}

.btn-inquiry-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    background: rgb(17, 157, 213);
    /* Skyblue color */
    color: #ffffff;
    font-weight: 600;
    font-size: 1rem;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 15px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(17, 157, 213, 0.3);
}

.btn-inquiry-submit:hover {
    background: #0e8bc0;
    /* Darker skyblue */
}

.btn-inquiry-submit:active {
    transform: translateY(1px);
}

.inquiry-features {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 5px;
}

.feature-badge {
    display: flex;
    align-items: center;
    background-color: rgba(32, 169, 224, 0.08);
    border-radius: 50px;
    padding: 5px 10px;
    font-size: 0.75rem;
    color: #555;
}

.feature-badge i {
    margin-right: 5px;
    font-size: 0.8rem;
}

.feature-badge:nth-child(1) i {
    color: #f39c12;
}

.feature-badge:nth-child(2) i {
    color: #20a9e0;
}

.feature-badge:nth-child(3) i {
    color: #2ecc71;
    background-color: rgba(46, 204, 113, 0.1);
    padding: 3px;
    border-radius: 50%;
}

/* Modern Charter Options Section Styles */
.charter-options-section {
    background-color: #f9fafb;
    position: relative;
    padding: 60px 0;
}

.charter-options-section::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(17, 157, 213, 0.05) 0%, rgba(17, 157, 213, 0) 70%);
    border-radius: 50%;
    z-index: 0;
}

.section-header {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
    z-index: 1;
}

.section-header h2 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: #333;
    position: relative;
    display: inline-block;
}

.section-header h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: linear-gradient(to right, rgb(17, 157, 213), rgb(0, 206, 255));
}

.section-header h2 span {
    color: rgb(17, 157, 213);
}

.section-header p {
    font-size: 1rem;
    color: #666;
    margin: 20px auto 0;
    max-width: 600px;
}

.charter-cards-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 20px;
    position: relative;
    z-index: 1;
}

.charter-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.charter-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(17, 157, 213, 0.1);
}

.charter-card-top {
    flex-grow: 1;
}

.charter-image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.charter-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.charter-card:hover .charter-image img {
    transform: scale(1.05);
}

.charter-tag {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgb(17, 157, 213);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.charter-info {
    padding: 20px;
}

.charter-info h3 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: #333;
}

.charter-specs {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.spec-item {
    font-size: 0.85rem;
    color: #555;
    display: flex;
    align-items: center;
    margin-right: 10px;
}

.spec-item i {
    color: rgb(17, 157, 213);
    margin-right: 5px;
    font-size: 0.9rem;
}

.charter-info p {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.5;
    margin-bottom: 0;
}

.charter-card-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #f9fafb;
    border-top: 1px solid #f0f0f0;
}

.charter-price {
    display: flex;
    align-items: baseline;
}

.charter-price .amount {
    font-size: 1.3rem;
    font-weight: 700;
    color: rgb(17, 157, 213);
    line-height: 1;
}

.charter-price .period {
    font-size: 0.85rem;
    color: #777;
}

.charter-book-btn {
    background: rgb(17, 157, 213);
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
}

.charter-book-btn:hover {
    background: #0e8bc0;
    color: white;
}

.view-more-container {
    text-align: center;
    margin-top: 30px;
}

/* Popular Routes Section Styles */
.popular-routes-section {
    background-color: #fff;
    position: relative;
    padding: 60px 0;
}

.routes-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 20px;
    position: relative;
    z-index: 1;
}

.route-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.route-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(17, 157, 213, 0.1);
}

.route-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.route-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.route-card:hover .route-image img {
    transform: scale(1.05);
}

.route-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.1));
    z-index: 1;
}

.route-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 2;
    margin-top: -60px;
    background: white;
    border-radius: 12px 12px 0 0;
}

.route-content h3 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: #333;
}

.route-details {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.route-detail {
    font-size: 0.85rem;
    color: #555;
    display: flex;
    align-items: center;
}

.route-detail i {
    color: rgb(17, 157, 213);
    margin-right: 5px;
    font-size: 0.9rem;
}

.route-content p {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.5;
    margin-bottom: 20px;
    flex-grow: 1;
}

.route-book-btn {
    align-self: flex-start;
    background: transparent;
    color: rgb(17, 157, 213);
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid rgb(17, 157, 213);
}

.route-book-btn:hover {
    background: rgb(17, 157, 213);
    color: white;
}

/* Game Fishing Section Styles */
.game-fishing-section {
    background-color: #f9fafb;
    padding: 50px 0;
}

.fishing-content-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 30px;
}

/* Left Column - Image Slider */
.fishing-image-col {
    position: relative;
}

.fishing-image-slider {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    height: 350px;
}

.fishing-image-slider img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.fishing-image-slider img.active {
    opacity: 1;
    z-index: 1;
}

.slider-controls {
    position: absolute;
    bottom: 15px;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 8px;
    z-index: 2;
}

.slider-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-dot.active {
    background: white;
    transform: scale(1.2);
}

.fishing-highlights {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

.charter-highlight-item {
    display: flex;
    align-items: center;
    background: white;
    padding: 10px 15px;
    border-radius: 8px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    flex: 1;
    margin: 0 5px;
}

.charter-highlight-item i {
    color: rgb(17, 157, 213);
    font-size: 1.2rem;
    margin-right: 10px;
}

.highlight-text {
    font-size: 0.85rem;
    font-weight: 500;
    color: #555;
}

/* Right Column - Content */
.fishing-content-col {
    display: flex;
    flex-direction: column;
}

.fishing-description {
    margin-bottom: 20px;
}

.fishing-description p {
    font-size: 0.95rem;
    color: #555;
    line-height: 1.6;
}

.fishing-packages {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 20px;
}

.fishing-package {
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    position: relative;
}

.fishing-package.featured {
    border: 1px solid rgb(17, 157, 213);
}

.package-tag {
    position: absolute;
    top: -10px;
    right: 15px;
    background: rgb(17, 157, 213);
    color: white;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 600;
}

.package-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.package-header h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.charter-package-price {
    font-weight: 700;
    color: rgb(17, 157, 213);
}

.charter-package-price span {
    font-size: 0.85rem;
    font-weight: 400;
    color: #777;
}

.package-features {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.package-features span {
    font-size: 0.85rem;
    color: #555;
    display: flex;
    align-items: center;
    background: #03a9f41c;
    padding: 5px 10px;
    border-radius: 5px;
    margin-right: 5px;
}

.package-features span i {
    color: #03A9F4;
    margin-right: 5px;
    font-size: 0.8rem;
}

.fishing-cta {
    margin-bottom: 20px;
}

.fishing-book-btn {
    display: inline-block;
    background: rgb(17, 157, 213);
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.fishing-book-btn:hover {
    background: #0e8bc0;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.2);
    color: white;
}

.fishing-species {
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.fishing-species h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
}

.species-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.species-tags span {
    background: rgba(17, 157, 213, 0.1);
    color: rgb(17, 157, 213);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.view-more-btn {
    display: inline-flex;
    align-items: center;
    background: transparent;
    color: rgb(17, 157, 213);
    padding: 10px 20px;
    border: 2px solid rgb(17, 157, 213);
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.view-more-btn i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.view-more-btn:hover {
    background: rgb(17, 157, 213);
    color: white;
}

.view-more-btn:hover i {
    transform: translateX(3px);
}

@media (max-width: 992px) {

    .charter-cards-container,
    .routes-container {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }

    .fishing-content-row {
        grid-template-columns: 1fr;
        gap: 25px;
    }

    .fishing-image-slider {
        height: 300px;
    }
}

@media (max-width: 768px) {

    .charter-options-section,
    .popular-routes-section,
    .game-fishing-section,
    .whats-included-section {
        padding: 40px 0;
    }

    .inclusion-items {
        grid-template-columns: 1fr;
    }

    .section-header h2 {
        font-size: 1.8rem;
    }

    .charter-cards-container,
    .routes-container {
        grid-template-columns: 1fr;
        max-width: 450px;
        margin: 0 auto;
    }

    .route-image {
        height: 180px;
    }

    .fishing-image-slider {
        height: 250px;
    }

    .fishing-highlights {
        flex-wrap: wrap;
    }

    .charter-highlight-item {
        flex: 0 0 calc(50% - 10px);
        margin-bottom: 10px;
    }

    .package-features {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
    .charter-card-bottom {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }

    .charter-price {
        justify-content: center;
    }

    .charter-book-btn {
        text-align: center;
    }

    .fishing-image-slider {
        height: 200px;
    }

    .charter-highlight-item {
        flex: 0 0 100%;
    }

    .package-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .species-tags span {
        font-size: 0.75rem;
    }
}

/* What's Included Section Styles */
.whats-included-section {
    background-color: #f9fafb;
}

.inclusions-container {
    margin-top: 30px;
}

.inclusion-tabs {
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.tab-buttons {
    display: flex;
    border-bottom: 1px solid #eee;
}

.tab-btn {
    flex: 1;
    padding: 15px;
    background: none;
    border: none;
    font-weight: 600;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.tab-btn.active {
    color: rgb(17, 157, 213);
}

.tab-btn.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: rgb(17, 157, 213);
}

.tab-btn i {
    margin-right: 8px;
}

.tab-btn:first-child i {
    color: #4CAF50;
}

.tab-btn:last-child i {
    color: #F44336;
}

.tab-content {
    padding: 20px;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.inclusion-items {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 15px;
}

.inclusion-item {
    display: flex;
    align-items: flex-start;
    padding: 15px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.inclusion-item:hover {
    background: #f9fafb;
}

.inclusion-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    background: rgba(17, 157, 213, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

.inclusion-icon i {
    color: rgb(17, 157, 213);
    font-size: 1rem;
}

.inclusion-icon.exclusion {
    background: rgba(244, 67, 54, 0.1);
}

.inclusion-icon.exclusion i {
    color: #F44336;
}

.inclusion-text h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
}

.inclusion-text p {
    font-size: 0.85rem;
    color: #666;
    margin: 0;
    line-height: 1.4;
}

/* Improved text visibility */
.hero-subtitle.text-white {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    font-weight: 500;
}

.badge {
    background-color: #f9680f;
    color: #ffffff;
    font-weight: 700;
    font-size: medium;
    padding: 5px 45px;
    position: absolute;
    top: 35px;
    left: -35px;
    transform: rotate(-45deg);
}

.read-more {
    color: black;
    font-weight: 600;
}

.charter-option-input:checked+.charter-option-label {
    border-color: rgb(17, 157, 213);
    background-color: rgba(17, 157, 213, 0.1);
    box-shadow: 0 0 0 3px rgba(17, 157, 213, 0.15);
}

.charter-option-label:hover {
    background-color: rgba(17, 157, 213, 0.05);
}
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Owl Carousel Init -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all book now buttons
    const bookButtons = document.querySelectorAll('.charter-book-btn');
    const charterSelect = document.getElementById('charterType');

    bookButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const charterCard = this.closest('.charter-card');

            const charterName = charterCard.querySelector('.charter-info h3').textContent.trim()
                .toLowerCase();

            const options = charterSelect.options;
            for (let i = 0; i < options.length; i++) {
                if (options[i].value.toLowerCase() === charterName) {
                    charterSelect.selectedIndex = i;
                    break;
                }
            }

            const form = document.getElementById('booking-form');
            form.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
$(document).ready(function() {
    $('.testimonial-slider').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });


});
</script>
<script>
// Function to handle fishing package selection
function selectFishingPackage(packageType) {
    const packages = document.querySelectorAll('.fishing-package');
    packages.forEach(pkg => {
        pkg.classList.remove('selected');
        pkg.style.border = 'none';
        pkg.style.backgroundColor = 'transparent';
    });
    const selectedPackage = document.getElementById(`package-${packageType}`);
    if (selectedPackage) {
        selectedPackage.classList.add('selected');
        selectedPackage.style.border = '2px solid rgb(17, 157, 213)';
        selectedPackage.style.backgroundColor = 'rgba(17, 157, 213, 0.05)';
    }
}

// Function to handle gallery filtering
function initGalleryFilter() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            filterButtons.forEach(btn => {
                btn.style.backgroundColor = 'rgba(17, 157, 213, 0.1)';
                btn.style.color = '#333';
            });

            // Add active class to clicked button
            this.classList.add('active');
            this.style.backgroundColor = 'rgb(17, 157, 213)';
            this.style.color = 'white';

            const filter = this.getAttribute('data-filter');

            // Show/hide gallery items based on filter
            galleryItems.forEach(item => {
                if (filter === 'all') {
                    item.style.display = 'block';
                    // Add animation
                    item.style.opacity = '0';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transition = 'opacity 0.5s ease';
                    }, 50);
                } else {
                    if (item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                        // Add animation
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transition = 'opacity 0.5s ease';
                        }, 50);
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    });

    // Add hover effects to gallery cards
    const galleryCards = document.querySelectorAll('.gallery-card');
    galleryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 15px 40px rgba(0, 0, 0, 0.15)';
            const overlay = this.querySelector('.gallery-overlay');
            if (overlay) {
                overlay.style.opacity = '1';
            }
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
            const overlay = this.querySelector('.gallery-overlay');
            if (overlay) {
                overlay.style.opacity = '0.7';
            }
        });
    });
}

// Function to initialize lightbox
function initLightbox() {
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImage = lightbox.querySelector('.lightbox-image');
    const lightboxCaption = lightbox.querySelector('.lightbox-caption');
    const lightboxClose = lightbox.querySelector('.lightbox-close');
    const lightboxPrev = lightbox.querySelector('.lightbox-prev');
    const lightboxNext = lightbox.querySelector('.lightbox-next');

    // Get all gallery images
    const galleryTriggers = document.querySelectorAll('.lightbox-trigger');
    let currentIndex = 0;
    let galleryImages = [];

    // Collect all gallery images and their data
    galleryTriggers.forEach((trigger, index) => {
        galleryImages.push({
            src: trigger.getAttribute('href'),
            title: trigger.getAttribute('data-title') || ''
        });

        // Add click event to open lightbox
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            currentIndex = index;
            openLightbox(currentIndex);
        });
    });

    // Function to open lightbox
    function openLightbox(index) {
        if (galleryImages.length === 0) return;

        const image = galleryImages[index];
        lightboxImage.src = image.src;
        lightboxImage.alt = image.title;
        lightboxCaption.textContent = image.title;

        // Show/hide navigation based on gallery length
        if (galleryImages.length <= 1) {
            lightboxPrev.style.display = 'none';
            lightboxNext.style.display = 'none';
        } else {
            lightboxPrev.style.display = 'flex';
            lightboxNext.style.display = 'flex';
        }

        // Show lightbox with animation
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Function to close lightbox
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Function to navigate to previous image
    function prevImage() {
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        openLightbox(currentIndex);
    }

    // Function to navigate to next image
    function nextImage() {
        currentIndex = (currentIndex + 1) % galleryImages.length;
        openLightbox(currentIndex);
    }

    // Add event listeners
    lightboxClose.addEventListener('click', closeLightbox);
    lightboxPrev.addEventListener('click', prevImage);
    lightboxNext.addEventListener('click', nextImage);

    // Close lightbox when clicking outside the image
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;

        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const fullDayPackage = document.getElementById('package-full-day');
    if (fullDayPackage) {
        selectFishingPackage('full-day');
    } else {
        const firstPackage = document.querySelector('.fishing-package');
        if (firstPackage) {
            selectFishingPackage(firstPackage.id.replace('package-', ''));
        }
    }
    // Initialize gallery filter functionality
    initGalleryFilter();

    // Initialize lightbox functionality
    initLightbox();
    // Parallax effect for hero section
    const heroSection = document.querySelector('.boat-charter-hero');
    const heroImage = document.querySelector('.hero-bg img');

    if (heroSection && heroImage && window.innerWidth > 992) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            if (scrollPosition < heroSection.offsetHeight) {
                heroImage.style.transform = `scale(1.05) translateY(${scrollPosition * 0.15}px)`;
            }
        });
    }

    // Fishing image slider functionality
    const fishingImageSlider = document.querySelector('.fishing-image-slider');
    if (fishingImageSlider) {
        const slides = fishingImageSlider.querySelectorAll('img');
        const dots = document.querySelectorAll('.slider-controls .slider-dot');

        let currentSlide = 0;
        const slideCount = slides.length;

        // Function to show a specific slide
        function showSlide(index) {
            // Hide all slides
            slides.forEach(slide => {
                slide.classList.remove('active');
            });

            // Remove active class from all dots
            dots.forEach(dot => {
                dot.classList.remove('active');
            });

            // Show the current slide
            slides[index].classList.add('active');

            // Add active class to current dot
            dots[index].classList.add('active');

            currentSlide = index;
        }

        // Add click events to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Auto-advance slides every 4 seconds
        setInterval(() => {
            let newIndex = currentSlide + 1;
            if (newIndex >= slideCount) newIndex = 0;
            showSlide(newIndex);
        }, 4000);
    }

    // Initialize animations for elements that come into view
    const animateOnScroll = function() {
        const elements = document.querySelectorAll(
            '.feature-card, .charter-card, .route-card, .testimonial-card, .card, .accordion-item');

        elements.forEach((element, index) => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.1;

            if (elementPosition < screenPosition) {
                // Add staggered delay based on element index within its parent
                const delay = index % 3 * 0.15;
                element.style.transitionDelay = `${delay}s`;
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };

    // Set initial state for animated elements
    const elementsToAnimate = document.querySelectorAll(
        '.feature-card, .charter-card, .route-card, .testimonial-card, .card, .accordion-item');
    elementsToAnimate.forEach(element => {
        element.style.opacity = '1';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
    });

    // Run animation on scroll with throttling for better performance
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (!scrollTimeout) {
            scrollTimeout = setTimeout(function() {
                animateOnScroll();
                scrollTimeout = null;
            }, 50);
        }
    });

    // Run once on page load
    animateOnScroll();

    // Inclusion/Exclusion Tabs
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            tabBtns.forEach(b => b.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Hide all tab panes
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Show the corresponding tab pane
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Enhanced form interactions for the new input structure
    const formInputs = document.querySelectorAll('.inquiry-input, .inquiry-select');
    formInputs.forEach(input => {
        // Add focus effect
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) {
                icon.style.color = 'rgb(17, 157, 213)'; // Skyblue color
            }
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
            const icon = this.parentElement.querySelector('.input-icon');
            if (icon) {
                icon.style.color = '#6c757d';
            }
        });

        // Set initial state for date inputs that might have value
        if (input.type === 'date' || (input.type === 'text' && input.id === 'charterDate')) {
            input.addEventListener('change', function() {
                if (this.value) {
                    this.classList.add('has-value');
                } else {
                    this.classList.remove('has-value');
                }
            });

            // Check on load
            if (input.value) {
                input.classList.add('has-value');
            }
        }
    });



    // Add keyframe animations and additional styles
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }

        .inquiry-input-wrapper.focused .input-icon {
            color: rgb(17, 157, 213) !important; /* Skyblue color */
        }

        .inquiry-input-wrapper.error-field .input-icon {
            color: #dc3545 !important;
        }

        .inquiry-input-wrapper.error-field .inquiry-input,
        .inquiry-input-wrapper.error-field .inquiry-select {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-valid {
            border-color: #28a745 !important;
        }

        .btn-inquiry-submit.loading {
            background: #6c757d;
            pointer-events: none;
        }

        .btn-inquiry-submit.success {
            background: #28a745;
        }

        .inquiry-message {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .inquiry-message.show {
            transform: translateY(0);
            opacity: 1;
        }

        .success-message {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid #28a745;
        }

        .error-message {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid #dc3545;
        }

        .message-icon {
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .success-message .message-icon {
            color: #28a745;
        }

        .error-message .message-icon {
            color: #dc3545;
        }

        .message-content h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .message-content p {
            font-size: 0.85rem;
            margin-bottom: 0;
            color: #6c757d;
        }

        /* Fix for date input */
        input[type="date"].has-value {
            color: #212529;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush