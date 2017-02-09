<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BroadcastsController extends Controller
{
    public function musicIndex()
    {
        return view("broadcasts.index");
    }

    public function musicPlay($id)
    {
        return view("broadcasts.play");
    }
}
