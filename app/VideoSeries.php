<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoSeries extends Model
{
    protected $fillable = [
        'name','intro',
    ];
    //视频系列----视频
    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}
