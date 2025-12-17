@extends('layouts.app')
@section('title', 'Underwater Scooter in Andaman|Book Your Sea Adventure')
@section('keywords', 'underwater scooter in Andaman, Andaman scooter diving, scuba scooter, Andaman underwater
adventure, marine life Andaman, Havelock scooter, North Bay scooter, Port Blair scooter, Andaman Bliss')
@section('description', 'Experience underwater scooter rides in Andaman. Safe, guided tours in Havelock and North Bay.
Perfect for families and adventure seekers. Book now!')
@section('meta_schema')

{
"@context": "https://schema.org",
"@type": "TouristTrip",
"name": "Underwater Scooter in Andaman|Book Your Sea Adventure",
"description": "Experience underwater scooter rides in Andaman. Safe, guided tours in Havelock and North Bay. Perfect
for families and adventure seekers. Book now!",
"touristType": "Adventure, Family, Couples",
"itinerary": {
"@type": "ItemList",
"numberOfItems": 2,
"itemListElement": [
{
"@type": "ListItem",
"position": 1,
"item": {
"@type": "Place",
"name": "Havelock Island",
"description": "Enjoy an underwater scooter adventure in Havelock. Discover vibrant coral reefs and marine life with
expert guides. Suitable for all ages. Reserve today!"
}
},
{
"@type": "ListItem",
"position": 2,
"item": {
"@type": "Place",
"name": "North Bay, Port Blair",
"description": "Try underwater scooter tours at North Bay, Port Blair. Safe, exciting, and family-friendly way to
explore the sea. Book your North Bay ride now!."
}
}
]
},
"provider": {
"@type": "TravelAgency",
"name": "Andaman Bliss Pvt Ltd",
"url": "https://www.andamanbliss.com",
"telephone": ["+91-8900909900", "+91-9933202248"]
},
"offers": {
"@type": "Offer",
"priceCurrency": "INR",
"price": "4800",
"priceSpecification": {
"@type": "UnitPriceSpecification",
"priceCurrency": "INR",
"price": "4800",
"unitText": "per person"
},
"availability": "https://schema.org/InStock",
"url": "https://andamanbliss.com/water-sports/submersible-scooter"
}
}

@endsection
@section('og_title',@$tour->og_title)
@section('og_description', @$tour->og_description)
@section('og_type', @$tour->og_type)
@section('og_image', @$tour->og_image)
@section('twitter_card', @$tour->twitter_card)
@section('twitter_title', @$tour->twitter_title)
@section('twitter_desc', @$tour->twitter_desc)
@section('twitter_image', @$tour->twitter_image)

@section('content')

<section class="hero-section position-relative overflow-hidden">
    <div class="container position-relative z-2">
        <div class="row min-vh-100 align-items-center py-5 mt-5">
            <div class="col-lg-6 text-white">
                <span class="badge bg-gradient-orange mb-3 px-3 py-2 rounded-pill">Featured Activity</span>
                <h1 class="display-4 fw-bold mb-4 text-white">Discover India's First Underwater Scooter In Andaman</h1>
                <p class="lead mb-4 opacity-90" style="text-align:justify">Experience the India's first Underwater
                    Scooter Ride In Andaman, Elephant Beach and North Bay, Explore the aquatic world with this thrilling
                    activity. Book today with Andaman Bliss</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#diving-options"
                        class="btn btn-lg btn-gradient-orange rounded-pill px-4 py-3 text-white">View Diving Spots</a>
                    <a href="#contact" class="btn btn-lg btn-outline-light rounded-pill px-4 py-3">Contact Us</a>
                </div>
                <div class="mt-4 d-flex gap-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-star text-warning me-2"></i>
                        <span>4.9/5 Rating</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users text-warning me-2"></i>
                        <span>1000+ Happy Divers</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 position-relative mt-5 mt-lg-0">
                <div class="hero-image-grid">
                    <img src="{{ asset('site/img/water-activity/underwater-scooter/underwater-scooter-3.jpg')}}" alt="Underwater Scooter"
                        class="img-1 rounded-4 shadow-lg">
                    <img src="{{ asset('site/img/water-activity/underwater-scooter/underwater-scooter-In-Andaman.jpg')}}"
                        alt="Underwater Scooter In Andaman" class="img-2 rounded-4 shadow-lg">

                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="tour-andamanbliss-section mt-3">
            <h2 class="tour-andamanbliss-title">Underwater Scooter In Andaman| <span>Get Up To 10% Off </span></h2>
            <p class="tour-andamanbliss-text">
                Are you someone looking to have some different and amazing activity? Look no further Andaman Bliss
                brings you a new and exciting way to explore the Andaman Islands marine life
                <a href="#" class="tour-andamanbliss-read-more" data-bs-toggle="modal"
                    data-bs-target="#andamanblissModal">Read More</a>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <span class="badge bg-gradient-orange mb-3 px-3 py-2 rounded-pill">Experience the Underwater
                        World</span>
                    <h2 class="fs-1 mb-4 section-title">Key Highlights of <span class="text-gradient">Underwater Scooter
                            Adventure</span></h2>
                    <p class="lead text-muted">Discover an unforgettable underwater journey in the pristine waters of
                        Andaman</p>
                </div>

                <div class="highlights-grid">
                    <!-- Experience Card -->
                    <article class="highlight-card experience-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-water fa-2x text-primary"></i>
                        </div>
                        <h3 class="card-title">Adventure Experience</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i>20-30 minutes underwater journey</li>
                            <li><i class="fas fa-check-circle"></i>Crystal clear water visibility</li>
                            <li><i class="fas fa-check-circle"></i>Professional guide assistance</li>
                            <li><i class="fas fa-check-circle"></i>Safe for non-swimmers</li>
                        </ul>
                        <div class="card-overlay"></div>
                    </article>

                    <!-- Locations Card -->
                    <article class="highlight-card locations-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                        </div>
                        <h3 class="card-title">Prime Locations</h3>
                        <div class="location-badges">
                            <span class="location-badge">
                                <i class="fas fa-compass"></i>
                                North Bay (Port Blair)
                            </span>
                            <span class="location-badge">
                                <i class="fas fa-compass"></i>
                                Elephant Beach (Havelock)
                            </span>
                        </div>
                        <p class="mt-3">Experience the best diving spots in Andaman Islands</p>
                        <div class="card-overlay"></div>
                    </article>

                    <!-- Requirements Card -->
                    <article class="highlight-card requirements-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-clipboard-check fa-2x text-success"></i>
                        </div>
                        <h3 class="card-title">Requirements</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-user"></i>Age: 12-45 years</li>
                            <li><i class="fas fa-heartbeat"></i>Good physical condition</li>
                            <li><i class="fas fa-swimming-pool"></i>No swimming skills needed</li>
                            <li><i class="fas fa-id-card"></i>Valid ID proof required</li>
                        </ul>
                        <div class="card-overlay"></div>
                    </article>

                    <!-- Inclusions Card
                    <article class="highlight-card inclusions-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-gift fa-2x text-warning"></i>
                        </div>
                        <h3 class="card-title">Package Inclusions</h3>
                        <ul class="feature-list">
                            <li><i class="fas fa-camera"></i>Free photo & video package</li>
                            <li><i class="fas fa-helmet-safety"></i>Safety equipment provided</li>
                            <li><i class="fas fa-ship"></i>Boat transfers included</li>
                            <li><i class="fas fa-life-ring"></i>Insurance coverage</li>
                        </ul>
                        <div class="card-overlay"></div>
                    </article> -->
                </div>

                <!-- Price Section -->
                <div class="price-banner mt-4">
                    <div class="price-content">
                        <div class="price-badge">Special Offer</div>
                        <div class="price-amount">
                            <span class="currency">₹</span>
                            <span class="amount">4,800</span>
                            <span class="per">/person</span>
                        </div>
                        <p class="price-note">Book now and get complimentary underwater photos worth ₹1,000!</p>
                        <a href="#" class="btn btn-light btn-lg rounded-pill px-4 py-2 mt-3" data-bs-toggle="modal"
                            data-bs-target="#bookingModal">
                            <i class="fas fa-calendar-check me-2"></i>Book Your Adventure
                        </a>
                    </div>
                </div>

                <style>
                .highlights-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                    gap: 1.5rem;
                    margin-bottom: 2rem;
                }

                .highlight-card {
                    background: rgba(255, 255, 255, 0.9);
                    backdrop-filter: blur(10px);
                    border-radius: 20px;
                    padding: 2rem;
                    position: relative;
                    overflow: hidden;
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                    transition: all 0.3s ease;
                }

                .highlight-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
                }

                .icon-wrapper {
                    width: 60px;
                    height: 60px;
                    border-radius: 15px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(145deg, #f8f9fa, #ffffff);
                    box-shadow: 5px 5px 10px #e8e9ea, -5px -5px 10px #ffffff;
                    margin-bottom: 1.5rem;
                }

                .card-title {
                    font-size: 1.25rem;
                    font-weight: 600;
                    margin-bottom: 1.5rem;
                    color: #2d3436;
                }

                .feature-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .feature-list li {
                    display: flex;
                    align-items: center;
                    margin-bottom: 1rem;
                    color: #636e72;
                }

                .feature-list li i {
                    margin-right: 10px;
                    color: #FF5722;
                }

                .location-badges {
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }

                .location-badge {
                    background: rgb(99 220 241 / 10%);
                    color: #03A9F4;
                    padding: 0.5rem 1rem;
                    border-radius: 50px;
                    font-size: 0.9rem;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }

                .price-banner {
                    background: linear-gradient(135deg, #03A9F4, #00BCD4);
                    border-radius: 20px;
                    padding: 2rem;
                    text-align: center;
                    color: white;
                    position: relative;
                    overflow: hidden;
                }

                .price-banner::before,
                .price-banner::after {
                    content: '';
                    position: absolute;
                    border-radius: 50%;
                    z-index: 0;
                    animation: pulse 3s ease-in-out infinite;
                }

                .price-banner::before {
                    width: 150px;
                    height: 150px;
                    background: rgba(255, 255, 255, 0.25);
                    top: -75px;
                    right: -75px;
                }

                .price-banner::after {
                    width: 200px;
                    height: 200px;
                    background: rgba(255, 255, 255, 0.2);
                    bottom: -100px;
                    left: -100px;
                }

                @keyframes pulse {
                    0% {
                        transform: scale(1);
                        opacity: 0.8;
                    }

                    50% {
                        transform: scale(1.1);
                        opacity: 0.6;
                    }

                    100% {
                        transform: scale(1);
                        opacity: 0.8;
                    }
                }

                .price-badge {
                    background: rgba(255, 255, 255, 0.2);
                    padding: 0.5rem 1.5rem;
                    border-radius: 50px;
                    display: inline-block;
                    margin-bottom: 1rem;
                    font-weight: 500;
                }

                .price-amount {
                    font-size: 3rem;
                    font-weight: 700;
                    line-height: 1;
                    margin-bottom: 1rem;
                }

                .price-amount .amount {
                    margin-right: 0.25rem;
                    color: #fff;
                }

                .price-amount .currency {
                    font-size: 1.5rem;
                    vertical-align: super;
                    color: #fff;
                }

                .price-amount .per {
                    font-size: 1rem;
                    opacity: 0.8;
                    text-align: center;
                    color: #fff;
                }

                .price-note {
                    opacity: 0.9;
                    margin-bottom: 1.5rem;
                    text-align: center;
                }

                @media (max-width: 768px) {
                    .highlights-grid {
                        grid-template-columns: 1fr;
                    }
                }
                </style>
            </div>
        </div>
    </div>
</section>


<!-- Diving Spots Section -->
<section class="py-5" id="diving-options">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5 destination-header">
                    <span class="badge bg-gradient-orange mb-3 px-3 py-2 rounded-pill">Premium Diving Spots</span>
                    <h2 class="fs-1 section-title mb-4 fade-in">Discover Our <span class="text-gradient">Exclusive
                            Locations</span></h2>
                    <p class="lead text-muted">Explore the underwater paradise at our handpicked diving destinations</p>
                </div>

                <div class="destinations-grid">
                    <!-- Havelock Island Card -->
                    <div class="destination-card">
                        <div class="destination-image">
                            <img src="{{ asset('site/img/water-activity/underwater-scooter-3.jpg')}}"
                                alt="Havelock Island Diving">
                            <div class="destination-overlay">
                                <div class="destination-content">
                                    <h3 class="text-white">Havelock Island</h3>
                                    <div class="destination-specs">
                                        <span><i class="fas fa-water"></i> Depth: 6m-12m</span>
                                        <span><i class="fas fa-eye"></i> Visibility: 20-40m</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="destination-details">
                            <div class="destination-features">
                                <span class="feature-tag"><i class="fas fa-fish"></i> Coral Reefs</span>
                                <span class="feature-tag"><i class="fas fa-shark"></i> Marine Life</span>
                                <span class="feature-tag"><i class="fas fa-camera"></i> Perfect for Photos</span>
                            </div>
                            <p class="destination-description">Experience crystal clear waters and encounter diverse
                                marine life including manta rays and reef sharks in this tropical paradise.</p>
                            <a href="https://andamanbliss.com/water-sports/submersible-scooter/submersible-scooter-in-havelock"
                                class="btn-explore">
                                Explore Location
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- North Bay Card -->
                    <div class="destination-card">
                        <div class="destination-image">
                            <img src="{{ asset('site/img/water-activity/underwater-scooter-4.jpg')}}"
                                alt="North Bay Diving">
                            <div class="destination-overlay">
                                <div class="destination-content">
                                    <h3 class="text-white">North Bay</h3>
                                    <div class="destination-specs">
                                        <span><i class="fas fa-water"></i> Depth: 3m-12m</span>
                                        <span><i class="fas fa-eye"></i> Visibility: 10-25m</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="destination-details">
                            <div class="destination-features">
                                <span class="feature-tag"><i class="fas fa-star"></i> Beginner Friendly</span>
                                <span class="feature-tag"><i class="fas fa-clock"></i> Quick Access</span>
                                <span class="feature-tag"><i class="fas fa-sun"></i> Clear Waters</span>
                            </div>
                            <p class="destination-description">Perfect for beginners with shallow reefs and colorful
                                marine life, just minutes away from Port Blair.</p>
                            <a href="https://andamanbliss.com/water-sports/submersible-scooter/submersible-scooter-in-north-bay"
                                class="btn-explore">
                                Explore Location
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .bg-gradient-ocean {
        background: linear-gradient(135deg, #00BCD4, #2196F3);
        color: white;
    }

    .text-gradient-ocean {
        background: linear-gradient(135deg, #00BCD4, #2196F3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .destination-header {
        margin-bottom: 4rem;
    }

    .destinations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .destination-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .destination-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .destination-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }

    .destination-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .destination-card:hover .destination-image img {
        transform: scale(1.1);
    }

    .destination-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        padding: 2rem;
        color: white;
    }

    .destination-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .destination-specs {
        display: flex;
        gap: 1rem;
        font-size: 0.9rem;
    }

    .destination-specs span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .destination-details {
        padding: 2rem;
    }

    .destination-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .feature-tag {
        background: rgba(0, 188, 212, 0.1);
        color: #00BCD4;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .destination-description {
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .btn-explore {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #00BCD4, #2196F3);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-explore:hover {
        background: linear-gradient(135deg, #2196F3, #00BCD4);
        transform: translateX(5px);
        color: white;
    }

    .fade-in {
        animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .destinations-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <span class="badge bg-gradient-orange mb-3 px-3 py-2 rounded-pill">Diver Testimonials</span>
                    <h2 class="fs-1 section-title mb-4">What Our <span class="text-gradient">Divers Say</span></h2>
                    <p class="lead text-muted">Read about the experiences of those who've explored the underwater
                        wonders of Andaman with us</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="text-warning me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-muted">5.0</span>
                                </div>
                                <p class="mb-3">"An incredible experience! The instructors were professional and made me
                                    feel completely safe despite it being my first time diving. The underwater world of
                                    Andaman is breathtaking."</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80"
                                            alt="Sarah M." class="rounded-circle" width="50" height="50">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Priya S.</h6>
                                        <p class="small text-muted mb-0">Dived in Havelock, April 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="text-warning me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-muted">5.0</span>
                                </div>
                                <p class="mb-3">"As an experienced diver, I was blown away by the diversity of marine
                                    life in Andaman. The dive sites were pristine, and the team's knowledge of local
                                    ecosystems was impressive."</p>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=150&q=80"
                                            alt="John D." class="rounded-circle" width="50" height="50">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Rohit M.</h6>
                                        <p class="small text-muted mb-0">Dived in Neil Island, May 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <span class="badge bg-gradient-orange mb-3 px-3 py-2 rounded-pill">Common Questions</span>
                    <h2 class="fs-1 section-title mb-4">Frequently Asked <span class="text-gradient">Questions</span>
                    </h2>
                    <p class="lead text-muted">Everything you need to know about Underwater scooter in Andaman</p>
                </div>
                <div class="accordion" id="seaWalkingFAQ">
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq1">
                                Is Underwater scooter safe for non-swimmers?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#seaWalkingFAQ">
                            <div class="accordion-body">
                                Absolutely! Non-swimmers can enjoy Underwater Scooter because it is designed to be safe.
                                The helmet allows you to breathe normally, and qualified advisors are always present to
                                assist you.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq2">
                                What should I wear for Underwater Scooter Activity?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#seaWalkingFAQ">
                            <div class="accordion-body">
                                Dress comfortably in swimsuits or lightweight clothing. Avoid carrying any unprotected
                                objects that may become misplaced underwater.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq3">
                                How long does the Underwater Scooter experience last?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#seaWalkingFAQ">
                            <div class="accordion-body">
                                The Underwater Scooter experience lasts approximately 20 to 30 minutes, but the complete
                                experience, including the introduction and preparation, takes around an hour.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq4">
                                Can children participate in Underwater Scooter?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#seaWalkingFAQ">
                            <div class="accordion-body">
                                Children over the age of ten can join as long as they feel comfortable and understand
                                the instructions.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq5">
                                Are there any medical restrictions?
                            </button>
                        </h3>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#seaWalkingFAQ">
                            <div class="accordion-body">
                                People with heart issues, severe asthma, or other serious medical conditions must
                                consult a physician before participating.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq6">
                                How do I book a Underwater Scooter Activity?
                        </h3>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#seaWalkingFAQ">
                            <div class="accordion-body">
                                You can make reservations instantly through our website or contact our support team for
                                further information.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CTA Section -->
<section class="py-5" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6 bg-gradient-primary text-white d-flex align-items-center">
                            <div class="p-5">
                                <h2 class="h1 mb-4">Ready to Experience the Underwater World?</h2>
                                <p class="lead mb-4">Book your Underwater Scooter adventure today and explore the
                                    vibrant marine life in Andaman.</p>
                                <ul class="list-unstyled mb-5">
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fas fa-check-circle me-3"></i>
                                        <span>Safety first with qualified guides</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="fas fa-check-circle me-3"></i>
                                        <span>No swimming required, perfect for everyone</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="fas fa-check-circle me-3"></i>
                                        <span>Explore Andaman's underwater beauty up close</span>
                                    </li>
                                </ul>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone-alt me-2"></i>
                                    <span>Call us: <a href="tel:099332 02248" class="text-white fw-bold">+91 99332
                                            02248</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-5">
                                <h3 class="h4 mb-4">Enquire Now</h3>
                                <form method="POST" action="{{ url('activity-enquiry') }}" id="bookingForm">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="customer_name"
                                            placeholder="Your Name" required>
                                    </div>
                                    <input type="text" name="url" class="d-none" value="{{ url()->current() }}" hidden>
                                    <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                        autocomplete="off">

                                    <input type="hidden" name="activity_name" value="{{ @$activity->name }}">
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="emailAddress"
                                            placeholder="Email Address" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control" name="phoneNumber"
                                            placeholder="Phone Number" required min="10" max="15">
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="activity_location" aria-label="Select Underwater Scooter Ride Location" required>
                                            <option selected>Select Underwater Scooter Ride Location</option>
                                            <option>Havelock Island</option>
                                            <option>North Bay</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" name="message" rows="3"
                                            placeholder="Your Message"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-gradient-orange rounded-pill px-4 py-2 text-white w-100">Send
                                        Enquiry</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row mt-5">
            <div>
                <h2 class="fs-4 fw-bold similarHotelslide section-title">Similar <span
                        class="text-gradient">Activities</span> </h2>
            </div>
            <div id="carouselExampleControls" class="carousel mt-3">
                <div class="carousel-inner">
                    @if (@$activities)
                    @foreach (@$activities as $key => $activity)
                    <div class="carousel-item @if ($key == 0) active @endif">
                        <div class="card p-2 border-0">
                            <div class="img-wrapper">
                                <img src="{{ @$activity->activityPhotos[0]->file }}" class="img-fluid rounded"
                                    alt="{{ __(@$activity->name) }}">
                            </div>
                            <div class="card-body">
                                <h2 class="card-text p-0 text-uppercase fs-6">
                                    <a
                                        href="{{ url('water-sports/' . @$activity->category->slug . '/' . @$activity->slug) }}">
                                        {{ __(@$activity->name) }}
                                    </a>
                                </h2>
                                <h2 class="fs-6">

                                    <span class="reviewCount">({{ @$activity->reviews_count }}) reviews</span>
                                </h2>
                                <ul class="d-flex justify-content-between">
                                    <li class="location-hotel">
                                        <i class="fa-solid fa-location-dot"></i>
                                        {{ __(@$activity->address) }}
                                    </li>
                                </ul>
                                <ul class="d-flex justify-content-between pt-2 priceTag">
                                    <li><i class="fa-regular fa-circle-check"></i> Price start form </li>
                                    <li class="fw-bold packageStart">₹ {{ number_format(@$activity->adult_price, 2)
                                        }}/PP</li>
                                </ul>
                                <div class="text-start mt-3">
                                    <a href="{{ url('water-sports/' . @$activity->category->slug . '/' . @$activity->slug) }}"
                                        class="bookHotelbtn ferry-inquiry-btn">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="andamanblissModal" tabindex="-1" aria-labelledby="andamanblissModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable tour-andamanbliss-modal modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="andamanblissModalLabel">Underwater Scooter In Andaman| Get Up To 10% Off
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- modal start--->
            <div class="modal-body p-0">
                <div class="tour-andamanbliss-packages m-0">
                    <div class="tour-andamanbliss-packages-header">
                        <h3>Activity</h3>
                        <div class="duration-price">
                            <div class="col">Duration</div>
                            <div class="col">Price </div>
                        </div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="https://andamanbliss.com/andaman-tour-packages/honeymoon">Submersible Scooter In
                                North Bay</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">1.5 Hours</div>
                        <div class="tour-andamanbliss-package-price">INR 4,800 ~PP</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="https://andamanbliss.com/andaman-tour-packages/family">Submersible Scooter In
                                Havelock</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">1.5 Hours</div>
                        <div class="tour-andamanbliss-package-price">INR 4,800 ~PP</div>
                    </div>

                    <div class="tour-andamanbliss-package-item">
                        <span class="text-danger" style="font-size:10px;">Note: These prices might vary according to
                            season.</span>
                    </div>
                </div>

                <div class="tour-andamanbliss-description" style="text-align:justify">

                    <p>Are you someone looking to have some different and amazing activity? Look no further <a
                            href="https://andamanbliss.com" target="_blank" rel="noopener noreferrer">Andaman Bliss</a>
                        brings you a new and exciting way to explore the Andaman Islands marine life, Introducing
                        <strong>Underwater Scooter In Andaman Islands </strong>also called <strong>Submersible
                            Scooter</strong> India’s first underwater scooter activity. It is truly a new and exciting
                        way to explore the underwater’s of the Islands. Underwater Scooter In Andaman lets you glide
                        through the waters and see the vibrant corals and marine life up close. Have the ultimate
                        experience of a lifetime by participating in this activity. Underwater Scooter In Andaman is a
                        unique activity that lets you explore the waters with no prior diving experience.
                    </p>

                    <p class="mt-3">The Andaman Islands does offer a wide range of thrilling and exciting water
                        activities for you to take part in, that also includes Underwater Scooter as well. Andaman
                        Islands is precisely known for its stunning beaches and blue crystal clear waters, which makes
                        it a perfect destination for people who want to take part in <a
                            href="https://andamanbliss.com/water-sports" target="_blank" rel="noopener noreferrer">water
                            activities</a>. The Underwater Scooter is a unique experience that involves riding a
                        specially designed scooter that allows you to explore the underwater world of the Andaman
                        Islands without any need for Scuba Diving equipment. The scooter is very easy to operate, you
                        can also participate in various other activities like <a
                            href="https://andamanbliss.com/water-sports/scuba-diving" target="_blank"
                            rel="noopener noreferrer">Scuba Diving</a>,<a
                            href="https://andamanbliss.com/water-sports/parasailing" target="_blank"
                            rel="noopener noreferrer">Parasailing</a>, <a
                            href="https://andamanbliss.com/water-sports/sea-walk" target="_blank"
                            rel="noopener noreferrer">Sea Walk</a> etc, to make this experience even more enjoyable.</p>

                    <p class="mt-3">
                        Now the real question is why to choose this activity over other water activities?, and we are
                        going to tell you just why. Well the one thing is, it’s easy to use, safe for beginners and it
                        certainly does not require swimming or any diving skills. Whether you are travelling alone, with
                        family or friends, this <strong>Family-Friendly Underwater Scooter Ride</strong> is definitely a
                        great choice for you. With Andaman Bliss on your side you will be able to participate in this
                        Underwater Scooter Activity and have an amazing experience. Do check out the <a
                            href="https://www.andamantourism.gov.in/admin-pannel/docfile/22-guidelines.pdf"
                            target="_blank" rel="noopener noreferrer">guidelines</a> for Underwater Scooter.
                    </p>
                    <div>
                        <h2 class="fs-6 fw-bold">How Does Underwater Scooter Works</h2>
                        <p>The <strong>Underwater Scooter In Andaman</strong> or (Submersible Scooter Ride) is a small
                            battery powered device that lets you ride underwater. It is really simple to operate, you
                            just have to sit up right and steer. The scooter comes with a special oxygenated dome shaped
                            helmet that lets you breathe underwater normally. It is a simple setup and you do not have
                            to worry about any complicated gear. This makes it different from any other activity such as
                            Scuba and Snorkeling.</p>
                        <div>
                            <ul class="under-wtr-itm">

                                <li style="disc">
                                    The scooters are guided by professionals and each piece is maintained as per the
                                    standards of Underwater Scooter Equipment and Maintenance.
                                </li>
                                <li>These scooters are designed by keeping safety in mind, to have a safe underwater
                                    scooter ride in Andaman.</li>
                                <li>You will stay at a safe depth which is usually 7-8 feet underwater, you can enjoy
                                    the view without getting completely wet.</li>
                                <li>
                                    The maintenance of this underwater scooter is handled by experts, so you can just
                                    relax and enjoy.
                                </li>
                            </ul>
                            <p><strong>Note:</strong>This activity depends on clear visibility and calm weather, please
                                check the weather condition before participating in the activity.</p>
                        </div>
                    </div>

                    <div>
                        <h2 class="fs-6 fw-bold">Best Known Locations for Underwater Scooters in Andaman</h2>
                        <p>Now as you know <strong>Underwater Scooter Activity </strong>is introduced in India for the
                            first time, and the Andaman Islands does have few destinations where you can take part in
                            this activity. Here are the best spots:</p>
                        <p class="mt-2">
                            <strong>Havelock Island:</strong> Havelock is known for its stunning beaches and coral
                            reefs, an <strong>underwater scooter ride in Havelock</strong> is a must-do. The calm and
                            peaceful waters of the <a
                                href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach"
                                target="_blank" rel="noopener noreferrer">Elephant Beach</a> are perfect for exploring
                            the vibrant coral reef and colorful fishes with an underwater scooter. Explore the
                            underwater with <strong>Underwater Scooter In Elephant Beach</strong>.
                        </p>
                        <p><strong>North Bay Island:</strong> North Bay Island is located close to the capital, Port
                            Blair offers vibrant marine life and easy access. Take part in <strong>underwater scooter
                                ride in North Bay</strong> and have a wonderful time discovering the underwater marine
                            life. It’s ideal for a quick adventure. Check out the newly launched activity</p>

                        <p class="mt-2">
                            Both locations feature guided underwater scooter activity, making them part of one of the
                            best <strong>water activity in Andaman</strong>. Take part in <strong>Underwater Scooter
                                Ride In Andaman</strong> and have a amazing time.

                        </p>
                    </div>
                    <div>
                        <h2 class="fs-6 fw-bold mt-3">Benefits of Underwater Scooter Adventure</h2>
                        <p>What makes an <strong>underwater scooter in Andaman </strong>so special? Check out these
                            benefits:</p>
                        <ul class="under-wtr-itm">
                            <li>
                                <strong>Increased Range:</strong> Move farther and do see more of the ocean than any
                                other activity.
                            </li>
                            <li>
                                <strong> Extended Dive Time:</strong> You get to stay underwater longer without getting
                                tired
                            </li>
                            <li>
                                <strong>Access Challenging Environments:</strong> Reach hidden reefs and spots with
                                ease.
                            </li>
                            <li>
                                <strong>Photography:</strong> Get complementary Photoshoot and video shoot of fish and
                                corals with underwater scooter Ride In Andaman.
                            </li>
                            <li>
                                <strong>Fun Factor:</strong> This activity is suitable for people of all ages, and have
                                a thrilling adventure.
                            </li>
                        </ul>
                        <p class="mt-2">
                            This safe <strong>underwater scooter in Andaman</strong> experience is perfect for families,
                            making it a top pick for a family underwater scooter adventure in Andaman.
                        </p>
                    </div>
                    <div>
                        <h2 class="fs-6 fw-bold mt-3">Safety and Guidelines For Underwater Scooter In Andaman</h2>
                        <p class="mt-2">
                            At Andaman Bliss, we follow strict regulations and safety when it comes to water activities,
                            these guidelines are followed to keep you safe. Here’s what you need to know:</p>
                        <ul class="under-wtr-itm">
                            <li>Minimum age must be 10 or older.</li>
                            <li>Not suitable for pregnant women.</li>
                            <li>This activity is not suitable for those with lung conditions.</li>
                            <li>Travelers with heart and cardiovascular issues are not permitted to take part in this
                                activity.</li>
                            <li>Guests who are claustrophobic are not permitted to take part in this activity.</li>
                            <li>We only let you participate in this activity when the water is clear for the best views.
                            </li>
                            <li>This activity is depended on weather condition, so if it’s rainy or windy there is a
                                huge possibility that it might get cancelled</li>
                            <li>Our guides are well trained, and always ready to face any kind of situation.</li>
                        </ul>
                        <p class="mt-2">Before you start, you will get a complete briefing with Andaman underwater
                            scooter safety tips. Our eco-friendly underwater scooter tours also ensure we protect the
                            ocean while you explore.</p>
                    </div>
                    <div>
                        <h2 class="fs-6 mt-2">
                            Basic Information About Underwater Scooter In Andaman
                        </h2>
                        <h3 class="fs-6 mt-2"><em>What Underwater Scooter is?</em></h3>
                        <p class="mt-2">An underwater scooter is a fun activity to take part in that lets you explore
                            underwater without swimming. You ride it like a scooter, and a helmet keeps your head dry
                            while you breathe normally.</p>
                        <h3 class="fs-6 mt-2"><em>How to Use Underwater Scooter</em></h3>
                        <p class="mt-2">It’s super easy to use. After a quick lesson, you will be able to ride it
                            without any complication, not a problem if something gets out of hand, Guides stay with you
                            to help out.
                        </p>
                        <ul class="under-wtr-itm">
                            <li>Sit on the scooter platform with your head placed inside the dome helmet.</li>
                            <li>You just hold the handlebar and enjoy the ride while the guide manages the direction and
                                speed.</li>
                            <li>No prior swimming or diving skill is required.</li>
                        </ul>
                        <h3 class="fs-6 mt-2"><em>How Does The Underwater Scooter Work?</em></h3>
                        <p class="mt-2">The Underwater Scooter runs is battery operated and it moves at a gentle speed
                            of 3 to 4km/hr. The Underwater Scooter is designed in such a way that even a beginner can
                            take part in it, so you don't have to have any kind of experience.</p>
                        <ul class="under-wtr-itm">
                            <li>A motor helps you to glide the scooter underwater.</li>
                            <li>Oxygen is continuously pumped into the dome shaped helmet.</li>
                            <li>The guides underwater with you ensure that you stay within the safe zone and depth
                                limits.</li>
                        </ul>
                        <h3 class="fs-6 mt-2"><em>Best Time to Participate in Underwater Scooter Activity</em></h3>
                        <ul class="under-wtr-itm">
                            <li>The best time to enjoy the underwater Scooter Ride is between October and May when the
                                water is clear and the weather is at its best.</li>
                            <li>Avoid the months of June to September which is the monsoon season, when the visibility
                                is poor and the seas are unstable.</li>
                        </ul>
                        <h3 class="fs-6 mt-2"><em>Highlights Of Underwater Scooter</em></h3>
                        <ul class="under-wtr-itm">
                            <li>You get to see colorful fish and vibrant corals.</li>
                            <li>Enjoy a safe, secure and a trip with complete assistance.</li>
                            <li>This activity is perfect for all ages.</li>
                            <li>It is easy and safe for beginners.</li>
                            <li>Guided tours with real-time assistance.</li>
                            <li>Ideal for photography.</li>
                            <li>Underwater Scooter in Andaman operates in 2 top destinations</li>
                        </ul>

                        <!-- Book Now Button -->
                        <div class="text-end " style="font-size:14px;"><a href="#" target="_blank"
                                rel="noopener noreferrer">Book Now</a></div>

                    </div>

                    <div>
                        <h2 class="fs-6 mt-2">Overview Of Underwater Scooter Activity</h2>
                        <p>
                            The <strong>underwater scooter Ride In Andaman</strong> or (submersible scooter) is a
                            beginner-friendly adventure that is completely safe and exciting, This is a guided marine
                            activity which uses a unique submersible scooter. It is definitely suitable for all ages and
                            delivers an unforgettable view of tropical reefs and sea creatures.
                        </p>
                        <h3 class="fs-6 mt-2"><em>Things To Know</em></h3>
                        <ul class="under-wtr-itm">
                            <li>No prior swimming or diving skill is needed.</li>
                            <li>Do bring swimwear and a towel.</li>
                            <li>Follow the guide’s instructions to have a fun time.</li>
                            <li>Do not carry any sharp objects.</li>
                            <li>Do not consume alcohol or any kinds of drugs</li>
                        </ul>
                        <h3 class="fs-6 mt-2"><em>Inclusion:</em></h3>
                        <ul class="under-wtr-itm">
                            <li>Boat transfers to dive site</li>
                            <li>Underwater scooter and helmet</li>
                            <li>Complimentary photography</li>
                            <li>Safety gear and guide</li>
                            <li>Assistance from certified dive professionals</li>
                            <li>Oxygen supply system and helmet</li>
                            <li>Life jacket and first aid support</li>
                            <li>Drinking water post-ride</li>
                            <li>Briefing session</li>
                        </ul>
                        <h3 class="fs-6 mt-2"><em>Exclusion:</em></h3>
                        <ul class="under-wtr-itm">
                            <li>Hotel pickup/drop (optional extra)</li>
                            <li>Food, drinks and personal expenses</li>
                            <li>Souvenir videos or high-resolution photo prints</li>
                            <li>Personal diving or snorkeling gear</li>
                            <li>Any extra activity not mentioned in inclusions</li>
                            <li>Medical insurance or travel insurance</li>
                        </ul>
                        <!-- Book Now Button -->
                        <div class="text-end" style="font-size:14px;"><a href="#" target="_blank"
                                rel="noopener noreferrer">Book Now</a></div>
                    </div>
                    <div>
                        <h2 class="fs-6 mt-2">Why Choose This Over Other Activities?</h2>

                        <ul class="under-wtr-itm">
                            <li>
                                Unlike any other activity, the underwater scooter in Andaman is easier and safer. It’s a
                                unique way to explore without training.
                            </li>
                            <li>
                                scuba diving, snorkeling and major activites recuire a small amount of swimming skills
                                and gears.
                            </li>
                            <li>
                                More stable and easy than snorkeling.
                            </li>
                            <li>
                                Allows better breathing and longer exploration time.
                            </li>
                            <li>
                                Ideal for all ages, especially non-swimmers and elderly travelers as well.
                            </li>
                            <li>
                                Offers guided underwater scooter tours with full safety.
                            </li>
                        </ul>
                        <!-- Book Now Button -->
                        <div class="text-end" style="font-size:14px;"><a href="#" target="_blank"
                                rel="noopener noreferrer">Book Now</a></div>
                    </div>
                    <div>
                        <h2 class="fs-6 mt-2 fw-bold">How to Book Underwater Scooter In Andaman</h2>
                        <p class="mt-2">To book this Underwater Scooter In Andaman you just have to visit our website <a
                                href="https://andamanbliss.com" target="_blank"
                                rel="noopener noreferrer">www.andamanbliss.com</a>, pick your spot (Havelock or North
                            Bay) and choose a date. Prices start at ₹4,800. Kids under 10 can’t join, and have a
                            wonderful experience with a 20-30 minute ride.</p>

                        <div>
                            <h2 class="fs-6 fw-bold">Participate In Unique Activities with Andaman Bliss</h2>

                            <ol class="tour-master-index-list">
                                <li><strong>Seakart Adventures:</strong> Ride the waves dashingly at Corbyn’s Cove
                                    Beach.</li>
                                <li><strong>Sea Plane Ride:</strong> Cruise above the Islands and take in the panoramic
                                    view <em>(Not Operational)</em>.</li>
                                <li><strong>Speed Boat Ride:</strong> Feel the adrenaline rushing through your veins on
                                    the open seas.</li>
                                <li><strong>Underwater scootering:</strong> Walk underwater and explore marine life up
                                    close.</li>
                                <li><strong>Trekking:</strong> Walking through the undiscovered trails of Havelock and
                                    Baratang Islands.</li>
                                <li><strong>Banana Boat Ride:</strong> A fun and bumpy thrill ride for the entire
                                    family.</li>
                                <li><strong>Glass Bottom Boat Ride:</strong> Peek into the underwater marine life world
                                    without getting wet.</li>
                                <li><strong>Parasailing:</strong> Get a bird’s-eye view of the beautiful coastline of
                                    the Andaman Islands.</li>
                                <li><strong>Kayaking:</strong> Paddle through calm and peaceful mangrove creeks.</li>
                                <li><strong>Scuba Diving:</strong> Take a dive into magnificent and luxuriant coral
                                    reefs of Havelock and Neil Island.</li>
                                <li><strong>Island Hopping:</strong> Visit multiple islands in one single trip.</li>
                                <li><strong>Hiking:</strong> Conquer scenic and beautiful trails of Mount Harriet and
                                    Little Andaman.</li>
                                <li><strong>Mangrove Kayaking:</strong> Glide smoothly across nature's waterways.</li>
                                <li><strong>Snorkeling:</strong> Swim with exotic marine life.</li>
                            </ol>

                            <p class="mt-2">Andaman Bliss can arrange these unique and exhilarating activities as part
                                of your Andaman Tour Packages from Mumbai, Andaman Honeymoon Tour Packages from
                                Bhubaneswar, or any other packages that you choose.</p>

                        </div>
                        <div>
                            <h2 class="fs-6 fw-bold">
                                Places You Can Participate In Underwater Scooter Ride In Andaman
                            </h2>

                            <p class="mt-2"><a
                                    href="https://andamanbliss.com/water-sports/submersible-scooter/submersible-scooter-in-north-bay"
                                    target="_blank" rel="noopener noreferrer">Underwater Scooter In North Bay Island</a>
                            </p>
                            <p class="mt-2"><a
                                    href="https://andamanbliss.com/water-sports/submersible-scooter/submersible-scooter-in-havelock"
                                    target="_blank" rel="noopener noreferrer">Underwater Scooter In Elephant Beach</a>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">View All Packages</button>
                </div>
            </div>
            <!--modal end-->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ocean">
                <h5 class="modal-title text-white" id="bookingModalLabel">Quick Booking</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="bookingForm" action="{{ url('activity-enquiry') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="customerName" name="customer_name"
                            placeholder="Full Name" required>
                        <label for="customerName">Full Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="emailAddress" placeholder="Email"
                            required>
                        <label for="email">Email Address <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="phone" name="phoneNumber" placeholder="Phone"
                            required>
                        <label for="phone">Phone Number <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="location" name="activity_location" required>
                            <option value="" selected disabled>Select Location</option>
                            <option value="Havelock Island">Havelock Island</option>
                            <option value="North Bay">North Bay</option>
                        </select>
                        <label for="location">Preferred Location <span class="text-danger">*</span></label>
                    </div>
                    <div class="row g-2">
                        <div class="col-7">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="date" name="preferred_date"
                                    min="{{ date('Y-m-d') }}">
                                <label for="date">Preferred Date</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="guests" name="number_of_guests" min="1"
                                    placeholder="Guests" required>
                                <label for="guests">Guests <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="activity_name" value="Underwater Scooter">
                    <input type="hidden" name="url" value="{{ url()->current() }}">
                    <div class="d-grid gap-2 justify-content-center">
                        <button type="submit" class="btn btn-gradient-ocean text-white py-2 text-center">
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.btn-gradient-ocean {
    background: linear-gradient(135deg, #00BCD4, #2196F3);
    border: none;
    transition: all 0.3s ease;
}

.btn-gradient-ocean:hover {
    background: linear-gradient(135deg, #2196F3, #00BCD4);
    transform: translateY(-2px);
}

.modal-sm {
    max-width: 400px;
}

.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.modal-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    padding: 1rem 1.5rem;
}

.form-floating>.form-control,
.form-floating>.form-select {
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    height: calc(3rem + 2px);
    line-height: 1.25;
}

.form-floating>textarea.form-control {
    height: 80px;
}

.form-floating>.form-control:focus,
.form-floating>.form-select:focus {
    border-color: #00BCD4;
    box-shadow: 0 0 0 0.2rem rgba(0, 188, 212, 0.25);
}

.form-floating>label {
    padding: 0.75rem 1rem;
}

.text-danger {
    color: #f44336;
}

.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #f44336;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.form-floating>.form-control::placeholder {
    color: transparent;
}

.form-floating>.form-control:focus::placeholder {
    color: #6c757d;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookingForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Basic form validation
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (isValid) {
            const formData = new FormData(form);
            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Close the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById(
                        'bookingModal'));
                    modal.hide();

                    // Show success message
                    alert('Booking submitted successfully! We will contact you shortly.');
                    form.reset();
                })
                .catch(error => {
                    alert('An error occurred. Please try again.');
                });
        }
    });
});
</script>
@endsection

