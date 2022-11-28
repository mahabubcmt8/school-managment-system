@extends('layouts.backend.app')
@section('block-header')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Role</li>
                    <li class="breadcrumb-item active">Show Role Permission</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <h5 class="text-success"> Show Role & Permissions</h5>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success btn-round" href="{{ route('roles.index') }}"><i class="fa fa-long-arrow-left"></i> Back</a>
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Role Name: </strong>
                        <span class="badge badge-warning">{{ $role->name }}</span><br><br>
                        <strong>Permissions: </strong>
                    </div>
                </div>
                <div class="row">
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                        <div class="col-md-3">
                            <span class="badge badge-info my-2">{{ $v->name }}</span>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
