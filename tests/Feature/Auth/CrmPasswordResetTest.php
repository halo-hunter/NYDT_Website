<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Crm\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class CrmPasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_change_password_accepts_hashed_token_and_updates_password(): void
    {
        $user = User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'User',
            'user_level_id' => 1,
            'email' => 'user@example.com',
            'password' => Hash::make('OldPassword1!'),
        ]);

        $plain = Str::random(40);
        $hashed = hash('sha256', $plain);

        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => $hashed,
            'created_at' => now(),
        ]);

        $response = $this->post('/change-password/' . $plain, [
            'new_password' => 'NewPassword1!',
            'confirm_password' => 'NewPassword1!',
        ]);

        $response->assertRedirect(route('pages->login->show'));
        $this->assertTrue(Hash::check('NewPassword1!', $user->fresh()->password));
        $this->assertDatabaseMissing('password_reset_tokens', ['token' => $hashed]);
    }

    public function test_change_password_missing_token_is_graceful(): void
    {
        $response = $this->get('/change-password/bad-token');

        $response->assertStatus(200);
        $response->assertViewHas('token_not_found');
    }

    public function test_invalid_login_attempt_password_is_redacted(): void
    {
        // trigger invalid login attempt so logging occurs
        $this->post('/login', [
            'email' => 'unknown@example.com',
            'password' => 'SensitivePass!',
        ]);

        $this->assertDatabaseHas('invalid_login_attempts', [
            'filled_guest_email' => 'unknown@example.com',
            'filled_guest_password_redacted' => '[redacted]',
        ]);
    }
}
