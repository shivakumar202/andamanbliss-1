@extends('layouts.app')
@section('title', 'Make Your Own Trip - Custom Itinerary Planner')
@section('description', 'Create your personalized Andaman trip with our custom itinerary planner. Choose your travel
duration, companions, budget, and activities to design your perfect vacation.')

@section('content')
<section class="custom-trip-section py-5">
    <div class="container">
        <div class="trip-header text-center mb-5">
            <div class="trip-header-content mt-3">
                <span class="pre-title">Custom Trip Planner</span>
                <h2 class="main-title">Make Your Own Trip</h2>
                <div class="title-separator">
                    <span class="separator-icon"><i class="fas fa-route"></i></span>
                </div>
                <p class="subtitle">Design your perfect Andaman adventure by creating a personalized itinerary</p>
            </div>
            <!-- Decorative Elements -->
            <div class="decorative-elements">
                <div class="decoration circle-1"></div>
                <div class="decoration circle-2"></div>
                <div class="decoration square-1"></div>
                <div class="decoration triangle-1"></div>
                <div class="decoration dots-1"></div>
                <div class="decoration dots-2"></div>
            </div>
        </div>

        <div class="booking-form-container">
            <!-- Flash Messages -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form id="makeYourTripForm" action="{{ route('custom-trip.submit') }}" method="POST">
                @csrf
                <!-- Travel Duration Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>How long would you like to travel?</h3>
                    </div>
                    <div class="duration-cards">
                        <label class="duration-card">
                            <input type="radio" name="duration" value="3-4" checked>
                            <div class="card-content">
                                <div class="duration-days">3-4 Days</div>
                                <div class="duration-type">Short Trip</div>
                                <div class="check-icon"><i class="fas fa-check"></i></div>
                            </div>
                        </label>
                        <label class="duration-card">
                            <input type="radio" name="duration" value="5-7">
                            <div class="card-content">
                                <div class="duration-days">5-7 Days</div>
                                <div class="duration-type">Standard Trip</div>
                                <div class="check-icon"><i class="fas fa-check"></i></div>
                            </div>
                        </label>
                        <label class="duration-card">
                            <input type="radio" name="duration" value="8-10">
                            <div class="card-content">
                                <div class="duration-days">8-10 Days</div>
                                <div class="duration-type">Extended Trip</div>
                                <div class="check-icon"><i class="fas fa-check"></i></div>
                            </div>
                        </label>
                        <label class="duration-card">
                            <input type="radio" name="duration" value="10+">
                            <div class="card-content">
                                <div class="duration-days">10+ Days</div>
                                <div class="duration-type">Long Trip</div>
                                <div class="check-icon"><i class="fas fa-check"></i></div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>Travel Date?</h3>
                    </div>
                    <div class="col-12">
                        <input type="date" name="travel_date" class="form-control" value="3-4" checked>


                    </div>
                </div>
                <input type="text" wire:model.defer="website" name="website" class="hidden" tabindex="-1"
                    autocomplete="off" hidden>
                <!-- Travelers Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-users"></i>
                        <h3>Who's traveling with you?</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 mb-3">
                            <div class="traveler-counter">
                                <div class="traveler-info">
                                    <div class="traveler-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="traveler-type">
                                        <h4>Adults</h4>
                                        <p>Age 12+</p>
                                    </div>
                                </div>
                                <div class="counter-controls">
                                    <button type="button" class="counter-btn minus" data-field="adults">-</button>
                                    <input type="text" class="counter-input" name="adults" value="2" readonly>
                                    <button type="button" class="counter-btn plus" data-field="adults">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="traveler-counter">
                                <div class="traveler-info">
                                    <div class="traveler-icon">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="traveler-type">
                                        <h4>Children</h4>
                                        <p>Age 2-11</p>
                                    </div>
                                </div>
                                <div class="counter-controls">
                                    <button type="button" class="counter-btn minus" data-field="children">-</button>
                                    <input type="text" class="counter-input" name="children" value="0" readonly>
                                    <button type="button" class="counter-btn plus" data-field="children">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="traveler-counter">
                                <div class="traveler-info">
                                    <div class="traveler-icon">
                                        <i class="fas fa-baby"></i>
                                    </div>
                                    <div class="traveler-type">
                                        <h4>Infants</h4>
                                        <p>Under 2</p>
                                    </div>
                                </div>
                                <div class="counter-controls">
                                    <button type="button" class="counter-btn minus" data-field="infants">-</button>
                                    <input type="text" class="counter-input" name="infants" value="0" readonly>
                                    <button type="button" class="counter-btn plus" data-field="infants">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Budget Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-rupee-sign"></i>
                        <h3>What's your budget?</h3>
                    </div>
                    <div class="budget-filter-card mt-3">
                        <div class="price-range-header">
                            <div class="price-range-title">Budget per person</div>
                            <div class="price-range-values">
                                <span class="price-value-display">₹<span id="minPrice">10,000</span> - ₹<span
                                        id="maxPrice">50,000</span></span>
                            </div>
                        </div>
                        <div class="price-range-slider">
                            <div class="price-range-track">
                                <div class="price-range-progress" id="priceRangeProgress"></div>
                            </div>
                            <div class="price-range-handles">
                                <div class="handle-min" id="handleMin"></div>
                                <div class="handle-max" id="handleMax"></div>
                            </div>
                            <div class="price-range-input">
                                <input type="range" id="priceRangeMin" name="min_price" min="5000" max="100000"
                                    step="1000" value="10000">
                                <input type="range" id="priceRangeMax" name="max_price" min="5000" max="100000"
                                    step="1000" value="50000">
                            </div>
                        </div>
                        <div class="price-range-markers">
                            <div class="marker-min">₹5,000</div>
                            <div class="marker-mid">₹50,000</div>
                            <div class="marker-max">₹100,000+</div>
                        </div>
                    </div>
                </div>

                <!-- Flight Tickets Option -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-plane"></i>
                        <h3>Flight Tickets Option</h3>
                    </div>
                    <p class="mb-3">Let us know if you need assistance with flight bookings</p>
                    <div class="flight-options-container">
                        <label class="flight-option-card" for="flight-option-have">
                            <input type="radio" name="flight_option" id="flight-option-have" value="have_tickets"
                                checked>
                            <div class="flight-option-content">
                                <div class="flight-option-icon">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <div class="flight-option-text">
                                    <h4>I already have flight tickets</h4>
                                    <p>You've arranged your own transportation</p>
                                </div>
                                <div class="flight-option-check">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                        </label>
                        <label class="flight-option-card" for="flight-option-need">
                            <input type="radio" name="flight_option" id="flight-option-need" value="need_tickets">
                            <div class="flight-option-content">
                                <div class="flight-option-icon flight-icon-blue">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <div class="flight-option-text">
                                    <h4>I need flight tickets</h4>
                                    <p>We'll help book your flights</p>
                                </div>
                                <div class="flight-option-check">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Trip Type Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-map-marked-alt"></i>
                        <h3>What type of trip are you planning?</h3>
                    </div>
                    <div class="trip-type-grid mt-3">
                        <div class="trip-type-card" data-type="family">
                            <input type="radio" name="trip_type" value="family" id="family" class="trip-type-input"
                                checked>
                            <label for="family" class="trip-type-label">
                                <div class="card-gradient"></div>
                                <div class="trip-type-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="trip-type-content">
                                    <h4 class="trip-type-name">Family</h4>
                                    <p class="trip-type-desc">Fun for all ages</p>
                                </div>
                                <div class="trip-type-check"><i class="fas fa-check"></i></div>
                            </label>
                        </div>
                        <div class="trip-type-card" data-type="honeymoon">
                            <input type="radio" name="trip_type" value="honeymoon" id="honeymoon"
                                class="trip-type-input">
                            <label for="honeymoon" class="trip-type-label">
                                <div class="card-gradient"></div>
                                <div class="trip-type-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="trip-type-content">
                                    <h4 class="trip-type-name">Honeymoon</h4>
                                    <p class="trip-type-desc">Romantic getaway</p>
                                </div>
                                <div class="trip-type-check"><i class="fas fa-check"></i></div>
                            </label>
                        </div>
                        <div class="trip-type-card" data-type="friends">
                            <input type="radio" name="trip_type" value="friends" id="friends" class="trip-type-input">
                            <label for="friends" class="trip-type-label">
                                <div class="card-gradient"></div>
                                <div class="trip-type-icon">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <div class="trip-type-content">
                                    <h4 class="trip-type-name">Friends</h4>
                                    <p class="trip-type-desc">Group adventure</p>
                                </div>
                                <div class="trip-type-check"><i class="fas fa-check"></i></div>
                            </label>
                        </div>
                        <div class="trip-type-card" data-type="solo">
                            <input type="radio" name="trip_type" value="solo" id="solo" class="trip-type-input">
                            <label for="solo" class="trip-type-label">
                                <div class="card-gradient"></div>
                                <div class="trip-type-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="trip-type-content">
                                    <h4 class="trip-type-name">Solo</h4>
                                    <p class="trip-type-desc">Travel alone</p>
                                </div>
                                <div class="trip-type-check"><i class="fas fa-check"></i></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Itinerary Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-clipboard-list"></i>
                        <h3>Create Your Itinerary</h3>
                    </div>
                    <div class="itinerary-container mt-3">
                        <div id="itinerary-items">
                            <div class="itinerary-item">
                                <div class="itinerary-day">
                                    <span class="day-number">Day 1</span>
                                </div>
                                <div class="itinerary-content">
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-2 location-autocomplete"
                                            name="itinerary[0][location]"
                                            placeholder="Enter location (e.g., Port Blair, Carbi Beach)">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="itinerary[0][activities]" rows="2"
                                            placeholder="Activities you'd like to do"></textarea>
                                    </div>
                                </div>
                                <div class="itinerary-actions">
                                    <button type="button" class="remove-day" disabled><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="add-day-container text-center mt-3">
                            <button type="button" id="add-day" class="btn btn-outline-primary">
                                <i class="fas fa-plus"></i> Add Another Day
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hotel Selection Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-hotel"></i>
                        <h3>Hotel Preferences</h3>
                    </div>
                    <div class="hotel-container mt-3">
                        <div id="hotel-items">
                            <div class="hotel-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select class="form-control hotel-location" name="hotel[0][location]">
                                                <option value="">Select location</option>
                                                <option value="Port Blair">Port Blair</option>
                                                <option value="Havelock">Havelock (Swaraj Dweep)</option>
                                                <option value="Neil Island">Neil Island (Shaheed Dweep)</option>
                                                <option value="Diglipur">Diglipur</option>
                                                <option value="Mayabunder">Mayabunder</option>
                                                <option value="Rangat">Rangat</option>
                                                <option value="Little Andaman">Little Andaman</option>
                                                <option value="Long Island">Long Island</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="hotel[0][category]">
                                                <option value="">Select category</option>
                                                <option value="Luxury">Luxury (5 Star)</option>
                                                <option value="Premium">Premium (4 Star)</option>
                                                <option value="Super Deluxe">Super Deluxe (3 Star)</option>
                                                <option value="Deluxe">Deluxe</option>
                                                <option value="Standard">Standard</option>
                                                <option value="Budget">Budget</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Number of Nights</label>
                                            <input type="number" class="form-control hotel-nights"
                                                name="hotel[0][nights]" min="1" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label> </label>
                                            <button type="button"
                                                class="remove-hotel form-control" disabled><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Special Requests (Optional)</label>
                                            <textarea class="form-control" name="hotel[0][requests]" rows="2"
                                                placeholder="Any specific hotel preferences or requirements"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-hotel-container text-center mt-3">
                            <button type="button" id="add-hotel" class="btn btn-outline-primary">
                                <i class="fas fa-plus"></i> Add Another Hotel
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Ferry Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-ship"></i>
                        <h3>Ferry Requirements</h3>
                    </div>
                    <div class="ferry-container mt-3">
                        <div id="ferry-items">
                            <div class="ferry-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <select class="form-control" name="ferry[0][from]">
                                                <option value="">Select departure port</option>
                                                <option value="Port Blair">Port Blair</option>
                                                <option value="Havelock">Havelock (Swaraj Dweep)</option>
                                                <option value="Neil Island">Neil Island (Shaheed Dweep)</option>
                                                <option value="Long Island">Long Island</option>
                                                <option value="Baratang">Baratang</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>To</label>
                                            <select class="form-control" name="ferry[0][to]">
                                                <option value="">Select arrival port</option>
                                                <option value="Port Blair">Port Blair</option>
                                                <option value="Havelock">Havelock (Swaraj Dweep)</option>
                                                <option value="Neil Island">Neil Island (Shaheed Dweep)</option>
                                                <option value="Long Island">Long Island</option>
                                                <option value="Baratang">Baratang</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label> </label>
                                            <button type="button"
                                                class=" remove-ferry form-control" disabled><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-ferry-container text-center mt-3">
                            <button type="button" id="add-ferry" class="btn btn-outline-primary">
                                <i class="fas fa-plus"></i> Add Another Ferry
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-user"></i>
                        <h3>Personal Information</h3>
                    </div>
                    <div class="personal-info-grid mt-3">
                        <div class="info-input-container">
                            <div class="input-icon-wrapper">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" class="info-input" name="name" placeholder="Full Name" required>
                            </div>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="info-input-container">
                            <div class="input-icon-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="info-input" name="email" placeholder="Email Address"
                                    required>
                            </div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="info-input-container">
                            <div class="input-icon-wrapper">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="tel" class="info-input" name="phone" placeholder="Phone Number" required>
                            </div>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="message-container mt-3">
                        <div class="textarea-wrapper">
                            <i class="fas fa-comment input-icon"></i>
                            <textarea class="info-textarea" name="special_requests"
                                placeholder="Any special requests or additional information?"></textarea>
                        </div>
                    </div>
                    <div class="submit-container mt-4">
                        <button type="submit" class="submit-button">
                            <i class="fas fa-paper-plane"></i> Submit Your Trip Plan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Variables to track maximum days based on selected duration
    let maxDays = 4; // Default for 3-4 days
    let selectedDuration = '3-4';

    // Duration radio buttons
    const durationRadios = document.querySelectorAll('input[name="duration"]');
    durationRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            selectedDuration = this.value;

            // Set max days based on selected duration
            switch (selectedDuration) {
                case '3-4':
                    maxDays = 4;
                    break;
                case '5-7':
                    maxDays = 7;
                    break;
                case '8-10':
                    maxDays = 10;
                    break;
                case '10+':
                    maxDays = 15; // Allow up to 15 days for 10+ option
                    break;
            }

            // Check if current days exceed the new max
            const currentDays = document.querySelectorAll('.itinerary-item').length;
            if (currentDays > maxDays) {
                // Remove excess days
                const daysToRemove = currentDays - maxDays;
                const days = document.querySelectorAll('.itinerary-item');

                for (let i = 0; i < daysToRemove; i++) {
                    days[days.length - 1 - i].remove();
                }

                // Update day counter and reorder days
                dayCounter = maxDays;
                reorderDays();

                alert(
                    `Your selected duration allows a maximum of ${maxDays} days in your itinerary. We've adjusted your itinerary accordingly.`
                );
            }

            // Update add day button state
            updateAddDayButtonState();
        });
    });

    // Function to update add day button state
    function updateAddDayButtonState() {
        const currentDays = document.querySelectorAll('.itinerary-item').length;
        addDayBtn.disabled = currentDays >= maxDays;

        if (currentDays >= maxDays) {
            addDayBtn.classList.add('disabled');
            addDayBtn.title = `Maximum ${maxDays} days allowed for selected duration`;
        } else {
            addDayBtn.classList.remove('disabled');
            addDayBtn.title = '';
        }
    }

    // Counter functionality for travelers
    const counterBtns = document.querySelectorAll('.counter-btn');
    counterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const field = this.dataset.field;
            const input = document.querySelector(`input[name="${field}"]`);
            const valueDisplay = this.parentElement.querySelector('.counter-value') || this
                .parentElement.querySelector('.counter-input');
            let value = parseInt(input.value);

            if (this.classList.contains('plus')) {
                value++;
            } else if (this.classList.contains('minus') && value > 0) {
                value--;
            }

            input.value = value;
            valueDisplay.textContent = value;
            valueDisplay.value = value;

            // Disable minus button if value is 0
            const minusBtn = this.parentElement.querySelector('.minus');
            if (minusBtn) {
                minusBtn.disabled = value === 0;
            }
        });
    });

    // Price range slider functionality
    const minPriceInput = document.getElementById('priceRangeMin');
    const maxPriceInput = document.getElementById('priceRangeMax');
    const minPriceDisplay = document.getElementById('minPrice');
    const maxPriceDisplay = document.getElementById('maxPrice');
    const priceRangeProgress = document.getElementById('priceRangeProgress');
    const handleMin = document.getElementById('handleMin');
    const handleMax = document.getElementById('handleMax');

    function updatePriceRange() {
        const minVal = parseInt(minPriceInput.value);
        const maxVal = parseInt(maxPriceInput.value);

        // Ensure min doesn't exceed max
        if (minVal > maxVal) {
            minPriceInput.value = maxVal;
            return;
        }

        // Update display values
        minPriceDisplay.textContent = minVal.toLocaleString();
        maxPriceDisplay.textContent = maxVal.toLocaleString();

        // Calculate percentages for visual elements
        const minPercent = ((minVal - minPriceInput.min) / (minPriceInput.max - minPriceInput.min)) * 100;
        const maxPercent = ((maxVal - minPriceInput.min) / (minPriceInput.max - minPriceInput.min)) * 100;

        // Update progress bar and handles
        priceRangeProgress.style.left = minPercent + '%';
        priceRangeProgress.style.right = (100 - maxPercent) + '%';
        handleMin.style.left = minPercent + '%';
        handleMax.style.left = maxPercent + '%';
    }

    minPriceInput.addEventListener('input', updatePriceRange);
    maxPriceInput.addEventListener('input', updatePriceRange);

    // Initialize price range
    updatePriceRange();

    // Itinerary day functionality
    const addDayBtn = document.getElementById('add-day');
    const itineraryItems = document.getElementById('itinerary-items');
    let dayCounter = 1;

    addDayBtn.addEventListener('click', function() {
        // Check if we've reached the maximum days
        if (dayCounter >= maxDays) {
            alert(`You can add a maximum of ${maxDays} days for your selected trip duration.`);
            return;
        }

        dayCounter++;

        const newDay = document.createElement('div');
        newDay.className = 'itinerary-item';
        newDay.innerHTML = `
            <div class="itinerary-day">
                <span class="day-number">Day ${dayCounter}</span>
            </div>
            <div class="itinerary-content">
                <div class="form-group">
                    <input type="text" class="form-control mb-2" name="itinerary[${dayCounter-1}][location]" placeholder="Location (e.g., Port Blair, Havelock Island)">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="itinerary[${dayCounter-1}][activities]" rows="2" placeholder="Activities you'd like to do"></textarea>
                </div>
            </div>
            <div class="itinerary-actions">
                <button type="button" class="btn btn-sm btn-danger remove-day"><i class="fas fa-trash"></i></button>
            </div>
        `;

        itineraryItems.appendChild(newDay);

        // Enable remove button on first day if we have more than one day
        if (dayCounter === 2) {
            const firstDayRemoveBtn = itineraryItems.querySelector('.remove-day');
            if (firstDayRemoveBtn) {
                firstDayRemoveBtn.disabled = false;
            }
        }

        // Add event listener to new remove button
        const removeBtn = newDay.querySelector('.remove-day');
        removeBtn.addEventListener('click', function() {
            newDay.remove();
            reorderDays();
            updateAddDayButtonState();
        });
    });

    // Function to reorder days after removal
    function reorderDays() {
        const days = itineraryItems.querySelectorAll('.itinerary-item');
        dayCounter = days.length;

        days.forEach((day, index) => {
            const dayNumber = day.querySelector('.day-number');
            dayNumber.textContent = `Day ${index + 1}`;

            // Update input names
            const locationInput = day.querySelector('input[name^="itinerary"]');
            const activitiesInput = day.querySelector('textarea[name^="itinerary"]');

            locationInput.name = `itinerary[${index}][location]`;
            activitiesInput.name = `itinerary[${index}][activities]`;

            // Disable remove button on the last day if only one remains
            const removeBtn = day.querySelector('.remove-day');
            removeBtn.disabled = days.length === 1;
        });
    }

    // Add event listener to existing remove buttons
    document.querySelectorAll('.remove-day').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.itinerary-item').remove();
            reorderDays();
            updateAddDayButtonState();
        });
    });

    // Hotel functionality
    const addHotelBtn = document.getElementById('add-hotel');
    const hotelItems = document.getElementById('hotel-items');
    let hotelCounter = 1;

    addHotelBtn.addEventListener('click', function() {
        const newHotel = document.createElement('div');
        newHotel.className = 'hotel-item';
        newHotel.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-control hotel-location" name="hotel[${hotelCounter}][location]">
                            <option value="">Select location</option>
                            <option value="Port Blair">Port Blair</option>
                            <option value="Havelock">Havelock (Swaraj Dweep)</option>
                            <option value="Neil Island">Neil Island (Shaheed Dweep)</option>
                            <option value="Diglipur">Diglipur</option>
                            <option value="Mayabunder">Mayabunder</option>
                            <option value="Rangat">Rangat</option>
                            <option value="Little Andaman">Little Andaman</option>
                            <option value="Long Island">Long Island</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="hotel[${hotelCounter}][category]">
                            <option value="">Select category</option>
                            <option value="Luxury">Luxury (5 Star)</option>
                            <option value="Premium">Premium (4 Star)</option>
                            <option value="Super Deluxe">Super Deluxe (3 Star)</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Standard">Standard</option>
                            <option value="Budget">Budget</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Number of Nights</label>
                        <input type="number" class="form-control hotel-nights" name="hotel[${hotelCounter}][nights]" min="1" value="1">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-sm btn-danger remove-hotel form-control"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Special Requests (Optional)</label>
                        <textarea class="form-control" name="hotel[${hotelCounter}][requests]" rows="2" placeholder="Any specific hotel preferences or requirements"></textarea>
                    </div>
                </div>
            </div>
        `;

        hotelItems.appendChild(newHotel);
        hotelCounter++;

        // Enable remove button on first hotel if we have more than one
        if (hotelCounter === 2) {
            const firstHotelRemoveBtn = hotelItems.querySelector('.remove-hotel');
            if (firstHotelRemoveBtn) {
                firstHotelRemoveBtn.disabled = false;
            }
        }

        // Add event listener to new remove button
        const removeBtn = newHotel.querySelector('.remove-hotel');
        removeBtn.addEventListener('click', function() {
            newHotel.remove();
            reorderHotels();
        });
    });

    // Function to reorder hotels after removal
    function reorderHotels() {
        const hotels = hotelItems.querySelectorAll('.hotel-item');
        hotelCounter = hotels.length;

        hotels.forEach((hotel, index) => {
            // Update input names
            const locationSelect = hotel.querySelector('select.hotel-location');
            const categorySelect = hotel.querySelector('select[name^="hotel"][name$="[category]"]');
            const nightsInput = hotel.querySelector('input.hotel-nights');
            const requestsTextarea = hotel.querySelector('textarea[name^="hotel"][name$="[requests]"]');

            locationSelect.name = `hotel[${index}][location]`;
            categorySelect.name = `hotel[${index}][category]`;
            nightsInput.name = `hotel[${index}][nights]`;
            requestsTextarea.name = `hotel[${index}][requests]`;

            // Disable remove button on the last hotel if only one remains
            const removeBtn = hotel.querySelector('.remove-hotel');
            removeBtn.disabled = hotels.length === 1;
        });
    }

    // Add event listener to existing remove buttons
    document.querySelectorAll('.remove-hotel').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.hotel-item').remove();
            reorderHotels();
        });
    });

    // Ferry functionality
    const addFerryBtn = document.getElementById('add-ferry');
    const ferryItems = document.getElementById('ferry-items');
    let ferryCounter = 1;

    addFerryBtn.addEventListener('click', function() {
        const newFerry = document.createElement('div');
        newFerry.className = 'ferry-item';
        newFerry.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>From</label>
                        <select class="form-control" name="ferry[${ferryCounter}][from]">
                            <option value="">Select departure port</option>
                            <option value="Port Blair">Port Blair</option>
                            <option value="Havelock">Havelock (Swaraj Dweep)</option>
                            <option value="Neil Island">Neil Island (Shaheed Dweep)</option>
                            <option value="Long Island">Long Island</option>
                            <option value="Baratang">Baratang</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>To</label>
                        <select class="form-control" name="ferry[${ferryCounter}][to]">
                            <option value="">Select arrival port</option>
                            <option value="Port Blair">Port Blair</option>
                            <option value="Havelock">Havelock (Swaraj Dweep)</option>
                            <option value="Neil Island">Neil Island (Shaheed Dweep)</option>
                            <option value="Long Island">Long Island</option>
                            <option value="Baratang">Baratang</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-sm btn-danger remove-ferry form-control"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        `;

        ferryItems.appendChild(newFerry);
        ferryCounter++;

        // Enable remove button on first ferry if we have more than one
        if (ferryCounter === 2) {
            const firstFerryRemoveBtn = ferryItems.querySelector('.remove-ferry');
            if (firstFerryRemoveBtn) {
                firstFerryRemoveBtn.disabled = false;
            }
        }

        // Add event listener to new remove button
        const removeBtn = newFerry.querySelector('.remove-ferry');
        removeBtn.addEventListener('click', function() {
            newFerry.remove();
            reorderFerries();
        });
    });

    // Function to reorder ferries after removal
    function reorderFerries() {
        const ferries = ferryItems.querySelectorAll('.ferry-item');
        ferryCounter = ferries.length;

        ferries.forEach((ferry, index) => {
            // Update select names
            const fromSelect = ferry.querySelector('select[name^="ferry"][name$="[from]"]');
            const toSelect = ferry.querySelector('select[name^="ferry"][name$="[to]"]');

            fromSelect.name = `ferry[${index}][from]`;
            toSelect.name = `ferry[${index}][to]`;

            // Disable remove button on the last ferry if only one remains
            const removeBtn = ferry.querySelector('.remove-ferry');
            removeBtn.disabled = ferries.length === 1;
        });
    }

    // Add event listener to existing remove buttons
    document.querySelectorAll('.remove-ferry').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.ferry-item').remove();
            reorderFerries();
        });
    });

    // Initialize the add day button state
    updateAddDayButtonState();

    // Form submission
  
});
</script>
@endpush

