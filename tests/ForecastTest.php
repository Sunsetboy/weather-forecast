<?php

namespace Tests;

use DateTime;

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

    /**
     * @test
     */
    public function try_get_forecast_for_yesterday()
    {
        $tomorrowDate = (new DateTime())->modify('-1 day')->format('Y-m-d');

        $this->get('/forecast/Amsterdam/' . $tomorrowDate)
            ->seeStatusCode(400);
    }

    /**
     * @test
     */
    public function try_get_forecast_for_distant_future()
    {
        $tomorrowDate = (new DateTime())->modify('+100 day')->format('Y-m-d');

        $this->get('/forecast/Amsterdam/' . $tomorrowDate)
            ->seeStatusCode(400);
    }

    /**
     * @test
     */
    public function try_get_forecast_with_unsupported_temperature_scale()
    {
        $this->get('/forecast/Amsterdam?scale=meters')
            ->seeStatusCode(400);
    }
}
