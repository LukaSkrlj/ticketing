<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Notification;

class SendUserCreatedNotification
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Notification::route('slack', env('SLACK_HOOK'))
            ->notify(new SlackNotification($event->user));
    }
}
