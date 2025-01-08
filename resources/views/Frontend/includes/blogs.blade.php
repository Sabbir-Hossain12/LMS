@if($blogs->count()>0) 
<!-- blog__section__start -->
<div class="blogarea__2 sp_top_100 sp_bottom_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-12" data-aos="fade-up">
                <div class="section__title__2 text-center teamarea__margin">
                    <div class="section__small__title">
                        <span>News & Blog</span>
                    </div>
                    <div class="section__title__heading__2 section__title__heading__3 heading__fontsize__2">
                        <h2>Latest News & Blogs</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
            @forelse($blogs as $key=> $blog) 
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" data-aos="fade-up">
                <div class="single__blog__wraper">
                    <div class="single__blog__img">
                        <img loading="lazy" src="{{asset($blog->thumbnail_img ??   'frontend/img/blog/blog_5.png')}}" alt="blog">
{{--                        <div class="single__blog__button">--}}
{{--                            <a class="default__button" href="#">Story</a>--}}
{{--                        </div>--}}
                    </div>
                    
                    <div class="single__blog__content">
                        <p>{{$blog->created_at->diffForHumans()}}</p>
                        <h4> <a href="#">{{$blog->title}} </a></h4>
                        <div class="single__blog__bottom__button">
                            <a href="#">Read More
                                <i class="icofont-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            @empty
            @endforelse
            
            <div class="col-xl-12" data-aos="fade-up">
                <div class="blogarea__bottom__button">
                    <a class="default__button" href="#">MORE BLOG</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- blog__section__end -->

@endif