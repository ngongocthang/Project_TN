<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Favicons -->
    <link href="{{ url( 'admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url( 'admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url( 'admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url( 'admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url( 'admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url( 'admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url( 'admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url( 'admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url( 'admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url( 'admin/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    @endphp

    @include('admin.inc.header')
    @include('admin.inc.sidebar')


    @yield('content')

    @include('admin.inc.footer')

    <script>
        function confirmation(ev, form) {
            ev.preventDefault();

            swal({
                    title: "Are You Sure to Delete This",
                    text: "This delete will be permanent",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit(); // Gửi form nếu người dùng xác nhận
                    }
                });
        }
    </script>

    <!-- cdnjs alert file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Vendor JS Files -->
    <script src="{{ url( 'admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url( 'admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url( 'admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url( 'admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ url( 'admin/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ url( 'admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url( 'admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url( 'admin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url( 'admin/assets/js/main.js') }}"></script>
</body>

</html>