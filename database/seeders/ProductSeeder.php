<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'Mac Ckicken',
            "content" => 'Lorem ipsum',
            "price" => 7.50 ,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Big Mac',
            "content" => 'Lorem ipsum',
            "price" => 8.50 ,
            'active' => true,
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Pizza Campione',
            "content" => 'Lorem ipsum',
            "price" => 9.00 ,
            'active' => true,
        ]);

         DB::table('products')->insert([
            'id' => 4,
            'name' => 'Cheeseburger',
            "content" => 'Lorem ipsum',
            "price" => 7.00 ,
            'active' => true,
        ]);
    }
}
