<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Ma première catégorie',
            'slug' => 'ma-premiere-categorie',
            'childs' => json_encode([]),
            'is_main' => true,
            'active' => true,
        ]);

        return;
        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Hamburgers Poulet',
            'slug' => 'hamburgers-poulet',
            'childs' => null,
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'name' => 'Hamburgers Boeuf',
            'slug' => 'hamburgers-boeuf',
            'childs' => null,
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'name' => 'Pizzas',
            'slug' => 'pizzas',
            'childs' => json_encode([5,6]),
            'is_main' => true,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 5,
            'name' => 'Base tomate',
            'slug' => 'base-tomate',
            'childs' => null,
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 6,
            'name' => 'Base crème fraiche',
            'slug' => 'base-creme-fraiche',
            'childs' => null,
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 7,
            'name' => 'Boissons',
            'slug' => 'boissons',
            'childs' => json_encode([9,8]),
            'is_main' => true,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 8,
            'name' => 'Boissons chaudes',
            'slug' => 'boissons-chaudes',
            'childs' => json_encode([10,11]),
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 9,
            'name' => 'Boissons froides',
            'slug' => 'boissons-froides',
            'childs' => null,
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 10,
            'name' => 'Café',
            'slug' => 'cafes',
            'childs' => null,
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 11,
            'name' => 'Chocolat',
            'slug' => 'chocolat',
            'childs' => null,
            'is_main' => false,
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'id' => 12,
            'name' => 'Formule Midi',
            'slug' => 'formule-midi',
            'childs' => null,
            'is_main' => true,
            'active' => true,
        ]);
    }
}
