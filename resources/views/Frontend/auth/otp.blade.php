@extends('Frontend.layouts.master')

@section('content')
    {{--    <!-- breadcrumbarea__section__start -->--}}

    {{--    <div class="breadcrumbarea">--}}

    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-xl-12">--}}
    {{--                    <div class="breadcrumb__content__wraper" data-aos="fade-up">--}}
    {{--                        <div class="breadcrumb__title">--}}
    {{--                            <h2 class="heading">Log In</h2>--}}
    {{--                        </div>--}}
    {{--                        <div class="breadcrumb__inner">--}}
    {{--                            <ul>--}}
    {{--                                <li><a href="index.html">Home</a></li>--}}
    {{--                                <li>Log In</li>--}}
    {{--                            </ul>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}


    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="shape__icon__2">--}}
    {{--            <img loading="lazy" class=" shape__icon__img shape__icon__img__1" src="{{asset('frontend')}}/img/herobanner/herobanner__1.png"--}}
    {{--                 alt="photo">--}}
    {{--            <img loading="lazy" class=" shape__icon__img shape__icon__img__2" src="{{asset('frontend')}}/img/herobanner/herobanner__2.png"--}}
    {{--                 alt="photo">--}}
    {{--            <img loading="lazy" class=" shape__icon__img shape__icon__img__3" src="{{asset('frontend')}}/img/herobanner/herobanner__3.png"--}}
    {{--                 alt="photo">--}}
    {{--            <img loading="lazy" class=" shape__icon__img shape__icon__img__4" src="{{asset('frontend')}}/img/herobanner/herobanner__5.png"--}}
    {{--                 alt="photo">--}}
    {{--        </div>--}}

    {{--    </div>--}}
    {{--    <!-- breadcrumbarea__section__end-->--}}

    <!-- login__section__start -->
    <div class="loginarea sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">



                <div class="tab-content tab__content__wrapper" id="myTabContent" data-aos="fade-up">

                    <div class="tab-pane fade active show" id="projects__one" role="tabpanel"
                         aria-labelledby="projects__one">
                        <div class="col-xl-8 col-md-8 offset-md-2">
                            <div class="loginarea__wraper">
                                <div class="login__heading">
                                    <h5 class="login__title">Please Enter the 4 Digit OTP</h5>
                                </div>


                                <form action="#">
                                    <div class="login__form">
                                        <label class="form__label">OTP</label>
                                        <input class="common__login__input" type="text"
                                               placeholder="******">

                                    </div>
                                    {{--                                    <div class="login__form">--}}
                                    {{--                                        <label class="form__label">Password</label>--}}
                                    {{--                                        <input class="common__login__input" type="password" placeholder="Password">--}}

                                    {{--                                    </div>--}}
                                    <div class="login__form d-flex justify-content-between flex-wrap gap-2">
                                        {{--                                        <div class="form__check">--}}
                                        {{--                                            <input id="forgot" type="checkbox">--}}
                                        {{--                                            <label for="forgot"> Remember me</label>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="text-end login__form__link">--}}
                                        {{--                                            <a href="#">Forgot your password?</a>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <div class="login__button">
                                        <a class="default__button" href="#">Submit</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="projects__two" role="tabpanel" aria-labelledby="projects__two">
                        <div class="col-xl-8 offset-md-2">
                            <div class="loginarea__wraper">
                                <div class="login__heading">
                                    <h5 class="login__title">Sign Up</h5>
                                    <p class="login__description">Already have an account? <a href="#"
                                                                                              data-bs-toggle="modal"
                                                                                              data-bs-target="#registerModal">Log In</a></p>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

            <div class=" login__shape__img educationarea__shape_image">
                <img loading="lazy" class="hero__shape hero__shape__1" src="{{asset('frontend')}}/img/education/hero_shape2.png" alt="Shape">
                <img loading="lazy" class="hero__shape hero__shape__2" src="{{asset('frontend')}}/img/education/hero_shape3.png" alt="Shape">
                <img loading="lazy" class="hero__shape hero__shape__3" src="{{asset('frontend')}}/img/education/hero_shape4.png" alt="Shape">
                <img loading="lazy" class="hero__shape hero__shape__4" src="{{asset('frontend')}}/img/education/hero_shape5.png" alt="Shape">
            </div>


        </div>
    </div>

    <!-- login__section__end -->
@endsection