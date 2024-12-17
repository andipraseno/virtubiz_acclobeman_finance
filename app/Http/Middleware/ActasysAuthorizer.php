<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;

class ActasysAuthorizer
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('actasys_user_id')) {
            return redirect('/');
        } else {
            if (Session::get('actasys_lockscreen') == 2) {
                return redirect('/');
            }

            return $next($request);
        }
    }
}
