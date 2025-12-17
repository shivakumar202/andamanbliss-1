<div>

    <div class="row">
        <!-- Left Column: Trip and Car Details -->
        <div class="col-lg-8">
            <!-- Trip Details Card -->
            <div class="card mb-4 p-3 shadow-sm">
                <h2 class="h5 mb-3">Trip Details</h2>
                <div class="row g-3">
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">From</p>
                        <p class="mb-0">{!! $formattedData['from_location'] ?? $formattedData['pickup'] ?? 'Not
                            Available' !!}</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">To</p>
                        <p class="mb-0">{!! $formattedData['to_location'] ?? ($formattedData['Package'] ?? 'Not
                            Available') !!}</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">Pickup Location</p>
                        <input type="text" class="form-control form-control-sm" wire:model.live="pickup_location"
                            placeholder="Enter Pickup Location" required>
                        @error('pickup_location') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">Number of Travellers</p>
                        <select class="form-control form-control-sm" wire:model.live="travellers" required>
                            @for ($i = 1; $i <= ($formattedData['carSeats'] ?? 1) * 3; $i++) <option value="{{ $i }}">{{
                                $i }}</option>
                                @endfor
                        </select>
                        @error('travellers') <span class="text-danger small">{{ $message }}</span> @enderror

                    </div>
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">Date</p>
                        <p class="mb-0">{{ $formattedData['pickupdate'] }}, {{
                            \Carbon\Carbon::parse($formattedData['pickupdate'])->format('l') }}</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">Pickup Time</p>
                        <p class="mb-0">{{ $formattedData['pickuptime'] }}</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">Trip Type</p>
                        <p class="mb-0">{{ $formattedData['trip_type'] }}</p>
                    </div>
                    @if ($formattedData['trip_type'] === 'Round Trip')
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">Return Date</p>
                        <p class="mb-0">{{ $formattedData['return_date'] ?? 'Not Available' }}</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p class="small text-muted mb-1">Return Time</p>
                        <p class="mb-0">{{ $formattedData['return_time'] ?? 'Not Available' }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Car Details Card -->
            <div class="card mb-4 p-3 shadow-sm">
                <h2 class="h5 mb-3">Car Details</h2>
                <div class="d-flex flex-column flex-md-row mb-3 align-items-md-center">
                    <img src="{{ asset($formattedData['carImage']) }}" alt="Car Image" class="me-md-3 mb-3 mb-md-0"
                        style="width: 100px; height: 60px; object-fit: cover; border-radius: 8px;">
                    <div class="flex-grow-1">
                        <p class="fw-bold mb-1">{!! $formattedData['carName'] !!} ({{ $formattedData['fuelType'] ??
                            'Diesel' }})</p>

                        <p class="mb-0">{{ $formattedData['carSeats'] }} Passengers | {{ $formattedData['smallBags'] ??
                            '2 Small Bags' }}</p>
                    </div>
                    <div class="mt-3 mt-md-0">
                        <label for="cab_quantity" class="small text-muted mb-1 d-block">Cab Quantity</label>
                        @php
                        $carSeats = $formattedData['carSeats'] ?? 1;
                        $travellerCount = $travellers ?? 1;
                        $minCabs = max(1, ceil($travellerCount / $carSeats));
                        $maxCabs = $minCabs; 
                        @endphp

                        <select class="form-control form-control-sm" id="cab_quantity" wire:model.live="cab_quantity"
                            required>
                            @for ($i = $minCabs; $i <= $maxCabs; $i++) <option value="{{ $i }}" {{ $cab_quantity==$i
                                ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                        </select>


                        @error('cab_quantity') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div>
                    <h3 class="h6 mb-2">Additional Details</h3>
                    <ul class="list-unstyled small">
                        @foreach ($formattedData['details'] as $detail)
                        <li class="mb-1">{{ $detail }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column: Fare and Billing -->
        <div class="col-lg-4">
            <!-- Fare Details -->
            <div class="card mb-4 p-3 shadow-sm">
                <h2 class="h5 mb-3">Fare Details</h2>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <p class="small text-muted mb-0">Base Fare</p>
                    <p class="mb-0 base-fare">₹{{ number_format($formattedData['fare'], 2) }}</p>
                </div>

                <div class="d-flex justify-content-between py-2 border-bottom">
                    <p class="small text-muted mb-0">Total Fare</p>
                    <p class="fw-bold text-warning mb-0 total-fare">₹{{ number_format($formattedData['totalFare'], 2) }}
                    </p>
                </div>
                <div class="small text-muted mt-2">
                    <p class="mb-0">Note: Please check all the details before confirming your booking.</p>
                </div>
            </div>

            <!-- Billing Details -->
            <div class="card p-3 mb-4 shadow-sm">
                <h2 class="h5 mb-3">Billing Details</h2>
                <form wire:submit.prevent="submit" id="booking-form">
                    <input type="hidden" name="carId" value="{{ $formattedData['carId'] ?? '' }}">
                    <input type="hidden" name="packageId" value="{{ $formattedData['packageId'] ?? '' }}">
                    <input type="hidden" name="pickupdate" value="{{ $formattedData['pickupdate'] }}">
                    <input type="hidden" name="pickuptime" value="{{ $formattedData['pickuptime'] }}">
                    <input type="hidden" name="trip_type" value="{{ $formattedData['trip_type'] ?? 'One Way' }}">
                    <input type="hidden" name="pickup" value="{{ $formattedData['pickup'] ?? '' }}">
                    <input type="hidden" name="from_location" value="{{ $formattedData['from_location'] ?? '' }}">
                    <input type="hidden" name="to_location" value="{{ $formattedData['to_location'] ?? '' }}">
                    <input type="hidden" name="return_date" value="{{ $formattedData['return_date'] ?? '' }}">
                    <input type="hidden" name="return_time" value="{{ $formattedData['return_time'] ?? '' }}">
                    <input type="hidden" name="package_type" value="{{ $formattedData['package_type'] ?? 'Local' }}">
                    <div class="mb-3">
                        <label for="name" class="form-label small">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" wire:model="name" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label small">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" wire:model="email" required>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label small">Contact</label>
                        <input type="number" class="form-control form-control-sm" id="contact" wire:model="contact"
                            required>
                        @error('contact') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label small">Billing Address</label>
                        <textarea class="form-control form-control-sm" id="address" wire:model="address" rows="3"
                            required></textarea>
                        @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <p class="small text-muted mb-0">Advance Payment (100%)</p>
                        <p class="fw-bold mb-0">₹{{ $payableAmt }}</p>
                    </div>
                    <div class="small text-muted mt-2">
                        <p class="mb-0">Note: The amount of ₹100 is required for advance booking confirmation.</p>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3 d-none d-sm-block">Pay Now {{ $payableAmt
                        }}</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sticky Button for Small Devices -->
    <div class="d-block d-sm-none position-sticky bottom-0 start-0 end-0 mb-3 px-3">
        <button type="submit" form="booking-form" class="btn btn-primary w-100">Pay Now {{ $payableAmt }}</button>
    </div>
</div>
@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
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
                @this.call('paymentSuccess', ([response.razorpay_payment_id, response.razorpay_order_id, response.razorpay_signature]));
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
</script>
@endpush