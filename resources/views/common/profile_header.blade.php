<div class="profile-header">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="profile-user-header">
                    <a href="#">
                        <img class="profile-user-avatar" src="{{$profile->user->avatar}}">
                    </a>
                </div>
                {{--<div class="profile-header-social">
                    <ul>
                        <li><a href="{{$profile->github}}"><i class="fa fa-github fa-2x"></i></a></li>
                        <li><a><i class="fa fa-weibo fa-2x"></i></a></li>
                        <li><a><i class="fa fa-qq fa-2x"></i></a></li>
                    </ul>
                </div>--}}
            </div>
            <div class="col-md-5">
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
                <table class="ui selectable inverted table">
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
                </table>

            </div>
        </div>
    </div>
</div>