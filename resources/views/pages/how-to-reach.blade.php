@extends('layouts.app')
@section('title', 'How to Reach Andaman Islands | Travel Guide')
@section('keywords', 'how to reach andaman, andaman travel guide, andaman flights, andaman ferry, port blair
airport, andaman islands transport')
@section('description', 'Learn the best ways to reach Andaman and Nicobar Islands by air and sea. Comprehensive
travel guide with flight information, ferry details, and essential travel tips.')
@section('content')

<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>
    <div class="container position-relative z-2">
        <div class="row min-vh-50 align-items-center py-1">
            <div class="col-lg-6 hero-content">
                <div class="animate-fade-in">
                    <div class="badge-wrapper">
                        <span class="hero-badge">Travel Guide</span>
                    </div>
                    <h1 class="hero-title text-white">How to Reach <span class="text-gradient">Andaman</span> Islands
                    </h1>
                    <p class="hero-description">Find the most convenient ways to travel to these breathtaking islands
                        with our comprehensive transportation guide.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('site/img/an-map.png') }}"
                        alt="Andaman Islands Map" class="img-fluid rounded-4 ">
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Introduction Section -->
<section class="content-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="content-card">
                    <h2 class="section-title">How To Reach <span class="text-gradient">The Andaman Islands</span></h2>
                    <div class="content-text">
                        <p>Located almost 1300 kilometers from the India's mainland, the Andaman and Nicobar Islands consists of breathtaking group of Islands, that are known for their immaculate beaches, crystal-clear waters and rich marine life. Located between the southern shores of India, there are only two ways to reach Port Blair the capital of Andaman and Nicobar Islands: <strong>by flight</strong>
                            or <strong>by ship</strong>.</p>

                        <p>Port Blair which was renamed as Sri Vijaya Puram, serves as the main gateway to the Andaman Islands, acting as the entrance point for all visitors who wishes to visit here. As there are no other entry points to get inside the island, Port Blair plays a crucial role in the Andaman Islands transportation system. All travelers, whether coming by sea or flight, must pass through this vibrant capital city before exploring the amazing beauty and cultural diversity of the Andaman Islands.</p>

                        <div class="weather-card my-4 p-3">
                            <h3 class="weather-title"><i class="fas fa-cloud-sun me-2"></i>Current Weather</h3>
                            <a href="https://www.accuweather.com/en/in/port-blair/70/daily-weather-forecast/70"
                                class="weather-link" target="_blank">Check Port Blair Weather <i
                                    class="fas fa-external-link-alt ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-sidebar">
                    <div class="card travel-options-card">
                        <div class="card-header">
                            <h3 class="text-white">Travel Options</h3>
                        </div>
                        <div class="card-body ">
                            <div class="travel-option">
                                <i class="fas fa-plane-departure"></i>
                                <div class="option-details">
                                    <h4>By Air</h4>
                                    <p>3-4 hours from mainland</p>
                                </div>
                            </div>
                            <div class="travel-option">
                                <i class="fas fa-ship"></i>
                                <div class="option-details">
                                    <h4>By Ship</h4>
                                    <p>50-60 hours journey</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- By Air Section -->
