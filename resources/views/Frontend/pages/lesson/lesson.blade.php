@extends('Frontend.layouts.master')

@section('content')

    <!-- tution__section__start -->
    <div class="tution sp_bottom_100 sp_top_50">
        <div class="container-fluid full__width__padding">
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up">

                    <div class="accordion content__cirriculum__wrap" id="accordionExample">
                        @forelse($subjects as $subject)
                            <div class="subject-wrapper">
                                <h3 class="subject-title">{{$subject->title}}</h3>

                            @forelse($subject->lessons as $key=> $lesson)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{$lesson->id}}" aria-expanded="true"
                                                    aria-controls="collapse{{$lesson->id}}">
                                                {{$lesson->title}}
                                                <span>{{$lesson->duration}}</span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{$lesson->id}}"
                                             class="accordion-collapse collapse @if($key == 0) show @endif"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">

                                                @if($lesson->lessonVideos->count() > 0)

                                                    @forelse($lesson->lessonVideos as $key1=>$video)
                                                        <div class="scc__wrap">
                                                            <div class="scc__info">
                                                                <i class="icofont-video-alt"></i>
                                                                <h5><a href="#"><span>{{$video->title}}</span></a></h5>
                                                            </div>

                                                            <div class="scc__meta">
                                                                <strong>{{$video->duration}}</strong>
                                                                
                                                                @if($enrollment)
                                                                    <a  data-id="{{$video->id}}" data-lesson-id="{{$lesson->id}}" href="#"><span class="question"><i
                                                                                    class="icofont-eye lessonVideoAnchor"></i></span></a>
                                                                @else
                                                                <a  data-id="{{$video->id}}" data-lesson-id="{{$lesson->id}}" ><span class="question"><i
                                                                                class=" @if($key==0 &&  ($key1 == 0 || $key1 == 1))  icofont-eye @else icofont-lock  @endif lessonVideoAnchor"></i></span></a>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    @empty
                                                    @endforelse
                                                @endif


                                                @if($lesson->lessonMaterials->count() > 0)
                                                    @forelse($lesson->lessonMaterials as $key2=>$material)
                                                        <div class="scc__wrap">
                                                            <div class="scc__info">
                                                                <i class="icofont-file-text"></i>
                                                                <h5><a href="#"><span>{{$material->title}}</span></a>
                                                                </h5>
                                                            </div>

                                                            <div class="scc__meta">
                                                                                                            <strong>3.27</strong>

                                                                @if($enrollment)

                                                                    <a href="#"><span class="question"><i
                                                                                    class="icofont-eye"></i></span></a>
                                                                @else
                                                                <a href="#"><span class="question"><i
                                                                                class="icofont-lock"></i></span></a>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    @empty
                                                    @endforelse
                                                @endif


                                                @if($lesson->assessments->count() > 0)
                                                    @forelse($lesson->assessments as $key2=>$assessment)

                                                        @if($assessment->type == 'quiz')

                                                            <div class="scc__wrap">
                                                                <div class="scc__info">
                                                                    <i class="icofont-audio"></i>
                                                                    <h5><a href="#"><span>{{$assessment->title}}</span></a>
                                                                    </h5>
                                                                </div>
                                                                <div class="scc__meta">
                                                                                                                <strong>3.27</strong>
                                                                    
                                                                    
                                                                    @if($enrollment)
                                                                        <a href="#"><span class="question"><i
                                                                                        class="icofont-eye"></i></span></a>
                                                                    @else
                                                                    <a href="#"><span class="question"><i
                                                                                    class="icofont-lock"></i></span></a>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        @else
                                                            <div class="scc__wrap">
                                                                <div class="scc__info">
                                                                    <i class="icofont-audio"></i>
                                                                    <h5><a href="#"><span>{{$assessment->title}}</span></a>
                                                                    </h5>
                                                                </div>
                                                                <div class="scc__meta">
                                                                                                                <strong>3.27</strong>

                                                                    @if($enrollment)
                                                                        <a href="#"><span class="question"><i
                                                                                        class="icofont-eye"></i></span></a>
                                                                    @else
                                                                    <a href="#"><span class="question"><i
                                                                                    class="icofont-lock"></i></span></a>
                                                                        
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        @endif

                                                    @empty
                                                    @endforelse

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                <h5>No Lessons added Yet</h5>
                                @endforelse
                            

                            </div>
                        @empty
                            <h3>No Subject Yet</h3>
                        @endforelse
                    </div>
                </div>
                
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up" id="lessonContent">
                  
                    
                    
                </div>
            </div>

        </div>
    </div>
    

    @push('js')
        <script>

            $(document).on('click', '.lessonVideoAnchor', function (e) {
               
                e.preventDefault();
                let id= $(this).data('id');
                let lessonId= $(this).data('lesson-id');


                console.log(id);
                console.log(lessonId);

                console.log('click')
            });

        </script>
    @endpush

@endsection


