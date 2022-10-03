@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Class routine</li>
                    <li class="breadcrumb-item active">Add New</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('class-routine.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-success float-left"><strong>Class Routine</strong></h5>
                            </div>
                            <div class="col-lg-6 align-right">
                                <a href="{{ route('class-routine.index') }}" class="btn btn-success btn-round">
                                    <i class="fa fa-plus"></i> Routine</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="" class="text-info">Class: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="class_id" id="class_id">
                                        <option class="bg-dark text-white" selected="" value="">Choose...</option>
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
                            <div class="col-md-4">
                                <label for="" class="text-info">Section: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="section_id" id="section_id">
                                        <option class="bg-dark text-white" selected="" value="">Choose...</option>
                                    </select>
                                </div>
                                @error('section_id')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="" class="text-info">Day: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fa fa-crosshairs"></i></label>
                                    </div>
                                    <select class="custom-select form-control" name="day" id="day">
                                        <option class="bg-dark text-white" selected="" value="">Choose...
                                        </option>
                                        <option class="bg-dark text-white" value="Sunday">Sunday</option>
                                        <option class="bg-dark text-white" value="Monday">Monday</option>
                                        <option class="bg-dark text-white" value="Tuesday">Tuesday</option>
                                        <option class="bg-dark text-white" value="Wednesday">Wednesday</option>
                                        <option class="bg-dark text-white" value="Thursday">Thursday</option>
                                        <option class="bg-dark text-white" value="Friday">Friday</option>
                                        <option class="bg-dark text-white" value="Saturday">Saturday</option>
                                    </select>
                                </div>
                                @error('day')
                                    <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-round float-right text-white my-3" onclick="myFunction()">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <div class="table-responsive">
                                    <table class="table m-b-0 table-bordered" id="myTable">
                                        <thead class="thead-dark text-center">
                                            <tr>
                                                <th>Subject</th>
                                                <th>Class Room</th>
                                                <th>Teacher</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-white text-center tbody" id="tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-success btn-xl btn-round">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script><!-- Input Mask Plugin Js -->
    <script>
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
        <script>
            function myFunction() {
                var table = document.getElementById("tbody");
                var row = table.insertRow(0);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                cell1.innerHTML = `<select class="custom-select form-control" id="subject_id" name="subject_id[]">
                            @foreach($subject as $item)
                                <option class="bg-dark text-white" value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                             </select>`;
                cell2.innerHTML = `<select class="custom-select form-control" id="class_room_id" name="class_room_id[]">
                                 @foreach ($class_room as $item)
                                     <option class="bg-dark text-white" value="{{ $item->id }}">{{ $item->room_no }}</option>
                                 @endforeach
                             </select>`;
                cell3.innerHTML = `<select class="custom-select form-control" id="teacher_id" name="teacher_id[]">
                                 @foreach ($user as $item)
                                     @if (!empty($item->getRoleNames()))
                                         @foreach ($item->getRoleNames() as $v)
                                             <option class="bg-dark text-white" value="{{ $item->id }}">
                                                 {{ $item->name . ' (' . $v . ') ' }}</option>
                                         @endforeach
                                     @endif
                                 @endforeach
                             </select>`;
                cell4.innerHTML = `<input type="time" class="form-control time12" placeholder="10:30 pm" id="start_time" name="start_time[]">`;
                cell5.innerHTML = `<input type="time" class="form-control time12" placeholder="11:30 pm" id="end_time" name="end_time[]">`;
                cell6.innerHTML = `<button class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-close"></i></button>`;
                }
                function deleteRow(r) {
                    var i = r.parentNode.parentNode.rowIndex;
                    document.getElementById("myTable").deleteRow(i);
                }
        </script>
@endsection
