<?php

namespace App\Repositories;

use App\Enums\TempScaleEnum;
use App\Exceptions\InvalidForecastDateException;
use App\Exceptions\NegativeAbsoluteTemperatureException;
use App\Valueobjects\Forecast;
use App\Valueobjects\Temperature;
use DateTime;

class MockForecastRepository implements ForecastProviderInterface
{
    use ForecastDateChecker;

    /**
     * Generates a fake forecast for testing purposes
     * @param string $town
     * @param DateTime $date
     * @return Forecast
     * @throws NegativeAbsoluteTemperatureException
     * @throws InvalidForecastDateException
     */
    public function getForecast(string $town, $date): Forecast
    {
        $this->checkDate($date);

        $temperatures = [];
        $currentDateTime = $date->modify('this hour');
        $tomorrow = (clone $currentDateTime)->modify('+1 day')->setTime(0, 0, 0);

        while ($currentDateTime < $tomorrow) {

            $randomTempValueInCelsius = mt_rand(10, 15);

            $temperature = Temperature::createFromScale(TempScaleEnum::CELSIUS(), $randomTempValueInCelsius);
            $datetimeAsString = $currentDateTime->format('Y-m-d H:i:s');
            $temperatures[$datetimeAsString] = $temperature;
            $currentDateTime->modify('+1 hour');
        }

        return new Forecast($temperatures, $town);
    }
}
