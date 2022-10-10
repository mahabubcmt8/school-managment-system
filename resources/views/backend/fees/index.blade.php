@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Fees</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <!-- ==================== Fees Type ==================== -->
                        <div class="col-md-2">
                            <div class="input-group">
                                <select class="custom-select form-control" name="fees_type_id" id="fees_type_id">
                                    <option class="bg-dark text-white" selected value="">Select FeesType</option>
                                    @foreach ($fees_type as $row)
                                        <option class="bg-dark text-white" value="{{ $row->id }}">{{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- ==================== Class ==================== -->
                        <div class="col-md-2">
                            <div class="input-group">
                                <select class="custom-select form-control" name="class_id" id="class_id"
                                    onchange="getSection();">
                                    <option class="bg-dark text-white" selected value="">Select Class</option>
                                    @foreach ($Classes as $row)
                                        <option class="bg-dark text-white" value="{{ $row->id }}">
                                            {{ $row->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- ==================== Section ==================== -->
                        <div class="col-md-2">
                            <div class="input-group">
                                <select class="custom-select form-control" name="section_id" id="section_id">
                                    <option class="bg-dark text-white" selected value="">Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <select class="custom-select form-control" name="status" id="status">
                                    <option class="bg-dark text-white" value="1">Select Status</option>
                                    <option class="bg-dark text-white" value="1">Paid</option>
                                    <option class="bg-dark text-white" value="0">Unpaid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-round" id="getData" onclick="getData();">Get Data</button>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4 ">
                        <div class="col-md-3">
                            <div class="details">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="data_details text-info mb-2"></div>
                            <table class="table table-bordered table-striped text-white text-center">
                                <thead class="thead-dark">
                                    <th>SL</th>
                                    <th>Student</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Note</th>
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
        // $("#getData").on('click',function(){

        // });
        getData();
        function getData(){
            var fees_type = $("#fees_type_id").val();
            var classes = $("#class_id").val();
            var section = $("#section_id").val();
            var status = $("#status").val();

            $.ajax({
                    url: "{{ url('get/fees/') }}"+'/'+fees_type+'/'+classes+'/'+section+'/'+status,
                    type: "GET",
                    datatype: "json",
                    success: function(data) {
                        html = '';
                        var i = 1;
                        if (data.length > 0) {
                            if(data[0].status == 1){
                                var status = "PAID";
                            }else{
                                var status = "UNPAID";
                            }

                            $('.details').append(`
                            <div class="card bg-dark text-white">
                                <div class="card-body">
                                    <ul style="list-style: none">
                                        <li>Fees Type: `+data[0].get_fees_type.name+`</li>
                                        <li>Class: `+data[0].classes.class_name+`</li>
                                        <li>Section: `+data[0].section.name+`</li>
                                        <li>Status: `+status+`</li>
                                    </ul>
                                </div>
                            </div>`);
                            $.each(data, function(key, value) {
                                var url = "{{ route('fees.destroy', ":id") }}";
                                url = url.replace(':id', value.id);

                                html += '<tr>';
                                html += '<td>'+(i++)+'</td>';
                                html += '<td>'+value.student.name+'</td>';
                                html += '<td>'+value.amount+'</td>';
                                html += '<td>'+value.due_date+'</td>';
                                html += '<td>'+value.note+'</td>';
                                html += '<td>'
                                html += `<form action="`+url+`" method="POST"
                                                id="delForm" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure delete?');">
                                                    <span class="sr-only">Delete</span><i class="fa fa-trash-o"></i>
                                                </button>
                                        </form>`;
                                html += '</tr>';
                            });
                        } else {
                            html += '<tr><td colspan="7"><p class="p-3 text-warning">No Data Available !!</p></td></tr>';
                        }

                        $("#tbody").append(html);
                    }
                });
        }

        // Get Section >>>>>>>>>>>>>>
        function getSection() {
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
        getSection();
    </script>

@endsection
