@extends('layouts.app')
@section('title', 'Cab Services in Andaman – Book Reliable Andaman Taxis | Andaman Bliss')
@section('keywords',
' cab service, taxi service, Andaman cab service, Andaman taxi, airport taxi Andaman, taxi booking
Andaman, cab rental Andaman, private cab hire, Andaman island taxi, reliable taxi service')
@section('description',
' Book trusted cab services in Andaman with Andaman Bliss. Enjoy safe, comfortable taxi rides
for sightseeing, airport transfers, and island tours. Reserve your cab now!')

@section('content')

<section class="cab-banner">
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row">
            <div class="col-12 text-center mt-5 banner-centre-contain">
                <h1 class="text-white fs-1 text-center">Book Your Andaman Cab with Andaman Bliss</h1>
            </div>
        </div>
    </div>
</section>


@include('common.search2')
@include('common.login-modal')
@if (count($cabPrices) > 0)
<section class="cab-listing container mt-2">
    <div class="row">
        <div class="col-lg-3">
            <div class="filter-section">
                <h5><i class="fas fa-filter me-1"></i>Filters</h5>
                <hr class="my-2">
                <!-- Car Type Filter -->
                <h6>Car Type</h6>
                <div class="form-check">
                    <input class="form-check-input filter-category" type="checkbox" value="sedan" id="sedan">
                    <label class="form-check-label small" for="sedan">Sedan</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input filter-category" type="checkbox" value="suv" id="suv" checked>
                    <label class="form-check-label small" for="suv">SUV</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input filter-category" type="checkbox" value="hatchback" id="hatchback">
                    <label class="form-check-label small" for="hatchback">Hatchback</label>
                </div>
                <hr class="my-2">
                <!-- AC Filter -->
                <h6>AC/Non-AC</h6>
                <div class="form-check">
                    <input class="form-check-input filter-ac" type="checkbox" value="ac" id="ac" checked>
                    <label class="form-check-label small" for="ac">AC</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input filter-ac" type="checkbox" value="nonac" id="nonac">
                    <label class="form-check-label small" for="nonac">Non-AC</label>
                </div>
                <hr class="my-2">
                <!-- Price Range -->
                <h6>Price Range (₹)</h6>
                <input type="range" class="form-range" id="priceRange" min="500" max="5000" value="5000">
                <small class="text-muted">₹500 - ₹5000</small>
                <hr class="my-2">
                <!-- Driver Type -->
                <h6>Driver Type</h6>
                <div class="form-check">
                    <input class="form-check-input filter-driver" type="radio" name="driver" value="withdriver" checked>
                    <label class="form-check-label small" for="withdriver">With Driver</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input filter-driver" type="radio" name="driver" value="selfdrive">
                    <label class="form-check-label small" for="selfdrive">Self Drive</label>
                </div>
                <hr class="my-2">
                <button class="btn btn-outline-primary w-100 py-1 fw-medium small">Apply Filters</button>
            </div>
        </div>
        <div class="col-lg-9">
            <!-- Sort Options -->
            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-1">
                <h5 class="mb-0">Available Cabs ({{ count($cabPrices) }} options found)</h5>
                <select class="sort-select form-select">
                    <option>Sort by: Price Low to High</option>
                    <option>Sort by: Price High to Low</option>
                    <option>Sort by: Popularity</option>
                </select>
            </div>

            <!-- Listing Section -->
            <div class="listing-section">
                <!-- Cab 1: Toyota Etios -->
                @foreach ($cabPrices as $cab)

                <div class="cab-card shadow" data-category="{{ strtolower($cab->category) }}" data-ac="{{ strtolower($cab->ac_type ?? 'ac') }}" data-price="{{ $cab->base_price }}" data-driver="{{ strtolower($cab->driver_type ?? 'withdriver') }}">
                    <div class="row g-0">
                        <div class="col-lg-8 cab-left">
                            <div class="d-flex flex-wrap">
                                <div class="col-4">
                                    <img src="{{ $cab->cabPhotos[0]->file }}"
                                        style="height: 55px !important; width:auto;" alt="{{ Str::slug($cab->name) }}"
                                        class="cab-image">
                                </div>
                                <div class="cab-header col-8">
                                    <h6>{{ ucwords($cab->name) }}</h6>
                                    <p><span
                                            class="bg-orange rounded-1 px-2">{{ strtolower($cab->category) }}</span>
                                        | {{ $cab->sitting_capacity }} Seat |
                                        {{ $cab->luggage ?? '2 Luggage Bag' }}
                                    </p>
                                </div>
                            </div>
                            <div class="cab-details-row">
                                <div class="detail-item">
                                    <i class="fas fa-road"></i>
                                    Kilometer Charges: {{ (int) $cab->distance_covered }} km Included after that
                                    km charge applicable
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-gas-pump"></i>
                                    Fuel Type: {{ $cab->fuel_type }}
                                </div>
                            </div>
                            <div class="cab-details-row">
                                <div class="detail-item check-green">
                                    <i class="fa-solid fa-user-shield"></i>
                                    Cancellation Policy: Free before 6 hours from the journey time.
                                </div>
                                <div class="detail-item hand-icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    Part Payment: Pay 25% now and rest to driver
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 cab-right text-end">
                            <div class="price mb-0 text-end d-flex flex-wrap flex-column">
                                ₹{{ number_format($cab->base_price) }}
                                <small class="mb-1 city-limit">within city limits</small>
                            </div>
                            <div class="text-end">

                                @if(Auth::check())
                                <form action="{{ route('cab.checkout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="request" id="request" value='@json($cab)'>
                                    <button type="submit" class="btn btn-primary">Book Now</button>
                                </form>
                                @else
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Book Now
                                </button>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="cab-footer ">
                        <p class="ps-2"><i class="fa-solid fa-check"></i> 24/7 customer helpline</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@if (count($cabPrices) == 0)
<section class=" overview-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="section-title mt-5">About Andaman Bliss <span class="text-gradient">Car Rental</span>
                </h2>
                <div class="read-more-container">
                    <div class="overview-description" style="text-align:justify">
                        <p class="pb-3">When it comes to <strong>cab booking in Andaman</strong>, <a
                                href="https://andamanbliss.com" target="_blank" rel="noopener noreferrer">Andaman
                                Bliss</a> is your trusted partner. We provide reliable and affordable taxi services
                            all
                            around the Andaman Islands, so you may travel with ease and comfort. Be it your Andaman
                            airport transfer, sightseeing cabs or a ride to get around Port Blair, we are there for
                            you
                            through our <strong>cab services in Andaman</strong>. We guarantee a great and safe
                            journey
                            every time with a fleet of well-maintained vehicles and experienced drivers. Choose
                            Andaman
                            Bliss as the <strong>best cab service in Andaman</strong> and explore the islands care
                            free.

                        <div class="more-text">
                            <p>
                                Renting a cab of your choice is very easy. It's merely child's play to rent a cab in
                                a
                                place like the Andaman Islands. Rent a cab in Andaman and experience the simplicity
                                firsthand. We in this feed will be discussing the details such as the documents
                                needed
                                and point-by-point detailed procedure of <strong>renting a cab</strong>. A very
                                important point to be noted—please do not worry if you did not find a cab to rent,
                                don't
                                be alarmed, you may not find a cab then... HAHA, gotcha! Who are we kidding? You
                                will
                                always find a Cab to rent up until you are in Andaman. Now let's get into the topic,
                                <strong>ANDAMAN BLISS</strong> giving you a detailed procedure to follow about how
                                to
                                book a Cab Rental in Andaman.
                            </p>

                        </div>
                    </div>
                    <button id="toggleBtn" class="mt-2">Read more</button>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('site/img/cab/ab-cars.png') }}" alt="Andamanbliss Bike Rental"
                    class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<section class="why-choose-section">
    <div class="container">
        <h2 class="section-title text-center">
            Why Choose Cab Services In Andaman <span class="text-gradient">From Andaman Bliss:</span>
        </h2>
        <p class="text-center mb-4">Reasons To Choose Cab Service In Andaman Over All Other Taxi Services In The
            Andaman
            Islands</p>
        <div class="row">
            <div class="col-md-3">
                <div class="choose-card">
                    <i class="fas fa-thumbs-up"></i>
                    <h3 class="fs-6 fw-bold">Reliability</h3>
                    <p>We are never late. We value time and want to guarantee you do not miss anything during your
                        trip.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="choose-card">
                    <i class="fas fa-rupee-sign"></i>
                    <h3 class="fs-6 fw-bold">Low Cost</h3>
                    <p>Simple pricing, no hidden costs. We are upfront yet affordable.Inexpensive</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="choose-card">
                    <i class="fas fa-car"></i>
                    <h3 class="fs-6 fw-bold">Comfortable Vehicles</h3>
                    <p>We have a quality fleet to ensure your ride is smooth, safe, and classy.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="choose-card">
                    <i class="fas fa-user-tie"></i>
                    <h3 class="fs-6 fw-bold">Experienced Drivers</h3>
                    <p>Our friendly and competent drivers are preferred by travelers who want a reliable ride.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Top Benefits of Booking with Us Section -->
