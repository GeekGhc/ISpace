<?php

namespace App;

use App\Events\PasswordReset;
use App\Events\UserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email','avatar','password','confirm_code','is_confirmed','social_type','social_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    //在数据保存到数据库之前会对密码进行一个预处理
    public function setPasswordAttribute($password){
        $this->attributes['password'] = \Hash::make($password);
    }

    //用户----档案
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    //用户----帖子
    public function discussions()
    {
        return $this->hasMany(Discussion::class);//$user->discussions()
    }

    //用户----文章
    public function articles()
    {
        return $this->hasMany(Article::class);//$user->discussions()
    }

    //用户----评论
    public function comments()
    {
        return $this->hasMany(Comment::class);//$user->comments()
    }

    //用户----收藏
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    //新用户注册
    public static function register(array $arr,$data)
    {
        $user = static::create(array_merge($arr, $data));
        Profile::create(['user_id'=>$user->id]);

        //用户信息写入数据库后触发events  比如发送邮件
        event(new UserRegistered($user,$data['confirm_code']));
        return $user;
    }

    //用户密码重置
    public static function password_reset($user)
    {
        //发送用户密码重置邮件
        event(new PasswordReset($user));
        return $user;
    }
}
