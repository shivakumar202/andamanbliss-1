@extends('layouts.app')
@section('title', 'Best Hotels in Andaman | Book Luxury, Deluxe & Budget Stays With Andaman Bliss')
@section('keywords', 'Hotels In Andaman, luxury hotels in Andaman, premium hotels in Andaman, super deluxe hotels in Andaman, deluxe hotels in Andaman, standard hotels in Andaman, budget hotels in Andaman')
@section('description', 'Find the best hotels in Andaman with Andaman Bliss! Choose from luxury, premium, super deluxe, deluxe, standard, and budget stays for a perfect vacation.')
@push('styles')

<style>
/* Custom styles for proper alignment */
</style>
@endpush

@section('content')
<section class="hotel-banner position-relative">
    <div class="container-fluid p-0 overflow-hidden ">
        <div class="row ">
            <div class="col-12 text-center mt-5 banner-centre-contain">
                <h1 class="text-white  fs-1 text-center">Let's Discover Your Perfect Stay and Capture Happy Moments
                </h1>
                <button type="button" class="banner-btn">Book Now</button>
            </div>
        </div>

    </div>
</section>

@include('common.search2')

<!-- Exclusive Offers Section -->
<section class="exclusive-offers-section pt-5 pb-2">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h2 class="section-title">Best Hotels for <span class="text-gradient">Pickup</span></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://andamanbliss.com/site/img/sliver-sand-pb.webp"
                            alt="Hotel Offer">
                        <div class="offer-badge">Top Picks</div>
                    </div>
                    <div class="offer-content">
                        <h3 class="fs-6">Silver Sand</h3>
                        <p>Book 30 days in advance and save up to 20% on your stay</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://andamanbliss.com/site/img/symphoney-hv.avif"
                            alt="Hotel Offer">
                        <div class="offer-badge">Top Picks</div>
                    </div>
                    <div class="offer-content">
                        <h3 class="fs-6">Symphony Samudra</h3>
                        <p>Book Hotel For Your Weekend Trips Offers Complimentary Breakfast</p>
                       
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://andamanbliss.com/site/img/coral-reef-hv.webp"
                            alt="Hotel Offer">
                        <div class="offer-badge">Top Picks</div>
                    </div>
                    <div class="offer-content">
                        <h3 class="fs-6">Coral Reef Hotel</h3>
                        <p>Get Amazing Discounts On Luxurious Stays Lasts Longer Than 7 days</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://andamanbliss.com/site/img/sea-shell-hv.jpg"
                            alt="Hotel Offer">
                        <div class="offer-badge">Top Picks</div>
                    </div>
                    <div class="offer-content">
                        <h3 class="fs-6">Sea Shell</h3>
                        <p>Stay That Provides Romantic Setting & Candle Light Dinner</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Book Hotels For Every Mood Section -->
<section class="mood-hotels-section pt-3 pb-2 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h2 class="section-title">Book Hotels For <span class="text-gradient">Every Mood</span></h2>
                <p>Find the perfect accommodation that matches your mood and preferences</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="mood-card">
                    <div class="mood-image">
                        <img src="https://andamanbliss.com/site/img/coral-reef-hv.webp"
                            alt="Beach Hotels">
                        <div class="mood-overlay">
                            <h3>Beach Hotels</h3>
                            <p class="text-white">Relax by the ocean</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="mood-card">
                    <div class="mood-image">
                        <img src="https://andamanbliss.com/site/img/symphoney-hv.avif"
                            alt="Mountain Hotels">
                        <div class="mood-overlay">
                            <h3>Honeymoon Hotels</h3>
                            <p class="text-white">Spend your honeymoon & Candlelight Dinner</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="mood-card">
                    <div class="mood-image">
                        <img src="https://andamanbliss.com/site/img/sea-shell-hv.jpg"
                            alt="City Hotels">
                        <div class="mood-overlay">
                            <h3>City Hotels</h3>
                            <p class="text-white">Urban adventures</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Book Hotels at Popular Destinations Section -->
