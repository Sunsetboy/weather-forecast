<?php


namespace App\Repositories;


use App\Enums\TempScaleEnum;
use App\Exceptions\NegativeAbsoluteTemperatureException;
use App\Valueobjects\Forecast;
use App\Valueobjects\Temperature;
use DateTime;

abstract class AbstractForecastRepository
{
    /**
     * Generates a fake forecast with random data
     * @param string $town
     * @param DateTime $date
     * @param $temperatureScale
     * @return Forecast
     * @throws NegativeAbsoluteTemperatureException
     */
    protected function getFakeForecast(string $town, $date, $temperatureScale): Forecast
    {
        $temperatures = [];
        $currentDateTime = $date->modify('this hour');
        $tomorrow = (clone $currentDateTime)->modify('+1 day')->setTime(0, 0, 0);

        while ($currentDateTime < $tomorrow) {

            $randomTempValue = mt_rand(10, 15);

            $temperature = Temperature::createFromScale($temperatureScale, $randomTempValue);
            $datetimeAsString = $currentDateTime->format('Y-m-d H:i:s');
            $temperatures[$datetimeAsString] = $temperature;
            $currentDateTime->modify('+1 hour');
        }

        return new Forecast($temperatures, $town);
    }
}
