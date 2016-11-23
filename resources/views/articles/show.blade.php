@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/article.css">
    <style>
        body {
            background: #f5f5f1;
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
            <div class="author-info">
                @if(\Auth::check())
                    @if($article->user->id===\Auth::user()->id)
                        <div class="btn btn-primary edit-article-btn">
                            <a href="{{url('/article/'.$article->id.'/edit')}}">
                                <span>编辑文章</span>
                            </a>
                        </div>
                    @else
                        <div class="btn btn-default my-favorite" id="favorite">
                            <a type="button"
                               @if($isFavorite===2)href="{{url('user/login')}}"@endif>
                                <i class="fa  fa-star-o" ></i>
                                @if($isFavorite==1)
                                    已收藏{{$isFavorite}}
                                @else添加收藏{{$isFavorite}}
                                @endif
                            </a>
                        </div>
                        <div class="btn btn-success follow">
                            <a>
                                <i class="fa fa-star-o"></i><span>关注作者</span>
                            </a>
                        </div>
                    @endif
                @endif
                <a class="article-show_avatar">
                    <img class="img-circle" src="/images/avatar/head.jpg">
                </a>
                <label class="label">作者</label>
                <a class="article-show_author-name" href="">
                    <span>{{$article->user->name}}</span>
                </a>
                <span class="article-show_publish-time">2016.5.12 13:58</span>
                <div class="article-show_favorite">
                    <span><em>67</em>人关注</span>
                </div>
            </div>
            <h2 class="article-show_title">{{$article->title}}</h2>
            <div class="meta-top">
                <span>阅读<em>{{$article->view_count}}</em></span>
                <span>评论<em>{{$article->comment_count}}</em></span>
                <span>关注<em>353</em></span>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
            <div class="article-show_body">
                {!! $article->html_body !!}
            </div>
        </div>
    </div>
<script>
    var isFavorite = {{$isFavorite}};
    $('#favorite').on('click', function () {

        if (isFavorite===1)//取消收藏
        {
            console.log('fav = '+isFavorite);
            isFavorite = 0;
            $(this).html('<i class="fa  fa-star-o"></i>' + '添加收藏');

            $.ajax({
                type: 'POST',
                url: "/favArticle",
                data: { 'favoriteable_id': '{{$article->id}}','isFavorite':'0'},
                headers: {
                    'X-CSRF-Token': document.querySelector('#token').getAttribute('value')
                },
                dataType: 'json',
                async: false,
                success: function (json) {
                    console.log(json);
                },
                error: function () {
                    alert("数据异常");
                }
            })
        }
        else//添加收藏
        {
            console.log('fav = '+isFavorite);
            isFavorite = 1;
            $(this).html('<i class="fa  fa-star-o"></i>' + '已收藏');

            $.ajax({
                type: 'POST',
                url: "/favArticle",
                data: { 'favoriteable_id': '{{$article->id}}','isFavorite':'1'},
                headers: {
                    'X-CSRF-Token': document.querySelector('#token').getAttribute('value')
                },
                dataType: 'json',
                async: false,
                success: function (json) {
                    console.log(json);
                },
                error: function () {
                    alert("数据异常");
                }
            })
        }
    });
</script>
@endsection
