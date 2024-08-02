@extends('master')
@section('title','User Create')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="semi-bold text-center light-heading">{{ __('Create Section') }}</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.page.details.store',$pageId) }}">
                        @include('page_details.form',['create'=>true])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection