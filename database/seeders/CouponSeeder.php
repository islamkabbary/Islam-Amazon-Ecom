<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker\Factory::create();
        $values = [15, 20, 5];
        $types = ['LE', 'LE', '%'];

        foreach ($values as $value) {
            foreach ($types as $type) {
                Coupon::create([
                    'start' => Carbon::now(),
                    'end' => Carbon::now()->addDay(),
                    'value' => $value,
                    'type' => $type,
                    'code' => random_int(65859473, 95321678),
                ]);
            }
        }
    }
}
