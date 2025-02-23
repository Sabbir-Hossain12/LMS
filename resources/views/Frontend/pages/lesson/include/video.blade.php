
<div class="lesson__content__main">
    @if($video->start_time <= now())
        
        <div class="lesson__content__wrap">
            <h3>{{$video->title ?? ''}}</h3>
            {{--        <span><a href="javascript:void(0)">Close</a></span>--}}
        </div>

        <div class="plyr__video-embed rbtplayer">
            <iframe src="{{$video->video_url ?? ''}}" allowfullscreen="" allow="autoplay"></iframe>
        </div>

    @else
        <h3 class="text-center mt-4">Video will be available
            on {{date('d M, Y h:i A', strtotime($video->start_time))}}</h3>
    @endif
</div>

           