<?php

namespace App\Http\Middleware;

use Closure;

class homeMiddleware
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
        // return $next($request);
        if(session('home_user')){
            // 执行下一次请求
            return $next($request);
        }else{
            //跳转至首页
            return redirect('/'); 
        }
    }
}
