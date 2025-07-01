<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //REDIRECT AN AUTHENTICATED USER TO DASHBOARD
        RedirectIfAuthenticated::redirectUsing(function(){
            return route('admin.dashboard');
        });

        //REDIRECT UN-AUTHENTICATED USER TO LOGIN PAGE
        Authenticate::redirectUsing(function(){
            Session::flash('fail', 'You must be logged in to access admin area. Please login to continue.');
            return route('admin.login');
        });
    }
}
