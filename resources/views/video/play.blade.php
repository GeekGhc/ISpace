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
                    <span>{{$video->title}}</span>
                </div>
                <div class="col-md-12 video-container">
                    <div class="video-show">
                        <video id="ispace-video" style="outline: none;width: 1170px;height: 490px;"
                               class="video-js vjs-default-skin vjs-big-play-centered"
                               preload="auto"
                               {{--tabindex="-1"--}}
                               controls
                               poster="/images/video/back.jpg"
                               data-setup='{"example_option":true}'
                        >
                            <source id="sourceBox" src="{{$video->url}}" type='video/mp4'>
                            <p class="vjs-no-js">
                                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                    video</a>
                            </p>
                        </video>
                        <div class="video-catalog">
                            <div style="color: #999;font-size: 18px">
                                <a href="/series/{{$video_series->name}}" style="text-decoration: none">{{$video_series->name}}</a>
                                <span style="font-weight: bold;"> &gt;&gt; </span>
                                <a href="#">{{$video->title}}</a>
                                <span style="margin-left: 14px"><i></i>{{$video->created_at}}</span>
                                <div class="video-button-list">
                                    <a class="btn btn-default"><i class="fa fa-star"></i>收藏</a>
                                    <a class="btn btn-default" id="video-download"><i class="fa fa-download"></i>下载视频</a>
                                    <a class="btn btn-default" href="/series/{{$video_series->name}}/video/{{$video_index-1}}"><i class="fa fa-arrow-left"></i>上一节</a>
                                    <a class="btn btn-default" href="/series/{{$video_series->name}}/video/{{$video_index+1}}"><i class="fa fa-arrow-right"></i>下一节</a>
                                </div>
                            </div>
                        </div>
                        <div  class="video-intro">
                            {{$video->intro}}
                        </div>
                        <div class="video-share"></div>
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
            fluid: true,
            preload: 'metadata',
           /* "playbackRates":[0.5,1,1.25,1.5,1.75,2],
            controls: true,
            bigPlayButton: true,
            LoadingSpinner:false,
            textTrackDisplay: true,
            posterImage: false,
            errorDisplay: true,
            controlBar : {
                LiveDisplay:false,
                VolumeMenuButton:false
            }*/
        };
        var player = videojs('ispace-video', options)
    </script>
@endsection
