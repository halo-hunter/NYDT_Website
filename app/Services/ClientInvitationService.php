<?php

namespace App\Services;

use App\Mail\Crm\SendSetPasswordUrlToCustomer;
use App\Models\ClientInvitationToken;
use App\Models\Crm\Client;
use App\Models\Crm\EmailSettings;
use Illuminate\Support\Facades\Mail;

class ClientInvitationService
{
    public static function send(Client $client, ?int $ttlMinutes = null): void
    {
        if (empty($client->email)) {
            return;
        }

        // remove existing pending tokens for this client to prevent reuse
        ClientInvitationToken::where('client_id', $client->id)
            ->whereNull('consumed_at')
            ->delete();

        $invitation = ClientInvitationToken::issueForClient(
            $client->id,
            $ttlMinutes ?? config('app.client_invitation_ttl', 60)
        );

        $mailData = [
            'client_id' => $client->id,
            'token' => $invitation->plain_text,
            'expires_at' => $invitation->expires_at,
        ];

        Mail::to($client->email)
            ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
            ->send(new SendSetPasswordUrlToCustomer($mailData));
    }
}
