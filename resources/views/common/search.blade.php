<section id="home_search_form ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="home_search_form_area">
                    <div class="home_search_form_tabbtn">
                        <ul class="nav nav-tabs justify-content-center align-items-center" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link search-tab1 text-white {{ request()->is('/') || request()->is('tours*') ? 'active' : '' }}" id="tours-tab" data-bs-toggle="tab" data-bs-target="#tours" type="button" role="tab" aria-controls="tours" aria-selected="true">
                                    <i class="fa-solid fa-location-dot"></i>
                                    Tours
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link search-tab2 text-white {{ request()->is('hotels*') ? 'active' : '' }}" id="hotels-tab" data-bs-toggle="tab" data-bs-target="#hotels" type="button" role="tab" aria-controls="hotels" aria-selected="false">
                                    <i class="fas fa-building"></i>
                                    Hotels
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link search-tab2 text-white {{ request()->is('activities*') ? 'active' : '' }}" id="activities-tab" data-bs-toggle="tab" data-bs-target="#activities" type="button" role="tab" aria-controls="activities" aria-selected="false">
                                    <i class="fa-solid fa-person-swimming"></i>
                                    Activities
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link search-tab2 text-white {{ request()->is('cruises*') ? 'active' : '' }}" id="cruises-tab" data-bs-toggle="tab" data-bs-target="#cruises" type="button" role="tab" aria-controls="cruises" aria-selected="false">
                                    <i class="fas fa-ship"></i>
                                    Cruises
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link search-tab2 text-white {{ request()->is('cabs*') ? 'active' : '' }}" id="cabs-tab" data-bs-toggle="tab" data-bs-target="#cabs" type="button" role="tab" aria-controls="cabs" aria-selected="false">
                                    <i class="fa-solid fa-car"></i>
                                    Cabs
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link search-tab2 text-white {{ request()->is('bikes*') ? 'active' : '' }}" id="bikes-tab" data-bs-toggle="tab" data-bs-target="#bikes" type="button" role="tab" aria-controls="bikes" aria-selected="false">
                                    <i class="fa-solid fa-motorcycle"></i>
                                    Bikes
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade {{ request()->is('/') || request()->is('tours*') ? 'show active' : '' }}" id="tours" role="tabpanel" aria-labelledby="tours-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tour_search_form">
                                        <form method="GET" action="{{ url('tours') }}" class="mt-0">
                                            <div class="row search-tab-pannel px-3 py-3">
                                                <div class="col-md-2">
                                                    <label for="category" class="form-label">Packages</label>
                                                    <select name="category" class="form-select form-select-ferry">
                                                        <option value="">Select</option>
                                                        @php
                                                        $categories = \App\Models\Category::where('type', 'tour')
                                                            ->get();
                                                        @endphp
                                                        @foreach ($categories as $key => $category)
                                                        <option value="{{ $category->slug }}" @selected($category->slug == request('category'))>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkin" class="form-label">Arrival</label>
                                                    <input type="text" name="checkin" value="{{ request('checkin') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkout" class="form-label">Departure</label>
                                                    <input type="text" name="checkout" value="{{ request('checkout') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="adult" class="form-label">Adult</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                        <input type="number" name="adult" value="{{ request('adult', 1) }}" min="1" class="form-control adults-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="child" class="form-label">Child</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting infants-decrement" type="button">-</button>
                                                        <input type="number" name="child" value="{{ request('child', 0) }}" min="0" class="form-control infants-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting infants-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 top_form_search_button">
                                                    <button type="submit" class="btn home_form_btn_search text-white fw-bold text-uppercase mt-4 px-5">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ request()->is('hotels*') ? 'show active' : '' }}" id="hotels" role="tabpanel" aria-labelledby="hotels-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tour_search_form">
                                        <form method="GET" action="{{ url('hotels') }}" class="mt-0">
                                            <div class="row search-tab-pannel px-3 py-3">
                                                <div class="col-md-2">
                                                    <label for="keyword" class="form-label">Hotels</label>
                                                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search hotels" class="form-control">
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkin" class="form-label">Checkin</label>
                                                    <input type="text" name="checkin" value="{{ request('checkin') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkout" class="form-label">Checkout</label>
                                                    <input type="text" name="checkout" value="{{ request('checkout') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="adult" class="form-label">Adult</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                        <input type="number" name="adult" value="{{ request('adult', 1) }}" min="1" class="form-control adults-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="child" class="form-label">Child</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting infants-decrement" type="button">-</button>
                                                        <input type="number" name="child" value="{{ request('child', 0) }}" min="0" class="form-control infants-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting infants-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 top_form_search_button">
                                                    <button type="submit" class="btn home_form_btn_search text-white fw-bold text-uppercase mt-4 px-5">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ request()->is('activities*') ? 'show active' : '' }}" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tour_search_form">
                                        <form method="GET" action="{{ url('activities') }}" class="mt-0">
                                            <div class="row search-tab-pannel px-3 py-3">
                                                <div class="col-md-6">
                                                    <label for="keyword" class="form-label">Activities</label>
                                                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search activities" class="form-control">
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkin" class="form-label">Checkin</label>
                                                    <input type="text" name="checkin" value="{{ request('checkin') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="adult" class="form-label">No. of Diver</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                        <input type="number" name="adult" value="{{ request('adult', 1) }}" min="1" class="form-control adults-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 top_form_search_button">
                                                    <button type="submit" class="btn home_form_btn_search text-white fw-bold text-uppercase mt-4 px-5">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ request()->is('cruises*') ? 'show active' : '' }}" id="cruises" role="tabpanel" aria-labelledby="cruises-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs multi_routes mt-1" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#singletrip" aria-selected="false" role="tab" tabindex="-1">Single Trip</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#multipletrip" aria-selected="false" role="tab" tabindex="-1">Multiple Trips</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-2 singleviewTabcontent bg-white">
                                        <div class="tab-pane fade active show" id="singletrip" role="tabpanel" aria-labelledby="tab1-tab">
                                            <div class="row">
                                                <div class="p-0">
                                                    <div class="tour_search_form">
                                                        <form method="GET" action="{{ url('cruises') }}" class="mt-0">
                                                            <div class="row search-tab-pannel px-3 py-3">
                                                                <div class="col-md-2 col-sm-12 col-12">
                                                                    <label for="from" class="form-label">Embark From</label>
                                                                    <select name="from" class="form-select form-select-ferry">
                                                                        <option value="">Select</option>
                                                                        <option value="portblair" @selected (request('from') == 'portblair')>Portblair</option>
                                                                        <option value="havelock" @selected (request('from') == 'havelock')>Havelock</option>
                                                                        <option value="neil" @selected (request('from') == 'neil')>Neil</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 col-sm-12 col-12">
                                                                    <label for="to" class="form-label">Destination</label>
                                                                    <select name="to" class="form-select form-select-ferry">
                                                                        <option value="">Select</option>
                                                                        <option value="portblair" @selected (request('to') == 'portblair')>Portblair</option>
                                                                        <option value="havelock" @selected (request('to') == 'havelock')>Havelock</option>
                                                                        <option value="neil" @selected (request('to') == 'neil')>Neil</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 position-relative">
                                                                    <label for="checkin" class="form-label">Checkin</label>
                                                                    <input type="text" name="checkin" value="{{ request('checkin') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="adult" class="form-label">Adult</label>
                                                                    <div class="input-group p-0 m-0">
                                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                                        <input type="number" name="adult" value="{{ request('adult', 1) }}" min="1" class="form-control adults-count" readonly>
                                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="child" class="form-label">Child</label>
                                                                    <div class="input-group p-0 m-0">
                                                                        <button class="btn btn-outline-secondary search_user-counting infants-decrement" type="button">-</button>
                                                                        <input type="number" name="child" value="{{ request('child', 0) }}" min="0" class="form-control infants-count" readonly>
                                                                        <button class="btn btn-outline-secondary search_user-counting infants-increment" type="button">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 top_form_search_button">
                                                                    <button type="submit" class="btn home_form_btn_search text-white fw-bold text-uppercase mt-4 px-5">Search</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="multipletrip" role="tabpanel" aria-labelledby="tab2-tab">
                                            <div class="row">
                                                <form method="GET" action="{{ url('cruises') }}" class="p-0">
                                                    <div class="tour_search_form">
                                                        <div class="mt-0">
                                                            <div class="row search-tab-pannel px-3 py-3">
                                                                <div class="col-md-2 col-sm-12 col-12">
                                                                    <label for="from[]" class="form-label">Embark From</label>
                                                                    <select name="from[]" class="form-select form-select-ferry">
                                                                        <option value="">Select</option>
                                                                        <option value="portblair" @selected (request('from[]') == 'portblair')>Portblair</option>
                                                                        <option value="havelock" @selected (request('from[]') == 'havelock')>Havelock</option>
                                                                        <option value="neil" @selected (request('from[]') == 'neil')>Neil</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 col-sm-12 col-12">
                                                                    <label for="to[]" class="form-label">Destination</label>
                                                                    <select name="to[]" class="form-select form-select-ferry">
                                                                        <option value="">Select</option>
                                                                        <option value="portblair" @selected (request('to[]') == 'portblair')>Portblair</option>
                                                                        <option value="havelock" @selected (request('to[]') == 'havelock')>Havelock</option>
                                                                        <option value="neil" @selected (request('to[]') == 'neil')>Neil</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 position-relative">
                                                                    <label for="checkin[]" class="form-label">Checkin</label>
                                                                    <input type="text" name="checkin[]" value="{{ request('checkin[]') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="adult[]" class="form-label">Adult</label>
                                                                    <div class="input-group p-0 m-0">
                                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                                        <input type="number" name="adult[]" value="{{ request('adult[]', 1) }}" min="1" class="form-control adults-count" readonly>
                                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="child[]" class="form-label">Child</label>
                                                                    <div class="input-group p-0 m-0">
                                                                        <button class="btn btn-outline-secondary search_user-counting infants-decrement" type="button">-</button>
                                                                        <input type="number" name="child[]" value="{{ request('child[]', 0) }}" min="0" class="form-control infants-count" readonly>
                                                                        <button class="btn btn-outline-secondary search_user-counting infants-increment" type="button">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 top_form_search_button">
                                                                    <button type="button" id="add-more-button" class="btn home_form_btn_search text-white fw-bold text-uppercase mt-4 px-5">Add More</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tour_search_form_multiple mt-2">
                                                        <div class="mt-0">
                                                            <div class="row search-tab-pannel px-3 py-3">
                                                                <div class="col-md-2 col-sm-12 col-12">
                                                                    <label for="from[]" class="form-label">Embark From</label>
                                                                    <select name="from[]" class="form-select form-select-ferry">
                                                                        <option value="">Select</option>
                                                                        <option value="portblair" @selected (request('from[]') == 'portblair')>Portblair</option>
                                                                        <option value="havelock" @selected (request('from[]') == 'havelock')>Havelock</option>
                                                                        <option value="neil" @selected (request('from[]') == 'neil')>Neil</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 col-sm-12 col-12">
                                                                    <label for="to[]" class="form-label">Destination</label>
                                                                    <select name="to[]" class="form-select form-select-ferry">
                                                                        <option value="">Select</option>
                                                                        <option value="portblair" @selected (request('to[]') == 'portblair')>Portblair</option>
                                                                        <option value="havelock" @selected (request('to[]') == 'havelock')>Havelock</option>
                                                                        <option value="neil" @selected (request('to[]') == 'neil')>Neil</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2 position-relative">
                                                                    <label for="checkin[]" class="form-label">Checkin</label>
                                                                    <input type="text" name="checkin[]" value="{{ request('checkin[]') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="adult[]" class="form-label">Adult</label>
                                                                    <div class="input-group p-0 m-0">
                                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                                        <input type="number" name="adult[]" value="{{ request('adult[]', 1) }}" min="1" class="form-control adults-count" readonly>
                                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="child[]" class="form-label">Child</label>
                                                                    <div class="input-group p-0 m-0">
                                                                        <button class="btn btn-outline-secondary search_user-counting infants-decrement" type="button">-</button>
                                                                        <input type="number" name="child[]" value="{{ request('child[]', 0) }}" min="0" class="form-control infants-count" readonly>
                                                                        <button class="btn btn-outline-secondary search_user-counting infants-increment" type="button">+</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 top_form_search_button">
                                                                    <button type="button" class="btn remove-sector text-white fw-bold text-uppercase mt-4 px-5" style="display: none;">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-center my-4">
                                                        <button type="button" class="btn home_form_btn_search text-white fw-bold text-uppercase px-5">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ request()->is('cabs*') ? 'show active' : '' }}" id="cabs" role="tabpanel" aria-labelledby="cabs-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tour_search_form">
                                        <form method="GET" action="{{ url('cabs') }}" class="mt-0">
                                            <div class="row search-tab-pannel px-3 py-3">
                                                <div class="col-md-2 col-sm-12 col-12">
                                                    <label for="from" class="form-label">Pickup</label>
                                                    <select name="from" class="form-select form-select-ferry">
                                                        <option value="">Select</option>
                                                        <option value="portblair" @selected (request('from') == 'portblair')>Portblair</option>
                                                        <option value="havelock" @selected (request('from') == 'havelock')>Havelock</option>
                                                        <option value="neil" @selected (request('from') == 'neil')>Neil</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-12">
                                                    <label for="to" class="form-label">Drop</label>
                                                    <select name="to" class="form-select form-select-ferry">
                                                        <option value="">Select</option>
                                                        <option value="portblair" @selected (request('to') == 'portblair')>Portblair</option>
                                                        <option value="havelock" @selected (request('to') == 'havelock')>Havelock</option>
                                                        <option value="neil" @selected (request('to') == 'neil')>Neil</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkin" class="form-label">Checkin</label>
                                                    <input type="text" name="checkin" value="{{ request('checkin') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="passanger" class="form-label">No. of Passanger</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                        <input type="number" name="passanger" value="{{ request('passanger', 1) }}" min="1" class="form-control adults-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="suitcase" class="form-label">No. of Suitcase</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting infants-decrement" type="button">-</button>
                                                        <input type="number" name="suitcase" value="{{ request('suitcase', 0) }}" min="0" class="form-control infants-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting infants-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 top_form_search_button">
                                                    <button type="submit" class="btn home_form_btn_search text-white fw-bold text-uppercase mt-4 px-5">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ request()->is('bikes*') ? 'show active' : '' }}" id="bikes" role="tabpanel" aria-labelledby="bikes-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tour_search_form">
                                        <form method="GET" action="{{ url('bikes') }}" class="mt-0">
                                            <div class="row search-tab-pannel px-3 py-3">
                                                <div class="col-md-4 col-sm-12 col-12">
                                                    <label for="from" class="form-label">Pickup & Drop</label>
                                                    <select name="from" class="form-select form-select-ferry">
                                                        <option value="">Select</option>
                                                        <option value="portblair" @selected (request('from') == 'portblair')>Portblair</option>
                                                        <option value="havelock" @selected (request('from') == 'havelock')>Havelock</option>
                                                        <option value="neil" @selected (request('from') == 'neil')>Neil</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkin" class="form-label">Checkin</label>
                                                    <input type="text" name="checkin" value="{{ request('checkin') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2 position-relative">
                                                    <label for="checkout" class="form-label">Checkout</label>
                                                    <input type="text" name="checkout" value="{{ request('checkout') }}" placeholder="yyyy-mm-dd" class="form-control datepicker" readonly>
                                                    <span class="custom-calendar-cruise"><i class="fa-solid fa-calendar-days"></i></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="passanger" class="form-label">No. of Passanger</label>
                                                    <div class="input-group p-0 m-0">
                                                        <button class="btn btn-outline-secondary search_user-counting adults-decrement" type="button">-</button>
                                                        <input type="number" name="passanger" value="{{ request('passanger', 1) }}" min="1" class="form-control adults-count" readonly>
                                                        <button class="btn btn-outline-secondary search_user-counting adults-increment" type="button">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 top_form_search_button">
                                                    <button type="submit" class="btn home_form_btn_search text-white fw-bold text-uppercase mt-4 px-5">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>