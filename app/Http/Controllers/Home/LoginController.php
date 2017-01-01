<?php

namespace App\Http\Controllers\Home;

use App\Socialite;
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
            'redirect' => 'http://localhost:8000/github/callback'
        ],
        'google' => [
            'client_id' => '794489703141-4d3uht5o10cbc4ob732rfmjn6ohis9vl.apps.googleusercontent.com',
            'client_secret' => 'jivItp5exFo5olYhQO0AZa11',
            'redirect' => 'https://kobeman.com/google/callback',
        ],
    ];

    public function driver($style)
    {
        $socialite = new SocialiteManager($this->config);
        return $socialite->driver($style)->redirect();
    }

    public function githubLogin()
    {
        $flag = $this->login->githubLogin($this->config);
        if ($flag) {
            if($flag==2){
                flash('该账号已经被绑定到其他注册账号下', 'warning');
            }
            return back();
        }
        return redirect('/');
    }

    public function weiboLogin()
    {
        $flag = $this->login->weiboLogin($this->config);
        if ($flag) {
            if($flag==2){
                flash('该账号已经被绑定到其他注册账号下', 'warning');
            }
            return back();
        }
        return redirect('/');
    }

    public function qqLogin()
    {
        $flag = $this->login->qqLogin($this->config);
        if ($flag) {
            if($flag==2){
                flash('该账号已经被绑定到其他注册账号下', 'warning');
            }
            return back();
        }
        return redirect('/');
    }

    public function wechat()
    {
        $flag = $this->login->wechatLogin($this->config);
        if ($flag) {
            if($flag==2){
                flash('该账号已经被绑定到其他注册账号下', 'warning');
            }
            return back();
        }
        return redirect('/');
    }

    public function googleLogin()
    {
        $flag = $this->login->googleLogin($this->config);
        if ($flag) {
            if($flag==2){
                flash('该账号已经被绑定到其他注册账号下', 'warning');
            }
            return back();
        }
        return redirect('/');
    }

    //解除用户绑定
    public function SocialiteRelieve($id)
    {
        $socialite = Socialite::find($id);
        $socialite->delete();
        return redirect()->back();
    }
}
