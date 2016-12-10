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
}
