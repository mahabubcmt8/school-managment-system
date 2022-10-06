@extends('layouts.backend.app')
@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12 ">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active">Exam Schedule</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-success"><strong>Exam Schedule</strong></h5>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('exam-schedule.create') }}"
                                class="btn btn-success btn-round float-right">Add New</a>
                        </div>
                    </div>
                </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                            </div>
                            <select class="custom-select form-control" name="exam_id" id="exam_id">
                                <option class="bg-dark text-white" selected value="">Select Exam</option>
                                @foreach ($exam as $item)
                                    <option class="bg-dark text-white" value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                            </div>
                            <select class="custom-select form-control" name="class_id" id="section_id">
                                <option class="bg-dark text-white" selected value="">Select Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-round btn-block" id="getBtn">Get Exam</button>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="data_details text-info mb-2"></div>
                        <table class="table table-bordered table-striped text-white text-center">
                            <thead class="thead-dark">
                                <th>SL</th>
                                <th>Exam</th>
                                <th>Room</th>
                                <th>Subject</th>
                                <th>Exam Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        // Get Section >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $("#class_id").on('change', function() {
            var class_id = $(this).val();
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
        });
        // Get All exam data >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $("#getBtn").on('click', function(){
            let exam_id = $("#exam_id").val();
            let class_id = $("#class_id").val();
            let section_id = $("#section_id").val();

            $.ajax({
                    url: "{{ url('get/exams/') }}"+"/"+exam_id+"/"+class_id+'/'+section_id,
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        $('#exam_id option:first').prop('selected',true);
                        $('#class_id option:first').prop('selected',true);
                        $("#section_id").append('<option class="bg-dark text-white" selected value="">Select Section</option>');
                        var html = '';
                        var i = 1;

                        if (data.length > 0) {
                            $('.data_details').append(
                            `<span>Exam: `+data[0].exam.name+`</span><br>
                            <span>Class: `+data[0].class.class_name+`</span><br>
                            <span>Section: `+data[0].section.name+`</span><br>`);
                            $.each(data, function(key, value) {

                                var url = "{{ route('exam-schedule.edit', ":id") }}";
                                url = url.replace(':id', value.id);

                                var delUrl = "{{ route('exam-schedule.destroy', ":id") }}";
                                delUrl = delUrl.replace(':id', value.id);

                                html +=
                                `<tr>
                                    <td>`+(i++)+`</td>
                                    <td>`+value.exam.name+`</td>
                                    <td>`+value.class_room.room_no+`</td>
                                    <td>`+value.subject.name+`</td>
                                    <td>`+value.exam_date+`</td>
                                    <td>`+value.start_time+` - `+value.end_time+`</td>
                                    <td>
                                        <a href=`+url+` class="btn btn-primary">
                                            <i class="fa fa-edit (alias)"></i>
                                        </a>

                                        <form action="`+delUrl+`" method="POST"
                                                id="delForm" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <span class="sr-only">Delete</span><i class="fa fa-trash-o"></i>
                                                </button>
                                        </form>
                                    </td>
                                    </tr>`;
                                });
                        } else {
                            html += '<td colspan="7"><p class="p-3 text-warning">No Data Available !!</p></td>';
                        }

                        $("#tbody").append(html);
                    }
                });
        });
    </script>
@endsection
