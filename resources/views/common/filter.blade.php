<form method="GET" action="{{ url()->full() }}">
    <div>
        <!-- Price Filter -->
    

        <div class="filter-price mb-4">
            <label for="priceRange" class="form-label fw-bold">Filter by Price</label>
            <input type="range" class="form-range" id="priceRange" min="0" max="200000" step="1000">

            <div class="d-flex justify-content-between">
                <span>₹0</span>
                <span id="priceRangeValue">₹2,00,000</span>
            </div>
        </div>



        <!-- Categories Filter -->
        <div class="tour-filter-card">
            <div class="tour-filter-header">
                <h3><i class="fas fa-tag"></i> Activity Categories</h3>
            </div>
            <div class="tour-filter-body">
                @if (count(@$categories))
                @foreach ($categories as $key => $category)
                <div class="tour-filter-checkbox form-check mb-2">
                    <input class="form-check-input" name="categories[]" type="checkbox" value="{{ $category->name }}"
                        id="cat{{ $category->name }}" @checked(in_array($category->slug, request('categories', [])))>
                    <label class="form-check-label" for="cat{{ $category->name }}">
                        {{ $category->name }}
                        <span class="tour-category-count">08</span>
                    </label>
                </div>
                @endforeach
                @endif

            </div>
        </div>

        <!-- Duration Filter -->
        
    </div>
</form>