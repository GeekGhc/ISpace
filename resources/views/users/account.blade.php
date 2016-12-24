@extends('app')
@section('title','ISpace 个人主页设置')
@section('header-css')
    <link rel="stylesheet" href="/css/jquery.Jcrop.css">
    <link rel="stylesheet" href="/css/account.css">
@endsection
@section('header-js')
    <script src="/js/source/jquery.form.js"></script>
    <script src="/js/source/jquery.Jcrop.min.js"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row user-account">

            <div class="col-md-2 col-md-offset-1">
                <div class="account-avatar">
                    <div id="validation-errors"></div>
                    {!! Form::open(['url'=>'/user/avatar','files'=>true,'id'=>'avatar']) !!}
                    <img src="{{$profile->user->avatar}}" class="img-circle" id="user-avatar">
                    <div class="avatar-change">
                        <button class="btn btn-primary btn-change-avatar" id="upload-avatar" type="submit">修改头像</button>
                        {{--<input type="file" id="account-avatar" name="avatar" class="file">--}}
                        <p>选择图片修改头像(图片不宜太大)</p>
                    </div>
                    {!! Form::file('avatar',['class'=>'avatar','id'=>'select-image']) !!}
                    {!! Form::close() !!}
                    <div class="span5">
                        <div id="output" style="display:none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-md-offset-1">
                {!! Form::open(['method'=>'PATCH','url'=>'/user/account/'.$profile->id]) !!}
                <div class="user-setting-general">
                    <h3 style="margin-top: 0;">常规设置</h3>
                    <div class="user-setting-list row form-horizontal">
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3 control-label">用户名:</label>
                            <div class="col-sm-9">
                                <input class="form-control" value="{{$profile->user->name}}" disabled>
                                <span class="help-block bg-warning">用户名建议无需修改,如需修改请联系管理员</span>
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">居住地:</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="city" value="{{$profile->city}}">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">学校:</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="school" value="{{$profile->school}}">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">个人网站:</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="website" placeholder="www.example.com" value="{{$profile->website}}">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">个人简介:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" rows="5" cols="50" placeholder="介绍下自己吧...">{{$profile->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-setting-general form-horizontal">
                    <h3>个人账号</h3>
                    <div class="user-setting-list">
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label" data-placement="https://github.com/XXph">Github:</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="github" placeholder="Your github name" value="{{$profile->github}}">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">新浪微博:</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="weibo" value="{{$profile->weibo}}">
                            </div>
                        </div>
                        <div class="user-setting-item form-group">
                            <label class="col-sm-3  control-label">腾讯QQ:</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="qq" value="{{$profile->qq}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::submit('更新我的资料',['class'=>'btn btn-primary pull-right btn-lg','style'=>'width:100%']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open( [ 'url' => ['/user/crop/api'], 'method' => 'POST', 'onsubmit'=>'return checkCoords();','files' => true ] ) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #ffffff">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">裁剪头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="content">
                            <div class="crop-image-wrapper">
                                <img
                                        src="{{Auth::user()->avatar}}"
                                        class="ui centered image" id="cropbox" style="width: 460px;height: 460px;">
                                <input type="hidden" id="photo" name="photo" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">裁剪头像</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function () {
            var options = {
                beforeSubmit: showRequest,
                success: showResponse,
                dataType: 'json'
            };
            $('#select-image').on('change', function () {
                $('#upload-avatar').html('正在上传...');
                $('#avatar').ajaxForm(options).submit();
            });
        });
        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display', 'none');
            return true;
        }

        function showResponse(response) {
            if (response.success == false) {
                var responseErrors = response.errors;
                $.each(responseErrors, function (index, value) {
                    if (value.length != 0) {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>' + value + '</strong><div>');
                    }
                });
                $("#validation-errors").show();
            } else {
                /*$('#user-avatar').attr('src',response.avatar);
                 $('#upload-avatar').html('更换新头像');*/

                var cropBox = $("#cropbox");
                cropBox.attr('src', response.avatar);
                $('#photo').val(response.image);
                $('#upload-avatar').html('更换新头像');
                $('#exampleModal').modal('show');
                cropBox.Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                    setSelect: [120, 120, 10, 10]
                });
                $('.jcrop-holder img').attr('src', response.avatar);
            }

            function updateCoords(c) {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            }

            function checkCoords() {
                if (parseInt($('#w').val())) return true;
                alert('请选择图片.');
                return false;
            }
        }
    </script>
@endsection