<section class="top-benefits-section">
    <div class="container">
        <h2 class="section-title text-center pb-4">Advantages of Choosing <span class="text-gradient">Andaman
                Bliss
                Cab Services</span></h2>
        <div class="row">
            <div class="col-md-3">
                <div class="benefit-card">
                    <i class="fas fa-mouse-pointer"></i>
                    <h3 class="fs-6 fw-bold">Convenience</h3>
                    <p>Booking a cab in Port Blair (or anywhere in Andaman) is as easy as a couple of clicks from
                        your
                        screen.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="benefit-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3 class="fs-6 fw-bold">Safety</h3>
                    <p>Your safety and comfort is our driver's number one priority during your trip, we bey traffic
                        rules and abide by the law.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="benefit-card">
                    <i class="fas fa-car"></i>
                    <h3 class="fs-6 fw-bold">Guides With Local Knowledge</h3>
                    <p>Our drivers know the best path and know special little places that will make your trip
                        even more memorable.</p>
                </div>
            </div>


            <div class="col-md-3 mt-4">
                <div class="benefit-card">
                    <i class="fas fa-wallet"></i>
                    <h3 class="fs-6 fw-bold">Affordable</h3>
                    <p>You will get the most bang for your buck with competitive pricing and transparent pricing.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Island Adventures Section -->
<section class="island-adventures bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="section-title">Explore the Islands with Our <span class="text-gradient">Taxi Services
                        In
                        Andaman</span></h2>
                <p>Choose our Andaman sightseeing cabs and explore the lovely Andaman Islands. Book our <strong>Cab
                        Services In Andaman</strong> and visit all the sightseeing spots, from the beautiful beaches
                    of
                    Havelock to the historic Cellular Jail in Port Blair. Make your journey hassle free and enjoy
                    every
                    moment of your Andaman holiday.</p>
                <ul class="adventure-highlights">
                    <li>Visit all the hidden beaches</li>
                    <li>A drive through the dense forest of Andaman</li>
                    <li>Have a taste of local culture and customs</li>
                    <li>Explore the islands at your own pace</li>
                    <li>Capture the stunning sunrises and sunsets</li>
                </ul>
                <a href="#cab_booking_frm" class="btn btn-primary mt-3">Plan Your Adventure</a>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('site/img/cab/cab3.jpg') }}" alt="Andaman Island Adventures"
                    class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>


<!-- Car Types and Comfort Section -->
<section class="car-types pt-4 pb-2">
    <div class="container">
        <h2 class="text-center mb-4 section-title">Choose a Cab That <span class="text-gradient">Suits Your
                Preferences</span></h2>
        <div class="row">
            <div class="col-md-3">
                <div class="car-type-card">
                    <img src="{{ asset('site/img/cab/car11.png') }}" alt="Sedan" class="rounded mb-3">
                    <h3 class="fs-6 fw-bold">Sedan</h3>
                    <p>Ideal for small groups or solo travelers who value comfort and efficiency.</p>
                    <a href="#cab_booking_frm" class="btn btn-primary mt-3">Book Now</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="car-type-card">
                    <img src="{{ asset('site/img/cab/car8.png') }}" alt="SUV" class="rounded mb-3">
                    <h3 class="fs-6 fw-bold">SUV</h3>
                    <p>Perfect for families or larger groups, offering plenty of space and comfort.</p>
                    <a href="#cab_booking_frm" class="btn btn-primary mt-3">Book Now</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="car-type-card">
                    <img src="{{ asset('site/img/cab/car10.png') }}" alt="Luxury Cars" class="rounded mb-3">
                    <h3 class="fs-6 fw-bold">Luxury Cars</h3>
                    <p>For those who prefer to travel in style with premium features and elegance.</p>
                    <a href="#cab_booking_frm" class="btn btn-primary mt-3">Book Now</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="car-type-card">
                    <img src="{{ asset('site/img/cab/car9.png') }}" alt="Tempo Traveller" class="rounded mb-3">
                    <h3 class="fs-6 fw-bold">Tempo Traveller</h3>
                    <p>Ideal for group tours or corporate outings — spacious and comfortable for all.</p>
                    <a href="#cab_booking_frm" class="btn btn-primary mt-3">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Travel Tips and Safety Section -->
