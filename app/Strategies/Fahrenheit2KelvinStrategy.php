<?php


namespace App\Strategies;


class Fahrenheit2KelvinStrategy implements TempScaleConversionStrategyInterface
{
    public function convert(float $fromValue): float
    {
        return round(($fromValue + 459.67) * 5 / 9,2);
    }

    public function invert(float $fromValue): float
    {
        return round($fromValue * 9 / 5 - 459.67,2);
    }
}
