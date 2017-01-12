<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Discussion extends Model
{
    use Searchable;
    protected $fillable = [
        'title', 'body', 'html_body', 'user_id', 'last_user_id', 'view_count', 'comment_count','is_first'
    ];

    //帖子----用户
    public function user()
    {
        return $this->belongsTo('App\User');//$discussion->user()
    }

    //帖子----最后更新用户
    public function last_user()
    {
        return $this->belongsTo('App\User');
    }

    //帖子----评论
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    //帖子----收藏
    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favoriteable');
    }

    //帖子----标签
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    //获取帖子标签
    public function getTagListAttribute()
    {
        return $this->tags->pluck('id')->all();
    }

}
