<?php


namespace App\Repositories;


use App\Enums\TempScaleEnum;
use App\Valueobjects\Forecast;
use DateTime;

interface ForecastProviderInterface
{
    /**
     * @param string $town
     * @param DateTime $date
     * @param TempScaleEnum $temperatureScale
     * @return Forecast
     */
    public function getForecast(string $town, DateTime $date, TempScaleEnum $temperatureScale): Forecast;
}
