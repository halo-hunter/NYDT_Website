<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\Crm\SendRequestedDocumentListToCustomer;
use App\Mail\Portal\NotifyAdministrationWhenProfileUpdated;
use App\Models\Crm\Client;
use App\Models\Crm\CompanyInfo;
use App\Models\Crm\Customers;
use App\Models\Crm\EmailSettings;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PortalCustomerProfileController extends Controller
{
    public function show(Request $request) {

        $portal_auth_user_id = Auth::guard('portal')->id();

        $current_phone = Client::where('id', $portal_auth_user_id)->first()->phone;
        $current_phone_secondary = Client::where('id', $portal_auth_user_id)->first()->phone_secondary;
        $current_email = Client::where('id', $portal_auth_user_id)->first()->email;

        if ($request->isMethod('get')) {
            $client = Client::where('id', $portal_auth_user_id)->first();
            $data = [
                'firstname' => $client->firstname,
                'lastname' => $client->lastname,
                'email' => $client->email,
                'phone' => $client->phone,
                'phone_secondary' => $client->phone_secondary,
                'profile_photo' => $client->profile_photo,
                'client_id' => $client->id,
            ];
            return view('portal.pages.profile.show', $data);
        } elseif ($request->isMethod('post')) {
            if ($request->new_password == null && $request->confirm_password == null) {
                if (Client::where('id', $portal_auth_user_id)->first()->email == $request->email) {
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|email',
                        'phone' => 'required',
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|email|unique:clients,email',
                        'phone' => 'required|min:17',
                        'phone_secondary' => 'nullable|min:17',
                    ]);
                }
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                Client::where('id', $portal_auth_user_id)->update([
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'phone_secondary' => $request->phone_secondary,
                ]);
            } else {
                if (Client::where('id', $portal_auth_user_id)->first()->email == $request->email) {
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|email',
                        'phone' => 'required',
                        'new_password' => 'required|min:8',
                        'confirm_password' => 'required|same:new_password',
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'email' => 'required|email|unique:clients,email',
                        'phone' => 'required',
                        'new_password' => 'required|min:8',
                        'confirm_password' => 'required|same:new_password',
                    ]);
                }
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                Client::where('id', $portal_auth_user_id)->update([
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'phone_secondary' => $request->phone_secondary,
                    'password' => Hash::make($request->new_password),
                ]);
            }

            $mail_data = [
                'customer_firstname_lastname' => Client::where('id', $portal_auth_user_id)->first()->lastname . ' ' . Client::where('id', $portal_auth_user_id)->first()->firstname,
                'client_id' => $portal_auth_user_id,
                'email' => $request->email != $current_email ? $request->email : 0,
                'phone' => $request->phone != $current_phone ? $request->phone : 0,
                'phone_secondary' => $request->phone_secondary != $current_phone_secondary ? $request->phone_secondary : 0,

            ];
            Mail::to(CompanyInfo::first()->email)
                ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                ->send(new NotifyAdministrationWhenProfileUpdated($mail_data));

            return back()->withErrors([
                "user_profile_updated_successfully" => "profile updated successfully"
            ]);
        }
    }
}
