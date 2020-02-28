<?php


namespace App\Services;

use App\Enums\TempScaleEnum;
use App\Repositories\ForecastProviderInterface;
use App\Valueobjects\Forecast;
use DateTime;

/**
 * Business logic of getting all forecast from different providers together
 * @todo implement dependency injection
 */
class ForecastService
{
    /** @var ForecastProviderInterface[] */
    private $providers;

    public function __construct()
    {
//        dd(config('forecast_providers.providers.bbc'));

        foreach (config('forecast_providers.providers') as $providerName => $providerConfig) {
            if ($providerConfig['enabled'] == true) {
                $this->providers[] = app($providerConfig['class']);
            }
        }
    }

    /**
     * Aggregates data from different providers
     * @param string $town
     * @param DateTime $date
     * @param TempScaleEnum $temperatureScale
     * @return Forecast
     * @throws \Exception
     */
    public function getForecast($town, $date, $temperatureScale): Forecast
    {
        $forecasts = [];

        foreach ($this->providers as $forecastProvider) {
            $forecasts[] = $forecastProvider->getForecast($town, $date, $temperatureScale);
        }

        return new Forecast([], $town);
    }
}
