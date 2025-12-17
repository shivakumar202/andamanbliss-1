@extends('layouts.app')
@section('title', 'Privacy Policy - Andaman Bliss™')
@section('keywords', 'Privacy Policy, Andaman Bliss™ Privacy Policy, Data Protection, User Information, Website Privacy, Andaman Travel Privacy, Secure Booking, Andaman Bliss™ Data Security')
@section('description', 'Understand how we collect, store & protect your personal information. We ensure data security & transparency while offering a seamless booking experience.')
@section('content')
<!-- Header Section -->
<section class="privacy-header">
    <div class="privacy-overlay"></div>
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="privacy-header-content">
                    <h1 class="text-white">Privacy <span class="text-gradient"> Policy</span></h1>
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="privacy-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Privacy Content Section -->
<section class="privacy-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="privacy-sidebar">
                    <div class="privacy-toc">
                        <h3>Table of Contents</h3>
                        <ul class="privacy-nav">
                            <li><a href="#section1" class="active">1. Information We Collect</a></li>
                            <li><a href="#section2">2. How We Use Your Data</a></li>
                            <li><a href="#section3">3. Data Sharing & Disclosure</a></li>
                            <!-- <li><a href="#section4">4. Your Privacy Rights</a></li>
                            <li><a href="#section5">5. Data Security</a></li> -->
                        </ul>
                    </div>

                    <div class="privacy-contact-info">
                        <h3>Privacy Concerns?</h3>
                        <p>If you have any questions about our privacy practices, please contact our Data Protection Officer:</p>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@andamanbliss.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <span>+91 890 090 9900</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="privacy-container">
                    <div class="privacy-intro">
                        <p>At Andaman Bliss™, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
                        <p>Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the site.</p>
                    </div>

                    <div class="privacy-section" id="section1">
                        <div class="section-header">
                            <span class="section-number">01</span>
                            <h2>Information <span class="text-gradient">Collect</span></h2>
                        </div>
                        <div class="section-content">
                            <p>
                                We may collect personal information that you voluntarily provide to us when you register on our website, express interest in obtaining information about us or our products and services, participate in activities on the website, or otherwise contact us.
                            </p>

                            <div class="data-categories">
                                <div class="data-category">
                                    <div class="category-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="category-content">
                                        <h4>Personal Information</h4>
                                        <p>Name, email address, phone number, billing address, and other similar contact data.</p>
                                    </div>
                                </div>

                                <div class="data-category">
                                    <div class="category-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div class="category-content">
                                        <h4>Payment Information</h4>
                                        <p>Credit card details, bank account numbers, and billing information when you make a purchase.</p>
                                    </div>
                                </div>

                                <div class="data-category">
                                    <div class="category-icon">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div class="category-content">
                                        <h4>Technical Information</h4>
                                        <p>IP address, browser type, operating system, device information, and browsing actions.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="info-box">
                                <div class="info-icon">
                                    <i class="fas fa-cookie-bite"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Cookie Policy</h4>
                                    <p>We use cookies and similar tracking technologies to track activity on our website and store certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="privacy-section" id="section2">
                        <div class="section-header">
                            <span class="section-number">02</span>
                            <h2>How We Use Your Data</h2>
                        </div>
                        <div class="section-content">
                            <p>
                                We use the information we collect or receive to facilitate account creation, process transactions, send you marketing communications, and improve our services.
                            </p>

                            <ul class="privacy-list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>To fulfill and manage your bookings, orders, payments, and other transactions</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>To send administrative information, such as updates to our terms, conditions, and policies</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>To deliver targeted advertising, newsletters, promotions, and other information related to our offerings</span>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>To analyze website usage and improve the user experience</span>
                                </li>
                            </ul>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    <h4>Legal Basis for Processing</h4>
                                    <p>We process your personal information based on legitimate interests, consent, contractual necessity, and/or compliance with legal obligations.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="privacy-section" id="section3">
                        <div class="section-header">
                            <span class="section-number">03</span>
                            <h2>Data Sharing & Disclosure</h2>
                        </div>
                        <div class="section-content">
                            <p>
                                We may share your information with third parties that perform services for us or on our behalf, including payment processing, data analysis, email delivery, hosting services, and customer service.
                            </p>

                            <div class="row privacy-features">
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-handshake"></i>
                                        </div>
                                        <div class="feature-text">
                                            <h4>Business Partners</h4>
                                            <p>We may share your information with our business partners to offer you certain products, services, or promotions.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <div class="feature-text">
                                            <h4>Legal Requirements</h4>
                                            <p>We may disclose your information where required to comply with applicable law, governmental requests, or legal process.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p>
                                We do not sell, rent, or otherwise disclose your personal information to third parties for their marketing purposes without your explicit consent.
                            </p>
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
body, input, textarea, button, select, label {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Header Section Styles */
.privacy-header {
    position: relative;
    background-image: url('https://img.freepik.com/free-photo/beautiful-tropical-beach-sea-with-coconut-palm-tree_74190-7482.jpg');
    background-size: cover;
    background-position: center;
    min-height: 300px;
    display: flex;
    align-items: center;
    color: var(--white);
    padding: 80px 0 100px;
    overflow: hidden;
}

.privacy-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(17, 157, 213, 0.7) 100%);
    z-index: 1;
}

