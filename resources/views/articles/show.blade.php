@extends('app')
@section('title',$article->title)
@section('header-css')
    <link rel="stylesheet" href="/css/article.css">
    <link rel="stylesheet" href="/css/discussion.css">
    <link rel="stylesheet" href="/css/comment.css">
@endsection
@section('header-js')
    <script src="/js/source/vue.js"></script>
    <script src="/js/source/vue-resource.min.js"></script>
@endsection
@section('content')
    <div id="app">
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
                            {{--<div class="btn btn-default my-favorite">--}}

                                {{--<a type="button" id="favorite" @click="favorite()"
                                @if($isFavorite===2)href="{{url('user/login')}}"@endif>
                                <i class="fa fa-star-o"></i>
                                @if($isFavorite==1)
                                    已收藏
                                @else添加收藏
                                @endif
                                </a>--}}

                                @if($isFavorite===2)
                                    <a style="float: right" class="ui inverted orange button" type="button" id="favorite" href="{{url('user/login')}}"><i class="fa fa-star"></i>添加收藏</a>
                                @elseif($isFavorite==1)
                                    <a style="float: right" class="ui  orange button" type="button" id="favorite" @click="favorite()"><i class="fa fa-star"></i>已收藏</a>
                                @else
                                    <a style="float: right" class="ui inverted orange button" type="button" id="favorite" @click="favorite()"><i class="fa fa-star"></i>添加收藏</a>
                                @endif
                            {{--</div>--}}
                            <div class="button ui green follow">
                                <a>
                                    <i class="fa fa-heart"></i><span>关注作者</span>
                                </a>
                            </div>
                        @endif
                    @endif
                    <a class="article-show_avatar">
                        <img class="img-circle" src="/images/avatar/head.jpg">
                    </a>
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
        </div>

        <div class="container" id="comment-post">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
                    <div class="post-show_content">
                        {!! $article->html_body !!}
                    </div>
                    <div class="answers-part">
                        <i class="fa fa-fw fa-thumb-tack fa-2x"></i><span>共<em>{{$article->comment_count}}</em>条评论</span>
                        <div
                                class="social-share share-component"
                                data-descritioin="一键分享"
                                data-disabled="diandian"
                                data-wechat-qrcode-title="请打开微信扫一扫"
                                data-wechat-qrcode-helper="<p>微信里点“发现”，扫一下</p><p>二维码便可将本文分享至朋友圈</p>"
                                data-mobile-sites="weibo,qq,qzone,tencent"
                                data-title="ISpace Community {{$article->title}}"
                                style="display: inline-block;margin-left: 14px"

                        >
                        </div>
                    </div>

                    <div class="comment-list">
                        <div class="comment-content">
                            @foreach($comments as $comment)
                                @if($comment->to_user_id==0&&$comment->to_comment_id==0)
                                    <reply-form :comments="{{$comments}}" :comment="{{$comment}}" v-cloak></reply-form>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="comment" v-for="newComment in commentLocalMain" v-cloak>

                        <div class="parent-comment">
                            <div class="meta-top">
                                <a class="comment-avatar"><img :src="[newComment.avatar]"></a>
                                <p class="comment-user-name">
                                    <a href="">@{{newComment.name}}</a></p>
                                <span class="reply-time">
                            <time>@{{newComment.created_at}}</time>
                            </span>
                            </div>
                            <p class="reply-content" v-html="newComment.html_body"></p>
                            <div class="comment-footer">
                            <span class="share-reply">
                                <a style="margin-right: 5px">分享</a>
                            </span>
                            </div>
                        </div>
                    </div>

                    {{--发表对帖子的评论--}}
                    @include('comments.reply_form')

                </div>
            </div>
        </div>
    </div>

    {{--reply模板--}}
    @include('comments.reply_content')

    @if(\Auth::check())
        <script>
            Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
            var comment = {
                'article_id': '{{$article->id}}',
                'user_id': '{{\Auth::user()->id}}',
                'to_user_id': '',
                'to_user_name': '',
                'to_comment_id': '',
            }
            //点击回复
            function clickReply(obj) {
                comment.to_user_id = $(obj).prev().attr('data-userid');
                comment.to_user_name = $(obj).prev().attr('data-username');
                comment.to_comment_id = $(obj).prev().attr('data-commentid');
                console.log(comment);
            }

            Vue.component('reply-form', {
                template: '#reply-template',
                props: ['comments', 'comment'],
                data: function () {
                    return {
                        is_reply: false,
                        commentLocal: [],
                        placeholder: '',
                        newComment: {
                            'name': '{{\Auth::user()->name}}',
                            'user_id': '{{\Auth::user()->id}}',
                            'to_user_name': '',
                            'comment_id': '',
                            'body': '',
                            'html_body': '',
                            'created_at': ''
                        },
                        postComment: {
                            'article_id': '{{$article->id}}',
                            'user_id': '{{\Auth::user()->id}}',
                            'to_user_id': '',
                            'to_comment_id': 0,
                            'body': ''
                        },
                    }
                },
                methods: {
                    //回复
                    cancelReply: function () {
                        this.is_reply = false;
                    },
                    //取消回复
                    onreply: function () {
                        if (this.is_reply) {
                            this.is_reply = false;
                        } else {
                            this.placeholder = '回复' + comment.to_user_name + ' :';
                            this.is_reply = true;
                        }
                    },
                    //提交回复
                    onSubmitForm: function (e) {
                        e.preventDefault();//点击评论后不会跳转到路由中
                        var commentTemp = this.newComment;
                        commentTemp.to_user_name = comment.to_user_name;
                        commentTemp.comment_id = comment.to_comment_id;
                        var post = this.postComment;
                        post.to_comment_id = comment.to_comment_id;
                        post.to_user_id = comment.to_user_id;
                        post.body = commentTemp.body;
                        this.$http.post('/commentArticle', post).then(response => {
                            console.log('comment_id = ' + comment.to_comment_id);
                        commentTemp.html_body = response.data.html_body;
                        commentTemp.created_at = response.data.created_at;
                        this.is_reply = false;
                        this.commentLocal.push(commentTemp);
                    })
                        ;
                        this.newComment = {
                            'name': '{{\Auth::user()->name}}',
                            'user_id': '{{\Auth::user()->id}}',
                            'to_user_name': '',
                            'comment_id': '',
                            'body': '',
                            'html_body': '',
                            'created_at': ''
                        };
                        comment = {
                            'article_id': '{{$article->id}}',
                            'user_id': '{{Auth::user()->id}}',
                            'to_user_id': '',
                            'to_user_name': '',
                            'to_comment_id': '',
                        }
                    },
                }
            })

            new Vue({
                el: '#app',
                data: {
                    is_reply: false,
                    commentLocalMain: [],
                    postFavorite: {
                        'favoriteable_id': '{{$article->id}}',
                        'isFavorite':{{$isFavorite}},
                    },
                    newCommentMain: {
                        'name': '{{Auth::user()->name}}',
                        'avatar': '{{Auth::user()->avatar}}',
                        'user_id': '{{Auth::user()->id}}',
                        'comment_id': '',
                        'body': '',
                        'html_body': '',
                        'created_at': ''
                    },
                    postCommentMain: {
                        'article_id': '{{$article->id}}',
                        'user_id': '{{Auth::user()->id}}',
                        'to_user_id': 0,
                        'to_comment_id': 0,
                        'body': ''
                    },
                },
                methods: {
                    //回复
                    cancelReply: function () {
                        this.is_reply = false;
                    },
                    //取消回复
                    onreply: function () {
                        if (this.is_reply) {
                            this.is_reply = false;
                        } else {
                            this.placeholder = '回复' + comment.to_user_name + ' :';
                            this.is_reply = true;
                        }
                    },
                    favorite: function () {
                        this.postFavorite.isFavorite = !this.postFavorite.isFavorite;
                        console.log('isFavorite = ' + this.postFavorite.isFavorite);
                        if (this.postFavorite.isFavorite) {
                            $('#favorite').removeClass("inverted");
                            $('#favorite').html('<i class="fa  fa-star-o" style="margin-right: 10px"></i>' + '已收藏');
                        } else {
                            $('#favorite').addClass("inverted");
                            $('#favorite').html('<i class="fa  fa-star-o" style="margin-right: 10px"></i>' + '添加收藏');
                        }
                        this.$http.post('/favArticle', this.postFavorite).then(response => {
                            console.log('response = ' + response.data);
                    })
                        ;
                    },
                    onSubmitFormMain: function (e) {
                        e.preventDefault();//点击发表评论后不会跳转到路由中
                        var commentTemp = this.newCommentMain;
                        var post = this.postCommentMain;
                        post.body = commentTemp.body;
                        this.$http.post('/commentArticle', post).then(response => {
                            console.log('response = ' + response.data.created_at);
                        commentTemp.html_body = response.data.html_body;
                        commentTemp.comment_id = response.data.comment_id;
                        commentTemp.created_at = response.data.created_at;
                        this.commentLocalMain.push(commentTemp);
                    })
                        ;
                        this.newCommentMain = {
                            'name': '{{Auth::user()->name}}',
                            'avatar': '{{Auth::user()->avatar}}',
                            'user_id': '{{Auth::user()->id}}',
                            'comment_id': '',
                            'body': '',
                            'html_body': '',
                            'created_at': ''
                        };
                    },
                }
            });
        </script>
    @else
       @include('comments.reply_not_login')
    @endif
@endsection
