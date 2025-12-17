<div class="container-fuild pt-5 mx-6 px-lg-5 ">
    <div class="row align-items-center my-lg-4 flex-nowrap ">
        <div class="col-8 mb-lg-3 mb-md-0 text-center">
            <h2 class="text-primary fw-bold m-0 fs-6">Rental Booking – Review & Payment</h2>
        </div>


        <div class="col-4 text-md-end me-2">
            <a href="{{ route('bike.book') }}" class="btn btn-sm btn-danger border rounded-pill">
                <i class="fa fa-arrow-left"></i>Back
            </a>
        </div>
    </div>
    <p>
        @if (session('message'))
    <div class="alert alert-success py-2 px-3 rounded-pill d-inline-block mb-0" role="alert">
        {{ session('message') }}
    </div>
    @endif
    </p>

    <div class="row g-3">
        <div class="col-lg-6 sticky-mobile">
            <div class="accordion" id="vehicleAccordion">
                <div class="accordion-item">
                    <div class=" bg-white">
                        <h2 class="accordion-header d-lg-none" id="headingVehicle">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseVehicle" aria-expanded="false" aria-controls="collapseVehicle">
                                Vehicle & Location Details
                            </button>
                        </h2>
                    </div>

                    <div id="collapseVehicle" class="accordion-collapse collapse d-lg-block"
                        aria-labelledby="headingVehicle" data-bs-parent="#vehicleAccordion">
                        <div class="accordion-body card p-3 position-relative">

                            <div class="map-container mb-3">
                                <div id="location-map" style="height:350px; width:100%;" wire:ignore>
                                    <p style="text-align:center; padding:10px;">Loading map...</p>
                                </div>
                            </div>

                            <span class="location-tag">{{ $location }}</span>
                            @php
                            $days =
                            \Carbon\Carbon::parse($pickupDate)->diffInDays(
                            \Carbon\Carbon::parse($dropoffDate),
                            ) + 1;
                            @endphp

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="section-title">Vehicle Details</div>
                                    <div><strong>{{ $bike->name }}</strong></div>
                                    <div class="text-muted">Location: {{ $location }}</div>
                                    <div>
                                        Pickup: {{ $pickupDate }} → {{ $dropoffDate }}
                                        ({{ $days }} day{{ $days > 1 ? 's' : '' }})
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 mb-2">
                            <div class="section-title">Additional Details</div>
                            <div>Excess Hourly Charges: ₹{{ $bike->adult_price }}/vehicle</div>
                        </div> -->
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <form wire:submit.prevent="submit">
                <input type="hidden" id="hiddenLocation" value="{{ $maps['location'] }}">


                <div class="card p-3 mb-3 ">
                    <div class="section-title">Billing Details</div>
                    <div class="d-flex flex-wrap">
                        <div class="mb-2 col-12 col-md-6  pe-lg-1">
                            <label class="form-label mb-1">Full Name</label>
                            <input type="text" class="form-control rounded-0" wire:model="fullName" required>
                            @error('fullName')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2 col-12 col-md-6">
                            <label class="form-label mb-1">Contact Number</label>
                            <input type="text" class="form-control rounded-0" wire:model="contact" required>
                            @error('contact')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2 col-12 col-md-6 pe-lg-1">
                            <label class="form-label mb-1">Email Address</label>
                            <input type="email" class="form-control rounded-0" wire:model="email" required>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2 col-12 col-md-6">
                            <label class="form-label mb-1">Bike Quantity</label>
                            <select class="form-control rounded-0" wire:model="bikeQuantity" wire:change="updateCost">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                            @error('bikeQuantity')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2 col-12 col-md-6 pe-lg-1">
                            <label class="form-label mb-1">Mode Of Pickup</label>
                            <select class="form-control rounded-0" wire:model="pickupOption"
                                wire:change="updatePickupOption">
                                <option value="self">Self Pickup</option>
                                <option value="delivery">Delivery</option>
                            </select>
                            @error('pickupOption')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2 col-12 col-md-6  {{ $showPickupLocation ? '' : 'd-none' }}">
                            <label for="pickupLocation" class="form-label mb-1">Pickup Location</label>
                            <div wire:ignore>
                                <select id="pickupLocation" class="form-control rounded-0 select2">
                                    <option value="">Select Pickup Location</option>
                                    @foreach($locations as $loc)
                                    <option
                                        value="{{ $loc['id'] }}"
                                        data-distance="{{ $loc['distance_km'] }}">
                                        {{ $loc['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <small style="font-size: 10px;" class="text-danger">Delivery avaiable within
                                {{ $maps['range_km'] }} Km of city range</small>
                            @foreach (['pickupLocation', 'distance'] as $field)
                            @error($field)
                            <span style="font-size: 10px;" class="text-danger small">{{ $message }}</span><br>
                            @enderror
                            @endforeach

                        </div>


                        <div class="mb-2 col-12 col-md-6 position-relative pickup-wrapper  {{ $showPickupLocation ? 'd-none' : '' }}">
                            <label for="selfpick" class="form-label mb-1">Pickup Location</label>
                            <input type="text" class="form-control rounded-0 hover-trigger"
                                name="selfpick" id="selfpick"
                                value=" Location : {{$mapcordinate['pick_location']}}" readonly>
                            <div class="self-map-container z-3 position-absolute" wire:ignore>
                                <iframe id="pickupMap" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <br>
                            <span style="font-size: 10px;" class="text-danger small">Pick Vehicle From</span>
                        </div>


                        <div class="col-12">
                            <div class="section-title">
                                Select Time Slot
                                @if ($errors->has('activeSlot') || $errors->has('selectedTime'))
                                <small class="text-danger">
                                    {{ $errors->first('activeSlot') ?: '' }}
                                    {{ $errors->has('activeSlot') && $errors->has('selectedTime') ? ' | ' : '' }}
                                    {{ $errors->first('selectedTime') ?: '' }}
                                </small>
                                @endif
                            </div>
                            <div class="d-flex gap-2 mb-2 me-lg-1">
                                @foreach (array_keys($times) as $slot)
                                <div class="slot-btn col-4 {{ $activeSlot === $slot ? 'active' : '' }}"
                                    wire:click="selectSlot('{{ $slot }}')">
                                    {{ ucfirst($slot) }} {!! $times[$slot]['icon'] ?? '' !!}
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                @if (isset($times[$activeSlot]['times']) && count($times[$activeSlot]['times']) > 0)
                                @foreach ($times[$activeSlot]['times'] as $time)
                                <div class="slot-btn {{ $selectedTime === $time ? 'active' : '' }}"
                                    wire:click="selectTime('{{ $time }}')">
                                    {{ $time }}
                                </div>
                                @endforeach
                                @else
                                <div class="text-muted">No slots available</div>
                                @endif

                            </div>
                            @if ($selectedTime)
                            <div class="note">
                                ** NOTE: Upon ending the ride, drop the vehicle at hub by
                                {{ $dropTime ?? '10:00 AM' }},
                                {{ \Carbon\Carbon::parse($pickupDate ?? now())->format('d-M-Y') }}
                            </div>
                            @endif
                        </div>

                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Vehicle Cost</span>
                        <strong>
                            ₹{{ number_format($showPickupLocation ? $totalCost - $payNow : $totalCost, 0) }}</strong>
                    </div>
                    @if ($showPickupLocation)
                    <div class="d-flex justify-content-between mb-1">
                        <span>Delivery Charge</span>
                        <strong>₹{{ number_format($payNow) }}</strong>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between mb-1">
                        <span>Total Amount</span>
                        <strong>₹{{ number_format($totalCost, 0) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Pay on arrival</span>
                        <strong>₹{{ number_format($payLater, 0) }}</strong>
                    </div>
                    <div class="note mb-3">A security deposit of ₹2000 will be collected at the time of bike
                        pickup and returned after the ride.</div>
                    <button type="submit" class="pay-btn desktop-pay">Pay Now
                        ₹{{ number_format($payNow, 0) }}</button>
                </div>

            </form>
        </div>
    </div>
    <div class="sticky-pay">
        <button type="button" class="pay-btn" wire:click="submit">
            Pay Now ₹{{ number_format($payNow, 0) }}
        </button>
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
        Processing your booking...
    </div>
</div>
@push('styles')
<style>
    #expert-btn {
        display: none;
    }

    #footers {
        display: none;
    }

    .card {
        border: 1px solid #e5e5e5;
        box-shadow: none;
        border-radius: 0;
    }

    .map-container {
        height: 350px;
    }

    .location-tag {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #000;
        color: #fff;
        padding: 4px 10px;
        font-weight: 600;
        font-size: 14px;
    }

    .section-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .slot-btn {
        border: 1px solid #ddd;
        padding: 6px 12px;
        cursor: pointer;
        font-size: 13px;
    }

    .slot-btn.active {
        background: #0dcaf0;
        color: #fff;
        border-color: #0dcaf0;
    }

    .pay-btn {
        background: #FF5722;
        border: none;
        padding: 12px 20px;
        color: #fff;
        width: 100%;
        font-weight: 600;
        font-size: 14px;
    }



    .note {
        color: #c00;
        font-size: 12px;
        margin-top: 8px;
    }

    .input-group input {
        font-size: 13px;
    }

    @media(max-width: 767px) {
        .sticky-pay {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            padding: 10px;
            border-top: 1px solid #ddd;
            z-index: 1000;
        }

        .desktop-pay {
            display: none;
        }
    }

    @media(min-width: 768px) {
        .sticky-pay {
            display: none;
        }
    }

    .input-group .btn {
        width: 100px !important;
    }

    @media (max-width: 768px) {
        .text-md-end {
            text-align: right !important;
        }
    }

    @media (max-width: 767px) {
        .sticky-mobile {
            position: sticky;
            top: 8vh;
            z-index: 1050;
            background: #fff;
        }
    }

    .accordion-button:focus {
        outline: none;
        background: none;
        box-shadow: none;
        /* Optional: Also remove the default box-shadow on focus */
    }

    #pickupLocation:focus~#datepicker-backdrop {
        display: block;
    }

    #pickupLocation:focus {
        outline: none;
    }

    /* Lock scroll */
    #pickupLocation:focus~#datepicker-backdrop {
        position: fixed;
    }

    body:has(#pickupLocation:focus) {
        overflow: hidden;
        height: 100vh;
    }

    #datepicker-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        z-index: 9998;
    }

    .pac-container {
        z-index: 9999 !important;
    }

    .pickup-wrapper {
        position: relative;
        /* necessary for absolute map */
    }

    .pickup-wrapper:hover .self-map-container {
        display: block;
        /* map stays visible when hovering input or map */
    }

    .self-map-container {
        display: none;
        width: 100%;
        height: 300px;
        /* fixed height */
        border: 1px solid #ccc;
        margin-top: 5px;
        box-shadow: -5px 5px 20px 5px #7c7c7cff;
        position: absolute;
        top: 40px;
        /* adjust so it appears below input */
        left: 0;
        z-index: 100;
    }
    .select2-container--default .select2-selection--single {
            width: 100% !important;
    padding: 2px !important;
    border: 1px solid #e0e0e0 !important;
    border-radius: 0px !important;
    font-size: 12px !important;
    transition: var(--transition) !important;
    height: 45px !important;

    }
