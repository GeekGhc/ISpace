<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.not_read');
    }

    public function allInfo(){
        return view('notifications.all_info');
    }

    public function message(){
        return view('notifications.message');
    }

    //标志消息已读
    public function makeAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }
}
