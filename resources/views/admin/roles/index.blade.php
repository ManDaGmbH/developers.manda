@extends('master')
@section('title','Role List')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('admin.roles.create') }}"> Create Role</a>
            @endcan
        </div>
    </div>
</div>

@include('admin.roles.partials.loop.list')
 
@include('partials.loadmorejs')
@endsection