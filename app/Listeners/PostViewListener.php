<?php

namespace App\Listeners;

use App\Events\PostView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class PostViewListener
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
     * @param  PostView  $event
     * @return void
     */
    public function handle(PostView $event)
    {
        $post = $event->post;
        //查看是否被浏览过
        if(!$this->hasViewedPost($post)){
            //最近没有浏览 则 浏览数加1
            $post->view_count = $post->view_count+1;
            $post->save();
            //看过文章之后将保存到Session
            $this->storeViewedPost($post);
        }
    }

    public function hasViewedPost($post)
    {
        return array_key_exists($post->id,$this->getViewedPost());
    }

    public function getViewedPost()
    {
        return $this->session->get('viewed_post',[]);
    }

    public function storeViewedPost($post)
    {
        $key = 'viewed_post.' . $post->id;
        $this->session->put($key, time());
    }
}
