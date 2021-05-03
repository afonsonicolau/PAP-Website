<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('product_types')->insert([
                'type' => $faker->unique()->sentence(1)
            ]);
        }
        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'username' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'role_id' => '1',
                'created_at' => now()
            ]);
        }
    }
}
