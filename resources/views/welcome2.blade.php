@extends('layouts.app')

@section('title', 'Best Travel Agency & Andaman Tour Packages | Tour Operator in Andaman')

@section('meta')
<link rel="canonical" href="https://andamanbliss.com/" />
@endsection


@section('keywords', 'Best Travel Agency in Andaman, Andaman Tour Packages, Best Andaman Tour Operator, Customized
Andaman Packages, Andaman Honeymoon Packages, Andaman Family Packages, Budget Andaman Packages')
@section('description', 'Welcome to the best travel agency in Andaman, offers the best Andaman tour packages for
everyone. Book now for customized trips to explore the best of Andaman')
@section('meta_schema')
{
"@context": "https://schema.org",
"@type": "TravelAgency",
"name": "Andaman Bliss",
"url": "https://andamanbliss.com",
"logo": "https://andamanbliss.com/site/img/logo.png",
"description": "Welcome to the best travel agency in Andaman, offering customizable Andaman tour packages, hotel and
activity bookings, transfers, and expert trip planning for every traveler.",
"image": "https://andamanbliss.com/site/img/logo.png",
"telephone": "+91-8900909900",
"email": "info@andamanbliss.com",
"areaServed": "Andaman & Nicobar Islands, India",
"address": {
"@type": "PostalAddress",
"streetAddress": "Port Blair, South Andaman",
"addressLocality": "Port Blair",
"addressRegion": "Andaman & Nicobar Islands",
"postalCode": "744101",
"addressCountry": "IN"
},
"keywords": "Best Travel Agency in Andaman, Andaman Tour Packages, Andaman Hotels, Andaman Activities, Customized
Andaman Packages, Andaman Honeymoon Packages, Andaman Family Packages, Budget Andaman Packages, Scuba Diving Andaman,
Andaman Transfers, Car Rental Andaman",
"serviceOffer": [
{
"@type": "Offer",
"name": "Andaman Tour Packages",
"description": "Wide range of Andaman tour packages including customized, family, honeymoon, group and budget trips."
},
{
"@type": "Offer",
"name": "Hotel Booking",
"description": "Handpicked hotels & resorts booking service in Andaman Islands."
},
{
"@type": "Offer",
"name": "Activity Booking",
"description": "Book activities like scuba diving, snorkeling, sightseeing, water sports, and more in Andaman."
},
{
"@type": "Offer",
"name": "Transport & Transfers",
"description": "Airport and local transfers, private car rentals, and arrival assistance in Andaman."
},
{
"@type": "Offer",
"name": "Customized Itinerary Planning",
"description": "Personalized trip planning and Andaman tour customization as per traveler’s preferences."
}
],
"review": {
"@type": "Review",
"author": "Verified Traveller",
"reviewRating": {
"@type": "Rating",
"ratingValue": "5",
"bestRating": "5"
},
"reviewBody": "Excellent service, knowledgeable guides, and seamless arrangements made our Andaman trip unforgettable!"
},
"sameAs": [
"https://www.facebook.com/AndamanBliss",
"https://www.instagram.com/andamanbliss",
"https://www.tripadvisor.in/Attraction_Review-g297584-d13198828-Reviews-Andaman_Bliss-Port_Blair_South_Andaman_Island_Andaman_and_Nicobar_Islands.html"
]
}
@endsection
@section('og_title', 'Andaman Bliss – Best Travel Agency in Andaman | Andaman Tour Packages')
@section('og_description', 'Welcome to the best travel agency in Andaman, offering customizable Andaman tour packages,
hotel bookings, adventure activities, and more. Book today for an unforgettable Andaman Islands experience!')
@section('og_type', 'website')
@section('og_image', 'https://andamanbliss.com/site/img/logo.png')

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'Andaman Bliss – Best Travel Agency in Andaman | Andaman Tour Packages')
@section('twitter_desc', 'Welcome to the best travel agency in Andaman, offering customizable Andaman tour packages,
hotel bookings, adventure activities, and more. Book today for an unforgettable Andaman Islands experience!')
@section('twitter_image', 'https://andamanbliss.com/site/img/logo.png')


@section('content')
<style>
.home-banner {
    position: relative;
    min-height: 80vh;
}

.home-banner .banner-form-container {
    position: absolute;
    top: 50%;
    right: 5%;
    transform: translateY(-50%);
    z-index: 10;
    max-width: 400px;
    width: 90%;
}

.home-banner .lead-form-card {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px);
}

@media (max-width: 768px) {
    .home-banner {
        min-height: auto;
        padding: 40px 0;
    }
    
    .home-banner .banner-form-container {
        position: relative;
        top: auto;
        right: auto;
        transform: none;
        max-width: 100%;
        padding: 20px;
    }
}
</style>

<section class="home-banner">
    <div class="d-flex justify-content-center align-items-center h-100 w-100 position-relative">
         <video autoplay loop muted playsinline class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
            <source src="{{ asset('site/videos/andaman.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Optional overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.2);"></div>

        <!-- Lead Form in Banner -->
        <div class="banner-form-container">
            <div class="card lead-form-card shadow-lg border-0 rounded-4">
                <div class="card-body p-3">
                    <div class="text-center mb-3">
                        <h3 class="h5 fw-bold text-andaman mb-2">Get Your Free Travel Consultation</h3>
                        <p class="text-muted small mb-0">Fill out the form and our travel experts will contact you</p>
                    </div>

                    <form class="lead-generation-form" method="POST" action="{{ route('contact') }}">
                        @csrf
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control form-control-sm" id="fullName"
                                        placeholder="Your Full Name" required>
                                    <label for="fullName">Full Name</label>
                                </div>
                            </div>
                            <input type="text" class="hidden" style="display: none;" name="url" id="url"
                                value="{{ url()->current() }}">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control form-control-sm" id="emailAddress"
                                        placeholder="Your Email Address" required>
                                    <label for="emailAddress">Email Address</label>
                                </div>
                            </div>
                            <div class="col-12 input-group">
                                <select class="form-select form-select-sm rounded-0 py-1" name="code"
                                    id="contact_pre" aria-label="Country Code" required>
                                    <option value="+91" selected>+91</option>
                                    <option value="+1">+1</option>
                                    <option value="+44">+44</option>
                                </select>
                                <input type="text" name="mobile" id="mobile" placeholder="Contact Number"
                                    class="form-control form-control-sm py-2" required>
                            </div>

                            <div class="col-6">
                                <div class="form-floating month-input-wrapper w-100">
                                    <input type="month" name="month" class="form-control form-control-sm" id="travelMonth"
                                        value="{{ date('Y-m', strtotime('+0 months')) }}"
                                        min="{{ date('Y-m') }}" required>
                                    <label for="travelMonth">Travel Month</label>
                                </div>
                            </div>

                            <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                autocomplete="off">
                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select form-select-sm" name="tour" id="travelType"
                                        aria-label="Preferred Travel Type" required>
                                        <option selected disabled value="">Select Type</option>
                                        <option value="honeymoon">Honeymoon</option>
                                        <option value="family">Family</option>
                                        <option value="adventure">Adventure</option>
                                        <option value="solo">Solo</option>
                                        <option value="group">Group</option>
                                    </select>
                                    <label for="travelType">Travel Type</label>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-sm" name="message"
                                        placeholder="Additional Preferences" id="additionalPreferences"
                                        style="height: 80px"></textarea>
                                    <label for="additionalPreferences">Additional Preferences</label>
                                </div>
                            </div> -->
                            <div class="col-12 d-flex justify-content-center text-center">
                                <button type="submit" class="btn-andaman btn-sm w-100 rounded-pill py-2">
                                    Get Free Consultation <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>


<section class="d-flex justify-content-center">
    @include('common.search2')
</section>

@php

$typeIcons = [
'tour' => 'fa-map-marked-alt',
'hotel' => 'fa-hotel',
'cruise' => 'fa-ship',
'activity' => 'fa-person-hiking',
'cab' => 'fa-car',
'bike' => 'fa-motorcycle',
];
$typeUrls = [
'tour' => 'tour.static',
'hotel' => 'hotel.index',
'cruise' => 'cruises',
'activity' => 'activity.view',
'cab' => 'cabs',
'bike' => 'bike.book',
];

@endphp



@php
$offerTypes = [
['id' => 'tour', 'icon' => 'fa-map-marked-alt', 'label' => 'Tour'],
['id' => 'hotel', 'icon' => 'fa-hotel', 'label' => 'Hotels'],
['id' => 'cruise', 'icon' => 'fa-ship', 'label' => 'Ferry'],
['id' => 'activity', 'icon' => 'fa-person-hiking', 'label' => 'Activities'],
['id' => 'cab', 'icon' => 'fa-car', 'label' => 'Car'],
['id' => 'bike', 'icon' => 'fa-motorcycle', 'label' => 'Bike'],
];
@endphp

<section id="andaman-special-offers" class="pb-2 bg-light special-offers-unique-section d-none">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center mt-3">
                <h2 class="section-heading">Exclusive Travel <span class="text-gradient">Deals</span></h2>
                <p class="section-subheading">Unbeatable Offers Across Your Dream Destinations</p>
            </div>
        </div>

        <div class="andaman-offers-container"
            style="background: white; border-radius: 15px; border: 1px solid rgba(0,0,0,0.1); box-shadow: 0 15px 40px rgba(0,0,0,0.1), 0 5px 15px rgba(0,0,0,0.05); padding: 16px; overflow: hidden;">
            <div class="andaman-offers-navigation">
                @foreach ($offerTypes as $type)
                <div class="andaman-offers-nav-item {{ $loop->first ? 'andaman-offers-nav-active' : '' }}"
                    data-target="andaman-offers-{{ $type['id'] }}">
                    <div class="andaman-offers-nav-icon">
                        <i class="fas {{ $type['icon'] }}"></i>
                    </div>
                    <span class="andaman-offers-nav-label">{{ $type['label'] }}</span>
                </div>
                @endforeach
            </div>



            <div class="andaman-offers-content">
                @foreach ($offerTypes as $type)
                <div class="andaman-offers-tab {{ $loop->first ? 'andaman-offers-tab-active' : '' }}"
                    id="andaman-offers-{{ $type['id'] }}">
                    <div class="{{ $type['id'] }}-slider-wrapper custom-slider-wrapper">
                        <div class="{{ $type['id'] }}-slider custom-slider">
                            <div class="custom-slider-container">
                                @php
                                $offers = $specialOffers[$type['id']] ?? [];
                                $icon = $typeIcons[$type['id']] ?? 'fa-star';
                                $urls = $typeUrls[$type['id']] ?? '';
                                @endphp

                                @foreach ($offers as $offer)
                                <div class="custom-slide">
                                    <div class="andaman-offers-card" style="--andaman-offers-color: #f4a261">
                                        <div class="andaman-offers-image-wrapper">
                                            <img src="{{ @$offer->OfferPhotos[0]->file ?? $offer->OfferPhotos  }}" alt="{{ $offer['name'] }}"
                                                class="andaman-offers-image">
                                            <div class="andaman-offers-badge">
                                                <i class="fas {{ $icon }}"></i>
                                            </div>
                                        </div>
                                        <div class="andaman-offers-card-content">
                                            <h3 class="fw-bolder fs-6">{{ $offer['name'] }}</h3>
                                            <p class="andaman-offers-subtitle" style="color:#FF5722">
                                                {{ Str::words($offer['meta_title'], 5, '...') }}
                                            </p>
                                            <p class="andaman-offers-description">
                                                {{ \Illuminate\Support\Str::words(ucfirst(strip_tags($offer['description'])), 5, '...') }}
                                            </p>
                                            <div class="andaman-offers-promo">

                                                @if($offer['adult_rate'] > 0)
                                                <span class="andaman-offers-promo-code">
                                                    @if ($offer['adult_rate'] != $offer['adult_price'])
                                                    <strike class="text-danger" style="font-size: 14px;">{{
                                                        $offer['adult_price'] }}</strike>
                                                    @endif
                                                    <span class="text-andaman">{{ $offer['adult_rate'] }}</span>
                                                </span>
                                                @endif

                                               @if ($urls)
    <a href="{{ route($urls, $offer['route_params']) }}" class="andaman-offers-btn-book">Book Now</a>
@endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button class="custom-slider-prev {{ $type['id'] }}-prev" aria-label="Previous Slide">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="custom-slider-next {{ $type['id'] }}-next" aria-label="Next Slide">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <div class="custom-slider-pagination {{ $type['id'] }}-pagination"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
<!-- review section-->

<style>
.reviews-section {
    height: 300px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.welcome-content {
    color: white;
    padding: 20px 10px;
}

.welcome-title {
    font-size: 1.8rem;
    font-weight: 300;
    margin-bottom: 5px;
}

.welcome-brand {
    font-size: 2.2rem;
    font-weight: 700;
    color: #FF5722;
    margin-bottom: 10px;
}

.welcome-subtitle {
    font-size: 1rem;
    font-weight: 300;
    margin-bottom: 15px;
    opacity: 0.95;
}

.welcome-tagline {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.welcome-description {
    font-size: 0.9rem;
    line-height: 1.5;
    opacity: 0.9;
}

.traveler-image-container {
    position: relative;
    height: 100%;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.traveler-image {
    max-width: 100%;
    height: auto;
    max-height: 280px;
    object-fit: contain;
}

.review-cards-vertical {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding: 10px 0;
}

.review-card-compact {
    background: white;
    border-radius: 12px;
    padding: 15px 10px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
}

.review-card-compact:hover {
    transform: translateY(-5px);
}

.review-logo-compact {
    max-width: 80px;
    margin-bottom: 8px;
}

.review-rating-compact {
    font-size: 1.2rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 3px;
}

.review-stars-compact {
    color: #FFA500;
    font-size: 0.75rem;
    margin-bottom: 5px;
}

.review-text-compact {
    font-size: 0.7rem;
    color: #666;
    font-weight: 600;
}

.review-subtext-compact {
    font-size: 0.65rem;
    color: #999;
}

@media (max-width: 768px) {
    .reviews-section {
        height: auto;
        min-height: 400px;
        padding: 20px 0;
    }
    
    .welcome-content {
        padding: 10px;
        margin-bottom: 20px;
    }
    
    .welcome-title {
        font-size: 1.3rem;
    }
    
    .welcome-brand {
        font-size: 1.6rem;
    }
    
    .welcome-subtitle {
        font-size: 0.85rem;
    }
    
    .welcome-tagline {
        font-size: 1rem;
    }
    
    .welcome-description {
        font-size: 0.8rem;
    }
    
    .traveler-image-container {
        margin: 0;
        padding: 10px;
    }
    
    .traveler-image {
        max-height: 180px;
    }
    
    .review-cards-vertical {
        gap: 10px;
        padding: 10px;
    }
    
    .review-card-compact {
        padding: 10px 8px;
    }
    
    .review-logo-compact {
        max-width: 60px;
    }
    
    .review-rating-compact {
        font-size: 1rem;
    }
}
</style>

<section class="reviews-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column: Welcome Content (6 columns on desktop, 12 on mobile) -->
            <div class="col-md-6 col-12 order-1">
                <div class="welcome-content">
                    <h1 class="welcome-title">Welcome to</h1>
                    <h2 class="welcome-brand">Andaman Bliss</h2>
                    <p class="welcome-subtitle">Your Trusted Andaman Travel Partner</p>
                    
                    <h3 class="welcome-tagline">Explore. Experience. Escape.</h3>
                    <p class="welcome-description">
                        Discover the pristine beauty of the Andaman & Nicobar islands like never before. At Andaman Bliss, we believe travel should be more than just a trip, it should be a soulful experience.
                    </p>
                </div>
            </div>
            
            <!-- Right Column: Review Cards (2 columns on desktop, 6 on mobile, appears 2nd on mobile) -->
            <div class="col-md-2 col-6 order-md-3 order-3">
                <div class="review-cards-vertical">
                    <!-- Google Review Card -->
                    <div class="review-card-compact">
                        <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="Google" class="review-logo-compact">
                        <div class="review-rating-compact">5.0</div>
                        <div class="review-stars-compact">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="review-text-compact">Rated by</div>
                        <div class="review-subtext-compact">3,200+ Happy<br>Travelers</div>
                    </div>
                    
                    <!-- TripAdvisor Review Card -->
                    <div class="review-card-compact">
                        <img src="https://static.tacdn.com/img2/brand_refresh/Tripadvisor_lockup_horizontal_secondary_registered.svg" alt="TripAdvisor" class="review-logo-compact">
                        <div class="review-text-compact">Top Rated on<br>Tripadvisor</div>
                        <div class="review-subtext-compact">Travelers' Choice</div>
                    </div>
                </div>
            </div>
            
            <!-- Center Column: Traveler Image (4 columns on desktop, 6 on mobile, appears 1st on mobile) -->
            <div class="col-md-4 col-6 order-md-2 order-2">
                <div class="traveler-image-container">
                    <img src="{{ asset('site/img/model.png') }}" alt="Happy Traveler" class="traveler-image">
                </div>
            </div>
        </div>
    </div>
</section>

<!--hot-deal or popular packages -->

<section class="hot-deals bg-light mt-3">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading fw-bolder mb-3">Explore Our <span class="text-gradient">Hot Deals</span></h2>
                <p class="section-subheading">Discover amazing travel experiences at unbeatable prices</p>
            </div>
        </div>

        <div class="row g-4 mobile-scroll-row">
            @foreach ($hotDeals as $deal)
            @php
                $rate = $deal['package_cost'] ?? 0;
                $discountAmount = $deal['discount'] ?? 0;
                $discountPercent = $rate > 0 ? round(($discountAmount / $rate) * 100) : 0;
                $discount = $rate - $discountAmount;
            @endphp

            <div class="col-lg-3 col-md-6">
                <div class="honeymoon-package-card">
                    <div class="honeymoon-package-image">
                        <img src="{{ @$deal->tourPhotos[0]->file }}" alt="{{ $deal['package_name'] }}">
                        @if($discountPercent > 0)
                        <div class="package-discount-badge">{{ $discountPercent }}% DISCOUNT</div>
                        @endif
                        <div class="package-rating-badge">
                            <i class="fas fa-star text-warning"></i> 4.8 (120)
                        </div>
                        <div class="package-duration">
                            {{ $deal['nights'] ?? 3 }} Nights, {{ $deal['days'] ?? 4 }} Days
                        </div>
                    </div>
                    
                    <div class="honeymoon-package-content">
                        <div class="package-route">{{ $deal['tourCategory']['name'] ?? 'Andaman Tour' }}</div>
                        <h3 class="package-title">{{ $deal['package_name'] }}</h3>
                    </div>
                    
                    <div class="package-price-footer">
                        <div class="package-price-text">INR {{ number_format($rate) }}/Person</div>
                        @if($discountAmount > 0)
                        <div class="package-price-original">{{ number_format($discount) }}</div>
                        @endif
                    </div>
                    
                    <div class="package-itinerary-container">
                        <a href="{{ route('tour.dynamic.category', [
                            'slug' => $deal['tourCategory']['slug'], 
                            'subslug' => $deal['slug']
                        ]) }}" class="package-itinerary-btn">View Itinerary</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ url('andaman-tour-packages') }}" class="view-all-btn btn-lg rounded-pill px-3">
                    View All Deals <i class="fas fa-chevron-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!--honeymoon -section-->

@php
$honeymoonPackages = [
    [
        'discount' => '10% DISCOUNT',
        'rating' => '5.0',
        'reviews' => '250',
        'nights' => 3,
        'days' => 4,
        'route' => 'Port Blair → Havelock → Port Blair',
        'title' => 'Andaman Couple Tour Package',
        'price' => '12,900',
        'original_price' => '17,000',
        'image' => asset('site/img/home/home_honeymoon3.webp'),
        'link' => 'https://andamanbliss.com/andaman-honeymoon-tour-3-nights-4-days'
    ],
    [
        'discount' => '20% DISCOUNT',
        'rating' => '5.0',
        'reviews' => '280',
        'nights' => 4,
        'days' => 5,
        'route' => 'Port Blair → Havelock → Port Blair',
        'title' => 'Andaman and Nicobar Couple Package',
        'price' => '16,900',
        'original_price' => '21,500',
        'image' => asset('site/img/home/hone_honeymoon2.webp'),
        'link' => 'https://andamanbliss.com/andaman-honeymoon-tour-4-nights-5-days'

    ],
    [
        'discount' => '30% DISCOUNT',
        'rating' => '5.0',
        'reviews' => '290',
        'nights' => 5,
        'days' => 6,
        'route' => 'Port Blair → Havelock → Neil → Port Blair',
        'title' => 'Andaman Honeymoon Tour Packages',
        'price' => '18,900',
        'original_price' => '25,000',
        'image' => asset('site/img/home/home_honeymoon.webp'),
        'link' => 'https://andamanbliss.com/andaman-honeymoon-tour-5-nights-6-days'
    ],
    [
        'discount' => '10% DISCOUNT',
        'rating' => '5.0',
        'reviews' => '310',
        'nights' => 6,
        'days' => 7,
        'route' => 'Port Blair → Havelock → Neil → Ross Island → Port Blair',
        'title' => 'Exciting Andaman Honeymoon Package',
        'price' => '20,900',
        'original_price' => '27,000',
        'image' => asset('site/img/home/home_honeymoon5.webp'),
        'link' => 'https://andamanbliss.com/andaman-honeymoon-tour-6-nights-7-days'
    ],
];
@endphp

<style>
.honeymoon-packages {
    padding: 60px 0;
    background: #fff;
}

.honeymoon-package-card {
    border-radius: 0 0 0 50px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    background: white;
    position: relative;
    height: 400px;
    display: flex;
    flex-direction: column;
}

.honeymoon-package-card:hover {
    transform: translateY(-10px);
}

.honeymoon-package-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.honeymoon-package-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.honeymoon-package-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.6) 100%);
    z-index: 1;
}

