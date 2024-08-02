@extends('master')
@section('title','Dashboard')
@section('content')
<div>
    <h1 class="float-left">List Users</h1>
    @include('admin.users.partials.user_search_form')
    <div class="pull-left">
    <b>Legends: </b>
		<i style="padding: 1px 9px;" data-toggle="tooltip" data-placement="top" title="" class="rounded-circle bg-success ml-2 mr-2" data-original-title="Active"></i>
		<i style="padding: 1px 9px;" class="rounded-circle bg-danger mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive"></i>
	</div>
    @can('user-create')
    <a href="{{route('admin.users.create')}}" class="btn btn-success float-right" role="button">Create User</a>
    @endcan	
    <div class="clearfix"></div>
</div>
@include('admin.users.partials.loop.list')    

@include('partials.loadmorejs')
@endsection
