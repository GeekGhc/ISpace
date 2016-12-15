{{--发表对帖子的评论--}}
<div class="reply-form-container reply-yourself">
    @if(\Auth::check())
        <div class="reply-form">
            {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitFormMain']) !!}
            <div class="reply-field">
                {!! Form::textarea('body',null,['class' => 'form-control','placeholder'=>'写下你的评论...','v-model'=>'newCommentMain.body']) !!}
            </div>
            <button type="submit" class="btn btn-primary reply-button pull-right">发表回复</button>
            {!! Form::close() !!}
        </div>
    @else
        <a class="btn btn-primary btn-lg" href="/user/login" style="width: 100%;">登录参与评论</a>
    @endif
</div>