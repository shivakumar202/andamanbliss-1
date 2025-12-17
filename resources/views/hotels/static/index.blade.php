@extends('layouts.app')
@section('title', __(@$hotel->name))
@section('keywords', __(@$hotel->name) . ', andamanbliss, andaman, islands, travel agency, tour and travel.')
@section('description', @$hotel->description)

@push('styles')
    <style>
        :root {
            --primary-gradient: linear-gradient(to left, #FF5722, #ff6510);
            --secondary-color: rgb(17, 157, 213);
            --text-color: #333;
            --border-color: #dee2e6;
        }

        #footers {
            display: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .room-card {
            transition: box-shadow 0.2s ease-in-out;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .room-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .bg-primary-gradient {
            background: var(--primary-gradient);
            color: white;
        }

        .price-box {
            background-color: #fff4e5;
            border-left: 5px solid #ffc107;
            padding: 1rem;
            border-radius: 0.25rem;
        }

        .room-icon {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .tab-section .nav-link {
            color: var(--text-color);
            padding: 0.75rem 1.5rem;
        }

        .tab-section .nav-link.active {
            border-bottom: 3px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .section-divider {
            border-top: 1px dashed #ccc;
            margin: 1.5rem 0;
        }

        .hotel-info i {
            color: var(--secondary-color);
            margin-right: 0.5rem;
        }

        .hotel-detail-wrapper {
            color: var(--text-color);
        }

        .hotel-header-top {
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
            margin-top: 4rem;
        }

        .filter-section {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .filter-section select,
        .filter-section input {
            border-radius: 0.25rem;
            border: 1px solid var(--border-color);
            padding: 0.5rem;
        }

        @media (max-width: 768px) {
            .hotel-header-top {
                margin-top: 2rem;
            }

            .card-body {
                flex-direction: column;
                align-items: start;
            }

            .card-body img {
                width: 100%;
                max-width: 200px;
                margin-bottom: 1rem;
            }

            .nav-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 0.5rem;
            }

            .nav-link {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }

            .room-card .row {
                flex-direction: column;
            }

            .room-card .col-md-3,
            .room-card .col-md-5,
            .room-card .col-md-2 {
                width: 100%;
                border-end: none;
                text-align: left;
            }

            .gallery-modal-content {
                width: 95%;
            }
        }

        @media (min-width: 769px) {
            .filter-section {
                display: flex;
                gap: 1rem;
                align-items: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="hotel-detail-wrapper">
        <section class="hotel-header-top">
            <div class="container py-3">
                <div class="card shadow-sm">
                    <div class="card-body d-flex flex-wrap align-items-center">
                        <div class="me-3 mb-2">
                            <img src="{{ $hotel['hotel_image'] ?? asset('/site/img/hotel_image.png') }}"
                                alt="Beach view luxury resort" class="rounded" style="width: 120px; height: auto;">
                        </div>
                        <div class="flex-grow-1 mb-2">
                            <h4 class="mb-1">{{ ucwords($hotel['hotel_name']) }} <span class="text-warning">★★★</span></h4>
                            <p class="mb-1">{{ ucfirst($hotel['address']) }}
                                <a href="{{$hotel['hotel_website_url']}}" class="text-decoration-underline">View on map</a>
                            </p>
                            @php
                                $facilities = json_decode($hotel['hotel_facilities'], true) ?? [];
                                $maxVisible = 5;
                            @endphp
                            <div class="hotel-facilities d-flex flex-wrap gap-2">
                                @foreach($facilities as $i => $facility)
                                    <span class="facility-item badge bg-light text-dark" @if($i >= $maxVisible)
                                    style="display:none;" @endif>
                                        {!! $facility !!}
                                    </span>
                                @endforeach
                                @if(count($facilities) > $maxVisible)
                                    <a class="toggle-facilities text-info"
                                        style="cursor:pointer;">+{{ count($facilities) - $maxVisible }} more</a>
                                @endif
                            </div>
                        </div>
                        <div class="text-end mb-2">
                            <strong>Check-in:</strong> {{\Carbon\Carbon::parse($requests['checkin'])->format('d F Y')}}<br>
                            <strong>Check-out:</strong>
                            {{\Carbon\Carbon::parse($requests['checkout'])->format('d F Y')}}<br>
                            <span class="badge bg-light text-dark">{{ count($requests['PaxRooms']) }} room(s),
                                {{ $requests['PaxRooms'][0]['Adults'] }}
                                Adult(s)@if($requests['PaxRooms'][0]['Children'] > 0),
                                {{ $requests['PaxRooms'][0]['Children'] }} Child(s)@endif</span>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs mt-3 tab-section" id="hotelTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#rooms" type="button"
                            role="tab">Available Rooms</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#gallery" type="button"
                            role="tab">Image Gallery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#details" type="button"
                            role="tab">Hotel Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#amenities" type="button"
                            role="tab">Hotel Amenities</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#map" type="button" role="tab">Show on
                            Map</button>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="rooms" role="tabpanel">
                        @php
                            $groupedRooms = collect($otherRooms)->groupBy(function ($room) {
                                return explode(',', $room['Name'][0])[0] ?? '';
                            });
                        @endphp
                        <div class="filter-section">
                            <select id="roomTypeFilter" class="form-select me-2 mb-2 mb-md-0" style="width: auto;">
                                <option value="all">All Room Types</option>
                                @foreach($groupedRooms as $roomName => $roomVariants)
                                    <option value="{{ Str::slug($roomName) }}">{{ $roomName }}</option>
                                @endforeach
                            </select>
                            <select id="priceRangeFilter" class="form-select" style="width: auto;">
                                <option value="all">All Prices</option>
                                <option value="0-5000">INR 0 - 5,000</option>
                                <option value="5000-10000">INR 5,000 - 10,000</option>
                                <option value="10000-20000">INR 10,000 - 20,000</option>
                                <option value="20000+">INR 20,000+</option>
                            </select>
                        </div>

                        @foreach ($groupedRooms as $roomName => $roomVariants)
                            <div class="room-card shadow-sm" data-room-name="{{ Str::slug($roomName) }}"
                                data-price-range="{{ $roomVariants[0]['TotalFare'] ?? 0 }}">
                                <div class="px-3 py-2 bg-light">
                                    <h6 class="mb-0">{{ $roomName }}</h6>
                                    <small class="text-muted">{{ $hotel['address'] ?? '' }},
                                        {{ $hotel['city_name'] ?? '' }}</small>
                                </div>
                                <div class="p-3">
                                    @foreach ($roomVariants as $room)
                                        @php
                                            $inclusion = $room['inclusion'] ?? 'Welcome Drink On Arrival, Breakfast';
                                            $isLong = strlen($inclusion) > 50;
                                            $shortText = \Illuminate\Support\Str::limit($inclusion, 50, '');
                                            $roomDescription = Str::limit(strip_tags($room['RoomDescription'] ?? ''), 100);
                                        @endphp
                                        <div class="row g-2 align-items-center mb-2 border-top">
                                            <div class="col-md-3 col-12">
                                                <div class="fw-semibold">{{ $room['Name'][0] ?? '' }}</div>
                                                <small class="text-muted">
                                                    <i class="fas fa-user-friends me-1"></i>
                                                    x {{ $requests['PaxRooms'][0]['Adults'] }} Adult(s)
                                                    @if($requests['PaxRooms'][0]['Children'] > 0)
                                                        , {{ $requests['PaxRooms'][0]['Children'] }} Child(s)
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="col-md-5 col-12">
                                                <small class="text-success">
                                                    <i class="fas fa-coffee me-1"></i> {{ $shortText }}
                                                    @if($isLong)
                                                        <span class="text-primary" data-bs-toggle="tooltip"
                                                            title="{{ $inclusion }}">More</span>
                                                    @endif
                                                </small>
                                                <small class="text-muted d-block mt-1">
                                                    <i class="fas fa-info-circle me-1"></i>{{ $roomDescription }}
                                                </small>
                                                @if(!empty($room['RoomPromotion'][$loop->iteration - 1]))
                                                    <span
                                                        class="badge bg-danger text-light mt-1">{{ Str::replace('|', '', $room['RoomPromotion'][$loop->iteration - 1]) }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-2 col-6 text-md-end">
                                                <div class="fw-bold">INR {{ number_format($room['TotalFare'] ?? 0) }}</div>
                                                <a href="#" class="small text-muted">View currencies</a>
                                            </div>
                                            <div class="col-md-2 col-6">
                                                <form id="hotel-book-form-{{ $room['BookingCode'] }}" method="POST"
                                                    action="{{ route('hotel.review', ['slug' => Str::slug($hotel->hotel_name)]) }}?{{ http_build_query($requests) }}">
                                                    @csrf
                                                    <input type="hidden" name="booking_code" value="{{ $room['BookingCode'] }}">
                                                    <button class="btn btn-sm btn-warning w-100" type="submit">Book Now <i
                                                            class="fas fa-arrow-right ms-1"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                        <div class="row g-3">
                            @php
                                $galleryImages = is_string($hotel['hotel_gallery']) ? json_decode($hotel['hotel_gallery'], true) : $hotel['hotel_gallery'];
                            @endphp
                            @if (!empty($galleryImages))
                                @foreach ($galleryImages as $gallery)
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <img src="{{ $gallery }}" alt="{{ $hotel['hotel_name'] ?? 'Hotel Image' }}"
                                            class="img-fluid rounded">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="details" role="tabpanel">
                        <p class="mt-3"><strong>Location:</strong> {{ $hotel['address'] ?? '' }}</p>
                        @php
                            $rawAttractions = $hotel['attractions'] ?? '';
                            if (is_string($rawAttractions) && str_starts_with($rawAttractions, '[')) {
                                $decoded = json_decode($rawAttractions, true);
                                $rawAttractions = $decoded[0] ?? '';
                            }
                            $decodedHtml = html_entity_decode($rawAttractions);
                            $decodedHtml = preg_replace('/<\/?p>/', '', $decodedHtml);
                            $attractionList = array_filter(array_map('trim', explode('<br />', $decodedHtml)));
                        @endphp
                        @if(!empty($attractionList))
                            <p><strong>Distances to nearest 0.1 mile/km:</strong></p>
                            <ul class="list-unstyled ms-2">
                                @foreach($attractionList as $item)
                                    @if(Str::contains($item, 'km -'))
                                        @php
                                            [$distance, $place] = explode(' - ', $item, 2);
                                        @endphp
                                        <li>✔ <strong>{{ $distance }}</strong> – {{ $place }}</li>
                                    @else
                                        <li>✔ {{ $item }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="amenities" role="tabpanel">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mt-3">
                            @php
                                $facilities = $hotel['hotel_facilities'];
                                if (is_string($facilities)) {
                                    $facilities = json_decode($facilities, true);
                                }
                            @endphp
                            @if(!empty($facilities) && is_array($facilities))
                                @foreach($facilities as $facility)
                                    <div class="col">✔ {{ $facility }}</div>
                                @endforeach
                            @else
                                <div class="col">No facilities listed</div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="map" role="tabpanel">
                        @php
                            $coords = explode('|', $hotel['map'] ?? '');
                            $lat = $coords[0] ?? '';
                            $lng = $coords[1] ?? '';
                        @endphp
                        @if(!empty($lat) && !empty($lng))
                            <iframe src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&z=13&output=embed" width="100%"
                                height="300" style="border:0;" allowfullscreen loading="lazy"></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setDefaultDates();
            initPersonCounter();
            initRoomSelection();
            initBookingForm();
            initGallery();
            initRoomTypeFilter();
            initPriceRangeFilter();

            const container = document.querySelector('.hotel-facilities');
            const toggleBtn = container.querySelector('.toggle-facilities');
            let expanded = false;

            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    container.querySelectorAll('.facility-item').forEach((item, index) => {
                        if (index >= {{ $maxVisible }}) {
                            item.style.display = expanded ? 'none' : 'inline-block';
                        }
                    });
                    toggleBtn.textContent = expanded ? `+${container.querySelectorAll('.facility-item').length - {{ $maxVisible }}} more` : 'Show less';
                    expanded = !expanded;
                });
            }
        });

        function initRoomTypeFilter() {
            const filter = document.getElementById('roomTypeFilter');
            filter.addEventListener('change', function () {
                const selectedType = this.value;
                const roomCards = document.querySelectorAll('.room-card');
                roomCards.forEach(card => {
                    const roomType = card.getAttribute('data-room-name');
                    card.style.display = (selectedType === 'all' || roomType === selectedType) ? 'block' : 'none';
                });
            });
        }

        function initPriceRangeFilter() {
            const filter = document.getElementById('priceRangeFilter');
            filter.addEventListener('change', function () {
                const range = this.value;
                const roomCards = document.querySelectorAll('.room-card');
                roomCards.forEach(card => {
                    const price = parseFloat(card.getAttribute('data-price-range'));
                    let show = true;
                    if (range !== 'all') {
                        const [min, max] = range.split('-').map(v => parseFloat(v) || Infinity);
                        show = max ? price >= min && price < max : price >= min;
                    }
                    card.style.display = show ? 'block' : 'none';
                });
            });
        }

        function setDefaultDates() {
            const checkInInput = document.getElementById('check-in');
            const checkOutInput = document.getElementById('check-out');
            if (checkInInput && checkOutInput) {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                const dayAfterTomorrow = new Date(today);
                dayAfterTomorrow.setDate(today.getDate() + 2);
                checkInInput.valueAsDate = tomorrow;
                checkOutInput.valueAsDate = dayAfterTomorrow;
                checkInInput.setAttribute('min', formatDateForInput(today));
                checkOutInput.setAttribute('min', formatDateForInput(tomorrow));
                checkInInput.addEventListener('change', function () {
                    const newCheckIn = new Date(this.value);
                    const nextDay = new Date(newCheckIn);
                    nextDay.setDate(newCheckIn.getDate() + 1);
                    checkOutInput.setAttribute('min', formatDateForInput(nextDay));
                    if (new Date(checkOutInput.value) <= newCheckIn) {
                        checkOutInput.valueAsDate = nextDay;
                    }
                });
            }
        }

        function formatDateForInput(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function initPersonCounter() {
            const counterContainers = document.querySelectorAll('.pCountall');
            counterContainers.forEach(container => {
                const minusBtn = container.querySelector('.pCountBtn.minus');
                const plusBtn = container.querySelector('.pCountBtn.plus');
                const input = container.querySelector('.pCountInput');
                if (minusBtn && plusBtn && input) {
                    updateCounterButtonState(input, minusBtn, plusBtn);
                    minusBtn.addEventListener('click', function () {
                        let value = parseInt(input.value);
                        const min = input.name === 'adult' ? 1 : 0;
                        if (value > min) {
                            input.value = --value;
                            updateCounterButtonState(input, minusBtn, plusBtn);
                            updatePriceSummary();
                        }
                    });
                    plusBtn.addEventListener('click', function () {
                        let value = parseInt(input.value);
                        const max = input.name === 'adult' ? 10 : (input.name === 'child' ? 6 : 4);
                        if (value < max) {
                            input.value = ++value;
                            updateCounterButtonState(input, minusBtn, plusBtn);
                            updatePriceSummary();
                        }
                    });
                }
            });
        }

        function updateCounterButtonState(input, minusBtn, plusBtn) {
            const value = parseInt(input.value);
            const min = input.name === 'adult' ? 1 : 0;
            const max = input.name === 'adult' ? 10 : (input.name === 'child' ? 6 : 4);
            minusBtn.disabled = value <= min;
            minusBtn.classList.toggle('disabled', value <= min);
            plusBtn.disabled = value >= max;
            plusBtn.classList.toggle('disabled', value >= max);
        }

        function initRoomSelection() {
            const selectButtons = document.querySelectorAll('.choose');
            const selectedRoomInput = document.getElementById('selected-room');
            const roomIdInput = document.getElementById('room-id');
            const mealPlanInput = document.getElementById('meal-plan');
            const roomPriceInput = document.getElementById('room-price');
            selectButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const roomId = this.getAttribute('data-id');
                    const roomName = this.getAttribute('data-room');
                    const mealPlan = this.getAttribute('data-food');
                    const roomPrice = this.getAttribute('data-price');
                    roomIdInput.value = roomId;
                    mealPlanInput.value = mealPlan;
                    roomPriceInput.value = roomPrice;
                    selectedRoomInput.value = `${roomName} - ${mealPlan}`;
                    selectButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    const allOptionCards = document.querySelectorAll('.room-option-card');
                    allOptionCards.forEach(card => card.classList.remove('selected-option'));
                    let parentCard = this.closest('.room-option-card');
                    if (parentCard) {
                        parentCard.classList.add('selected-option');
                    }
                    if (window.innerWidth < 992) {
                        const bookingCard = document.querySelector('.sticky-booking-card');
                        if (bookingCard) {
                            bookingCard.scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                    updatePriceSummary();
                });
            });
        }

        function updatePriceSummary() {
            const roomPriceInput = document.getElementById('room-price');
            const roomChargesDisplay = document.getElementById('room-charges');
            const taxesFeeDisplay = document.getElementById('taxes-fees');
            const totalPriceDisplay = document.getElementById('total-price');
            if (roomPriceInput && roomPriceInput.value) {
                const roomPrice = parseFloat(roomPriceInput.value);
                const taxRate = 0.18;
                const taxAmount = roomPrice * taxRate;
                const totalPrice = roomPrice + taxAmount;
                roomChargesDisplay.textContent = `₹${roomPrice.toFixed(2)}`;
                taxesFeeDisplay.textContent = `₹${taxAmount.toFixed(2)}`;
                totalPriceDisplay.textContent = `₹${totalPrice.toFixed(2)}`;
            } else {
                roomChargesDisplay.textContent = '₹0.00';
                taxesFeeDisplay.textContent = '₹0.00';
                totalPriceDisplay.textContent = '₹0.00';
            }
        }

        function initBookingForm() {
            const bookingForm = document.getElementById('booking-form');
            const bookNowBtn = document.getElementById('book-now-btn');
            if (bookingForm && bookNowBtn) {
                bookingForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    if (validateBookingForm()) {
                        const formData = new FormData(bookingForm);
                        const urlPath = window.location.pathname;
                        const hotelId = urlPath.split('/').pop();
                        formData.append('id', hotelId);
                        fetch('/hotels/booking', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Booking successful! Reference ID: ' + data.booking_id);
                                    bookingForm.reset();
                                    setDefaultDates();
                                    document.getElementById('selected-room').value = '';
                                    document.getElementById('room-id').value = '';
                                    document.getElementById('meal-plan').value = '';
                                    document.getElementById('room-price').value = '';
                                    updatePriceSummary();
                                } else {
                                    alert('Booking failed: ' + (data.message || 'Please try again later.'));
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while processing your booking. Please try again.');
                            });
                    }
                });
            }
        }

        function validateBookingForm() {
            let isValid = true;
            const roomIdInput = document.getElementById('room-id');
            if (!roomIdInput.value) {
                alert('Please select a room option');
                isValid = false;
            }
            const nameInput = document.getElementById('guest-name');
            if (!nameInput.value.trim()) {
                nameInput.classList.add('is-invalid');
                isValid = false;
            }
            const emailInput = document.getElementById('guest-email');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.value)) {
                emailInput.classList.add('is-invalid');
                isValid = false;
            }
            const phoneInput = document.getElementById('guest-phone');
            if (!phoneInput.value.trim() || phoneInput.value.trim().length < 10) {
                phoneInput.classList.add('is-invalid');
                isValid = false;
            }
            return isValid;
        }

        function initGallery() {
            const viewAllBtn = document.querySelector('.view-all-photos button');
            if (viewAllBtn) {
                viewAllBtn.addEventListener('click', function () {
                    const modal = document.createElement('div');
                    modal.className = 'gallery-modal';
                    modal.innerHTML = `
                            <div class="gallery-modal-overlay"></div>
                            <div class="gallery-modal-content">
                                <button class="gallery-close-btn">&times;</button>
                                <div class="gallery-slides"></div>
                                <button class="gallery-prev-btn">&lt;</button>
                                <button class="gallery-next-btn">&gt;</button>
                            </div>
                        `;
                    document.body.appendChild(modal);
                    const style = document.createElement('style');
                    style.textContent = `
                            .gallery-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1050; display: flex; align-items: center; justify-content: center; }
                            .gallery-modal-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.9); }
                            .gallery-modal-content { position: relative; width: 80%; max-width: 1000px; z-index: 1051; }
                            .gallery-close-btn { position: absolute; top: -40px; right: 0; color: white; font-size: 32px; border: none; background: transparent; cursor: pointer; z-index: 1052; }
                            .gallery-slides { width: 100%; position: relative; }
                            .gallery-slide { display: none; width: 100%; }
                            .gallery-slide.active { display: block; }
                            .gallery-slide img { width: 100%; max-height: 80vh; object-fit: contain; }
                            .gallery-prev-btn, .gallery-next-btn { position: absolute; top: 50%; transform: translateY(-50%); color: white; font-size: 24px; border: none; background: rgba(0, 0, 0, 0.5); width: 40px; height: 40px; border-radius: 50%; cursor: pointer; z-index: 1052; }
                            .gallery-prev-btn { left: 20px; }
                            .gallery-next-btn { right: 20px; }
                            @media (max-width: 768px) {
                                .gallery-modal-content { width: 95%; }
                                .gallery-close-btn { top: -30px; font-size: 24px; }
                                .gallery-prev-btn, .gallery-next-btn { font-size: 20px; width: 30px; height: 30px; }
                            }
                        `;
                    document.head.appendChild(style);
                    const gallerySlides = document.querySelector('.gallery-slides');
                    const galleryImages = document.querySelectorAll('.main-gallery-image img, .gallery-thumbnail img');
                    galleryImages.forEach((img, index) => {
                        const slide = document.createElement('div');
                        slide.className = `gallery-slide ${index === 0 ? 'active' : ''}`;
                        slide.innerHTML = `<img src="${img.src}" alt="Gallery image ${index + 1}">`;
                        gallerySlides.appendChild(slide);
                    });
                    let currentSlide = 0;
                    function showSlide(index) {
                        const slides = document.querySelectorAll('.gallery-slide');
                        if (index < 0) index = slides.length - 1;
                        if (index >= slides.length) index = 0;
                        currentSlide = index;
                        slides.forEach(slide => slide.classList.remove('active'));
                        slides[currentSlide].classList.add('active');
                    }
                    const closeBtn = document.querySelector('.gallery-close-btn');
                    const prevBtn = document.querySelector('.gallery-prev-btn');
                    const nextBtn = document.querySelector('.gallery-next-btn');
                    const overlay = document.querySelector('.gallery-modal-overlay');
                    closeBtn.addEventListener('click', () => document.body.removeChild(modal));
                    overlay.addEventListener('click', () => document.body.removeChild(modal));
                    prevBtn.addEventListener('click', () => showSlide(currentSlide - 1));
                    nextBtn.addEventListener('click', () => showSlide(currentSlide + 1));
                    document.addEventListener('keydown', function (e) {
                        if (e.key === 'Escape' && document.querySelector('.gallery-modal')) {
                            document.body.removeChild(modal);
                        } else if (e.key === 'ArrowLeft' && document.querySelector('.gallery-modal')) {
                            showSlide(currentSlide - 1);
                        } else if (e.key === 'ArrowRight' && document.querySelector('.gallery-modal')) {
                            showSlide(currentSlide + 1);
                        }
                    });
                });
            }
        }
    </script>
@endpush