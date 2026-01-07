<style>
    .lesson__content__wrap {
        padding: 15px 20px !important;
    }

    @media (max-width: 767px) {
        /* CSS for mobile devices */
        .lesson__content__wrap {
            padding: 12px 20px !important;
        }
    }

    .lesson__content__wrap.footer {
        padding: 15px 10px !important;
        bottom: 0 !important;
    }

    @media (min-width: 767px) {
        .lesson__content__wrap.footer {
            padding: 23px 10px !important;
            bottom: 0 !important;
        }
    }
</style>
<div class="lesson__content__main">
    @if($video->start_time <= now())

        <div class="lesson__content__wrap">
            <h3>{{$video->title ?? ''}}</h3>
            {{--        <span><a href="javascript:void(0)">Close</a></span>--}}
        </div>

        <!--<div class="plyr__video-embed rbtplayer">-->
        <!--    <iframe src="{{$video->video_url ?? ''}}" allowfullscreen="" allow="autoplay"></iframe>-->
        <!--</div>-->

        @if($video->video_file)
            {{-- Play uploaded video --}}
            <video class="rbtplayer" id="lessonVideoPlayer" controls playsinline
                   oncontextmenu="return false;"
                   controlsList="nodownload noremoteplayback noplaybackrate" width="100%">
                <source src="{{ asset($video->video_file) }}" type="video/mp4">
                <!--Your browser does not support the video tag.-->
            </video>
        @elseif($video->video_url)
            {{-- Play embedded video (YouTube/Vimeo) --}}
            <div class="plyr__video-embed rbtplayer">
                <iframe src="{{ $video->video_url }}" allowfullscreen allow="autoplay"></iframe>
            </div>
        @endif

    @else
        <h3 class="text-center mt-4">Video will be available
            on {{date('d M, Y h:i A', strtotime($video->start_time))}}</h3>
    @endif

    <div class="lesson__content__wrap footer">
        <h3></h3>
        {{--        <span><a href="javascript:void(0)">Close</a></span>--}}
    </div>
</div>

