<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

class PaymentController extends Controller
{
    public function checkout($id)
    {
        $product = Product::find($id);
        $cart = Cart::where('product_id',$id)->first();
        return view('checkout',compact('product','cart'));
    } 

    public function stripe($id)
    {
        $product = Product::find($id);
        return view('stripe',compact('product'));
    }
}
