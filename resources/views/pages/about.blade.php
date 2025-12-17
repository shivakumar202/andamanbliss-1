@extends('layouts.app')
@section('title', 'About Andaman Bliss™ - Your Premier Travel Partner in Andaman Islands')
@section('description', 'Learn about Andaman Bliss™, your trusted travel partner in the Andaman Islands since 2017.
Discover our story, mission, and commitment to sustainable tourism.')

@section('content')
<!-- Modern Hero Section -->
<section class="about-hero">
    <div class="about-hero__background">
        <img src="https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2073&q=80"
            alt="Andaman Islands Beach" class="about-hero__image">
        <div class="about-hero__overlay"></div>
    </div>
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="about-hero__content">
                    <div class="about-hero__subtitle">ABOUT US</div>
                    <h1 class="about-hero__title">Discover the <span>Andaman Islands</span> with the Experts</h1>
                    <div class="about-hero__text">Your trusted travel partner since 2017, creating unforgettable
                        experiences in paradise</div>

                    <div class="about-hero__stats">
                        <div class="about-hero__stat">
                            <div class="about-hero__stat-number">8+</div>
                            <div class="about-hero__stat-text">Years of Excellence</div>
                        </div>
                        <div class="about-hero__stat">
                            <div class="about-hero__stat-number">100K+</div>
                            <div class="about-hero__stat-text">Happy Travelers</div>
                        </div>
                        <div class="about-hero__stat">
                            <div class="about-hero__stat-number">200+</div>
                            <div class="about-hero__stat-text">Tour Packages</div>
                        </div>
                    </div>

                    <div class="about-hero__badges">
                        <div class="about-hero__badge">
                            <i class="fas fa-award"></i>
                            <span>Trusted Partner</span>
                        </div>
                        <div class="about-hero__badge">
                            <i class="fas fa-globe-asia"></i>
                            <span>Local Expertise</span>
                        </div>
                        <div class="about-hero__badge">
                            <i class="fas fa-leaf"></i>
                            <span>Sustainable Tourism</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-hero__shape"></div>
</section>

<!-- About Us Section -->
<section class="travel-partner">
    <div class="container">
        <div class="travel-partner__header text-center">
            <div class="section-tag">ABOUT US</div>
            <h2 class="section-heading">Your Trusted Travel Partner <span>in Andaman</span> </h2>
            <div class="section-separator mx-auto"></div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="travel-partner__image-container">
                    <img src="https://andamanbliss.com/site/img/video2.jpg" alt="Andaman Islands Beach"
                        class="travel-partner__main-image" loading="lazy">
                    <div class="travel-partner__badge">
                        <div class="travel-partner__badge-number">8+</div>
                        <div class="travel-partner__badge-text">Years of Excellence</div>
                    </div>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="travel-partner__video-btn"
                        target="_blank">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="travel-partner__text-box">
                    <p>Hello there, welcome to Andaman Bliss™, we are the best travel agency to rely on if you choose to
                        discover the beauty and magic of the Andaman and Nicobar Islands. With over 8 years of
                        experience, we have helped thousands of travelers to create unforgettable memories in this
                        beautiful paradise.</p>
                    <p>Our understanding and connectivity of the islands does makes us reliable, we have a strict
                        commitment to provide you a sustainable tourism, and we strive with a passion for creating
                        exceptional experiences that sets us apart as the leading travel agency in the region.</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="travel-partner__features">
                    <div class="travel-partner__feature">
                        <div class="travel-partner__feature-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <div class="travel-partner__feature-content">
                            <h3>Customised Tour Packages</h3>
                            <p>Customised tour Itineraries are designed according your preferences and are created to
                                provide you with an unforgettable experiences</p>
                        </div>
                    </div>

                    <div class="travel-partner__feature">
                        <div class="travel-partner__feature-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="travel-partner__feature-content">
                            <h3>Knowledgeable Local Guides</h3>
                            <p>At Andaman Bliss™ we are a team of locals, our guides share you authentic insights and
                                hidden gems of the islands</p>
                        </div>
                    </div>

                    <div class="travel-partner__feature">
                        <div class="travel-partner__feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="travel-partner__feature-content">
                            <h3>24/7 Customer Support</h3>
                            <p>With our dedicated assistance throughout your journey, we ensure a smooth and worry-free
                                experience</p>
                        </div>
                    </div>

                    <div class="travel-partner__cta-container">
                        <a href="/andaman-tour-packages" class="travel-partner__btn">Explore Packages</a>
                        <div class="travel-partner__social">
                            <a href="https://www.facebook.com/andamanblisstravels/" aria-label="Facebook"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/andamanbliss/" aria-label="Instagram"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="https://in.linkedin.com/in/andaman-bliss" aria-label="LinkedIn"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a href="https://x.com/andaman_bliss" aria-label="Twitter"><i
                                    class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Founder Message Section -->
<section class="founder-message">
    <div class="container">
        <div class="founder-message__header text-center">
            <div class="section-tag">A MESSAGE FROM OUR FOUNDER</div>
            <h2 class="section-heading">Creating Unforgettable <span>Island Experiences</span> </h2>
            <div class="section-separator mx-auto"></div>
        </div>

        <div class="founder-message__container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="founder-message__card">
                        <div class="founder-message__top-section">
                            <div class="founder-message__profile-wrapper">
                                <div class="founder-message__profile-image">
                                    <img src="{{ asset('site/img/navin.jpeg') }}"
                                        alt="Navin Kumar - Founder and Director of Andaman Bliss™" loading="lazy">
                                </div>
                                <div class="founder-message__profile-badge">
                                    <span>8+</span>
                                    <small>Years</small>
                                </div>
                            </div>

                            <div class="founder-message__profile-info">
                                <h3>Navin Kumar</h3>
                                <p>Founder & Director</p>
                                <div class="founder-message__signature">
                                    <img src="{{ asset('site/img/ceosign.png') }}" alt="Navin Signature" loading="lazy">
                                </div>
                            </div>
                        </div>

                        <div class="founder-message__stats-container">
                            <div class="founder-message__stats-row">
                                <div class="founder-message__stat-box">
                                    <div class="founder-message__stat-number">100K<sup>+</sup></div>
                                    <div class="founder-message__stat-label">Happy Travelers</div>
                                    <div class="founder-message__stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>

                                <div class="founder-message__stat-box">
                                    <div class="founder-message__stat-number">200<sup>+</sup></div>
                                    <div class="founder-message__stat-label">Tour Packages</div>
                                    <div class="founder-message__stat-icon">
                                        <i class="fas fa-route"></i>
                                    </div>
                                </div>

                                <div class="founder-message__stat-box">
                                    <div class="founder-message__stat-number">8<sup>+</sup></div>
                                    <div class="founder-message__stat-label">Years of Excellence</div>
                                    <div class="founder-message__stat-icon">
                                        <i class="fas fa-award"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="founder-message__content">
                        <div class="founder-message__quote">
                            <i class="fas fa-quote-left founder-message__quote-icon"></i>
                            <p style="text-align:justify">As the Director and founder of Andaman Bliss™, I am very
                                committed to highlighting the sundry beauty of the Andaman Islands to everyone in the
                                world while doing so in a sustainable and eco-friendly way. We have established from the
                                year 2017, since then we have been dedicated to creating memorable experiences that
                                enrich the lives of our guests and also assist our local communities.</p>
                        </div>

                        <div class="founder-message__text">
                            <p style="text-align:justify">We take great pride in our responsibility to care for the
                                pristine islands, by continuously ensuring excellent service but also protecting the
                                nature and the heritage for generations to come.</p>

                            <div class="founder-message__values">
                                <div class="founder-message__value">
                                    <i class="fas fa-leaf"></i>
                                    <span>Sustainable Tourism</span>
                                </div>
                                <div class="founder-message__value">
                                    <i class="fas fa-award"></i>
                                    <span>Excellence in Service</span>
                                </div>
                                <div class="founder-message__value">
                                    <i class="fas fa-hands-helping"></i>
                                    <span>Community Support</span>
                                </div>
                                <div class="founder-message__value">
                                    <i class="fas fa-hands-helping"></i>
                                    <span>Customizable Package</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Awards & Recognition Section -->
<section class="awards">
    <div class="awards__bg">
        <div class="awards__shape-top"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-tag">AWARDS & RECOGNITION</div>
                <h2 class="section-heading">Excellence Recognized<span>& Celebrated</span> </h2>
                <div class="section-separator mx-auto"></div>
                <p class="section-description">Our commitment to exceptional service and sustainable tourism has earned
                    us recognition from industry leaders and travelers alike</p>
            </div>
        </div>

        <div class="awards__grid">
            <div class="awards__item">
                <div class="awards__item-icon">
                    <img src="{{ asset('site/img/satte-2025.png') }}" alt="Tourism Excellence Award"
                        class="awards__item-img">
                </div>
                <div class="awards__item-content">
                    <h3 class="awards__item-title">SATTE Awards </h3>
                    <p class="awards__item-year">2025</p>
                    <p class="awards__item-text">Recognized for outstanding contribution to sustainable tourism
                        development in the Andaman Islands.</p>
                </div>
            </div>

            <div class="awards__item">
                <div class="awards__item-icon">
                    <img src="{{ asset('site/img/tripadvisor-award.jpg') }}" alt="Best Tour Operator"
                        class="awards__item-img">
                </div>
                <div class="awards__item-content">
                    <h3 class="awards__item-title">Trip Advisor</h3>
                    <p class="awards__item-year">2024</p>
                    <p class="awards__item-text">Voted as the best tour operator in Andaman by Trip Advisor.
                    </p>
                </div>
            </div>

            <div class="awards__item">
                <div class="awards__item-icon">
                    <img src="{{ asset('site/img/satte-2024.png') }}" alt="Customer Satisfaction Award"
                        class="awards__item-img">
                </div>
                <div class="awards__item-content">
                    <h3 class="awards__item-title">SATTE Awards</h3>
                    <p class="awards__item-year">2024</p>
                    <p class="awards__item-text">Awarded for pioneering eco-friendly tourism practices that preserve the
                        natural beauty of the islands.</p>
                </div>
            </div>

            <!-- <div class="awards__item">
                <div class="awards__item-icon">
                    <img src="https://cdn-icons-png.flaticon.com/512/3176/3176371.png" alt="Eco-Tourism Champion"
                        class="awards__item-img">
                </div>
                <div class="awards__item-content">
                    <h3 class="awards__item-title">SATTE Awards</h3>
                    <p class="awards__item-year">2023 & 2024</p>
                    <p class="awards__item-text"> Recognized for maintaining exceptional customer satisfaction ratings
                        for Two consecutive years.</p>
                </div>
            </div> -->
        </div>

        <div class="awards__partners">
            <div class="awards__partners-heading">
                <h3>Trusted By Industry</h3>
            </div>
            <div class="awards__partners-logos">
                <div class="awards__partner">
                    <img src="{{ asset('site/img/approved.webp') }}" alt="TripAdvisor Partner"
                        class="awards__partner-logo">
                </div>
                <!-- <div class="awards__partner">
                    <img src="{{ asset('site/img/icon/bliss-certi1.png') }}" alt="Booking.com Partner"
                        class="awards__partner-logo">
                </div>
                <div class="awards__partner">
                    <img src="https://cdn-icons-png.flaticon.com/512/5968/5968952.png" alt="Expedia Partner"
                        class="awards__partner-logo">
                </div>
                <div class="awards__partner">
                    <img src="https://cdn-icons-png.flaticon.com/512/731/731985.png" alt="MakeMyTrip Partner"
                        class="awards__partner-logo">
                </div>
                <div class="awards__partner">
                    <img src="https://cdn-icons-png.flaticon.com/512/2504/2504929.png" alt="Tourism Ministry Partner"
                        class="awards__partner-logo">
                </div> -->
            </div>
        </div>
    </div>
    <div class="awards__shape-bottom"></div>
</section>

<!-- Our Journey Section -->
<section class="journey">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-tag">OUR JOURNEY</div>
                <h2 class="section-heading">Our <span>Growth Story</span></h2>
                <div class="section-separator mx-auto"></div>
                <p class="section-description">Discover how Andaman Bliss™ have established, evolved and grown since
                    2017,
                    creating a legacy of providing an exceptional travel experiences in the Andaman Islands</p>
            </div>
        </div>

        <div class="journey__timeline">
            <div class="journey__timeline-line"></div>

            <div class="row">
                <div class="col-md-6 journey__milestone journey__milestone--left">
                    <div class="journey__milestone-content">
                        <div class="journey__milestone-year">2017</div>
                        <h3 class="journey__milestone-title">The Beginning Of Our Journey</h3>
                        <p class="journey__milestone-text">Andaman Bliss™ was started as a small company with the goal of
                            showcasing the unspoiled beauty of the Andaman Islands while offering traveler's from all
                            over the world first-rate travel experiences and services.</p>
                        <ul class="journey__milestone-list">
                            <li><i class="fas fa-check-circle"></i> We Began in Port Blair in 2017</li>
                            <li><i class="fas fa-check-circle"></i> We launched with a team of few with one small boat
                                operating to Ross Island </li>
                            <li><i class="fas fa-check-circle"></i> We cultivated trust and loyality</li>

                        </ul>
                    </div>
                    <div class="journey__milestone-dot"></div>
                </div>

                <div class="col-md-6 journey__milestone journey__milestone--right">
                    <div class="journey__milestone-dot"></div>
                    <div class="journey__milestone-content">
                        <div class="journey__milestone-year">2019</div>
                        <h3 class="journey__milestone-title">Phase Of Expansion</h3>
                        <p class="journey__milestone-text">Despite several obstacles, we grew our portfolio, added new
                            experiences and places, and adjusted our offerings to meet the evolving demands of
                            travelers.
                        </p>
                        <ul class="journey__milestone-list">
                            <li><i class="fas fa-check-circle"></i> Introduced new and well established Travel Packages
                            </li>
                            <li><i class="fas fa-check-circle"></i> Expanded team to 20 members</li>
                            <li><i class="fas fa-check-circle"></i> We added new vehicles to our fleet</li>
                            <li><i class="fas fa-check-circle"></i> Established a new branch office at Havelock Island
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-6 journey__milestone journey__milestone--left">
                    <div class="journey__milestone-content">
                        <div class="journey__milestone-year">2022</div>
                        <h3 class="journey__milestone-title">Reaching New Heights</h3>
                        <p class="journey__milestone-text"> The covid-19 hit us hard but that did not stop us, post
                            pandemic we were able to rise upto new heights by practicing safe travels by following all
                            the necessary guidelines.</p>
                        <ul class="journey__milestone-list">
                            <li><i class="fas fa-check-circle"></i>Successfully got back to full scale operations and
                                expanded our services</li>
                            <li><i class="fas fa-check-circle"></i> Gained back our customers trust with flexiblility
                                and 24/7 support.</li>
                            <li><i class="fas fa-check-circle"></i> Practiced safe & secure model of tourism
                                post-pandemic</li>
                        </ul>
                    </div>
                    <div class="journey__milestone-dot"></div>
                </div>

                <div class="col-md-6 journey__milestone journey__milestone--right">
                    <div class="journey__milestone-dot"></div>
                    <div class="journey__milestone-content">
                        <div class="journey__milestone-year">2025</div>
                        <h3 class="journey__milestone-title">Leading the Way</h3>
                        <p class="journey__milestone-text">Today, we continue to innovate and enhance our services,
                            creating unforgettable experiences for thousands of visitors while maintaining our
                            commitment to sustainable tourism.</p>
                        <ul class="journey__milestone-list">
                            <li><i class="fas fa-check-circle"></i> Expanded to 40+ team members</li>
                            <li><i class="fas fa-check-circle"></i> Offering choice to customized tour packages</li>
                            <li><i class="fas fa-check-circle"></i> Served over 1,00,000 travelers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="journey__achievements">
            <div class="row">
                <div class="col-md-4">
                    <div class="journey__achievement">
                        <div class="journey__achievement-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="journey__achievement-number">5000+</div>
                        <div class="journey__achievement-text">Happy Travelers</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="journey__achievement">
                        <div class="journey__achievement-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <div class="journey__achievement-number">20+</div>
                        <div class="journey__achievement-text">Tour Packages</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="journey__achievement">
                        <div class="journey__achievement-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="journey__achievement-number">25+</div>
                        <div class="journey__achievement-text">Team Members</div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>

@push('styles')
<style>
/* Common Variables */
:root {
    --primary-color: rgb(17, 157, 213);
    /* Sky blue */
    --secondary-color: #ff7e00;
    /* Orange */
    --text-color: #333;
    --light-bg: #f8f9fa;
    --dark-bg: #343a40;
    --border-radius: 10px;
    --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

/* Hero Section Styles */
.about-hero {
    position: relative;
    padding: 120px 0 100px;
    overflow: hidden;
    color: #fff;
}

.about-hero__background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.about-hero__image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.about-hero__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
}

.about-hero__content {
    position: relative;
    z-index: 1;
    text-align: center;
}

.about-hero__subtitle {
    display: inline-block;
    background-color: rgba(255, 126, 0, 0.2);
    color: var(--secondary-color);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 2px;
    padding: 8px 15px;
    border-radius: 30px;
    margin-bottom: 20px;
}

.about-hero__title {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.2;
    color: #fff;
}

.about-hero__title span {
    color: var(--secondary-color);
    position: relative;
    display: inline-block;
}

.about-hero__text {
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto 30px;
    opacity: 0.9;
}

.about-hero__stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-bottom: 30px;
}

