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
use Illuminate\Support\Facades\RateLimiter;
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

        Auth::guard('portal')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

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
            $this->enforceRateLimit('portal-login', $request);
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::guard('portal')->attempt($credentials)) {
                RateLimiter::clear($this->rateLimiterKey('portal-login', $request));
                $request->session()->regenerate();
                return redirect()->route('portal->dashboard->show');
            }

            RateLimiter::hit($this->rateLimiterKey('portal-login', $request));
            return back()->withErrors([
                'credentials_is_incorrect' => 'The provided credentials do not match our records.',
            ]);
        } else {
            return abort(404);
        }
    }

    public function logout(Request $request) {
        Auth::guard('portal')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('portal->login->show');
    }

    public function forgot_password(Request $request) {
        if ($request->isMethod('get')) {
            return view('portal.pages.forgot_password.show');
        } elseif ($request->isMethod('post')) {
            $this->enforceRateLimit('portal-forgot-password', $request);

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
                RateLimiter::hit($this->rateLimiterKey('portal-forgot-password', $request));
                return back()->withErrors($validator)
                    ->withInput();
            }

            $tokenPlain = Str::random(64);
            $hashedToken = hash('sha256', $tokenPlain);

            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $hashedToken,
                'created_at' => Carbon::now()
            ]);

            $mail_data = [
                'uuid' => $tokenPlain,
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
            $hashedToken = hash('sha256', $token);
            $record = DB::table('password_reset_tokens')->where('token', $hashedToken)->first();

            if ($record && $record->created_at && Carbon::parse($record->created_at)->lte(Carbon::now()->subMinutes(5))) {
                DB::table('password_reset_tokens')->where('token', $hashedToken)->delete();
                $record = null;
            }

            if ($record) {
                $data = ['token' => $token];
                return view('portal.pages.change_password.show', $data);
            } else {
                $data = ['token_not_found' => 'password change url is incorrect'];
                return view('portal.pages.change_password.show', $data);
            }
        } elseif ($request->isMethod('post')) {
            $this->enforceRateLimit('portal-change-password', $request);
            $validator = Validator::make($request->all(), [
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            if ($validator->fails()) {
                RateLimiter::hit($this->rateLimiterKey('portal-change-password', $request));
                return back()->withErrors($validator)
                    ->withInput();
            }

            $hashedToken = hash('sha256', $token);
            $record = DB::table('password_reset_tokens')->where('token', $hashedToken)->first();

            if (! $record) {
                return back()->withErrors([
                    'token_not_found' => 'password change url is incorrect',
                ]);
            }

            if ($record->created_at && Carbon::parse($record->created_at)->lte(Carbon::now()->subMinutes(5))) {
                DB::table('password_reset_tokens')->where('token', $hashedToken)->delete();
                return back()->withErrors([
                    'token_not_found' => 'password change url is incorrect or expired',
                ]);
            }

            $user_email = $record->email;
            Client::where('email', $user_email)->update([
                'password' => Hash::make($request->new_password)
            ]);
            DB::table('password_reset_tokens')->where('token', $hashedToken)->delete();
            RateLimiter::clear($this->rateLimiterKey('portal-change-password', $request));
            Mail::to($user_email)
                ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                ->send(new PortalChangePassword());
            return redirect()->route('portal->login->show')->with("password_change_success_message", "password changed successfully");
        }
    }

    protected function enforceRateLimit(string $name, Request $request): void
    {
        $key = $this->rateLimiterKey($name, $request);
        if (RateLimiter::tooManyAttempts($key, 5)) {
            abort(429, 'Too many attempts. Please try again later.');
        }
    }

    protected function rateLimiterKey(string $name, Request $request): string
    {
        return $name . '|' . $request->ip() . '|' . $request->input('email', 'guest');
    }

}
