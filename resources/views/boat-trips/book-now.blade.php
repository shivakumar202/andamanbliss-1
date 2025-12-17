@extends('layouts.app')

@section('title', 'Boat Trip Checkout')

@section('content')
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
    Processing your booking...
</div>

<form method="POST" action="{{ route('boat-trip-pay') }}" class="mt-5" enctype="multipart/form-data" id="booking-form">
    @csrf

    <section class="booking-review-section">
        <div class="container p-0">
            <div class="booking-steps mb-2 pt-5 d-flex flex-nowrap p-3">
                <div class="step active">
                    <span class="step-number">1</span>
                    <span class="step-text">Traveller Details</span>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <span class="step-text">Payment</span>
                </div>
            </div>

            <div class="row g-0">
                <div class="col-lg-8 col-md-7 p-1 ">
                    <div class=" rounded p-3 tour-package-left shadow bg-white ">
                        <h3>
                            <strong>{{ $data['trip_to'] }}</strong>
                            
                        </h3>
                        <p class="text-muted mb-1">
                            <i class="fa fa-map-marker me-2 text-gradient" aria-hidden="true"></i>
                            {{ $data['trip']['location'] }}

                        </p>

                        <div class="d-flex justify-content-between py-1 border-top border-bottom my-1">
                            <div class="jour-main">
                                <strong class="date-list">TRIP DATE</strong><br>
                                {{ \Carbon\Carbon::parse($data['date'])->format('D') }}
                                <strong class="date-list">{{ \Carbon\Carbon::parse($data['date'])->format('d-m-Y') }}</strong><br>
                            </div>
                            <div class="text-center align-self-center">
                                <strong class="date-list">SLOT - {{ \Carbon\carbon::parse($data['depart'])->format('H:i A') }} </strong>
                            </div>
                           
                        </div>
                       

                        <p class="fw-bold guest-count-dtls">{{ $data['trip_to'] }} | {{ $data['adult'] }} Adults ,
                            {{ $data['infant'] }} Children
                        </p>
                        <hr>
                        <h3 class="fw-bold fs-6">Travellers Details</h3>
           

                        <div class=" mb-3 bg-light">

                            @for ($i = 1; $i <= $data['adult']; $i++)
                                <div class="mb-3">
                                <label class="form-label d-block">Adult {{ $i }}</label>
                                <div class="row g-1">
                                    <div class="col-md-2">
                                        <select
                                            name="guests[adults][{{ $i - 1 }}][title]"
                                            class="form-control rounded-0" required>
                                            <option value="">Title</option>
                                            <option>Mr</option>
                                            <option>Mrs</option>
                                            <option>Miss</option>
                                            <option>Master</option>
                                            <option>Dr</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"
                                            name="guests[adults][{{ $i - 1 }}][first_name]"
                                            class="form-control rounded-0" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"
                                            name="guests[adults][{{ $i - 1 }}][middle_name]"
                                            class="form-control rounded-0" placeholder="Middle Name">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"
                                            name="guests[adults][{{ $i - 1 }}][last_name]"
                                            class="form-control rounded-0" placeholder="Last Name" >
                                    </div>
                                    <div class="col-md-2">
                                        <select
                                            name="guests[adults][{{ $i - 1 }}][gender]"
                                            class="form-control rounded-0" required>
                                            <option value="">Gender</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number"
                                            name="guests[adults][{{ $i - 1 }}][age]" onkeydown="return ! ['e','E','+','.','-'].includes(event.key)"
                                            class="form-control rounded-0" placeholder="Age" required>
                                    </div>      
                                </div>
                        </div>
                        @endfor

                        @for ($j = 0 ; $j< $data['infant'] ; $j++)
                        <div class="mb-3">
                            <label class="form-label d-block">Infant {{ $j + 1 }} <span style="color: red; font-size:12px;">Age (0-3 Yr's)</span></label>
                            <div class="row g-1">
                                <div class="col-md-2">
                                    <select
                                        name="guests[children][{{ $j }}][title]"
                                        class="form-control rounded-0" required>
                                        <option value="">Title</option>
                                        <option>Mr</option>
                                        <option>Mrs</option>
                                        <option>Ms</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text"
                                        name="guests[children][{{ $j }}][name]"
                                        class="form-control rounded-0" placeholder="Full Name" required>
                                </div>
                                <div class="col-md-2">
                                    <select
                                        name="guests[children][{{ $j }}][gender]"
                                        class="form-control rounded-0" required>
                                        <option value="">Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" onkeydown="return ! ['e','E','+','.','-'].includes(event.key)" class="form-control rounded-0"
                                        name="guests[children][{{ $j }}][age]"
                                        value="" min="0" max="3" placeholder="0-3 Yr's" required>
                                </div>
                                {{-- <div class="col-md-3">
                                                    <input type="text"
                                                        name="guests[children][{{ $j }}][id_no]"
                                class="form-control rounded-0" placeholder="AADHAAR Number" required>
                            </div>
                            <div class="col-md-4">
                                <input type="file"
                                    name="guests[children][{{ $j }}][id_file]"
                                    class="form-control rounded-0" accept=".jpg,.jpeg,.png,.pdf"
                                    required>
                            </div> --}}
                        </div>
                    </div>
                    @endfor
                </div>

                <hr>
                <h3 class="fs-6 fw-bold">Billing Details</h3>
                <div class="row g-1">
                    <div class="col-md-6"><input type="text" value="{{ $logged['name'] ?? '' }}" name="billing[name]" class="form-control rounded-0" placeholder="Full Name" required></div>
                    <div class="col-md-6"><input type="email" value="{{ $logged['email'] ?? '' }}" name="billing[email]" class="form-control rounded-0" placeholder="Email" required></div>
                    <div class="col-md-6"><input type="text" value="{{ $logged['mobile'] ?? '' }}" name="billing[phone]" onkeydown="return ! ['e','E','+','-','.'].includes(event.key)" class="form-control rounded-0" placeholder="Phone Number" required></div>
                    <div class="col-md-6"><input type="text" name="billing[gst]" class="form-control rounded-0" placeholder="GST Number (optional)"></div>
                    <div class="col-12"><input type="text" name="billing[address]" class="form-control rounded-0" placeholder="Billing Address" required></div>
                    <input type="hidden" name="total_cost" id="total_cost" value="{{ $data['totalCost'] }}">
                    <input type="hidden" name="total_tax" id="total_tax" value="{{ $data['taxTotal'] }}">
                    <input type="hidden" name="trip_detail" id="trip_detail" value='@json($data["trip"])'>
                    <input type="hidden" name="slot" id="slot" value="{{$data['depart']}}">
                    <input type="hidden" name="date" id="date" value="{{$data['date']}}">

                   
                </div>



                <hr>

                <h5 class="pay-heading-title">Terms & Conditions</h5>

<ol class="payement-terms-condition-inner">
    <li>Booking & Payment</li>
    <ul>
        <li>Your booking will get confirmed once the full payment is received.</li>
        <li>Once the payment is done, you will receive a confirmation ticket from us within 5 minutes.</li>
        <li>We request you to share correct passenger details and carry a valid photo ID proof at the time of booking.</li>
        <li>Any special request like extra luggage or seating preference should be mentioned while booking.</li>
    </ul>

    <li>Reporting & Boarding</li>
    <ul>
        <li>Please make sure you reach the jetty at least 30-45 minutes before departure. The boarding closes 15-20 minutes before the scheduled time.</li>
        <li>All the passengers should carry a valid government ID card to board.</li>
        <li>If you arrive late or miss the boat, the ticket will be non refundable.</li>
    </ul>

    <li>Schedule & Charges</li>
    <ul>
        <li>All sailing depends on weather, sea condition and port authority permissions.</li>
        <li>We may reschedule, delay or can even cancel a trip for safety reasons. In such cases, we will try our best to inform you early and may offer a reschedule or refund.</li>
    </ul>

    <li>Passenger Conduct</li>
    <ul>
        <li>We request you to follow all the safety instructions given by the crew while on board.</li>
        <li>Smoking, alcohol and drugs are strictly prohibited.</li>
        <li>Andaman Bliss will not be responsible for any loss or damage during the trip.</li>
    </ul>

    <li>Luggage & Prohibited Items</li>
    <ul>
        <li>All passengers are requested to carry limited bags. Extra or heavy luggage may come under additional cost.</li>
        <li>Dangerous items like flammable, explosives or sharp objects are not allowed while traveling.</li>
    </ul>

    <li>Island Entry & Permits</li>
    <ul>
        <li>Some islands may collect entry fees or may require permits. Unless mentioned in your booking, these fees are to be paid directly by the travelers.</li>
        <li>We request you to please respect local island rules, wildlife and ecosystem.</li>
    </ul>

    <li>Liability & Jurisdiction</li>
    <ul>
        <li>Andaman Bliss is not responsible for any delay, cancellation or loss that are caused by weather, sea conditions or government restrictions.</li>
        <li>All the disputes will fall under the jurisdiction of Port Blair courts.</li>
    </ul>
</ol>

<h5 class="pay-heading-title">Cancellation & Refund Policy</h5>

<ol class="payement-terms-condition-inner">
    <li>If You Need to Cancel</li>
    <ul>
        <li>48 hours or more before departure: You will receive a 90% refund. A small 10% charge will be kept as a cancellation fee.</li>
        <li>Less than 48 hours before departure: You will receive no refund.</li>
        <li>No show: If you are unable to travel on that particular date, then the ticket will be non refundable.</li>
    </ul>

    <li>If We Have to Cancel</li>
    <ul>
        <li>Sometimes due to bad weather conditions, technical issues or cyclonic disasters, we may have to cancel or delay the sailing. So in that case, we will provide you with a full refund or you may even reschedule your trip to another available date.</li>
    </ul>

    <li>Refund Timeline</li>
    <ul>
        <li>All refunds will be processed through your original payment method within 5 to 10 working days. Any bank or transaction charges will be deducted from the total refund amount.</li>
    </ul>
</ol>



            </div>
        </div>

        <div class="col-lg-4 col-md-5 p-2">
            <div class="tour-package-sticky-sidebar">
                <div class="tbook-card">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <div class="tbook-subtitle">GRAND TOTAL - {{ $data['adult'] }} Adult , {{ $data['infant'] }} Child</div>
                            <div class="tbook-price">₹{{ number_format($data['totalCost'] ?? 0, 2) }}</div>
                        </div>
            
                        <span class="tbook-discount bg-success">⚡Instant Confirmation</span>
                    </div>

                    

                    <div class="tbook-option tbook-option-active mb-3">
                        <div class="form-check d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="full_pay" id="payFull" checked>
                                <label class="form-check-label fw-bolder ms-2 my-0" for="payFull">Pay To Confirm</label>
                            </div>
                            <strong>₹{{ number_format($data['totalCost'], 2) }}</strong>
                        </div>
                    </div>



                    <div class="mb-3">
                        <h6 class="fw-bold">Fare Breakup</h6>
                        <div class="tbook-farebox">
                            <div class="d-flex justify-content-between">
                                <span>Total Basic Cost</span>
                                <strong>₹{{ number_format($data['sum_total'] ?? 0, 2) }}</strong>
                            </div>
                            <small class="text-muted">{{ $data['adult'] }} Adults , {{ $data['infant'] }} Child </small>
                        
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>Services & Taxes</span>
                                <strong>+₹{{ number_format($data['taxTotal'], 2) }}</strong>
                            </div>
                        </div>
                    </div>

                    <p class="tbook-emi" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="EMI Available on all payment modes">EMI Available on all payment modes</p>

                    <!-- <div class="mt-3">
                        <h6 class="fw-bold">Important Information</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirm" checked>
                            <label class="form-check-label" for="confirm">
                                I confirm that I have read and I accept
                                <a href="#" class="tbook-link">Cancellation Policy</a>,
                                <a href="#" class="tbook-link">Terms & Condition</a>, and
                                <a href="#" class="tbook-link">Privacy Policy</a> of Andaman Bliss
                            </label>
                        </div>
                    </div> -->
                        <hr>
                    <div class="d-grid mt-2">
                        <button type="button" id="rzp-button" class="btn btn-primary d-flex justify-content-center">
                            Pay Now
                        </button>
                        <div>
                            <ul class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
                                <li><img src="{{ asset('site/img/google-pay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="google-pay"></li>
                                <li><img src="{{ asset('site/img/phonepe-1.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="phonepe-1"></li>
                                <li><img src="{{ asset('site/img/rupay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="rupay"></li>
                                <li><img src="{{ asset('site/img/visa.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="visa"></li>
                                <li><img src="{{ asset('site/img/mastercard-4.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="mastercard-4"></li>
                                <li><img src="{{ asset('site/img/paypal-3.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="paypal-3"></li>
                            </ul>
                        </div>
                    </div>
                    

                  



                </div>
            </div>
            <div class="mobile-pay-now d-lg-none">
                <button type="button" id="rzp-button-mobile" class="btn btn-primary w-100 d-flex justify-content-center">
                    Pay Now
                </button>
                <div>
                    <ul class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
                        <li><img src="{{ asset('site/img/google-pay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="google-pay"></li>
                        <li><img src="{{ asset('site/img/phonepe-1.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="phonepe-1"></li>
                        <li><img src="{{ asset('site/img/rupay.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="rupay"></li>
                        <li><img src="{{ asset('site/img/visa.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="visa"></li>
                        <li><img src="{{ asset('site/img/mastercard-4.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="mastercard-4"></li>
                        <li><img src="{{ asset('site/img/paypal-3.svg') }}" class="img-fluid rounded payment-mode-lst-img" alt="paypal-3"></li>
                    </ul>
                </div>
            </div>

        </div>
        </div>
    </section>
</form>

@push('styles')
<style>
    .step {
        background: linear-gradient(90deg, #c7dffe 0%, #d8f2ff 100%);
        padding: 5px;
        border-radius: 10px;
    }

    .step-text {
        font-size: 14px;
    }

    .payement-terms-condition-inner li {
        font-size: 10px !important;
    }

    .pay-heading-title {
        font-size: 14px;
    }

    .tour-package-left h3 {
        font-size: 16px;
    }

    .date-list {
        font-size: 12px;
    }

    .booking-steps>span {
        font-size: 14px;
    }

    .jour-main {
        font-size: 12px;
    }

    .guest-count-dtls {
        font-size: 14px;
    }

    .room-ty {
        font-size: 14px;
    }

    #footers {
        display: none !important;
    }

    #expert-btn {
        display: none !important;
    }

    #booking-loader {
        pointer-events: none;

    }

    /* Desktop: sticky sidebar */
    @media(min-width: 992px) {
        .tour-package-sticky-sidebar {
            position: sticky;
            top: 80px;
            /* adjust based on header height */
        }
    }



    /* Mobile: sticky bottom pay button */
    @media(max-width: 991px) {
        .mobile-pay-now {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background: #fff;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.15);
            z-index: 999;
        }

        /* hide the original button on mobile */
        #rzp-button {
            display: none !important;
        }

        .tour-package-sticky-sidebar {
            position: relative;
            bottom: 35px;
        }
    }

    @media (max-width: 576px) {
        .tour-package-left {
            position: relative;
            bottom: 30px;
        }
    }

    /* payment section styling */
    .tbook-card {
        max-width: 520px;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 24px;
    }

    .tbook-subtitle {
        font-size: 0.7rem;
        color: #6c757d;
    }

    .tbook-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #222;
    }

    .tbook-discount {
        font-size: 0.75rem;
        background: #ff4d4f;
        padding: 4px 8px;
        border-radius: 4px;
        color: #fff;
        font-weight: 600;
    }

    /* Radio sections */
    .tbook-option {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 16px;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s;
    }

    .tbook-option:hover {
        background: #f9fafc;
    }

    .tbook-option-active {
        border-color: #0d6efd;
        background-color: #eef4ff;
    }

    .tbook-paylater-details {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px 16px;
        margin-top: 10px;
    }

    .tbook-paylater-details small {
        font-size: 0.8rem;
        color: #6c757d;
    }

    /* Fare section */
    .tbook-farebox {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 16px;
    }

    .tbook-farebox hr {
        margin: 10px 0;
    }

    .tbook-coupon {
        background-color: #d1fae5;
        color: #065f46;
        font-size: 0.75rem;
        padding: 3px 6px;
        border-radius: 4px;
        font-weight: 600;
    }

    /* EMI banner */
    .tbook-emi {
        color: #000000ff;
        text-align: start;
        border-radius: 8px;
        padding: 0;
        font-size: 0.9rem;
        margin-top: 0;
    }

    /* Links */
    .tbook-link {
        color: #0d6efd;
        text-decoration: none;
    }

    .tbook-link:hover {
        text-decoration: underline;
    }

    .form-check-input {
        padding: 0 !important;
    }
