<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Article;
use App\Discussion;
use App\Events\AskReply;
use App\Http\Requests\ArticleCommentRequest;
use App\Http\Requests\DiscussionCommentRequest;
use App\Http\Requests\VideoCommentRequest;
use App\Notifications\PostComment;
use App\Notifications\PostReply;
use App\Timeline;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use App\Markdown\Markdown;
use EndaEditor;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    protected $markdown;
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    //帖子评论
    public function storePost(DiscussionCommentRequest $request)
    {
        $postId = $request->get('discussion_id');
        $post = Discussion::findOrFail($postId);
        $post->increment('comment_count');
        $post->last_user_id = $request->get('user_id');

        $data = [
            'user_id'=>$request->get('user_id'),
            'to_user_id'=>$request->get('to_user_id')?$request->get('to_user_id'):0,
            'to_comment_id'=>$request->get('to_comment_id')?$request->get('to_comment_id'):0,
            'body'=>$request->get('body'),
            'html_body'=>$this->markdown->markdown($request->get('body')),
        ];
        $comment = $post->comments()->create($data);
        $timeLine = Timeline::create([
            'user_id'=>Auth::user()->id,
            'operation_id'=>$post->id,
            'operation_type'=>'comment',
            'operation_class'=>'App\Discussion'
        ]);

        $askReply = [
            'type'=>'discussion',
            'name'=>$post->user->name,
            'to_user_id'=>$data['to_user_id'],
            'reply_user'=>User::find($request->get('user_id'))->name,
            'post_title'=>$post->title,
            'post_body'=>mb_substr(strip_tags($post->html_body),0,70,"utf-8"),
            'post_id'=>$post->id
        ];
        //如果帖子下产生评论
        if($data['to_user_id']===0){
            $post->user->notify(new PostComment($askReply));
//            event(new AskReply($post->user,$askReply));
        }else{
            User::find($data['to_user_id'])->notify(new PostReply($askReply));
        }
        $post->save();
        $data = [
            'html_body' =>$comment->html_body,
            'comment_id'=>$comment->id,
            'created_at'=>$comment->created_at
        ];
        return $data;
    }


    //文章评论
    public function storeArticle(ArticleCommentRequest $request){
        $articleId = $request->get('article_id');
        $article = Article::findOrFail($articleId);
        $article->increment('comment_count');
//        $article->comment_count = $article->comment_count+1;

        $data = [
            'user_id'=>$request->get('user_id'),
            'to_user_id'=>$request->get('to_user_id')?$request->get('to_user_id'):0,
            'to_comment_id'=>$request->get('to_comment_id')?$request->get('to_comment_id'):0,
            'body'=>$request->get('body'),
            'html_body'=>$this->markdown->markdown($request->get('body')),
        ];
        $comment = $article->comments()->create($data);
        $timeLine = Timeline::create([
            'user_id'=>Auth::user()->id,
            'operation_id'=>$article->id,
            'operation_type'=>'comment',
            'operation_class'=>'App\Article'
        ]);

        //如果文章下产生评论
        if($data['to_user_id']===0){
            $askReply = [
                'type'=>'article',
                'name'=>$article->user->name,
                'to_user_id'=>$data['to_user_id'],
                'reply_user'=>User::find($request->get('user_id'))->name,
                'post_title'=>$article->title,
                'post_body'=>mb_substr(strip_tags($article->html_body),0,70,"utf-8"),
                'post_id'=>$article->id
            ];
            $article->user->notify(new PostComment($askReply));
        }
        $article->save();

        $data = [
            'html_body' =>$comment->html_body,
            'comment_id'=>$comment->id,
            'created_at'=>$comment->created_at
        ];
        return $data;
    }

    //视频评论
    public function storeVideo(VideoCommentRequest $request)
    {
        $videoId = $request->get('video_id');
        $video = Video::findOrFail($videoId);
        $video->increment('comment_count');
//        $video->comment_count = $video->comment_count+1;
        $video->save();

        $data = [
            'user_id'=>$request->get('user_id'),
            'to_user_id'=>$request->get('to_user_id')?$request->get('to_user_id'):0,
            'to_comment_id'=>$request->get('to_comment_id')?$request->get('to_comment_id'):0,
            'body'=>$request->get('body'),
            'html_body'=>$this->markdown->markdown($request->get('body')),
        ];
        $comment = $video->comments()->create($data);
        $data = [
            'html_body' =>$comment->html_body,
            'comment_id'=>$comment->id,
            'created_at'=>$comment->created_at
        ];
        return $data;
    }
}
