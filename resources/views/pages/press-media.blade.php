@extends('layouts.app')
@section('title', 'Press Release')
@section('keywords', 'Andaman Bliss™ press release, Andaman travel related news, Andaman tourism updates, Andaman tour packages, Best Travel Agency In Andaman, Andaman travel media')
@section('description', 'Read the latest press releases from Andaman Bliss™, featuring travel updates, tourism news, and important announcements about the company')
@section('content')
<!-- Press Release Header Banner -->
<section class="press-header">
    <div class="press-overlay"></div>
    <div class="container">
        <div class="press-header-content">
            <h1 class="text-white">Press <span class="text-gradient">Releases</span></h1>
            <p class="press-subtitle">Stay informed with the latest news and announcements from Andaman Bliss™</p>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Press Releases</li>
                    </ol>
                </nav>
            </div>
            <a href="#press-releases" class="btn btn-primary-payment scroll-to-press">
                <i class="fas fa-arrow-down me-2"></i> View Press Releases
            </a>
        </div>
    </div>
    <div class="press-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

<!-- Press Release Content -->
<section id="press-releases" class="press-content py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2>Latest <span>Press Releases</span></h2>
                    <p class="section-subtitle">Discover our recent media coverage and company announcements</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Press Release Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card h-100">
                    <div class="press-card-img">
                        <img src="{{ asset('site/img/andamanbliss-press-img.avif') }}" class="img-fluid" alt="Press Release"
                            loading="lazy">
                    </div>
                    <div class="press-card-body">
                        <div class="press-date">
                            <i class="far fa-calendar-alt"></i> May 16, 2025
                        </div>
                        <h3 class="press-title">Andaman Bliss™ Sets a New Benchmark in Island Tourism with Affordable and Customizable Packages</h3>
                        <p class="press-excerpt">
                            Andaman Bliss™ is a renowned travel agency in the Andaman Islands, we are creating new waves with our reimagined and innovative method as India's tourism industry keeps growing steadily. Our goal is to provide the guests with amazing experiences at a reasonable cost....
                        </p>
                        <a href="https://www.business-standard.com/content/press-releases-ani/andaman-bliss-sets-a-new-benchmark-in-island-tourism-with-affordable-and-customizable-packages-125051600508_1.html"
                            class="press-read-more">
                            Read Full Article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Press Release Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card h-100">
                    <div class="press-card-img">
                        <img src="{{ asset('site/img/andamanbliss-press-img2.webp') }}" class="img-fluid" alt="Press Release"
                            loading="lazy">
                    </div>
                    <div class="press-card-body">
                        <div class="press-date">
                            <i class="far fa-calendar-alt"></i> April 12, 2023
                        </div>
                        <h3 class="press-title">Andaman Bliss™ Tours and Travel Agency Launches with a Mission to Help Travelers</h3>
                        <p class="press-excerpt">
                            Andaman, the exotic Indian archipelago, is known for its pristine beaches, crystal-clear waters, lush forests, and colorful marine life. For many tourists, this paradise on earth is the ultimate destination for relaxation and adventure....
                        </p>
                        <a href="https://www.hindustanbytes.com/andaman-bliss-tours-and-travel-agency-launches-with-a-mission-to-help-travelers"
                            class="press-read-more">
                            Read Full Article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Press Release Card 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card h-100">
                    <div class="press-card-img">
                        <img src="{{ asset('site/img/andamanbliss-press-img3.jpg') }}" class="img-fluid" alt="Press Release"
                            loading="lazy">
                    </div>
                    <div class="press-card-body">
                        <div class="press-date">
                            <i class="far fa-calendar-alt"></i> August 21, 2023
                        </div>
                        <h3 class="press-title">Allow Andaman Bliss™ to assist in helping you plan your subsequent visit to the Andaman and Nicobar Islands</h3>
                        <p class="press-excerpt">
                            The Andaman and Nicobar Islands stand out in the broad fabric of India’s diversified topography for its distinct and intriguing scenery. The environment here, amidst the calm azure seas of the Indian Ocean, presents a story of astounding beauty and incomparable intrigue....
                        </p>
                        <a href="https://republicnewsindia.com/allow-andaman-bliss-to-assist-in-helping-you-plan-your-subsequent-visit-to-the-andaman-and-nicobar-islands/" class="press-read-more">
                            Read Full Article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Media Coverage Section -->
