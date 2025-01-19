
@if($questions->count() > 0)

    @if($examType->start_time <= now() && $examType->end_time >= now())
        <div class="lesson__quiz__wrap">
            <div class="fw-bold">
                <ul>
                    <li>Total Attempts: {{$examType->attempts}} </li>
                    <li>| Start Time: {{$examType->start_time->format('F d, Y h:i A')}}</li>
                    <li>| End Time: {{$examType->end_time->format('F d, Y h:i A')}}</li>
                </ul>
            </div>
            <hr class="hr">

            @forelse($questions as $key=> $question)
                <div class="quiz__single__attemp">
                    <ul>
                        <li>Question : {{$key+1}}/{{count($questions)}}  </li>
                         
                    </ul>
                   
                    
                    <hr class="hr">

                    @if(isset($question->question_image))
                        <div class="m-2">
                            <img src="{{asset($question->question_image)}}" class="img-fluid" width="300px" alt="">
                        </div>

                    @endif
                    {{--                <h3>--}}
                    {{--                   --}}
                    {{--                    {{$key+1}}. --}}
                    {{--                    --}}
                    {{--                --}}
                    {{--                </h3>--}}
                    {!! $question->question_text !!}
                    <div class="row">
                        @forelse(json_decode($question->options,0) as $key2=> $option)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="" name="answer">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{$option}}
                                    </label>
                                </div>

                            </div>

                        @empty
                        @endforelse
                    </div>


                </div>
                <br><br><br>
            @empty
                <p>No Questions For Now, We Will Keep You Notified</p>
            @endforelse






            <a class="default__button" href="#"> Quiz Submit
                <i class="icofont-long-arrow-right"></i>
            </a>



        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>

            $(document).on('visibilitychange', function () {
                if (document.hidden) {
                    alert('You are not allowed to switch tabs during the quiz.');
                    
                    swal('You are not allowed to switch tabs during the quiz.');

                }
            });
        </script>
        
    @else
        <h4 class="text-center">Quiz Not Available Yet</h4>
    @endif
    
    
@else
    <h4>No Questions For Now, We Will Keep You Notified</h4>

@endif
