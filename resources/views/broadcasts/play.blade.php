@extends("app")
@section('title','ISpace Community 音乐电台')
@section('header-css')
    <link rel="stylesheet" href="/css/broadcasts.css">
    <script src="/js/source/APlayer.min.js"></script>
@endsection

@section("content")
    <div class="broad-body">
        <h1 class="broad-header">
            ISpace Community 音乐电台
        </h1>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="audio-play-panel">
                        <div class="ui card" style="width: 100%">
                            <div class="card audio-play">
                                <div id="player" class="aplayer" style="margin-bottom: 0"></div>
                                <div class="content">
                                    <a class="header"><i class="fa fa-reply"></i>  发布于 {{$music->created_at->diffForHumans()}}</a>
                                    <div class="description">
                                        {{$music->description}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="disqus_thread"></div>
                    {{--<script id="dsq-count-scr" src="//ispace-1.disqus.com/count.js" async></script>
                    <a href="{{\Illuminate\Support\Facades\Request::getRequestUri()}}#disqus_thread">
                        显示评论数(若只需数字 可用jquery去掉非数字即可)
                    </a>--}}
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
        <p>ISpace  CopyRight @2016 Developed By JellyBean</p>
    </div>
@endsection

@section("footer-js")
    <script>
        $("#footer").css('display','none');

        var ap1 = new APlayer({
            element: document.getElementById('player'),
            narrow: false,
            autoplay: false,
            showlrc: false,
            mutex: true,
            theme: '#e6d0b2',
            preload: 'metadata',
            mode: 'circulation',
            listmaxheight: '513px',                                             // Optional, max height of play list
            music: {                                                           // Required, music info, see: ###With playlist
                title: '{{$music->title}}',                                          // Required, music title
                author: '{{$music->author}}',                          // Required, music author
                url: '{{$music->song_uri}}',
                pic: '{{$music->song_pic}}',  // Optional, music picture
//                lrc: '[00:00.00]lrc here\n[00:01.00]aplayer'                   // Optional, lrc, see: ###With lrc
            }
        });

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
         var disqus_config = function () {
         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
         };
         */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = '//ispace-1.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@endsection