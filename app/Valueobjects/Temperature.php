<?php

namespace App\Valueobjects;

use App\Exceptions\NegativeAbsoluteTemperatureException;

class Temperature
{
    /** @var float */
    private $valueInKelvins;

    /**
     * @param float $valueInKelvins
     * @throws NegativeAbsoluteTemperatureException
     */
    public function __construct(float $valueInKelvins)
    {
        if ($valueInKelvins < 0) {
            throw new NegativeAbsoluteTemperatureException('Temperature is too low');
        }
        $this->valueInKelvins = $valueInKelvins;
    }
}
