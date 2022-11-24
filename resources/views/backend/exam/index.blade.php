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
                    <h5 class="card-title text-success float-left"><strong>Exam List</strong></h5>
                    <button class="btn btn-success btn-round float-right text-white" data-toggle="modal"
                        data-target="#modal">
                        <i class="fa fa-plus"></i> Create New
                    </button>
                </div>
                <div class="card-body pt-5">
                    <table class="table table-bordered data-table" id="data-table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Exam Name</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">End Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-white text-center">
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Exam Name</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">End Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend.exam.modal')
    @include('backend.exam.viewmodal')
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
        $('.btnUpdate').hide();
        /* ============================ All Data ============================ */
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getExamList') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        /* ============================ Get All Input ============================ */
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


        // ============================ Create a new Record ============================
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('exam.store') }}",
                data: getInput(),
                success: function(data) {
                    success();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Exam Created Successfully!!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                },
                error: function(error) {
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_start_date').text(error.responseJSON.errors.start_date);
                    $('.validate_end_date').text(error.responseJSON.errors.end_date);
                    $('.validate_note').text(error.responseJSON.errors.note);
                }
            })
        }

        // ============================ Edit Data ============================
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
        // ============================ Show Details ============================
        function viewData(id) {
            var url = "{{ route('exam.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: url,
                success: function(data) {
                    $("#viewmodal").modal('show');
                    if (data.status == 1) {
                        var status = 'Complete';
                    } else if (data.status == 0) {
                        status = 'InComplete';
                    }
                    $('.name').html(data.name);
                    $('.start_date').html(data.start_date);
                    $('.end_date').html(data.end_date);
                    $('.status').html(status);
                    $('.note').html(data.note);

                }
            });
        }

        // ============================ Update Data ============================
        function updateData() {
            var id = $("#data_id").val();

            $.ajax({
                type: "PUT",
                dataType: 'json',
                data: getInput(),
                url: "exam/" + id,
                success: function(data) {
                    success();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Updated Successfully!!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                },
                error: function(error) {
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_start_date').text(error.responseJSON.errors.start_date);
                    $('.validate_end_date').text(error.responseJSON.errors.end_date);
                    $('.validate_note').text(error.responseJSON.errors.note);
                }
            });
        }

        // ============================ Data Delete ============================
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
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Deleted Successfully!!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    });
                }
            });
        }
    </script>
@endsection
