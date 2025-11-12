<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortalDashboardController extends Controller
{
    public function show(Request $request) {
        return redirect()->route('portal->case_history->show');
        // return view('portal.pages.dashboard.show');
    }
}
