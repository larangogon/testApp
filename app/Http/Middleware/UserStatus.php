<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserStatus
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
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
