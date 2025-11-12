<?php

namespace App\Http\Middleware\Portal;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PortalAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('portal_authorized_user_id')) {
            return redirect()->route('portal->dashboard->show');
        } else {
            return $next($request);
        }
    }
}
