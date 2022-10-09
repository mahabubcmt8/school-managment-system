@extends('layouts.backend.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Guardians</li>
                    <li class="breadcrumb-item active">Guardians Information</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="history.back()" class="btn btn-dark btn-round float-right">
                        <i class="fa fa-edit (alias)"></i> Back
                    </button>
                </div>
                <div class="card-body mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="user-account">
                                <h2>Student</h2>
                                <div class="user_div">
                                    @if ($guardian->student->picture)
                                        <img src="{{ asset('storage/images/students/' . $guardian->student->picture) }}" class="user-photo"
                                        alt="User Profile Picture" style="width: 140px;height:140px">
                                    @else
                                    <img src="{{ asset('backend/assets/images/user.png') }}" class="user-photo"
                                    alt="User Profile Picture" style="width: 140px;height:140px">
                                    @endif
                                </div>
                            </div>
                            <h4 class="mb-3 text-success text-center"><strong><a href="{{ route('students.show',$guardian->student->id) }}">{{ $guardian->student->name }}</a></strong></h4>
                            <div class="info text-center">
                                Class: {{ $guardian->student->classes->class_name }}<br>
                                Section: {{ $guardian->student->section->name }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="user-account">
                                <h2>Father</h2>
                                <div class="user_div">
                                    @if ($guardian->fathers_photo)
                                        <img src="{{ asset('storage/images/guardians/' . $guardian->fathers_photo) }}" class="user-photo"
                                        alt="User Profile Picture" style="width: 140px;height:140px">
                                    @else
                                    <img src="{{ asset('backend/assets/images/user.png') }}" class="user-photo"
                                    alt="User Profile Picture" style="width: 140px;height:140px">
                                    @endif
                                </div>
                            </div>
                            <h4 class="mb-3 text-success text-center"><strong>{{ $guardian->fathers_name }}</strong></h4>
                            <div class="info text-center">
                                Email: {{ $guardian->fathers_email }}<br>
                                Phone: {{ $guardian->fathers_phone }}
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="user-account">
                                <h2>Mother</h2>
                                <div class="user_div">
                                    @if ($guardian->mothers_photo)
                                        <img src="{{ asset('storage/images/guardians/' . $guardian->mothers_photo) }}" class="user-photo"
                                        alt="User Profile Picture" style="width: 140px;height:140px">
                                    @else
                                    <img src="{{ asset('backend/assets/images/user.png') }}" class="user-photo"
                                    alt="User Profile Picture" style="width: 140px;height:140px">
                                    @endif
                                </div>
                            </div>
                            <h4 class="mb-3 text-success text-center"><strong>{{ $guardian->mothers_name }}</strong></h4>
                            <div class="info text-center">
                                Email: {{ $guardian->mothers_email }}<br>
                                Phone: {{ $guardian->mothers_phone }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
