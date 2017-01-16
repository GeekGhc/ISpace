@extends('app')
@section('title',$profile->user->name.'的主页')
@section('header-css')
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/search.css">
@endsection
@section('header-js')
    <script src="/js/source/vue.js"></script>
    <script src="/js/source/vue-resource.min.js"></script>
@endsection
@section('content')
    <div class="profile" id="app">
        @include('common.profile_header')

        <div class="container">
            <div class="profile-main row">
                @include('common.profile_left_navbar')


                <div class="profile-posts col-md-9 profile-my-content">
                    <h3 class="ui horizontal divider header">
                        <i class="bar chart icon"></i>
                        @if(\Auth::user()->owns($profile))
                            我的回答
                        @else
                            他的回答
                        @endif
                    </h3>
                    <ul class="profile-list">
                        @foreach($posts as $post)
                            <li>
                                <div class="row">
                                    <div class="col-md-1 col-xs-1">
                                        <span class="label label-success profile-label">{{$post->comment_count}}回复</span>
                                    </div>
                                    <div class="col-md-8 col-xs-8">
                                        <a class="profile-article-title"
                                           href="/discussion/{{$post->id}}">{{$post->title}}</a>
                                    </div>
                                    <div class="col-md-3 col-xs-3" style="font-size: 16px">
                                        <span class="profile-article-time">帖子发表于{{$post->created_at->diffForHumans()}}</span>
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
            $('#profile-answers-list').addClass('active');
        });
    </script>
    @include('common.profile_follow_user')
@endsection