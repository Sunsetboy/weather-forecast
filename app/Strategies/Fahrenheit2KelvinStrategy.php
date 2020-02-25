<?php


namespace App\Strategies;


class Fahrenheit2KelvinStrategy implements TempScaleConversionStrategyInterface
{
    public function convert(float $fromValue): float
    {
        return ($fromValue + 459.67) * 5 / 9;
    }

    public function invert(float $fromValue): float
    {
        return $fromValue * 9 / 5 - 459.67;
    }
}