.privacy-header .container {
    z-index: 2;
}

.privacy-header-content {
    padding: 2rem 0;
}

.privacy-header-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
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

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.6);
}

.privacy-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.privacy-shape svg {
    width: 100%;
    height: 80px;
}

/* Privacy Content Styles */
.privacy-content {
    position: relative;
    padding: 60px 0 100px;
    background-color: var(--white);
}

/* Sidebar Styles */
.privacy-sidebar {
    position: sticky;
    top: 100px;
}

.privacy-toc {
    background-color: var(--light-bg);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--box-shadow);
}

.privacy-toc h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1.2rem;
    padding-bottom: 0.8rem;
    border-bottom: 2px solid var(--primary-light);
}

.privacy-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.privacy-nav li {
    margin-bottom: 0.8rem;
}

.privacy-nav li a {
    display: block;
    padding: 0.6rem 1rem;
    color: var(--text-dark);
    text-decoration: none;
    border-radius: 6px;
    transition: var(--transition);
    font-size: 0.95rem;
}

.privacy-nav li a:hover,
.privacy-nav li a.active {
    background-color: var(--primary-light);
    color: var(--primary-color);
    font-weight: 600;
}

.privacy-contact-info {
    background: linear-gradient(135deg, var(--primary-color) 0%, #0e8bc0 100%);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    color: var(--white);
    box-shadow: var(--box-shadow);
    position: relative;
    overflow: hidden;
}

.privacy-contact-info::before {
    content: '';
    position: absolute;
    top: -30px;
    right: -30px;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.privacy-contact-info::after {
    content: '';
    position: absolute;
    bottom: -40px;
    left: -40px;
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.privacy-contact-info h3 {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.privacy-contact-info p {
    font-size: 0.95rem;
    opacity: 0.9;
    margin-bottom: 1.2rem;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.contact-item i {
    width: 36px;
    height: 36px;
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.contact-item span {
    font-size: 0.95rem;
}

/* Privacy Container Styles */
.privacy-container {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2rem;
}

.privacy-intro {
    margin-bottom: 2rem;
}

.privacy-intro .lead {
    font-size: 1.2rem;
    color: var(--text-dark);
    font-weight: 500;
    margin-bottom: 1rem;
}

.privacy-section {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #eee;
}

.privacy-section:last-child {
    margin-bottom: 2rem;
    padding-bottom: 0;
    border-bottom: none;
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-light);
    margin-right: 1rem;
    line-height: 1;
}

.section-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: rgb(17, 157, 213);
    margin-bottom: 0;
}

.section-content {
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.7;
}

.section-content p {
    margin-bottom: 1.2rem;
}

.data-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.data-category {
    display: flex;
    background-color: var(--light-bg);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    transition: var(--transition);
}

.data-category:hover {
    transform: translateY(-5px);
    box-shadow: var(--box-shadow);
}

.category-icon {
    width: 50px;
    height: 50px;
    background-color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 1.2rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.category-content h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.category-content p {
    font-size: 0.9rem;
    margin-bottom: 0;
}

.info-box {
    display: flex;
    background-color: var(--primary-light);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin: 1.5rem 0;
}

.info-icon {
    width: 50px;
    height: 50px;
    background-color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 1.5rem;
    margin-right: 1.2rem;
    flex-shrink: 0;
}

.info-content h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.info-content p {
    font-size: 0.95rem;
    margin-bottom: 0;
}

.privacy-list {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0;
}

.privacy-list li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.privacy-list li i {
    color: var(--secondary-color);
    margin-right: 0.8rem;
    margin-top: 0.3rem;
}

.privacy-features {
    margin: 2rem 0;
}

.feature-item {
    display: flex;
    background-color: var(--light-bg);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    height: 100%;
    transition: var(--transition);
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--box-shadow);
}

.feature-icon {
    width: 50px;
    height: 50px;
    background-color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 1.2rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.feature-text h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.feature-text p {
    font-size: 0.9rem;
    margin-bottom: 0;
}

.privacy-rights {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.right-item {
    display: flex;
    background-color: var(--light-bg);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    transition: var(--transition);
}

.right-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--box-shadow);
}

.right-icon {
    width: 50px;
    height: 50px;
    background-color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 1.2rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.right-content h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.right-content p {
    font-size: 0.9rem;
    margin-bottom: 0;
}

.cta-box {
    background-color: var(--light-bg);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin: 2rem 0 1rem;
    text-align: center;
}

.cta-box h4 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.8rem;
}

.cta-box p {
    font-size: 1rem;
    margin-bottom: 0;
}

.cta-box a {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
}

.alert {
    display: flex;
    align-items: flex-start;
    border: none;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin: 1.5rem 0;
}

.alert-info {
    background-color: rgba(17, 157, 213, 0.1);
}

.alert-warning {
    background-color: rgba(253, 110, 15, 0.1);
}

.alert i {
    color: var(--secondary-color);
    font-size: 1.5rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.alert-info i {
    color: var(--primary-color);
}

.alert h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 0.5rem;
}

.alert-info h4 {
    color: var(--primary-color);
}

.alert p {
    font-size: 0.95rem;
    margin-bottom: 0;
    color: var(--text-dark);
}

.security-measures {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin: 2rem 0;
}

.measure-item {
    display: flex;
    align-items: center;
    background-color: var(--light-bg);
    border-radius: 50px;
    padding: 0.8rem 1.5rem;
    transition: var(--transition);
}

.measure-item:hover {
    background-color: var(--primary-light);
    transform: translateY(-3px);
}

.measure-item i {
    color: var(--primary-color);
    margin-right: 0.8rem;
}

.measure-item span {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-dark);
}

.privacy-footer {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #eee;
}

.privacy-footer-content {
    text-align: center;
    color: var(--text-light);
    font-size: 0.9rem;
}

.privacy-footer-content a {
    color: var(--primary-color);
    text-decoration: none;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .privacy-header-content h1 {
        font-size: 2.2rem;
    }

    .privacy-sidebar {
        margin-bottom: 2rem;
    }

    .section-number {
        font-size: 2rem;
    }

    .section-header h2 {
        font-size: 1.5rem;
    }

    .data-categories,
    .privacy-rights {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .privacy-header {
        min-height: 250px;
        padding: 60px 0 80px;
    }

    .privacy-header-content h1 {
        font-size: 1.8rem;
    }

    .privacy-container {
        padding: 1.5rem;
    }

    .info-box,
    .data-category,
    .feature-item,
    .right-item,
    .alert {
        flex-direction: column;
    }

    .info-icon,
    .category-icon,
    .feature-icon,
    .right-icon,
    .alert i {
        margin-bottom: 1rem;
        margin-right: 0;
    }

    .feature-item {
        margin-bottom: 1rem;
    }

    .security-measures {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
    .privacy-header {
        min-height: 200px;
        padding: 50px 0 70px;
    }

    .privacy-header-content h1 {
        font-size: 1.5rem;
    }

    .breadcrumb-wrapper {
        padding: 0.4rem 1rem;
    }

    .privacy-container {
        padding: 1rem;
    }

    .section-number {
        font-size: 1.5rem;
    }

    .section-header h2 {
        font-size: 1.2rem;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Smooth scrolling for anchor links
    $('.privacy-nav a').on('click', function(e) {
        e.preventDefault();

        // Remove active class from all links
        $('.privacy-nav a').removeClass('active');

        // Add active class to clicked link
        $(this).addClass('active');

        // Get the target section
        var target = $(this).attr('href');

        // Animate scroll to target
        $('html, body').animate({
            scrollTop: $(target).offset().top - 100
        }, 800);
    });

    // Highlight active section on scroll
    $(window).on('scroll', function() {
        var scrollPosition = $(window).scrollTop();

        // Check each section
        $('.privacy-section').each(function() {
            var topDistance = $(this).offset().top - 120;

            if (scrollPosition >= topDistance) {
                var sectionId = $(this).attr('id');

                // Remove active class from all links
                $('.privacy-nav a').removeClass('active');

                // Add active class to corresponding link
                $('.privacy-nav a[href="#' + sectionId + '"]').addClass('active');
            }
        });
    });

    // Animate elements on scroll
    function animateOnScroll() {
        $('.privacy-section, .privacy-sidebar > div').each(function() {
            var elementPos = $(this).offset().top;
            var topOfWindow = $(window).scrollTop();
            var windowHeight = $(window).height();

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