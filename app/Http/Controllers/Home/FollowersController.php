<?php

namespace App\Http\Controllers\Home;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class FollowersController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function isFollow($id)
    {
        $user = $this->user->byId($id);
        $followers = $user->followedUser()->pluck('follower_user_id')->toArray();
//        return response()->json(['followed'=>Auth::guard('api')->user()->id]);
        if(in_array(Auth::user()->id,$followers)){
            return response()->json(['followed'=>true]);
        }
        return response()->json(['followed'=>false]);
    }

    public function follow()
    {
        $userToFollow = $this->user->byId(request('user'));
        $followed = Auth::user()->followThisUser($userToFollow);

        if(count($followed['attached'])>0){
           $data = [
               'type'=>'follow',
               'user_id'=>request('user'),
               'user_name'=>$userToFollow->name
           ];
            $userToFollow->notify(new NewUserFollowNotification($data));
            $userToFollow->increment('followers_count');
            Auth::user()->increment('followings_count');
            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');
        Auth::user()->decrement('followings_count');

        return response()->json(['followed' => false]);
    }
}
