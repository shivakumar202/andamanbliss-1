@extends('layouts.app')
@section('title', 'Activity Booking')

@section('content')
    <section class="singleviewTop my-5">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </section>

      <div id="fullPageOverlay" style="
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(255, 255, 255, 0.85);
    pointer-events: all;
    cursor: wait;
    backdrop-filter: blur(2px);
">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        font-weight: bold; font-size: 16px; color: #333;">
        Processing payment... Please wait.
    </div>
</div>




    <div class="container px-2">
        <div class="main-container">
            <div class="row g-0">
                <!-- Left Section - Booking Summary -->
                <div class="col-lg-5 col-md-6">
                    <div class="booking-summary h-100">
                        <div class="section-title-billing">
                            <i class="bi bi-water me-2"></i>Booking Summary
                        </div>
                        <input type="hidden" name="activity_id" id="activity_id" value="{{ $data['activity_id'] }}">
                        <!-- Booking Details -->
                        <div class="mb-4">
                            <h3 class="fw-bold billing-title-activity mb-3 fs-6">
                                Activity Details
                            </h3>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="bi bi-activity me-2"></i>Activity
                                </span>
                                <span class="info-value">
                                    {{ ucwords($activity->service_name) }}
                                    <span class="activity-badge">{{ ucwords($activity->category->name) }}</span>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="bi bi-geo-alt me-2"></i>Location
                                </span>
                                <span class="info-value">{{ ucwords($activity->location) }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="bi bi-calendar-check me-2"></i>Date
                                </span>
                                <span
                                    class="info-value">{{ \Carbon\Carbon::parse($data['arrival_date'])->format('d F Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="bi bi-clock me-2"></i>Time
                                </span>
                                @php
                                    $formattedSlot = 'Not Selected';
                                    if (!empty($data['time_slot'])) {
                                        [$start, $end] = explode(' - ', $data['time_slot']);
                                        $formattedSlot = \Carbon\Carbon::createFromFormat('H:i', $start)->format('g:i A') . ' - ' .
                                                        \Carbon\Carbon::createFromFormat('H:i', $end)->format('g:i A');
                                    }
                                @endphp
                                <span class="info-value">{{ $formattedSlot }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="bi bi-people me-2"></i>Participants
                                </span>
                                <span class="info-value">{{ $data['guest'] }} Adult , {{ $data['child'] }} Children</span>
                            </div>
                            <div class="image-gallery">
                                <div class="gallery-container">
                                    @foreach ($activity['activityPhotos'] as $photo)
                                        <div class="gallery-slide active">
                                            <img src="{{ $photo['file'] }}" alt="{{ Str::slug($activity->name) }}">
                                            <div class="gallery-overlay">
                                                <div class="gallery-title">{{ ucwords($activity->service_name) }}</div>
                                                <div class="gallery-description">{{ $activity->title }}</div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Navigation buttons -->
                                    <button class="gallery-nav prev" onclick="changeSlide(-1)">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button class="gallery-nav next" onclick="changeSlide(1)">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>

                                    <!-- Indicators -->
                                    <div class="gallery-indicators">
                                        <span class="gallery-dot active" onclick="currentSlide(1)"></span>
                                        <span class="gallery-dot" onclick="currentSlide(2)"></span>
                                        <span class="gallery-dot" onclick="currentSlide(3)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Summary -->

                    </div>
                </div>

                <!-- Right Section - Billing Details -->
                <div class="col-lg-7 col-md-6">
                    <div class="billing-section">
                        <div class="section-title-billing">
                            <i class="bi bi-person-lines-fill me-2"></i>Booking Details
                        </div>

                        <form method="post" action="{{ route('activity.paymentsubmit') }}" id="booking-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <input type="hidden" name="data" id="data" value='@json($data)'>
                                <input type="hidden" name="activity" id="activity" value="{{ $activity->id }}">
                                <div class="col-sm-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ $logged['first_name'] ?? '' }}" placeholder="Enter First Name"
                                        required />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $logged['last_name'] ?? ''  }}" placeholder="Enter Last Name"
                                        required />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="tel" class="form-control" value="{{ $logged['mobile'] ?? '' }}" name="mobile"
                                        placeholder="Enter 10-digit mobile number" required min="10"/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" value="{{ $logged['email'] ?? '' }}" name="email" placeholder="Enter email address"
                                        required />
                                </div>
                                <div class="col-12">    
                                    <div class="form-check mt-3 d-flex gap-3 align-items-start">
                                    <input class="form-check-input custom-check border-dark" type="checkbox" id="terms" required />
                                        <div>
                                            <span class="form-text" style="text-align: justify;">
                                               I hereby accept the 
                                                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#termsModal" class="fw-semibold" style="color: #ff5722">terms and conditions</a>
                                                and confirm that all participants are mentally and physically fit to undertake this activity. We have no medical history that would restrict or affect our participation in this activity.
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="pricing-summary">
                                <h3 class="fw-bold billing-title-activity mb-3 fs-6">
                                    <i class="fa fa-receipt me-2"></i>Payment Summary
                                </h3>
                                @php
                                    $baseAmount = $data['total_cost'];                                    
                                        $tax = ($baseAmount * 7) / 100; 
                                        $amt = $baseAmount + $tax;                                    
                                @endphp
                                <div class="total-item">
                                    <span class="info-label">Activity Cost x {{$data['guest']+$data['child']}}</span>
                                    <span class="info-value">₹{{ number_format($baseAmount, 2) }}</span>
                                </div>
                               
                                <div class="total-item">
                                    <span class="info-label">Taxes & Services</span>
                                    <span class="info-value">₹{{ number_format($tax, 2) }}</span>
                                    <input type="hidden" name="gst" id="gst" value="{{ $tax }}">
                                </div>
                                <div class="total-item">
                                    <span class="info-label">Total Amount</span>
                                    <span class="amount">₹{{ number_format($amt, 2) }}</span>
                                    <input type="hidden" name="total_cost" id="total_cost" value="{{ $amt }}">
                                    <input type="hidden" name="activity_cost" id="activity_cost" value="{{ $amt }}">
                                </div>
                            </div>
                            @if($activity->live_booking != 1)
                            <p>Instant Booking is not available for this activity kindly send enuqiry we will connect with in 24 hrs</p>
                            @endif
                            <div class="d-none d-md-flex justify-content-between mt-4">
                                <a type="button" class="btn btn-back" href="{{ url()->previous() }}">
                                    <i class="fa-solid fa-left-long me-2"></i>Back
                                </a>
                                @if($activity->live_booking == 1)
                                <button type="button" id="rzp-button" class="btn btn-proceed">
                                    <i class="fa-solid fa-credit-card me-2"></i>Pay Now ₹{{ number_format($amt, 2) }}
                                </button>
                                @else 
                                <button type="button" id="enquiry-btn" class="btn btn-proceed">
                                    <i class="fa-solid fa-envelope me-2"></i> Send Enquiry
                                </button>
                                @endif
                            </div>                            
                        </form>         

                    </div>
                </div>
            </div>
        </div>
        <div class="d-md-none d-block mobile-sticky-footer">
            @if($activity->live_booking == 1)
    <button type="button" id="rzp-button-mobile" class="btn btn-proceed w-100">
        <i class="fa-solid fa-credit-card me-2"></i>Pay Now ₹{{ number_format($amt, 2) }}
    </button>
    @else 
    <button type="button" id="enquiry-btn-mobile" class="btn btn-proceed w-100">
        <i class="fa solid fa-enveloper me-2"></i> Send Enquiry
    </button>
    @endif
</div>
    </div>


    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-body">
       <h2>Terms and Conditions</h2>
  <p>These terms and conditions are governed by all applicable activity bookings that are made through Andaman Bliss. By conforming a booking, you as a customer agree to comply fully with all the following terms:</p>

  <h6>Booking Confirmation:</h6>
  <ul>
    <li>All the activity bookings are confirmed only upon receiving the full payment.</li>
    <li>All booking is considered valid only when a confirmed voucher is issued by Andaman Bliss on the time of booking.</li>
  </ul>

  <h6>Cancellation Policy:</h6>
  <p>All the cancellations must be requested via email and are subject to the following refund conditions:</p>
  <ul>
    <li>30 days or more prior to the activity date: 100% refund of the booking amount</li>
    <li>20-29 days before the activity date: 25% will be deduced as a cancellation fee.</li>
    <li>15-19 days before the activity date: 50% will be deducted as a cancellation fee.</li>
    <li>10-14 days before the activity date: No refund will be issued</li>
    <li>Less than 10 days before the activity, late arrival, or no show: The booking fee will be forfeited in full. No refund or rescheduling will be allowed.</li>
  </ul>
  <p>All cancellations are subject to approval and Andaman Bliss reserves the sole right to determine the validity of any cancellation request made.</p>

  <h6>Cancellation Done By Vendor:</h6>
  <p>In the rare event of cancellation done by the vendor or the activity provider due to weather conditions, technical failures or unforeseen circumstances like operational issues, Andaman Bliss is entitled to refund you a complete 100 % of the booking amount paid by the customer.</p>
  <p>This is the only scenario where a full refund will be issued.</p>
  <p>No other compensation, monetary or otherwise, will be provided.</p>

  <h6>Rescheduling Policy</h6>
  <ul>
    <li>Customers may request rescheduling of an activity only once and at least 10 days prior to the scheduled date.</li>
    <li>Approval of rescheduling is subject to availability and discretion of Andaman Bliss.</li>
    <li>Rescheduling requests made within 10 days of the activity date will not be accepted.</li>
    <li>No refund will be applicable if the rescheduling request is denied due to unavailability.</li>
  </ul>

  <h6>Activity Modifications or Changes</h6>
  <ul>
    <li>Activity details including time, route, itinerary, duration, or features may be modified by the vendor or operator due to operational, safety, or weather-related reasons.</li>
    <li>Any such changes will not be considered grounds for refund or compensation.</li>
    <li>If the modified activity is conducted as per the revised plan, it shall be deemed successfully delivered.</li>
    
  </ul>

  <h6>Force Majeure Clause</h6>
  <p>No refunds, reschedules, or compensation will be offered for delays, changes, or cancellations caused by events beyond the control of Andaman Bliss, including but not limited to:</p>
  <ul>
    <li>Natural disasters or weather disturbances</li>
    <li>Acts of God or public authority restrictions</li>
    <li>Political disturbances, strikes, or riots</li>
    <li>Health emergencies, lockdowns, or transport bans</li>
  </ul>
  <p>In such cases, the booking will be treated as void due to force majeure, and Andaman Bliss will not be held liable in any manner.</p>

  <h6>Eligibility and Health Requirements</h6>
  <ul>
    <li>It is the sole responsibility of the customer to ensure that they meet the minimum age, health, and fitness requirements for the selected activity.</li>
    <li>If a customer is deemed unfit or ineligible at the time of the activity, participation may be denied without refund.</li>
    <li>No compensation will be provided for ineligibility discovered at the last moment.</li>
  </ul>

  <h6>ID Verification Requirement</h6>
  <ul>
    <li>Every customer must carry a valid government-issued photo ID for verification at the time of the activity.</li>
    <li>Failure to produce valid ID will result in denial of service and the booking will be considered a no-show.</li>
    <li>No refunds or reschedules will be allowed under such circumstances.</li>
  </ul>

  <h6>Responsibility Disclaimer</h6>
  <ul>
    <li>Andaman Bliss is solely a booking facilitator and is not the direct operator of any activity.</li>
    <li>The company will not be held responsible for any accident, injury, loss, delay, damage, or dissatisfaction during the course of the activity.</li>
    <li>Participation in any activity is entirely at the customer’s own risk.</li>
  </ul>

  <h6>Refund Process & Timelines</h6>
  <ul>
    <li>Refunds, if applicable under these terms, will be processed within 7 to 10 working days from the date of approval.</li>
    <li>All refunds will be made only to the original source of payment.</li>
    <li>Andaman Bliss will not be liable for any delays caused by the customer’s bank or payment system.</li>
  </ul>

  <h6>Legal Jurisdiction</h6>
  <p>Any and all disputes related to activity bookings through Andaman Bliss shall fall under the exclusive jurisdiction of the courts in Port Blair, Andaman & Nicobar Islands.</p>
  <p>By booking an activity, the customer accepts this legal jurisdiction clause unconditionally.</p>

  <h6>Final Authority:</h6>
  <ul>
    <li>Andaman Bliss reserves the right to make the final decision in any dispute or discrepancy.</li>
    <li>The company also retains the right to deny any service or refund if it believes that any terms have been violated or misused.</li>
    <li>Decisions taken by Andaman Bliss will be considered final, binding, and non-negotiable.</li>
    <li>Andaman Bliss has the rights to cancel any services like cabs, ferry bookings, tour packages or activity arrangements at any time due to operational, safety or unforeseen circumstances.</li>
    <li>In case, the cancellation of any services or packages are done from our side, guests will receive a full refund within 7 working days.</li>
  </ul>

  <h6>Acceptance of Terms</h6>
  <p>By proceeding with the activity booking through Andaman Bliss, the customer:</p>
  <ul>
    <li>Confirms having read and fully understood all terms and conditions.</li>
    <li>Agrees to comply with them without question or dispute.</li>
    <li>Accepts that any violation may result in cancellation without refund or future eligibility.</li>
  </ul>
      </div>
     
      
    </div>
  </div>
</div>

@endsection
@push('styles')
    <style>
        .main-container {
            max-width: 100%;
            margin: 1rem auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            position: relative;
        }

        .custom-check {
    box-shadow: none !important;         /* remove default Bootstrap focus shadow */
    border-width: 2px !important;        /* make border slightly bolder if needed */
}

.custom-check:focus {
    border-color: #000 !important;       /* solid black on focus */
    outline: none !important;
}

        #footers{
            display: none;
        }

        .main-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ff6b6b, #ff5722, #f44336);
            border-radius: 20px 20px 0 0;
        }

        .section-title-billing {
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff5722, #ff5722);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            text-align: center;
        }

        .booking-summary {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 1.5rem;
            border-radius: 0 0 0 20px;
        }

        .billing-section {
            padding: 1.5rem;
        }

        .billing-title-activity {
            color: #03a9f4;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0.75rem;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 8px;
            border-left: 3px solid #03a9f4;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
        }

        .info-item:hover {
            transform: translateX(3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            color: #64748b;
            font-weight: 500;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }

        .info-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
            text-align: right;
        }

        .activity-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f44336, #ff5722);
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .pricing-summary {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            margin-top: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .total-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
        }

        .total-item:last-child {
            border-bottom: none;
            padding-top: 0.75rem;
            font-weight: 700;
            font-size: 1.05rem;
        }

        .amount {
            color: #059669;
            font-weight: 700;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #003b6f;
            margin-bottom: 0.25rem;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            color: #003b6f;
            font-weight: 600;
            border-radius: 12px;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 1);
            color: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-proceed {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white !important;
            font-weight: 600;
            border-radius: 12px;
            padding: 0.3rem 1.5rem;
            border: none;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(238, 90, 36, 0.3);
        }

        .btn-proceed:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(238, 90, 36, 0.4);
        }

        .form-check-label {
            font-size: 0.85rem;
            color: #64748b;
        }

        .image-gallery {
            margin-top: 1.5rem;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .gallery-container {
            position: relative;
            height: 200px;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .gallery-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .gallery-slide.active {
            opacity: 1;
        }

        .gallery-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .gallery-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .gallery-description {
            font-size: 0.75rem;
            opacity: 0.9;
        }

        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .gallery-nav:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-50%) scale(1.1);
        }

        .gallery-nav.prev {
            left: 10px;
        }

        .gallery-nav.next {
            right: 10px;
        }

        .gallery-indicators {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .gallery-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gallery-dot.active {
            background: white;
            transform: scale(1.2);
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .gallery-container {
                height: 150px;
            }

            .gallery-nav {
                width: 30px;
                height: 30px;
            }

            .gallery-overlay {
                padding: 0.75rem;
            }

            .gallery-title {
                font-size: 0.8rem;
            }

            .gallery-description {
                font-size: 0.7rem;
            }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            /* body {
                padding: 0.5rem;
            } */

            .main-container {
                margin: -2rem auto;
                border-radius: 15px;
            }
            

            .booking-summary,
            .billing-section {
                padding: 1rem;
            }

            .section-title-billing {
                font-size: 1.1rem;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }

            .info-value {
                text-align: left;
                margin-top: 0.25rem;
            }

            .btn-proceed,
            .btn-back {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .d-flex.justify-content-between {
                flex-direction: column-reverse;
            }
        }

        @media print {
            body {
                background: white !important;
            }

            .btn-proceed,
            .btn-back {
                display: none;
            }

            .main-container {
                box-shadow: none;
                border: 1px solid #ccc;
                background: white !important;
            }
        }

       .mobile-sticky-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 10px 15px;
    background-color: #fff;
    z-index: 999;
    box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
    border-top: 1px solid #ddd;
}
    </style>
@endpush
@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const btn = document.getElementById('expert-btn');
    if (btn) btn.style.display = 'none';

    let slideIndex = 1;

    function changeSlide(n) { showSlide(slideIndex += n); }
    function currentSlide(n) { showSlide(slideIndex = n); }

    function showSlide(n) {
        const slides = document.querySelectorAll('.gallery-slide');
        const dots = document.querySelectorAll('.gallery-dot');

        if (n > slides.length) slideIndex = 1;
        if (n < 1) slideIndex = slides.length;

        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));

        slides[slideIndex - 1].classList.add('active');
        dots[slideIndex - 1].classList.add('active');
    }

    setInterval(() => { changeSlide(1); }, 4000);

    const payDesktop = document.getElementById('rzp-button');
    const payMobile = document.getElementById('rzp-button-mobile');

    function handlePayment(e) {
        e.preventDefault();

        const form = document.getElementById('booking-form');
        const overlay = document.getElementById('fullPageOverlay');

        if (!form) { alert('Form not found. Please try again or contact support.'); return; }

        const firstName = form.querySelector('input[name="first_name"]').value.trim();
        const lastName = form.querySelector('input[name="last_name"]').value.trim();
        const mobile = form.querySelector('input[name="mobile"]').value.trim();
        const email = form.querySelector('input[name="email"]').value.trim();
        const termsAccepted = form.querySelector('#terms').checked;

        if (!firstName || !lastName || !mobile || !email) { alert('Please fill all required fields.'); return; }
        if (!/^\d{10}$/.test(mobile)) { alert('Please enter a valid 10-digit mobile number.'); return; }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { alert('Please enter a valid email address.'); return; }
        if (!termsAccepted) { alert('You must accept the terms and conditions to proceed.'); return; }

        const razorpayKey = "{{ config('services.razorpay.key') }}";
        if (!razorpayKey) { alert('Payment configuration error. Please contact support.'); return; }

        const formData = new FormData(form);

        fetch('{{ route('activity.paymentsubmit') }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(r => r.json())
        .then(data => {
            if (data.success && data.order_id && data.booking_id) {

                const options = {
                    key: razorpayKey,
                    amount: {{ $amt * 100 }},
                    currency: "INR",
                    description: "Activity Booking Payment",
                    order_id: data.order_id,
                    handler: function (response) {
                        overlay.style.display = 'block';
                        fetch('{{ route('activity.payment.update') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                booking_id: data.booking_id,
                                ticket_code: data.ticketcode,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature
                            })
                        })
                        .then(r => r.json())
                        .then(update => {
                            if (update.success) {
                                window.location.replace('/activity/payment-voucher/' + update.ticketcode);
                            } else {
                                alert('Payment update failed. Please contact support.');
                            }
                            overlay.style.display = 'none';
                        })
                        .catch(() => {
                            alert('An error occurred while updating payment.');
                            overlay.style.display = 'none';
                        });
                    },
                    prefill: {
                        name: firstName + ' ' + lastName,
                        email: email,
                        contact: mobile
                    },
                    theme: { color: "#3399cc" }
                };

                new Razorpay(options).open();

            } else {
                alert('Failed to create booking or order. Please try again.');
                overlay.style.display = 'none';
            }
        })
        .catch(() => {
            alert('An error occurred. Please try again.');
            overlay.style.display = 'none';
        });
    }

    if (payDesktop) payDesktop.onclick = handlePayment;
    if (payMobile) payMobile.onclick = handlePayment;

   const enquiryDesk = document.getElementById('enquiry-btn');
