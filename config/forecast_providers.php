<?php

return [
    'providers' => [
        'iamsterdam' => [
            'enabled' => env('IAMSTERDAM_FORECAST_PROVIDER_ENABLED'),
            'class' => \App\Repositories\IAmSterdamForecastProvider::class,
            'api_url' => env('IAMSTERDAM_API_URL'),
            'api_key' => env('IAMSTERDAM_API_KEY'),
        ],
        'bbc' => [
            'enabled' => env('BBC_FORECAST_PROVIDER_ENABLED'),
            'class' => \App\Repositories\BBCForecastProvider::class,
            'api_url' => env('BBC_API_URL'),
            'api_key' => env('BBC_API_KEY'),
        ],
    ]
];
