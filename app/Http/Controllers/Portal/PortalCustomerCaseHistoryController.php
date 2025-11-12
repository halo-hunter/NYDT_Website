<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Models\Crm\Customers;
use Illuminate\Http\Request;

class PortalCustomerCaseHistoryController extends Controller
{
    public function show(Request $request) {
        $portal_auth_user_id = session()->get('portal_authorized_user_id');
        $client = Client::find($portal_auth_user_id);
        $client_cases = $client->cases()->get();

        $data = [
            'customer_cases' => $client_cases,
        ];
        return view('portal.pages.case_history.show', $data);
    }
}
