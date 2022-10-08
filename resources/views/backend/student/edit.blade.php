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
                    <li class="breadcrumb-item active">Create New</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left">
                        <strong><i class="icon-user-follow"></i> New Student</strong>
                    </h5>
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-round float-right text-white">
                         All Students
                    </a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ route('students.update',$student->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- ==================== Name ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Name: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Name..." name="name"
                                    value="{{ $student->name }}">
                            </div>
                            @error('name')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <!-- ==================== Class ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Class: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="class_id" id="class_id">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                    @foreach ($Classes as $item)
                                        <option class="bg-dark text-white" value="{{ $item->id }}" {{ $student->class_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('class_id')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <!-- ==================== Section ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Section: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="section_id" id="section_id">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                </select>
                            </div>
                            @error('section_id')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <!-- ==================== Username ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Username: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-align-center"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username..." name="username"
                                    value="{{ $student->username }}">
                            </div>
                            @error('username')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <!-- ==================== Email ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Email: (Optional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email..." name="email"
                                    value="{{ $student->email }}">
                            </div>
                            @error('email')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <!-- ==================== Phone ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Phone: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-call-in"></i></span>
                                </div>
                                <input type="number" class="form-control" placeholder="Phone No..." name="phone"
                                    value="{{ $student->phone }}">
                            </div>
                            @error('phone')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <!-- ==================== Roll ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Roll No: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-energy"></i></span>
                                </div>
                                <input type="number" class="form-control" placeholder="Roll No..." name="roll_no"
                                    value="{{ $student->roll_no }}">
                            </div>
                            @error('roll_no')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <!-- ==================== Registration ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Registration No: (Optional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-energy"></i></span>
                                </div>
                                <input type="number" class="form-control" placeholder="Registration No..."
                                    name="registration_no" value="{{ $student->registration_no }}">
                            </div>
                            @error('registration_no')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <!-- ==================== Date of Birth ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Date Of Birth: <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Date of Birth..." name="dob"
                                    value="{{ date('d-m-Y', strtotime($student->dob)) }}" id="dob">
                            </div>
                            @error('dob')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <!-- ==================== Password ==================== -->
                        <div class="col-md-4">
                            <label for="" class="text-info">Password: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-circle-o"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="**********" name="password">
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
                            <label for="" class="text-info">Gender: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="gender">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                    <option class="bg-dark text-white" value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option class="bg-dark text-white" value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option class="bg-dark text-white" value="Others" {{ $student->gender == 'Others' ? 'selected' : '' }}>Others</option>
                                </select>
                            </div>
                            @error('gender')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                    </div>
                    <div class="row mt-4">
                        <!-- ==================== Address ==================== -->
                        <div class="col-md-6">
                            <label for="" class="text-info">Address: (Optional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                </div>
                                <textarea class="form-control" rows="5" name="address" aria-label="With textarea" placeholder="Student Address...">{{ $student->address }}</textarea>
                            </div>
                        </div>
                        <!-- ==================== Picture ==================== -->
                        <div class="col-md-6">
                            <label for="" class="text-info ">Picture <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="dropify" data-height="105" name="picture" />

                            @error('picture')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-success btn-xl btn-round">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </form>
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
        $("#class_id").on('change', function() {
            var class_id = $(this).val();
            if (class_id) {
                // Get Section >>>>>>>>>>>>>>
                $.ajax({
                    url: "{{ url('get/section/') }}" + "/" + class_id,
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $("#section_id").empty();
                        $.each(data, function(key, value) {
                            $("#section_id").append(
                                '<option class="bg-dark text-white" value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
