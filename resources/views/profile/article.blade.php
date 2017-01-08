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


                <div class="profile-posts col-md-9 profile-my-content">
                    <h3 class="ui horizontal divider header"><i class="bar chart icon"></i> 我的文章 </h3>
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

            </div>
        </div>
    </div>

@endsection
@section('footer-js')
    <script>
        $(document).ready(function () {
            $('#profile-articles-list').addClass('active');
        });
    </script>
@endsection