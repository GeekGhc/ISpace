@inject('count','App\UserProfile\Profile')

<div class="col-md-3">
    <div class="search-menu-list">
        <ul class="dropDown-menu">
            @if(!$user->owns($profile))
                <li class="item-category">
                    <follow-user-button user_id="{{$profile->user->id}}"></follow-user-button>
                    {{--<button class="btn btn-success" style="margin-right: 10px">关注他</button>--}}
                    <button class="btn btn-default">发私信</button>
                </li>
            @endif
            <li class="item-allCategory">
                <p>
                    <i class="fa fa-fw fa-th-large" style="color: #1678c2;"></i>
                    @if($user->owns($profile)&&\Auth::check())
                        <a href="/u/{{$profile->user->name}}/timeLine">我的时光轴</a>
                    @else
                        <a href="/u/{{$profile->user->name}}/timeLine">他的时光轴</a>
                    @endif
                </p>
            </li>
            <li class="dropdown-separator"></li>
            <li class="item-category">
                <a id="profile-posts-list" href="/u/{{$profile->user->name}}/posts">
                    <span><i class="fa fa-fw fa-square" style="color: #EF6733;"></i></span>
                    @if($user->owns($profile)&&\Auth::check())
                        我的帖子
                    @else
                        他的帖子
                    @endif
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->postsCount($profile->user->name)}}
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-articles-list" href="/u/{{$profile->user->name}}/articles">
                    <span><i class="fa fa-fw fa-square" style="color: #7088a9;"></i></span>
                    @if($user->owns($profile)&&\Auth::check())
                        我的文章
                    @else
                        他的文章
                    @endif
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->articlesCount($profile->user->name)}}
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-answers-list" href="/u/{{$profile->user->name}}/answers">
                    <span><i class="fa fa-fw fa-square" style="color: #09d7c1;"></i></span>
                    @if($user->owns($profile)&&\Auth::check())
                        我的回答
                    @else
                        他的回答
                    @endif
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->answersCount($profile->user->name)}}
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-followers-list" href="/u/{{$profile->user->name}}/followers">
                    <span><i class="fa fa-fw fa-square" style="color: #5829bb;"></i></span>
                    @if($user->owns($profile)&&\Auth::check())
                        我的粉丝
                    @else
                        他的粉丝
                    @endif
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->followersCount($profile->user->name)}}
                    </div>
                </a>
            </li>
            <li class="item-category">
                <a id="profile-followings-list" href="/u/{{$profile->user->name}}/followings">
                    <span><i class="fa fa-fw fa-square" style="color: #d01919;"></i></span>
                    @if($user->owns($profile)&&\Auth::check())
                        我关注的人
                    @else
                        他关注的人
                    @endif
                    <div class="value" style="margin-left: 16px;font-size: 16px;">
                        {{$count->followingsCount($profile->user->name)}}
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>