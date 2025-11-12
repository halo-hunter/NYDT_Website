<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use Illuminate\Http\Request;

class PortalCaseController extends Controller
{
    public function show($case_id) {
        $portal_auth_user_id = session()->get('portal_authorized_user_id');
        $client = Client::find($portal_auth_user_id);
        $client_cases = $client->cases()->get();

        $data = [
            'case_id' => $case_id,
            'customer_cases' => $client_cases
        ];
        return view('portal.pages.case.show', $data);
    }
}
