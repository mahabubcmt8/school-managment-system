@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Exam List</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left"><strong>Exam</strong></h5>
                    <button class="btn btn-success btn-round float-right text-white" data-toggle="modal"
                        data-target="#modal">
                        <i class="fa fa-plus"></i> Create New
                    </button>
                </div>
                <div class="card-body pt-5">
                    <table id="example" class="table table-bordered display text-white text-muted table-striped dataTable" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-info">Name</th>
                                <th class="text-info">Start Date</th>
                                <th class="text-info">End Date</th>
                                <th class="text-info">Note</th>
                                <th class="text-info">Status</th>
                                <th class="text-info">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">

                        </tbody>
                        <tfoot class="thead-dark">
                            <tr>
                                <th class="text-info">Name</th>
                                <th class="text-info">Start Date</th>
                                <th class="text-info">End Date</th>
                                <th class="text-info">Note</th>
                                <th class="text-info">Status</th>
                                <th class="text-info">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend.exam.modal')
@endsection
@section('script')
    @include('backend.includes.script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropfy.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script><!-- Input Mask Plugin Js -->
    <script>
        $('#start_date').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
        });
        $('#end_date').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        $('.btnUpdate').hide();
        // --------------------- Get All Inputs ----------------------
        function getInput() {
            var id = $("#data_id").val();
            var name = $('input[name="name"]').val();
            var start_date = $('input[name="start_date"]').val();
            var end_date = $('input[name="end_date"]').val();
            var note = $('textarea[name="note"]').val();
            var status = $('select[name="status"]').val();
            return {
                id: id,
                name: name,
                start_date: start_date,
                end_date: end_date,
                note: note,
                status: status,
                _token: '{!! csrf_token() !!}'
            }
        }

        // --------------------- Get All Records from Database ---------------------
        function allData() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ route('getExamList') }}",
                success: function(data) {
                    html = '';
                    $.each(data, function(key, value) {

                        if (value.status == 1) {
                            var status = '<span class="badge badge-success">Complete</span>';
                        }else{
                            var status = '<span class="badge badge-danger">InComplete</span>'
                        }

                        html += '<tr>'
                        html += '<td>'+ value.name + '</td>'
                        html += '<td>' + value.start_date + '</td>'
                        html += '<td>' + value.end_date + '</td>'
                        html += '<td>' + value.note + '</td>'
                        html += '<td>' + status + '</td>'
                        html += '<td>'
                        html += '<button type="button" class="btn text-warning" onclick="editData(' +
                            value.id + ')"><h5><i class="fa fa-edit (alias)"></i></h5></button>';
                        html += '<button type="button" class="btn text-danger" onclick="deleteData(' +
                            value.id + ')"><h5><i class="fa fa-trash-o"></i></h5></button>';
                        html += '</td>'
                        html += '</tr>'
                    });
                    $('.tbody').html(html);
                }
            });
        }
        allData();

        // -------------------- Create a new Record -----------------------
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('exam.store') }}",
                data: getInput(),
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Exam Created Successfully',
                        timer: 1500
                    });
                    success();
                },
                error: function(error) {
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_start_date').text(error.responseJSON.errors.start_date);
                    $('.validate_end_date').text(error.responseJSON.errors.end_date);
                    $('.validate_note').text(error.responseJSON.errors.note);
                }
            })
        }

        // -------------------- Edit Data ----------------------
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "exam/" + id + "/edit",
                success: function(data) {
                    $("#modal").modal('show');
                    $('.btnSave').hide();
                    $('.btnUpdate').show();
                    $("#data_id").val(data.id);
                    $('input[name="name"]').val(data.name);
                    $('input[name="start_date"]').val(data.start_date);
                    $('input[name="end_date"]').val(data.end_date);
                    $('textarea[name="note"]').val(data.note);
                }
            });
        }

        // --------------------- Update Data ------------------------
        function updateData() {
            var id = $("#data_id").val();

            $.ajax({
                type: "PUT",
                dataType: 'json',
                data: getInput(),
                url: "exam/" + id,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated Successfull',
                        timer: 1500
                    });
                    success();
                    $('.btnSave').show();
                    $('.btnUpdate').hide();
                },
                error: function(error) {
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_start_date').text(error.responseJSON.errors.start_date);
                    $('.validate_end_date').text(error.responseJSON.errors.end_date);
                    $('.validate_note').text(error.responseJSON.errors.note);
                }
            });
        }

        // --------------------- Data Delete ---------------------
        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Item!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        data: getInput(),
                        url: "exam/" + id,
                        success: function(data) {
                            success();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });
                }
            });
        }
    </script>
@endsection