<section class="travel-tips bg-light pt-4 pb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="{{ asset('site/img/cab/cab2.jpg') }}" alt="Safe Travel in Andaman"
                    class="img-fluid rounded shadow">
            </div>
            <div class="col-md-8">
                <h2 class="section-title">Traveling Safely with<span class="text-gradient"> Andaman Bliss/span>
                </h2>
                <p>Your safety is paramount to us. We have set expectations around safety, we follow strict safety
                    procedures, including regular vehicle maintenance; ensuring drivers are trained and that they
                    follow
                    traffic rules. Our experienced and courteous drivers ensure you have a smooth and safe journey.
                </p>
                <div class="tips-list">
                    <div class="tip-item">
                        <i class="fas fa-tools"></i>
                        <span>24/7 Road Side Assistance</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-map"></i>
                        <span>Comprehensive and Local Navigation</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-car-side"></i>
                        <span>Clean and Sanitized Vehicles</span>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-language"></i>
                        <span>Multilingual Customer Support</span>
                    </div>
                </div>

                <a href="#contact" class="btn btn-primary mt-3">Contact Our Support</a>
            </div>
        </div>
    </div>
</section>


<!-- FAQ and Partners Section -->
<section class="faq-partners-section bg-light pt-4 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="section-header mb-4">
                    <h2 class="section-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
                    <p>Got questions? We've got answers. Find quick insights about our car rental service.</p>
                </div>
                <div class="faq-accordion">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    What types of cabs are available for rent in Andaman?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    In the Andaman Islands, you can rent various types of cabs, including sedans,
                                    SUVs
                                    and vans. Some services also offer luxury vehicles and minivans for larger
                                    groups.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Can I cancel my cab booking and what are the cancellation charges?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Cancellation policies vary among rental companies. Generally, there might be a
                                    small
                                    fee for cancellations made within a certain period before the booking date. Last
                                    minute cancellations could include higher charges.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Is it easy to find cabs at major tourist destinations in Andaman Islands?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, cabs are generally available at popular tourist spots. However, during peak
                                    seasons, it is advisable to pre-book your cab to avoid waiting times.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    Can I rent a cab for a few hours instead of a full day?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, many rental companies offer hourly rental options. However, minimum rental
                                    periods and rates may apply, so it’s best to check with the specific provider.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    How far in advance should I book a cab rental in Andaman?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    It is advisable to book your cab rental at least a few days in advance,
                                    especially
                                    during peak tourist seasons (December to February and May to June).
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                    aria-controls="collapseSix">
                                    Are there any hidden charges I should be aware of?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse"
                                aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    To avoid unexpected costs, read the rental agreement carefully. Look out for
                                    hidden
                                    charges such as service fees or additional driver fees.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 shadow-1 border shadow bg-white p-2">
                <div class="section-header text-center mb-4">
                    <h2 class="section-title mt-2">Get The <span class="text-gradient">Best Deals</h2>
                    <p>Book hassle-free cab services designed for your comfort and convenience.</p>
                </div>
                @include('common.bike-lead')
            </div>
        </div>
    </div>
</section>

