<?php


namespace App\Repositories;


use App\Valueobjects\Forecast;

interface ForecastProviderInterface
{
    public function getForecast(string $town, $date): Forecast;
}
