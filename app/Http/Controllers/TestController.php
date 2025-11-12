<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Crm\GenericController;
use App\Mail\Crm\ForgorPassword;
use App\Mail\Crm\ScheduledBiometricAppointment;
use App\Mail\Crm\SendSetPasswordUrlToCustomer;
use App\Models\Crm\CaseModel;
use App\Models\Crm\Client;
use App\Models\Crm\CompanyInfo;
use App\Models\Crm\Customers;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\Invoice;
use App\Models\Crm\PaymentSettings;
use App\Models\Crm\ReminderSetting;
use App\Models\Crm\Rider;
use App\Models\Crm\TodoTask;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;

class TestController extends Controller
{
    public function dashboard() {
        echo 'dashboard';
        echo " <a href='" . route('portal->logout') . "'>logout</a> ";
    }

    public function set_password() {
        echo "set_password";
    }

    public function portal() {
        echo 'portal';
    }


    public function test() {



        dd(Hash::make('MainBKNYLaw@2025'));

        exit;



        Mail::raw("Interview datetime: Hello", function($message) {
            $message->to('eldar.g@zrabo.com');
        });

        exit;


        $cases__due_dates = DB::table('cases')
            ->select(
                'cases.id AS url',
                DB::raw("jt.due_date AS start"),
                DB::raw("'Due Date' AS title")
            )
            ->join(DB::raw("JSON_TABLE(cases.due_date, '$[*]' COLUMNS (due_date VARCHAR(255) PATH '$')) AS jt"), function ($join) {
                $join->whereNotNull('jt.due_date');
            })
            ->get()
            ->toArray();

        dd($cases__due_dates);


        exit;

        $cases__due_dates = CaseModel::select('id', 'due_date as start', DB::raw("'Due Date' as title"))
            ->whereNotNull('due_date')
            ->get()
            ->toArray();


        dd($cases__due_dates);



        exit;

        dd(GenericController::get_client_riders_email_addresses(174));
        dd(GenericController::get_client_riders_phone_numbers(174));





        exit;

        dd(GenericController::twilio_send_sms(1,2, 2, '+995599777666', 'test'));




















        if (\request()->ip() != '188.129.169.8') {
            abort(404);
        }




















        echo GenericController::format_phone_number_to_us_format('+19955997776');

















    }
}
