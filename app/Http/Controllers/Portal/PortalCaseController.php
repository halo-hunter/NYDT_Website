<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Support\PortalCaseResolver;
use Illuminate\Http\Request;

class PortalCaseController extends Controller
{
    public function show($case_id) {
        // Ensure the requested case belongs to the current portal client
        $client = PortalCaseResolver::currentClient();
        $case = PortalCaseResolver::caseForCurrentClientOrAbort((int) $case_id);
        $client_cases = $client->cases()->get();

        $data = [
            'case_id' => $case->id,
            'customer_cases' => $client_cases
        ];
        return view('portal.pages.case.show', $data);
    }
}
