<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id = 1;
        $user->name = "User";
        $user->email = "user@gmail.com";
        $user->password = Hash::make(123456);
        $user->save();

        $user = new User();
        $user->id = 2;
        $user->name = "User";
        $user->email = "user1@gmail.com";
        $user->password = Hash::make(123456);
        $user->save();

        $user = new User();
        $user->id = 3;
        $user->name = "User";
        $user->email = "user2@gmail.com";
        $user->password = Hash::make(123456);
        $user->save();
    }
}
