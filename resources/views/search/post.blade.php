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
@section('header-js')
    <script src="/js/source/vue.js"></script>
    <script src="/js/source/vue-resource.min.js"></script>
@endsection
@section('content')
    <div class="container" id="app">
        <div class="row search-row">
            <div class="col-md-12 col-sm-12">

                @include('common.search_navbar')

                <div class="col-md-9">

                    <div class="collections-list" id="search-post">
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

                             <li v-for="newPost in postLocal">
                                 <div class="reply-media">
                                     <div class="reply-info">
                                         <a>@{{newPost.comment_count}}</a>回复
                                     </div>
                                 </div>
                                 <a class="avatar"><img class="img-circle" :src="newPost.user.avatar"></a>
                                 <div class="collection-info">
                                     <span class="title">
                                         <a :href="postUrl(newPost.id)">@{{newPost.title}}</a>
                                     </span>
                                     <div class="description" v-html="subBody(newPost.html_body)">
                                     </div>
                                     <div>
                                         <div class="publish-info" style="color: #7088a9;">
                                             <a style="font-weight: bold">@{{newPost.user.name}}</a>
                                             <span>
                                                 @{{formatTime(newPost.created_at)}}发表</span>
                                             <span>
                                                 <i class="fa fa-reply"></i>
                                                 由 <a style="color: #00b1b3;font-weight: bold;">@{{newPost.last_user.name}}</a>
                                                     @{{formatTime(newPost.updated_at)}}更新
                                             </span>
                                         </div>
                                         <div class="tags">
                                             <span class="label label-success">Laravel</span>
                                             <span class="label label-warning">PHP</span>
                                         </div>
                                     </div>
                                 </div>
                             </li>

                        </ul>
                        <div class="discussion-loadMore">
                            <button class="ui orange button" id="loadMore">
                                <span class="btn-load" v-on:click="loadData">Load More</span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    <script src="/js/source/moment.min.js"></script>
    <script>
        $(function () {
            $('#search-post-list').addClass('active');
            $('#search-article-list').removeClass('active');
            $('#search-video-list').removeClass('active');
        })
    </script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        new Vue({
            el: '#app',
            data: {
                requestData: {
                    step: 0,
                    q:"{{$query}}",
                },
                postLocal: [],
                subBody:'',
            },
            methods: {
                loadData: function (e) {
                    moment.locale('zh-cn');
//                    console.log('time = '+moment('2016-12-30 12:03:00 ','YYYY-MM-DD HH:mm:ss').fromNow());
                    $('#loadMore').addClass('loading');
                    e.preventDefault();//点击加载后不会跳转到路由中
                    this.requestData.step = this.requestData.step + 4;
                    var post = this.requestData;
                    console.log('step = ' + this.requestData.step);
                    this.$http.post('/search/loadPost', post).then(response => {
                          console.log(response.data);
                        this.postLocal = this.postLocal.concat(response.data);
                    });
                    $('#loadMore').removeClass('loading');
                },
                subBody:function (value) {
                    return value.substring(0,52);
                },
                formatTime:function (value) {
                    return moment(value,'YYYY-MM-DD HH:mm:ss').fromNow();
                },
                postUrl:function (value) {
                    return "/discussion/"+value;
                }
            },
            /*computed:{
                request:function () {

                }
            }*/
        })
    </script>
@endsection