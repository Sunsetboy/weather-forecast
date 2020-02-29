<?php


namespace App\Services;

use App\Enums\TempScaleEnum;
use App\Helpers\AverageTemperatureHelper;
use App\Repositories\ForecastProviderInterface;
use App\Valueobjects\Forecast;
use DateTime;
use Illuminate\Support\Facades\Cache;

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
        $cacheKey = $town . $date->format('Y-m-d');
        $forecast = Cache::get($cacheKey);

        if ($forecast instanceof Forecast) {
            return $forecast;
        }

        $forecasts = [];
        $averageTemperatures = [];
        $temperaturesByTime = [];
        $currentTime = (clone $date)->setTime((int)$date->format('H'), 0, 0);
        $nextDayBegin = (clone $date)->modify('next day midnight');

        foreach ($this->providers as $forecastProvider) {
            $forecastDate = clone $date;
            $forecasts[] = $forecastProvider->getForecast($town, $forecastDate, $temperatureScale);
        }

        while ($currentTime < $nextDayBegin) {
            $currentTimeString = $currentTime->format('Y-m-d H:i:s');
            $temperaturesByTime[$currentTimeString] = [];

            foreach ($forecasts as $forecast) {
                /** @var Forecast $forecast */
                $forecastTemperatures = $forecast->getTemperatures();
                $temperaturesByTime[$currentTimeString][] = $forecastTemperatures[$currentTimeString];
            }

            // calculate an average temperature for each hour
            $averageTemperatures[$currentTimeString] = AverageTemperatureHelper::getAverageTemperature($temperaturesByTime[$currentTimeString]);

            $currentTime->modify('+1 hour');
        }

        $forecast = new Forecast($averageTemperatures, $town);
        Cache::put($cacheKey, $forecast, config('app.forecast_cache_ttl'));

        return $forecast;
    }

    /**
     * @return ForecastProviderInterface[]
     */
    public function getProviders(): array
    {
        return $this->providers;
    }

    /**
     * @param ForecastProviderInterface[] $providers
     * @return ForecastService
     */
    public function setProviders(array $providers): ForecastService
    {
        $this->providers = $providers;

        return $this;
    }
}
