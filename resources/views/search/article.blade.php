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

                    <div class="collections-list" id="search-article">
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

                                <li v-for="newArticle in articleLocal">
                                    <div class="reply-media">
                                        <div class="reply-info">
                                            <a>@{{newArticle.comment_count}}</a>回复
                                        </div>
                                    </div>
                                    <a class="avatar"><img class="img-circle" :src="newArticle.user.avatar"></a>
                                    <div class="collection-info">
                                        <span class="title">
                                            <a :href="articleUrl(newArticle.id)">@{{newArticle.title}}</a>
                                        </span>
                                        <div>
                                            <div class="publish-info" style="color: #426799;">
                                                <a style="font-weight: bold">@{{newArticle.user.name}}</a>
                                                <span> @{{formatTime(newArticle.created_at)}}发表</span>
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
                $('#search-post-list').removeClass('active');
                $('#search-article-list').addClass('active');
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
                },
                articleLocal: [],
                subBody:'',
            },
            methods: {
                loadData: function (e) {
                    moment.locale('zh-cn');
                    $('#loadMore').addClass('loading');
                    e.preventDefault();//点击加载后不会跳转到路由中
                    this.requestData.step = this.requestData.step + 4;
                    var post = this.requestData;
                    console.log('step = ' + this.requestData.step);
                    this.$http.post('/search/loadArticle', post).then(response => {
                        console.log(response.data);
                        this.articleLocal = this.articleLocal.concat(response.data);
                    });
                    $('#loadMore').removeClass('loading');
                },
                subBody:function (value) {
                    return value.substring(0,52);
                },
                formatTime:function (value) {
                    return moment(value,'YYYY-MM-DD HH:mm:ss').fromNow();
                },
                articleUrl:function (value) {
                    return "/article/"+value;
                }
            },
        })
    </script>
@endsection