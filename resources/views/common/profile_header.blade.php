@inject('social','App\UserProfile\SocialAccount')
<div class="profile-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-user-header">
                    <a href="#">
                        <img class="profile-user-avatar" src="{{$profile->user->avatar}}">
                    </a>
                </div>
                <div class="profile-header-social">
                    @if($social->github($profile->user->id))
                        <a class="ui circular icon button" target="_blank"
                           href="https://github.com/{{$social->github($profile->user->id)}}">
                            <i class="github icon"></i>
                        </a>
                    @endif
                    @if($social->weibo($profile->user->id))
                        <a class="ui circular orange icon button"
                           href="http://weibo.com/u/{{$social->weibo($profile->user->id)}}">
                            <i class="weibo icon"></i>
                        </a>
                    @endif
                    @if($social->qq($profile->user->id))
                        <a class="ui circular  blue icon button">
                            <i class="qq icon"></i>
                        </a>
                    @endif
                    @if($social->google($profile->user->id))
                        <a class="ui circular red icon button"
                           href="https://plus.google.com/{{$social->google($profile->user->id)}}">
                            <i class="google plus icon"></i>
                        </a>
                    @endif

                </div>
            </div>
            <div class="col-md-4">
                <div class="profile-head-name">
                    <h2>{{$profile->user->name}}</h2>
                </div>
                <div class="profile-head-other">
                    <div class="profile-other-item">
                        <i class="fa fa-map-marker profile-head-fa"></i>
                        @if($profile->city)
                            <span>{{$profile->city}}</span>
                        @else
                            <span>还未填写</span>
                        @endif
                    </div>
                    <div class="profile-other-item">
                        <i class="fa fa-graduation-cap profile-head-fa"></i>
                        @if($profile->school)
                            <span>{{$profile->school}}</span>
                        @else
                            <span>还未填写</span>
                        @endif
                    </div>
                    <div class="profile-other-item">
                        <i class="fa fa-link profile-head-fa"></i>
                        @if($profile->city)
                            <span>
                                 <a href="http://{{$profile->website}}" target="_blank">{{$profile->website}}</a>
                            </span>
                        @else
                            <span>还未填写</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">

                <h2 class="ui grey inverted header" style="padding-top: 12px">简介</h2>

                <div class="ui grey inverted description-content">
                    @if($profile->description)
                        {{$profile->description}}
                    @else
                        简单介绍你自己吧...
                    @endif
                </div>
                {{--<table class="ui selectable inverted table">
                    <tbody>
                    <tr>
                        <td>Github</td>
                        <td class="right aligned">
                            @if($profile->github)
                                <a href="https://github.com/{{$profile->github}}">{{$profile->github}}</a>
                            @else
                                还未填写
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>QQ</td>
                        <td class="right aligned">
                            @if($profile->qq)
                                {{$profile->qq}}
                            @else
                                还未填写
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Google</td>
                        <td class="right aligned">
                            @if($profile->qq)
                                {{$profile->qq}}
                            @else
                                还未填写
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Weibo</td>
                        <td class="right aligned">
                            @if($profile->weibo)
                                {{$profile->weibo}}
                            @else
                                还未填写
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>简介</td>
                        <td class="right aligned">
                            @if($profile->description)
                                {{$profile->description}}
                            @else
                                还未填写
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>--}}

            </div>
        </div>
    </div>
</div>