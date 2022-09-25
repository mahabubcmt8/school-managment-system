@extends('layouts.backend.app')
@section('css')
    @include('backend.includes.style')
@endsection

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active">Users Management</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <h5 class="text-success">Users Management</h5>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success btn-round" href="{{ route('users.create') }}"> Create New User</a>
                    </div>
                </div>
                <div class="card-body mt-5">
                    <table id="example" class="table table-bordered display text-white text-muted table-striped"
                        style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-warning"><i class="fa fa-file-picture-o (alias)"></i>&nbsp; Picture</th>
                                <th class="text-center text-warning"><i class="fa icon-user-following"></i>&nbsp; Name</th>
                                <th class="text-center text-warning"><i class="fa icon-envelope"></i>&nbsp; Email</th>
                                <th class="text-center text-warning"><i class="fa icon-call-in"></i>&nbsp; Phone</th>
                                <th class="text-center text-warning">Department</th>
                                <th class="text-center text-warning">Role</th>
                                <th class="text-center text-warning">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($users as $row)
                                <tr>
                                    <td class="text-center">
                                                @if ($row->profile_picture)
                                                <div class="profile-image mb-3">
                                                    <img src="{{ asset('storage/images/users/' . $row->profile_picture) }}" class="rounded-circle" style="width: 40px; height: 40px" alt="">
                                                </div>
                                                @else
                                                <div class="profile-image mb-3">
                                                    <img src="{{ asset('backend/assets/images/xs/avatar2.jpg') }}" class="rounded-circle" style="width: 40px; height: 40px" alt="">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ $row->department->name }}</td>
                                    <td>
                                        @if (!empty($row->getRoleNames()))
                                            @foreach ($row->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('users.show', $row->id) }}" class="btn text-info"
                                                title="View Users Info">
                                                <span class="sr-only">Edit</span><i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('users/' . $row->id . '/edit') }}" class="btn text-warning"
                                                title="Edit">
                                                <span class="sr-only">Edit</span><i class="fa fa-edit (alias)"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $row->id) }}" method="POST"
                                                id="delForm" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn text-danger delBtn">
                                                    <span class="sr-only">Delete</span><i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </div>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="thead-dark text-white">
                            <tr>
                                <th class="text-center text-warning"><i class="fa fa-file-picture-o (alias)"></i>&nbsp; Picture</th>
                                <th class="text-center text-warning"><i class="fa icon-user-following"></i>&nbsp; Name</th>
                                <th class="text-center text-warning"><i class="fa icon-envelope"></i>&nbsp; Email</th>
                                <th class="text-center text-warning"><i class="fa icon-call-in"></i>&nbsp; Phone</th>
                                <th class="text-center text-warning">Department</th>
                                <th class="text-center text-warning">Role</th>
                                <th class="text-center text-warning">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @include('backend.includes.script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
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
