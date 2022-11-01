<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Product::create([
        //     'name'          => 'Beras level 1 (2kg)',
        //     'quantity'      => '50',
        //     'category_id'   => '1',
        //     'price'         => '60000',
        //     'status'        => '1',
        //     'thumbnail'      => '',
        // ]);
        // Product::create([
        //     'name'          => 'Bimoli (800ml)',
        //     'quantity'      => '10',
        //     'category_id'   => '1',
        //     'price'         => '60000',
        //     'status'        => '1',
        //     'thumbnail'      => '',
        // ]);
        foreach (range(1, 1000) as $key => $value) {
            Product::create([
                'name'          => 'Barang ' . $key,
                'quantity'      => '50',
                'category_id'   => rand(1, 4),
                'price'         => '60000',
                'status'        => '1',
                'thumbnail'      => '',
            ]);
        }
    }
}