.package-discount-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #FF5722;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    z-index: 2;
}

.package-rating-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255,255,255,0.95);
    color: #333;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 5px;
}

.package-duration {
   position: absolute;
    bottom: 11px;
    left: 35px;
    background: #FF5722;
    color: white;
    padding: 5px 13px;
    border-radius: 2px;
    font-size: 0.725rem;
    font-weight: 600;
    z-index: 2;
}


.honeymoon-package-content {
    position: absolute;
    bottom: 60px;
    left: 0;
    right: 0;
    padding: 20px;
    z-index: 2;
    color: white;
}

.package-route {
    font-size: 0.75rem;
    color: white;
    margin-bottom: 10px;
    opacity: 0.9;
}

.package-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
    margin-bottom: 18px;
    min-height: auto;
}

.package-itinerary-container {
    position: absolute;
    bottom: 12px;
    left: 150px;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    z-index: 2;
}

.package-itinerary-btn {
    background: transparent;
    color: white;
    border: 1px solid white;
    padding: 3px 6px;
    border-radius: 1px;
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.package-itinerary-btn:hover {
    background: white;
    color: #0d6efd;
}

.package-price-footer {
    position: absolute;
    bottom: 25px;
    left: 0;
    right: 0;
    background: transparent;
    color: white;
    padding: 15px 20px;
    z-index: 2;
}

.package-price-text {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.package-price-original {
    font-size: 0.85rem;
    opacity: 0.9;
    text-decoration: line-through;
}

@media (max-width: 768px) {
    .honeymoon-package-card {
        margin-bottom: 20px;
    }
}
</style>

<section class="honeymoon-packages">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading fw-bolder mb-3">Andaman <span class="text-gradient">Honeymoon</span> Tour Packages</h2>
            </div>
        </div>
        
        <div class="row g-4 mobile-scroll-row">
            @foreach($honeymoonPackages as $package)
            <div class="col-lg-3 col-md-6">
                <div class="honeymoon-package-card">
                    <div class="honeymoon-package-image">
                        <img src="{{ $package['image'] }}" alt="{{ $package['title'] }}">
                        <div class="package-discount-badge">{{ $package['discount'] }}</div>
                        <div class="package-rating-badge">
                            <i class="fas fa-star text-warning"></i> {{ $package['rating'] }} ({{ $package['reviews'] }})
                        </div>
                        <div class="package-duration">
                            {{ $package['nights'] }} Nights, {{ $package['days'] }} Days
                        </div>
                    </div>
                    
                    <div class="honeymoon-package-content">
                        <div class="package-route">{{ $package['route'] }}</div>
                        <h3 class="package-title">{{ $package['title'] }}</h3>
                    </div>
                    
                    <div class="package-price-footer">
                        <div class="package-price-text">INR {{ $package['price'] }}/Person</div>
                        <div class="package-price-original">{{ $package['original_price'] }}</div>
                    </div>
                    
                    <div class="package-itinerary-container">
                        <a href="{{ $package['link'] ?? 'add link' }}" class="package-itinerary-btn">View Itinerary</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .popular-activities .activity-card {
        border-radius: 0;
        border-bottom-left-radius: 40px; /* Consistent curve on bottom-left */
        overflow: hidden;
        position: relative;
        height: 350px;
        border: none;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        border-radius: 0 0 0 50px !important;
    }
    
    .popular-activities .activity-card:hover {
        transform: translateY(-5px);
    }

    .popular-activities .activity-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .popular-activities .activity-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 50%, transparent 100%);
        color: white;
        text-align: center;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        height: 60%;
    }

    .popular-activities .activity-title {
        font-size: 1.1rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 5px;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        color: white;
    }

    .popular-activities .activity-separator {
        width: 50px;
        height: 2px;
        background-color: white;
        margin: 5px auto;
    }

    .popular-activities .activity-price {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        color: white;
    }

    /* Mobile Adjustments */
    @media (max-width: 768px) {
        .popular-activities .activity-card {
            height: 220px; /* Reduced height for mobile */
            border-bottom-left-radius: 25px; /* Slightly smaller curve for smaller cards */
        }
        
        .popular-activities .activity-overlay {
            padding: 10px;
            height: 70%; /* Increase overlay height coverage for better text visibility */
        }

        .popular-activities .activity-title {
            font-size: 0.75rem; /* Smaller font */
            margin-bottom: 3px;
            letter-spacing: 0.5px;
        }

        .popular-activities .activity-separator {
            width: 30px;
            margin: 3px auto;
        }

        .popular-activities .activity-price {
            font-size: 0.7rem;
        }
    }
</style>

<section class="popular-activities bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-heading fw-bolder mb-3">Popular & Trending <span
                        class="text-gradient">Activities</span></h2>
                <p class="section-subheading pb-5">Discover exciting adventures that make Andaman unforgettable</p>
            </div>
        </div>
        
        <div class="row g-2 g-md-4"> <!-- Reduced gap on mobile -->
            @foreach ($activities as $activity)
            <div class="col-lg-2 col-md-3 col-4"> <!-- col-4 for 3 columns on mobile -->
                @php
                    $activityUrl = $activity->url ?? $activity->slug;
                    $original = $activity['adult_cost'];
                    $discount = $activity['discount'] ?? 0;
                    $finalPrice = $original - ($original * $discount / 100);
                @endphp
                <a href="{{ route('activity.view',['url' =>  $activityUrl ]) }}" class="text-decoration-none">
                    <div class="card activity-card">
                        <img src="{{ $activity['activityPhotos'][0]['file'] }}" class="activity-image"
                            alt="{{ $activity['service_name'] }}" loading="lazy">
                        <div class="activity-overlay">
                            <h3 class="activity-title">{{ $activity['service_name'] }}</h3>
                            <div class="activity-separator"></div>
                            <p class="activity-price">
                                @if($discount > 0)
                                    ₹{{ number_format($finalPrice) }}
                                @else
                                    ₹{{ number_format($original) }}
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ url('water-sports') }}" class="view-all-btn btn-lg rounded-pill px-5">
                    Explore All Activities <i class="fas fa-chevron-right ms-2 "></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!--mobile view only--->


