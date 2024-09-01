<!-- resources/views/admin/layouts/services.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('template/assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('template/assets/images/favicon.png')}}" type="image/x-icon">
    <title> Admin Template</title>
    <!-- sweet alart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/animate.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('template/assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('template/assets/css/responsive.css')}}">
    <!--custom css for dashboard-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/customdashboard.css') }}">
</head>
<body>
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('admin.layouts.header')
    <div class="page-body-wrapper">
        @include('admin.layouts.sidebar')
        <div class="page-body">
            @yield('content')
        </div>
        @include('admin.layouts.footer')
    </div>
</div>
<!-- loader ends-->
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<!-- latest jquery-->
<script src="{{asset('template/assets/js/jquery.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('template/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('template/assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('template/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('template/assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('template/assets/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('template/assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{asset('template/assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('template/assets/js/sidebar-pin.js')}}"></script>
<script src="{{asset('template/assets/js/slick/slick.min.js')}}"></script>
<script src="{{asset('template/assets/js/slick/slick.js')}}"></script>
<script src="{{asset('template/assets/js/header-slick.js')}}"></script>
<script src="{{asset('template/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('template/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('template/assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('template/assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('template/assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('template/assets/js/dashboard/dashboard_2.js')}}"></script>
<script src="{{asset('template/assets/js/animation/wow/wow.min.js')}}"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('template/assets/js/script.js')}}"></script>
<script src="{{asset('template/assets/js/theme-customizer/customizer.js')}}"></script>

<!--sweet alart script-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>new WOW().init();</script>
<!--custom js to load icon-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
</body>
</html>
