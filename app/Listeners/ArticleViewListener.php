<?php

namespace App\Listeners;

use App\Events\ArticleView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class ArticleViewListener
{
    protected $session;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  ArticleView $event
     * @return void
     */
    public function handle(ArticleView $event)
    {
        $article = $event->article;
        //查看是否被浏览过
        if(!$this->hasViewedArticle($article)){
            //最近没有浏览 则 浏览数加1
            $article->view_count = $article->view_count+1;
            $article->save();
            //看过文章之后将保存到Session
            $this->storeViewedArticle($article);
        }
    }

    public function hasViewedArticle($article)
    {
        return array_key_exists($article->id,$this->getViewedArticle());
    }

    public function getViewedArticle()
    {
        return $this->session->get('viewed_article', []);
    }

    public function storeViewedArticle($article)
    {
        $key = 'viewed_article.' . $article->id;
        $this->session->put($key, time());
    }
}
