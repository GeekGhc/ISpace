<?php
namespace App\UserLogin;

use App\Socialite;
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
        $socialite = new SocialiteManager($config);
        $githubUser = $socialite->driver('github')->user();//user就可以拿到github的公共信息
        //账号进行绑定
        if(Auth::check()){
            $isBind = Socialite::where('social_id',$githubUser->getId())->first();
            if(!is_null($isBind)){
                return 2;
            }
            Socialite::create([
                'social_type'=>'github',
                'social_id'=>$githubUser->getId(),
                'social_name'=>$githubUser->getNickname(),
                'user_id'=>Auth::user()->id
            ]);
            return 1;
        }

        //账号注册登录
        $socialiteUser = Socialite::where(['social_type'=>'github','social_id'=>$githubUser->getId()])->first();
        //如果查到这个用户
        if (!is_null($socialiteUser)) {
            Auth::loginUsingId($socialiteUser->user_id);
            return 0;
        }

        //如果邮箱相同则默认已经有账号  进行登录
        $loginUser = User::where('email',$githubUser->getEmail())->first();
        if (!is_null($loginUser)) {
            Auth::loginUsingId($loginUser->id);
            return 0;
        }

        //重新注册用户
        $user = [
            'name' => 'sp'.time(),
            'email' => $githubUser->getEmail(),
            'password' => bcrypt(str_random(16)),
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $githubUser->getAvatar(),
        ];
        $newUser = User::create($user);
        Socialite::create([
            'social_type'=>'github',
            'social_id'=>$githubUser->getId(),
            'user_id'=>$newUser->id
        ]);
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return 0;
    }

    //qq登录
    public function qqLogin($config)
    {
        $socialite = new SocialiteManager($config);
        $qqUser = $socialite->driver('qq')->user();//user就可以拿到github的公共信息

        //账号进行绑定
        if(Auth::check()){
            $isBind = Socialite::where('social_id',$qqUser->getId())->first();
            if(!is_null($isBind)){
                return 2;
            }
            Socialite::create([
                'social_type'=>'qq',
                'social_id'=>$qqUser->getId(),
                'social_name'=>$qqUser->getNickname(),
                'user_id'=>Auth::user()->id
            ]);
            return 1;
        }


        //账号注册登录
        $socialiteUser = Socialite::where(['social_type'=>'qq','social_id'=>$qqUser->getId()])->first();
        //如果查到这个用户
        if (!is_null($socialiteUser)) {
            Auth::loginUsingId($socialiteUser->user_id);
            return 0;
        }

        $user = [
            'name' => $qqUser->getNickName(),
            'email' => $qqUser->getNickName().'@qq.com',
            'password' => bcrypt(str_random(16)),
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $qqUser->getAvatar(),
        ];
        $newUser = User::create($user);
        Socialite::create([
            'social_type'=>'qq',
            'social_id'=>$qqUser->getId(),
            'user_id'=>$newUser->id
        ]);
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return 0;
    }


    //微博登录
    public function weiboLogin($config)
    {
        $socialite = new SocialiteManager($config);
        $weiboUser = $socialite->driver('weibo')->user();//user就可以拿到weibo的公共信息

        //账号进行绑定
        if(Auth::check()){
            $isBind = Socialite::where('social_id',$weiboUser->getId())->first();
            if(!is_null($isBind)){
                return 2;
            }
            Socialite::create([
                'social_type'=>'weibo',
                'social_id'=>$weiboUser->getId(),
                'social_name'=>$weiboUser->getNickname(),
                'user_id'=>Auth::user()->id
            ]);
            return 1;
        }

        //账号注册登录
        $socialiteUser = Socialite::where(['social_type'=>'weibo','social_id'=>$weiboUser->getId()])->first();
        //如果查到这个用户
        if (!is_null($socialiteUser)) {
            Auth::loginUsingId($socialiteUser->user_id);
            return 0;
        }

        $user = [
            'name' => $weiboUser->getNickName(),
            'email' => $weiboUser->getNickName().'@weibo.com',
            'password' => bcrypt(str_random(16)),
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $weiboUser->getAvatar(),
        ];
        $newUser = User::create($user);
        Socialite::create([
            'social_type'=>'weibo',
            'social_id'=>$weiboUser->getId(),
            'user_id'=>$newUser->id
        ]);
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return 0;
    }


    //google登录
    public function googleLogin($config)
    {
        $socialite = new SocialiteManager($config);
        $googleUser = $socialite->driver('google')->user();//user就可以拿到google的公共信息

        //账号进行绑定
        if(Auth::check()){
            $isBind = Socialite::where('social_id',$googleUser->getId())->first();
            if(!is_null($isBind)){
                return 2;
            }
            Socialite::create([
                'social_type'=>'google',
                'social_id'=>$googleUser->getId(),
                'social_name'=>$googleUser->getNickname(),
                'user_id'=>Auth::user()->id
            ]);
            return 1;
        }

        //账号注册登录
        $socialiteUser = Socialite::where(['social_type'=>'google','social_id'=>$googleUser->getId()])->first();
        //如果查到这个用户
        if (!is_null($socialiteUser)) {
            Auth::loginUsingId($socialiteUser->user_id);
            return 0;
        }

        //如果邮箱相同则默认已经有账号  进行登录
        $loginUser = User::where('email',$googleUser->getEmail())->first();
        if (!is_null($loginUser)) {
            Auth::loginUsingId($loginUser->id);
            return 0;
        }


        $user = [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(str_random(16)),
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $googleUser->getAvatar(),
        ];
        $newUser = User::create($user);
        Socialite::create([
            'social_type'=>'google',
            'social_id'=>$googleUser->getId(),
            'user_id'=>$newUser->id
        ]);
        Profile::create(['user_id' => $newUser->id]);
        Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return 0;
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