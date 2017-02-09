@extends("app")
@section('title','ISpace Community 音乐电台')
@section('header-css')
    <link rel="stylesheet" href="/css/broadcasts.css">
@endsection

@section("content")
    <div class="broad-body">
        <h1 class="broad-header">
            ISpace Community 音乐电台
        </h1>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="broad-music-list">
                        <article class="broad-music-list-item ui two column grid segment" style="border: none">
                            <div class="broad-music-page five wide column">
                                <div class="broad-album-pic">
                                    <div class="broad-outer-pic">
                                        <img src="/images/mypage/my-avatar.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="broad-music-des eleven wide column">

                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection