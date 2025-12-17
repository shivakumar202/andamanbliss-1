@extends('layouts.app')
@section('title', 'Car Payment | Andaman Bliss')
@section('keywords', 'car rental, car booking, andaman car rental, payment')
@section('description', 'Complete your car rental booking payment for Andaman Islands')

@section('content')
    <div id="payment-loader"
        style="
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(2px);
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    color: #000;
    font-weight: bold;
">
        Initializing Payment...
    </div>
    <div id="booking-loader"
        style="
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(2px);
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    color: #000;
    font-weight: bold;
">
        Processing Booking...
    </div>
    <div class="cp-page">
        <div class="container">
            <!-- Progress Steps -->
            <div class="cp-progress-wrapper">
                <div class="cp-progress-container">
                    <div class="cp-progress-step cp-step-complete">
                        <div class="cp-step-top">
                            <div class="cp-step-circle">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </div>
                        <div class="cp-step-text">1. Review & Travellers</div>
                    </div>
                    <div class="cp-progress-line-wrapper">
                        <div class="cp-line cp-line-complete"></div>
                    </div>
                    <div class="cp-progress-step cp-step-active">
                        <div class="cp-step-top">
                            <div class="cp-step-circle">2</div>
                        </div>
                        <div class="cp-step-text">2. Payment</div>
                    </div>
                    <div class="cp-progress-line-wrapper">
                        <div class="cp-line cp-line-inactive"></div>
                    </div>

                    <div class="cp-progress-step cp-step-inactive">
                        <div class="cp-step-top">
                            <div class="cp-step-circle">3</div>
                        </div>
                        <div class="cp-step-text">3. Confirmation</div>
                    </div>
                </div>
            </div>

            <div class="cp-layout">
                <!-- Left Column -->
                <div class="cp-main">
                    <!-- Pickup Info Card -->
                    <div class="cp-card">
                        <div class="cp-pickup-title">
                            <strong>Pickup :</strong>
                            {{ \Carbon\carbon::parse($cabs->pickup_date)->format('l, d F y H:i A') }} - <strong>{{ ucwords($cabs->type.' '. $cabs->trip_type) }}</strong>
                        </div>
                        <div class="cp-car-section">
                            <div class="cp-car-image-box">
                                <div class="cp-car-img">
                                    <img src="{{$cab->cabPhotos[0]->file}}" alt="Car">
                                </div>
                                <div class="cp-car-badge">{{ $cabs->category }}</div>
                            </div>

                            <div class="cp-car-info">
                                <div class="cp-route">
                                    <div class="cp-route-item">
                                        <strong>Pickup</strong>
                                        <p>{{ $cabs->pick_up }}</p>
                                    </div>
                                    <div class="cp-route-arrow">→</div>
                                    <div class="cp-route-item">
                                        <strong>Drop-Off</strong>
                                        <p>{{ $cabs->drop_location }}</p>
                                    </div>
                                </div>

                                <div class="cp-specs">
                                    <div class="cp-spec-item">
                                        <i class="fa-solid fa-car"></i>
                                        <div>
                                            <strong>Car Model</strong>
                                            <span>{{ $cabs->name }}</span>
                                        </div>
                                    </div>
                                    <div class="cp-spec-item">
                                        <i class="fa-solid fa-bolt"></i>
                                        <div>
                                            <strong>Km Charges</strong>
                                            <span>Rs. {{ $cabs->extra_fare }} after {{ $cabs->distance_covered ?? 5 }}
                                                Kms</span>
                                        </div>
                                    </div>
                                    <div class="cp-spec-item">
                                        <i class="fa-solid fa-gas-pump"></i>
                                        <div>
                                            <strong>Fuel Type</strong>
                                            <span>{{ $cabs->fuel_type }}</span>
                                        </div>
                                    </div>
                                    <div class="cp-spec-item">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        <div>
                                            <strong>Extra</strong>
                                            <span>{{ $cabs->luggage ?? '1 Luggage Bags' }} | {{ $cabs->sitting_capacity }}
                                                Seats | AC</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Travellers Details -->
                    <form action="{{ route('cabs.store') }}" method="post" id="travelform" enctype="multipart/form-data">
                        <div class="cp-card">
                            <h2 class="cp-section-title">Travellers Details</h2>

                            <div class="cp-title-select">
                                <button type="button" class="cp-title-btn btn-sm cp-title-active">Mr.</button>
                                <button type="button" class="cp-title-btn btn-sm">Ms.</button>
                                <button type="button" class="cp-title-btn btn-sm">Mrs.</button>
                            </div>
                            <input type="hidden" name="title" id="titleInput" value="Mr.">


                            <div class="cp-form-row">
                                <div class="cp-field">
                                    <label>First Name</label>
                                    <input type="text" class="cp-input" value="{{ $logged['f_name'] ?? '' }}" name="f_name" placeholder="Enter First Name">
                                </div>
                                <div class="cp-field">
                                    <label>Last Name</label>
                                    <input type="text" class="cp-input" value="{{ $logged['l_name'] ?? '' }}" name="l_name" placeholder="Enter Last Name">
                                </div>
                            </div>

                            <div class="cp-form-row">
                                <div class="cp-field">
                                    <label>Email</label>
                                    <input type="email" class="cp-input" name="email" value="{{ $logged['email'] ?? '' }}" placeholder="Enter Your Email Address">
                                    <small>Your booking details will be sent to this email address and mobile
                                        number.</small>
                                </div>
                                <div class="cp-field">
                                    <label>Phone</label>
                                    <div class="cp-phone">
                                        <select class="cp-code" name="tel_code">
                                            <option selected>+91</option>
                                            <option>+1</option>
                                            <option>+44</option>
                                        </select>
                                        <input type="tel" class="cp-input w-100" name="tel_no" value="{{ $logged['mobile'] ?? '' }}" placeholder="Enter Mobile No">
                                    </div>
                                </div>
                            </div>
                             @if($cabs->type == 'airport')
                            <div class="cp-field">
                                <div class="cp-arrival">
                                    <label class="cp-radio-label">
                                        <input type="radio" name="arrival">
                                        <span>Flight</span>
                                    </label>
                                </div>
                                <input type="text" class="cp-input" name="flight_no" placeholder="Enter Flight No.">
                            </div>
                            @endif

                            <div class="cp-terms">
                                <label>
                                    <input type="checkbox" name="agree" require>
                                    <span>I understand and agree to the rules of this fare, and the <a href="#terms">Terms
                                            & Conditions</a></span>
                                </label>
                            </div>
                        </div>

                        <!-- Trip Details -->
                        <div class="cp-card">
                            <h2 class="cp-section-title">Trip Details</h2>

                            <div class="cp-field">
                                <label>Pick-Up Address <i class="fa-solid fa-info-circle"></i></label>
                                <input type="text" class="cp-input" name="pickup_location" value="{{ $cabs->pick_up }}"
                                    readonly>
                                <div class="cp-note">{{ $cabs->pick_up }}</div>
                            </div>

                            <div class="cp-field">
                                <label>Drop-Off Address <i class="fa-solid fa-info-circle"></i></label>
                                <input type="text" class="cp-input" name="drop_location"
                                    placeholder="{{ $cabs->drop_location }}" value="{{ $cabs->drop_location }}" readonly>
                                <div class="cp-note">{{ $cabs->drop_location }}</div>
                            </div>
                            <input type="text" name="cabs" value='@json($cabs)' hidden>
                           
                        </div>
                    </form>
                    <!-- Read Before You Book -->
                    <div class="cp-card cp-accordion" id="terms">
    <button class="cp-accordion-btn">
        <span>Read Before You Book</span>
        <i class="fa-solid fa-chevron-down"></i>
    </button>
    <div class="cp-accordion-body">
        <div class="cp-info-block">
            <h4>Important Information</h4>
            <p><strong>Hilly Areas:</strong> AC will be off in the hilly areas or when the vehicle is stationary.</p>
            <p><strong>Luggage Policy:</strong> A sedan car has the capacity of only 2 large luggage bags. So, depending on the passenger luggage can be adjusted in the seating areas with the driver's consent.</p>
            <p><strong>Stop Over:</strong> This is Point to Point Booking, so only one stop for a meal is included.</p>
            <p><strong>Waiting Charges:</strong> The driver will be up to 30 minutes from your pickup booking timing. And if there is more delay, your trip may be canceled without any refund. You will need to pay Rs. 150 per hour, if it gets mutually arranged with the driver.</p>
            <p><strong>Night Charges:</strong> From 10 PM to 6 AM, an additional charge of rupees 250 per night will be charged. The charges are directly paid to the driver.</p>
            <p><strong>Extra Kilometer:</strong> The moment you exceed the kms limit, extra charges for kms will be applicable. The distance will be calculated from point to point basis.</p>
            <p><strong>Delays:</strong> Pickup may get delayed up to 30 minutes due to traffic or some unforeseen reason.</p>
            <p><strong>Other Charges:</strong> Small pets are allowed only if you are informed at the time of bookings. You will be charged Rs.1000 by the cab operator as a pet cleaning fees. Extra pickup/Drop charges of Rs. 150 per person will be applicable for extra km charge.</p>
            <p><strong>Additional Information:</strong> You will be responsible for maintaining your travel schedule, Andaman Bliss is not responsible for any delays or missed connections. The cab availability, fuel type and possible delays like CNG, refill or traffic totally depends on the circumstances and may even vary.</p>
        </div>

        <div class="cp-info-block">
            <h4>Terms and Conditions</h4>
            <p>The term “Cab” refers to all types of passenger vehicles, it includes all categories of transport vehicles like hatchbacks, sedans, SUVs, MUVs and any other transport vehicles that are meant for transportation passengers.</p>
            <p>A “Cab Operator” means any company or individual that provides cab service along with the drive for hire.</p>
        </div>

            <div class="cp-info-block">
            <h4>Cancellation Policy</h4>
            <ul>
                <li>Free Cancellation: If you cancel before 24 hours.</li>
                <li>Cancellation Charges: If you cancel within 24 hours of your journey time, no refund will be applicable.</li>
                <li>In case of natural calamity, traffic jam, strike or road blockage, we will not be responsible for any delays or cancellations.</li>
                <li>Andaman Bliss has the rights to modify or cancel the booking at any point of time.</li>
                <li>If you want to cancel your booking, submit your cancellation request directly to our website mail. </li>
            </ul>
        </div>

        <div class="cp-info-block">
            <h4>Cab Services</h4>
            <p>The cabs are operated by licensed local drivers that can travel across the Andaman Island that includes Port Blair, Havelock, Neil Island and many other destinations. Our service connects travelers with these cab operators as per their travel needs and preferences.</p>
            <ul>
                <li><strong>One Way Trip:</strong> One pickup and one drop only. No sightseeing or diversion are allowed.</li>
                <li><strong>Round Trip:</strong> Travel from one location to another and back within the booking period. Enroute sightseeing depends on the driver/cab operators, but diversion from the main route are not allowed. Note: In a round trip, the cab must return to the origin location within the booking time. If the cab is not brought back in time, the customer may be charged for an extra full day.</li>
            </ul>
        </div>

        <div class="cp-info-block">
            <h4>Car Rental/ Hourly Services</h4>
            <p>The services allow travelers to hire cabs for travel within a single island which is perfect for local sightseeing, visiting beaches and exploring all the nearby attractions at your own pace.</p>
        </div>

        <div class="cp-info-block">
            <h4>Airport Pickup/Drop Services</h4>
            <p>The service covers airport transfer within the island such as Port Blair Airport to hotels or resorts.</p>
        </div>

        <div class="cp-info-block">
            <h4>Payment Terms</h4>
            <p>User can choose between:</p>
            <ul>
                <li><strong>Prepaid:</strong> You can pay the full amount at the time of booking (includes fare, taxes and fees)</li>
                <li><strong>Part payment:</strong> You can pay half of the payment at the time of booking and the rest directly to the driver at the time of pickup.</li>
            </ul>
            <p>For cancellation policy, follow the policy that is mentioned on the booking page or voucher. The displayed trip cost is a final estimate. Driver allowances (if applicable) must be paid by the user. A travel day counts from 12:00 AM to 11:59 PM. Exceeding this time may lead to an extra full day charge. If the journey extends beyond the booked distance, extra charges will be applied as per cab operator rates.</p>
        </div>

        <div class="cp-info-block">
            <h4>User Responsibility</h4>
            <ul>
                <li>Carry a valid photo ID and show it when asked.</li>
                <li>The driver should start the trip once you board. If not, report to AndamanBliss Team.</li>
                <li>Be punctual. If you are late or do not show up, your booking may be cancelled without refund.</li>
                <li>Avoid unnecessary breaks unless its an emergency.</li>
                <li>Take care of your luggage because Andaman Bliss is not responsible for any loss or damage.</li>
                <li>Bookings are for personal travel or tourism only, not for any commercial or profit making purpose.</li>
                <li>Carry pets only if the cab operators allow you (as per your booking terms and conditions).</li>
                <li>Respect the baggage limit mentioned in your voucher, extra baggage may end up denial of service.</li>
            </ul>
        </div>

        <div class="cp-info-block">
            <h4>User Guidelines</h4>
            <p><strong>Do’s</strong></p>
            <ul>
                <li>Reach the pickup point on time.</li>
                <li>Maintain polite behavior with the driver.</li>
                <li>Check the odometer reading at the start and end of the trip.</li>
                <li>Confirm that your luggage fits in the cab boot space before departure.</li>
            </ul>
            <p><strong>Dont’s</strong></p>
            <ul>
                <li>Do not overload the cab with excess luggage.</li>
                <li>Do not force the driver to take unplanned stops or illegal routes.</li>
                <li>Do not engage in illegal activities during your trip.</li>
                <li>Do not travel under the influence of alcohol or drugs.</li>
            </ul>
            <p><strong>Note:</strong> All these terms and conditions must be read along with AndamanBliss General Terms & Conditions and other related policies.</p>
        </div>
    </div>