<section class="lead-generation-section bg-gradient-andaman">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="lead-cta-content text-white">
                    <div class="d-flex align-items-center mb-4">

                        <div>
                            <h2 class="fw-bold text-white mb-2">Plan Your Adventure With Our Best Andaman Tour
                                Packages</h2>
                            <p class="lead mb-0 text-white">Checkout our latest offer and get a customized package</p>
                        </div>
                    </div>
                    <div class="lead-benefits list-unstyled d-flex">
                        <div class="col-6">
                            <ul>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Customized Itineraries
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Expert Local Guidance
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Exclusive Travel Deals
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Secure and Easy Booking
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    24 X 7 Customer Support
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Handpicked Resorts & Hotels
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Airport & Jetty Drop
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Flexible Payment Options
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    No Hidden Charges Of Any Sort
                                </li>
                                <li class="lead-beni-item">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Eco-friendly Travel Options
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="lead-form-container mt-3">
                    <div class="card lead-form-card shadow-lg border-0 rounded-4">
                        <div class="card-body p-3">
                            <div class="text-center mb-4">
                                <h3 class="h4 fw-bold text-andaman mb-3">Get Your Free Travel Consultation</h3>
                                <p class="text-muted">Fill out the form and our travel experts will contact you</p>
                            </div>

                            <form class="lead-generation-form" method="POST" action="{{ url('contact') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" class="form-control" id="fullName"
                                                placeholder="Your Full Name" required>
                                            <label for="fullName">Full Name</label>
                                        </div>
                                    </div>
                                    <input type="text" class="hidden" style="display: none;" name="url" id="url"
                                        value="{{ url()->current() }}">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control " id="emailAddress"
                                                placeholder="Your Email Address" required>
                                            <label for="emailAddress">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 input-group">
                                        <select class="form-select form-select-sm rounded-0 py-1" name="code"
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
                                            <option value="+211">++211</option>
                                            <option value="+212">++212</option>
                                            <option value="+213">+213</option>
                                            <option value="+216">+216</option>
                                            <option value="+218">+218</option>
                                            <option value="+220">+220</option>
                                            <option value="+221">+221</option>
                                            <option value="+222">+222</option>
                                            <option value="+223">+223</option>
                                            <option value="+224">+224</option>
                                            <option value="+225">+225</option>
                                            <option value="+226">+226</option>
                                            <option value="+227">+227</option>
                                            <option value="+228">+228</option>
                                            <option value="+229">+229</option>
                                            <option value="+230">+230</option>
                                            <option value="+231">+231</option>
                                            <option value="+232">+232</option>
                                            <option value="+233">+233</option>
                                            <option value="+234">+234</option>
                                            <option value="+235">+235</option>
                                            <option value="+236">+236</option>
                                            <option value="+237">+237</option>
                                            <option value="+238">+238</option>
                                            <option value="+239">+239</option>
                                            <option value="+240">+240</option>
                                            <option value="+241">+241</option>
                                            <option value="+242">+242</option>
                                            <option value="+243">+243</option>
                                            <option value="+244">+244</option>
                                            <option value="+245">+245</option>
                                            <option value="+246">+246</option>
                                            <option value="+248">+248</option>
                                            <option value="+249">+249</option>
                                            <option value="+250">+250</option>
                                            <option value="+251">+251</option>
                                            <option value="+252">+252</option>
                                            <option value="+253">+253</option>
                                            <option value="+254">+254</option>
                                            <option value="+255">+255</option>
                                            <option value="+256">+256</option>
                                            <option value="+257">+257</option>
                                            <option value="+258">+258</option>
                                            <option value="+260">+260</option>
                                            <option value="+261">+261</option>
                                            <option value="+262">+262</option>
                                            <option value="+263">+263</option>
                                            <option value="+264">+264</option>
                                            <option value="+265">+265</option>
                                            <option value="+266">+266</option>
                                            <option value="+267">+267</option>
                                            <option value="+268">+268</option>
                                            <option value="+269">+269</option>
                                            <option value="+290">+290</option>
                                            <option value="+291">+291</option>
                                            <option value="+297">+297</option>
                                            <option value="+298">+298</option>
                                            <option value="+299">+299</option>
                                            <option value="+350">+350</option>
                                            <option value="+351">+351</option>
                                            <option value="+352">+352</option>
                                            <option value="+353">+353</option>
                                            <option value="+354">+354</option>
                                            <option value="+355">+355</option>
                                            <option value="+356">+356</option>
                                            <option value="+357">+357</option>
                                            <option value="+358">+358</option>
                                            <option value="+359">+359</option>
                                            <option value="+370">+370</option>
                                            <option value="+371">+371</option>
                                            <option value="+372">+372</option>
                                            <option value="+373">+373</option>
                                            <option value="+374">+374</option>
                                            <option value="+375">+375</option>
                                            <option value="+376">+376</option>
                                            <option value="+377">+377</option>
                                            <option value="+378">+378</option>
                                            <option value="+379">+379</option>
                                            <option value="+380">+380</option>
                                            <option value="+381">+381</option>
                                            <option value="+382">+382</option>
                                            <option value="+385">+385</option>
                                            <option value="+386">+386</option>
                                            <option value="+387">+387</option>
                                            <option value="+389">+389</option>
                                            <option value="+420">+420</option>
                                            <option value="+421">+421</option>
                                            <option value="+423">+423</option>
                                            <option value="+500">+500</option>
                                            <option value="+501">+501</option>
                                            <option value="+502">+502</option>
                                            <option value="+503">+503</option>
                                            <option value="+504">+504</option>
                                            <option value="+505">+505</option>
                                            <option value="+506">+506</option>
                                            <option value="+507">+507</option>
                                            <option value="+508">+508</option>
                                            <option value="+509">+509</option>
                                            <option value="+590">+590</option>
                                            <option value="+591">+591</option>
                                            <option value="+592">+592</option>
                                            <option value="+593">+593</option>
                                            <option value="+594">+594</option>
                                            <option value="+595">+595</option>
                                            <option value="+596">+596</option>
                                            <option value="+597">+597</option>
                                            <option value="+598">+598</option>
                                            <option value="+599">+599</option>
                                            <option value="+670">+670</option>
                                            <option value="+971">+971</option>
                                            <option value="+972">+972</option>
                                            <option value="+973">+973</option>
                                            <option value="+974">+974</option>
                                            <option value="+975">+975</option>
                                            <option value="+976">+976</option>
                                            <option value="+977">+977</option>
                                        </select>
                                        <input type="text" name="mobile" id="mobile" placeholder="Contact Number"
                                            class="form-control py-3" required>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating month-input-wrapper w-100">
                                            <input type="month" name="month" class="form-control" id="travelMonth"
                                                value="{{ date('Y-m', strtotime('+0 months')) }}"
                                                min="{{ date('Y-m') }}" required>

                                            <label for="travelMonth">Travel Month</label>
                                        </div>
                                    </div>

                                    <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                        autocomplete="off">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="tour" id="travelType"
                                                aria-label="Preferred Travel Type" required>
                                                <option selected disabled value="">Select Travel Type</option>
                                                <option value="honeymoon">Honeymoon</option>
                                                <option value="family">Family Vacation</option>
                                                <option value="adventure">Adventure Trip</option>
                                                <option value="solo">Solo Travel</option>
                                                <option value="group">Group Tour</option>
                                            </select>
                                            <label for="travelType">Travel Type</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="message"
                                                placeholder="Additional Preferences" id="additionalPreferences"
                                                style="height: 100px"></textarea>
                                            <label for="additionalPreferences">Additional Preferences</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check d-flex align-items-center py-2">
                                            <input class="form-check-input me-2" type="checkbox" id="privacyConsent">
                                            <label class="form-check-label text-muted ms-2" for="privacyConsent">
                                                I agree to receive travel updates and promotional offers
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center text-center">
                                        <button type="submit" class="btn-andaman btn-lg w-100 rounded-pill py-2">
                                            Get Free Consultation <i class="fas fa-paper-plane ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.promo-banner-slider {
    padding: 40px 0;
    background: #f8f9fa;
    overflow: hidden;
}

.promo-slider-container {
    position: relative;
    max-width: 1400px;
    margin: 0 auto;
    overflow: hidden;
}

.promo-slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.promo-slide {
    min-width: 100%;
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    height: 200px;
    background: linear-gradient(135deg, #2c3e50 0%, #4a5568 100%);
}

.promo-slide-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100%;
    padding: 30px 50px;
    color: white;
}

.promo-left {
    flex: 1;
}

.promo-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 2px;
    line-height: 1.2;
}

.promo-package {
    font-size: 1.2rem;
    font-weight: 800;
    color: #ffffffff;
    margin-bottom: 10px;
}

.promo-price {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.promo-price small {
    font-size: 1rem;
    font-weight: 400;
    opacity: 0.9;
}

.promo-features {
    display: flex;
    gap: 20px;
    font-size: 0.9rem;
}

.promo-right {
    position: relative;
    width: 300px;
    height: 100%;
}

.promo-image {
    position: absolute;
    right: -50px;
    bottom: 0;
    height: 100%;
    width: auto;
    object-fit: contain;
}

.promo-logo {
    position: absolute;
    top: 20px;
    right: 20px;
    max-width: 150px;
    z-index: 3;
}

.promo-dots {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.promo-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
}

.promo-dot.active {
    background: #FD6E0F;
    width: 30px;
    border-radius: 6px;
}

@media (max-width: 768px) {
   .promo-slide {
        height: 150px;
    }
   
    .promo-slide-content {
        padding: 15px 20px;
    }
   
    .promo-title {
        font-size: 0.75rem;
        margin-bottom: 5px;
    }
   
    .promo-package {
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
   
    .promo-price {
        font-size: 1rem;
        margin-bottom: 5px;
    }
   
    .promo-price small {
        font-size: 0.7rem;
    }
   
    .promo-features {
        font-size: 0.65rem;
        gap: 8px;
    }
   
    .promo-right {
        width: 150px;
    }
   
    .promo-image {
        right: -20px;
        max-height: 120px;
    }
   
    .promo-logo {
        max-width: 80px;
        top: 10px;
        right: 10px;
    }
}
</style>

@php
$promoSlides = [
    [
        'title' => 'Deal Never Before - Luxurious Escape to Andaman!',
        'package' => '3N/4D Luxury Package',
        'price' => '₹16,999',
        'per' => 'per person',
        'features' => ['Stay', 'Private Ferry', 'Sightseeing', 'All Inclusive'],
        'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=400&fit=crop',
        'gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'
    ],
    [
        'title' => 'Honeymoon Special - Paradise Awaits!',
        'package' => '5N/6D Romantic Package',
        'price' => '₹24,999',
        'per' => 'per couple',
        'features' => ['Luxury Stay', 'Candlelight Dinner', 'Island Hopping', 'Spa'],
        'image' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?w=400&h=400&fit=crop',
        'gradient' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)'
    ],
    [
        'title' => 'Family Adventure - Create Memories Together!',
        'package' => '4N/5D Family Package',
        'price' => '₹19,999',
        'per' => 'per person',
        'features' => ['Family Rooms', 'Water Sports', 'Beach Activities', 'Meals'],
        'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=400&h=400&fit=crop',
        'gradient' => 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)'
    ],
];
@endphp

<section class="promo-banner-slider">
    <div class="container">
        <div class="promo-slider-container">
            <div class="promo-slides" id="promoSlides">
                @foreach($promoSlides as $index => $slide)
                <div class="promo-slide" style="background: {{ $slide['gradient'] }};">
                    <div class="promo-slide-content">
                        <div class="promo-left">
                            <h2 class="promo-title">{{ $slide['title'] }}</h2>
                            <div class="promo-package">{{ $slide['package'] }}</div>
                            <div class="promo-price">Starting at {{ $slide['price'] }} <small>{{ $slide['per'] }}</small></div>
                            <div class="promo-features">
                                @foreach($slide['features'] as $feature)
                                <span>{{ $feature }}</span> @if(!$loop->last) | @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="promo-right">
                            <img src="{{ $slide['image'] }}" alt="Promo" class="promo-image">
                            <img src="{{ asset('site/img/ad_girl.png') }}" alt="Logo" class="promo-logo">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="promo-dots">
                @foreach($promoSlides as $index => $slide)
                <div class="promo-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slidesContainer = document.getElementById('promoSlides');
    const dots = document.querySelectorAll('.promo-dot');
    let currentSlide = 0;
    const totalSlides = {{ count($promoSlides) }};
    
    function goToSlide(index) {
        currentSlide = index;
        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentSlide);
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        goToSlide(currentSlide);
    }
    
    // Auto-play
    let autoPlay = setInterval(nextSlide, 5000);
    
    // Dot navigation
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            clearInterval(autoPlay);
            goToSlide(parseInt(this.dataset.slide));
            autoPlay = setInterval(nextSlide, 5000);
        });
    });
});
</script>

<!--andaman family pacakge-->

@php
$familyPackages = [
    [
        'discount' => '15% DISCOUNT',
        'rating' => '4.9',
        'reviews' => '180',
        'nights' => 4,
        'days' => 5,
        'route' => 'Port Blair → Havelock → Neil Island',
        'title' => 'Andaman Family Adventure Package',
        'price' => '15,500',
        'original_price' => '18,200',
        'image' => asset('site/img/home/home_family1.jpg'),
        'link' => 'https://andamanbliss.com/andaman-family-tour-3-nights-4-days'
    ],
    [
        'discount' => '20% DISCOUNT',
        'rating' => '5.0',
        'reviews' => '220',
        'nights' => 5,
        'days' => 6,
        'route' => 'Port Blair → Havelock → Neil → Ross Island',
        'title' => 'Andaman Family Deluxe Package',
        'price' => '19,900',
        'original_price' => '24,900',
        'image' => asset('site/img/home/home_family2.jpg'),
        'link' => 'https://andamanbliss.com/andaman-family-tour-5-nights-6-days'
    ],
    [
        'discount' => '10% DISCOUNT',
        'rating' => '4.8',
        'reviews' => '150',
        'nights' => 3,
        'days' => 4,
        'route' => 'Port Blair → Havelock → Port Blair',
        'title' => 'Andaman Family Budget Package',
        'price' => '11,700',
        'original_price' => '13,000',
        'image' => asset('site/img/home/home_family3.jpg'),
        'link' => 'https://andamanbliss.com/andaman-family-tour-3-nights-4-days'
    ],
    [
        'discount' => '25% DISCOUNT',
        'rating' => '5.0',
        'reviews' => '300',
        'nights' => 6,
        'days' => 7,
        'route' => 'Port Blair → Havelock → Neil → Baratang',
        'title' => 'Andaman Family Premium Package',
        'price' => '24,750',
        'original_price' => '33,000',
        'image' => asset('site/img/home/home_family4.jpg'),
        'link' => 'https://andamanbliss.com/andaman-family-tour-6-nights-7-days'
    ],
];
@endphp



