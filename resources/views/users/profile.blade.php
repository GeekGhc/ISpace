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
                    <li class="active"><a>我的文章</a></li>
                    <li><a>我的帖子</a></li>
                    <li><a>我的回答</a></li>
                </ul>
                <div class="profile-articles">
                    <ul class="profile-list">
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">8回复</span>
                                </div>
                                <div class="col-md-7">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程</a>
                                </div>
                                <div class="col-md-2">
                                    <a>代码不日记</a>
                                </div>
                                <div class="col-md-2">
                                    <span class="profile-article-time">2016年8月8号</span>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">8回复</span>
                                </div>
                                <div class="col-md-7">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程</a>
                                </div>
                                <div class="col-md-2">
                                    <a>代码不日记</a>
                                </div>
                                <div class="col-md-2">
                                    <span class="profile-article-time">2016年8月8号</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">8回复</span>
                                </div>
                                <div class="col-md-7">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程</a>
                                </div>
                                <div class="col-md-2">
                                    <a>代码不日记</a>
                                </div>
                                <div class="col-md-2">
                                    <span class="profile-article-time">2016年8月8号</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">8回复</span>
                                </div>
                                <div class="col-md-7">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程</a>
                                </div>
                                <div class="col-md-2">
                                    <a>代码不日记</a>
                                </div>
                                <div class="col-md-2">
                                    <span class="profile-article-time">2016年8月8号</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-1">
                                    <span class="label label-success profile-label">8回复</span>
                                </div>
                                <div class="col-md-7">
                                    <a class="profile-article-title">Laravel 5 系列教程二：路由，视图，控制器工作流程</a>
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
            </div>
        </div>
    </div>
@endsection