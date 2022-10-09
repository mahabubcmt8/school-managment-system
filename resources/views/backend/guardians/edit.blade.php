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
                    <li class="breadcrumb-item active">Guardians</li>
                    <li class="breadcrumb-item active">New Guardians</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-success"><strong>Edit Guardians Info</strong></h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('guardians.update',$guardian->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mt-4">
                        <!-- ==================== Student ==================== -->
                        <div class="col-md-12">
                            <label for="" class="text-info">Student: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="student_id">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                    @foreach ($student as $row)
                                        <option class="bg-dark text-white" value="{{ $row->id }}"
                                            {{ $guardian->student_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('student_id')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="" class="text-info">Father's Name: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Father's Name..." name="fathers_name"
                                        value="{{ $guardian->fathers_name }}">
                                </div>
                                @error('fathers_name')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text-info">Mother's Name: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-user-female"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Mother's Name..." name="mothers_name"
                                        value="{{ $guardian->mothers_name }}">
                                </div>
                                @error('mothers_name')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="" class="text-info">Father's Phone: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-call-in"></i></span>
                                </div>
                                <input type="number" class="form-control" placeholder="Father's Phone..." name="fathers_phone"
                                    value="{{ old('fathers_phone') }}">
                            </div>
                            @error('fathers_phone')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="text-info">Mother's Phone: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-call-in"></i></span>
                                </div>
                                <input type="number" class="form-control" placeholder="Mother's Phone..." name="mothers_phone"
                                    value="{{ $guardian->mothers_phone }}">
                            </div>
                            @error('mothers_phone')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="" class="text-info">Father's Email: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Father's Email..." name="fathers_email"
                                    value="{{ $guardian->fathers_email }}">
                            </div>
                            @error('fathers_email')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="text-info">Mother's Email: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Mother's Email..." name="mothers_email"
                                    value="{{ $guardian->mothers_email }}">
                            </div>
                            @error('mothers_email')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="" class="text-info ">Father's Picture <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="dropify" data-height="105" name="fathers_photo" />

                            @error('fathers_photo')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="text-info ">Mother's Picture <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="dropify" data-height="105" name="mothers_photo" />

                            @error('mothers_photo')
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
    <script>
        $('.dropify').dropify({
            tpl: {
                message: '<div class="dropify-message"><h4 class="text-info"><i class="fa icon-cloud-upload"></i></h4><h6 class="text-info">Drag and drop a file here or click</h6></div>',
            }
        });
    </script>
@endsection
