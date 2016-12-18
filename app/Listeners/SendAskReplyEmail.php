<?php

namespace App\Listeners;

use App\Events\AskReply;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAskReplyEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AskReply  $event
     * @return void
     */
    public function handle(AskReply $event)
    {
        //
    }
}