.about-hero__stat {
    text-align: center;
}

.about-hero__stat-number {
    font-size: 36px;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 5px;
}

.about-hero__stat-text {
    font-size: 14px;
    opacity: 0.8;
}

.about-hero__badges {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
}

.about-hero__badge {
    display: flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.1);
    padding: 10px 20px;
    border-radius: 30px;
    backdrop-filter: blur(5px);
}

.about-hero__badge i {
    color: var(--secondary-color);
    margin-right: 8px;
    font-size: 16px;
}

.about-hero__shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 70px;
    /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E"); */
    background-size: cover;
}

/* Trusted Partner Section Styles */
.trusted-partner {
    position: relative;
    padding: 60px 0;
    overflow: hidden;
}

.trusted-partner__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.trusted-partner__shape {
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(17, 157, 213, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
    border-radius: 50%;
}

.trusted-partner__header {
    margin-bottom: 40px;
}

.section-tag {
    display: inline-block;
    background-color: rgba(17, 157, 213, 0.1);
    color: var(--primary-color);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 2px;
    padding: 8px 15px;
    border-radius: 30px;
    margin-bottom: 15px;
}

.section-heading {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--primary-color);
}

.section-heading span {
    color: var(--andaman-primary);
    position: relative;
}

.section-separator {
    width: 80px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), #00c2ff);
    margin-bottom: 20px;
}

