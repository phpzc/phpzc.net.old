<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
{


    /**
     * 后台登录验证
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->session()->has('id') ){
            $id = $request->session()->get('id');
            if($id == 1)
                return $next($request);
        }else{
            return redirect('/');
        }


    }
}
