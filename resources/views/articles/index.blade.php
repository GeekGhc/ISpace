@extends('app')
<meta id="module" content="article">
@section('header-css')
    <link rel="stylesheet" href="/css/article.css">
    <meta>
   {{-- <style>
        body{
            background-color: #E7F1F5;
        }
    </style>--}}
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="main col-md-9 col-xs-12">
                @foreach($articles as $article)
                    <ul class="article-list">
                        <li class="article-item">
                            <div>
                                <p class="article-list_top">
                                    <a href="" class="author-name">{{$article->user->name}}</a>
                                    <span><time>{{$article->created_at->diffForHumans()}}</time>发表</span>
                                </p>
                                <div class="article-item_title">
                                    <a href="{{url('/article/'.$article->id)}}">{{$article->title}}</a>
                                </div>
                                <div class="article-item_footer">
                                    <span>   阅读 <em>{{$article->view_count}}</em></span>
                                    <span> · 评论 <em>{{$article->comment_count}}</em></span>
                                    <span> · 关注 <em>68</em></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
                    {{$articles->links()}}
            </div>


            <div class="side col-md-3 col-xs-12">
                <div class="side-article">
                    <p>今天你有什么感悟灵感呢?</p>
                    <a href="{{url('/article/create')}}" class="btn btn-primary btn-block">写文章</a>
                </div>
            </div>
        </div>
    </div>
@endsection