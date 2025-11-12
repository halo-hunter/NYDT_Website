<?php

namespace App\Http\Middleware\Crm;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevelForRightsToDeleteCustomers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $get_auth_user_level_id = DB::table('users')->where('id', Auth::id())->first()->user_level_id;
        if ($get_auth_user_level_id == 1) {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
