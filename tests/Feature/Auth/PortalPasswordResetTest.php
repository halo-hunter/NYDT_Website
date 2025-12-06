<?php

namespace Tests\Feature\Auth;

use App\Models\Crm\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class PortalPasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_portal_change_password_accepts_hashed_token(): void
    {
        $client = Client::factory()->create([
            'email' => 'client@example.com',
            'password' => Hash::make('OldPortalPass1!'),
        ]);

        $plain = Str::random(40);
        $hashed = hash('sha256', $plain);

        DB::table('password_reset_tokens')->insert([
            'email' => $client->email,
            'token' => $hashed,
            'created_at' => now(),
        ]);

        $response = $this->post('http://portal.nydt.law/portal/change-password/' . $plain, [
            'new_password' => 'NewPortalPass1!',
            'confirm_password' => 'NewPortalPass1!',
        ]);

        $response->assertRedirect(route('portal->login->show'));
        $this->assertTrue(Hash::check('NewPortalPass1!', $client->fresh()->password));
        $this->assertDatabaseMissing('password_reset_tokens', ['token' => $hashed]);
    }

    public function test_portal_change_password_missing_token_is_graceful(): void
    {
        $response = $this->get('http://portal.nydt.law/portal/change-password/bad-token');

        $response->assertStatus(200);
        $response->assertViewHas('token_not_found');
    }
}
