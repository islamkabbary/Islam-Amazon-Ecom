<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class StripeHelper
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }
    
    public function createToken ($info_cart)
    {
        return $this->stripe->tokens->create([
            'card'=>[
                "number" => $info_cart['cardNumber'],
                "cvc" => $info_cart['cvc'],
                "exp_month" => $info_cart['month'],
                "exp_year" => $info_cart['year'],
            ]
        ]);
    }

    public function createCustomer ($token)
    {
        return $this->stripe->customers->create([
            'name' => Auth::guard('store')->user()->name,
            'email' => Auth::guard('store')->user()->email,
            'source' => $token->id
        ]);
    }
    
    public function Charge ($info_cart)
    {
        $token = $this->createToken($info_cart);
        $customer = $this->createCustomer($token);
        return $this->stripe->charges->create([
            'amount' => $info_cart['price'] * 100,
            'currency' => 'usd',
            'customer' => $customer->id
        ]);
    }
}