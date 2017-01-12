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
@section('content')
    <div class="container section-content" id="app">
        <div class="row search-row">
            <div class="col-md-12 col-sm-12">

                @include('common.search_navbar')

                <div class="col-md-9">
                    <div class="collections-list" id="search-video" style="padding-top: 18px">
                        <table class="ui selectable striped table">
                            <tbody>
                            <thead>
                            <tr>
                                <th colspan="3">视频系列</th>
                            </tr>
                            </thead>
                            @foreach($videos as $key=>$video)
                                <tr class="search-video-tr">
                                    <td class="collapsing"><i class="fa fa-code icon-type"></i></td>
                                    <td>
                                        <i class="fa fa-play-circle" style="margin-right: 8px;"></i>
                                        <a href="/series/{{$video->video_series->name}}">{{$video->title}} {{$video->id}} {{$video->video_series->id}}</a>
                                    </td>
                                    <td class="right aligned collapsing">
                                        <time style="margin-right: 12px;">7:03</time>
                                        <span>{{$video->created_at}}</span>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                       {{-- <div class="discussion-loadMore">
                            <button class="ui orange button">
                                <span class="btn-load">Load More</span>
                            </button>
                        </div>--}}
                        {{$videos->links()}}
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
            $('#search-article-list').removeClass('active');
            $('#search-video-list').addClass('active');
        })
    </script>
@endsection