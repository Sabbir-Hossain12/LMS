@extends('Frontend.layouts.master')

@section('content')
    <style>
        @media only screen and (min-width: 767px) {
            .purchase-sec {
                display: none;
            }
        }
    </style>

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

                        <div class="course__summery__button purchase-sec">
                            @if($enrollment)

                                <a class="default__button" href="{{route('course-lessons', $courseDetails->slug)}}">Continue</a>

                            @else
                                <!--<a class="default__button" href="{{route('course-lessons', $courseDetails->slug)}}">Try-->
                                <!--    For Free</a>-->

                                @if($courseDetails->sale_price == 0)
                                    <a class="default__button default__button--2" onclick="addtocart()"
                                       href="{{route('checkout', $courseDetails->slug)}}">Buy Now</a>

                                @else
                                    <a class="default__button default__button--2" onclick="addtocart()"
                                       href="{{route('checkout', $courseDetails->slug)}}">Buy Now</a>
                                    @if($courseDetails->product_type == 'book')
                                        <a class="default__button default__button--1"
                                           href="javascript:void(0);">Add to Cart</a>
                                    @endif

                                    <!--<img class="img-fluid" src="{{asset('payment.jpg')}}" />-->
                                @endif
                            @endif


                            <span>
                                        <i class="icofont-ui-rotation"></i>
{{--                                        45-Days Money-Back Guarantee--}}
                                    </span>
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
                                @if($courseDetails->product_type == 'course')
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
                                @endif
                            </ul>
                        </div>
                        <div class="course__details__paragraph" data-aos="fade-up">
                            <p>
                                {{$courseDetails->short_desc}}
                            </p>
                        </div>

                        <h4 class="sidebar__title" data-aos="fade-up">Course Details</h4>

                        @if($courseDetails->product_type == 'course')
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
                                        Enrolled : <span> {{ $enrollmentCount ?? 100 }} </span>
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
                        @endif


                        <div class="course__details__tab__wrapper" data-aos="fade-up">
                            <div class="row">
                                <div class="col-xl-12">
                                    <ul class="nav  course__tap__wrap" id="myTab" role="tablist">

                                        @if($courseDetails->product_type == 'course')
                                            <li class="nav-item" role="presentation">
                                                <button class="single__tab__link active" data-bs-toggle="tab"
                                                        data-bs-target="#projects__two" type="button"><i
                                                            class="icofont-book-alt"></i>Curriculum
                                                </button>
                                            </li>

                                        @else
                                            @isset($courseDetails->demo_pdf)
                                                <li class="nav-item" role="presentation">
                                                    <button class="single__tab__link active" data-bs-toggle="tab"
                                                            data-bs-target="#projects__pdf" type="button"><i
                                                                class="icofont-book-alt"></i>Demo PDF
                                                    </button>
                                                </li>
                                            @endisset
                                        @endif

                                        <li class="nav-item" role="presentation">
                                            <button class="single__tab__link" data-bs-toggle="tab"
                                                    data-bs-target="#projects__one" type="button"><i
                                                        class="icofont-paper"></i>Description
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content tab__content__wrapper" id="myTabContent">

                                <div class="tab-pane fade" id="projects__one" role="tabpanel"
                                     aria-labelledby="projects__one">

                                    {!! $courseDetails->long_desc !!}

                                </div>

                                @if($courseDetails->product_type == 'course')
                                    <div class="tab-pane fade  active show" id="projects__two" role="tabpanel"
                                         aria-labelledby="projects__two">
                                        <div class="accordion content__cirriculum__wrap" id="accordionExample">
                                            @forelse($subjects as $subject)
                                                <div class="subject-wrapper">
                                                    <!-- Subject header: clicking this toggles the lessons collapse -->
                                                    <h1 class="accordion-header mb-2"
                                                        id="headingSubject{{$subject->id}}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapseSubject{{$subject->id}}"
                                                                aria-expanded="false"
                                                                aria-controls="collapseSubject{{$subject->id}}">
                                                            {{$subject->title}}
                                                        </button>
                                                    </h1>

                                                    <!-- Collapse container for lessons under this subject -->
                                                    <div id="collapseSubject{{$subject->id}}"
                                                         class="accordion-collapse collapse"
                                                         aria-labelledby="headingSubject{{$subject->id}}"
                                                         data-bs-parent="#accordionExample">

                                                        @forelse($subject->lessons as $key => $lesson)
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header"
                                                                    id="headingLesson{{$lesson->id}}">
                                                                    <button class="accordion-button" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseLesson{{$lesson->id}}"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseLesson{{$lesson->id}}">
                                                                        {{$lesson->title}}
                                                                        <span>{{$lesson->duration}}</span>
                                                                    </button>
                                                                </h2>
                                                                <div id="collapseLesson{{$lesson->id}}"
                                                                     class="accordion-collapse collapse"
                                                                     aria-labelledby="headingLesson{{$lesson->id}}"
                                                                     data-bs-parent="#collapseSubject{{$subject->id}}">
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
                                                                                        <a href="#"><span
                                                                                                    class="question"><i
                                                                                                        class="icofont-eye"></i></span></a>
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
                                                                                    <span><i
                                                                                                class="icofont-lock"></i></span>
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
                                @else
                                    <div class="tab-pane fade active show" id="projects__pdf" role="tabpanel"
                                         aria-labelledby="projects__pdf">
                                        <iframe src="{{ asset($courseDetails->demo_pdf) }}" width="100%"
                                                height="500px"></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($courseDetails->product_type == 'course')
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
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">

                    <div class="course__details__sidebar">
                        <div class="event__sidebar__wraper" data-aos="fade-up">


                            @if($courseDetails->product_type == 'course')
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
                            @endif
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

                                @if($courseDetails->product_type == 'course')

                                    @if($enrollment)

                                        <a class="default__button"
                                           href="{{route('course-lessons', $courseDetails->slug)}}">Continue</a>

                                    @else
                                        <!--<a class="default__button" href="{{route('course-lessons', $courseDetails->slug)}}">Try-->
                                        <!--    For Free</a>-->

                                        @if($courseDetails->sale_price == 0)
                                            <a class="default__button default__button--2" onclick="addtocart()"
                                               href="{{route('checkout', $courseDetails->slug)}}">Buy Now</a>

                                        @else
                                            <a class="default__button default__button--2" onclick="addtocart()"
                                               href="{{route('checkout', $courseDetails->slug)}}">Buy Now</a>
                                        

                                            <!--<img class="img-fluid" src="{{asset('payment.jpg')}}" />-->
                                        @endif
                                    @endif

                                @else
                                    @if($enrollment)
                                        <a class="default__button default__button--2"
                                           href="javascript:void(0)">Purchased</a>
                                    @else
                                        <a class="default__button default__button--2" onclick="addtocart()"
                                           href="{{route('checkout', $courseDetails->slug)}}">Buy Now</a>

                                        @if($courseDetails->product_type == 'book')
                                            <a class="default__button default__button--1"
                                               href="javascript:void(0);">Add to Cart</a>
                                        @endif
                                    @endif
                                @endif


                                <span>
                                        <i class="icofont-ui-rotation"></i>
{{--                                        45-Days Money-Back Guarantee--}}
                                    </span>
                            </div>

                            @if($courseDetails->product_type == 'course')
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
                                                <span class="sb_label">Enrolled</span><span
                                                        class="sb_content">{{ $enrollmentCount ?? 100 }}</span>
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
                            @endif

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

    <script>

        var gtmprice = {{ $courseDetails->sale_price ?? 0 }};
        var gtmqty = 1;
        var gtmid = {{ $courseDetails->id }};
        var gtmsku = 'SMM{{ $courseDetails->id }}';
        var gtmproductname = '{{ $courseDetails->title}}';
        var gtmdiscount = {{ $courseDetails->discount}};

        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            ecommerce: null
        });

        dataLayer.push({
            event: "view_item",
            ecommerce: {
                currency: "BDT",
                value: gtmprice,
                items: [{
                    item_id: gtmid,
                    item_name: gtmproductname,
                    index: 0,
                    price: gtmprice,
                    discount: gtmdiscount,
                    item_brand: 'schoolmathematics.com.bd',
                    currency: "BDT",
                    quantity: 1,
                }]

            }
        });

        function addtocart() {
            var gtmprice = {{ $courseDetails->sale_price ?? 0 }};
            var gtmqty = 1;
            var gtmid = {{ $courseDetails->id }};
            var gtmsku = 'SMM{{ $courseDetails->id }}';
            var gtmproductname = '{{ $courseDetails->title}}';
            var gtmdiscount = {{ $courseDetails->discount}};

            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                ecommerce: null
            });

            dataLayer.push({
                event: "add_to_cart",
                ecommerce: {
                    currency: "BDT",
                    value: gtmprice,
                    items: [{
                        item_id: gtmid,
                        item_name: gtmproductname,
                        index: 0,
                        price: gtmprice,
                        discount: gtmdiscount,
                        item_brand: 'schoolmathematics.com.bd',
                        currency: "BDT",
                        quantity: 1,
                    }]

                }
            });
        }
    </script>

@endsection
