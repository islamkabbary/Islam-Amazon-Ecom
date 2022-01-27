<?php

namespace Database\Seeders;

use App\Models\ProductsHasOffers;
use Illuminate\Database\Seeder;

class ProductsHasOffersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new ProductsHasOffers();
        $product->offer_id = 1;
        $product->product_id = 1;
        $product->save();

        $product = new ProductsHasOffers();
        $product->offer_id = 2;
        $product->product_id = 2;
        $product->save();

        $product = new ProductsHasOffers();
        $product->offer_id = 3;
        $product->product_id = 3;
        $product->save();
    }
}