</div>

                </div>

                <!-- Right Sidebar -->
                <div class="cp-sidebar">
                    <div class="cp-card cp-price-box">
                        <div class="cp-free-cancel">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Free Cancellation before 6 hours from the journey time</span>
                        </div>

                        <div class="cp-total-row">
                            <h3 class="cp-total-label">Grand Total</h3>
                            <div class="cp-total-price">₹{{ number_format($cabs->total_amount,2) }}</div>
                        </div>
                        <p class="cp-breakdown">Fare Breakdown</p>

                        <div class="cp-payment-opts">
                            <div class="cp-pay-opt">
                                <input type="radio" name="payment" value="token" id="part" checked>
                                <label for="part">
                                    <div class="cp-pay-row">
                                        <div class="cp-pay-left">
                                            <div class="cp-pay-head">
                                                <i class="fa-solid fa-wallet"></i>
                                                <span>Make part payment now</span>
                                            </div>
                                            <p>Pay the rest to the driver</p>
                                        </div>
                                        <div class="cp-pay-amt">₹{{ number_format($cabs->payable,2) }}</div>
                                    </div>
                                </label>
                            </div>

                            <div class="cp-pay-opt">
                                <input type="radio" name="payment" value="full" id="full">
                                <label for="full">
                                    <div class="cp-pay-row">
                                        <div class="cp-pay-left">
                                            <div class="cp-pay-head">
                                                <i class="fa-solid fa-credit-card"></i>
                                                <span>Make full payment now</span>
                                            </div>
                                        </div>
                                        <div class="cp-pay-amt">₹{{ number_format($cabs->total_amount,2) }}</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="payment-block" id="payment-block">
                        <button type="button" id="submitform" class="cp-continue-btn">Continue to Payment</button>
                    <ul class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
                        <li><img src="{{ asset('site/img/google-pay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="google-pay"></li>
                        <li><img src="{{ asset('site/img/phonepe-1.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="phonepe-1"></li>
                        <li><img src="{{ asset('site/img/rupay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="rupay"></li>
                        <li><img src="{{ asset('site/img/visa.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="visa"></li>
                        <li><img src="{{ asset('site/img/mastercard-4.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="mastercard-4"></li>
                        <li><img src="{{ asset('site/img/paypal-3.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="paypal-3"></li>
                    </ul>
                        </div>
                    <div>
                  
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #footers {
            display: none;
        }

        #expert-btn{
            display: none !important;
        }

        /* Car Payment - Prefix: cp- */
        .cp-page {
            --cp-orange: #ff6b35;
            --cp-orange-dark: #e55a2b;
            --cp-green: #10b981;
            --cp-blue: #0ea5e9;
            --cp-text: #1f2937;
            --cp-text-light: #6b7280;
            --cp-border: #e5e7eb;
            --cp-bg: #f9fafb;
            background: var(--cp-bg);
            padding: 20px 0 60px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Progress */
        .cp-progress-wrapper {
            margin-bottom: 10px;
            padding: 20px 0 0 0;
            display: flex;
            justify-content: start;
            margin-top: 25px;
        }

        .cp-progress-container {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            position: relative;
            width: 50%;
            max-width: 600px
        }

        .cp-progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2
        }

        .cp-step-top {
            position: relative
        }

        .cp-step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            color: #fff;
            background: #d1d5db;
            border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1)
        }

        .cp-step-complete .cp-step-circle {
            background: #0ea5e9;
            color: #fff
        }

        .cp-step-active .cp-step-circle {
            background: #0ea5e9;
            color: #fff
        }

        .cp-step-inactive .cp-step-circle {
            background: #d1d5db;
            color: #9ca3af
        }

        .cp-progress-line-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            height: 40px;
            position: relative;
            z-index: 1
        }

        .cp-line {
            height: 3px;
            width: 100%;
            background: #d1d5db
        }

        .cp-line-complete {
            background: #0ea5e9
        }

        .cp-line-inactive {
            background: #d1d5db
        }

        .cp-step-text {
            font-size: 10px;
            color: #6b7280;
            font-weight: 500;
            white-space: nowrap;
            text-align: center;
            margin-top: 3px
        }

        .cp-step-active .cp-step-text {
            color: #0ea5e9;
            font-weight: 600
        }

        .cp-step-complete .cp-step-text {
            color: #0ea5e9;
            font-weight: 600
        }

        .cp-step-inactive .cp-step-text {
            color: #9ca3af
        }

        /* Layout */
        .cp-layout {
            display: grid;
            gap: 20px
        }

        @media (min-width: 992px) {
            .cp-layout {
                grid-template-columns: 1fr 380px
            }
        }

        /* Card */
        .cp-card {
            background: #fff;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0px 1px 7px 1px rgba(0, 0, 0, 0.49);
            -webkit-box-shadow: 0px 2px 2px 2px rgba(154, 154, 154, 0.49);
            -moz-box-shadow: 0px 1px 7px 1px rgba(0, 0, 0, 0.49);
            margin-bottom: 20px
        }

        .cp-section-title {
            margin: 0 0 20px 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--cp-text)
        }

        /* Pickup */
        .cp-pickup-title {
            font-size: 15px;
            color: var(--cp-text);
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--cp-border)
        }

        .cp-pickup-title strong {
            font-weight: 700
        }

        .cp-car-section {
            display: flex;
            gap: 24px;
            align-items: flex-start
        }

        .cp-car-image-box {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center
        }

        .cp-car-img {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 16px;
            width: 180px;
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .cp-car-img img {
            width: 100%;
            height: 100%;
            object-fit: contain
        }

        .cp-car-badge {
            background: #000;
            color: #fff;
            padding: 6px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            width: 100%;
            text-align: center
        }

        .cp-car-info {
            flex: 1
        }

        .cp-route {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: 1px solid #f0f0f0
        }

        .cp-route-item {
            flex: 1
        }

        .cp-route-item strong {
            display: block;
            font-size: 14px;
            color: var(--cp-text);
            margin-bottom: 6px;
            font-weight: 700
        }

        .cp-route-item p {
            margin: 0;
            font-size: 13px;
            color: var(--cp-text-light);
            line-height: 1.5
        }

        .cp-route-arrow {
            font-size: 20px;
            color: var(--cp-text-light);
            margin-top: 6px
        }

        .cp-specs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            row-gap: 14px
        }

        .cp-spec-item {
            display: flex;
            align-items: flex-start;
            gap: 12px
        }

        .cp-spec-item i {
            color: var(--cp-orange);
            font-size: 20px;
            margin-top: 2px;
            flex-shrink: 0
        }

        .cp-spec-item div {
            display: flex;
            flex-direction: column;
            gap: 3px
        }

        .cp-spec-item strong {
            font-size: 13px;
            color: var(--cp-text);
            font-weight: 700
        }

        .cp-spec-item span {
            font-size: 12px;
            color: var(--cp-text-light);
            line-height: 1.4
        }

        /* Donation */
        .cp-donation-card {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 1px solid #a7f3d0
        }

        .cp-donation-header {
            display: flex;
            gap: 16px;
            margin-bottom: 20px
        }

        .cp-donation-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            flex-shrink: 0
        }

        .cp-donation-header h3 {
            margin: 0 0 8px 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--cp-text)
        }

        .cp-donation-header p {
            margin: 0;
            font-size: 13px;
            color: var(--cp-text-light);
            line-height: 1.5
        }

        .cp-donation-btns {
            display: flex;
            gap: 10px
        }

        .cp-don-btn {
            flex: 1;
            padding: 10px;
            border: 2px solid var(--cp-green);
            background: #fff;
            border-radius: 8px;
            font-weight: 700;
            color: var(--cp-text);
            cursor: pointer;
            transition: all .2s
        }

        .cp-don-btn:hover {
            background: #f0fdf4
        }

        .cp-don-active {
            background: var(--cp-green);
            color: #fff
        }

        /* Title Select */
        .cp-title-select {
            display: flex;
            gap: 10px;
            margin-bottom: 10px
        }

        .cp-title-btn {
            padding: 8px 24px;
            border: 1px solid var(--cp-border);
            background: #fff;
            border-radius: 6px;
            font-weight: 600;
            color: var(--cp-text-light);
            cursor: pointer;
            transition: all .2s
        }

        .cp-title-btn:hover {
            border-color: var(--cp-orange)
        }

        .cp-title-active {
            background: var(--cp-orange);
            color: #fff;
            border-color: var(--cp-orange)
        }

        /* Form */
        .cp-form-row {
            display: grid;
            gap: 20px;
            margin-bottom: 2px
        }

        @media (min-width: 768px) {
            .cp-form-row {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        .cp-field {
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .cp-field label {
            font-size: 14px;
            font-weight: 600;
            color: var(--cp-text)
        }

        .cp-field label i {
            color: var(--cp-text-light);
            font-size: 12px;
            margin-left: 4px
        }

        .cp-field small {
            font-size: 12px;
            color: var(--cp-text-light);
            line-height: 1.4
        }

        .cp-input {
            height: 44px;
            border: 1px solid var(--cp-border);
            border-radius: 6px;
            padding: 0 12px;
            font-size: 14px;
            outline: 0;
            transition: border-color .2s
        }

        .cp-input:focus {
            border-color: var(--cp-orange)
        }

        .cp-input::placeholder {
            color: #9ca3af
        }

        .cp-phone {
            display: flex;
            gap: 10px
        }

        .cp-code {
            width: 80px;
            height: 44px;
            border: 1px solid var(--cp-border);
            border-radius: 6px;
            padding: 0 8px;
            font-size: 14px;
            outline: 0
        }

        .cp-note {
            padding: 8px 12px;
            background: #fef3c7;
            border-radius: 4px;
            font-size: 12px;
            color: #92400e;
            margin-top: 8px
        }

        /* Arrival */
        .cp-arrival {
            display: flex;
            gap: 15px;
            margin-bottom: 2px
        }

        .cp-radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer
        }

        .cp-radio-label input {
            margin: 0
        }

        .cp-radio-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: #f3f4f6;
            color: var(--cp-text-light)
        }

        .cp-radio-label input:checked~.cp-radio-icon {
            background: var(--cp-orange);
            color: #fff
        }

        /* GST */
        .cp-gst-info {
            margin: 0;
            font-size: 12px !important;
            color: var(--cp-text-light);
            line-height: 1.5
        }

        /* Terms */
        .cp-terms {
            margin-top: 5px
        }

        .cp-terms label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 13px;
            color: var(--cp-text-light)
        }

        .cp-terms input {
            margin-top: 2px
        }

        .cp-terms a {
            color: var(--cp-orange);
            text-decoration: none
        }

        /* Accordion */
        .cp-accordion {
            padding: 0
        }

        .cp-accordion-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            background: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            color: var(--cp-text);
            cursor: pointer;
            text-align: left
        }

        .cp-accordion-btn:hover {
            background: #f9fafb
        }

        .cp-accordion-body {
            padding: 0 24px 24px;
            display: none
        }

        .cp-accordion-body.show {
            display: block
        }

        .cp-info-block {
            margin-bottom: 30px
        }

        .cp-info-block:last-child {
            margin-bottom: 0
        }

        .cp-info-block h4 {
            margin: 0 0 12px 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--cp-text)
        }

        .cp-info-block p {
            margin: 0 0 8px 0;
            font-size: 13px;
            color: var(--cp-text)
        }

        .cp-info-block ul {
            margin: 0 0 15px 0;
            padding-left: 20px
        }

        .cp-info-block li {
            margin: 6px 0;
            font-size: 13px;
            color: var(--cp-text-light);
            line-height: 1.5
        }

        .cp-info-grid {
            display: grid;
            gap: 20px
        }

        @media (min-width: 768px) {
            .cp-info-grid {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        /* Sidebar */
        .cp-price-box {
            position: sticky;
            top: 20px
        }

        .cp-free-cancel {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            background: #ecfdf5;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 12px;
            color: #065f46
        }

        .cp-free-cancel i {
            color: var(--cp-green)
        }

        /* Total Row */
        .cp-total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px
        }

        .cp-total-label {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .cp-total-price {
            font-size: 24px;
            font-weight: 800;
            color: var(--cp-text)
        }

        .cp-breakdown {
            margin: 0 0 5px 0;
            font-size: 12px !important;
            color: var(--cp-text-light)
        }

        /* Payment Options */
        .cp-payment-opts {
            margin-bottom: 20px
        }

        .cp-pay-opt {
            border: 2px solid var(--cp-border);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all .2s;
        }

        .cp-pay-opt:hover {
            border-color: var(--cp-orange);
        }

        .cp-pay-opt input {
            display: none
        }

        .cp-pay-opt input:checked+label {
            color: var(--cp-orange);
        }

        .cp-pay-opt:has(input:checked) {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .cp-pay-opt input:checked~* {
            border-color: var(--cp-orange);
        }

        .cp-pay-opt label {
            display: block;
            cursor: pointer
        }

        .cp-pay-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px
        }

        .cp-pay-left {
            flex: 1
        }

        .cp-pay-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
            font-weight: 600;
            color: var(--cp-text)
        }

        .cp-pay-head i {
            color: var(--cp-orange)
        }

        .cp-pay-amt {
            font-size: 24px;
            font-weight: 800;
            color: var(--cp-text);
            flex-shrink: 0
        }

        .cp-pay-opt p {
            margin: 0;
            font-size: 12px !important;
            color: var(--cp-text-light)
        }

        /* Button */
        .cp-continue-btn {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 8px;
            background: var(--cp-orange);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s
        }

        .cp-continue-btn:hover {
            background: var(--cp-orange-dark)
        }

        /* Responsive */
        @media (max-width: 991px) {
            .cp-car-section {
                flex-direction: column;
                align-items: center
            }

            .cp-car-image-box {
                width: 100%;
                max-width: 300px
            }
         #payment-block {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        padding: 15px 0;
        text-align: center;
        font-size: 18px;
        border-radius: 0;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.2);
        background: white;
    }

    .cp-price-box {
        padding-bottom: 70px; /* Space for sticky button */
    }
    .cp-sidebar{
        padding-bottom: 7vh;
    }
        }

        @media (max-width: 767px) {
            .cp-progress-container {
                padding: 0 20px;
                width: 90%;
                max-width: none
            }

            .cp-step-text {
                font-size: 12px
            }

            .cp-step-circle {
                width: 32px;
                height: 32px;
                font-size: 14px
            }

            .cp-card {
                padding: 16px
            }

            .cp-route {
                flex-direction: row;
                gap: 1px
            }

           

            .cp-donation-header {
                flex-direction: column
            }

            .cp-donation-btns {
                flex-wrap: wrap
            }

            .cp-don-btn {
                min-width: calc(50% - 5px)
            }

            .cp-total-price {
                font-size: 28px
            }

            .cp-pay-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px
            }

            .cp-pay-amt {
                font-size: 20px
            }
        }

        .cp-info-block > ul > li {
            list-style-type: disc !important;
            color: #000;
            font-weight: 600;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        (function() {
            document.querySelectorAll('.cp-title-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.cp-title-btn').forEach(b => b.classList.remove(
                        'cp-title-active'));
                    this.classList.add('cp-title-active');
                    document.getElementById('titleInput').value = this.textContent;
                });
            });

            // Accordion
            document.querySelectorAll('.cp-accordion-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const body = this.nextElementSibling;
                    const icon = this.querySelector('i');
                    body.classList.toggle('show');
                    icon.style.transform = body.classList.contains('show') ? 'rotate(180deg)' :
                        'rotate(0deg)';
                });
            });


             const payOptions = document.querySelectorAll('.cp-pay-opt');

    // Set initial border for checked radio
    payOptions.forEach(opt => {
        const radio = opt.querySelector('input');
        if (radio.checked) {
            opt.style.borderColor = 'var(--cp-orange)';
        } else {
            opt.style.borderColor = 'var(--cp-border)';
        }
    });

    // Click handler
    payOptions.forEach(opt => {
        opt.addEventListener('click', function() {
            const radio = this.querySelector('input');
            radio.checked = true;
            payOptions.forEach(o => o.style.borderColor = 'var(--cp-border)');
            this.style.borderColor = 'var(--cp-orange)';
        });
    });

         
        })();

