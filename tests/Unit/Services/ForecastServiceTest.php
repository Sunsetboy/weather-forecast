<?php

namespace Tests\Unit\Services;

use App\Enums\TempScaleEnum;
use App\Repositories\BBCForecastProvider;
use App\Repositories\IAmSterdamForecastProvider;
use App\Services\ForecastService;
use App\Valueobjects\Forecast;
use App\Valueobjects\Temperature;
use DateTime;
use Tests\TestCase;

class ForecastServiceTest extends TestCase
{
    /**
     * @test
     */
    public function test_constructor()
    {
        $forecastProvidersConfig = [
            'provider1' => [
                'enabled' => true,
                'class' => \App\Repositories\IAmSterdamForecastProvider::class,
            ],
            'provider2' => [
                'enabled' => false,
                'class' => \App\Repositories\BBCForecastProvider::class
            ],
        ];

        $forecastService = new ForecastService($forecastProvidersConfig);
        $this->assertEquals(1, count($forecastService->getProviders()));
    }

    /**
     * @test
     */
    public function set_and_get_providers()
    {
        $forecastProviders = [
            $this->createMock(BBCForecastProvider::class),
            $this->createMock(BBCForecastProvider::class),
            $this->createMock(IAmSterdamForecastProvider::class),
        ];

        $forecastService = new ForecastService([]);
        $forecastService->setProviders($forecastProviders);

        $this->assertEquals($forecastProviders, $forecastService->getProviders());
    }

    /**
     * @test
     */
    public function get_forecast()
    {
        // we want to get a forecast for a given date and time
        $date = (new DateTime())->modify('+1 day')->setTime(21, 20, 0);
        $temperatureScaleCelsius = new TempScaleEnum('celsius');
        $temperatureScaleFahrenheit = new TempScaleEnum('fahrenheit');

        $mockedForecastProviders = $this->createForecastMocks($date, $temperatureScaleCelsius);

        $forecastService = new ForecastService([]);
        $forecastService->setProviders($mockedForecastProviders);

        $forecastCelsius = $forecastService->getForecast('Amsterdam', $date, $temperatureScaleCelsius);
        $forecastFahrenheit = $forecastService->getForecast('Amsterdam', $date, $temperatureScaleFahrenheit);

        $forecastAsArrayInCelsius = $forecastCelsius->toArray($temperatureScaleCelsius);
        $forecastAsArrayInFahrenheit = $forecastFahrenheit->toArray($temperatureScaleFahrenheit);

        $this->assertEquals('Amsterdam', $forecastAsArrayInCelsius['town']);

        $expectedTemperaturesCelsius = [
            "2020-03-01 21:00:00" => 11,
            "2020-03-01 22:00:00" => 9,
            "2020-03-01 23:00:00" => 5,
        ];

        $expectedTemperaturesFahrenheit = [
            "2020-03-01 21:00:00" => 51.8,
            "2020-03-01 22:00:00" => 48.2,
            "2020-03-01 23:00:00" => 41,
        ];

        $this->assertEquals($expectedTemperaturesCelsius, $forecastAsArrayInCelsius['temperatures']);
        $this->assertEquals($expectedTemperaturesFahrenheit, $forecastAsArrayInFahrenheit['temperatures']);
    }

    /**
     * Creates mocked forecast providers. BBC gives a forecast with higher temperature than iamsterdam
     * @param DateTime $date
     * @param TempScaleEnum $temperatureScaleCelsius
     * @return array
     * @throws \App\Exceptions\NegativeAbsoluteTemperatureException
     */
    private function createForecastMocks(DateTime $date, TempScaleEnum $temperatureScaleCelsius): array
    {
        $bbcForecastProviderMock = $this->createMock(BBCForecastProvider::class);
        $iamsterdamForecastProviderMock = $this->createMock(IAmSterdamForecastProvider::class);

        $bbcForecastMock = $this->createMock(Forecast::class);
        $bbcForecastMock->method('getTown')->willReturn('Amsterdam');
        $bbcForecastTemperatures = [
            (clone $date)->setTime(21, 0, 0)->format('Y-m-d H:i:s') => Temperature::createFromScale($temperatureScaleCelsius, 10),
            (clone $date)->setTime(22, 0, 0)->format('Y-m-d H:i:s') => Temperature::createFromScale($temperatureScaleCelsius, 8),
            (clone $date)->setTime(23, 0, 0)->format('Y-m-d H:i:s') => Temperature::createFromScale($temperatureScaleCelsius, 6),
        ];
        $bbcForecastMock->method('getTemperatures')->willReturn($bbcForecastTemperatures);
        $bbcForecastProviderMock->method('getForecast')->willReturn($bbcForecastMock);

        $iamsterdamForecastMock = $this->createMock(Forecast::class);
        $iamsterdamForecastMock->method('getTown')->willReturn('Amsterdam');
        $iamsterdamForecastTemperatures = [
            (clone $date)->setTime(21, 0, 0)->format('Y-m-d H:i:s') => Temperature::createFromScale($temperatureScaleCelsius, 12),
            (clone $date)->setTime(22, 0, 0)->format('Y-m-d H:i:s') => Temperature::createFromScale($temperatureScaleCelsius, 10),
            (clone $date)->setTime(23, 0, 0)->format('Y-m-d H:i:s') => Temperature::createFromScale($temperatureScaleCelsius, 4),
        ];
        $iamsterdamForecastMock->method('getTemperatures')->willReturn($iamsterdamForecastTemperatures);
        $iamsterdamForecastProviderMock->method('getForecast')->willReturn($iamsterdamForecastMock);

        return [
            $bbcForecastProviderMock,
            $iamsterdamForecastProviderMock,
        ];
    }
}
