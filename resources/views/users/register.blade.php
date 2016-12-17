@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            @if(Session::has('user_login_failed'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('user_login_failed')}}
                </div>
            @endif
            <div class="login-form" role="main">
                {!! Form::open(['url'=>'/user/register']) !!}
                <div class="form-group tabs">
                    <a class="tabs_tab" href="/user/login">登录</a>
                    <a class="tabs_tab tabs_tab_active" href="/user/register">注册</a>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', '用户名 :') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <!---Email  Field --->
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', '邮箱 :') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <!---Password  Field --->
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', '密码 :') !!}
                    {!! Form::password('password',['class' => 'form-control']) !!}
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <!---Password  Field --->
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {!! Form::label('password_confirmation', '确认密码 :') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                {!! Form::submit('马上注册',['class'=>'btn btn-primary btn-lg register-submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection