@extends('login')
@section('title','Login')
@section('content')


<div class="row justify-content-center boxoverlay">
                <div class="col-md-6 col-lg-12">
                  @include('partials.alerts')
                    <div class="login-wrap p-0">
                <h3 class="mb-4 text-center">Login to your account</h3>
                <form id="form-login" class="signin-form" role="form" action="{{url('/backend/login')}}" method="POST" autocomplete="off">
                  @csrf
                    <div class="form-group animate__animated animate__backInLeft">
                      <input type="email" name="email" placeholder="Provide Your Email" class="form-control" required autocomplete="off">
                        
                    </div>
                <div class="form-group animate__animated animate__backInRight">
                  <input name="password" id="pwd" type="password" class="form-control " placeholder="Provide Your Password" required>
                  <span toggle="#pwd" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="row clearfix">
              <div class="col-sm-12">
                <p class="bold m-l-5" style="margin-bottom:5px;font-weight:bold !important;font-size:16px;">Human Verification</p>
                <p class="m-l-5 text-default small" style="margin-bottom:5px;">Please write "{{config('app.name','Content Management System')}}" in green box</p>
              </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default" style="background-color: #fedad0;border-radius: 40px;">
                            <input type="text" class="form-control" name="red_box" id="redField" style="height:35px;color:#000 !important;">
                          </div>
                          
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default" style="background-color: #d2f1eb;border-radius: 40px;">
                            <input type="text" class="form-control" name="green_box" id="greenField" style="height:35px;;color:#000 !important;">
                          </div>
                          @error('green_box')
                            <label id="green_box-error" class="error" for="green_box">{{$message}}</label>
                        @enderror
                        </div>

                        
              </div>
                <div class="form-group">
                    <button type="submit" id="submitForm" class="form-control btn btn-primary submit px-3">Sign In</button>
                </div>
                <div class="form-group d-md-flex">
                      <div class="w-100 text-md-right">
                            <a href="{{url('/')}}/backend/forgotPassword" class="text-warning small m-l-10">Forgot Password?</a>
                      </div>
                </div>
              </form>
              </div>
                </div>
            </div>

@endsection