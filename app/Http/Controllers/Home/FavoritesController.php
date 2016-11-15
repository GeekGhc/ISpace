<?php

namespace App\Http\Controllers\Home;

use App\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class FavoritesController extends Controller
{
    //收藏帖子
    public function favoritePost($id)
    {
        $discussion = Discussion::findOrFail($id);
        $user = \Auth::user();
        $discussion->favorites()->create(['user_id'=>$user->id]);
        return Redirect::back();
    }

    public function favoriteArticle($id){

    }
}
