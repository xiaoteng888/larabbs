<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RecordLastActivedTime
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
        //如果是登录的用户
        if(Auth::check()){
            //记录最后登录的时间
            Auth::user()->recordLastActivedAt();
        }
        return $next($request);
    }
}
