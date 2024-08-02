@extends('master')
@section('title','User Create')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="semi-bold text-center light-heading">{{ __('Create User') }}</h4>

                <div class="card-body">
                    <form method="POST" id="user-form" action="{{ route('admin.users.store') }}">
                        @include('admin.users.partials.form',['create'=>true])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document.body).on('click', '#save-form', function () {
        $('#user-form').validate({
            rules: {
                first_name: {
                    lettersonly: true,
                    required: true,
                    maxlength: 45,
                    minlength: 2

                },
                last_name: {
                    lettersonly: true,
                    required: true,
                    maxlength: 45,
                    minlength: 2

                },
                email: {
                    required: true,
                    email: true
                },
                email_confirmation: {
                    required: true,
                    equalTo: "#email"
                },
                /*password: {
                    required: true,
                    pwcheck: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }*/
            },
            message: {
                password: {
                    required: "Password Required",
                    pwcheck: "Password Week",
                    minlength: "min 8 Char"
                },
                first_name: {
                    lettersonly: "please enter characters only",
                    required: "Enter your first name, please.",
                    maxlength: "First Name too long.",
                    minlength: "Min 2 Char"
                },
                last_name: {
                    lettersonly: "please enter characters only",
                    required: "Enter your first name, please.",
                    maxlength: "First Name too long.",
                    minlength: "Min 2 Char"
                }
            },
            submitHandler: function (form) {
                $("#submitForm").html("Please wait...").attr('disabled', true);
                form.submit();
            }

        });
        $.validator.addMethod("pwcheck", function (value) {

            return /^[a-zA-Z0-9!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]+$/.test(value)
                    && /[a-z]/.test(value) // has a lowercase letter
                    && /\d/.test(value)//has a digit
                    && /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)// has a special character
        }, "Must consist  lowercase letter, number and special characters");
        
        $.validator.addMethod("lettersonly", function (value) {
            return /^[a-zA-Z\s]+$/.test(value)
        }, "Only Charachters Are Allowed");
    });

</script>
@endsection