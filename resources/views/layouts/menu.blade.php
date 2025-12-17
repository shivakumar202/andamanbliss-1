<nav class="navbar navbar-expand-lg fixed-top bg-light shadow p-0">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('site/img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}"
                style="width:60px; height:60px">
        </a>
        <div class="justify-content-end d-flex gap-0 align-items-center">
            <div>
                <a href="{{ url('contact') }}" class="mobo-con px-1" aria-label="Contact us"><i
                        class="fa-solid fa-headphones"></i></a>
                <a href="{{ url('login') }}" class="mobo-user px-3" aria-label="Login"><i
                        class="fa-solid fa-user"></i></a>
            </div>
            <button class="navbar-toggler px-2" type="button" id="navbarTogglerButton" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>

        <!-- Mobile Sidebar Menu -->
        <div id="mobile-sidebar-menu" class="mobile-sidebar-menu">
            <div class="mobile-menu-header">
                <div class="mobile-menu-title">Menu</div>
                <button id="mobile-menu-close" class="mobile-menu-close" aria-label="Close menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <ul class="mobile-menu-items">
                <li class="mobile-menu-item">
                    <a href="{{ url('/') }}" class="mobile-menu-link">Home</a>
                </li>
                <li class="mobile-menu-item">
                    <a href="/best-places-to-visit" class="mobile-menu-link">
                        Andaman Tourism
                        <button type="button" class="mobile-submenu-toggle" aria-label="Toggle submenu">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                    <ul class="mobile-submenu">
                        <li class="mobile-submenu-item">
                            <a href="{{ url('islands/port-blair') }}" class="mobile-submenu-link">Port Blair</a>
                        </li>
                        <li class="mobile-submenu-item">
                            <a href="{{ url('islands/havelock-swaraj-dweep') }}" class="mobile-submenu-link">Havelock
                                Island</a>
                        </li>
                        <li class="mobile-submenu-item">
                            <a href="{{ url('islands/neil-shaheed-dweep') }}" class="mobile-submenu-link">Neil
                                Island</a>
                        </li>
                    </ul>
                </li>
                <li class="mobile-menu-item">
                    <div class="mobile-menu-link">
 <a href="{{ url('tours') }}" class="">
                        Packages
                       
                    </a>
                     <button type="button" class="mobile-submenu-toggle" aria-expanded="false"
                            aria-label="Toggle Packages submenu" aria-controls="packages-submenu">
                            <i class="fa-solid fa-plus"></i>
                        </button> 
                    </div>
                     
                    <ul class="mobile-submenu">
                        @php
    $categories = \App\Models\Category::where('type', 'tour')
        ->where('status', 1)
        ->limit(6)
        ->get();
@endphp

@foreach ($categories as $category)
    @if ($category->name === 'Best Seller')
        @php
            $bestSellerPackages = \App\Models\TourPackages::with('tourCategory')
                ->where('best_seller', 1)
                ->where('status', 1)
                ->limit(4)
                ->get();
        @endphp

        <li class="mobile-submenu-item has-submenu">

         
                             <a href="{{ route('tour.home', ['slug' => $category->slug]) }}"
                class="mobile-submenu-link">
                {{ $category->name }}
                <button type="button" class="mobile-submenu-toggle level-2"
                    aria-label="Toggle sub-menu level 2">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
            
       

            <ul class="mobile-submenu level-2">
                @foreach ($bestSellerPackages as $package)
                    <li class="mobile-submenu-item">
                        <a href="{{ route('tour.static', [
                                'slug' => $package->tourCategory->slug,
                                'subslug' => $package->slug
                            ]) }}"
                            class="mobile-submenu-link">
                            {{ $package->package_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        

                                <li class="mobile-submenu-item has-submenu">
    <a href="{{ route('tour.home', ['slug' => $category->slug]) }}"
        class="mobile-submenu-link">
        {{ $category->name }}
        <button type="button" class="mobile-submenu-toggle level-2"
            aria-label="Toggle sub-menu level 2">
            <i class="fa-solid fa-plus"></i>
        </button>
    </a>

    <ul class="mobile-submenu level-2">
        @php
            $tours = \App\Models\TourPackages::where('category_id', $category->id)
                ->where('status', 1) 
                ->limit(6)
                ->orderBy('nights', 'ASC')
                ->get();
        @endphp

        @foreach ($tours as $tour)
            <li class="mobile-submenu-item">
                <a href="{{ route('tour.static', [
                        'slug' => $category->slug,
                        'subslug' => $tour->slug
                    ]) }}"
                    class="mobile-submenu-link">
                    {{ $tour->package_name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>

                            @endif
                        @endforeach
                    </ul>
                </li>


                <li class="mobile-menu-item">
                    <a href="{{ url('activities') }}" class="mobile-menu-link">
                        Water Activities
                        <button type="button" class="mobile-submenu-toggle" aria-label="Toggle submenu">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                    <ul class="mobile-submenu">
                        @php
                            $categories = \App\Models\Category::where('type', 'activity')->where('status',1)->limit(8)->get();
                        @endphp
                        @foreach ($categories as $key => $category)
                            <li class="mobile-submenu-item has-submenu">
                                <a href="{{ route('activity.static' ,['slug' => $category->slug] ) }}" class="mobile-submenu-link">
                                    {{ $category->name }}
                                    <button type="button" class="mobile-submenu-toggle level-2"
                                        aria-label="Toggle sub-menu">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </a>
                                <ul class="mobile-submenu level-2">
                                    @php
                                        $activities = \App\Models\Activities::where('category_id', $category->id)
                                            ->where('status', '1')
                                            ->limit(6)
                                            ->get();
                                    @endphp
                                    @foreach ($activities as $k => $activity)
                                      @php
    $activityUrl = $activity->url ?? $activity->slug;
@endphp

                                        <li class="mobile-submenu-item">
                                            <a href="{{ route('activity.view' ,['url' => $activityUrl] ) }}"
                                                class="mobile-submenu-link">
                                                {{ $activity->service_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li class="mobile-menu-item has--submenu">
                    <a href="{{ route('cruises') }}" class="mobile-menu-link">
                        Ferry Booking
                        <button type="button" class="mobile-submenu-toggle"
                            aria-label="Toggle Honeymoon Packages submenu">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                    

                      <ul class="mobile-submenu level-2">
                         <li class="mobile-submenu-item">
                                <a href="{{ route('cruises') }}" class="mobile-submenu-link">
                                    Inter-Island Ferry
                                </a>
                            </li>
                              @php
                            $Btrips = \App\Models\BoatTripLocations::all();
                            @endphp
                            @foreach($Btrips as $btrip)
                            <li class="mobile-submenu-item"><a href="{{ route('boat-trips',['url' => $btrip->page_url]) }}" class="mobile-submenu-link">{{$btrip->name}}</a></li>
                            @endforeach
                      </ul>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ url('hotels') }}" class="mobile-menu-link">Hotels</a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ url('cabs') }}" class="mobile-menu-link">Cab</a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ url('bikes') }}" class="mobile-menu-link">Bike</a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ route('best-places') }}" class="mobile-menu-link">
                        Islands
                        <button type="button" class="mobile-submenu-toggle" aria-label="Toggle submenu">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                    <ul class="mobile-submenu">
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/port-blair') }}" class="mobile-submenu-link">
                                Port Blair
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/cellular-jail') }}"
                                        class="mobile-submenu-link">Cellular Jail</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/ross-island') }}"
                                        class="mobile-submenu-link">Ross Island</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/north-bay-island') }}"
                                        class="mobile-submenu-link">North Bay Island</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/chidiatapu') }}"
                                        class="mobile-submenu-link">Chidiyatapu</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/jolly-buoy-island') }}"
                                        class="mobile-submenu-link">Jolly Buoy Island</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/corbyns-cove') }}"
                                        class="mobile-submenu-link">Corbyns Cove</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/museums') }}"
                                        class="mobile-submenu-link">Museums</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/flag-point') }}"
                                        class="mobile-submenu-link">Flag Point</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/port-blair/rajiv-gandhi-water-sports-complex') }}"
                                        class="mobile-submenu-link">Rajiv Gandhi Water Sports Complex</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/havelock-swaraj-dweep') }}" class="mobile-submenu-link">
                                Havelock (Swaraj Dweep)
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle Water Sports submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/havelock-swaraj-dweep/radhanagar-beach') }}"
                                        class="mobile-submenu-link">Radhanagar Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/havelock-swaraj-dweep/elephant-beach') }}"
                                        class="mobile-submenu-link">Elephant Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/havelock-swaraj-dweep/kalapathar-beach') }}"
                                        class="mobile-submenu-link">Kalapathar Beach</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/neil-shaheed-dweep') }}" class="mobile-submenu-link">
                                Neil Island (Shaheed Dweep)
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle Adventure Activities submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/neil-shaheed-dweep/laxmanpur-beach') }}"
                                        class="mobile-submenu-link">Laxmanpur Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/neil-shaheed-dweep/bharatpur-beach') }}"
                                        class="mobile-submenu-link">Bharatpur Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/neil-shaheed-dweep/natural-rock') }}"
                                        class="mobile-submenu-link">Natural Rock</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/neil-shaheed-dweep/sitapur-beach') }}"
                                        class="mobile-submenu-link">Sitapur Beach</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/baratang') }}" class="mobile-submenu-link">
                                Baratang
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle Adventure submenu" aria-controls="adventure-submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2" id="adventure-submenu">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/baratang/lime-stone-caves') }}"
                                        class="mobile-submenu-link">Lime Stone Caves</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/baratang/mud-volcano') }}"
                                        class="mobile-submenu-link">Mud
                                        Volcano</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/baratang/parrot-island') }}"
                                        class="mobile-submenu-link">Parrot Island</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/diglipur') }}" class="mobile-submenu-link">
                                Diglipur
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/ross-and-smith-island') }}"
                                        class="mobile-submenu-link">Ross and Smith Island</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/saddle-peak') }}"
                                        class="mobile-submenu-link">Saddle Peak</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/kalipur-beach') }}"
                                        class="mobile-submenu-link">Kalipur Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/ramnagar-beach') }}"
                                        class="mobile-submenu-link">Ramnagar Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/mud-volcanoes-of-shyamnagar') }}"
                                        class="mobile-submenu-link">Mud Volcanoes of Shyamnagar</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/alfred-caves') }}"
                                        class="mobile-submenu-link">Alfred Caves</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/lamiya-bay-beach') }}"
                                        class="mobile-submenu-link">Lamiya Bay Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/aerial-bay') }}"
                                        class="mobile-submenu-link">Aerial Bay</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/diglipur/patti-level') }}"
                                        class="mobile-submenu-link">Patti Level</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/mayabunder') }}" class="mobile-submenu-link">
                                Mayabunder
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/mayabunder/karmatang-beach') }}"
                                        class="mobile-submenu-link">Karmatang Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/mayabunder/avis-island') }}"
                                        class="mobile-submenu-link">Avis Island</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/mayabunder/german-jetty') }}"
                                        class="mobile-submenu-link">German Jetty</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/little-andaman') }}" class="mobile-submenu-link">
                                Little Andaman
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle Water Sports submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/little-andaman/butler-bay-beach') }}"
                                        class="mobile-submenu-link">Butler Bay Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/little-andaman/kalapathar-limestone-caves') }}"
                                        class="mobile-submenu-link">Kalapathar Limestone Caves</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/little-andaman/white-surf-waterfall') }}"
                                        class="mobile-submenu-link">White Surf Waterfall</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/little-andaman/whisper-wave-waterfall') }}"
                                        class="mobile-submenu-link">Whisper Wave Waterfall</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/little-andaman/red-palm-oil-plantation') }}"
                                        class="mobile-submenu-link">Red Palm Oil Plantation</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/little-andaman/light-house') }}"
                                        class="mobile-submenu-link">Light House</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/long-island') }}" class="mobile-submenu-link">
                                Long Island
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/long-island/lalaji-bay-beach') }}"
                                        class="mobile-submenu-link">Lalaji Bay Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/long-island/guitar-island') }}"
                                        class="mobile-submenu-link">Guitar Island</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/long-island/merk-bay-beach-north-passage-island') }}"
                                        class="mobile-submenu-link">Merk Bay Beach</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item has-submenu">
                            <a href="{{ url('islands/rangat') }}" class="mobile-submenu-link">
                                Rangat
                                <button type="button" class="mobile-submenu-toggle level-2"
                                    aria-label="Toggle submenu">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </a>
                            <ul class="mobile-submenu level-2">
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/rangat/dhaninallah-mangrove-walkway') }}"
                                        class="mobile-submenu-link">Dhaninallah Mangrove Walkway</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/rangat/morrice-dera-beach') }}"
                                        class="mobile-submenu-link">Morrice Dera Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/rangat/yeratta-creek') }}"
                                        class="mobile-submenu-link">Yeratta Creek</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/rangat/ambkunj-beach') }}"
                                        class="mobile-submenu-link">Ambkunj Beach</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/rangat/panchavati-waterfalls') }}"
                                        class="mobile-submenu-link">Panchavati Waterfalls</a>
                                </li>
                                <li class="mobile-submenu-item">
                                    <a href="{{ url('islands/rangat/curtbert-bay-beach') }}"
                                        class="mobile-submenu-link">Cuthbert Bay Beach</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mobile-submenu-item">
                            <a href="{{ url('islands/barren-island') }}" class="mobile-submenu-link">Barren
                                Island</a>
                        </li>
                    </ul>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ url('blogs') }}" class="mobile-menu-link">Blog</a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ url('about') }}" class="mobile-menu-link">About Us</a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ url('contact') }}" class="mobile-menu-link">Contact</a>
                </li>
                <li class="mobile-menu-item">
                    <a href="{{ url('/andaman-tour-packages/custom-booking-package') }}"
                        class="mobile-menu-link">Customize Tour</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse justify-content-end overflow-hidden" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('andaman-tour-packages') }}">
                        Tour
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <!-- Mega Menu -->
                   <div class="mega-menu">
    <div class="container">
        <div class="row p-3 shadow mega-menu-item">
            @php
                $categories = \App\Models\Category::where('type', 'tour')
                    ->where('status', 1)
                    ->limit(6)
                    ->get();
            @endphp

            @foreach ($categories as $category)
                <div class="col-md-2 col-sm-6 {{ $loop->iteration % 2 == 1 ? 'bg-list-first' : '' }}">
                    <h2 class="fs-6">
                       
                            <a href="{{ route('tour.home', ['slug' => $category->slug]) }}" 
                               class="fw-bold">
                                {{ $category->name }}
                            </a>
                    </h2>

                    <ul class="list-unstyled">
                        @if ($category->name === 'Best Seller')
                            @php
                                $bestSellerPackages = \App\Models\TourPackages::with('tourCategory')
                                    ->where('best_seller', 1)
                                    ->where('status', 1)
                                    ->limit(5)
                                    ->get();
                            @endphp

                            @foreach ($bestSellerPackages as $package)
                                <li>
                                    <a href="{{ route('tour.static', [
                                            'slug' => $package->tourCategory->slug,
                                            'subslug' => $package->slug
                                        ]) }}">
                                        {{ $package->package_name }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            @php
                                $tours = \App\Models\TourPackages::where('category_id', $category->id)
                                    ->where('status', 1)
                                    ->limit(5)
                                    ->orderBy('nights','ASC')
                                    ->get();
                            @endphp

                            @foreach ($tours as $tour)
                            
                                <li>
                                    <a href="{{ route('tour.static', [
                                            'slug' => $category->slug,
                                            'subslug' => $tour->slug
                                        ]) }}">
                                        {{ $tour->package_name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>


                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('water-sports') }}">
                        Activities
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                   <div class="mega-menu">
    @php
        $categories = \App\Models\Category::where('type', 'activity')
            ->where('status', 1)
            ->with(['activities'])
            ->get()
            ->values();
        $columns = [];
        $tempCol = [];
        $tempCount = 0;

        foreach ($categories as $category) {
            $srvCount = $category->activities->count();
            $weight = $srvCount === 1 ? 1 : 4;

            if ($tempCount + $weight > 12) {
                $columns[] = $tempCol;
                $tempCol = [];
                $tempCount = 0;
            }

            $tempCol[] = $category;
            $tempCount += $weight;
        }

        if (count($tempCol)) {
            $columns[] = $tempCol;
        }
    @endphp
    <div class="container-fluid">
        <div class="row shadow p-3 mega-menu-item px-3">
            @foreach ($columns as $i => $col)
                <div class="col-2 {{ $i % 2 === 0 ? 'bg-list-first' : '' }}">
                    @foreach ($col as $category)
                        <div class="category-heading">
                            <a href="{{ in_array($category->slug, ['game-fishing-in-andaman', 'charter-boat', 'photography-in-andaman']) ? url($category->slug) : route('activity.static', ['slug' => $category->slug]) }}">
                                <h3 class="menu-sub-category">{{ $category->name }}</h3>
                            </a>
                        </div>
                        @if ($category->slug !== 'charter-boat')
                            <div class="category-list">
                                <ul class="list-unstyled">
                                    @foreach ($category->activities as $service)
                                        @if (strtolower($service->service_name) !== strtolower($category->name))
                                            <li>
                                                @php $activityUrl = $service->url ?? $service->slug; @endphp
                                                @if ($activityUrl)
                                                    <a href="{{ route('activity.view', ['url' => $activityUrl]) }}">{{ $service->service_name }}</a>
                                                @else
                                                    <span>{{ $service->service_name }}</span>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('hotels') }}">
                        Hotels
                    </a>
                </li>

                <li class="nav-item">
                    <!-- <a class="nav-link " href="{{ route('cruises') }}">
                        Ferry Booking
                    </a> -->
                    <a class="nav-link more-menu-lst" href="{{ route('cruises') }}">
                        Ferry Booking
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <!-- Submenu for "More" -->
                    <div class="submenu">
                        <ul class="list-unstyled px-2 ">
                            <li>
                                <a href="{{ route('cruises') }}">
                                    Inter-Island Ferry
                                </a>
                            </li>
                            @php
                            $Btrips = \App\Models\BoatTripLocations::all();
                            @endphp
                            @foreach($Btrips as $btrip)
                            <li><a href="{{ route('boat-trips',['url' => $btrip->page_url]) }}">{{$btrip->name}}</a></li>
                            @endforeach
                           
                        </ul>
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('cabs') }}">
                        Cab
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('bikes') }}">
                        Bike

                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('best-places') }}">
                        Islands
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row shadow p-3 mega-menu-item ">
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/port-blair') }}"><b>Portblair</b></a></span>
                                        </li>
                                        <li><a href="{{ url('islands/port-blair/jolly-buoy-island') }}">Jolly Buoy
                                                Island</a></li>
                                        <li><a href="{{ url('islands/port-blair/cellular-jail') }}">Cellular Jail</a>
                                        </li>
                                        <li><a href="{{ url('islands/port-blair/north-bay-island') }}">North Bay
                                                Island</a></li>
                                        <li><a href="{{ url('islands/port-blair/ross-island') }}">Ross Island</a>
                                        </li>
                                        <li><a href="{{ url('islands/port-blair/chidiatapu') }}">Chidiatapu</a></li>
                                        <li><a href="{{ url('islands/port-blair/corbyns-cove') }}">Corbyns Cove</a>
                                        </li>
                                        <li><a href="{{ url('islands/port-blair/museums') }}">Museums</a></li>
                                        <li><a href="{{ url('islands/port-blair/flag-point') }}">Flag Point</a></li>
                                        <li><a
                                                href="{{ url('islands/port-blair/rajiv-gandhi-water-sports-complex') }}">Rajiv
                                                Gandhi Water Sports Complex</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a
                                                    href="{{ url('islands/havelock-swaraj-dweep') }}"><b>Havelock</b></a>
                                            </span>
                                        </li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/radhanagar-beach') }}">Radhanagar
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/elephant-beach') }}">Elephant
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/kalapathar-beach') }}">Kalapathar
                                                Beach</a></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/neil-shaheed-dweep') }}"><b>Neil (Shaheed
                                                        Dweep)</b></a></span>
                                        </li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/laxmanpur-beach') }}">Laxmanpur
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/bharatpur-beach') }}">Bharatpur
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/natural-rock') }}">Natural
                                                Rock</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/sitapur-beach') }}">Sitapur
                                                Beach</a></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/barren-island') }}"><b>Barren Island</b></a>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/mayabunder') }}"><b>Mayabunder</b></a></span>
                                        </li>
                                        <li><a href="{{ url('islands/mayabunder/karmatang-beach') }}">Karmatang
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/mayabunder/avis-island') }}">Avis Island</a>
                                        </li>
                                        <li><a href="{{ url('islands/mayabunder/german-jetty') }}">German Jetty</a>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/little-andaman') }}"><b>Little
                                                        Andaman</b></a>
                                            </span>
                                        </li>
                                        <li><a href="{{ url('islands/little-andaman/butler-bay-beach') }}">Butler Bay
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/little-andaman/kalapathar-limestone-caves') }}">Kalapathar
                                                Limestone Caves</a></li>
                                        <li><a href="{{ url('islands/little-andaman/white-surf-waterfall') }}">White
                                                Surf Waterfall</a></li>
                                        <li><a href="{{ url('islands/little-andaman/whisper-wave-waterfall') }}">Whisper
                                                Wave Waterfall</a></li>
                                        <li><a href="{{ url('islands/little-andaman/red-palm-oil-plantation') }}">Red
                                                Palm Oil Plantation</a></li>
                                        <li><a href="{{ url('islands/little-andaman/light-house') }}">Light House</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <ul class="list-unstyled">
                                        <li><a href="{{ url('islands/baratang') }}"><b>Baratang</b></a></li>
                                        <li><a href="{{ url('islands/baratang/lime-stone-caves') }}">Lime Stone
                                                Caves</a></li>
                                        <li><a href="{{ url('islands/baratang/mud-volcano') }}">Mud Volcano</a></li>
                                        <li><a href="{{ url('islands/baratang/parrot-island') }}">Parrot Island</a>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/long-island') }}"><b>Long Island</b></a>
                                            </span>
                                        </li>
                                        <li><a href="{{ url('islands/long-island/lalaji-bay-beach') }}">Lalaji Bay
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/long-island/guitar-island') }}">Guitar
                                                Island</a>
                                        </li>
                                        <li><a
                                                href="{{ url('islands/long-island/merk-bay-beach-north-passage-island') }}">Merk
                                                Bay Beach </a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/diglipur') }}"><b>Diglipur</b></a></span>
                                        </li>
                                        <li><a href="{{ url('islands/diglipur/ross-and-smith-island') }}">Ross and
                                                Smith
                                                Island</a></li>
                                        <li><a href="{{ url('islands/diglipur/saddle-peak') }}">Saddle Peak</a></li>
                                        <li><a href="{{ url('islands/diglipur/kalipur-beach') }}">Kalipur Beach</a>
                                        </li>
                                        <li><a href="{{ url('islands/diglipur/ramnagar-beach') }}">Ramnagar Beach</a>
                                        </li>
                                        <li><a href="{{ url('islands/diglipur/mud-volcanoes-of-shyamnagar') }}">Mud
                                                Volcanoes of Shyamnagar</a></li>
                                        <li><a href="{{ url('islands/diglipur/alfred-caves') }}">Alfred Caves</a>
                                        </li>
                                        <li><a href="{{ url('islands/diglipur/lamiya-bay-beach') }}">Lamiya Bay
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/diglipur/aerial-bay') }}">Aerial Bay</a></li>
                                        <li><a href="{{ url('islands/diglipur/patti-level') }}">Patti Level</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <span><a href="{{ url('islands/rangat') }}"><b>Ranghat</b></a></span>
                                        </li>
                                        <li><a href="{{ url('islands/rangat/dhaninallah-mangrove-walkway') }}">Dhaninallah
                                                Mangrove Walkway</a></li>
                                        <li><a href="{{ url('islands/rangat/morrice-dera-beach') }}">Morrice Dera
                                                Beach</a></li>
                                        <li><a href="{{ url('islands/rangat/yeratta-creek') }}">Yeratta Creek</a>
                                        </li>
                                        <li><a href="{{ url('islands/rangat/ambkunj-beach') }}">Ambkunj Beach</a>
                                        </li>
                                        <li><a href="{{ url('islands/rangat/panchavati-waterfalls') }}">Panchavati
                                                Waterfalls</a></li>
                                        <li><a href="{{ url('islands/rangat/curtbert-bay-beach') }}">Cuthbert Bay
                                                Beach</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link more-menu-lst" href="#">
                        More
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <!-- Submenu for "More" -->
                    <div class="submenu">
                        <ul class="list-unstyled px-2 ">
                            <li><a href="{{ url('/andaman-tour-packages/custom-booking-package') }}">Customize
                                    Tour</a>
                            </li>
                            <li><a href="{{ url('about') }}">About</a></li>
                            <li><a href="{{ url('blogs') }}">Blog</a></li>
                            <li><a href="{{ url('how-to-reach') }}">How To Reach</a></li>
                            <li><a href="{{ url('weather') }}">Weather</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item contact-menu">
                    <a class="nav-link fw-bold" href="{{ url('contact') }}">Contact</a>
                </li>
                <li class="nav-item px-3">
                    @guest
                        <a class="nav-link login-icon" href="{{ url('login') }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="Login Now">
                            <i class="fa-solid fa-user" aria-label="Login Now"></i>
                        </a>
                    @endguest

                    @auth
                        <a class="nav-link login-icon" href="{{ url('home') }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="Profile">
                            <i class="fa-solid fa-user" aria-label="Profile"></i>
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>

</nav>
