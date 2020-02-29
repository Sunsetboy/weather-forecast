<?php

namespace Tests\Unit\Helpers;

use App\Enums\TempScaleEnum;
use App\Helpers\AverageTemperatureHelper;
use App\Valueobjects\Temperature;
use Tests\TestCase;

class AverageTemperatureHelperTest extends TestCase
{
    /**
     * @test
     */
    public function get_average_temperature_from_array()
    {
        $scale = TempScaleEnum::CELSIUS();
        $temperatures = [
            Temperature::createFromScale($scale, 10),
            Temperature::createFromScale($scale, 20),
        ];

        $averageTemperature = AverageTemperatureHelper::getAverageTemperature($temperatures);

        $this->assertEquals(15, $averageTemperature->getValue($scale));
    }

    /**
     * @test
     */
    public function try_to_get_average_temperature_from_empty_array()
    {
        $this->expectException(\Exception::class);
        AverageTemperatureHelper::getAverageTemperature([]);
    }
}
