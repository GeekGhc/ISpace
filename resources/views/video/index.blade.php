@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/video.css">
@endsection
@section('content')
<div class="video-list">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="episode-outline table table-hover table-striped">
                    <tbody>
                    <tr class="episode-wrap">
                        <td class="episode-index"><i class="fa fa-code icon-type"></i>1</td>
                        <td class="episode-title">
                            <a href="#">
                                <i class="fa fa-play-circle"></i>
                                <span>laravel5.3的路由讲解</span>
                            </a>
                        </td>
                        <td class="episode-date">
                            <time>7:03</time>
                            <span>2016-2-9</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection