<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isLoggedIn
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
        if(Auth::guard($guard)->check()){
            if($guard=='admin')return redirect()->intended('admin');
            if($guard == 'web') return redirect()->intended('');
        };
        return $next($request);
    }
}
