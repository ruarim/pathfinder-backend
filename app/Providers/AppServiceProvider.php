<?php

namespace App\Providers;

use App\Contracts\AuthenticationServiceInterface;
use App\Services\AuthenticationService;
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
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }
}
