@extends('master')
@section('title','User Create')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="semi-bold text-center light-heading">{{ __('Edit Section') }}</h4>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.categories.update',$id) }}">
                        @method('put')
                        @include('admin.categories.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection