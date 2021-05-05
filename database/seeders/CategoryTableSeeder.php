<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::insert([
            [
                'title'=>'Vegetables',
                'slug'=> Str::slug('Vegetables'),
                'status' =>1,
                'featured' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'=>'Non-Veg',
                'slug'=> Str::slug('Non-Veg'),
                'status' =>1,
                'featured' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'=>'Dairy',
                'slug'=> Str::slug('Dairy'),
                'status' =>1,
                'featured' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
