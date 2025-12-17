@extends('layouts.app')
@section('title', 'Reviews')

@section('content')

<!-- Header Section -->
<section class="feedback-header">
    <div class="feedback-overlay"></div>
    <div class="container">
        <div class="feedback-header-content">
            <h1 class="text-white">Customer <span class="text-gradient">Feedback</span></h1>
            <p class="feedback-subtitle">Sharing true happy memories and experiences</p>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="feedback-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

<!-- Video Testimonials Section -->
<section class="video-testimonials-section">
    <div class="container">
        <div class="section-intro text-center mb-5">
            <span class="section-subtitle">Video Testimonials</span>
            <h2 class="section-title">What Our <span class="text-gradient">Customers Say</span></h2>
            <p class="lead">Watch real experiences from our happy travelers</p>
        </div>
        <div class="row video-grid">
            <!-- Video 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="oLRLwOFyazg">
                        <img src="{{ asset('site/img/reviewithumb1.webp') }}" class="img-fluid"
                            alt="Customer Testimonial" loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Amazing Andaman Experience</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Happy Customer</span>
                            <span><i class="fas fa-star"></i> 5.0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 2 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="dJEz0lGICv0">
                        <img src="{{ asset('site/img/reviewithumb3.webp') }}" class="img-fluid"
                            alt="Customer Testimonial" loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Unforgettable Island Tour</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Satisfied Traveler</span>
                            <span><i class="fas fa-star"></i> 4.9</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 3 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="UuXOld7tBew">
                        <img src="{{ asset('site/img/thumnail-feed4.jpg') }}" class="img-fluid"
                            alt="Customer Testimonial" loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Best Vacation Ever</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Family Traveler</span>
                            <span><i class="fas fa-star"></i> 5.0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 4 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="vEOY9qpbbDE">
                        <img src="{{ asset('site/img/cus-feed5.jpg') }}" class="img-fluid" alt="Customer Testimonial"
                            loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Perfect Honeymoon Trip</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Couple</span>
                            <span><i class="fas fa-star"></i> 4.8</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 5 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="YgbmV2Gc4LQ">
                        <img src="{{ asset('site/img/cus-feed6.jpg') }}" class="img-fluid" alt="Customer Testimonial"
                            loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Scuba Diving Adventure</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Adventure Seeker</span>
                            <span><i class="fas fa-star"></i> 5.0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 6 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="2RLTJ9o7GBA">
                        <img src="{{ asset('site/img/cus-feed7.jpg') }}" class="img-fluid" alt="Customer Testimonial"
                            loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Island Hopping Experience</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Group Traveler</span>
                            <span><i class="fas fa-star"></i> 4.9</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 7 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="UuXOld7tBew">
                        <img src="{{ asset('site/img/reviewithumb1.webp') }}" class="img-fluid"
                            alt="Customer Testimonial" loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Beach Paradise</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Solo Traveler</span>
                            <span><i class="fas fa-star"></i> 4.7</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 8 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="UuXOld7tBew">
                        <img src="{{ asset('site/img/reviewithumb1.webp') }}" class="img-fluid"
                            alt="Customer Testimonial" loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Luxury Resort Stay</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Premium Guest</span>
                            <span><i class="fas fa-star"></i> 5.0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 9 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="video-card">
                    <div class="video-wrapper" data-id="UuXOld7tBew">
                        <img src="{{ asset('site/img/reviewithumb1.webp') }}" class="img-fluid"
                            alt="Customer Testimonial" loading="lazy" />
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="video-overlay"></div>
                    </div>
                    <div class="video-info">
                        <h3>Wildlife Exploration</h3>
                        <div class="video-meta">
                            <span><i class="fas fa-user"></i> Nature Enthusiast</span>
                            <span><i class="fas fa-star"></i> 4.8</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Google Reviews Section -->
