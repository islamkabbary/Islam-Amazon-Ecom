<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->status = "panding";
        $order->total = 1000;
        $order->paid = 1;
        $order->note = "kjiukyj";
        $order->user_id = 1;
        $order->driver_id = 1;
        $order->save();

        $order = new Order();
        $order->status = "panding";
        $order->total = 1000;
        $order->paid = 1;
        $order->note = "kjiukyj";
        $order->user_id = 2;
        $order->driver_id = 2;
        $order->save();
    }
}
