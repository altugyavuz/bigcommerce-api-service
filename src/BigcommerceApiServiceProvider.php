<?php

namespace Yvz\BigcommerceApiService;

use Illuminate\Support\ServiceProvider;
use Yvz\BigcommerceApiService\Contracts\BigcommerceApiServiceInterface;
use Yvz\BigcommerceApiService\Services\BigcommerceApiService;

class BigcommerceApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            BigcommerceApiServiceInterface::class,
            BigcommerceApiService::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Registering logic
    }
}