<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserLevelSeeder::class,
            UserSeeder::class,
            EmailSettingsSeeder::class,
            PaymentSettingsSeeder::class,
            StatesSeeder::class,
            CompanyInfoSeeder::class,
            TypeOfHearingSeeder::class,
            MaritalStatusSeeder::class,
            CountrySeeder::class,
            CaseSubTypeSeeder::class,
            ReminderSettingsTableSeeder::class,
        ]);
    }
}
