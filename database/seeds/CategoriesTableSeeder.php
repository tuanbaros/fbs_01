<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'image' => 'images/cate1.1.png',
                'sort' => 1,
            ]);
        }

        $subCategory = [
            'Cham soc da',
            'Son & Cham soc moi',
            'Tran diem da',
            'Nuoc hoa',
            'Tam & cham soc co the',
            'Cham soc toc',
            'Trang diem mat',
            'Dung cu lam dep',
            'Vitamin & thuc pham chuc nang',
        ];

        for ($i = 0; $i < count($category); $i++) {
            for ($j = 0; $j < count($subCategory); $j++) {
                DB::table('categories')->insert([
                    'name' => $subCategory[$j],
                    'image' => 'images/cate1.1.png',
                    'sort' => 1,
                    'parent_id' => $i + 1,
                ]);
            } 
        }
    }
}
