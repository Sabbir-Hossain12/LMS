@if($teachers->count()>0) 
<!-- team__section__start -->
<div class="teamarea sp_bottom_100 sp_top_50">
    <div class="container">
        <div class="row mb-2">
            <div class="col-xl-12" data-aos="fade-up">
                <div class="section__title__2 text-center teamarea__margin">
                    <div class="section__small__title">
                        <span>Expert teachers</span>
                    </div>
                    <div class="section__title__heading__2 section__title__heading__3 heading__fontsize__2">
                        <h2>Our Expert Teacher</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($teachers as $key=> $teacher) 
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" data-aos="fade-up">
                <div class="single__team">
                    <div class="teamarea__img">
                        <img class="rounded" loading="lazy" src="{{asset($teacher->profile_image ?? 'https://media.istockphoto.com/id/1147544807/vector/thumbnail-image-vector-graphic.jpg?s=612x612&w=0&k=20&c=rnCKVbdxqkjlcs3xH87-9gocETqpspHFXu5dIGB4wuM=')}}" alt="team">
                        <div class="teamarea__icon">
                            <ul>
                                <li>
                                    <a href="#"> <i class="icofont-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"> <i class="icofont-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"> <i class="icofont-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"> <i class="icofont-youtube-play"></i></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="teamarea__content">
                        <p>{{$teacher->instructor_title}}</p>
                        <h5><a href="#">{{$teacher->name}}</a></h5>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
           

        </div>
    </div>
</div>
<!-- team__section__end-->

@endif