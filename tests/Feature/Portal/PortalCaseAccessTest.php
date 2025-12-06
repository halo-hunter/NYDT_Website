<?php

namespace Tests\Feature\Portal;

use App\Models\Crm\CaseModel;
use App\Models\Crm\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalCaseAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_portal_client_can_view_only_their_case(): void
    {
        $client = Client::factory()->create();
        $case = CaseModel::query()->forceCreate([
            'contract_number' => 'CN-001',
        ]);
        $client->cases()->attach($case->id);

        $response = $this->actingAs($client, 'portal')
            ->get('http://portal.nydt.law/portal/case/' . $case->id);

        $response->assertOk();
        $response->assertViewHas('case_id', $case->id);
    }

    public function test_portal_client_cannot_view_foreign_case(): void
    {
        $client = Client::factory()->create();
        $foreignClient = Client::factory()->create();

        $foreignCase = CaseModel::query()->forceCreate([
            'contract_number' => 'CN-FOREIGN',
        ]);
        $foreignClient->cases()->attach($foreignCase->id);

        $response = $this->actingAs($client, 'portal')
            ->get('http://portal.nydt.law/portal/case/' . $foreignCase->id);

        $response->assertStatus(404);
    }

    public function test_portal_client_cannot_upload_to_foreign_case(): void
    {
        $client = Client::factory()->create();
        $foreignClient = Client::factory()->create();

        $foreignCase = CaseModel::query()->forceCreate([
            'contract_number' => 'CN-UPLOAD-BLOCKED',
        ]);
        $foreignClient->cases()->attach($foreignCase->id);

        $response = $this->actingAs($client, 'portal')
            ->withSession(['portal_recent_confirmation' => now()])
            ->post('http://portal.nydt.law/portal/upload-documents/' . $foreignCase->id, []);

        $response->assertStatus(404);
    }
}
