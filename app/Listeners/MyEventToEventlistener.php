<?php

namespace App\Listeners;

use App\Events\DeleteAllCartEvent;
use Illuminate\Support\Facades\Auth;

class MyEventToEventlistener
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
     * @param  object  $event
     * @return void
     */
    public function handle(DeleteAllCartEvent $event)
    {
        Auth::user()->products()->sync([]);
    }
}
