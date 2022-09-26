<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!-- Custom libraries -->
    @yield('css-libraries')

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet">

    <!-- Custom styles -->
    @yield('style')
</head>

<body>
    <div id="app">
        @yield('template')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>

    <!-- Custom Js Libraries -->
    @yield('js-libraries')

    <script src="{{ asset('js/stisla.js')}}"></script>
    <script src="{{ asset('js/scripts.js')}}"></script>

    <!-- Custom Scripts -->
    @yield('script')
</body>

</html>
