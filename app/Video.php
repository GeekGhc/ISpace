<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'url','intro'
    ];

    //视频----评论
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    //视频----收藏
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }
}


