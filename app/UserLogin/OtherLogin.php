<?php
namespace App\UserLogin;

use Flashy;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Overtrue\Socialite\SocialiteManager;

class OtherLogin
{
    //github登录
    public function githubLogin($config)
    {
        //账号进行绑定
        if(Auth::check()){

        }
        //账号注册登录
        $socialite = new SocialiteManager($config);
        $githubUser = $socialite->driver('github')->user();//user就可以拿到github的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'github')->where('social_id', $githubUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            Auth::loginUsingId($loginUser->id);
            return;
        }
        $user = [
            'name' => $githubUser->getNickName(),
            'email' => $githubUser->getEmail(),
            'password' => bcrypt(str_random(16)),
            'social_type' => 'github',
            'social_id' => $githubUser->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $githubUser->getAvatar(),
        ];

        $loginUser = User::where('email',$user['email'])->first();
        if (!is_null($loginUser)) {
            Auth::loginUsingId($loginUser->id);
            return;
        }
        $loginUser = User::where('name',$user['name'])->first();
        if(!is_null($loginUser)){
            $user['name'] = 'sp'.time();
        }

        $newUser = User::create(array_merge($user, $data));
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return;
    }

    //qq登录
    public function qqLogin($config)
    {
        $socialite = new SocialiteManager($config);
        $qqUser = $socialite->driver('qq')->user();//user就可以拿到github的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'qq')->where('social_id', $qqUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            Auth::loginUsingId($loginUser->id);
            return;
        }
        $user = [
            'name' => $qqUser->getNickName(),
            'email' => $qqUser->getNickName().'@qq.com',
            'password' => bcrypt(str_random(16)),
            'social_type' => 'qq',
            'social_id' => $qqUser->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $qqUser->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return;
    }


    //微博登录
    public function weiboLogin($config)
    {
        $socialite = new SocialiteManager($config);
        $weiboUser = $socialite->driver('weibo')->user();//user就可以拿到weibo的公共信息
        //第一次用户登录
        $loginUser = User::where('social_type', 'weibo')->where('social_id', $weiboUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }
        $user = [
            'name' => $weiboUser->getNickName(),
            'email' => $weiboUser->getNickName().'@weibo.com',
            'password' => bcrypt(str_random(16)),
            'social_type' => 'weibo',
            'social_id' => $weiboUser->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $weiboUser->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        Auth::loginUsingId($newUser->id);
    }


    //google登录
    public function googleLogin($config)
    {
        $socialite = new SocialiteManager($config);
        $googleUser = $socialite->driver('google')->user();//user就可以拿到google的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'google')->where('social_id', $googleUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }
        $user = [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(str_random(16)),
            'social_type' => 'google',
            'social_id' => $googleUser->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $googleUser->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
    }

    //微信登录
    public function wechatLogin($config)
    {
        $socialite = new SocialiteManager($config);
        $wechatUser = $socialite->driver('wechat')->user();//user就可以拿到google的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'wechat')->where('social_id', $wechatUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }
        $user = [
            'name' => $wechatUser->getName(),
            'email' => $wechatUser->getEmail(),
            'password' => bcrypt(str_random(16)),
            'social_type' => 'wechat',
            'social_id' => $wechatUser->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $wechatUser->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
    }
}