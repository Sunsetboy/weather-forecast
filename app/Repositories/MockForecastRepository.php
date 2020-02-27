<?php

namespace App\Repositories;

use App\Valueobjects\Forecast;
use DateTime;

class MockForecastRepository implements ForecastProviderInterface
{
    /**
     * Generates a fake forecast for testing purposes
     * @param string $town
     * @param DateTime $date
     * @return Forecast
     */
    public function getForecast(string $town, $date): Forecast
    {

    }
}
