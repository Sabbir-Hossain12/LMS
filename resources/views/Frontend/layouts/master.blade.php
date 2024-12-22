<!doctype html>
<html class="no-js is_dark" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home-5 Online Course Dark | Danpite Tech </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/img/favicon.ico">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/animate.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/aos.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/icofont.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/slick.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css">

</head>


<body class="body__wrapper">
<!-- pre loader area start -->
<div id="back__preloader">
    <div id="back__circle_loader"></div>
    <div class="back__loader_logo">
        <img loading="lazy" src="{{asset('frontend')}}/img/pre.png" alt="Preload">
    </div>
</div>
<!-- pre loader area end -->


<main class="main_wrapper overflow-hidden">


@include('Frontend.includes.header')

    <!-- theme fixed shadow -->
    <div>
        <div class="theme__shadow__circle"></div>
        <div class="theme__shadow__circle shadow__right"></div>
    </div>
    <!-- theme fixed shadow -->


    @yield('content')
    
    @include('Frontend.includes.footer')

    
</main>





<!-- JS here -->
<script src="{{asset('frontend')}}/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="{{asset('frontend')}}/js/vendor/jquery-3.6.0.min.js"></script>
<script src="{{asset('frontend')}}/js/popper.min.js"></script>
<script src="{{asset('frontend')}}/js/bootstrap.min.js"></script>
<script src="{{asset('frontend')}}/js/isotope.pkgd.min.js"></script>
<script src="{{asset('frontend')}}/js/slick.min.js"></script>
<script src="{{asset('frontend')}}/js/jquery.meanmenu.min.js"></script>
<script src="{{asset('frontend')}}/js/ajax-form.js"></script>
<script src="{{asset('frontend')}}/js/wow.min.js"></script>
<script src="{{asset('frontend')}}/js/jquery.scrollUp.min.js"></script>
<script src="{{asset('frontend')}}/js/imagesloaded.pkgd.min.js"></script>
<script src="{{asset('frontend')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('frontend')}}/js/waypoints.min.js"></script>
<script src="{{asset('frontend')}}/js/jquery.counterup.min.js"></script>
<script src="{{asset('frontend')}}/js/plugins.js"></script>
<script src="{{asset('frontend')}}/js/swiper-bundle.min.js"></script>
<script src="{{asset('frontend')}}/js/main.js"></script>




</body>
</html>