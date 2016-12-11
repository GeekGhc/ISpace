@extends('app')
@section('header-css')
    <link href="http://vjs.zencdn.net/5.12.6/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/video.css">
@endsection
@section('content')
    <div class="video-lesson">
        <div class="container video-wrap">
            <div class="row">
                <div class="col-md-12 video-title">
                    <span>Laravel开始使用VueJs</span>
                </div>
                <div class="col-md-12 video-container">
                    <div class="video-show">
                        <video id="ispace-video" style="outline: none;width: 1170px;height: 490px;"
                               class="video-js vjs-default-skin vjs-big-play-centered"
                               preload="auto"
                               tabindex="-1"
                               poster="/images/video/back.jpg"
                               data-setup='{"example_option":true}'
                        >
                            <source id="sourceBox" src="http://static.qiakr.com/movie/0060202.mp4" type='video/mp4'>
                            <p class="vjs-no-js">
                                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                    video</a>
                            </p>
                        </video>
                    </div>
                    <!-- If you'd like to support IE8 -->
                    <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
                    <script src="http://vjs.zencdn.net/5.12.6/video.js"></script>
                </div>
            </div>
        </div>
    </div>
    <script>
        var options = {
            controls: true,
            techOrder : ["html5","flash"],
            "playbackRates":[0.5,1,1.25,1.5,1.75,2],
            bigPlayButton: true,
            textTrackDisplay: true,
            posterImage: false,
            errorDisplay: true,
            controlBar : {
                captionsButton : false,
                chaptersButton: false,
                subtitlesButton:false,
                liveDisplay:false,
                playbackRateMenuButton:false
            }
           /* controlBar: {
                captionsButton: true,
                CurrentTimeDisplay:true,
                TimeDivider:true,
                Duration:true,
                chaptersButton: true,
                subtitlesButton: true,
                liveDisplay: true,
                playbackRateMenuButton: true
            }*/

        };
        var player = videojs('ispace-video', options);
        player.on('ready',function () {
            console.log($(this));
        })
    </script>
@endsection
