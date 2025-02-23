@extends('Frontend.layouts.master')

@section('content')
    
    <style>
        .active{
            color: #0d6efd !important;
        }
    </style>

    <!-- tution__section__start -->
    <div class="tution sp_bottom_100 sp_top_50">
        <div class="container-fluid full__width__padding">
            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12" id="lessonSidebar" data-aos="fade-up" >

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
                                                                
                                                                @if(!$enrollment)
                                                                    
                                                                <h5>
                                                                    <a data-id="{{$video->id}}" data-lesson-id="{{$lesson->id}}" class="@if($key==0 &&  ($key1 == 0 || $key1 == 1))lessonVideoAnchor @else @endif"  href="javascript:void(0)">
                                                                        <span>{{$video->title}}</span>
                                                                    </a>
                                                                </h5>
                                                                    
                                                                @else
                                                                    
                                                                    <h5>
                                                                        <a data-id="{{$video->id}}" data-lesson-id="{{$lesson->id}}" class="lessonVideoAnchor"   href="javascript:void(0)"><span>{{$video->title}}</span></a>
                                                                    </h5>
                                                                    
                                                                @endif
                                                            </div>

                                                            <div class="scc__meta">
                                                                <strong>{{$video->duration}}</strong>
                                                                
                                                                @if($enrollment)
                                                                    <a  data-id="{{$video->id}}" data-lesson-id="{{$lesson->id}}" href="#"><span class="question"><i
                                                                                    class="icofont-eye lessonVideoAnchor"></i></span></a>
                                                                @else
                                                                <a href="#"><span class="question"><i
                                                                                class=" @if($key==0 &&  ($key1 == 0 || $key1 == 1))  icofont-eye @else icofont-lock  @endif"></i></span></a>
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
                                                                
                                                                @if($enrollment)
                                                                <h5>
                                                                    <a data-id="{{$material->id}}" data-lesson-id="{{$lesson->id}}" class="lessonMaterialAnchor" href="javascript:void(0)">
                                                                        <span>{{$material->title}}</span>
                                                                    </a>
                                                                </h5>
                                                                    
                                                                @else

                                                                    <h5>
                                                                        <a  class="" href="javascript:void(0)">
                                                                            <span>{{$material->title}}</span>
                                                                        </a>
                                                                    </h5>
                                                                    
                                                                @endif
                                                            </div>

                                                            <div class="scc__meta">
{{--                                                          <strong>3.27</strong>--}}

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

{{--                                                        @if($assessment->type == 'quiz')--}}

                                                            <div class="scc__wrap">
                                                                <div class="scc__info">
                                                                    <i class="icofont-audio"></i>
                                                                    
                                                                    @if($enrollment)
                                                                        <h5>
                                                                            <a href="{{route('lesson-exam2',$assessment->id)}}" data-id="{{$assessment->id}}" data-lesson-id="{{$lesson->id}}" class="lessonExamAnchor">
                                                                                <span>{{$assessment->title}}</span>
                                                                            </a>
                                                                        </h5>

                                                                    @else

                                                                        <h5>
                                                                            <a  class="" href="javascript:void(0)">
                                                                                <span>{{$assessment->title}}</span>
                                                                            </a>
                                                                        </h5>

                                                                    @endif

                                                                   
                                                                </div>
                                                                <div class="scc__meta">
{{--                                                                  <strong>3.27</strong>--}}
                                                                    
                                                                    @if($enrollment)
                                                                        <a href="#"><span class="question"><i
                                                                                        class="icofont-eye"></i></span></a>
                                                                    @else
                                                                    <a href="#"><span class="question"><i
                                                                                    class="icofont-lock"></i></span></a>
                                                                    @endif
                                                                </div>
                                                            </div>

{{--                                                        @else--}}
                                                            

