<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrederItems;
use App\Events\MyEventToEvent;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderRresource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $orders = Order::where('driver_id', Auth::id())->get();
            return $this->respondWithSuccess(OrderRresource::collection($orders));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {
            $procarts = Auth::user()->products;
            $total = 0;
            DB::beginTransaction();
            $order = new Order();
            $order->total = 0;
            $order->paid = 0;
            $order->note = $request->note;
            $order->save();
            foreach ($procarts as $procart) {
                $orderItem = new OrederItems();
                $orderItem->price = $procart->price;
                $orderItem->qty = $procart->qty;
                $orderItem->products_id = $procart->id;
                $orderItem->orders_id = $order->id;
                $orderItem->save();
                $total += $procart->price * $procart->pivot->qty;
                 
            }
            $order->total = $total;
            $order->save();
            DB::commit();
            // $pro = Auth::user()->products()->detach($order->products->pluck('id')->toArray());
            event(new MyEventToEvent());
            return $this->respondCreated(new OrderRresource($order));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // try {
        //     $procarts = Auth::user()->products;
        //     $total = 0;
        //     DB::beginTransaction();
        //     foreach ($procarts as $procart) {
        //         $total += $procart->price * $procart->pivot->qty;
        //         $orderItem = new OrederItems();
        //         $orderItem->price = $procart->price;
        //         $orderItem->qty = $procart->qty;
        //         $orderItem->products_id = $procart->id;
        //     }
        //     $order = new Order();
        //     $order->total = $total;
        //     $order->paid = 0;
        //     $order->note = $request->note;
        //     $order->save();
        //     $orderItem->orders_id = $order->id;
        //     $orderItem->save();
        //     DB::commit();
        //     return $this->respondCreated(new OrderRresource($order));
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return $this->respondError($th->getMessage());
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
