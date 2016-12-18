@extends('app')
@section('title','密码重置-ISpace Community')
@section('content')
    <div class="container">
        <div class="row">
            @if(Session::has('password_edit_failed'))
                <div class="alert alert-danger" role="alert" style="text-align: center">
                    {{Session::get('password_edit_failed')}}
                </div>
            @endif
            <div class="login-form" role="main">
                {!! Form::open(['url'=>'/user/password/reset/edit?token='.$confirm_code]) !!}
                <div class="form-group pass-tabs">
                    <a class="tabs_tab" href="/user/login">重置密码 {{$confirm_code}}</a>
                </div>


                <!---Password  Field --->
                <div class="form-group input-group-lg{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom: 26px">
                    {!! Form::label('password', '新密码 :') !!}
                    {!! Form::password('password',['class' => 'form-control','placeholder'=>"新密码"]) !!}
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <!---Password  Field --->
                <div class="form-group input-group-lg{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="margin-bottom: 26px">
                    {!! Form::label('password_confirmation', '确认密码 :') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>"密码确认"]) !!}
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group input-group-lg" style="text-align: center;margin-bottom: 0px">
                    {!! Form::submit('更新密码',['class'=>'btn btn-primary form-control  btn-lg','style'=>'width:100%']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection