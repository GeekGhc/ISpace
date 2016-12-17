<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'city','website','description','github','qq','weibo','experience_count'
    ];

    //档案----用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
