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
        $forecastDatetime = (new DateTime())->setTime(14, 0, 0);
        $town = 'Rotterdam';
        $temperature = Temperature::createFromScale(new TempScaleEnum('celsius'), 20);

        $forecast = new Forecast($temperature, $forecastDatetime, $town);

        $this->assertEquals($forecastDatetime, $forecast->getDatetime());
        $this->assertEquals($town, $forecast->getTown());
        $this->assertEquals($temperature, $forecast->getTemperature());
        $this->assertEquals($now->format('Y-m-d H:i:s'), $forecast->getCreateTs()->format('Y-m-d H:i:s'));
    }
}
