@extends('app')
<style>
    body {
        background: #f5f5f1;
    }
</style>
@section('header-js')
    <script src="/js/source/vue.js"></script>
    <script src="/js/source/vue-resource.min.js"></script>
@endsection
@section('content')
    <i v-show="false"></i>
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
                    <a type="button" id="favorite" class="btn btn-default my-favorite"
                       @if($isFavorite===2)href="{{url('user/login')}}"@endif>
                        <i class="fa  fa-star-o" style="margin-right: 10px"></i>
                        @if($isFavorite==1)
                            已收藏{{$isFavorite}}
                        @else添加收藏{{$isFavorite}}
                        @endif
                    </a>

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

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12" id="comment-post">
                <div class="post-show_content">
                    {!! $discussion->html_body !!}
                </div>
                <div class="answers-part">
                    <i class="fa fa-fw fa-thumb-tack fa-2x"></i><span>共<em>56</em>条评论</span>
                    <i v-show="false">{{date_default_timezone_set('PRC')}}</i>
                </div>

                @foreach($comments as $comment)
                    @if($comment->to_user_id==0&&$comment->to_comment_id==0)
                    <div class="comment-list">
                        <div class="comment-note">
                            <div class="comment-content">

                                <div class="meta-top">
                                    <a class="comment-avatar"><img src="{{$comment->user->avatar}}"></a>
                                    <p class="comment-user-name"><a href="">{{\App\User::find($comment->user_id)->name}}</a></p>
                                <span class="reply-time">
                                    <time>2016.4.15 16:54</time>
                                </span>
                                </div>
                                <p class="reply-content">
                                    {!! $comment->html_body !!}
                                </p>
                                <div class="comment-footer">
                                <span class="share-reply">
                                <a style="margin-right: 5px">分享</a><i>|</i>
                                <i v-show="show_user" data-userid="{{$comment->user_id}}" data-username="{{\App\User::find($comment->user_id)->name}}"
                                   data-commentid="{{$comment->id}}">
                                </i>
                                <a class="comment-reply" style="margin-left: 5px" @click="onreply">回复</a>
                                    </span>
                                </div>

                                @if(\App\Comment::where('to_comment_id',$comment->id)->first()?1:0)
                                <div class="child-comment-list">
                                    @foreach($comments as $commentChild)
                                        @if($commentChild->to_comment_id==$comment->id)
                                            <div class="child-comment">
                                                <p>
                                                    <a class="main-user">{{\App\User::find($commentChild->user_id)->name}}</a>&nbsp;&nbsp;回复
                                                    <a class="commented-user">{{\App\User::find($commentChild->to_user_id)->name}}</a>:
                                                    {!! $commentChild->html_body !!}
                                                </p>
                                                <div class="child-comment-footer">
                                            <span class="reply-time pull-left">
                                                <time>2016.5.18 13:58</time>
                                            </span>
                                                    <i v-show="show_user" data-userid="{{$commentChild->user_id}}" data-username="{{\App\User::find($commentChild->user_id)->first()->name}}"
                                                       data-commentid="{{$commentChild->id}}"></i>
                                                    <a class="child-comment-reply comment-reply" @click="onreply">回复</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach


                                    <div class="child-comment" v-for="comment in comments">
                                        <p>
                                            <a>@{{comment.name}}</a>&nbsp;&nbsp;回复
                                            <a class="commented-user">@{{comment.user_name}}</a>:
                                            @{{comment.body}}
                                        </p>
                                        <div class="child-comment-footer" style="width: 100%; height: 21px;">
                                            <span class="reply-time pull-left">
                                                <time>{{date("Y.m.d H:i",time())}}</time>
                                            </span>
                                            <i v-show="show_user" data-userid="@{{comment.user_id}}"
                                               data-username="{{\Auth::user()->name}}"
                                               data-commentid="@{{comment.comment_id}}"></i>
                                            <a v-show="false" class="child-comment-reply comment-reply" @click="onreply"
                                            >
                                            回复</a>
                                        </div>
                                    </div>

                                </div>
                                @endif

                                <div class="reply-form-container" v-show="reply_form">
                                    <div class="reply-form">
                                        {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                                        <div class="reply-field">
                                            {!! Form::textarea('body',null,['class' => 'form-control reply-info','v-model'=>'newComment.body']) !!}
                                        </div>
                                        <div class="btn btn-default reply-button cancel-reply" @click="cancelReply">取消回复
                                    </div>
                                    <button type="submit" class="btn btn-primary reply-button">发表回复</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
            @endforeach


            <div class="comment-list" v-for="commentMain in commentsMain">
                <div class="comment-note">
                    <div class="comment-content">

                        <div class="meta-top">
                            <a class="comment-avatar"><img src="{{\Auth::user()->avatar}}"></a>
                            <p class="comment-user-name"><a href="">{{\Auth::user()->name}}</a></p>
                                <span class="reply-time">
                                    <time>{{date("Y.m.d H:i",time())}}</time>
                                </span>
                        </div>
                        <p class="reply-content">
                            @{{commentMain.body}}
                        </p>
                        <div class="comment-footer">
                                <span class="share-reply">
                                <a style="margin-right: 5px">分享</a>
                                <i v-show="show_user" data-userid="{{\Auth::user()->id}}"
                                   data-username="@{{commentMain.name}}"
                                   data-commentid="@{{commentMain.comment_id}}"></i>
                                <a v-show="false" data-content="JellyTest" class="comment-reply"
                                   style="margin-left: 5px" @click="onreply">回复</a>
                                    </span>
                        </div>

                    </div>
                </div>
            </div>

            {{--发表对帖子的评论--}}
            <div class="reply-form-container reply-yourself">
                <div class="reply-form">
                    {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitFormMain']) !!}
                    <div class="reply-field">
                        {!! Form::textarea('body',null,['class' => 'form-control','placeholder'=>'写下你的评论...','v-model'=>'newCommentMain.body']) !!}
                    </div>
                    <button type="submit" class="btn btn-primary reply-button pull-right">发表回复</button>
                    {!! Form::close() !!}
                </div>
            </div>


        </div>
    </div>
    </div>
    <script>

        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        var isFavorite = {{$isFavorite}};
        var to_user;
        var comment = {
            'discussion_id': '{{$discussion->id}}',
            'user_id': '{{Auth::user()->id}}',
            'to_user_id': '',
            'to_user_name': '',
            'to_comment_id': '',
            'body': ''
        }
        $('#favorite').on('click', function () {

            if (isFavorite === 1)//取消收藏
            {
                console.log('fav = ' + isFavorite);
                isFavorite = 0;
                $(this).html('<i class="fa  fa-star-o" style="margin-right: 10px"></i>' + '添加收藏');

                $.ajax({
                    type: 'POST',
                    url: "/favPost",
                    data: {'favoriteable_id': '{{$discussion->id}}', 'isFavorite': '0'},
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
                console.log('fav = ' + isFavorite);
                isFavorite = 1;
                $(this).html('<i class="fa  fa-star-o" style="margin-right: 10px"></i>' + '已收藏');

                $.ajax({
                    type: 'POST',
                    url: "/favPost",
                    data: {'favoriteable_id': '{{$discussion->id}}', 'isFavorite': '1'},
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

        //回复按钮
        $('.comment-reply').on('click', function () {
            to_user = $(this).prev().attr('data-username');
            comment.to_user_id = $(this).prev().attr('data-userid');
            comment.to_user_name = $(this).prev().attr('data-username');
            comment.to_comment_id = $(this).prev().attr('data-commentid');
        })


        new Vue({
            el: '#comment-post',
            data: {
                comments: [],
                commentsMain: [],
                newComment: {
                    'name': '{{\Auth::user()->name}}',
                    'user_id': '{{\Auth::user()->id}}',
                    'comment_id': 0,
                    'user_name': '',
                    'comment_id': '',
                    'body': ''
                },
                newCommentMain: {
                    'name': '{{Auth::user()->name}}',
                    'comment_id': 0,
                    'body': ''
                },
                PostMain: {
                    'discussion_id': '{{$discussion->id}}',
                    'user_id': '{{Auth::user()->id}}',
                    'to_user_id': '',
                    'to_user_name': '',
                    'to_comment_id': '',
                    'body': ''
                },
                user_name: '',
                reply_form: false,
                show_user: false,
            },
            methods: {
                onSubmitForm: function (e) {
                    e.preventDefault();//点击评论后不会跳转到路由中
                    var newComment = this.newComment;
                    newComment.user_name = comment.to_user_name;
                    var post = comment;
                    post.body = newComment.body;
//                    this.comments.push(newComment);
                    this.$http.post('/commentPost', post).then(function (data, status, request) {
                        newComment.comment_id = data.body;
                        this.comments.push(newComment);
                    });
                    this.newComment = {
                        'name': '{{\Auth::user()->name}}',
                        'user_id': '{{\Auth::user()->id}}',
                        'user_name': '',
                        'comment_id': '',
                        'body': ''
                    };
                    comment = {
                        'discussion_id': '{{$discussion->id}}',
                        'user_id': '{{Auth::user()->id}}',
                        'to_user_id': '',
                        'to_user_name': '',
                        'to_comment_id': '',
                        'body': ''
                    }

                },
                onSubmitFormMain: function (e) {
                    e.preventDefault();//点击发表评论后不会跳转到路由中
                    var comment = this.newCommentMain;
                    var post = this.PostMain;
                    post.body = comment.body;
                    this.commentsMain.push(comment)
                    this.$http.post('/commentPost', post).then(function (data, status, request) {
                        console.log(data.body);
                        comment.comment_id = data.body;
                        this.commentsMain.push(comment);
                    });
                    this.newCommentMain = {
                        'name': '{{Auth::user()->name}}',
                        'body': ''
                    };
                },
                onreply: function () {
                    if (this.reply_form) {
                        this.reply_form = false;
                    } else {
                        this.reply_form = true;
                    }
                    $('.reply-info').attr('placeholder', '回复' + to_user + ' :');
                },
                cancelReply: function () {
                    this.reply_form = false;
                }
            }
        });
    </script>
@endsection
