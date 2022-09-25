@extends('layouts.backend.app')



@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active">Users Information</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="card profile-header">
                <div class="body text-center">
                    <blockquote class="blockquote mb-0">
                    <div class="user-account">
                        <div class="user_div">
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/images/users/' . $user->profile_picture) }}" class="user-photo"
                                alt="User Profile Picture" style="width: 140px;height:140px">
                            @else
                            <img src="{{ asset('backend/assets/images/user.png') }}" class="user-photo"
                            alt="User Profile Picture" style="width: 140px;height:140px">
                            @endif
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-3 text-success">{{ $user->name }}</h4>
                        <span>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </span>
                    </div>
                    <div class="mt-3 pb-4">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-dark btn-round">
                            <i class="fa fa-edit (alias)"></i> EDIT
                        </a>
                        <button onclick="history.back()" class="btn btn-dark btn-round">
                            <i class="fa fa-edit (alias)"></i> Back
                        </button>
                    </div>
                </blockquote>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="body">
                    <blockquote class="blockquote mb-0">
                    <div class="row profile_state text-info">
                        <div class="col-lg-4 col-md-6">
                            <i class="fa icon-user"></i><br>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Name</h5>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <i class="fa fa-envelope"></i><br>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Email</h5>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <i class="fa icon-call-in"></i>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Phone</h5>
                            <span>{{ $user->phone }}</span>
                        </div>
                    </div>

                    <div class="row profile_state text-info mt-5">
                        <div class="col-lg-4 col-md-6">
                            <i class="fa fa-crosshairs"></i>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Department</h5>
                            <span>{{ $user->department->name }}</span>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <i class="fa icon-calendar"></i>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Date Of Birth</h5>
                            <span>{{ date('d-m-Y', strtotime($user->dob)) }}</span>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <i class="fa icon-users"></i>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Gender</h5>
                            <span>{{ $user->gender }}</span>
                        </div>
                    </div>

                    <div class="row profile_state text-info mt-5">
                        <div class="col-lg-4 col-md-6">
                            <i class="fa fa-location-arrow"></i>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Address:</h5>
                            <span>{{ $user->address }}</span>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <i class="fa fa-file-text"></i>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Resume</h5>
                            <span><a href="{{ asset('storage/images/users/' . $user->resume) }}" target="_blank">Click here</a></span>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <i class="fa fa-file-text"></i>
                            <h5 class="m-b-0 number count-to" data-from="0" data-to="2365" data-speed="1000"
                                data-fresh-interval="700">Joining Letter</h5>
                            <span><a href="{{ asset('storage/images/users/' . $user->joining_letter) }}" target="_blank">Click here</a></span>
                        </div>
                    </div>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
@endsection
