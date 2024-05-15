<?php

namespace Database\Seeders;

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
        \App\Models\ProductModel::insert([
            'name' => 'Product 1',
             'category_id' => 1,
             'stock_id' => 1,
             'image' => 'default.jpg',
             'price' => 50,
             'slug' => 'product-1',
             'status' => 'active',
             'created_at' => date("Y-m-d H:i:s")
          ]);

          \App\Models\ProductModel::insert([
            'name' => 'Product 2',
             'category_id' => 2,
             'stock_id' => 2,
             'image' => 'default.jpg',
             'price' => 100,
             'slug' => 'product-2',
             'status' => 'active',
             'created_at' => date("Y-m-d H:i:s")
          ]);
    }
}