<section class="honeymoon-packages">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading fw-bolder mb-3">Andaman <span class="text-gradient">Family</span> Tour Packages</h2>
            </div>
        </div>
        
        <div class="row g-4 mobile-scroll-row">
            @foreach($familyPackages as $package)
            <div class="col-lg-3 col-md-6">
                <div class="honeymoon-package-card">
                    <div class="honeymoon-package-image">
                        <img src="{{ $package['image'] }}" alt="{{ $package['title'] }}">
                        <div class="package-discount-badge">{{ $package['discount'] }}</div>
                        <div class="package-rating-badge">
                            <i class="fas fa-star text-warning"></i> {{ $package['rating'] }} ({{ $package['reviews'] }})
                        </div>
                        <div class="package-duration">
                            {{ $package['nights'] }} Nights, {{ $package['days'] }} Days
                        </div>
                    </div>
                    
                    <div class="honeymoon-package-content">
                        <div class="package-route">{{ $package['route'] }}</div>
                        <h3 class="package-title">{{ $package['title'] }}</h3>
                    </div>
                    
                    <div class="package-price-footer">
                        <div class="package-price-text">INR {{ $package['price'] }}/Person</div>
                        <div class="package-price-original">{{ $package['original_price'] }}</div>
                    </div>
                    
                    <div class="package-itinerary-container">
                        <a href="{{ $package['link'] ?? 'add-link' }}" class="package-itinerary-btn">View Itinerary</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!--popular cruise-->

<style>
    .popular-cruise .cruise-card {
        border: none;
        border-radius: 15px 15px 15px 40px; /* Match footer curve */
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        position: relative;
        background: transparent; /* Remove white background */
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .popular-cruise .cruise-image-container {
        position: relative;
        height: 300px;
        overflow: hidden;
    }

    .popular-cruise .cruise-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .popular-cruise .cruise-card:hover .cruise-image {
        transform: scale(1.1);
    }

    .popular-cruise .cruise-discount-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #FF5722;
        color: white;
        padding: 5px 10px;
        font-weight: bold;
        font-size: 0.8rem;
        border-radius: 4px;
        z-index: 2;
    }

    .popular-cruise .cruise-rating-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        color: white;
        text-align: right;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .popular-cruise .cruise-overlay-content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        color: white;
        z-index: 2;
    }

    .popular-cruise .cruise-route {
        font-size: 0.8rem;
        opacity: 0.9;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .popular-cruise .cruise-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 5px;
        line-height: 1.2;
        color: white;
    }

    .popular-cruise .cruise-price {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .popular-cruise .cruise-original-price {
        font-size: 0.9rem;
        text-decoration: line-through;
        opacity: 0.7;
        margin-left: 10px;
        font-weight: normal;
    }

    .popular-cruise .cruise-footer {
        background: rgb(17, 157, 213); /* Updated Theme Color */
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom-left-radius: 40px; /* The requested curve */
    }

    .popular-cruise .cruise-footer .phone-icon {
        color: white;
        font-size: 1.2rem;
        transform: rotate(90deg);
    }

    .popular-cruise .cruise-footer .btn-view-itinerary {
        background: white;
        color: #333;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .popular-cruise .cruise-footer .btn-view-itinerary:hover {
        background: #f8f9fa;
    }
</style>

<section class="popular-cruise">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading fw-bolder mb-3">Popular Cruise <span class="text-gradient">Lines</span></h2>
                <p class="section-subheading">Discover the best ferry and cruise options in Andaman</p>
            </div>
        </div>

        @php
        $cruises = [
        [
        'name' => 'Makruzz Gold',
        'description' => 'Premium Luxury Ferry',
        'image' => asset('site/img/home/makruzz_3.jpg'),
        'routes' => ['Port Blair', 'Havelock', 'Neil Island'],
        'duration' => '2-3 Hours',
        'price' => '₹1,500',
        'original_price' => '₹1,800',
        'rating' => 4.8,
        'reviews' => 245
        ],
        [
        'name' => 'Nautika',
        'description' => 'Comfortable Island Connector',
        'image' => asset('site/img/home/nautika.jpg'),
        'routes' => ['Port Blair', 'Havelock', 'Neil Island'],
        'duration' => '2-3 Hours',
        'price' => '₹1,400',
        'original_price' => '₹1,650',
        'rating' => 4.6,
        'reviews' => 189
        ],
        [
        'name' => 'Green Ocean',
        'description' => 'Eco-Friendly Ferry Service',
        'image' => asset('site/img/home/green_ocean.webp'),
        'routes' => ['Port Blair', 'Havelock'],
        'duration' => '2 Hours',
        'price' => '₹850',
        'original_price' => '₹1,000',
        'rating' => 4.5,
        'reviews' => 156
        ],
        [
        'name' => 'ITT Majestic',
        'description' => 'Reliable Island Transport',
        'image' => asset('site/img/home/itt_majestic.jpg'),
        'routes' => ['Port Blair', 'Neil Island'],
        'duration' => '1.5 Hours',
        'price' => '₹1,200',
        'original_price' => '₹1,400',
        'rating' => 4.4,
        'reviews' => 132
        ]
        ];
        @endphp

        <div class="row g-4 mobile-scroll-row">
            @foreach($cruises as $cruise)
            <div class="col-lg-3 col-md-6">
                <div class="honeymoon-package-card">
                    <div class="honeymoon-package-image">
                        <img src="{{$cruise['image']}}" alt="{{ $cruise['name'] }}">
                        <div class="package-discount-badge">POPULAR</div>
                        <div class="package-rating-badge">
                            <i class="fas fa-star text-warning"></i> {{ $cruise['rating'] }} ({{ $cruise['reviews'] }})
                        </div>
                        <div class="package-duration">
                            {{ $cruise['duration'] }}
                        </div>
                    </div>
                    
                    <div class="honeymoon-package-content">
                        <div class="package-route">{{ implode(' → ', $cruise['routes']) }}</div>
                        <h3 class="package-title">{{ $cruise['name'] }}</h3>
                    </div>
                    
                    <div class="package-price-footer">
                        <div class="package-price-text">{{ $cruise['price'] }}/Person</div>
                        <div class="package-price-original">{{ $cruise['original_price'] }}</div>
                    </div>
                    
                    <div class="package-itinerary-container">
                        <a href="{{ route('cruises') }}" class="package-itinerary-btn">Book Ferry</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ route('cruises') }}" class="view-all-btn btn-lg rounded-pill px-3">
                    Explore All Cruises <i class="fas fa-chevron-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>




<style>
    .featured-hotels .hotel-card {
        border: none;
        border-radius: 15px; /* Match footer curve */
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        position: relative;
        background: transparent !important; /* Ensure no background */
        padding: 0 !important; /* Remove any padding causing the gap */
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .featured-hotels .hotel-image-container {
        position: relative;
        height: 300px;
        overflow: hidden;
    }

    .featured-hotels .hotel-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .featured-hotels .hotel-card:hover .hotel-image {
        transform: scale(1.1);
    }

    .featured-hotels .hotel-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #FF5722;
        color: white;
        padding: 5px 10px;
        font-weight: bold;
        font-size: 0.8rem;
        border-radius: 4px;
        z-index: 2;
    }

    .featured-hotels .hotel-rating-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        color: white;
        text-align: right;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .featured-hotels .hotel-overlay-content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        color: white;
        z-index: 2;
    }

    .featured-hotels .hotel-location {
        font-size: 0.8rem;
        opacity: 0.9;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: white;
    }

    .featured-hotels .hotel-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 5px;
        line-height: 1.2;
        color: white;
    }

    .featured-hotels .hotel-status {
        font-size: 1.0rem;
        font-weight: bold;
        color: #ffc107;
    }

    .featured-hotels .hotel-footer {
        background: rgb(17, 157, 213);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: -1px; /* Fix potential sub-pixel gap */
        gap:5px;
        padding: 3px 5px;
        border-radius: 3px;
    }
    .mobile-scroll-row .hotel-card{
        margin-bottom: 0px !important;
    }

    .featured-hotels .hotel-footer .phone-icon {
        color: white;
        font-size: 1.2rem;
        transform: rotate(90deg);
    }

    .featured-hotels .hotel-footer .btn-book {
        background: white;
        color: #333;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .featured-hotels .hotel-footer .btn-book:hover {
        background: #f8f9fa;
    }
</style>

<section class="featured-hotels pb-2 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class=" section-heading mb-3">Your Perfect Stay <span class="text-gradient">in Andaman</span></h2>
                <p class="section-subheading">Discover handpicked hotels that promise comfort, luxury, and unforgettable
                    experiences</p>
            </div>
        </div>

        <div class="mobile-slider-wrapper">
            <div class="row mobile-scroll-row">
            @foreach ($featuredHotels as $hotel)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="honeymoon-package-card">
                    <div class="honeymoon-package-image">
                        @php
                            $hotelGallery = !empty($hotel->hotel_gallery) 
                                ? json_decode($hotel->hotel_gallery, true) 
                                : [];

                            $hotelPhoto = !empty($hotel->hotel_image)
                                ? $hotel->hotel_image
                                : (!empty($hotelGallery[0])
                                    ? $hotelGallery[0]
                                    : 'https://andamanbliss.com/site/img/hotel_image.png');
                        @endphp

                        <img src="{{ $hotelPhoto }}" 
                             alt="{{ $hotel->hotel_name ?? 'Hotel Image' }}">
                        
                        <div class="package-discount-badge">FEATURED</div>

                        <div class="package-rating-badge">
                            @for($i=0; $i<=$hotel['hotel_rating']; $i++) 
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                    </div>

                    <div class="honeymoon-package-content">
                        <div class="package-route">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ Str::limit($hotel['address'], 40) }}
                        </div>
                        
                        <h3 class="package-title">{{ $hotel['hotel_name'] }}</h3>
                    </div>

                    <div class="package-price-footer mb-3">
                        <div class="package-price-text" style="font-size: 1rem;">Instant Booking</div>
                    </div>

                    <div class="package-itinerary-container">
                        <a href="{{ url('hotels') }}" class="package-itinerary-btn">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ url('hotels') }}" class="view-all-btn btn-lg rounded-pill px-5">
                Explore All Hotels <i class="fas fa-chevron-right ms-2"></i>
            </a>
        </div>
    </div>
    </div>
</section>

<!-- book your -dream-->
 <style>
.dream-holiday-slider {
    padding: 60px 0;
    background: #f8f9fa;
}

.dream-holiday-header {
    margin-bottom: 40px;
}

.dream-holiday-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.dream-holiday-subtitle {
    font-size: 1rem;
    color: #666;
}

.dream-slider-wrapper {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
}

.dream-slider-container {
    position: relative;
    overflow: hidden;
}

.dream-slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.dream-slide {
    min-width: 100%;
    display: flex;
    gap: 20px;
    padding: 0 10px;
}

.dream-destination-card {
    flex: 1;
    position: relative;
    height: 200px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.dream-destination-card:hover {
    transform: translateY(-5px);
}

.dream-card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.dream-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.2) 100%);
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.dream-destination-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: white;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.dream-destination-subtitle {
    font-size: 0.9rem;
    color: white;
    margin-bottom: 15px;
    opacity: 0.9;
}

.dream-countries-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    font-size: 0.85rem;
    color: white;
}

.dream-country-item {
    padding: 3px 0;
}

.dream-popular-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #FF5722;
    color: white;
    padding: 8px 15px;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 3px 10px rgba(255,87,34,0.4);
}

.dream-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    z-index: 10;
    transition: all 0.3s ease;
}

.dream-nav-btn:hover {
    background: #FF5722;
    color: white;
}

.dream-nav-btn.prev {
    left: -20px;
}

.dream-nav-btn.next {
    right: -20px;
}

@media (max-width: 768px) {
    .dream-holiday-slider {
        padding: 40px 0;
    }
    
    .dream-slides {
        flex-wrap: nowrap;
    }
    
    .dream-slide {
        flex-direction: row;
        gap: 0;
        min-width: 100%;
        gap:20px;
    }
    
    .dream-destination-card {
        height: 150px;
        min-height: 150px;
        min-width: 100%;
        flex: none;
    }
    
    .dream-card-overlay {
        padding: 15px;
    }
    
    .dream-destination-title {
        font-size: 1.2rem;
        margin-bottom: 5px;
    }
    
    .dream-destination-subtitle {
        font-size: 0.75rem;
        margin-bottom: 8px;
    }
    
    .dream-countries-list {
        font-size: 0.65rem;
        gap: 5px;
    }
    
    .dream-popular-badge {
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        font-size: 0.65rem;
    }
    
    .dream-nav-btn {
        display: none;
    }
    
    .dream-slider-wrapper {
        padding: 0 5px;
    }
}
</style>

