@extends('layouts.app')
@section('title', 'Payment')
@section('keywords', 'Andaman Bliss™ Payment, Online Payment Andaman Tour, Secure Travel Payment, Book Andaman Tour Online, Andaman Trip Payment, Travel Booking Payment Portal, Pay for Andaman Tour Securely.')
@section('description', 'Make secure online payments for your Andaman tour with Andaman Bliss™. Use credit/debit cards, net banking or wallets to complete your transaction easily.')
@section('content')
<!-- Header Section -->
<section class="payment-header">
    <div class="payment-overlay"></div>
    <div class="container">
        <div class="payment-header-content">
            <h1 class="text-white">Payment <span class="text-gradient">Details</span></h1>
            <p class="payment-subtitle">Secure and convenient payment options for your Andaman trip</p>
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="payment-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

<!-- Payment Section -->
<section class="payment-section">
    <div class="container">
        <div class="payment-container">
            <h2 class="section-title">Complete Your <span class="text-gradient">Payment</span></h2>
            <!-- Payment Method Tabs -->
            <ul class="nav payment-tabs" id="paymentTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="payment-tab active" id="online-payment-tab" data-bs-toggle="tab"
                        data-bs-target="#online-payment" type="button" role="tab" aria-controls="online-payment"
                        aria-selected="true">
                        <i class="fas fa-credit-card me-2"></i> Make Online Payment
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="payment-tab" id="submit-payment-tab" data-bs-toggle="tab"
                        data-bs-target="#submit-payment" type="button" role="tab" aria-controls="submit-payment"
                        aria-selected="false">
                        <i class="fas fa-receipt me-2"></i> Submit Payment Details
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-4" id="paymentTabsContent">
                <!-- Make Online Payment Form -->
                <div class="tab-pane fade show active" id="online-payment" role="tabpanel"
                    aria-labelledby="online-payment-tab">
                    <div class="payment-method-info">
                        <i class="fas fa-info-circle"></i>
                        <p>We accept Credit Cards, Debit Cards, Net Banking, EMI, and Digital Wallets for secure online
                            payments.</p>
                    </div>
                    <form class="payment-form">
                        <!-- Personal Details -->
                        <div class="form-section">
                            <h3 class="form-section-title">Personal <span class="text-gradient">Details</span></h3>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName"
                                            placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email ID</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Enter your email address" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone"
                                            placeholder="Enter your phone number" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Details -->
                        <div class="form-section">
                            <h3 class="form-section-title">Address <span class="text-gradient">Details</span></h3>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address"
                                            placeholder="Enter your address" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="cityState" class="form-label">City/State</label>
                                        <input type="text" class="form-control" id="cityState"
                                            placeholder="Enter city and state" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="zip" class="form-label">PIN Code/ZIP</label>
                                        <input type="text" class="form-control" id="zip" placeholder="Enter PIN code"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div class="form-section">
                            <h3 class="form-section-title">Service <span class="text-gradient">Details</span></h3>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="service" class="form-label">Service Type</label>
                                        <select id="service" class="form-select" required>
                                            <option value="" selected disabled>Select service</option>
                                            <option value="tour">Tour</option>
                                            <option value="hotels">Hotels</option>
                                            <option value="activity">Activity</option>
                                            <option value="cruise">Cruise</option>
                                            <option value="cab">Cab</option>
                                            <option value="bike">Bike</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="destination" class="form-label">Destination</label>
                                        <select id="destination" class="form-select" required>
                                            <option value="" selected disabled>Select destination</option>
                                            <option value="andaman">Andaman Nicobar Islands</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="bookingDate" class="form-label">Date of Booking</label>
                                        <input type="date" class="form-control" id="bookingDate" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="salesPerson" class="form-label">Sales Person</label>
                                        <select id="salesPerson" class="form-select" required>
                                            <option value="" selected disabled>Select sales person</option>
                                            <option value="salesperson1">Eswari Prakash</option>
                                            <option value="salesperson2">Asha</option>
                                            <option value="salesperson3">Sneha</option>
                                            <option value="salesperson4">Priyanka</option>
                                            <option value="salesperson5">Nirmala</option>
                                            <option value="salesperson6">Navin</option>
                                            <option value="salesperson7">Pravin</option>
                                            <option value="salesperson8">David</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Amount -->
                        <div class="form-section">
                            <h3 class="form-section-title">Payment <span class="text-gradient">Amount</span></h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="amount-section">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" class="form-control" id="amount" placeholder="Enter amount"
                                            required>
                                        <div class="form-text">A charge of 2.5% will be levied on all payments done
                                            through payment gateway.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="total-amount">
                                        <label for="totalAmount" class="form-label">Total Amount (including
                                            charges)</label>
                                        <input type="text" class="form-control" id="totalAmount" disabled
                                            placeholder="₹0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="form-section remarks-section">
                            <h3 class="form-section-title">Additional <span class="text-gradient">Information</span>
                            </h3>
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control" id="remarks" rows="4"
                                    placeholder="Enter remarks or purpose of payment"></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="button-container">
                            <button type="submit" class="btn btn-primary-payment">Pay Now</button>
                            <button type="reset" class="btn btn-secondary-payment">Reset</button>
                        </div>
                    </form>
                </div>

                <!-- Submit Payment Details Form -->
                <div class="tab-pane fade" id="submit-payment" role="tabpanel" aria-labelledby="submit-payment-tab">
                    <div class="payment-method-info">
                        <i class="fas fa-info-circle"></i>
                        <p>If you've already made a payment via bank transfer or other methods, please submit your
                            payment details here.</p>
                    </div>
                    <form class="payment-form">
                        <!-- Personal Details -->
                        <div class="form-section">
                            <h3 class="form-section-title">Personal <span class="text-gradient">Details</span></h3>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="fullName2" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName2"
                                            placeholder="Enter your full name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="email2" class="form-label">Email ID</label>
                                        <input type="email" class="form-control" id="email2"
                                            placeholder="Enter your email address" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="phone2" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone2"
                                            placeholder="Enter your phone number" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="form-section">
                            <h3 class="form-section-title">Payment <span class="text-gradient">Details</span></h3>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="bankName" class="form-label">Bank Name</label>
                                        <select id="bankName" class="form-select" required>
                                            <option value="" selected disabled>Select bank</option>
                                            <option value="axis">HDFC BANK LTD.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="transactionId" class="form-label">Transaction ID</label>
                                        <input type="text" class="form-control" id="transactionId"
                                            placeholder="Enter transaction ID" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="transferAmount" class="form-label">Transfer Amount</label>
                                        <input type="number" class="form-control" id="transferAmount"
                                            placeholder="Enter amount" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="dateOfTransfer" class="form-label">Date of Transfer</label>
                                        <input type="date" class="form-control" id="dateOfTransfer" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div class="form-section">
                            <h3 class="form-section-title">Service <span class="text-gradient">Details</span></h3>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="paymentType" class="form-label">Payment Type</label>
                                        <select id="paymentType" class="form-select" required>
                                            <option value="" selected disabled>Select payment type</option>
                                            <option value="online">Online Transfer (NEFT/RTGS/IMPS)</option>
                                            <option value="cheque">Cheque Deposit</option>
                                            <option value="cash">Cash Deposit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="destination2" class="form-label">Destination</label>
                                        <select id="destination2" class="form-select" required>
                                            <option value="" selected disabled>Select destination</option>
                                            <option value="andaman">Andaman Nicobar Islands</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="bookingDate2" class="form-label">Date of Booking</label>
                                        <input type="date" class="form-control" id="bookingDate2" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="salesPerson2" class="form-label">Sales Person</label>
                                        <select id="salesPerson2" class="form-select" required>
                                            <option value="" selected disabled>Select sales person</option>
                                            <option value="salesperson1">Eswari Prakash</option>
                                            <option value="salesperson2">Asha</option>
                                            <option value="salesperson3">Sneha</option>
                                            <option value="salesperson4">Priyanka</option>
                                            <option value="salesperson5">Nirmala</option>
                                            <option value="salesperson6">Navin</option>
                                            <option value="salesperson7">Pravin</option>
                                            <option value="salesperson8">David</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Remarks -->
                        <div class="form-section remarks-section">
                            <h3 class="form-section-title">Additional <span class="text-gradient">Information</span>
                            </h3>
                            <div class="mb-3">
                                <label for="remarks2" class="form-label">Remarks</label>
                                <textarea class="form-control" id="remarks2" rows="4"
                                    placeholder="Enter remarks or additional details"></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="button-container">
                            <button type="submit" class="btn btn-primary-payment">Submit Payment Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</section>
