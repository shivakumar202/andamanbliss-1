@extends('layouts.app')
@section('title', 'FAQ')
@section('keywords', 'Andaman FAQs, Andaman travel questions, Andaman Islands travel guide, best time to visit Andaman, Andaman tour packages FAQs, visa for Andaman, Andaman travel tips, Andaman honeymoon FAQs, Andaman family trip questions')
@section('description', 'Find answers to all your travel queries about the Andaman Islands. From the best time to visit to package details. Plan your dream vacation with confidence.')
@push('styles')
<style>
/* Modern FAQ Page Styles */
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

/* FAQ Header - Matching Careers Page Style */
.faq-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, #0066cc 100%);
    background-size: cover;
    background-position: center;
    padding: 100px 0 80px;
    position: relative;
    overflow: hidden;
}

.faq-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(0, 102, 204, 0.8) 100%);
    z-index: 1;
}

.faq-header .container {
    z-index: 2;
    position: relative;
}

.faq-header-content {
    padding: 2rem 0;
    text-align: center;
    color: white;
}

.faq-header-content h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.text-gradient {
    background: linear-gradient(to right, #fff, var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 800;
}

.faq-subtitle {
    font-size: 1.3rem;
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

.faq-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.faq-shape svg {
    width: 100%;
    height: 80px;
}

/* FAQ Intro Section */
.faq-intro-section {
    padding: 60px 0 30px;
    background-color: var(--white);
}

.faq-intro-container {
    padding: 2.5rem;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 2rem;
    transition: all 0.3s ease;
}

.faq-intro-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.faq-icon {
    width: 90px;
    height: 90px;
    background-color: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    transition: all 0.3s ease;
}

.faq-icon i {
    font-size: 2.8rem;
    color: var(--primary-color);
    transition: all 0.3s ease;
}

.faq-intro-container:hover .faq-icon {
    background-color: var(--primary-color);
}

.faq-intro-container:hover .faq-icon i {
    color: var(--white);
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.faq-search-container {
    margin-top: 2rem;
}

.faq-search-box {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
}

.search-icon {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    font-size: 1.2rem;
}

.faq-search-input {
    width: 100%;
    padding: 15px 20px 15px 50px;
    border: 2px solid rgba(17, 157, 213, 0.2);
    border-radius: 50px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.faq-search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(17, 157, 213, 0.2);
}

/* FAQ Content Section */
.faq-content-section {
    padding: 30px 0 80px;
    background-color: #f8f9fa;
}

.faq-content-container {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2.5rem;
    overflow: hidden;
}

.section-intro {
    text-align: center;
    margin-bottom: 2.5rem;
}

.section-subtitle {
    display: inline-block;
    background-color: var(--primary-light);
    color: var(--primary-color);
    padding: 0.5rem 1.2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

/* FAQ Category Tabs */
.faq-category-tabs {
    margin-bottom: 2rem;
}

.nav-pills .nav-link {
    padding: 12px 25px;
    border-radius: 50px;
    margin: 0 5px 10px;
    color: var(--text-dark);
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.nav-pills .nav-link i {
    margin-right: 8px;
    font-size: 1.1rem;
}

.nav-pills .nav-link.active {
    background-color: var(--primary-color);
    color: white;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
}

/* FAQ Accordion Styling */
.faq-category {
    background-color: var(--white);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
}

.category-header {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.category-icon {
    width: 50px;
    height: 50px;
    background-color: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

.category-icon i {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.category-header h3 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.accordion {
    border: none;
    margin-bottom: 1rem;
}

.accordion-heading {
    padding: 0;
    border: none;
    background-color: transparent;
}

.accordion-title {
    margin: 0;
    font-size: 1rem;
    font-weight: 500;
}

.accordion-title a {
    display: block;
    padding: 1.2rem 1.5rem;
    color: var(--text-dark);
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.accordion-title a:hover {
    color: var(--primary-color);
}

.accordion-title a:after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.3s ease;
}

.accordion-title a:not(.collapsed):after {
    transform: translateY(-50%) rotate(180deg);
    color: var(--primary-color);
}

.accordion-body {
    padding: 1.5rem;
    color: var(--text-light);
    background-color: rgba(17, 157, 213, 0.03);
}

.accordion-body p {
    margin-bottom: 0;
    line-height: 1.6;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .faq-header-content h1 {
        font-size: 2.5rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .faq-content-container {
        padding: 1.5rem;
    }
}

@media (max-width: 767px) {
    .faq-header {
        padding: 80px 0 60px;
    }

    .faq-header-content h1 {
        font-size: 2rem;
    }

    .faq-subtitle {
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 1.8rem;
    }

    .nav-pills .nav-link {
        padding: 10px 15px;
        font-size: 0.9rem;
    }
}
</style>
@endpush

@section('content')
<!-- Header Section -->
<section class="faq-header">
    <div class="faq-overlay"></div>
    <div class="container">
        <div class="faq-header-content">
            <h1 class="text-white">Frequently Asked <span class="text-gradient">Questions</span></h1>
            <p class="faq-subtitle">Find answers to common questions about our services</p>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="faq-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

<!-- FAQ Introduction -->
<section class="faq-intro-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="faq-intro-container text-center">
                    <div class="faq-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <h2 class="section-title"><span style="color: rgb(17, 157, 213);">Do you have some</span> <span
                            style="color: #fd6e0f;">Questions?</span></h2>
                    <p class="lead" >Welcome to your new go-to source for unforgettable travel experiences and exclusive
                        tour packages with AndamanBliss Tour and Travel.</p>
                    <div class="faq-search-container">
                        <div class="faq-search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="faqSearch" placeholder="Search for questions..."
                                class="faq-search-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content Section -->
<section class="faq-content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="faq-content-container">
                    <div class="section-intro text-center mb-4">
                        <span class="section-subtitle">Common Questions</span>
                        <h2 class="section-title"><span style="color: rgb(17, 157, 213);">Find Your</span> <span
                                style="color: #fd6e0f;">Answers</span></h2>
                        <p class="lead">Browse through our most frequently asked questions by category</p>
                    </div>

                    <!-- FAQ Category Tabs -->
                    <div class="faq-category-tabs">
                        <ul class="nav nav-pills mb-4" id="faqCategoryTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="general-tab" data-bs-toggle="pill"
                                    data-bs-target="#general" type="button" role="tab" aria-controls="general"
                                    aria-selected="true">
                                    <i class="fas fa-info-circle"></i> General
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="travel-tab" data-bs-toggle="pill" data-bs-target="#travel"
                                    type="button" role="tab" aria-controls="travel" aria-selected="false">
                                    <i class="fas fa-plane"></i> Travel
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="booking-tab" data-bs-toggle="pill"
                                    data-bs-target="#booking" type="button" role="tab" aria-controls="booking"
                                    aria-selected="false">
                                    <i class="fas fa-calendar-check"></i> Booking
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payment-tab" data-bs-toggle="pill"
                                    data-bs-target="#payment" type="button" role="tab" aria-controls="payment"
                                    aria-selected="false">
                                    <i class="fas fa-credit-card"></i> Payment
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Accordions START -->
                    <div class="tab-content" id="faqCategoryContent" style="text-align:justify">
                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                            aria-labelledby="general-tab">
                            <div class="faq-accordion-container">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-info-circle"></i>
                                                </div>
                                                <h3>General Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingOne">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="false"
                                                            aria-controls="collapseOne" href="#">
                                                            1. What is the best time to visit the Andaman Islands?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse"
                                                    aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>The best time to visit the Andaman Islands is between October
                                                            and May, during the dry season when the weather is pleasant
                                                            and ideal for sightseeing and water activities. The monsoon
                                                            season (June to September) can bring heavy rain, which might
                                                            disrupt outdoor plans, though it can be a good time for
                                                            budget travelers.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingTwo">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                                            aria-controls="collapseTwo" href="#">
                                                            2. What are the top attractions in the Andaman Islands?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse"
                                                    aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Some of the must-visit attractions include Radhanagar Beach,
                                                            Cellular Jail, Ross Island, Havelock Island, Neil Island,
                                                            Baratang Limestone Caves and North Bay Island. For adventure
                                                            lovers, snorkeling, scuba diving and sea walking are highly
                                                            recommended activities.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Right Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-info-circle"></i>
                                                </div>
                                                <h3>General Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingThree">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="false"
                                                            aria-controls="collapseThree" href="#">
                                                            3. How many days should I spend in the Andaman Islands?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse"
                                                    aria-labelledby="headingThree" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>A trip of 5 to 7 days is ideal to explore the key attractions
                                                            and islands at a relaxed pace. A 3-day trip can cover the
                                                            essentials of Port Blair and Havelock Island, but for a more
                                                            immersive experience, consider extending your stay to visit
                                                            Neil Island and other remote spots.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingFour">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFour" aria-expanded="false"
                                                            aria-controls="collapseFour" href="#">
                                                            4. What are the transportation options available on the
                                                            Andaman Islands?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFour" class="panel-collapse collapse"
                                                    aria-labelledby="headingFour" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Transportation within the Andaman Islands primarily includes
                                                            ferries, private cabs, buses and rented bikes or cars.
                                                            Ferries connect major islands like Port Blair, Havelock and
                                                            Neil. For local travel, auto rickshaws, cab rentals, or bike
                                                            rentals are convenient.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Travel Tab -->
                        <div class="tab-pane fade" id="travel" role="tabpanel" aria-labelledby="travel-tab">
                            <div class="faq-accordion-container">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-plane"></i>
                                                </div>
                                                <h3>Travel Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingFive">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFive" aria-expanded="false"
                                                            aria-controls="collapseFive" href="#">
                                                            1. What documents are required for visiting Andaman Islands?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFive" class="panel-collapse collapse"
                                                    aria-labelledby="headingFive" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>For Indian citizens, a valid government photo ID is
                                                            sufficient. Foreign nationals need a valid passport and
                                                            visa. No special permits are required for most tourist
                                                            areas, but some remote islands may require additional
                                                            permissions.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingSix">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseSix" aria-expanded="false"
                                                            aria-controls="collapseSix" href="#">
                                                            2. What is the weather like in Andaman Islands?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseSix" class="panel-collapse collapse"
                                                    aria-labelledby="headingSix" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>The Andaman Islands have a tropical climate with temperatures
                                                            ranging from 23°C to 31°C throughout the year. The islands
                                                            experience two main seasons: dry (October to May) and
                                                            monsoon (June to September). The humidity levels are
                                                            generally high throughout the year.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Right Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-plane"></i>
                                                </div>
                                                <h3>Travel Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingSeven">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseSeven" aria-expanded="false"
                                                            aria-controls="collapseSeven" href="#">
                                                            3. What activities are available in Andaman Islands?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseSeven" class="panel-collapse collapse"
                                                    aria-labelledby="headingSeven" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>The Andaman Islands offer various activities including scuba
                                                            diving, snorkeling, sea walking, glass-bottom boat rides,
                                                            trekking, bird watching, and historical site visits. Water
                                                            sports are particularly popular at beaches like Corbyn's
                                                            Cove and North Bay.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingEight">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseEight" aria-expanded="false"
                                                            aria-controls="collapseEight" href="#">
                                                            4. What should I pack for my Andaman trip?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseEight" class="panel-collapse collapse"
                                                    aria-labelledby="headingEight" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Pack light, comfortable clothing, swimwear, sunscreen, insect
                                                            repellent, and comfortable walking shoes. Don't forget your
                                                            camera, basic medicines, and necessary documents. For water
                                                            activities, consider bringing your own snorkeling gear
                                                            though rentals are available.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Tab -->
                        <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                            <div class="faq-accordion-container">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                                <h3>Booking Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingNine">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseNine" aria-expanded="false"
                                                            aria-controls="collapseNine" href="#">
                                                            1. How do I book a tour package?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseNine" class="panel-collapse collapse"
                                                    aria-labelledby="headingNine" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>You can book a tour package through our website by selecting
                                                            your preferred package and following the booking process.
                                                            Alternatively, you can contact our customer service team who
                                                            will guide you through the booking process and help
                                                            customize your package.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingTen">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTen" aria-expanded="false"
                                                            aria-controls="collapseTen" href="#">
                                                            2. Can I customize my tour package?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTen" class="panel-collapse collapse"
                                                    aria-labelledby="headingTen" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Yes, we offer customizable tour packages. You can modify the
                                                            itinerary, choose specific activities, select your preferred
                                                            accommodation, and adjust the duration of your stay
                                                            according to your preferences and budget.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Right Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>
                                                <h3>Booking Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingEleven">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseEleven" aria-expanded="false"
                                                            aria-controls="collapseEleven" href="#">
                                                            3. What is your cancellation policy?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseEleven" class="panel-collapse collapse"
                                                    aria-labelledby="headingEleven" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Our cancellation policy varies depending on the package and
                                                            timing of cancellation. Generally, cancellations made 30
                                                            days before arrival receive a full refund, while later
                                                            cancellations may incur charges. Please refer to your
                                                            booking confirmation for specific details.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingTwelve">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwelve" aria-expanded="false"
                                                            aria-controls="collapseTwelve" href="#">
                                                            4. How far in advance should I book my tour?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwelve" class="panel-collapse collapse"
                                                    aria-labelledby="headingTwelve" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>We recommend booking at least 2-3 months in advance,
                                                            especially during peak season (October to May). This ensures
                                                            better availability of accommodations and activities, and
                                                            often better rates. Last-minute bookings are possible but
                                                            may have limited options.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Tab -->
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="faq-accordion-container">
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-credit-card"></i>
                                                </div>
                                                <h3>Payment Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingThirteen">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThirteen" aria-expanded="false"
                                                            aria-controls="collapseThirteen" href="#">
                                                            1. What payment methods do you accept?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThirteen" class="panel-collapse collapse"
                                                    aria-labelledby="headingThirteen" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>We accept various payment methods including credit/debit
                                                            cards (Visa, MasterCard, American Express), net banking,
                                                            UPI, and digital wallets. International payments can be made
                                                            through secure payment gateways. We also accept bank
                                                            transfers for certain bookings.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingFourteen">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFourteen" aria-expanded="false"
                                                            aria-controls="collapseFourteen" href="#">
                                                            2. Is my payment information secure?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFourteen" class="panel-collapse collapse"
                                                    aria-labelledby="headingFourteen" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Yes, all payments are processed through secure payment
                                                            gateways with SSL encryption. We do not store your credit
                                                            card information. Our payment system complies with
                                                            international security standards to ensure safe
                                                            transactions.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Right Column -->
                                    <div class="col-lg-6">
                                        <div class="faq-category mb-4">
                                            <div class="category-header">
                                                <div class="category-icon">
                                                    <i class="fas fa-credit-card"></i>
                                                </div>
                                                <h3>Payment Information</h3>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingFifteen">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFifteen" aria-expanded="false"
                                                            aria-controls="collapseFifteen" href="#">
                                                            3. What is your refund policy?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFifteen" class="panel-collapse collapse"
                                                    aria-labelledby="headingFifteen" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Refunds are processed according to our cancellation policy.
                                                            Once approved, refunds typically take 5-7 business days for
                                                            credit card payments and 3-5 business days for bank
                                                            transfers. The exact timing may vary depending on your bank
                                                            and payment method.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default accordion">
                                                <div class="panel-heading accordion-heading" id="headingSixteen">
                                                    <h4 class="panel-title accordion-title">
                                                        <a class="btn-link collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseSixteen" aria-expanded="false"
                                                            aria-controls="collapseSixteen" href="#">
                                                            4. Do you offer installment payment options?
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseSixteen" class="panel-collapse collapse"
                                                    aria-labelledby="headingSixteen" data-parent="#accordion">
                                                    <div class="panel-body accordion-body">
                                                        <p>Yes, for certain packages we offer installment payment
                                                            options. Typically, this includes an initial deposit
                                                            followed by scheduled payments. The availability and terms
                                                            of installment payments depend on the package value and
                                                            timing of your booking.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- Accordions END -->
            </div>
        </div>

    </div>


    <div class="row">
        <h2 class="text-center pt-5">Can’t find what you are looking for?</h2>
        <div class="contact-buttons d-flex justify-content-center gap-4 pt-3">
            <!-- Email Us button -->
            <a href="mailto:info@andamanbliss.com" class="contact-btn email-btn">
                <i class="fas fa-envelope"></i> Email Us
            </a>

            <!-- Contact Us button -->
            <a href="{{ url('contact') }}" class="contact-btn contact-page-btn">
                <i class="fas fa-phone-alt"></i> Contact Us
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/faq-fix-final.css') }}">
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
.faq-header {
    position: relative;
    background-image: url('https://images.unsplash.com/photo-1596178065887-1198b6148b2b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
    background-size: cover;
    background-position: center;
    min-height: 300px;
    display: flex;
    align-items: center;
    color: var(--white);
    padding: 80px 0 100px;
    overflow: hidden;
}

.faq-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(17, 157, 213, 0.7) 100%);
    z-index: 1;
}

.faq-header .container {
    z-index: 2;
    position: relative;
}

.faq-header-content {
    padding: 2rem 0;
    text-align: center;
}

.faq-header-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.faq-subtitle {
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

.faq-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.faq-shape svg {
    width: 100%;
    height: 80px;
}

/* FAQ Intro Section */
.faq-intro-section {
    padding: 60px 0 30px;
    background-color: var(--white);
}

.faq-intro-container {
    padding: 2rem;
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 2rem;
}

.faq-icon {
    width: 80px;
    height: 80px;
    background-color: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.faq-icon i {
    font-size: 2.5rem;
    color: var(--primary-color);
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.text-gradient {
    color: var(--secondary-color);
    font-weight: 800;
}

.faq-search-container {
    margin-top: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.faq-search-box {
    position: relative;
    width: 100%;
}

.search-icon {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
}

.faq-search-input {
    width: 100%;
    padding: 1rem 1rem 1rem 50px;
    border: 1px solid #e0e0e0;
    border-radius: 50px;
    font-size: 1rem;
    transition: var(--transition);
}

.faq-search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--primary-light);
}

/* FAQ Content Section */
.faq-content-section {
    padding: 30px 0 80px;
    background-color: var(--light-bg);
}

.faq-content-container {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2rem;
    overflow: hidden;
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

.lead {
    font-size: 1.1rem;
    color: var(--text-light);
    max-width: 800px;
    margin: 0 auto;
}

/* FAQ Category Tabs */
.faq-category-tabs {
    margin-bottom: 2rem;
}

.nav-pills {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.5rem;
}

.nav-pills .nav-link {
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    color: var(--text-dark);
    background-color: #f0f0f0;
    transition: var(--transition);
    display: flex;
    align-items: center;
}

.nav-pills .nav-link i {
    margin-right: 0.5rem;
    font-size: 1.1rem;
}

.nav-pills .nav-link.active {
    background-color: var(--primary-color);
    color: var(--white);
}

.nav-pills .nav-link:hover:not(.active) {
    background-color: #e0e0e0;
}

/* Accordion Styles */
.accordion-item {
    border: none;
    margin-bottom: 1rem;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.accordion-button {
    padding: 1.25rem 1.5rem;
    font-weight: 600;
    color: var(--text-dark);
    background-color: var(--white);
    border: none;
    box-shadow: none;
}

.accordion-button:not(.collapsed) {
    color: var(--primary-color);
    background-color: var(--primary-light);
    box-shadow: none;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
}

.accordion-button::after {
    background-size: 1.25rem;
    transition: var(--transition);
}

.accordion-body {
    padding: 1.25rem 1.5rem;
    color: var(--text-light);
    line-height: 1.7;
}

/* Category Styles */
.category-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.category-icon {
    width: 40px;
    height: 40px;
    background-color: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.category-icon i {
    font-size: 1.2rem;
    color: var(--primary-color);
}

.category-header h3 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0;
}

/* Contact Button Styles */
.contact-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.8rem 1.8rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
}

.contact-btn i {
    margin-right: 0.5rem;
}

.email-btn {
    background-color: var(--primary-color);
    color: var(--white);
}

.email-btn:hover {
    background-color: #0e8bc0;
    color: var(--white);
    transform: translateY(-3px);
}

.contact-page-btn {
    background-color: var(--secondary-color);
    color: var(--white);
}

.contact-page-btn:hover {
    background-color: #e05d00;
    color: var(--white);
    transform: translateY(-3px);
}

/* Responsive Styles */
@media (max-width: 992px) {
    .faq-header-content h1 {
        font-size: 2.2rem;
    }

    .faq-subtitle {
        font-size: 1rem;
    }

    .section-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .faq-header {
        min-height: 250px;
        padding: 60px 0 80px;
    }

    .faq-header-content h1 {
        font-size: 1.8rem;
    }

    .nav-pills {
        flex-direction: column;
        align-items: center;
    }

    .nav-pills .nav-link {
        width: 100%;
        text-align: center;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .faq-header {
        min-height: 200px;
        padding: 50px 0 70px;
    }

    .faq-header-content h1 {
        font-size: 1.5rem;
    }

    .breadcrumb-wrapper {
        padding: 0.4rem 1rem;
    }

    .faq-intro-container,
    .faq-content-container {
        padding: 1.5rem 1rem;
    }

    .contact-buttons {
        flex-direction: column;
        gap: 1rem;
    }

    .contact-btn {
        width: 100%;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Search functionality
    $('#faqSearch').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();

        $('.accordion-item').each(function() {
            var questionText = $(this).find('.accordion-button').text().toLowerCase();
            var answerText = $(this).find('.accordion-body').text().toLowerCase();

            if (questionText.indexOf(searchText) > -1 || answerText.indexOf(searchText) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
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

    // Initialize Bootstrap components
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush