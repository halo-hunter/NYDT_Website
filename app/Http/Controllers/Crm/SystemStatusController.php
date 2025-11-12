<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;

class SystemStatusController extends Controller
{
    public function twilio_messaging() {
        return view('crm.pages.system_status.twilio_messaging.show');
    }
}
