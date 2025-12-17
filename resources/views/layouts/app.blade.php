<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="andamanbliss tour and travel" />
    <meta name="description" content="@yield('description', '')" />

    <meta name="keywords" content="@yield('keywords', '')" />
    <script type="application/ld+json">
        @yield('meta_schema', '')
    </script>



    <!-- Open Graph / Facebook -->

    <meta property="og:title" content="@yield('og_title', 'Andaman Bliss')" />
    <meta property="og:description" content="@yield('og_description', 'Andaman Bliss')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="@yield('og_image', 'https://andamanbliss.com/site/img/logo.png')" />
    <meta property="og:site_name" content="Andaman Bliss" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="@yield('twitter_card', '')" />
    <meta name="twitter:title" content="@yield('twitter_title', '')" />
    <meta name="twitter:description" content="@yield('twitter_desc', '')" />
    <meta name="twitter:image" content="@yield('twitter_image', '')" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="BPBz3i-CR0XamXBe_mCGEUegC9M55svVdjJ23lLQbV8" />

    <link rel="apple-touch-icon" href="{{ asset('site/img/logo.png') }}" />
    <link rel="shortcut icon" href="{{ asset('site/img/logo.png') }}" />
    <link rel="canonical" href="{{ rtrim(url()->current(), '/') }}/" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico')}}" />


    <title>@yield('title', config('app.name', 'AndamanBliss'))</title>


    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-M4NMKFSH');</script>
    <!-- End Google Tag Manager -->

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.6/swiper-bundle.min.js">
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QKS6JVYP8Y"></script>



    <!-- Styles -->
    <link type="text/css" rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/style.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('site/css/mobile-menu.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


    {{--
    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom.css') }}" /> --}}
    @livewireStyles
    <meta name="fast2sms" content="7CYGv94Tyjl6EMIH3pznX3YGw2dYl42f">

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-QKS6JVYP8Y');
    </script>
    @stack('styles')
</head>

<body class="islandbg">

    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4NMKFSH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) --> 
    <div id="app">
        <div id="datepicker-backdrop" style="display: none;"></div>

        @include('layouts.header')

        @yield('content')

        @if (
                !request()->routeIs('logout') &&
                !request()->routeIs('password.*') &&
                !request()->routeIs('profile.*') &&
                !request()->routeIs('home') &&
                !request()->routeIs('bookings.*')
            )
            <div id="footers">
                @include('layouts.footer')
            </div>
        @endif
    </div>

    <!-- validate js -->
    <script type="text/javascript" src="{{ asset('site/js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site/js/mobile-menu.js') }}"></script>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('site/js/custom.js') }}"></script>
<script>
const SW_VERSION = "7.0.1"; // match service-worker.js

function checkNotificationStatus() {
    let denyTime = localStorage.getItem("noti_deny_time");

    if (denyTime) {
        let diff = (Date.now() - parseInt(denyTime)) / 1000;
        if (diff < 300) return; // 5 mins cooldown
        localStorage.removeItem("noti_deny_time");
    }

    if (Notification.permission === "denied") {
        showNotificationBlockedMessage();
        return;
    }

    if (Notification.permission === "granted") {
        initPush();
        return;
    }

    if (Notification.permission === "default") {
        showEnableNotificationPrompt();
    }
}

checkNotificationStatus();

/* ============================
   BLOCKED MESSAGE
============================ */
function showNotificationBlockedMessage() {
    const div = document.createElement('div');
    div.innerHTML = `
        <div style="
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ffdddd;
            padding: 16px;
            border-left: 4px solid red;
            border-radius: 8px;
            font-size: 15px;
            width: 300px;
            z-index: 999999;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        ">
            <strong>Notifications Blocked</strong><br>
            Enable them in Browser Settings → Site Settings → Notifications.
        </div>
    `;
    document.body.appendChild(div);
}