@push('styles')
<style type="text/css">
    /* Main container styles */
    .custom-trip-section {
        background-color: #f8f9fa;
        padding: 30px 0;
        position: relative;
        overflow: hidden;
    }

    .custom-trip-section::before {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://img.freepik.com/free-vector/abstract-wavy-background_1393-316.jpg?w=1380&t=st=1724150844~exp=1724151444~hmac=9dcb0eccd60be0b8dfabe49c68ead2df05e1ebe4cda43fd79e69e94478e7f30e');
        background-size: cover;
        background-position: center;
        opacity: 0.07;
        z-index: 0;
    }

    .trip-header {
        max-width: 600px;
        margin: 0 auto 20px;
        position: relative;
        z-index: 1;
    }

    .trip-header-content {
        position: relative;
        z-index: 1;
        padding: 20px 0;
    }

    .pre-title {
        display: inline-block;
        background: linear-gradient(135deg, rgb(17, 157, 213) 0%, #1fabff 100%);
        color: white;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 30px;
        margin-bottom: 15px;
        box-shadow: 0 4px 12px rgba(17, 157, 213, 0.2);
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .main-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #333 30%, #111 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
    }

    .title-separator {
        position: relative;
        height: 30px;
        width: 100%;
        max-width: 120px;
        margin: 0 auto 25px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .title-separator::before,
    .title-separator::after {
        content: "";
        height: 2px;
        width: 40%;
        background: rgb(17, 157, 213);
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .title-separator::before {
        left: 0;
    }

    .title-separator::after {
        right: 0;
    }

    .separator-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #F44336 0%, #FF9800 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        box-shadow: 0 5px 15px rgba(17, 157, 213, 0.3);
        animation: float 3s ease-in-out infinite;
        z-index: 2;
    }

    .separator-icon i {
        font-size: 16px;
    }

    .subtitle {
        font-size: 1.25rem;
        color: #555;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Decorative Elements */
    .decorative-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }

    .decoration {
        position: absolute;
        opacity: 0.6;
    }

    .circle-1 {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 4px solid rgb(17, 157, 213);
        top: 10%;
        left: 15%;
        animation: float-slow 8s ease-in-out infinite;
    }

    .circle-2 {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(17, 157, 213, 0.1);
        border: 3px solid rgba(17, 157, 213, 0.3);
        bottom: 15%;
        right: 10%;
        animation: float-slow 6s ease-in-out infinite 1s;
    }

    .square-1 {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(17, 157, 213, 0.4);
        transform: rotate(45deg);
        top: 20%;
        right: 20%;
        animation: rotate-slow 15s linear infinite;
    }

    .triangle-1 {
        width: 0;
        height: 0;
        border-left: 25px solid transparent;
        border-right: 25px solid transparent;
        border-bottom: 40px solid rgba(17, 157, 213, 0.15);
        bottom: 20%;
        left: 20%;
        animation: float-slow 7s ease-in-out infinite 0.5s;
    }

    .dots-1,
    .dots-2 {
        width: 120px;
        height: 120px;
        background-image: radial-gradient(rgb(17, 157, 213) 2px, transparent 2px);
        background-size: 15px 15px;
        opacity: 0.2;
    }

    .dots-1 {
        top: 15%;
        right: 5%;
        animation: rotate-slow 30s linear infinite;
    }

    .dots-2 {
        bottom: 10%;
        left: 5%;
        animation: rotate-slow 25s linear infinite reverse;
    }

    @keyframes rotate-slow {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes float-slow {
        0% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-15px) rotate(5deg);
        }

        100% {
            transform: translateY(0) rotate(0deg);
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-7px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .booking-form-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .form-section {
        margin-bottom: 25px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
        position: relative;
        z-index: 1;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f0f0;
    }

    .section-header i {
        font-size: 18px;
        margin-right: 10px;
        color: rgb(17, 157, 213);
        width: 32px;
        height: 32px;
        background: rgba(17, 157, 213, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-header h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: #333;
    }

    /* Duration cards */
    .duration-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .duration-card {
        position: relative;
        flex: 1;
        min-width: 120px;
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid #e0e0e0;
        overflow: hidden;
    }

    .duration-card:hover {
        border-color: #ccc;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .duration-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .duration-card input[type="radio"]:checked+.card-content {
        color: rgb(17, 157, 213);
    }

    .duration-card input[type="radio"]:checked+.card-content .check-icon {
        opacity: 1;
        transform: scale(1);
    }

    .duration-card input[type="radio"]:checked+.card-content:before {
        opacity: 1;
    }

    .card-content {
        position: relative;
        z-index: 1;
    }

    .card-content:before {
        content: '';
        position: absolute;
        top: -15px;
        left: -15px;
        right: -15px;
        bottom: -15px;
        border: 2px solid rgb(17, 157, 213);
        border-radius: 8px;
        opacity: 0;
        transition: opacity 0.2s ease;
        z-index: -1;
    }

    .duration-days {
        font-size: 12px;
        font-weight: 500;
        color: #666;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .duration-type {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 0;
    }

    .check-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 18px;
        height: 18px;
        background: rgb(17, 157, 213);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transform: scale(0);
        transition: all 0.2s ease;
    }

    .check-icon i {
        font-size: 10px;
    }

    /* Traveler counter styles */
    .traveler-counter {
        display: flex;
        flex-direction: column;
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        height: 100%;
        border: 1px solid #eee;
    }

    .traveler-info {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .traveler-icon {
        width: 36px;
        height: 36px;
        background: rgba(17, 157, 213, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }

    .traveler-icon i {
        color: rgb(17, 157, 213);
        font-size: 16px;
    }

    .traveler-type h4 {
        font-size: 16px;
        margin: 0 0 2px;
        color: #333;
    }

    .traveler-type p {
        font-size: 12px;
        margin: 0;
        color: #666;
    }

    .counter-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
        background: #f9f9f9;
        border-radius: 6px;
        padding: 8px;
    }

    .counter-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .counter-btn.minus {
        background: #f0f0f0;
        color: #666;
    }

    .counter-btn.plus {
        background: rgb(17, 157, 213);
        color: white;
    }

    .counter-btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .counter-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .counter-input {
        width: 40px;
        text-align: center;
        border: none;
        font-size: 18px;
        font-weight: 600;
        color: #333;
        background: transparent;
    }

    /* Budget filter styles */
    .budget-filter-card {
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .price-range-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .price-range-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .price-range-values {
        background: rgb(17, 157, 213, 0.1);
        padding: 8px 15px;
        border-radius: 20px;
    }

    .price-value-display {
        font-size: 15px;
        font-weight: 600;
        color: rgb(17, 157, 213);
    }

    .price-range-slider {
        position: relative;
        height: 50px;
        margin-bottom: 15px;
    }

    .price-range-track {
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 6px;
        background: #e0e0e0;
        border-radius: 3px;
    }

    .price-range-progress {
        position: absolute;
        height: 100%;
        left: 0%;
        right: 54.3%;
        background: rgb(17, 157, 213);
        border-radius: 3px;
    }

    .price-range-handles {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        pointer-events: none;
    }

    .handle-min,
    .handle-max {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 22px;
        height: 22px;
        background: #fff;
        border: 2px solid rgb(17, 157, 213);
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        pointer-events: none;
    }

    .handle-min {
        left: 0%;
    }

    .handle-max {
        left: 45.7%;
    }

    .price-range-input {
        position: relative;
        height: 100%;
    }

    .price-range-input input {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        background: none;
        pointer-events: auto;
        -webkit-appearance: none;
        appearance: none;
        opacity: 0;
        z-index: 5;
        cursor: pointer;
    }

    .price-range-markers {
        display: flex;
        justify-content: space-between;
        padding: 0 2px;
    }

    .marker-min,
    .marker-mid,
    .marker-max {
        font-size: 12px;
        color: #666;
    }

    /* Flight Tickets Option Styling */
    .flight-options-container {
        display: flex;
        gap: 20px;
        margin-top: 15px;
    }

    .flight-option-card {
        flex: 1;
        position: relative;
        cursor: pointer;
        margin-bottom: 0;
    }

    .flight-option-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .flight-option-content {
        display: flex;
        align-items: center;
        padding: 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
        border: 2px solid #eee;
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .flight-option-card input[type="radio"]:checked+.flight-option-content {
        border-color: #3498db;
        background-color: #f0f8ff;
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.1);
    }

    .flight-option-icon {
        width: 50px;
        height: 50px;
        background-color: #ffe9e3;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .flight-option-icon i {
        font-size: 22px;
        color: #ff6b4a;
    }

    .flight-icon-blue {
        background-color: #e3f2ff;
    }

    .flight-icon-blue i {
        color: #3498db;
    }

    .flight-option-text {
        flex-grow: 1;
    }

    .flight-option-text h4 {
        font-size: 16px;
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }

    .flight-option-text p {
        font-size: 13px;
        color: #777;
        margin-bottom: 0;
    }

    .flight-option-check {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: #3498db;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
    }

    .flight-option-check i {
        font-size: 12px;
    }

    .flight-option-card input[type="radio"]:checked+.flight-option-content .flight-option-check {
        opacity: 1;
        transform: scale(1);
    }
    .remove-day,.remove-hotel,.remove-ferry{
        border:none;
        background:transparent;
    }
    .remove-day,.remove-hotel,.remove-ferry i{
        color:red;
    }

    @media (max-width: 767px) {
        .flight-options-container {
            flex-direction: column;
        }
    }

    /* Trip Type Section Styling */
    .trip-type-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 15px;
    }

    .trip-type-card {
        position: relative;
        transition: all 0.3s ease;
    }

    .trip-type-input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .trip-type-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: #fff;
        border-radius: 12px;
        padding: 25px 15px;
        height: 100%;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 0;
    }

    .trip-type-card[data-type="honeymoon"] .card-gradient {
        background: linear-gradient(135deg, #ff6b6b 0%, #cc3e76 100%);
    }

    .trip-type-card[data-type="family"] .card-gradient {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .trip-type-card[data-type="friends"] .card-gradient {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .trip-type-card[data-type="solo"] .card-gradient {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .trip-type-icon {
        width: 60px;
        height: 60px;
        background-color: rgba(17, 157, 213, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .trip-type-icon i {
        font-size: 24px;
        color: rgb(17, 157, 213);
        transition: all 0.3s ease;
    }

    .trip-type-content {
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .trip-type-name {
        font-size: 16px;
        font-weight: 600;
        margin: 0 0 5px;
        color: #333;
        transition: color 0.3s ease;
    }

    .trip-type-desc {
        font-size: 12px;
        color: #666;
        margin: 0;
        transition: color 0.3s ease;
    }

    .trip-type-check {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 22px;
        height: 22px;
        background: rgb(17, 157, 213);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
        z-index: 1;
    }

    .trip-type-check i {
        font-size: 12px;
    }

    /* Hover Effects */
    .trip-type-card:hover .trip-type-label {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .trip-type-card:hover .card-gradient {
        opacity: 0.05;
    }

    /* Selected State */
    .trip-type-input:checked+.trip-type-label {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        border-color: rgb(17, 157, 213);
    }

    .trip-type-input:checked+.trip-type-label .card-gradient {
        opacity: 0.15;
    }

    .trip-type-input:checked+.trip-type-label .trip-type-icon {
        background-color: rgb(17, 157, 213);
    }

    .trip-type-input:checked+.trip-type-label .trip-type-icon i {
        color: white;
    }

    .trip-type-input:checked+.trip-type-label .trip-type-name {
        color: rgb(17, 157, 213);
    }

    .trip-type-input:checked+.trip-type-label .trip-type-check {
        opacity: 1;
        transform: scale(1);
    }

    /* Itinerary Section Styling */
    .itinerary-container {
        margin-top: 20px;
    }

    .itinerary-item {
        display: flex;
        align-items: flex-start;
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
    }

    .itinerary-day {
        min-width: 80px;
        padding-right: 15px;
        border-right: 1px dashed #ddd;
        margin-right: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .day-number {
        font-size: 16px;
        font-weight: 700;
        color: rgb(254, 255, 255);
        margin-bottom: 5px;
    }

    .itinerary-content {
        flex: 1;
    }

    .itinerary-actions {
        margin-left: 10px;
        align-self: center;
    }

    .add-day-container {
        margin-top: 20px;
    }

    /* Hotel Section Styling */
    .hotel-container {
        margin-top: 20px;
    }

    .hotel-item {
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
        position: relative;
    }

    .hotel-item .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    .add-hotel-container {
        margin-top: 20px;
    }

    /* Ferry Section Styling */
    .ferry-container {
        margin-top: 20px;
    }

    .ferry-item {
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
    }

    .add-ferry-container {
        margin-top: 20px;
    }

    /* Personal Information Section Styling */
    .personal-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-input-container {
        position: relative;
    }

    .input-icon-wrapper {
        position: relative;
        transition: all 0.3s ease;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: rgb(17, 157, 213);
        font-size: 16px;
        z-index: 1;
    }

    .info-input {
        width: 100%;
        padding: 15px 15px 15px 45px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    }

    .info-input:focus {
        border-color: rgb(17, 157, 213);
        box-shadow: 0 5px 15px rgba(17, 157, 213, 0.1);
        outline: none;
    }

    .info-input::placeholder {
        color: #999;
        font-size: 14px;
    }

    .message-container {
        margin-bottom: 30px;
    }

    .textarea-wrapper {
        position: relative;
    }

    .textarea-wrapper .input-icon {
        top: 20px;
        transform: none;
    }

    .info-textarea {
        width: 100%;
        min-height: 120px;
        padding: 15px 15px 15px 45px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        resize: vertical;
    }

    .info-textarea:focus {
        border-color: rgb(17, 157, 213);
        box-shadow: 0 5px 15px rgba(17, 157, 213, 0.1);
        outline: none;
    }

    .info-textarea::placeholder {
        color: #999;
        font-size: 14px;
    }

    .submit-container {
        display: flex;
        justify-content: center;
    }

    .submit-button {
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgb(17, 157, 213);
        color: white;
        border: none;
        border-radius: 30px;
        padding: 15px 35px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(17, 157, 213, 0.2);
    }

    .submit-button i {
        margin-right: 10px;
        font-size: 18px;
    }

    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(17, 157, 213, 0.3);
        background: rgb(15, 140, 190);
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .trip-type-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .personal-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .duration-cards {
            flex-direction: column;
        }

        .duration-card {
            width: 100%;
        }

        .main-title {
            font-size: 1.75rem;
        }

        .subtitle {
            font-size: 1rem;
        }

        .section-header h3 {
            font-size: 16px;
        }

        .itinerary-day {
            min-width: 60px;
        }
    }

    @media (max-width: 576px) {
        .trip-type-grid {
            grid-template-columns: 1fr;
        }

        .personal-info-grid {
            grid-template-columns: 1fr;
        }

        .form-section {
            padding: 15px;
        }

        .itinerary-item {
            flex-direction: column;
        }

        .itinerary-day {
            border-right: none;
            border-bottom: 1px dashed #ddd;
            padding-right: 0;
            padding-bottom: 10px;
            margin-right: 0;
            margin-bottom: 10px;
            width: 100%;
            flex-direction: row;
            justify-content: space-between;
        }

        .itinerary-actions {
            position: absolute;
            top: 15px;
            right: 15px;
        }
    }
</style>
@endpush