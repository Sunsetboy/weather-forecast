<?php

namespace App\Valueobjects;

use App\Enums\TempScaleEnum;
use App\Exceptions\NegativeAbsoluteTemperatureException;
use App\Strategies\ScaleConversionStrategyResolver;

class Temperature
{
    /** @var float */
    private $valueInKelvins;

    /**
     * @param float $valueInKelvins
     * @throws NegativeAbsoluteTemperatureException
     */
    private function __construct(float $valueInKelvins)
    {
        if ($valueInKelvins < 0) {
            throw new NegativeAbsoluteTemperatureException('Temperature is too low');
        }
        $this->valueInKelvins = $valueInKelvins;
    }

    /**
     * @param TempScaleEnum $scale
     * @param float $value
     * @return Temperature
     * @throws NegativeAbsoluteTemperatureException
     */
    public static function createFromScale(TempScaleEnum $scale, float $value): Temperature
    {
        $conversionStrategy = (new ScaleConversionStrategyResolver())->resolve($scale);

        $valueInKelvins = $conversionStrategy->convert($value);

        return new self($valueInKelvins);
    }

    /**
     * Returns a value in a specified scale
     * @param TempScaleEnum $scale
     * @return float
     * @throws \Exception
     */
    public function getValue(TempScaleEnum $scale): float
    {
        $conversionStrategy = (new ScaleConversionStrategyResolver())->resolve($scale);

        return $conversionStrategy->invert($this->valueInKelvins);
    }
}