.section-description {
    font-size: 16px;
    color: var(--color-text-light);
    margin-bottom: 30px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.trusted-partner__content {
    position: relative;
}

.trusted-partner__media {
    position: relative;
    margin-bottom: 25px;
}

.trusted-partner__image-container {
    position: relative;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
}

.trusted-partner__image {
    width: 100%;
    height: auto;
    display: block;
    border-radius: var(--border-radius);
    transition: transform 0.5s ease;
}

.trusted-partner__image:hover {
    transform: scale(1.03);
}

.trusted-partner__experience {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: var(--primary-color);
    color: #fff;
    padding: 10px 15px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    text-align: center;
}

.trusted-partner__experience-number {
    font-size: 24px;
    font-weight: 700;
    line-height: 1;
}

.trusted-partner__experience-text {
    font-size: 12px;
    opacity: 0.9;
}

.trusted-partner__video {
    position: absolute;
    bottom: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    color: #fff;
    z-index: 2;
}

.trusted-partner__video-btn {
    width: 50px;
    height: 50px;
    background-color: var(--secondary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    margin-right: 10px;
    box-shadow: 0 0 0 5px rgba(255, 126, 0, 0.3);
    transition: var(--transition);
}

.trusted-partner__video-btn:hover {
    background-color: var(--primary-color);
    box-shadow: 0 0 0 8px rgba(17, 157, 213, 0.3);
    transform: scale(1.05);
}

.trusted-partner__text-box {
    background-color: #f8f9fa;
    border-radius: var(--border-radius);
    padding: 20px;
    margin-bottom: 20px;
}

.trusted-partner__text-box p {
    margin-bottom: 15px;
    color: var(--color-text-light);
    line-height: 1.6;
    font-size: 15px;
}

.trusted-partner__text-box p:last-child {
    margin-bottom: 0;
}

.trusted-partner__cards {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 25px;
}

.trusted-partner__card {
    display: flex;
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 20px;
    transition: var(--transition);
}

.trusted-partner__card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.trusted-partner__card-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.trusted-partner__card-icon i {
    color: var(--primary-color);
    font-size: 20px;
}

.trusted-partner__card-content {
    flex: 1;
}

.trusted-partner__card-content h3 {
    font-size: 18px;
    margin-bottom: 8px;
    color: var(--text-color);
}

.trusted-partner__card-content p {
    font-size: 14px;
    color: var(--color-text-light);
    margin-bottom: 10px;
    line-height: 1.5;
}

.trusted-partner__card-link {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-size: 14px;
    font-weight: 600;
    transition: var(--transition);
}

.trusted-partner__card-link i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.trusted-partner__card-link:hover {
    color: var(--secondary-color);
}

.trusted-partner__card-link:hover i {
    transform: translateX(5px);
}

.trusted-partner__social {
    display: flex;
    align-items: center;
    background-color: #f8f9fa;
    border-radius: var(--border-radius);
    padding: 15px 20px;
}

.trusted-partner__social span {
    font-weight: 600;
    margin-right: 15px;
    color: var(--text-color);
    font-size: 14px;
}

.trusted-partner__social-links {
    display: flex;
    gap: 10px;
}

.trusted-partner__social-link {
    width: 36px;
    height: 36px;
    background-color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-light);
    transition: var(--transition);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.trusted-partner__social-link:hover {
    background-color: var(--primary-color);
    color: #fff;
    transform: translateY(-3px);
}

@media (max-width: 991px) {
    .trusted-partner__card {
        padding: 15px;
    }

    .trusted-partner__card-icon {
        width: 40px;
        height: 40px;
    }

    .trusted-partner__card-content h3 {
        font-size: 16px;
    }
}

@media (max-width: 767px) {
    .trusted-partner {
        padding: 40px 0;
    }

    .section-heading {
        font-size: 28px;
    }

    .trusted-partner__experience {
        padding: 8px 12px;
    }

    .trusted-partner__experience-number {
        font-size: 20px;
    }

    .trusted-partner__experience-text {
        font-size: 10px;
    }

    .trusted-partner__social {
        flex-direction: column;
        align-items: flex-start;
    }

    .trusted-partner__social span {
        margin-right: 0;
        margin-bottom: 10px;
    }
    .travel-partner__cta-container {
        flex-direction: column;
        gap: 15px;
        align-items: center;
        justify-content: center;
    }
    .destinations {
        padding: 30px 0;
    }
}
</style>
@endpush

@push('styles')
<style>
/* Travel Partner Section Styles */
.travel-partner {
    position: relative;
    padding: 60px 0;
    overflow: hidden;
    background-color: #f9f9f9;
}

.travel-partner__header {
    margin-bottom: 30px;
}

.travel-partner__image-container {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    height: 350px;
}

.travel-partner__main-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.travel-partner__image-container:hover .travel-partner__main-image {
    transform: scale(1.05);
}

.travel-partner__badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: rgb(17, 157, 213);
    color: #fff;
    padding: 10px 15px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
    text-align: center;
    z-index: 2;
}

.travel-partner__badge-number {
    font-size: 24px;
    font-weight: 700;
    line-height: 1;
}

.travel-partner__badge-text {
    font-size: 12px;
    opacity: 0.9;
}

.travel-partner__video-btn {
    position: absolute;
    bottom: 20px;
    left: 20px;
    width: 50px;
    height: 50px;
    background-color: rgb(255, 126, 0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    box-shadow: 0 0 0 5px rgba(255, 126, 0, 0.3);
    transition: all 0.3s ease;
    z-index: 2;
}

.travel-partner__video-btn:hover {
    background-color: rgb(17, 157, 213);
    box-shadow: 0 0 0 8px rgba(17, 157, 213, 0.3);
    transform: scale(1.05);
    color: #fff;
}

.travel-partner__text-box {
    background-color: #fff;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

.travel-partner__text-box p {
    color: var(--color-text-light);
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 15px;
}

.travel-partner__text-box p:last-child {
    margin-bottom: 0;
}

.travel-partner__features {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.travel-partner__feature {
    display: flex;
    background-color: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.travel-partner__feature:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.travel-partner__feature-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.travel-partner__feature-icon i {
    color: rgb(255, 126, 0);
    font-size: 20px;
}

.travel-partner__feature-content {
    flex: 1;
}

.travel-partner__feature-content h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

.travel-partner__feature-content p {
    font-size: 14px;
    color: var(--color-text-light);
    margin-bottom: 0;
    line-height: 1.5;
}

.travel-partner__cta-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    margin-top: 5px;
}

.travel-partner__btn {
    display: inline-block;
    background: linear-gradient(135deg, rgb(17, 157, 213), rgb(22 199 255));
    color: #fff;
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 5px 15px rgba(255, 126, 0, 0.2);
}

.travel-partner__btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(255, 126, 0, 0.3);
    color: #fff;
}

.travel-partner__social {
    display: flex;
    gap: 10px;
}

.travel-partner__social a {
    width: 36px;
    height: 36px;
    background-color: #f5f5f5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-light);
    transition: all 0.3s ease;
}

.travel-partner__social a:hover {
    background-color: rgb(17, 157, 213);
    color: #fff;
    transform: translateY(-3px);
}

@media (max-width: 991px) {
    .travel-partner {
        padding: 40px 0;
    }

    .travel-partner__image-container {
        height: 300px;
    }

    .travel-partner__feature {
        padding: 15px;
    }

    .travel-partner__feature-icon {
        width: 40px;
        height: 40px;
    }

    .travel-partner__feature-content h3 {
        font-size: 16px;
    }

    .travel-partner__cta-container {
        flex-direction: column;
        gap: 15px;
       
    }
   

    .travel-partner__btn {
        width: 100%;
        text-align: center;
    }
}

@media (max-width: 767px) {
    .travel-partner__image-container {
        height: 250px;
    }

    .travel-partner__badge {
        padding: 8px 12px;
    }

    .travel-partner__badge-number {
        font-size: 20px;
    }

    .travel-partner__badge-text {
        font-size: 10px;
    }

    .travel-partner__video-btn {
        width: 40px;
        height: 40px;
    }
     .founder-message__signature{
        text-align:center;
        display:flex;
        justify-content:center;
    }
}

/* Founder Message Section Styles */
.founder-message {
    position: relative;
    padding: 60px 0;
    background-color: #f9f9f9;
}

.founder-message__header {
    margin-bottom: 40px;
}

.founder-message__container {
    margin-top: 30px;
}

.founder-message__card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    padding: 30px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.founder-message__top-section {
    display: flex;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9f6fd 100%);
    border-radius: 12px 12px 0 0;
    position: relative;
    overflow: hidden;
}

.founder-message__top-section::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 150px;
    height: 150px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    z-index: 0;
}

.founder-message__profile-wrapper {
    position: relative;
    margin-right: 25px;
}

.founder-message__profile-image {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    overflow: hidden;
    border: 5px solid #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
}

.founder-message__profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.founder-message__profile-image:hover img {
    transform: scale(1.1);
}

.founder-message__profile-badge {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 50px;
    height: 50px;
    background-color: rgb(255, 126, 0);
    color: #fff;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    z-index: 2;
}

.founder-message__profile-badge span {
    font-size: 16px;
    font-weight: 700;
    line-height: 1;
}

.founder-message__profile-badge small {
    font-size: 10px;
    opacity: 0.9;
}

.founder-message__profile-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    z-index: 1;
}

