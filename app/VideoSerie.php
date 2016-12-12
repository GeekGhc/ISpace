<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoSerie extends Model
{
    protected $fillable = [
        'name','intro','thumbnail'
    ];
    //视频系列----视频
    public function videos()
    {
        return $this->hasMany('App\Video','video_series_id');
    }
}
