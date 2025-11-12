<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReminderSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $records = [
            [
                'key' => 'scheduled_biometric_appointment',
                'name' => 'Scheduled Biometric Appointment',
                'days' => 2,
            ],
            [
                'key' => 'interview_date',
                'name' => 'Interview Date',
                'days' => 2,
            ]
        ];

        foreach ($records as $record) {

            $exists = DB::table('reminder_settings')
                ->where('key', $record['key'])
                ->exists();

            if (!$exists) {
                DB::table('reminder_settings')->insert([
                    'key' => $record['key'],
                    'name' => $record['name'],
                    'days' => $record['days'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

    }
}
