<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Discussion;
use App\Http\Requests\ArticleCommentRequest;
use App\Http\Requests\DiscussionCommentRequest;
use App\Http\Requests\VideoCommentRequest;
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
        $post->comment_count = $post->comment_count+1;
        $post->save();

        $data = [
            'user_id'=>$request->get('user_id'),
            'to_user_id'=>$request->get('to_user_id')?$request->get('to_user_id'):0,
            'to_comment_id'=>$request->get('to_comment_id')?$request->get('to_comment_id'):0,
            'body'=>$request->get('body'),
            'html_body'=>$this->markdown->markdown($request->get('body')),
        ];
        $comment = $post->comments()->create($data);
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
        $article->comment_count = $article->comment_count+1;
        $article->save();

        $data = [
            'user_id'=>$request->get('user_id'),
            'to_user_id'=>$request->get('to_user_id')?$request->get('to_user_id'):0,
            'to_comment_id'=>$request->get('to_comment_id')?$request->get('to_comment_id'):0,
            'body'=>$request->get('body'),
            'html_body'=>$this->markdown->markdown($request->get('body')),
        ];
        $comment = $article->comments()->create($data);
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
        $video->comment_count = $video->comment_count+1;
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
