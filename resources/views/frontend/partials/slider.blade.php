<!--<div id="flexslider-nav" class="fullpage-wrap full-vh small">-->
<div id="flexslider-nav" class="fullpage-wrap small">
    <ul class="slides">
        @foreach($sliders as $slider)  
        <li style="background-image:url(<?= asset('/images/thumbnails/' . $slider->image) ?>)">
            <!--<div class="container text">
                <h1 class="white flex-animation">It's time to <br> start your adventures</h1>
                <h2 class="white flex-animation">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>Veniam, facilis.</h2>
                <a href="#" class="shadow btn-alt small activetwo margin-bottom-null flex-animation">More info</a>
            </div>-->
            <div class="gradient dark"></div>
        </li>
        @endforeach
<!--            <li style="background-image:url(<?= asset('/frontend') ?>/assets/img/home2.jpg)">
            <div class="text container">
                <h1 class="white flex-animation no-opacity">Wild nature<br> safe adventure</h1>
                <h2 class="white flex-animation no-opacity">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>Veniam, facilis.</h2>
                <a href="#" class="shadow btn-alt small activetwo margin-bottom-null flex-animation no-opacity">More info</a>
            </div>
            <div class="gradient dark"></div>
        </li>-->
    </ul>
    <div class="slider-navigation">
        <a href="#" class="flex-prev"><i class="icon ion-ios-arrow-thin-left"></i></a>
        <div class="slider-controls-container"></div>
        <a href="#" class="flex-next"><i class="icon ion-ios-arrow-thin-right"></i></a>
    </div>
</div>