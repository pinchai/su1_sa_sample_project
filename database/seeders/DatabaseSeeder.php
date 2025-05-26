<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        DB::table('branch')->insertOrIgnore([
            [
                'name' => 'Dino Cafe',
                'phone' => '099 774 967',
                'location' => 'Phnom Penh',
                'description' => null,
            ],
        ]);


        DB::table('users')->insertOrIgnore([
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => '12345678',
                'branch_id' => 1,
            ],
        ]);

        DB::table('customer')->insertOrIgnore([
            [
                'name' => 'general',
                'description' => null,
            ],
        ]);

        DB::table('category')->insertOrIgnore([
            [
                'name' => 'Drink',
                'description' => null,
            ],
        ]);

        DB::table('product')->insertOrIgnore([
            [
                'name' => 'Coca Cola',
                'cost' => 0.25,
                'price' => 0.5,
                'category_id' => 1,
            ],
        ]);
    }
}
