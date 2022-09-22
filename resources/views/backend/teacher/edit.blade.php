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
                    <li class="breadcrumb-item active">Teacher</li>
                    <li class="breadcrumb-item active">Create Teacher</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success float-left"><strong>Update teacher Info</strong></h5>
                        <a href="{{ route('teacher.index') }}" class="btn btn-success btn-round float-right text-white">
                            <i class="fa fa-plus"></i> All Teacher
                        </a>
                    </div>
                    <div class="card-body mt-5">
                        <form action="{{ route('teacher.update', $teacher->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="" class="text-info">Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-crosshairs"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            value="{{ $teacher->name ?: '' }}">
                                    </div>
                                    @error('name')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text-info">Department <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                        </div>
                                        <select class="custom-select form-control" name="department_id">
                                            <option class="bg-dark text-white" selected value="">Choose...</option>
                                            @foreach ($dept as $item)
                                                <option class="bg-dark text-white" value="{{ $item->id }}"
                                                    {{ $teacher->department_id == $teacher->department_id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department_id')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="" class="text-info">Email Address <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-crosshairs"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email Address"
                                            name="email" value="{{ $teacher->email }}">
                                    </div>
                                    @error('email')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text-info">Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-crosshairs"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Phone" name="phone"
                                            value="{{ $teacher->phone }}">
                                    </div>
                                    @error('phone')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="" class="text-info">Date Of Birth <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control date" name="dob" id="dob"
                                            placeholder="dd/mm/yyyy"
                                            value="{{ date('d-m-Y', strtotime($teacher->dob)) }}">
                                    </div>
                                    @error('dob')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text-info">Gender <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01"><i
                                                    class="fa fa-crosshairs"></i></label>
                                        </div>
                                        <select class="custom-select form-control" name="gender">
                                            <option class="bg-dark text-white" selected value="">Choose...</option>
                                            <option class="bg-dark text-white" value="Male"
                                                {{ $teacher->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option class="bg-dark text-white" value="Female"
                                                {{ $teacher->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option class="bg-dark text-white" value="Others"
                                                {{ $teacher->gender == 'Others' ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="text-info my-3">Profile Picture <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="dropify" data-height="130" name="profile_picture"
                                        value="{{ $teacher->profile_picture }}" /> <br>
                                    <img src="{{ asset('storage/images/teacher/' . $teacher->profile_picture) }}"
                                        height="auto" width="50px" alt="Profile Picture">

                                    @error('profile_picture')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="" class="text-info my-3">Resume</label>
                                    <input type="file" class="dropify" data-height="130" name="resume"
                                        value="{{ $teacher->resume }}" /><br>
                                    <a href="{{ asset('storage/document/teacher/' . $teacher->resume) }}"
                                        class="text-info" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>&nbsp; View Resume
                                    </a><br>

                                    @error('resume')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="text-info my-3">Joining Letter</label>
                                    <input type="file" class="dropify" data-height="130" name="joining_letter"
                                        value="{{ $teacher->joining_letter }}" /><br>
                                    <a href="{{ asset('storage/document/teacher/' . $teacher->joining_letter) }}"
                                        class="text-info" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>&nbsp; View Joining Letter
                                    </a>

                                    @error('joining_letter')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center my-5">
                                <button type="submit" class="btn btn-primary btn-xl btn-round"><i
                                        class="fa fa-save (alias)"></i> Update</button>
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
