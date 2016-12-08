<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body','html_body','user_id','to_user_id','to_comment_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function to_user()
    {
        return $this->belongsTo(User::class);
    }

    //对应与文章和帖子和视频
    public function commentable()
    {
        return $this->morphTo();
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i');
//        return Carbon::createFromFormat('Y-m-d H:i', $date)->format('F j, Y @ g:i A');
    }
}