<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="faq-container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
                    <p class="lead">Find answers to common questions about our payment process and options.</p>
                </div>
            </div>

            <div class="faq-wrapper">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1"
                                aria-expanded="false" aria-controls="faq1">
                                <div class="question-text">
                                    <span class="question-number">01</span>
                                    <h3>What payment methods do you accept?</h3>
                                </div>
                                <div class="question-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div id="faq1" class="faq-answer collapse">
                                <div class="answer-content">
                                    <p>We accept a wide range of payment methods, including credit and debit cards
                                        (Visa, Mastercard, American Express), UPI payments, net banking and popular
                                        mobile wallets like Google Pay, Paytm and PhonePe. We also offer the option to
                                        pay through bank transfers for large bookings.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2"
                                aria-expanded="false" aria-controls="faq2">
                                <div class="question-text">
                                    <span class="question-number">02</span>
                                    <h3>Is it safe to make payments on your website?</h3>
                                </div>
                                <div class="question-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div id="faq2" class="faq-answer collapse">
                                <div class="answer-content">
                                    <p>Yes, absolutely! Our website uses SSL encryption and follows industry standard
                                        security protocols to ensure your payment details are protected. We partner with
                                        secure and trusted payment gateways to ensure all transactions are safe.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3"
                                aria-expanded="false" aria-controls="faq3">
                                <div class="question-text">
                                    <span class="question-number">03</span>
                                    <h3>Can I make a partial payment to confirm my booking?</h3>
                                </div>
                                <div class="question-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div id="faq3" class="faq-answer collapse">
                                <div class="answer-content">
                                    <p>Yes, for most packages we offer the option of making a partial payment to confirm
                                        your booking. The remaining balance can be paid closer to the travel date.
                                        Please refer to the specific package for details on the payment schedule.</p>
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
                                    <h3>What should I do if my payment fails?</h3>
                                </div>
                                <div class="question-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div id="faq4" class="faq-answer collapse">
                                <div class="answer-content">
                                    <p>If your payment fails, first ensure that you have entered the correct details and
                                        that there are no connectivity issues with your bank. If the issue persists, try
                                        using a different payment method. You can also contact our customer service team
                                        and they will assist you in resolving the issue.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5"
                                aria-expanded="false" aria-controls="faq5">
                                <div class="question-text">
                                    <span class="question-number">05</span>
                                    <h3>Can I pay in installments for my trip?</h3>
                                </div>
                                <div class="question-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div id="faq5" class="faq-answer collapse">
                                <div class="answer-content">
                                    <p>Yes, we offer the option of paying in installments for selected tour packages.
                                        The installment plans will be outlined during the booking process. Please note
                                        that the full payment must be made before your trip starts.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq6"
                                aria-expanded="false" aria-controls="faq6">
                                <div class="question-text">
                                    <span class="question-number">06</span>
                                    <h3>How do I know if my payment was successful?</h3>
                                </div>
                                <div class="question-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div id="faq6" class="faq-answer collapse">
                                <div class="answer-content">
                                    <p>After a successful payment, you will receive an email confirmation from Andaman
                                        Bliss with your booking details and payment receipt. You can also check the
                                        status of your payment by logging into your account dashboard on our website.
                                    </p>
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
.payment-header {
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

.payment-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(17, 157, 213, 0.85) 0%, rgba(17, 157, 213, 0.7) 100%);
    z-index: 1;
}

