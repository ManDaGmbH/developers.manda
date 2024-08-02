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
                    <h1 class="white margin-bottom-small"><?= $gallery->title ?></h1>
                </div>
                <div class="gradient dark"></div>
            </li>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Achievements</li>
            </ol>
        </ul>
    </div>
    <!--  END Slider  -->
    <div id="page-wrap" class="content-section fullpage-wrap">
        <!--  Gallery Section  -->


        {{--
        <section id="gallery" data-isotope="load-simple">
                  
                   <div class="masonry-items equal four-columns">
                <!--  Lightbox trek -->
        <?php
        $images = $gallery->images;
        ?>
                @foreach($images as $image)
                <div class="one-item">
                    <div class="image-bg" style="background-image:url(<?= asset('images/thumbnails/' . $image->image) ?>)"></div>
                    <div class="content figure">
                        <i class="pd-icon-camera"></i>
                        <a href="<?= asset('images/thumbnails/' . $image->image) ?>" class="link lightbox"></a>
                    </div>
                </div>
                @endforeach
                
            </div>
        </section>
                --}}
        <!--  END Lightbox trek -->


        <!--  END Gallery Section  -->
        <section style="margin: 40px 0;">
            <div class="container" >

                <!--  Lightbox trek -->
                <?php
                $images = $gallery->images;
                ?>
                @foreach($images as $image)
                <div class="row" style="margin-top: 15px; border: 1px solid #ccc;box-shadow: 0 2px 5px 1px rgba(64,60,67,.16)">
                    <div class="col-lg-4" style="padding:0">
                        <div style="height:300px;display: flex;justify-content: center; align-items: center;">
                            <div style="background-position: center;flex-grow:1;background-size: contain;height:190px;background-repeat: no-repeat;background-image:url(<?= asset('images/thumbnails/' . $image->image) ?>)"></div>
                        </div>

                    </div>
                    <div class="col-lg-8" style="padding:20px;">
                        <?= $image->description ?>
                    </div>
                </div>
                @endforeach

            </div>
        </section>
    </div>
</div>

<!--  END Page Content, class footer-fixed if footer is fixed  -->
@endsection