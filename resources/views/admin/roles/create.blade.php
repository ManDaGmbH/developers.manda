@extends('master')
@section('title','Role Create')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="semi-bold text-center light-heading">{{ __('Create Role') }}</h4>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @include('admin.roles.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