<section class="popular-destinations-section ">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h2 class="section-title">Book Hotels At <span class="text-gradient">Popular Destinations</span></h2>
                <p>Discover the best hotels in popular destinations</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://andamanbliss.com/site/img/portblair-is.jpg"
                            alt="Portblair">
                    </div>
                    <div class="destination-content">
                        <h4>Port Blair</h4>
                        <p class="text-left">352 Hotels</p>
                        <div class="destination-price">Starting from ₹2,500</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://andamanbliss.com/site/img/havelock-is.jpg"
                            alt="Havelock">
                    </div>
                    <div class="destination-content">
                        <h4>Havelock Island</h4>
                        <p>76 Hotels</p>
                        <div class="destination-price">Starting from ₹3,200</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://andamanbliss.com/site/img/neil-is.jpg"
                            alt="Neil Island">
                    </div>
                    <div class="destination-content">
                        <h4>Neil Island</h4>
                        <p>40 Hotels</p>
                        <div class="destination-price">Starting from ₹2,800</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://andamanbliss.com/site/img/diglipur6.jpg"
                            alt="Diglipur">
                    </div>
                    <div class="destination-content">
                        <h4>Diglipur</h4>
                        <p>38 Hotels</p>
                        <div class="destination-price">Starting from ₹2,200</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://andamanbliss.com/site/img/baratang1.webp"
                            alt="Baratang">
                    </div>
                    <div class="destination-content">
                        <h4>Baratang</h4>
                        <p>23 Hotels</p>
                        <div class="destination-price">Starting from ₹3,500</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://andamanbliss.com/site/img/ranga-market.jpg"
                            alt="Ranghat">
                    </div>
                    <div class="destination-content">
                        <h4>Rangat</h4>
                        <p>18 Hotels</p>
                        <div class="destination-price">Starting from ₹2,000</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-3">
                <button class="view-all-btn btn-lg rounded-pill search-submit">View All Destinations</button>
            </div>
        </div>
    </div>
</section>

<!-- Our Top Hotel Chains Section -->
<section class="hotel-chains-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h2 class="section-title">Our Top <span class="text-gradient">Hotel Chains</span></h2>
                <p class="section-subtitle">Trusted partners for your perfect stay</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="chain-card">
                    <div class="chain-logo">
                        <img src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://seashellhotels.net/wp-content/uploads/2020/11/seashell-logo-dark-green-1.png"
                            alt="Sea Shell">
                    </div>
                    <h5>She Shell</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="chain-card">
                    <div class="chain-logo">
                        <img src="https://assets.simplotel.com/simplotel/image/upload/x_910,y_1081,w_3224,h_1754,r_0,c_crop,q_90/w_355,h_200,f_auto,c_fit/symphony-resorts/Symphony_Resorts_hzmyhg"
                            alt="symphoney">
                    </div>
                    <h5>Symphony</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="chain-card">
                    <div class="chain-logo">
                        <img src="https://www.tsgresorts.in/assests/images/tsg-logo.png" alt="TSG grand">
                    </div>
                    <h5>TSG Grand</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="chain-card">
                    <div class="chain-logo">
                        <img src="https://www.grandparadisehotel.in/images/logo.jpg" alt="Grand Paradise">
                    </div>
                    <h5>Grand Paradise</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="chain-card">
                    <div class="chain-logo">
                        <img src="https://royalneilresort.in/wp-content/uploads/2024/03/Resort-1-LOGO-1.png"
                            alt="Royal Neil">
                    </div>
                    <h5>Royal Neil</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <div class="chain-card">
                    <div class="chain-logo">
                        <img src="https://cdn.sanity.io/images/ocl5w36p/prod5/4eeaf5b2669e2f360ea72bed30fbc7cbdfb3a2a4-67x59.png"
                            alt="Taj">
                    </div>
                    <h5> Hotels Taj</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cheapest Deals Section -->
