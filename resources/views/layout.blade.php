<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="public/images/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/slick.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/main-color.css') }}">

</head>
<body>
        <!-- include header -->
        @include('inc.header')
        <!-- end header -->

        <!-- Content -->
        @yield('content')
        <!-- end Content -->

        <!-- include footer -->
        @include('inc.footer')
        <!-- end footer -->

        <script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ url('js/bootstrap.min.js') }}"></script>
        <script src="{{ url('js/jquery.countdown.min.js') }}"></script>
        <script src="{{ url('js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ url('js/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ url('js/slick.min.js') }}"></script>
        <script src="{{ url('js/biolife.framework.js') }}"></script>
        <script src="{{ url('js/functions.js') }}"></script>
</body>
</html>