<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'name' => 'shop',
            'status' => 1,
            'user_id' => 1,
            'category_id' => 1,
            'address' => 'VN',
            'description' => 'la mot cua hang',
        ]);
    }
}
