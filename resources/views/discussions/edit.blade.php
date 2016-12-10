@extends('app')
@section('header-css')
    <link rel="stylesheet" href="/css/discussion.css">
    <link rel="stylesheet" href="/css/comment.css">
@endsection
@section('content')
    @include('editor::head')
    <style>
        .editor{
            width:100%;
        }
    </style>
    <div class="container">
        <div class="row">
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model($discussion,['method'=>'PATCH','url'=>'/discussion/'.$discussion->id]) !!}
                 <!--- Name Field --->
                <div class="form-group create-post_title">
                    {{--{!! Form::label('title', '帖子标题 :') !!}--}}
                    {!! Form::text('title', null, ['class' => 'form-control','placeholder'=>'标题: 最好一句话说清楚']) !!}
                </div>

                <!--- Tag Field --->
                <div class="form-group">
                    {!! Form::select('tag_list[]',$tags, null, ['class' => 'form-control js-example-basic-multiple','multiple'=>'multiple']) !!}
                </div>

                <!--- Name Field --->
                <div class="form-group">
                    <div class="editor">
                        {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'myEditor']) !!}
                    </div>
                </div>

                <div>
                    {!! Form::submit('更新帖子',['class'=>'btn btn-primary pull-right publish-post']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>
@endsection