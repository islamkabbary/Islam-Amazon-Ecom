<?php

namespace App\Http\Controllers\Api\Web;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Coupon;
use App\Events\MyEvent;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Events\MyEventToEvent;
use App\Events\DeleteAllCartEvent;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CartRresource;
use Illuminate\Support\Facades\Redis;
use App\Http\Resources\OrderRresource;
use App\Events\NotificationOrderToStore;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        try {
            $user = Auth::guard('api')->user();
            if (empty($user) && empty(Redis::get('cart'))) {
                Redis::set('cart', json_encode([
                    ['product_id' => $request->product_id, 'qty' => $request->qty],
                ]));
                $cart = json_decode(Redis::get('cart'));
                return $cart;
            } elseif (empty($user) && !empty(Redis::get('cart'))) {
                $productsInCart = json_decode(Redis::get('cart'));
                $newProduct = [];
                $found = false;
                foreach ($productsInCart as $productInCart) {
                    if ($productInCart->product_id == $request->product_id) {
                        $productInCart->qty += $request->qty;
                        $found = true;
                    }
                    $newProduct[] = $productInCart;
                }
                if (!$found) {
                    $newProduct[] = ['product_id' => $request->product_id, 'qty' => $request->qty];
                }
                Redis::set('cart', json_encode($newProduct));
                $cart = json_decode(Redis::get('cart'));
                return $cart;
            } elseif (!empty($user)) {
                $products = Auth::user()->products()->where("products.id", $request->product_id)->first();
                if (!empty($products)) {
                    Auth::user()->products()->updateExistingPivot($request->product_id, ['qty' => $products->pivot->qty + ($request->qty ? $request->qty : 1)]);
                    $pro =  Auth::user()->products;
                    return $this->respondWithSuccess(CartRresource::collection($pro));
                } else {
                    Auth::user()->products()->attach($request->product_id, ['qty' => $request->qty]);
                    $proNew =  Auth::user()->products;
                    return $this->respondWithSuccess(CartRresource::collection($proNew));
                }
            }
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = Auth::user();
            if (!empty($user)) {
                $products = $user->products()->where("products.id", $id)->first();
                if (!empty($products) && $products->pivot->qty > 1) {
                    $user->products()->updateExistingPivot($id, ['qty' => $products->pivot->qty - 1]);
                    //$pro = Auth::user()->products()->detach($order->products->pluck('id')->toArray());
                    $pro =  Auth::user()->products;
                    return $this->respondWithSuccess(CartRresource::collection($pro));
                } elseif ($products->pivot->qty == 1) {
                    $user->products()->detach($id);
                    $pro =  Auth::user()->products;
                    return $this->respondWithSuccess(CartRresource::collection($pro));
                }
            } elseif (!empty(Redis::get('cart'))) {
                $carts = json_decode(Redis::get('cart'));
                $newCart = [];
                foreach ($carts as $cart) {
                    if ($cart->product_id == $id && $cart->qty > 1) {
                        $cart->qty -= 1;
                        $newCart[] = $cart;
                    } elseif ($cart->product_id == $id && $cart->qty <= 1) {
                        foreach ($newCart as $c) {
                            unset($c);
                        }
                    } elseif ($cart->product_id !== $id) {
                        $newCart[] = $cart;
                    }
                }
                Redis::set('cart', json_encode($newCart));
                $cart = json_decode(Redis::get('cart'));
                return $cart;
            }
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function checkOut(Request $request)
    {
        try {
            $productInCart = json_decode(Redis::get('cart'));
            if (!empty($productInCart)) {
                foreach ($productInCart as $procart) {
                    $products = Auth::user()->products()->where("products.id", $procart->product_id)->first();
                    if (!empty($products)) {
                        Auth::user()->products()->updateExistingPivot($procart->product_id, ['qty' => $products->pivot->qty + ($procart->qty ? $procart->qty : 1)]);
                    } else {
                        Auth::user()->products()->attach($procart->product_id, ['qty' => ($procart->qty ? $procart->qty : 1)]);
                    }
                }
                Redis::flushAll();
                return  $this->respondWithSuccess(CartRresource::collection(Auth::user()->products));
            } elseif (count(Auth::user()->products)) {
                $coupon = Coupon::where('code', $request->code)->whereDate('start', '<=', Carbon::now()->toDateString())->whereDate('end', '>=', Carbon::now()->toDateString())->first();
                $procarts = Auth::user()->products;
                DB::beginTransaction();
                $order = new Order();
                $order->total = 0;
                $order->paid = 0;
                $order->note = $request->note ?? 'note';
                $order->coupon_id =  $coupon->id ??null;
                $order->driver_id = null;
                $order->save();
                foreach ($procarts as $procart) {
                    $product = Product::find($procart->pivot->product_id);
                    $order->products()->attach($product->id, ['qty' => $procart->pivot->qty, 'price' => $procart->price]);
                    $order->total += $product->price * $procart->pivot->qty;
                    $order->save();
                    $notifay = new Notification;
                    $notifay->notificationable_type = "App\Models\Store";
                    $notifay->notificationable_id = $product->store_id;
                    $notifay->titel = 'New Order';
                    $notifay->body = "Product Name"." "."="." ".$product->name." ".'price'." ".'='." ". $procart->price .'qty'." ".'='." ". $procart->qty;
                    $notifay->save();
                    // event(new DeleteAllCartEvent());
                }
                event(new NotificationOrderToStore($order,$product->store_id));
        // $options = array(
        //     'cluster' => 'eu',
        //     'useTLS' => true
        // );
        // $pusher = new \Pusher\Pusher(
        //     '33fb164cc6c0a6b54d94',
        //     'c47e61ab2b4aad6c60dc',
        //     '1340828',
        //     $options
        // );
        // $pusher->trigger('store_' . $product->store_id, 'New-order', ['relation' => $order->products]);

                DB::commit();
                return $this->respondCreated(new OrderRresource($order));
            } else {
                return $this->respondError("Don't have product in cart");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->respondError($th->getMessage().$th->getLine() . $th->getFile());
        }
    }

    // public function couponInOrder(Request $request)
    // {
    //     try {
    //         $coupon = Coupon::where('code', $request->code)->first();
    //         return dd($coupon);
    //         foreach ($coupon as $cou) {
    //             if ($cou->code == $request->code) {
    //                 $products = Auth::user()->products;
    //                 $total = 0;
    //                 foreach ($products as $pro) {
    //                     $total += $pro->pivot->qty * $pro->price;
    //                 }
    //                 if ($cou->type == 'LE') {
    //                     $total -= $cou->value;
    //                 } else {
    //                     $new = $total * $cou->value / 100;
    //                     $total -= $new;
    //                 }
    //                 return $total;
    //             }
    //         }
    //     } catch (\Throwable $th) {
    //         return $this->respondError($th->getMessage());
    //     }
    // }
}
