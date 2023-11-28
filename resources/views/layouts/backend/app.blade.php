@php
    $settings = App\Models\Settings::latest()->first();
@endphp
<!doctype html>
<html lang="en">
<head>
<title>{{ $pageTitle ?? '' }} , {{ config('site.title') }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ config('site.logo') }}" type="image/x-icon">

<link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
{{-- <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}"> --}}

<link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts-c3/plugin.css') }}"/>
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/chartist/css/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">


<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/css/color_skins.css') }}">
<!-- CUSTOM CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@yield('css')
</head>
<body class="theme-blush">

<!-- Page Loader -->
{{-- <div class="page-loader-wrapper">
    <div class="loader">
        <h4 class="text-white">Loading...</h4>
    </div>
</div> --}}
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">
    @guest
        @else
            @include('layouts.backend.navbar')
            @include('layouts.backend.sidebar')
    @endguest

    <div id="main-content">
        <div class="container-fluid">
            <div class="mb-5"></div>
            @yield('content')
        </div>
    </div>

</div>

<!-- Javascript -->
@yield('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Javascript -->
<script src="{{ asset('backend/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/vendorscripts.bundle.js') }}"></script>

<script src="{{ asset('backend/assets/js/c3.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/chartist.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/toastr/toastr.js') }}"></script>

<script src="{{ asset('backend/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
</body>
</html>
