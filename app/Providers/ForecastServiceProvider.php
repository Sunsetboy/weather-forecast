<?php

namespace App\Providers;

use App\Repositories\BBCForecastProvider;
use App\Repositories\IAmSterdamForecastProvider;
use Illuminate\Support\ServiceProvider;

class ForecastServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IAmSterdamForecastProvider::class, function ($app) {
            return new IAmSterdamForecastProvider(
                config('forecast_providers.providers.iamsterdam.api_url'),
                config('forecast_providers.providers.iamsterdam.api_key')
            );
        });

        $this->app->bind(BBCForecastProvider::class, function ($app) {
            return new BBCForecastProvider(
                config('forecast_providers.providers.bbc.api_url'),
                config('forecast_providers.providers.bbc.api_key')
            );
        });

    }
}