.founder-message__profile-info h3 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #333;
}

.founder-message__profile-info p {
    font-size: 16px;
    color: rgb(17, 157, 213);
    margin-bottom: 15px;
    font-weight: 600;
}

.founder-message__signature img {
    height: 50px;
    display: inline-block;
}

.founder-message__stats-container {
    padding: 25px 30px;
    background-color: #fff;
    border-radius: 0 0 12px 12px;
}

.founder-message__stats-row {
    display: flex;
    justify-content: space-between;
    gap: 15px;
}

.founder-message__stat-box {
    flex: 1;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9f6fd 100%);
    border-radius: 10px;
    padding: 20px 15px;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.founder-message__stat-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
}

.founder-message__stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
    position: relative;
    z-index: 1;
}

.founder-message__stat-number sup {
    font-size: 16px;
    color: rgb(255, 126, 0);
}

.founder-message__stat-label {
    font-size: 13px;
    color: var(--color-text-light);
    font-weight: 500;
    position: relative;
    z-index: 1;
}

.founder-message__stat-icon {
    position: absolute;
    bottom: -10px;
    right: -10px;
    font-size: 50px;
    color: rgba(17, 157, 213, 0.1);
    z-index: 0;
}

.founder-message__signature-container {
    margin-top: auto;
    padding-top: 20px;
}

.founder-message__signature-line {
    height: 1px;
    background: linear-gradient(to right, transparent, #ddd, transparent);
    margin-bottom: 15px;
}

.founder-message__signature {
    text-align: right;
    margin-bottom: 5px;
}

.founder-message__signature-img {
    height: 60px;
    display: inline-block;
}

.founder-message__signature-date {
    text-align: right;
    font-size: 14px;
    color: #888;
    font-style: italic;
}

.founder-message__content {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    padding: 30px;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.founder-message__quote {
    position: relative;
    margin-bottom: 25px;
    padding: 20px;
}

.founder-message__quote-icon {
    position: absolute;
    top: 0;
    left: 0;
    color: rgb(17, 157, 213);
    font-size: 24px;
    opacity: 0.3;
}

.founder-message__quote p {
    font-style: italic;
    color: var(--color-text-light);
    ;
    line-height: 1.7;
    font-size: 16px;
}

.founder-message__text p {
    color: var(--color-text-light);
    line-height: 1.7;
    margin-bottom: 20px;
    padding:20px;
}

.founder-message__values {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 10px;
    padding:5px 20px;
}

.founder-message__value {
    display: flex;
    align-items: center;
    background-color: #f9f9f9;
    padding: 10px 15px;
    border-radius: 8px;
    flex-grow: 1;
}

.founder-message__value i {
    color: rgb(255, 126, 0);
    margin-right: 10px;
    font-size: 16px;
}

.founder-message__value span {
    font-size: 14px;
    font-weight: 600;
    color: var(--color-text-light);
}

@media (max-width: 991px) {
    .founder-message__top-section {
        padding: 25px;
    }

    .founder-message__profile-image {
        width: 120px;
        height: 120px;
    }

    .founder-message__profile-info h3 {
        font-size: 24px;
    }

    .founder-message__stats-container {
        padding: 20px;
    }

    .founder-message__stats-row {
        flex-wrap: wrap;
    }

    .founder-message__stat-box {
        flex: 1 0 calc(50% - 10px);
        margin-bottom: 10px;
    }

    .founder-message__stat-box:last-child {
        flex: 1 0 100%;
    }
}

@media (max-width: 767px) {
    .founder-message {
        padding: 40px 0;
    }

    .founder-message__card,
    .founder-message__content {
        padding: 0 0 20px 0;
    }

    .founder-message__top-section {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px;
    }

    .founder-message__profile-wrapper {
        margin-right: 0;
        margin-bottom: 20px;
    }

    .founder-message__profile-image {
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }

    .founder-message__profile-badge {
        right: 50%;
        transform: translateX(40px);
    }

    .founder-message__stats-container {
        padding: 20px;
    }

    .founder-message__stats-row {
        flex-direction: row;
    }

    .founder-message__stat-box {
        margin-bottom: 15px;
    }

    .founder-message__stat-box:last-child {
        margin-bottom: 0;
    }

    .founder-message__stat-number {
        font-size: 24px;
    }
    .founder-message__signature{
        display:none;
    }
}

/* Awards Section Styles */
.awards {
    position: relative;
    padding: 10px 0;
    background-color: #f8f9fa;
    overflow: hidden;
}

.awards__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.awards__shape-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 70px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    transform: rotate(180deg);
}

.awards__shape-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 70px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
}

.awards__grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
}

.awards__item {
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 30px;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.awards__item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.awards__item-icon {
    width: 100%;
    margin-bottom: 20px;
}

.awards__item-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.awards__item-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 5px;
    color: var(--text-color);
}

.awards__item-year {
    display: inline-block;
    background-color: rgba(17, 157, 213, 0.1);
    color: var(--primary-color);
    font-size: 14px;
    font-weight: 600;
    padding: 5px 15px;
    border-radius: 20px;
    margin-bottom: 15px;
}

.awards__item-text {
    font-size: 14px;
    color: var(--color-text-light);
    margin: 0;
}

.awards__partners {
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 30px;
}

.awards__partners-heading {
    text-align: center;
    margin-bottom: 30px;
}

.awards__partners-heading h3 {
    font-size: 24px;
    font-weight: 700;
    color: var(--text-color);
    position: relative;
    display: inline-block;
    padding-bottom: 10px;
}

.awards__partners-heading h3:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), #15cee3);
}

.awards__partners-logos {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
}

.awards__partner {
    width: auto;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: var(--transition);
}

.awards__partner:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.05);
}

.awards__partner-logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
</style>
@endpush

@push('styles')
<style>
/* Journey Section Styles */
.journey {
    padding-top:30px;
    padding-bottom:5px;
}

.journey__timeline {
    position: relative;
    padding: 40px 0;
    margin-bottom: 10px;
}

.journey__timeline-line {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 100%;
    background: linear-gradient(to bottom, var(--primary-color), #18e1e3);
    z-index: 1;
}

.journey__milestone {
    position: relative;
    margin-bottom: 50px;
}

.journey__milestone-dot {
    position: absolute;
    top: 30px;
    width: 20px;
    height: 20px;
    background-color: var(--secondary-color);
    border-radius: 50%;
    z-index: 2;
    box-shadow: 0 0 0 5px rgba(255, 126, 0, 0.3);
}

.journey__milestone--left .journey__milestone-dot {
    right: -10px;
}

.journey__milestone--right .journey__milestone-dot {
    left: -10px;
}

.journey__milestone-content {
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 25px;
    position: relative;
    transition: var(--transition);
}

.journey__milestone-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.journey__milestone--left .journey__milestone-content {
    margin-right: 30px;
    text-align: right;
}

.journey__milestone--right .journey__milestone-content {
    margin-left: 30px;
    text-align: left;
}

.journey__milestone-year {
    display: inline-block;
    background-color: var(--primary-color);
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    padding: 5px 15px;
    border-radius: 20px;
    margin-bottom: 10px;
}

.journey__milestone-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 10px;
    color: var(--text-color);
}

.journey__milestone-text {
    font-size: 14px;
    color: var(--color-text-light);
    margin-bottom: 15px;
    line-height: 1.6;
}

