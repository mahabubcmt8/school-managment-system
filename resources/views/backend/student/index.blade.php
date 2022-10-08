@extends('layouts.backend.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropfy.css') }}">
@endsection
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Student</li>
                    <li class="breadcrumb-item active">Create New</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left">
                        <strong><i class="icon-user-follow"></i> All Student</strong>
                    </h5>
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-round float-right text-white">
                         Add New
                    </a>
                </div>
                <div class="card-body mt-5">
                    <table id="example" class="table table-bordered display text-white text-muted table-striped"
                        style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Picture</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Section</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $row)
                                <tr>
                                    <td class="text-center">
                                        @if ($row->picture)
                                            <div class="profile-image">
                                                <img src="{{ asset('storage/images/students/' . $row->picture) }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @else
                                            <div class="profile-image">
                                                <img src="{{ asset('backend/assets/images/xs/avatar2.jpg') }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $row->name }}</td>
                                    <td class="text-center">{{ $row->phone }}</td>
                                    <td class="text-center">{{ $row->classes->class_name }}</td>
                                    <td class="text-center">{{ $row->section->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('students.show',$row->id) }}" class="btn btn-primary" title="Edit Data">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit',$row->id) }}" class="btn btn-info" title="Edit Data">
                                            <i class="fa fa-edit (alias)"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $row->id) }}" method="POST"
                                            id="delForm" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delBtn">
                                                <span class="sr-only">Delete</span><i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="thead-dark text-white">
                            <tr>
                                <th class="text-center">Picture</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Section</th>
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

