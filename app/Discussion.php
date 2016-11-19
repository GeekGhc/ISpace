<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Discussion extends Model
{
    use Searchable;
    protected $fillable = [
        'title', 'body','html_body','user_id','last_user_id','view_count','comment_count'
    ];
    //帖子----用户
    public function user()
    {
        return $this->belongsTo(User::class);//$discussion->user()
    }

    //帖子----评论
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    //文章----收藏
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }

    //帖子----标签
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

}
