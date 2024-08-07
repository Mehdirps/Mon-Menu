<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('category_product')->insert([
            'id' => 1,
            'product_id' => 3,
            'category_id' => 12
        ]);

        DB::table('category_product')->insert([
            'id' => 2,
            'product_id' => 3,
            'category_id' => 5
        ]);

        DB::table('category_product')->insert([
            'id' => 3,
            'product_id' => 1,
            'category_id' => 2
        ]);

        DB::table('category_product')->insert([
            'id' => 4,
            'product_id' => 2,
            'category_id' => 3
        ]);

        DB::table('category_product')->insert([
            'id' => 5,
            'product_id' => 4,
            'category_id' => 3
        ]);
    }
}
