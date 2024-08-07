<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         \App\Models\User::factory()->create([
             'name' => 'Vinz',
             'email' => 'vinz.neo@gmail.com',
             'restaurant_id' => 1,
             'role' => 0,
             'password' => Hash::make('1234')
         ]);

          \App\Models\User::factory()->create([
             'name' => 'Cyril',
             'email' => 'cliondor@gmail.com',
             'restaurant_id' => 2,
             'role' => 0,
             'password' => Hash::make('1234')
         ]);

        $this->call([
            RestaurantSeeder::class,
            CategorySeeder::class,
            // ProductSeeder::class,
            // CategoryProductSeeder::class
        ]);

    }

    

}
