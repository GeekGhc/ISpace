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
                        @foreach($musics as $music)
                            <article class="broad-music-list-item ui two column grid segment" style="border: none">
                                <div class="broad-music-page four wide column">
                                    <div class="broad-album-pic">
                                        <div class="broad-outer-pic">
                                            <img src="{{$music->song_pic}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="broad-music-des twelve wide column">
                                    <div class="broad-music-content" style="padding-left: 0">
                                        <a href="/broadcasts/{{$music->id}}" class="meta">{{$music->title}}</a>
                                        <div class="singer">
                                            歌手:<span>{{$music->suthor}}</span>
                                        </div>
                                        <div class="description">
                                            {{$music->description}}
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        {{$musics->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="broad-footer">
        <div class="broad-host">
            <a class="broad-host-avatar">
                <img src="https://ol7nwmu54.qnssl.com/my-avatar.jpg">
            </a>
            <h3>JellyBean</h3>
        </div>
        <p>ISpace CopyRight @2016 Developed By JellyBean</p>
    </div>
@endsection

@section("footer-js")
    <script>
    $("#footer").css('display','none');
    </script>
@endsection