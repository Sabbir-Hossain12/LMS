@if($services->count()>0) 
<!-- populer__section__start -->
<div class="populerarea sp_top_80 sp_bottom_50">
    <div class="container">
        <div class="row populerarea__wraper">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6" data-aos="fade-up">
                <div class="populerarea__heading heading__underline">
                    <div class="default__small__button">Course List</div>
                    <h2>Popular <span>Categories</span></h2>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6" data-aos="fade-up">
{{--                <div class="populerarea__content">--}}
{{--                    <p>Forging relationships between multi to national governments and global NGOs begins.</p>--}}
{{--                </div>--}}
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6" data-aos="fade-up">
                <div class="populerarea__button">
                    <a class="default__button" href="#">All Catagories
                        <i class="icofont-long-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
        <div class="row">
             @forelse($services as $key=> $class) 
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6" data-aos="fade-up">
                <div class="single__service">
                    <div class="service__img">

                        <i class="fas {{$class->icon}}" style="font-size: 30px">

                        </i>
                        <div class="service__bg__img">
                            <svg class="service__icon__bg" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M63.3775 44.4535C54.8582 58.717 39.1005 53.2202 23.1736 47.5697C7.2467 41.9192 -5.18037 32.7111 3.33895 18.4477C11.8583 4.18418 31.6595 -2.79441 47.5803 2.85105C63.5011 8.49652 71.8609 30.2313 63.3488 44.4865L63.3775 44.4535Z" fill="#5F2DED" fill-opacity="0.05"/>
                            </svg>
                        </div>
                    </div>
                    <div class="service__content">
                        <h3><a href="{{route('course-by-class', $class->slug)}}">{{$class->title}}</a></h3>
                        <p>{{$class->subtitle}}</p>
                    </div>
                    <div class="service__small__img">
                        <svg class="icon__hover__img" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.5961 10.265L19 1.33069L10.0022 3.73285L1 6.1306L7.59393 12.6627L14.1879 19.1992L16.5961 10.265Z" stroke="#FFB31F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
            @empty
            @endforelse

        </div>
    </div>
</div>
<!-- populer__section__end -->

@endif