<!doctype html>
<html class="no-js is_dark" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <!--SEO-->
    <title>{{$basicInfo->meta_title ?? 'schoolmathematics'}} </title>
    <meta name="description" content="{{$basicInfo->meta_desc ?? ''}}">
    <meta name="keywords" content="{{$basicInfo->meta_keyword ?? ''}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">


 <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:title" content="{{$basicInfo->meta_title ?? 'schoolmathematics'}}">
    <meta property="og:description" content="{{$basicInfo->meta_desc ?? ''}}">
    
    @if($basicInfo->meta_image)
    <meta property="og:image" content="{{asset($basicInfo->meta_image)}}">
    @endif
    
    <meta property="og:url" content="https://schoolmathematics.com.bd/">
    <meta property="og:type" content="website">
    
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$basicInfo->meta_title ?? 'schoolmathematics'}}">
    <meta name="twitter:description" content="{{$basicInfo->meta_desc ?? ''}}">
    @if($basicInfo->meta_image)
    <meta name="twitter:image" content="{{asset($basicInfo->meta_image)}}">
    @endif
    
    <!--Fav Icon-->
       <link rel="shortcut icon" type="image/x-icon" href="{{asset($basicInfo->fav_icon ?? 'frontend/img/favicon.ico')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/animate.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/aos.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/icofont.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/slick.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/plugins_plyr.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/progress.css">
    <link href="{{asset('frontend')}}/css/toastify.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    
    {{-- tostr.js--}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    


    @stack('css')
</head>


<body class="body__wrapper" @yield('context')>
<!-- pre loader area start -->
{{--<div id="back__preloader">--}}
{{--    <div id="back__circle_loader"></div>--}}
{{--    <div class="back__loader_logo">--}}
{{--        <img loading="lazy" src="{{asset('frontend')}}/img/pre.png" alt="Preload">--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- pre loader area end -->--}}
<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

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
<script src="{{asset('frontend')}}/js/plugin_plyr.js" ></script>
<script src="{{asset('frontend')}}/js/main.js"></script>
<script src="{{asset('frontend')}}/js/toastify-js.js"></script>
<script src="{{asset('frontend')}}/js/config.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{--toastr.js--}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('success'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("{{ session('success') }}");
    @endif

        @if (Session::has('error'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

        @if (Session::has('info'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.info("{{ session('info') }}");
    @endif

        @if (Session::has('warning'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>

@stack('js')

</body>
</html>