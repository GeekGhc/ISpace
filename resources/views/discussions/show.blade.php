@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/discussion.css">
@endsection
@section('header-js')
    <script src="/js/source/vue.js"></script>
    <script src="/js/source/vue-resource.min.js"></script>
@endsection
@section('content')

<div id="app">
    <div class="post-topheader">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="post-author_avatar">
                        <a><img src="/images/avatar/default.png"></a>
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
                    <a type="button" id="favorite" class="btn btn-default my-favorite" @click="favorite()"
                    @if($isFavorite===2)href="{{url('user/login')}}"@endif>
                    <i class="fa  fa-star-o" style="margin-right: 10px"></i>
                    @if($isFavorite==1)
                        已收藏
                    @else添加收藏
                    @endif
                    </a>
                    {{--是本文作者可编辑文章--}}
                    @if(\Auth::check())
                        @if($discussion->user->id===\Auth::user()->id)
                            <a class="btn edit-discussion-btn" href="{{url('/discussion/'.$discussion->id.'/edit')}}">编辑帖子
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
                    <i class="fa fa-fw fa-thumb-tack fa-2x"></i><span>共<em>56</em>条评论</span>
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
                <div class="reply-form-container reply-yourself">
                    @if(\Auth::check())
                        <div class="reply-form">
                            {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitFormMain']) !!}
                            <div class="reply-field">
                                {!! Form::textarea('body',null,['class' => 'form-control','placeholder'=>'写下你的评论...','v-model'=>'newCommentMain.body']) !!}
                            </div>
                            <button type="submit" class="btn btn-primary reply-button pull-right">发表回复</button>
                            {!! Form::close() !!}
                        </div>
                    @else
                        <a class="btn btn-primary btn-lg" href="/user/login" style="width: 100%;">登录参与评论</a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>


    {{--reply 模板--}}
    <script type="text/x-template" id="reply-template">
        <div class="comment">
            <div class="parent-comment">
                <div class="meta-top">
                    <a class="comment-avatar"><img :src="[comment.user.avatar]"></a>
                    <p class="comment-user-name">
                        <a href="">@{{comment.user.name}}</a></p>
                    <span class="reply-time">
                        <time>@{{comment.created_at}}</time>
                        </span>
                </div>
                <p class="reply-content" v-html="comment.html_body">
                </p>
                <div class="comment-footer">
                    <span class="share-reply">
                    <a style="margin-right: 5px">分享</a> <i>|</i>
                        <i :data-userid="[comment.user_id]"
                           :data-username="[comment.user.name]"
                           :data-commentid="[comment.id]">
                        </i>
                    <a class="comment-reply" style="margin-left: 5px" onclick="clickReply(this)" @click="onreply()">回复</a>
                    </span>
                </div>
            </div>
            {{--@if(\App\Comment::where('to_comment_id',$comment->id)->first()?0:1)--}}
            <div class="child-comment-list">
                <div class="child-comment" v-for="commentChild in comments"
                     v-if="commentChild.to_comment_id==comment.id">
                    <p>
                        <a class="main-user">@{{commentChild.user.name}}</a>&nbsp;&nbsp;回复
                        <a class="commented-user">@{{ commentChild.to_user.name }}</a>:
                    <p v-html="commentChild.html_body"></p>
                    </p>
                    <div class="child-comment-footer">
                        <span class="reply-time pull-left">
                            <time>@{{ commentChild.created_at }}</time>
                        </span>
                        <i
                                :data-userid="[commentChild.user_id]"
                                :data-username="[commentChild.user.name]"
                                :data-commentid="[comment.id]"></i>
                        <a class="child-comment-reply comment-reply"
                           onclick="clickReply(this)" @click="onreply()">回复</a>
                    </div>
                </div>

                <div class="child-comment" v-for="newComment in commentLocal">
                    <p>
                        <a class="main-user">@{{newComment.name}}</a>&nbsp;&nbsp;回复
                        <a class="commented-user">@{{newComment.to_user_name}}</a>:
                    <p v-html="newComment.html_body"></p>
                    </p>
                    <div class="child-comment-footer">
                            <span class="reply-time pull-left">
                                <time>@{{newComment.created_at}}</time>
                            </span>
                        <i   :data-userid="[newComment.user_id]"
                             :data-username="[newComment.name]"
                             :data-commentid="[newComment.comment_id]">
                        </i>
                        <a class="child-comment-reply comment-reply"
                           onclick="clickReply(this)" @click="onreply()">回复</a>
                    </div>
                </div>
            </div>
            {{--@endif--}}

            <div class="reply-form-container" v-if="is_reply">
                <div class="reply-form">
                    {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                    <div class="reply-field">
                        {!! Form::textarea('body',null,['class' => 'form-control reply-info',':placeholder'=>'placeholder','v-model'=>'newComment.body']) !!}
                    </div>
                    <div class="btn btn-default reply-button cancel-reply" @click="cancelReply">
                    取消回复
                </div>
                <button type="submit" class="btn btn-primary reply-button">发表回复</button>
                {!! Form::close() !!}
            </div>

        </div>
    </script>

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
                    favorite:function(){
                        this.postFavorite.isFavorite = !this.postFavorite.isFavorite;
                        console.log('isFavorite = '+this.postFavorite.isFavorite);
                        if(this.postFavorite.isFavorite){
                            $('#favorite').html('<i class="fa  fa-star-o" style="margin-right: 10px"></i>' + '取消收藏');
                        }else{
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
        <script>
            var comment = {
                'discussion_id': '{{$discussion->id}}',
                'user_id': '',
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
            $(function () {
                $('.comment-reply').attr('href', '/user/login');
            })
            Vue.component('reply-form', {
                template: '#reply-template',
                props: ['comments', 'comment'],
                data: function () {
                    return {
                        is_reply: false,
                        commentLocal: [],
                    }
                },
            })
            new Vue({
                el: '#app',
            })
        </script>
    @endif
@endsection

