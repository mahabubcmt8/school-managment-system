<!doctype html>
<html lang="en">
<head>
<title>:: HexaBit Dark :: Home</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="HexaBit Bootstrap 4x Admin Template">
<meta name="author" content="WrapTheme, www.thememakker.com">

<link rel="icon" href="favicon.ico" type="{{ asset('backend/assets/image/x-icon') }}">
@yield('css')
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/chartist/css/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/morrisjs/morris.css') }}" />

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/css/color_skins.css') }}">
<!-- CUSTOM CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body class="theme-cyan">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{ asset('backend/assets/images/icon-light.svg') }}" width="48" height="48" alt="HexaBit"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">

    @include('layouts.backend.partials.navbar')


    @include('layouts.backend.partials.left-sidebar')

    <div id="main-content">

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

</div>

<!-- Javascript -->
@yield('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('backend/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/vendorscripts.bundle.js')}}"></script>
<script src="{{ asset('backend/assets/bundles/chartist.bundle.js') }}"></script>
<script src="{{ asset('backend/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/morrisscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
</body>
</html>