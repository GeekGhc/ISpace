<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
    protected $fillable = ['user_id','social_type','social_id'];
    //用户----第三方账户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
