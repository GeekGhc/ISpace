<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Discussion;
use App\Events\UserRegistered;
use App\Http\Requests\PasswordEditRequest;
use App\Http\Requests\PasswordForgetRequest;
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
        $this->middleware('auth', ['only' => ['password']]);
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

    public function password()
    {
        return view('users.password');
    }

    //密码修改
    public function passwordEdit(PasswordEditRequest $request)
    {
        $user = \Auth::user();
//        $user = User::find(11);
        if (\Hash::check($request->get('old_password'), $user->password)) {
            $user->password = $request->password;
            $user->save();
            \Auth::logout();
            flashy()->success('密码更新成功', 'https://kobeman.com');
            return redirect('user/login');
        }
        \Session::flash('password_edit_failed', '用户密码不正确');
        return redirect()->action('Home\UserController@password')->withInput();
    }

    //密码重置
    public function passwordForget()
    {
        return view('users.password_forget');
    }

    public function passwordSendEmail(PasswordForgetRequest $request)
    {
        flashy()->success('密码重置邮件已发送', 'https://kobeman.com');
        $user = User::where('email', $request->get('email'))->first();
        User::password_reset($user);
        return redirect('/');
    }

    //用户重置密码
    public function passwordReset($password_token)
    {
        $user = User::where('confirm_code', $password_token)->first();
        //如果没有查到这个用户 重定向到首页
        if (is_null($user)) {
            flashy()->warning('请确保接受到密码重置邮件', 'https://kobeman.com');
            return redirect('/');
        }

        //如果查找到这个用户
        return view('users.password_reset');
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
