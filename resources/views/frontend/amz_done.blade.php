@extends('layouts.front_theme')
@section('content')

<!--  Page Content, class footer-fixed if footer is fixed  -->
<div id="page-content" class="header-static footer-fixed">
    <!--  Slider  -->
    <div id="flexslider" class="fullpage-wrap small">
        <ul class="slides">
            <?php
            $image = 'img' . rand(1, 1) . '.jpg';
            ?>
            <li class="flex-active-slide" style="background-image: url('{{ asset('login/images/'.$image) }}'); width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
                <div class="container text text-center">
                    <h1 class="white margin-bottom-small">API Details</h1>
                </div>
                <div class="gradient dark"></div>
            </li>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">API Detail</li>
            </ol>
        </ul>
    </div>
    <!--  END Slider  -->
    <div id="page-wrap" class="content-section fullpage-wrap">
        <div class="row margin-leftright-null">
            <div class="container">
                <!--  Contact Info  -->
                <div class="col-md-10 padding-leftright-null">
                    <div class="text">
                        <h2 class="margin-bottom-null title line left">API Details</h2>
                        <!--<p class="heading center grey margin-bottom-null">D.Dogucu</p>-->
                        <!--<p class="heading center grey margin-bottom-null">Mantas Duda (CEO)</p>-->
                        <div class="padding-onlytop-md">
                            <!--<p class="margin-bottom">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem harum aspernatur sapiente error, voluptas fuga, laudantium ullam magni fugit. Qui!</p>-->
                            <p><!--<span class="contact-info">Address <em>322 Moon St, Venice
                                Italy, 1231</em></span><br>-->
                                <?php
                                $requestParams = $_GET;
                                ?>
                            <table class="table table-bordered table-striped">
                                <!--<thead>-->
                                    <tr>
                                        <th>Key</th>
                                        <th>Value</th>
                                        <th>Copy</th>
                                    </tr>
                                <!--</thead>-->
                                <tbody>
                                    @forelse($requestParams as $key=>$value)
                                    <tr>
                                        <td>
                                            {{ $key }}
                                        </td>
                                        <td id="<?= $key ?>">
                                            {{ $value }}
                                        </td>
                                        <td>
                                            <a href="javascript:void();" onclick="copyMe('<?= $key ?>')">

                                                <i class="fa fa-copy"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td width="100">
                                            No data found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>


                            </p>
                            <!--<p class="margin-md-bottom-null"><span class="contact-info">Monday to Friday <em>9.00 am to 12.00 pm</em></span><br><span class="contact-info">Saturday from <em>9.00 am to 12.00 pm</em></span></p>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--<div class="row margin-leftright-null">
              Map. Settings in assets/js/maps.js  
            <div class="col-md-12 padding-leftright-null map">
                <div id="map"></div>
            </div>
              END Map  
        </div>-->
    </div>
</div>
<script>
    function copyMe(id) {
        // Get the text from the element with the provided id
        var textToCopy = document.getElementById(id).innerText;

        // Create a temporary textarea element to hold the text
        var tempTextarea = document.createElement('textarea');
        tempTextarea.value = textToCopy;

        // Add the textarea to the document so it can be selected
        document.body.appendChild(tempTextarea);

        // Select the text inside the textarea
        tempTextarea.select();

        // Copy the selected text to the clipboard
        document.execCommand('copy');

        // Remove the temporary textarea from the document
        document.body.removeChild(tempTextarea);

        // Optional: Give feedback to the user that the text was copied
//        alert('Text copied to clipboard!');
    }


</script>
<!--  END Page Content, class footer-fixed if footer is fixed  -->
@endsection