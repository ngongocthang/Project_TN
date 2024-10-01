<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="{{ url('admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url('admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url('admin/assets/css/style.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ url('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('admin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('admin/assets/js/main.js') }}"></script>
</body>
</html>