<?php

namespace App;

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
}
