<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <base href="{{ url('/') }}" />

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

        <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

        <!-- reset css -->
        <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">

        <!-- fonts -->
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800">

        <!-- bootstrap 4 css -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <!-- fontawesome css -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

        <!-- icons css -->
        <link type="text/css" rel="stylesheet"
            href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link type="text/css" rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link type="text/css" rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">

        <!-- star-rating css -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/star-rating.min.css') }}">

        <!-- fullcalendar css -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">

        <!-- elaAdmin css -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!-- custom css -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Styles -->
        {{-- <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

        @yield('css')

        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    </head>

    <body class="bg-dark">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="index.html">
                            <img class="align-content" src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                    </div>

                    <div class="bg-warning login-form">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">@yield('title')</strong>
                            </div>

                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <!-- bootstrap 4 js -->
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

        <!-- matchHeight js -->
        <script type="text/javascript" src="{{ asset('js/jquery.matchHeight.min.js') }}"></script>

        <!-- star-rating js -->
        <script type="text/javascript" src="{{ asset('js/star-rating.min.js') }}"></script>

        <!-- validate js -->
        <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>

        <!-- fullcalendar js -->
        <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/fullcalendar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/fullcalendar-init.js') }}"></script>

        <!-- elaAdmin js -->
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

        <!-- custom js -->
        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

        @yield('script')
    </body>

</html>