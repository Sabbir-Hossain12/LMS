<div class="lesson__assignment__wrap">

    @if($questions->count() > 0)

        @if($examType->start_time <= now() )

            <div class="assignment__submit__wrap">
                <div class="fw-bold">
                    <ul>
                        <li> Start Time: {{$examType->start_time->format('F d, Y h:i A')}}</li>
                        <li>| End Time: {{$examType->end_time->format('F d, Y h:i A')}}</li>
                        <li>| Duration: <span id="timer"> 00:00:00</span></li>
                    </ul>
                </div>
                <hr class="hr">
                <h3>Assignment Submission</h3>
                <hr class="hr">

                {{--        <div class="mb-3">--}}
                {{--            <label for="exampleFormControlTextarea1" class="form-label">Assignment Content</label>--}}
                {{--            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{$questions[0]->question_text}}</textarea>--}}
                {{--        </div>--}}

                @forelse($questions as $key2=>$question)

                    <h4>{{$key2+1}}.</h4>
                    @if(isset($question->question_image))

                        <div class="mb-3">
                            <img src="{{asset($question->question_image)}}" class="img-fluid" width="300px" alt="">
                        </div>

                    @endif

                    @if(isset($question->question_text))

                        <div class="mb-3">
                            {!! $question->question_text !!}
                        </div>

                    @endif

                @empty

                @endforelse

                <form id="assignmentSubmitForm" enctype="multipart/form-data"  >
                    @csrf
{{--                action="{{route('assignment.submit')}}--}}
                    <input type="hidden" name="assessment_id" value="{{$examType->id}}">

                    <div class="mb-3">
                        <label for="formFileLg" class="form-label">Drop Answer File (Doc/Docx/Pdf)</label>
                        <input class="form-control form-control-lg" id="file_path" name="file_path" type="file">
                    </div>

                    <button class="default__button">Submit Assignment</button>
                </form>

            </div>


            <script>

                // $(document).ready(function () {
                //     window.onbeforeunload = function () {
                //         return "You are in the middle of a Exam. Are you sure you want to leave?";
                //     };
                // });


            </script>

        @else
            <h4 class="text-center">Exam will be available
                on {{date('d M, Y h:i A', strtotime($examType->start_time))}}</h4>
        @endif

    @else
        <h3>No Assignment Added Yet</h3>
    @endif

</div>
@php
    // Calculate the end time by adding the duration to the current time
    $examDuration = $examType->duration;

@endphp


<script>



    // Submit Assignment
    $('#assignmentSubmitForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('assignment.submit') }}",
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {
                if (res.status === 'success') {
                  
                  $('#assignmentSubmitForm').trigger('reset');
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

    //disable Sidebar

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