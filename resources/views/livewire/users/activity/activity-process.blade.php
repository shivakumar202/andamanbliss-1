<div>

    <div class="row">
        <div class="col-md-12 form-column p-3">
            <div class="form-container shadow p-3 bg-white">
                <div class="row border-bottom mb-3">
                    <h2 class="fw-bolder fs-4">
                        {{ match ($step) {
                            1 => 'Billing Details',
                            2 => 'Booking Details',
                            default => 'Step Information',
                        } }}
                    </h2>
                </div>
                {{-- Step 1 --}}
                @if($step === 1)
                    <div class="form-step {{ $step == 1 ? 'active' : '' }}" id="bookingDetailsStep">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control rounded-0" wire:model="fname"
                                    id="firstName" name="firstName" placeholder="Enter first name" required>
                                <div class="invalid-feedback">Please enter your first name.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control rounded-0" wire:model="lname"
                                    id="lastName" name="lastName" placeholder="Enter last name" required>
                                <div class="invalid-feedback">Please enter your last name.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input type="tel" class="form-control rounded-0" wire:model="contact"
                                    id="mobile" name="mobile" placeholder="Enter 10-digit mobile number" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control rounded-0" wire:model="email"
                                    id="email" name="email" placeholder="Enter Email Address" required>
                                <div class="invalid-feedback">Please enter email address.</div>
                            </div>
                            <div class="col-12 mb-3 form-check">                               
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="termsAccept" wire:model.defer="termsAccepted">
                                <label class="form-check-label" for="termsAccept">
                                    I accept the terms and conditions and confirm that all participants are mentally and physically fit to undertake this activity.
                                </label>
                            </div>
                            @error('termsAccepted') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Validation Errors --}}
                        @error('fname') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('lname') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('dec') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                {{-- Step 2 --}}
                @elseif($step === 2)
                    <div class="form-step {{ $step == 2 ? 'active' : '' }}" id="bookingConfirmationStep">
                        <div class="container-fluid m-0">
                            <h4 class="mb-2 text-center fw-bold">Water Activity Booking</h4>
                            <div class="row g-0">
                                <div class="col-lg-6 col-md-6 col-sm-12 p-1 border-end">
                                    <div class="d-flex justify-content-between mb-1">Booking Date:
                                        <span>{{ \Carbon\Carbon::now()->format('jS F Y') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">Activity:
                                        <span>{{ ucwords(collect(explode(' ', str_replace('-', ' ', $activity['service_name'])))->take(2)->join(' ')) }}...</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">Location:
                                        <span>{{ collect(explode(' ', str_replace('-', ' ', $activity['location'])))->take(2)->join(' ') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">Name:
                                        <span>{{ ucwords($fname . ' ' . $lname) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">Contact:
                                        <span>{{ $contact }}</span>
                                    </div>
                                   
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 p-1">
                                    <div class="d-flex justify-content-between mb-1">Date:
                                        <span>{{ \Carbon\Carbon::parse($activity_date)->format('jS F Y') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">Slot:
                                        <span>{{ $slot ?? 'Not Selected' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">Participants:
                                        <span>{{ $guest }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">Per Person:
                                        <span>{{ number_format($activity['adult_price'], 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">GST:
                                        <span>18%</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1 text-success">Total:
                                        <span>{{ number_format($total_cost, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1 text-success">Pay Now:
                                        <span>{{ number_format($paynow, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Sticky Buttons (appear on all screen sizes, stick only on small screens) --}}
                <div class="sticky-footer-wrapper mt-4 d-block d-md-none">
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-secondary w-50 rounded-0"
                            wire:click="previousStep">Back</button>
                        @if($step < 2)
                            <button type="button" class="btn btn-yellow w-50 text-white fw-semibold rounded-0"
                                wire:click="nextStep">Proceed</button>
                        @else
                            <button type="button" class="btn btn-primary w-50 text-white fw-semibold rounded-0"
                                wire:click="submit">Pay Now <i class="fa-solid fa-wallet"></i></button>
                        @endif
                    </div>
                </div>

                {{-- Buttons for desktop (non-sticky) --}}
                <div class="d-none d-md-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary rounded-0"
                        wire:click="previousStep">Back</button>
                    @if($step < 2)
                        <button type="button" class="btn btn-yellow btn-lg text-white fw-semibold rounded-0 ms-auto"
                            wire:click="nextStep">Proceed</button>
                    @else
                        <button type="button" class="btn btn-primary text-white fw-semibold rounded-0 ms-auto"
                            wire:click="submit">Pay Now <i class="fa-solid fa-wallet"></i></button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>


@push('styles')


@endpush
@push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:init', function() {
            $(document).ready(function() {
                Livewire.on('ineligible', () => {
                    $('#medicalConditionModal').modal('show');
                })


                Livewire.on('alert', (message) => {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: message,
                        footer: '<a href="#">Happy Travel :) </a>'
                    });
                });

                Livewire.on('OpenPaymentSdk', (data) => {
                    if (!data || !data[0] || !data[0].order || !data[0].userDetails) {
                        console.error('Order or User Details are undefined.');
                        return;
                    }

                    const order = data[0].order;
                    const UserDeta = data[0].userDetails;

                    console.log('Order:', order);
                    console.log('User Details:', UserDeta);

                    var options = {
                        "key": UserDeta.razorpay_key,
                        "amount": order.amount,
                        "currency": order.currency,
                        "order_id": order.id,
                        "handler": function(response) {
                            @this.call('paymentSuccess', ([response.razorpay_payment_id,
                                response.razorpay_order_id, response
                                .razorpay_signature
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


            })


        })
    </script>
@endpush
