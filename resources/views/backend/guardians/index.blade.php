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
                    <li class="breadcrumb-item active">Guardians</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success float-left">
                        <strong><i class="icon-user-follow"></i> All Guardian</strong>
                    </h5>
                    <a href="{{ route('guardians.create') }}" class="btn btn-primary btn-round float-right text-white">
                         Add New
                    </a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered display text-white text-muted table-striped"
                        style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Student</th>
                                <th class="text-center">Father</th>
                                <th class="text-center">Mother</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guardians as $row)
                                <tr>
                                    <td class="text-center">
                                        @if ($row->student->picture)
                                            <div class="profile-image">
                                                <img src="{{ asset('storage/images/students/' . $row->student->picture) }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @else
                                            <div class="profile-image">
                                                <img src="{{ asset('backend/assets/images/xs/avatar2.jpg') }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @endif
                                        {{ $row->student->name }}
                                    </td>
                                    <td class="text-center">
                                        @if ($row->fathers_photo)
                                            <div class="profile-image">
                                                <img src="{{ asset('storage/images/guardians/' . $row->fathers_photo) }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @else
                                            <div class="profile-image">
                                                <img src="{{ asset('backend/assets/images/xs/avatar2.jpg') }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @endif
                                        {{ $row->fathers_name }}
                                    </td>
                                    <td class="text-center">
                                        @if ($row->mothers_photo)
                                            <div class="profile-image">
                                                <img src="{{ asset('storage/images/guardians/' . $row->mothers_photo) }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @else
                                            <div class="profile-image">
                                                <img src="{{ asset('backend/assets/images/xs/avatar2.jpg') }}" class="" style="width: 40px; height: 40px;border-radius:50%" alt="">
                                            </div>
                                        @endif
                                        {{ $row->fathers_name }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('guardians.show',$row->id) }}" class="btn btn-primary" title="Edit Data">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a href="{{ route('guardians.edit',$row->id) }}" class="btn btn-info" title="Edit Data">
                                            <i class="fa fa-edit (alias)"></i>
                                        </a>
                                        <form action="{{ route('guardians.destroy', $row->id) }}" method="POST"
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
                                <th class="text-center">Student</th>
                                <th class="text-center">Father</th>
                                <th class="text-center">Mother</th>
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
