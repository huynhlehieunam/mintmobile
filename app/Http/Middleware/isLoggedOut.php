<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isLoggedOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard='web')
    {
        if (Auth::guard($guard)->guest()) {
            if ($guard == 'admin') return redirect()->intended('admin/login');
            if ($guard == 'web') return redirect()->intended('login');
        };
        return $next($request);
    }  
}
