<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name','type'
    ];

    //标签与文章
    public function articles()
    {
        return $this->morphedByMany('App\Article', 'taggable');
    }

    //标签与帖子(问答)
    public function discussions()
    {
        return $this->morphedByMany('App\Discussion', 'taggable');
    }

}
