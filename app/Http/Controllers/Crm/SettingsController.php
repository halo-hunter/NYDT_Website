<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\PaymentSettings;
use App\Models\Crm\ReminderSetting;
use App\Models\Crm\Settings;
use App\Rules\Crm\BccValidationRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function email_settings(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.settings.email.show');
        } elseif ($request->isMethod('post')) {

            if ($request->has('translator_email_address')) {

                $validator = Validator::make($request->all(), [
                    'translator_email_address' => 'email|nullable',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }

                if (Settings::where('name', 'translator_email_address')->exists()) {

                    Settings::where('name', 'translator_email_address')->update([
                        'data' => json_encode($request->translator_email_address)
                    ]);

                } else {

                    Settings::create([
                        'name' => 'translator_email_address',
                        'data' => json_encode($request->translator_email_address),
                    ]);

                }

                return back()->withErrors(["translator_email_address_update_success_message" => "Translator email address has updated successfully"]);

            } else {

                $validator = Validator::make($request->all(), [
                    'host' => 'required',
                    'port' => 'required|numeric',
                    'encryption' => 'required',
                    'username' => 'required|email',
                    'password' => 'required',
                    'bcc' => New BccValidationRule(),
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)
                        ->withInput();
                }
                EmailSettings::truncate();
                EmailSettings::insert([
                    [
                        'host' => $request->host,
                        'port' => $request->port,
                        'encryption' => $request->encryption,
                        'username' => $request->username,
                        'password' => $request->password,
                        'bcc' => $request->bcc,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                ]);
                return back()->withErrors(["email_settings_update_success_message" => "email settings has updated successfully"]);

            }

        }
    }

    public function payment_settings(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.settings.payment.show');
        } elseif ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'environment' => 'required',
                'merchant_login_id' => 'required',
                'merchant_transaction_key' => 'required',
                'merchant_email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            PaymentSettings::truncate();
            PaymentSettings::insert([
                [
                    'environment' => $request->environment,
                    'merchant_login_id' => $request->merchant_login_id,
                    'merchant_transaction_key' => $request->merchant_transaction_key,
                    'merchant_email' => $request->merchant_email,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
            return back()->withErrors(["payment_settings_update_success_message" => "payment settings has updated successfully"]);
        }
    }

    public function reminder_settings(Request $request)
    {

        if ($request->isMethod('get')) {

            $data = [
                'reminder_settings' => ReminderSetting::all()
            ];

            return view('crm.pages.settings.reminder.show', $data);

        } elseif ($request->isMethod('post')) {

            foreach ($request->all() as $key => $value)  {

                ReminderSetting::where('key', $key)->update([

                    'days' => $value != null ? $value : 0

                ]);

            }

            return back()->withErrors(["reminder_settings_update_success_message" => "reminder settings has updated successfully"]);

        }

    }

}
