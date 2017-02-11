<?php

namespace App\Http\Controllers\Home;

use App\Music;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BroadcastsController extends Controller
{
    public function musicIndex()
    {
        $musics = Music::orderBy('song_order','desc')->paginate(10);
        return view("broadcasts.index",compact('musics'));
    }

    public function musicPlay($id)
    {
        $music = Music::find($id);
        return view("broadcasts.play",compact('music'));
    }
}
