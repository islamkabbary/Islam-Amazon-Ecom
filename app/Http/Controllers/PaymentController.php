<?php

namespace App\Http\Controllers;

use App\Helper\StripeHelper;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Requests\PaymentRequest;

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

    public  function charge(PaymentRequest $request){
        try {
            $info_cart =  $request->validated();
            $product = Product::find($request->product);
            $info_cart['price'] = $product->price;
            $stripe = new StripeHelper();
            return $stripe->Charge($info_cart);
        }
        catch (\Throwable $th) {
            return $th->getMessage() . $th->getLine() . $th->getFile() ;
        }
    }
}
