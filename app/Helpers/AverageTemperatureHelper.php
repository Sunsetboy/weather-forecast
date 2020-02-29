<?php

namespace App\Helpers;

use App\Enums\TempScaleEnum;
use App\Valueobjects\Temperature;

class AverageTemperatureHelper
{
    /**
     * Calculates an average temperature
     * @param array $temperatures
     * @return Temperature
     * @throws \Exception
     */
    public static function getAverageTemperature(array $temperatures): Temperature
    {
        if(sizeof($temperatures) == 0) {
            throw new \Exception('Array size should be greater than zero');
        }

        $tempScale = new TempScaleEnum('celsius');
        $valuesInCelsius = array_map(function (Temperature $temperature) use ($tempScale) {
            return $temperature->getValue($tempScale);
        }, $temperatures);

        $averageValue = array_sum($valuesInCelsius) / sizeof($temperatures);

        return Temperature::createFromScale($tempScale, $averageValue);
    }
}
