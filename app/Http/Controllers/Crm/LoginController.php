<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Mail\Crm\ChangePassword;
use App\Mail\Crm\ForgorPassword;
use App\Models\Crm\EmailSettings;
use App\Models\Crm\Login;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function show(Request $request) {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            if ($request->isMethod('get')) {
                return view('crm.pages.login.show');
            } elseif ($request->isMethod('post')) {
                $this->enforceRateLimit('crm-login', $request);

                $credentials = $request->validate([
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ]);

                if (Auth::attempt($credentials)) {
                    RateLimiter::clear($this->rateLimiterKey('crm-login', $request));
                    Login::create_auth_log('login');
                    $request->session()->regenerate();
                    return redirect()->intended('dashboard');
                }

                Login::create_invalid_login_attempt($request->email, $request->password);
                RateLimiter::hit($this->rateLimiterKey('crm-login', $request));
                return back()->withErrors([
                    'credentials_is_incorrect' => 'The provided credentials do not match our records.',
                ]);
            } else {
                return abort(404);
            }
        }
    }

    public function logout(Request $request) {
        Login::create_auth_log('logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pages->login->show');
    }

    public function forgot_password(Request $request) {
        if ($request->isMethod('get')) {
            return view('crm.pages.forgot_password.show');
        } elseif ($request->isMethod('post')) {
            $this->enforceRateLimit('crm-forgot-password', $request);

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
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
                RateLimiter::hit($this->rateLimiterKey('crm-forgot-password', $request));
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
                ->send(new ForgorPassword($mail_data));

            return back()->with("password_change_url_send_success_message", "password reset link sent successfully, please check email");

        } else {
            return abort(404);
        }
    }

    public function change_password(Request $request, $token = false) {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } else {
            if ($request->isMethod('get')) {
                $hashedToken = hash('sha256', $token);
                $record = DB::table('password_reset_tokens')->where('token', $hashedToken)->first();

                if ($record && $record->created_at && Carbon::parse($record->created_at)->lte(Carbon::now()->subMinutes(5))) {
                    DB::table('password_reset_tokens')->where('token', $hashedToken)->delete();
                    $record = null;
                }

                if ($record) {
                    $data = ['token' => $token];
                    return view('crm.pages.change_password.show', $data);
                } else {
                    $data = ['token_not_found' => 'password change url is incorrect'];
                    return view('crm.pages.change_password.show', $data);
                }
            } elseif ($request->isMethod('post')) {
                $this->enforceRateLimit('crm-change-password', $request);

                $validator = Validator::make($request->all(), [
                    'new_password' => 'required|min:8',
                    'confirm_password' => 'required|same:new_password',
                ]);
                if ($validator->fails()) {
                    RateLimiter::hit($this->rateLimiterKey('crm-change-password', $request));
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
                User::where('email', $user_email)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                DB::table('password_reset_tokens')->where('token', $hashedToken)->delete();
                RateLimiter::clear($this->rateLimiterKey('crm-change-password', $request));
                Mail::to($user_email)
                    ->bcc(EmailSettings::get_bcc_mail_addresses_with_dev_email())
                    ->send(new ChangePassword());
                return redirect()->route('pages->login->show')->with("password_change_success_message", "password changed successfully");
            }
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
