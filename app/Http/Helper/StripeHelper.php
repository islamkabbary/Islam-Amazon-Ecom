<?php
namespace App\Helpers;

use Stripe\StripeClient;


class StripeHelper
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }
}