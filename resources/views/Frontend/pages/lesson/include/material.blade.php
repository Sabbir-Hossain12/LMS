<div class="lesson__meterials__wrap">
    <div class="aboutarea__content__wraper__5">
      
        @if($material->type == 'text') 
            
            {!! $material->text !!}
            
        @elseif($material->type == 'file')
            <iframe src="{{asset($material->file)}}" width="100%" height="500px"></iframe>
            
        @elseif($material->type == 'url')
            <iframe src="{{$material->url}}" width="100%" height="500px"></iframe>
        @endif
        

    </div>
</div>