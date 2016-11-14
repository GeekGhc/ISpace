<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    protected $mailer;

    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
//        dd('send to email to '.$event->user->email);
        $this->mailer->welcome($event->user,$event->data);
    }
}
