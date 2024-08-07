<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use \Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Laravel fix for SQLSTATE[42000]: Syntax error or access violation: 1071 La clé est trop longue. Longueur maximale: 1000"
         * @author neovinz
         * @link https://gist.github.com/fabinou/5294ae21ac462659eb9e9f7de6b75d91
         */

        \Schema::defaultStringLength(191);


        /**
         * Get a variable accessible in all templates
         * @author neovinz
         * @link https://stackoverflow.com/a/61181644
         */
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('user', Auth::user()->load('restaurant'));
            }
        });
    }
}
