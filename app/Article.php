<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;
    protected $fillable = [
        'title', 'body','html_body','user_id','view_count','comment_count'
    ];

    //文章----用户
    public function user()
    {
        return $this->belongsTo(User::class);//$discussion->user()
    }

    //文章----评论
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    //文章----收藏
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }


    //文章----标签
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    //获取文章标签
    public function getTagListAttribute()
    {
        return $this->tags->pluck('id')->all()  ;
    }
}