.payment-header .container {
    z-index: 2;
    position: relative;
}

.payment-header-content {
    padding: 2rem 0;
    text-align: center;
}

.payment-header-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.payment-subtitle {
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

.payment-shape {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.payment-shape svg {
    width: 100%;
    height: 80px;
}

/* Payment Form Section */
.payment-section {
    padding: 60px 0;
    background-color: var(--light-bg);
}

.payment-container {
    background-color: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 2rem;
    margin-bottom: 2rem;
}

.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: rgb(17, 157, 213);
    margin-bottom: 1.5rem;
    text-align: center;
}

/* Tab Navigation Styles */
.payment-tabs {
    display: flex;
    margin-bottom: 2rem;
    border-bottom: none;
    justify-content: center;
}

.payment-tab {
    padding: 1rem 2rem;
    font-weight: 600;
    color: var(--text-dark);
    background-color: var(--light-bg);
    border: none;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    margin: 0 0.5rem;
}

.payment-tab::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: transparent;
    transition: var(--transition);
}

.payment-tab.active {
    color: var(--primary-color);
    background-color: var(--white);
    box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.05);
}

.payment-tab.active::before {
    background-color: var(--primary-color);
}

.payment-tab:hover:not(.active) {
    background-color: rgba(255, 255, 255, 0.8);
}

/* Form Styles */
.form-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.form-section-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: rgb(17, 157, 213);
    margin-bottom: 1.5rem;
    padding-left: 1rem;
    border-left: 3px solid rgb(17, 157, 213);
}

.form-label {
    font-weight: 500;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.form-control {
    padding: 0.8rem 1rem;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(17, 157, 213, 0.15);
}

.form-select {
    padding: 0.8rem 1rem;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    transition: var(--transition);
}

.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(17, 157, 213, 0.15);
}

.form-text {
    font-size: 0.85rem;
    color: var(--text-light);
    margin-top: 0.5rem;
}

.form-text.text-danger {
    color: #dc3545;
}

/* Button Styles */
.btn-payment {
    padding: 0.8rem 2rem;
    font-weight: 600;
    border-radius: 50px;
    transition: var(--transition);
    border: none;
}

.btn-primary-payment {
    background-color: var(--primary-color);
    color: var(--white);
}

.btn-primary-payment:hover {
    background-color: #0e8bc0;
    transform: translateY(-3px);
}

