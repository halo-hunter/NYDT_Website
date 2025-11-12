<?php

namespace Database\Seeders;

use App\Models\Crm\EmailSettings;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailSettings::insert([
            [
                'host' => 'mail.jlklawoffice.com',
                'port' => '465',
                'encryption' => 'ssl',
                'username' => 'noreply@jlklawoffice.com',
                'password' => 'UMtRY#,tYRx#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