<section class="media-coverage py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2>Media <span>Coverage</span></h2>
                    <p class="section-subtitle">Andaman Bliss™ in the news and media</p>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-10">
                <div class="media-logos">
                    <div class="row align-items-center justify-content-center g-4">
                        <div class="col-md-3 col-6 text-center">
                            <img src="{{ asset('site/img/business-standard-press1.avif') }}" alt="Media Logo"
                                class="img-fluid media-logo">
                        </div>
                        <div class="col-md-3 col-6 text-center">
                            <img src="{{ asset('site/img/the_tribune_press4.webp') }}" alt="Media Logo"
                                class="img-fluid media-logo">
                        </div>
                        <div class="col-md-3 col-6 text-center">
                            <img src="{{ asset('site/img/republic-news-press3.png') }}" alt="Media Logo"
                                class="img-fluid media-logo">
                        </div>
                        <div class="col-md-3 col-6 text-center">
                            <img src="{{ asset('site/img/industan_press6.webp') }}" alt="Media Logo"
                                class="img-fluid media-logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<div class="section-block py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2>Frequently <span>Asked Questions</span></h2>
                    <p class="section-subtitle">Find More About Andaman Bliss™ Through Our Press Releases</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="panel-group faq-block pt-1" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="row">
                    <!-- LEFT COLUMN -->
                    <div class="col-lg-6">
                    <!-- FAQ 1 -->
                    <div class="panel panel-default accordion">
                        <div class="panel-heading accordion-heading" role="tab" id="headingOne">
                        <h4 class="panel-title accordion-title">
                            <a href="javascript:void(0)" class="btn-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" role="tab"
                            id="tabOne">
                            1. Where is Andaman Bliss™ located?
                            </a>
                        </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabOne"
                        data-parent="#accordion">
                        <div class="panel-body accordion-body">
                            <p>We are a travel agency in house, our head office is located in the Andaman Islands, with operational presence in Port Blair...</p>
                        </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="panel panel-default accordion">
                        <div class="panel-heading accordion-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title accordion-title">
                            <a href="javascript:void(0)" class="btn-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="tab"
                            id="tabTwo">
                            2. Do we offer customisable travel packages?
                            </a>
                        </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabTwo"
                        data-parent="#accordion">
                        <div class="panel-body accordion-body">
                            <p>Well Absolutely! We understand that every traveler is unique... </p>
                        </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="panel panel-default accordion">
                        <div class="panel-heading accordion-heading" role="tab" id="headingThree">
                        <h4 class="panel-title accordion-title">
                            <a href="javascript:void(0)" class="btn-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" role="tab"
                            id="tabThree">
                            3. What are our customer support hours?
                            </a>
                        </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabThree"
                        data-parent="#accordion">
                        <div class="panel-body accordion-body">
                            <p>Our support team is available 24/7 to assist you...</p>
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="col-lg-6">
                    <!-- FAQ 4 -->
                    <div class="panel panel-default accordion">
                        <div class="panel-heading accordion-heading" role="tab" id="headingTen">
                        <h4 class="panel-title accordion-title">
                            <a href="javascript:void(0)" class="btn-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen" role="tab"
                            id="tabTen">
                            4. How can I contact Andaman Bliss™?
                            </a>
                        </h4>
                        </div>
                        <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabTen"
                        data-parent="#accordion">
                        <div class="panel-body accordion-body">
                            <p>You can reach us via email, phone, WhatsApp, or social media...</p>
                        </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="panel panel-default accordion">
                        <div class="panel-heading accordion-heading" role="tab" id="headingEleven">
                        <h4 class="panel-title accordion-title">
                            <a href="javascript:void(0)" class="btn-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven" role="tab"
                            id="tabEleven">
                            5. What services does Andaman Bliss™ offer?
                            </a>
                        </h4>
                        </div>
                        <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabEleven"
                        data-parent="#accordion">
                        <div class="panel-body accordion-body">
                            <p>We provide complete travel solutions including tour packages, hotel bookings, and more...</p>
                        </div>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="panel panel-default accordion">
                        <div class="panel-heading accordion-heading" role="tab" id="headingTwelve">
                        <h4 class="panel-title accordion-title">
                            <a href="javascript:void(0)" class="btn-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve" role="tab"
                            id="tabTwelve">
                            6. Is Andaman Bliss™ a licensed travel agency?
                            </a>
                        </h4>
                        </div>
                        <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabTwelve"
                        data-parent="#accordion">
                        <div class="panel-body accordion-body">
                            <p>Yes, Andaman Bliss™ is a fully licensed and registered travel agency...</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div> <!-- /.row -->
                </div> <!-- /.panel-group -->
            </div>
        </div>
    </div>
</div>

<!-- Contact Press Team -->
<section class="press-contact py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="press-contact-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3>Contact Our Press Team</h3>
                            <p>For media inquiries, interview requests, or additional information about Andaman Bliss™,
                                please contact our press team.</p>
                            <div class="contact-info">
                                <p><i class="fas fa-envelope"></i> <a
                                        href="mailto:press@andamanbliss.com">press@andamanbliss.com</a></p>
                                <p><i class="fas fa-phone-alt"></i> <a href="tel:+918900909900">+91 8900909900</a></p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
                            <a href="{{ url('contact') }}" class="btn press-contact-btn">Contact Us</a>
                        </div>
                    </div>
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
    --box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
}

/* Press Header */
.press-header {
    position: relative;
    background-image: url('https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1473&q=80');
    background-size: cover;
    background-position: center;
    min-height: 300px;
    display: flex;
    align-items: center;
    color: var(--white);
    padding: 80px 0 100px;
    overflow: hidden;
}

.press-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(17, 157, 213, 0.7) 100%);
    z-index: 1;
}

.press-header .container {
    z-index: 2;
    position: relative;
}

