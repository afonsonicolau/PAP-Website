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
                'colors' => '["' . $faker->randomElement($array = array('Vermelho','Azul','Castanho')) . '"]', // needs to change
                'created_at' => now()
            ]);
        }

        // Products
        foreach (range(1, 100) as $index) {
            DB::table('products')->insert([
                'collection_id' => $faker->numberBetween($min = 1, $max = 50),
                'standout' => $faker->numberBetween($min = 0, $max = 1),
                'outlet' => $faker->numberBetween($min = 0, $max = 1),
                'color' => '["' . $faker->randomElement($array = array('Vermelho','Azul','Castanho')) . '"]',
                'type_id' => $faker->numberBetween($min = 1, $max = 50),
                'size' => '123x123',
                'price' => $faker->numberBetween($min = 10, $max = 50),
                'iva' => 23,
                'weight' => $faker->numberBetween($min = 1, $max = 50),
                'stock' => $faker->numberBetween($min = 1, $max = 50),
                'thumbnail' => $faker->randomElement($array = array('produto_1_459_omnis_Lisette Powlowski_2021-06-08_21-16-06.jpeg', 'produto_2_459_omnis_Lisette Powlowski_2021-06-08_21-16-06.jpeg', 'produto_3_459_omnis_Lisette Powlowski_2021-06-08_21-16-06.jpeg', 'produto_4_459_omnis_Lisette Powlowski_2021-06-08_21-16-06.jpeg', 'produto_5_459_omnis_Lisette Powlowski_2021-06-08_21-16-06.jpeg', 'produto_6_459_omnis_Lisette Powlowski_2021-06-08_21-16-06.jpeg', 'thumbnail_7_Ex enim._Verão.jpg', 'thumbnail_34_1_Amen.jpg', 'thumbnail_34_3_asdsada.jpg', 'thumbnail_34_4_Azul.jpg', 'produto_7_459_omnis_Lisette Powlowski_2021-06-08_21-16-06.jpeg')),
                'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                'created_at' => now()
            ]);
        }

        // Company Details
        DB::table('company_details')->insert([
            'atm_reference' => $faker->numberBetween($min = 10000, $max = 99999),
            'paypal_reference' => $faker->numberBetween($min = 10000, $max = 99999),
            'debitcard_reference' => $faker->numberBetween($min = 10000, $max = 99999),
            'iva' => 23,
            'created_at' => now()
        ]);
    }
}
