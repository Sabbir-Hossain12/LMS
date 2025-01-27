<style>
    .video-container {
        /*width:100vw;*/
        /*height:100vh;*/
        overflow: hidden;
        position: relative;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .video-container iframe {
        /*pointer-events: none;*/
    }

    .video-container iframe {
        position: absolute;
        top: -60px;
        bottom: -200px;
        left: 0;
        width: 100%;
        height: calc(100% + 120px);
    }

    .video-foreground {
        /*pointer-events:none;*/

    }
</style>
<div class="lesson__content__main video-container" id="iframe-wrapper">

        <div class="lesson__content__wrap">
            <h3>{{$video->title ?? ''}}</h3>
        </div>

    <div class="plyr__video-embed video-foreground rbtplayer" oncontextmenu="return false;">

        {{--        <iframe--}}
        {{--                src="https://www.youtube.com/embed/W0LHTWG-UmQ?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist=W0LHTWG-UmQ&mute=1"--}}
        {{--                frameBorder="0" allowFullScreen>--}}

        {{--        </iframe>--}}
        <iframe src="{{$video->video_url ?? ''}}?controls=0&showinfo=0&rel=0&loop=1&mute=0"></iframe>
        {{--            <iframe type="text/html" src="https://www.youtube.com/embed/-ePDPGXkvlw?autoplay=1" frameborder="0" allow="autoplay"></iframe>--}}
    </div>

</div>

           