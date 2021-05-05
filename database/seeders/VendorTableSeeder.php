<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Vendor::insert([
            [
                'name'=>'Ganapati Meat Shop',
                'address'=>'Kumaripati, Lalitpur',
                'district'=>'Lalitpur',
                'email'=>'samratshrestha846@gmail.com',
                'phone'=>'9865322334',
                'role_id'=>'4'
            ],
            [
                'name'=>'Laxmi Dairy',
                'address'=>'Kalimati, Kathmandu',
                'district'=>'Kathmandu',
                'email'=>'blancmanandhar@gmail.com',
                'phone'=>'9865322334',
                'role_id'=>'4'
            ],
            [
                'name'=>'Rame Vegetable Shop',
                'address'=>'Ravibhawan, Kathmandu',
                'district'=>'Kathmandu',
                'email'=>'rame@gmail.com',
                'phone'=>'9865322334',
                'role_id'=>'4'
            ],
        ]);
    }
}