document.addEventListener('DOMContentLoaded', () => {
    const form = $('#travelform');
    const submitbtn = $('#submitform');
    const loader = document.getElementById('payment-loader');
    const bookingloader = document.getElementById('booking-loader');


    function validateForm() {
        let valid = true;
        let messages = [];

        const title = $('#titleInput').val().trim();
        const fname = $('input[name="f_name"]').val().trim();
        const lname = $('input[name="l_name"]').val().trim();
        const email = $('input[name="email"]').val().trim();
        const phone = $('input[name="tel_no"]').val().trim();
        const agree = $('input[name="agree"]').is(':checked');
        const flightField = $('input[name="flight_no"]');
        const flightNo = flightField.length ? flightField.val().trim() : '';

        if (!title) messages.push('Please select a title.');
        if (!fname) messages.push('First name is required.');
        if (!lname) messages.push('Last name is required.');
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) messages.push('Enter a valid email.');
        if (!phone || !/^[0-9]{6,15}$/.test(phone)) messages.push('Enter a valid phone number.');
        if (!agree) messages.push('Please agree to the Terms & Conditions.');

        if (messages.length > 0) {
            alert(messages.join('\n'));
            valid = false;
        }
        return valid;
    }

    submitbtn.on('click', function(e) {
        e.preventDefault();
         if (!validateForm()) return;
        if (loader) loader.style.display = 'flex';
        document.body.style.pointerEvents = 'none';

        const actionUrl = form.attr('action');
        const methodType = form.attr('method');
        let formData = form.serialize();
        const payValue = $("input[name='payment']:checked").val();
        formData += `&payment=${encodeURIComponent(payValue)}`;

        $.ajax({
            type: methodType,
            url: actionUrl,
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const options = {
                        key: "{{ env('RAZORPAY_API_KEY') }}",
                        amount: response.amount * 100,
                        currency: "INR",
                        name: "Andaman Bliss",
                        description: "Cab Booking Payment",
                        order_id: response.order_id,
                        handler: function(paymentResponse) {
                             if (bookingloader) bookingloader.style.display = 'flex';
                                    document.body.style.pointerEvents = 'none';
                            $.post("{{ route('cab.confirm') }}", {
                                _token: "{{ csrf_token() }}",
                                payment_id: paymentResponse.razorpay_payment_id,
                                order_id: paymentResponse.razorpay_order_id,
                                signature: paymentResponse.razorpay_signature,
                                status: 'success'
                            }, function(res) {
                                  
                                if (res.success && res.redirect_url) {
                                    window.location.href = res.redirect_url;
                                } else {
                                    if (loader) loader.style.display = 'none';
                                    document.body.style.pointerEvents = 'auto';
                                    alert('Payment updated but redirect failed');
                                }
                            });
                        },
                        modal: {
                            ondismiss: function() {
                                if (loader) loader.style.display = 'none';
                                document.body.style.pointerEvents = 'auto';
                            }
                        },
                        prefill: {
                            name: $('input[name="f_name"]').val() + ' ' + $('input[name="l_name"]').val(),
                            email: $('input[name="email"]').val(),
                            contact: $('input[name="tel_no"]').val()
                        },
                        theme: { color: "#F37254" }
                    };

                    const rzp = new Razorpay(options);
                    rzp.on('payment.failed', function(response) {
                        $.post("{{ route('cab.confirm') }}", {
                            _token: "{{ csrf_token() }}",
                            payment_id: response.error.metadata.payment_id,
                            order_id: response.error.metadata.order_id,
                            signature: '',
                            status: 'failed'
                        }, function(res) {
                            if (res.success && res.redirect_url) {
                                window.location.href = res.redirect_url;
                            } else {
                                if (loader) loader.style.display = 'none';
                                document.body.style.pointerEvents = 'auto';
                                alert('Payment failed, but redirect failed');
                            }
                        });
                    });

                    if (loader) loader.style.display = 'none';
                    document.body.style.pointerEvents = 'auto';
                    rzp.open();
                } else {
                    if (loader) loader.style.display = 'none';
                    document.body.style.pointerEvents = 'auto';
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                if (loader) loader.style.display = 'none';
                document.body.style.pointerEvents = 'auto';
                alert('AJAX request failed');
            }
        });
    });
});

</script>

@endpush
