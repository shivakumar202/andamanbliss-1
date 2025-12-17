<div class="sticky-top">
    <div class="sticky-top">
        <div class="booking-card" id="booking">
            <div class="booking-container ">
                <div class="booking-header">
                    <div class="booking-title">
                        <i class="fas fa-calendar-check"></i>
                        <h3 class="text-white">Book Your {{$activity->service_name}} Experience</h3>
                    </div>
                    <div class="booking-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>4.9 (120+ Reviews)</span>
                    </div>
                </div>

                <div class="booking-price">
                    <div class="current-price">
                        <div class="price-info">
                            <div class="price-amount">
                                <span class="currency">₹</span>
                                <span class="amount pe-1">{{ number_format($activityPrice, 0) }} </span>
                                <span class="per-person">Per Person</span>
                            </div>
                        </div>

                        @if ($activity->discount > 0)

                        <div class="discount-tag">{{$activity->discount }}% OFF</div>
                        @endif
                    </div>

                    @if ($activity->discount > 0)
                    <div class="original-price">
                        <span class="label">Original Price:</span>
                        <span class="value">₹{{ number_format($activity->adult_cost) }}</span>
                    </div>
                    @endif

                    <div class="limited-offer">
                        <i class="fas fa-bolt"></i>
                        <span>Limited time offer - Book now!</span>
                    </div>
                </div>


                <div class="booking-form">
                    <div class="form-group">
                        <label><i class="far fa-calendar-alt"></i> Select Date</label>
                        <div wire:ignore>
                            <input type="text" id="arrival_date" placeholder="Activity Date" class="" readonly />
                        </div>
                        @error('arrival_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @if(!empty($timeSlots))
                    <div class="form-group">
                        <label><i class="far fa-clock"></i> Select Time Slot</label>
                        <select class="form-select" wire:model="activityTime" required>
                            <option value="">Choose a time slot</option>
                            @foreach($timeSlots as $slot)
                            <option value="{{ $slot['value'] }}">{{ $slot['label'] }}</option>
                            @endforeach
                        </select>
                        @error('activityTime') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group form-group-half">
                            <label class="d-flex  align-items-center"><i class="fas fa-users"></i> <span>No. of
                                    Adult</span><span class="actvi-form-label-adult">(Age:18-45)</span></label>
                            <div class="person-counter">
                                <button type="button" class="counter-btn minus" aria-label="Decrease guest count"
                                    wire:click="decrement('guest')">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" wire:model="guest" min="1" max="10" class="counter-input"
                                    aria-label="Guest count" readonly>
                                <button type="button" class="counter-btn plus" aria-label="Increase guest count"
                                    wire:click="increment('guest')">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group form-group-half">
                            <label class="d-flex align-items-center"><i class="fas fa-users"></i> <span>No. of
                                    Child</span> <span class="actvi-form-label-child">(Age:12-18)</span></label>
                            <div class="person-counter">
                                <button type="button" class="counter-btn minus" aria-label="Decrease child count"
                                    wire:click="decrement('child')">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" wire:model="child" min="0" max="10" class="counter-input"
                                    aria-label="Child count" readonly>
                                <button type="button" class="counter-btn plus" aria-label="Increase child count"
                                    wire:click="increment('child')">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="total-price-section">
                        <span class="total-price-label fs-6 fw-bolder">Total Price</span>
                        <span class="total-price-value " id="totalPriceDisplay">₹{{ number_format($totalCost, 2)
                        }}</span>
                    </div>

                    @if(Auth::check())
                    <button class="booking-submit-btn" wire:click="submitBookingForm">
                        <span style="font-size:14px;">Book Now</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    @else
                    <button type="button" class="booking-submit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal"> <span style="font-size:14px;">Book Now</span>
                        <i class="fas fa-arrow-right"></i></button>
                    @endif

                </div>



                <div class="booking-help">
                    <i class="fas fa-headset"></i>
                    <span>Need help? <a href="#contact">Contact us</a></span>
                </div>
            </div>
        </div>
    </div>

</div>
@push('styles')
<style>
    /* .modal-backdrop {
                --bs-backdrop-zindex: 0 !important;
                --bs-backdrop-bg: #000;
                --bs-backdrop-opacity: 0.5;
                position: fixed;
                top: 0;
                left: 0;
                z-index: var(--bs-backdrop-zindex);
                width: 100vw;
                height: 100vh;
                background-color: var(--bs-backdrop-bg);
            } */
    .modal-backdrop {
        z-index: 1040 !important;
    }

    .modal {
        z-index: 1050 !important;
    }


    @media only screen and (max-width: 600px) and (min-width: 300px) {
        .sticky-top {
            position: sticky;
            top: 72px;
            background-color: #ffffff;
            z-index: 222;
        }
    }
</style>
@endpush
@push('scripts')
<script>
    window.addEventListener('showBookingModal', () => {
        const modal = new bootstrap.Modal(document.getElementById('staticBackdropA'))
        modal.show()
    });

    document.addEventListener('livewire:init', function() {
        function initializeDatepicker() {
            $('#arrival_date').datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0,
                onSelect: function(dateText) {
                    @this.set('arrival_date', dateText);
                },
                beforeShow: function(input, inst) {
                    $('body').addClass('no-scroll');
                },
                onClose: function(dateText, inst) {
                    $('body').removeClass('no-scroll');
                }
            });
        }

        Livewire.on('success', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdropA'));
            if (modal) modal.hide();
        });

        initializeDatepicker();

        Livewire.hook('message.processed', () => {
            $('#arrival_date').datepicker('destroy');
            initializeDatepicker();
        });
    });
</script>
@endpush