<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="andamanbliss tour and travel" />
    <meta name="description"
        content="@yield('description', 'Plan your dream trip with Andaman Bliss, the best travel agency in Andaman, offering customized tour packages for honeymooners, families. Book your Tour Today.')" />
    <meta name="keywords"
        content="@yield('keywords', 'Andaman Tour Packages, Andaman Tour Packages for Family, Best Travel Agency In Andaman, Best Tour Operators In Andaman, Andaman Honeymoon Tour Packages, Andaman Honeymoon Packages From Chennai, Andaman Group Tour Packages. Top Travel Agent In Andaman')" />

    <script type="application/ld+json">
        @yield('meta_schema', '"Andaman"')
    </script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="BPBz3i-CR0XamXBe_mCGEUegC9M55svVdjJ23lLQbV8" />

    <link rel="preload" as="image" href="{{ asset('site/img/travelBG1.png') }}" />
    <link rel="preload" as="image" href="{{ asset('site/img/bg-hero2.webp') }}" />
    <link rel="apple-touch-icon" href="{{ asset('site/img/logo.png') }}" />
    <link rel="shortcut icon" href="{{ asset('site/img/logo.png') }}" />
    <link rel="canonical" href="{{ url()->current() }}">

    <title>@yield('title', config('app.name', 'AndamanBliss'))</title>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.6/swiper-bundle.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script async defer type="text/javascript">
        <script src="https://grwapi.net/widget.min.js">
    </script>
    <script async
        src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=297&amp;locationId=13198828&amp;lang=en_IN&amp;border=false&amp;shadow=false&amp;backgroundColor=white&amp;display_version=2"
        data-loadtrk onload="this.loadtrk=true"></script>
    <script src="https://cdn.commoninja.com/sdk/latest/commonninja.js" defer></script>
    {{-- <script type="text/javascript" src="{{ asset('js/custom.js') }}" defer></script> --}}


    <!-- Fonts -->
    <link type="text/css" rel="dns-prefetch" href="//fonts.gstatic.com" />
    <!--<link type="text/css" rel="stylesheet" href="https://fonts.bunny.net/css?family=Nunito" />-->

    <!-- Styles -->
    <link type="text/css" rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"
        rel="stylesheet">

    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/style.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/packagestyle.css') }}" />

    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/homestyle.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{--
    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}" /> --}}
    @livewireStyles

    @stack('styles')
</head>

