@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Exam Schedule</li>
                    <li class="breadcrumb-item active">Add New</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-success"><strong>Exam Schedule</strong></h5>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('exam-schedule.index') }}"
                                class="btn btn-success btn-round float-right">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('exam-schedule.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <!-- ==================== Exam ==================== -->
                            <div class="col-md-6">
                                <label for="" class="text-info">Exam: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="exam_id">
                                        <option class="bg-dark text-white" selected value="">Choose...</option>
                                        @foreach ($exam as $item)
                                            <option class="bg-dark text-white" value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('exam_id')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <!-- ==================== Exam Date ==================== -->
                            <div class="col-md-6">
                                <label for="" class="text-info">Exam Date: <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control date" name="exam_date" id="exam_date"
                                        placeholder="dd/mm/yyyy" value="{{ old('exam_date') }}">
                                </div>
                                @error('exam_date')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- ==================== Class ==================== -->
                            <div class="col-md-6">
                                <label for="" class="text-info">Class: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="class_id" id="class_id">
                                        <option class="bg-dark text-white" selected value="">Choose...</option>
                                        @foreach ($class as $item)
                                            <option class="bg-dark text-white" value="{{ $item->id }}">
                                                {{ $item->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('class_id')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <!-- ==================== Section ==================== -->
                            <div class="col-md-6">
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
                        <div class="row mt-3">
                            <!-- ==================== Subject ==================== -->
                            <div class="col-md-6">
                                <label for="" class="text-info">Subject: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="subject_id" id="subject_id">
                                        <option class="bg-dark text-white" selected value="">Choose...</option>
                                    </select>
                                </div>
                                @error('subject_id')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <!-- ==================== Class Room ==================== -->
                            <div class="col-md-6">
                                <label for="" class="text-info">Class Room: <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="class_room_id">
                                        <option class="bg-dark text-white" selected value="">Choose...</option>
                                        @foreach ($class_room as $item)
                                            <option class="bg-dark text-white" value="{{ $item->id }}">
                                                {{ $item->room_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('class_room_id')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- ==================== Start Time ==================== -->
                            <div class="col-md-6">
                                <label for="" class="text-info">Start Time: <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="start_time" id="start_time"
                                        placeholder="10:30 AM" value="{{ old('start_time') }}">
                                </div>
                                @error('start_time')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <!-- ==================== End Time ==================== -->
                            <div class="col-md-6">
                                <label for="" class="text-info">End Time: <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control " name="end_time" id="end_time"
                                        placeholder="01:00 PM" value="{{ old('end_time') }}">
                                </div>
                                @error('end_time')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-round"><i class="fa fa-check"></i>
                                Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script><!-- Input Mask Plugin Js -->
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropfy.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script><!-- Input Mask Plugin Js -->
    <script>
        $('#exam_date').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
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
                // Get Subject >>>>>>>>>>>>>>
                $.ajax({
                    url: "{{ url('get/subject/') }}" + "/" + class_id,
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $("#subject_id").empty();
                        $.each(data, function(key, value) {
                            $("#subject_id").append(
                                '<option class="bg-dark text-white" value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
