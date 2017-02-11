<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = [
       'title','author','song_uri','song_pic','song_order','description'
    ];
}