.journey__milestone-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.journey__milestone--left .journey__milestone-list {
    text-align: right;
}

.journey__milestone--right .journey__milestone-list {
    text-align: left;
}

.journey__milestone-list li {
    margin-bottom: 8px;
    font-size: 14px;
    color: var(--color-text-light);
    display: flex;
    align-items: center;
}

.journey__milestone--left .journey__milestone-list li {
    justify-content: flex-end;
}

.journey__milestone-list li i {
    color: var(--secondary-color);
    margin-right: 8px;
    font-size: 14px;
}

.journey__milestone--left .journey__milestone-list li i {
    order: 2;
    margin-right: 0;
    margin-left: 8px;
}

.journey__achievements {
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 40px;
}

.journey__achievement {
    text-align: center;
    padding: 20px;
    transition: var(--transition);
}

.journey__achievement:hover {
    transform: translateY(-10px);
}

.journey__achievement-icon {
    width: 70px;
    height: 70px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}

.journey__achievement-icon i {
    color: var(--primary-color);
    font-size: 30px;
}

.journey__achievement-number {
    font-size: 36px;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 5px;
}

.journey__achievement-text {
    font-size: 16px;
    color: var(--text-color);
    font-weight: 600;
}

/* Vision & Mission Section Styles */
.vision-mission {
    position: relative;
    padding: 10px 0;
    overflow: hidden;
     background-color: #f8f9fa;
}

.vision-mission__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #f8f9fa;
    z-index: -1;
}

.vision-mission__shape-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 70px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    transform: rotate(180deg);
}

.vision-mission__shape-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 70px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
}

.vision-mission__card {
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 30px;
    height: 100%;
    transition: var(--transition);
}

.vision-mission__card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.vision-mission__card--vision {
    border-top: 5px solid var(--primary-color);
}

.vision-mission__card--mission {
    border-top: 5px solid var(--secondary-color);
}

.vision-mission__card-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.vision-mission__card-icon {
    width: 60px;
    height: 60px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.vision-mission__card--vision .vision-mission__card-icon {
    background-color: rgba(17, 157, 213, 0.1);
}

.vision-mission__card--mission .vision-mission__card-icon {
    background-color: rgba(255, 126, 0, 0.1);
}

.vision-mission__card-icon i {
    font-size: 24px;
}

.vision-mission__card--vision .vision-mission__card-icon i {
    color: var(--primary-color);
}

.vision-mission__card--mission .vision-mission__card-icon i {
    color: var(--secondary-color);
}

.vision-mission__card-title {
    font-size: 24px;
    font-weight: 700;
    color: var(--text-color);
    margin: 0;
}

.vision-mission__card-text {
    font-size: 16px;
    color: var(--color-text-light);
    line-height: 1.7;
    margin-bottom: 20px;
}

.vision-mission__card-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.vision-mission__card-list li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 12px;
    font-size: 15px;
    color: var(--color-text-light);
}

.vision-mission__card-list li i {
    color: var(--secondary-color);
    margin-right: 10px;
    margin-top: 4px;
    font-size: 14px;
    flex-shrink: 0;
}
</style>
@endpush

@push('styles')
<style>
/* Features Section Styles */
.features {
    padding: 30px 0;
}

.features__grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

.features__item {
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 30px;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
}

.features__item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.features__item-icon {
    width: 70px;
    height: 70px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.features__item-icon i {
    color: var(--primary-color);
    font-size: 30px;
}

.features__item-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 15px;
    color: var(--text-color);
}

.features__item-text {
    font-size: 15px;
    color: var(--color-text-light);
    line-height: 1.7;
    margin-bottom: 20px;
    flex-grow: 1;
}

.features__item-link {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-weight: 600;
    font-size: 15px;
    transition: var(--transition);
}

.features__item-link i {
    margin-left: 5px;
    transition: var(--transition);
}

.features__item-link:hover {
    color: var(--secondary-color);
}

.features__item-link:hover i {
    transform: translateX(5px);
}

</style>
@endpush

@push('styles')
<style>
/* Destinations Section Styles */
.destinations {
    padding: 30px 0;
}

.destinations__grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
}

.destinations__item {
    background-color: #fff;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    overflow: hidden;
    transition: var(--transition);
}

.destinations__item:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.destinations__item-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.destinations__item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.destinations__item:hover .destinations__item-image img {
    transform: scale(1.1);
}

.destinations__item-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: var(--transition);
}

.destinations__item:hover .destinations__item-overlay {
    opacity: 1;
}

.destinations__item-link {
    display: inline-flex;
    align-items: center;
    background-color: var(--secondary-color);
    color: #fff;
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 14px;
    transition: var(--transition);
}

.destinations__item-link i {
    margin-left: 5px;
    transition: var(--transition);
}

.destinations__item-link:hover {
    background-color: var(--primary-color);
}

.destinations__item-link:hover i {
    transform: translateX(5px);
}

.destinations__item-content {
    padding: 20px;
}

.destinations__item-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(17, 157, 213, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.destinations__item-icon i {
    color: var(--primary-color);
    font-size: 20px;
}

.destinations__item-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
    color: var(--text-color);
}

.destinations__item-text {
    font-size: 14px;
    color: var(--color-text-light);
    line-height: 1.6;
    margin: 0;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    background-color: var(--primary-color);
    color: #fff;
    padding: 12px 30px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 16px;
    transition: var(--transition);
    border: none;
    cursor: pointer;
}

.btn-primary i {
    margin-left: 8px;
    transition: var(--transition);
}

.btn-primary:hover {
    background-color: var(--secondary-color);
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.btn-primary:hover i {
    transform: translateX(5px);
}

/* CTA Section Styles */
.cta {
    position: relative;
    padding: 30px 0;
    color: #fff;
    overflow: hidden;
}

.cta__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('https://images.unsplash.com/photo-1506953823976-52e1fdc0149a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    z-index: -1;
}

.cta__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(17, 157, 213, 0.9), rgba(255, 126, 0, 0.9));
    z-index: -1;
}

.cta__content {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius);
    padding: 50px;
    text-align: center;
    backdrop-filter: blur(5px);
    box-shadow: var(--box-shadow);
}

.cta__title {
    font-size: 36px;
    font-weight: 800;
    margin-bottom: 20px;
    color: #ffffff;
}

.cta__text {
    font-size: 18px;
    margin-bottom: 30px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    opacity: 0.9;
}

.cta__buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.cta__button {
    display: inline-flex;
    align-items: center;
    padding: 15px 30px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 16px;
    transition: var(--transition);
}

.cta__button--primary {
    background-color: var(--secondary-color);
    color: #fff;
}

.cta__button--secondary {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    border: 2px solid #fff;
}

.cta__button:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.cta__button--primary:hover {
    background-color: #fff;
    color: var(--secondary-color);
}

.cta__button--secondary:hover {
    background-color: #fff;
    color: var(--primary-color);
}

.cta__trust-badges {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.cta__trust-badge {
    display: flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.2);
    padding: 10px 20px;
    border-radius: 30px;
    backdrop-filter: blur(5px);
}

.cta__trust-badge i {
    margin-right: 8px;
    font-size: 16px;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .about-hero__title {
        font-size: 36px;
    }

    .about-hero__stats {
        gap: 20px;
    }

    .journey__milestone--left .journey__milestone-content,
    .journey__milestone--right .journey__milestone-content {
        text-align: left;
        margin-left: 30px;
        margin-right: 0;
    }

    .journey__milestone--left .journey__milestone-dot,
    .journey__milestone--right .journey__milestone-dot {
        left: -10px;
        right: auto;
    }

    .journey__milestone--left .journey__milestone-list {
        text-align: left;
    }

    .journey__milestone--left .journey__milestone-list li {
        justify-content: flex-start;
    }

    .journey__milestone--left .journey__milestone-list li i {
        order: 0;
        margin-right: 8px;
        margin-left: 0;
    }

    .journey__timeline-line {
        left: 0;
        transform: none;
    }

    .features__grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }

    .cta__content {
        padding: 30px;
    }

    .cta__title {
        font-size: 30px;
    }
}

@media (max-width: 767px) {
    .about-hero {
        padding: 80px 0 60px;
    }

    .about-hero__title {
        font-size: 30px;
    }

    .about-hero__stats {
        
        gap: 15px;
    }
    .about-hero__stat-number{
        font-size:25px;
    }
    .cta__buttons{
        flex-wrap: nowrap;
    } 
    .cta__button {
    display: inline-flex;
    align-items: center;
    padding: 3px 12px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 12px;
    transition: var(--transition);
}
.team__grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr) !important; 
        gap: 10px; 
        max-width: 100%; 
        margin: 0 auto;
    }
