<?php

namespace App\Http\Controllers\Home;

use App\User;
use App\UserLogin\OtherLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\Socialite\SocialiteManager;
use Flashy;

class LoginController extends Controller
{
    protected $login;

    public function __construct(OtherLogin $login)
    {
        $this->login = $login;
    }

    protected $config = [
        'weibo' => [
            'client_id' => '2630420162',
            'client_secret' => 'caa3a434be7ca19afe80197eea1d9db1',
            'redirect' => 'https://kobeman.com/weibo/login'
        ],
        'qq' => [
            'client_id' => '101368952',
            'client_secret' => 'ab9cb9c23461130246ca189f17a86182',
            'redirect' => 'http://localhost:8000/qq/login'
        ],
        'github' => [
            'client_id' => '81ef36deca1d9eb5298b',
            'client_secret' => '8c429e4f6b3fa50b1c555d66a72206e5039e533e',
            'redirect' => 'http://localhost:8000/github/login'
        ],
    ];

    public function driver($style)
    {
        $socialite = new SocialiteManager($this->config);
        return $socialite->driver($style)->redirect();
    }

    public function githubLogin()
    {
        $this->login->githubLogin($this->config);
        return redirect('/');
       /* $socialite = new SocialiteManager($this->config);
        $githubUser = $socialite->driver('github')->user();//user就可以拿到igthub的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'github')->where('social_id', $githubUser->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
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
        $newUser = User::create(array_merge($user, $data));
        \Auth::loginUsingId($newUser->id);
        return redirect('/');*/
    }

    public function weiboLogin()
    {
        $socialite = new SocialiteManager($this->config);
        $User = $socialite->driver('weibo')->user();//user就可以拿到igthub的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'weibo')->where('social_id', $User->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }

        $user = [
            'name' => $User->getNickName(),
            'email' =>'example@ispace.com',
            'password' => bcrypt(str_random(16)),
            'social_type' => 'weibo',
            'social_id' => $User->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $User->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        \Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return redirect('/');
    }

    public function qqLogin()
    {
        $socialite = new SocialiteManager($this->config);
        $User = $socialite->driver('qq')->user();//user就可以拿到igthub的公共信息

        //第一次用户登录
        $loginUser = User::where('social_type', 'qq')->where('social_id', $User->getId())->first();
        //如果没有查到这个用户 重定向到首页
        if (!is_null($loginUser)) {
            \Auth::loginUsingId($loginUser->id);
            return redirect('/');
        }

        $user = [
            'name' => $User->getNickName(),
            'email' =>'example@ispace.com',
            'password' => bcrypt(str_random(16)),
            'social_type' => 'qq    ',
            'social_id' => $User->getId()
        ];
        $data = [
            'is_confirmed' => 1,
            'confirm_code' => str_random(48),
            'avatar' => $User->getAvatar(),
        ];
        $newUser = User::create(array_merge($user, $data));
        \Auth::loginUsingId($newUser->id);
        Flashy::message('Welcome ISpace', 'https://kobeman.com');
        return redirect('/');
    }
}
