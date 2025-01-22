
@if($questions->count() > 0)

    @if($examType->start_time <= now() && $examType->end_time >= now())
        
        <form id="quiz-form" method="post" action="{{route('quiz.submit')}}">
            @csrf
            
            <input type="hidden" name="assessment_id" value="{{$examType->id}}">
        <div class="lesson__quiz__wrap">
            <div class="fw-bold">
                <ul>
{{--                <li>Total Attempts: {{$examType->attempts}} </li>--}}
                    <li>Start Time: {{$examType->start_time->format('F d, Y h:i A')}}</li>
                    <li>| End Time: {{$examType->end_time->format('F d, Y h:i A')}}</li>
                </ul>
            </div>
            <hr class="hr">

            @forelse($questions as $key=> $question)
                <div class="quiz__single__attemp">
                    <ul>
                        <li>Question : {{$key+1}}/{{count($questions)}}  </li>
                        <li>| Mark : {{$question->marks}}  </li>
                         
                    </ul>
                   
                    
                    <hr class="hr">

                    @if(isset($question->question_image))
                        <div class="m-2">
                            <img src="{{asset($question->question_image)}}" class="img-fluid" width="300px" alt="">
                        </div>

                    @endif

                    {!! $question->question_text !!}
                    <div class="row">
                        @forelse(json_decode($question->options,0) as $key2=> $option)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer_{{$question->id}}"
                                          id="option_{{$question->id}}_{{$key2}}" value="{{$option}}" required >
                                    <label class="form-check-label" for="option_{{$question->id}}_{{$key2}}">
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
            
            <button type="submit" class="default__button" > Quiz Submit
                <i class="icofont-long-arrow-right"></i>
            </button>



        </div>

        </form>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>

            $(document).on('visibilitychange', function () {
                if (document.hidden) {
                    // alert('You are not allowed to switch tabs during the quiz.');
                    // swal.fire('You are not allowed to switch tabs during the quiz.');
                }
            });
        </script>
        
    @else
        <h4 class="text-center">Quiz Not Available Yet</h4>
    @endif
    
    
@else
    <h4>No Questions For Now, We Will Keep You Notified</h4>

@endif

<script>
    $('#quiz-form').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('quiz.submit') }}",
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {
                if (res.status === 'success') {

                    $('#quiz-form').trigger('reset');
                    swal.fire({
                        title: "Success",
                        text: "Exam Submitted Successfully!",
                        icon: "success"
                    })

                }
            },
            error: function (err) {

                swal.fire({
                    title: "Failed",
                    text: err.responseJSON.message,
                    icon: "error"
                })
                // Optionally, handle error behavior like showing an error message
            }
        });
    });
</script>
