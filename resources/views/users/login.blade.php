@extends('app')
@section('title','用户登录-ISpace Community')
@section('content')
    <div class="container">
        <div class="row">
            @if(Session::has('user_login_failed'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('user_login_failed')}}
                </div>
            @endif
            <div class="login-form" role="main">
                {!! Form::open(['url'=>'/user/login']) !!}
                <div class="form-group tabs">
                    <a class="tabs_tab tabs_tab_active" href="/user/login">登录</a>
                    <a class="tabs_tab" href="/user/register">注册</a>
                </div>

                <!---Email  Field --->
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"
                     style="margin-bottom: 26px">
                    {!! Form::label('email', '邮箱 :') !!}
                    {{--<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>--}}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <!---Password  Field --->
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"
                     style="margin-bottom: 26px">
                    {!! Form::label('password', '密码 :') !!}
                    {{--<span class="input-group-addon"><i class="fa fa-key"></i></span>--}}
                    {!! Form::password('password',['class' => 'form-control']) !!}
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                    <input type="text" name="captcha" class="form-control col-md-4 captcha-input">
                    <a id="refresh-captcha">
                        <img src="{{captcha_src()}}"
                             alt="验证码"
                             title="刷新图片"
                             width="152px"
                             height="40px"
                             id="captcha"
                             border="0"
                             data-captcha-config="default"
                        >
                        @if ($errors->has('captcha'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                        @endif
                    </a>
                </div>

                <div class="form-group remember-login">
                    <label class="pull-right login-check">
                        <input id="remember" name="remember" value="0" type="checkbox" style="display: inline-block">
                        记住登录状态
                    </label>
                    {{--{!! Form::hidden('remember',1) !!}--}}
                    <a href="{{url('user/password/forget')}}" class="forget-pass pull-left"><p>忘记密码?</p></a>
                </div>
                <div class="form-group">
                    {!! Form::submit('马上登录',['class'=>'btn btn-primary btn-lg login-submit']) !!}
                </div>
                <div class="form-group quick-login-div">
                    <p class="pull-left quick-login">快捷登录</p>

                    <ul class="login-sns">
                        <li class="github">
                            <a class="icon-login" href="{{url('/user/login/github')}}">
                                <i class="fa fa-github"></i>
                            </a>
                        </li>
                        <li class="weixin">
                            <a class="icon-login" href="{{url('/user/login/weixin')}}">
                                <i class="fa fa-weixin"></i>
                            </a>
                        </li>
                        <li class="weibo">
                            <a class="icon-login" href="{{url('/user/login/weibo')}}">
                                <i class="fa fa-weibo"></i>
                            </a>
                        </li>
                        <li class="google">
                            <a class="icon-login" href="{{url('/user/login/google')}}">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="qq">
                            <a class="icon-login" href="{{url('/user/login/qq')}}">
                                <i class="fa fa-qq"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        $("#remember").change(function () {
            if (!$(this).attr('checked')) {
                $(this).attr('value', 1);
            }
        })
        $('#captcha').on('click', function () {
            var captcha = $(this);
            var url = '/captcha/' + captcha.attr('data-captcha-config') + '/?' + Math.random();
            captcha.attr('src', url);
        })
    </script>
    <script>
        $('#flash-overlay-modal').modal();
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

@endsection