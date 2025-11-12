<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    use HasFactory;

    public static function get_bcc_mail_addresses_with_dev_email(){
        $emailSettings = EmailSettings::first();

        $bcc_array = [];

        if ($emailSettings && $emailSettings->bcc != '') {
            $bcc_array = explode(',', $emailSettings->bcc);
        }

        if (config('app.dev_email_address') != '') {
            $bcc_array[] = config('app.dev_email_address');
        }

        return array_filter($bcc_array);
    }
}
