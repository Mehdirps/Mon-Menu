<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            'name'          => 'Chez Vinz',
            'cp'            => '91310',
            'city'          => 'Linas',
            'ref_client'    => '123456',
            'active'        => 1,
            'admin_id'      => 1
        ]);

         DB::table('restaurants')->insert([
            'name'          => 'Chez Cyril',
            'cp'            => '05130',
            'city'          => 'Tallard',
            'admin_id'      => 2
        ]);


    }
}
