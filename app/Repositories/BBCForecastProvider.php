<?php


namespace App\Repositories;


use App\Valueobjects\Forecast;

class BBCForecastProvider implements ForecastProviderInterface
{
    public function getForecast(string $town, $date): Forecast
    {
        // TODO: Implement getForecast() method.
    }
}
