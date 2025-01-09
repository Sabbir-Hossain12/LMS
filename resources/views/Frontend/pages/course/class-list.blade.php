@extends('Frontend.layouts.master')

@section('content')
    <div class="mt-4">

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__content__wraper aos-init aos-animate" data-aos="fade-up">
                        <div class="breadcrumb__title">
                            <h2 class="heading">Courses List</h2>
                        </div>
                        <div class="breadcrumb__inner">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li>Courses List</li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="shape__icon__2">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__1" src="{{asset('frontend')}}/img/herobanner/herobanner__1.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__2" src="{{asset('frontend')}}/img/herobanner/herobanner__2.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__3" src="{{asset('frontend')}}/img/herobanner/herobanner__3.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__4" src="{{asset('frontend')}}/img/herobanner/herobanner__5.png" alt="photo">
        </div>

    </div>

    <div class="coursearea sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
                {{--            <div class="col-xl-12">--}}
                {{--                <div class="course__text__wraper aos-init aos-animate" data-aos="fade-up">--}}
                {{--                    <div class="course__text">--}}
                {{--                        <p>Showing 1–12 of 54 Results</p>--}}
                {{--                    </div>--}}
                {{--                    <div class="course__icon">--}}
                {{--                        <ul class="nav property__team__tap" id="myTab" role="tablist">--}}
                {{--                            <li class="nav-item" role="presentation">--}}
                {{--                                <a href="#" class="single__tab__link active" data-bs-toggle="tab" data-bs-target="#projects__one" aria-selected="true" role="tab"><i class="icofont-layout"></i>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li class="nav-item" role="presentation">--}}
                {{--                                <a href="#" class="single__tab__link" data-bs-toggle="tab" data-bs-target="#projects__two" aria-selected="false" role="tab" tabindex="-1"><i class="icofont-listine-dots"></i>--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li class="short__by__new">--}}
                {{--                                <select class="form-select" aria-label="Default select example">--}}
                {{--                                    <option selected="">  Short by New</option>--}}
                {{--                                    <option value="1">One</option>--}}
                {{--                                    <option value="2">Two</option>--}}
                {{--                                    <option value="3">Three</option>--}}
                {{--                                </select>--}}
                {{--                            </li>--}}

                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--            </div>--}}

                <div class="col-xl-12">

                    <div class="tab-content tab__content__wrapper" id="myTabContent">


                        <div class="tab-pane fade active show" id="projects__one" role="tabpanel" aria-labelledby="projects__one">

                            <div class="row">
                                @forelse($classes as $class)
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 aos-init aos-animate" data-aos="fade-up">
                                        <div class="gridarea__wraper gridarea__wraper__2">
{{--                                            <div class="gridarea__img">--}}
{{--                                                <a href="{{route('course-details', $course->slug)}}"><img loading="lazy" src="{{asset($course->thumbnail_img)}}" alt="grid"></a>--}}
{{--                                                <div class="gridarea__small__button">--}}
{{--                                                    <div class="grid__badge">{{$course->class->title}}</div>--}}
{{--                                                </div>--}}
{{--                                                --}}
{{--                                                --}}{{--<div class="gridarea__small__icon">--}}
{{--                                                --}}{{--<a href="#"><i class="icofont-heart-alt"></i></a>--}}
{{--                                                --}}{{--</div>--}}

{{--                                            </div>--}}
                                            <div class="gridarea__content">
                                                <div class="gridarea__list">
                                                    
                                                    
                                                    <ul>
                                                        <li>
                                                            <i class="icofont-book-alt"></i> {{$course->lessons->count()}} Lesson
                                                        </li>
                                                        <li>
                                                            <i class="icofont-clock-time"></i> {{$course->duration}}
                                                        </li>
                                                    </ul>
                                                </div>
                                                
                                                
                                                <div class="gridarea__heading">
                                                    <h3><a href="{{route('course-details', $course->slug)}}">{{$course->title}}</a></h3>
                                                </div>
{{--                                                <div class="gridarea__price">--}}
{{--                                                    ৳ {{$course->sale_price}} <del>/ ৳ {{$course->regular_price}}</del>--}}
{{--                                                    @if($course->sale_price=0)--}}
{{--                                                        <span> Free</span>--}}

{{--                                                    @else--}}
{{--                                                        <span> <del class="del__2">Free</del></span>--}}
{{--                                                    @endif--}}


{{--                                                </div>--}}
{{--                                                <div class="gridarea__bottom">--}}

