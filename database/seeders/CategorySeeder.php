<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->id = 1;
        $category->name = "Elc";
        $category->save();

        $category = new Category();
        $category->id = 2;
        $category->name = "Sport";
        $category->parent_id = 1;
        $category->save();

        $category = new Category();
        $category->id = 3;
        $category->name = "Home";
        $category->parent_id = 2;
        $category->save();
    }
}
