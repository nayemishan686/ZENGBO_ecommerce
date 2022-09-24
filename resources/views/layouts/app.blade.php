<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - {{ $setting->title }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.css">
    <link href="{{ asset('public/frontend') }}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/responsive.css">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
    @stack('css')
</head>

<body>

    <div class="super_container">
        <!-- Header -->
        <header class="header">
            <!-- Top Bar -->
            @include('layouts.frontpartial.topbar');

            <!-- Header Main -->
            @include('layouts.frontpartial.mainheader');

            <!-- Main Navigation -->
            @include('layouts.frontpartial.navbar');

            <!-- Menu -->
            @include('layouts.frontpartial.mobile_menu');
        </header>


        {{-- All Page Content --}}
        @yield('content')
        <!-- Footer -->
        @include('layouts.frontpartial.footer');
    </div>

    <script src="{{ asset('public/frontend') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('public/frontend') }}/styles/bootstrap4/popper.js"></script>
    <script src="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/TweenMax.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/TimelineMax.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/animation.gsap.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/easing/easing.js"></script>
    <script src="{{ asset('public/frontend') }}/js/custom.js"></script>
    <script src="{{ asset('public/frontend') }}/js/product_custom.js"></script>
    <!-- sweetalert msg start -->
    <script>
        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif
    </script>
    @stack('script')
</body>

</html>
