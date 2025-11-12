<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\Crm\ChangePassword;
use App\Mail\Crm\ForgorPassword;
use App\Mail\Portal\CustomerPasswordHasBeenSetSuccessfully;
use App\Mail\Portal\PortalChangePassword;
use App\Mail\Portal\PortalForgotPassword;
use App\Models\ClientInvitationToken;
use App\Models\Crm\Client;
use App\Models\Crm\Customers;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\Login;
use App\Models\User;
use Carbon\Carbon;
use http\Message\Body;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PortalAuthController extends Controller
{
    public function __construct()
    {
//        if (request()->ip() != '188.129.169.8') {
//            echo "<p style='text-align: center; margin-top: 10%; font-size: 24px; font-family: sans-serif; color: #5e72e4; font-weight: bold'>Under Construction</p>";
//            exit();
//        }
    }

    public function set_password(Request $request, string $token)
    {
        $tokenValue = $request->route('token') ?? $token;

        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $invitation = ClientInvitationToken::findValidToken($tokenValue);

        if (! $invitation || ! $invitation->client || $invitation->client->password_status === 'set') {
            abort(404);
        }

        $client = $invitation->client;

        if ($request->isMethod('get')) {
            return view('portal.pages.set_password.show', ['token' => $tokenValue]);
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $client->update([
            'password' => Hash::make($request->password),
            'password_status' => 'set',
        ]);

        $invitation->markConsumed();

        ClientInvitationToken::where('client_id', $client->id)
            ->whereNull('consumed_at')
            ->delete();

        Mail::to($client->email)
            ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
            ->send(new CustomerPasswordHasBeenSetSuccessfully());

        return redirect()->route('portal->login->show')->with("password_has_been_set_success_message", "password has been set successfully");
    }

    public function login(Request $request) {
        if ($request->isMethod('get')) {
            return view('portal.pages.login.show');
        } elseif ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            if (Client::where('email', $request->email)->exists()) {
                if (Hash::check($request->password, Client::where('email', $request->email)->first()->password)) {
                    $request->session()->regenerate();
                    session()->forget('portal_authorized_user_id');
                    session()->put('portal_authorized_user_id', Client::where('email', $request->email)->first()->id);
                    session()->save();
                    if (session()->has('portal_authorized_user_id')) {
                        return redirect()->route('portal->dashboard->show');
                    } else {
                        return redirect()->route('portal->login->show');
                    }
                }  else {
                    return back()->withErrors([
                        'credentials_is_incorrect' => 'The provided credentials do not match our records.',
                    ]);
                }
            } else {
                return back()->withErrors([
                    'credentials_is_incorrect' => 'The provided credentials do not match our records.',
                ]);
            }
        } else {
            return abort(404);
        }
    }

    public function logout(Request $request) {
        session()->forget('portal_authorized_user_id');
        return redirect()->route('portal->login->show');
    }

    public function forgot_password(Request $request) {
        if ($request->isMethod('get')) {
            return view('portal.pages.forgot_password.show');
        } elseif ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:clients,email',
            ]);

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                if (!User::where('email', $request->email)->exists()) {
                    DB::table('invalid_forgot_password_attempts')->insert([
                        'ip' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'email_address' => $request->email,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            $uuid = Str::uuid();

            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $uuid,
                'created_at' => Carbon::now()
            ]);

            $mail_data = [
                'uuid' => $uuid,
            ];

            Mail::to($request->email)
                ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                ->send(new PortalForgotPassword($mail_data));

            return back()->with("password_change_url_send_success_message", "password reset link sent successfully, please check email");

        } else {
            return abort(404);
        }
    }

    public function change_password(Request $request, $token) {
        if ($request->isMethod('get')) {
            if (DB::table('password_reset_tokens')->where('token', $token)->where('created_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())->exists()) {
                DB::table('password_reset_tokens')->where('token', $token)->delete();
            }
            if (DB::table('password_reset_tokens')->where('token', $token)->exists()) {
                $data = ['token' => $token];
                return view('portal.pages.change_password.show', $data);
            } else {
                $data = ['token_not_found' => 'password change url is incorrect'];
                return view('portal.pages.change_password.show', $data);
            }
        } elseif ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }
            $user_email = DB::table('password_reset_tokens')->where('token', $token)->first()->email;
            Client::where('email', $user_email)->update([
                'password' => Hash::make($request->new_password)
            ]);
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            Mail::to($user_email)
                ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                ->send(new PortalChangePassword());
            return redirect()->route('portal->login->show')->with("password_change_success_message", "password changed successfully");
        }
    }

}
