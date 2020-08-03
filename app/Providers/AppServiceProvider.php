<?php

namespace App\Providers;

use App\Observers\RelativeObserver;
use App\Relative;
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
        // add model observers
        Relative::observe(RelativeObserver::class);
    }
}
