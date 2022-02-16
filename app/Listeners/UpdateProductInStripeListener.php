<?php

namespace App\Listeners;

use App\Events\UpdateProductInStripeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductInStripeListener
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
    public function handle(UpdateProductInStripeEvent $event)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51KRheJF9ihmYlrFiM3YLsGcjwq4wd8eSy8DBWZnZQOkty2XvvefGyCI9aKaetBMcNrSrHGq3TmScyo3ShDLj0ter00L1a8i5tX');
        $stripe->products->update($event->product->product_stripe_id, ['name' => $event->product->name]);
        // $stripe->products->update($event->product->price_product_stripe_id, ['name' => $event->product->price]);
        $event->product->save();
    }
}
