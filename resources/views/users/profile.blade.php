@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/profile.css">
@endsection
@section('content')
    <div class="profile">
        <div class="profile-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="profile-user-header">
                            <a href="#">
                                <img class="profile-user-avatar" src="{{$profile->user->avatar}}">
                            </a>
                        </div>
                        <div class="profile-header-social">
                            <ul>
                                <li><a class="fa fa-github fa-2x"></a></li>
                                <li><a class="fa fa-weibo fa-2x"></a></li>
                                <li><a class="fa fa-qq fa-2x"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="profile-head-name">
                            <h2>{{$profile->user->name}}</h2>
                        </div>
                        <div class="profile-head-other">
                            <div class="profile-other-item">
                                <i class="fa fa-map-marker profile-head-fa"></i>
                                <span>{{$profile->city}}</span>
                            </div>
                            <div class="profile-other-item">
                                <i class="fa fa-graduation-cap profile-head-fa"></i>
                                <span>{{$profile->school}}</span>
                            </div>
                            <div class="profile-other-item">
                                <i class="fa fa-chrome profile-head-fa"></i>
                                <span><a href="http://{{$profile->website}}" target="_blank">{{$profile->website}}</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="font-size: 20px;font-weight: bold">个人简介</div>
                            <div class="panel-body" style="min-height: 120px;font-size: 16px">
                                {{$profile->description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="profile-main">
                <ul class="nav profile-nav nav-tabs">
                    <li id="profile-article" class="active"><a>我的文章</a></li>
                    <li id="profile-post"><a>我的帖子</a></li>
                    <li id="profile-note"><a>我的收藏</a></li>
                </ul>
                <div class="profile-articles">
                    <ul class="profile-list">
                        @foreach($articles as $article)
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">{{$article->comment_count}}回复</span>
                                </div>
                                <div class="col-md-8">
                                    <a class="profile-article-title" href="/article/{{$article->id}}">{{$article->title}}</a>
                                </div>
                                <div class="col-md-3" style="font-size: 16px">
                                    <span class="profile-article-time">文章发表于{{$article->created_at->diffForHumans()}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="profile-posts" style="display: none">
                    <ul class="profile-list">
                        @foreach($posts as $post)
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">{{$post->comment_count}}回复</span>
                                </div>
                                <div class="col-md-8">
                                    <a class="profile-article-title" href="/discussion/{{$post->id}}">{{$post->title}}</a>
                                </div>
                                <div class="col-md-3" style="font-size: 16px">
                                    <span class="profile-article-time">帖子发表于{{$post->created_at->diffForHumans()}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="profile-notes" style="display: none">
                    <ul class="profile-list">
                        @foreach($favorites as $favorite)
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">{{$favorite->favoriteable->comment_count}}回复</span>
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
    <script>
        $("#profile-article").on('click',function(){
            $(this).siblings().removeClass("active");
            $(this).addClass('active');
            $('.profile-articles').css('display','block');
            $('.profile-posts').css('display','none');
            $('.profile-notes').css('display','none');
        })
        $("#profile-post").on('click',function(){
            $(this).siblings().removeClass("active");
            $(this).addClass('active');
            $('.profile-articles').css('display','none');
            $('.profile-posts').css('display','block');
            $('.profile-notes').css('display','none');
        })
        $("#profile-note").on('click',function(){
            $(this).siblings().removeClass("active");
            $(this).addClass('active');
            $('.profile-articles').css('display','none');
            $('.profile-posts').css('display','none');
            $('.profile-notes').css('display','block');
        })
    </script>
@endsection