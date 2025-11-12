<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaseSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('case_sub_types')->delete();

        $caseSubTypes = [
            'removal proceedings',
            'family reunification',
            'employment based',
            'vawa',
            'daca',
            'special juvenile',
            'cancellation of removal',
            'mandamus'
        ];

        foreach ($caseSubTypes as $type) {
            DB::table('case_sub_types')->insert([
                'name' => $type
            ]);
        }

    }
}
