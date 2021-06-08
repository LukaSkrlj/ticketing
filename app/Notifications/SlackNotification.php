<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Facades\Auth;

class SlackNotification extends Notification
{
    use Queueable;

    public $new_user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($new_user = null)
    {
        $this->new_user = $new_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $message = " has joined the party :meow_party:";
        $user = Auth::user();
        return (new SlackMessage)
            ->from($user->name, ':meow_party:')
            ->to('#random')
            ->content( $this->new_user->name .$message);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
