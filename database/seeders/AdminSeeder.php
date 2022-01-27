<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Admin();
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make(123456);
        $user->save();
    }
}
