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

    public $config = [
        'weibo' => [
            'client_id' => '2630420162',
            'client_secret' => 'caa3a434be7ca19afe80197eea1d9db1',
            'redirect' => 'https://kobeman.com/weibo/callback'
        ],
        'qq' => [
            'client_id' => '101368952',
            'client_secret' => 'ab9cb9c23461130246ca189f17a86182',
            'redirect' => 'https://kobeman.com/qq/callback'
        ],
        'github' => [
            'client_id' => '81ef36deca1d9eb5298b',
            'client_secret' => '8c429e4f6b3fa50b1c555d66a72206e5039e533e',
            'redirect' => 'https://kobeman.com/github/callback'
        ],
        'google'=>[
            'client_id'=>'794489703141-4d3uht5o10cbc4ob732rfmjn6ohis9vl.apps.googleusercontent.com',
            'client_secret'=>'jivItp5exFo5olYhQO0AZa11',
            'redirect'=>'https://kobeman.com/google/callback',
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
    }

    public function weiboLogin()
    {
        $this->login->weiboLogin($this->config);
        return redirect('/');
    }

    public function qqLogin()
    {
        $this->login->qqLogin($this->config);
        return redirect('/');
    }

    public function wechat(){
        $this->login->wechatLogin($this->config);
        return redirect('/');
    }

    public function googleLogin()
    {
        $this->login->googleLogin($this->config);
        return redirect('/');
    }
}
