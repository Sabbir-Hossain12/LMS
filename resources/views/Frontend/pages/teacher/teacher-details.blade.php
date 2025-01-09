@extends('Frontend.layouts.master')



@section('content')
    
    <!-- intructor__teacher__start -->
    <div class="instructor sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="instructor__sidebar" data-tilt>
                        <div class="instructor__sidebar__img" data-aos="fade-up">
                            <img loading="lazy"  src="{{asset($teacher->profile_image ??   'frontend/img/team/team__4.png')}}" alt="team">
                            <div class="instructor__sidebar__small__img">
                                <img loading="lazy"  src="{{asset('frontend')}}/img/about/about_4.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="instructor__inner__wraper">
                        <div class="instructor__list">
                            <ul>
                                <li data-aos="fade-up">
                                    <div class="instructor__heading">
                                        <h3>{{$teacher->name}}</h3>
                                        <p>{{$teacher->instructor_title}}</p>
                                    </div>
                                </li>

                                <li data-aos="fade-up">
                                    <div class="instructor__follow">
                                        <span>Follow Us:</span>
                                        <div class="instructor__icon">
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="icofont-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="icofont-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="icofont-instagram"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="icofont-youtube-play"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="instructor__content__wraper" data-aos="fade-up">
                            <h6>Short Bio</h6>
                            <p>{{$teacher->short_desc}}</p>
                        </div>
                        <div class="online__course__wrap">
                            <div class="instructor__heading__2" data-aos="fade-up">
                                <h3>Online Course</h3>
                            </div>

                            <div class="row instructor__slider__active row__custom__class" data-aos="fade-up">
                                
                                @forelse($relatedCourses as $key=> $course) 
                                <div class="col-xl-6 column__custom__class">
                                    <div class="gridarea__wraper">
                                        <div class="gridarea__img">

                                            <a href="{{route('course-details', $course->slug)}}"><img loading="lazy" src="{{asset($course->thumbnail_img)}}" alt="grid"></a>
                                            <div class="gridarea__small__button gridarea__small__button__1">
                                                <div class="grid__badge">{{$course->class->title}}</div>
                                            </div>
                                            {{--                                <div class="gridarea__small__icon">--}}
                                            {{--                                    <a href="#"><i class="icofont-heart-alt"></i></a>--}}
                                            {{--                                </div>--}}
                                        </div>

                                        <div class="gridarea__content">
                                            <div class="gridarea__list">
                                                <ul>
                                                    <li>
                                                        <i class="icofont-book-alt"></i> {{$course->lessons->count()}} Lessons
                                                    </li>

                                                    <li>
                                                        <i class="icofont-clock-time"></i> {{$course->duration}}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="gridarea__heading">
                                                <h3><a href="{{route('course-details', $course->slug)}}">{{$course->title}}</a></h3>
                                            </div>
                                            <div class="gridarea__price">
                                                ৳ {{$course->sale_price}} <del>/ ৳ {{$course->regular_price}}</del>
                                                @if($course->sale_price=0)
                                                    <span> Free</span>

                                                @else
                                                    <span> <del class="del__2">Free</del></span>
                                                @endif


                                            </div>
                                            <div class="gridarea__bottom">

                                                <a href="{{route('teacher.details', $course->teacher->slug)}}">
                                                    <div class="gridarea__small__img">
                                                        <img loading="lazy" src="{{asset($course->teacher->profile_image ?? 'frontend/img/grid/grid_small_1.jpg')}}"  alt="grid">
                                                        <div class="gridarea__small__content">
                                                            <h6>{{$course->teacher->name}}</h6>
                                                        </div>
                                                    </div>
                                                </a>

{{--                                                <div class="gridarea__star">--}}
{{--                                                    <i class="icofont-star"></i>--}}
{{--                                                    <i class="icofont-star"></i>--}}
{{--                                                    <i class="icofont-star"></i>--}}
{{--                                                    <i class="icofont-star"></i>--}}
{{--                                                    <i class="icofont-star"></i>--}}
{{--                                                    <span>(44)</span>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                               
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- intructor__teacher__end -->
    
@endsection