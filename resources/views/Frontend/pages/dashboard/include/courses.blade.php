<div class="dashboard__content__wraper" id="enrolledCourseSection">
    <div class="dashboard__section__title">
        <h4>My Enrolled Courses</h4>
    </div>
    <div class="row">
        <div class="col-xl-12 aos-init aos-animate" data-aos="fade-up">
            <ul class="nav  about__button__wrap dashboard__button__wrap" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="single__tab__link active" data-bs-toggle="tab" data-bs-target="#projects__one"
                            type="button" aria-selected="true" role="tab">Enrolled Courses
                    </button>
                </li>
            </ul>
        </div>


        <div class="tab-content tab__content__wrapper aos-init aos-animate" id="myTabContent" data-aos="fade-up">

            <div class="tab-pane fade active show" id="projects__one" role="tabpanel" aria-labelledby="projects__one">
                <div class="row">
                    @forelse($enrollments as $enrollment) 
                    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                        <div class="gridarea__wraper">
                            <div class="gridarea__img">

                                <a href="{{route('course-lessons', $enrollment->course->slug)}}"><img loading="lazy" src="{{asset($enrollment->course->thumbnail_img)}}" alt="grid"></a>
                                <div class="gridarea__small__button gridarea__small__button__1">
                                    <div class="grid__badge">{{$enrollment->course->class->title}}</div>
                                </div>
                                {{--                                <div class="gridarea__small__icon">--}}
                                {{--                                    <a href="#"><i class="icofont-heart-alt"></i></a>--}}
                                {{--                                </div>--}}
                            </div>

                            <div class="gridarea__content">
                                <div class="gridarea__list">
                                    <ul>
                                        <li>
                                            <i class="icofont-book-alt"></i> {{$enrollment->course->lessons->count()}} Lessons
                                        </li>

                                        <li>
                                            <i class="icofont-clock-time"></i> {{$enrollment->course->duration}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="gridarea__heading">
                                    <h3><a href="{{route('course-lessons', $enrollment->course->slug)}}">{{$enrollment->course->title}}</a></h3>
                                </div>
                                <div class="gridarea__price">
                                    ৳ {{$enrollment->course->sale_price}} <del>/ ৳ {{$enrollment->course->regular_price}}</del>
                                    @if($enrollment->course->sale_price=0)
                                        <span> Free</span>

                                    @else
                                        <span> <del class="del__2">Free</del></span>
                                    @endif


                                </div>
                                <div class="gridarea__bottom">

                                    <a href="{{route('teacher.details', $enrollment->course->teacher->slug)}}">
                                        <div class="gridarea__small__img">
                                            <img loading="lazy" src="{{asset($enrollment->course->teacher->profile_image ?? 'frontend/img/grid/grid_small_1.jpg')}}"  alt="grid">
                                            <div class="gridarea__small__content">
                                                <h6>{{$enrollment->course->teacher->name}}</h6>
                                            </div>
                                        </div>
                                    </a>

                                    {{--                                    <div class="gridarea__star">--}}
                                    {{--                                        <i class="icofont-star"></i>--}}
                                    {{--                                        <i class="icofont-star"></i>--}}
                                    {{--                                        <i class="icofont-star"></i>--}}
                                    {{--                                        <i class="icofont-star"></i>--}}
                                    {{--                                        <i class="icofont-star"></i>--}}
                                    {{--                                        <span>(44)</span>--}}
                                    {{--                                    </div>--}}
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