/* ============================
   PROMPT BANNER
============================ */
function showEnableNotificationPrompt() {
    const banner = document.createElement("div");
    banner.id = "noti-banner";
    banner.style = `
        position: fixed;
        top: 0;
        left: 8%;
        background: #f8f9fa;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: start;
        border-bottom: 2px solid #ddd;
        z-index: 999999;
        flex-direction: column;
        box-shadow: 6px 7px 32px -7px rgba(0,0,0,0.65);
        font-family: Arial, sans-serif;
    `;
    banner.innerHTML = `
        <div style="font-size: 15px;">
            🔔 <strong>Enable Notifications?</strong><br>
            Get updates, offers & booking alerts.
        </div>
        <div style="margin-top: 10px;">
            <button id="allowNoti" style="
                background: #28a745;
                color: #fff;
                padding: 8px 14px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                margin-right: 10px;
            ">Allow</button>
            <button id="noThanksNoti" style="
                background: #ccc;
                color: #333;
                padding: 8px 14px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
            ">No Thanks</button>
        </div>
    `;
    document.body.appendChild(banner);

    document.getElementById("allowNoti").onclick = function () {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") initPush();
            removeBanner();
        });
    };

    document.getElementById("noThanksNoti").onclick = function () {
        localStorage.setItem("noti_deny_time", Date.now().toString());
        removeBanner();
    };
}

function removeBanner() {
    const b = document.getElementById("noti-banner");
    if (b) b.remove();
}

/* ============================
   INIT PUSH
============================ */
function initPush() {
    navigator.serviceWorker.register("/service-worker.js?v=" + SW_VERSION)
        .then(() => navigator.serviceWorker.ready)
        .then(reg => {
            subscribeUser(reg);
        });
}

/* ============================
   SUBSCRIBE
============================ */
function subscribeUser(sw) {
    sw.pushManager.getSubscription().then(existing => {
        if (existing) {
            saveSubscription(existing);
            return;
        }

        const vapidKey = "{{ env('VAPID_PUBLIC_KEY') }}";
        const convertedVapidKey = urlBase64ToUint8Array(vapidKey);

        sw.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: convertedVapidKey
        }).then(sub => {
            saveSubscription(sub);
        }).catch(err => {
            console.log("Subscription error:", err);
        });
    });
}

/* ============================
   SAVE SUBSCRIPTION
============================ */
function saveSubscription(sub) {
    $.post("{{ url('save-push-notification-sub') }}", {
        _token: '{{ csrf_token() }}',
        sw_version: SW_VERSION,
        sub: sub.toJSON()
    }).done(() => {
        console.log("Subscription saved");
    }).fail(() => {
        console.log("Failed to save subscription");
    });
}

function urlBase64ToUint8Array(base64String) {
    const padding = "=".repeat((4 - (base64String.length % 4)) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, "+")
        .replace(/_/g, "/");

    const rawData = atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
</script>




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

        $(document).ready(function () {
            $('#form').validate();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });
        $(document).ready(function () {
            $('.select2-input').select2({
                placeholder: function () {
                    return $(this).data('placeholder');
                },
                allowClear: true,
                width: '100%'
            });
      

        });


        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5a32d693f4461b0b4ef88c40/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

    </script>
      
    @livewireScripts
    
    @stack('scripts')

      


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('Expert');
            const expertBtn = document.querySelector('a[data-bs-target="#Expert"]');

            modal.addEventListener('show.bs.modal', function () {
                expertBtn.style.display = 'none';
            });

            modal.addEventListener('hidden.bs.modal', function () {
                expertBtn.style.display = 'block';
            });
        });



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
        document.addEventListener('DOMContentLoaded', function () {
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

                travelerSelect.addEventListener("click", function () {
                    travelerDropdown.classList.toggle("show");
                });

                document.addEventListener("click", function (event) {
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

        document.getElementById('guest').addEventListener('click', function () {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

    </script>

</body>

</html>