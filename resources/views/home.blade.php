@extends('layouts.backend.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-3 bg-success text-light">
                <blockquote class="blockquote mb-0 border-white">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="fa fa-3x icon-users"></i>
                        </div>
                        <div class="number float-right text-right">
                            <h6>Teachers</h6>
                            <span class="font700"><i class="fa fa-refresh"></i>&nbsp; 500</span>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3 bg-danger text-light">
                <blockquote class="blockquote mb-0 border-white">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="fa fa-3x icon-users"></i>
                        </div>
                        <div class="number float-right text-right">
                            <h6>Student</h6>
                            <span class="font700"><i class="fa fa-refresh"></i>&nbsp; 500</span>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3 bg-info text-light">
                <blockquote class="blockquote mb-0 border-white">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="fa fa-3x icon-users"></i>
                        </div>
                        <div class="number float-right text-right">
                            <h6>Teachers</h6>
                            <span class="font700"><i class="fa fa-refresh"></i>&nbsp; 500</span>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
@endsection