<body class="islandbg">
    <div id="app">
        @include('layouts.dev_header')

        @yield('content')

        @if (
        !request()->routeIs('logout') &&
        !request()->routeIs('password.*') &&
        !request()->routeIs('profile.*') &&
        !request()->routeIs('home') &&
        !request()->routeIs('bookings.*'))
        <div id="footers">
            @include('layouts.dev_footer')
        </div>
        @endif
    </div>

    <!-- validate js -->
    <script type="text/javascript" src="{{ asset('site/js/jquery.validate.js') }}"></script>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('site/js/custom.js') }}"></script>

    <script type="text/javascript">
        toastr.options.timeOut = 10000;
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;

        @if (Session::has('success'))
            toastr.success("{{ session('success') }}", 'Congrats!');
        @endif

        @if (Session::has('info'))
            toastr.info("{{ session('info') }}", 'Info!');
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ session('warning') }}", 'Warning!');
        @endif

        @if (Session::has('error'))
            toastr.error("{{ session('error') }}", 'Oops!');
        @endif

        $(document).ready(function() {
            $('#form').validate();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

         
        });
        $(document).ready(function() {
            $('.select2-input').select2({
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
                width: '100%'
            });
            $('.datepick').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });
        });
    </script>
    @livewireScripts
    @stack('scripts')
    <script async defer
        src="https://maps.gomaps.pro/maps/api/js?key=AlzaSysWE5aPhmG0Qn_OfBqtaJsaUGheaQEtfTV&libraries=geometry,places&callback=initMap">
    </script>
    <script>
        let map;
    let autocompleteBike;
    let autocompleteCab;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 11.7401,
                lng: 92.6586
            },
            zoom: 13
        });

        const options = {
            componentRestrictions: {
                country: 'IN'
            }, // India
            bounds: new google.maps.LatLngBounds(
                new google.maps.LatLng(6.7460, 92.1453),
                new google.maps.LatLng(13.7460, 94.1453)
            )
        };

        const inputBike = document.getElementById('bike-location');
        autocompleteBike = new google.maps.places.Autocomplete(inputBike, options);
        autocompleteBike.bindTo('bounds', map);
        const inputCab = document.getElementById('cab-pickup');
        const inputCabDrop = document.getElementById('cab-drop');
        autocompleteCab = new google.maps.places.Autocomplete(inputCab, options);
        autocompleteCab = new google.maps.places.Autocomplete(inputCabDrop, options);
        autocompleteCab.bindTo('bounds', map);
        autocompleteBike.addListener('place_changed', () => {
            const place = autocompleteBike.getPlace();
            if (!place.geometry) {
                console.log("No details available for the input: '" + place.name + "'");
                return;
            }
            handlePlaceSelection(place);
        });



        autocompleteCab.addListener('place_changed', () => {
            const place = autocompleteCab.getPlace();
            if (!place.geometry) {
                console.log("No details available for the input: '" + place.name + "'");
                return;
            }
            handlePlaceSelection(place);
        });
    }

    function handlePlaceSelection(place) {
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        new google.maps.Marker({
            position: place.geometry.location,
            map: map
        });

        console.log("Selected place: " + place.name);
    }

    google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('success', (message) => {
                toastr.success(message);
            });
            Livewire.on('error', (message) => {
                toastr.error(message);
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            if (document.body.classList.contains('hide-footers')) {
                document.querySelector('footers').style.display = 'none';
            }

            document.querySelectorAll(".traveler-selection-container").forEach(container => {
                const travelerSelect = container.querySelector(".form-control");
                const travelerDropdown = container.querySelector(".traveler-dropdown-form");

                const adultMinus = container.querySelector(".adult-minus");
                const adultPlus = container.querySelector(".adult-plus");
                const adultCount = container.querySelector(".adult-count");

                const childMinus = container.querySelector(".child-minus");
                const childPlus = container.querySelector(".child-plus");
                const childCount = container.querySelector(".child-count");

                const saveTravelers = container.querySelector(".save-travelers");

                travelerSelect.addEventListener("click", function() {
                    travelerDropdown.classList.toggle("show");
                });

                document.addEventListener("click", function(event) {
                    if (!travelerSelect.contains(event.target) && !travelerDropdown.contains(event
                            .target)) {
                        travelerDropdown.classList.remove("show");
                    }
                });

                adultMinus.addEventListener("click", () => {
                    let current = parseInt(adultCount.value);
                    adultCount.value = Math.max(0, current - 1);
                });

                adultPlus.addEventListener("click", () => {
                    let current = parseInt(adultCount.value);
                    adultCount.value = current + 1;
                });

                childMinus.addEventListener("click", () => {
                    let current = parseInt(childCount.value);
                    childCount.value = Math.max(0, current - 1);
                });

                childPlus.addEventListener("click", () => {
                    let current = parseInt(childCount.value);
                    childCount.value = current + 1;
                });

                saveTravelers.addEventListener("click", () => {
                    const adults = parseInt(adultCount.value);
                    const children = parseInt(childCount.value);
                    const totalTravelers = adults + children;

                    travelerSelect.value = totalTravelers > 0 ?
                        `${totalTravelers} Travelers (Adults: ${adults}, Children: ${children})` :
                        "";

                    travelerDropdown.classList.remove("show");
                });
            });
        });

        function updateValue(id, increment) {
            const input = document.getElementById(id);
            let value = parseInt(input.value, 10) || 0;
            const newValue = value + increment;

            if (newValue >= 0 && newValue <= 15) {
                input.value = newValue;
            }
        }

        function applyValues() {
            const adults = parseInt(document.getElementById('adults').value, 10) || 0;
            const children = parseInt(document.getElementById('children').value, 10) || 0;
            const total = adults + children;

            document.getElementById('guest').value = `${total} Travellers`;

            document.getElementById('dropdown-menu').style.display = 'none';
        }

        document.getElementById('guest').addEventListener('click', function() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                items: 1,
                loop: true,
                margin: 1,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        });
    </script>

</body>

</html>