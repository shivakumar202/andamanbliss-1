@extends('layouts.app')
@section('title', 'Contact Us - Andaman Bliss™')
@section('keywords', 'Contact Andaman Bliss™, Andaman Travel Agency Contact, Andaman Tour Booking, Andaman Hotel Booking, Andaman Cab Rental, Andaman Bike Rental, Cruise Booking Andaman, Best Travel Agency in Andaman, Andaman Tour Packages, Andaman Tourism Support')
@section('description', 'Get in touch with Andaman Bliss™ for the best Andaman tour packages, hotel bookings, cab rentals & cruise bookings. Contact us today for the best vacation.')
@section('content')
<!-- Contact Section -->
<section class="contact-section">
    <div class="contact-bg-elements">
        <div class="contact-shape shape-1"></div>
        <div class="contact-shape shape-2"></div>
        <div class="contact-shape shape-3"></div>
        <div class="contact-shape shape-4"></div>
        <div class="contact-shape shape-5"></div>
    </div>

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-header text-center mb-5">
                    <span class="section-subtitle">Get In Touch</span>
                    <h1 class="section-title">Contact <span class="highlight">Us</span></h1>
                    <div class="title-separator">
                        <span><i class="fas fa-paper-plane"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="contact-container">
                    <div class="row g-0">
                        <!-- Contact Form -->
                        <div class="col-lg-7">
                            <div class="contact-form-container">
                                <form method="POST" action="{{ route('contact') }}" id="contactForm"
                                    class="contact-form">
                                    @csrf
                                    <div class="service-selector mb-4">
                                        <h3>I'm interested in:</h3>
                                        <div class="service-options">
                                            <label class="service-option">
                                                <input type="checkbox" name="services[]" value="tour">
                                                <span class="service-checkbox"></span>
                                                <span class="service-text">Tour Packages</span>
                                            </label>
                                            <label class="service-option">
                                                <input type="checkbox" name="services[]" value="hotel">
                                                <span class="service-checkbox"></span>
                                                <span class="service-text">Hotel Booking</span>
                                            </label>
                                            <label class="service-option">
                                                <input type="checkbox" name="services[]" value="cab">
                                                <span class="service-checkbox"></span>
                                                <span class="service-text">Cab Booking</span>
                                            </label>
                                            <label class="service-option">
                                                <input type="checkbox" name="services[]" value="bike">
                                                <span class="service-checkbox"></span>
                                                <span class="service-text">Bike Booking</span>
                                            </label>
                                            <label class="service-option">
                                                <input type="checkbox" name="services[]" value="water-activities">
                                                <span class="service-checkbox"></span>
                                                <span class="service-text">Water Activities Booking</span>
                                            </label>
                                            <label class="service-option">
                                                <input type="checkbox" name="services[]" value="ferry">
                                                <span class="service-checkbox"></span>
                                                <span class="service-text">Ferry Booking</span>
                                            </label>
                                        </div>
                                    </div>
                                    <input type="text" name="website" id="website" style="display:none;" tabindex="-1"
                                        autocomplete="off">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" id="firstName"
                                                    placeholder="First Name*" required>
                                                <div class="form-icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Email Address (Optional)">
                                                <div class="form-icon">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="tel" class="form-control" name="mobile" id="phone"
                                                    placeholder="Mobile Number*" required>
                                                <div class="form-icon">
                                                    <i class="fas fa-phone-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="message" name="message"
                                                    placeholder="Your Message" rows="4"></textarea>
                                                <div class="form-icon">
                                                    <i class="fas fa-comment-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-buttons">
                                                <button type="submit" class="btn-submit">
                                                    <span>Send Message</span>
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="col-lg-5">
                            <div class="contact-info-container">
                                <!-- Decorative shapes -->
                                <div class="shape-circle"></div>
                                <div class="shape-dots"></div>
                                <div class="shape-circle-small"></div>

                                <div class="contact-info-header">
                                    <h2 class="text-white">Contact Information</h2>
                                </div>

                                <div class="contact-info-content">
                                    <div class="contact-info-item">
                                        <div class="contact-info-icon">
                                            <i class="fa-solid fa-headphones"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h3>Reservation Support</h3>
                                            <p><i class="fas fa-envelope"></i> info@andamanbliss.com</p>
                                            <p><i class="fas fa-phone-alt"></i> 9933202248, 8900909900</p>

                                        </div>
                                    </div>

                                    <div class="contact-info-item">
                                        <div class="contact-info-icon">
                                            <i class="fa-solid fa-comments"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h3>Customer Support</h3>
                                            <p><i class="fas fa-envelope"></i> support@andamanbliss.com</p>
                                            <p><i class="fas fa-phone-alt"></i> 9679503320, 8900909900</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item">
                                        <div class="contact-info-icon">
                                            <i class="fa-solid fa-ship"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h3>Ferry Booking Support</h3>
                                            <p><i class="fas fa-envelope"></i> booking@andamanbliss.com</p>
                                            <p><i class="fas fa-phone-alt"></i> 9531823069, 8101872355</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item">
                                        <div class="contact-info-icon">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h3>B2B / Corporate Support</h3>
                                            <p><i class="fas fa-envelope"></i> b2b@andamanbliss.com</p>
                                            <p><i class="fas fa-phone-alt"></i> 7063953253, 9531972987</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item">
                                        <div class="contact-info-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h3>Address</h3>
                                            <p>2nd Floor, Foreshore Road, Phoenix Bay, Port Blair<br> Andaman Islands
                                            </p>
                                        </div>
                                    </div>

                                    <div class="contact-info-item">
                                        <div class="contact-info-icon">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <div class="contact-social">
                                                <h3 class="text-white">Connect With Us</h3>
                                                <div class="social-icons">
                                                    <a href="https://twitter.com/andaman_bliss" target="_blank"
                                                        aria-label="Twitter">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                    <a href="https://www.facebook.com/andamanbliss" target="_blank"
                                                        aria-label="Facebook">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                    <a href="https://www.instagram.com/andamanbliss" target="_blank"
                                                        aria-label="Instagram">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                    <a href="https://in.linkedin.com/in/andaman-bliss" target="_blank"
                                                        aria-label="LinkedIn">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                    <a href="https://in.pinterest.com/andamanbliss" target="_blank"
                                                        aria-label="Pinterest">
                                                        <i class="fab fa-pinterest-p"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="contact-info-item">
                                        <div class="contact-info-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="contact-info-text">
                                            <h3>Working Hours</h3>
                                            <p>Monday - Saturday (9AM - 6PM)<br>Sunday - Closed</p>
                                        </div>
                                    </div> -->
                                </div>

                                <!-- <div class="contact-map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3907.236315264613!2d92.71829457505535!3d11.6776574885313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x308895b2161cd085%3A0xa80e7524498a7c17!2sAndaman%20Bliss%20Tours%20and%20Travels!5e0!3m2!1sen!2sin!4v1711512289485!5m2!1sen!2sin"
                                        width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div> -->

                                <!-- <div class="contact-social">
                                    <h3 class="text-white">Connect With Us</h3>
                                    <div class="social-icons">
                                        <a href="https://twitter.com/andaman_bliss" target="_blank"
                                            aria-label="Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://www.facebook.com/andamanbliss" target="_blank"
                                            aria-label="Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://www.instagram.com/andamanbliss" target="_blank"
                                            aria-label="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="https://in.linkedin.com/in/andaman-bliss" target="_blank"
                                            aria-label="LinkedIn">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="https://in.pinterest.com/andamanbliss" target="_blank"
                                            aria-label="Pinterest">
                                            <i class="fab fa-pinterest-p"></i>
                                        </a>
                                    </div>
                                </div> -->

                            </div>
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
    --text-dark: #333;
    --text-light: #666;
    --white: #fff;
    --light-bg: #f8f9fa;
    --border-radius: 12px;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

