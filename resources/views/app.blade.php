<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta name="google-signin-client_id"
          content="794489703141-4d3uht5o10cbc4ob732rfmjn6ohis9vl.apps.googleusercontent.com">
    <link href="/favicon.ico" rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">

    {{-- <link rel="stylesheet" href="/css/source/bootstrap.css">
     <link rel="stylesheet" href="/css/source/semantic.min.css">
     <link rel="stylesheet" href="/css/source/select2.min.css">
     <link rel="stylesheet" href="/css/source/font-awesome.min.css">
     <link rel="stylesheet" href="/css/source/share.min.css">
     <link rel="stylesheet" href="/css/style.css">--}}
    @yield('header-css')
    <script src="{{elixir('/js/app.js')}}"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
     {{--<script src="/js/source/jquery-2.1.4.min.js"></script>
     <script src="/js/source/bootstrap.min.js"></script>
     <script src="/js/source/social-share.min.js"></script>
     <script src="/js/source/select2.full.min.js"></script>--}}


    @yield('header-js')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        window.Laravel.apiToken = "{{Auth::check()?'Bearer '.Auth::user()->api_token:'Bearer '}}";
    </script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="ISpace" href="{{url('/')}}">ISpace</a>
        </div>

        <!-- 内容分类 -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="heart"><a href="/lessons">视频</a></li>
                <li id="article"><a href="/article">文章</a></li>
                <li id="post"><a href="/discussion">问答</a></li>
                <li id="donate"><a href="/donate-to-me">捐赠</a></li>
                <li id="activity"><a href="#">活动</a></li>
            </ul>

            <div class="navbar-form navbar-left" role="search">
                {{--<div class="form-group search-label">
                    <input type="text" id="search-content" class="form-control search-input" placeholder="关键字搜索">
                    <a type="submit" id="search" class="btn btn-default search-btn"><i class="search icon"></i></a>
                </div>--}}
                <div class="ui search">
                    <div class="ui icon input  form-group">
                        <input id="search-content" class="prompt form-control" type="text" placeholder="输入关键字搜索...">
                        <i class="search icon search-icon" style="color: #007f80;"></i>
                    </div>
                </div>
            </div>

            {{--用户登录 信息展示--}}
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">撰写 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{url('/article/create')}}">写文章</a></li>
                        <li><a href="{{url('/discussion/create')}}">提问题</a></li>
                        <li><a href="#">做笔记</a></li>
                        <li class="divider"></li>
                        <li><a href="#">草稿箱</a></li>
                    </ul>
                </li>

                @if(\Auth::check())
                    <li><a href="/user/notifications" class="message-info">
                            <i class="fa fa-bell-o">
                                @if(Auth::user()->unreadNotifications->count()!==0)
                                    <span class="badge">{{\Auth::user()->unreadNotifications->count()}}</span>
                                @endif
                            </i>
                        </a>
                    </li>
                    <li>
                        <a id="dLabel" type="button" data-toggle="dropdown" href="#">
                            {{Auth::user()->name}}
                        </a>
                    </li>
                    <li class="dropdown">
                        <a id="dLabel" type="button" data-toggle="dropdown"
                           style="padding: 0px 0px 2px;cursor: pointer">
                            <img src="{{\Auth::User()->avatar}}" class="img-circle" width="44px" height="44px"
                                 style="margin-top: 3px;border: 1px solid #fff;cursor: pointer"
                                 alt="">
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/u/{{\Auth::user()->name}}"><i class="fa fa-user fa-mr"></i>我的主页</a>
                            </li>
                            <li>
                                <a href="/user/account"><i class="fa  fa-cog fa-mr"></i>账户设置</a>
                            </li>
                            <li>
                                <a href="/user/favorites"><i class="fa fa-heart fa-mr"></i>我的收藏</a>
                            </li>
                            <li>
                                <a href="/broadcasts/music"><i class="fa fa-microphone fa-mr"></i>音乐电台</a>
                            </li>
                            <li>
                                <a href="/user/password"><i class="fa fa-lock fa-mr"></i>修改密码</a>
                            </li>
                            <li role="separator" class="divider fa-mr"></li>
                            <li>
                                <a href="/logout"><i class="fa fa-sign-out fa-mr"></i>退出登录</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a href="/user/login">登录</a></li>
                    <li><a href="/user/register">注册</a></li>
                @endif

            </ul>
        </div>
    </div>
</nav>

@yield('content')

<div class="footer" id="footer">
    <div id="backToTop" class="scroll-back-to-top" style="display: none">
        <button class="ui black button"><i class="chevron up icon" style="margin: 0px -0.214286em;"></i></button>
    </div>
    <div class="container">
        <div class="row">
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>网站相关</a></dt>
                <dd><a>文章教程</a></dd>
                <dd><a>个人博客</a></dd>
                <dd><a href="http://hao.shejidaren.com/" target="_blank">资源网站</a></dd>
                <dd><a>社区规则</a></dd>
            </dl>
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>学习资料</a></dt>
                <dd><a href="https://laravel.com/" target="_blank">Laravel官网</a></dd>
                <dd><a href="http://laravelacademy.org/" target="_blank">Laravel学院</a></dd>
                <dd><a href="https://laravel-china.org/" target="_blank">PHPHub</a></dd>
                <dd><a href="https://easywechat.org/" target="_blank">EasyWechat</a></dd>
            </dl>
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>常用链接</a></dt>
                <dd><a>域名注册</a></dd>
                <dd><a href="https://unsplash.com/" target="_blank">图片资源</a></dd>
                <dd><a href="http://pkg.phpcomposer.com/" target="_blank">Composer镜像</a></dd>
            </dl>
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>个人相关</a></dt>
                <dd><a href="https://www.jellybook.me" target="_blank">个人博客</a></dd>
                <dd><a href="http://weibo.com/2721760737/profile?topnav=1&wvr=6&is_all=1" target="_blank">个人微博</a></dd>
                <dd><a href="https://github.com/GeekGhc" target="_blank">Github</a></dd>
                <dd><a href="https://segmentfault.com/u/jellygavin" target="_blank">Segmentfault</a></dd>
            </dl>
        </div>
        <div class="footer-bottom">
            <p>ISpace CopyRight @2016&nbsp;&nbsp;Developed By <span style="font-weight: bold">JellyBean</span></p>
            <a style="font-weight: bold" href="http://www.miitbeian.gov.cn" target="_blank">苏ICP备16045385号-2</a>
        </div>
    </div>
</div>

@include('flashy::message')
{{--@include('flash::message')--}}
{{--<script src="{{elixir('/js/app.js')}}"></script>--}}

{{--<script src="/js/index.js"></script>--}}
@yield('footer-js')
</body>
</html>