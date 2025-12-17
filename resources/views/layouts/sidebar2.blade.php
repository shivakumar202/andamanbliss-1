<div class="hotel-sidebar">
    <form method="GET" action="{{ url()->full() }}">

        <!-- Search by name -->
        <div class="filter-section">
            <div class="filter-title">
                <span>Suggested For You</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-options">
                <input type="text" class="search-input" name="keyword" placeholder="Search by keyword"
                    value="{{ request('keyword') }}">
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox" checked>
                        <span class="checkmark"></span>
                        <span class="label-text">Top Rated</span>
                        <span class="filter-count">108</span>
                    </label>
                </div>
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Best Seller</span>
                        <span class="filter-count">87</span>
                    </label>
                </div>
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Budget Friendly</span>
                        <span class="filter-count">64</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Price Range -->
        <div class="filter-section">
            <div class="filter-title">
                <span>Price Range</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-options">
                <div class="price-slider">
                    <input type="range" min="1000" max="20000" value="5000" class="form-range" id="priceRange">
                    <div class="price-range">
                        <span>₹1,000</span>
                        <span id="priceValue">₹5,000</span>
                        <span>₹20,000</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Star Rating -->
        <div class="filter-section">
            <div class="filter-title">
                <span>Star Category</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-options">
                @for ($i = 9; $i >= 7; $i--)
                @php
                $rating = $i / 2;
                $label = match(true) {
                $rating >= 4.5 => ' (Excellent)',
                $rating >= 4.0 => ' (Very Good)',
                $rating >= 3.5 => ' (Good)',
                default => ''
                };
                @endphp
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="radio" name="ratings[]" value="{{ $rating }}" id="rating{{ $rating }}"
                            class="form-check-input" @checked(in_array($rating, request('ratings', [])))>
                        <span class="checkmark"></span>
                        <span class="label-text">{{ $rating }} &amp; Above{{ $label }}</span>
                        <span class="filter-count">24</span>
                    </label>
                </div>
                @endfor
            </div>
        </div>


        <!-- User Rating -->


        <!-- Property Type -->
        @if (count(@$categories))
        <div class="filter-section">
            <div class="filter-title">
                <span>Filter by Categories</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-options">
                @foreach ($categories as $key => $category)
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="categories[]" value="{{ $category->slug }}" id="category{{ $key }}"
                            class="form-check-input" @checked(in_array($category->slug, request('categories', [])))>
                        <span class="checkmark"></span>
                        <span class="label-text">{{ $category->name }}</span>
                        <span class="filter-count">87</span>
                    </label>
                </div>
                @endforeach

            </div>
        </div>
        @endif

        <!-- Location -->

        <div class="filter-section">
            <div class="filter-title">
                <span>Location</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-options">
                @foreach ($locations as $location)
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="location[]" value="{{ $location }}" id="category{{ $key }}"
                            class="form-check-input" @checked(in_array($location, request('location', [])))>
                        <span class="checkmark"></span>
                        <span class="label-text">{{$location}}</span>
                        <span class="filter-count">108</span>
                    </label>
                </div>
                @endforeach

            </div>
        </div>

        <!-- Amenities -->
        {{-- <div class="filter-section">
            <div class="filter-title">
                <span>Amenities</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-options">
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Free WiFi</span>
                        <span class="filter-count">120</span>
                    </label>
                </div>
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Breakfast Included</span>
                        <span class="filter-count">98</span>
                    </label>
                </div>
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Swimming Pool</span>
                        <span class="filter-count">67</span>
                    </label>
                </div>
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Air Conditioning</span>
                        <span class="filter-count">145</span>
                    </label>
                </div>
                <div class="filter-option">
                    <label class="custom-checkbox">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        <span class="label-text">Restaurant</span>
                        <span class="filter-count">89</span>
                    </label>
                </div>
                <span class="view-more">+ View More</span>
            </div>
        </div> --}}

        <!-- Buttons -->
        <button class="clear-filters">Clear All Filters</button>
        <button class="apply-filters">Apply Filters</button>
    </form>
</div>