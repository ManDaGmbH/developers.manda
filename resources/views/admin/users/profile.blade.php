@extends('master')
@section('title','User Edit')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <h4 class="semi-bold text-center light-heading">{{ __('Profile') }}</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.user.profile') }}">
                        @method('PATCH')
                        @include('admin.users.partials.form',['user'=>$user,'profile'=>true])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection