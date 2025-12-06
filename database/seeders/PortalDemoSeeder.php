<?php

namespace Database\Seeders;

use App\Models\Crm\CaseModel;
use App\Models\Crm\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortalDemoSeeder extends Seeder
{
    /**
     * Seed a demo client + case for portal POV testing.
     */
    public function run(): void
    {
        $client = Client::firstOrNew(['email' => 'portal.demo@example.com']);

        if (! $client->exists) {
            $client->firstname = 'Portal';
            $client->lastname = 'Demo';
            $client->phone = '5551234567';
            $client->password = Hash::make('C');
            $client->save();
        }

        $case = CaseModel::firstOrNew(['contract_number' => 'PORTAL-CASE-1001']);

        if (! $case->exists) {
            $case->case_type = 'Immigration';
            $case->due_date = json_encode([]);
            $case->save();
        }

        $case->client()->syncWithoutDetaching([$client->id]);
    }
}
