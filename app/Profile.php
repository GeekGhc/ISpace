<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //档案----用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
