<?php


namespace App\Services;

use App\Enums\TempScaleEnum;
use App\Repositories\ForecastProviderInterface;
use App\Valueobjects\Forecast;
use DateTime;

/**
 * Business logic of getting all forecast from different providers together
 */
class ForecastService
{
    /** @var ForecastProviderInterface[] */
    private $providers;

    public function __construct(array $forecastProvidersConfig)
    {
        foreach ($forecastProvidersConfig as $providerName => $providerConfig) {
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

    /**
     * @return ForecastProviderInterface[]
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}