/* Global Font Smoothing */
body,
input,
textarea,
button,
select,
label {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Contact Section Styles */
.contact-section {
    position: relative;
    padding: 100px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9f6fd 100%);
    overflow: hidden;
}

/* Background Elements */
.contact-bg-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.contact-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.5;
}

.shape-1 {
    top: -100px;
    right: -100px;
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.2) 0%, rgba(17, 157, 213, 0.1) 100%);
    animation: float 8s infinite ease-in-out;
}

.shape-2 {
    bottom: -80px;
    left: -80px;
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, rgba(253, 110, 15, 0.2) 0%, rgba(253, 110, 15, 0.1) 100%);
    animation: float 10s infinite ease-in-out;
}

.shape-3 {
    top: 30%;
    left: 10%;
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.15) 0%, rgba(17, 157, 213, 0.05) 100%);
    animation: float 7s infinite ease-in-out;
}

.shape-4 {
    top: 20%;
    right: 15%;
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, rgba(253, 110, 15, 0.15) 0%, rgba(253, 110, 15, 0.05) 100%);
    animation: float 9s infinite ease-in-out;
}

.shape-5 {
    bottom: 20%;
    right: 10%;
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.1) 0%, rgba(17, 157, 213, 0.05) 100%);
    animation: float 11s infinite ease-in-out;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }

    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