{{--                                                    <a href="{{route('teacher.details', $course->teacher->slug)}}">--}}
{{--                                                        <div class="gridarea__small__img">--}}
{{--                                                            <img loading="lazy" src="{{asset($course->teacher->profile_image ?? 'frontend/img/grid/grid_small_1.jpg')}}" alt="grid">--}}
{{--                                                            <div class="gridarea__small__content">--}}
{{--                                                                <h6>{{$course->teacher->name}}</h6>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </a>--}}

{{--                                                    --}}{{--                                            <div class="gridarea__star">--}}
{{--                                                    --}}{{--                                                <i class="icofont-star"></i>--}}
{{--                                                    --}}{{--                                                <i class="icofont-star"></i>--}}
{{--                                                    --}}{{--                                                <i class="icofont-star"></i>--}}
{{--                                                    --}}{{--                                                <i class="icofont-star"></i>--}}
{{--                                                    --}}{{--                                                <span>(44)</span>--}}
{{--                                                    --}}{{--                                            </div>--}}
{{--                                                </div>--}}

                                            </div>
                                        </div>
                                    </div>

                                @empty
                                @endforelse
                            </div>

                        </div>


                        {{--                    <div class="tab-pane fade" id="projects__two" role="tabpanel" aria-labelledby="projects__two">--}}

                        {{--                        <div class="gridarea__wraper gridarea__wraper__2 gridarea__course__list aos-init aos-animate" data-aos="fade-up">--}}
                        {{--                            <div class="gridarea__img">--}}
                        {{--                                <a href="course-details.html"><img loading="lazy" src="img/grid/grid_1.png" alt="grid"></a>--}}
                        {{--                                <div class="gridarea__small__button">--}}
                        {{--                                    <div class="grid__badge">Data &amp; Tech</div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="gridarea__small__icon">--}}
                        {{--                                    <a href="#"><i class="icofont-heart-alt"></i></a>--}}
                        {{--                                </div>--}}

                        {{--                            </div>--}}
                        {{--                            <div class="gridarea__content">--}}
                        {{--                                <div class="gridarea__list">--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li>--}}
                        {{--                                            <i class="icofont-book-alt"></i> 23 Lesson--}}
                        {{--                                        </li>--}}
                        {{--                                        <li>--}}
                        {{--                                            <i class="icofont-clock-time"></i> 1 hr 30 min--}}
                        {{--                                        </li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="gridarea__heading">--}}
                        {{--                                    <h3><a href="course-details.html">Become a product Manager learn the--}}
                        {{--                                            skills &amp; job.--}}
                        {{--                                        </a></h3>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="gridarea__price">--}}
                        {{--                                    $32.00 <del>/ $67.00</del>--}}
                        {{--                                    <span>Free.</span>--}}

                        {{--                                </div>--}}
                        {{--                                <div class="gridarea__bottom">--}}
                        {{--                                    <div class="gridarea__bottom__left">--}}
                        {{--                                        <a href="instructor-details.html">--}}
                        {{--                                            <div class="gridarea__small__img">--}}
                        {{--                                                <img loading="lazy" src="img/grid/grid_small_1.jpg" alt="grid">--}}
                        {{--                                                <div class="gridarea__small__content">--}}
                        {{--                                                    <h6>Mirnsdo .H</h6>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </a>--}}

                        {{--                                        <div class="gridarea__star">--}}
                        {{--                                            <i class="icofont-star"></i>--}}
                        {{--                                            <i class="icofont-star"></i>--}}
                        {{--                                            <i class="icofont-star"></i>--}}
                        {{--                                            <i class="icofont-star"></i>--}}
                        {{--                                            <span>(44)</span>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}

                        {{--                                    <div class="gridarea__details">--}}
                        {{--                                        <a href="course-details.html">Know Details--}}
                        {{--                                            <i class="icofont-arrow-right"></i>--}}
                        {{--                                        </a>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--              --}}

                        {{--                    </div>--}}

                    </div>



                </div>


                {{--            <div class="main__pagination__wrapper aos-init aos-animate" data-aos="fade-up">--}}
                {{--                <ul class="main__page__pagination">--}}
                {{--                    <li><a class="disable" href="#"><i class="icofont-double-left"></i></a></li>--}}
                {{--                    <li><a class="active" href="#">1</a></li>--}}
                {{--                    <li><a href="#">2</a></li>--}}
                {{--                    <li><a href="#">3</a></li>--}}
                {{--                    <li><a href="#"><i class="icofont-double-right"></i></a></li>--}}
                {{--                </ul>--}}
                {{--            </div>--}}

            </div>

        </div>
    </div>

@endsection

