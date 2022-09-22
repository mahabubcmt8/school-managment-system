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
                    <li class="breadcrumb-item active">Teacher</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-warning float-left">Teacher</h5>
                    <a href="{{ route('teacher.create') }}" class="btn btn-warning btn-round float-right text-white">
                        <i class="fa fa-plus"></i> Create New
                    </a>
                </div>
                <div class="card-body mt-5">
                    <table id="example" class="table table-bordered display text-info table-striped" style="width:100%">
                        <thead class="thead-dark text-white">
                            <tr>
                                <th class="text-center">Picture</th>
                                <th class="text-center">Teacher</th>
                                <th class="text-center">Contact</th>
                                <th class="text-center">Date Of Birth</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Document</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($teachers as $row)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/images/teacher/' . $row->profile_picture) }}"
                                            height="auto" width="50px" alt="Profile Picture">
                                    </td>
                                    <td>
                                        <i class="fa icon-user-following"></i>&nbsp; {{ $row->name }}<br>
                                        <i class="fa fa-circle"></i>&nbsp; {{ $row->department->name . ' Department ' }}
                                    </td>
                                    <td>
                                        <i class="fa icon-envelope"></i>&nbsp; {{ $row->email }}<br>
                                        <i class="fa fa-phone"></i>&nbsp; {{ $row->phone }}
                                    </td>
                                    <td><i class="fa icon-calendar"></i>&nbsp; {{ date('d-m-Y', strtotime($row->dob)) }}
                                    </td>
                                    <td><span class="badge badge-primary">{{ $row->gender }}</span></td>
                                    <td>
                                        <a href="{{ asset('storage/document/teacher/' . $row->resume) }}" class="text-info"
                                            target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>&nbsp; Resume
                                        </a><br>
                                        <a href="{{ asset('storage/document/teacher/' . $row->joining_letter) }}"
                                            class="text-info" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>&nbsp; Joining Letter
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('teacher/'.$row->id.'/edit') }}" class="btn text-warning mb-2" title="Edit">
                                            <span class="sr-only">Edit</span><i class="fa fa-edit (alias)"></i>
                                        </a>
                                        <form action="{{ route('teacher.destroy',$row->id) }}" method="POST" id="delForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-warning mb-2 delBtn">
                                                <span class="sr-only">Delete</span><i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="thead-dark text-white">
                            <tr>
                                <th class="text-center">Picture</th>
                                <th class="text-center">Teacher</th>
                                <th class="text-center">Contact</th>
                                <th class="text-center">Date Of Birth</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Document</th>
                                <th class="text-center">Action</th>
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
        $('.delBtn').on('click', function(e){
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
