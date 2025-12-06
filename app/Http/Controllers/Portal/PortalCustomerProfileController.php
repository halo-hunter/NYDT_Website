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

        $client = Auth::guard('portal')->user();

        if (! $client) {
            return redirect()->route('portal->login->show');
        }

        $current_phone = $client->phone;
        $current_phone_secondary = $client->phone_secondary;
        $current_email = $client->email;

        if ($request->isMethod('get')) {
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
                if ($client->email == $request->email) {
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
                Client::where('id', $client->id)->update([
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'phone_secondary' => $request->phone_secondary,
                ]);
            } else {
                if ($client->email == $request->email) {
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
                Client::where('id', $client->id)->update([
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'phone_secondary' => $request->phone_secondary,
                    'password' => Hash::make($request->new_password),
                ]);
            }

            $mail_data = [
                'customer_firstname_lastname' => $client->lastname . ' ' . $client->firstname,
                'client_id' => $client->id,
                'email' => $request->email != $current_email ? $request->email : 0,
                'phone' => $request->phone != $current_phone ? $request->phone : 0,
                'phone_secondary' => $request->phone_secondary != $current_phone_secondary ? $request->phone_secondary : 0,

            ];
            $companyEmail = optional(CompanyInfo::first())->email;
            if ($companyEmail) {
                Mail::to($companyEmail)
                    ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                    ->send(new NotifyAdministrationWhenProfileUpdated($mail_data));
            }

            return back()->withErrors([
                "user_profile_updated_successfully" => "profile updated successfully"
            ]);
        }
    }
}
