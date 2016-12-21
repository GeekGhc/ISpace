<?php

namespace App\Listeners;

use App\Events\AskReply;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAskReplyEmail
{
    protected $mailer;
    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  AskReply  $event
     * @return void
     */
    public function handle(AskReply $event)
    {
        $this->mailer->askReply($event->user,$event->data);
    }
}
