@extends('layouts.backend.app')
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Section</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left"><strong>Section</strong></h5>
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
                                <th class="text-center">Section</th>
                                <th class="text-center">Capacity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-white text-center">
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Section</th>
                                <th class="text-center">Capacity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @include('backend.section.modal')
@endsection
@section('script')
    @include('backend.includes.script')

    <script>
        $('.btnUpdate').hide();
        /* ============================ All Data ============================ */
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getSections') }}",
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
                        data: 'capacity',
                        name: 'capacity'
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
            var class_id = $('select[name="class_id"]').val();
            var name = $('input[name="name"]').val();
            var capacity = $('input[name="capacity"]').val();
            return {
                id: id,
                class_id: class_id,
                name: name,
                capacity: capacity,
                _token: '{!! csrf_token() !!}'
            }
        }

        /* ============================ Create new record ============================ */
        $("#saveBtn").on('click', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('section.store') }}",
                data: getInput(),
                success: function(data) {
                    success();
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Section Created Successfully!!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                },
                error: function(error) {
                    $('.validate_class_id').text(error.responseJSON.errors.class_id);
                    $('.validate_name').text(error.responseJSON.errors.name);
                    $('.validate_capacity').text(error.responseJSON.errors.capacity);
                }
            })
        });
        // ============================ Edit Data ============================
        function editData(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "section/" + id + "/edit",
                success: function(data) {
                    $("#modal").modal('show');
                    $('.btnSave').hide();
                    $('.btnUpdate').show();
                    $("#data_id").val(data.id);
                    $('input[name="name"]').val(data.name);
                    $('input[name="capacity"]').val(data.capacity);
                }
            });
        }
        // ============================ Update Data ============================
        $('.btnUpdate').on('click', function() {
            var id = $("#data_id").val();

            $.ajax({
                type: "PUT",
                dataType: 'json',
                data: getInput(),
                url: "section/" + id,
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
                    $('.validate_capacity').text(error.responseJSON.errors.capacity);
                }
            });
        });
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
                        url: "section/" + id,
                        success: function(data) {
                            success();
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Deleted Successfully !!',
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
