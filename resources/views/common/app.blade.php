<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ISpace @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/source/bootstrap.css">
    {{--<link rel="stylesheet" href="/css/source/font-awesome.css">--}}
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/discussion.css">
    {{--<link href="http://ofnp0bg60.bkt.clouddn.com/style.css" rel="stylesheet">--}}
    @yield('header-css')
    <script src="/js/source/jquery-2.1.4.min.js"></script>
    <script src="/js/source/bootstrap.min.js"></script>
    @yield('header-js')
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
            <a class="navbar-brand" href="{{url('/')}}">ISpace</a>
        </div>

        <!-- 内容分类 -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/heart">热门</a></li>
                <li><a href="/article">文章</a></li>
                <li><a href="/discussion">问答</a></li>
                <li><a href="/event">活动</a></li>
            </ul>

            <form class="navbar-form navbar-left" role="search">
                <div class="form-group search-label">
                    <input type="text" class="form-control search-input" placeholder="关键字搜索">
                    <button type="submit" class="btn btn-default search-btn"><i class="fa fa-search"></i></button>
                </div>
            </form>

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

                <li>
                    <ul class="nav navbar-nav navbar-right">
                        @if(\Auth::check())
                            <li>
                                <a id="dLabel" type="button" data-toggle="dropdown" href="#">
                                    {{Auth::user()->name}}
                                </a>
                            </li>
                            <li>
                                <a id="dLabel" type="button" data-toggle="dropdown" style="padding: 0px 0px 2px">
                                    <img src="{{\Auth::User()->avatar}}" class="img-circle" width="44px" height="44px"
                                         style="margin-top: 3px;border: 1px solid #fff"
                                         alt="">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel" role="menu">
                                    <li>
                                        <a href="/user/avatar"><i class="fa fa-user fa-mr"></i>我的主页</a>
                                    </li>
                                    <li>
                                        <a href="/user/avatar"><i class="fa fa-user fa-mr"></i>更换头像</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-cog fa-mr"></i>修改密码</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-heart fa-mr"></i>特别感谢</a>
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
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container- -->
</nav>

@yield('content')

<div class="footer">
    <div class="container">
        <div class="row">
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>学习资料</a></dt>
                <dd><a>文章教程</a></dd>
                <dd><a>个人博客</a></dd>
                <dd><a>资源网站</a></dd>
                <dd><a>论坛帖子</a></dd>
            </dl>
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>常用链接</a></dt>
                <dd><a>域名注册</a></dd>
                <dd><a>Github</a></dd>
                <dd><a>社区规则</a></dd>
            </dl>
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>网站相关</a></dt>
                <dd><a>域名注册</a></dd>
                <dd><a>Github</a></dd>
                <dd><a>社区规则</a></dd>
            </dl>
            <dl class="col-sm-2 col-md-2 site-link">
                <dt><a>常用链接</a></dt>
                <dd><a>域名注册</a></dd>
                <dd><a>Github</a></dd>
                <dd><a>社区规则</a></dd>
            </dl>
        </div>
        <div class="footer-bottom">
            <p>Developed By JellyBean</p>
        </div>
    </div>
</div>
@include('flashy::message')
{{--@include('flash::message')--}}



</body>
</html>