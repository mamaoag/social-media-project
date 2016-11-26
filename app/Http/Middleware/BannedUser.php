<?php

namespace Tragala\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;
class BannedUser
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
         if (Auth::guard($guard)->check() && Auth::user()->banned == true) {
           Auth::logout();
           return redirect()->route('auth.login')->withTitle('Account Suspended')->withInfo('Your account has been suspended. If you believe this was a mistake, contact the administrators.');
         }else{
           return $next($request);
         }
     }
}
