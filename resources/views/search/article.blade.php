@extends('app')
@section('title','ISpace Community')
@section('header-css')
    {{--<link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/video.css">--}}
    <style>
        body {
            background: #f5f5f1;
        }
    </style>
@endsection
@section('content')
    <div class="container section-content" id="app">
        <div class="row search-row">
            <div class="col-md-12 col-sm-12">

                @include('common.search_navbar')

                <div class="col-md-9">

                    <div class="collections-list" id="search-article">
                        <ul class="collection-list-ul">
                            @foreach($articles as $article)
                                <li>
                                    <div class="reply-media">
                                        <div class="reply-info">
                                            <a>{{$article->comment_count}}</a>回复
                                        </div>
                                    </div>
                                    <a class="avatar"><img class="img-circle" src="{{$article->user->avatar}}"></a>
                                    <div class="collection-info">
                                        <span class="title"><a
                                                    href="{{url('/article/'.$article->id)}}">{{$article->title}}</a>
                                        </span>
                                        <div>
                                            <div class="publish-info" style="color: #426799;">
                                                <a style="font-weight: bold">{{$article->user->name}}</a>
                                                <span>{{$article->created_at->diffForHumans()}}发表</span>
                                            </div>
                                            <div class="tags">
                                                @foreach($article->tags as $tag)
                                                    <span class="ui label {{$tag->type}}">{{$tag->name}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{$articles->links()}}
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    <script>
        $(function () {
                $('#search-post-list').removeClass('active');
                $('#search-article-list').addClass('active');
                $('#search-video-list').removeClass('active');
        })
    </script>
@endsection