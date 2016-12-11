@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/video.css">
    <style>
        body{
            background-color: #edf1f2;
        }
        .navbar-inverse {
            border-color: transparent;
        }
    </style>
@endsection
@section('content')
<div class="video-info">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container" style="margin-bottom: 18px">
                    <div class="row">
                        <div class="video-series-name col-md-12">开发团队管理系统</div>
                        <div class="series-description col-md-8">
                            <span>简介: </span>
                            <p>轻松学习PHP基础知识，了解PHP中的变量、变量的类型、常量等概念，认识PHP中的运算符，掌握PHP中顺序结构、条件结构、循环结构三种语言结构语句。</p>
                        </div>
                        <div class="video-clearfix col-md-3">
                            <ul>
                                <li class="static_item" style=" border-right: 1px solid #aaa;padding-left: 0">
                                    <span class="video-item-meta">课程时长</span>
                                    <span class="video-item-value">23:45</span>
                                </li>
                                <li class="static_item">
                                    <span class="video-item-meta">关注人数</span>
                                    <span class="video-item-value">35</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="video-list">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="episode-outline table table-hover" style="background: #fff">
                    <tbody>
                        <tr class="episode-wrap">
                            <td class="episode-index"><i class="fa fa-code icon-type"></i><span>1</span></td>
                            <td class="episode-title">
                                <a href="/series/laravel-php/1">
                                    <i class="fa fa-play-circle"></i>
                                    <span>laravel5.3的路由讲解</span>
                                </a>
                            </td>
                            <td class="episode-date">
                                <span>2016-2-9</span>
                                <time>7:03</time>
                            </td>
                        </tr>
                        <tr class="episode-wrap">
                            <td class="episode-index"><i class="fa fa-code icon-type"></i><span>1</span></td>
                            <td class="episode-title">
                                <a href="/series/laravel-php/2">
                                    <i class="fa fa-play-circle"></i>
                                    <span>laravel5.3 Container理解</span>
                                </a>
                            </td>
                            <td class="episode-date">
                                <span>2016-2-9</span>
                                <time>7:03</time>
                            </td>
                        </tr>
                        <tr class="episode-wrap">
                            <td class="episode-index"><i class="fa fa-code icon-type"></i><span>1</span></td>
                            <td class="episode-title">
                                <a href="#">
                                    <i class="fa fa-play-circle"></i>
                                    <span>邮件发送服务</span>
                                </a>
                            </td>
                            <td class="episode-date">
                                <span>2016-2-9</span>
                                <time>7:03</time>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection