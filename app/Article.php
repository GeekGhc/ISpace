<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;
    protected $fillable = [
        'title', 'body','html_body','user_id','last_user_id','view_count','comment_count'
    ];

    //获得上一篇文章的id
    public function getPrevArticleId($id)
    {
        return Article::where('id','<',$id)->max('id');
    }

    //获得下一篇文章的id
    public function getNextArticleId($id)
    {
        return Article::where('id','>',$id)->min('id');
    }

    //文章----用户
    public function user()
    {
        return $this->belongsTo(User::class);//$discussion->user()
    }

    //文章----最后更新用户
    public function last_user()
    {
        return $this->belongsTo(User::class);
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
