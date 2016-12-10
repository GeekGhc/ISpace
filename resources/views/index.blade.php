@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/index.css">
@endsection
@section('title','社区')
<meta id="module" content="ISpace">
@section('content')
    <div class="hero-header">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 hero-header-title">
                <p>Become a Part of  ISpace Community</p>
                <h3></h3>
            </div>
        </div>
    </div>
    <div class="pexels">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="my-video">
                    <span class="series-tag">最近更新</span>
                    <a class="thumbnail-link" href="/series/php-laravel">
                        <div class="play-button">
                            <span class="arrow"><i class="fa fa-play-circle-o video-icon"></i></span>
                        </div>
                        <div class="thumbnail ispace-video-theme">
                            <img style="height: 224px" src="/images/video/back.jpg">
                        </div>
                    </a>
                    <div class="video-info">
                        <h3>开发任务管理系统</h3>
                        <span>采用laravel框架开发</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="my-video">
                    <span class="series-tag">最近更新</span>
                    <a class="thumbnail-link">
                        <div class="play-button">
                            <span class="arrow"><i class="fa fa-play-circle-o video-icon"></i></span>
                        </div>
                        <div class="thumbnail ispace-video-theme">
                            <img style="height: 224px" src="/images/video/back.jpg">
                        </div>
                    </a>
                    <div class="video-info">
                        <h3>开发任务管理系统</h3>
                        <span>采用laravel框架开发</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="my-video">
                    <span class="series-tag">最近更新</span>
                    <a class="thumbnail-link">
                        <div class="play-button">
                            <span class="arrow"><i class="fa fa-play-circle-o video-icon"></i></span>
                        </div>
                        <div class="thumbnail ispace-video-theme">
                            <img style="height: 224px" src="/images/video/back.jpg">
                        </div>
                    </a>
                    <div class="video-info">
                        <h3>开发任务管理系统</h3>
                        <span>采用laravel框架开发</span>
                    </div>
                </div>
            </div>
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
   {{-- <script>
        $('#flash-overlay-modal').modal();
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>--}}
@endsection