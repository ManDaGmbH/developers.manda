@extends('layouts.front_theme')
@section('content')
<style>
    .content-area font font {
        font-size: 18px;
    }
</style>

<style>
    .developer-section {
        margin-bottom: 30px;
    }
    .developer-img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .developer-description {
        padding: 20px;
    }
       .bg-light {
            background-color: #F8F8F8;
        }
        
</style>

<!--  Page Content, class footer-fixed if footer is fixed  -->
<div id="page-content" class="header-static footer-fixed" style="margin-bottom: 1px;">
    @php $homecontent=""; @endphp
    @if($type=="home")
    @php $homecontent = "home-content-area"; @endphp
    <!--  Slider  -->
    @include('frontend.partials.slider')


    <!--developer section started-->
    <div class="container my-5">
        <h2 class="text-center" style="margin: 30px 0;font-weight: bold">Meet Our Developers</h2>

        @foreach($categories as $k=>$category)
        <?php
        $c = '';
        $c1 = '';
        if (fmod($k, 2) > 0) {
            $c = 'col-md-push-8';
            $c1 = 'col-md-pull-4';
        }
        ?>
        <!-- Developer 1 -->
        <div class="developer-section row bg-light">
            <div class="col-md-4 <?=$c?>">
                <img src="{{ asset('images/thumbnails/'.$category->image) }}" class="developer-img" alt="{{ $category->title }}">
            </div>
            <div class="col-md-8 <?=$c1?> developer-description">
                <h3 style="font-weight: bold">{{ $category->title }}</h3>
                <p>
                    {{ $category->description }}
                </p>
                <a href="{{ url('gallery/'.$category->slug) }}" class="shadow btn-alt small activetwo margin-bottom-null flex-animation">Achievements</a>
            </div>
        </div>

        @endforeach
    </div>

    @endif

    <!--Dynamic Content-->
    @if($type!="home")
    <div class="fullpage-wrap small" id="flexslider" >
        <ul class="slides">
            <?php
            $image = 'img' . rand(1, 1) . '.jpg';
            ?>
            <li class="flex-active-slide" 
                style="background-image: url('{{ asset('login/images/'.$image) }}'); width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;"
                >
                <div class="container text text-center">
                    <h1 class="white margin-bottom-small">{{ $page->title }}</h1>
                </div>
                <div class="gradient dark">&nbsp;</div>
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li class="active">{{ $page->title }}</li>
                </ol>
            </li>
        </ul>
    </div>
    @endif

    <div class="content-area {{$homecontent}}" style="padding: 50px 120px;">
        <?php
        $sections = ($page) ? $page->pageDetails : [];
        ?>
        @foreach($sections as $section)
        <?= $section->section ?>
        @endforeach
    </div>

    <!--  END Slider  -->

</div>
<!--  END Page Content, class footer-fixed if footer is fixed  -->
@endsection