const enquiryMob = document.getElementById('enquiry-btn-mobile');

function handleEnquiry(e) {
    e.preventDefault();

    const form = document.getElementById('booking-form');
    const overlay = document.getElementById('fullPageOverlay');

    if (!form) { alert('Form not found . please try again or contact support'); return; }

    const firstName = form.querySelector('input[name="first_name"]').value.trim();
    const lastName = form.querySelector('input[name="last_name"]').value.trim();
    const mobile = form.querySelector('input[name="mobile"]').value.trim();
    const email = form.querySelector('input[name="email"]').value.trim();
    const termsAccepted = form.querySelector('#terms').checked;

    if (!firstName || !lastName || !mobile || !email) { alert('Please fill all required fields.'); return; }
    if (!/^\d{10}$/.test(mobile)) { alert('please enter a valid 10-digit mobile number'); return; }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { alert('Please enter a valid email address'); return; }
    if (!termsAccepted) { alert('You must accept the terms and conditions to proceed.'); return; }

    const formData = new FormData(form);

    enquiryDesk.disabled = true;
    enquiryMob.disabled = true;

    fetch('{{ route('activity.send-enquiry') }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Your enquiry has been sent",
        showConfirmButton: true,
        timer: 6500
    }).then(() => {
        window.location.href = data.redirect_url;
    });
}
 else {
            alert('Something went wrong! Please try again.');
            enquiryDesk.disabled = false;
            enquiryMob.disabled = false;
        }
    })
    .catch(() => {
        alert('Server error. Please try again.');
        enquiryDesk.disabled = false;
        enquiryMob.disabled = false;
    });
}

    if (enquiryDesk) enquiryDesk.onclick = handleEnquiry;
    if (enquiryMob) enquiryMob.onclick = handleEnquiry;
});
</script>
@endpush
