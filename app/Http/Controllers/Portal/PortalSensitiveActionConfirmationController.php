<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PortalSensitiveActionConfirmationController extends Controller
{
    public function show(Request $request)
    {
        return view('portal.pages.confirm_action.show');
    }

    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('portal')->user();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ]);
        }

        session()->put('portal_recent_confirmation', now());

        $intended = session()->pull('portal_confirm_intended', route('portal->dashboard->show'));

        return redirect()->to($intended);
    }
}
