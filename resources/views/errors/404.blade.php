@extends('Frontend.layouts.master')

@section('content')

    <!-- error__section__start -->
    <div class="errorarea sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-sm-12 col-12 m-auto">
                    <div class="errorarea__inner" data-aos="fade-up">
                        <div class="error__img">
                            <img loading="lazy"  src="{{asset('frontend')}}/img/icon/error__1.png" alt="error">
                        </div>
                        <div class="error__text">
                            <h3>Oops... It looks like you ‘re lost !</h3>
                            <p>Oops! The page you are looking for does not exist. It might have been moved or deleted</p>
                        </div>
                        <div class="error__button">
                            <a class="default__button" href="{{url('/')}}">Back To Home
                                <i class="icofont-simple-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- error__section__end -->

@endsection