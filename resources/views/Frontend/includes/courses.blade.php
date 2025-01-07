<!-- grid__section__start -->
<div class="gridarea gridarea__2">
    <div class="container">
        <div class="row grid__row">

            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12" data-aos="fade-up">
                <div class="section__title__2">
                    <div class="section__title__button">
                        <div class="default__small__button">Course List</div>
                    </div>
                    <div class="section__title__heading__2 section__title__heading__3 heading__fontsize__2">
                        <h2>Perfect Online Course Your Carrer</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12" data-aos="fade-up">
                <div class="gridfilter_nav grid__filter__2 gridFilter">
                    <button class="active" data-filter="*">See All  </button>
                    @forelse($courseClasses as $key=> $class) 
                    <button data-filter=".filter{{ $class->id }}" class="">{{ $class->title }} </button>
{{--                    <button data-filter=".filter2" class="">Engineering </button>--}}
{{--                    <button data-filter=".filter3" class="">Featured </button>--}}
{{--                    <button data-filter=".filter4" class="">Architecture</button>--}}
                    @empty
                    @endforelse
                </div>
            </div>
        </div>





        <div class="row grid" data-aos="fade-up">
            @forelse($randomCourse as $key=> $course) 
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 grid-item filter{{$course->course_class_id}}">
                <div class="gridarea__wraper">
                    <div class="gridarea__img">
                        <a href="{{route('course-details', $course->slug)}}"><img loading="lazy" src="{{asset($course->thumbnail_img ??  'frontend/img/grid/grid_1.png')}}" width="252px" height="158px" alt="grid"></a>
                        <div class="gridarea__small__button">
                            <div class="grid__badge">{{$course->class->title}}</div>
                        </div>
                        <div class="gridarea__small__icon">
                            <a href="#"><i class="icofont-heart-alt"></i></a>
                        </div>
                    </div>
                    
                    
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
    </div>
</div>
{{--    <!-- grid__section__end -->--}}