</style>
@endpush
@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</script>

<script>
    const loader = document.getElementById('booking-loader');

    const pickLoc = @json(['Location' => $mapcordinate['pick_location'], ]);

    const locationName = pickLoc.Location; // define the variable

    const iframe = document.getElementById('pickupMap');

    iframe.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyAai7unx7nXZnFcC4tVv3AGzJVjjUr4-bg&q=${encodeURIComponent(locationName)}&zoom=14`;



    // Livewire.on('OpenPaymentSdk', (data) => {
    //     if (!data || !data[0] || !data[0].order || !data[0].userDetails) return;

    //     const order = data[0].order;
    //     const UserDeta = data[0].userDetails;

    //     var options = {
    //         "key": UserDeta.razorpay_key,
    //         "amount": order.amount,
    //         "currency": order.currency,
    //         "order_id": order.id,
    //         "handler": function(response) {
    //             @this.call('paymentSuccess', ([response.razorpay_payment_id, response.razorpay_order_id,
    //                 response.razorpay_signature
    //             ]));
    //             loader.style.display = 'flex';
    //             console.log(response);

    //         },
    //         "modal": {
    //             "ondismiss": function() {
    //                 @this.call('resetForm');
    //                 @this.call('paymentFailedSessionAlert');
    //                 window.location.reload();
    //             }
    //         },
    //         "prefill": {
    //             "name": UserDeta.name || "Default Name",
    //             "email": UserDeta.email || "default@example.com",
    //             "contact": UserDeta.contact || "0000000000"
    //         },
    //         "theme": {
    //             "color": "#3399cc"
    //         }
    //     };
    //     new Razorpay(options).open();
    // });





    function initMap() {
        var locationName = @json($location ?? null);


        if (!locationName) {
            document.getElementById('location-map').innerHTML =
                "<p style='text-align:center; padding:20px;'>Location not set</p>";
            return;
        }

        var iframeUrl = `https://www.google.com/maps/embed/v1/place?key=AIzaSyAai7unx7nXZnFcC4tVv3AGzJVjjUr4-bg&q=${encodeURIComponent(locationName + ', Andaman and Nicobar Islands')}`;
        document.getElementById('location-map').innerHTML = `<iframe width="100%" height="100%" style="border:0; border-radius:8px;" src="${iframeUrl}" allowfullscreen></iframe>`;
    }

    if (window.Livewire) {
        initMap();
        Livewire.hook('message.processed', () => initMap());
    } else {
        document.addEventListener('DOMContentLoaded', initMap);
    };




    document.addEventListener('livewire:init', () => {

        const longitude = parseFloat(@json($maps['longitude']));
        const latitude = parseFloat(@json($maps['latitude']));
        const distance = parseFloat(@json($maps['range_km']));
        const airportCoords = {
            lat: latitude,
            lng: longitude
        };
        let autocomplete;
        let islandBounds;

        const maxDistance = parseFloat(@json($maps['range_km']));

        $('#pickupLocation').select2({
            width: '100%'
        });

        $('#pickupLocation').on('change', function() {

            const selectedOption = $(this).find(':selected');

            if (!selectedOption.val()) {
                resetPickup();
                return;
            }

            const locationName = selectedOption.text();
            const distanceValue = parseFloat(selectedOption.data('distance'));

            // 1️⃣ Invalid distance
            if (isNaN(distanceValue)) {
                Swal.fire({
                    icon: "warning",
                    title: "Oops!",
                    text: "Invalid location selected.",
                }).then(resetPickup);
                return;
            }

            // 2️⃣ Out of delivery range
            if (distanceValue > maxDistance) {
                Swal.fire({
                    icon: "warning",
                    title: "Sorry!",
                    text: "We only deliver bikes within the city limits!",
                }).then(resetPickup);
                return;
            }

            @this.call('updatePickup', locationName, distanceValue);
            @this.set('distance', distanceValue);

            console.log('Pickup set:', locationName, distanceValue);
        });

        function resetPickup() {
            $('#pickupLocation').val(null).trigger('change.select2');
            @this.call('updatePickup', null, null);
            @this.set('distance', 0);
        }

        Livewire.hook('message.processed', () => {
            $('#pickupLocation').select2({
                width: '100%'
            });
        });
    });




    // Livewire.on('paymentCompleted', bookingId => {
    //     let form = document.createElement('form');
    //     form.method = 'POST';
    //     form.action = '/booking/confirm/' + bookingId;

    //     let token = document.createElement('input');
    //     token.type = 'hidden';
    //     token.name = '_token';
    //     token.value = '{{ csrf_token() }}';
    //     form.appendChild(token);

    //     document.body.appendChild(form);
    //     form.submit();
    // });

    // Livewire.on('paymentError', message => {
    //     console.log('Payment Failed:', message);
    //     alert('Payment Failed: ' + message);
    // });


    document.addEventListener('livewire:init', () => {
        initAutocomplete();
        Livewire.hook('message.processed', () => {
            attachAutocomplete();
        });
    });
</script>
@endpush