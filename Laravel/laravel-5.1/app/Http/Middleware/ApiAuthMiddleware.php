<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthMiddleware
{


    /**
     * 接口登录验证
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->session()->has('id') ){
            return $next($request);
        }else{
            return json_encode(['error'=>1,'message'=>'has not login']);
        }


    }
}
