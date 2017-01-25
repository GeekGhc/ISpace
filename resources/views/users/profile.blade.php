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
                @include('common.profile_left_navbar')


                <div class="profile-articles col-md-9" style="display:none;">
                    <ul class="profile-list">
                        @foreach($articles as $article)
                            <li>
                                <div class="row">
                                    <div class="col-md-1">
                                        <span class="label label-success profile-label">{{$article->comment_count}}
                                            回复</span>
                                    </div>
                                    <div class="col-md-8">
                                        <a class="profile-article-title"
                                           href="/article/{{$article->id}}">{{$article->title}}</a>
                                    </div>
                                    <div class="col-md-3" style="font-size: 16px">
                                        <span class="profile-article-time">文章发表于{{$article->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="profile-posts col-md-9" style="display: block;">
                    <h4 class="ui horizontal divider header"><i class="bar chart icon"></i> 我的回答 </h4>
                    <ul class="profile-list">
                        @foreach($posts as $post)
                            <li>
                                <div class="row">
                                    <div class="col-md-1">
                                        <span class="label label-success profile-label">{{$post->comment_count}}
                                            回复</span>
                                    </div>
                                    <div class="col-md-8">
                                        <a class="profile-article-title"
                                           href="/discussion/{{$post->id}}">{{$post->title}}</a>
                                    </div>
                                    <div class="col-md-3" style="font-size: 16px">
                                        <span class="profile-article-time">帖子发表于{{$post->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="profile-notes col-md-9" style="display: none">
                    <ul class="profile-list">
                        @foreach($favorites as $favorite)
                            <li>
                                <div class="row">
                                    <div class="col-md-1">
                                        <span class="label label-success profile-label">{{$favorite->favoriteable->comment_count}}
                                            回复</span>
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
@endsection
@section('footer-js')
    <script>
        $(document).ready(function () {
            $('.tooltip-pro').tooltip('hide');
        });
    </script>
@endsection