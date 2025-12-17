@extends('layouts.app')
@section('title', 'Bank Account Details - Andaman Bliss™')
@section('keywords', 'Andaman Bliss™ Bank Details, Andaman Bliss™ Payment Options, Andaman Tour Payment, Online Payment Andaman Bliss™, Andaman Bliss™ NEFT Transfer, Andaman Travel Agency Payment, Secure Payment Andaman')
@section('description', 'To make secure online transactions for your Andaman tour packages. Make payments via NEFT, RTGS, IMPS or online link. Ensure all details are entered correctly.')
@section('content')
<!-- Header Section -->
<section class="bank-header">
    <div class="bank-overlay"></div>
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="bank-header-content">
                    <h1 class="text-white">Payment Information</h1>
                    <p class="bank-subtitle">Secure and convenient payment options for your Andaman adventure</p>
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bank Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bank-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

<!-- Payment Options Section -->
<section class="payment-options-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="payment-options-container">
                    <div class="section-intro text-center mb-5">
                        <span class="section-subtitle">Payment Methods</span>
                        <h2 class="section-title">Choose Your <span class="highlight">Preferred</span> Payment Option
                        </h2>
                        <p class="section-description">We offer multiple secure payment methods for your convenience</p>
                    </div>

                    <div class="payment-methods">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="payment-method-card">
                                    <div class="method-icon">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <h3>Bank Transfer</h3>
                                    <p>Direct bank transfers via NEFT, RTGS, or IMPS</p>
                                    <span class="method-badge free">FREE</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="payment-method-card">
                                    <div class="method-icon">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <h3>UPI Payment</h3>
                                    <p>Quick payments using Google Pay, PhonePe, etc.</p>
                                    <span class="method-badge free">FREE</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="payment-method-card">
                                    <div class="method-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <h3>Card Payment</h3>
                                    <p>Secure payments using credit or debit cards</p>
                                    <span class="method-badge">FEES MAY APPLY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bank Details Section -->