</style>
@endpush

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    

    document.addEventListener('DOMContentLoaded', function() {

        const loader = document.getElementById('booking-loader');
        const form = document.getElementById('booking-form');

        

        async function handlePaymentClick(e) {
            e.preventDefault();

            // Expand any invalid accordion fields
            const invalidFields = form.querySelectorAll(':invalid');
            invalidFields.forEach(field => {
                const accordionItem = field.closest('.accordion-collapse');
                if (accordionItem && !accordionItem.classList.contains('show')) {
                    const accordionButton = document.querySelector(`[data-bs-target="#${accordionItem.id}"]`);
                    if (accordionButton) accordionButton.click();
                }
            });

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            loader.style.display = 'flex';

            // Prepare form data
            const formData = new FormData(form);
            const obj = {};
            formData.forEach((value, key) => {
                // Handles arrays and objects from inputs
                if (key.includes('[')) {
                    const keys = key.replace(/\]/g, '').split('[');
                    let temp = obj;
                    keys.forEach((k, i) => {
                        if (i === keys.length - 1) temp[k] = value;
                        else temp[k] = temp[k] || {};
                        temp = temp[k];
                    });
                } else obj[key] = value;
            });

            try {
                // Step 1: Create Razorpay order
                const orderRes = await fetch("{{ route('boat-trip-pay') }}", {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(obj)
                });
                const orderData = await orderRes.json();

                if (!orderData.success) {
                    alert(orderData.message || "Order creation failed");
                    loader.style.display = 'none';
                    document.body.style.pointerEvents = '';
                    return;
                }

                // Step 2: Open Razorpay

                const options = {
                    key: "{{ config('services.razorpay.key') }}",
                    amount: orderData.amount,
                    currency: "INR",
                    name: "Andaman Bliss",
                    description: "Boat Trip Adventure Booking",
                    order_id: orderData.order_id,
                    handler: async function(response) {
                        try {
                            // Step 3: Verify payment
                            const verifyRes = await fetch("{{ route('boat-trip-payment.success') }}", {
                                method: 'POST',
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    booking_id: orderData.booking_id,
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature,
                                })
                            });
                            const successData = await verifyRes.json();
                           if (successData.success) {
                                Swal.fire({
                                    title: "Payment Successful!",
                                    text: "You’ll receive the booking details via email shortly.📨",
                                    icon: "success",
                                    timer: 6000,
                                    showConfirmButton: true
                                });

                                loader.style.display = 'none';
                                document.body.style.pointerEvents = '';

                                setTimeout(() => {
                                    window.location.href = `/boat-trips/${successData.name}`;
                                }, 6000);
                            }
                        else {
                                alert("Payment verification failed: " + successData.message);
                                loader.style.display = 'none';
                                document.body.style.pointerEvents = '';
                            }
                        } catch (err) {
                            alert("Error verifying payment. Please contact support.");
                            loader.style.display = 'none';
                            document.body.style.pointerEvents = '';
                        }
                    },
                    prefill: {
                        name: obj.billing?.name || '',
                        email: obj.billing?.email || '',
                        contact: obj.billing?.phone || ''
                    },
                    theme: {
                        color: "#3399cc"
                    },
                    modal: {
                        ondismiss: function() {
                            console.log("Razorpay modal was closed by the user.");
                            loader.style.display = 'none';
                            document.body.style.pointerEvents = '';
                        },
                        escape: true, 
                        backdropclose: false 
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();

            } catch (err) {
                alert("Something went wrong. Please try again.");
                loader.style.display = 'none';
                document.body.style.pointerEvents = '';
            }
        }

        const payButton = document.getElementById('rzp-button');
        const payButtonMobile = document.getElementById('rzp-button-mobile');

        if (payButton) payButton.addEventListener('click', handlePaymentClick);
        if (payButtonMobile) payButtonMobile.addEventListener('click', handlePaymentClick);
    });
</script>

@endsection