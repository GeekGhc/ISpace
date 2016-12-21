<?php

namespace App\Mailer;


class UserMailer extends Mailer
{
    //只是在用户注册时候触发
    public function welcome($user, $token)
    {
        $subject = 'ISpace Community 邮箱确认';
        $view = 'welcome';
        //传入用户名  和 token值
        $data = ['%name%' => [$user->name], '%token%' => [$token]];
        $this->sendTo($user, $subject, $view, $data);
    }

    //忘记密码发送邮件
    public function passwordReset($user)
    {
        $subject = 'ISpace Community 用户密码重置';
        $view = 'password_reset';
        //传入用户名  和token值
        $data = ['%name%' => [$user->name], '%token%' => [$user->confirm_code]];
        $this->sendTo($user, $subject, $view, $data);
    }

    //有人回复帖子时触发
    public function askReply($user,$reply)
    {
        $subject = '有人回复了你的帖子';
        $view = 'ask_reply';
        //传入用户名  和token值
        $data = ['%name%' => [$reply['name']], '%reply_user%' => [$reply['reply_user']],
            '%post_title%'=>[$reply['post_title']],'%post_body%'=>[$reply['post_body']],'%post_id%'=>[$reply['post_id']]];
        $this->sendTo($user, $subject, $view, $data);
    }
}