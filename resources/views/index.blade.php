@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/index.css">
@endsection
@section('title','ISpace Community')
@section('content')
    <div class="hero-header">
        <div class="hero-bck">
            <div class="container">
                <div class="col-md-6 col-md-offset-3 hero-header-title">
                    <p>ISpace Community</p>
                    <h2>从这里开启你的梦想</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="pexels">
    <div class="container">
        @include('flash::message')
        <div class="row">
            @foreach($video_series as $video_serie)
            <div class="col-md-4">
                <div class="my-video">
                    <span class="series-tag">最近更新</span>
                    <a class="thumbnail-link" href="/series/{{$video_serie->name}}">
                        <div class="play-button">
                            <span class="arrow"><i class="fa fa-play-circle-o video-icon"></i></span>
                        </div>
                        <div class="thumbnail ispace-video-theme">
                            <img style="height: 224px" src="{{$video_serie->thumbnail}}">
                        </div>
                    </a>
                    <div class="video-info">
                        <span>{{$video_serie->name}}
                            <p class="video-series-count">12 LESSONS</p>
                        </span>
                        {{--<span>{{$video_serie->intro}}</span>--}}
                    </div>
                </div>
            </div>
            @endforeach

            {{--<div class="col-md-3 col-xs-12">
                <div class="weight-messages">
                    <a class="weight-messages_item">我的主页</a>
                    <a class="weight-messages_item">我的文章</a>
                    <a class="weight-messages_item">我的笔记</a>
                    <a class="weight-messages_item">我的提问</a>
                    <a class="weight-messages_item">我的回答</a>
                </div>
            </div>--}}
        </div>
    </div>
    </div>
    <script>
        $('#flash-overlay-modal').modal();
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@endsection