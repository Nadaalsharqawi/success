<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 0 , 'code'=>401 , 'message'=>trans('admin.Token_is_Invalid')] , 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 0 , 'code'=>401 , 'message'=> trans('admin.Token_is_Expired')] , 401);
            }else{
                return response()->json(['status' => 0 , 'code'=>401 , 'message'=> trans('admin.Authorization_Token_not_found')] , 401);
            }
        }
        return $next($request);
    }
}
