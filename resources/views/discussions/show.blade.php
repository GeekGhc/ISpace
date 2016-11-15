@extends('common.app')
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
                            <span><em>309</em>&nbsp;浏览</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <a type="button" {{--href="/favorite/15"--}} id="favorite" class="btn btn-default my-favorite"><i class="fa  fa-star-o"
                                                                   style="margin-right: 10px"></i>添加收藏
                    </a>

                    <a class="btn edit-discussion-btn" href="{{url('/discussion/'.$discussion->id.'/edit')}}">编辑帖子
                    </a>
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
                </div>

                <div class="comment-list">
                    <div class="comment-note">
                        <div class="comment-content">

                            <div class="meta-top">
                                <a class="comment-avatar"><img src="/images/avatar/head.jpg"></a>
                                <p class="comment-user-name"><a href="">JellyBean</a></p>
                                <span class="reply-time">
                                    <time>2016.4.15 16:54</time>
                                </span>
                            </div>
                            <p class="reply-content">
                                还没毕业还没成为程序员呢，坐几个小时腰就困得不行了，毕业了可咋整
                            </p>
                            <div class="comment-footer">
                                <span class="share-reply">
                                <a style="margin-right: 5px">分享</a><i>|</i><a data-content="JellyTest"  style="margin-left: 5px" @click="onreply">回复</a>
                                    </span>
                            </div>

                            <div class="child-comment-list">
                                <div class="child-comment">
                                    <p>
                                        <a class="main-user">千里马军</a>&nbsp;&nbsp;回复
                                        <a class="commented-user">我就是王大大</a>:
                                        现在就开始运动吧 每天运动一小时时间比较很舒服是不是不服是是事实并不是舒不舒服伤风败俗
                                    </p>
                                    <div class="child-comment-footer">
                                            <span class="reply-time pull-left">
                                                <time>2016.5.18 13:58</time>
                                            </span>
                                        <i v-show="show_user" data-user="Jelly"></i>
                                        <a class="child-comment-reply" @click="onreply">回复</a>
                                    </div>
                                </div>

                                <div class="child-comment">
                                    <p>
                                        <a>我就是王大</a>&nbsp;&nbsp;回复
                                        <a class="commented-user">维尼熊</a>:
                                        好吧 你好像说的对
                                    </p>
                                    <div class="child-comment-footer">
                                            <span class="reply-time pull-left">
                                                <time>2016.5.19 15:58</time>
                                            </span>
                                        <a class="child-comment-reply">回复</a>
                                    </div>
                                </div>

                            </div>

                            <div class="reply-form-container" v-show="reply_form">
                                <div class="reply-form">
                                    {!! Form::open() !!}
                                    <div class="reply-field">
                                        {!! Form::textarea('body',null,['class' => 'form-control reply-info','placeholder'=>'写下你的评论...']) !!}
                                    </div>
                                    <div class="btn btn-default reply-button cancel-reply">取消回复</div>
                                    <div class="btn btn-primary reply-button">发表回复</div>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{--发表对帖子的评论--}}
                <div class="reply-form-container reply-yourself">
                    <div class="reply-form">
                        {!! Form::open() !!}
                        <div class="reply-field">
                            {!! Form::textarea('body',null,['class' => 'form-control','placeholder'=>'写下你的评论...']) !!}
                        </div>
                        <div class="btn btn-primary reply-button pull-right">发表回复</div>
                        {!! Form::close() !!}
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        $('#favorite').on('click',function(){
//            alert($('#favorite').text());
            console.log($(this).text());
            if($(this).text()=="添加收藏"){
//                $(this).text('已收藏');
                alert($(this).text());
            }
        });
        var user ;
        $('.child-comment-reply').on('click',function(){
            user = $(this).prev().attr('data-user');

//            alert($(this).prev().attr('data-user'));
        })

        //    Vue.http.headers.common['X-CSRF-TOKEN'] =   document.querySelector('#token').getAttribute('value');
        new Vue({
            el: '#comment-post',
            data: {
                user_name:'',
                reply_form:false,
                show_user:false,
            },
            methods:{
               /* onSubmitForm:function(e){
                    e.preventDefault();//点击发表评论后不会跳转到路由中
                    var comment = this.newComment;
                    var post = this.newPost;
                    post.body = comment.body;
                    this.$http.post('/comment',post).then(function(){
                        this.comments.push(comment)
                    });
                    this.newComment =  {
                        'name':'{{Auth::user()->name}}',
                        'avatar':'{{Auth::user()->avatar}}',
                        'body':''
                    };
                },*/
                onreply:function(){
                    if(this.reply_form){
                        this.reply_form = false;
                    }else{
                        this.reply_form = true;
                    }
                    $('.reply-info').attr('placeholder','回复'+user+' :');
                }
            }
        });
    </script>
@endsection