<section class="google-reviews-section">
    <div class="container">
        <div class="section-intro text-center mb-5">
            <span class="section-subtitle">Verified Reviews</span>
            <h2 class="section-title">Latest <span class="text-gradient">Google Reviews</span></h2>
            <p class="lead">See what our customers are saying about us on Google</p>
            <div class="mt-4">
                <a href="https://g.page/r/CZnXWZKSvzVeEB0/review" target="_blank" class="google-review-btn">
                    <i class="fab fa-google"></i> View Google Review
                </a>
            </div>
        </div>
        <div class="google-reviews-container">
            <div class='sk-ww-google-reviews' data-embed-id='25470661'></div>
        </div>
    </div>
</section>
<!-- CEO Message Section -->
<section class="ceo-message-section">
    <div class="container">
        <div class="ceo-message-container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5">
                    <div class="ceo-image">
                        <img src="{{ asset('site/img/aboutCeo1.jpg') }}" class="img-fluid"
                            alt="Mr Pravin Kumar - Managing Director" loading="lazy" />
                        <div class="image-shape"></div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="ceo-message-content">
                        <span class="section-subtitle">Our Commitment</span>
                        <h2 class="section-title">We Guarantee the trip you <span class="text-gradient">book with
                                us!</span></h2>
                        <div class="message-text">
                            <p>We welcome you to AndamanBliss Tour and Travel, where unforgettable journeys begin!
                                Experience the breathtaking beauty of the Andaman Islands and beyond with us. At
                                AndamanBliss, we ensure you are treated with the utmost care, and our personal touch is
                                reflected in every tour we offer. We are available at any time to provide full support,
                                and when you book a trip with us, it's a guarantee of a remarkable and hassle-free
                                adventure.</p>
                        </div>
                        <div class="ceo-info">
                            <div class="ceo-details">
                                <h3>Mr Pravin Kumar</h3>
                                <p>Managing Director & Director - Sales | Andamanbliss</p>
                            </div>
                            <div class="ceo-connect">
                                <p>Connect directly:</p>
                                <div class="connect-buttons">
                                    <a href="tel:+918900909900" class="connect-btn phone">
                                        <i class="fas fa-phone-alt"></i> Call Now
                                    </a>
                                    <a href="https://wa.me/+918900909900" class="connect-btn whatsapp">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
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
<section class="faq-section">
    <div class="container">
        <div class="faq-container">
            <div class="section-intro text-center mb-5">
                <span class="section-subtitle">Common Questions</span>
                <h2 class="section-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
                <p class="lead">Find answers to common questions about our services</p>
            </div>
            <!-- Accordions START -->
            <div class="panel-group faq-block pt-1" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="faq-heading">
                        </div>
                        <div class="panel panel-default accordion">
                            <div class="panel-heading accordion-heading" id="headingOne">
                                <h4 class="panel-title accordion-title">
                                    <a class=" btn-link collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        1. Is thе Reef Looker Semi Submarine Ride In Havelock suitable for childrеn?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="panel-body accordion-body">
                                    <p>Yеs, thе еxpеriеncе is completely sеcurе for children and has all nеcеssary
                                        safety features.</p>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default accordion">
                            <div class="panel-heading accordion-heading" id="headingTwo">
                                <h4 class="panel-title accordion-title">
                                    <a class=" btn-link collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        2. Do I rеquirе to havе thе ability to swim in ordеr to participatе in this
                                        ridе?

                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="panel-body accordion-body">
                                    <p>Thе answеr is no, swimming skills are not needed bеcausе you will bе dry
                                        within thе Reef Looker Semi Submarine Ride In Elephant Beach.</p>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default accordion">
                            <div class="panel-heading accordion-heading" role="tab" id="headingThree">
                                <h4 class="panel-title accordion-title">
                                    <a class=" btn-link collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="true"
                                        aria-controls="collapseThree">
                                        3. Am I allowed to take picturеs throughout thе Reef Looker Semi Submarine
                                        Ride?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="panel-body accordion-body">
                                    <p>Yеs, photography is welcomed and thеrе аrе numerous possibilities to takе
                                        amazing underwater photos.

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-heading">
                        </div>
                        <div class="panel panel-default accordion">
                            <div class="panel-heading accordion-heading" role="tab" id="headingTen">
                                <h4 class="panel-title accordion-title">
                                    <a class=" btn-link collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                        4. How do I arrange a ride on thе Reef Looker Semi Submarine Ride In Andaman
                                        Islands?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTen" class="panel-collapse collapse" aria-labelledby="headingTen"
                                data-parent="#accordion">
                                <div class="panel-body accordion-body">
                                    <p>You can book thе journеy onlinе by visiting the <a
                                            href="www.andamanbliss.com">Andaman Bliss™ wеbsitе</a>, or you may call
                                        our customеr sеrvicе staff for assistancе with rеsеrvations.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default accordion">
                            <div class="panel-heading accordion-heading" role="tab" id="headingEleven">
                                <h4 class="panel-title accordion-title">
                                    <a class=" btn-link collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseEleven" aria-expanded="true"
                                        aria-controls="collapseEleven">
                                        5. Is there an age limit for participating in thе Reef Looker Semi Submarine
                                        Ride In Havelock?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEleven" class="panel-collapse collapse" aria-labelledby="headingEleven"
                                data-parent="#accordion">
                                <div class="panel-body accordion-body">
                                    <p>No, thе еxpеriеncе is appropriate for all ages, which makеs it an idеal
                                        family activity. Children are required to be supervised by an adult.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default accordion">
                            <div class="panel-heading accordion-heading" role="tab" id="headingTweleve">
                                <h4 class="panel-title accordion-title">
                                    <a class=" btn-link collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTweleve" aria-expanded="true"
                                        aria-controls="collapseTweleve">
                                        6. What happеns if thе wеathеr is bad?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTweleve" class="panel-collapse collapse" aria-labelledby="headingTweleve"
                                data-parent="#accordion">
                                <div class="panel-body accordion-body">
                                    <p>If there is severe weather expected, thе ride may be delayed or cancеlеd for
                                        security reasons. You will be notified about it advancе and altеrnatе
                                        arrangеmеnts will bе put togеthеr.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Accordions END -->
            </div>

            <!-- Contact Info -->
            <div class="faq-contact-info text-center mt-5">
                <p>Still have questions? Contact our support team</p>
                <div class="contact-buttons">
                    <a href="mailto:support@andamanbliss.com" class="contact-button email">
                        <i class="fas fa-envelope"></i> Email Us
                    </a>
                    <a href="tel:+918900909900" class="contact-button phone">
                        <i class="fas fa-phone-alt"></i> Call Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style type="text/css">
