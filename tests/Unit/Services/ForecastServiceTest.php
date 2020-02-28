<?php

namespace Tests\Unit\Services;

use App\Services\ForecastService;
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
}