@push('styles')
<style>
/* Andamanbliss Tour Packages Section */
.tour-andamanbliss-section {
    background-color: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    border: 1px solid #e0e0e0;
}

.tour-andamanbliss-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.tour-andamanbliss-title span {
    color: #f9680f;
}

.tour-andamanbliss-text {
    color: #666;
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.tour-andamanbliss-read-more {
    color: rgb(17, 157, 213);
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.tour-andamanbliss-read-more:hover {
    color: #f9680f;
    text-decoration: underline;
}

/* Andamanbliss Modal */
.tour-andamanbliss-modal {
    max-width: 960px;
}

.tour-andamanbliss-modal .modal-header {
    border-bottom: 1px solid #eee;
    padding: 1rem 1.5rem;
    background-color: #fff;
}

.tour-andamanbliss-modal .modal-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
}

.tour-andamanbliss-modal .modal-body {
    padding: 0;
    max-height: 70vh;
    overflow-y: auto;
}

.tour-andamanbliss-modal .modal-footer {
    border-top: 1px solid #eee;
    padding: 1rem 1.5rem;
    background-color: #fff;
}

.under-wtr-itm li {
    list-style-type: disc !important;
    font-size:14px;
    color:#002246;
}

.tour-andamanbliss-packages {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.tour-andamanbliss-packages-header {
    display: flex;
    justify-content: space-between;
    background-color: #f8f9fa;
    padding: 0.75rem 1.5rem;
    border-bottom: 1px solid #e0e0e0;
}

.tour-andamanbliss-packages-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.tour-andamanbliss-packages-header .duration-price {
    display: flex;
    gap: 8rem;
}

.tour-andamanbliss-packages-header .col {
    font-size: 1rem;
    font-weight: 600;
    color: #666;
    text-align: center;
}

.tour-andamanbliss-package-item {
    display: flex;
    align-items: center;
    padding: 0rem 1.5rem;
    transition: all 0.3s ease;
}

.tour-andamanbliss-package-item:last-child {
    border-bottom: none;
}

.tour-andamanbliss-package-item:hover {
    background-color: rgba(249, 104, 15, 0.05);
}

.tour-andamanbliss-package-name {
    flex: 1;
}

.tour-andamanbliss-package-name a {
    color: #f9680f;
    font-weight: 600;
    text-decoration: none;
    font-size: 12px;
}

.tour-andamanbliss-package-name a:hover {
    color: rgb(17, 157, 213);
    text-decoration: underline;
}

.tour-andamanbliss-package-duration,
.tour-andamanbliss-package-price {
    width: 150px;
    text-align: right;
    font-weight: 500;
    font-size: 12px;
}

.tour-andamanbliss-package-duration {
    color: #666;
}

.tour-andamanbliss-package-price {
    color: #666;
}

.tour-andamanbliss-description {
    padding: 1.5rem;
    color: #666;
    line-height: 1.6;
}

.tour-andamanbliss-description p {
    margin-bottom: 1rem;
    font-size: 14px;
}

.tour-andamanbliss-description a {
    color: rgb(17, 157, 213);
    font-weight: 600;
    text-decoration: none;
}

.tour-andamanbliss-description a:hover {
    color: #f9680f;
    text-decoration: underline;
}

.tour-andamanbliss-modal .btn-primary {
    background-color: rgb(17, 157, 213);
    border-color: rgb(17, 157, 213);
}

.tour-andamanbliss-modal .btn-primary:hover {
    background-color: #0e8bc0;
    border-color: #0e8bc0;
}

.tour-andamanbliss-modal .btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.tour-andamanbliss-modal .close {
    font-size: 1.5rem;
    color: #000;
    opacity: 0.5;
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
// $(document).ready(function() {
//     $('#bookingForm').validate({
//         submitHandler: function(form) {
//             // Serialize form data
//             var formData = $(form).serializeArray();

//             // Add extra data
//             formData.push(
//                 { name: 'id', value: "{{ @$activity->id }}" },
//                 { name: 'location', value: $('#location').val() },
//                 { name: 'adultCount', value: $('#adultCount').val() },
//             );

//             $('.addons:checked').each(function(i, item) {
//                 formData.push(
//                     { name: `addons[${i}]`, value: $(item).val() },
//                 );
//             });

//             // Convert to URL-encoded string
//             var dataString = $.param(formData);

//             $.ajax({
//                 url: "{{ url('activities/booking') }}",
//                 type: 'POST',
//                 data: dataString,
//                 success: function(response) {
//                     toastr.success('Booking enquiry form submitted successfully!', 'Congrats!');
//                     $('#enquiryModal').modal('hide');
//                 }
//             });
//         }
//     });
// });
</script>
@endpush