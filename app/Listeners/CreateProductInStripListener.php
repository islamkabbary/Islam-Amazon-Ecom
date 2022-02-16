<?php

namespace App\Listeners;

use Stripe\StripeClient;
use App\Events\CreateProductInStrip;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProductInStripListener
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
  public function handle(CreateProductInStrip $event)
  {
    $stripe = new \Stripe\StripeClient('sk_test_51KRheJF9ihmYlrFiM3YLsGcjwq4wd8eSy8DBWZnZQOkty2XvvefGyCI9aKaetBMcNrSrHGq3TmScyo3ShDLj0ter00L1a8i5tX');
    $product_stripe = $stripe->products->create(['name' => $event->product->name]);
    $event->product->product_stripe_id = $product_stripe->id;
    // $price = $stripe->prices->create(
    //   [
    //     'product' => $product_stripe->id,
    //     'unit_amount' => $event->product->price,
    //     'currency' => 'usd',
    //   ]
    // );
    // $event->product->price_product_stripe_id = $price->id;
    $event->product->save();
  }
}