.about-hero__stat-text{
    font-size:12px;
}
.about-hero__badge span{
    font-size:12px;
}
.about-hero__badges{
    gap:5px;
}
.about-hero__text{
    font-size:14px;
}
    .section-heading {
        font-size: 28px;
    }

    .founder-message__experience {
        position: relative;
        bottom: auto;
        right: auto;
        display: inline-block;
        margin-top: 20px;
    }

    .founder-message__quote-icon {
        display: none;
    }
    .features__item{
        flex-direction:row;
        align-items: center;
        gap: 5px;
        padding:5px;
    }
    .cta__trust-badges{
        display:none;
    }
    .cta__trust-badges{
    padding: 0px 30px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 12px;
    }
   .features__grid{
    gap:5px;
    display:flex;
    flex-wrap: wrap;
   }
   .features__item-icon i{
    font-size:18px;
   }
   .features__item-icon{
    height:25px;
    width:25px;
    margin-top:15px;
   }
    .features__item-title{
        font-size:14px;
    }
    .features__item-text{
        display:none;
        
    }

    .awards__grid {
        grid-template-columns: 1fr;
    }
    .destinations{
        display:none;
    }

    .destinations__grid {
        grid-template-columns: 1fr;
    }

    .cta__title {
        font-size: 24px;
    }

    .cta__text {
        font-size: 16px;
    }

    .cta__trust-badges {
        flex-direction: column;
        gap: 15px;
        align-items: center;
    }
    .founder-message__quote{
        margin-bottom:3px;
        padding:20px 20px 5px 20px;
    }
    .awards__partner{
        height:18px;
    }
    .journey__milestone--left .journey__milestone-dot,
    .journey__milestone--right .journey__milestone-dot {
        left: 4px;
        right: auto;
    }
    .journey__timeline-line{
        height: 96%;
    }
    .journey__timeline{
            position: relative;
    padding: 25px 0;
    margin-bottom: 0px;
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
$(document).ready(function() {
    // Team filter functionality
    $('.team__filter-btn').click(function() {
        const filter = $(this).data('filter');

        // Update active button
        $('.team__filter-btn').removeClass('active');
        $(this).addClass('active');

        // Filter team members
        $('.team__member').hide();
        $(`.team__member[data-category="${filter}"]`).show();
    });

    // Show first department tab by default
    const firstFilter = $('.team__filter-btn').first().data('filter');
    $('.team__filter-btn').removeClass('active');
    $('.team__filter-btn').first().addClass('active');
    $('.team__member').hide();
    $(`.team__member[data-category="${firstFilter}"]`).show();

    // Testimonials slider functionality
  
});
 $(document).ready(function () {
        // Infinite testimonial slider with 6 cards
        const slider = $('#testimonialSlider');
        const cards = slider.find('.testimonial-card');
        const dotsContainer = $('#testimonialDots');
        const prevBtn = $('#testimonialPrev');
        const nextBtn = $('#testimonialNext');

        // Clone cards for infinite scrolling
        cards.each(function () {
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
                setTimeout(function () {
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
        nextBtn.on('click', function () {
            clearInterval(autoSlideInterval);
            nextSlide();
            startAutoSlide();
        });

        prevBtn.on('click', function () {
            clearInterval(autoSlideInterval);
            prevSlide();
            startAutoSlide();
        });

        dotsContainer.on('click', '.dot', function () {
            if (isAnimating) return;
            clearInterval(autoSlideInterval);

            const dotIndex = parseInt($(this).data('index'));
            currentIndex = dotIndex;
            updateSlider();
            startAutoSlide();
        });

        // Handle window resize with debounce for better performance
        let resizeTimer;
        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
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
            autoSlideInterval = setInterval(function () {
                nextSlide();
            }, 5000);
        }

        // Start auto-sliding
        startAutoSlide();

        // Pause auto-sliding when user interacts
        $('.testimonial-slider-container').on('mouseenter', function () {
            clearInterval(autoSlideInterval);
        }).on('mouseleave', function () {
            startAutoSlide();
        });

        // Touch swipe functionality
        let touchStartX = 0;
        let touchEndX = 0;

        slider.on('touchstart', function (e) {
            touchStartX = e.originalEvent.touches[0].clientX;
            clearInterval(autoSlideInterval);
        });

        slider.on('touchend', function (e) {
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

<!-- Vision & Mission Section -->
<section class="vision-mission">
    <div class="vision-mission__bg">
        <div class="vision-mission__shape-top"></div>
        <div class="vision-mission__shape-bottom"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-tag">OUR VISION & MISSION</div>
                <h2 class="section-heading">Guided by <span>Purpose</span>, Driven by <span>Excellence</span></h2>
                <div class="section-separator mx-auto"></div>
                <p class="section-description">Our core values guide everything we do as we strive to create exceptional
                    travel experiences</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="vision-mission__card vision-mission__card--vision">
                    <div class="vision-mission__card-header">
                        <div class="vision-mission__card-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="vision-mission__card-title">Our Vision</h3>
                    </div>
                    <div class="vision-mission__card-body">
                        <p class="vision-mission__card-text" style="text-align:justify">Andaman Bliss™’s vision is to
                            become the most trust worthy and inspiring travel agency in the Andaman Islands. We aspire
                            to redefine the island tourism by offering enriching, responsible and a unique experiences
                            that help you celebrate the natural beauty and the cultural heritage of the Andaman Islands.
                            Our main goal is to establish a meaningful connection between guests and the islands, where
                            every trip supports local communities, respects the environment and leaves lasting
                            impressions on every soul we touch.</p>
                        <ul class="vision-mission__card-list">
                            <li><i class="fas fa-check-circle"></i> To become the most trusted travel agency in the
                                Andaman Islands</li>
                            <li><i class="fas fa-check-circle"></i> To redefine island tourism through sustainable</li>
                            <li><i class="fas fa-check-circle"></i> Build meaningful and memorable journeys for every
                                traveler</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="vision-mission__card vision-mission__card--mission">
                    <div class="vision-mission__card-header">
                        <div class="vision-mission__card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="vision-mission__card-title">Our Mission</h3>
                    </div>
                    <div class="vision-mission__card-body">
                        <p class="vision-mission__card-text" style="text-align:justify">Andaman Bliss™’s mission is to
                            listen to you and turn your dream into reality. Imagine yourself at white sandy beaches,
                            crystal clear blue waters and nothing but the sound of waves crashing and your heartbeat
                            syncing in together. As the Best Travel Agency In Andaman, we create a customized Andaman
                            Tour Packages that is crafted and designed according to your needs & interests. No matter
                            whenever you plan to visit Andaman Bliss™ will help you make it a perfect and memorable
                            experience.</p>
                        <ul class="vision-mission__card-list">
                            <li><i class="fas fa-check-circle"></i> Build customized and memorable tour experiences.
                            </li>
                            <li><i class="fas fa-check-circle"></i> Offer safe, secure, hassle free and a well organized
                                tours</li>
                            <li><i class="fas fa-check-circle"></i> Continuously upgrading us to provide guests with the
                                best satisfaction.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="features">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-tag">WHAT SETS US APART</div>
                <h2 class="section-heading">Why Choose <span>Andaman Bliss™?</span></h2>
                <div class="section-separator mx-auto"></div>
                <p class="section-description">Learn about the special and unique advantages that sets us apart from
                    other travel agencies for
                    exploring the Andaman Islands</p>
            </div>
        </div>

        <div class="features__grid">
            <div class="features__item">
                <div class="features__item-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="features__item-content">
                    <h3 class="features__item-title">Native Experience</h3>
                    <p class="features__item-text" style="text-align:justify">Being a native, we have a deep
                        understanding of the Andaman Islands, we ensure to provide you with a best experience of what
                        this beautiful paradise has to offer.</p>
                    <!-- <a href="#" class="features__item-link">Learn More <i class="fas fa-arrow-right"></i></a> -->
                </div>
            </div>

            <div class="features__item">
                <div class="features__item-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="features__item-content">
                    <h3 class="features__item-title">Personalized Service</h3>
                    <p class="features__item-text" style="text-align:justify">At Andaman Bliss™ we create each and every
                        itinerary with care and love, we make sure that it perfectly matches your preferences and travel
                        style. Each and every service of Andaman Bliss™ is different from others.</p>
                    <!-- <a href="#" class="features__item-link">Learn More <i class="fas fa-arrow-right"></i></a> -->
                </div>
            </div>

            <div class="features__item">
                <div class="features__item-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="features__item-content">
                    <h3 class="features__item-title">Sustainable Tourism</h3>
                    <p class="features__item-text" style="text-align:justify">We are so committed when it comes to
                        preserving the natural beauty of the islands and protecting the environment while providing best
                        and real travel experience.</p>
                    <!-- <a href="#" class="features__item-link">Learn More <i class="fas fa-arrow-right"></i></a> -->
                </div>
            </div>

            <div class="features__item">
                <div class="features__item-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="features__item-content">
                    <h3 class="features__item-title">Safety At Its Best</h3>
                    <p class="features__item-text" style="text-align:justify">We do consider safety as our top-most
                        priority.We stick to the highest safety standards for all of your activities, travel, and
                        accommodation all throughout your stay at the Islands.
                    </p>
                    <!-- <a href="#" class="features__item-link">Learn More <i class="fas fa-arrow-right"></i></a> -->
                </div>
            </div>

            <div class="features__item">
                <div class="features__item-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <div class="features__item-content">
                    <h3 class="features__item-title">Great Travel Experiences</h3>
                    <p class="features__item-text" style="text-align:justify">We provide you with a unique and premium
                        quality level of travel experience that allows you to explore the hidden gems of the Andaman
                        Islands that very few highly-rated travel agencies provide.</p>
                    <!-- <a href="#" class="features__item-link">Learn More <i class="fas fa-arrow-right"></i></a> -->
                </div>
            </div>

            <div class="features__item">
                <div class="features__item-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="features__item-content">
                    <h3 class="features__item-title">24/7 Support</h3>
                    <p class="features__item-text" style="text-align:justify">At Andaman Bliss™, we have a dedicated
                        support team that is always there for you, 24 hours a day, to be there for you during your time
                        in the Andaman Islands to address any questions or needs.</p>
                    <!-- <a href="#" class="features__item-link">Learn More <i class="fas fa-arrow-right"></i></a> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
 <section class="testimonials-section" id="testimonials">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-subtitle">What Our Travelers Say</span>
            <h2 class="section-title">Real <span class="text-gradient">Experiences</span> from Real Travelers</h2>
            <p class="section-description">Discover why thousands of travelers choose our Andaman packages for their
                dream vacation</p>
        </div>
        <div class="testimonial-slider-container">
            <div class="testimonial-slider" id="testimonialSlider">
                @foreach($reviews as $review)
                @php
                $hasImage = !empty($review->reviewer_profile_photo_url);
                $avatarLetter = strtoupper(substr($review['reviewer_name'], 0, 1));
                $bgColors = ['#f44336', '#e91e63', '#9c27b0', '#3f51b5', '#2196f3', '#009688', '#4caf50', '#ff9800',
                '#795548'];
                $bgColor = $bgColors[$loop->index % count($bgColors)];
                @endphp
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card-inner">
                        <div class="testimonial-header">
                            <div class="testimonial-quote">
                                <i class="fas fa-quote-left"></i>
                            </div>

                            <div class="testimonial-rating">
                                 @for ($i = 0; $i < $review['rating']; $i++) <i class="fas fa-star text-warning"></i>
                                @endfor
                                
                                <span>{{ number_format($review['rating'],1)}}</span>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <p class="testimonial-text">"Andaman Bliss made our family trip truly memorable! From
                                pristine beaches to well-organized sightseeing, everything was seamless. The kids loved
                                Radhanagar Beach, and we had the most relaxing time at Neil Island. Highly recommend
                                their family tour packages"</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                @if ($hasImage)
                                <img src="{{ $review->reviewer_profile_photo_url }}"
                                    alt="Sarah M.">
                                @else
                                <div class="rounded-circle me-3 d-flex justify-content-center align-items-center text-white"
                                    style="width: 50px; height: 50px; background-color: {{ $bgColor }}; font-size: 20px; font-weight: bold;">
                                    {{ $avatarLetter }}
                                </div>
                                @endif
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">{{ $review['reviewer_name'] }}</h4>
                                <p class="author-trip">Traveled in {{ \Carbon\carbon::parse($review['review_date'])->format('M-Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="testimonial-pagination-indicator d-md-none">
                <span id="currentSlideIndicator">1</span> / <span id="totalSlidesIndicator">6</span>
            </div>

            <div class="testimonial-controls">
                <button class="control-prev" id="testimonialPrev" aria-label="Previous testimonial">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="control-dots" id="testimonialDots"></div>
                <button class="control-next" id="testimonialNext" aria-label="Next testimonial">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="section-shape-3"></div>
</section>

<!-- Discover Andaman Section -->
<section class="destinations">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-tag">DISCOVER ANDAMAN</div>
                <h2 class="section-heading">Experience <span>Paradise</span> in Andaman</h2>
                <div class="section-separator mx-auto"></div>
                <p class="section-description">Explore the pristine beaches, vibrant coral reefs, and rich cultural
                    heritage of the Andaman Islands</p>
            </div>
        </div>

        <div class="destinations__grid">
            <div class="destinations__item">
                <div class="destinations__item-image">
                    <img src="https://images.unsplash.com/photo-1473116763249-2faaef81ccda?q=80&w=1792&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Pristine Beaches in Andaman Islands" loading="lazy">
                    <div class="destinations__item-overlay">
                        <a href="/destinations/beaches" class="destinations__item-link">Explore <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="destinations__item-content">
                    <!-- <div class="destinations__item-icon">
                        <i class="fas fa-umbrella-beach"></i>
                    </div> -->
                    <h3 class="destinations__item-title">Radhanagar Beach</h3>
                    <p class="destinations__item-text" style="text-align:justify">Spend your evening at the powdered
                        white sandy beaches and crystal-clear turquoise blue waters, which is absolutely perfect to
                        relax with your loved ones.</p>
                </div>
            </div>

            <div class="destinations__item">
                <div class="destinations__item-image">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800"
                        alt="Water Sports and Diving in Andaman Islands" loading="lazy">
                    <div class="destinations__item-overlay">
                        <a href="/destinations/water-sports" class="destinations__item-link">Explore <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="destinations__item-content">
                    <!-- <div class="destinations__item-icon">
                        <i class="fas fa-water"></i>
                    </div> -->
                    <h3 class="destinations__item-title" style="text-align:justify">Elephanta Beach</h3>
                    <p class="destinations__item-text">Discover the vibrant marine life and crystal-clear waters of
                        Elephanta Beach, perfect for snorkeling, glass-bottom boat rides, and relaxing by the pristine
                        shoreline.</p>
                </div>
            </div>

            <div class="destinations__item">
                <div class="destinations__item-image">
                    <img src="https://andamanbliss.com/site/img/rossisland.avif" alt="Ross Island" loading="lazy">
                    <div class="destinations__item-overlay">
                        <a href="/destinations/culture" class="destinations__item-link">Explore <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="destinations__item-content">
                    <!-- <div class="destinations__item-icon">
                        <i class="fas fa-landmark"></i>
                    </div> -->
                    <h3 class="destinations__item-title">Ross Island</h3>
                    <p class="destinations__item-text" style="text-align:justify">Explore the haunting beauty of
                        colonial-era ruins surrounded by
                        lush greenery and peacocks at Ross Island, once the British capital of the Andaman Islands.</p>
                </div>
            </div>

            <div class="destinations__item">
                <div class="destinations__item-image">
                    <img src="https://andamanbliss.com/site/img/cellular-jail4.webp" alt="Cellular jail" loading="lazy">
                    <div class="destinations__item-overlay">
                        <a href="/destinations/wildlife" class="destinations__item-link">Explore <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="destinations__item-content">
                    <!-- <div class="destinations__item-icon">
                        <i class="fas fa-leaf"></i>
                    </div> -->
                    <h3 class="destinations__item-title">Cellular Jail</h3>
                    <p class="destinations__item-text" style="text-align:justify"> Step back in time as you explore the
                        historic ruins, colonial
                        architecture, and scenic beauty of Ross Island — once the British administrative capital of the
                        Andaman Islands.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="/best-places-to-visit" class="btn-primary">View All Destinations <i
                    class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta">
    <div class="cta__bg">
        <div class="cta__overlay"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="cta__content">
                    <h2 class="cta__title">Are you Ready to Experience the Beauty & Magic of The Andaman Islands?</h2>
                    <p class="cta__text">Let Andaman Bliss™ help you plan a perfect getaway which is properly customised
                        according to your needs and preferences. Our team is ready to turn your dream into a reality.
                    </p>
                    <div class="cta__buttons">
                        <a href="/contact" class="cta__button cta__button--primary">Contact Us</a>
                        <a href="/andaman-tour-packages" class="cta__button cta__button--secondary">Browse Packages</a>
                    </div>
                    <div class="cta__trust-badges">
                        <div class="cta__trust-badge">
                            <i class="fas fa-lock"></i>
                            <span>Secure Booking</span>
                        </div>
                        <div class="cta__trust-badge">
                            <i class="fas fa-calendar-check"></i>
                            <span>Flexible Scheduling</span>
                        </div>
                        <div class="cta__trust-badge">
                            <i class="fas fa-tag"></i>
                            <span>Best Price Guarantee</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meet Our Team Section -->
<section class="team">
    <div class="team__bg">
        <div class="team__shape-top"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <div class="section-tag">MEET OUR TEAM</div>
                <h2 class="section-heading">The Faces Behind Your <span>Perfect Holiday</span></h2>
                <div class="section-separator mx-auto"></div>
                <p class="section-description">Our experienced team is dedicated to making your Andaman journey
                    unforgettable with their expertise and passion</p>
            </div>
        </div>

        <div class="team__filter">
           @php
    $departments = $teams->pluck('department')->unique();

    $departments = $departments->sortBy(fn($d) => $d === 'Sales Team' ? 0 : 1);
@endphp

@foreach ($departments as $department)
    <button class="team__filter-btn {{ $loop->first ? 'active' : '' }}"
        data-filter="{{ Str::slug($department) }}">{{ $department }}</button>
@endforeach

        </div>

        <div class="team__grid">

            @foreach ($teams as $team)

            <div class="team__member" data-category="{{ Str::slug($team->department) }}">
                <div class="team__card">
                    <div class="team__card-front">
                        <div class="team__image">
                            <img src="{{ $team->photo->file }}" alt="{{ ucwords($team->name) .' - '. $team->role}}"
                                loading="lazy">
                            <div class="team__badge">{{ ucwords($team->role) }}</div>
                        </div>
                        <div class="team__info">
                            <h3 class="team__name">{{ ucwords($team->name) }}</h3>
                            <!-- <p class="team__position">{{ ucwords($team->role) }}</p> -->
                            <!-- <div class="team__social">
                                <a href="#" class="team__social-link" aria-label="LinkedIn"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="team__social-link" aria-label="Twitter"><i
                                        class="fab fa-twitter"></i></a>
                                <a href="#" class="team__social-link" aria-label="Instagram"><i
                                        class="fab fa-instagram"></i></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="team__card-back">
                        <div class="team__bio">
                            <h3>{{ ucwords($team->name) }}</h3>
                            <p class="team__position">{{ ucwords($team->role) }}</p>
                            <p class="text-white fw-semibold fst-italic">"{{ ucfirst($team->description) }}"</p>

                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>


    </div>
    <div class="team__shape-bottom"></div>
</section>

<!-- CTA Section -->
<section class="adventure-cta">
    <div class="adventure-cta__bg">
        <div class="adventure-cta__overlay"></div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="adventure-cta__content">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="adventure-cta__left">
                                <h2 class="adventure-cta__title">Ready to Start Your <span>Andaman Adventure</span>?
                                </h2>
                                <p class="adventure-cta__text">Let us help you plan the perfect island getaway with
                                    personalized itineraries.</p>
                                <div class="adventure-cta__features">
                                    <div class="adventure-cta__feature"><i class="fas fa-calendar-check"></i> Flexible
                                        Booking</div>
                                    <div class="adventure-cta__feature"><i class="fas fa-tag"></i> Best Price Guarantee
                                    </div>
                                    <div class="adventure-cta__feature"><i class="fas fa-headset"></i> 24/7 Support
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="adventure-cta__right">
                                <div class="adventure-cta__actions">
                                    <a href="/contact" class="adventure-cta__button adventure-cta__button--primary">Get
                                        Started <i class="fas fa-arrow-right"></i></a>
                                    <a href="/andaman-tour-packages"
                                        class="adventure-cta__button adventure-cta__button--secondary">View Packages</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Adventure CTA Section Styles */
.adventure-cta {
    position: relative;
    padding: 60px 0;
    overflow: hidden;
}

.adventure-cta__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('https://images.unsplash.com/photo-1505228395891-9a51e7e86bf6?w=1920');
    background-size: cover;
    background-position: center;
    z-index: -2;
}

.adventure-cta__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.9), rgba(255, 126, 0, 0.85));
    z-index: -1;
}

.adventure-cta__content {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
}

.adventure-cta__left {
    text-align: left;
    padding-right: 20px;
}

.adventure-cta__right {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.adventure-cta__title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
}

.adventure-cta__title span {
    background: linear-gradient(135deg, rgb(213 148 17), rgb(255, 126, 0));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
}

.adventure-cta__text {
    font-size: 16px;
    color: var(--color-text-light);
    margin-bottom: 20px;
    line-height: 1.5;
}

.adventure-cta__features {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 0;
    justify-content: space-between;
}

.adventure-cta__feature {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--color-text-light);
    white-space: nowrap;
}

.adventure-cta__feature i {
    color: rgb(255, 126, 0);
    font-size: 14px;
    width: 16px;
}

.adventure-cta__actions {
    display: flex;
    flex-direction: row;
    gap: 15px;
    width: 100%;
    justify-content: center;
}

.adventure-cta__button {
    padding: 12px 25px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: auto;
}

.adventure-cta__button--primary {
    background: linear-gradient(135deg, rgb(213 157 17), rgb(255, 126, 0));
    color: #fff;
    box-shadow: 0 5px 15px rgba(255, 126, 0, 0.3);
}

.adventure-cta__button--primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(255, 126, 0, 0.4);
    color: #fff;
}

.adventure-cta__button--secondary {
    background-color: transparent;
    border: 2px solid rgb(17, 157, 213);
    color: rgb(17, 157, 213);
}

.adventure-cta__button--secondary:hover {
    background-color: rgb(17, 157, 213);
    color: #fff;
    transform: translateY(-3px);
}

.adventure-cta__button i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.adventure-cta__button:hover i {
    transform: translateX(5px);
}

@media (max-width: 767px) {
    .adventure-cta {
        padding: 40px 0;
    }

    .adventure-cta__content {
        padding: 25px 20px;
    }

    .adventure-cta__left {
        padding-right: 0;
        margin-bottom: 25px;
        text-align: center;
    }

    .adventure-cta__title {
        font-size: 24px;
    }

    .adventure-cta__features {
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .adventure-cta__actions {
        flex-direction: column;
    }

    .adventure-cta__button {
        width: 100%;
    }
}

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.badge.bg-primary {
    background-color: #FFA207 !important;
}

.card-text {
    color: var(--color-text-light);
    line-height: 1.6;
}

.feature-card,
.vision-card,
.mission-card,
.destination-card {
    transition: transform 0.3s ease;
}

.feature-card:hover,
.vision-card:hover,
.mission-card:hover,
.destination-card:hover {
    transform: translateY(-5px);
}

.bg-primary-exp {
    background-color: #FFA207;
}
</style>
@endpush

@push('styles')
<style>
.hero-section {
    position: relative;
    background-color: #000;
}

.hover-card {
    transition: transform 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-10px);
}

.about-image-wrapper img {
    transition: transform 0.5s ease;
}

.about-image-wrapper:hover img {
    transform: scale(1.1);
}

.social-links a {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background-color: #FFA207;
    border-color: #FFA207;
    color: white;
}

.text-primary {
    color: #FFF !important;
}

.text-primary-exp {
    color: #FFA207 !important;
}

.bg-primary {
    background-color: #FFA207 !important;
}

.btn-outline-primary {
    border-color: #FFA207;
    color: #FFA207;
}

.btn-outline-primary:hover {
    background-color: #FFA207;
    border-color: #FFA207;
    color: white;
}

/* Team Section Styles */
.team {
    position: relative;
    padding: 30px 0;
    overflow: hidden;
}

.team__bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #f8f9fa;
    z-index: -1;
}

.team__shape-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 70px;
    /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z'%3E%3C/path%3E%3C/svg%3E"); */
    background-size: cover;
    transform: rotate(180deg);
}

.team__shape-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 70px;
    /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E"); */
    background-size: cover;
}

.team__filter {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 40px;
}

.team__filter-btn {
    background-color: #fff;
    border: none;
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-color);
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.team__filter-btn.active,
.team__filter-btn:hover {
    background-color: var(--primary-color);
    color: #fff;
}

.team__grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
}

.team__member {
    perspective: 1000px;
}

.team__card {
    position: relative;
    width: 100%;
    height: 360px;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    cursor: pointer;
}

.team__member:hover .team__card {
    transform: rotateY(180deg);
}

.team__card-front,
.team__card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
}

