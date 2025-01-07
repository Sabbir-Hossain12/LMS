<!-- .about__tap__section__end -->

@if($featuredCourses->count()>0) 
<div class="gridarea__2 sp_bottom_100 sp_top_80" data-aos="fade-up">
    <div class="container-fluid full__width__padding">

        <div class="section__title">

            <div class="section__title__heading">
                <h2>Featured Course</h2>
            </div>
        </div>

        <div class="row row__custom__class">
            <div class="swiper featured__course">
                <div class="swiper-wrapper">
                    
                    @forelse($featuredCourses as $key=> $course) 
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 grid-item column__custom__class swiper-slide">
                        <div class="gridarea__wraper">
                            <div class="gridarea__img">
                                
                                <a href="{{route('course-details', $course->slug)}}"><img loading="lazy" src="{{asset($course->thumbnail_img)}}" width="252px" height="158px" alt="grid"></a>
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

                                    <a href="#">
                                        <div class="gridarea__small__img">
                                            <img loading="lazy" src="{{asset($course->teacher->profile_image ?? 'frontend/img/grid/grid_small_1.jpg')}}"  alt="grid">
                                            <div class="gridarea__small__content">
                                                <h6>{{$course->teacher->name}}</h6>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="gridarea__star">
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <i class="icofont-star"></i>
                                        <span>(44)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>

                <div class="slider__controls__wrap slider__controls__arrows">
                    <div class="swiper-button-next arrow-btn"></div>
                    <div class="swiper-button-prev arrow-btn"></div>
                </div>

            </div>
        </div>
    </div>
</div>

@endif