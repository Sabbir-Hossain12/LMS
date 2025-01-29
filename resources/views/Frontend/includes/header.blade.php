<style>
    
    #active-nav
    {
      color: #0d6efd;
    }
    
    .headerarea__2__input input
    {
        color: #eae0e0 !important;
        display: flex;
    }
</style>

<!-- topbar__section__stert -->
<div class="topbararea topbararea--2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="topbar__left">
                    <ul>
                        <li>
                            Call Us: {{$basicInfo->phone_1 ?? '+880'}}
                        </li>
                        <li>
                            - Mail Us: {{$basicInfo->mail ?? 'contact@gmail.com'}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="topbar__right">
                    <div class="topbar__icon">
                        <i class="icofont-location-pin"></i>
                    </div>
                    <div class="topbar__text">
                        <p>{{$basicInfo->address ?? 'Dhaka, Bangladesh'}}</p>
                    </div>
                    <div class="topbar__list">
                        <ul>
                            <li>
                                <a href="{{$basicInfo->fb_link ?? '#'}}"><i class="icofont-facebook"></i></a>
                            </li>
                            <li>
                                <a href="{{$basicInfo->twitter_link ?? '#'}}"><i class="icofont-twitter"></i></a>
                            </li>
                            <li>
                                <a href="{{$basicInfo->insta_link ?? '#'}}"><i class="icofont-instagram"></i></a>
                            </li>
                            <li>
                                <a href="{{$basicInfo->youtube_link ?? '#'}}"><i class="icofont-youtube-play"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- topbar__section__end -->


<!-- headar section start -->
<header>
    <div class="headerarea headerarea__2  header__area">
        <div class="container desktop__menu__wrapper">

            <div class="row headerarea__search__wrap align-items-center">
                <div class="col-xl-3 col-lg-3">

                    <div class="headerarea__2__inner justify-content-center">
                        <div class="headerarea__left">
                            <div class="headerarea__left__logo" style="height: 55px;">
{{--                                <h3 class="text-white">Danpite Tech</h3>--}}
                                   <a href="{{route('home')}}">
                                       <img loading="lazy" src="{{asset($basicInfo->light_logo)}}" width="187px" height="48px" alt="logo">
                                   </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <form action="{{route('search-results')}}">
                        @csrf
                    <div class="headerarea__2__input d-flex">
                        <input type="text" placeholder="Search Course" name="content" required>
                        <button class="btn btn-primary" type="submit" ><i class="icofont-search-1"></i></button>
                    </div>
                    </form>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="headerarea__right">

                        <div class="headerarea__button me-2">
                            <a href="#">Get Start Here</a>
                        </div>

                        @auth
                            @if(auth()->user()->hasRole('student'))
                                <div class="headerarea__login">
                                    <a href="{{ route('student.dashboard.index') }}"><i class="icofont-home"></i></a>
                                </div>
                            @else
                                <div class="headerarea__login">
                                    <a href="{{ route('student.phone-page') }}"><i class="icofont-user-alt-5"></i></a>
                                </div>
                            @endif
                        @else
                            <div class="headerarea__login">
                                <a href="{{ route('student.phone-page') }}"><i class="icofont-user-alt-5"></i></a>
                            </div>
                        @endauth
                        
                       

                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-xl-12 col-lg-12 main_menu_wrap">
                    <div class="headerarea__main__menu">
                        <nav>
                            <ul>
                                
                                <li>
                                    <a class="headerarea__has__dropdown" id="{{Route::is('home') ? 'active-nav' : ''}}"  href="{{url('/')}}">Home
                                    </a>
                                </li>
                                
{{--                                <li>--}}
{{--                                    <a class="headerarea__has__dropdown" href="{{route('class-list')}}">Categories--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                                
                                <li>
                                    <a class="headerarea__has__dropdown" id="{{Route::is('course-list') ? 'active-nav' : ''}}" href="{{route('course-list')}}">Courses
                                    </a>
                                </li>
                                
                                <li>
                                    <a class="headerarea__has__dropdown" id="{{Route::is('teacher.page') ? 'active-nav' : ''}}" href="{{route('teacher.page')}}">Teachers
                                    </a>
                                </li>

                                <li>
                                    <a class="headerarea__has__dropdown" id="{{Route::is('ai-assistant') ? 'active-nav' : ''}}" href="{{route('ai-assistant')}}">AI Assistant</a>
                                </li>

                                <li>
                                    <a class="headerarea__has__dropdown" id="{{Route::is('blog-list') ? 'active-nav' : ''}}" href="{{route('blog-list')}}">Blogs
                                    </a>
                                </li>
                                
{{--                                <li>--}}
{{--                                    <a class="headerarea__has__dropdown" href="#">AI Assistant--}}
{{--                                    </a>--}}
{{--                                </li>--}}

                                <li>
                                    <a class="headerarea__has__dropdown" href="{{route('page','about-us')}}">About Us
                                    </a>
                                </li>
                                
{{--                                <li>--}}
{{--                                    <a class="headerarea__has__dropdown" href="#">Others--}}
{{--                                        <i class="icofont-rounded-down"></i>--}}
{{--                                    </a>--}}
{{--                                    <ul class="headerarea__submenu">--}}
{{--                                        <li><a href="#">About us</a></li>--}}
{{--                                        <li><a href="#">Contact Us</a></li>--}}
{{--                                        <li><a href="#">Blogs</a></li>--}}
{{--                                        <li><a href="#">Terms & Condition</a></li>--}}
{{--                                        <li><a href="#">Privacy Policy</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
                                
                            </ul>
                        </nav>
                    </div>
                </div>


            </div>

        </div>

        
    </div>

    <div class="headerarea headerarea__2  header__sticky header__area">
        


        <div class="container-fluid mob_menu_wrapper">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="mobile-logo">
                        <a class="logo__dark" href="{{route('home')}}"><img loading="lazy" src="{{asset($basicInfo->light_logo ?? 'frontend/img/logo/logo_1.png')}}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-right-wrap">
                        

                        <div class="mobile-off-canvas">
                            <a class="mobile-aside-button" href="#"><i class="icofont-navigation-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header section end -->

<!-- Mobile Menu Start Here -->
<div class="mobile-off-canvas-active">
    <a class="mobile-aside-close"><i class="icofont  icofont-close-line"></i></a>
    <div class="header-mobile-aside-wrap">
{{--        <div class="mobile-search">--}}
{{--            <form class="search-form" action="#">--}}
{{--                <input type="text" placeholder="Search entire store…">--}}
{{--                <button class="button-search"><i class="icofont icofont-search-2"></i></button>--}}
{{--            </form>--}}
{{--        </div>--}}
        <div class="mobile-menu-wrap headerarea">

            <div class="mobile-navigation">

                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children">
                            <a href="{{route('home')}}">Home</a>
                        </li>


                        <li class="menu-item-has-children">
                            <a href="{{route('course-list')}}">Courses</a>
                        </li>

                        
                        <li class="menu-item-has-children "><a href="{{route('teacher.page')}}">Teachers</a>
                            
                        </li>
                        
                        <li class="menu-item-has-children ">
                            <a href="{{route('blog-list')}}">Blogs</a>
                        </li>

                        <li class="menu-item-has-children ">
                            <a href="{{route('ai-assistant')}}">AI Assistant</a>
                        </li>

                        <li class="menu-item-has-children"><a href="{{route('page','about-us')}}">About Us</a>
                            
                        </li>

                    </ul>
                </nav>

            </div>

        </div>
        <div class="mobile-curr-lang-wrap">
            <div class="single-mobile-curr-lang">
                <a class="mobile-account-active" href="#">My Account <i class="icofont-thin-down"></i></a>
                <div class="lang-curr-dropdown account-dropdown-active">
                    <ul class="mobile-menu">
                        @auth
                            @if(auth()->user()->hasRole('student'))
                                <li>
                                    <a href="{{ route('student.dashboard.index') }}">My Account</i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('student.phone-page') }}">Login/Registration</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a href="{{ route('student.phone-page') }}">Login/ Registration</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="mobile-social-wrap">
            <a class="facebook" href="{{$basicInfo->fb_link ?? '#'}}"><i class="icofont icofont-facebook"></i></a>
            <a class="twitter" href="{{$basicInfo->twitter_link ?? '#'}}"><i class="icofont icofont-twitter"></i></a>
            <a class="instagram" href="{{$basicInfo->insta_link ?? '#'}}"><i class="icofont icofont-instagram"></i></a>
            <a class="google" href="{{$basicInfo->youtube_link ?? '#'}}"><i class="icofont icofont-youtube-play"></i></a>
        </div>
        
    </div>
</div>
<!-- Mobile Menu end Here -->