<section class="transportation-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center mb-5">
                    <span class="section-subtitle">Travel Option 1</span>
                    <h2 class="section-title"><i class="fas fa-plane-departure me-3 "></i>Reaching Andaman
                        <span class="text-gradient">By Air </span></h2>
                    <div class="section-divider"></div>
                </div>
            </div>
        </div>

        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="content-card h-100">
                    <div class="card-body">
                        <p class="lead" >Taking flight as a mode of transportation is the most practical and popular method to reach the Andaman Islands.
                        </p>
                        <p style="text-align: justify">Veer Savarkar International Airport (IXZ) in Port Blair is the primary airport serving the Andaman and Nicobar Islands. Several major airlines offer regularly scheduled flights from major Indian cities to Port Blair, including Air India, IndiGo, Vistara</p>

                        <p>Travelers can expect the following flight durations:</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-clock"></i> <strong>Chennai/Kolkata to Port Blair:</strong> 1.5-2 hours
                            </li>
                            <li><i class="fas fa-clock"></i> <strong>Bangalore to Port Blair:</strong> 2-3 hours</li>
                            <li><i class="fas fa-clock"></i> <strong>Delhi/Mumbai to Port Blair:</strong> 4-5 hours
                                (seasonal)</li>
                        </ul>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> The Flights operating from Delhi and Mumbai are not always available. Please check and conform the availability so that you can plan your trip accordingly.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="airlines-card h-100">
                    <div class="card-header">
                        <h3 class="text-white">Flights That Operates To The Andaman Islands</h3>
                    </div>
                    <div class="card-body">
                        <div class="airlines-grid">
                            <div class="airline-item">
                                <div class="airline-icon">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <h4>Air India</h4>
                                <p>This is a national carrier operating with regular flights</p>
                            </div>
                            <div class="airline-item">
                                <div class="airline-icon">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <h4>IndiGo</h4>
                                <p>It has vast number of flights operating on a daily basis</p>
                            </div>
                            <div class="airline-item">
                                <div class="airline-icon">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <h4>Vistara</h4>
                                <p>Premium service on select routes</p>
                            </div>
                            <div class="airline-item">
                                <div class="airline-icon">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <h4>SpiceJet</h4>
                                <p>Budget-friendly options available</p>
                            </div>
                            <div class="airline-item">
                                <div class="airline-icon">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <h4>Akasa Air</h4>
                                <p>Newest airline serving Andaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="important-note-card">
                    <div class="note-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="note-content">
                        <h4>Important Information About Flights Operating To The Islands</h4>
                        <ul>
                            <li>There are no evening flights available to the Andaman Islands after sundown</li>
                            <li>First flights typically depart at 7:00 AM from Port Blair, with the last flight departing around 3:00 PM</li>
                            <li>The Veer Savarkar International Airport (IXZ) located in Port Blair is the only commercial airport operating in Andaman</li>
                            <li>There are no international flights operating directly to Andaman Islands- foreign travelers must travel to the mainland first and then visit the Andaman Island.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- By Ship Section -->
