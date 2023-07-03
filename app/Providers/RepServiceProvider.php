<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\LocationRepositoryInterface',
            'App\Repository\LocationRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
