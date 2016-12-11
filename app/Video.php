<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Video extends Model
{
    use Searchable;
    protected $fillable = [
        'url','intro','video_series_id'
    ];

    //视频----视频系列
    public function video_series()
    {
        return $this->belongsTo('App\VideoSeries');
    }

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


