<div class="quiz__single__attemp__wrapper">

    <div class="dashboard__section__title">
        <h4>Solution For {{$examType->title}} </h4>
      <a href="javascript:void(0)" class="examCloseBtn"> <i class="fa fa-x close"></i></a>
    </div>
    
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
                                   id="option_{{$question->id}}_{{$key2}}" value="{{$option}}" @if($option == $question->correct_answers) checked @endif disabled>
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
    
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>








