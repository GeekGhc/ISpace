<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUser extends Model
{
    protected $table = 'follow_user';

    protected $fillable = ['user_id','followed_user_id'];
}
