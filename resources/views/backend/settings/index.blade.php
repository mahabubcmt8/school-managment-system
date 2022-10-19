@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h2 class="text-success"><strong>System Settings</strong></h2>
                </div>
                <div class="body">
                    <ul class="nav nav-tabs-new2">
                        <li class="nav-item"><a class="text-success nav-link show active" data-toggle="tab" href="#Home-new2"><strong>Basic</strong></a>
                        </li>
                        <li class="nav-item"><a class="text-success nav-link" data-toggle="tab" href="#Profile-new2"><strong>Logo & Icon</strong></a></li>
                        <li class="nav-item"><a class="text-success nav-link" data-toggle="tab" href="#social"><strong>Social</strong></a></li>
                        <li class="nav-item"><a class="text-success nav-link" data-toggle="tab" href="#theme"><strong>Theme</strong></a></li>
                        <li class="nav-item"><a class="text-success nav-link" data-toggle="tab" href="#system"><strong>System</strong></a></li>
                    </ul>
                    <div class="tab-content">
                        @include('backend.settings.basic')
                        @include('backend.settings.logo')
                        @include('backend.settings.social')
                        @include('backend.settings.theme')
                        @include('backend.settings.system')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@include('backend.includes.script')
    <script>
        $(document).ready(function () {
            $.getJSON("{{ asset('backend/assets/js/country.json') }}",
                function (data) {
                var html = '';
                $.each(data, function (key, value) {
                    html += '<option class="bg-dark text-white" value="'+value.code+'">'+value.name+'</option>'
                });
                $("#timezone").append(html);
            });
        });
    </script>
@endsection
