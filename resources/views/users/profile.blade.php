@extends('app')
@section('title',$profile->user->name.'的主页')
@section('header-css')
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/search.css">
@endsection
@section('content')
    <div class="profile">
        @include('common.profile_header')

        <div class="container">
            <div class="profile-main row">
                @include('common.profile_left_navbar')

                {{--<section id="cd-timeline" class="cd-container" style="display: none;">
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-favorite tooltip-pro" data-toggle="tooltip" data-placement="left" title="收藏文章">
                            --}}{{--<i class="fa fa-github fa-2x"></i>--}}{{--
                        </div>

                        <div class="cd-timeline-content panel panel-default">
                            <div class="panel-heading">
                                <h2>HTML5+CSS3实现的响应式垂直时间轴</h2>
                            </div>
                            <div class="panel-body">
                                <p>网页时间轴一般用于展示以时间为主线的事件，如企业网站常见的公司发展历程等。本文将给大家介绍一款基于HTML5和CSS3的漂亮的垂直时间轴，它可以响应页面布局，适用于HTML5开发的PC和移动手机WEB应用。</p>
                                <a href="#" class="cd-read-more ui linkedin button">阅读全文</a>
                                <span class="cd-date">2015-01-06</span>
                            </div>
                        </div>
                    </div>

                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-post tooltip-pro" data-toggle="tooltip" data-placement="left" title="发起讨论">
                        </div>

                        <div class="cd-timeline-content panel panel-default">
                            <div class="panel-heading">
                            <h2>jQuery+PHP动态数字展示效果</h2>
                            </div>
                            <div class="panel-body">
                            <p>我们在一些应用中需要动态展示数据，比如当前在线人数，当前交易总额，当前汇率等等，前端页面需要实时刷新获取最新数据。本文将结合实例给大家介绍使用jQuery和PHP来实现动态数字展示效果。</p>
                            <a href="#" class="cd-read-more ui linkedin button">阅读全文</a>
                            <span class="cd-date">2014-12-25</span>
                            </div>
                        </div>
                    </div>
                </section>--}}

                {{-- <ul class="nav profile-nav nav-tabs">
                     <li id="profile-article" class="active"><a>我的文章</a></li>
                     <li id="profile-post"><a>我的帖子</a></li>
                     <li id="profile-note"><a>我的收藏</a></li>
                 </ul>--}}

                <div class="profile-articles col-md-9" style="display:none;">
                    <ul class="profile-list">
                        @foreach($articles as $article)
                            <li>
                                <div class="row">
                                    <div class="col-md-1">
                                        <span class="label label-success profile-label">{{$article->comment_count}}
                                            回复</span>
                                    </div>
                                    <div class="col-md-8">
                                        <a class="profile-article-title"
                                           href="/article/{{$article->id}}">{{$article->title}}</a>
                                    </div>
                                    <div class="col-md-3" style="font-size: 16px">
                                        <span class="profile-article-time">文章发表于{{$article->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="profile-posts col-md-9" style="display: block;">
                    <h4 class="ui horizontal divider header"><i class="bar chart icon"></i> 我的回答 </h4>
                    <ul class="profile-list">
                        @foreach($posts as $post)
                            <li>
                                <div class="row">
                                    <div class="col-md-1">
                                        <span class="label label-success profile-label">{{$post->comment_count}}
                                            回复</span>
                                    </div>
                                    <div class="col-md-8">
                                        <a class="profile-article-title"
                                           href="/discussion/{{$post->id}}">{{$post->title}}</a>
                                    </div>
                                    <div class="col-md-3" style="font-size: 16px">
                                        <span class="profile-article-time">帖子发表于{{$post->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="profile-notes col-md-9" style="display: none">
                    <ul class="profile-list">
                        @foreach($favorites as $favorite)
                            <li>
                                <div class="row">
                                    <div class="col-md-1">
                                        <span class="label label-success profile-label">{{$favorite->favoriteable->comment_count}}
                                            回复</span>
                                    </div>
                                    <div class="col-md-8">
                                        <a class="profile-article-title"
                                           @if($favorite->favoriteable_type==="App\Article")
                                           href="/article/{{$favorite->favoriteable->id}}"
                                           @else
                                           href="/discussion/{{$favorite->favoriteable->id}}"
                                                @endif
                                        >{{$favorite->favoriteable->title}}</a>
                                    </div>
                                    <div class="col-md-3" style="font-size: 16px">
                                        <span class="profile-article-time">最近更新于{{$favorite->favoriteable->updated_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    <script>
        $(document).ready(function () {
            $('.tooltip-pro').tooltip('hide');
        });
    </script>
@endsection