<?php

namespace App\Repositories;

use App\Enums\TempScaleEnum;
use App\Exceptions\InvalidForecastDateException;
use App\Exceptions\NegativeAbsoluteTemperatureException;
use App\Valueobjects\Forecast;
use DateTime;

class BBCForecastProvider extends AbstractForecastRepository implements ForecastProviderInterface
{
    use ForecastDateChecker;

    private $apiUrl;
    private $apiKey;

    public function __construct($apiUrl, $apiKey)
    {
        // some constructor logic
    }

    /**
     * @param string $town
     * @param DateTime $date
     * @param TempScaleEnum $temperatureScale
     * @return Forecast
     * @throws InvalidForecastDateException
     * @throws NegativeAbsoluteTemperatureException
     */
    public function getForecast(string $town, DateTime $date, TempScaleEnum $temperatureScale): Forecast
    {
        $this->checkDate($date);

        return $this->getFakeForecast($town, $date, $temperatureScale);
    }
}
