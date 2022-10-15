@extends('layouts.backend.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endsection
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Attendence</li>
                    <li class="breadcrumb-item active">Student Attendence</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-success"><strong>Student Attendence</strong></h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('student-attendence.store') }}" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="date" id="date">
                                </div>
                                @error('date')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <!-- ==================== Class ==================== -->
                            <div class="col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="class_id" id="class_id">
                                        <option class="bg-dark text-white" selected value="">Select Class</option>
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
                            <div class="col-md-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="section_id" id="section_id">
                                        <option class="bg-dark text-white" selected value="">Select Section</option>
                                    </select>
                                </div>
                                @error('section_id')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-round btn-block" onclick="loadData();">Get Student</button>
                            </div>
                        </div>
                        <div class="row datalist mt-5">
                        </div>
                        <button type="submit" class="btn btn-success btn-round d-none mt-4" id="saveBtn">Save All</button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function loadData(){
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            $.ajax({
                    url: "{{ url('/get/student/') }}"+"/"+class_id+"/"+section_id,
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $("#saveBtn").removeClass('d-none');
                        var html = '';
                        var i = 1;
                        $.each(data, function(key, value) {
                            html += '<div class="col-md-2">'
                            html += '<div class="fancy-checkbox">'
                            html += '<input type="hidden" name="student_id[]" value="'+value.id+'">'
                            html += '<label><input type="checkbox" name="attendence[]" value="1" checked>'
                            html += '<span>'+value.name+ " ("+ value.roll_no+ ") " +'</span>'
                            html += '</label>'
                            html += '</div>'
                            html += '</div>'
                        });
                        $('.datalist').append(html);
                    }
                });
        }
    </script>
    <script>
        flatpickr("#date", {
            enableTime: false,
            dateFormat: "d-m-Y",
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
