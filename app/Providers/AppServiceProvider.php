<?php

namespace App\Providers;

use App\Services\ApiClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiClient::class, function ()
        {
            return new ApiClient(
                config('services.api.base_url'),
                config('services.api.key')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
