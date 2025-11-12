<?php

namespace Database\Seeders;

use App\Models\Crm\UserLevel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserLevel::insert([
            [
                'user_level_id' => 1,
                'user_level_name' => 'administrator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_level_id' => 2,
                'user_level_name' => 'manager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_level_id' => 3,
                'user_level_name' => 'sales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
