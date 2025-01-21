<div class="lesson__assignment__wrap">

    @if($questions->count() > 0)

        @if($examType->start_time <= now() && $examType->end_time >= now())

            <div class="assignment__submit__wrap">
                <div class="fw-bold">
                    <ul>
                        <li> Start Time: {{$examType->start_time->format('F d, Y h:i A')}}</li>
                        <li>| End Time: {{$examType->end_time->format('F d, Y h:i A')}}</li>
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

                <form enctype="multipart/form-data" method="post" action="{{route('assignment.submit')}}">
                    @csrf
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
            <h4 class="text-center">Assignment Not Available Yet</h4>
        @endif

    @else
        <h3>No Assignment Added Yet</h3>
    @endif

</div>


<script>
    swal.fire({
        title: "Failed",
        icon: "error"
    })
</script>