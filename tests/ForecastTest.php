<?php

namespace Tests;

use DateTime;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ForecastTest extends TestCase
{
    /**
     * @test
     */
    public function get_forecast_for_existing_city()
    {
        $this->get('/forecast/Amsterdam')
            ->seeStatusCode(200);
    }

    /**
     * @test
     */
    public function get_forecast_for_existing_city_and_tomorrow_date()
    {
        $tomorrowDate = (new DateTime())->modify('+1 day')->format('Y-m-d');

        $this->get('/forecast/Amsterdam/' . $tomorrowDate)
            ->seeStatusCode(200);
    }
}