:root {
    --primary-color: rgb(17, 157, 213);
    --primary-light: rgba(17, 157, 213, 0.1);
    --secondary-color: #fd6e0f;
    --secondary-light: rgba(253, 110, 15, 0.1);
    --text-dark: #333;
    --text-light: #666;
    --white: #fff;
    --light-bg: #f8f9fa;
    --border-radius: 12px;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

/* Header Section Styles */
.feedback-header {
    position: relative;
    background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80');
    background-size: cover;
    background-position: center;
    min-height: 300px;
    display: flex;
    align-items: center;
    color: var(--white);
    padding: 80px 0 100px;
    overflow: hidden;
}

.feedback-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(17, 157, 213, 0.7) 100%);
    z-index: 1;
}

.feedback-header .container {
    z-index: 2;
    position: relative;
}

.feedback-header-content {
    padding: 2rem 0;
    text-align: center;
}

.feedback-header-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.feedback-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
}

.breadcrumb-wrapper {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
}

.breadcrumb {
    margin-bottom: 0;
}

.breadcrumb-item a {
    color: var(--white);
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb-item.active {
    color: rgba(255, 255, 255, 0.8);
}

.breadcrumb-item+.breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.6);
}

.feedback-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.feedback-shape svg {
    width: 100%;
    height: 80px;
}

