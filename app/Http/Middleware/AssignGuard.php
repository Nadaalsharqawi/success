<?php

namespace App\Http\Middleware;
use Closure;
use Auth ;

class AssignGuard
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
        if ((Auth::guard('user_api')->check()) or (Auth::guard('provider_api')->check())) {
           return $next($request);
        }

      return redirect('/');
    }
}