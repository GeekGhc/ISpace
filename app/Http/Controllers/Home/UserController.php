<?php

namespace App\Http\Controllers\Home;

use App\Favorite;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Image;
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
use App\VideoSerie;
use Flashy;
use Illuminate\Http\Request;
use App\Http\Requests;
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
        $video_series = VideoSerie::all();
        return view('index', compact('video_series'));
        //第一次用户登录
    }


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


    //用户的账户设置
    public function userAccount()
    {
        $user = \Auth::user();
        $profile = Profile::with('user')->where('user_id',$user->id)->first();
        return view('users.account',compact('profile'));
    }


    //用户账户资料更新
    public function userUpdate(Request $request,$id)
    {
        $profile = Profile::findOrFail($id);
        $profile-> update($request->all());
        return redirect('user/account');
    }

    //修改用户头像
    public function changeAvatar(Request $request)
    {
        $file = $request->file("avatar");

        //请求验证 (检查是否是image类型)
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $destinationPath = 'uploads/avatar/';
        $filename = \Auth::user()->id . '_' . time() . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        Image::make($destinationPath . $filename)->fit(400)->save();

        //更新数据库中用户头像的字段
      /*   $user = User::find(\Auth::user()->id);
         $user->avatar = '/' . $destinationPath . $filename;
         $user->save();*/

        return \Response::json([
            'success' => true,
            'avatar' => asset($destinationPath . $filename),
            'image' =>  $destinationPath . $filename,
        ]);
    }

    //用户头像的裁剪
    public function cropAvatar(Request $request)
    {
        $photo =$request->get('photo');
        $height = (int)$request->get('h');
        $width = (int)$request->get('w');
        $xAlign = (int)$request->get('x');
        $yAlign = (int)$request->get('y');

        Image::make($photo)->crop($width, $height, $xAlign, $yAlign)->save();
        $user = \Auth::user();
//        $result = unlink($user->avatar);
        $user->avatar = asset($photo);
        $user->save();
        return redirect('user/account');
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
//            $videos = Video::with('user')->orderBy('comment_count', 'desc')->paginate(10);
            return view('search.index', compact('articles', 'discussions', 'videos'));
        }
    }
}
