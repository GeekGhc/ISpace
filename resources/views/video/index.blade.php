@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/video.css">
    <style>
        body {
            background-color: #edf1f2;
        }

        .navbar-inverse {
            border-color: transparent;
        }
    </style>
@endsection
@section('content')
    <div class="video-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container" style="margin-bottom: 18px">
                        <div class="row">
                            <div class="video-series-name col-md-12">{{$video_serie->name}}</div>
                            <div class="series-description col-md-8">
                                <span>简介: </span>
                                <p>{{$video_serie->intro}}</p>
                            </div>
                            <div class="video-clearfix col-md-3">
                                <ul>
                                    <li class="static_item" style=" border-right: 1px solid #aaa;padding-left: 0">
                                        <span class="video-item-meta">课程时长</span>
                                        <span class="video-item-value">23:45</span>
                                    </li>
                                    <li class="static_item">
                                        <span class="video-item-meta">关注人数</span>
                                        <span class="video-item-value">35</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="video-list section-content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table class="episode-outline table table-hover" style="background: #fff">
                        <tbody>
                        @foreach($videos as $key=>$video)
                            <tr class="episode-wrap">
                                <td class="episode-index"><i class="fa fa-code icon-type"></i><span>{{$key+1}}</span></td>
                                <td class="episode-title">
                                    <a href="/series/{{$video_serie->name}}/video/{{$key+1}}">
                                        <i class="fa fa-play-circle"></i>
                                        <span>{{$video->title}}</span>
                                    </a>
                                </td>
                                <td class="episode-date">
                                    <span>{{$video->created_at}}</span>
                                    <time>7:03</time>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection