<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::insert([
            [
                'name'=>'Mr.Admin',
                'email'=>'admin@admin.com',
                'role_id' => 1,
                'password'=>bcrypt('password'),
                'is_verified'=>1,
                'created_at'      => date("Y-m-d H:i:s"),
                'updated_at'      => date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'Mr.Editor',
                'email'=>'editor@editor.com',
                'role_id' => 2,
                'password'=>bcrypt('password'),
                'created_at'      => date("Y-m-d H:i:s"),
                'updated_at'      => date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'Mr.Manager',
                'email'=>'manager@manager.com',
                'role_id' => 3,
                'password'=>bcrypt('password'),
                'created_at'      => date("Y-m-d H:i:s"),
                'updated_at'      => date("Y-m-d H:i:s"),
            ],
            [
                'name'=>'Mr.Vendor',
                'email'=>'vendor@vendor.com',
                'role_id' => 4,
                'password'=>bcrypt('password'),
                'created_at'      => date("Y-m-d H:i:s"),
                'updated_at'      => date("Y-m-d H:i:s"),
            ]


        ]);
    }
}
