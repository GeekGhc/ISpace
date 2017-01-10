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
                <div class="col-md-12">

                <section id="cd-timeline" class="cd-container">
                    <div class="cd-timeline-block">
                        <div class="cd-timeline-img cd-favorite tooltip-pro" data-toggle="tooltip" data-placement="left" title="收藏文章">
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
                </section>

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
