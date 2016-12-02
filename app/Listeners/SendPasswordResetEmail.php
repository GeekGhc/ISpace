<?php

namespace App\Listeners;

use App\Events\PasswordReset;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordResetEmail
{
    protected $mailer;

    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  PasswordReset $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $this->mailer->passwordReset($event->user);
    }
}
