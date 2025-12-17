@extends('layouts.app')
@section('title', 'Andaman Nicobar Tour Packages - Upto 20% 𝙊𝙛𝙛 Book Now!')
@section('keywords', ' Andaman tour packages, Andaman holidays, Andaman trip, Andaman travel deals, Andaman honeymoon
package, Andaman family tour, cheap Andaman packages, Andaman itinerary, Port Blair, Havelock Island')
@section('description', ' Andaman Bliss offers the best Andaman & Nicobar tour packages for families, friends, and couples - fully customized for a perfect island holiday. Upto 20% Off. Book Now!')


@section('content')
<section class="tour-page-banner">
    <img src="{{ asset('site/img/travelbg.webp') }}" alt="Andaman Tours Banner" />
    <div class="tour-banner-content">
        <h1>Explore the Best Andaman <span style="color: #f9680f;"> Tour Packages</span></h1>
        <div class="subtitle">
            <i class="fas fa-compass me-2"></i>Find awesome hotel, tour, car, ferry and packages
        </div>
    </div>
</section>

@include('common.search2')


<!---top content ----------->

<section>
    <div class="container px-5 py-2 mt-3">
        <div class="row">
            <p>Are you planning a trip to the breathtaking Andaman Islands? Look no further. <strong>Andaman Bliss</strong> is your trusted travel partner, offering a wide range of perfectly curated <strong>Andaman Tour Packages</strong>, starting at just ₹35,000 (approx) for 5 days. With over 100+ thoughtfully designed itineraries, we bring you everything from peaceful beach escapes to thrilling adventure holidays.</p>
            <p>Whether you’re searching for <a href="https://andamanbliss.com/andaman-honeymoon-packages" target="_blank">Andaman Honeymoon Tour Packages</a>, <a href="https://andamanbliss.com/andaman-family-packages" target="_blank">Andaman Family Tour Packages</a>, <a href="https://andamanbliss.com/andaman-group-packages" target="_blank">Andaman Group Tour Packages</a>, or even a well-planned solo getaway, Andaman Bliss has the ideal itinerary waiting for you. We also provide region-specific packages such as Andaman Tour Packages from Chennai, Bangalore, Kolkata, Delhi, and other major cities-making your holiday planning seamless no matter where you travel from.</p>
            <p>As one of the best travel agencies for Andaman tours, <strong>Andaman Bliss</strong> ensures a smooth experience from start to finish. Our packages cover the most stunning destinations across the Andaman & Nicobar Islands-pristine beaches, crystal-clear waters, coral reefs, scenic viewpoints, and exciting water sports. Travelers from India and across the world choose us for a journey filled with comfort, adventure, and unforgettable memories.</p>
            <p>Whether you want a short escape or a long, immersive island vacation, Andaman Bliss makes planning your dream holiday effortless and enjoyable.</p>
            <p>Your perfect Andaman trip starts here-crafted with care, expertise, and a passion for delivering incredible travel experiences.</p>
        </div>
    </div>
</section>
<section id="tour-listing" class="py-5">
    <div class="tour-section-title">
        <h2 class="fs-4">Our Customized Andaman<span> Tour Packages</span></h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">



                <div class="d-flex justify-content-between justify-content-lg-end mb-3">

                    <a class="btn btn-outline-secondary fs-6 d-lg-none p-2 rounded-5 text-center" style="width:100px; height:fit-content;" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        filter <i class="fa-solid fa-filter"></i>
                    </a>

                    <div class="dropdown mb-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            id="priceFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by Price
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="priceFilterDropdown">
                            <li><a class="dropdown-item sort-price" data-sort="low_high" href="#">Price: Low to High</a></li>
                            <li><a class="dropdown-item sort-price" data-sort="high_low" href="#">Price: High to Low</a></li>
                        </ul>
                    </div>

                </div>
                <div class="row ">
                    <!-- Tour Card 1 -->
                    <div class="col-3 sidebars">
                        @include('common.filter2')
                    </div>
                    <div class="col-md-12 col-lg-9 d-lg-flex flex-wrap tour-container justify-content-center">
                        @forelse (@$tours as $key => $tour)
                        @php
                        $rate = $tour->start_price;
                        $price = (int) $tour->discount;
                        $hasDiscount = 0 < $price;
                            $discount=$hasDiscount ? round(($rate * $price) / 100) : 0;
                            $discountAmt=$hasDiscount ? round($discount + $rate) : 0;

                            @endphp
                            <div class="col-lg-4 col-md-6 mb-4 ">
                            <div class="ab-tour-card">
                                <div class="ab-tour-card-header">
                                    @if($tour->discount > 0)
                                    <div class="ab-tour-card-deal">
                                        <span>Exclusive Deal upto {{ number_format($tour->discount,0) }}% <em>-off</em></span>
                                    </div>
                                    @endif
                                    <div class="ab-tour-card-image">
                                        <img src="{{ @$tour->tourPhotos[0]->file }}" alt="{{ __(@$tour->name) }}">
                                        <div class="ab-tour-card-map-btn">
                                            <span class="ab-tour-card-duration">{{ "{$tour->nights}N/{$tour->days}D" }}</span>
                                            <button class="ab-tour-card-map-button">
                                                <i class="fas fa-map-marker-alt"></i> Map
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ab-tour-card-content">
                                    @if($tour->subCategories)
                                    <div class="ab-tour-card-tags">
                                        @foreach($tour->subCategories as $subCategory)
                                        <span class="ab-tour-tag">{{ $subCategory->name }}</span>
                                        @endforeach

                                    </div>
                                    @endif
                                    <h3 class="ab-tour-card-title">
                                        <span class="cat"> {{ ucwords($tour->tourcategory->name) }}</span>
                                        {{ preg_replace('/(\d)(?=[A-Za-z])/', '$1 ', __(@$tour->package_name)) }}
                                    </h3>
                                    @if($tour->islands_covered)
                                    <div class="ab-tour-card-details">
                                        <div class="ab-tour-card-stats">
                                            <span>{{ $key % 3 == 0 ? '1 Package' : '1 Package' }}</span>
                                            <div class="destination-hover">
                                                <span>Destinations</span>
                                                <div class="destination-popup">
                                                    <h6 style="font-size: 0.9rem;">You will visit</h6>
                                                    <ul>
                                                        @foreach( $tour->islands_covered as $island)
                                                        <li>{{ trim($island) }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ab-tour-card-highlights">
                                            <span>Highlights</span>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="ab-tour-card-includes">
                                        <div class="ab-tour-includes-header">
                                            <h4>Tour Includes</h4>
                                            <div class="ab-tour-card-icons">
                                                <span class="ab-tour-icon"><i class="fas fa-hotel"></i></span>
                                                <span class="ab-tour-icon"><i class="fas fa-cab"></i></span>
                                                <span class="ab-tour-icon"><i class="fas fa-ship"></i></span>
                                                <span class="ab-tour-icon"><i class="fas fa-camera"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ab-tour-card-pricing">
                                        <div class="ab-tour-card-price-info">
                                            <span class="ab-tour-card-price-label">All inclusive price</span>
                                            <div class="ab-tour-card-price">
                                                <span class="ab-tour-card-price-currency">₹</span>
                                                <span
                                                    class="ab-tour-card-price-amount">{{ number_format($rate, 2) }}</span>
                                                <span class="ab-tour-card-price-asterisk">*</span>
                                            </div>
                                        </div>
                                        <div class="ab-tour-card-emi">
                                            <div class="ab-tour-card-emi-icon">
                                                <i class="fas fa-credit-card"></i>
                                            </div>
                                            <div class="ab-tour-card-emi-details">
                                                <span class="ab-tour-card-emi-label">Partial Pay</span>
                                                <span class="ab-tour-card-emi-amount">Available</span>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $hasInputs = !empty($inputs) && array_filter($inputs, fn($v) => !is_null($v) && $v !== []);
                                    @endphp
                                    <div class="ab-tour-card-actions">
                                        @if($hasInputs)
                                        <form class="w-100" action="{{ route('tour.itinerary', ['category' => Str::slug($tour['sub_cat']), 'slug' => $tour['tourCategory']['slug'], 'subslug' => $tour['slug']]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="inputs" id="inputsData" value='@json($inputs)'>
                                            <input type="hidden" name="package" value="{{$tour['slug']}}">
                                            <div class="w-100 d-flex justify-content-end align-items-center gap-2">
                                                <button type="submit" class="ab-tour-card-btn ab-tour-view-btn " style="width: 100;">
                                                    View Tour
                                                </button>
                                                <button type="submit" class="ab-tour-card-btn ab-tour-book-btn w-100">
                                                    Book Now
                                                </button>
                                            </div>
                                        </form>

                                        @else
                                        <a href="{{ route('tour.static', ['category' => Str::slug($tour['sub_cat']), 'slug' => $tour['tourCategory']['slug'], 'subslug' => $tour['slug']]) }}"
                                            class="ab-tour-card-btn ab-tour-view-btn">View Tour</a>
                                        <a href="{{ route('tour.static', ['category' => Str::slug($tour['sub_cat']), 'slug' => $tour['tourCategory']['slug'], 'subslug' => $tour['slug']]) }}" class="ab-tour-card-btn ab-tour-book-btn">Book Online</a>
                                        @endif
                                    </div>

                                    <div class="ab-tour-card-contact">
                                        <a href="https://wa.me/918900909900?text={{ rawurlencode('Hi! I’m interested in the ' . $tour->package_name . ' (' . $tour->tourcategory->name . ' - ' . $tour->sub_cat . ') package. Please share the detailed itinerary and pricing.') }}" target="_blank" class="ab-tour-card-whatsapp">
                                            <i class="fab fa-whatsapp"></i> Request Callback
                                        </a>

                                        <a href="#" class="ab-tour-card-itinerary" data-bs-toggle="modal"
                                            data-bs-target="#getItineraryModal" data-tour="{{ $tour->package_name }} - {{ $tour->tourcategory->name }} - {{ $tour->sub_cat }}">
                                            <i class="fas fa-envelope"></i> Get Itinerary
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="text-center mt-4 mb-5 {{ $tours->hasMorePages()  }}"
            id="load-more-container">
            <button class="tour-load-more" id="load-more-btn">
                <i class="fas fa-spinner fa-spin d-none" id="load-spinner"></i> Load more packages
            </button>
        </div>
    </div>

</section>

<div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
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
                    <h3><i class="fas fa-tag"></i> Tour Categories</h3>
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
                <button class="btn btn-sm btn-primary" data-bs-dismiss="offcanvas" aria-label="Close">Apply</button>

                </div>
            </div>

            <!-- Duration Filter -->
            <div class="tour-filter-card">
                <div class="tour-filter-header">
                    <h3><i class="fas fa-calendar-alt"></i> Tour Duration</h3>
                </div>
                <div class="tour-filter-body">
                    <div class="tour-filter-checkbox form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="duration[]" value="3n4d" id="day1">
                        <label class="form-check-label" for="day1">
                            3 Nights & 4 Days
                        </label>
                    </div>
                    <div class="tour-filter-checkbox form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="duration[]" value="4n5d" id="day2">
                        <label class="form-check-label" for="day2">
                            4 Nights & 5 Days
                        </label>
                    </div>
                    <div class="tour-filter-checkbox form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="duration[]" value="5n6d" id="day3">
                        <label class="form-check-label" for="day3">
                            5 Nights & 6 Days
                        </label>
                    </div>
                    <div class="tour-filter-checkbox form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="duration[]" value="6n7d" id="day4">
                        <label class="form-check-label" for="day4">
                            6 Nights & 7 Days
                        </label>
                    </div>
                    <div class="tour-filter-checkbox form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="duration[]" value="7n8d" id="day5">
                        <label class="form-check-label" for="day5">
                            7 Nights & 8 Days
                        </label>
                    </div>
                    <button class="btn btn-sm btn-primary" data-bs-dismiss="offcanvas" aria-label="Close">Apply</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Andamanbliss Tour Packages Section -->
<div class="container">
    <div class="tour-andamanbliss-section mt-3">
        <h2 class="tour-andamanbliss-title">Andaman Tour Packages<span> - Your Dream Island Vacation Starts Here </span></h2>
        <p class="tour-andamanbliss-text">
            Are you planning a trip to the breathtaking Andaman Islands? You’ve just found the right place. Andaman Bliss, your trusted travel partner, brings you a wide range of Andaman Tour Packages, starting at just ₹35,000 (approx) for 5 days.
            <a href="#" class="tour-andamanbliss-read-more" id="andamanbliss-toggle-btn">Read More</a>
        </p>
    </div>
</div>

<!---read more content ------------>
<div class="container">
    <div class="row">
        <div class="read-more-container">
            <div class="more-text" style="display: none;">
                <div class="tour-andamanbliss-packages m-0">
                    <div class="tour-andamanbliss-packages-header">
                        <h3>Andaman Tour Packages</h3>
                        <div class="duration-price">
                            <div class="col">Duration</div>
                            <div class="col">Price </div>
                        </div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="https://andamanbliss.com/andaman-honeymoon-packages/">Andaman Honeymoon
                                Tour</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">5 Nights & 6 Days</div>
                        <div class="tour-andamanbliss-package-price">INR 22,500 ~PP</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="https://andamanbliss.com/andaman-family-packages/">A Family Trip To Andaman</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">6 Nights & 7 Days</div>
                        <div class="tour-andamanbliss-package-price">INR 13,250 ~PP</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="https://andamanbliss.com/andaman-adventure-packages/">Backpacking Trip To The Islands</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">8 Nights & 9 Days</div>
                        <div class="tour-andamanbliss-package-price">INR 40,200 ~PP</div>
                    </div>
                    <div class="tour-andamanbliss-package-item">
                        <div class="tour-andamanbliss-package-name">
                            <a href="https://andamanbliss.com/andaman-honeymoon-packages/">Romantic Honeymoon At
                                Andaman</a>
                        </div>
                        <div class="tour-andamanbliss-package-duration">6 Nights & 7 Days</div>
                        <div class="tour-andamanbliss-package-price">INR 25,500 ~PP</div>
                    </div>

                    <div class="tour-andamanbliss-package-item">
                        <span class="text-danger" style="font-size:10px;">Note: These prices might vary according to
                            your preferences.</span>
                    </div>
                </div>

                <div class="tour-andamanbliss-description">
                    <p>Are you planning a trip to the breathtaking Andaman Islands? You’ve just found the right place. Andaman Bliss, your trusted travel partner, brings you a wide range of Andaman Tour Packages, starting at just ₹35,000 (approx) for 5 days.</p>

                    <p class="mt-3">With more than 100+ carefully curated itineraries, we offer everything-from peaceful beach escapes and luxury island stays to adventure-filled water sports holidays. Whether you’re looking for <a href="https://andamanbliss.com/andaman-honeymoon-packages" target="_blank">Andaman Honeymoon Tour Packages</a>, <a href="https://andamanbliss.com/andaman-family-packages" target="_blank">Andaman Family Tour Packages</a>, <a href="https://andamanbliss.com/andaman-group-packages" target="_blank">Andaman Group Tour Packages</a>, or a plan for solo travelers, we have options designed for every type of visitor. We also offer tailored packages like Andaman Tour Packages from Chennai, Bangalore, Kolkata, and other major Indian cities, ensuring a smooth travel experience no matter where you begin your journey.</p>

                    <p class="mt-3">Our packages are flexible-you can choose a short getaway, a long island vacation, or a fully customized itinerary. Planning your Andaman holiday with us is easy, enjoyable, and truly unforgettable.</p>

                    <div>
                        <h2 class="fs-6 fw-bold mt-2">Andaman Tour Packages from All Major Indian Cities</h2>
                        <p>Whether you're traveling from a metro city, a state capital, or a popular regional destination, Andaman Bliss offers convenient and fully </strong>customized Andaman Tour Packages</strong> from almost every major city in India.</p>

                        <p class="mt-2">
                            No matter where your journey begins, we make sure your trip to the Andaman Islands is smooth, affordable, and unforgettable.
                        </p>

                        <p class="mt-2">


                            Below is the complete list of cities we serve:
                        </p>
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <p><a href="#">Andaman Tour Packages from Delhi</a></p>
                            <p><a href="#">Andaman Tour Packages from Mumbai</a></p>
                            <p><a href="#">Andaman Tour Packages from Bangalore</a></p>
                            <p><a href="#">Andaman Tour Packages from Chennai</a></p>
                            <p><a href="#">Andaman Tour Packages from Kolkata</a></p>
                            <p><a href="#">Andaman Tour Packages from Hyderabad</a></p>
                            <p><a href="#">Andaman Tour Packages from Pune</a></p>
                            <p><a href="#">Andaman Tour Packages from Ahmedabad</a></p>
                            <p><a href="#">Andaman Tour Packages from Jaipur</a></p>
                            <p><a href="#">Andaman Tour Packages from Surat</a></p>
                            <p><a href="#">Andaman Tour Packages from Lucknow</a></p>
                            <p><a href="#">Andaman Tour Packages from Indore</a></p>
                            <p><a href="#">Andaman Tour Packages from Bhopal</a></p>
                            <p><a href="#">Andaman Tour Packages from Kochi (Cochin)</a></p>
                            <p><a href="#">Andaman Tour Packages from Chandigarh</a></p>
                            <p><a href="#">Andaman Tour Packages from Patna</a></p>
                            <p><a href="#">Andaman Tour Packages from Nagpur</a></p>
                            <p><a href="#">Andaman Tour Packages from Visakhapatnam (Vizag)</a></p>
                            <p><a href="#">Andaman Tour Packages from Kanpur</a></p>
                            <p><a href="#">Andaman Tour Packages from Vadodara</a></p>
                            <p><a href="#">Andaman Tour Packages from Nashik</a></p>
                            <p><a href="#">Andaman Tour Packages from Vijayawada</a></p>
                            <p><a href="#">Andaman Tour Packages from Raipur</a></p>
                            <p><a href="#">Andaman Tour Packages from Ranchi</a></p>
                            <p><a href="#">Andaman Tour Packages from Dehradun</a></p>
                            <p><a href="#">Andaman Tour Packages from Bhubaneswar</a></p>
                            <p><a href="#">Andaman Tour Packages from Guwahati</a></p>
                            <p><a href="#">Andaman Tour Packages from Mysore</a></p>
                            <p><a href="#">Andaman Tour Packages from Mangalore</a></p>
                            <p><a href="#">Andaman Tour Packages from Coimbatore</a></p>
                            <p><a href="#">Andaman Tour Packages from Thiruvananthapuram (Trivandrum)</a></p>
                            <p><a href="#">Andaman Tour Packages from Udaipur</a></p>
                            <p><a href="#">Andaman Tour Packages from Jodhpur</a></p>
                            <p><a href="#">Andaman Tour Packages from Jaisalmer</a></p>
                            <p><a href="#">Andaman Tour Packages from Ayodhya</a></p>
                            <p><a href="#">Andaman Tour Packages from Kodaikanal</a></p>
                            <p><a href="#">Andaman Tour Packages from Ooty</a></p>
                            <p><a href="#">Andaman Tour Packages from Munnar</a></p>
                            <p><a href="#">Andaman Tour Packages from Goa</a></p>
                            <p><a href="#">Andaman Tour Packages from Dwarka</a></p>
                            <p><a href="#">Andaman Tour Packages from Shirdi</a></p>
                            <p><a href="#">Andaman Tour Packages from Aurangabad</a></p>
                            <p><a href="#">Andaman Tour Packages from Gwalior</a></p>
                            <p><a href="#">Andaman Tour Packages from Agra</a></p>
                            <p><a href="#">Andaman Tour Packages from Jammu</a></p>
                            <p><a href="#">Andaman Tour Packages from Srinagar</a></p>
                            <p><a href="#">Andaman Tour Packages from Amritsar</a></p>
                            <p><a href="#">Andaman Tour Packages from Ludhiana</a></p>
                            <p><a href="#">Andaman Tour Packages from Jalandhar</a></p>
                            <p><a href="#">Andaman Tour Packages from Noida</a></p>
                            <p><a href="#">Andaman Tour Packages from Ghaziabad</a></p>
                            <p><a href="#">Andaman Tour Packages from Faridabad</a></p>
                            <p><a href="#">Andaman Tour Packages from Gurugram (Gurgaon)</a></p>
                            <p><a href="#">Andaman Tour Packages from Madurai</a></p>
                            <p><a href="#">Andaman Tour Packages from Tiruchirappalli (Trichy)</a></p>
                            <p><a href="#">Andaman Tour Packages from Salem</a></p>
                            <p><a href="#">Andaman Tour Packages from Hubli</a></p>
                            <p><a href="#">Andaman Tour Packages from Belgaum</a></p>
                            <p><a href="#">Andaman Tour Packages from Warangal</a></p>
                            <p><a href="#">Andaman Tour Packages from Nellore</a></p>
                            <p><a href="#">Andaman Tour Packages from Tirupati</a></p>
                            <p><a href="#">Andaman Tour Packages from Solapur</a></p>
                            <p><a href="#">Andaman Tour Packages from Nanded</a></p>
                            <p><a href="#">Andaman Tour Packages from Kolhapur</a></p>
                            <p><a href="#">Andaman Tour Packages from Rajkot</a></p>
                            <p><a href="#">Andaman Tour Packages from Jamnagar</a></p>
                            <p><a href="#">Andaman Tour Packages from Siliguri</a></p>
                            <p><a href="#">Andaman Tour Packages from Durgapur</a></p>
                            <p><a href="#">Andaman Tour Packages from Asansol</a></p>
                            <p><a href="#">Andaman Tour Packages from Cuttack</a></p>
                            <p><a href="#">Andaman Tour Packages from Dhanbad</a></p>
                            <p><a href="#">Andaman Tour Packages from Puri</a></p>
                            <p><a href="#">Andaman Tour Packages from Muzaffarpur</a></p>
                            <p><a href="#">Andaman Tour Packages from Shillong</a></p>
                            <p><a href="#">Andaman Tour Packages from Aizawl</a></p>
                            <p><a href="#">Andaman Tour Packages from Imphal</a></p>
                            <p><a href="#">Andaman Tour Packages from Dimapur</a></p>
                            <p><a href="#">Andaman Tour Packages from Gangtok</a></p>
                            <p><a href="#">Andaman Tour Packages from Agartala</a></p>
                            <p><a href="#">Andaman Tour Packages from Itanagar</a></p>
                        </div>


                        <div>
                            <h2 class="fs-6 fw-bold mt-3">
                                Ready-Made Itineraries for Your Andaman Trip
                            </h2>
                            <h3 class="fs-6 mt-2"><em>3 Nights 4 Days Andaman Tour - Port Blair Island</em></h3>
                            <p>Destinations Covered: Port Blair, Cellular Jail, Corbyn’s Cove Beach, Ross Island, North Bay</p>

                            <ul class="tour-master-index-list">
                                <h4 class="fw-bold mt-2 tour-iti-sub-heading">Day 1 - Arrival + Cellular Jail + Light & Sound Show</h4>
                                <li>Arrive at Veer Savarkar Airport, Port Blair</li>
                                <li>Transfer to hotel and relax.</li>
                                <li>Visit <a href="https://andamanbliss.com/islands/port-blair/cellular-jail" target="_blank">Cellular Jail.</a></li>
                                <li>Enjoy the <a href="https://andamanbliss.com/activity/show-in-cellular-jail" target="_blank">Light & Sound Show in the evening.</a></li>
                                <li>Overnight stay in Port Blair.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 2 - Corbyn’s Cove Beach + City Tour</h4>
                                <li>Breakfast at hotel.</li>
                                <li>Visit <a href="https://andamanbliss.com/islands/port-blair/corbyns-cove" target="_blank">Corbyn’s Cove Beach</a> (swimming & leisure).</li>
                                <li>Explore local markets and museum.</li>
                                <li>Optional water sports.</li>
                                <li>Stay overnight at the hotel.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 3 - Ross Island & North Bay Island Tour</h4>
                                <li>Take a boat to <a href="https://andamanbliss.com/islands/port-blair/ross-island" target="_blank">Ross Island</a> (colonial ruins, deer, peacocks).</li>
                                <li>Continue to <a href="https://andamanbliss.com/islands/port-blair/north-bay-island" target="_blank">North Bay Island</a> (corals, snorkelling, glass-bottom boat).</li>
                                <li>Return to hotel for overnight stay.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 4 - Departure</h4>
                                <li>Airport drop.</li>
                                <li>Trip concludes with beautiful island memories.</li>
                            </ul>
                            <!-- Book Now Button -->
                            <div class="text-end bg-light" style="font-size:14px;"><a href="#" target="_blank"
                                    rel="noopener noreferrer">Book Now</a></div>

                        </div>

                        <div>
                            <h3 class="tour-iti-sub-heading mt-2"><em>4 Nights 5 Days Andaman Tour - Port Blair | Havelock Island</em></h3>
                            <p>Destinations Covered: Port Blair, Havelock, Radhanagar Beach, Elephant Beach</p>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 1 - Arrival + Cellular Jail + Light & Sound Show</h4>
                                <li>Arrive at Port Blair.</li>
                                <li>Visit <a href="https://andamanbliss.com/islands/port-blair/cellular-jail" target="_blank">Cellular Jail</a> & <a href="https://andamanbliss.com/islands/port-blair/corbyns-cove" target="_blank">Corbyn’s Cove Beach</a>.</li>
                                <li>Light & Sound Show (optiona).</li>
                            </ul>
                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 2 - Ferry to Havelock + Radhanagar Beach</h4>
                                <li>Ride to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep" target="_blank">Havelock Island</a> via luxury ferry.</li>
                                <li>Check-in & relax.</li>
                                <li>Evening visit to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach" target="_blank">Radhanagar Beach</a> (Asia’s Top Beach).</li>
                                <li>Overnight at Havelock.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 3 - Elephant Beach Tour</h4>
                                <li>Speed boat to <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/elephant-beach" target="_blank">Elephant Beach</a>.</li>
                                <li>Complimentary snorkelling session.</li>
                                <li>Water sports available.</li>
                                <li>Evening at leisure.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 4 - Back to Port Blair</h4>
                                <li>Kalapathar Beach visit (optional).</li>
                                <li>Ferry back to Port Blair.</li>
                                <li>Overnight stay.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 5 - Departure</h4>
                                <li>Airport drop.</li>
                            </ul>
                            <!-- Book Now Button -->
                            <div class="text-end" style="font-size:14px;"><a href="#" target="_blank"
                                    rel="noopener noreferrer">Book Now</a></div>
                        </div>
                        <div>
                            <h3 class="fs-6 mt-2"><em>5 Nights 6 Days Andaman Tour - Port Blair | Havelock Island</em></h3>
                            <p>Destinations: Port Blair • Havelock • Elephant Beach • Radhanagar</p>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 1 - Arrival & City Sightseeing</h4>
                                <li>Airport pickup.</li>
                                <li>Visit anthropological museum, <a href="https://andamanbliss.com/islands/port-blair/corbyns-cove" target="_blank">Corbyn’s Cove</a>, Cellular Jail.</li>
                                <li>Evening Light & Sound Show.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 2 - Ferry to Havelock</h4>
                                <li>Premium ferry to Havelock.</li>
                                <li>Check-in & leisure time.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 3 - Elephant Beach + Radhanagar Sunset</h4>
                                <li><a href="https://andamanbliss.com/activity/snorkeling-in-elephant-beach" target="_blank">Snorkelling</a> at Elephant Beach.</li>
                                <li>Relax at Radhanagar Beach.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 4 - Havelock to Port Blair</h4>
                                <li>Kalapathar Beach visit.</li>
                                <li>Return to Port Blair.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 5 - Ross & North Bay Island Tour</h4>
                                <li>Visit <a href="https://andamanbliss.com/islands/port-blair/ross-island" target="_blank">Ross Island</a>.</li>
                                <li>Water sports at North Bay.</li>
                            </ul>

                            <ul class="tour-master-index-list">
                                <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 6 - Departure</h4>
                                <li>End of your journey.</li>
                            </ul>

                            <div>
                                <h3 class="fs-6 mt-2"><em>6 Nights 7 Days Andaman Tour - Port Blair | Neil Island | Havelock Island</em></h3>
                                <p>Destinations: Port Blair • Neil Island • Havelock Island </p>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 1 - Arrival & City Tour</h4>
                                    <li>Airport pickup.</li>
                                    <li>Explore <a href="https://andamanbliss.com/islands/port-blair/corbyns-cove" target="">Corbyn’s Cove Beach</a>.</li>
                                    <li>Cellular Jail + Light & Sound Show.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 2 - Ferry to Havelock + Radhanagar Beach</h4>
                                    <li>Ride to Havelock Island.</li>
                                    <li>Evening at <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/radhanagar-beach" target="_blank">Radhanagar Beach</a>.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 3 - Elephant Beach Adventure</h4>
                                    <li>Complimentary snorkelling.</li>
                                    <li>Try jetski, banana ride, parasailing.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 4 - Kalapathar Beach + Neil Island Transfer</h4>
                                    <li>Visit <a href="https://andamanbliss.com/islands/havelock-swaraj-dweep/kalapathar-beach" target="_blank">Kalapathar Beach</a>.</li>
                                    <li>Board ferry to Neil Island.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 5 - Neil Island Sightseeing</h4>
                                    <li>Bharatpur Beach</li>
                                    <li>Laxmanpur Beach (beautiful sunset)</li>
                                    <li><a href="https://andamanbliss.com/islands/neil-shaheed-dweep/natural-rock" target="_blank">Natural Bridge</a> (Howrah Bridge).</li>
                                    <li>Return to Port Blair.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 6 - Baratang Day Trip (Optional)</h4>
                                    <li>Limestone Caves</li>
                                    <li>Mud Volcano</li>
                                    <li>Mangrove creek boat ride.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 7 - Departure</h4>
                                    <li>End your journey</li>
                                </ul>

                                <h3 class="fs-6 mt-2"><em>7 Nights 8 Days Andaman Tour - Port Blair | Neil Island | Havelock Island </em></h3>
                                <p>Destinations: Port Blair • Neil • Havelock • Ross • Viper Island</p>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 1 - Arrival + Ross Island + North Bay + Viper Island</h4>
                                    <li>Explore all 3 islands in a single boat trip.</li>
                                    <li>Return to hotel.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 2 - Ferry to Neil Island</h4>
                                    <li>Transfer & leisure day.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 3 - Full Day Neil Sightseeing</h4>
                                    <li>Natural Bridge.</li>
                                    <li>Bharatpur Beach (water sports).</li>
                                    <li>Laxmanpur Beach sunset</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 4 - Transfer to Havelock</h4>
                                    <li>Ferry from Neil to Havelock.</li>
                                    <li>Hotel check-in.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 5 - Elephant Beach + Radhanagar Beach</h4>
                                    <li>Snorkelling at Elephant Beach.</li>
                                    <li>Evening at Radhanagar.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 6 - Kalapathar Beach + Ferry to Port Blair</h4>
                                    <li>Visit Kalapathar Beach.</li>
                                    <li>Return to Port Blair.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 7 - Mount Harriet National Park</h4>
                                    <li>Explore trekking routes, wildlife, viewpoints.</li>
                                </ul>

                                <ul class="tour-master-index-list">
                                    <h4 class="tour-iti-sub-heading fw-bold mt-2">Day 8 - Departure</h4>
                                    <li>End of your journey.</li>
                                </ul>

                                <h3 class="fs-6 mt-2"><em>8 Nights 9 Days Andaman Tour - Port Blair | Neil Island | Havelock Island </em></h3>
                                <p>(This covers everything above plus extended sightseeing)</p>
                                <ul class="styled_li">
                                    <li>Port Blair city tour.</li>
                                    <li>Ross, North Bay & Viper.</li>
                                    <li>Neil Island 2 days.</li>
                                    <li>Havelock 2-3 days.</li>
                                    <li>Elephant Beach + Radhanagar.</li>
                                    <li>Baratang (Limestone Caves).</li>
                                    <li>Mt Harriet.</li>
                                    <li>Extra leisure day & photography day.</li>
                                </ul>

                                <h3 class="fs-6 mt-2"><em>9 Nights 10 Days Andaman Tour - Port Blair | Neil Island | Havelock Island </em></h3>
                                <p>Full Andaman Experience</p>
                                <ul class="styled_li">
                                    <li>Port Blair (City + Museums + Beaches).</li>
                                    <li>Ross Island.</li>
                                    <li>North Bay Island.</li>
                                    <li>Viper Island</li>
                                    <li>Havelock Island (Radhanagar, Elephant Beach, Kalapathar).</li>
                                    <li>Neil Island (Bharatpur, Laxmanpur & Natural Bridge).</li>
                                    <li>Baratang (Limestone Caves & Mud Volcano).</li>
                                    <li>Diglipur (optional - twin volcanoes & turtle nesting).</li>
                                    <li>Mount Harriet National Park.</li>
                                    <li>Extra day for relaxation & shopping.</li>
                                    <p>Perfect for: honeymooners, families, senior citizens, and group travellers wanting complete coverage.</p>
                                </ul>

                                <!-- Book Now Button -->
                                <div class="text-end" style="font-size:14px;"><a href="#" target="_blank"
                                        rel="noopener noreferrer">Book Now</a></div>

                                <p class="mt-2">These are a few sample itineraries. Please contact Andaman Bliss to customize
                                    your perfect trip.</p>
                            </div>

                            <div>
                                <h2 class="fs-6 fw-bold mt-2">
                                    Andaman Tour Packages for Group
                                </h2>
                                <p class="mt-2">
                                    Traveling in a group is all about adventure, bonding, and shared experiences-and the Andaman Islands are the ideal destination for that. Our Andaman Tour Packages for Group are perfect for college groups, corporate trips, friends’ trips, community groups, wedding groups, and large family gatherings.
                                </p>
                                <p>At Andaman Bliss, we specialize in handling group tours of all sizes. From 6 people to 100+ people, we manage everything-hotels, ferries, buses, sightseeing, water sports, group meals, and customized itineraries. We ensure everyone in the group has a great time with smooth arrangements throughout the tour.</p>
                                <p>Group-focused itineraries include:</p>
                                <ul class="styled_li pb-3">
                                    <li>Port Blair sightseeing - Museums, Cellular Jail, Light & Sound Show.</li>
                                    <li>Adventure activities - Scuba diving, snorkeling, kayaking, sea walk.></li>
                                    <li>Havelock Island - Radhanagar Beach and Elephant Beach activities.</li>
                                    <li>Neil Island - Group activities on the beach.</li>
                                    <li>Ross Island and North Bay - Short island-hopping adventures.</li>
                                    <li>Cruise rides - Group discounts on premium ferries.</li>
                                </ul>
                                <p class="mt-3">
                                    <strong class="mt-3">Why choose Andaman Tour Packages for group travel:</strong>
                                </p>
                                <ul class="styled_li">
                                    <li>Best pricing with group discounts.</li>
                                    <li>Large private vehicles for group transfers.</li>
                                    <li>Flexibility in hotel and resort selection.</li>
                                    <li>Add-on activities for big groups.</li>
                                    <li>Dedicated tour managers for on-ground support.</li>
                                    <li>Fully customizable itineraries.</li>
                                    <p>Whether it’s a college trip, friends’ getaway, or corporate retreat, we make sure your group enjoys the best of Andaman-smooth, fun, safe, and hassle-free.</p>
                                </ul>

                                <h2 class="fs-6 fw-bold mt-2">
                                    Honeymoon Tour Packages for Andaman
                                </h2>
                                <p class="mt-2">
                                    A honeymoon is the beginning of a lifetime of memories-and the Andaman Islands offer the perfect romantic escape for newlyweds. With turquoise beaches, white-sand shores, secluded islands, candlelight dinners, luxury resorts, and dreamy sunsets, our Honeymoon Tour Packages for Andaman are designed to give couples an unforgettable start to their journey together.
                                </p>
                                <p>At Andaman Bliss, we curate personalized Andaman Tour Packages that include romantic candlelight dinners, flower bed decorations, private beach moments, sunset cruises, and exclusive water activities for couples. Whether you want a quiet and peaceful honeymoon or an adventurous one filled with diving, kayaking, and island hopping-we tailor your package exactly to your preferences.</p>
                                <p>Our honeymoon itineraries include must-visit romantic destinations like:</p>
                                <ul class="styled_li">
                                    <li>Havelock Island (Swaraj Dweep) - Asia’s most romantic beach, Radhanagar.</li>
                                    <li>Neil Island (Shaheed Dweep) - The perfect place for peaceful moments.</li>
                                    <li>Port Blair - History, beaches, city life and cafes.</li>
                                    <li>Elephant Beach - Snorkeling, sea walk & underwater photography.</li>
                                    <li>Kalapathar Beach - Sunrise spot for couples.</li>
                                    <li>Ross & North Bay Islands - Fun activities and stunning sea views.</li>
                                </ul>
                                <p class="mt-3">
                                    <strong>Couples booking Andaman Honeymoon Tour Packages enjoy:</strong>
                                </p>
                                <ul class="styled_li">
                                    <li>Private transfers and premium resorts.</li>
                                    <li>Sunset cruises and romantic dinners.</li>
                                    <li>Adventure activities curated for two.</li>
                                    <li>Add-on activities for big groups.</li>
                                    <li>Beautiful decorations and add-ons.</li>
                                    <li>Complimentary couple experiences (varies by package)</li>
                                    <p>Whether you prefer 3N/4D, 4N/5D, 5N/6D or extended luxury Andaman Tour Packages, we ensure your honeymoon feels like a dream you never want to end.</p>
                                </ul>

                                <h3 class="fs-6 fw-bold mt-2">Andaman Tour Packages for Family</h3>
                                <p class="mt-2">Planning a family holiday? The Andaman Islands are one of India’s safest, most family-friendly, and most scenic destinations. With clean beaches, calm waters, historical attractions, wildlife parks, and guided tours, our Andaman Tour Packages for Family offer the perfect balance of fun, comfort, and relaxation.</p>

                                <p class="mt-2">At Andaman Bliss, we understand that every family has different needs-whether you are traveling with kids, parents, or large families. That’s why we design customized itineraries that include comfortable hotels, kid-friendly activities, safe water adventures, and hassle-free travel planning.</p>

                                <h2 class="fs-6 fw-bold mt-2">Our family-friendly itineraries typically include:</h2>
                                <ul class="tour-master-index-list">
                                    <li>Port Blair - Cellular Jail, Museums, Corbyn’s Cove, Marina Park.</li>
                                    <li>Port Blair - Cellular Jail, Museums, Corbyn’s Cove, Marina Park.</li>
                                    <li>Havelock Island - Radhanagar Beach, safe for kids to play.</li>
                                    <li>Neil Island - Laxmanpur Beach sunset & natural rock formation.</li>
                                    <li>Mount Harriet National Park - Nature walk and wildlife sightings.</li>
                                    <li>Chidiyatapu Biological Park - Great spot for kids and nature lovers.</li>
                                </ul>

                                <h2 class="fs-6 fw-bold mt-2">Why families love our Andaman Tour Packages:</h2>
                                <ul class="tour-master-index-list">
                                    <li>Safe transportation and comfortable stays.</li>
                                    <li>Activities suitable for all ages.</li>
                                    <li>Enough leisure time to relax without rushing.</li>
                                    <li>Personalized itineraries based on family preferences.</li>
                                    <li>Experienced local team available throughout the trip.</li>
                                    <li>Options for vegetarian/jain meals.</li>
                                    <p>Whether it’s a small family holiday or a big family vacation, we ensure your Andaman trip is smooth, well-planned, and filled with lifelong memories.</p>
                                </ul>
                            </div>

                            <div>

                                <h2 class="fs-6 fw-bold mt-2">
                                    Why Choose Andaman Bliss For Your Andaman Tour Packages?
                                </h2>
                                <ol class="tour-master-index-list">
                                    <li>Customizable Itineraries: Every itinerary can be modified as per your travel style, duration, and preferences.
                                    </li>
                                    <li>
                                        Expert Guidance: Our experienced travel experts share insights, tips, and recommendations to make your trip seamless.
                                    <li>
                                        Best Prices Guaranteed: Get top-quality experiences, exclusive deals, and value-packed packages.
                                    </li>
                                    <li>
                                        Local Experience Advantage: Discover hidden gems, authentic local culture, and insider tips known only to locals.
                                    </li>

                                    <li>
                                        Hassle-Free Booking: Choose your tour, confirm your date, and leave the rest to us.
                                    </li>
                                    <li>
                                        24/7 Travel Support: Our team is available round the clock to assist you throughout your journey.
                                    </li>
                                </ol>

                                <p class="mt-2">Andaman Bliss makes sure that you are well guided through these must visit
                                    islands so that you can have the best experience on your visit to the islands.</p>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Offcanvas -->
<div class="offcanvas tour-contact-offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel" class="fw-bold">Contact Us</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="tour-contact-item">
            <h6><i class="fas fa-users"></i> Group Tours</h6>
            <p>+91 8900909900</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-heart"></i> Honeymoon Packages</h6>
            <p>+91 9933202248</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-building"></i> Corporate Travel</h6>
            <p>+91 9679503320</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-headset"></i> 24x7 Support</h6>
            <p>+91 9531972987</p>
        </div>
        <div class="tour-contact-item">
            <h6><i class="fas fa-clock"></i> Office Hours</h6>
            <p>9:00 AM to 7:00 PM</p>
        </div>
        <div class="tour-contact-links">
            <a href="#" class="tour-contact-link">Contact Us</a>
            <a href="#" class="tour-contact-link">Our Branches</a>
        </div>
    </div>
</div>
<!--lead model-->
<div class="modal fade" id="getItineraryModal" tabindex="-1" aria-labelledby="getItineraryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                style="position: absolute; right: 10px; top: 10px; z-index: 1050;"></button>
            <div class="modal-body p-0">
                <div class="itinerary-modal-content">
                    <div class="itinerary-modal-image">
                        <img src="https://www.kesari.in/assets/img/tourenquiry.jpg" alt="Itinerary Image"
                            class="img-fluid">
                    </div>
                    <div class="itinerary-modal-form p-4">
                        <h5 class="mb-3">Here are the itinerary and pricing details for your upcoming tour.</h5>
                        <form method="POST" action="{{ route('contact') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <input type="text" hidden class="form-control" name="tour" id="tourNameInput" value="" required>
                            <input type="text" hidden name="website" id="website">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email address" required>
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control" name="mobile" placeholder="Mobile" required>
                            </div>
                            <input type="text" class="form-control" hidden value="Package Ititnerary Request" name="message">
                            <button type="submit" class="btn btn-danger w-100 py-2 d-flex justify-content-center">Send
                                Itinerary</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style type="text/css">
    /* Modern Tours Page Styles */
    .tour-page-banner {
        position: relative;
        height: 500px;
        overflow: hidden;
    }

    .lst-apply-btn {
        background: #03A9F4;
        color: #fff;
        border: none;
        padding: 5px 15px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 12px;
        font-weight: 500;
    }

    .tour-page-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.8);
    }

    .tour-banner-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 100%;
        max-width: 800px;
        z-index: 2;
    }

    .tour-banner-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .tour-banner-content .subtitle {
        font-size: 0.875rem;
        color: white;
        background-color: rgba(17, 157, 213, 0.8);
        display: inline-block;
        padding: 0.5rem 1.5rem;
        border-radius: 30px;
        margin-top: 1rem;
    }

    .tour-section-title {
        position: relative;
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .tour-section-title h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: rgb(17, 157, 213);
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }

    .tour-section-title h2 span {
        color: #f9680f;
    }

    .tour-section-title h2:after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, rgb(17, 157, 213), rgb(0, 206, 255));
    }

    /* Filter Sidebar Styles */
    .tour-filter-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
        border: none;
    }

    .tour-filter-header {
        background-color: rgba(17, 157, 213, 0.1);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(17, 157, 213, 0.1);
    }

    .tour-filter-header h3 {
        font-size: 1rem;
        font-weight: 600;
        color: rgb(17, 157, 213);
        margin: 0;
        display: flex;
        align-items: center;
    }

    .tour-filter-header h3 i {
        margin-right: 0.5rem;
    }

    .tour-filter-body {
        padding: 1.5rem;
    }

    .tour-filter-search .form-control {
        border-radius: 50px 0 0 50px;
        border: 1px solid #e0e0e0;
        padding-left: 1rem;
    }

    .tour-filter-search .btn {
        border-radius: 0 50px 50px 0;
        background-color: rgb(17, 157, 213);
        color: white;
        border: none;
        width: 67px !important;
        padding: 0px 10px !important;
    }

    .tour-filter-price .form-control {
        border-radius: 4px;
        border: 1px solid #e0e0e0;
    }

    .tour-filter-price .input-group-text {
        background-color: rgba(17, 157, 213, 0.1);
        border: 1px solid #e0e0e0;
        color: rgb(17, 157, 213);
    }

    .tour-filter-price .btn {
        border-radius: 50px;
        background-color: rgb(17, 157, 213);
        color: white;
        border: none;
        margin-top: 0.75rem;
        font-size: 0.8rem;

    }

    .tour-filter-checkbox {
        margin-bottom: 0.5rem;
    }

    .form-check {
        display: flex !important;
    }

    .tour-filter-checkbox .form-check-input {
        border-color: #e0e0e0;
        margin-right: 15px;
    }

    .tour-filter-checkbox .form-check-input:checked {
        background-color: rgb(17, 157, 213);
        border-color: rgb(17, 157, 213);
    }

    .tour-filter-checkbox .form-check-label {
        font-size: 0.9rem;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .tour-category-count {
        background-color: rgba(17, 157, 213, 0.1);
        color: rgb(17, 157, 213);
        font-size: 0.75rem;
        padding: 0.1rem 0.5rem;
        border-radius: 50px;
        font-weight: 600;
    }

    .tour-star {
        color: #FFD700;
    }

    .tour-star-empty {
        color: #e0e0e0;
    }

    .tour-rating-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .tour-rating-text {
        font-weight: 600;
        color: #333;
    }

    .tour-rating-count {
        background-color: rgba(17, 157, 213, 0.1);
        color: rgb(17, 157, 213);
        font-size: 0.75rem;
        padding: 0.1rem 0.5rem;
        border-radius: 50px;
        font-weight: 600;
    }

    /* Tour Card Styles */
    .tour-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        border: none;
    }

    .tour-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .tour-card-image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .tour-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .tour-card:hover .tour-card-image img {
        transform: scale(1.05);
    }

    .tour-card-content {
        padding: 1.25rem;
    }

    .tour-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
        line-height: 1.4;
    }

    .tour-card-rating {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .tour-card-stars {
        margin-right: 0.5rem;
    }

    .tour-card-reviews {
        font-size: 0.8rem;
        color: #777;
    }

    .tour-card-price {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .tour-card-price-label {
        font-size: 0.8rem;
        color: #777;
        margin-right: 0.5rem;
    }

    .tour-card-price-old {
        font-size: 0.9rem;
        color: #999;
        text-decoration: line-through;
        margin-right: 0.5rem;
    }

    .tour-card-price-new {
        font-size: 1.1rem;
        font-weight: 700;
        color: rgb(17, 157, 213);
    }

    .tour-card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .tour-card-btn {
        flex: 1;
        padding: 0.5rem 0;
        text-align: center;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .tour-card-btn-primary {
        background-color: rgb(17, 157, 213);
        color: white;
        box-shadow: 0 4px 10px rgba(17, 157, 213, 0.3);
    }

    .tour-card-btn-primary:hover {
        background-color: rgb(15, 140, 190);
        color: white;
    }

    .tour-card-btn-outline {
        background-color: white;
        color: rgb(17, 157, 213);
        border: 1px solid rgb(17, 157, 213);
    }

    .tour-card-btn-outline:hover {
        background-color: rgba(17, 157, 213, 0.1);
        color: rgb(17, 157, 213);
    }

    .tour-master-index-list li {
        font-size: 14px;
        color: #002246;
    }

    .tour-card-badge {
        position: absolute;
        top: 1rem;
        padding: 0.25rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 0 50px 50px 0;
        z-index: 1;
    }

    .tour-card-badge-discount {
        left: 0;
        background-color: #f9680f;
        color: white;
    }

    .tour-card-badge-bestseller {
        right: 0;
        background-color: rgb(17, 157, 213);
        color: white;
        border-radius: 50px 0 0 50px;
    }

    .tour-load-more {
        background-color: white;
        color: rgb(17, 157, 213);
        border: 1px solid rgb(17, 157, 213);
        border-radius: 50px;
        padding: 0.5rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .tour-load-more:hover {
        background-color: rgb(17, 157, 213);
        color: white;
    }

    .tour-load-more i {
        margin-right: 0.5rem;
    }

    /* Andamanbliss Tour Packages Section */
    .tour-andamanbliss-section {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        border: 1px solid #e0e0e0;
    }

    .tour-andamanbliss-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .tour-andamanbliss-title span {
        color: #f9680f;
    }



    .tour-andamanbliss-read-more {
        color: rgb(17, 157, 213);
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .tour-andamanbliss-read-more:hover {
        color: #f9680f;
        text-decoration: underline;
    }

    /* Andamanbliss Modal */
    .tour-andamanbliss-modal {
        max-width: 960px;
    }

    .tour-andamanbliss-modal .modal-header {
        border-bottom: 1px solid #eee;
        padding: 1rem 1.5rem;
        background-color: #fff;
    }

    .tour-andamanbliss-modal .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }

    .tour-andamanbliss-modal .modal-body {
        padding: 0;
        max-height: 70vh;
        overflow-y: auto;
    }

    .tour-andamanbliss-modal .modal-footer {
        border-top: 1px solid #eee;
        padding: 1rem 1.5rem;
        background-color: #fff;
    }

    .tour-andamanbliss-packages {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .tour-andamanbliss-packages-header {
        display: flex;
        justify-content: space-between;
        background-color: #f8f9fa;
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e0e0e0;
    }

    .tour-andamanbliss-packages-header h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .tour-andamanbliss-packages-header .duration-price {
        display: flex;
        gap: 8rem;
    }

    .tour-andamanbliss-packages-header .col {
        font-size: 1rem;
        font-weight: 600;
        color: #666;
        text-align: center;
    }

    .tour-andamanbliss-package-item {
        display: flex;
        align-items: center;
        padding: 0rem 1.5rem;
        transition: all 0.3s ease;
    }

    .tour-andamanbliss-package-item:last-child {
        border-bottom: none;
    }

    .tour-andamanbliss-package-item:hover {
        background-color: rgba(249, 104, 15, 0.05);
    }

    .tour-andamanbliss-package-name {
        flex: 1;
    }

    .tour-andamanbliss-package-name a {
        color: #f9680f;
        font-weight: 600;
        text-decoration: none;
        font-size: 12px;
    }

    .tour-andamanbliss-package-name a:hover {
        color: rgb(17, 157, 213);
        text-decoration: underline;
    }

    .tour-andamanbliss-package-duration,
    .tour-andamanbliss-package-price {
        width: 150px;
        text-align: right;
        font-weight: 500;
        font-size: 12px;
    }

    .tour-andamanbliss-package-duration {
        color: #666;
    }

    .tour-andamanbliss-package-price {
        color: #666;
    }

    .tour-andamanbliss-description {
        padding: 1.5rem;
        color: #666;
        line-height: 1.6;
    }

    .tour-andamanbliss-description p {
        margin-bottom: 1rem;
        font-size: 14px;
    }

    .tour-andamanbliss-description a {
        color: rgb(17, 157, 213);
        font-weight: 600;
        text-decoration: none;
    }

    .tour-andamanbliss-description a:hover {
        color: #f9680f;
        text-decoration: underline;
    }

    .tour-andamanbliss-modal .btn-primary {
        background-color: rgb(17, 157, 213);
        border-color: rgb(17, 157, 213);
    }

    .tour-andamanbliss-modal .btn-primary:hover {
        background-color: #0e8bc0;
        border-color: #0e8bc0;
    }

    .tour-andamanbliss-modal .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .tour-andamanbliss-modal .close {
        font-size: 1.5rem;
        color: #000;
        opacity: 0.5;
    }

    /* Contact Offcanvas */
    .tour-contact-offcanvas .offcanvas-header {
        background-color: rgb(17, 157, 213);
        color: white;
    }

    .tour-contact-offcanvas .btn-close {
        filter: brightness(0) invert(1);
    }

    .tour-contact-item {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .tour-contact-item h6 {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .tour-contact-item h6 i {
        color: rgb(17, 157, 213);
        margin-right: 0.5rem;
    }

    .tour-contact-item p {
        font-size: 1.1rem;
        font-weight: 700;
        color: rgb(17, 157, 213);
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    .tour-contact-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .tour-contact-link {
        color: rgb(17, 157, 213);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .tour-contact-link:hover {
        color: #f9680f;
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .tour-banner-content h1 {
            font-size: 2.5rem;
        }

        .tour-banner-content .subtitle {
            font-size: 1rem;
        }

        .tour-section-title h2 {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 767px) {
        .tour-page-banner {
            height: 350px;
        }

        .tour-banner-content h1 {
            font-size: 2rem;
        }

        .tour-banner-content .subtitle {
            font-size: 0.9rem;
        }

        .tour-section-title h2 {
            font-size: 1.5rem;
        }

        .tour-card-image {
            height: 180px;
        }
    }

    /* Tour Card Redesign Styles */
    .ab-tour-card {
        width: 98%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        background-color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: fit-content;
        display: flex;
        flex-direction: column;
        border: 1px solid #f0f0f0;
    }

    .ab-tour-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .ab-tour-card-header {
        position: relative;
    }

    /* Badge Styles */
    .ab-tour-card-badge {
        position: absolute;
        top: 10px;
        left: 0;
        z-index: 2;
        padding: 5px 12px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        border-radius: 0 4px 4px 0;
    }

    .ab-badge-text {
        display: flex;
        align-items: center;
    }

    .ab-badge-sn {
        background-color: #E91E63;
    }

    .ab-badge-sy {
        background-color: #FF9800;
    }

    .ab-badge-sm {
        background-color: #FF6B00;
    }

    /* Hover styles */
    .package-hover,
    .destination-hover,
    .tour-includes-hover {
        position: relative;
        cursor: pointer;
        margin-top: -2px;
    }

    .package-hover span,
    .destination-hover span {
        text-decoration: underline dotted;
        text-underline-offset: 2px;
    }

    .package-popup,
    .destination-popup,
    .tour-includes-popup {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 10px 15px;
        z-index: 1000;
        width: 250px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
    }

    .package-hover:hover .package-popup,
    .destination-hover:hover .destination-popup,
    .tour-includes-hover:hover .tour-includes-popup {
        opacity: 1;
        visibility: visible;
    }

    .tour-includes-hover h4 {
        margin: 0;
        display: inline-block;
    }

    /* Tour includes content styling */
    .tour-includes-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .tour-includes-item {
        flex: 0 0 48%;
    }

    .tour-includes-item i {
        color: #e74c3c;
        margin-right: 5px;
    }

    .tour-iti-sub-heading {
        font-size: 12px;
    }

    .tour-includes-popup {
        position: absolute;
        top: -5px;
        left: 0;
        transform: translateY(-100%);
        background-color: white;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 15px;
        width: 280px;
        z-index: 100;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .tour-includes-hover:hover .tour-includes-popup {
        display: block;
        opacity: 1;
    }

    .tour-includes-popup:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 20px;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid white;
    }

    .tour-includes-popup h5 {
        color: #333;
        font-size: 16px;
        margin-bottom: 10px;
        font-weight: 600;
        border-bottom: 1px solid #eaeaea;
        padding-bottom: 8px;
    }

    .tour-includes-popup ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 10px;
    }

    .tour-includes-popup li {
        color: #555;
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .tour-includes-popup li i {
        color: #e74c3c;
        margin-right: 8px;
        min-width: 16px;
    }

    .tour-includes-popup .flight-note {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 8px;
        font-style: italic;
        line-height: 1.4;
    }

    margin-bottom: 4px;
    color: #444;
    }

    /* Tour includes tooltip */
    .tour-includes-tooltip {
        color: #333;
    }

    .tour-includes-tooltip h5 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .tour-includes-tooltip .includes-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .tour-includes-tooltip .includes-item i {
        color: #0d6efd;
        margin-right: 8px;
        width: 16px;
    }

    .tour-includes-tooltip .includes-note {
        font-size: 11px;
        color: #dc3545;
        margin-top: 8px;
    }

    /* Tour includes header style */
    .ab-tour-includes-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .ab-tour-card-deal {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        padding: 6px 10px;
        font-size: 14px;
        font-weight: 500;
        z-index: 1;
    }

    .ab-tour-card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .ab-tour-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .ab-tour-card:hover .ab-tour-card-image img {
        transform: scale(1.05);
    }

    .ab-tour-card-map-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ab-tour-card-location {
        background-color: #2196F3;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-location-sn {
        background-color: #E91E63;
    }

    .ab-location-sy {
        background-color: #FF9800;
    }

    .ab-location-sm {
        background-color: #2196F3;
    }

    .ab-tour-card-duration {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-tour-card-map-button {
        background-color: white;
        border: none;
        color: #333;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ab-tour-card-content {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ab-tour-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .ab-tour-tag {
        background-color: #f0f0f0;
        color: #555;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .ab-tour-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .ab-tour-card-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .ab-tour-card-stats {
        display: flex;
        gap: 10px;
    }

    .ab-tour-card-stats span {
        font-size: 13px;
        color: #666;
    }

    .ab-tour-card-highlights {
        font-size: 13px;
        color: #2196F3;
        font-weight: 600;
    }

    .ab-tour-card-includes {
        margin-bottom: 5px;
    }

    .ab-tour-card-includes h4 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .ab-tour-card-icons {
        display: flex;
        gap: 12px;
    }

    .ab-tour-icon {
        width: 30px;
        height: 30px;
        background-color: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 14px;
    }

    .ab-tour-card-pricing {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .ab-tour-card-price-label {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 3px;
    }

    .ab-tour-card-price {
        display: flex;
        align-items: baseline;
    }

    .ab-tour-card-price-currency {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .ab-tour-card-price-amount {
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }

    .ab-tour-card-price-asterisk {
        font-size: 14px;
        color: #FF6B00;
        font-weight: 600;
    }

    .ab-tour-card-emi {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ab-tour-card-emi-icon {
        width: 24px;
        height: 24px;
        background-color: rgba(33, 150, 243, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2196F3;
    }

    .ab-tour-card-emi-details {
        display: flex;
        flex-direction: column;
    }

    .ab-tour-card-emi-label {
        font-size: 11px;
        color: #666;
    }

    .ab-tour-card-emi-amount {
        font-size: 13px;
        font-weight: 600;
        color: #2196F3;
    }

    .ab-tour-card-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
    }

    .ab-tour-card-btn {
        flex: 1;
        padding: 10px;
        text-align: center;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .ab-tour-view-btn {
        background-color: white;
        color: #2196F3;
        border: 1px solid #2196F3;
    }

    .ab-tour-view-btn:hover {
        background-color: rgba(33, 150, 243, 0.1);
    }

    .ab-tour-book-btn {
        background-color: #2196F3;
        color: white;
        border: 1px solid #2196F3;
    }

    .ab-tour-book-btn:hover {
        background-color: #1976D2;
    }

    .ab-tour-card-contact {
        display: flex;
        justify-content: center;
    }

    .ab-tour-card-whatsapp {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #4CAF50;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }

    .ab-tour-card-whatsapp:hover {
        text-decoration: underline;
    }

    .ab-tour-card-itinerary {
        margin-left: 15px;
        display: flex;
        align-items: center;
        gap: 5px;
        color: #FF6B00;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }

    .ab-tour-card-itinerary:hover {
        text-decoration: underline;
    }

    /* Responsive Styles */
    @media (max-width: 991px) {
        .ab-tour-card-image {
            height: 180px;
        }

        .ab-tour-card-title {
            font-size: 16px;
        }

        .ab-tour-card-price-amount {
            font-size: 20px;
        }
    }

    @media (max-width: 767px) {
        .ab-tour-card-actions {
            flex-direction: column;
        }

        .ab-tour-card-contact {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .ab-tour-card-itinerary {
            margin-left: 0;
        }
    }

    .ab-tour-card-badge {
        position: absolute;
        top: 10px;
        left: 0;
        z-index: 2;
        padding: 5px 15px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        border-radius: 0 4px 4px 0;
    }

    .ab-badge-sn {
        background-color: #FF6B00;
    }

    .ab-badge-sy {
        background-color: #FF6B00;
    }

    .ab-badge-sm {
        background-color: #FF6B00;
    }

    .ab-tour-card-deal {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        padding: 6px 10px;
        font-size: 14px;
        font-weight: 500;
        z-index: 1;
    }

    .ab-tour-card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .ab-tour-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .ab-tour-card:hover .ab-tour-card-image img {
        transform: scale(1.05);
    }

    .ab-tour-card-map-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ab-tour-card-location {
        background-color: #2196F3;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-location-sn {
        background-color: #E91E63;
    }

    .ab-location-sy {
        background-color: #FF9800;
    }

    .ab-location-sm {
        background-color: #2196F3;
    }

    .ab-tour-card-duration {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 12px;
    }

    .ab-tour-card-map-button {
        background-color: white;
        border: none;
        color: #333;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ab-tour-card-content {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ab-tour-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .ab-tour-tag {
        background-color: #f0f0f0;
        color: #555;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .ab-tour-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .ab-tour-card-details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .ab-tour-card-stats {
        display: flex;
        gap: 10px;
    }

    .ab-tour-card-stats span {
        font-size: 13px;
        color: #666;
    }

    .ab-tour-card-highlights {
        font-size: 13px;
        color: #2196F3;
        font-weight: 600;
    }

    .ab-tour-card-includes {
        margin-bottom: 5px;
    }

    .ab-tour-card-includes h4 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .ab-tour-card-icons {
        display: flex;
        gap: 12px;
    }

    .ab-tour-icon {
        width: 30px;
        height: 30px;
        background-color: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 14px;
    }

    .ab-tour-card-pricing {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .ab-tour-card-price-label {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 3px;
    }

    .ab-tour-card-price {
        display: flex;
        align-items: baseline;
    }

    .ab-tour-card-price-currency {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    .ab-tour-card-price-amount {
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }

    .ab-tour-card-price-asterisk {
        font-size: 14px;
        color: #FF6B00;
        font-weight: 600;
    }

    .ab-tour-card-emi {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: #f5f9ff;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .ab-tour-card-emi-icon {
        color: #2196F3;
        font-size: 14px;
    }

    .ab-tour-card-emi-details {
        display: flex;
        flex-direction: column;
    }

    .ab-tour-card-emi-label {
        font-size: 11px;
        color: #666;
    }

    .ab-tour-card-emi-amount {
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }

    .ab-tour-card-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .ab-tour-card-btn {
        flex: 1;
        text-align: center;
        padding: 10px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .ab-tour-view-btn {
        background-color: #f5f5f5;
        color: #333;
        border: 1px solid #ddd;
    }

    .ab-tour-view-btn:hover {
        background-color: #eee;
        color: #333;
    }

    .ab-tour-book-btn {
        background-color: #FF6B00;
        color: white;
        border: 1px solid #FF6B00;
    }

    .ab-tour-book-btn:hover {
        background-color: #e65c00;
        border-color: #e65c00;
        color: white;
    }

    .ab-tour-card-contact {
        display: flex;
        justify-content: space-between;
    }

    .ab-tour-card-whatsapp,
    .ab-tour-card-itinerary {
        font-size: 13px;
        color: #666;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ab-tour-card-whatsapp i {
        color: #25D366;
    }

    .ab-tour-card-itinerary i {
        color: #2196F3;
    }

    .ab-tour-card-whatsapp:hover,
    .ab-tour-card-itinerary:hover {
        color: #333;
    }

    /* Responsive styles */
    @media (max-width: 991px) {
        .ab-tour-card-pricing {
            flex-direction: row;
            align-items: flex-start;
            gap: 10px;
        }

        .ab-tour-card-emi {
            align-self: flex-start;
        }
    }

    @media (max-width: 767px) {
        .ab-tour-card-image {
            height: 180px;
        }

        .ab-tour-card-actions {
            flex-direction: column;
        }

        .ab-tour-card-title {
            font-size: 16px;
        }

        .ab-tour-card-price-amount {
            font-size: 20px;
        }
    }

    @media (max-width: 575px) {
        .ab-tour-card-details {
            flex-direction: row;
            gap: 8px;
        }

        .ab-tour-card-contact {
            flex-direction: row;
            gap: 10px;
        }

        .sidebars {
            display: none;
        }
    }

    .itinerary-modal-content {
        display: flex;
        flex-direction: column;
    }

    .itinerary-modal-image img {
        width: 100%;
        height: auto;
    }

    #getItineraryModal .modal-dialog {
        max-width: 400px;
        margin: 1.75rem auto;
    }

    #getItineraryModal .modal-content {
        border: none;
        border-radius: 8px;
        overflow: hidden;
    }

    #getItineraryModal .btn-danger {
        background-color: #FF6B00;
        border-color: #FF6B00;
    }

    #getItineraryModal .form-control {
        padding: 10px;
        border-radius: 4px;
    }

    .tour-andamanbliss-text {
        color: #666;
        margin-bottom: 0;
        display: block;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var nextPageUrl = '{{ $tours->nextPageUrl() }}';
        var $loadMoreBtn = $('#load-more-btn');
        var $loadSpinner = $('#load-spinner');
        var $loadMoreContainer = $('#load-more-container');
        var $toursContainer = $('.tour-container');
        var inputsElement = document.getElementById('inputsData');
        var inputs = inputsElement ? JSON.parse(inputsElement.value || '{}') : {};

        function generateTourCard(tour, localInputs = null) {
            var activeInputs = localInputs || inputs || {};
            var photo = (tour.tour_photos && tour.tour_photos[0] && tour.tour_photos[0].file) ?
                tour.tour_photos[0].file :
                '/placeholder.jpg';
            var categoryName = tour.sub_cat || 'Unknown Category';
            var category = (tour.tour_category && tour.tour_category.name) || 'Andaman Bliss';
            var categorySlug = (categoryName && tour.tour_category.slug) || '';
            var tourName = tour.package_name || 'Unnamed Tour';
            var rate = parseFloat(tour.start_price) || 0;
            var price = parseFloat(tour.discount) || 0;
            var hasDiscount = price > 0;
            var discount = hasDiscount ? Math.round((rate * price) / 100) : 0;
            var discountAmt = hasDiscount ? Math.round(discount + rate) : 0;
            var tourSlug = tour.slug || '';
            var islandsCovered = tour.islands_covered || [];
            var islandList = '';
            const message = `Hi! I’m interested in the ${tourName} (${category} - ${categoryName}) package. Please share the detailed itinerary and pricing.`;
            const encodedMessage = encodeURIComponent(message);
            const whatsappLink = `https://wa.me/918900909900?text=${encodedMessage}`;


            islandsCovered.forEach(island => {
                islandList += `<li>${island.trim()}</li>`;
            });

            var hasInputs = Object.keys(activeInputs).some(key => {
                const val = activeInputs[key];
                return val !== null && val !== '' && !(Array.isArray(val) && val.length === 0);
            });

            var categoryNameLower = categoryName ? categoryName.toLowerCase().replace(/\s+/g, '-') : '';
            var categorySlugLower = categorySlug ? categorySlug.toLowerCase() : '';

            var route = hasInputs ?
                `/${categoryNameLower ? categoryNameLower + '/' : ''}andaman-${categorySlugLower}-tour-${tourSlug}/itinerary` :
                `/${categoryNameLower ? categoryNameLower + '/' : ''}andaman-${categorySlugLower}-tour-${tourSlug}`;

            var inputsJson = hasInputs ? JSON.stringify(activeInputs) : '';


            return `
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="ab-tour-card">
         
                <div class="ab-tour-card-header">
                      ${hasDiscount ? `
                                <div class="ab-tour-card-deal">
                                    <span>Exclusive Deal upto ${discount}% <em>-off</em></span>
                                </div> ` : ``}
                    <div class="ab-tour-card-image">
                        <img src="${photo}" alt="${tourName}">
                        <div class="ab-tour-card-map-btn">
                            <span class="ab-tour-card-duration">${tour.nights}N/${tour.days}D</span>
                            <button class="ab-tour-card-map-button">
                                <i class="fas fa-map-marker-alt"></i> Map
                            </button>
                        </div>
                    </div>
                </div>
                <div class="ab-tour-card-content">
                    <h3 class="ab-tour-card-title">
                        <span class="cat">${category}</span> ${tourName.replace(/(\d)(?=[A-Za-z])/g, '$1 ')}
                    </h3>
                    <div class="ab-tour-card-details">
                        <div class="ab-tour-card-stats">
                            <span>1 Package</span>
                            <div class="destination-hover">
                                <span>Destinations</span>
                                <div class="destination-popup">
                                    <h5>You will visit</h5>
                                    <ul>${islandList}</ul>
                                </div>
                            </div>
                        </div>
                        <div class="ab-tour-card-highlights">
                            <span>Highlights</span>
                        </div>
                    </div>
                    <div class="ab-tour-card-includes">
                        <div class="ab-tour-includes-header">
                            <h4>Tour Includes</h4>
                            <div class="ab-tour-card-icons">
                                <span class="ab-tour-icon"><i class="fas fa-hotel"></i></span>
                                <span class="ab-tour-icon"><i class="fas fa-cab"></i></span>
                                <span class="ab-tour-icon"><i class="fas fa-ship"></i></span>
                                <span class="ab-tour-icon"><i class="fas fa-camera"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="ab-tour-card-pricing">
                        <div class="ab-tour-card-price-info">
                            <span class="ab-tour-card-price-label">All inclusive price</span>
                            <div class="ab-tour-card-price">
                                <span class="ab-tour-card-price-currency">₹</span>
                                <span class="ab-tour-card-price-amount">${rate.toLocaleString('en-IN', { minimumFractionDigits: 2 })}</span>
                                <span class="ab-tour-card-price-asterisk">*</span>
                            </div>
                        </div>
                        <div class="ab-tour-card-emi">
                            <div class="ab-tour-card-emi-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="ab-tour-card-emi-details">
                                <span class="ab-tour-card-emi-label">Partial Pay</span>
                                <span class="ab-tour-card-emi-amount">Available</span>
                            </div>
                        </div>
                    </div>
                    <div class="ab-tour-card-actions">
                        ${hasInputs ? `
                            <form class="w-100" action="${route}" method="POST">
                                <input type="hidden" name="_token" value="${$('meta[name=csrf-token]').attr('content')}">
                                <input type="hidden" name="inputs" value='${inputsJson}'>
                                <input type="hidden" name="package" value="${tourSlug}">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <button type="submit" class="ab-tour-card-btn ab-tour-view-btn w-100">View Tour</button>
                                    <button type="submit" class="ab-tour-card-btn ab-tour-book-btn w-100">Book Now</button>
                                </div>
                            </form>
                        ` : `
                            <a href="${route}" class="ab-tour-card-btn ab-tour-view-btn">View Tour</a>
                            <a href="${route}" class="ab-tour-card-btn ab-tour-book-btn">Book Online</a>
                        `}
                    </div>
                    <div class="ab-tour-card-contact">
                       <a href="${whatsappLink}" target="_blank" class="ab-tour-card-whatsapp">
                        <i class="fab fa-whatsapp"></i> Request Callback </a>
                        <a href="#" class="ab-tour-card-itinerary" data-bs-toggle="modal" data-tour="${tourName} - ${category} - ${categoryName}" data-bs-target="#getItineraryModal">
                            <i class="fas fa-envelope"></i> Get Itinerary
                        </a>
                    </div>
                </div>
            </div>
        </div>
        `;
        }




        function renderTours(tours) {
            var container = document.querySelector('.row.tour-container');
            if (!container) return;
            container.innerHTML = ''; // clear current

            tours.forEach(tour => {
                container.innerHTML += generateTourCard(tour);
            });
        }


        $loadMoreBtn.on('click', function() {
            if (!nextPageUrl) {
                $loadMoreContainer.addClass('d-none');
                return;
            }

            // Show spinner and disable button
            $loadSpinner.removeClass('d-none');
            $loadMoreBtn.prop('disabled', true);

            $.ajax({
                url: nextPageUrl,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(data) {
                    if (data.tours && data.tours.length > 0) {
                        data.tours.forEach(function(tour) {
                            $toursContainer.append(generateTourCard(tour));
                        });
                    } else {
                        console.warn('No tours returned in response');
                    }

                    nextPageUrl = data.next_page;
                    if (!data.has_more) {
                        $loadMoreContainer.addClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load more tours:', error);
                    alert('Failed to load more tours. Please try again.');
                },
                complete: function() {
                    $loadSpinner.addClass('d-none');
                    $loadMoreBtn.prop('disabled', false);
                }
            });
        });
    });


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
        console.log('Opening offcanvas for desktop');
    }

    document.addEventListener('DOMContentLoaded', setCallNowHref);
    window.addEventListener('resize', setCallNowHref);

    // Andamanbliss Modal Script
    document.addEventListener('DOMContentLoaded', function() {
        var andamanblissModal = document.getElementById('andamanblissModal');
        if (andamanblissModal) {
            andamanblissModal.addEventListener('shown.bs.modal', function() {
                console.log('Andamanbliss modal opened');
            });
        }
    });

    $(document).ready(function() {

        $(document).on('click', '.sort-price', function(e) {
            e.preventDefault();

            let sortType = $(this).data('sort');
            let $container = $('.tour-container');
            let $tours = $container.children('.col-lg-4'); // each card column

            // Convert jQuery collection to array for sorting
            let sorted = $tours.get().sort(function(a, b) {
                let priceA = parseFloat($(a).find('.ab-tour-card-price-amount').text().replace(/,/g, '')) || 0;
                let priceB = parseFloat($(b).find('.ab-tour-card-price-amount').text().replace(/,/g, '')) || 0;

                if (sortType === 'low_high') {
                    return priceA - priceB;
                } else {
                    return priceB - priceA;
                }
            });

            // Re-append sorted elements
            $container.html(sorted);

            // Update dropdown text
            $('#priceFilterDropdown').text(
                sortType === 'low_high' ? 'Price: Low to High' : 'Price: High to Low'
            );
        });

    });


    $(document).on('click', '.ab-tour-card-itinerary', function() {
        const tourName = $(this).data('tour');
        $('#tourNameInput').val(tourName);
    });

    $(document).on('click', '.ab-tour-card-itinerary', function() {
        const tourName = $(this).data('tour');
        $('#tourNameInput').val(tourName);
    });

    // JavaScript for toggle read more and read less
    const toggleBtn = document.getElementById('andamanbliss-toggle-btn');
    const moreText = document.querySelector('.read-more-container .more-text');

    if (toggleBtn && moreText) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();

            if (moreText.style.display === 'none' || !moreText.style.display) {
                moreText.style.display = 'block';
                toggleBtn.textContent = 'Read Less';
            } else {
                moreText.style.display = 'none';
                toggleBtn.textContent = 'Read More';
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function() {

        const slider = document.getElementById("priceRange");
        const output = document.getElementById("priceRangeValue");
        const durationCheckboxes = document.querySelectorAll("input[name='duration[]']");
        const categoryCheck = document.querySelectorAll("input[name='categories[]']");
        const cards = document.querySelectorAll(".ab-tour-card");

        function applyFilters() {
            let maxPrice = parseInt(slider.value);

            let durations = [...durationCheckboxes]
                .filter(cb => cb.checked)
                .map(cb => cb.value.toLowerCase());

            let categories = [...categoryCheck]
                .filter(cb => cb.checked)
                .map(cb => cb.value.toLowerCase());

            cards.forEach(card => {

                let cardWrapper = card.closest(".col-lg-4");

                let priceEl = card.querySelector(".ab-tour-card-price-amount");
                let durEl = card.querySelector(".ab-tour-card-duration");
                let catEl = card.querySelector(".cat");

                if (!priceEl || !durEl || !catEl) return;

                let price = parseInt(priceEl.textContent.replace(/[,₹ ]/g, ""));
                let durationText = durEl.textContent.trim().toLowerCase().replace("/", "");
                let categoryText = catEl.textContent.trim().toLowerCase();

                let passPrice = price <= maxPrice;
                let passDuration = durations.length === 0 || durations.includes(durationText);
                let passCategory = categories.length === 0 || categories.includes(categoryText);

                if (passPrice && passDuration && passCategory) {
                    cardWrapper.style.display = "block";
                } else {
                    cardWrapper.style.display = "none";
                }
            });
        }

        slider.addEventListener("input", function() {
            output.textContent = "₹" + parseInt(this.value).toLocaleString('en-IN');
            applyFilters();
        });

        durationCheckboxes.forEach(cb => cb.addEventListener("change", applyFilters));
        categoryCheck.forEach(cb => cb.addEventListener("change", applyFilters));

    });
</script>
@endpush


<!-- Andamanbliss Tour Packages Modal -->

<!-- Get Itinerary Modal -->