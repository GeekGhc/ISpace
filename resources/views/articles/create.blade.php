@extends('app')
@section('title','发布文章')
@section('header-css')
    <link rel="stylesheet" href="/css/article.css">
    <link rel="stylesheet" href="/css/comment.css">
@endsection

@section('content')
    @include('editor::head')
    <style>
        .editor{
            width:100%;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <div class="col-md-10 col-md-offset-1">
                {!! Form::open(['url'=>'/article']) !!}
                <!--- Name Field --->
                <div class="form-group create-article_title">
                    {{--{!! Form::label('title', '帖子标题 :') !!}--}}
                    {!! Form::text('title', null, ['class' => 'form-control','placeholder'=>'标题: 最好一句话说清楚']) !!}
                </div>

                <!--- Tags Field --->
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
                    {!! Form::submit('发表文章',['class'=>'btn btn-primary pull-right publish-article']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2({
            placeholder: "标签:  选择文章的相关标签",
            maximumSelectionLength: 5
        });
    </script>
@endsection