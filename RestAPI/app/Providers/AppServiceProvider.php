<?php

namespace App\Providers;

use App\Services\CurrencyService;
use App\Services\Interfaces\CurrencyServiceInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrencyServiceInterface::class, function ($app) {
            return new CurrencyService(new Client());
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
