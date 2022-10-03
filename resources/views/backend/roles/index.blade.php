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
    <div class="col-lg-10">
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
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-info">SL NO</th>
                            <th class="text-info">Name</th>
                            <th class="text-info" width="280px">Action</th>
                         </tr>
                    </thead>
                    <tbody class="text-light">
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a class="btn btn-outline-info" href="{{ route('roles.show',$role->id) }}" title="SHOW">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @can('role-edit')
                                    <a class="btn btn-outline-success" href="{{ route('roles.edit',$role->id) }}">
                                        <i class="fa fa-edit (alias)"></i>
                                    </a>
                                @endcan
                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'id' => "delForm",'style'=>'display:inline']) !!}
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger delBtn">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    @else
                                    <button type="submit" class="btn btn-outline-danger disabled" title="You Have not permission to delete this role">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="thead-dark">
                        <tr>
                            <th class="text-info">SL NO</th>
                            <th class="text-info">Name</th>
                            <th class="text-info" width="280px">Action</th>
                         </tr>
                    </tfoot>
                  </table>
                  {!! $roles->render() !!}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $('.delBtn').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#delForm").submit();
                }
            });
        });
    </script>
@endsection
