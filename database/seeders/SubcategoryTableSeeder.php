<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Subcategory::insert([
            [
                'category_id'=>'1',
                'title'=>'Green Vegetables',
                'slug'=>Str::slug('Green Vegetables'),
                'image_name' => 'noimage.png',
                'status'=>1,
                'featured'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id'=>'2',
                'title'=>'Chicken',
                'slug'=>Str::slug('Chicken'),
                'image_name' => 'noimage.png',
                'status'=>1,
                'featured'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id'=>'2',
                'title'=>'Buff',
                'slug'=>Str::slug('Buff'),
                'image_name' => 'noimage.png',
                'status'=>1,
                'featured'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id'=>'2',
                'title'=>'Pork',
                'slug'=>Str::slug('Pork'),
                'image_name' => 'noimage.png',
                'status'=>1,
                'featured'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id'=>'3',
                'title'=>'Paneer',
                'slug'=>Str::slug('Paneer'),
                'image_name' => 'noimage.png',
                'status'=>1,
                'featured'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'category_id'=>'3',
                'title'=>'Milk',
                'slug'=>Str::slug('Milk'),
                'image_name' => 'noimage.png',
                'status'=>1,
                'featured'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
