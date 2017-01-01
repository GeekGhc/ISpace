<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Video extends Model
{
    use Searchable;
    protected $fillable = [
        'title','url','intro','video_series_id'
    ];

    //视频----视频系列
    public function video_series()
    {
        return $this->belongsTo('App\VideoSerie','video_series_id');
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

    //显示创建时间
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}