.btn-secondary-payment {
    background-color: var(--secondary-color);
    color: var(--white);
}

.btn-secondary-payment:hover {
    background-color: #e05d00;
    transform: translateY(-3px);
}

.btn-outline-payment {
    background-color: transparent;
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
}

.btn-outline-payment:hover {
    background-color: var(--primary-color);
    color: var(--white);
    transform: translateY(-3px);
}

/* Payment Method Info */
.payment-method-info {
    background-color: var(--primary-light);
    border-radius: var(--border-radius);
    padding: 1rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.payment-method-info i {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin-right: 1rem;
}

.payment-method-info p {
    margin-bottom: 0;
    font-size: 0.95rem;
    color: var(--text-dark);
}

/* Amount Section */
.amount-section {
    background-color: var(--light-bg);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.amount-section .form-text {
    color: var(--secondary-color);
    font-weight: 500;
}

.total-amount {
    background-color: var(--primary-light);
    border-radius: var(--border-radius);
    padding: 1.5rem;
}

.total-amount .form-control {
    font-weight: 700;
    font-size: 1.2rem;
    color: var(--primary-color);
    text-align: center;
}

/* Remarks Section */
.remarks-section {
    margin-top: 1.5rem;
}

.remarks-section textarea {
    min-height: 120px;
}

/* Button Container */
.button-container {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

/* Text Gradient */
.text-gradient {
    background: linear-gradient(to right, #fff, #f9680f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: #f3a20e8c;
    font-weight: 800;
    display: inline-block;
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

/* FAQ Contact Info Styles */
.faq-contact-info {
    margin-top: 4rem;
    padding: 2rem;
    background-color: var(--light-bg);
    border-radius: var(--border-radius);
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
    .payment-header-content h1 {
        font-size: 2.2rem;
    }

    .payment-subtitle {
        font-size: 1rem;
    }

    .payment-container {
        padding: 1.5rem;
    }

    .payment-tab {
        padding: 0.8rem 1.5rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 768px) {
    .payment-header {
        min-height: 250px;
        padding: 60px 0 80px;
    }

    .payment-header-content h1 {
        font-size: 1.8rem;
    }

    .payment-tabs {
        flex-direction: column;
        align-items: center;
    }

    .payment-tab {
        width: 100%;
        margin-bottom: 0.5rem;
        border-radius: var(--border-radius);
        text-align: center;
    }

    .button-container {
        flex-direction: column;
    }

    .btn-payment {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .contact-buttons {
        flex-direction: column;
    }

    .contact-button {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .payment-header {
        min-height: 200px;
        padding: 50px 0 70px;
    }

    .payment-header-content h1 {
        font-size: 1.5rem;
    }

    .breadcrumb-wrapper {
        padding: 0.4rem 1rem;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .payment-container {
        padding: 1rem;
    }

    .form-section-title {
        font-size: 1.1rem;
    }
}
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // Calculate total amount with charges
    $('#amount').on('input', function() {
        var amount = parseFloat($(this).val()) || 0;
        var charges = amount * 0.025; // 2.5% charge
        var totalAmount = amount + charges;
        $('#totalAmount').val('₹' + totalAmount.toFixed(2));
    });

    // Form validation
    $('.payment-form').on('submit', function(e) {
        e.preventDefault();
        var isValid = true;

        // Basic validation
        $(this).find('input[required], select[required], textarea[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // Email validation
        var emailField = $(this).find('input[type="email"]');
        if (emailField.length && emailField.val() !== '') {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailField.val())) {
                isValid = false;
                emailField.addClass('is-invalid');
            }
        }

        // Phone validation
        var phoneField = $(this).find('input[type="tel"]');
        if (phoneField.length && phoneField.val() !== '') {
            var phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phoneField.val().replace(/[\s-]/g, ''))) {
                isValid = false;
                phoneField.addClass('is-invalid');
            }
        }

        // If form is valid, submit it
        if (isValid) {
            // For demo purposes, show success message
            alert('Form submitted successfully!');
            // In production, you would submit the form here
            // $(this).unbind('submit').submit();
        } else {
            // Show error message
            alert('Please fill in all required fields correctly.');
        }
    });

    // Reset validation on input
    $('input, select, textarea').on('input change', function() {
        $(this).removeClass('is-invalid');
    });

    // Tab switching animation
    $('.payment-tab').on('shown.bs.tab', function(e) {
        var target = $(e.target).data('bs-target');
        $(target).find('.payment-container').addClass('animate__animated animate__fadeIn');
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // FAQ accordion functionality
    $('.faq-question').on('click', function() {
        $(this).attr('aria-expanded', function(i, attr) {
            return attr == 'true' ? 'false' : 'true';
        });

        // Toggle the collapse state
        $(this).next('.faq-answer').collapse('toggle');
    });
});
</script>
@endpush