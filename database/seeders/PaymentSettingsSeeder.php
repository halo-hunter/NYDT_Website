<?php

namespace Database\Seeders;

use App\Models\Crm\EmailSettings;
use App\Models\Crm\PaymentSettings;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentSettings::insert([
            [
                'environment' => 'sandbox',
                'merchant_login_id' => '96QhKu5GMJ7r',
                'merchant_transaction_key' => '6q56SPQ6m9Uyq3v3',
                'merchant_email' => 'noreply@jlklawoffice.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
