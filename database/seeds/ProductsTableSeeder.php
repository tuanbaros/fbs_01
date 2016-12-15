<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) { 
            DB::table('products')->insert([
                'name' => $faker->text(30),
                'code' => '123',
                'price' => 100000,
                'quantity' => $faker->numberBetween(1, 100),
                'discount' => $faker->numberBetween(1, 50),
                'point_rate' => $faker->numberBetween(1, 5),
                'number_rate' => $faker->numberBetween(1, 10),
                'description' => $faker->text(200),
                'status' => 1,
                'category_id' => $i + 1,
                'shop_id' => 1,
            ]);
        }
    }
}
