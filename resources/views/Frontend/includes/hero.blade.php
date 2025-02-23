

@if($heroBanner) 
<!-- herobannerarea__section__start -->
<div class="herobannerarea herobannerarea__2 herobannerarea__online__course">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                <div class="herobannerarea__content__wraper">


                    <div class="herobannerarea__title">
                        <div class="herobannerarea__small__title">
                            <span>{{$heroBanner->short_title ?? ''}}</span>
                        </div>
                        <div class="herobannerarea__title__heading__2 herobannerarea__title__heading__3">
                            <h2>{{$heroBanner->main_title ?? ''}}</h2>
                        </div>
                    </div>


                    <div class="herobannerarea__text herobannerarea__text__2">
                        <p>{{$heroBanner->sub_title ?? ''}} </p>
                    </div>
                    <div class="hreobannerarea__button__2">
                        <a class="default__button" href="{{$heroBanner->btn1_link ?? '#'}}">{{$heroBanner->btn1_text ?? ''}}</a>
                        <a class="default__button hreobannerarea__button__3" href="{{$heroBanner->btn2_link ?? '#'}}">{{$heroBanner->btn2_text ?? ''}}</a>
                    </div>
                </div>
                <!--test-->
                  <div class="herobannerarea__content__wraper mt-5">
                      <div class="row justify-content-around">
                        
                        @forelse($services as $key=> $class) 
                            <div class="single__service col-5">
                
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
               
                        @empty
                        @endforelse
                       
                        </div>
                   
                </div>
            </div>
            
            
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12" data-aos="fade-up">

                <div class="herobanner__video registerarea__video">
                    @if($heroBanner->video_thumbnail_img) 
                    <img loading="lazy" src="{{asset($heroBanner->video_thumbnail_img)}}" alt="Video Banner">
                    @endif
                    <div class="video__pop__btn">
                        <a class="video-btn" href="{{$heroBanner->video_url ?? ''}}"> <img loading="lazy" src="{{asset('frontend')}}/img/icon/video.png" alt=""></a>
                    </div>
                </div>

            </div>

            <div class="herobannerarea__icon__2">
                <img loading="lazy" class="herobanner__common__img herobanner__img__1" src="{{asset('frontend')}}/img/herobanner/herobanner__1.png" alt="photo">
                <img loading="lazy" class="herobanner__common__img herobanner__img__2" src="{{asset('frontend')}}/img/herobanner/herobanner__2.png" alt="photo">
                <!--<img loading="lazy" class="herobanner__common__img herobanner__img__3" src="{{asset('frontend')}}/img/herobanner/herobanner__3.png" alt="photo">-->
                <!--<img loading="lazy" class="herobanner__common__img herobanner__img__4" src="{{asset('frontend')}}/img/herobanner/herobanner__4.png" alt="photo">-->
                <!--<img loading="lazy" class="herobanner__common__img herobanner__img__5" src="{{asset('frontend')}}/img/herobanner/herobanner__5.png" alt="photo">-->
            </div>
        </div>
    </div>
</div>
<!-- herobannerarea__section__end-->

@endif