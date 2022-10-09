@extends('layouts.backend.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropfy.css') }}">
@endsection
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Student</li>
                    <li class="breadcrumb-item active">Student Information</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <blockquote class="blockquote mb-0">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="user-account">
                                <div class="user_div">
                                    @if ($student->picture)
                                        <img src="{{ asset('storage/images/students/' . $student->picture) }}" class="user-photo"
                                        alt="User Profile Picture" style="width: 140px;height:140px">
                                    @else
                                    <img src="{{ asset('backend/assets/images/user.png') }}" class="user-photo"
                                    alt="User Profile Picture" style="width: 140px;height:140px">
                                    @endif
                                </div>
                            </div>
                            <h4 class="mb-3 text-success text-center"><strong>{{ $student->name }}</strong></h4>
                            <div class="mt-3 pb-4 text-center">
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-dark btn-round">
                                    <i class="fa fa-edit (alias)"></i> EDIT
                                </a>
                                <button onclick="history.back()" class="btn btn-dark btn-round">
                                    <i class="fa fa-edit (alias)"></i> Back
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="text-info list-group">
                                <li class="list-group-item"><i class="icon-graduation"></i> Full Name: {{ $student->name }}</li>
                                <li class="list-group-item"><i class="icon-user"></i> Fathers Name:
                                    <a href="{{ route('guardians.show',$student->guardian->id) }}">
                                        {{ $student->guardian->fathers_name }}
                                    </a>
                                </li>
                                <li class="list-group-item"><i class="icon-user-female"></i> Mothers Name:
                                    <a href="{{ route('guardians.show',$student->guardian->id) }}">
                                        {{ $student->guardian->mothers_name }}
                                    </a>
                                </li>
                                <li class="list-group-item"><i class="icon-energy"></i> Roll No: {{ $student->roll_no }}</li>
                                <li class="list-group-item"><i class="icon-energy"></i> Registration No: {{ $student->registration_no }}</li>
                                <li class="list-group-item"><i class="fa fa-align-center"></i> Username: {{ $student->username }}</li>
                                <li class="list-group-item"><i class="icon-calendar"></i> Date Of Birth: {{ date('d-m-Y', strtotime($student->dob)) }}</li>
                            </ul>
                            </div>
                        <div class="col-md-5">
                            <ul class="text-info list-group">
                                <li class="list-group-item"><i class="icon-envelope"></i> Email Address: {{ $student->email }}</li>
                                <li class="list-group-item"><i class="icon-call-in"></i> Phone No: {{ $student->email }}</li>
                                <li class="list-group-item"><i class="fa fa-crosshairs"></i> Class: {{ $student->classes->class_name }}</li>
                                <li class="list-group-item"><i class="fa fa-crosshairs"></i> Section: {{ $student->section->name }}</li>
                                <li class="list-group-item"><i class="fa fa-crosshairs"></i> Gender: {{ $student->gender }}</li>
                                <li class="list-group-item"><i class="fa fa-location-arrow"></i> Address: {{ $student->address }}</li>
                                <li class="list-group-item"><i class="icon-badge"></i> Attendence: </li>
                            </ul>
                            </ul>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
    </div>
@endsection
