<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LoanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("App\Services\LoanService",function(){
            return new \App\Services\LoanService(config('constants.loan'));
        });
    }
}
