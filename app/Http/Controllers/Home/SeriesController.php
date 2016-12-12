<?php

namespace App\Http\Controllers\Home;

use App\VideoSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    public function videoSeriesList($series_name)
    {
        $video_serie = VideoSerie::where('name',$series_name)->first();
        $videos = $video_serie->videos;
        return view('video.index',compact('video_serie','videos'));
    }

    public function videoPlay($series_name,$video_index)
    {
        $video_serie = VideoSerie::where('name',$series_name)->first();
        $video = [];
        return view('video.play');
    }
}