<section class="cheapest-deals-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="deals-content">
                    <h2 class="deals-title">Book Cheap & Best Accommodation In Andaman <span class="text-gradient">Islands With Andaman Bliss</span></h2>
                    <p class="deals-description" style="text-align:justify">
                        Find out the unbeatable prices of both budget friendly accommodation, premium resorts and luxury accommodation. Our large scale of network of hotels and partners make sure that you get best deals, whether you are looking for a comfortable stay or have a premium experience. Book your accommodation now and enjoy your trip stress free.</p>
                    <div class="deals-features">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="deal-feature">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Guaranteed Low Price</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="deal-feature">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Instant Confirmation After Booking</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="deal-feature">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Limited Time Free Cancellation Available</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="deal-feature">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>24/7 Reliable Customer Support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="view-all-btn btn-lg rounded-pill search-submit">Explore Deals</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="deals-image">
                    <img src="https://andamanbliss.com/site/img/coral-reef-hv.webp"
                        alt="Hotel Deals" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Book Hotels Section -->
<section class="why-book-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h2 class="section-title">Why Book Hotels with <span class="text-gradient">andamanbliss.com?</span></h2>
                <p class="section-subtitle">Check out the reason why to choose us to book a proper accommodation that suits your preferences.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4>Quick Search</h4>
                    <p>Find perfect hotel with advanced search filters & user friendly interface</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h4>Best Prices</h4>
                    <p>Find exclusive deals & lowest rates on hotels across Andaman</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Secure Payment</h4>
                    <p>Encrypted payment gateways to make your transaction safe.
                        </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>All time support to assist you with any sort of queries</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">FAQ'<span class="text-gradient">s</span></h2>
                <p class="section-subtitle">Know Everything About Booking You A Proper Accommodation</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1"
                            aria-expanded="false" role="button">
                            <span>What are the check-in and check-out times?</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq1">
                            <div class="faq-answer-content">
                                Standard check-in time is 2:00 PM and check-out time is 12:00 PM. Early check-in and
                                late check-out may be available upon request and subject to availability.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2"
                            aria-expanded="false" role="button">
                            <span>Can I cancel or modify my booking?</span>
                           <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq2">
                            <div class="faq-answer-content">
                                Yes, you can cancel or modify your booking. Cancellation policies vary by hotel and
                                booking type. Please check your booking confirmation for specific terms and conditions.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3"
                            aria-expanded="false" role="button">
                            <span>Do you offer airport transfers?</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq3">
                            <div class="faq-answer-content">
                                Many of our partner hotels offer airport transfer services. You can add this service
                                during booking or contact the hotel directly to arrange transfers.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4"
                            aria-expanded="false" role="button">
                            <span>Are pets allowed in the hotels?</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq4">
                            <div class="faq-answer-content">
                                Pet policies vary by hotel. Some hotels are pet-friendly while others may not allow
                                pets. Please check the hotel's pet policy before booking or contact us for assistance.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5"
                            aria-expanded="false" role="button">
                            <span>What payment methods do you accept?</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq5">
                            <div class="faq-answer-content">
                                We accept all major credit cards, debit cards, net banking, UPI, and digital wallets.
                                Payment is secure and processed through encrypted channels.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq6"
                            aria-expanded="false" role="button">
                            <span>Can I cancеl my rеsеrvation without any chargеs?</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq6">
                            <div class="faq-answer-content">
                            Yеs, many accommodation allows guests to cancel their rеsеrvations free of charge up to 48 hours bеforе chеck in. Cancellations madе within 48 hours will incur a fее, ensuring guеsts have flexibility in thеіr travеl plans.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq7"
                            aria-expanded="false" role="button">
                            <span>Is there hotels available in Andaman with beach view?</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq7">
                            <div class="faq-answer-content">
                            Absolutely, many resorts & hotels in the Andaman Islands, especially in Havelock & Neil Islands, these hotels offers a stunnin beach view. That ranges from luxury resorts to budget stays, there are multiple options to choose from.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq8"
                            aria-expanded="false" role="button">
                            <span>What are the amenities to expect at the Andaman Islands?</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq8">
                            <div class="faq-answer-content">
                            There are many common amenities at the hotels that includes wi-fi, AC, room services, in house restaurents, sea views and travel desks. However, in few remote location internet access and network coverages might be limited and sometimes a mess.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq9"
                            aria-expanded="false" role="button">
                            <span>Is breakfast included in the room rate?</span>
                           <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="collapse faq-answer" id="faq9">
                            <div class="faq-answer-content">
                                Breakfast inclusion varies by hotel and room type. You can see if breakfast is included
                                in the room details during booking. Some hotels offer complimentary breakfast while
                                others charge separately.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->

