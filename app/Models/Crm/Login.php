<?php

namespace App\Models\Crm;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;


    public static function create_auth_log($auth_type = false) { // $auth_type maybe login or logout
        $insert_data = Login::insert([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_data' => json_encode(Auth::user()),
            'auth_type' => $auth_type,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return $insert_data;
    }

    public static function create_invalid_login_attempt($email = false, $password = false) {
        $insert_data = DB::table('invalid_login_attempts')->insert([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'filled_guest_email' => $email,
            'filled_guest_password' => $password,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return $insert_data;
    }

}
