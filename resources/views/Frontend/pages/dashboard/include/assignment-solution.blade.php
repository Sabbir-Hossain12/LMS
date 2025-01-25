<div class="quiz__single__attemp__wrapper">

    <div class="dashboard__section__title">
        <h4>Solution For {{$examType->title}} </h4>
        <a href="javascript:void(0)" class="examCloseBtn"> <i class="fa fa-x close"></i></a>
    </div>

    <div class="quiz__single__attemp__content">
      <iframe src="{{$assignment->solution ?? ''}}" width="100%" height="500px"></iframe>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>








