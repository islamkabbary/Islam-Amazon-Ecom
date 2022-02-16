<?php

namespace App\Providers;

use App\Events\DeleteAllCartEvent;
use App\Events\CreateProductInStrip;
use App\Events\DeleteProductInStripeEvent;
use App\Events\NotificationOrderToStore;
use App\Events\UpdateProductInStripeEvent;
use App\Listeners\MyEventToEventlistener;
use App\Listeners\CreateProductInStripListener;
use App\Listeners\DeleteProductInStripeListener;
use App\Listeners\UpdateProductInStripeListener;
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
            MyEventToEventlistener::class,
        ],
        CreateProductInStrip::class => [
            CreateProductInStripListener::class,
        ],
        UpdateProductInStripeEvent::class => [
            UpdateProductInStripeListener::class,
        ],
        DeleteProductInStripeEvent::class => [
            DeleteProductInStripeListener::class,
        ],
        NotificationOrderToStore::class => [],
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