{{--                                                        @endif--}}

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
                
                $('.lessonVideoAnchor').removeClass('active');
                $('.lessonMaterialAnchor').removeClass('active');
                $('.lessonExamAnchor').removeClass('active');// Remove active class from all anchors
                $(this).addClass('active'); // Add active class to the clicked element's anchor
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{route('lesson-video')}}",
                    data: {
                        id: id,
                        lesson_id:lessonId

                    },
                   
                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    success: function (res) {
                        
                        $('#lessonContent').empty();
                        $('#lessonContent').append(res.html);

                       $("html, body").animate({
                            scrollTop: $("#lessonContent").offset().top - 300
                        }, 200); // 800ms smooth scrolling

                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });
            
            $(document).ready(function () {
              // Select the first visible .lessonVideoAnchor and trigger a click
              $('.lessonVideoAnchor:first').trigger('click');
              $('.lessonVideoAnchor:first').addClass('active');
              
          });

            $(document).on('click', '.lessonMaterialAnchor', function (e) {

                e.preventDefault();
                let id= $(this).data('id');
                let lessonId= $(this).data('lesson-id');

                $('.lessonVideoAnchor').removeClass('active');
                $('.lessonMaterialAnchor').removeClass('active');
                $('.lessonExamAnchor').removeClass('active');// Remove active class from all anchors
                $(this).addClass('active'); // Add active class to the clicked element's anchor

               


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{route('lesson-material')}}",
                    data: {
                        id: id,
                        lesson_id:lessonId

                    },

                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    success: function (res) {

                        $('#lessonContent').empty();
                        $('#lessonContent').append(res.html);

                            $("html, body").animate({
                            scrollTop: $("#lessonContent").offset().top - 300
                        }, 200); // 800ms smooth scrolling


                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });

            // Make sure SweetAlert2 is loaded on your page
            document.querySelectorAll('.lessonExamAnchor').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent the default navigation

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are about to start this exam. Do you want to proceed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, start exam!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If confirmed, redirect to the exam page
                            window.location.href = this.href;
                        }
                    });
                });
            });
                

      
            
            {{--$(document).on('click', '.lessonExamAnchor', function (e) {--}}
            
            {{--    e.preventDefault();--}}
            {{--    let assessment_id= $(this).data('id');--}}
            
            {{--    $('.lessonVideoAnchor').removeClass('active');--}}
            {{--    $('.lessonMaterialAnchor').removeClass('active');--}}
            {{--    $('.lessonExamAnchor').removeClass('active');--}}
            {{--    // Remove active class from all anchors--}}
            {{--    $(this).addClass('active'); // Add active class to the clicked element's anchor--}}
            {{--    $('.katex-html').hide();--}}
            {{--    --}}
            {{--    Swal.fire({--}}
            {{--        title: "You Want to Resume Exam?",--}}
            {{--        // text: "You won't be able to revert this!",--}}
            {{--        icon: "warning",--}}
            {{--        showCancelButton: true,--}}
            {{--        confirmButtonColor: "#3085d6",--}}
            {{--        cancelButtonColor: "#d33",--}}
            {{--        confirmButtonText: "Resume Exam",--}}
            {{--    }).then((result) => {--}}
            {{--        if (result.isConfirmed) {--}}
            
            {{--            $.ajax({--}}
            {{--                headers: {--}}
            {{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--                },--}}
            {{--                method: 'POST',--}}
            {{--                url: "{{route('lesson-exam')}}",--}}
            {{--                data: {--}}
            {{--                    assessment_id:assessment_id--}}
            {{--                },--}}
            
            {{--                // contentType: false,--}}
            {{--                // processData: false,--}}
            {{--                beforeSend: function() {--}}
            {{--                    // Show loader--}}
            {{--                    showLoader();--}}
            {{--                },--}}
            {{--                success: function (res) {--}}
            
            {{--                    $('#lessonContent').empty();--}}
            {{--                    $('#lessonContent').append(res.html);--}}
            {{--                    --}}
            {{--                    $("html, body").animate({--}}
            {{--                scrollTop: $("#lessonContent").offset().top - 300--}}
            {{--            }, 200); // 800ms smooth scrolling--}}
            
            {{--                },--}}
            {{--                error: function (err) {--}}
            
            {{--                    errorToast('error');--}}
            {{--                },--}}
            {{--                complete: function() {--}}
            {{--                    // Hide loader--}}
            {{--                    hideLoader();--}}
            {{--                }--}}
            {{--            })--}}
            {{--        }--}}
            {{--    });--}}
            {{--    --}}
            {{--  --}}
            {{--});--}}

        </script>
    @endpush

@endsection


