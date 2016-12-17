<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordEditRequest;
use App\Http\Requests\PasswordForgetRequest;
use App\Http\Requests\PasswordResetEditRequest;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['password']]);
    }

    public function password()
    {
        return view('users.password');
    }

    //密码修改
    public function passwordEdit(PasswordEditRequest $request)
    {
        $user = \Auth::user();
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

    //用户密码的重置修改
    public function passwordResetEdit(PasswordResetEditRequest $request)
    {
        $user = User::where('confirm_code', $request->get('token'))->first();
        $user->password = $request->get('password');
        $user->save();
        flashy()->success('密码重置成功', 'https://kobeman.com');
        return redirect('user/login');
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
        $confirm_code = $password_token;

        //如果查找到这个用户
        return view('users.password_reset',compact('confirm_code'));
    }

}
