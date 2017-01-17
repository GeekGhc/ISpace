<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Comment;
use App\Discussion;
use App\Favorite;
use App\Profile;
use App\Timeline;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    //用户的个人主页
    public function profile($username)
    {
        $user = User::where('name', $username)->first();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();
        $articles = $user->articles;
        $posts = $user->discussions;
        $favorites = Favorite::where('user_id',$user->id)->get();
        return view('users.profile',compact('profile','articles','posts','favorites'));
    }

    //用户的帖子
    public function post($username)
    {
        $user = User::where('name', $username)->first();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();
        $posts = $user->discussions;
//        dd($user);
        return view('profile.post',compact('user','profile','posts'));
    }

    //用户的文章
    public function article($username)
    {
        $user = User::where('name', $username)->first();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();
        $articles = $user->articles;
        return view('profile.article',compact('user','profile','articles'));
    }

    //用户的回答
    public function answer($username)
    {
        $user = User::where('name', $username)->first();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();
        $posts_id = Comment::where('commentable_type','App\Discussion')
                          ->where('user_id',$user->id)->pluck('commentable_id')->unique();
        $posts = Discussion::find($posts_id->toArray());
        return view('profile.answer',compact('user','profile','posts'));
    }

    //用户关注的人
    public function follower($username)
    {
        $user = User::where('name', $username)->first();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();
        $followers = $user->followedUser;
        return view('profile.follower',compact('user','profile','followers'));
    }

    //用户的粉丝
    public function following($username)
    {
        $user = User::where('name', $username)->first();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();
        $followings = $user->followerUser;
//        dd($followings);
//        $posts = $user->discussions;
        return view('profile.following',compact('user','profile','followings'));
    }

    //用户的时光轴
    public function timeLine($username)
    {
        $user = User::where('name', $username)->first();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();

        $timeLines = $user->timeLines;
        return view('profile.timeLine',compact('user','profile','timeLines'));
    }
}
