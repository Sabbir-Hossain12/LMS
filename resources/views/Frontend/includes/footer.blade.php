<!-- footer__section__start -->
<div class="footerarea">
    <div class="container">
        {{--        <div class="footerarea__newsletter__wraper">--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-up">--}}
        {{--                    <div class="footerarea__text">--}}
        {{--                        <h3>Still You Need Our <span>Support</span> ?</h3>--}}
        {{--                        <p>Don’t wait make a smart & logical quote here. Its pretty easy.</p>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-up">--}}
        {{--                    <div class="footerarea__newsletter">--}}
        {{--                        <div class="footerarea__newsletter__input">--}}
        {{--                            <form action="#">--}}
        {{--                                <input type="text" placeholder="Enter your email here">--}}
        {{--                                <div class="footerarea__newsletter__button">--}}
        {{--                                    <button type="submit" class="subscribe__btn">Subscribe Now</button>--}}
        {{--                                </div>--}}
        {{--                            </form>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="footerarea__wrapper footerarea__wrapper__2">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12" data-aos="fade-up">
                    <div class="footerarea__inner footerarea__about__us">
                        <div class="footerarea__heading">
                            <h3>About us</h3>
                        </div>
                        <div class="footerarea__content">
                            <p>{{$basicInfo->about_text}}</p>
                        </div>
                        <div class="foter__bottom__text">
                            <div class="footer__bottom__icon">
                                <i class="icofont-clock-time"></i>
                            </div>
                            @if($basicInfo->opening_hours_text) 
                            <div class="footer__bottom__content">
                                <h6>Opening Houres</h6>
                                <span>{{$basicInfo->opening_hours_text}}</span>
                                
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-xl-2 col-lg-2  col-md-6 col-sm-6" data-aos="fade-up">
                    <div class="footerarea__inner">
                        <div class="footerarea__heading">
                            <h3>Usefull Links</h3>
                        </div>
                        <div class="footerarea__list">
                            <ul>
                                @forelse($pages->take(5) as $page) 
                                <li>
                                    <a href="#">{{$page->name}}</a>
                                </li>
                                @empty
                                @endforelse
                              
                            </ul>
                        </div>


                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6" data-aos="fade-up">
                    <div class="footerarea__inner footerarea__padding__left">
                        <div class="footerarea__heading">
                            <h3>Course</h3>
                        </div>
                        <div class="footerarea__list">
                            <ul>
                                @forelse($classes as $key=> $class) 
                                <li>
                                    <a href="#">{{$class->title}}</a>
                                </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>


                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12" data-aos="fade-up">
                    <div class="footerarea__right__wraper footerarea__inner">
                        <div class="footerarea__heading">
                            <h3>Recent Post</h3>
                        </div>
                        
                        <div class="footerarea__right__list">
                            <ul>
                                @forelse($blogs as $key=> $blog) 
                                <li>
                                    <a href="#">
                                        <div class="footerarea__right__img">
                                            <img loading="lazy" src="{{asset($blog->thumbnail_img)}}"
                                               width="61px" height="54px"  alt="footerphoto">
                                        </div>
                                        
                                        <div class="footerarea__right__content">
                                            <span>{{$blog->created_at->diffForHumans()}} </span>
                                            <h6>{{$blog->title}}</h6>
                                        </div>
                                    </a>
                                </li>
                                    
                                    
                                @empty
                                @endforelse
                                    

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerarea__copyright__wrapper footerarea__copyright__wrapper__2">
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="copyright__logo">
                        <a href="https://danpite.tech/">
{{--                            <h3>Danpite Tech</h3>--}}
                            <img loading="lazy" src="{{asset($basicInfo->light_logo)}}" width="187px" height="48px" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="footerarea__copyright__content footerarea__copyright__content__2">
                        <p style="font-size: 14px"> All Rights Reserved by <a href="{{route('home')}}">{{$basicInfo->site_name}}</a> , Designed and Developed by <a href="https://danpite.tech/">Danpite Tech</a></p>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3">
                    <div class="footerarea__icon footerarea__icon__2">
                        <ul>
                            <li><a href="{{$basicInfo->fb_link ?? '#'}}"><i class="icofont-facebook"></i></a></li>
                            <li><a href="{{$basicInfo->twitter_link ?? '#'}}"><i class="icofont-twitter"></i></a></li>
                            <li><a href="{{$basicInfo->vimeo_link ?? '#'}}"><i class="icofont-vimeo"></i></a></li>
                            <li><a href="{{$basicInfo->linkedin_link ?? '#'}}"><i class="icofont-linkedin"></i></a></li>
                            <li><a href="{{$basicInfo->skype_link ?? '#'}}"><i class="icofont-skype"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- footer__section__end -->