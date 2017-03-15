@extends('app')
@section('title',$discussion->title)
@section('header-css')
   {{-- <link rel="stylesheet" href="/css/discussion.css">
    <link rel="stylesheet" href="/css/comment.css">--}}
    <style>
        body{
            background: #f5f5f1;
        }
    </style>
@endsection
{{--@section('header-js')
    <script src="/js/source/vue.js"></script>
    <script src="/js/source/vue-resource.min.js"></script>
@endsection--}}
@section('content')

<div id="app" class="section-content">
    <div class="post-topheader">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="post-author_avatar">
                        <a><img src="{{$discussion->user->avatar}}"></a>
                    </div>
                    <div class="post-title_info">
                        <h3 class="post-show_title">{{$discussion->title}}</h3>
                        <div class="post-author">
                            <a>{{$discussion->user->name}}</a>
                            <span><time>{{$discussion->created_at->diffForHumans()}}</time>提问</span>
                            <span><em>{{$discussion->view_count}}</em>&nbsp;浏览</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-xs-12">
                    @if($isFavorite===2)
                        <a class="ui inverted orange button" type="button" id="favorite" href="{{url('user/login')}}"><i class="fa fa-star"></i>添加收藏</a>
                    @elseif($isFavorite==1)
                        <a class="ui  orange button" type="button" id="favorite" @click="favorite()"><i class="fa fa-star"></i>已收藏</a>
                    @else
                        <a class="ui  inverted orange button" type="button" id="favorite" @click="favorite()"><i class="fa fa-star"></i>添加收藏</a>
                    @endif
                    {{--是本文作者可编辑文章--}}
                    @if(\Auth::check())
                        @if($discussion->user->id===\Auth::user()->id)
                            <a class="ui button teal" href="{{url('/discussion/'.$discussion->id.'/edit')}}">编辑帖子
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="comment-post">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
                <div class="post-show_content">
                    {!! $discussion->html_body !!}
                </div>
                <div class="answers-part">
                    <i class="fa fa-fw fa-thumb-tack fa-2x"></i><span>共<em>{{$discussion->comment_count}}</em>条评论</span>
                    <div
                            class="social-share share-component"
                            data-descritioin="一键分享"
                            data-disabled="diandian"
                            data-wechat-qrcode-title="请打开微信扫一扫"
                            data-wechat-qrcode-helper="<p>微信里点“发现”，扫一下</p><p>二维码便可将本文分享至朋友圈</p>"
                            data-mobile-sites="weibo,qq,qzone,tencent"
                            data-title="ISpace Community {{$discussion->title}}"
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
    @include('comments.reply_content')

    @if(\Auth::check())
        <script>
            Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

            var comment = {
                'discussion_id': '{{$discussion->id}}',
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
                            'created_at':''
                        },
                        postComment: {
                            'discussion_id': '{{$discussion->id}}',
                            'user_id': '{{\Auth::user()->id}}',
                            'to_user_id': '',
                            'to_comment_id': 0,
                            'body': ''
                        },
                    }
                },
                methods: {
                    //名字Url
                    nameUrl:function (value) {
                        return "/u/"+value;
                    },
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
                        this.$http.post('/commentPost', post).then(response => {
                            console.log('comment_id = ' + comment.to_comment_id);
                            commentTemp.html_body = response.data.html_body;
                            commentTemp.created_at = response.data.created_at;
                            this.is_reply = false;
                            this.commentLocal.push(commentTemp);
                        });
                        this.newComment = {
                            'name': '{{\Auth::user()->name}}',
                            'user_id': '{{\Auth::user()->id}}',
                            'to_user_name': '',
                            'comment_id': '',
                            'body': '',
                            'html_body': '',
                            'created_at':''
                        };
                        comment = {
                            'discussion_id': '{{$discussion->id}}',
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
                    commentLocalMain: [],
                    postFavorite:{
                        'favoriteable_id': '{{$discussion->id}}',
                        'isFavorite':{{$isFavorite}},
                    },
                    newCommentMain: {
                        'name': '{{Auth::user()->name}}',
                        'avatar': '{{Auth::user()->avatar}}',
                        'user_id':'{{Auth::user()->id}}',
                        'comment_id': '',
                        'body': '',
                        'html_body': '',
                        'created_at':''
                    },
                    postCommentMain: {
                        'discussion_id': '{{$discussion->id}}',
                        'user_id': '{{Auth::user()->id}}',
                        'to_user_id': 0,
                        'to_comment_id': 0,
                        'body': ''
                    },
                },
                methods: {
                    nameUrl:function (value) {
                        return "/u/"+value;
                    },
                    favorite:function(){
                        this.postFavorite.isFavorite = !this.postFavorite.isFavorite;
                        console.log('isFavorite = '+this.postFavorite.isFavorite);
                        if(this.postFavorite.isFavorite){
                            $('#favorite').removeClass("inverted");
                            $('#favorite').html('<i class="fa  fa-star-o" style="margin-right: 10px"></i>' + '已收藏');
                        }else{
                            $('#favorite').addClass("inverted");
                            $('#favorite').html('<i class="fa  fa-star-o" style="margin-right: 10px"></i>' + '添加收藏');
                        }
                        this.$http.post('/favPost', this.postFavorite).then(response => {
                            console.log('response = '+response.data);
                    });
                    },
                    onSubmitFormMain: function (e) {
                        e.preventDefault();//点击发表评论后不会跳转到路由中
                        var commentTemp = this.newCommentMain;
                        var post = this.postCommentMain;
                        post.body = commentTemp.body;
                        this.$http.post('/commentPost', post).then(response => {
                            console.log('response = '+response.data.created_at);
                            commentTemp.html_body = response.data.html_body;
                            commentTemp.comment_id = response.data.comment_id;
                            commentTemp.created_at = response.data.created_at;
                            this.commentLocalMain.push(commentTemp);
                        });
                        this.newCommentMain = {
                            'name': '{{Auth::user()->name}}',
                            'avatar': '{{Auth::user()->avatar}}',
                            'user_id':'{{Auth::user()->id}}',
                            'comment_id': '',
                            'body': '',
                            'html_body': '',
                            'created_at':''
                        };
                    },
                }
            });
        </script>
    @else
       @include('comments.reply_not_login')
    @endif
@endsection

