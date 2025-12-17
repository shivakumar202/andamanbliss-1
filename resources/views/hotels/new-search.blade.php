@extends('layouts.app')
@section('title', 'Hotels')

@push('styles')
    <link rel="stylesheet" href="{{ asset('site/css/hotel-listing.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/hotel-sidebar.css') }}">
    <style>
        #loading {
            position: fixed;
            bottom: 20px;
            /* distance from bottom */
            left: 58%;
            /* start from center */
            transform: translateX(-50%);
            /* perfectly center horizontally */
            background: #ffc107;
            /* semi-transparent background */
            color: #1e1616;
            padding: 2px 29px;
            border-radius: 20px;
            font-size: 14px;
            width: 13%;
            z-index: 9999;
        }

        @media only screen and (max-width: 600px) {
            #loading {
                left: 50%;

                width: 50%;
            }
        }

        .hotel-sidebar {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px;
            position: sticky;
            top: 20px;

            max-height: calc(100vh - 40px);
            overflow-y: auto;
            border: 1px solid #e0e0e0;
        }

        .tooltip-inner {
            background-color: #fff !important;
            color: #333;
            z-index: 999;
            border-radius: 0%;
        }

        #footers {
            display: none;
        }

        .filter-section {
            margin-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
        }

        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .filter-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .filter-options {
            margin-top: 8px;
        }

        .filter-option {
            margin-bottom: 10px;
            font-size: 13px;
            color: #333;
        }

        .custom-checkbox {
            position: relative;
            padding-left: 26px;
            cursor: pointer;
            user-select: none;
            display: block;
            width: 100%;
        }

        .filter-count {
            color: #888;
            font-size: 12px;
            float: right;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: -8px;
            height: 16px;
            width: 16px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 2px;
            margin-top: 2px;
        }

        .label-text {
            padding-left: 10px;
        }

        .custom-checkbox:hover input~.checkmark {
            border-color: #0066cc;
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: #0066cc;
            border-color: #0066cc;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 5px;
            top: 2px;
            width: 4px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .view-more {
            color: #0066cc;
            font-size: 12px;
            cursor: pointer;
            margin-top: 8px;
            display: inline-block;
            padding-left: 25px;
        }

        .clear-filters,
        .apply-filters {
            width: 100%;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
            margin-top: 10px;
        }

        .clear-filters {
            background-color: transparent;
            border: 1px solid #0066cc;
            color: #0066cc;
        }

        .apply-filters {
            background-color: #0066cc;
            color: white;
            border: none;
        }

        .search-input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 10px;
            font-size: 13px;
            width: 100%;
            margin-bottom: 12px;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 16px;
        }

        .custom-checkbox {
            display: flex !important;
            justify-content: start !important;
        }

        .hotel-listing>h5 {
            font-size: medium !important;
        }
        
.listing-htl-hotel-card {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border: none;
}

.listing-htl-hotel-img {
    height: auto;
    object-fit: cover;
    border-radius: 10px;
    /* width: 200px; */
    margin:1px;
    border:2px solid #dddddd1f;
}



.listing-htl-hotel-header {
    border-bottom: 1px solid #eee;
}

.listing-htl-hotel-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.listing-htl-stars {
    font-size: 0.9rem;
}

.listing-htl-location {
    font-size: 0.85rem;
    color: #666;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.listing-htl-address {
    margin-right: 5px;
}

.listing-htl-map-link {
    color:#FF6214;
    text-decoration: none;
    white-space: nowrap;
}



.listing-htl-price {
    font-weight: 700;
    font-size: 0.9rem;
    color: #333;
}

.listing-htl-currency-link {
    font-size: 0.8rem;
    color: #0d6efd;
    text-decoration: none;
    display: block;
}

.listing-htl-book-btn {
    background-color: #ffc107;
    border: none;
    padding: 6px 10px;
    font-weight: 500;
    color: #000;
    font-size: 12px;
    border-radius:20px;
}

