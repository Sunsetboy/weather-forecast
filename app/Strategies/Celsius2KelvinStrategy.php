<?php


namespace App\Strategies;


class Celsius2KelvinStrategy implements TempScaleConversionStrategyInterface
{
    /**
     * Celsius -> Kelvin
     * @param float $fromValue
     * @return float
     */
    public function convert(float $fromValue): float
    {
        return round($fromValue + 273, 2);
    }

    /**
     * Kelvin -> Celsius
     * @param float $fromValue
     * @return float
     */
    public function invert(float $fromValue): float
    {
        return round($fromValue - 273, 2);
    }
}
