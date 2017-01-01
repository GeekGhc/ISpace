@extends('app')
@section('title','帖子-ISpace Community')
@section('header-css')
    <link rel="stylesheet" href="/css/discussion.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="main col-md-9 col-xs-12">

                @foreach($discussions as $discussion)
                    <div class="stream-list">
                        <dt>
                            <a><img class="user-header" src="{{$discussion->user->avatar}}"></a>
                            <a class="nickname">{{$discussion->user->name}}</a>
                        </dt>
                        <dd>
                            <h3 class="discussion-list_title">
                                <a href="{{url('/discussion/'.$discussion->id)}}">{{$discussion->title}}</a>
                            </h3>
                            <ul class="discussion-list_inline">
                                <li><a href="/u/{{\App\User::find($discussion->last_user_id)->name}}" style="color: #00b1b3;font-weight: 800;font-size: 14px">{{\App\User::find($discussion->last_user_id)->name}}</a></li>
                                <li>
                                    <time>{{$discussion->updated_at->diffForHumans()}}更新</time>
                                </li>
                            </ul>
                            <div class="discussion-list_content">
                                {{mb_substr(strip_tags($discussion->html_body),0,100,"utf-8")}}
                            </div>
                            <div class="discussion-list_footer">
                                <div class="tagsLabel">
                                    <ul>
                                        @foreach($discussion->tags as $tag)
                                            <li class="tagLabel php"><span class="label label-{{$tag->type}}">{{$tag->name}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="others-info fr">
                                    <div class="discussion_published_at"><label>发表于{{$discussion->created_at->diffForHumans()}}</label></div>
                                    <div class="discussion_view_count"><i class="fa fa-eye"></i><em>{{$discussion->view_count}}</em></div>
                                    <div class="discussion_comment_count"><i class="fa fa-comment"></i><em>{{$discussion->comment_count}}</em>
                                    </div>
                                </div>
                            </div>
                        </dd>
                    </div>
                @endforeach
                    {!! PaginateRoute::renderPageList($discussions,false,'pagination',true) !!}
                {{--{{$discussions->links()}}--}}


            </div>

            <div class="side col-md-3 col-xs-12">
                <div class="side-ask">
                    <p>今天你有什么问题呢?</p>
                    <a href="{{url('/discussion/create')}}" class="btn btn-primary btn-block">撰写问题</a>
                </div>
            </div>
        </div>
    </div>
@endsection