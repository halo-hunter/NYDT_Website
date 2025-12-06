<?php

namespace App\Http\Middleware\Portal;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PortalSessionTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('portal')->check()) {
            return redirect()->route('portal->login->show');
        }

        $lastActivity = session()->get('portal_last_activity');
        $timeoutSeconds = config('session.lifetime') * 60;

        if ($lastActivity && now()->diffInSeconds($lastActivity) > $timeoutSeconds) {
            Auth::guard('portal')->logout();
            session()->invalidate();
            session()->regenerateToken();

            return redirect()->route('portal->login->show')->withErrors([
                'session_expired' => 'Your session has expired due to inactivity.',
            ]);
        }

        session()->put('portal_last_activity', now());

        return $next($request);
    }
}
