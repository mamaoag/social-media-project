<?php

namespace Tragala\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $guard = null)
     {
         if (Auth::guard($guard)->check() && Auth::user()->usergroup > 2) {
           return $next($request);
         }else{
           return redirect('auth.login');
         }

     }
}
