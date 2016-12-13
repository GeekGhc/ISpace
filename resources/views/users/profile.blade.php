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
                                <img class="profile-user-avatar" src="/images/avatar/head.jpg">
                            </a>
                        </div>
                        <div class="profile-header-social">
                            <ul>
                                <li><a class="fa fa-github fa-2x"></a></li>
                                <li><a class="fa fa-weibo fa-2x"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="profile-head-name">
                            <h2>JellyBean</h2>
                        </div>
                        <div class="profile-head-other">
                            <div class="profile-other-item">
                                <i class="fa fa-map-marker profile-head-fa"></i>
                                <span>南京</span>
                            </div>
                            <div class="profile-other-item">
                                <i class="fa fa-graduation-cap profile-head-fa"></i>
                                <span>金陵科技学院</span>
                            </div>
                            <div class="profile-other-item">
                                <i class="fa fa-chrome profile-head-fa"></i>
                                <span>www.kobeman.com</span>
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
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">8回复</span>
                                </div>
                                <div class="col-md-7">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程(文章)</a>
                                </div>
                                <div class="col-md-2">
                                    <a>代码不日记</a>
                                </div>
                                <div class="col-md-2">
                                    <span class="profile-article-time">2016年8月8号</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="profile-posts" style="display: none">
                    <ul class="profile-list">
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">9回复</span>
                                </div>
                                <div class="col-md-9">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程(帖子)</a>
                                </div>
                                <div class="col-md-2">
                                    <span class="profile-article-time">2016年8月8号</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="profile-notes" style="display: none">
                    <ul class="profile-list">
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">8回复</span>
                                </div>
                                <div class="col-md-9">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程(笔记)</a>
                                </div>
                                <div class="col-md-2">
                                    <span class="profile-article-time">2016年8月8号</span>
                                </div>
                            </div>
                        </li>
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