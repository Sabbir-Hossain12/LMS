
    <div class="lesson__content__main">
        
        <div class="lesson__content__wrap">
            <h3>{{$video->title ?? ''}}</h3>
        </div>

        <div class="plyr__video-embed rbtplayer">
            
{{--        <iframe src="https://www.youtube.com/embed/1IvAwBdP-X8?si=wWPzGjX3FHplf4n1" allowfullscreen="" allow="autoplay" oncontextmenu="return false;"></iframe>--}}
            <iframe src="{{$video->video_url ?? ''}}" allowfullscreen="" allow="autoplay" oncontextmenu="return false;"></iframe>
            
        </div>
        
    </div>
