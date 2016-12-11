<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    public function videoSeriesList($seires_name)
    {
        return view('video.index');
    }

    public function videoPlay($series_name,$video_index)
    {
        $video = [];
        return view('video.play');
    }
}
