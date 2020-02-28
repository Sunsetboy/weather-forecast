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
        $forecastService = new ForecastService();

    }
}
