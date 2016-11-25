<?php

namespace App\Mailer;


class UserMailer extends Mailer
{
    //只是在用户注册时候触发
    public function welcome($user,$token)
    {
        $subject = 'ISpace 邮箱确认';
        $view = 'welcome';
//        $data = ['%name%' => [$user->name],'%token%' => [str_random(40)]];
        //传入用户名  和 token值
        $data = ['%name%' => [$user->name],'%token%'=>[$token]];
        $this->sendTo($user, $subject, $view, $data);
    }

    //忘记密码发送邮件
    public function forgotPassword()
    {
        $subject = 'ISpace 邮箱确认';
    }
}