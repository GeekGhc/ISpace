<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id'];
    //收藏----用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //对应与文章和帖子和视频
    public function favoriteable()
    {
        return $this->morphTo();
    }
}
