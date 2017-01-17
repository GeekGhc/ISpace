<?php

namespace App\Http\Controllers\Home;

use App\TimeLine;
use Auth;
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    //收藏的帖子
    public function posts()
    {
        $user = Auth::user();
        $discussions_id = $user->favorites->where('favoriteable_type','App\Discussion')->pluck('favoriteable_id')->toArray();
//        dd($discussions_id);
        $discussions = Discussion::with('user')->find($discussions_id);
//        dd($discussions);
        return view('favorites.post',compact('discussions'));
    }

    //收藏的文章
    public function articles()
    {
        $user = Auth::user();
        $articles_id = $user->favorites->where('favoriteable_type','App\Article')->pluck('favoriteable_id')->toArray();
        $articles = Article::with('user')->find($articles_id);
        return view('favorites.article',compact('articles'));
    }

    //收藏的视频
    public function videos()
    {
        $user = Auth::user();
        $videos_id = $user->favorites->where('favoriteable_type','App\Video')->pluck('favoriteable_id')->toArray();
        $videos = Video::find($videos_id);
        return view('favorites.video',compact('videos'));
    }

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
        $timeLine = Timeline::create([
            'user_id'=>Auth::user()->id,
            'operation_id'=>$discussion->id,
            'operation_type'=>'comment',
            'operation_class'=>'App\Discussion',
            'operation_text'=>'收藏帖子',
            'operation_icon'=>'fa-star'
        ]);
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
        $timeLine = Timeline::create([
            'user_id'=>Auth::user()->id,
            'operation_id'=>$article->id,
            'operation_type'=>'comment',
            'operation_class'=>'App\Article',
            'operation_text'=>'收藏文章',
            'operation_icon'=>'fa-star'
        ]);
        return $article;
    }

    public function favoriteVideo(Request $request)
    {
        $id = $request->get('favoriteable_id');
        $video = Video::findOrFail($id);
        $user = \Auth::user();
        if ($request->get('isFavorite')) {
//            Flashy::success('收藏成功', 'http://kobeman.com');
            $video->favorites()->create(['user_id' => $user->id]);
        } else {
            $video->favorites()->delete(['user_id' => $user->id]);
        }
        $timeLine = Timeline::create([
            'user_id'=>Auth::user()->id,
            'operation_id'=>$video->id,
            'operation_type'=>'comment',
            'operation_class'=>'App\Video',
            'operation_text'=>'收藏视频',
            'operation_icon'=>'fa-star'
        ]);
        return $video;
    }

}
