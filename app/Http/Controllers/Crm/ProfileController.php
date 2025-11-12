<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function settings(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.profile.settings.show');
        } elseif ($request->isMethod('post')) {
            if ($request->new_password == null && $request->confirm_password == null) {
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                User::where('id', Auth::id())->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'new_password' => 'required|min:8',
                    'confirm_password' => 'required|same:new_password',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                User::where('id', Auth::id())->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'password' => Hash::make($request->new_password),
                ]);
            }
            return back()->withErrors([
                "user_profile_updated_successfully" => "profile updated successfully"
            ]);
        }
    }
}
