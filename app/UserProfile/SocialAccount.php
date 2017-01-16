<?php

namespace App\UserProfile;


use App\Socialite;
use App\User;

class SocialAccount
{
    public function github($user_id)
    {
        $social = Socialite::where('social_type','github')->where('user_id',$user_id)->first();
        if(is_null($social)){
            return 0;
        }
        return $social->social_name;
    }

    public function weibo($user_id)
    {
        $social = Socialite::where('social_type','weibo')->where('user_id',$user_id)->first();
        if(is_null($social)){
            return 0;
        }
        return $social->social_id;
    }

    public function qq($user_id)
    {
        $social = Socialite::where('social_type','qq')->where('user_id',$user_id)->first();
        if(is_null($social)){
            return 0;
        }
        return $social->social_id;
    }

    public function google($user_id)
    {
        $social = Socialite::where('social_type','google')->where('user_id',$user_id)->first();
        if(is_null($social)){
            return 0;
        }
        return $social->social_id;
    }
}