<section class="bank-details-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bank-details-container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="bank-details-content">
                                <h2>Bank Account <span class="highlight">Details</span></h2>
                                <div class="bank-info">
                                    <div class="bank-info-item">
                                        <div class="info-label">Account Name</div>
                                        <div class="info-value">Andaman Bliss™ OPC Private Limited</div>
                                    </div>
                                    <div class="bank-info-item">
                                        <div class="info-label">Bank Name</div>
                                        <div class="info-value">HDFC BANK LTD.</div>
                                    </div>
                                    <div class="bank-info-item">
                                        <div class="info-label">Branch Address</div>
                                        <div class="info-value">Bathu Basti (Sri Vijaya Puram), Andaman Nicobar Island
                                        </div>
                                    </div>
                                    <div class="bank-info-item">
                                        <div class="info-label">Account Type</div>
                                        <div class="info-value">Current</div>
                                    </div>
                                    <div class="bank-info-item">
                                        <div class="info-label">Account Number</div>
                                        <div class="info-value account-number">50200112708303</div>
                                    </div>
                                    <div class="bank-info-item">
                                        <div class="info-label">IFSC Code</div>
                                        <div class="info-value">HDFC0009508</div>
                                    </div>

                                    <div class="bank-info-item">
                                        <div class="info-label">GST:IN</div>
                                        <div class="info-value">35ABDCA2206K1ZZ</div>
                                    </div>
                                </div>

                                <div class="online-payment mt-4">
                                    <h3>Online Payment Link</h3>
                                    <a href="https://www.instamojo.com/@andamanbliss" class="payment-link"
                                        target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Pay via Instamojo
                                    </a>
                                    <p class="payment-note">Secure payments via credit/debit cards, net banking, and UPI
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="qr-code-container">
                                <div class="qr-code-wrapper">
                                    <div class="qr-code-header">
                                        <i class="fas fa-qrcode"></i>
                                        <h3>Scan & Pay</h3>
                                    </div>
                                    <div class="qr-code-image">
                                        <img src="{{ asset('site/img/payement-scan.jpg') }}" class="img-fluid"
                                            alt="Payment QR Code" loading="lazy" />
                                    </div>
                                    <div class="qr-code-footer">
                                        <p>UPI ID: <strong>9679503320@pz</strong></p>
                                    </div>
                                </div>

                                <div class="important-note">
                                    <div class="note-header">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <h3>Important Note</h3>
                                    </div>
                                    <ul class="note-list">
                                        <li>Cash Deposit in any bank is chargeable as per Bank Rules.</li>
                                        <li>Online Transfer (NEFT/RTGS/IMPS) to any bank would be FREE.</li>
                                        <li>All deposit updates are only to be made during the operational time of the
                                            accounts department.</li>
                                        <li>We would like to request that all details must be entered correctly and
                                            clearly to avoid any delays in uploads.</li>
                                    </ul>
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
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="faq-container">
                    <div class="section-intro text-center mb-5">
                        <span class="section-subtitle">Common Questions</span>
                        <h2 class="section-title">Frequently Asked <span class="highlight">Questions</span></h2>
                        <p class="section-description">Find answers to common questions about our payment process</p>
                    </div>

                    <div class="faq-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="faq-item">
                                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1"
                                        aria-expanded="false" aria-controls="faq1">
                                        <div class="question-text">
                                            <span class="question-number">01</span>
                                            <h3>What is the recommended method for making payments?</h3>
                                        </div>
                                        <div class="question-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div id="faq1" class="faq-answer collapse">
                                        <div class="answer-content">
                                            <ul class="answer-list">
                                                <li>We recommend using online bank transfers such as NEFT, RTGS or IMPS,
                                                    which are free of charge.</li>
                                                <li>You can also deposit cash into the account at any Axis Bank branch,
                                                    though charges may apply as per the bank's rules.</li>
                                                <li>For instant payments you can also use our Instamojo online payment
                                                    link: <a href="https://www.instamojo.com/@andamanbliss"
                                                        target="_blank">Instamojo Payment Link</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="faq-item">
                                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2"
                                        aria-expanded="false" aria-controls="faq2">
                                        <div class="question-text">
                                            <span class="question-number">02</span>
                                            <h3>Are there any charges for making payments?</h3>
                                        </div>
                                        <div class="question-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div id="faq2" class="faq-answer collapse">
                                        <div class="answer-content">
                                            <ul class="answer-list">
                                                <li>Cash Deposit: Cash deposits made at any Axis Bank branch will incur
                                                    a charge according to Axis Bank's rules and regulations.</li>
                                                <li>Online Transfers (NEFT/RTGS/IMPS): These transactions are free of
                                                    charge when transferred to our account.</li>
                                                <li>Digital Payments: If you use a payment gateway like Instamojo or
                                                    Google Pay, ensure you check if there are any associated service
                                                    fees from your provider.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="faq-item">
                                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3"
                                        aria-expanded="false" aria-controls="faq3">
                                        <div class="question-text">
                                            <span class="question-number">03</span>
                                            <h3>How can I confirm my payment has been received?</h3>
                                        </div>
                                        <div class="question-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div id="faq3" class="faq-answer collapse">
                                        <div class="answer-content">
                                            <p>Once you have made a payment, it is essential to update your transaction
                                                details with us during the operational hours of our accounts department.
                                                This will ensure timely processing and confirmation of your payment.</p>
                                            <p>You can send a screenshot or payment confirmation to our support team via
                                                email or WhatsApp to ensure smooth processing.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="faq-item">
                                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4"
                                        aria-expanded="false" aria-controls="faq4">
                                        <div class="question-text">
                                            <span class="question-number">04</span>
                                            <h3>Can I use UPI apps like Google Pay or PhonePe?</h3>
                                        </div>
                                        <div class="question-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div id="faq4" class="faq-answer collapse">
                                        <div class="answer-content">
                                            <p>Yes, you can make payments via UPI apps like Google Pay, PhonePe and
                                                other UPI platforms by scanning the QR code provided on the page.
                                                Alternatively, you can directly use our <strong>UPI ID:
                                                    8900909900@okbizaxis</strong>.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="faq-item">
                                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5"
                                        aria-expanded="false" aria-controls="faq5">
                                        <div class="question-text">
                                            <span class="question-number">05</span>
                                            <h3>Is it possible to pay via a credit card or debit card?</h3>
                                        </div>
                                        <div class="question-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div id="faq5" class="faq-answer collapse">
                                        <div class="answer-content">
                                            <p>Yes, you can use a credit or debit card for payments through our
                                                Instamojo link. This link allows secure payment using major cards and
                                                digital wallets. Click here to pay using a card: <a
                                                    href="https://www.instamojo.com/@andamanbliss"
                                                    target="_blank">Instamojo Payment Link</a>.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="faq-item">
                                    <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq6"
                                        aria-expanded="false" aria-controls="faq6">
                                        <div class="question-text">
                                            <span class="question-number">06</span>
                                            <h3>What if I entered incorrect details while making a payment?</h3>
                                        </div>
                                        <div class="question-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    <div id="faq6" class="faq-answer collapse">
                                        <div class="answer-content">
                                            <p>If you have entered incorrect payment details, please contact our
                                                accounts department immediately. Make sure you provide your payment
                                                reference number and any details about the mistakes so we can assist you
                                                in resolving it as quickly as possible.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

        /* Header Section Styles */
        .bank-header {
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

        .bank-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(17, 157, 213, 0.7) 100%);
            z-index: 1;
        }

        .bank-header .container {
            z-index: 2;
            position: relative;
        }

        .bank-header-content {
            padding: 2rem 0;
            text-align: center;
        }

        .bank-header-content h1 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .bank-subtitle {
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

        .bank-shape {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            z-index: 2;
            line-height: 0;
        }

        .bank-shape svg {
            width: 100%;
            height: 80px;
        }

        /* Payment Options Section */
        .payment-options-section {
            padding: 80px 0 60px;
            background-color: var(--white);
        }

        .payment-options-container {
            margin-bottom: 30px;
        }

        .section-intro {
            margin-bottom: 3rem;
        }

        .section-subtitle {
            display: inline-block;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-title .highlight {
            color: var(--primary-color);
        }

        .section-description {
            font-size: 1.1rem;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
        }

        .payment-methods {
            margin-top: 3rem;
        }

        .payment-method-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            text-align: center;
            height: 100%;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .payment-method-card:hover {
            transform: translateY(-10px);
        }

        .payment-method-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-color);
        }

        .method-icon {
            width: 70px;
            height: 70px;
            background-color: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary-color);
            font-size: 1.8rem;
            transition: var(--transition);
        }

        .payment-method-card:hover .method-icon {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .payment-method-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .payment-method-card p {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .method-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            background-color: rgba(253, 110, 15, 0.1);
            color: var(--secondary-color);
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .method-badge.free {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        /* Bank Details Section */
        .bank-details-section {
            padding: 60px 0;
            background-color: var(--light-bg);
        }

        .bank-details-container {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 3rem;
            overflow: hidden;
        }

        .bank-details-content h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .bank-details-content h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 3px;
            background: var(--primary-color);
        }

        .bank-info {
            margin-bottom: 2rem;
        }

        .bank-info-item {
            display: flex;
            margin-bottom: 1.2rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid #eee;
        }

        .bank-info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 150px;
            font-weight: 600;
            color: var(--text-dark);
            flex-shrink: 0;
        }

        .info-value {
            color: var(--text-light);
        }

        .account-number {
            font-weight: 600;
            letter-spacing: 1px;
        }

        .online-payment h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .payment-link {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--secondary-color);
            color: var(--white);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .payment-link:hover {
            background-color: #e05d00;
            color: var(--white);
            transform: translateY(-3px);
        }

        .payment-note {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-top: 1rem;
        }

        .qr-code-container {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .qr-code-wrapper {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .qr-code-header {
            margin-bottom: 1.5rem;
        }

        .qr-code-header i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .qr-code-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .qr-code-image {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border: 2px dashed #eee;
            border-radius: var(--border-radius);
        }

        .qr-code-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .qr-code-footer p {
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 0;
        }

        .important-note {
            background-color: rgba(253, 110, 15, 0.1);
            border-radius: var(--border-radius);
            padding: 1.5rem;
        }

        .note-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .note-header i {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-right: 0.8rem;
        }

        .note-header h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0;
        }

        .note-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .note-list li {
            position: relative;
            padding-left: 1.5rem;
            line-height:22px;
            color: var(--text-dark);
            font-size: 13px;
        }

        .note-list li::before {
            content: '\2022';
            position: absolute;
            left: 0;
            top: 0;
            color: var(--secondary-color);
            font-weight: bold;
        }

        /* FAQ Section Styles */
        .faq-section {
            padding: 80px 0;
            background-color: var(--white);
        }

        .faq-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .faq-wrapper {
            margin-top: 3rem;
        }

        .faq-item {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .faq-item:hover {
            box-shadow: var(--box-shadow);
        }

        .faq-question {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .faq-question:hover {
            background-color: var(--primary-light);
        }

        .question-text {
            display: flex;
            align-items: center;
        }

        .question-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-right: 1rem;
            opacity: 0.5;
        }

        .question-text h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0;
        }

        .question-icon i {
            color: var(--primary-color);
            font-size: 1rem;
            transition: var(--transition);
        }

        .faq-question[aria-expanded="true"] .question-icon i {
            transform: rotate(180deg);
        }

        .faq-answer {
            border-top: 1px solid #eee;
        }

        .answer-content {
            padding: 1.5rem;
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .answer-content p:last-child {
            margin-bottom: 0;
        }

        .answer-list {
            padding-left: 1.2rem;
            margin-bottom: 0;
        }

        .answer-list li {
            margin-bottom: 0.8rem;
        }

        .answer-list li:last-child {
            margin-bottom: 0;
        }

        .faq-contact-info {
            margin-top: 4rem;
            padding: 2rem;
            background-color: var(--light-bg);
            border-radius: var(--border-radius);
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
        }

        .contact-button.phone {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .contact-button.phone:hover {
            background-color: #e05d00;
            color: var(--white);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .bank-header-content h1 {
                font-size: 2.2rem;
            }

            .bank-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .bank-details-container {
                padding: 2rem;
            }

            .qr-code-container {
                margin-top: 3rem;
            }
        }

        @media (max-width: 768px) {
            .bank-header {
                min-height: 250px;
                padding: 60px 0 80px;
            }

            .bank-header-content h1 {
                font-size: 1.8rem;
            }

            .payment-method-card {
                margin-bottom: 1.5rem;
            }

            .bank-info-item {
                flex-direction: column;
            }

            .info-label {
                width: 100%;
                margin-bottom: 0.5rem;
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
            .bank-header {
                min-height: 200px;
                padding: 50px 0 70px;
            }

            .bank-header-content h1 {
                font-size: 1.5rem;
            }

            .breadcrumb-wrapper {
                padding: 0.4rem 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .bank-details-container {
                padding: 1.5rem;
            }

            .question-number {
                font-size: 1.5rem;
            }

            .question-text h3 {
                font-size: 1rem;
            }
        }
        </style>
        @endpush

        @push('scripts')
        <script type="text/javascript">
        $(document).ready(function() {
            // Initialize FAQ accordion functionality
            $('.faq-question').on('click', function() {
                $(this).attr('aria-expanded', function(i, attr) {
                    return attr == 'true' ? 'false' : 'true';
                });

                // Toggle the collapse state
                $(this).next('.faq-answer').collapse('toggle');
            });

            // Add hover effect to payment method cards
            $('.payment-method-card').hover(
                function() {
                    $(this).find('.method-icon').addClass('bg-primary text-white');
                },
                function() {
                    $(this).find('.method-icon').removeClass('bg-primary text-white');
                }
            );
        });
        </script>
        @endpush