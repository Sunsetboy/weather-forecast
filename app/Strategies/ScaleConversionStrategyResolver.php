<?php

namespace App\Strategies;

use App\Enums\TempScaleEnum;

class ScaleConversionStrategyResolver
{
    /**
     * @param TempScaleEnum $scale
     * @return TempScaleConversionStrategyInterface
     * @throws \Exception
     */
    public function resolve(TempScaleEnum $scale): TempScaleConversionStrategyInterface
    {
        switch ($scale) {
            case TempScaleEnum::CELSIUS():
                return new Celsius2KelvinStrategy();
                break;
            case TempScaleEnum::FAHRENHEIT():
                return new Fahrenheit2KelvinStrategy();
                break;
        }

        throw new \Exception('Unknown temperature scale');
    }
}
