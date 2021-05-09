<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::insert([
            [
                'vendor_id'=>'1',
                'subcategory_id'=>'2',
                'title'=>'Chicken Meat',
                'slug'=>Str::slug('Chicken Meat'),
                'price'=>'450',
                'discount'=>'0',
                'quantity'=>'1',
                'unit'=>'Kg',
                'shipping'=>'Yes',
                'details'=>'Best Chicken in the market',
                'status'=>1,
                'featured'=>1,
                'bought_price'=>'400',
                'unit_info'=>'5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'vendor_id'=>'3',
                'subcategory_id'=>'1',
                'title'=>'Aalu',
                'slug'=>Str::slug('Aalu'),
                'price'=>'80',
                'discount'=>'0',
                'quantity'=>'1',
                'unit'=>'Kg',
                'shipping'=>'Yes',
                'details'=>'Best aalu in the market',
                'status'=>1,
                'featured'=>1,
                'bought_price'=>'50',
                'unit_info'=>'5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
