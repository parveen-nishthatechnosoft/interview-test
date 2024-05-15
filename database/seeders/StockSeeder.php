<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StockModel::insert([
            'name' => 'Stock1',
             'available_stock' => 10,
             'created_at' => date("Y-m-d H:i:s")
          ]);
          \App\Models\StockModel::insert([
             'name' => 'Stock2',
             'available_stock' => 5,
              'created_at' => date("Y-m-d H:i:s")
           ]);
    }
}
