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
                        <a class="item active" data-tab="first" href="/user/notifications"><i class="fa fa-comment"></i>未读消息</a>
                        <a class="item" data-tab="second" href="/user/notifications/all"><i class="fa fa-comments"></i>所有消息通知</a>
                        <a class="item" data-tab="third" href="/user/notifications/message"><i class="fa fa-commenting"></i>私信消息</a>
                        <a href="/user/notifications/read" style="float: right;padding-top: 5px"><button class="ui teal button">全部标记为已读</button></a>
                    </div>

                    <div class="notify-weight">
                        @foreach(\Auth::user()->unreadNotifications as $notification)
                        <section class="notify-weight-item">
                            <div class="notify-weight-left">
                                <i class="fa fa-comment-o"></i>
                            </div>
                            <div class="notify-weight-right">
                                <p class="notify-weight-info">
                                    {{$notification->created_at->diffForHumans()}}
                                </p>
                                @if($notification->data['to_user_id']==0)
                                <p><a href="/u/{{$notification->data['reply_user']}}">{{$notification->data['reply_user']}}</a>回答了你的问题 <a href="/discussion/{{$notification->data['post_id']}}">{{$notification->data['post_title']}}</a></p>
                                @else
                                <p><a href="/u/{{$notification->data['reply_user']}}">{{$notification->data['reply_user']}}</a>回复了你的评论 <a href="/discussion/{{$notification->data['post_id']}}">{{$notification->data['post_title']}}</a></p>
                                @endif
                            </div>
                        </section>
                        @endforeach
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