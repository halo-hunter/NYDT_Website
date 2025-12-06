<?php

namespace App\Http\Middleware\Portal;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequireRecentConfirmation
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('portal')->check()) {
            return redirect()->route('portal->login->show');
        }

        $recent = session()->get('portal_recent_confirmation');
        $ttlMinutes = config('app.portal_confirmation_ttl', 10);

        if (! $recent || now()->diffInMinutes($recent) >= $ttlMinutes) {
            session()->put('portal_confirm_intended', $request->fullUrl());
            return redirect()->route('portal->confirm_action->show');
        }

        return $next($request);
    }
}
