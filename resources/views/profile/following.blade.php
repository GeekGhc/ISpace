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
    @inject('count','App\UserProfile\Profile')
    <div class="profile" id="app">
        @include('common.profile_header')

        <div class="container">
            <div class="profile-main row">
                @include('common.profile_left_navbar')


                <div class="profile-posts col-md-9 profile-my-content">
                    <h3 class="ui horizontal divider header">
                        <i class="bar chart icon"></i>
                        @if($user->owns($profile)&&\Auth::check())
                            我关注的人
                        @else
                            他关注的人
                        @endif
                    </h3>
                    <ul class="profile-user-list">
                        @foreach($followings as $following)
                            <li>
                                <a class="avatar">
                                    <img src="{{$following->avatar}}">
                                </a>
                                <div class="info">
                                    <a href="/u/{{$following->name}}" class="follow-user-name">{{$following->name}}</a>
                                    <div class="follow-meta">
                                        <span>关注 {{$following->followings_count}}</span>
                                        <span>粉丝 {{$following->followers_count}}</span>
                                        <span>文章 {{$count->articlesCount($following->name)}}</span>
                                        <span>帖子 {{$count->postsCount($following->name)}}</span>
                                    </div>
                                </div>
                                @if(\Auth::id()!==$following->id)
                                    <div class="follow_button">
                                        <follow-user-button user_id="{{$following->id}}"></follow-user-button>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        {{--{{$followings->links()}}--}}
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer-js')
    <script>
        $(document).ready(function () {
            $('#profile-followings-list').addClass('active');
        });
    </script>
    @include('common.profile_follow_user')
@endsection