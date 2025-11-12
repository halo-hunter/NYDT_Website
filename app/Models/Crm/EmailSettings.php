<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    use HasFactory;

    public static function get_bcc_mail_addresses_with_dev_email(){
        if (EmailSettings::first()->bcc != '') {
            $bcc_array = explode(',', EmailSettings::first()->bcc);
            if (config('app.dev_email_address') != '') {
                array_push($bcc_array, config('app.dev_email_address'));
            }
        } else {
            $bcc_array = [];
            array_push($bcc_array, config('app.dev_email_address'));
        }
        return $bcc_array;
    }
}