/* Section Header */
.section-header {
    position: relative;
    z-index: 2;
    margin-bottom: 3rem;
}

.section-subtitle {
    display: inline-block;
    font-size: 1rem;
    font-weight: 600;
    color: var(--secondary-color);
    background-color: rgba(253, 110, 15, 0.1);
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    margin-bottom: 1rem;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.section-title {
    font-size: 3rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 1rem;
    letter-spacing: -0.5px;
}

.section-title .highlight {
    color: var(--secondary-color);
    position: relative;
}

.section-title .highlight::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: rgba(17, 157, 213, 0.2);
    z-index: -1;
    border-radius: 10px;
}

.title-separator {
    position: relative;
    height: 2px;
    width: 80px;
    background-color: rgba(17, 157, 213, 0.3);
    margin: 1.5rem auto 0;
}

.title-separator span {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: var(--secondary-color);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.title-separator i {
    color: var(--white);
    font-size: 1rem;
}

/* Contact Container */
.contact-container {
    position: relative;
    z-index: 2;
    background-color: var(--white);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
}

/* Contact Form Styles */
.contact-form-container {
    background-color: var(--white);
}

.service-selector h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1.2rem;
    color: var(--text-dark);
}

.service-options {
    display: flex;
    flex-wrap: wrap;
    gap: 1.2rem;
}

.service-option {
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: var(--transition);
}

.service-option input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.service-checkbox {
    position: relative;
    height: 20px;
    width: 20px;
    background-color: #f0f0f0;
    border: 2px solid #ddd;
    border-radius: 4px;
    margin-right: 8px;
    transition: var(--transition);
}

.service-option:hover .service-checkbox {
    border-color: var(--primary-color);
}

.service-option input:checked~.service-checkbox {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.service-checkbox:after {
    content: "";
    position: absolute;
    display: none;
    left: 5px;
    top: 1px;
    width: 6px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.service-option input:checked~.service-checkbox:after {
    display: block;
}

.service-text {
    font-size: 0.95rem;
    color: var(--text-dark);
    transition: var(--transition);
    font-weight: 500;
}

.service-option:hover .service-text {
    color: var(--primary-color);
}

.form-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-control {
    height: auto;
    padding: 1rem 1rem 1rem 3rem;
    font-size: 1rem;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    background-color: #f9f9f9;
    transition: var(--transition);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(17, 157, 213, 0.15);
    background-color: #fff;
}

.form-control::placeholder {
    color: #888;
    font-size: 0.95rem;
    opacity: 1;
}

.form-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    font-size: 1rem;
    pointer-events: none;
}

.form-group textarea~.form-icon {
    top: 20px;
    transform: none;
}

.form-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn-submit {
    background: linear-gradient(135deg, var(--primary-color) 0%, #0e8bc0 100%);
    color: var(--white);
    border: none;
    padding: 1rem 2rem;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 10px 20px rgba(17, 157, 213, 0.2);
    width: 100%;
    letter-spacing: 0.5px;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(17, 157, 213, 0.3);
}

.btn-submit i {
    font-size: 1rem;
    transition: transform 0.3s ease;
}

.btn-submit:hover i {
    transform: translateX(5px);
}

/* Contact Info Styles */
.contact-info-container {
    background: linear-gradient(135deg, #03A9F4 0%, #FF5722 100%);
    color: var(--white);
    height: 100%;
    padding: 3rem 2rem;
    position: relative;
    overflow: hidden;
}

.contact-info-container::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect x="0" y="0" width="100" height="100" fill="none"/><path d="M0,0 L100,100" stroke="rgba(255,255,255,0.05)" stroke-width="1"/><path d="M100,0 L0,100" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></svg>');
    background-size: 20px 20px;
    opacity: 0.5;
}

/* Decorative shapes for contact info container */
.contact-info-container::after {
    content: '';
    position: absolute;
    top: 20px;
    right: 20px;
    width: 70px;
    height: 70px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.25);
    transform: rotate(45deg);
    z-index: 0;
}

.contact-info-container .shape-circle {
    position: absolute;
    bottom: 40px;
    left: -20px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0.15) 100%);
    z-index: 0;
}

.contact-info-container .shape-dots {
    position: absolute;
    top: 50%;
    right: 30px;
    transform: translateY(-50%);
    width: 60px;
    height: 120px;
    z-index: 0;
    opacity: 0.5;
}

.contact-info-container .shape-dots::before,
.contact-info-container .shape-dots::after {
    content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.6);
}

