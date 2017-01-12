@extends('app')
@section('title','文章-ISpace Community')
<meta id="module" content="article">
@section('header-css')
    <link rel="stylesheet" href="/css/article.css">
@endsection

@section('content')
    <div class="container section-content">
        <div class="row">

            <div class="main col-md-9 col-xs-12" style="padding-top: 10px">
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
                                    <div class="tagsLabel">
                                    <ul>
                                        @foreach($article->tags as $tag)
                                        <li class="tagLabel"><span class="ui label {{$tag->type}}">{{$tag->name}}</span></li>
                                        @endforeach
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
                    {{--{{$articles->links()}}--}}
                    {!! PaginateRoute::renderPageList($articles,false,'pagination',true) !!}
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