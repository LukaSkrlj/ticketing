<?php

namespace App\Providers;

use App\Events\TicketCreated;
use App\Events\UserCreated;
use App\Listeners\SendUserCreatedNotification;
use App\Listeners\SendTicketCreatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TicketCreated::class => [
            SendTicketCreatedNotification::class,
        ],
        UserCreated::class => [
            SendUserCreatedNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
