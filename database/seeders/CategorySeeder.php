<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         \App\Models\CategoryModel::insert([
           'name' => 'Fashion',
            'slug' => 'fashion',
            'status' => 'active',
            'created_at' => date("Y-m-d H:i:s")
         ]);
         \App\Models\CategoryModel::insert([
            'name' => 'Sports',
             'slug' => 'sports',
             'status' => 'active',
             'created_at' => date("Y-m-d H:i:s")
          ]);
    }
}
