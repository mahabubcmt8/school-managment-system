@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Subject Management</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left"><strong>Subject Management</strong></h5>
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
                                <th class="text-center">Class</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Code</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-white text-center">
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Code</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend.subject.modal')
    @include('backend.subject.view-modal')
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $('.btnUpdate').hide();
        // ============================ Get All Inputs ============================
        function getInput() {
            var id = $("#data_id").val();
            var class_id = $('select[name="class_id"]').val();
            var name = $('input[name="name"]').val();
            var code = $('input[name="code"]').val();
            var type = $('select[name="type"]').val();
            var total_mark = $('input[name="total_mark"]').val();
            var pass_mark = $('input[name="pass_mark"]').val();
            var optional = $('input[name="optional"]').val();
            return {
                id: id,
                class_id: class_id,
                name: name,
                code: code,
                type: type,
                total_mark: total_mark,
                pass_mark: pass_mark,
                optional: optional,
                _token: '{!! csrf_token() !!}'
            }
        }

        /* ============================ All Data ============================ */
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getAllSubject') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'classes',
                        name: 'classes'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'type',
                        name: 'type'
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

        // ============================ Create a new Record ============================
        function storeData() {
            $.ajax({
                type: "POST",
                url: "{{ route('subject.store') }}",
                data: getInput(),
                success: function(data) {
                    success();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Subject Created Successfully!!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                },
                error: function(error) {
                    $('.validate_class_id').text(error.responseJSON.errors.class_id);
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_code').text(error.responseJSON.errors.code);
                    $('.validate_type').text(error.responseJSON.errors.type);
                    $('.validate_total_mark').text(error.responseJSON.errors.total_mark);
                    $('.validate_pass_mark').text(error.responseJSON.errors.pass_mark);
                    $('.validate_optional').text(error.responseJSON.errors.optional);
                }
            })
        }

        // ============================ Edit Data ============================
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "subject/" + id + "/edit",
                success: function(data) {
                    $("#modal").modal('show');
                    $('.btnSave').hide();
                    $('.btnUpdate').show();
                    $("#data_id").val(data.id);
                    $('input[name="name"]').val(data.name);
                    $('input[name="code"]').val(data.code);
                    $('input[name="total_mark"]').val(data.total_mark);
                    $('input[name="pass_mark"]').val(data.pass_mark);
                }
            });
        }
        // ============================ Show Details ============================
        function viewData(id) {
            var url = "{{ route('subject.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: url,
                success: function(data) {
                    $("#viewmodal").modal('show');
                    if (data.optional == 1) {
                        var optional = 'YES';
                    } else {
                        optional = "NO"
                    }
                    console.log(data);
                    $('.name').html(data.name);
                    $('.code').html(data.code);
                    $('.type').html(data.type);
                    $('.optional').html(optional);
                    $('.total_mark').html(data.total_mark);
                    $('.pass_mark').html(data.pass_mark);
                    $('.class').html(data.classes.class_name);
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
                url: "subject/" + id,
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
                    $('.validate_class_id').text(error.responseJSON.errors.class_id);
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_code').text(error.responseJSON.errors.code);
                    $('.validate_type').text(error.responseJSON.errors.type);
                    $('.validate_total_mark').text(error.responseJSON.errors.total_mark);
                    $('.validate_pass_mark').text(error.responseJSON.errors.pass_mark);
                    $('.validate_optional').text(error.responseJSON.errors.optional);
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
                        url: "subject/" + id,
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
