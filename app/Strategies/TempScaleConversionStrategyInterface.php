<?php

namespace App\Strategies;

interface TempScaleConversionStrategyInterface
{
    public function convert(float $fromValue): float;

    public function invert(float $fromValue): float;
}
