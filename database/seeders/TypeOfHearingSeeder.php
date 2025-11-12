<?php

namespace Database\Seeders;

use App\Models\Crm\TypeOfHearing;
use App\Models\Crm\UserLevel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfHearingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfHearing::insert([
            [
                'id' => 1,
                'hearing_type' => 'master',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'hearing_type' => 'individual',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
