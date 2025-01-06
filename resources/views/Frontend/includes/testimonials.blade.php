@if($testimonials->count()>0) 
<!-- testimonial__section__start -->
<div class="testimonialarea__3">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="section__title__2" data-aos="fade-up">
                    <div class="section__small__title">
                        <span>{{$testimonialSetting->short_title}}</span>
                    </div>
                    <div class="section__title__heading__2 section__title__heading__3 heading__fontsize__2">
                        <h2>{{$testimonialSetting->main_title}}</h2>
                    </div>
                </div>

                <div class="testimonial__slider__active__3" data-aos="fade-up">
                    @forelse($testimonials as $key=> $testimonial) 
                    <div class="testimonialarea__paragraph__3 ">
                        <p class="testimonial__quote"><i class="icofont-quote-left active quote__left"></i>{{$testimonial->desc}}<i class="icofont-quote-right quote__right active"></i></p>

                        <div class="testimonialarea__person__3">
                            <div class="testimonial__img__3">
                                <img loading="lazy" src="{{asset($testimonial->img ?? 'frontend/img/testimonial/testi_2.png')}}" alt="">
                            </div>
                            <div class="testimonial__name">
                                <h6><a href="#">{{$testimonial->name ?? ''}}</a></h6>
                                <span>{{$testimonial->title ?? ''}}</span>
                            </div>
                        </div>

                    </div>
                    @empty
                    @endforelse
                    
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                <div class="testimonial__group__img" data-tilt>
                    <img loading="lazy" src="{{asset($testimonialSetting->side_img ?? 'frontend/img/testimonial/testi__group__1.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>

</div>
<!-- testimonial__section__start -->

@endif