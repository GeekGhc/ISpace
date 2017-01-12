<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Comment;
use App\Discussion;
use App\Events\PostView;
use App\Favorite;
use App\Markdown\Markdown;
use App\Tag;
use App\Timeline;
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

//        $body = $this->markdown->markdown($discussions->body);
        return view('discussions.index',compact('discussions'));
    }

    public function create()
    {
        $tags = Tag::pluck('name','id');
        return view('discussions.create',compact('tags'));
    }

    public function show($id)
    {
        //判断这个用户是否收藏了这篇帖子
        $discussion = Discussion::with('user')->findOrFail($id);
        event(new PostView($discussion));
        $favorite = Favorite::where('favoriteable_type','App\Discussion')->where('favoriteable_id',$discussion->id)->first();
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
        $comments = Comment::with('user')->with('to_user')->where('commentable_type','App\Discussion')->where('commentable_id',$id)->get();
        return view('discussions.show',compact('discussion','isFavorite','comments'));
    }

    //修改帖子
    public function edit($id)
    {
        $tags = Tag::pluck('name','id');
        $discussion = Discussion::with('user')->findOrFail($id);
        if(\Auth::user()->id !== $discussion->user->id){
            return redirect('/');
        }
        return view('discussions.edit', compact('discussion','tags'));
    }

    //更新帖子
    public function update(Requests\DiscussionEditRequest $request,$id)
    {
        $discussion = Discussion::findOrFail($id);
        $data = [
            'html_body'=>$this->markdown->markdown($request->get('body'))
        ];
        $discussion->update(array_merge($request->all(), $data));
        //更新帖子标签
        $discussion->tags()->sync($request->get('tag_list'));
        return redirect()->action('Home\DiscussionsController@index');
    }

    public function store(Requests\DiscussionStoreRequest $request)
    {
        $data = [
            'user_id'=>Auth::user()->id,
            'last_user_id'=>Auth::user()->id,
            'html_body'=>$this->markdown->markdown($request->get('body'))
        ];

        //保存帖子
        $discussion = Discussion::create(array_merge($request->all(), $data));
        $discussion->tags()->attach($request->get('tag_list'));
        $timeLine = Timeline::create([
            'user_id'=>Auth::user()->id,
            'operation_id'=>$discussion->id,
            'operation_type'=>'post',
            'operation_class'=>'App\Discussion'
        ]);
        return redirect('/discussion');
    }
}
