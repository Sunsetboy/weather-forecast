<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * Available temperature scales
 * @method static TempScaleEnum KELVIN()
 * @method static TempScaleEnum CELSIUS()
 * @method static TempScaleEnum FAHRENHEIT()
 */
class TempScaleEnum extends Enum
{
    private const KELVIN = 'kelvin';
    private const CELSIUS = 'celsius';
    private const FAHRENHEIT = 'fahrenheit';
}