<section class="transportation-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center mb-5">
                    <span class="section-subtitle">Travel Option 2</span>
                    <h2 class="section-title"><i class="fas fa-ship me-3 "></i>Reach The Andaman Islans  <span class="text-gradient">By Ship</span></h2>
                    <div class="section-divider"></div>
                </div>
            </div>
        </div>

        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="content-card h-100">
                    <div class="card-body">
                        <p class="lead fw-bolder">Traveling to the Andaman Islands using Ships is not a popular option from flying, but traveling through sea does offers a unique and exciting adventure for those who got a lot of time to spare.</p>
                        <p style="text-align: justify">Ships that carry the passengers are operated by the Indian Government connecting Port Blair with major Indian cities like Chennai, Kolkata and Visakhapatnam. The ship journey usually takes 3 to 4 days i.e typically (60-70 hours). But it purely depends on weather and sea condition.</p>

                        <p>Ship journeys offer various accommodation options:</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-bed"></i> <strong>Bunk Class:</strong> The most affordable option to book.</li>
                            <li><i class="fas fa-bed"></i> <strong>Cabin Class:</strong> Comfort and a Mid-range cabin</li>
                            <li><i class="fas fa-bed"></i> <strong>Deluxe Class:</strong> Premium Cabins and accommodation with modern amenities.</li>
                        </ul>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i> The ship to the Andaman Islands sails atleast 2 - 3 times per month. Booking in advance is necessarily recommended.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ship-experience-card h-100">
                    <div class="card-header">
                        <h3 class="text-white">Get a unique experience with your ship journey</h3>
                    </div>
                    <div class="card-body ">
                        <div class="experience-points">
                            <div class="experience-item p-2">
                                <div class="experience-icon positive">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <div class="experience-content">
                                    <h4>Advantages</h4>
                                    <ul>
                                    <li>Breathtaking and stunning sea views</li>
                                    <li>Unique and beautiful travel experience</li>
                                    <li>It is more economical and cheaper than flying</li>
                                    <li>You get the ability to carry more luggage</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="experience-item">
                                <div class="experience-icon negative">
                                    <i class="fas fa-minus-circle"></i>
                                </div>
                                <div class="experience-content">
                                    <h4>Considerations</h4>
                                    <ul>
                                    <li>Takes long journey duration (3-4 days)</li>
                                    <li>Potential for seasickness</li>
                                    <li>Basic and limited amenities compared to cruise ships</li>
                                    <li>The ship schedule is dependent on weather</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="ship-note m-4">
                            <p><strong>Note:</strong> Haddo Jetty at Port Blair is the main seaport serving the Andaman
                                Islands. The ships operating on this route are passenger and cargo vessels, not luxury
                                cruise liners.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="recommendation-card">
                    <div class="recommendation-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="recommendation-content">
                        <h4>Recommendation Made By Us:</h4>
                        <p>People who travel on a time construct and did plan a small and limited vacation, for those guest we recommend choose flight as your mode of transportation to travel to the Andaman Islands. Flying to the island is considerably faster and does provides a more comfortable and cozy experience.
                        </p>
                        <p>However, if you have time to spare and generally planning to have a longer trip, or want to experience a unique way to travel, then choosing ship as mode of your transportation and get a interesting perspective.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <span class="section-subtitle">Common Questions</span>
                <h2 class="section-title">Frequently Asked  <span class="text-gradient">Questions</span></h2>
                <div class="section-divider"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="accordion faq-accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqOne" aria-expanded="true" aria-controls="faqOne">
                                <i class="fas fa-question-circle me-2"></i> What is the best way to reach the Andaman
                                Islands?
                            </button>
                        </h2>
                        <div id="faqOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Flying is the most efficient and practical way to get to the Andaman Islands. There
                                    are flights to Veer Savarkar International Airport in Port Blair from several major
                                    cities including Chennai, Kolkata, Bangalore, Delhi (seasonal), and Mumbai
                                    (seasonal).</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
                                <i class="fas fa-question-circle me-2"></i> Do I need to book my tickets in advance?
                            </button>
                        </h2>
                        <div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Absolutely, it is strongly advised to purchase your airline tickets early in advance,
                                    particularly from November to March when traveler demand is at its highest.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqThree" aria-expanded="false" aria-controls="faqThree">
                                <i class="fas fa-question-circle me-2"></i> Are there direct train or road routes to the
                                Andaman Islands?
                            </button>
                        </h2>
                        <div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Neither railway nor road travel to the Andaman Islands is possible in a direct way.
                                    You can travel to Chennai, Kolkata, or Visakhapatnam by train, and from there, you
                                    can board a ship or plane to reach Port Blair.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqFour" aria-expanded="false" aria-controls="faqFour">
                                <i class="fas fa-question-circle me-2"></i> What identification documents are required?
                            </button>
                        </h2>
                        <div id="faqFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Indian citizens should always have up-to-date identity documents such as voter ID,
                                    passport, or Aadhar card. Foreign nationals require a Restricted Area Permit (RAP),
                                    which can be acquired upon arrival at Port Blair.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqFive" aria-expanded="false" aria-controls="faqFive">
                                <i class="fas fa-question-circle me-2"></i> What local transport options are available
                                in Port Blair?
                            </button>
                        </h2>
                        <div id="faqFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>In Port Blair, you can get around the city in cabs, autorickshaws, and rental
                                    scooters. Boats and ferries are readily accessible for inter-island transportation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section text-center  rounded-4 mx-auto my-5 p-5">
    <div class="container">
        <h2 class="mb-3 text-white fw-bolder">Ready to Explore Andaman Islands?</h2>
        <p class="lead mb-4 text-white">Let us help you plan your perfect Andaman getaway</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ url('/contact') }}"
                class="btn btn-lg btn-gradient-orange rounded-pill px-4 py-3 text-white">Contact Us</a>
            <a href="{{ url('/tours/packages') }}" class="btn btn-lg btn-outline-light rounded-pill px-4 py-3">View
                Packages</a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style type="text/css">
    :root {
        --color-primary: rgb(17, 157, 213);
        --color-primary-light: rgb(25, 133, 197);
        --color-primary-dark: rgb(15, 120, 180);
        --color-primary-gradient: radial-gradient(circle at center, rgb(17 153 233 / 78%) 0%, rgb(17 157 213) 100%);
        --color-secondary: #f9680f;
        --color-secondary-dark: #df511b;
        --color-secondary-gradient: linear-gradient(135deg, #f9680ff7 0%, #df511b 100%);
        --color-text: #334E6B;
        --color-text-light: #6C8EB3;
        --color-bg-light: #F8FBFF;
        --color-white: #FFFFFF;
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 6px 12px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 15px 25px rgba(0, 0, 0, 0.1);
        --border-radius-sm: 8px;
        --border-radius-md: 12px;
        --border-radius-lg: 20px;
        --transition-fast: all 0.3s ease;
        --transition-medium: all 0.5s ease;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(332deg, #ffffff 0%, #45bbf6 100%);
        position: relative;
        overflow: hidden;
        padding: 80px 0;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgb(255 255 255 / 30%) 0%, rgb(17 157 213) 100%);
        z-index: 1;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+PHJlY3QgaWQ9InBhdHRlcm4tYmciIHdpZHRoPSI0MDAiIGhlaWdodD0iNDAwIiBmaWxsPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMDMpIj48L3JlY3Q+PHBhdGggZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSIgZD0iTTAgMGg0MHY0MEgweiI+PC9wYXRoPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgaGVpZ2h0PSIxMDAlIiB3aWR0aD0iMTAwJSI+PC9yZWN0Pjwvc3ZnPg==');
        opacity: 0.4;
        z-index: 1;
    }

    .z-2 {
        z-index: 2;
        position: relative;
    }

    .min-vh-50 {
        min-height: 50vh;
    }

    .hero-content {
        color: white;
    }

    .animate-fade-in {
        animation: fadeIn 1s ease-out;
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

    .hero-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 25px;
        border-left: 3px solid var(--color-secondary);
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 25px;
        letter-spacing: -0.5px;
    }

    .text-gradient {
        background: linear-gradient(to right, #f9925a, var(--color-secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: var(--color-secondary);
    }

    .hero-description {
        font-size: 1.2rem;
        line-height: 1.6;
        margin-bottom: 35px;
        opacity: 0.9;
        max-width: 90%;
    }

    .hero-image-wrapper {
        position: relative;
        z-index: 2;
        padding: 10px;
        width: 400px;
    }

    /* Content Styles */
    .content-section {
        padding: 60px 0;
    }

    .content-card {
        background-color: #fff;
        border-radius: var(--border-radius-md);
        box-shadow: var(--shadow-sm);
        padding: 30px;
        height: 100%;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--color-heading);
        position: relative;
        display: block;
    }

    .section-subtitle {
        display: inline-block;
        background: rgba(17, 157, 213, 0.1);
        color: var(--color-primary);
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .section-divider {
        height: 3px;
        width: 60px;
        background: var(--color-secondary-gradient);
        margin: 15px auto 30px;
        border-radius: 10px;
    }

    .content-text p {
        color: var(--color-text);
        margin-bottom: 1.2rem;
        line-height: 1.7;
    }

    .weather-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e7ec 100%);
        border-radius: var(--border-radius-sm);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .weather-title {
        font-size: 1.2rem;
        color: var(--color-text);
        margin-bottom: 15px;
    }

    .weather-link {
        color: var(--color-primary);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition-fast);
    }

    .weather-link:hover {
        color: var(--color-secondary);
    }

    /* Sidebar Styles */
    .info-sidebar {
        position: sticky;
        top: 30px;
    }

    .travel-options-card {
        border-radius: var(--border-radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: none;
    }

    .travel-options-card .card-header {
        background: var(--color-primary-gradient);
        color: white;
        padding: 15px 20px;
        border: none;
    }

    .travel-options-card .card-header h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .travel-option {
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .travel-option:last-child {
        border-bottom: none;
    }

    .travel-option i {
        width: 40px;
        height: 40px;
        background: var(--color-primary-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 15px;
        font-size: 1.2rem;
    }

    .option-details h4 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--color-text);
    }

    .option-details p {
        margin: 5px 0 0;
        font-size: 0.85rem;
        color: var(--color-text-light);
    }

    /* Transportation Section Styles */
    .transportation-section {
        padding: 80px 0;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0;
    }

    .btn-gradient-orange {
        background: linear-gradient(135deg, #ff9966 0%, #ff5e62 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .feature-list li {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        color: var(--color-text);
    }

    .feature-list li i {
        color: var(--color-secondary);
        margin-right: 10px;
        font-size: 1rem;
    }

    /* Airlines Card */
    .airlines-card,
    .ship-experience-card {
        border-radius: var(--border-radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: none;
    }

    .airlines-card .card-header,
    .ship-experience-card .card-header {
        background: var(--color-primary-gradient);
        color: white;
        padding: 15px 20px;
        border: none;
    }

    .airlines-card .card-header h3,
    .ship-experience-card .card-header h3 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .airlines-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 15px;
    }

    .airline-item {
        text-align: center;
        padding: 15px 10px;
        border-radius: var(--border-radius-sm);
        background: var(--color-bg-light);
        transition: var(--transition-fast);
    }

    .airline-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-sm);
    }

    .airline-icon {
        width: 40px;
        height: 40px;
        background: rgba(17, 157, 213, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }

    .airline-icon i {
        color: var(--color-primary);
    }

    .airline-item h4 {
        font-size: 0.9rem;
        margin-bottom: 5px;
        color: var(--color-text);
    }

    .airline-item p {
        font-size: 0.75rem;
        color: var(--color-text-light);
        margin: 0;
    }

    /* Important Note Card */
    .important-note-card {
        display: flex;
        align-items: flex-start;
        background: rgba(17, 157, 213, 0.05);
        border-radius: var(--border-radius-md);
        padding: 20px;
        border-left: 4px solid var(--color-primary);
    }

    .note-icon {
        flex-shrink: 0;
        margin-right: 20px;
        width: 40px;
        height: 40px;
        background: var(--color-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .note-content h4 {
        font-size: 1.1rem;
        color: var(--color-text);
        margin-bottom: 15px;
    }

    .note-content ul {
        margin: 0;
        padding-left: 20px;
    }

    .note-content li {
        margin-bottom: 8px;
        color: var(--color-text);
    }

    /* Ship Experience Card */
    .experience-item {
        display: flex;
        margin-bottom: 2px;
    }

    .experience-icon {
        flex-shrink: 0;
        margin-right: 15px;
        font-size: 1.2rem;
    }

    .experience-icon.positive {
        color: #28a745;
    }

    .experience-icon.negative {
        color: #dc3545;
    }

    .experience-content h4 {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: var(--color-text);
    }

    .experience-content ul {
        padding-left: 20px;
        margin: 0;
    }

    .experience-content li {
        margin-bottom: 5px;
        color: var(--color-text);
    }

    .ship-note {
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        font-size: 0.9rem;
        color: var(--color-text-light);
    }

    /* Recommendation Card */
    .recommendation-card {
        display: flex;
        align-items: flex-start;
        background: rgba(249, 104, 15, 0.05);
        border-radius: var(--border-radius-md);
        padding: 25px;
        border-left: 4px solid var(--color-secondary);
    }

    .recommendation-icon {
        flex-shrink: 0;
        margin-right: 20px;
        width: 50px;
        height: 50px;
        background: var(--color-secondary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .recommendation-content h4 {
        font-size: 1.2rem;
        color: var(--color-text);
        margin-bottom: 15px;
    }

    .recommendation-content p {
        color: var(--color-text);
        margin-bottom: 10px;
        line-height: 1.7;
    }

    .recommendation-content p:last-child {
        margin-bottom: 0;
    }

    /* FAQ Section */
    .faq-section {
        padding: 80px 0;
    }

    .faq-accordion .accordion-item {
        margin-bottom: 15px;
        border: none;
        border-radius: var(--border-radius-sm);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .faq-accordion .accordion-button {
        padding: 20px 25px;
        font-weight: 600;
        color: var(--color-text);
        background-color: white;
        border: none;
    }

    .faq-accordion .accordion-button:not(.collapsed) {
        color: var(--color-primary);
        background-color: rgba(17, 157, 213, 0.05);
        box-shadow: none;
    }

    .faq-accordion .accordion-button:focus {
        box-shadow: none;
    }

    .faq-accordion .accordion-body {
        padding: 20px 25px;
        color: var(--color-text);
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(16deg, #88cbe6, #12a5de);
        border-radius: var(--border-radius-lg);
        margin: 60px auto;
        max-width: 1140px;
    }

    .btn-light {
        background-color: white;
        color: var(--color-primary-dark);
        font-weight: 600;
        transition: var(--transition-fast);
    }

    .btn-light:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(255, 255, 255, 0.2);
    }

    .btn-outline-light {
        border: 2px solid white;
        color: white;
        font-weight: 600;
        transition: var(--transition-fast);
    }

    .btn-outline-light:hover {
        background-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    /* Responsive styles */
    @media (max-width: 992px) {
        .hero-section {
            padding: 60px 0;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-description {
            font-size: 1rem;
        }

        .content-section,
        .transportation-section,
        .faq-section {
            padding: 60px 0;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .airlines-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 40px 0;
        }

        .hero-title {
            font-size: 1.8rem;
        }

        .hero-description {
            font-size: 0.9rem;
        }

        .content-section,
        .transportation-section,
        .faq-section {
            padding: 40px 0;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .recommendation-card,
        .important-note-card {
            flex-direction: column;
        }

        .recommendation-icon,
        .note-icon {
            margin-bottom: 15px;
        }

        .airlines-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    // Add animation classes on scroll
document.addEventListener('DOMContentLoaded', function() {
    // Select all elements to animate
    const animateElements = document.querySelectorAll(
        '.content-card, .info-sidebar, .airlines-card, .ship-experience-card, .important-note-card, .recommendation-card'
    );

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    animateElements.forEach(element => {
        observer.observe(element);
    });
});
</script>
@endpush