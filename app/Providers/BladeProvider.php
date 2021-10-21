<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Admin;
class BladeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole',function($expression){
            if(Auth::user()){
                if(Auth::user()->hasAnyRoles($expression)){ //hasAny neu co nhieu quyen hasrole chi duy nhat 1 quyen
                    return true;
                }
            }
            return false;
        });
        Blade::if('impersonate',function(){
            if(session()->get('impersonate')){
                return true;
            }
            return false;
        });
    }
}
