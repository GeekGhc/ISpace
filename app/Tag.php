<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    //标签与文章
    public function articles()
    {
        return $this->morphedByMany('App\Article', 'taggable');
    }

    //标签与帖子(问答)
    public function discussion()
    {
        return $this->morphedByMany('App\Discussion', 'taggable');
    }

}