/* Section Intro Styles */
.section-intro {
    text-align: center;
    margin-bottom: 2rem;
}

.section-subtitle {
    display: inline-block;
    background-color: var(--primary-light);
    color: var(--primary-color);
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: rgb(17, 157, 213);
    margin-bottom: 1rem;
}

.text-gradient {
    color: #fd6e0f;
    font-weight: 800;
    display: inline-block;
}

.lead {
    font-size: 1.1rem;
    color: var(--text-light);
    max-width: 800px;
    margin: 0 auto;
}

/* Video Testimonials Section */
.video-testimonials-section {
    padding: 60px 0;
    background-color: var(--white);
}

.video-grid {
    margin-top: 2rem;
}

.video-card {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    overflow: hidden;
    transition: var(--transition);
    height: 100%;
}

.video-card:hover {
    transform: translateY(-5px);
}

.video-wrapper {
    position: relative;
    padding-bottom: 56.25%;
    /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    cursor: pointer;
}

.video-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.2);
    transition: var(--transition);
}

.video-wrapper:hover .video-overlay {
    background-color: rgba(0, 0, 0, 0.4);
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background-color: rgba(17, 157, 213, 0.8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    transition: var(--transition);
}

.play-button i {
    color: var(--white);
    font-size: 1.5rem;
}

.video-wrapper:hover .play-button {
    background-color: var(--secondary-color);
    transform: translate(-50%, -50%) scale(1.1);
}

.video-info {
    padding: 1.5rem;
}

.video-info h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
}

.video-meta {
    display: flex;
    justify-content: space-between;
}

.video-meta span {
    display: inline-flex;
    align-items: center;
    font-size: 0.9rem;
    color: var(--text-light);
}

.video-meta span i {
    margin-right: 0.3rem;
    color: var(--primary-color);
}

.video-meta span:last-child i {
    color: var(--secondary-color);
}

.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

/* Google Reviews Section */
.google-reviews-section {
    padding: 60px 0;
    background-color: var(--light-bg);
}

.google-reviews-container {
    margin-top: 2rem;
    border-radius: var(--border-radius);
    overflow: hidden;
}

.google-review-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.8rem 1.8rem;
    background-color: var(--secondary-color);
    color: var(--white);
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(253, 110, 15, 0.3);
}

.google-review-btn i {
    margin-right: 0.5rem;
    font-size: 1.2rem;
}

.google-review-btn:hover {
    background-color: #e05d00;
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(253, 110, 15, 0.4);
}

/* CEO Message Section */
.ceo-message-section {
    padding: 60px 0;
    background-color: var(--white);
}

.ceo-message-container {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2rem;
    overflow: hidden;
}

.ceo-image {
    position: relative;
    padding: 1rem;
}

.ceo-image img {
    border-radius: var(--border-radius);
    position: relative;
    z-index: 2;
    width: 100%;
}

.image-shape {
    position: absolute;
    top: 0;
    right: 0;
    width: 80%;
    height: 80%;
    background-color: var(--primary-light);
    border-radius: var(--border-radius);
    z-index: 1;
}

.ceo-message-content {
    padding: 1rem;
}

.message-text {
    margin: 1.5rem 0;
    color: var(--text-light);
    line-height: 1.7;
}

.ceo-info {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.ceo-details h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.3rem;
}

.ceo-details p {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 0;
}

.ceo-connect p {
    font-size: 0.9rem;
    color: var(--text-light);
    margin-bottom: 0.75rem;
}

.connect-buttons {
    display: flex;
    gap: 1rem;
}

.connect-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.6rem 1.2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: var(--transition);
}

.connect-btn i {
    margin-right: 0.5rem;
}

.connect-btn.phone {
    background-color: var(--primary-color);
    color: var(--white);
}

