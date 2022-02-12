<?php

namespace App\Helper;



class StripeHelper
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient("sk_test_51KRheJF9ihmYlrFiM3YLsGcjwq4wd8eSy8DBWZnZQOkty2XvvefGyCI9aKaetBMcNrSrHGq3TmScyo3ShDLj0ter00L1a8i5tX");
    }
    
    public function createToken ($info_cart)
    {
        $islam = $this->stripe->tokens->create([
            'cart'=>[
                "number" => $info_cart['cardNumber'],
                "cvc" => $info_cart['cvc'],
                "exp_month" => $info_cart['month'],
                "exp_year" => $info_cart['year'],
            ]
        ]);
        return $islam;
    }

    public function createCustomer ($token)
    {
        
    }
    
    public function Charge ($info_cart)
    {
        $token = $this->createToken($info_cart);
        dd($token);
        // $customer = $this->createCustomer($token);
    }
}