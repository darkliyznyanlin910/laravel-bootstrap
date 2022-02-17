<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user() && $request->user()->type == "admin"){
            return $next($request);
        }

        if($request->user() && $request->user()->type != "user"){
            return new Response(view('auth/login')->with('role', 'USER'));
        }

        if($request->user() && $request->user()->type == "user"){
            return $next($request);
        }

    }
}
