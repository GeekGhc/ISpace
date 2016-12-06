@extends('app')
<meta id="module" content="post">
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
                    <i v-show="false">{{date_default_timezone_set('PRC')}}</i>
                </div>

                <div class="comment-list">
                    <div class="comment-content">
                       @foreach($comments as $comment)
                            @if($comment->to_user_id==0&&$comment->to_comment_id==0)
                                <reply-form :comments="{{$comments}}" :comment="{{$comment}}"></reply-form>
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- <div class="comment-list" v-for="commentMain in commentsMain">
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
                                        data-commentid="@{{commentMain.comment_id}}">
                                     </i>
                                     <a v-show="false" data-content="JellyTest" class="comment-reply"
                                        style="margin-left: 5px" @click="onreply">回复
                                     </a>
                                 </span>
                             </div>

                         </div>
                     </div>
                 </div>--}}

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

    {{--reply 模板--}}
    <script type="text/x-template" id="reply-template">
        <div class="comment">
            <div class="parent-comment">
                <div class="meta-top">
                    <a class="comment-avatar"><img :src="[comment.user.avatar]"></a>
                    <p class="comment-user-name">
                        <a href="">@{{comment.user.name}}</a></p>
                        <span class="reply-time">
                        <time>2016.4.15 16:54</time>
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
                    <div class="child-comment" v-for="commentChild in comments" v-if="commentChild.to_comment_id==comment.id"   >
                        <p>
                            <a class="main-user">@{{commentChild.user.name}}</a>&nbsp;&nbsp;回复
                            <a class="commented-user">@{{ commentChild.to_user_id }}</a>:
                            <p v-html="commentChild.html_body"></p>
                        </p>
                        <div class="child-comment-footer">
                            <span class="reply-time pull-left">
                                <time>2016.5.18 13:58</time>
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
                            <a class="main-user">@{{comment.name}}</a>&nbsp;&nbsp;回复
                            <a class="commented-user">@{{comment.user_name}}</a>:
                            <p v-html="newComment.html_body"></p>
                        </p>
                        <div class="child-comment-footer">
                            <span class="reply-time pull-left">
                                <time>2016.5.18 13:58</time>
                            </span>
                           <i
                                   :data-userid="[newComment.user_id]"
                                   :data-username="[newComment.name]"
                                   :data-commentid="[newComment.comment_id]"></i>
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
       /* $(function(){
            $('.commented-user').text($('.commented-user').attr('data-to-user'));
        })*/
        var comment = {
            'discussion_id': '{{$discussion->id}}',
            'user_id':'{{\Auth::user()->id}}',
            'to_user_id': '',
            'to_user_name': '',
            'to_comment_id': '',
        }
        //点击回复
        function clickReply(obj){
            comment.to_user_id = $(obj).prev().attr('data-userid');
            comment.to_user_name = $(obj).prev().attr('data-username');
            comment.to_comment_id = $(obj).prev().attr('data-commentid');
            console.log(comment);
        }

        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        var isFavorite = {{$isFavorite}};
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


        Vue.component('reply-form', {
            template: '#reply-template',
            props: ['comments','comment'],
            data:function(){
                return {
                    is_reply:false,
                    commentLocal:[],
                    placeholder:'',
                    newComment: {
                        'name': '{{\Auth::user()->name}}',
                        'user_id': '{{\Auth::user()->id}}',
                        'to_user_id': '',
                        'comment_id': 0,
                        'body': ''
                    },
                    postComment: {
                        'discussion_id':'{{$discussion->id}}',
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
                     }  else {
                        this.placeholder = '回复'+comment.to_user_name + ' :';
                        this.is_reply = true;
                     }
                 },
                //提交回复
                onSubmitForm: function (e) {
                    e.preventDefault();//点击评论后不会跳转到路由中
                    var commentTemp = this.newComment;
                    commentTemp.to_user_id = comment.to_user_id;
                    var post = this.postComment;
                    post.to_comment_id = comment.to_comment_id;
                    post.to_user_id = comment.to_user_id;
                    post.body = commentTemp.body;
                    this.$http.post('/commentPost', post).then(function (data, status, request) {
                        commentTemp.comment_id = comment.to_comment_id;
                        this.commentLocal.push(commentTemp);
                    });
                    this.newComment = {
                        'name': '{{\Auth::user()->name}}',
                        'user_id': '{{\Auth::user()->id}}',
                        'to_user_id': '',
                        'comment_id': 0,
                        'body': ''
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
            el: '#comment-post',
            data: {
                is_reply: false,
                commentsMain: [],
                newCommentMain: {
                    'name': '{{Auth::user()->name}}',
                    'comment_id': 0,
                    'body': ''
                },
                postMain: {
                    'discussion_id': '{{$discussion->id}}',
                    'user_id': '{{Auth::user()->id}}',
                    'to_user_id': '',
                    'to_comment_id': '',
                    'body': ''
                },
                user_name: '',
                reply_form: false,
                show_user: false,
            },
            methods: {
                onSubmitFormMain: function (e) {
                    e.preventDefault();//点击发表评论后不会跳转到路由中
                    var newComment = this.newCommentMain;
                    var post = this.postMain;
                    this.$http.post('/commentPost', post).then(function (data, status, request) {
                        console.log(data.body);
                        comment.comment_id = data.body;
                        this.commentsMain.push(newComment);
                    });
                    this.newCommentMain = {
                        'name': '{{Auth::user()->name}}',
                        'body': ''
                    };
                },
            }
        });
    </script>
    @else
        <script>
            var comment = {
                'discussion_id': '{{$discussion->id}}',
                'user_id':'',
                'to_user_id': '',
                'to_user_name': '',
                'to_comment_id': '',
            }
            //点击回复
            function clickReply(obj){
                comment.to_user_id = $(obj).prev().attr('data-userid');
                comment.to_user_name = $(obj).prev().attr('data-username');
                comment.to_comment_id = $(obj).prev().attr('data-commentid');
                console.log(comment);
            }
           $(function(){
                   $('.comment-reply').attr('href','/user/login');
           })
            Vue.component('reply-form', {
                template: '#reply-template',
                props: ['comments','comment'],
                data:function(){
                    return {
                        is_reply:false,
                        commentLocal:[],
                    }
                },
            })
            new Vue({
                el: '#comment-post',
            })
        </script>
    @endif
@endsection

