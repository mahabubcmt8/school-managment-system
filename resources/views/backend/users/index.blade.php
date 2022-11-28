@extends('layouts.backend.app',['pageTitle'=>'All Users'])
@section('css')
    @include('backend.includes.style')
@endsection
@section('block-header')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active"><strong>Users</strong></li>
                    <li class="breadcrumb-item active"><strong>Users Management</strong></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h5 class="text-success"><strong>Users Management</strong></h5>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success btn-round" href="{{ route('users.create') }}">
                            <i class="fa fa-plus"></i> Create New User
                        </a>
                    </div>
                </div>
                <div class="card-body mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table table-responsive-sm yajra-datatable" id="data-table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">Picture</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-white text-center">
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th class="text-center">Picture</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'picture',
                        name: 'picture'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'department_id',
                        name: 'department_id'
                    },
                    {
                        data: 'role',
                        name: 'role'
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
        // ============================ Data Delete ============================
        function deleteData(id) {
            var token = '{!! csrf_token() !!}';
            Swal.fire({
                title: 'Are you confirm?',
                text: "Delete This User!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        url: "users/" + id,
                        success: function(data) {
                            success();
                            $('#data-table').DataTable().ajax.reload();
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
