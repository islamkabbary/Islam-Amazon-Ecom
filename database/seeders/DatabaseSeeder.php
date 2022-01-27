<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CartSeeder;
use Database\Seeders\UserSeeder;
use App\Models\ProductsHasOffers;
use Database\Seeders\AdminSeeder;
use Database\Seeders\OfferSeeder;
use Database\Seeders\StoreSeeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\DriverSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductsHasOffersSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            StoreSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OfferSeeder::class,
            CouponSeeder::class,
            ProductsHasOffersSeeder::class,
            DriverSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
