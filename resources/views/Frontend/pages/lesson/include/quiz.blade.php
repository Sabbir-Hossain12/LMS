
@if($questions->count() > 0)

    @if($examType->start_time <= now())
        
        <form id="quiz-form" method="post" action="{{route('quiz.submit')}}">
            @csrf
            
            <input type="hidden" name="assessment_id" value="{{$examType->id}}">
        <div class="lesson__quiz__wrap">
            <div class="fw-bold">
                <ul>
{{--                <li>Total Attempts: {{$examType->attempts}} </li>--}}
                    <li>Start Time: {{$examType->start_time->format('F d, Y h:i A')}}</li>
                    <li>| End Time: {{$examType->end_time->format('F d, Y h:i A')}}</li>
                    <li>| Duration: <span id="timer"> 00:00:00</span></li>
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
                                          id="option_{{$question->id}}_{{$key2}}" value="{{$option}}"  >
                                    <label class="form-check-label" for="option_{{$question->id}}_{{$key2}}">
                                        {!!  $option !!}
                                    </label>
                                </div>

                            </div>

                        @empty
                        @endforelse
                    </div>


                </div>
                <br><br><br>
            @empty
                <p>Exam will be available
                    on {{date('d M, Y h:i A', strtotime($examType->start_time))}}</p>
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
                    swal.fire('You are not allowed to switch tabs during the quiz.');
                }
            });
            
            
           
                // $(window).on('beforeunload', function (e) {
                //     // Display a confirmation message
                //     e.preventDefault();
                //     e.returnValue = ''; // Required for Chrome
                //     return 'Are you sure you want to leave? Your progress may be lost.'; // Message for older browsers
                //
                //     // Swal.fire({
                //     //     title: "You Want to Start Exam?",
                //     //     // text: "You won't be able to revert this!",
                //     //     icon: "warning",
                //     //     showCancelButton: true,
                //     //     confirmButtonColor: "#3085d6",
                //     //     cancelButtonColor: "#d33",
                //     //     confirmButtonText: "Resume Exam",
                //     // }).then((result) => {
                //     //     if (result.isConfirmed) {
                //     //        
                //     //     }
                //     // });
                // });
            
        </script>
        
    @else
        <h4 class="text-center">Quiz Not Available Yet</h4>
    @endif
    
    
@else
    <h4>No Questions For Now, We Will Keep You Notified</h4>

@endif

@php
    // Calculate the end time by adding the duration to the current time
    $examDuration = $examType->duration;
    
@endphp

<script>
    
    $('.katex-html').hide();
    
    //Submit Quiz
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
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Your Exam has been saved, redirecting you to dashboard !",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    setTimeout(() => {
                        window.location.href = '{{route('student.dashboard.index')}}';
                    }, 2000);

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


    $('#lessonSidebar').css('pointer-events', 'none');
    $('#lessonSidebar').off('click');

  
</script>

<script>
    let timerInterval = null; // Declare timerInterval globally

    function initializeQuizTimer() {
        // Clear the existing timer if it's running
        if (timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
        }

        // Get the exam duration (in minutes) from the server
        const examDuration = {{ $examDuration }};

        // Calculate the quiz end time based on the client's current time.
        // Note: new Date() returns the client's current time.
        const clientNow = new Date().getTime();
        const examDurationMs = examDuration * 60 * 1000; // convert minutes to milliseconds
        const quizEndTime = clientNow + examDurationMs;

        // Timer function: updates the countdown every second.
        function updateTimer() {
            const now = new Date().getTime();
            const timeLeft = quizEndTime - now;

            if (timeLeft <= 0) {
                // Time's up! Submit the quiz automatically.
                clearInterval(timerInterval);
                document.getElementById('timer').innerHTML = "00:00:00";
                $('#quiz-form').submit();
                return;
            }

            // Calculate hours, minutes, and seconds from the time left.
            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            // Display the timer with leading zeros.
            document.getElementById('timer').innerHTML =
                `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        // Start the timer by calling updateTimer every 1000 milliseconds (1 second)
        timerInterval = setInterval(updateTimer, 1000);

        // Initial call to display the timer immediately without delay.
        updateTimer();
    }

    // Initialize the quiz timer when the page loads.
    initializeQuizTimer();
</script>
