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

        // Users
        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'username' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'role_id' => '1',
                'created_at' => now()
            ]);
        }

        // Product Types
        foreach (range(1, 100) as $index) {
            DB::table('product_types')->insert([
                'reference' => $faker->unique()->numberBetween($min = 5, $max = 500),
                'type' => $faker->unique()->word,
            ]);
        }
        
        // Collections
        foreach (range(1, 100) as $index) {
            DB::table('collections')->insert([
                'collection' => $faker->unique()->name,
                'colors' => $faker->randomElement($array = array ('a','b','c')), // needs to change
                'created_at' => now()
            ]);
        }

        // Products
        foreach (range(1, 100) as $index) {
            DB::table('products')->insert([
                'collection_id' => $faker->numberBetween($min = 1, $max = 50),
                'standout' => $faker->numberBetween($min = 0, $max = 1),
                'color' => $faker->randomElement($array = array ('a','b','c')),
                'type_id' => $faker->numberBetween($min = 1, $max = 50),
                'size' => '123x123',
                'price' => $faker->numberBetween($min = 10, $max = 50),
                'iva' => 23,
                'weight' => $faker->numberBetween($min = 1, $max = 50),
                'stock' => $faker->numberBetween($min = 1, $max = 50),
                'thumbnail' => $faker->randomElement($array = array ('thumbnail_34_7_asdsdsad.jpg','thumbnail_3123_1_sadasd.jpg','thumbnail_34_1_Amen.jpg')),
                'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                'created_at' => now()
            ]);
        }
    }
}