.team__card-front {
    background-color: #fff;
}

.team__card-back {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: #fff;
    transform: rotateY(180deg);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
}

.team__image {
    position: relative;
    height: 320px;
    overflow: hidden;
}

.team__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.team__badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #262422a1;
    color: #fff;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    z-index: 1;
}

.team__info {
    padding: 10px;
    text-align: center;
}

.team__name {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 0px;
    color: var(--text-color);
}

.team__position {
    font-size: 14px;
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 15px;
}

.team__social {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.team__social-link {
    width: 35px;
    height: 35px;
    background-color: #f5f5f5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-color);
    transition: var(--transition);
}

.team__social-link:hover {
    background-color: var(--primary-color);
    color: #fff;
}

.team__bio {
    text-align: center;
}

.team__bio h3 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #fff;
}

.team__bio .team__position {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 20px;
}

.team__bio p {
    margin-bottom: 20px;
    line-height: 1.6;
}

.team__skills {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
}

.team__skills li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.team__skills li i {
    color: #fff;
    margin-right: 10px;
    font-size: 14px;
}

@media (max-width: 991px) {
    .team__grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 767px) {
    .team__filter {
        flex-direction: column;
        align-items: center;
    }

    .team__filter-btn {
        width: 100%;
        max-width: 200px;
    }

    
}
</style>
@endpush
@endsection