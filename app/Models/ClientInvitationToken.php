<?php

namespace App\Models;

use App\Models\Crm\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClientInvitationToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'token',
        'expires_at',
        'consumed_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'consumed_at' => 'datetime',
    ];

    protected $hidden = [
        'token',
    ];

    public ?string $plain_text = null;

    public static function issueForClient(int $clientId, ?int $minutes = 60): self
    {
        $plain = Str::random(64);

        $invitation = static::create([
            'client_id' => $clientId,
            'token' => hash('sha256', $plain),
            'expires_at' => now()->addMinutes($minutes ?? 60),
        ]);

        $invitation->plain_text = $plain;

        return $invitation;
    }

    public static function findValidToken(string $token): ?self
    {
        return static::with('client')
            ->where('token', hash('sha256', $token))
            ->whereNull('consumed_at')
            ->where('expires_at', '>', now())
            ->first();
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function isValid(): bool
    {
        return is_null($this->consumed_at) && $this->expires_at->isFuture();
    }

    public function markConsumed(): void
    {
        $this->update(['consumed_at' => now()]);
    }
}
