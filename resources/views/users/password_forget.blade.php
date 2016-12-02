@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            @if(Session::has('password_edit_failed'))
                <div class="alert alert-danger" role="alert" style="text-align: center">
                    {{Session::get('password_edit_failed')}}
                </div>
            @endif
            <div class="login-form" role="main">
                {!! Form::open(['url'=>'/user/password/forget/send_email']) !!}
                <div class="form-group pass-tabs">
                    <a class="tabs_tab">密码找回</a>
                </div>

                <!---Email  Field --->
                <div class="input-group input-group-lg{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 26px">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    {!! Form::email('email', null, ['class' => 'form-control',' placeholder'=>'注册邮箱']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group input-group-lg{{ $errors->has('captcha') ? ' has-error' : '' }}" style="margin-bottom: 26px">
                    <input type="text" name="captcha" class="form-control col-md-4 captcha-input" placeholder="验证码">
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
                            <span class="help-block" >
                                  <strong>{{ $errors->first('captcha') }}</strong>
                            </span>
                        @endif
                    </a>
                </div>


                <div class="form-group input-group-lg" style="text-align: center;margin-bottom: 0px">
                {!! Form::submit('发送重置邮件',['class'=>'btn btn-primary btn-lg','style'=>'width:100%']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#captcha').on('click',function(){
            var captcha = $(this);
            var url = '/captcha/'+captcha.attr('data-captcha-config')+'/?'+Math.random();
            captcha.attr('src',url);
        })
    </script>
    <script>
        $('#flash-overlay-modal').modal();
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@endsection