<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        Schema::defaultStringLength(191);
        //
        Blade::if('admin', function () {
            return in_array(auth()->user()->role_id, [1, 2, 3]);
        });
        Blade::if('student', function () {
            return in_array(auth()->user()->role_id, [1, 2, 3, 4]);
        });
    }
}
