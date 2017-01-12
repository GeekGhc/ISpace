<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeLine extends Model
{
    protected $table = 'timelines';
    protected $fillable = ['user_id','operation_id','operation_type','operation_class'];

    //时光轴----用户
    public function user()
    {
        return $this->belongsTo('App\User');//$timeLine->user()
    }
}
