<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Discussion;
use App\Events\UserRegistered;
use App\Http\Requests\PasswordEditRequest;
use App\Http\Requests\PasswordForgetRequest;
use App\Http\Requests\PasswordResetEditRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Mailer\UserMailer;
use App\User;
use App\Video;
use Flashy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userMailer;

    public function __construct(UserMailer $userMailer)
    {
        $this->userMailer = $userMailer;
    }

    public function index()
    {
        return view('index');
        //第一次用户登录
    }


    public function profile($username)
    {
        $user = User::where('name', $username)->first();
//        $profile = $user->profile;
        return view('users.profile');
    }


    public function edit($id)
    {
        return view('users.editInfo');
    }


    public function update(Request $request, $id)
    {

    }

    public function login()
    {
        return view('users.login');
    }

    public function register()
    {
        return view('users.register');
    }

    /**
     * 用户登录
     */
    public function signin(UserLoginRequest $request)
    {

        $remember = $request->get('remember') ? 1 : 0;
        if (\Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_confirmed' => 1,
        ], $remember)
        ) {
            Flashy::message('Welcome ISpace', 'https://kobeman.com');
//            flash('登录成功', 'success');
            return redirect('/');//重定向到首页
        };
        \Session::flash('user_login_failed', '密码不正确或者邮箱没有验证');
        return redirect('user/login')->withInput();
    }

    /**
     * 用户注册信息存储
     */
    public function store(UserRegisterRequest $request)
    {
        $data = [
            'avatar' => '/images/avatar/default.png',
            'confirm_code' => str_random(48),
            'social_type' => 'local',
            'user_name' => $request->get('name'),
        ];

        User::register($request->all(), $data);
        return redirect('/user/login');
    }

    //退出登录
    public function logout()
    {
        \Auth::logout();
        flashy()->success('You have been logged out!', 'https://kobeman.com');
        return redirect('/');
    }

    /**
     * 用户邮箱验证
     */
    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();
        //如果没有查到这个用户 重定向到首页
        if (is_null($user)) {
            return redirect('/');
        }

        //如果查找到这个用户
        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);//确保点击后再次点击是无效的
        $user->save();

        return redirect('user/login');
    }

    //用户站内搜索
    public function search(Request $request)
    {
        //判断是否存在搜索数据
        if ($request->has('q')) {
            $articles = Article::search($request->input('q'))->paginate(10);
//            $discussions = Discussion::search($request->input('q'))->paginate(10);
//            $videos = Video::search($request->input('q'))->paginate(10);
            return view('search.index', compact('articles'));
        } else {
            $articles = Article::with('user')->orderBy('comment_count', 'desc')->paginate(10);
            $discussions = Discussion::with('user')->orderBy('comment_count', 'desc')->paginate(10);
            $videos = Video::with('user')->orderBy('comment_count', 'desc')->paginate(10);
            return view('search.index', compact('articles', 'discussions', 'videos'));
        }
    }
}
