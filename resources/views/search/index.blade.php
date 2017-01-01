@extends('app')
@section('title','ISpace Community')
@section('header-css')
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/video.css">
    <style>
        body {
            background: #f5f5f1;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row search-row">
            <div class="col-md-12 col-sm-12">

                <div class="col-md-3">
                    <div class="search-menu-list">
                        <ul class="dropDown-menu">
                            <li class="item-allCategory">
                                <p>
                                    <i class="fa fa-fw fa-th-large"></i>
                                    All Category
                                </p>
                            </li>
                            <li class="dropdown-separator"></li>
                            <li class="item-category">
                                <a class="active" id="search-post-list">
                                    <span><i class="fa fa-fw fa-square" style="color: #EF6733;"></i></span>
                                    相关帖子
                                </a>
                            </li>
                            <li class="item-category">
                                <a id="search-article-list">
                                    <span><i class="fa fa-fw fa-square" style="color: #7088a9;"></i></span>
                                    相关文章
                                </a>
                            </li>
                            <li class="item-category">
                                <a id="search-video-list">
                                    <span><i class="fa fa-fw fa-square" style="color: #09d7c1;"></i></span>
                                    相关视频
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="collections-list" id="search-post" style="display: block">
                        <ul class="collection-list-ul">
                            @foreach($discussions as $discussion)
                                <li>
                                    <div class="reply-media">
                                        <div class="reply-info">
                                            <a>{{$discussion->comment_count}}</a>回复
                                        </div>
                                    </div>
                                    <a class="avatar"><img class="img-circle" src="{{$discussion->user->avatar}}"></a>
                                    <div class="collection-info">
                                        <span class="title"><a
                                                    href="{{url('/discussion/'.$discussion->id)}}">{{$discussion->title}}</a></span>
                                        <div class="description">
                                            {{mb_substr(strip_tags($discussion->html_body),0,88,"utf-8")}}
                                        </div>
                                        <div>
                                            <div class="publish-info" style="color: #7088a9;">
                                                <a style="font-weight: bold">{{$discussion->user->name}}</a>
                                                <span>{{$discussion->created_at->diffForHumans()}}发表</span>
                                                <span>
                                                    <i class="fa fa-reply"></i>
                                                    由 <a style="color: #00b1b3;font-weight: bold;">{{$discussion->last_user->name}}</a>{{$discussion->updated_at->diffForHumans()}}
                                                    更新
                                                </span>
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
                        <div class="discussion-loadMore">
                            <button class="ui orange button">
                                <span class="btn-load">Load More</span>
                            </button>
                        </div>
                        {{--{{$discussions->links()}}--}}
                    </div>


                    <div class="collections-list" id="search-article" style="display: none">
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
                                                <span class="label label-success">Laravel</span>
                                                <span class="label label-warning">PHP</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{$articles->links()}}
                    </div>

                    <div class="collections-list" id="search-video" style="display: none;padding-top: 18px">
                        <table class="ui selectable striped table">
                            <tbody>
                            <thead>
                            <tr>
                                <th colspan="3">视频系列</th>
                            </tr>
                            </thead>
                            @foreach($videos as $key=>$video)
                                <tr class="search-video-tr">
                                    <td class="collapsing"><i class="fa fa-code icon-type"></i></td>
                                    <td>
                                        <i class="fa fa-play-circle" style="margin-right: 8px;"></i>
                                        <a href="/series/{{$video->video_series->name}}">{{$video->title}} {{$video->id}} {{$video->video_series->id}}</a>
                                    </td>
                                    <td class="right aligned collapsing">
                                        <time style="margin-right: 12px;">7:03</time>
                                        <span>{{$video->created_at}}</span>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                        {{$videos->links()}}
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer-js')
    <script>
        $(function () {
            $('#search-post-list').on('click',function () {
                $(this).addClass('active');
                $('#search-article-list').removeClass('active');
                $('#search-video-list').removeClass('active');
                $('#search-post').css('display', 'block');
                $('#search-article').css('display', 'none');
                $('#search-video').css('display', 'none');
            })
            $('#search-article-list').on('click',function () {
                $(this).addClass('active');
                $('#search-post-list').removeClass('active');
                $('#search-video-list').removeClass('active');
                $('#search-post').css('display', 'none');
                $('#search-article').css('display', 'block');
                $('#search-video').css('display', 'none');
            })
            $('#search-video-list').on('click',function () {
                $(this).addClass('active');
                $('#search-post-list').removeClass('active');
                $('#search-article-list').removeClass('active');
                $('#search-post').css('display', 'none');
                $('#search-article').css('display', 'none');
                $('#search-video').css('display', 'block');
            })
        })
    </script>
@endsection