<?php

namespace Database\Seeders;

use App\Models\Crm\CompanyInfo;
use App\Models\Crm\EmailSettings;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyInfo::insert([
            [
                'company_name' => config('app.company_name'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
