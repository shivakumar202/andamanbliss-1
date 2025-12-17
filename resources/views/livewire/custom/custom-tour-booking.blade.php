<div class="booking-form-container">
    <form wire:submit.prevent="submit">
        <!-- Duration Section -->
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-calendar-alt"></i>
                <h3>How long would you like to travel?</h3>
            </div>
            <p class="text-muted mb-3">Select the duration that best fits your travel plans</p>

            <div class="duration-cards">
                @php
                    $durations = [
                        '2-3' => 'Quick Trip',
                        '4-6' => 'Short Trip',
                        '7-10' => 'Week Tour',
                        '10+' => 'Long Trip'
                    ];
                @endphp
                @if (!empty($durations))
                    @foreach ($durations as $value => $type)
                        <div class="duration-card {{ $duration === $value ? 'selected' : '' }}" wire:key="duration-{{ $value }}">
                            <input type="radio" id="duration-{{ $value }}" name="duration" value="{{ $value }}"
                                wire:model="duration" class="duration-input">
                            <label for="duration-{{ $value }}" class="card-content">
                                <div class="duration-days">{{ str_replace('-', '–', $value) }} Days</div>
                                <div class="duration-type">{{ $type }}</div>
                                <div class="check-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            @error('duration') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Travelers Section -->
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-users"></i>
                <h3>Who's traveling with you?</h3>
            </div>
            <p class="text-muted mb-4">Tell us about your travel companions so we can plan accordingly</p>

            <div class="row">
                @php
                    $travelerTypes = [
                        'adults' => ['Adults', 'Age 13+', 1, 10],
                        'children' => ['Children', 'Age 5-12', 0, 6],
                        'infants' => ['Infants', 'Under 5', 0, 4]
                    ];
                @endphp
                @if (!empty($travelerTypes))
                    @foreach ($travelerTypes as $field => $info)
                        <div class="col-lg-4 col-md-6 mb-4" wire:key="traveler-{{ $field }}">
                            <div class="traveler-counter">
                                <div class="traveler-info">
                                    <div class="traveler-icon">
                                        <i class="fas fa-{{ $field === 'adults' ? 'user' : ($field === 'children' ? 'child' : 'baby') }}"></i>
                                    </div>
                                    <div class="traveler-type">
                                        <h4>{{ $info[0] }}</h4>
                                        <p class="text-muted">{{ $info[1] }}</p>
                                    </div>
                                </div>
                                <div class="counter-controls">
                                    <button type="button" class="counter-btn minus" wire:click="decrement('{{ $field }}')"
                                        {{ $$field <= $info[2] ? '' : '' }} aria-label="Decrease {{ $info[0] }} count">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="{{ $field }}" id="{{ $field }}" class="counter-input"
                                        wire:model.live="{{ $field }}" value="{{ $$field }}" readonly aria-label="{{ $info[0] }} count">
                                    <button type="button" class="counter-btn plus" wire:click="increment('{{ $field }}')"
                                        {{ $$field >= $info[3] ? '' : '' }} aria-label="Increase {{ $info[0] }} count">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @error($field) <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Budget Section -->
        <div class="form-section">
            <div class="section-header">
                <i class="fas fa-wallet"></i>
                <h3>What's your budget?</h3>
            </div>
            <p class="text-muted mb-3">Slide to select your minimum and maximum budget</p>

            <div class="budget-filter-card"
                x-data="{ selectedMinPrice: {{ $selectedMinPrice }}, selectedMaxPrice: {{ $selectedMaxPrice }} }"
                x-init="() => {
                    selectedMinPrice = {{ $selectedMinPrice }};
                    selectedMaxPrice = {{ $selectedMaxPrice }};
                }">
                <div class="price-range-header">
                    <div class="price-range-title">Price Range</div>
                    <div class="price-range-values">
                        <span class="price-value-display">₹<span
                                x-text="new Intl.NumberFormat('en-IN').format(selectedMinPrice)"></span> - ₹<span
                                x-text="new Intl.NumberFormat('en-IN').format(selectedMaxPrice)"></span></span>
                    </div>
                </div>

                <div class="price-range-slider">
                    <div class="price-range-track">
                        <div class="price-range-progress"
                            x-bind:style="`left: ${(selectedMinPrice - 1000) / (1000000 - 1000) * 100}%; right: ${(100 - (selectedMaxPrice - 1000) / (1000000 - 1000) * 100)}%`">
                        </div>
                        <div class="price-range-handles">
                            <span class="handle-min"
                                x-bind:style="`left: ${(selectedMinPrice - 1000) / (1000000 - 1000) * 100}%`"></span>
                            <span class="handle-max"
                                x-bind:style="`left: ${(selectedMaxPrice - 1000) / (1000000 - 1000) * 100}%`"></span>
                        </div>
                    </div>
                    <div class="price-range-input">
                        <input type="range" class="range-min" min="1000" max="1000000" step="500"
                            wire:model.live="selectedMinPrice" x-bind:value="selectedMinPrice"
                            x-on:input="selectedMinPrice = parseInt($event.target.value)" wire:key="selected-min-price"
                            aria-label="Minimum price">
                        <input type="range" class="range-max" min="1000" max="1000000" step="500"
                            wire:model.live="selectedMaxPrice" x-bind:value="selectedMaxPrice"
                            x-on:input="selectedMaxPrice = parseInt($event.target.value)" wire:key="selected-max-price"
                            aria-label="Maximum price">
                    </div>
                </div>

                <div class="price-range-markers">
                    <span class="marker-min">₹<span
                            x-text="new Intl.NumberFormat('en-IN').format(selectedMinPrice)"></span></span>
                    <span class="marker-mid">₹<span
                            x-text="new Intl.NumberFormat('en-IN').format((selectedMinPrice + selectedMaxPrice) / 2)"></span></span>
                    <span class="marker-max">₹<span
                            x-text="new Intl.NumberFormat('en-IN').format(selectedMaxPrice)"></span></span>
                </div>
            </div>
            @error('selectedMinPrice') <span class="error text-danger">{{ $message }}</span> @enderror
            @error('selectedMaxPrice') <span class="error text-danger">{{ $message }}</span> @enderror

            <!-- Date and Hotel Category Section -->
            <div class="date-hotel-container">
                <div class="date-card">
                    <label class="input-label">Date of Journey <span class="text-danger">*</span></label>
                    <div class="date-input-wrapper">
                        <i class="fas fa-calendar-alt input-icon"></i>
                        <input type="date" id="journey-date" class="date-input" wire:model="journeyDate"
                            x-ref="dateInput" aria-label="Journey date">
                    </div>
                    @error('journeyDate') <span class="journey-date-error error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="hotel-card">
                    <label class="input-label">Hotel Category <span class="text-danger">*</span></label>
                    <select wire:model="hotelCategory" class="form-control" aria-label="Hotel category">
                        <option value="">Select hotel category</option>
                        @php
                            $hotelCategories = [
                                '7' => '7 Star Hotels',
                                '5' => '5 Star Hotels',
                                '4' => '4 Star Hotels',
                                '3' => '3 Star Hotels',
                                '2' => '2 Star Hotels',
                                '1' => 'Standard Hotels'
                            ];
                        @endphp
                        @if (!empty($hotelCategories))
                            @foreach ($hotelCategories as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('hotelCategory') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Tour Mode Section -->
        <div class="form-section tour-type-section">
            <div class="section-header">
                <i class="fas fa-suitcase-rolling"></i>
                <h3>What type of trip are you planning?</h3>
            </div>
            <p class="text-muted mb-4">Select the type of travel experience you're looking for</p>

            <div class="trip-type-grid">
                @php
                    $travelTypes = [
                        'honeymoon' => ['Honeymoon', 'Romantic getaway for couples', 'heart'],
                        'family' => ['Family Trip', 'Fun adventures for all ages', 'users'],
                        'friends' => ['Friends Trip', 'Create memories together', 'user-friends'],
                        'adventure' => ['Adventure', 'Thrilling outdoor experiences', 'mountain'],
                        'group' => ['Group Tour', 'Travel with like-minded people', 'users'],
                        'corporate' => ['Corporate', 'Business travel & team building', 'briefcase'],
                        'wedding' => ['Wedding', 'Destination wedding celebrations', 'glass-cheers'],
                        'solo' => ['Solo Travel', 'Independent exploration', 'user']
                    ];
                @endphp
                @if (!empty($travelTypes))
                    @foreach ($travelTypes as $type => $info)
                        <div class="trip-type-card {{ $travelType === $type ? 'selected' : '' }}" data-type="{{ $type }}"
                            wire:key="travel-type-{{ $type }}">
                            <input type="radio" class="trip-type-input" id="type-{{ $type }}" name="travel-type"
                                value="{{ $type }}" wire:model="travelType">
                            <label for="type-{{ $type }}" class="trip-type-label">
                                <div class="card-gradient"></div>
                                <div class="trip-type-icon">
                                    <i class="fas fa-{{ $info[2] }}"></i>
                                </div>
                                <div class="trip-type-content">
                                    <h4 class="trip-type-name">{{ $info[0] }}</h4>
                                    <p class="trip-type-desc">{{ $info[1] }}</p>
                                </div>
                                <div class="trip-type-check">
                                    <i class="fas fa-check"></i>
                                </div>
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            @error('travelType') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Ticket Options Section -->
        <div class="form-section ticket-section">
            <div class="section-header">
                <i class="fas fa-plane-departure"></i>
                <h3>Flight Tickets Option</h3>
            </div>
            <p class="text-muted mb-4">Let us know if you need assistance with flight bookings</p>

            <div class="ticket-options-grid">
                @php
                    $flightOptions = [
                        'have-tickets' => ['I already have flight tickets', 'You\'ve arranged your own transportation', 'ticket-alt'],
                        'need-tickets' => ['I need flight tickets', 'We\'ll help book your flights', 'plane']
                    ];
                @endphp
                @if (!empty($flightOptions))
                    @foreach ($flightOptions as $option => $info)
                        <div class="ticket-option-card {{ $flightOption === $option ? 'selected' : '' }}"
                            data-type="{{ $option }}" wire:key="flight-option-{{ $option }}">
                            <input type="radio" class="ticket-option-input" id="{{ $option }}" name="flight-option"
                                value="{{ $option }}" wire:model.live="flightOption">
                            <label for="{{ $option }}" class="ticket-option-label">
                                <div class="card-gradient"></div>
                                <div class="ticket-option-icon">
                                    <i class="fas fa-{{ $info[2] }}"></i>
                                </div>
                                <div class="ticket-option-content">
                                    <h4 class="ticket-option-title">{{ $info[0] }}</h4>
                                    <p class="ticket-option-desc">{{ $info[1] }}</p>
                                </div>
                                <div class="ticket-option-check">
                                    <i class="fas fa-check"></i>
                                </div>
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            @error('flightOption') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Personal Information Section -->
        <div class="form-section personal-info-section">
            <div class="section-header">
                <i class="fas fa-user-circle"></i>
                <h3>Personal Information</h3>
            </div>
            <p class="text-muted mb-4">Tell us about yourself so we can contact you about your custom tour</p>

            <div class="personal-info-grid">
                @php
                    $personalFields = [
                        'fullname' => 'user',
                        'email' => 'envelope',
                        'phone' => 'phone-alt'
                    ];
                @endphp
                @if (!empty($personalFields))
                    @foreach ($personalFields as $field => $info)
                        <div class="info-input-container" wire:key="personal-info-{{ $field }}">
                            <div class="input-icon-wrapper">
                                <i class="fas fa-{{ $info }} input-icon"></i>
                                <input type="{{ $field === 'email' ? 'email' : ($field === 'phone' ? 'tel' : 'text') }}"
                                    id="{{ $field }}" wire:model.debounce.500ms="{{ $field }}" class="info-input"
                                    placeholder="Your {{ ucfirst(str_replace('_', ' ', $field)) }}"
                                    {{ $field === 'phone' ? 'maxlength=12' : '' }} required
                                    aria-label="{{ ucfirst(str_replace('_', ' ', $field)) }}">
                            </div>
                            @error($field) <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="message-container">
                <div class="input-icon-wrapper textarea-wrapper">
                    <i class="fas fa-comment-alt input-icon"></i>
                    <textarea id="message" wire:model.debounce.500ms="message" class="info-textarea"
                        placeholder="Any special requests or comments about your trip" aria-label="Special requests"></textarea>
                </div>
                @error('message') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="submit-container">
                <button type="submit" class="submit-button" aria-label="Submit inquiry">
                    <i class="fas fa-paper-plane"></i>
                    <span>Send Inquiry</span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle duration card selection
        const durationCards = document.querySelectorAll('.duration-card');
        durationCards.forEach(card => {
            card.addEventListener('click', function() {
                durationCards.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                const input = this.querySelector('input[type="radio"]');
                input.checked = true;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });

        // Handle radio inputs for travel-type and flight-option
        const radioGroups = ['travel-type', 'flight-option'];
        radioGroups.forEach(group => {
            const inputs = document.querySelectorAll(`input[name="${group}"]`);
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    const parentCards = this.closest('.trip-type-grid, .ticket-options-grid').querySelectorAll('.trip-type-card, .ticket-option-card');
                    parentCards.forEach(card => card.classList.remove('selected'));
                    this.closest('.trip-type-card, .ticket-option-card').classList.add('selected');
                    if (group === 'flight-option') {
                        Livewire.dispatch('update', { flightOption: this.value });
                    }
                });
            });
        });

        // Handle price range slider updates
        const minPriceInput = document.querySelector('.range-min');
        const maxPriceInput = document.querySelector('.range-max');
        const alpineScope = document.querySelector('.budget-filter-card[x-data]').__x.$data;
        let debounceTimeout;

        function updatePriceRange(minValue, maxValue) {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                Livewire.dispatch('updatePriceRange', { min: minValue, max: maxValue });
            }, 150);
        }

        minPriceInput.addEventListener('input', function() {
            let minValue = parseInt(this.value);
            let maxValue = parseInt(maxPriceInput.value);
            if (minValue > maxValue - 500) {
                minValue = maxValue - 500;
                this.value = minValue;
            }
            alpineScope.selectedMinPrice = minValue;
            updatePriceRange(minValue, maxValue);
        });

        maxPriceInput.addEventListener('input', function() {
            let maxValue = parseInt(this.value);
            let minValue = parseInt(minPriceInput.value);
            if (maxValue < minValue + 500) {
                maxValue = minValue + 500;
                this.value = maxValue;
            }
            alpineScope.selectedMaxPrice = maxValue;
            updatePriceRange(minValue, maxValue);
        });

        // Sync slider UI with backend updates
        Livewire.on('price-range-updated', ({ min, max }) => {
            alpineScope.selectedMinPrice = min;
            alpineScope.selectedMaxPrice = max;
            minPriceInput.value = min;
            maxPriceInput.value = max;
            minPriceInput.dispatchEvent(new Event('input', { bubbles: true }));
            maxPriceInput.dispatchEvent(new Event('input', { bubbles: true }));
        });
    });
</script>
@endpush
