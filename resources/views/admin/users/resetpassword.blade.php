@extends('login')
@section('title','Reset Password')
@section('content')

<div class="row justify-content-center boxoverlay">
                <div class="col-md-6 col-lg-12">
                  @include('partials.alerts')
                    <div class="login-wrap p-0">
                <h3 class="mb-4 text-center">You can reset your password</h3>
                <form id="form-resetpass" class="signin-form" role="form" action="{{url('/')}}/changePassword" method="POST" autocomplete="off">
                  <input type="hidden" name="reset_token" value="{{$token}}" />
                    @include('admin.users.partials.changepassword')
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

          <script>
            $(".toggle-password").click(function() {
              $(this).toggleClass("fa-eye fa-eye-slash");
              var input = $($(this).attr("toggle"));
              if (input.attr("type") == "password") {
                input.attr("type", "text");
              } else {
                input.attr("type", "password");
              }
            });
          </script> 
@endsection