<section class="dream-holiday-slider">
    <div class="container">
        <div class="dream-holiday-header text-center">
            <h2 class="section-heading fw-bolder mb-3">Book Your <span class="text-gradient">Dream Holiday</span> Today!</h2>
            <p class="section-subheading">Unbeatable deals on incredible destinations—plan your next adventure now!</p>
        </div>

        <div class="dream-slider-wrapper">
            <button class="dream-nav-btn prev" onclick="dreamPrevSlide()">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="dream-slider-container">
                <div class="dream-slides" id="dreamSlides">
                    <!-- Slide 1 -->
                    <div class="dream-slide">
                        <div class="dream-destination-card">
                                                    <a href="{{ url('andaman-honeymoon-packages') }}">

                            <img src= "{{asset('site/img/home/andaman_honey.jpeg')}}", alt="Andaman Honeymoon" class="dream-card-image">
                            <div class="dream-card-overlay">
                                <h3 class="dream-destination-title">Andaman Honeymoon</h3>
                                <p class="dream-destination-subtitle">Romantic Escapes for Couples</p>
                                <div class="dream-countries-list">
                                    <span class="dream-country-item">Beach Resorts</span> |
                                    <span class="dream-country-item">Candlelight Dinner</span> |
                                    <span class="dream-country-item">Private Islands</span> |
                                    <span class="dream-country-item">Sunset Cruise</span> |
                                    <span class="dream-country-item">Couple Activities</span> |
                                    <span class="dream-country-item">Luxury Stays</span>
                                </div>
                            </div>
                            <div class="dream-popular-badge">POPULAR</div>
                                                    </a>
                        </div>
                        
                        <div class="dream-destination-card">
                                                    <a href="andaman-group-packages">

                            <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?w=800&h=400&fit=crop" alt="Andaman Group Packages" class="dream-card-image">
                            <div class="dream-card-overlay">
                                <h3 class="dream-destination-title">Group Packages</h3>
                                <p class="dream-destination-subtitle">Perfect for Friends & Corporate Groups</p>
                                <div class="dream-countries-list">
                                    <span class="dream-country-item">Island Hopping</span> |
                                    <span class="dream-country-item">Water Sports</span> |
                                    <span class="dream-country-item">Beach Camping</span> |
                                    <span class="dream-country-item">Group Activities</span> |
                                    <span class="dream-country-item">Team Building</span>
                                </div>
                            </div>
                            <div class="dream-popular-badge">POPULAR</div>
                                                    </a>
                        </div>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="dream-slide">
                        <div class="dream-destination-card">
                                                    <a href="andaman-family-packages">

                            <img src="{{asset('site/img/home/andaman_family.jpeg')}}", alt="Andaman Family Package" class="dream-card-image">
                            <div class="dream-card-overlay">
                                <h3 class="dream-destination-title">Family Package</h3>
                                <p class="dream-destination-subtitle">Fun-Filled Family Vacations</p>
                                <div class="dream-countries-list">
                                    <span class="dream-country-item">Kid-Friendly Beaches</span> |
                                    <span class="dream-country-item">Family Resorts</span> |
                                    <span class="dream-country-item">Sightseeing Tours</span> |
                                    <span class="dream-country-item">Safe Activities</span> |
                                    <span class="dream-country-item">Cultural Visits</span>
                                </div>
                            </div>
                            <div class="dream-popular-badge">POPULAR</div>
                                                    </a>
                        </div>
                        
                        <div class="dream-destination-card">
                                                    <a href="andaman-adventure-packages">

                            <img src="{{asset('site/img/home/andaman_adventure1.jpeg')}}",alt="Andaman Adventure" class="dream-card-image">
                            <div class="dream-card-overlay">
                                <h3 class="dream-destination-title">Adventure Package</h3>
                                <p class="dream-destination-subtitle">Thrilling Experiences Await</p>
                                <div class="dream-countries-list">
                                    <span class="dream-country-item">Scuba Diving</span> |
                                    <span class="dream-country-item">Snorkeling</span> |
                                    <span class="dream-country-item">Sea Walking</span> |
                                    <span class="dream-country-item">Parasailing</span> |
                                    <span class="dream-country-item">Jet Ski</span> |
                                    <span class="dream-country-item">Kayaking</span>
                                </div>
                            </div>
                            <div class="dream-popular-badge">POPULAR</div>
                                                    </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="dream-nav-btn next" onclick="dreamNextSlide()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<script>
let dreamCurrentSlide = 0;
const dreamTotalSlides = 2;

function dreamGoToSlide(index) {
    dreamCurrentSlide = index;
    const slidesContainer = document.getElementById('dreamSlides');
    slidesContainer.style.transform = `translateX(-${dreamCurrentSlide * 100}%)`;
}

function dreamNextSlide() {
    dreamCurrentSlide = (dreamCurrentSlide + 1) % dreamTotalSlides;
    dreamGoToSlide(dreamCurrentSlide);
}

function dreamPrevSlide() {
    dreamCurrentSlide = (dreamCurrentSlide - 1 + dreamTotalSlides) % dreamTotalSlides;
    dreamGoToSlide(dreamCurrentSlide);
}

// Auto-play every 7 seconds
setInterval(dreamNextSlide, 7000);
</script>


<!--popular beaches-->
@php
$popularBeaches = [
[
'name' => 'Radhanagar Beach',
'island' => 'Havelock Island',
'description' => 'Voted as Asia\'s Best Beach, known for pristine white sands',
'image' => asset('site/img/home/h_radhanagar.jpeg'),
'highlights' => ['Crystal Clear Waters', 'White Sand', 'Scenic Beauty'],
'url' => url('islands/havelock-swaraj-dweep/radhanagar-beach'),
],
[
'name' => 'Elephant Beach',
'island' => 'Havelock Island',
'description' => 'Perfect for witnessing breathtaking sunset views',
'image' => asset('site/img/home/h_neil1.jpeg'),
'highlights' => ['Sunset Views','Birdwatching','Scenic Beauty'],
'url' => url('islands/havelock-swaraj-dweep/elephant-beach'),
],
[
'name' => 'Chidiyatapu',
'island' => 'Port Blair',
'description' => 'Perfect for water sports and marine exploration',
'image' => asset('site/img/home/h_chidiatapu.jpeg'),
'highlights' => ['Snorkeling', 'Coral Reefs', 'Water Sports'],
'url' => url('/islands/port-blair/chidiatapu'),
],
[
'name' => 'Sitapur Beach',
'island' => 'Neil Island',
'description' => 'Serene sunrise location with breathtaking natural beauty',
'image' => asset('site/img/home/h_sitapur.jpeg'),
'highlights' => ['Sunrise View', 'Tranquil', 'Natural Landscape'],
'url' => url('islands/neil-shaheed-dweep/sitapur-beach'),
],
[
'name' => "Corbyns's Cove",
'island' => 'Port Blair',
'description' => 'Closest beach to Port Blair with scenic coconut palms',
'image' => asset('site/img/home/h_corbyn.jpeg'),
'highlights' => ['Coconut Groves', 'Proximity to City', 'Scenic'],
'url' => url('islands/port-blair/corbyns-cove'),
],
[
'name' => "Laxmanpur Beach",
'island' => 'Neil Island',
'description' => 'Closest beach to Neil Island with scenic coconut palms',
'image' => asset('site/img/home/h_laxmapur1.jpeg'),
'highlights' => ['Coconut Groves', 'Proximity to City', 'Scenic'],
'url' => url('/islands/neil-shaheed-dweep/laxmanpur-beach/'),
],
[
'name' => "Bharatpur Beach",
'island' => 'Neil Island',
'description' => 'Closest beach to Neil Island with scenic coconut palms',
'image' => asset('site/img/home/h_bharatpur.jpeg'),
'highlights' => ['Coconut Groves', 'Proximity to City', 'Scenic'],
'url' => url('/islands/neil-shaheed-dweep/bharatpur-beach/'),
],
];
@endphp

<style>
    .andaman-popular-beaches {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); /* Fallback/Theme Gradient */
        background-image: url('{{ asset("site/img/beach-bg-overlay.jpg") }}'); /* Placeholder if available */
        background-size: cover;
        background-position: center;
        padding: 60px 0;
        /* border-radius: 30px; Large rounded corners for the main container */
        margin: 40px 0;
        position: relative;
        overflow: hidden;
    }

    /* Overlay to ensure text readability if bg is an image */
    .andaman-popular-beaches::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 123, 255, 0.3); /* Blue tint */
        z-index: 1;
    }

    .andaman-popular-beaches .container {
        position: relative;
        z-index: 2;
    }

    .beaches-content-wrapper {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .beaches-left-panel {
        flex: 0 0 30%;
        max-width: 30%;
        padding-right: 20px;
        color: white;
    }

    .beaches-right-panel {
        flex: 0 0 70%;
        max-width: 70%;
        overflow-x: auto;
        padding-bottom: 20px;
        /* Hide scrollbar */
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* IE 10+ */
    }
    
    .beaches-right-panel::-webkit-scrollbar { 
        display: none;  /* Chrome Safari */
    }

    .beaches-title-small {
        font-size: 1.5rem;
        font-weight: 300;
        margin-bottom: 0;
        display: block;
    }

    .beaches-title-large {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 10px;
        display: block;
        text-transform: uppercase;
    }

    .beaches-nav-btns {
        margin-top: 30px;
        display: flex;
        gap: 15px;
    }

    .beaches-nav-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%; /* Pill shape container for buttons? Image shows a pill */
        background: white;
        color: #333;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .beaches-nav-pill {
        background: white;
        border-radius: 30px;
        padding: 5px;
        display: flex;
        gap: 5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    
    .beaches-nav-btn-inner {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        background: transparent;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    
    .beaches-nav-btn-inner:hover {
        background: #f0f0f0;
    }

    .beach-cards-row {
        display: flex;
        gap: 15px;
        padding-left: 10px; /* Slight offset */
    }

    .beach-card-new {
        flex: 0 0 220px; /* Fixed width for cards */
        height: 350px;
        border-radius: 0 0 0 50px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
        border: 2px solid white; /* White border as seen in image */
    }

    .beach-card-new:hover {
        transform: translateY(-5px);
    }

    .beach-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .beach-card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 40%, rgba(0,0,0,0.6) 100%); /* Gradient on the right side */
        pointer-events: none;
    }

    .beach-card-text-vertical {
        position: absolute;
        top: -10px;
        right: 10px;
        transform: rotate(-90deg);
        transform-origin: bottom right;
        text-align: left;
        width: 300px; /* Ensure enough width for text */
        white-space: nowrap;
        color: white;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .beach-name-vertical {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        display: inline-block;
        color: white;
    }
.beach-card-text-vertical p{
    color: white;
}
    .beach-island-vertical {
        font-size: 0.8rem;
        font-weight: 400;
        opacity: 0.9;
        margin-left: 10px;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .beaches-content-wrapper {
            flex-direction: column;
        }
        .beaches-left-panel {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 20px;
            text-align: center;
            padding-right: 0;
        }
        .beaches-right-panel {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .beaches-nav-btns {
            justify-content: center;
        }
        .beaches-title-large {
            font-size: 2.5rem;
        }
    }
</style>

<section class="andaman-popular-beaches">
    <div class="container">
        <div class="beaches-content-wrapper">
            <!-- Left Panel: Text & Nav -->
            <div class="beaches-left-panel">
                <span class="beaches-title-small">Explore The Best</span>
                <span class="beaches-title-large">ANDAMAN<br>BEACHES</span>
                
                <div class="beaches-nav-btns">
                    <div class="beaches-nav-pill">
                        <button class="beaches-nav-btn-inner prev-beach"><i class="fas fa-chevron-left"></i></button>
                        <button class="beaches-nav-btn-inner next-beach"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Slider -->
            <div class="beaches-right-panel">
                <div class="beach-cards-row">
                    @foreach ($popularBeaches as $beach)
                    <div class="beach-card-new">
                        <img src="{{ $beach['image'] }}" alt="{{ $beach['name'] }}" class="beach-card-img">
                        <div class="beach-card-overlay"></div>
                        <div class="beach-card-text-vertical">
                            <h3 class="beach-name-vertical">{{ $beach['name'] }}</h3><br>
                            <p class="beach-island-vertical">{{ $beach['island'] }}</p>
                        </div>
                        <a href="{{ $beach['url'] }}" class="stretched-link"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollContainer = document.querySelector('.beaches-right-panel');
        const prevBtn = document.querySelector('.prev-beach');
        const nextBtn = document.querySelector('.next-beach');

        if(scrollContainer && prevBtn && nextBtn) {
            nextBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({ left: 240, behavior: 'smooth' });
            });

            prevBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({ left: -240, behavior: 'smooth' });
            });
        }
    });
</script>

<!--popular place to vist-->

<style>
.popular-places-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.popular-places-section .places-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.popular-places-section .tourist-image {
    max-width: 200px;
    margin-bottom: 20px;
}

.popular-places-section .places-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #333;
    text-align: center;
    line-height: 1.3;
}

.popular-places-section .places-title .highlight {
    color: rgb(17, 157, 213);
}

.popular-places-section .nav-arrows {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.popular-places-section .nav-arrow {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #ddd;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.popular-places-section .nav-arrow:hover {
    background: #FD6E0F;
    color: white;
    border-color: #FD6E0F;
}

.popular-places-section .places-slider {
    position: relative;
    overflow: hidden;
}

.popular-places-section .places-cards {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    -ms-overflow-style: none;
    padding: 20px 0;
}

.popular-places-section .places-cards::-webkit-scrollbar {
    display: none;
}

.popular-places-section .place-card {
    flex: 0 0 250px;
    height: 300px;
    border-radius: 0 0 0 50px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    transition: transform 0.3s ease;
}

.popular-places-section .place-card:hover {
    transform: translateY(-10px);
}

.popular-places-section .place-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.popular-places-section .place-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
    padding: 20px;
    color: white;
}

.popular-places-section .place-name {
    font-size: 1.2rem;
    font-weight: 700;
    text-transform: uppercase;
    margin: 0;
    text-align: center;
    color:#fff;
}

@media (max-width: 768px) {
    .popular-places-section .tourist-image {
        max-width: 150px;
    }
    
    .popular-places-section .places-title {
        font-size: 1.5rem;
    }
    
    .popular-places-section .place-card {
        flex: 0 0 120px;
        height: 250px;
    }
    .popular-places-section .places-cards{
        gap: 10px;
    }
    .popular-places-section .place-name {
        font-size: 0.8rem;
    }
}
</style>

@php
$popularPlaces = [
    [
        'name' => 'Port Blair',
        'image' => asset('site/img/home/h_portblair.jpeg'),
        'url' => url('islands/ross-island')
    ],
    [
        'name' => 'HAVELOCK',
        'image' => asset('site/img/home/h_havelock.jpeg'),
        'url' => url('islands/havelock-swaraj-dweep')
    ],
    [
        'name' => 'NEIL',
        'image' => asset('site/img/home/h_neil.jpeg'),
        'url' => url('islands/neil-shaheed-dweep')
    ],
    [
        'name' => 'BARATANG',
        'image' => asset('site/img/home/h_baratang.jpeg'),
        'url' => url('islands/baratang')
    ],
    [
        'name' => 'DIGLIPUR',
        'image' => asset('site/img/home/h_diglipur.jpeg'),
        'url' => url('islands/diglipur')
    ],
    [
        'name' => 'ROSS',
        'image' => asset('site/img/home/h_ross_island.jpeg'),
        'url' => url('islands/ross-island')
    ],
    [
        'name' => 'NORTHBAY',
        'image' => asset('site/img/home/h_northbay.jpeg'),
        'url' => url('islands/north-bay-island')
    ],
];
@endphp

