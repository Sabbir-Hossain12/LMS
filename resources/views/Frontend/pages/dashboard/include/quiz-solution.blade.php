{{--<style>--}}
{{--    .form-check-input:checked {--}}
{{--        background-color: #f80443;--}}
{{--        border-color: #f80443;--}}
{{--    }--}}
{{--    --}}
{{--</style>--}}

<style>
    /* Green checkbox for correct answers */
    input.form-check-input:checked.correct-answer {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }

    /* Red checkbox for wrong answers */
    input.form-check-input:checked.wrong-answer {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        /*background-image: none !important;*/
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 6L14 14M14 6L6 14'/%3e%3c/svg%3e")
    !important;    }

    .form-check-input:checked[type=checkbox].wrong-answers {
        /*background-image: none !important;*/
        
    }
    .form-check-input:checked[type=checkbox].correct-answer {
      
    }
    
   
</style>


<div class="quiz__single__attemp__wrapper">

    <div class="dashboard__section__title">
        <h4>Solution For {{$examType->title}} </h4>
        <a href="javascript:void(0)" class="examCloseBtn"> <i class="fa fa-x close"></i></a>
    </div>

    @forelse($attempts as $key=> $attempt)
        <div class="quiz__single__attemp">
            <ul>
                <li>Question : {{$key+1}}/{{count($attempts)}}  </li>
                <li>| Mark : {{$attempt->question->marks}}  </li>
                <li>| Obtained : {{$attempt->is_correct == 1 ? $attempt->question->marks : 0}}  </li>
            </ul>

            <hr class="hr">

            @if(isset($attempt->question->question_image))

                <div class="m-2">
                    <img src="{{asset($attempt->question->question_image)}}" class="img-fluid" width="300px" alt="">
                </div>
            @endif

            {!! $attempt->question->question_text !!}
            <div class="row">
                @forelse(json_decode($attempt->question->options) as $key2=> $option)
                    <div class="col-md-6">

                        @php
                            $letters = range('A', 'Z');
                            $letter = $letters[$key2];
                            
                            $correctAnswer = $attempt->question->correct_option;
                            
                            $isCorrect = $letter == $correctAnswer;
                            $isSelected = $attempt->selected_option == $letter; // This option was selected 
                            //Determine label color class
                            $labelClass = $isCorrect ? 'text-success' : ($isSelected ? 'text-danger' : 'text-dark');
                        @endphp

                        <div class="form-check">
                            <input class="form-check-input {{ $isCorrect ? 'correct-answer' : ($isSelected ? 'wrong-answer' : '') }}"
                                   type="checkbox" name="answer_{{$attempt->question->id}}"
                                   id="option_{{$attempt->question->id}}_{{$key2}}" value="{{ $letter }}"
                                   
                                   {{ $isSelected || $isCorrect ? 'checked' : '' }} disabled>
                            <!-- Disable checkboxes for display -->

                            <label class="form-check-label text-success"
                                   for="option_{{$attempt->question->id}}_{{$key2}}">
                                {!!$option!!}
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
    
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.katex-html').hide();
</script>







