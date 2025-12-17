<div class="news_tags_area">
    <!--<a href="{{ url('activities') }}">
        <img src="{{ asset('site/img/island-side-bar-activities.webp') }}" alt="banner">
    </a>-->
    <a class="weatherwidget-io" href="https://forecast7.com/en/11d7492d66/andaman-and-nicobar-islands/" data-label_1="ANDAMAN AND NICOBAR ISLANDS" data-label_2="WEATHER" data-theme="original" >ANDAMAN AND NICOBAR ISLANDS WEATHER</a>
</div>
<div class="pt-5">
    <h3>Why Book with Andamanbliss</h3>
    <div class="pb-3">
        <p>Andaman Bliss providеs pеrsonalizеd itinеrariеs, local guidеs, 24 hour support, rеsponsiblе tourism and еxclusivе pricеs to guarantее a rеlaxеd vacation in Andaman. Choose Andaman Bliss To have an amazing experience.</p>
        <div class="row">
            <div class="col-md-4 col-4">
                <div class="island-pg-icon">
                    <img src="{{ asset('site/img/icon/beach-icon.png') }}" alt="beach-icon" class="img-fluid">
                    <h4>Hassle Free Holiday Planning</h4>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div class="island-pg-icon">
                    <img src="{{ asset('site/img/icon/gift.png') }}" alt="deal-icon" class="img-fluid">
                    <h4>Best Deals Guaranteed</h4>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div class="island-pg-icon">
                    <img src="{{ asset('site/img/icon/tr-expert.png') }}" alt="expert-icon" class="img-fluid">
                    <h4>50+ Travel Experts</h4>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div class="island-pg-icon">
                    <img src="{{ asset('site/img/icon/confirm-icon.png') }}" alt="deal-icon" class="img-fluid">
                    <h4>Government Registered Company</h4>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div class="island-pg-icon">
                    <img src="{{ asset('site/img/icon/experience.png') }}" alt="support-icon" class="img-fluid">
                    <h4>Best Support 24/7</h4>
                </div>
            </div>
            <div class="col-md-4 col-4">
                <div class="island-pg-icon">
                    <img src="{{ asset('site/img/icon/secure-payment-icon.png') }}" alt="discount-icon" class="img-fluid">
                    <h4>Secure Payment </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="pt-3">
    <div class="row">
        <div class="owl-carousel owl-theme" id="owl-demo">
            <div class="item">
                <img src="{{ asset('site/img/island-treanding1.webp') }}" alt="kayaking-icon">
            </div>
            <div class="item">
                <img src="{{ asset('site/img/island-treanding2.webp') }}" alt="honeymoon-icon">
            </div>
            <div class="item">
                <img src="{{ asset('site/img/scuba-dive-in-india.jpg') }}" alt="scuba-icon">
            </div>
        </div>
    </div>
</div>
<h3 class="social-heading">FOLLOW US</h3>
<div class="news_tags_area-social pt-3">
    <div class="row">
        <div class="col-md-4 col-4 text-center">
            <a href="https://twitter.com/andaman_bliss" target="_blank">
                <i class="fa-brands fa-x-twitter"></i>
                <p>twitter</p>
            </a>
        </div>
        <div class="col-md-4 col-4 text-center">
            <a href="https://www.facebook.com/andamanblisstravels" target="_blank">
                <i class="fa-brands fa-square-facebook"></i>
                <p>facebook</p>
            </a>
        </div>
        <div class="col-md-4 col-4 text-center">
            <a href="https://www.instagram.com/andamanbliss" target="_blank">
                <i class="fa-brands fa-instagram"></i>
                <p>instagram</p>
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4 col-4 text-center">
            <a href="https://www.linkedin.com/in/andaman-bliss-955b7a151" target="_blank">
                <i class="fa-brands fa-linkedin"></i>
                <p>linkedin</p>
            </a>
        </div>
        <div class="col-md-4 col-4 text-center">
            <a href="https://in.pinterest.com/andamanbliss" target="_blank">
                <i class="fa-brands fa-square-pinterest"></i>
                <p>pinterest</p>
            </a>
        </div>
        <div class="col-md-4 col-4 text-center">
            {{-- <a href="#">
                <i class="fa-brands fa-youtube"></i>
                <p>youtube</p>
            </a> --}}
        </div>
    </div>
</div>
<h3 class="mt-5">Popular Sevice at AB</h3>
<div class="news_tags_area">
    <ul class="pb-5">
        <li><a href="{{ url('tours') }}">Tour Booking</a></li>
        <li><a href="{{ url('hotels') }}">Hotel Booking</a></li>
        <li><a href="{{ url('activities') }}">Activity Booking</a></li>
        <li><a href="{{ url('cruises') }}">Ferry Booking</a></li>
        <li><a href="{{ url('cabs') }}">Cab Booking</a></li>
        <li><a href="{{ url('bikes') }}">Bike Booking</a></li>
        <li><a href="{{ url('how-to-reach') }}">How to Reach</a></li>
        <li><a href="{{ url('photography') }}">Photography</a></li>
    </ul>
</div>
<div class="pt-3">
    <h3 class="mt-3">Best Selling Packages</h3>
    <div class="island-left-title-list px-3">
        <ul>
            @php
            $categories = \App\Models\Category::where('type', 'tour')
                ->get();
            @endphp
            @foreach ($categories as $key => $category)
            <li><a href="{{ url('tour/' . $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <h3 class="mt-3">Best Fun Activities</h3>
    <div class="island-left-title-list px-3">
        <ul>
            @php
            $categories = \App\Models\Category::where('type', 'activity')
                ->get();
            @endphp
            @foreach ($categories as $key => $category)
            <li><a href="{{ url('activity/' . $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <h3 class="mt-3">Popular Tourist Places & Islands</h3>
    <div class="island-left-title-list px-3">
        <ul>
            <li><a href="{{ url('islands/port-blair') }}">Portblair</a></li>
            <li><a href="{{ url('islands/havelock-swaraj-dweep') }}">Havelock</a></li>
            <li><a href="{{ url('islands/neil-shaheed-dweep') }}">Neil (Shaheed Dweep)</a></li>
            <li><a href="{{ url('islands/barren-island') }}">Barren Island</a></li>
            <li><a href="{{ url('islands/mayabunder') }}">Mayabunder</a></li>
            <li><a href="{{ url('islands/little-andaman') }}">Little Andaman</a></li>
            <li><a href="{{ url('islands/baratang') }}">Baratang</a></li>
            <li><a href="{{ url('islands/long-island') }}">Long Island</a></li>
            <li><a href="{{ url('islands/diglipur') }}">Diglipur</a></li>
            <li><a href="{{ url('islands/rangat') }}">Ranghat</a></li>
        </ul>
    </div>
</div>