<section class="popular-places-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="places-info">
                    <img src="{{ asset('site/img/ad_girl.png') }}" alt="Tourist" class="tourist-image">
                    <h2 class="places-title"><span class="highlight">MOST POPULAR</span> Places to Visit In Andaman</h2>
                    <div class="nav-arrows">
                        <button class="nav-arrow places-prev" aria-label="Previous">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="nav-arrow places-next" aria-label="Next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="places-slider">
                    <div class="places-cards">
                        @foreach($popularPlaces as $place)
                        <a href="{{ $place['url'] }}" class="place-card text-decoration-none">
                            <img src="{{ $place['image'] }}" alt="{{ $place['name'] }}">
                            <div class="place-overlay">
                                <h3 class="place-name">{{ $place['name'] }}</h3>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const placesContainer = document.querySelector('.places-cards');
    const prevBtn = document.querySelector('.places-prev');
    const nextBtn = document.querySelector('.places-next');
    
    if(placesContainer && prevBtn && nextBtn) {
        const scrollAmount = 270; // card width + gap
        
        nextBtn.addEventListener('click', () => {
            placesContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
        
        prevBtn.addEventListener('click', () => {
            placesContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
    }
});
</script>

<!--card style-->
<section class="trail-postcards">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="postcard-info">
                    <h2 class="postcard-title fs-4 text-center">Celebrities That<br>We Catered</h2>
                    <p class="postcard-subtitle tetx-center">Unfiltered trips,stamped with <span class="heart">❤</span>
                    </p>
                    <div class="ratings-container d-flex flex-column gap-3">
                        <div class="google-rating">
                            <img src="https://www.google.com/favicon.ico" alt="Google" width="20" height="20"
                                class="me-2">
                            <span class="rating">4.9</span>
                            <i class="fas fa-star ms-1"></i>
                            <span class="reviews">(2700+ reviews)</span>
                        </div>
                        <div class="facebook-rating">
                            <i class="fab fa-facebook text-primary me-2"></i>
                            <span class="rating">4.9</span>
                            <i class="fas fa-star ms-1"></i>
                            <span class="reviews fw-bolder">(500+ reviews)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                <div class="trail-slider position-relative">
                    <div class="trail-cards d-flex gap-4">
                        @foreach ($CelebsReviews as $celebReview)
                        <div class="trail-card">
                            <div class="card-header">
                                <span class="location bg-dark opacity-75"><i
                                        class="fas fa-map-marker-alt"></i>{{ ucwords($celebReview->name) }}</span>
                            </div>

                            @php
                            $media = $celebReview->reviewPhotos[0]->file;
                            $mediaExt = $celebReview->reviewPhotos[0]->file_name;
                            $extension = strtolower(pathinfo($mediaExt, PATHINFO_EXTENSION));
                            @endphp

                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                            <img src="{{ $media }}" alt="{{ $celebReview->name }}" class="img-fluid" />
                            @elseif(in_array($extension, ['gif']))
                            <img src="{{ $media }}" alt="{{ $celebReview->name }}" class="img-fluid" />
                            @elseif(in_array($extension, ['mp4', 'webm', 'ogg']))
                            <video controls class="img-fluid">
                                <source src="{{ $media }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
                            @endif

                            <!-- <div class="card-footer">
                                <h3 class="fs-6">{{ ucwords($celebReview->name) }}</h3>
                            </div> -->
                        </div>
                        @endforeach


                    </div>
                    <button class="slider-nav prev" aria-label="Previous Slide"><i
                            class="fas fa-chevron-left"></i></button>
                    <button class="slider-nav next" aria-label="Next Slide"><i
                            class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.trail-slider');
    const cardContainer = slider.querySelector('.trail-cards');
    const cards = slider.querySelectorAll('.trail-card');
    const prevBtn = slider.querySelector('.slider-nav.prev');
    const nextBtn = slider.querySelector('.slider-nav.next');

    let currentIndex = 0;
    let autoSlideInterval;
    const cardCount = cards.length;
    const cardWidth = cards[0].offsetWidth + 16; // 16 is the gap (adjust if needed)

    // Clone first and last card for infinite effect
    const firstClone = cards[0].cloneNode(true);
    const lastClone = cards[cardCount - 1].cloneNode(true);
    cardContainer.appendChild(firstClone);
    cardContainer.insertBefore(lastClone, cards[0]);

    let totalCards = slider.querySelectorAll('.trail-card').length;
    let slideIndex = 1; // Start from actual first card

    // Set initial transform
    cardContainer.style.transform = `translateX(-${cardWidth * slideIndex}px)`;

    // Slide to index
    function slideTo(index) {
        cardContainer.style.transition = 'transform 0.5s ease-in-out';
        cardContainer.style.transform = `translateX(-${cardWidth * index}px)`;
    }

    // Handle transition end for infinite effect
    cardContainer.addEventListener('transitionend', () => {
        const allCards = slider.querySelectorAll('.trail-card');
        if (slideIndex === 0) {
            cardContainer.style.transition = 'none';
            slideIndex = cardCount;
            cardContainer.style.transform = `translateX(-${cardWidth * slideIndex}px)`;
        } else if (slideIndex === totalCards - 1) {
            cardContainer.style.transition = 'none';
            slideIndex = 1;
            cardContainer.style.transform = `translateX(-${cardWidth * slideIndex}px)`;
        }
    });

    // Navigation buttons
    prevBtn.addEventListener('click', () => {
        if (slideIndex <= 0) return;
        slideIndex--;
        slideTo(slideIndex);
    });

    nextBtn.addEventListener('click', () => {
        if (slideIndex >= totalCards - 1) return;
        slideIndex++;
        slideTo(slideIndex);
    });

    // Auto slide
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            slideIndex++;
            slideTo(slideIndex);
        }, 4000); // every 4 seconds
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    // Optional: pause on hover
    slider.addEventListener('mouseenter', stopAutoSlide);
    slider.addEventListener('mouseleave', startAutoSlide);

    // Start
    startAutoSlide();
});
</script>
@endpush

@push('styles')
<style>
.trail-postcards {
    background-color: #e6f3ff;
    position: relative;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="%23e6f3ff"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%23cce4ff" stroke-width="0.5" stroke-dasharray="2,2"/></svg>');
    padding-top:20px;
}

.postcard-info {
    padding: 2rem;
    background-color: #e6f3ff;
    border-radius: 15px;
}

.postcard-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1rem;
    color: #333;
    text-align: left;
}
 .lead-generation-section{
    display:none;
}

.postcard-subtitle {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.5;
    margin-bottom: 2rem;
    text-align: left;
}

.heart {
    color: #ff4b6e;
}

@media (max-width: 768px) {
    .postcard-info {
        text-align: center;
        
    }

    .postcard-title,
    .postcard-subtitle {
        text-align: center;
    }

    .ratings-container {
        align-items: center;
    }
    .unique-experiences{
        padding: 30px 0 !important;
    }
}

.trail-postcards::before {
    content: '';
    position: absolute;
    bottom: 20px;
    left: 50px;
    width: 120px;
    height: 120px;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120"><circle cx="60" cy="60" r="55" fill="none" stroke="%23ddd" stroke-width="1"/><circle cx="60" cy="60" r="45" fill="none" stroke="%23ddd" stroke-width="1"/><path d="M30,60 C30,40 45,25 60,25 C75,25 90,40 90,60 C90,80 75,95 60,95 C45,95 30,80 30,60" fill="none" stroke="%23ddd" stroke-width="1"/></svg>');
    opacity: 0.3;
    z-index: 0;
    transform: rotate(-15deg);
}

.ratings-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 2rem;
}

.google-rating
 {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    background: white;
    border-radius: 30px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    width: fit-content;
}
.facebook-rating{
display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: white;
    border-radius: 30px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    width: fit-content;
}
.google-rating img {
    width: 16px;
    height: 16px;
}

.rating {
    font-weight: 600;
    font-size: 0.95rem;
    color: #333;
    margin-right: 2px;
}

.reviews {
    color: #666;
    font-size: 0.85rem;
    margin-left: 4px;
}

.fa-star {
    color: #ffd700;
    font-size: 0.8rem;
}

.trail-slider {
    margin-left: -15px;
    margin-right: -15px;
    padding: 0 15px;
}

.trail-slider {
    overflow: hidden;
    padding: 20px 0;
    margin: 0 -15px;
}

.trail-cards {
    display: flex;
    transition: transform 0.3s ease;
    gap: 20px;
    padding: 0 15px;
}

.trail-card {
    flex: 0 0 280px;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
}

.trail-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
}

.card-header {
    position: absolute;
    bottom: 10px;
    left: 10px;
    z-index: 1;

    padding: 5px 10px;
    border-radius: 20px;
}

.location {
    font-size: 0.8rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 5px;
}

.location i {
    font-size: 0.7rem;
}

.card-image,
.card-video,
.trail-card img {
    width: 100%;
    height: 380px;
    object-fit: cover;
    display: block;
}

.video-card .card-footer {
    background: rgba(0, 0, 0, 0.05);
}

.video-card video {
    transition: all 0.3s ease;
}

.video-card:hover video {
    transform: scale(1.05);
}

.card-footer {
    padding: 12px;
    background: white;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}
.hotel-instant-book-span{
    font-size:12px;
}

.card-footer h5 {
    margin: 0;
    font-size: 0.9rem;
    color: #333;
    font-weight: 500;
    font-size: 1rem;
    color: #333;

}

.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: white;
    border: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    font-size: 0.8rem;
    transition: all 0.2s ease;
}

.slider-nav.prev {
    left: 5px;
}

.slider-nav.next {
    right: 5px;
}

.slider-nav:hover {
    background: #f8f9fa;
    color: #333;
    transform: translateY(-50%) scale(1.1);
}

@media (max-width: 768px) {
    .ratings-container {
        flex-direction: column;
        gap: 10px;
        padding: 0px;
    }
     .lead-generation-section{
    display:block;
}

    .trail-card {
        flex: 0 0 280px;
    }

    .card-image {
        height: 350px;
    }

    .slider-nav {
        width: 35px;
        height: 35px;
    }
}
</style>
@endpush

<section class="about-us bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="about-image-wrapper position-relative">
                    <img src="https://andamanbliss.com/site/img/video2.jpg" alt="Andaman Bliss Travel Experience"
                        class="img-fluid rounded-4 shadow-lg" loading="lazy">
                    <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 rounded-4"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-content">
                    <h2 class="section-heading mb-4">About <span class="text-gradient">Andaman Bliss</span></h2>
                    <p class="section-subheading mb-4">
                        We are more than just a travel agency. We are your gateway to the breathtaking Andaman Islands,
                        crafting personalized experiences that transform ordinary trips into extraordinary memories.
                    </p>
                    <div class="about-features">
                        <div class="row g-4">
                            <div class="col-md-6 col-6">
                                <div class="feature-item d-flex flex-column align-items-center p-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-compass text-andaman fs-2"></i>
                                    </div>
                                    <h3 class="fw-bold mb-2 fs-6">Expert Guidance</h3>
                                    <p class="text-muted text-center">
                                        Our team of local experts ensures you explore the islands like a true
                                        adventurer.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="feature-item d-flex flex-column align-items-center p-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-heart text-andaman fs-2"></i>
                                    </div>
                                    <h3 class="fw-bold mb-2 fs-6">Sustainable Tourism</h3>
                                    <p class="text-muted text-center">
                                        We are committed to preserving the natural beauty and ecosystem of Andaman.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="feature-item d-flex flex-column align-items-center p-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-users text-andaman fs-2"></i>
                                    </div>
                                    <h3 class="fw-bold mb-2 fs-6">Personalized Experiences</h3>
                                    <p class="text-muted text-center">
                                        Every journey is unique. We tailor trips to match your dreams and preferences.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="feature-item d-flex flex-column align-items-center p-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-shield-alt text-andaman fs-2"></i>
                                    </div>
                                    <h3 class="fw-bold mb-2 fs-6">Safety First</h3>
                                    <p class="text-muted text-center">
                                        Your safety is our priority. We ensure top-notch security and support.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-cta mt-4 text-center">
                        <a href="{{ url('about') }}" class="view-all-btn btn-lg rounded-pill px-5">
                            Know More <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Unique Travel Experiences Section -->
