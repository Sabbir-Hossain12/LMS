@extends('Frontend.layouts.master')

@section('content')


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
                                    <h5 class="login__title">Login</h5>
                                </div>
                                
                                <form action="#">
                                    <div class="login__form">
                                        <label class="form__label">Phone Number</label>
                                        <input class="common__login__input" type="text" placeholder="01*********">
                                    </div>
                                    <div class="login__button">
                                        <a class="default__button" href="#">Submit</a>
                                    </div>
                                </form>

{{--                                <div class="login__social__option">--}}
{{--                                    <p>or Log-in with</p>--}}

{{--                                    <ul class="login__social__btn">--}}
{{--                                        <li><a class="default__button login__button__1" href="#"><i--}}
{{--                                                        class="icofont-facebook"></i> Facebook</a></li>--}}
{{--                                        <li><a class="default__button" href="#"><i class="icofont-google-plus"></i>--}}
{{--                                                Google</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="projects__two" role="tabpanel" aria-labelledby="projects__two">
                        <div class="col-xl-8 offset-md-2">
                            <div class="loginarea__wraper">
                                <div class="login__heading">
                                    <h5 class="login__title">Sign Up</h5>
                                    <p class="login__description">Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Log In</a></p>
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