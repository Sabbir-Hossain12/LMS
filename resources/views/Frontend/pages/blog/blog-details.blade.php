@extends('Frontend.layouts.master')

@section('content')



    <div class="blogarea__2 sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="blog__details__content__wraper">
                        <div class="blog__details__img" data-aos="fade-up">
                            <img loading="lazy"  src="{{asset($blog->main_img ??    'frontend/img/blog/blog_21.png')}}" alt="blog">
                        </div>
                        
                        <div class="blog__details__content">
                            
                            {!! $blog->desc !!}

                        </div>
                      



                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="blogsidebar__content__wraper__2" data-aos="fade-up">
                        <div class="blogsidebar__content__inner__2">
                            <div class="blogsidebar__img__2">
                                <img loading="lazy"  src="{{asset( $blog->author->profile_image ?? 'frontend/img/blog/blog_10.png')}}" height="95px" width="95px" alt="blog">
                            </div>
                            <div class="blogsidebar__name__2">

                                <h5>
                                    <a href="{{route('teacher.details', $blog->author->slug)}}"> {{$blog->author->name}}</a>

                                </h5>

                                <p>{{$blog->author->instructor_title}}</p>

                            </div>

                            <div class="blog__sidebar__text__2">
                                <p>{{$blog->author->short_desc}}</p>
                            </div>

                            <div class="blogsidbar__icon__2">
                                <ul>
                                    <li>
                                        <a href="{{$basicInfo->fb_link}}"><i class="icofont-facebook"></i></a>
                                    </li>

                                    <li>
                                        <a href="{{$basicInfo->youtube_link}}"><i class="icofont-youtube-play"></i></a>
                                    </li>

                                    <li>
                                        <a href="{{$basicInfo->insta_link}}"><i class="icofont-instagram"></i></a>
                                    </li>

                                    <li>
                                        <a href="{{$basicInfo->twitter_link}}"><i class="icofont-twitter"></i></a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                    {{--                    <div class="blogsidebar__content__wraper__2" data-aos="fade-up">--}}
                    {{--                        <h4 class="sidebar__title">Search here</h4>--}}
                    {{--                        <form action="#">--}}
                    {{--                            <div class="blogsudebar__input__area">--}}
                    {{--                                <input type="text" name="search" placeholder="Search product">--}}
                    {{--                                <button class="blogsidebar__input__icon">--}}
                    {{--                                    <i class="icofont-search-1"></i>--}}
                    {{--                                </button>--}}


                    {{--                            </div>--}}


                    {{--                        </form>--}}

                    {{--                    </div>--}}

                    <div class="blogsidebar__content__wraper__2" data-aos="fade-up">

                        <h4 class="sidebar__title">Recent Post</h4>
                        <ul class="recent__list">

                            @forelse($recentBlogs as $blog)
                                <li>
                                    <div class="recent__img">
                                        <a href="{{route('blog-details', $blog->slug)}}">
                                            <img loading="lazy"  src="{{asset($blog->thumbnail_img ??   'frontend/img/blog/blog_11.png')}}" width="84px" height="48px" alt="sidbar">
                                            <div class="recent__number">
                                                <span>01</span>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="recent__text">

                                        <div class="recent__date">
                                            <a href="#">{{$blog->created_at->format('d, M Y')}}</a>
                                        </div>

                                        <h6><a href="#"> {{$blog->title}} </a></h6>

                                    </div>
                                </li>
                            @empty
                            @endforelse

                        </ul>

                    </div>

                    <div class="blogsidebar__content__wraper__2" data-aos="fade-up">

                        <h4 class="sidebar__title">Follow Us</h4>
                        <div class="follow__icon">
                            <ul>
                                <li>
                                    <a href="#"><i class="icofont-facebook"></i></a>
                                </li>

                                <li>
                                    <a href="#"><i class="icofont-youtube-play"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icofont-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icofont-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icofont-instagram"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection