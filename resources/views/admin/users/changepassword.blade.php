@extends('master')
@section('title','Change Password')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="semi-bold text-center light-heading">{{ __('Change Password') }}</h4>

                <div class="card-body">
					<form method="POST" action="{{url('/')}}/changePassword">
						<input type="hidden" name="changepassword" value="1" />
						@include('admin.users.partials.changepassword',['isChangepass'=>true])
						<button class="btn btn-primary btn-cons m-t-0 pull-right" type="submit" id="submitForm">Update Password</button>
					</form>	
				</div>
			</div>
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