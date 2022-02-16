<?php

namespace App\Helper;

use Stripe\StripeClient;
use Illuminate\Support\Facades\Auth;

class StripeHelper
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    public function createToken($info_card)
    {
        try {
            return $this->stripe->tokens->create([
                'card' => [
                    "number" => $info_card['cardNumber'],
                    "cvc" => $info_card['cvc'],
                    "exp_month" => $info_card['month'],
                    "exp_year" => $info_card['year'],
                ]
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function createCustomer($token)
    {
        try {
            $customer = $this->stripe->customers->create([
                // 'name' => Auth::user()->name,
                'name' => Auth::guard('store')->user()->name,
                // 'email' => Auth::user()->email,
                'email' => Auth::guard('store')->user()->email,
                'source' => $token->id
            ]);
            // $user = Auth::user();
            $user = Auth::guard('store')->user();
            $user->stripe_id = $customer->id;
            $user->save();
            return $customer;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function Charge($info_card)
    {
        try {
            $user = Auth::guard('store')->user();
            if (empty($user->stripe_id)) {
                $token = $this->createToken($info_card);
                $customer = $this->createCustomer($token);
                return $this->stripe->charges->create([
                    'amount' => $info_card['price'] * 100,
                    'currency' => 'usd',
                    'customer' => $customer->id,
                ]);
            }
            return $this->stripe->charges->create([
                'amount' => $info_card['price'] * 100,
                'currency' => 'usd',
                'customer' => Auth::guard('store')->user()->stripe_id,
            ]);
            // dd($pay->paid);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function createProduct($name)
    {
        return $this->stripe->products->create(['name' => $name]);
    }

    public function addPrice($price)
    {
        return  $this->stripe->prices->create(
            [
                'product' => $price['plan_id'],
                'unit_amount' => $price['price'] * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => $price['duration']],
            ]
        );
    }

    public function UpdateProduct($id, $name)
    {
        return $this->stripe->products->update($id, ['name' => $name]);
    }

    public function UpdatePrice($price, $id)
    {
        return $this->stripe->prices->update($id,
            [
                'metadata' => [
                    'unit_amount' =>$price['price'] *100 ,
                    'recurring' => $price['duration'],
                ]
            ]
        );
    }
    
    public function addUserPlan($stripeId, $price)
    {
        return $this->stripe->subscriptions->create([
            'customer' => $stripeId,
            'items' => [[
                'price' => $price,
            ]]
        ]);
    }
}
