<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user != null) {
            if ($user->active) {
                return $next($request);
            } else {
                Auth::logout() ;

                return redirect('login');
            }
        } else {
            return $next($request);
        }
    }
}
