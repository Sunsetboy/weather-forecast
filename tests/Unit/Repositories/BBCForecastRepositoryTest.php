<?php

namespace Tests\Unit\Repositories;

use App\Enums\TempScaleEnum;
use App\Repositories\BBCForecastProvider;
use App\Valueobjects\Forecast;
use DateTime;
use Tests\TestCase;

class BBCForecastRepositoryTest extends TestCase
{

    /**
     * @test
     * @dataProvider getForecastProvider
     */
    public function test_get_forecast($forecastDate, $expectedHours)
    {
        $mockForecastRepository = new BBCForecastProvider('test.local', '122');

        $forecast = $mockForecastRepository->getForecast('Rotterdam', $forecastDate, TempScaleEnum::CELSIUS());

        $this->assertInstanceOf(Forecast::class, $forecast);
        $this->assertEquals($expectedHours, count($forecast->getTemperatures()));
    }

    public function getForecastProvider(): array
    {
        return [
            [
                'forecastDate' => (new DateTime())->setTime(0, 0, 0),
                'expectedHours' => 24,
            ],
            [
                'forecastDate' => (new DateTime())->setTime(18, 0, 0),
                'expectedHours' => 6,
            ],
            [
                'forecastDate' => (new DateTime())->setTime(18, 30, 0),
                'expectedHours' => 6,
            ]
        ];
    }
}
