@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/search.css">
    <style>
        body {
            background: #f5f5f1;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <div class="search-title">
                    <ul class="collection-nav">
                        <li class="active"><a>相关文章</a></li>
                        <li class=""><a>相关帖子</a></li>
                        <li class=""><a>相关视频</a></li>
                    </ul>
                </div>
                <div class="collections-list">
                    <ul>
                        @foreach($articles as $article)
                            <li>
                                <div class="reply-media">
                                    <div class="reply-info">
                                        <a>{{$article->comment_count}}</a>回复
                                    </div>
                                </div>
                                <a class="avatar"><img class="img-circle" src="{{$article->user->avatar}}"></a>
                                <div class="collection-info">
                                    <span class="title"><a href="{{url('/article/'.$article->id)}}">{{$article->title}}</a></span>
                                    <div class="description">
                                        {!! $article->html_body !!}
                                    </div>
                                    <div>
                                        <div class="publish-info"><a>{{$article->user->name}}</a>
                                            <span>{{$article->created_at->diffForHumans()}}发表</span>
                                        </div>
                                        <div class="tags">
                                            <span class="label label-success">Laravel</span>
                                            <span class="label label-warning">PHP</span>
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