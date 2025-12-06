<?php

namespace App\Console\Commands;

use App\Models\Crm\Client;
use Illuminate\Console\Command;

class EncryptClientPii extends Command
{
    protected $signature = 'clients:encrypt-pii {--chunk=100}';

    protected $description = 'Encrypt legacy plaintext PII fields for clients using FallbackEncrypted cast.';

    public function handle(): int
    {
        $chunk = (int) $this->option('chunk');
        $count = 0;

        Client::chunk($chunk, function ($clients) use (&$count) {
            /** @var Client $client */
            foreach ($clients as $client) {
                $client->save(); // triggers cast set on dirty attributes below
                $dirty = [];
                foreach (['a_number','social_security','phone','phone_secondary','address_country','address_state_code','address_city','address_zip_code','address_unit','address_address'] as $field) {
                    $dirty[$field] = $client->{$field};
                }
                $client->fill($dirty);
                $client->save();
                $count++;
            }
        });

        $this->info("Processed {$count} clients.");

        return self::SUCCESS;
    }
}