<section class="unique-experiences">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading fw-bolder mb-3">Why Choose <span class="text-gradient">Andaman Bliss?</span>
                </h2>
                <p class="section-subheading">Discover what makes our travel experiences truly extraordinary</p>
            </div>
        </div>
        <div class="row g-4">
            @php
            $uniqueExperiences = [
            [
            'icon' => 'fas fa-users',
            'title' => 'No Third Party Mess',
            'description' => '100% In House Operations- All tours are managed by our own team, no outsourcing, no fake
            promises',
            'color' => '#0066CC'
            ],
            [
            'icon' => 'fas fa-shield-alt',
            'title' => 'On-Ground Support',
            'description' => 'We have Got Your Back- From the moment you land till your trip ends, our team is just a
            call away',
            'color' => '#0066CC'
            ],
            [
            'icon' => 'fas fa-filter',
            'title' => 'Private Tours',
            'description' => 'Your Tour, Your Way -Exclusive experiences, trip crafted just for you and your family',
            'color' => '#0066CC'
            ],
            [
            'icon' => 'fas fa-check-circle',
            'title' => 'Hassle-Free Experience',
            'description' => 'All in One Travel- Stays, transport, guides, everything taken care of, seamlessly.',
            'color' => '#0066CC'
            ]
            ];
            @endphp
            @foreach($uniqueExperiences as $experience)
            <div class="col-md-3 col-6">
                <div class="experience-card h-100">
                    <div class="card-content p-4">
                        <h3 class="card-title fw-bold mb-3 fs-6">{{ $experience['title'] }}</h3>
                        <p class="card-text">{{ $experience['description'] }}</p>
                    </div>
                    <div class="bottom-circle">
                        <i class="{{ $experience['icon'] }}"></i>
                        <div class="yellow-circle"></div>
                        <div class="small-square"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="guest-review bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading mb-3">What Our <span class="text-gradient">Travelers Say</span></h2>
                <p class="section-subheading">Authentic experiences shared by our valued guests</p>
            </div>
        </div>

        <div class="row mobile-scroll-row g-4">
            @foreach ($reviews->take(8) as $review)
                 <div class="col-md-3">
                <div class="card review-card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $review['reviewer_profile_photo_url'] }}" alt="{{ $review['reviewer_name'] }}" loading="lazy" class="rounded-circle me-3 review-avatar" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h3 class="mb-1 fw-bold fs-6">{{ $review['reviewer_name'] }}</h3>
                                <p class="text-muted mb-0 small">Reviewed: {{ \Carbon\Carbon::parse($review['review_date'])->format('M Y') }}</p>
                            </div>
                        </div>
                        <div class="review-stars mb-3">
                            @for ($i = 0; $i < $review['rating']; $i++) <i class="fas fa-star text-warning"></i>
                                @endfor
                        </div>
                        <p class="card-text flex-grow-1 text-muted">
                            "{{ Str::words($review['comment'], 30, '...') }}"
                        </p>                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="https://www.google.com/search?sca_esv=fccbee740c3569c2&si=APYL9bs7Hg2KMLB-4tSoTdxuOx8BdRvHbByC_AuVpNyh0x2KzZGhhuTObpYUE1HkKN3_Md8nYAFeEcAMoqiwdXoQwFSYOqDDrltYmi0pT-KVQrk7jrXJvBHEjOUEAxjr3BAscxIA0ZLZPSZUF0TyftwGHy_nKSSZDhNDiNpS5IIFZWGUxqYNtE7WRuocO1d4xEmQjIo1QcKvF0EVBYIbKy20-dQkqQGWbw%3D%3D&q=Andaman+Bliss+-+Best+DMC+%26+B2B+Supplier+for+Andaman+Tour+Packages+Reviews&sa=X&ved=2ahUKEwi-p7_S2sWMAxWySGwGHbAxOxcQ0bkNegQIKBAE"
                    target="_blank" class="view-all-btn btn-lg rounded-pill px-5">
                    View More Reviews <i class="fas fa-chevron-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .insta-book{
        font-size:12px;
        color:#ff6510;
        padding:0 10px;
    }
.unique-experiences {
    padding: 60px 0;
}
.about-content{
    padding-top:40px;
}
.subtitle-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.subtitle {
    font-size: 1.2rem;
    font-weight: 500;
    color: #333;
    margin-bottom: 5px;
}

.subtitle-underline {
    width: 80px;
    height: 3px;
    background-color: #ffd700;
    margin-bottom: 30px;
}

.experience-card {
    position: relative;
    border: 1px solid #87CEEB;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease;
    background-color: #fff;

}

.experience-card:hover {
    transform: translateY(-5px);
}

.card-content {
    position: relative;
    z-index: 2;
}

.card-title {
    color: rgb(17, 157, 213);
    font-size: 1.25rem;
}


.card-text {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.5;
}

