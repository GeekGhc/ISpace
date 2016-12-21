@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/notification.css">
    <style>
        body{
            background: #f5f7f9;
        }
    </style>
@endsection
@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <div class="notify-main">
            <div class="ui pointing secondary menu">
                <a class="item active" data-tab="first"><i class="fa fa-comment"></i>未读消息</a>
                <a class="item" data-tab="second"><i class="fa fa-comments"></i>所有消息通知</a>
                <a class="item" data-tab="third"><i class="fa fa-commenting"></i>私信消息</a>
            </div>

            <div class="notify-weight">
                <section class="notify-weight-item">
                    <div class="notify-weight-left">
                        <i class="fa fa-comment-o"></i>
                    </div>
                    <div class="notify-weight-right">
                        <p class="notify-weight-info">
                            3小时前
                        </p>
                        <p><a>JellyBean</a>回复了你的评论<a>关于七牛云上传</a></p>
                    </div>
                </section>
            </div>

        </div>
        </div>
    </div>
</div>
    <script>
        $('.ui.menu .item').on('click',function () {
            $.tab('change tab', 'first');
        });

    </script>
@endsection