<?php

namespace Database\Seeders;

use App\Models\Crm\EmailSettings;
use App\Models\Crm\Settings;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email_settings = [
            ''
        ];

        Settings::insert([
            [
                'name' => 'mail.jlklawoffice.com',
                'data' => '465',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
