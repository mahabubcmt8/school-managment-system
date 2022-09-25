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
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active">New User</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success float-left"><i class="fa icon-user-follow"></i> New User</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-round float-right text-white">
                             All Users
                        </a>
                    </div>
                    <div class="card-body py-5">
                        @if (count($errors) > 0)
                            <p class="mb-5 text-danger text-center"><strong>Whoops! </strong> Something went wrong, Please Try Again.</p>
                        @endif
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-4">
                                <!-- ==================== Name ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Name: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Name..." name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Role ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Role: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text"><i class="fa icon-energy"></i></label>
                                        </div>
                                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                                    </div>
                                    @error('roles')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Department ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Department: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                        </div>
                                        <select class="custom-select form-control" name="department_id">
                                            <option class="bg-dark text-white" selected value="">Choose...</option>
                                            @foreach ($department as $item)
                                                <option class="bg-dark text-white" value="{{ $item->id }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department_id')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>
                            <!-- ==================== Email ==================== -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="" class="text-info">Email Address: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa icon-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email Address..."
                                            name="email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Phone ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Phone: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa icon-call-out"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Phone..." name="phone"
                                            value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Date Of Birth ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Date Of Birth: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control date" name="dob" id="dob"
                                            placeholder="dd/mm/yyyy" value="{{ old('dob') }}">
                                    </div>
                                    @error('dob')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <!-- ==================== Password ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Password: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-circle-o"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="**********"
                                            name="password">
                                    </div>
                                    @error('password')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Confirm Password ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Confirm Password: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-circle-o"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="**********"
                                            name="confirm-password">
                                    </div>
                                    @error('confirm-password')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Gender ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info">Gender: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                        </div>
                                        <select class="custom-select form-control" name="gender">
                                            <option class="bg-dark text-white" selected value="">Choose...</option>
                                            <option class="bg-dark text-white" value="Male">Male</option>
                                            <option class="bg-dark text-white" value="Female">Female</option>
                                            <option class="bg-dark text-white" value="Others">Others</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-4">
                                <!-- ==================== Address ==================== -->
                                <div class="col-md-6">
                                    <label for="" class="text-info">Address: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                        </div>
                                        <textarea class="form-control" name="address" aria-label="With textarea" placeholder="Address..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- ==================== Profile Picture ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info my-3">Profile Picture <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="dropify" data-height="130" name="profile_picture" />

                                    @error('profile_picture')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Resume ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info my-3">Resume</label>
                                    <input type="file" class="dropify" data-height="130" name="resume" />

                                    @error('resume')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <!-- ==================== Joining Letter ==================== -->
                                <div class="col-md-4">
                                    <label for="" class="text-info my-3">Joining Letter</label>
                                    <input type="file" class="dropify" data-height="130" name="joining_letter" />

                                    @error('joining_letter')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-success btn-xl btn-round">
                                    <i class="fa fa-save (alias)"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropfy.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script><!-- Input Mask Plugin Js -->
    <script>
        $('#dob').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
        });
        $('.dropify').dropify({
            tpl: {
                message: '<div class="dropify-message"><h4 class="text-info"><i class="fa icon-cloud-upload"></i></h4><h6 class="text-info">Drag and drop a file here or click</h6></div>',
            }
        });
    </script>
@endsection
