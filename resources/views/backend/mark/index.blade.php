@extends('layouts.backend.app')
@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12 ">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active">Mark</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('mark.store') }}" method="post">
            @csrf

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-success"><strong>Add New</strong></h5>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('markedit') }}" class="btn btn-success float-right"><strong>UPDATE MARKS</strong></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <!-- ==================== Exam ==================== -->
                    <div class="col-md-2">
                        <div class="input-group">
                            <select class="custom-select form-control" name="exam_id" id="exam_id">
                                <option class="bg-dark text-white" selected value="">Select Exams</option>
                                @foreach ($exams as $row)
                                    <option class="bg-dark text-white" value="{{ $row->id }}">{{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('exam_id')
                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                    <!-- ==================== Class ==================== -->
                    <div class="col-md-2">
                        <div class="input-group">
                            <select class="custom-select form-control" name="class_id" id="class_id"
                                onchange="getSection();">
                                <option class="bg-dark text-white" selected value="">Select Class</option>
                                @foreach ($classes as $row)
                                    <option class="bg-dark text-white" value="{{ $row->id }}">
                                        {{ $row->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('class_id')
                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                    <!-- ==================== Section ==================== -->
                    <div class="col-md-2">
                        <div class="input-group">
                            <select class="custom-select form-control" name="section_id" id="section_id">
                                <option class="bg-dark text-white" selected value="">Select Section</option>
                            </select>
                        </div>
                        @error('section_id')
                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                    <!-- ==================== Subject ==================== -->
                    <div class="col-md-2">
                        <div class="input-group">
                            <select class="custom-select form-control" name="subject_id" id="subject_id">
                                <option class="bg-dark text-white" selected value="">Select Subject</option>
                            </select>
                        </div>
                        @error('subject_id')
                            <small class="text-warning"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-round" id="getData" onclick="loadData();">Load Data</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card d-none" id="table-card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.N</th>
                                    <th>Student Name</th>
                                    <th>Username</th>
                                    <th>Roll No</th>
                                    <th>Mark</th>
                                </tr>
                            </thead>
                            <tbody class="tbody text-white">

                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save All</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        function loadData(){
            var class_id = $("#class_id").val();
            var section_id = $("#section_id").val();
            var exam_id = $("#exam_id").val();
            var subject_id = $("#subject_id").val();
            $.ajax({
                    url: "{{ url('/get/student/') }}"+"/"+class_id+"/"+section_id,
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $("#table-card").removeClass('d-none');
                        var html = '';
                        var i = 1;
                        $.each(data, function(key, value) {
                            html += '<tr>';
                            html += '<td><input type="hidden" name="student_id[]" value="'+value.id+'">'+(i++)+'</td>'
                            html += '<td>'+value.name+'</td>'
                            html += '<td>'+value.username+'</td>'
                            html += '<td>'+value.roll_no+'</td>'
                            html += '<td><input type="number" class="form-control" name="marks[]"></td>'
                            html += '</tr>';
                        });
                        $('.tbody').append(html);
                    }
                });
        }
    </script>
    <script>
        function getSection() {
            var class_id = $("#class_id").val();
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
        }
        getSection();
    </script>

@endsection