.bottom-circle {
    position: absolute;
    width: 200px;
    height: 200px;
    background-color: rgb(135 206 235 / 15%);
    border-radius: 50%;
    bottom: -83px;
    left: 4px;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bottom-circle i {
    color: #1699b980;
    font-size: 1.8rem;
    z-index: 3;
}

.yellow-circle {
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: rgba(255, 215, 0, 0.6);
    border-radius: 50%;
    bottom: 15px;
    left: 15px;
    z-index: 2;
}

.small-square {
    position: absolute;
    width: 15px;
    height: 15px;
    background-color: rgba(135, 206, 235, 0.5);
    top: 20px;
    right: 20px;
    transform: rotate(45deg);
    z-index: 2;
}

.experience-card::before {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: rgba(255, 215, 0, 0.3);
    border-radius: 50%;
    top: 20px;
    right: 20px;
    z-index: 1;
}

.popular-cruise {
    background-color: #f8f9fa;
    padding: 25px 0;
    position: relative;
    overflow: hidden;
}

.section-heading {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: rgb(17, 157, 213);
    position: relative;
    display: inline-block;
}

.section-heading span {
    color: #fd6e0f;
    font-weight: 800;
}

.section-heading:after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(to right, rgb(17, 157, 213), #10d5e9);
    border-radius: 10px;
}

.section-subheading {
    font-size: 1.1rem;
    color: #6c757d;
    max-width: 700px;
    margin: 0 auto 2rem;
}
.hot-deals{
    padding-top:0px;
    padding-bottom:20px;
}

/* Cruise Card Styles */
.cruise-card {
    background-color: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    /* margin-bottom: 20px; */
}

.cruise-card:hover {
    /* transform: translateY(-10px); */
    box-shadow: 0 20px 40px rgba(17, 157, 213, 0.15);
}

.cruise-card-ribbon {
    position: absolute;
    top: 20px;
    left: -5px;
    background: linear-gradient(to right, #fd6e0f, #ff9248);
    color: white;
    padding: 5px 15px;
    font-size: 12px;
    font-weight: 600;
    z-index: 3;
    border-radius: 0 4px 4px 0;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.cruise-card-ribbon:before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    border-top: 5px solid #d45500;
    border-left: 5px solid transparent;
    filter: brightness(0.8);
}

.cruise-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.cruise-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.cruise-card:hover .cruise-image img {
    /* transform: scale(1.1); */
}

.cruise-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 45px;
    height: 45px;
    background: rgb(17, 157, 213);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
    z-index: 2;
    transition: all 0.3s ease;
}

.cruise-card:hover .cruise-badge {
    /* transform: scale(1.1) rotate(10deg); */
}

.cruise-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.cruise-card:hover .cruise-overlay {
    opacity: 1;
}

.cruise-quick-view {
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.cruise-card:hover .cruise-quick-view {
    transform: translateY(0);
}

.quick-view-btn {
    background-color: white;
    color: #333;
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.quick-view-btn:hover {
    background-color: #fd6e0f;
    color: white;
    transform: scale(1.05);
}

.cruise-content {
    padding: 20px;
}

.cruise-rating {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.rating-score {
    font-weight: 700;
    font-size: 12px;
    color: #333;
    margin-right: 8px;
    background-color: #FF5722;
    color: #fff;

}
.lead-beni-item{
    color:#fff;
}

.rating-stars {
    display: flex;
    margin-right: 8px;
}

.rating-stars i {
    color: #ddd;
    font-size: 14px;
    margin-right: 2px;
}

.rating-stars i.filled {
    color: #FF5722;
}

.rating-count {
    color: #6c757d;
    font-size: 14px;
}

.cruise-title {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin-bottom: 6px;
    transition: color 0.3s ease;
}

.cruise-card:hover .cruise-title {
    color: rgb(17, 157, 213);
}

.activity-card:hover .card-title {
    color: rgb(17, 157, 213);
}

.cruise-desc {
    color: #fd6e0f;
    font-size: 14px;
    margin-bottom: 15px;
    font-weight: 500;
}

.cruise-info {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 15px;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    font-size: 14px;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item i {
    color: rgb(17, 157, 213);
    margin-right: 10px;
    width: 16px;
    text-align: center;
}

.info-item span {
    color: #666;
}

.price-item {
    margin-top: 5px;
    padding-top: 5px;
    border-top: 1px dashed #ddd;
}

.info-item .price {
    color: #fd6e0f;
    font-weight: 700;
}

.cruise-actions {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.hotel-loco {
    font-size: 12px;
}

.btn-details,
.btn-book {
    flex: 1;
    text-align: center;
    border-radius: 50px;
    padding: 4px 15px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-details {
    background-color: #f1f3f5;
    color: #333;
    border: 1px solid #ddd;
}

.btn-book {
    background-color: rgb(17, 157, 213);
    color: white;
    padding: 4px 15px;
}

.btn-details:hover {
    background-color: #e9ecef;
    border-color: #ced4da;
}

.btn-book:hover {
    background-color: #0e8bc0;
    transform: translateY(-2px);
}

.view-all-btn {
    display: inline-block;
    border: 2px solid rgb(17, 157, 213);
    color: rgb(17, 157, 213);
    font-weight: 600;
    padding: 4px 15px;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.view-all-btn:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background-color: rgb(17, 157, 213);
    transition: width 0.3s ease;
    z-index: -1;
}

.view-all-btn:hover {
    color: white;
}

.view-all-btn:hover:before {
    width: 100%;
}

.view-all-btn i {
    transition: transform 0.3s ease;
}

.view-all-btn:hover i {
    transform: translateX(5px);
}

/* Responsive Styles */
@media (max-width: 1199px) {
    .cruise-image {
        height: 180px;
    }

    .section-heading {
        font-size: 2.2rem;
    }
}

@media (max-width: 991px) {
    .popular-cruise {
        padding: 60px 0;
    }

    .cruise-image {
        height: 160px;
    }

    .section-heading {
        font-size: 2rem;
    }

    .section-subheading {
        font-size: 1rem;
    }
}

@media (max-width: 767px) {
    .cruise-content {
        padding: 15px;
    }
    

    .experience-card {
        position: relative;
        border: 1px solid #87CEEB;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
        background-color: #fff;
        /* min-height: 280px; */
    }

    .cruise-title {
        font-size: 16px;
    }

    .cruise-desc {
        font-size: 13px;
        margin-bottom: 10px;
    }

    .info-item {
        font-size: 12px;
        margin-bottom: 6px;
    }

    .btn-details,
    .btn-book {
        padding: 8px 15px;
        font-size: 13px;
    }

    .section-heading {
        font-size: 1.8rem;
    }
}

@media (max-width: 575px) {
    .popular-cruise {
        padding-top: 50px;
        padding-bottom: 17px;
    }

    .cruise-image {
        height: 260px;
    }
    .about-content{
        padding-top: 5px;
    }

    .cruise-badge {
        width: 35px;
        height: 35px;
    }

    .cruise-card-ribbon {
        font-size: 10px;
        padding: 4px 12px;
    }

    .section-heading {
        font-size: 1.5rem;
    }

    .section-subheading {
        font-size: 0.9rem;
    }

    .view-all-btn {
        padding: 10px 25px;
        font-size: 14px;
    }

    .home-banner {
        display: none;
    }

    .search-navigation {
        margin-top: 120px;
    }

    .lead-cta-content {
        display: none;
    }
/* 
    .card-text:last-child {
        display: none;
    } */

    .card-title {
        font-size: 1rem;
    }

    .experience-icon {
        font-size: 10px;
    }

    .feature-item h5 {
        font-size: 12px;
    }

    .feature-item p {
        display: none;
    }

    .about-cta {
        text-align: center;
    }
    .popular-activities{
        padding-top:50px;
        padding-bottom:50px;
    }
    .andaman-popular-beaches{
        padding-top: 30px;
    }
    .hot-deals {
    padding-top: 30px;
    padding-bottom: 30px;
}
.tour-support-title{
    font-size:1.5rem;
}
}

/* Review Card Styles */
.review-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.review-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.review-avatar {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
}

.review-stars {
    color: #ffc107;
}

.review-stars i {
    margin-right: 5px;
}

.review-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.review-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.review-avatar {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
}

.review-stars {
    color: #ffc107;
}

.review-stars i {
    margin-right: 5px;
}

.icon-style {
    color: rgb(17, 157, 213);
    /* border: 2px solid #fd6e0f; */
    border-radius: 50%;
    padding: 10px;
    margin: 5px;
    display: inline-block;
    width: 35px;
    height: 35px;
    text-align: center;
}

.month-input-wrapper {
    position: relative;
    width: fit-content;
    /* Adjust based on your layout */
}

.placeholder-text {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #aaa;
    /* Placeholder-like color */
    pointer-events: none;
    /* Allows clicks to pass through to the input */
}

/* Hide placeholder when input is focused or has a value */
input[type="month"]:focus+.placeholder-text,
input[type="month"]:valid+.placeholder-text {
    display: none;
}

/* Ensure placeholder shows when input is empty and not focused */
input[type="month"]:invalid:not(:focus)+.placeholder-text {
    display: block;
}

/* Mobile Optimization Styles */
@media (max-width: 767px) {
    .mobile-scroll-row {
        display: flex !important;
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
        scroll-snap-type: x mandatory;
        gap: 1rem;
        padding-bottom: 1rem;
        -webkit-overflow-scrolling: touch;
        margin-left: -0.75rem !important;
        margin-right: -0.75rem !important;
        padding-left: 7.5% !important; /* Center alignment padding */
        padding-right: 7.5% !important;
        width: calc(100% + 1.5rem);
    }
    
    .mobile-scroll-row > * {
        flex: 0 0 85% !important;
        max-width: 85% !important;
        scroll-snap-align: center !important;
        margin-bottom: 0 !important; /* Remove bottom margin in scroll view */
    }

    /* Hide scrollbar for cleaner look */
    .mobile-scroll-row::-webkit-scrollbar {
        display: none;
    }
    .mobile-scroll-row {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Compact Hero for Mobile */
    .home-banner {
        height: 50vh !important; /* Reduce height on mobile */
        min-height: 300px;
    }
    
    /* Adjust Section Headings */
    .section-heading {
        font-size: 1.5rem !important;
        margin-bottom: 0.5rem !important;
    }
    .section-subheading {
        font-size: 0.9rem !important;
        margin-bottom: 1.5rem !important;
    }
    
    /* Compact Cards */
    .activity-card, .cruise-card, .hotel-card, .andaman-beach-card {
        height: 100%;
        margin-bottom: 0 !important;
    }
    
    /* Lead Form Compact */
    .lead-generation-section {
        padding: 2rem 0;
    }
    .lead-cta-content {
        text-align: center;
        margin-bottom: 1rem;
    }
    .lead-benefits {
        display: none !important; /* Hide benefits list on mobile to save space */
    }
    .lead-form-card {
        margin-top: 0 !important;
    }
    
    /* Adjust paddings */
    .popular-activities, .popular-cruise, .featured-hotels, .andaman-popular-beaches {
        padding-top: 2rem !important;
        padding-bottom: 1rem !important;
    }
}

    /* Scroll Indicator Arrow */
    .scroll-indicator {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background: rgba(255, 255, 255, 0.8);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        animation: bounceRight 2s infinite;
        pointer-events: none; /* Let clicks pass through */
    }
    
    .scroll-indicator i {
        color: #fd6e0f;
    }

    @keyframes bounceRight {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(-50%) translateX(0);
        }
        40% {
            transform: translateY(-50%) translateX(-10px);
        }
        60% {
            transform: translateY(-50%) translateX(-5px);
        }
    }
}
</style>
@endpush












<!-- Travel Resources Section -->
{{-- <section class="travel-resources py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading mb-3">Travel <span class="text-gradient">Resources</span></h2>
                <p class="lead text-muted">Everything you need to plan your perfect Andaman adventure</p>
            </div>
        </div>
        <div class="row g-4">
            @php
            $resources = [
            [
            'icon' => 'fas fa-passport',
            'title' => 'Travel Guide',
            'description' => 'Comprehensive guide to Andaman',
            'link' => '#',
            ],
            [
            'icon' => 'fas fa-umbrella-beach',
            'title' => 'Best Beaches',
            'description' => 'Top beaches you must visit',
            'link' => '#',
            ],
            [
            'icon' => 'fas fa-utensils',
            'title' => 'Local Cuisine',
            'description' => 'Explore Andaman\'s culinary delights',
            'link' => '#',
            ],
            [
            'icon' => 'fas fa-camera',
            'title' => 'Photography Tips',
            'description' => 'Capture your Andaman memories',
            'link' => '#',
            ],
            ];
            @endphp
            @foreach ($resources as $resource)
            <div class="col-md-3 col-6">
                <div class="card resource-card border-0 h-100 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="resource-icon mb-3 text-orange">
                            <i class="{{ $resource['icon'] }} fa-3x"></i>
</div>
<h4 class="card-title fw-bold mb-3">{{ $resource['title'] }}</h4>
<p class="card-text text-muted mb-3">{{ $resource['description'] }}</p>
<a href="{{ $resource['link'] }}" class="btn-book btn-sm rounded-pill px-3">
    Learn More <i class="fas fa-chevron-right ms-2"></i>
</a>
</div>
</div>
</div>
@endforeach
</div>
</div>
</section> --}}
<!-- Our Blog Section -->

@if(!empty($blogs))

<section class="our-blog">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-heading">Our <span class="text-gradient">Blogs</span></h2>
                <p class="section-subheading">Explore travel insights, local culture, and unforgettable experiences</p>
            </div>
        </div>

        @php
        $firstBlog = $blogs->first();
        $remainingBlogs = $blogs->skip(1);
        @endphp

        @if($firstBlog)
        <div class="row g-4 mb-4">
            <!-- Main column (col-md-9) -->
            <div class="col-md-9">
                <div class="card border-0 shadow-sm blog-card h-100">
                    <img src="{{ $firstBlog->photo->file }}" class="card-img" alt="{{ $firstBlog->title }}">
                    <div class="card-img-overlay text-white d-flex flex-column justify-content-end">
                        <h3 class="h4 text-white fw-bolder mb-2">{{ Str::limit($firstBlog->title, 70) }}</h3>
                        <p class="small text-white fw-bolder mb-3">{{ Str::limit(strip_tags($firstBlog->content), 200)
                            }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small>Updated on {{ \Carbon\Carbon::parse($firstBlog->publish_date)->format('M d, Y')
                                }}</small>
                            <a href="{{ url('/blogs/' . $firstBlog->slug) }}"
                                class="btn btn-warning btn-sm rounded-pill ">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>

            @if($remainingBlogs->count())
            <div class="col-md-3">
                @php $sideBlog = $remainingBlogs->first(); @endphp
                <div class="card border-0 shadow-sm blog-card blog-card-small h-100">
                    <img src="{{ $sideBlog->photo->file }}" class="card-img" alt="{{ $sideBlog->title }}">
                    <div class="card-img-overlay text-white d-flex flex-column justify-content-end">
                        <h3 class="h4 text-white fw-bolder mb-2">{{ Str::limit($sideBlog->title, 35) }}</h3>
                        <p class="small text-white mb-3">{{ Str::limit(strip_tags($sideBlog->content), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small>Updated on
                                {{ \Carbon\Carbon::parse($sideBlog->publish_date)->format('F Y') }}</small>
                            <a href="{{ url('/blogs/' . $sideBlog->slug) }}"
                                class="btn btn-warning btn-sm rounded-pill">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif

        <!-- Second row with 4 columns -->
        <div class="mobile-slider-wrapper">
        <div class="row g-4 mobile-scroll-row">
            @foreach($remainingBlogs->skip(1)->take(4) as $blog)
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm h-100 d-flex flex-row blog-thumbnail-card">
                    <div class="thumbnail-img-container" style="width: 40%; min-width: 40%;">
                        <img src="{{ $blog->photo->file }}" class="img-fluid h-100 w-100 object-fit-cover"
                            alt="{{ $blog->title }}">
                    </div>
                    <div class="card-body p-2">
                        <h3 class="h6 mb-2"><a href="{{ url('/blogs/' . $blog->slug) }}"
                                class="text-dark fw-bolder fs-6">{{
                                Str::limit($blog->title, 50) }}</a></h3>
                        <p class="text-muted small mb-2" style="font-size: 0.8rem; line-height: 1.4;">
                            {{ Str::limit(strip_tags($blog->content), 50) }}
                        </p>
                        <small class="text-muted d-flex align-items-center" style="font-size: 0.7rem;">
                            <i class="far fa-calendar-alt me-1"></i> Updated on
                            {{ \Carbon\Carbon::parse($blog->publish_date)->format('F Y') }}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </div>


        <div class="col-12 text-center mt-4">
            <a href="/blogs" class="btn btn-outline-primary rounded-pill px-4 py-2">VIEW MORE</a>
        </div>
    </div>
    </div>
</section>
@endif
@push('scripts')
<script>
document.querySelector('.month-input-wrapper').addEventListener('click', function() {
    const input = document.getElementById('travelMonth');
    if (input.showPicker) {
        input.showPicker(); // Opens the picker instantly where supported
    } else {
        input.focus(); // Backup plan, still opens it in most cases
    }

});
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality

    const navItems = document.querySelectorAll('.andaman-offers-nav-item');
    const tabs = document.querySelectorAll('.andaman-offers-tab');
    let customSliders = {};

    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const target = this.getAttribute('data-target');

            // Get the tab type before DOM updates
            const tabType = target.replace('andaman-offers-', '');

            // Remove active class from all nav items and tabs
            navItems.forEach(nav => nav.classList.remove('andaman-offers-nav-active'));
            tabs.forEach(tab => tab.classList.remove('andaman-offers-tab-active'));

            // Add active class to clicked nav item and corresponding tab
            this.classList.add('andaman-offers-nav-active');
            document.getElementById(target).classList.add('andaman-offers-tab-active');

            // Update the active slider
            if (customSliders[tabType]) {
                customSliders[tabType].updateSlider();
                equalizeCardHeights(tabType);
            }
        });
    });

    // Custom slider class
    class CustomSlider {
        constructor(elementId, options = {}) {
            this.elementId = elementId;
            this.element = document.querySelector(`.${elementId}-slider`);
            if (!this.element) return;

            this.container = this.element.querySelector('.custom-slider-container');
            this.slides = this.element.querySelectorAll('.custom-slide');
            this.prevBtn = this.element.querySelector(`.${elementId}-prev`);
            this.nextBtn = this.element.querySelector(`.${elementId}-next`);
            this.paginationEl = this.element.querySelector(`.${elementId}-pagination`);

            this.currentIndex = 0;
            this.slidesPerView = options.slidesPerView || 2;
            this.slideWidth = 0;
            this.totalSlides = this.slides.length;
            this.maxIndex = Math.max(0, this.totalSlides - this.slidesPerView);

            // Clone slides for infinite loop
            this.setupInfiniteLoop();
            this.createPagination();
            this.updateDimensions();
            this.bindEvents();
            this.goToSlide(0);
        }

        setupInfiniteLoop() {
            // Clone first and last slides
            const firstSlideClone = this.slides[0].cloneNode(true);
            const lastSlideClone = this.slides[this.slides.length - 1].cloneNode(true);

            // Add clones to container
            this.container.appendChild(firstSlideClone);
            this.container.insertBefore(lastSlideClone, this.slides[0]);

            // Update slides collection
            this.slides = this.element.querySelectorAll('.custom-slide');
        }

        goToSlide(index, smooth = true) {
            this.currentIndex = index;

            // Calculate the actual translation considering cloned slides
            const translateX = -(index + 1) * this.slideWidth;

            this.container.style.transition = smooth ? 'transform 0.3s ease' : 'none';
            this.container.style.transform = `translateX(${translateX}px)`;

            // Handle infinite loop
            if (index === -1) {
                setTimeout(() => {
                    this.container.style.transition = 'none';
                    this.currentIndex = this.maxIndex;
                    const finalTranslate = -(this.currentIndex + 1) * this.slideWidth;
                    this.container.style.transform = `translateX(${finalTranslate}px)`;

                    setTimeout(() => {
                        this.container.style.transition = 'transform 0.3s ease';
                    }, 50);
                }, 300);
            } else if (index > this.maxIndex) {
                setTimeout(() => {
                    this.container.style.transition = 'none';
                    this.currentIndex = 0;
                    const finalTranslate = -this.slideWidth;
                    this.container.style.transform = `translateX(${finalTranslate}px)`;

                    setTimeout(() => {
                        this.container.style.transition = 'transform 0.3s ease';
                    }, 50);
                }, 300);
            }

            // Update pagination
            const bullets = this.paginationEl.querySelectorAll('.custom-slider-bullet');
            bullets.forEach((bullet, i) => {
                if (i === this.currentIndex) {
                    bullet.classList.add('active');
                } else {
                    bullet.classList.remove('active');
                }
            });
        }

        bindEvents() {
            if (this.prevBtn) {
                this.prevBtn.addEventListener('click', () => {
                    this.goToSlide(this.currentIndex - 1);
                });
            }

            if (this.nextBtn) {
                this.nextBtn.addEventListener('click', () => {
                    this.goToSlide(this.currentIndex + 1);
                });
            }

            // Handle transition end for smooth infinite loop
            this.container.addEventListener('transitionend', () => {
                if (this.currentIndex === -1) {
                    this.goToSlide(this.maxIndex, false);
                } else if (this.currentIndex > this.maxIndex) {
                    this.goToSlide(0, false);
                }
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                this.updateDimensions();
            });
        }

        updateDimensions() {
            // Check if we should use mobile layout
            if (window.innerWidth <= 768) {
                this.slidesPerView = 1;
            } else {
                this.slidesPerView = 2;
            }

            // Recalculate slide dimensions
            this.maxIndex = Math.max(0, this.totalSlides - this.slidesPerView);

            // Calculate slide width including the cloned slides
            const containerWidth = this.element.offsetWidth;
            this.slideWidth = containerWidth / this.slidesPerView;

            // Set width for each slide
            this.slides.forEach(slide => {
                slide.style.flexBasis = `calc(${100 / this.slidesPerView}% - 20px)`;
            });

            // Update slide position
            this.goToSlide(this.currentIndex, false);
        }

        createPagination() {
            // Create pagination bullets
            for (let i = 0; i <= this.maxIndex; i++) {
                const bullet = document.createElement('div');
                bullet.classList.add('custom-slider-bullet');
                if (i === 0) bullet.classList.add('active');

                bullet.addEventListener('click', () => {
                    this.goToSlide(i);
                });

                this.paginationEl.appendChild(bullet);
            }
        }

        updateSlider() {
            this.updateDimensions();
        }
    }

    // Initialize custom sliders for all tabs
    function initCustomSliders() {
        const offerTypes = @json($offerTypes);

        offerTypes.forEach(type => {
            customSliders[type.id] = new CustomSlider(type.id, {
                slidesPerView: window.innerWidth <= 768 ? 1 : 2
            });

            // Initial height equalization
            equalizeCardHeights(type.id);
        });
    }

    // Function to make all cards in a slide the same height
    function equalizeCardHeights(tabType = 'tour') {
        const cards = document.querySelectorAll(`.${tabType}-slider .andaman-offers-card`);

        // Reset heights
        cards.forEach(card => {
            card.style.height = 'auto';
        });

        // Calculate max height
        let maxHeight = 0;
        cards.forEach(card => {
            maxHeight = Math.max(maxHeight, card.offsetHeight);
        });

        // Apply max height to all cards
        if (maxHeight > 0) {
            cards.forEach(card => {
                card.style.height = maxHeight + 'px';
            });
        }
    }

    // Run equalize heights on window resize
    window.addEventListener('resize', function() {
        const offerTypes = @json($offerTypes);
        offerTypes.forEach(type => {
            if (customSliders[type.id]) {
                equalizeCardHeights(type.id);
                customSliders[type.id].updateSlider();
            }
        });
    });

    // Initialize all sliders
    initCustomSliders();

    // Mobile Slider Navigation Logic
    document.querySelectorAll('.mobile-slider-wrapper').forEach(wrapper => {
        const row = wrapper.querySelector('.mobile-scroll-row');
        const prevBtn = wrapper.querySelector('.mobile-nav-btn.prev');
        const nextBtn = wrapper.querySelector('.mobile-nav-btn.next');

        if (row && prevBtn && nextBtn) {
            nextBtn.addEventListener('click', () => {
                const cardWidth = row.firstElementChild.offsetWidth;
                row.scrollBy({ left: cardWidth + 16, behavior: 'smooth' }); // 16 is gap
            });

            prevBtn.addEventListener('click', () => {
                const cardWidth = row.firstElementChild.offsetWidth;
                row.scrollBy({ left: -(cardWidth + 16), behavior: 'smooth' });
            });
        }
    });
});
</script>
@endpush





@endsection