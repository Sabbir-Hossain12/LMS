@extends('Frontend.layouts.master')

@section('content')

    <!-- breadcrumbarea__section__start -->

    <div class="breadcrumbarea" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__content__wraper">
                        <div class="breadcrumb__title">
                            <h2 class="heading">About Page</h2>
                        </div>
                        <div class="breadcrumb__inner">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li> About Page</li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="shape__icon__2">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__1" src="{{asset('frontend')}}/img/herobanner/herobanner__1.png" alt="photo">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__2" src="{{asset('frontend')}}/img/herobanner/herobanner__2.png" alt="photo">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__3" src="{{asset('frontend')}}/img/herobanner/herobanner__3.png" alt="photo">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__4" src="{{asset('frontend')}}/img/herobanner/herobanner__5.png" alt="photo">
        </div>

    </div>
    <!-- breadcrumbarea__section__end-->

    <!-- aboutarea__5__section__start -->
    <div class="aboutarea__5 sp_bottom_100 sp_top_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6" data-aos="fade-up">
                    <div class="aboutarea__5__img" data-tilt>
                        <img loading="lazy"  src="{{asset( 'frontend/img/about/about_14.png')}}" alt="about">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6" data-aos="fade-up">
                    <div class="aboutarea__content__wraper__5">
                        <div class="section__title">
                            <div class="section__title__button">
                                <div class="default__small__button">About us</div>
                            </div>
                            <div class="section__title__heading ">
                                <h2>{{$content->title ?? ''}}</h2>
                            </div>
                        </div>
{{--                        <div class="about__text__5">--}}
{{--                            <p>Meet my startup design agency Shape Rex Currently I am working at CodeNext as Product Designer.</p>--}}
{{--                        </div>--}}

                        <div class="aboutarea__5__small__icon__wraper">
                            <div class="aboutarea__5__small__icon">
                                <img loading="lazy"  src="{{asset('frontend/img/about/about_15.png')}}" alt="about">

                            </div>
                            <div class="aboutarea__small__heading">
                                {{$content->short_desc ?? ''}}
                            </div>

                        </div>




                        <div class="aboutarea__para__5">
                          {!! $content->long_desc ?? '' !!}
                        </div>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- aboutarea__5__section__end -->

@endsection