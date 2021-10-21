<?php

namespace App\Http\Middleware;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use session;
use Closure;

class impersonate
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
        if(session()->has('impersonate')){  //nếu middle có session thì ráng session id đó
            Auth::onceUsingId(session('impersonate'));
        }
        return $next($request);
    }
}
