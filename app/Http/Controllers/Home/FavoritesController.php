<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Discussion;
use App\Video;
use Flashy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class FavoritesController extends Controller
{
    //收藏帖子
    public function favoritePost(Request $request)
    {
        $id = $request->get('favoriteable_id');
        $discussion = Discussion::findOrFail($id);
        $user = \Auth::user();
        if ($request->get('isFavorite')) {
            $discussion->favorites()->create(['user_id' => $user->id]);
        } else {
            $discussion->favorites()->delete(['user_id' => $user->id]);
        }
//        echo json_encode($discussion);
        return $discussion;
    }

    public function favoriteArticle(Request $request)
    {
        $id = $request->get('favoriteable_id');
        $article = Article::findOrFail($id);
        $user = \Auth::user();
        if ($request->get('isFavorite')) {
            $article->favorites()->create(['user_id' => $user->id]);
        } else {
            $article->favorites()->delete(['user_id' => $user->id]);
        }
        return $article;
    }

    public function favoriteVideo(Request $request)
    {
        $id = $request->get('favoriteable_id');
        $video = Video::findOrFail($id);
        $user = \Auth::user();
        if($request->get('isFavorite')){
            Flashy::success('收藏成功', 'http://kobeman.com');
            $video->favorites()->create(['user_id'=>$user->id]);
        }else{
            Flashy::message('已取消收藏', 'http://kobeman.com');
            $video->favorites()->delete(['user_id'=>$user->id]);
        }
        echo json_encode($video);
    }
}
