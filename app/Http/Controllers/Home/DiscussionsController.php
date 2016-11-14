<?php

namespace App\Http\Controllers\Home;

use App\Discussion;
use App\Markdown\Markdown;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EndaEditor;
use App\Http\Requests;

class DiscussionsController extends Controller
{
    protected $markdown;
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    public function index()
    {
        $discussions = Discussion::with('user')->latest()->paginate(10);
//        dd($discussions);
//        $body = $this->markdown->markdown($discussions->body);
        return view('discussions.index',compact('discussions'));
    }

    public function create()
    {
        return view('discussions.create');
    }

    public function show($id)
    {
        $discussion = Discussion::with('user')->findOrFail($id);
//        $user = $discussion->user;
        return view('discussions.show',compact('discussion'));
    }

    //修改帖子
    public function edit($id)
    {
        $discussion = Discussion::with('user')->findOrFail($id);
        if(\Auth::user()->id !== $discussion->user->id){
            return redirect('/');
        }
        return view('discussions.edit', compact('discussion'));
    }

    //更新帖子
    public function update(Requests\DiscussionEditRequest $request,$id)
    {
        $discussion = Discussion::findOrFail($id);
        $data = [
            'html_body'=>$this->markdown->markdown($request->get('body'))
        ];
        $discussion->update(array_merge($request->all(), $data));
        return redirect()->action('Home\DiscussionsController@index');
    }

    public function store(Requests\DiscussionStoreRequest $request)
    {
        $data = [
            'user_id'=>\Auth::user()->id,
            'last_user_id'=>\Auth::user()->id,
            'html_body'=>$this->markdown->markdown($request->get('body'))
        ];

        //保存用户数据
        $discussion = Discussion::create(array_merge($request->all(), $data));
        return redirect('/discussion');
    }
}
