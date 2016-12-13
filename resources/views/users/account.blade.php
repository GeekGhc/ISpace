@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/account.css">
@endsection
@section('content')
    <div class="container">
        <div class="row user-account">

            <div class="col-md-2 col-md-offset-1">
                <div class="account-avatar">
                    {!! Form::open(['url'=>'']) !!}
                    <img src="/images/avatar/head.jpg">
                    <div class="avatar-change">
                        <button class="btn btn-primary btn-change-avatar">修改头像</button>
                        <input type="file" id="account-avatar" name="avatar" class="file">
                        <p>选择图片修改头像(图片不宜太大)</p>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="col-md-7 col-md-offset-1">
                <div class="user-setting-general">
                    <h3 style="margin-top: 0;">常规设置</h3>
                    <div class="user-setting-list row form-horizontal">
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3 control-label">用户名:</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="Jelly">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">居住地:</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="上海">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">个人网站:</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="Jelly">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">个人简介:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-setting-general form-horizontal">
                    <h3>个人账号</h3>
                    <div class="user-setting-list">
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">Github:</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="Jelly">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">新浪微博:</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="Jelly">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">腾讯QQ:</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="Jelly">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection