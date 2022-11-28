@extends('layouts.backend.app')
@section('content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-md-6 col-sm-12 ">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active">Role</li>
                <li class="breadcrumb-item active">Role Management</li>
            </ul>
        </div>
    </div>
</div>
<div class="row mt-3 justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-success">Role Management</h4>
                    </div>
                    <div class="col-md-6 align-right">
                        @can('role-create')
                            <a class="btn btn-success btn-round" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> New Role</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table table-responsive-sm yajra-datatable" id="data-table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-white text-center">
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th class="text-center">S.N</th>
                                <th class="text-center">Name</th>
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
                ajax: "{{ route('roles.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
                text: "Delete This Role!",
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
                        url: "roles/" + id,
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
