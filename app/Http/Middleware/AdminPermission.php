<?php

namespace App\Http\Middleware;
use App\Admin;
use Aws\Result;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
class AdminPermission
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
        if(Auth::user()->hasRole('admin')){
            return $next($request);
        }
        return Redirect::to('/dashboard');
       
    }

}
