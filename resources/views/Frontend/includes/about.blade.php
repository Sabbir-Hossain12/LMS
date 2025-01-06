@if($about) 
<!-- aboutarea__2__section__start -->
<div class="aboutarea__2 aboutarea__4 sp_bottom_30" style="margin-bottom: 120px">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                <div class="about__right__wraper__2 about__right__wraper__4">
                    <div class="educationarea__img" data-tilt>
{{--                        <img loading="lazy" class="aboutimg__4__img__1" src="{{asset('frontend')}}/img/about/about_13.png" alt="about">--}}
                        <img loading="lazy" class="aboutimg__4__img__2" src="{{asset($about->side_img ?? 'backend/upload/about/1735321710676ee86e580ff.png')}}" alt="about">
                    </div>

                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" data-aos="fade-up">

                <div class="aboutarea__content__wraper">

                    <div class="section__title__2">
                        <div class="section__small__title">
                            <span>{{$about->short_title ?? ''}}</span>
                        </div>
                        <div class="section__title__heading__2 section__title__heading__3 heading__fontsize__2">
                            <h2>{{$about->main_title ?? ''}}</h2>
                        </div>
                    </div>

                
{{--                    {!! $about->desc !!}--}}
                    <div class="aboutarea__para aboutarea__para__2">
                        {!! $about->desc !!}
{{--                        <p>25+Contrary to popular belief, Lorem Ipsum is not simply random text roots in a piece of classical Latin literature from 45 BC</p>--}}
                    </div>
{{--                    <div class="aboutarea__list__2">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <i class="icofont-check"></i> Explore a variety of fresh educational teach--}}
{{--                            </li>--}}

{{--                            <li>--}}
{{--                                <i class="icofont-check"></i> Explore a variety of fresh educational teach--}}
{{--                            </li>--}}

{{--                            <li>--}}
{{--                                <i class="icofont-check"></i> Explore a variety of fresh educational teach--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

                </div>

            </div>
        </div>
    </div>
</div>
<!-- aboutarea__2__section__end -->

@endif