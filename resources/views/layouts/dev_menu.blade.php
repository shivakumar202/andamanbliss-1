<nav class="navbar navbar-expand-lg fixed-top bg-light shadow p-0">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('site/img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" style="width:60px; height:60px">
        </a>
        <div class="justify-content-end d-flex gap-0 align-items-center">
            <div>
                <a href="{{ url('contact') }}" class="mobo-con px-1"><i class="fa-solid fa-headphones"></i></a>
                <a href="{{ url('login') }}" class="mobo-user px-1"><i class="fa-solid fa-user"></i></a>
            </div>
            <button class="navbar-toggler" type="button" id="navbarTogglerButton" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end overflow-hidden" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('tours') }}">
                        Tour
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <!-- Mega Menu -->
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row p-3 shadow mega-menu-item">
                                @php
                                $categories = \App\Models\Category::where('type', 'tour')
                                    ->limit(6)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="{{ url('tour/' . $category->slug) }}" class="fw-bold">
                                            {{ $category->name }}
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $tours = \App\Models\Service::where('type', 'tour')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($tours as $k => $tour)
                                        <li>
                                            <a href="{{ url('tour/' . $category->slug . '/' . $tour->slug) }}">
                                                {{ $tour->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('hotels') }}">
                        Hotels
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row shadow p-3 mega-menu-item">
                                @php
                                $categories = \App\Models\Category::where('type', 'hotel')
                                    ->limit(6)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }}
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $hotels = \App\Models\Service::where('type', 'hotel')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($hotels as $k => $hotel)
                                        <li>
                                            <a href="{{ url('hotel/' . $category->slug . '/' . $hotel->slug) }}">
                                                {{ $hotel->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('activities') }}">
                        Activities
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row shadow p-3 mega-menu-item">
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <div class="category-heading">
                                        <a href="{{url('activity/scuba-diving/')}}"><h3 class="menu-sub-category">Scuba Diving</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/scuba-diving/boat-diving-in-neil-island') }}">Boat Diving in Neil Island</a></li>
                                            <li><a href="{{ url('activity/scuba-diving/scuba-diving-in-neil-island') }}">Scuba Diving in Neil Island</a></li>
                                            <li><a href="{{ url('activity/scuba-diving/scuba-diving-in-chidiyatapu') }}">Scuba Diving in Chidiyatapu</a></li>
                                            <li><a href="{{ url('activity/scuba-diving/scuba-diving-in-northbay') }}">Scuba Diving in Northbay</a></li>
                                            <li><a href="{{ url('activity/scuba-diving/boat-diving-in-havelock-island') }}">Boat Diving in Havelock Island</a></li>
                                            <li><a href="{{ url('activity/scuba-diving/scuba-diving-in-havelock-island') }}">Scuba Diving in Havelock Island</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <div class="category-heading">
                                       <a href="{{url('activity/light-sound-show/')}}"> <h3 class="menu-sub-category">Light & Sound Show</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/light-sound-show/show-in-cellular-jail') }}">Show in Cellular Jail</a></li>
                                            <li><a href="{{ url('activity/light-sound-show/show-of-ross-islands') }}">Show of Ross Islands</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-heading">
                                        <a href="{{url('activity/sea-walk/')}}"><h3 class="menu-sub-category">Sea Walk</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/sea-walk/sea-walk-in-northbay-islands') }}">Sea Walk in Northbay Islands</a></li>
                                            <li><a href="{{ url('activity/sea-walk/sea-walk-in-elephanta-beach') }}">Sea Walk in Elephanta Beach</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <div class="category-heading">
                                        <a href="url{{ url('activity/glass-bottom-boat-ride/') }}"><h3 class="menu-sub-category">Glass Bottom Boat Ride</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/glass-bottom-boat-ride/semi-submarine-ride-in-port-blair') }}">Semi-Submarine ride in Port Blair</a></li>
                                            <li><a href="{{ url('activity/glass-bottom-boat-ride/andaman-dolphin-glass-bottom-luxury-boat-ride') }}">Andaman Dolphin Glass bottom luxury boat ride</a></li>
                                            <li><a href="{{ url('activity/glass-bottom-boat-ride/reef-looker-semi-sub-marine') }}">Reef Looker Semi-Sub Marine</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-heading">
                                        <a href="{{ url('activity/island-tours/')}}"><h3 class="menu-sub-category">Island Tours</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/island-tours/day-trip-to-barren-island') }}">Day trip to Barren Island</a></li>
                                            <li><a href="{{ url('activity/island-tours/private-boat-around-havelock') }}">Private boat around Havelock</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <div class="category-heading">
                                        <a href="{{ url('activity/dinner-cruise/') }}"><h3 class="menu-sub-category">Dinner Cruise</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/dinner-cruise/bella-bay-dinner-cruise') }}">Bella Bay Dinner Cruise</a></li>
                                            <li><a href="{{ url('activity/dinner-cruise/dinner-cruise-dory') }}">Dinner Cruise Dory</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-heading">
                                        <a href="{{ url('activity/kayaking/') }}"><h3 class="menu-sub-category">Kayaking</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/kayaking/night-kayaking-in-port-blair') }}">Night Kayaking in Port Blair</a></li>
                                            <li><a href="{{ url('activity/kayaking/kayaking-in-havelock-island') }}">Kayaking in Havelock Island</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-heading">
                                        <a href="{{ url('activity/parasailing/') }}"><h3 class="menu-sub-category">Parasailing</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/parasailing/parasailing-in-port-blair') }}">Parasailing in Port Blair</a></li>
                                            <li><a href="{{ url('activity/parasailing/parasailing-in-havelock') }}">Parasailing in Havelock</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <div class="category-heading">
                                      <a href="{{ url('activity/trekking-in-andamans/')  }}"><h3 class="menu-sub-category">Trekking in Andamans</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/trekking-in-andamans/trekking-to-elephant-beach') }}">Trekking to Elephant Beach</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-heading">
                                        <a href="{{ url('activity/under-water-wedding/')  }}"><h3 class="menu-sub-category">Under Water Wedding</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/under-water-wedding/under-water-wedding-at-havelock') }}">Under Water Wedding at Havelock</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-heading">
                                        <a href="{{ url('activity/candle-light-dinner/')  }}"><h3 class="menu-sub-category">Candle Light Dinner</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/candle-light-dinner/candle-light-dinner-havelock') }}">Candle Light Dinner (Havelock)</a></li>
                                            <li><a href="{{ url('activity/candle-light-dinner/candle-light-dinner-neil') }}">Candle Light Dinner (Neil)</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <div class="category-heading">
                                        <a href="{{ url('activity/photography-in-andaman/')  }}"><h3 class="menu-sub-category">Photography In Andaman</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/photography-in-andaman/photography-in-portblair') }}">Photography In Portblair</a></li>
                                            <li><a href="{{ url('activity/photography-in-andaman/photography-in-havelock') }}">Photography In Havelock</a></li>
                                            <li><a href="{{ url('activity/photography-in-andaman/photography-in-neil-islands') }}">Photography In Neil Islands</a></li>
                                        </ul>
                                    </div>
                                    <div class="category-heading">
                                        <a href="{{ url('activity/game-fishing/')  }}"><h3 class="menu-sub-category">Game Fishing</h3></a>
                                    </div>
                                    <div class="category-list">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('activity/game-fishing/game-fishing-portblair') }}">Game Fishing Portblair</a></li>
                                            <li><a href="{{ url('activity/game-fishing/game-fishing-havelock') }}">Game Fishing Havelock</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cruises') }}">
                        Cruise
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row shadow p-3 mega-menu-item">
                                @php
                                $categories = \App\Models\Category::where('type', 'cruise')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }}
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $cruises = \App\Models\Service::where('type', 'cruise')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($cruises as $k => $cruise)
                                        <li>
                                            <a href="{{ url('cruise/' . $category->slug . '/' . $cruise->slug) }}">
                                                {{ $cruise->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <h3 class="menu-sub-category">Popular Routes</h3>
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;">Portblair to Havelock</a></li>
                                        <li><a href="javascript:;">Portblair to Neil</a></li>
                                        <li><a href="javascript:;">Havelock to Portblair</a></li>
                                        <li><a href="javascript:;">Neil to Portblair</a></li>
                                        <li><a href="javascript:;">Havelock to Neil</a></li>
                                        <li><a href="javascript:;">Neil to Havelock</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <h3 class="menu-sub-category">Packages</h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $categories = \App\Models\Category::where('type', 'tour')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($categories as $key => $category)
                                        <li>
                                            <a href="{{ url('tour/' . $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <h3 class="menu-sub-category">Best Beaches</h3>
                                    <ul class="list-unstyled">
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/radhanagar-beach') }}">Radhanagar Beach</a></li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/elephant-beach') }}">Elephanta Beach</a></li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/kalapathar-beach') }}">Kalaphatar Beach</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/sitapur-beach') }}">Sitapur Beach</a></li>
                                        <li><a href="{{ url('islands/port-blair/corbyns-cove') }}">Carbyn beach</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/bharatpur-beach') }}">Bharatpur Beach</a></li>
                                        <li><a href="{{ url('islands/port-blair/chidiatapu') }}">Chidiyatappu Beach</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <h3 class="menu-sub-category">Activities</h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $categories = \App\Models\Category::where('type', 'activity')->with(['activities'])->limit(7)->get();
                                    @endphp
                                @foreach ($categories as $category)
                                <ul>
                                        <li>
                                            <a href="{{ url('activity/' . $category->slug . '/' . $category->activities[0]->slug) }}">
                                                {{ $category->name }} 
                                            </a>
                                        </li>
                                </ul>
                            @endforeach
                                                                    
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <h3 class="menu-sub-category">Islands</h3>
                                    <ul class="list-unstyled">
                                        <li><a href="{{ url('islands/port-blair') }}">Portblair</a></li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep') }}">Havelock</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep') }}">Neil Island</a></li>
                                        <li><a href="{{ url('islands/port-blair/north-bay-island') }}">Northbay</a></li>
                                        <li><a href="{{ url('islands/port-blair/ross-island') }}">Ross Island</a></li>
                                        <li><a href="{{ url('islands/baratang') }}">Baratang</a></li>
                                        <li><a href="{{ url('islands/barren-island') }}">Barren Island</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('cabs') }}">
                        Cab
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row shadow p-3 mega-menu-item">
                                @php
                                $categories = \App\Models\Category::where('type', 'cab')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }} in Portblair
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $cabs = \App\Models\Service::where('type', 'cab')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')->where('address','LIKE','%PortBlair%')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($cabs as $k => $cab)
                                        <li>
                                            <a href="{{ url('cab/' . $category->slug . '/' . $cab->slug) . '?location=Portblair' }}">
                                                {{ $cab->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                @php
                                $categories = \App\Models\Category::where('type', 'cab')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) pt-2 @else bg-list-first @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }} at Havelock
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $cabs = \App\Models\Service::where('type', 'cab')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')->where('address','LIKE','%Havelock%')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($cabs as $k => $cab)
                                        <li>
                                            <a href="{{ url('cab/' . $category->slug . '/' . $cab->slug) . '?location=Havelock' }}">
                                                {{ $cab->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                @php
                                $categories = \App\Models\Category::where('type', 'cab')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }} at Neil Island
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $cabs = \App\Models\Service::where('type', 'cab')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')->where('address','LIKE','%Neil Island%')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($cabs as $k => $cab)
                                        <li>
                                            <a href="{{ url('cab/' . $category->slug . '/' . $cab->slug) . '?location=Neil Island' }}">
                                                {{ $cab->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <h3 class="fs-6"><a href="javascript:;">Popular Routes</a></h3>
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;">Portblair to Havelock</a></li>
                                        <li><a href="javascript:;">Portblair to Neil</a></li>
                                        <li><a href="javascript:;">Havelock to Portblair</a></li>
                                        <li><a href="javascript:;">Neil to Portblair</a></li>
                                        <li><a href="javascript:;">Havelock to Neil</a></li>
                                        <li><a href="javascript:;">Neil to Havelock</a></li>
                                    </ul>
                                </div>
                                @php
                                $categories = \App\Models\Category::where('type', 'cruise')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }}
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $cruises = \App\Models\Service::where('type', 'cruise')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($cruises as $k => $cruise)
                                        <li>
                                            <a href="{{ url('cruise/' . $category->slug . '/' . $cruise->slug) }}">
                                                {{ $cruise->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <h3 class="fs-6"><a href="javascript:;">Activities</a></h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $categories = \App\Models\Category::where('type', 'activity')->with(['activities'])->limit(7)->get();
                                    @endphp
                                @foreach ($categories as $category)
                                <ul>
                                        <li>
                                            <a href="{{ url('activity/' . $category->slug . '/' . $category->activities[0]->slug) }}">
                                                {{ $category->name }} 
                                            </a>
                                        </li>
                                </ul>
                            @endforeach
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('bikes') }}">
                        Bike
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row shadow p-3 mega-menu-item">
                                @php
                                $categories = \App\Models\Category::where('type', 'bike')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }} in Portblair
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $bikes = \App\Models\Service::where('type', 'bike')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')->where('address','LIKE','%PortBlair%')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($bikes as $k => $bike)
                                        <li>
                                            <a href="{{ url('bike/' . $category->slug . '/' . $bike->slug) . '?location=Portblair' }}">
                                                {{ $bike->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                @php
                                $categories = \App\Models\Category::where('type', 'bike')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) pt-2 @else bg-list-first @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }} at Havelock
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $bikes = \App\Models\Service::where('type', 'bike')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')->where('address','LIKE','%Havelock%')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($bikes as $k => $bike)
                                        <li>
                                            <a href="{{ url('bike/' . $category->slug . '/' . $bike->slug) . '?location=Havelock' }}">
                                                {{ $bike->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                @php
                                $categories = \App\Models\Category::where('type', 'bike')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }} at Neil Island
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $bikes = \App\Models\Service::where('type', 'bike')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')->where('address','LIKE','%Neil Island%')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($bikes as $k => $bike)
                                        <li>
                                            <a href="{{ url('bike/' . $category->slug . '/' . $bike->slug) . '?location=Neil Island' }}">
                                                {{ $bike->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <h3 class="fs-6"><a href="javascript:;">Popular Routes</a></h3>
                                    <ul class="list-unstyled">
                                        <li><a href="javascript:;">Portblair to Havelock</a></li>
                                        <li><a href="javascript:;">Portblair to Neil</a></li>
                                        <li><a href="javascript:;">Havelock to Portblair</a></li>
                                        <li><a href="javascript:;">Neil to Portblair</a></li>
                                        <li><a href="javascript:;">Havelock to Neil</a></li>
                                        <li><a href="javascript:;">Neil to Havelock</a></li>
                                    </ul>
                                </div>
                                @php
                                $categories = \App\Models\Category::where('type', 'cruise')
                                    ->limit(1)
                                    ->get();
                                @endphp
                                @foreach ($categories as $key => $category)
                                <div class="col-md-2 col-sm-6 @if ($key % 2 == 0) bg-list-first @else pt-2 @endif">
                                    <h3 class="fs-6">
                                        <a href="javascript:;" class="fw-bold">
                                            {{ $category->name }}
                                        </a>
                                    </h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $cruises = \App\Models\Service::where('type', 'cruise')
                                            ->where('category_id', $category->id)
                                            ->where('status', 'active')
                                            ->limit(6)
                                            ->get();
                                        @endphp
                                        @foreach ($cruises as $k => $cruise)
                                        <li>
                                            <a href="{{ url('cruise/' . $category->slug . '/' . $cruise->slug) }}">
                                                {{ $cruise->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                <div class="col-md-2 col-sm-6 pt-2">
                                    <h3 class="fs-6"><a href="javascript:;">Activities</a></h3>
                                    <ul class="list-unstyled">
                                        @php
                                        $categories = \App\Models\Category::where('type', 'activity')->with(['activities'])->limit(7)->get();
                                    @endphp
                                @foreach ($categories as $category)
                                <ul>
                                        <li>
                                            <a href="{{ url('activity/' . $category->slug . '/' . $category->activities[0]->slug) }}">
                                                {{ $category->name }} 
                                            </a>
                                        </li>
                                </ul>
                            @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="javascript:;">
                        Islands
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <div class="mega-menu">
                        <div class="container">
                            <div class="row shadow p-3 mega-menu-item ">
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/port-blair') }}"><b>Portblair</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/port-blair/jolly-buoy-island') }}">Jolly Buoy Island</a></li>
                                        <li><a href="{{ url('islands/port-blair/cellular-jail') }}">Cellular Jail</a></li>
                                        <li><a href="{{ url('islands/port-blair/north-bay-island') }}">North Bay Island</a></li>
                                        <li><a href="{{ url('islands/port-blair/ross-island') }}">Ross Island</a></li>
                                        <li><a href="{{ url('islands/port-blair/chidiatapu') }}">Chidiatapu</a></li>
                                        <li><a href="{{ url('islands/port-blair/corbyns-cove') }}">Corbyns Cove</a></li>
                                        <li><a href="{{ url('islands/port-blair/museums') }}">Museums</a></li>
                                        <li><a href="{{ url('islands/port-blair/flag-point') }}">Flag Point</a></li>
                                        <li><a href="{{ url('islands/port-blair/rajiv-gandhi-water-sports-complex') }}">Rajiv Gandhi Water Sports Complex</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/havelock-swaraj-dweep') }}"><b>Havelock</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/radhanagar-beach') }}">Radhanagar Beach</a></li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/elephant-beach') }}">Elephant Beach</a></li>
                                        <li><a href="{{ url('islands/havelock-swaraj-dweep/kalapathar-beach') }}">Kalapathar Beach</a></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/neil-shaheed-dweep') }}"><b>Neil (Shaheed Dweep)</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/laxmanpur-beach') }}">Laxmanpur Beach</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/bharatpur-beach') }}">Bharatpur Beach</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/natural-rock') }}">Natural Rock</a></li>
                                        <li><a href="{{ url('islands/neil-shaheed-dweep/sitapur-beach') }}">Sitapur Beach</a></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/barren-island') }}"><b>Barren Island</b></a></h6>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/mayabunder') }}"><b>Mayabunder</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/mayabunder/karmatang-beach') }}">Karmatang Beach</a></li>
                                        <li><a href="{{ url('islands/mayabunder/avis-island') }}">Avis Island</a></li>
                                        <li><a href="{{ url('islands/mayabunder/german-jetty') }}">German Jetty</a></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/little-andaman') }}"><b>Little Andaman</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/little-andaman/butler-bay-beach') }}">Butler Bay Beach</a></li>
                                        <li><a href="{{ url('islands/little-andaman/kalapathar-limestone-caves') }}">Kalapathar Limestone Caves</a></li>
                                        <li><a href="{{ url('islands/little-andaman/white-surf-waterfall') }}">White Surf Waterfall</a></li>
                                        <li><a href="{{ url('islands/little-andaman/whisper-wave-waterfall') }}">Whisper Wave Waterfall</a></li>
                                        <li><a href="{{ url('islands/little-andaman/red-palm-oil-plantation') }}">Red Palm Oil Plantation</a></li>
                                        <li><a href="{{ url('islands/little-andaman/light-house') }}">Light House</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/baratang') }}"><b>Baratang</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/baratang/lime-stone-caves') }}">Lime Stone Caves</a></li>
                                        <li><a href="{{ url('islands/baratang/mud-volcano') }}">Mud Volcano</a></li>
                                        <li><a href="{{ url('islands/baratang/parrot-island') }}">Parrot Island</a></li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/long-island') }}"><b>Long Island</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/long-island/lalaji-bay-beach') }}">Lalaji Bay Beach</a></li>
                                        <li><a href="{{ url('islands/long-island/guitar-island') }}">Guitar Island</a></li>
                                        <li><a href="{{ url('islands/long-island/merk-bay-beach-north-passage-island') }}">Merk Bay Beach </a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6 bg-list-first">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/diglipur') }}"><b>Diglipur</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/diglipur/ross-and-smith-island') }}">Ross and Smith Island</a></li>
                                        <li><a href="{{ url('islands/diglipur/saddle-peak') }}">Saddle Peak</a></li>
                                        <li><a href="{{ url('islands/diglipur/kalipur-beach') }}">Kalipur Beach</a></li>
                                        <li><a href="{{ url('islands/diglipur/ramnagar-beach') }}">Ramnagar Beach</a></li>
                                        <li><a href="{{ url('islands/diglipur/mud-volcanoes-of-shyamnagar') }}">Mud Volcanoes of Shyamnagar</a></li>
                                        <li><a href="{{ url('islands/diglipur/alfred-caves') }}">Alfred Caves</a></li>
                                        <li><a href="{{ url('islands/diglipur/lamiya-bay-beach') }}">Lamiya Bay Beach</a></li>
                                        <li><a href="{{ url('islands/diglipur/aerial-bay') }}">Aerial Bay</a></li>
                                        <li><a href="{{ url('islands/diglipur/patti-level') }}">Patti Level</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h6><a href="{{ url('islands/rangat') }}"><b>Rangat</b></a></h6>
                                        </li>
                                        <li><a href="{{ url('islands/rangat/dhaninallah-mangrove-walkway') }}">Dhaninallah Mangrove Walkway</a></li>
                                        <li><a href="{{ url('islands/rangat/morrice-dera-beach') }}">Morrice Dera Beach</a></li>
                                        <li><a href="{{ url('islands/rangat/yeratta-creek') }}">Yeratta Creek</a></li>
                                        <li><a href="{{ url('islands/rangat/ambkunj-beach') }}">Ambkunj Beach</a></li>
                                        <li><a href="{{ url('islands/rangat/panchavati-waterfalls') }}">Panchavati Waterfalls</a></li>
                                        <li><a href="{{ url('islands/rangat/curtbert-bay-beach') }}">Cuthbert Bay Beach</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link more-menu-lst" href="javascript:;">
                        More
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <!-- Submenu for "More" -->
                    <div class="submenu">
                        <ul class="list-unstyled px-2 ">
                            <li><a href="{{ url('tours/booking/custom') }}">Customize Tour</a></li>
                            <li><a href="{{ url('about') }}">About</a></li>
                            <li><a href="{{ url('blog') }}">Blog</a></li>
                            <li><a href="{{ url('how-to-reach') }}">How To Reach</a></li>
                            <li><a href="{{ url('weather') }}">Weather</a></li>
                            <li><a href="{{ url('photography') }}">Photography</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item contact-menu">
                    <a class="nav-link fw-bold" href="{{ url('/dev/contact') }}">Contact</a>
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
   <!-- <div>
        <marquee direction="right" style="background:#ffeb3b; color:#333; font-size:12px; font-weight:bold; padding:10px; border-radius:10px;">
            The website is under maintenance. We'll be back shortly!
        </marquee>
    </div> -->
</nav>
