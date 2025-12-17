@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="row mt-5">
            @include('layouts.profile')

            <div class="col-lg-9">
                <div class="dashboard_main_top">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{ url('bookings/tours') }}" class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <img src="{{ asset('site/img/tour-guide.png') }}" class="d-block img-fluid "
                                        alt="tour-icon">
                                </div>
                                <div class="dashboard_top_text">
                                    <h3 class="fs-5">Tour Bookings</h3>
                                    <div><span>{{ $tourBookings }}</span></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ url('bookings/hotels') }}" class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <img src="{{ asset('site/img/bed-decoration.png') }}" class="d-block img-fluid "
                                        alt="hotel-icon">
                                </div>
                                <div class="dashboard_top_text">
                                    <h3 class="fs-5">Hotel Bookings</h3>
                                    <div><span>{{ $hotelBookings }}</span></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ url('bookings/activities') }}" class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <img src="{{ asset('site/img/entertainment.png') }}" class="d-block img-fluid "
                                        alt="activity-icon">
                                </div>
                                <div class="dashboard_top_text">
                                    <h3 class="fs-5">Activity</h3>
                                    <div><span>{{ $activityBookings }}</span></div>
                                </div>
                            </a>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <a href="{{ url('bookings/cruises') }}" class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <img src="{{ asset('site/img/boat-luxury.png') }}" class="d-block img-fluid "
                                        alt="ferry-icon">
                                </div>
                                <div class="dashboard_top_text">
                                    <h3 class="fs-5">Cruise Bookings</h3>
                                    <div><span>{{ $cruiseBookings }}</span></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ url('bookings/cabs') }}" class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <img src="{{ asset('site/img/cab.png') }}" class="d-block img-fluid "
                                        alt="cab-icon">
                                </div>
                                <div class="dashboard_top_text">
                                    <h3 class="fs-5">Cab Bookings</h3>
                                    <div><span>{{ $cabBookings }}</span></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{ url('bookings/bikes') }}" class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <img src="{{ asset('site/img/motorcycle.png') }}" class="d-block img-fluid "
                                        alt="bike-icon">
                                </div>
                                <div class="dashboard_top_text">
                                    <h3 class="fs-5">Bike Bookings</h3>
                                    <div><span>{{ $bikeBookings }}</span></div>
                                </div>
                            </a>
                        </div>
                       
                    </div>
                    <div class="row mt-2">
                         <div class="col-lg-4">
                            <a href="{{ url('bookings/boat-trips') }}" class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <img src="{{ asset('site/img/icon/boat_trip.png') }}" class="d-block img-fluid" alt="bike-icon">
                                </div>
                                <div class="dashboard_top_text">
                                    <h3 class="fs-5">Boat Trips Bookings</h3>
                                    <div><span>{{ $boatTripBookings }}</span></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between gap-1">
                            <div>
                                <img src="{{ asset('site/img/honeymoon.avif') }}" alt="banner" class="img-fluid
                rounded-3" />
            </div>
            <div>
                <span class="fw-bold user-offer">Best Offer for You</span>
                <ul class="user-offer-list">
                    <li><i class="fa-regular fa-calendar-days"></i> <span>01/09/2024 - 31/12/2024</span>
                    </li>
                    <li><i class="fa-solid fa-user"></i> <span>2 Person</span></li>
                    <li><i class="fa-solid fa-plane"></i> <span>5Night & 6Days</span></li>
                    <li><i class="fa-solid fa-money-bill"></i> <span>₹13500.00</span></li>
                </ul>
                <p class="user-offer-content">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nesciunt quidem quae aliquam mollitia dolorem fugit, velit officiis rem voluptatibus
                    nostrum adipisci, odio dolores, corporis quisquam perferendis facere quis asperiores
                    reprehenderit.</p>
                <hr>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-md-6">
        <span class="fw-bold user-offer">Activities</span>
        <hr>
        <div class="d-flex justify-content-between gap-2">
            <div>
                <img src="{{ asset('site/img/honeymoon.avif') }}" alt="banner" class="img-fluid rounded-3" />
            </div>
            <div>
                <img src="{{ asset('site/img/honeymoon.avif') }}" alt="banner" class="img-fluid rounded-3" />
            </div>
            <div>
                <img src="{{ asset('site/img/honeymoon.avif') }}" alt="banner" class="img-fluid rounded-3" />
            </div>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            <a href="#" class="ferry-inquiry-btn px-3 py-2 rounded-3">View Details</a>
        </div>
        <hr>
    </div>
    </div> --}}
    </div>
    </div>
    </div>
</section>
@endsection

@push('styles')
<style type="text/css">
/* page styles */
</style>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    // page scripts
});
</script>
@endpush