.listing-htl-book-btn:hover {
    background-color: #e0a800;
}

.listing-htl-more-rooms {
    border-top: 1px solid #eee;
}

.listing-htl-more-rooms-link {
    color: #176ea3;
    text-decoration: none;
    font-size: 0.8rem;
    display: inline-block;
    padding: 5px 10px;
    background-color: #BADDF6;
    border-radius: 3px;
    font-weight: bold;
}

.listing-htl-preferred-badge .badge {
    font-size: 0.75rem;
    padding: 5px 8px;
}

.listing-htl-divider {
    border-top: 1px dotted #ccc;
    margin: 10px 0;
}
.book-room-btn{
    background-color:#ff6214;
    color:#fff;
    border:none;
    border-radius:20px;
    padding:5px 12px;
    font-weight: 500;
}
.hotel-lst-prc{
    font-weight: bold;
    font-size: 1.1rem;
    margin-bottom: 2px;
}
.hotel-lst-htl-room-type{
    font-weight: bold;
    font-size: 14px;;
    margin-bottom: 2px;
}
.hotel-amities-lst{
    display: flex;
    gap:10px;
    list-style-type: none;
    align-items: center;
    justify-content: left;
    padding: 2px 0;
}
.hotel-amities-lst li{
    font-size:13px;
}
.hotel-breakfst{
    color:#198754;
}
.non-refund-htl{
    color:#dc3545;
}
.htl-lsting-more-dlts{
    text-decoration: none;
}
.htl-currnecy-tag{
    font-size: 12px;
}
.htl-des{
    font-size:14px;
    margin-bottom: 2px;
    
    
}
.htl-des span{
background-color: #9bd3f7;
    border-radius:5px;
    padding: 5px 10px;
    font-size:12px;
}
.book-now-tag{
    background-color: #ff6214;
    color:#fff;
    padding:2px 12px;
    border-radius:5px;
}
.heading-htl{
    display: flex;
    justify-content: space-between;
}
.htl-des-bed{
    display: flex;
}
.price-htl{
    text-align: end;
}
.htl-star-algn{
    display: flex;
}
/* Mobile specific styles */
@media (max-width: 767.98px) {
    
    .container {
        padding: 0;
        max-width: 100%;
    }
    .htl-des-bed{
    display: flex;
    justify-content: center;
    }
    .hote-photo{
        height: 30vh;
        width: auto;
    }
    .price-blok {
        display: flex;
        flex-wrap: wrap;
    }
    .price-htl{
    text-align: center;
    display: flex;
    margin-top:30px;
    justify-content: space-between;
    border:1px solid #ddd;
    border-radius: 15px;
    padding: 10px 20px;
    align-items: center;
    background-color: #cadfed;
}
.book-now-tag{
    display:none;
}
.book-room-btn{
    /* margin-top:25px; */
}
.htl-main-des{
    text-align: center;
}
    .htl-des{
    font-size:14px;
    text-align: center;
    
    
}
    
    .listing-htl-hotel-card {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 15px !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: none;
    }
    
    .listing-htl-hotel-card .row {
        flex-direction: column;
        margin: 0;
    }
    
    .listing-htl-hotel-img {
        width: 100%;
        height: 180px;
        border-radius: 0;
        margin: 0;
        border: none;
        object-fit: cover;
    }
    
    .listing-htl-hotel-header {
        padding: 12px 15px !important;
        border-bottom: none;
    }
    
    .listing-htl-hotel-title {
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        font-weight: 600;
    }
    
    .listing-htl-stars {
        font-size: 0.85rem;
        margin-bottom: 0.5rem !important;
    }
    
    .listing-htl-location {
        margin-bottom: 0 !important;
    }
    
    .listing-htl-map-link {
        font-size: 0.8rem;
        color: #FF6214;
        text-decoration: none;
    }
    
    .listing-htl-room-container {
        padding: 0.75rem 1rem !important;
    }
    
    .listing-htl-room-type-container {
        margin-bottom: 0.75rem !important;
    }
    
    .listing-htl-room-type {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0;
    }
    
    .listing-htl-room-details {
        margin-bottom: 0;
    }
    
    .listing-htl-room-details .d-flex {
        flex-direction: column;
    }
    
    .listing-htl-left-details {
        width: 100%;
        margin-bottom: 15px;
    }
    
    .listing-htl-right-details {
        width: 100%;
        text-align: left !important;
    }
    
    .listing-htl-occupancy {
        font-size: 0.8rem;
        color: #666;
        margin-bottom: 8px;
    }
    
    .listing-htl-free-cancellation {
        font-size: 12px;
        color: #198754;
        margin-bottom: 8px;
    }
    
    .listing-htl-room-only {
        font-size: 0.8rem;
        color: #198754;
        margin-bottom: 8px;
    }
    
    .listing-htl-room-links a {
        font-size: 0.8rem;
        color: #0f2342;
        text-decoration: none;
    }
    
    .listing-htl-price {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0;
        display: inline-block;
    }
    
    .listing-htl-book-btn {
        width: 100%;
        font-size: 0.9rem;
        padding: 0.5rem;
        margin-bottom: 0.5rem !important;
        background-color: #ffc107;
        border: none;
        color: #000;
        font-weight: 600;
        border-radius: 20px;
    }
    
    .listing-htl-currency-link {
        font-size: 0.75rem;
        color: #0d6efd;
        text-decoration: none;
    }
    
    .listing-htl-more-rooms {
        margin-top: 0;
        background-color: #f0f8ff;
        padding: 0.5rem !important;
    }
    
    .listing-htl-more-rooms-link {
        font-size: 0.85rem;
        color: #176ea3;
        text-decoration: none;
    }
    
    .listing-htl-discount-btn {
        background-color: white;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
    
    .listing-htl-discount-btn i {
        color: #333;
    }
    
    /* Quote/Compare checkbox styling */
    .quote-compare-container {
        display: flex;
        justify-content: flex-end;
        padding: 0.5rem 1rem;
        align-items: center;
        font-size: 0.8rem;
        border-top: 1px solid #eee;
    }
    
    .quote-compare-container input[type="checkbox"] {
        margin-right: 0.5rem;
    }
}

/* Desktop specific styles */
@media (min-width: 768px) {
    .listing-htl-room-container {
        border-bottom: none;
    }
}
    </style>
@endpush

@section('content')
    <section class="hotel-banner position-relative">
        <div class="container-fluid p-0 overflow-hidden">
            <div class="row">
                <div class="col-12 text-center mt-5 banner-centre-contain">
                    <h1 class="text-white fs-1 text-center">Let's Discover Your Perfect Stay and Capture Happy Moments</h1>
                    <button type="button" class="banner-btn">Book Now</button>
                </div>
            </div>
        </div>
    </section>

    @include('common.search2')

    <section id="hotel-listing" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mobile-hide">
                    <div class="hotel-sidebar">
                        <div class="filter-section">
                            <div class="filter-title">
                                <span>Suggested For You</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="filter-options">
                                <input type="text" class="search-input" placeholder="Search by hotel name">
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Top Rated">

                                        <span class="label-text">Top Rated</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Best Seller">

                                        <span class="label-text">Best Seller</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Budget Friendly">

                                        <span class="label-text">Budget Friendly</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-section">
                            <div class="filter-title">
                                <span>Price Range</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="filter-options">
                                <div class="price-slider">
                                    <input type="range" min="1000" max="20000" value="20000" class="form-range"
                                        id="priceRange">
                                    <div class="price-range">
                                        <span>₹1,000</span>
                                        <span id="priceValue">₹20,000</span>
                                        <span>₹20,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-section">
                            <div class="filter-title">
                                <span>Star Category</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="filter-options">
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="5 Star">

                                        <span class="label-text">5 Star</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="4 Star">

                                        <span class="label-text">4 Star</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="3 Star">

                                        <span class="label-text">3 Star</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="2 Star">

                                        <span class="label-text">2 Star</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-section">
                            <div class="filter-title">
                                <span>Location</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="filter-options">
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Port Blair">

                                        <span class="label-text">Port Blair</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Havelock Island">

                                        <span class="label-text">Havelock Island</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Neil Island">

                                        <span class="label-text">Neil Island</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Diglipur">

                                        <span class="label-text">Diglipur</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="filter-section">
                            <div class="filter-title">
                                <span>Amenities</span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="filter-options">
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Free WiFi">

                                        <span class="label-text">Free WiFi</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Breakfast Included">

                                        <span class="label-text">Breakfast Included</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Swimming Pool">

                                        <span class="label-text">Swimming Pool</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Air Conditioning">

                                        <span class="label-text">Air Conditioning</span>
                                    </label>
                                </div>
                                <div class="filter-option">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" value="Restaurant">

                                        <span class="label-text">Restaurant</span>

                                    </label>
                                </div>
                                <span class="view-more">+ View More</span>
                            </div>
                        </div>
                        <button class="clear-filters">Clear All Filters</button>
                        <button class="apply-filters">Apply Filters</button>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row  p-1">
                        <div id="hotel-list" class="row mx-0"></div>
                        <div id="loading" class="text-center mt-3">Loading more hotels...</div>

                        <div class="no-results" style="display: none;">No hotels match your filters.</div>
                    </div>
                </div>


            </div>
        </div>

    </section>

@endsection


@push('scripts')
   <script>
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });

        let hotelCodes = @json($hotelCodes);
        let searchParams = @json($searchParams);

            fetch("{{ route('hotel.fetchChunk') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    codes: hotelCodes,
                    searchParams: searchParams
                })
            })
        .then(res => res.json())
        .then(data => {
            if (data.html) {
                document.getElementById('hotel-list').insertAdjacentHTML('beforeend', data.html);
            }
            document.getElementById('loading').style.display = 'none';
            if (!document.getElementById('hotel-list').children.length) {
                document.querySelector('.no-results').style.display = 'block';
            }
            initTooltips();
        });

        setCallNowHref();
        initPriceSlider();
        initFilterSections();
        initTooltips();

        const applyFiltersBtn = document.querySelector('.apply-filters');
        if (applyFiltersBtn) {
            applyFiltersBtn.addEventListener('click', applyFilters);
        }

        const searchInput = document.querySelector('.search-input');
        const priceRange = document.getElementById('priceRange');
        const checkboxes = document.querySelectorAll('.custom-checkbox input[type="checkbox"]');

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }
        if (priceRange) {
            priceRange.addEventListener('input', applyFilters);
        }
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', applyFilters);
        });
    });

    function initTooltips() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            if (!tooltipTriggerEl._tooltip) {
                tooltipTriggerEl._tooltip = new bootstrap.Tooltip(tooltipTriggerEl);
            }
        });
    }

    function setCallNowHref() {
        var callNowButtons = document.querySelectorAll('.callNowButton');
        callNowButtons.forEach(function(button) {
            if (window.innerWidth <= 768) {
                button.href = 'tel:+918900909900';
                button.removeAttribute('data-bs-toggle');
                button.removeAttribute('data-bs-target');
                button.removeAttribute('aria-controls');
            } else {
                button.href = 'javascript:void(0);';
                button.addEventListener('click', openOffcanvas);
            }
        });
    }

    function openOffcanvas() {
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasRight'));
        offcanvas.show();
    }

    function initPriceSlider() {
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');
        if (priceRange && priceValue) {
            priceValue.textContent = '₹' + priceRange.value;
            priceRange.addEventListener('input', function() {
                priceValue.textContent = '₹' + this.value;
            });
        }
    }

    function initFilterSections() {
        const filterTitles = document.querySelectorAll('.filter-title');
        filterTitles.forEach(title => {
            const options = title.nextElementSibling;
            const icon = title.querySelector('i');
            options.style.display = 'block';
            title.addEventListener('click', function() {
                if (options.style.display === 'none') {
                    options.style.display = 'block';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    options.style.display = 'none';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });
        });

        const viewMoreLinks = document.querySelectorAll('.view-more');
        viewMoreLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const hiddenOptions = this.previousElementSibling.querySelectorAll('.filter-option.hidden');
                hiddenOptions.forEach(option => {
                    option.classList.toggle('hidden');
                    option.style.display = option.style.display === 'none' ? 'block' : 'none';
                });
                this.textContent = this.textContent === '+ View More' ? '- View Less' : '+ View More';
            });
        });

        const clearFiltersBtn = document.querySelector('.clear-filters');
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.custom-checkbox input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                const searchInput = document.querySelector('.search-input');
                if (searchInput) searchInput.value = '';
                const priceRange = document.getElementById('priceRange');
                if (priceRange) {
                    priceRange.value = priceRange.max;
                    const event = new Event('input');
                    priceRange.dispatchEvent(event);
                }
                applyFilters();
            });
        }
    }

    function applyFilters() {
        const searchInput = document.querySelector('.search-input')?.value.toLowerCase() || '';
        const priceRange = parseInt(document.getElementById('priceRange')?.value) || 20000;
        const checkboxes = document.querySelectorAll('.custom-checkbox input[type="checkbox"]:checked');
        const noResults = document.querySelector('.no-results');
        let filters = {
            suggestions: [],
            stars: [],
            locations: [],
            amenities: []
        };

        checkboxes.forEach(checkbox => {
            const label = checkbox.value;
            const section = checkbox.closest('.filter-section').querySelector('.filter-title span').textContent;
            if (section === 'Suggested For You') filters.suggestions.push(label);
            else if (section === 'Star Category') filters.stars.push(label);
            else if (section === 'Location') filters.locations.push(label);
            else if (section === 'Amenities') filters.amenities.push(label);
        });

        const hotelCards = document.querySelectorAll('.listing-htl-hotel-card');
        let visibleCards = 0;

        hotelCards.forEach(card => {
            const hotelName = card.querySelector('.listing-htl-hotel-title')?.textContent.toLowerCase() || '';
            const priceText = card.querySelector('.listing-htl-price')?.textContent.replace('INR', '').replace(',', '').trim() || '0';
            const price = parseInt(priceText) || 0;
            const location = card.querySelector('.listing-htl-address')?.textContent || '';
            const stars = parseInt(card.dataset.stars) || 0;
            const starLabel = `${stars} Star`;
            const amenities = card.dataset.amenities || '';
            const hasPromotion = !!card.querySelector('.listing-htl-preferred-badge');

            let showCard = true;

            if (searchInput && !hotelName.includes(searchInput)) {
                showCard = false;
            }

            if (price > priceRange) {
                showCard = false;
            }

            if (filters.stars.length > 0 && !filters.stars.includes(starLabel)) {
                showCard = false;
            }

            if (filters.locations.length > 0 && !filters.locations.some(loc => location.includes(loc))) {
                showCard = false;
            }

            if (filters.amenities.length > 0 && !filters.amenities.some(amenity => amenities.includes(amenity))) {
                showCard = false;
            }

            if (filters.suggestions.length > 0) {
                if (filters.suggestions.includes('Top Rated') && stars < 4) {
                    showCard = false;
                }
                if (filters.suggestions.includes('Budget Friendly') && price > 5000) {
                    showCard = false;
                }
                if (filters.suggestions.includes('Best Seller') && !hasPromotion) {
                    showCard = false;
                }
            }

            card.style.display = showCard ? 'block' : 'none';
            if (showCard) visibleCards++;
        });

        if (noResults) {
            noResults.style.display = visibleCards === 0 ? 'block' : 'none';
        }
    }

    window.addEventListener('resize', setCallNowHref);
</script>
@endpush
