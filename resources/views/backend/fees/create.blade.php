@extends('layouts.backend.app')
@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12 ">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active">Fees</li>
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
                        <h5 class="text-success"><strong>Add new</strong></h5>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('fees.index') }}"
                            class="btn btn-success btn-round float-right">All Fees</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('fees.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- ==================== Fees Type ==================== -->
                        <div class="col-md-6">
                            <label for="" class="text-info">Fees Type: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="fees_type_id">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                    @foreach ($fees_type as $row)
                                        <option class="bg-dark text-white" value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('fees_type_id')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                         <!-- ==================== Class ==================== -->
                         <div class="col-md-6">
                            <label for="" class="text-info">Class: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="class_id" id="class_id" onchange="getSection();">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                    @foreach ($Classes as $item)
                                        <option class="bg-dark text-white" value="{{ $item->id }}">
                                            {{ $item->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('class_id')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                    </div>
                    <div class="row mt-4">
                        <!-- ==================== Section ==================== -->
                        <div class="col-md-6">
                            <label for="" class="text-info">Section: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="section_id" id="section_id" onchange="getStudent();">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                </select>
                            </div>
                            @error('section_id')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="text-info">Student: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="student_id" id="student_id">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                </select>
                            </div>
                            @error('student_id')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <!-- ==================== Due Date ==================== -->
                        <div class="col-md-6">
                            <label for="" class="text-info">Due Date: <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control date" name="due_date" id="due_date"
                                    placeholder="dd/mm/yyyy" value="{{ old('due_date') }}">
                            </div>
                            @error('due_date')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <!-- ==================== Amount ==================== -->
                        <div class="col-md-6">
                            <label for="" class="text-info">Amount: <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-money"></i></span>
                                </div>
                                <input type="text" class="form-control" name="amount" id="amount"
                                    placeholder="500" value="{{ old('amount') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            @error('amount')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="" class="text-info">Status: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                </div>
                                <select class="custom-select form-control" name="status" id="status">
                                    <option class="bg-dark text-white" value="1">Paid</option>
                                    <option class="bg-dark text-white" value="0">Unpaid</option>
                                </select>
                            </div>
                            @error('status')
                                <small class="text-warning"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="text-info">Description:</label>
                            <textarea class="form-control" aria-label="With textarea" placeholder="Description..." name="note"></textarea>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-round"><i class="fa fa-check"></i>
                            Save</button>
                    </div>
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
        $('#due_date').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
        });

        // Get Section >>>>>>>>>>>>>>
        function getSection(){
            var class_id = $("#class_id").val();
            if (class_id) {
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
        }
        // Get Student >>>>>>>>>>>>>>
        function getStudent(){
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            $.ajax({
                    url: "{{ url('get/student/') }}" + "/" + class_id + "/" + section_id,
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $("#student_id").empty();
                        $.each(data, function(key, value) {
                            $("#student_id").append(
                                '<option class="bg-dark text-white" value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            }
        getStudent();
        getSection();
    </script>
@endsection

