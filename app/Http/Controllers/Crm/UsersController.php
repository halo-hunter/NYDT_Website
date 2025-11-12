<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function show(Request $request) {
        return view('crm.pages.users.show');
    }

    public function insert(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.users.insert');
        } elseif ($request->isMethod('post')) {
            $request->flash();
            $validator = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:users,email',
                'user_level' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            User::insert([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'user_level_id' => $request->user_level,
                'password' => Hash::make($request->new_password),
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('users->show')->withErrors([
                "user_profile_created_deleted_successfully" => "user profile created successfully"
            ]);
        }
    }

    public function update(Request $request, $id = false) {
        if (User::where('id', $id)->exists()) {
            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id
                ];
                return view('crm.pages.users.update', $data);
            } elseif ($request->isMethod('post')) {
                if ($request->new_password == null && $request->confirm_password == null) {
                    $validator = Validator::make($request->all(), [
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'user_level' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return back()->withErrors($validator)
                            ->withInput();
                    }
                    User::where('id', $id)->update([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'user_level_id' => $request->user_level,
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'user_level' => 'required',
                        'new_password' => 'required|min:8',
                        'confirm_password' => 'required|same:new_password',
                    ]);
                    if ($validator->fails()) {
                        return back()->withErrors($validator)
                            ->withInput();
                    }
                    User::where('id', $id)->update([
                        'firstname' => $request->firstname,
                        'lastname' => $request->lastname,
                        'user_level_id' => $request->user_level,
                        'password' => Hash::make($request->new_password),
                        'updated_at' => Carbon::now()
                    ]);
                }
                return back()->withErrors([
                    "user_profile_updated_successfully" => "user profile updated successfully"
                ]);
            }
        } else {
            return abort(404);
        }
    }

    public function delete(Request $request, $id = false) {
        if (User::where('id', $id)->exists()) {
            if ($request->isMethod('get')) {
                $data = [
                    'id' => $id
                ];
                return view('crm.pages.users.delete', $data);
            } elseif ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'user_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                User::where('id', $id)->delete();
                return redirect()->route('users->show')->withErrors([
                    "user_profile_deleted_successfully" => "user deleted successfully"
                ]);
            }
        } else {
            return abort(404);
        }
    }
}
