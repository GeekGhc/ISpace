@extends('app')
@section('title','ISpace Community')
@section('header-css')
   {{-- <link rel="stylesheet" href="/css/favorite.css">
    <link rel="stylesheet" href="/css/search.css">--}}
    <link rel="stylesheet" href="/css/comment.css">
    <style>
        body {
            background: #f5f5f1;
        }
    </style>
@endsection
@section('content')
    @include('common.favorites_nav_header')
    <div class="container favorite-section-content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="collections-list">
                    <ul class="collection-list-ul">
                        @foreach($discussions as $discussion)
                            <li>
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
                                                    由 <a style="color: #00b1b3;font-weight: bold;">
                                                    {{$discussion->last_user->name}}</a>{{$discussion->updated_at->diffForHumans()}}更新
                                            </span>
                                        </div>
                                        <div class="tags">
                                            @foreach($discussion->tags as $tag)
                                                <span class="ui label {{$tag->type}}">{{$tag->name}}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    {{--{{$discussions->links()}}--}}
                    {{-- <div class="discussion-loadMore">
                         <button class="ui orange button" id="loadMore">
                             <span class="btn-load" v-on:click="loadData">Load More</span>
                         </button>
                     </div>--}}
                </div>


            </div>
        </div>
    </div>
@endsection
@section('footer-js')
    <script>
        $(document).ready(function () {
            $('#favorite-posts-link').addClass('active');
        });
    </script>
@endsection