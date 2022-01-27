<?php

namespace App\Providers;

use App\Events\DeleteAllCartEvent;
use App\Listeners\MyEventToEventlistener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        DeleteAllCartEvent::class => [
            // SendEmailVerificationNotification::class,
            MyEventToEventlistener::class,
        ],
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
