<?php

namespace Tests\Unit\Valueobjects;

use App\Enums\TempScaleEnum;
use App\Valueobjects\Forecast;
use App\Valueobjects\Temperature;
use DateTime;
use Tests\TestCase;

class ForecastTest extends TestCase
{
    /**
     * @test
     */
    public function test_constructor_and_getters()
    {
        $now = new DateTime();
        $town = 'Rotterdam';
        $temperatures = [
            '2020-03-01 14:00:00' => Temperature::createFromScale(new TempScaleEnum('celsius'), 20),
        ];

        $forecast = new Forecast($temperatures, $town);

        $this->assertEquals($town, $forecast->getTown());
        $this->assertEquals($temperatures, $forecast->getTemperatures());
        $this->assertEquals($now->format('Y-m-d H:i:s'), $forecast->getCreateTs()->format('Y-m-d H:i:s'));
    }
}
