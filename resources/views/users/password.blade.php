@extends('app')
@section('title','密码修改-ISpace Community')
@section('content')
    <div class="container section-content">
        <div class="row">
            @if(Session::has('password_edit_failed'))
                <div class="alert alert-danger" role="alert" style="text-align: center">
                    {{Session::get('password_edit_failed')}}
                </div>
            @endif
            <div class="login-form" role="main">
                {!! Form::open(['url'=>'/user/password_edit']) !!}
                <div class="form-group pass-tabs">
                    <a class="tabs_tab" href="/user/login">修改密码</a>
                </div>

                <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                    {!! Form::label('old_password', '原密码 :') !!}
                    {!! Form::text('old_password', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('old_password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif
                </div>

                <!---Password  Field --->
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', '新密码 :') !!}
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

                {!! Form::submit('更新密码',['class'=>'btn btn-primary form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection