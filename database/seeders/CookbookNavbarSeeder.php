<?php

namespace Database\Seeders;

use App\Models\CookbookNavbar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CookbookNavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CookbookNavbar::insert([
            [
                'navbar_item'=>'Courses',
                'icon'=>'icon.png',
                'status'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'navbar_item'=>'Indian Flavors',
                'icon'=>'icon.png',
                'status'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'navbar_item'=>'World Flavors',
                'icon'=>'icon.png',
                'status'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'navbar_item'=>'Kids & Nutrition',
                'icon'=>'icon.png',
                'status'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'navbar_item'=>'Bakery Zone',
                'icon'=>Storage::disk('uploads')->url('icon.png'),
                'status'=>1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
