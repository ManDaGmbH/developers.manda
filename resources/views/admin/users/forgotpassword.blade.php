@extends('login')
@section('title','Forgot Password')
@section('content')



<div class="row justify-content-center boxoverlay">
                <div class="col-md-6 col-lg-12">
                  @include('partials.alerts')
                    <div class="login-wrap p-0">
                <h3 class="mb-4 text-center">Please provide your registered email</h3>
                <form id="form-login" class="signin-form" role="form" action="{{url('/')}}/recoverPassword" method="POST" autocomplete="off">
                  @csrf
                    <div class="form-group animate__animated animate__backInLeft @error('email'){{'has-error'}} @enderror">
                      <input type="email" name="email" placeholder="Provide Your Email" required class="form-control @error('email'){{'error'}} @enderror" autocomplete="off">
                    </div>
                     @error('email')
                    <label id="email-error" class="error" for="email">{{$message}}</label>
                    @enderror
                <div class="form-group">
                    <button type="submit" id="submitForm" class="form-control btn btn-primary submit px-3">Recover Password</button>
                </div>
                <div class="form-group d-md-flex">
                      <div class="w-100 text-md-right">
                            <a href="{{url('/')}}/backend/login" class="text-warning small m-l-5">Back To Login</a>
                      </div>
                </div>
              </form>
              </div>
                </div>
            </div>
@endsection