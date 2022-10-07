<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MobileLang
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
        if ($request->wantsJson()) {
            if (isset($request->header()['accept-language'][0])) {
                app()->setLocale($request->header()['accept-language'][0]);
            } else {
                app()->setLocale('ar');
            }
        }
        return $next($request);
    }
}
