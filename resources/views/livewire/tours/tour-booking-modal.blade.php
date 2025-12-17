<div class="sticky-top">
    <div class="pricing-card mt-3" id="sticky-pricing-card">
        <div class="pricing-header">
            <div class="pricing-title">
                <i class="fas fa-tag"></i>
                <span>Pricing Summary</span>
            </div>
            <div class="package-badge">{{$tour->category->name}} Package</div>
        </div>
        <input type="text" name="url" wire:model="url" id="url" class="form-control d-none" readonly>
        <div class="price-summary">
            <div class="base-price">
                <span class="base-price-label">Base Price</span>
                <span class="base-price-value">₹{{$tourPrice}}
                    <small class="text-muted">/per person</small>
                </span>
            </div>
            <p class="price-note">
                <span>Note:</span> Children 12+ years count as adults
            </p>
        </div>

        <div class="guest-control">
            <span class="guest-label">Number of Adults</span>
            <div class="quantity-control">
                <button class="quantity-btn" wire:click="decrement('guest')">-</button>
                <input type="number" class="quantity-input" min="1" wire:model="guest" aria-label="Number of Adults" readonly>
                <button class="quantity-btn" wire:click="increment('guest')">+</button>
            </div>
        </div>

        <div class="guest-control">
            <span class="guest-label">Number of Children</span>
            <div class="quantity-control">
                <button class="quantity-btn" wire:click="decrement('child')">-</button>
                <input type="number" class="quantity-input" min="0" wire:model="child" aria-label="Number of Children" readonly>
                <button class="quantity-btn" wire:click="increment('child')">+</button>
            </div>
        </div>

        <div class="arrival-month-section">
            <div class="arrival-month-label">Select Arrival Date</div>
            <div wire:ignore>
                <input type="text" id="arrival_date" placeholder="Select Arrival Date" wire:model="arrival_date"
                    class="custom-month-select" readonly>
            </div>
            @error('arrival_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <hr class="dashline">
        @if(!empty($addons))
        <div class="addons-section">
            <div class="addons-label">Add Extra Services</div>
            <div class="addons-options">
                @foreach ($addons as $addon)
                <div class="addon-item">
                    <div class="addon-name">{{ $addon->name }} (₹{{ $addon->price }}{{ $addon->unit ? '/' . $addon->unit
                        : '' }})</div>
                    <div class="addon-select-wrapper">
                        <select wire:model="addon_quantities.{{ $addon->id }}" wire:change="calculate"
                            class="addon-select" aria-label="Add-on Quantity for Item 1">
                            <option value="0">Add+</option>
                            @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }} {{ $addon->unit ?? '' }}
                                </option>
                                @endfor
                        </select>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        @endif
        <div class="total-price-section">
            <span class="total-price-label">Total Price</span>
            <span class="total-price-value" id="totalPriceDisplay">₹{{ number_format(@$totalCost, 2) }}</span>
        </div>

        <button class="book-now-btn" wire:click="checkFormThenShowModal">Book Your Package</button>
    </div>

    <div class="modal fade " id="staticBackdropT" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropTLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5 text-white fw-bolder" id="staticBackdropTLabel">Package Enquiry</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid bg-light p-4 carform">
                        <input type="text" name="website" wire:model.defer="website" style="display:none;">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label text-start required">Name</label>
                            <input type="text" name="name" placeholder="Your Name" wire:model="name" id="name"
                                class="form-control" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label text-start">Email ID</label>
                            <input type="text" name="email" placeholder="Your Email" id="email" wire:model="email"
                                class="form-control">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="mobile" class="form-label text-start">Mobile No.</label>
                            <input type="number" name="mobile" placeholder="Your Mobile" id="mobile" wire:model="mobile"
                                class="form-control">
                            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="done">Send Enquiry</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    .modal-backdrop {
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
    }
    .total-price-section > span{
        color:#fff;
    }
</style>
@endpush


@push('scripts')
<script>
    window.addEventListener('showBookingModal', () => {
    const modal = new bootstrap.Modal(document.getElementById('staticBackdropT'))
    modal.show()
})

function openCakePopup(addonId) {
    document.getElementById('cakePopup').style.display = 'block'
}

function closePopup() {
    document.getElementById('cakePopup').style.display = 'none'
}

document.addEventListener('livewire:init', function() {
    function initializeDatepicker() {
        $('#arrival_date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true,
            startDate: '0d'
        }).on('changeDate', function(e) {
            @this.set('arrival_date', e.format())
        })
    }
    Livewire.on('success', (message) => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdropT'));
        if (modal) {
            modal.hide();
        }
    });

    initializeDatepicker()

    Livewire.hook('message.processed', function() {
        initializeDatepicker()
    })
})
</script>
@endpush