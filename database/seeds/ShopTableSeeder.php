<?php

use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
            'shop 1',
            'shop 2',
            'shop 3',
        ];
        foreach ($shops as $key => $value) {
            DB::table('shops')->insert([
                'name' => $value,
                'status' => 0,
                'user_id' => 1,
                'category_id' => 1,
            ]);
        }
    }
}
