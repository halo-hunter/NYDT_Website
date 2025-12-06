<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Crypt;

class FallbackEncrypted implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            // Value likely stored in plaintext; return as-is to avoid fatal
            return $value;
        }
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        try {
            // Avoid double-encrypt if already decrypted
            Crypt::decryptString($value);
            // If decrypt succeeds, treat as already encrypted
            return $value;
        } catch (\Throwable $e) {
            return Crypt::encryptString($value);
        }
    }
}
