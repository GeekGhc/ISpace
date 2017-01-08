<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Discussion;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //用户站内搜索
    public function searchPost(Request $request)
    {
        //判断是否存在搜索数据
        if ($request->has('q')) {
            $discussions = Discussion::search($request->input('q'))->orderBy('comment_count', 'desc')->paginate(6);
            $query = $request->get('q');
            return view('search.post', compact('discussions', 'query'));
        }
        $discussions = Discussion::with('user')->orderBy('comment_count', 'desc')->paginate(6);
        $query = '';
        return view('search.post', compact('discussions', 'query'));
    }

    public function searchArticle(Request $request)
    {
        //判断是否存在搜索数据
        if ($request->has('q')) {
            $articles = Article::search($request->input('q'))->orderBy('comment_count', 'desc')->paginate(6);
            $query = $request->get('q');
            return view('search.article', compact('articles', 'query'));
        }
        $articles = Article::with('user')->orderBy('comment_count', 'desc')->paginate(6);
        $query = '';
        return view('search.article', compact('articles', 'query'));
    }

    public function searchVideo(Request $request)
    {
        //判断是否存在搜索数据
        if ($request->has('q')) {
            $videos = Video::search($request->input('q'))->orderBy('comment_count', 'desc')->paginate(8);
            $query = $request->get('q');
            return view('search.video', compact('videos', 'query'));
        }
        $videos = Video::paginate(8);
        $query = '';
        return view('search.video', compact('videos', 'query'));
    }

    public function loadPost(Request $request)
    {
        if ($request->has('q')) {
            $step = $request->get('step');
            $posts = Discussion::search($request->get('q'))->orderBy('comment_count', 'desc')->limit(4,$step)->get();
            return $posts->toArray();
        }
        $step = $request->get('step');
        $posts = Discussion::with(['user', 'last_user'])->orderBy('comment_count', 'desc')->skip($step)->take(4)->get();
        return $posts->toArray();
    }

    public function loadArticle(Request $request)
    {
        if ($request->has('q')) {
            $step = $request->get('step');
            $articles = Article::search($request->get('q'))->with('user')->orderBy('comment_count', 'desc')->skip($step)->take(4)->get();
            return $articles->toArray();
        }
        $step = $request->get('step');
        $articles = Article::with('user')->orderBy('comment_count', 'desc')->skip($step)->take(4)->get();
        return $articles->toArray();
    }

    public function loadVideo(Request $request)
    {
        if ($request->has('q')) {
            $step = $request->get('step');
            $videos = Video::search($request->get('q'))->skip($step)->take(4)->get();
            return $videos->toArray();
        }
        $step = $request->get('step');
        $videos = Video::skip($step)->take(4)->get();
        return $videos->toArray();
    }
}
