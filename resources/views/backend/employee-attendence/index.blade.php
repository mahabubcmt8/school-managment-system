@extends('layouts.backend.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endsection
@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Attendence</li>
                    <li class="breadcrumb-item active">Employee Attendence Management</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-success"><strong>Employee Attendence</strong></h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee-attendence.store') }}" method="post">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <label for="" class="text-info">Attendence Date <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="date" id="attendence">
                                </div>
                                @error('date')
                                        <small class="text-warning"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped text-white">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Attendence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @php
                                          $i = 1
                                      @endphp
                                        @foreach ($users as $row)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="users_id[]" value="{{ $row->id }}">
                                                    {{ $i++ }}
                                                </td>
                                                <td>{{ $row->name }}</td>
                                                <td>
                                                    @if (!empty($row->getRoleNames()))
                                                        @foreach ($row->getRoleNames() as $v)
                                                            <label class="badge badge-success">{{ $v }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="fancy-checkbox">
                                                        <label>
                                                            <input type="checkbox" name="attendence[]" value="1"><span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table><br>
                                    <button type="submit" class="btn btn-primary btn-round">Save All</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.includes.script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#attendence", {
            enableTime: false,
            dateFormat: "d-m-Y",
        });
    </script>
@endsection

