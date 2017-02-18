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
    <div class="container section-content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="notify-main notify-section-content">
                    <div class="ui pointing secondary menu">
                        <a class="item"  data-tab="first" href="/user/notifications"><i class="fa fa-comment"></i>未读消息</a>
                        <a class="item" data-tab="second" href="/user/notifications/all"><i class="fa fa-comments"></i>所有消息通知</a>
                        <a class="item active" data-tab="third" href="/user/notifications/message"><i class="fa fa-commenting"></i>私信消息</a>
                        <a href="/user/notifications/read" style="float: right;padding-top:5px "><button class="ui teal button">全部标记为已读</button></a>
                    </div>

                    <div class="notify-weight">

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