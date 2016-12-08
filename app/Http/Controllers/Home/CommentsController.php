<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\Discussion;
use App\Http\Requests\ArticleCommentRequest;
use App\Http\Requests\DiscussionCommentRequest;
use App\Http\Requests\VideoCommentRequest;
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

    public function storePost(DiscussionCommentRequest $request)
    {
        $postId = $request->get('discussion_id');
        $post = Discussion::findOrFail($postId);

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


    public function storeArticle(ArticleCommentRequest $request){
        $articleId = $request->get('article_id');
        $article = Article::findOrFail($articleId);

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

    public function storeVideo(VideoCommentRequest $request)
    {

    }



}
