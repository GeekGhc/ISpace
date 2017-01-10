<?php

namespace App\Http\Controllers\Home;

use App\Comment;
use App\Favorite;
use App\Video;
use Qiniu\Auth;
use App\VideoSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    public function videos()
    {
        $videos = Video::latest()->paginate(10);
        return view('video.video',compact('videos'));
    }


    public function videoSeriesList($series_name)
    {
        $video_serie = VideoSerie::where('name', $series_name)->first();
        $videos = $video_serie->videos;
        return view('video.index', compact('video_serie', 'videos'));
    }

    public function videoPlay($series_name, $video_index)
    {
        $video_series = VideoSerie::where('name', $series_name)->first();
        $video_count = $video_series->videos->count();
        $video = $video_series->videos->get($video_index-1);

        $favorite = Favorite::where('favoriteable_type','App\Video')->where('favoriteable_id',$video->id)->first();
        if(\Auth::check()){
            if($favorite){
                $isFavorite = \Auth::user()->id==$favorite->user_id;
                if(!$isFavorite){$isFavorite = 0;}
            }else{
                $isFavorite = 0;//未收藏
            }
        }else{
            $isFavorite = 2;//游客状态
        }

        $comments = Comment::with('user')->with('to_user')->where('commentable_type','App\Video')->where('commentable_id',$video->id)->get();
        return view('video.play',compact('video','video_index','video_count','video_series','isFavorite','comments'));
    }
}
