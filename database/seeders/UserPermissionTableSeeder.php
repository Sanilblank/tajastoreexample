<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Seeder;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserPermission::insert([
            [
                'user_id' => 1,
                'permission_id' => 1,
            ],
            [
                'user_id' => 1,
                'permission_id' => 2,
            ],
            [
                'user_id' => 1,
                'permission_id' => 3,
            ],
            [
                'user_id' => 1,
                'permission_id' => 4,
            ],
            [
                'user_id' => 1,
                'permission_id' => 5,
            ],
            [
                'user_id' => 1,
                'permission_id' => 6,
            ],
            [
                'user_id' => 1,
                'permission_id' => 7,
            ],
            [
                'user_id' => 1,
                'permission_id' => 8,
            ],
            [
                'user_id' => 1,
                'permission_id' => 9,
            ],

        ]);
    }
}
