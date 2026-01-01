<div>
    <div class="confirmation-section bg-light ">
        <div class="container">
            @if ($step == 0)
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem"></i>
                        </div>
                        <h2 class="mb-3">Booking Confirmed!</h2>
                        <p class="lead mb-4">
                            Your Andaman tour package has been successfully booked. Would you
                            like to enhance your experience with some amazing water
                            activities?
                        </p>

                        <div class="d-flex gap-3 justify-content-center">
                            <a href="{{ route('index') }}"><button class="btn btn-outline-secondary btn-lg"
                                    href="{{ route('home') }}">
                                    <i class="bi bi-skip-forward me-2"></i>Skip & Continue
                                </button></a>
                            <button class="btn btn-primary-custom btn-lg" wire:click="nextStep">
                                <i class="bi bi-search me-2"></i>Explore More Activities
                            </button>
                        </div>
                    </div>
                </div>
            @elseif($step == 1)
                <div class="upsale-section mt-5" id="upsaleSection">
                    <div class="up-container container-fluid">
                        <div class="up-header">
                            <h3>
                                <i class="bi bi-star-fill up-star"></i>
                                Enhance Your Andaman Experience
                            </h3>
                            <p>
                                Add these amazing water activities to make your trip unforgettable
                            </p>
                        </div>

                        <div class="d-flex flex-wrap booking-review-section">
                            <div class="up-card-grid col-8">
                                @foreach ($activities as $activity)
                                    <div class="up-card">
                                        <div class="up-card-image">
                                            <img src="https://images.unsplash.com/photo-1586508577428-120d6b072945?q=80&w=928&auto=format&fit=crop"
                                                alt="{{ $activity->service_name }}">
                                            <span class="up-discount">30% OFF</span>
                                        </div>

                                        <div class="up-card-body">
                                            <h5 class="up-title">{{ $activity->service_name }}</h5>
                                            <p class="up-desc">
                                                Explore vibrant coral reefs and marine life in crystal clear waters.
                                            </p>

                                            <div class="up-price">
                                                <span class="up-price-original">₹6,500</span>
                                                <span class="up-price-offer">₹4,550</span>
                                            </div>

                                            <div class="up-actions">
                                                <button class="btn btn-primary-custom w-100 " data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    wire:click="openActivity({{ $activity->id }})">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div> 

                            <div class="col-lg-4 col-md-5 p-2">
                                <div class="tour-package-sticky-sidebar">
                                    <div class="tbook-card">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <div>
                                                <div class="tbook-price">SELECTED ACTIVITIES</div>
                                            </div>
                                            <span class="tbook-discount bg-success">⚡Instant Confirmation</span>
                                        </div>
                                        @if (count($selectedActivities))
                                            <div class="ms-1 overflow-y-auto mb-1" style="max-height: 200px">
                                                @foreach ($selectedActivities as $id => $data)
                                                    @php
                                                        $activity = $activities->firstWhere('id', $id);
                                                    @endphp

                                                    <div class="card mb-3 shadow-sm rounded-5">
                                                        <div class="row g-0 align-items-center">
                                                            <!-- Image / Icon placeholder -->
                                                            <div class="col-md-2 text-center p-2">
                                                                <i class="fa-solid fa-person-swimming"></i>
                                                            </div>

                                                            <!-- Activity details -->
                                                            <div class="col-md-10">
                                                                <div class="card-body p-2">
                                                                    <h5 class="up-title mb-1">
                                                                        {{ $activity->service_name }}
                                                                    </h5>

                                                                    <p class="card-text text-muted small mb-1">
                                                                        {{ \Carbon\Carbon::parse($data['date'])->format('d M Y') }}
                                                                        |
                                                                        Adults: {{ $data['adult'] }}, Children:
                                                                        {{ $data['child'] }}
                                                                    </p>

                                                                </div>
                                                            </div>

                                                            <!-- Price & Actions -->
                                                            <div class="col-md-12 text-center p-1">
                                                                <div class="d-flex gap-1">
                                                                    <button class="btn btn-primary btn-sm"
                                                                        wire:click="editActivity({{ $id }})">
                                                                        Edit <i class="fa fa-pen ms-1"></i>
                                                                    </button>
                                                                    <button class="btn btn-outline-danger btn-sm"
                                                                        wire:click="removeActivity({{ $id }})">
                                                                        Remove <i class="fa fa-trash ms-1"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="tbook-option tbook-option-active mb-3">
                                            <div class="form-check d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input" type="radio" name="full_pay"
                                                        id="payFull" checked>
                                                    <label class="form-check-label fw-bolder ms-2 my-0"
                                                        for="payFull">Pay To Confirm</label>
                                                </div>
                                                <strong>₹{{ number_format($totalCost, 2) }}</strong>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="fw-bold">Fare Breakup</h6>
                                            <div class="tbook-farebox">
                                                <div class="d-flex justify-content-between">
                                                    <span>Total Basic Cost</span>
                                                    <strong>₹{{ number_format($activityCost, 2) }}</strong>
                                                </div>
                                                <small class="text-muted">4 Activities </small>

                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <span>Services & Taxes</span>
                                                    <strong>+₹{{ number_format($serviceCost, 2) }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="tbook-emi" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="EMI Available on all payment modes">EMI Available on all
                                            payment modes</p>

                                        <hr>
                                        <div class="d-grid mt-2">
                                            <button type="button" id="rzp-button"
                                                class="btn btn-primary d-flex justify-content-center" wire:click='submit'>
                                                Pay Now
                                            </button>
                                            <div>
                                                <ul
                                                    class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
                                                    <li><img src="{{ asset('site/img/google-pay.svg') }}"
                                                            class="img-fluid rounded payment-mode-lst-img"
                                                            alt="google-pay"></li>
                                                    <li><img src="{{ asset('site/img/phonepe-1.svg') }}"
                                                            class="img-fluid rounded payment-mode-lst-img"
                                                            alt="phonepe-1"></li>
                                                    <li><img src="{{ asset('site/img/rupay.svg') }}"
                                                            class="img-fluid rounded payment-mode-lst-img"
                                                            alt="rupay"></li>
                                                    <li><img src="{{ asset('site/img/visa.svg') }}"
                                                            class="img-fluid rounded payment-mode-lst-img"
                                                            alt="visa"></li>
                                                    <li><img src="{{ asset('site/img/mastercard-4.svg') }}"
                                                            class="img-fluid rounded payment-mode-lst-img"
                                                            alt="mastercard-4"></li>
                                                    <li><img src="{{ asset('site/img/paypal-3.svg') }}"
                                                            class="img-fluid rounded payment-mode-lst-img"
                                                            alt="paypal-3"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mobile-pay-now d-lg-none">
                                    <button type="button" id="rzp-button-mobile"
                                        class="btn btn-primary w-100 d-flex justify-content-center" wire:click='submit'>
                                        Pay Now
                                    </button>
                                    <div>
                                        <ul
                                            class="d-flex justify-content-center gap-2 align-items-center payment-mode-lst">
                                            <li><img src="{{ asset('site/img/google-pay.svg') }}"
                                                    class="img-fluid rounded payment-mode-lst-img" alt="google-pay">
                                            </li>
                                            <li><img src="{{ asset('site/img/phonepe-1.svg') }}"
                                                    class="img-fluid rounded payment-mode-lst-img" alt="phonepe-1">
                                            </li>
                                            <li><img src="{{ asset('site/img/rupay.svg') }}"
                                                    class="img-fluid rounded payment-mode-lst-img" alt="rupay">
                                            </li>
                                            <li><img src="{{ asset('site/img/visa.svg') }}"
                                                    class="img-fluid rounded payment-mode-lst-img" alt="visa">
                                            </li>
                                            <li><img src="{{ asset('site/img/mastercard-4.svg') }}"
                                                    class="img-fluid rounded payment-mode-lst-img" alt="mastercard-4">
                                            </li>
                                            <li><img src="{{ asset('site/img/paypal-3.svg') }}"
                                                    class="img-fluid rounded payment-mode-lst-img" alt="paypal-3">
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>



                            <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel"
                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content p-2">
                                        <div class="div d-flex justify-content-end">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="mb-1">
                                                <label class="form-label text-muted small">Activity Date</label>
                                                <input type="date" class="form-control form-control-lg"
                                                    wire:model="activityDate">
                                            </div>

                                            <!-- Adults -->
                                            <div class="d-flex justify-content-between align-items-center mb-1"
                                                style="font-size: 12px">
                                                <div>
                                                    <div class="fw-semibold">Adults</div>
                                                    <small class="text-muted">Age 12+</small>
                                                </div>



                                                <div class="input-group input-group-sm w-auto">
                                                    <button type="button" class="btn btn-outline-secondary mini-size"
                                                        wire:click="decreaseAdult">
                                                        −
                                                    </button>

                                                    <input type="text" class="form-control text-center mini-size"
                                                        wire:model="adult" readonly style="max-width:50px">

                                                    <button type="button" class="btn btn-outline-secondary mini-size"
                                                        wire:click="increaseAdult">
                                                        +
                                                    </button>
                                                </div>

                                            </div>

                                            <!-- Children -->
                                            <div class="d-flex justify-content-between align-items-center mb-1"
                                                style="font-size: 12px">
                                                <div>
                                                    <div class="fw-semibold">Child's</div>
                                                    <small class="text-muted">Age 0–3</small>
                                                </div>

                                                <div class="input-group input-group-sm w-auto">
                                                    <button type="button" class="btn btn-outline-secondary mini-size"
                                                        wire:click="decreaseInfant">
                                                        −
                                                    </button>

                                                    <input type="text" class="form-control text-center mini-size"
                                                        wire:model="child" readonly style="max-width:50px">

                                                    <button type="button" class="btn btn-outline-secondary mini-size"
                                                        wire:click="increaseInfant">
                                                        +
                                                    </button>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-primary"
                                                wire:click="addActivity">Add
                                                <i class="fa-solid fa-cart-arrow-down"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($step == 2)
            @else
                <p>Unexpected Error</p>
            @endif
        </div>
    </div>
</div>
@push('styles')
    <style>
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
            font-size: 1rem;
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
@push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('open-activity-modal', () => {
                const modal = new bootstrap.Modal(
                    document.getElementById('exampleModal')
                );
                modal.show();
            });

            Livewire.on('close-activity-modal', () => {
                const el = document.getElementById('exampleModal');
                const modal = bootstrap.Modal.getInstance(el);
                modal.hide();
            });

            Livewire.on('OpenPaymentSdk', (data) => {
                if (!data || !data[0] || !data[0].order || !data[0].userDetails) {
                    console.error('Order or User Details are undefined.');
                    return;
                }
                const order = data[0].order;
                const UserDeta = data[0].userDetails;

                var options = {
                    "key": UserDeta.razorpay_key,
                    "amount": order.amount,
                    "currency": order.currency,
                    "order_id": order.id,
                    "handler": function(response) {
                        @this.call('paymentSuccess', ([response.razorpay_payment_id, response
                            .razorpay_order_id, response.razorpay_signature
                        ]));
                    },
                    "modal": {
                        "ondismiss": function() {
                            @this.call('paymentFailedSessionAlert');
                        }
                    },
                    "prefill": {
                        "name": UserDeta.name || "Default Name",
                        "email": UserDeta.email || "default@example.com",
                        "contact": UserDeta.contact || "0000000000"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            });

        });
    </script>
@endpush
