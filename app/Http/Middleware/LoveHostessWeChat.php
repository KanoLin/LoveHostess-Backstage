<?php

namespace App\Http\Middleware;

use Closure;

class LoveHostessWeChat
{
    public function handle($request,Closure $next)
    {
        if (!$request->session()->has('openid'))
            return response()->json([
                'err_code'=>1,
                'err_msg'=>'尚未微信登录哦！'
            ]);
        return $next($request);
    }
    
}