.contact-info-container .shape-dots::before {
    top: 0;
    left: 0;
    box-shadow:
        20px 20px 0 rgba(255, 255, 255, 0.6),
        40px 40px 0 rgba(255, 255, 255, 0.6),
        0px 40px 0 rgba(255, 255, 255, 0.6),
        40px 0px 0 rgba(255, 255, 255, 0.6),
        20px 60px 0 rgba(255, 255, 255, 0.6),
        0px 80px 0 rgba(255, 255, 255, 0.6),
        40px 80px 0 rgba(255, 255, 255, 0.6),
        20px 100px 0 rgba(255, 255, 255, 0.6);
}

.contact-info-container .shape-circle-small {
    position: absolute;
    bottom: 20px;
    right: 40px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0.1) 70%);
    z-index: 0;
    animation: pulse 6s infinite ease-in-out;
}

@keyframes pulse {

    0%,
    100% {
        transform: scale(1);
        opacity: 0.2;
    }

    50% {
        transform: scale(1.1);
        opacity: 0.3;
    }
}

.contact-info-header {
    position: relative;
    margin-bottom: 2rem;
}

.contact-info-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 0;
    position: relative;
    display: inline-block;
}

.contact-info-header h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 50px;
    height: 3px;
    background-color: #fff;
    border-radius: 10px;
}

.contact-info-content {
    position: relative;
    z-index: 1;
}

.contact-info-item {
    display: flex;
    align-items: flex-start;
    transition: var(--transition);
    padding: 1rem;
    border-radius: 10px;
}

.contact-info-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}

.contact-info-item:hover p {
    color: #000;
    transform: translateX(5px);
}


.contact-info-icon {
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
    transition: var(--transition);
}

.contact-info-item:hover .contact-info-icon {
    background-color: var(--secondary-color);
    transform: rotate(360deg);
}

.contact-info-icon i {
    font-size: 1rem;
}

.contact-info-text h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
    color: #fff;
}

.contact-info-text p {
    font-size: 0.95rem;
    opacity: 0.8;
    line-height: 1.5;
    margin-bottom: 0;
    color: #fff;
}

.contact-map {
    margin: 2rem 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.contact-social {
    position: relative;
    z-index: 1;
}

.contact-social h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.social-icons {
    display: flex;
    gap: 0.8rem;
}

.social-icons a {
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    transition: var(--transition);
}

.social-icons a:hover {
    background-color: var(--secondary-color);
    transform: translateY(-5px);
}

/* Responsive Styles */
@media (max-width: 992px) {
    .section-title {
        font-size: 2.5rem;
    }

    .contact-form-container,
    .contact-info-container {
        padding: 2rem;
    }

    .service-options {
        flex-direction: column;
        gap: 0.8rem;
    }
}

@media (max-width: 768px) {
    .contact-section {
        padding: 80px 0;
    }

    .section-title {
        font-size: 2rem;
    }

    .contact-container {
        border-radius: 15px;
    }

    .contact-form-container {
        padding: 1.5rem;
    }

    .form-buttons {
        flex-direction: column;
    }

    .btn-submit {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .section-title {
        font-size: 1.8rem;
    }

    .section-subtitle {
        font-size: 0.8rem;
        padding: 0.4rem 1rem;
    }

    .contact-info-item {
        padding: 0.8rem;
    }

    .contact-info-icon {
        width: 35px;
        height: 35px;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Service checkbox animation
    $('.service-option').on('click', function() {
        $(this).find('input[type="checkbox"]').prop('checked', function(i, val) {
            return !val;
        });
    });


    // Hide form message
    function hideFormMessage() {
        $('.form-alert').fadeOut(300, function() {
            $(this).remove();
        });
    }

    // Add animation to form fields on focus
    $('.form-control').on('focus', function() {
        $(this).parent().find('.form-icon').addClass('text-primary');
    }).on('blur', function() {
        $(this).parent().find('.form-icon').removeClass('text-primary');
    });

    // Animate elements on scroll
    function animateOnScroll() {
        $('.contact-container').each(function() {
            const elementPos = $(this).offset().top;
            const topOfWindow = $(window).scrollTop();
            const windowHeight = $(window).height();

            if (elementPos < topOfWindow + windowHeight - 100) {
                $(this).addClass('animate__animated animate__fadeInUp');
            }
        });
    }

    // Run animation on page load
    setTimeout(function() {
        animateOnScroll();
    }, 500);

    // Run animation on scroll
    $(window).on('scroll', function() {
        animateOnScroll();
    });
});
</script>
@endpush