<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->id = 1;
        $product->name = "TV";
        $product->price = 100;
        $product->description = Str::random(50);
        $product->qty = 5;
        $product->category_id = 1;
        $product->store_id = 1;
        $product->save();

        $product = new Product();
        $product->id = 2;
        $product->name = "TEL";
        $product->price = 150;
        $product->description = Str::random(50);
        $product->qty = 10;
        $product->category_id = 2;
        $product->store_id = 2;
        $product->save();

        $product = new Product();
        $product->id = 3;
        $product->name = "LAP";
        $product->price = 150;
        $product->description = Str::random(50);
        $product->qty = 15;
        $product->category_id = 3;
        $product->store_id = 3;
        $product->save();
    }
}
