<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'user_level_id' => 1,
                'email' => 'zrabotest1@gmail.com',
                'password' => '$2y$10$lz0CtCPLd5Td02aTcsRyau952S/PTfKoiBMvsURr1sO6bkLM5z6NS', // 12345678
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
