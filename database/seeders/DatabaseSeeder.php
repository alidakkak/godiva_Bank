<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'SuperAdmin',
//             'email' => 'superadmin@gmail.com',
             'type' => 'Super',
             'password' => '00000000'
         ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
//            'email' => 'admin@gmail.com',
            'serial_number' => '11111111',
            'type' => 'Admin',
            'password' => '00000000'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Cashier',
//            'email' => 'cashier@gmail.com',
            'serial_number' => '22222222',
            'type' => 'Cashier',
            'password' => '00000000'
        ]);
    }
}