.press-header-content {
    padding: 2rem 0;
    text-align: center;
}

.press-header-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.press-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
}

.text-gradient {
    background: linear-gradient(to right, rgb(213 204 17), #fd6e0f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 800;
    display: inline-block;
}

.breadcrumb-wrapper {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    margin-bottom: 1.5rem;
}

.breadcrumb {
    margin-bottom: 0;
    padding: 0;
    background-color: transparent;
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

.press-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.press-shape svg {
    width: 100%;
    height: 80px;
}

.btn-primary-payment {
    background-color: var(--secondary-color);
    color: var(--white);
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
}

.btn-primary-payment:hover {
    background-color: #e05d00;
    color: var(--white);
    transform: translateY(-3px);
}

/* Section Title */
.section-title {
    margin-bottom: 2.5rem;
}

.section-title h2 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--text-dark);
    position: relative;
    display: inline-block;
}

.section-title h2 span {
    color: var(--primary-color);
}

.section-title h2:after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    border-radius: 10px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-light);
    max-width: 700px;
    margin: 0 auto;
}

/* Press Cards */
.press-card {
    background-color: var(--white);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    transition: all 0.3s ease;
}

.press-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.press-card-img {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.press-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.press-card:hover .press-card-img img {
    transform: scale(1.05);
}

.press-card-body {
    padding: 1.5rem;
}

.press-date {
    display: inline-block;
    background-color: var(--primary-light);
    color: var(--primary-color);
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    margin-bottom: 1rem;
}

.press-date i {
    margin-right: 5px;
}

.press-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--text-dark);
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.press-excerpt {
    color: var(--text-light);
    font-size: 0.95rem;
    line-height: 1.7;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.press-read-more {
    display: inline-flex;
    align-items: center;
    color: var(--secondary-color);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.press-read-more i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.press-read-more:hover {
    color: var(--primary-color);
}

.press-read-more:hover i {
    transform: translateX(5px);
}

/* Media Logos */
.media-logos {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--box-shadow);
}

.media-logo {
    max-height: 60px;
    opacity: 0.7;
    transition: all 0.3s ease;
    filter: grayscale(100%);
}

.media-logo:hover {
    opacity: 1;
    filter: grayscale(0%);
}

/* Press Contact */
.press-contact-card {
    background-color: var(--white);
    border-radius: var(--border-radius);
    padding: 2.5rem;
    box-shadow: var(--box-shadow);
    border-left: 5px solid var(--primary-color);
}

.press-contact-card h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--text-dark);
}

.press-contact-card p {
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.contact-info p {
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.contact-info i {
    color: var(--primary-color);
    margin-right: 10px;
    font-size: 1.1rem;
}

.contact-info a {
    color: var(--text-dark);
    text-decoration: none;
    transition: all 0.3s ease;
}

.contact-info a:hover {
    color: var(--primary-color);
}

.press-contact-btn {
    background-color: var(--secondary-color);
    color: var(--white);
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.press-contact-btn:hover {
    background-color: var(--primary-color);
    color: var(--white);
    transform: translateY(-3px);
}

/* Responsive Styles */
@media (max-width: 991px) {
    .press-header {
        min-height: 300px;
    }

    .press-header-content h1 {
        font-size: 2.3rem;
    }

    .press-subtitle {
        font-size: 1.1rem;
    }

    .section-title h2 {
        font-size: 1.8rem;
    }

    .press-card {
        margin-bottom: 20px;
    }

    .press-contact-card {
        padding: 1.5rem;
    }
}

@media (max-width: 767px) {
    .press-header {
        padding: 60px 0 80px;
        min-height: 250px;
    }

    .press-header-content h1 {
        font-size: 2rem;
    }

    .press-subtitle {
        font-size: 1rem;
    }

    .breadcrumb-wrapper {
        padding: 0.4rem 1rem;
    }

    .section-title h2 {
        font-size: 1.6rem;
    }

    .press-card-img {
        height: 180px;
    }

    .press-contact-card h3 {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .press-header {
        min-height: 200px;
        padding: 50px 0 70px;
    }

    .press-header-content h1 {
        font-size: 1.5rem;
    }

    .press-subtitle {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .breadcrumb-wrapper {
        padding: 0.3rem 0.8rem;
        margin-bottom: 1rem;
    }

    .btn-primary-payment {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Add animation to press cards on scroll
    function animateOnScroll() {
        $('.press-card').each(function() {
            var cardPosition = $(this).offset().top;
            var topOfWindow = $(window).scrollTop();
            var windowHeight = $(window).height();

            if (cardPosition < topOfWindow + windowHeight - 100) {
                $(this).addClass('animated');
            }
        });
    }

    // Run animation on page load
    animateOnScroll();

    // Run animation on scroll
    $(window).scroll(function() {
        animateOnScroll();
    });

    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();

        var target = this.hash;
        var $target = $(target);

        $('html, body').animate({
            'scrollTop': $target.offset().top - 100
        }, 800, 'swing');
    });

    // Smooth scroll to press releases
    $('.scroll-to-press').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#press-releases').offset().top - 80
        }, 800);
    });
});
</script>
@endpush