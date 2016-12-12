<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            'Suc khoe & sac dep',
            'Thoi trang',
            'Dien thoai & phu kien',
            'Thiet bi dien tu',
            'Me & be',
            'Thiet bi dien gia dung',
            'Nha cua & Doi song',
            'Giay dep',
            'Tui vi',
        ];

        for ($i = 0; $i < count($category); $i++) { 
            DB::table('categories')->insert([
                'name' => $category[$i],
            ]);
        }
    }
}
