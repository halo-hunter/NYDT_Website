<?php

namespace Tests\Feature\Portal;

use App\Mail\Portal\CustomerPasswordHasBeenSetSuccessfully;
use App\Models\ClientInvitationToken;
use App\Models\Crm\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PortalSetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_set_password_with_valid_token(): void
    {
        Mail::fake();

        $client = Client::factory()->create([
            'password' => null,
            'password_status' => 'pending',
            'email' => 'client@example.com',
        ]);

        $invitation = ClientInvitationToken::issueForClient($client->id, 30);

        $this->get(route('portal->set-password->show', ['token' => $invitation->plain_text]))
            ->assertOk();

        $response = $this->post(route('portal->set-password->show', ['token' => $invitation->plain_text]), [
            'password' => 'SecurePass123!',
            'confirm_password' => 'SecurePass123!',
        ]);

        $response->assertRedirect(route('portal->login->show'));

        $client->refresh();

        $this->assertTrue(Hash::check('SecurePass123!', $client->password));
        $this->assertEquals('set', $client->password_status);
        $this->assertEquals(0, ClientInvitationToken::where('client_id', $client->id)->whereNull('consumed_at')->count());

        Mail::assertSent(CustomerPasswordHasBeenSetSuccessfully::class);
    }

    public function test_invalid_or_consumed_token_returns_not_found(): void
    {
        $this->get(route('portal->set-password->show', ['token' => 'invalid-token']))
            ->assertStatus(404);

        $client = Client::factory()->create([
            'password' => null,
            'password_status' => 'pending',
            'email' => 'client2@example.com',
        ]);

        $invitation = ClientInvitationToken::issueForClient($client->id, 30);
        $invitation->markConsumed();

        $this->get(route('portal->set-password->show', ['token' => $invitation->plain_text]))
            ->assertStatus(404);
    }
}
