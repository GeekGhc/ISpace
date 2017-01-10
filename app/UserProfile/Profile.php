<?php


namespace App\UserProfile;

use App\Discussion;
use App\User;
use App\Comment;

class Profile
{
    public function postsCount($username)
    {
        $user = User::where('name', $username)->first();
        return $user->discussions->count();
    }

    public function articlesCount($username)
    {
        $user = User::where('name', $username)->first();
        return $user->articles->count();
    }

    public function answersCount($username)
    {
        $user = User::where('name', $username)->first();
        $posts_id = Comment::where('commentable_type','App\Discussion')
            ->where('user_id',$user->id)->pluck('commentable_id')->unique();
        $posts = Discussion::find($posts_id->toArray());
        return $posts->count();
    }

    public function FollowersCount()
    {
        $user = User::where('name', $this->username)->first();
    }

    public function FollowingsCount()
    {
        $user = User::where('name', $this->username)->first();
    }
}