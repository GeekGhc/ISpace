@extends('app')
@section('title','ISpace Community')
@section('header-css')
    <link rel="stylesheet" href="/css/favorite.css">
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/comment.css">
    <style>
        body {
            background: #f5f5f1;
        }
    </style>
@endsection
@section('content')
    @include('common.favorites_nav_header')
    <div class="container favorite-section-content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">


                <div class="collections-list">
                    <ul class="collection-list-ul">
                        @foreach($articles as $article)
                            <li>
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
                    {{--{{$articles->links()}}--}}
                </div>


            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    <script>
        $(document).ready(function () {
            $('#favorite-articles-link').addClass('active');
        });
    </script>
@endsection