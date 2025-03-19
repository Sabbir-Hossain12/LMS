@extends('Frontend.layouts.master')

@section('content')

    <div class="blogarea__2 sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8">

                    <div class="blogarae__img__2 course__details__img__2" data-aos="fade-up">
                        <img loading="lazy"
                             src="{{asset( $courseDetails->details_img ?? 'frontend/img/blog/blog_8.png')}}"
                             alt="blog">
                    </div>

                    <div class="blog__details__content__wraper">
                        <div class="course__button__wraper" data-aos="fade-up">
                            <!--<div class="course__button">-->
                            <!--    @forelse($courseDetails->subjects as $subject)-->
                            <!--        <a href="#">{{$subject->title}}</a>-->
                            <!--    @empty-->
                            <!--    @endforelse-->
                            <!--</div>-->
                            <div class="course__date">
                                <p>Last Update: <span>{{$courseDetails->updated_at->format('M d, Y')}}</span></p>
                            </div>
                        </div>
                        <div class="course__details__heading" data-aos="fade-up">
                            <h3>{{$courseDetails->title}}</h3>
                        </div>
                        <div class="course__details__price" data-aos="fade-up">
                            <ul>
                                <li>
                                    <div class="course__price">
                                        ৳{{$courseDetails->sale_price}}
                                        <del>/ ৳{{$courseDetails->regular_price}}</del>
                                    </div>
                                </li>
                                <li>
                                    <div class="course__details__date">
                                        <i class="icofont-book-alt"></i> {{$courseDetails->lessons->count()}} Lesson
                                    </div>

                                </li>
                                <li>
                                    <div class="course__star">
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <span>(44)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="course__details__paragraph" data-aos="fade-up">
                            <p>
                                {{$courseDetails->short_desc}}
                            </p>
                        </div>

                        <h4 class="sidebar__title" data-aos="fade-up">Course Details</h4>
                        <div class="course__details__wraper" data-aos="fade-up">

                            <ul>
                                <li>
                                    Instructor : <span> {{$courseDetails->teacher->name ?? ''}}</span>
                                </li>
                                <li>
                                    Lessons : <span> {{$courseDetails->lessons->count()}}  </span>
                                </li>
                                <li>
                                    Duration : <span>  {{$courseDetails->duration}}</span>
                                </li>
                                <li>
                                    Enrolled : <span>  2 students</span>
                                </li>
                            </ul>
                            <ul>

                                <li>
                                    Language : <span>Bangla</span>
                                </li>
                                <li>
                                    Regular Price : <span>{{$courseDetails->regular_price}}</span>
                                </li>
                                <li>
                                    Discount : <span>{{$courseDetails->discount}}</span>
                                </li>

                                <li>
                                    Course Status : <span>Available</span>
                                </li>
                            </ul>
                        </div>


                        <div class="course__details__tab__wrapper" data-aos="fade-up">
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="nav  course__tap__wrap" id="myTab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="single__tab__link active" data-bs-toggle="tab"
                                                    data-bs-target="#projects__two" type="button"><i
                                                        class="icofont-book-alt"></i>Curriculum
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="single__tab__link" data-bs-toggle="tab"
                                                    data-bs-target="#projects__one" type="button"><i
                                                        class="icofont-paper"></i>Description
                                            </button>
                                        </li>
                                        {{--                                        <li class="nav-item" role="presentation">--}}
                                        {{--                                            <button class="single__tab__link" data-bs-toggle="tab"--}}
                                        {{--                                                    data-bs-target="#projects__three" type="button"><i--}}
                                        {{--                                                        class="icofont-star"></i>Reviews--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </li>--}}
                                        {{--                                        <li class="nav-item" role="presentation">--}}
                                        {{--                                            <button class="single__tab__link" data-bs-toggle="tab"--}}
                                        {{--                                                    data-bs-target="#projects__four" type="button"><i--}}
                                        {{--                                                        class="icofont-teacher"></i>Instructor--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </li>--}}


                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content tab__content__wrapper" id="myTabContent">
                                <div class="tab-pane fade  active show" id="projects__two" role="tabpanel"
                                     aria-labelledby="projects__two">

                                     <div class="accordion content__cirriculum__wrap" id="accordionExample">
                                        @forelse($subjects as $subject)
                                            <div class="subject-wrapper">
                                                <!-- Subject header: clicking this toggles the lessons collapse -->
                                                <h1 class="accordion-header mb-2" id="headingSubject{{$subject->id}}">
                                                    <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseSubject{{$subject->id}}"
                                                            aria-expanded="false"
                                                            aria-controls="collapseSubject{{$subject->id}}">
                                                        {{$subject->title}}
                                                    </button>
                                                </h1>

                                                <!-- Collapse container for lessons under this subject -->
                                                <div id="collapseSubject{{$subject->id}}" class="accordion-collapse collapse"
                                                     aria-labelledby="headingSubject{{$subject->id}}" data-bs-parent="#accordionExample">

                                                    @forelse($subject->lessons as $key => $lesson)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingLesson{{$lesson->id}}">
                                                                <button class="accordion-button" type="button"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#collapseLesson{{$lesson->id}}"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapseLesson{{$lesson->id}}">
                                                                    {{$lesson->title}} <span>{{$lesson->duration}}</span>
                                                                </button>
                                                            </h2>
                                                            <div id="collapseLesson{{$lesson->id}}" class="accordion-collapse collapse"
                                                                 aria-labelledby="headingLesson{{$lesson->id}}" data-bs-parent="#collapseSubject{{$subject->id}}">
                                                                <div class="accordion-body">
                                                                    @if($lesson->lessonVideos->count() > 0)
                                                                        @forelse($lesson->lessonVideos as $key1=>$video)
                                                                            <div class="scc__wrap">
                                                                                <div class="scc__info">
                                                                                    <i class="icofont-video-alt"></i>
                                                                                    <h5>{{$video->title}}</h5>
                                                                                </div>
                                                                                <div class="scc__meta">
                                                <span class="time">
                                                    <i class="icofont-clock-time"></i> {{$video->duration}}
                                                </span>
                                                                                    <a href="#"><span class="question"><i class="icofont-eye"></i></span></a>
                                                                                </div>
                                                                            </div>
                                                                        @empty
                                                                            <!-- Optionally show a message if no videos are available -->
                                                                        @endforelse
                                                                    @endif

                                                                    @if($lesson->assessments->count() > 0)
                                                                        @forelse($lesson->assessments as $key2=>$assessment)
                                                                            <div class="scc__wrap">
                                                                                <div class="scc__info">
                                                                                    <i class="icofont-file-text"></i>
                                                                                    <h5>
                                                                                        <span>{{$assessment->title}}</span>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="scc__meta">
                                                                                    <span><i class="icofont-lock"></i></span>
                                                                                </div>
                                                                            </div>
                                                                        @empty
                                                                            <!-- Optionally show a message if no assessments are available -->
                                                                        @endforelse
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p>No Lesson Yet</p>
                                                    @endforelse

                                                </div>
                                            </div>
                                        @empty
                                            <p>No Subject Yet</p>
                                        @endforelse
                                    </div>


                                </div>

                                <div class="tab-pane fade" id="projects__one" role="tabpanel"
                                     aria-labelledby="projects__one">

                                    {!! $courseDetails->long_desc !!}

                                </div>


                                <div class="tab-pane fade" id="projects__four" role="tabpanel"
                                     aria-labelledby="projects__four">
                                    <div class="blogsidebar__content__wraper__2 tab__instructor">
                                        <div class="blogsidebar__content__inner__2">
                                            <div class="blogsidebar__img__2">
                                                <img loading="lazy"
                                                     src="{{asset($courseDetails->teacher->profile_image)}}"
                                                     height="96px" width="96px" alt="blog">

                                            </div>

                                            <div class="tab__instructor__inner">
                                                <div class="blogsidebar__name__2">
                                                    <h5>
                                                        <a href="#"> {{$courseDetails->teacher->name}}</a>

                                                    </h5>
                                                    <p>{{$courseDetails->teacher->instructor_title}}</p>
                                                </div>
                                                <div class="blog__sidebar__text__2">
                                                    <p>{{$courseDetails->teacher->short_desc}}</p>
                                                </div>
                                                <div class="blogsidbar__icon__2">
                                                    <ul>
                                                        <li>
                                                            <a href="{{$courseDetails->teacher->fb_link ?? '#'}}"><i
                                                                        class="icofont-facebook"></i></a>
                                                        </li>

                                                        <li>
                                                            <a href="{{$courseDetails->teacher->youtube_link ?? '#'}}"><i
                                                                        class="icofont-youtube-play"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{$courseDetails->teacher->insta_link ?? '#'}}"><i
                                                                        class="icofont-instagram"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{$courseDetails->teacher->twitter_link ?? '#'}}"><i
                                                                        class="icofont-twitter"></i></a>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="blog__details__tag" data-aos="fade-up">
                            <ul>

                                <li class="heading__tag">
                                    Subjects:
                                </li>
                                @forelse($courseDetails->subjects as $key=> $subject)
                                    <li>
                                        <a href="#"> {{$subject->title}}</a>
                                    </li>
                                @empty
                                @endforelse

                            </ul>
                            <ul class="share__list">
                                <li class="heading__tag">
                                    Share
                                </li>
                                <li>
                                    <a href="#"><i class="icofont-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icofont-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icofont-instagram"></i></a>
                                </li>
                            </ul>
                        </div>


                        {{--                        <div class="online__course__wrap">--}}
                        {{--                            <div class="instructor__heading__2" data-aos="fade-up">--}}
                        {{--                                <h3>Author More Courses</h3>--}}
                        {{--                                <a href="#">More Courses...</a>--}}
                        {{--                            </div>--}}

                        {{--                            <div class="row instructor__slider__active row__custom__class" data-aos="fade-up">--}}
                        {{--                                @forelse($relatedCourses as $key=> $course)--}}
                        {{--                                    <div class="col-xl-6 column__custom__class">--}}
                        {{--                                        <div class="gridarea__wraper">--}}
                        {{--                                            <div class="gridarea__img">--}}

                        {{--                                                <a href="{{route('course-details', $course->slug)}}"><img loading="lazy"--}}
                        {{--                                                                                                          src="{{asset($course->thumbnail_img)}}"--}}
                        {{--                                                                                                          width="252px"--}}
                        {{--                                                                                                          height="158px"--}}
                        {{--                                                                                                          alt="grid"></a>--}}
                        {{--                                                <div class="gridarea__small__button gridarea__small__button__1">--}}
                        {{--                                                    <div class="grid__badge">{{$course->class->title}}</div>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="gridarea__small__icon">--}}
                        {{--                                                    <a href="#"><i class="icofont-heart-alt"></i></a>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}

                        {{--                                            <div class="gridarea__content">--}}
                        {{--                                                <div class="gridarea__list">--}}
                        {{--                                                    <ul>--}}
                        {{--                                                        <li>--}}
                        {{--                                                            <i class="icofont-book-alt"></i> {{$course->lessons->count()}}--}}
                        {{--                                                            Lessons--}}
                        {{--                                                        </li>--}}

                        {{--                                                        <li>--}}
                        {{--                                                            <i class="icofont-clock-time"></i> {{$course->duration}}--}}
                        {{--                                                        </li>--}}
                        {{--                                                    </ul>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="gridarea__heading">--}}
                        {{--                                                    <h3>--}}
                        {{--                                                        <a href="{{route('course-details', $course->slug)}}">{{$course->title}}</a>--}}
                        {{--                                                    </h3>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="gridarea__price">--}}
                        {{--                                                    ৳ {{$course->sale_price}}--}}
                        {{--                                                    <del>/ ৳ {{$course->regular_price}}</del>--}}
                        {{--                                                    @if($course->sale_price=0)--}}
                        {{--                                                        <span> Free</span>--}}

                        {{--                                                    @else--}}
                        {{--                                                        <span> <del class="del__2">Free</del></span>--}}
                        {{--                                                    @endif--}}


                        {{--                                                </div>--}}
                        {{--                                                <div class="gridarea__bottom">--}}

                        {{--                                                    <a href="#">--}}
                        {{--                                                        <div class="gridarea__small__img">--}}
                        {{--                                                            <img loading="lazy"--}}
                        {{--                                                                 src="{{asset($course->teacher->profile_image ?? 'frontend/img/grid/grid_small_1.jpg')}}"--}}
                        {{--                                                                 alt="grid">--}}
                        {{--                                                            <div class="gridarea__small__content">--}}
                        {{--                                                                <h6>{{$course->teacher->name}}</h6>--}}
                        {{--                                                            </div>--}}
                        {{--                                                        </div>--}}
                        {{--                                                    </a>--}}

                        {{--                                                    <div class="gridarea__star">--}}
                        {{--                                                        <i class="icofont-star"></i>--}}
                        {{--                                                        <i class="icofont-star"></i>--}}
                        {{--                                                        <i class="icofont-star"></i>--}}
                        {{--                                                        <i class="icofont-star"></i>--}}
                        {{--                                                        <i class="icofont-star"></i>--}}
                        {{--                                                        <span>(44)</span>--}}
                        {{--                                                    </div>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                @empty--}}
                        {{--                                @endforelse--}}

                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">

                    <div class="course__details__sidebar">
                        <div class="event__sidebar__wraper" data-aos="fade-up">


                            <div class="blogsidebar__content__wraper__2 aos-init aos-animate" data-aos="fade-up">
                                <div class="blogsidebar__content__inner__2">
                                    <div class="blogsidebar__img__2">
                                        <img loading="lazy" src="{{asset($courseDetails->teacher->profile_image)}}"
                                             height="96px" width="96px" alt="blog">
                                    </div>

                                    <div class="blogsidebar__name__2">
                                        <h5>
                                            <a href="#"> {{$courseDetails->teacher->name}}</a>

                                        </h5>
                                        <p>{{$courseDetails->teacher->instructor_title}}</p>
                                    </div>

                                    <div class="blog__sidebar__text__2">
                                        <p>{{$courseDetails->teacher->short_desc}}</p>
                                    </div>
                                    <div class="blogsidbar__icon__2">
                                        <ul>
                                            <li>
                                                <a href="{{$courseDetails->teacher->fb_link ?? '#'}}"><i
                                                            class="icofont-facebook"></i></a>
                                            </li>

                                            <li>
                                                <a href="{{$courseDetails->teacher->youtube_link ?? '#'}}"><i
                                                            class="icofont-youtube-play"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{$courseDetails->teacher->insta_link ?? '#'}}"><i
                                                            class="icofont-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="{{$courseDetails->teacher->twitter_link ?? '#'}}"><i
                                                            class="icofont-twitter"></i></a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <div class="event__price__wraper">

                                <div class="event__price">
                                    {{$basicInfo->currency_symbol}}{{$courseDetails->sale_price}}
                                    <del>/ {{$basicInfo->currency_symbol}}{{$courseDetails->regular_price}}</del>
                                </div>
                                <div class="event__Price__button">
                                    <a href="#">{{$basicInfo->currency_symbol}}{{$courseDetails->discount}} OFF</a>
                                </div>
                            </div>

                            <div class="course__summery__button">
                                @if($enrollment)

                                    <a class="default__button" href="{{route('course-lessons', $courseDetails->slug)}}">Continue</a>
                                    
                                    @else
                                    <a class="default__button" href="{{route('course-lessons', $courseDetails->slug)}}">Try
                                        For Free</a>
                                        
                                        @if($courseDetails->sale_price == 0)
                                            <a class="default__button default__button--2" href="{{route('checkout', $courseDetails->slug)}}">Buy Now</a>
                                            
                                            @else
                                    
                                            <img class="img-fluid" src="{{asset('payment.jpg')}}" />
                                            @endif
                                @endif
                                
                               
                                <span>
                                        <i class="icofont-ui-rotation"></i>
{{--                                        45-Days Money-Back Guarantee--}}
                                    </span>
                            </div>

                            <div class="course__summery__lists">
                                <ul>
                                    <li>

                                        <div class="course__summery__item">
                                            
                                            <span class="sb_label">Instructor:
                                            </span><span class="sb_content"><a
                                                        href="">{{$courseDetails->teacher->name}}</a>
                                            </span>
                                        </div>

                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Start Date</span><span
                                                    class="sb_content">{{$courseDetails->created_at->format('d, M Y')}}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Total Duration</span><span
                                                    class="sb_content">{{$courseDetails->duration}}</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Enrolled</span><span class="sb_content">100</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Lessons</span><span
                                                    class="sb_content">{{$courseDetails->lessons->count()}}</span>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Quiz</span><span class="sb_content">@if($courseDetails->is_exam == 1)
                                                    Yes
                                                @else
                                                    No
                                                @endif</span>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="course__summery__item">
                                            <span class="sb_label">Certificate</span><span class="sb_content">@if($courseDetails->is_certificate == 1)
                                                    Yes
                                                @else
                                                    No
                                                @endif</span>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="course__summery__button">
                                <p>More inquery about course.</p>
                                <a class="default__button default__button--3" href="tel:+88{{$basicInfo->phone_1}}"><i
                                            class="icofont-phone"></i> {{$basicInfo->phone_1}}</a>
                            </div>


                        </div>


                        <div class="blogsidebar__content__wraper__2" data-aos="fade-up">

                            <h4 class="sidebar__title">Follow Us</h4>
                            <div class="follow__icon">
                                <ul>
                                    <li>
                                        <a href="{{$basicInfo->fb_link ?? '#'}}"><i class="icofont-facebook"></i></a>
                                    </li>

                                    <li>
                                        <a href="{{$basicInfo->youtube_link ?? '#'}}"><i
                                                    class="icofont-youtube-play"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{$basicInfo->insta_link ?? '#'}}"><i
                                                    class="icofont-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{$basicInfo->twitter_link ?? '#'}}"><i
                                                    class="icofont-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{$basicInfo->insta_link ?? '#'}}"><i
                                                    class="icofont-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        @if($popularCourses->count()>0)
                            <div class="blogsidebar__content__wraper__2" data-aos="fade-up">

                                <h4 class="sidebar__title">Populer Course</h4>
                                <ul class="course__details__populer__list">

                                    @forelse($popularCourses as $course)
                                        <li>

                                            <div class="course__details__populer__img">
                                                <img loading="lazy"
                                                     src="{{asset($course->thumbnail_img ?? 'frontend/img/blog-details/blog-details__6.png')}}"
                                                     alt="populer" width="91px" height="74px">
                                            </div>
                                            <div class="course__details__populer__content">
                                                <span>{{$basicInfo->currency_symbol}}{{$course->sale_price}}</span>
                                                <h6>
                                                    <a href="{{route('course-details', $course->slug ?? '#')}}">{{$course->title}}</a>

                                                </h6>
                                            </div>


                                        </li>
                                    @empty
                                    @endforelse

                                </ul>

                            </div>
                        @endif


                        <div class="blogsidebar__content__wraper__2" data-aos="fade-up">

                            <h4 class="sidebar__title">Popular tag</h4>
                            <div class="populer__tag__list">
                                <ul>
                                    @forelse($popularClasses as $class)
                                        <li><a href="#">{{$class->title}}</a></li>
                                    @empty
                                    @endforelse

                                </ul>
                            </div>

                        </div>


                    </div>

                </div>
            </div>


        </div>


    </div>

@endsection