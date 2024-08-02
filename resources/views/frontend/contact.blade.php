@extends('layouts.front_theme')
@section('content')

<!--  Page Content, class footer-fixed if footer is fixed  -->
            <div id="page-content" class="header-static footer-fixed">
                <!--  Slider  -->
                <div id="flexslider" class="fullpage-wrap small">
                    <ul class="slides">
                         <?php
            $image='img'.rand(1,1).'.jpg';
            ?>
            <li class="flex-active-slide" style="background-image: url('{{ asset('login/images/'.$image) }}'); width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
                  <div class="container text text-center">
                                <h1 class="white margin-bottom-small">Contact Us</h1>
                            </div>
                            <div class="gradient dark"></div>
                        </li>
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="active">Contact</li>
                        </ol>
                    </ul>
                </div>
                <!--  END Slider  -->
                <div id="page-wrap" class="content-section fullpage-wrap">
                    <div class="row margin-leftright-null">
                        <div class="container">
                            <!--  Contact Info  -->
                            <div class="col-md-6 padding-leftright-null">
                                <div class="text">
                                    <h2 class="margin-bottom-null title line left">Get in touch Person</h2>
                                    <!--<p class="heading center grey margin-bottom-null">D.Dogucu</p>-->
                                    <p class="heading center grey margin-bottom-null">Mantas Duda (CEO)</p>
                                    <div class="padding-onlytop-md">
                                        <!--<p class="margin-bottom">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem harum aspernatur sapiente error, voluptas fuga, laudantium ullam magni fugit. Qui!</p>-->
                                        <p><!--<span class="contact-info">Address <em>322 Moon St, Venice
                                            Italy, 1231</em></span><br>-->
                                            <span class="contact-info">Phone <em>(49) 111-111 1111</em></span>
                                            <br>
                                            <span class="contact-info">Email <a href="mailto:hallo@manda.gmbh"><em>hallo@manda.gmbh</em></a></span></p>
                                        <!--<p class="margin-md-bottom-null"><span class="contact-info">Monday to Friday <em>9.00 am to 12.00 pm</em></span><br><span class="contact-info">Saturday from <em>9.00 am to 12.00 pm</em></span></p>-->
                                    </div>
                                </div>
                            </div>
                            <!--  END Contact Info -->
                            <!--  Input Form  -->
                            <div class="col-md-6 padding-leftright-null">
                                <div class="text padding-onlybottom-sm padding-md-top-null">
                                    <form id="contact-form" action="<?=url('send-message')?>" method="post" class="padding-onlytop-md padding-md-topbottom-null">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input class="form-field" name="name" id="name" type="text" placeholder="Name">
                                            </div>
                                            <div class="col-md-12">
                                                <input class="form-field" name="mail" id="mail" type="text" placeholder="Email">
                                            </div>
                                            <div class="col-md-12">
                                                <input class="form-field" name="subjectForm" id="subjectForm" type="text" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea class="form-field" name="messageForm" id="messageForm" rows="6" placeholder="Your Message"></textarea>
                                                <div class="submit-area padding-onlytop-sm">
                                                    <input type="submit" id="submit-contact" class="btn-alt" value="Send Message">
                                                    <div id="msg" class="message"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--  END Input Form  -->
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
            <!--  END Page Content, class footer-fixed if footer is fixed  -->
@endsection