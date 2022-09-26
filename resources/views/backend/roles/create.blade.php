@extends('layouts.backend.app')



@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Role</li>
                    <li class="breadcrumb-item active">New Role</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="text-success">Create New Role</h5>
                        </div>
                        <div class="col-6 align-right">
                            <a class="btn btn-success btn-round" href="{{ route('roles.index') }}">
                                <i class="fa fa-long-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong class="text-info">Name:</strong>
                                {!! Form::text('name', null, ['placeholder' => 'Name...', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong class="text-info">Permission:</strong>
                                <br />
                                <div class="row">
                                    @foreach ($permission as $value)
                                    <div class="col-md-3">
                                        <div class="fancy-checkbox my-2">
                                            <label>
                                                {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                                <span>{{ $value->name }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success btn-round">Save</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>


@endsection
