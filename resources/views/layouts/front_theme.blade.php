<?php
$menus = menus();
$categories = categories();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Manda Developers Homes</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/bootstrap/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/bootstrap/bootstrap-theme.min.css">

        <!-- Custom css -->
        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/style.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/ionicons.min.css">

        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/puredesign.css">

        <!-- Flexslider -->
        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/flexslider.css">

        <!-- Owl -->
        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/owl.carousel.css">

        <!-- Magnific Popup -->
        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/magnific-popup.css">

        <link rel="stylesheet" href="<?= asset('/frontend') ?>/assets/css/jquery.fullPage.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?= asset('/frontend') ?>/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="<?= asset('/frontend') ?>/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            header nav.navbar #logo a.navbar-brand img {
                max-height: 55px;
                width: auto;
            }
            #header {
                    background: rgba(12,12,13,0.9) !important;
                    transition: background-color .4s ease-out;
                    box-shadow: 0px 2px 4px -2px rgb(156 156 156 / 50%);
            }
        </style>
    </head>
    <body>

        <!--  loader  -->
        <div id="myloader">
            <span class="loader">
                <div class="inner-loader"></div>
            </span>
        </div>
<header id="header" class="transparent full-width">
                <div class="container-fluid " style="padding: 0 30px;">
                    <nav class="navbar navbar-default white" style="padding: 0 40px;">
                        <!--  Header Logo  -->
                        <div id="logo">
                            <a class="navbar-brand" href="<?= asset('/') ?>">
                                <img src="<?= asset('/frontend') ?>/assets/img/logo.png" class="normal" alt="logo">
                                <img src="<?= asset('/frontend') ?>/assets/img/logo.png" class="retina" alt="logo">
                                <img src="<?= asset('/frontend') ?>/assets/img/logo.png" class="normal white-logo" alt="logo">
                                <img src="<?= asset('/frontend') ?>/assets/img/logo.png" class="retina white-logo" alt="logo">
                            </a>
                        </div>
                        <!--  END Header Logo  -->
                        <!--  Classic menu, responsive menu classic  -->
                        <div id="menu-classic">
                            <div class="menu-holder">
                                <ul>
                                    <li class="">
                                        <!--class="active-item"-->
                                        <a href="<?= url('/') ?>" >Home</a>
                                    </li>
                                    @foreach($menus as $menu)
                                    <li class="">
                                        <!--class="active-item"-->
                                        <a href="<?= url('page/' . $menu->slug) ?>" ><?= $menu->title ?></a>
                                    </li>

                                    @endforeach
                                   <!--developers details-->
                                    
                                   {{-- @if($categories->count())
                                    <li class="submenu">
                                        <a href="javascript:void(0)">Developers</a>
                                        <ul class="sub-menu">
                                            @foreach($categories as $category)
                                            <li><a href="<?= url('gallery/' . $category->slug) ?>"><?= $category->title ?></a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif --}}
                                    <li class="">
                                        <!--class="active-item"-->
                                        <a href="<?= url('contact') ?>" >Kontakt</a>
                                    </li>

                                    <!--                                    <li class="submenu">
                                                                            <a href="<?= url('') ?>" class="active-item">Home</a>
                                                                        </li>
                                                                        <li class="submenu">
                                                                            <a href="javascript:void(0)">Gallery</a>
                                                                            <ul class="sub-menu">
                                                                                <li><a href="<?= asset('/frontend') ?>/gallery.html">Classic</a></li>
                                                                                <li><a href="<?= asset('/frontend') ?>/gallery-filters.html">Filters</a></li>
                                                                                <li><a href="<?= asset('/frontend') ?>/single-project-1.html">Single Project 1</a></li>
                                                                                <li><a href="<?= asset('/frontend') ?>/single-project-2.html">Single Project 2</a></li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="submenu">
                                                                            <a href="javascript:void(0)">Blog</a>
                                                                            <ul class="sub-menu">
                                                                                <li><a href="<?= asset('/frontend') ?>/blog-classic.html">Blog Classic</a></li>
                                                                                <li><a href="<?= asset('/frontend') ?>/standard-post.html">Image Post</a></li>
                                                                                <li><a href="<?= asset('/frontend') ?>/slider-post.html">Slider Post </a></li>
                                                                                <li><a href="<?= asset('/frontend') ?>/video-post.html">Video Post</a></li>
                                                                            </ul>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?= asset('/frontend') ?>/elements.html">Elements</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?= asset('/frontend') ?>/contact-1.html">Contact</a>
                                                                        </li>
                                    -->
                                </ul>
                            </div>
                        </div>
                        <!--  END Classic menu, responsive menu classic  -->
                        <!--  Button for Responsive Menu Classic  -->
                        <div id="menu-responsive-classic">
                            <div class="menu-button">
                                <span class="bar bar-1"></span>
                                <span class="bar bar-2"></span>
                                <span class="bar bar-3"></span>
                            </div>
                        </div>
                        <!--  END Button for Responsive Menu Classic  -->
                        <!--  Search Box  -->
                        <div id="search-box" class="full-width">
                            <form role="search" id="search-form" class="black big">
                                <div class="form-input">
                                    <input class="form-field black big" type="search" placeholder="Search...">
                                    <span class="form-button big">
                                        <button type="button">
                                            <i class="icon ion-ios-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                            <button class="close-search-box">
                                <i class="icon ion-ios-close-empty"></i>
                            </button>
                        </div>
                        <!--  END Search Box  -->
                    </nav>
                </div>
            </header>
        <!--  Main Wrap  -->
        <div id="main-wrap" class="full-width">
            <!--  Header & Menu  -->
            
            <!--  END Header & Menu  -->

            @yield('content')

            <!--  Footer. Class fixed for fixed footer  -->
            <footer class="full-width" style="background-color: #181819;">
                <div class="text-white text-center" style="color: #eaeaea;font-size: 12px; padding: 0">
                    © <?= date('Y') ?>   |  Manda Developers Homes   |   All Rights Reserved   
                    <!--| Developed by <a href="https://www.cyberclouds.com">Cyber Clouds</a>-->

                </div>
            </footer>
            <!--  END Footer. Class fixed for fixed footer  -->
        </div>
        <!--  Main Wrap  -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.min.js"></script>
        <!-- All js library -->
        <script src="<?= asset('/frontend') ?>/assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.flexslider-min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.fullPage.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/owl.carousel.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/isotope.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.magnific-popup.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/smooth.scroll.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.appear.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.countTo.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/jquery.scrolly.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/plugins-scroll.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/imagesloaded.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/pace.min.js"></script>
        <script src="<?= asset('/frontend') ?>/assets/js/main.js"></script>
    </body>
</html>