.connect-btn.phone:hover {
    background-color: #0e8bc0;
    transform: translateY(-3px);
    color: var(--white);
}

.connect-btn.whatsapp {
    background-color: #25D366;
    color: var(--white);
}

.connect-btn.whatsapp:hover {
    background-color: #128C7E;
    transform: translateY(-3px);
    color: var(--white);
}

/* FAQ Section Styles */
.faq-section {
    padding: 60px 0;
    background-color: var(--light-bg);
}

.faq-container {
    max-width: 1000px;
    margin: 0 auto;
}

.panel-default {
    border: none;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 1rem;
    overflow: hidden;
}

.accordion-heading {
    padding: 0;
    border: none;
    background-color: var(--white);
}

.accordion-title {
    margin: 0;
    padding: 0;
}

.accordion-title a {
    display: block;
    padding: 1.2rem 1.5rem;
    color: var(--text-dark);
    font-weight: 600;
    text-decoration: none;
    position: relative;
    transition: var(--transition);
}

.accordion-title a:hover {
    color: var(--primary-color);
}

.accordion-title a::after {
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    transition: var(--transition);
}

.accordion-title a[aria-expanded="true"]::after {
    transform: translateY(-50%) rotate(180deg);
}

.accordion-body {
    padding: 0 1.5rem 1.2rem;
    border-top: none;
}

.accordion-body p {
    margin-bottom: 0;
    color: var(--text-light);
    line-height: 1.7;
}

/* FAQ Contact Info Styles */
.faq-contact-info {
    margin-top: 4rem;
    padding: 2rem;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    text-align: center;
}

.faq-contact-info p {
    font-size: 1.1rem;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
}

.contact-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.contact-button {
    display: inline-flex;
    align-items: center;
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.contact-button i {
    margin-right: 0.5rem;
}

.contact-button.email {
    background-color: var(--primary-color);
    color: var(--white);
}

.contact-button.email:hover {
    background-color: #0e8bc0;
    color: var(--white);
    transform: translateY(-3px);
}

.contact-button.phone {
    background-color: var(--secondary-color);
    color: var(--white);
}

.contact-button.phone:hover {
    background-color: #e05d00;
    color: var(--white);
    transform: translateY(-3px);
}

/* Responsive Styles */
@media (max-width: 992px) {
    .feedback-header-content h1 {
        font-size: 2.2rem;
    }

    .feedback-subtitle {
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .ceo-info {
        flex-direction: column;
    }

    .ceo-details {
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 768px) {
    .feedback-header {
        min-height: 250px;
        padding: 60px 0 80px;
    }

    .feedback-header-content h1 {
        font-size: 1.8rem;
    }

    .ceo-image {
        margin-bottom: 2rem;
    }

    .connect-buttons {
        flex-direction: column;
    }

    .connect-btn {
        width: 100%;
        justify-content: center;
    }

    .contact-buttons {
        flex-direction: column;
    }

    .contact-button {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .feedback-header {
        min-height: 200px;
        padding: 50px 0 70px;
    }

    .feedback-header-content h1 {
        font-size: 1.5rem;
    }

    .breadcrumb-wrapper {
        padding: 0.4rem 1rem;
    }

    .video-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Video player functionality
    $('.video-wrapper').on('click', function() {
        var videoID = $(this).data('id');
        var iframe = $('<iframe/>', {
            src: 'https://www.youtube.com/embed/' + videoID + '?autoplay=1',
            frameborder: '0',
            allow: 'autoplay; encrypted-media',
            allowfullscreen: '1'
        });
        $(this).empty().append(iframe);
    });

    // Accordion functionality
    $('.accordion-title a').on('click', function() {
        $(this).attr('aria-expanded', function(i, attr) {
            return attr == 'true' ? 'false' : 'true';
        });
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        if (this.hash !== '') {
            e.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 100
            }, 800);
        }
    });
});
</script>
@endpush