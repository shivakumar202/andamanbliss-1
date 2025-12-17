<div class="col-lg-3">
    <div class="dashboard_sidebar">
        <div class="dashboard_sidebar_user">
            <img onError="this.onerror=null;this.src='{{ asset('images/default.jpg') }}'"
                alt="{{ auth()->user()->name }}" @if (auth()->user()->profile)
            src="{{ auth()->user()->profile }}"

            @else
            src="{{ asset('images/avatar.png') }}"
            @endif
            class="img img-fluid m-auto d-block" />

            <h3>{{ auth()->user()->name }} {{ auth()->user()->surname }}</h3>
            <p><i class="fas fa-mobile"></i> <a href="javascript:;">{{ auth()->user()->mobile }}</a></p>
            <p><i class="fas fa-envelope"></i> <a href="javascript:;">{{ auth()->user()->email }}</a></p>
        </div>
        <div class="dashboard_menu_area">
            <ul>
                <li>
                    <div class="d-flex gap-2">
                        <img src="{{ asset('site/img/dashboard.png') }}"
                            class="d-block dashboar-side-bar-icon img-fluid " alt="dashboard-icon">
                        <a href="{{ url('home') }}" class="{{ request()->is('home*') ? 'active' : '' }}">Dashboard</a>
                    </div>
                </li>
                <li class="dashboard_dropdown_button  {{ request()->is('bookings*') ? 'active' : '' }}"
                    id="dashboard_dropdowns">
                    <div class="d-flex gap-2"><img src="{{ asset('site/img/booking-menu.png') }}"
                            class="d-block dashboar-side-bar-icon img-fluid " alt="booking-icon">My Bookings<span><i
                                class="fas fa-angle-down"></i></span></div>
                    <div class="booing_sidebar_dashboard {{ request()->is('bookings*') ? '' : 'd-none' }}"
                        id="show_dropdown_items">
                        <ul>
                            <li class="d-flex gap-2"><img src="{{ asset('site/img/tour-guide.png') }}"
                                    class="d-block dashboar-side-bar-icon img-fluid " alt="tour-icon"><a
                                    href="{{ url('bookings/tours') }}"
                                    class="{{ request()->is('bookings/tours*') ? 'active' : '' }}">Tour
                                    Bookings</a></li>
                            <li class="d-flex gap-2"><img src="{{ asset('site/img/bed-decoration.png') }}"
                                    class="d-block dashboar-side-bar-icon img-fluid " alt="hotel-icon"><a
                                    href="{{ url('bookings/hotels') }}"
                                    class="{{ request()->is('bookings/hotels*') ? 'active' : '' }}">Hotel Bookings</a>
                            </li>
                            <li class="d-flex gap-2"><img src="{{ asset('site/img/entertainment.png') }}"
                                    class="d-block dashboar-side-bar-icon img-fluid " alt="activity-icon"><a
                                    href="{{ url('bookings/activities') }}"
                                    class="{{ request()->is('bookings/activities*') ? 'active' : '' }}">Activity
                                    Bookings</a></li>
                            <li class="d-flex gap-2"><img src="{{ asset('site/img/boat-luxury.png') }}"
                                    class="d-block dashboar-side-bar-icon img-fluid " alt="ferry-icon"><a
                                    href="{{ url('bookings/cruises') }}"
                                    class="{{ request()->is('bookings/cruises*') ? 'active' : '' }}">Cruise Bookings</a>
                            </li>
                            <li class="d-flex gap-2"><img src="{{ asset('site/img/cab.png') }}"
                                    class="d-block dashboar-side-bar-icon img-fluid " alt="cab-icon"><a
                                    href="{{ url('bookings/cabs') }}"
                                    class="{{ request()->is('bookings/cabs*') ? 'active' : '' }}">Cab Bookings</a></li>
                            <li class="d-flex gap-2"><img src="{{ asset('site/img/motorcycle.png') }}"
                                    class="d-block dashboar-side-bar-icon img-fluid " alt="bike-icon"><a
                                    href="{{ url('bookings/bikes') }}"
                                    class="{{ request()->is('bookings/bikes*') ? 'active' : '' }}">Bike Bookings</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="d-flex gap-2">
                        <img src="{{ asset('site/img/update-user.png') }}"
                            class="d-block dashboar-side-bar-icon img-fluid " alt="update-profile-icon"><a
                            href="{{ url('profile') }}" class="{{ request()->is('profile*') ? 'active' : '' }}">Update
                            Profile</a>
                    </div>
                </li>
                <li>
                    <div class="d-flex gap-2"><img src="{{ asset('site/img/key.png') }}"
                            class="d-block dashboar-side-bar-icon img-fluid " alt="update-key-icon"> <a
                            href="{{ url('password/change') }}"
                            class="{{ request()->is('password*') ? 'active' : '' }}">Change
                            Password</a></div>
                </li>
                <li>
                    <div class="d-flex gap-2"><img src="{{ asset('site/img/shutdown.png') }}"
                            class="d-block dashboar-side-bar-icon img-fluid " alt="shutdown-key-icon"> <a
                            href="{{ url('logout') }}">Logout</a></div>
                </li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#dashboard_dropdowns').on('click', function() {
        $('#show_dropdown_items').toggleClass('d-none');
    });
});
</script>