<section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">What Our <span class="text-gradient">Travelers</span> Say</h2>
            <p class="section-description">Discover why thousands of travelers choose our Andaman packages for their
                dream vacation</p>
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

    </div>
</section>

<!-- FAQ Section -->


@endsection

@push('styles')
<style type="text/css">
/* Hotel Banner Styles */


/* Section Titles */
.section-title {
    color: rgb(17, 157, 213);
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.section-subtitle {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 30px;
}

/* Cheapest Deals Section */
.deals-title {
    color: rgb(17, 157, 213);
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.deals-description {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 25px;
}

.deal-feature {
    display: flex;
    align-items: center;
    font-weight: 500;
    color: #333;
    font-size:12px;
}

.deal-feature i {
    color: #28a745;
    margin-right: 10px;
}

.deals-image img {
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Testimonials Slider Section */
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

/* FAQ Section */
.faq-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.faq-item {
    border-bottom: 1px solid #e9ecef;
    margin-bottom:5px;
}

.faq-item:last-child {
    border-bottom: none;
}

.faq-question {
    padding: 12px 25px;
    background: white;
    cursor: pointer;
    display: flex;
    justify-content: between;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
    width: 100%;
    text-align: left;
}

.faq-question:hover {
    background: #f8f9fa;
}

.faq-question span {
    color: #333;
    font-weight: 600;
    font-size: 0.8rem;
    flex: 1;
}

.faq-icon {
    color: rgb(17, 157, 213);
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.faq-question[aria-expanded="true"] .faq-icon {
    transform: rotate(180deg);
}

.faq-answer-content {
    padding: 0 25px 20px;
    color: #666;
    line-height: 1.6;
    font-size:12px;
}

/* Exclusive Offers Section */
.exclusive-offers-section {
    background: #f8f9fa;
}

.offer-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.offer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.offer-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.offer-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.offer-card:hover .offer-image img {
    transform: scale(1.05);
}

.offer-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #f9680f;
    color: white;
    padding: 2px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.offer-content {
    padding: 20px;
}

.offer-content h4 {
    color: #333;
    font-weight: 600;
    margin-bottom: 10px;
}

.offer-content p {
    color: #666;
    font-size: 0.95rem;
    margin-bottom: 15px;
}

.offer-btn {
    background: rgb(17, 157, 213);
    color: white;
    text-decoration: none;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-block;
}

.offer-btn:hover {
    background: rgb(0, 206, 255);
    color: white;
    text-decoration: none;
}

/* Mood Hotels Section */
.mood-card {
    border-radius: 12px;
    overflow: hidden;
    height: 250px;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.mood-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.mood-image {
    width: 100%;
    height: 100%;
    position: relative;
}

.mood-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.mood-card:hover .mood-image img {
    transform: scale(1.05);
}

.mood-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    color: white;
    padding: 30px 20px 20px;
}

.mood-overlay h3 {
    font-weight: 600;
    margin-bottom: 5px;
    color: #fff;
    font-size:16px;
}

.mood-overlay p {
    margin: 0;
    opacity: 0.9;
}

/* Popular Destinations Section */
.destination-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.destination-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.destination-image {
    height: 200px;
    overflow: hidden;
}

.destination-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.destination-card:hover .destination-image img {
    transform: scale(1.05);
}

.destination-content {
    padding: 20px;
}

.destination-content h4 {
    color: #333;
    font-weight: 600;
    margin-bottom: 5px;
    font-size:16px;
}

.destination-content p {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.destination-price {
    color: rgb(17, 157, 213);
    font-weight: 600;
    font-size: 0.9rem;
}

/* Hotel Chains Section */
.chain-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.chain-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.chain-logo {
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.chain-logo img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}

.chain-card h5 {
    color: #333;
    font-weight: 600;
    margin: 0;
}

/* Feature Cards */
.feature-card {
    background: white;
    border-radius: 12px;
    padding: 30px 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.feature-icon {
    width: 40px;
    height: 40px;
    background: rgb(17, 157, 213);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    transition: all 0.3s ease;
}

.feature-icon i {
    font-size: 1rem;
    color: white;
}

.feature-card:hover .feature-icon {
    background: #f9680f;
    transform: scale(1.1);
}

.feature-card h4 {
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
    font-size:16px;
}

.feature-card p {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .section-title {
        font-size: 1.8rem;
    }

    .banner-centre-contain h1 {
        font-size: 1.5rem;
    }

    .offer-image,
    .destination-image {
        height: 180px;
    }

    .mood-card {
        height: 200px;
    }

    .chain-logo {
        height: 50px;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
    }

    .feature-icon i {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
// Testimonial Slider Functionality
$(document).ready(function() {
        // Infinite testimonial slider with 6 cards
        const slider = $('#testimonialSlider');
        const cards = slider.find('.testimonial-card');
        const dotsContainer = $('#testimonialDots');
        const prevBtn = $('#testimonialPrev');
        const nextBtn = $('#testimonialNext');

        // Clone cards for infinite scrolling
        cards.each(function() {
            $(this).clone().appendTo(slider);
        });

        // Get updated cards after cloning
        const allCards = slider.find('.testimonial-card');

        // Variables
        let currentIndex = 0;
        const originalCardsCount = cards.length;
        let cardWidth, containerWidth, visibleCards, maxIndex;
        let isAnimating = false;

        // Calculate dimensions and limits
        function calculateDimensions() {
            // Reset any inline styles first
            slider.find('.testimonial-card').removeAttr('style');
            slider.find('.testimonial-card').css('display', 'flex');

            // Get container width first
            containerWidth = slider.parent().width();

            // Determine how many cards are visible based on screen size
            if (window.innerWidth <= 768) {
                visibleCards = 1;
                // Mobile view - single card with proper spacing
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(100% - 30px)',
                    'max-width': 'calc(100% - 30px)',
                    'margin': '0 15px'
                });
            } else if (window.innerWidth <= 992) {
                visibleCards = 2;
                // Tablet view - two cards
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(50% - 20px)',
                    'max-width': 'calc(50% - 20px)',
                    'margin': '0 10px'
                });
            } else {
                visibleCards = 3;
                // Desktop view - three cards
                slider.find('.testimonial-card').css({
                    'flex': '0 0 calc(33.333% - 20px)',
                    'max-width': 'calc(33.333% - 20px)',
                    'margin': '0 10px'
                });
            }

            // Now get the actual card width after CSS adjustments
            cardWidth = allCards.first().outerWidth(true);

            // Calculate maximum index (original cards count)
            maxIndex = originalCardsCount;

            console.log('Screen width:', window.innerWidth);
            console.log('Container width:', containerWidth);
            console.log('Card width:', cardWidth);
            console.log('Visible cards:', visibleCards);
        }

        // Create dots based on original cards count
        function createDots() {
            dotsContainer.empty();

            for (let i = 0; i < originalCardsCount; i++) {
                dotsContainer.append(
                    `<div class="dot ${i === currentIndex % originalCardsCount ? 'active' : ''}" data-index="${i}"></div>`
                );
            }
        }

        // Update slider position with smooth transition
        function updateSlider(withAnimation = true) {
            if (isAnimating) return;

            // Recalculate dimensions to ensure proper sizing
            if (!withAnimation) {
                calculateDimensions();
            }

            // Update active dot
            dotsContainer.find('.dot').removeClass('active');
            dotsContainer.find(`.dot[data-index="${currentIndex % originalCardsCount}"]`).addClass('active');

            // Calculate the translation value based on current card width
            const translateValue = -currentIndex * cardWidth;

            // Add a class to the current active card for mobile styling
            slider.find('.testimonial-card').removeClass('active-card');
            slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

            // Update pagination indicator for mobile
            $('#currentSlideIndicator').text((currentIndex % originalCardsCount) + 1);
            $('#totalSlidesIndicator').text(originalCardsCount);

            if (withAnimation) {
                isAnimating = true;
                slider.css('transition', 'transform 0.5s ease-out');
                slider.css('transform', `translateX(${translateValue}px)`);

                // After animation completes
                setTimeout(function() {
                    isAnimating = false;

                    // If we've scrolled past the original set, reset to the clone
                    if (currentIndex >= originalCardsCount) {
                        slider.css('transition', 'none');
                        currentIndex = currentIndex % originalCardsCount;
                        slider.css('transform', `translateX(${-currentIndex * cardWidth}px)`);

                        // Update active card after reset
                        slider.find('.testimonial-card').removeClass('active-card');
                        slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

                        // Update pagination indicator after reset
                        $('#currentSlideIndicator').text(currentIndex + 1);
                    }

                    // If we've scrolled to the beginning of the clone set, reset to the original
                    if (currentIndex < 0) {
                        slider.css('transition', 'none');
                        currentIndex = originalCardsCount - Math.abs(currentIndex % originalCardsCount);
                        slider.css('transform', `translateX(${-currentIndex * cardWidth}px)`);

                        // Update active card after reset
                        slider.find('.testimonial-card').removeClass('active-card');
                        slider.find('.testimonial-card').eq(currentIndex).addClass('active-card');

                        // Update pagination indicator after reset
                        $('#currentSlideIndicator').text(currentIndex + 1);
                    }
                }, 500);
            } else {
                slider.css('transition', 'none');
                slider.css('transform', `translateX(${translateValue}px)`);
            }
        }

        // Next slide with infinite scrolling
        function nextSlide() {
            if (isAnimating) return;
            currentIndex++;
            updateSlider();
        }

        // Previous slide with infinite scrolling
        function prevSlide() {
            if (isAnimating) return;
            currentIndex--;
            updateSlider();
        }

        // Initialize slider
        calculateDimensions();
        createDots();
        updateSlider(false);

        // Event listeners
        nextBtn.on('click', function() {
            clearInterval(autoSlideInterval);
            nextSlide();
            startAutoSlide();
        });

        prevBtn.on('click', function() {
            clearInterval(autoSlideInterval);
            prevSlide();
            startAutoSlide();
        });

        dotsContainer.on('click', '.dot', function() {
            if (isAnimating) return;
            clearInterval(autoSlideInterval);

            const dotIndex = parseInt($(this).data('index'));
            currentIndex = dotIndex;
            updateSlider();
            startAutoSlide();
        });

        // Handle window resize with debounce for better performance
        let resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Store current index before recalculating
                const currentActiveIndex = currentIndex % originalCardsCount;

                // Reset to the active slide's position
                currentIndex = currentActiveIndex;

                // Recalculate everything
                calculateDimensions();
                createDots();
                updateSlider(false);
            }, 250);
        });

        // Auto-slide functionality
        let autoSlideInterval;

        function startAutoSlide() {
            autoSlideInterval = setInterval(function() {
                nextSlide();
            }, 5000);
        }

        // Start auto-sliding
        startAutoSlide();

        // Pause auto-sliding when user interacts
        $('.testimonial-slider-container').on('mouseenter', function() {
            clearInterval(autoSlideInterval);
        }).on('mouseleave', function() {
            startAutoSlide();
        });

        // Touch swipe functionality
        let touchStartX = 0;
        let touchEndX = 0;

        slider.on('touchstart', function(e) {
            touchStartX = e.originalEvent.touches[0].clientX;
            clearInterval(autoSlideInterval);
        });

        slider.on('touchend', function(e) {
            touchEndX = e.originalEvent.changedTouches[0].clientX;

            // Determine swipe direction
            if (touchStartX - touchEndX > 50) { // Swipe left
                nextSlide();
            } else if (touchEndX - touchStartX > 50) { // Swipe right
                prevSlide();
            }

            // Restart auto-slide
            startAutoSlide();
        });

        // Initialize AOS animation library
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>
@endpush