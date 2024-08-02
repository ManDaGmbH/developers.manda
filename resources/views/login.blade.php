<!doctype html>
<html lang="en">
  <head>
    <title>{{config('app.name','Content Management System')}} - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('pages/css/themes/modern.css') }}" />
    <link rel="stylesheet" href="{{asset('login/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('login/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('validate-password/css/jquery.passwordRequirements.css') }}" />

    </head>
    <body class="img js-fullheight" style="background-image: url({{asset('login/images/img5.jpeg')}});overflow:hidden;">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-0">
                    <h2 class="heading-section"><img src="{{asset('frontend/assets/img/logo.png')}}" width="80px"/></h2>
                </div>
            </div>
             @yield('content')
            
        </div>
    </section>

    <script src="{{asset('login/js/jquery.min.js')}}"></script>
  <script src="{{asset('login/js/popper.js')}}"></script>
  <script src="{{asset('login/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('login/js/main.js')}}"></script>
   <script src="{{asset('plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <!-- END VENDOR JS -->
        <script src="{{ asset('validate-password/js/jquery.passwordRequirements.js') }}"></script>

        <script src="{{asset('pages/js/pages.min.js')}}"></script>
        <script>
function redMustEmpty() {
    if ($('#redField').val().length > 0) {
        return false;
    }
}
$(function ()
{
    $(".pr-password").passwordRequirements();
    $('#form-login').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            red_box: {
                maxlength: 0
            },
            green_box: {
                required: true
            }
        },
        messages: {
            red_box: {
                maxlength: 'The red box must be empty'
            }
        },
        submitHandler: function (form) {
            $("#submitForm").html("Please wait...").attr('disabled', true);
            form.submit();
        }

    });





    $('#form-resetpass').validate({
        rules: {
            password: {
                required: true,
                pwcheck: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        message: {
            password: {
                required: "Password Required",
                pwcheck: "Password Week",
                minlength: "min 8 Char"
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

});
        </script>

    </body>
</html>