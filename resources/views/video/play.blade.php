@extends('app')
@section('header-css')
    <link href="http://vjs.zencdn.net/5.12.6/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/video.css">
    <link rel="stylesheet" href="/css/comment.css">
@endsection
@section('header-js')
    <script src="/js/source/vue.js"></script>
    <script src="/js/source/vue-resource.min.js"></script>
@endsection
@section('content')

<div id="app">
    <div class="video-lesson">
        <div class="container video-wrap">
            <div class="row">
                <div class="col-md-12 video-title">
                    <span>{{$video->title}}</span>
                </div>
                <div  class="col-md-12 video-container">
                    <div class="video-show">
                        <video id="ispace-video" style="outline: none;width: 1170px;height: 490px;outline: none"
                               class="video-js vjs-default-skin vjs-big-play-centered
                               vjs-user-inactive vjs-has-started vjs-paused"
                               preload="auto"
                               controls
                               tabindex="-1"
                               poster="/images/video/back.jpg"
                               data-setup='{"example_option":true}'
                        >
                            <source id="sourceBox" src="{{$video->url}}" type='video/mp4'>
                            <p class="vjs-no-js">
                                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                    video</a>
                            </p>
                        </video>
                        <div class="video-catalog">
                            <div style="color: #999;font-size: 18px">
                                <a href="/series/{{$video_series->name}}" style="text-decoration: none">{{$video_series->name}}</a>
                                <span style="font-weight: bold;"> &gt;&gt; </span>
                                <a href="#">{{$video->title}}</a>
                                <span style="margin-left: 14px"><i></i>{{$video->created_at}}</span>
                                <div class="video-button-list">
                                    @if($isFavorite===2)
                                    <a class="ui inverted red basic button" type="button" id="favorite" href="{{url('user/login')}}"><i class="fa fa-star"></i>添加收藏</a>
                                    @elseif($isFavorite==1)
                                    <a class="ui inverted red button" type="button" id="favorite" @click="favorite()"><i class="fa fa-star"></i>已收藏</a>
                                    @else
                                    <a class="ui inverted red basic button" type="button" id="favorite" @click="favorite()"><i class="fa fa-star"></i>添加收藏</a>
                                    @endif
                                    </a>
                                    <a class="ui inverted green basic button" id="video-download"><i class="fa fa-download"></i>下载视频</a>
                                    <a class="ui inverted brown basic button" :class="ifPrev" href="/series/{{$video_series->name}}/video/{{$video_index-1}}"><i class="fa fa-arrow-left"></i>上一节</a>
                                    <a class="ui inverted brown basic button" :class="ifNext" href="/series/{{$video_series->name}}/video/{{$video_index+1}}"><i class="fa fa-arrow-right"></i>下一节</a>
                                </div>
                            </div>
                        </div>
                        <div  class="video-intro">
                            {{$video->intro}}
                        </div>
                        <div class="video-share"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="comment-post" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
                {{--发表对帖子的评论--}}
                @include('comments.reply_form')
                <div class="comment-list">

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

                    <div class="comment-content">
                        @foreach($comments as $comment)
                            @if($comment->to_user_id==0&&$comment->to_comment_id==0)
                                <reply-form :comments="{{$comments}}" :comment="{{$comment}}" v-cloak></reply-form>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- If you'd like to support IE8 -->
<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
<script src="http://vjs.zencdn.net/5.12.6/video.js"></script>
@include('comments.reply_content')

@if(\Auth::check())
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        var comment = {
            'video_id': '{{$video->id}}',
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
                        'video_id': '{{$video->id}}',
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
                    this.$http.post('/commentVideo', post).then(response => {
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
                        'video_id': '{{$video->id}}',
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
                ifPrev:'',
                ifNext:'',
                videoIndex:'{{$video_index}}',
                commentLocalMain: [],
                postFavorite:{
                    'favoriteable_id': '{{$video->id}}',
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
                    'video_id': '{{$video->id}}',
                    'user_id': '{{Auth::user()->id}}',
                    'to_user_id': 0,
                    'to_comment_id': 0,
                    'body': ''
                },
            },
            computed:{
                ifPrev:function(){
                    if(this.videoIndex==="1"){
                        return 'ifPrev';
                    }
                },
                ifNext:function(){
                    if(this.videoIndex==="{{$video_count}}"){
                        return 'ifNext';
                    }
                }
            },
            methods: {
                favorite:function(){
                    this.postFavorite.isFavorite = !this.postFavorite.isFavorite;
                    console.log('isFavorite = '+this.postFavorite.isFavorite);
                    if(this.postFavorite.isFavorite){
                        $('#favorite').removeClass("basic");
                        $('#favorite').html('<i class="fa  fa-star" style="margin-right: 10px"></i>' + '已收藏');
                    }else{
                        $('#favorite').addClass("basic");
                        $('#favorite').html('<i class="fa  fa-star" style="margin-right: 10px"></i>' + '添加收藏');
                    }
                    this.$http.post('/favVideo', this.postFavorite).then(response => {
                        console.log('response = '+response.data);
                });
                },
                onSubmitFormMain: function (e) {
                    e.preventDefault();//点击发表评论后不会跳转到路由中
                    var commentTemp = this.newCommentMain;
                    var post = this.postCommentMain;
                    post.body = commentTemp.body;
                    this.$http.post('/commentVideo', post).then(response => {
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

<script>
    var options = {
        fluid: true,
        preload: 'metadata',
        "playbackRates":[0.5,1,1.25,1.5,1.75,2],
        controls: true,
        bigPlayButton: true,
        LoadingSpinner:false,
        textTrackDisplay: true,
        posterImage: false,
        errorDisplay: true,
        VolumeMenuButton:false,
        controlBar : {
            CustomControlSpacer:true,
        }
    };
    var player = videojs('ispace-video', options);
    player.removeChild('BigPlayButton');
</script>
@endsection
