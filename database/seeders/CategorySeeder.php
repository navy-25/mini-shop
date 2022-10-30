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
        Category::create(['name' => 'Sembako', 'status' => '1', 'thumbnail' => '',]);
        Category::create(['name' => 'Sayuran', 'status' => '1', 'thumbnail' => '',]);
        Category::create(['name' => 'Buah', 'status' => '0', 'thumbnail' => '',]);
        Category::create(['name' => 'Fashion', 'status' => '1', 'thumbnail' => '',]);
    }
}