<section class=" review-section mt-3 bg-white p-4 rounded">
    <div class="text-center">
        <h2 class="section-title">Real <span class="text-gradient">Experiences</span> from Real Travelers</h2>
        <p class="section-description">Discover why thousands of travelers choose our Andaman packages for their dream vacation</p>
    </div>
    <div class="container rev-container mt-3">
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
                    <div class="rev-bar">
                        <div style="width:95%"></div>
                    </div>
                    <span>{{ $rating[5] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>4 ★</span>
                    <div class="rev-bar">
                        <div style="width:30%"></div>
                    </div>
                    <span>{{ $rating[4] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>3 ★</span>
                    <div class="rev-bar">
                        <div style="width:3%"></div>
                    </div>
                    <span>{{ $rating[3] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>2 ★</span>
                    <div class="rev-bar">
                        <div style="width:2%"></div>
                    </div>
                    <span>{{ $rating[2] }}</span>
                </div>

                <div class="rev-rating-row">
                    <span>1 ★</span>
                    <div class="rev-bar">
                        <div style="width:4%"></div>
                    </div>
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
                <img src="{{ $first->image_url }}" class="rev-big-img" alt="review-image">
                <span class="rev-view-all"><i class="fa fa-camera"></i> View All ({{ $review_images->count() }})</span>
            </a>

            @foreach($review_images->skip(1)->take(6) as $img)
            <a href="{{ $img->image_url }}" data-lightbox="gallery">
                <img src="{{ $img->image_url }}" class="rev-small-img" alt="review-image">
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
            <img src="{{ $review['reviewer_profile_photo_url'] }}" alt="{{ Str::slug( $review['reviewer_name'] ) }}" class="rev-avatar">

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

</section>

@endif
@push('styles')
<style>
    .city-limit {
        font-size: 10px;
        text-align: end;
    }

    .filter-section {
        background: #fff;
        border-radius: 8px;
        padding: 1rem;
        border: 1px solid #d7d7d7;
        margin-bottom: 1rem;
    }

    .filter-section h5 {
        font-weight: 500;
        color: #1e293b;
        margin-bottom: 0.5rem;
        font-size: 16px;
    }

    .filter-section h6 {
        font-weight: 500;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
        font-size: 14px;
    }


    .cab-card {
        border: 1px solid #d7d7d7;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1rem;
        background: #fff;
    }

    .cab-card:hover {
        border: 1px solid rgb(255, 162, 0);
    }

    .cab-left {
        padding: 1rem;
        padding-bottom: 0px;
        border-right: 1px solid #d7d7d7;
    }

    .cab-footer {
        background: #c8ecf77d;

    }

    .cab-footer p {
        font-size: 12px !important;
        color: black;
    }

    .cab-image {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
    }

    .cab-header {
        margin-bottom: 0.75rem;

    }

    .cab-header h6 {
        font-weight: 500;
        color: #1e293b;
        margin-bottom: 0.25rem;
        align-items: center;
        font-size: 1rem;
        font-weight: bolder;
    }

    .cab-header h6 i {
        color: var(--primary-color);
        margin-right: 0.5rem;
        width: 16px;
    }

    .cab-header p {
        margin-bottom: 0;
        color: #0b0b0b;
        font-size: 12px !important;
    }

    .bg-orange {
        background-color: var(--secondary-color);
        color: white;
    }

    .cab-details-row {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 0.3rem;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        font-size: 10px;
        flex-direction: row;
        color: #0b0b0b;
        flex: 1;
        min-width: 140px;
    }

    .detail-item i {
        color: var(--success-color);
        margin-right: 0.5rem;
        width: 14px;
        margin-top: 1px;
        flex-shrink: 0;
    }

    .check-green .fas {
        color: var(--success-color);
    }

    .hand-icon .fas {
        color: var(--warning-color);
    }

    .cab-right {
        padding: 1rem;
        background: #ffffff;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        align-content: flex-end;
    }

    .price {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--success-color);
        margin-bottom: 0.75rem;
        text-align: center;
    }

    .book-btn {
        background: var(--primary-color);
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        color: white;
        font-weight: 500;
        width: 100%;
        font-size: 14px;
    }

    .book-btn:hover {
        background: #1d4ed8;
        color: white;
    }

    .sort-select {
        width: 180px;
        border-radius: 4px;
        border: 1px solid #d7d7d7;
        font-weight: 500;
        font-size: 14px;
    }

    .h5 {
        font-weight: 500;
        color: #1e293b;
        font-size: 18px;
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .form-range::-webkit-slider-thumb {
        background: var(--primary-color);
    }

    .footer-helpline {
        background: #fff;
        color: var(--secondary-color);
        text-align: center;
        padding: 0.75rem;
        border-top: 1px solid #d7d7d7;
        font-size: 14px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .search-section {
            padding: 1rem 0;
        }

        .cab-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: end;
        }

        .search-card {
            padding: 0.75rem;
        }

        .cab-left,
        .cab-right {
            border-right: none;
            border-bottom: 1px solid #efe8e8;
            padding: 0.75rem;
        }

        .cab-right {
            border-bottom: none;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .cab-details-row {
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-item {
            min-width: auto;
        }

        .price {
            font-size: 1.25rem;
        }
    }

    .testimonials-section {
        padding: 35px 0;
        position: relative;
        background-color: white;
        overflow: hidden;
    }

    .testimonial-slider-container {
        position: relative;
        overflow: hidden;
        margin-bottom: 5px;
        z-index: 2;
        width: 100%;
    }

    .testimonial-slider {
        display: flex;
        transition: transform 0.5s ease;
        width: 100%;
    }

    .testimonial-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        height: 100%;
        flex: 0 0 calc(33.333% - 20px);
        margin: 0 10px;
        max-width: calc(33.333% - 20px);
    }

    .testimonial-card-inner {
        padding: 30px 25px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.1);
    }

    .testimonial-card.active-card {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(17, 157, 213, 0.15);
        border-bottom: 3px solid #119dd5;
    }

    .testimonial-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .testimonial-quote {
        font-size: 36px;
        color: rgba(17, 157, 213, 0.2);
    }

    .testimonial-content {
        flex: 1;
        margin-bottom: 20px;
    }

    .testimonial-rating {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .testimonial-rating i {
        color: #FFD700;
        margin-right: 3px;
    }

    .testimonial-rating span {
        margin-left: 8px;
        font-weight: 600;
        color: var(--color-text-light);
    }

    .testimonial-text {
        font-size: 1.05rem;
        line-height: 1.7;
        color: var(--color-text);
        font-style: italic;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        margin-top: auto;
    }

    .author-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
        border: 3px solid rgba(17, 157, 213, 0.1);
    }

    .author-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 5px;
    }

    .author-trip {
        font-size: 0.9rem;
        color: var(--color-text-light);
        margin: 0;
    }

    .testimonial-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .control-prev,
    .control-next {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .control-prev:hover,
    .control-next:hover {
        background: var(--color-primary-gradient);
        transform: translateY(-3px);
    }

    .control-prev:hover i,
    .control-next:hover i {
        color: white;
    }

    .control-prev i,
    .control-next i {
        color: var(--color-primary);
        font-size: 14px;
    }

    .control-dots {
        display: flex;
        gap: 8px;
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        background: var(--color-primary);
        transform: scale(1.2);
    }

    .section-shape-3 {
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.03);
        bottom: -150px;
        left: -150px;
        z-index: 1;
    }

    @media (max-width: 992px) {
        .testimonials-section {
            padding: 80px 0;
        }

        .testimonial-card {
            flex: 0 0 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 768px) {
        .testimonials-section {
            padding: 60px 0;
        }

        .testimonial-slider-container {
            padding: 0 15px;
        }

        .testimonial-card {
            flex: 0 0 calc(100% - 30px);
            max-width: calc(100% - 30px);
            margin: 0 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .testimonial-card-inner {
            padding: 25px 20px;
        }

        .testimonial-text {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .testimonial-quote {
            font-size: 30px;
            top: 15px;
            right: 15px;
        }

        .testimonial-rating {
            margin-bottom: 15px;
        }

        .author-image {
            width: 50px;
            height: 50px;
        }

        .author-name {
            font-size: 1rem;
        }

        .author-trip {
            font-size: 0.8rem;
        }

        .testimonial-controls {
            margin-top: 25px;
        }

        .control-prev,
        .control-next {
            width: 36px;
            height: 36px;
        }

        /* Special styling for active card on mobile */
        .testimonial-card.active-card {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(17, 157, 213, 0.2);
            border-bottom: 3px solid #119dd5;
        }

        .testimonial-card.active-card .testimonial-card-inner {
            background: linear-gradient(to bottom, white, rgba(17, 157, 213, 0.03));
        }

        /* Add pagination indicator for mobile */
        .testimonial-pagination-indicator {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
    }
</style>
@endpush
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cabPricesObj = @json($cabPrices); // your object
        const cabPrices = Object.values(cabPricesObj); // convert to array
        const hasCabPrices = cabPrices.length > 0;

        const footer = document.getElementById('footers');
        if (!footer) return;

        footer.style.display = hasCabPrices ? 'none' : 'block';
    });

    document.querySelectorAll(
        '.filter-category, .filter-ac, .filter-driver, #priceRange'
    ).forEach(el => {
        el.addEventListener('change', applyFilters);
    });

    function applyFilters() {

        let categories = [...document.querySelectorAll('.filter-category:checked')]
            .map(el => el.value);

        let acTypes = [...document.querySelectorAll('.filter-ac:checked')]
            .map(el => el.value);

        let driver = document.querySelector('.filter-driver:checked')?.value;
        let maxPrice = document.getElementById('priceRange').value;

        document.querySelectorAll('.cab-card').forEach(card => {

            let matchCategory = !categories.length || categories.includes(card.dataset.category);
            let matchAc = !acTypes.length || acTypes.includes(card.dataset.ac);
            let matchDriver = !driver || card.dataset.driver === driver;
            let matchPrice = parseInt(card.dataset.price) <= parseInt(maxPrice);

            card.style.display = (
                matchCategory && matchAc && matchDriver && matchPrice
            ) ? 'block' : 'none';
        });
    }
</script>
@endpush


@endsection