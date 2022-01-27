<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driver = new Driver();
        $driver->name = "driver";
        $driver->email = "driver@gmail.com";
        $driver->password = Hash::make(123456);
        $driver->store_id = 1;
        $driver->save();

        $driver = new Driver();
        $driver->name = "driver1";
        $driver->email = "driver1@gmail.com";
        $driver->password = Hash::make(123456);
        $driver->store_id = 1;
        $driver->save();
    }
}
