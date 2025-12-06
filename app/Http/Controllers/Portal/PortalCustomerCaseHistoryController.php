<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Models\Crm\Customers;
use Illuminate\Http\Request;

class PortalCustomerCaseHistoryController extends Controller
{
    public function show(Request $request) {
        $client = \Illuminate\Support\Facades\Auth::guard('portal')->user();

        if (! $client) {
            return redirect()->route('portal->login->show');
        }

        $client_cases = $client->cases()->get();

        $data = [
            'customer_cases' => $client_cases,
        ];
        return view('portal.pages.case_history.show', $data);
    }
}
