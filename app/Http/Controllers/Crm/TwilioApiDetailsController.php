<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\TwilioApiDetails;
use App\Rules\Crm\BccValidationRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TwilioApiDetailsController extends Controller
{
    public function show(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.api_connections.twilio.show');
        } elseif ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'account_sid' => 'required',
                'app_token' => 'required',
                'from_phone_number' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            if (TwilioApiDetails::all()->count()  == 0) {
                TwilioApiDetails::insert([
                    'account_sid' => $request->account_sid,
                    'app_token' => $request->app_token,
                    'from_phone_number' => $request->from_phone_number,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } else {
                $get_last_record_id = TwilioApiDetails::get()->first()->id;
                TwilioApiDetails::where('id', $get_last_record_id)->update([
                    'account_sid' => $request->account_sid,
                    'app_token' => $request->app_token,
                    'from_phone_number' => $request->from_phone_number,
                    'updated_at' => Carbon::now(),
                ]);
            }
            return back()->withErrors(["updated_successfully" => "updated successfully"]);
        }
    }

    public function status_callback(Request $request) {
//        Session::remove('dd');
//        Session::remove('rrr');
//        Session::put('rrr', $request->all());
//        Session::save();
        $status = implode(',',$_REQUEST) ;
        $handle = fopen('twilio_log.txt','a');
        fwrite($handle, $status);
    }
}
