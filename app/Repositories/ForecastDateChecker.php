<?php

namespace App\Repositories;

use App\Exceptions\InvalidForecastDateException;
use DateTime;

trait ForecastDateChecker
{
    /**
     * Checks if a date is not in past or distant future
     * @param DateTime $date
     * @throws InvalidForecastDateException
     * @todo extract limits to config
     */
    public function checkDate(DateTime $date): void
    {
        $today = (new DateTime())->setTime(0,0,0);
        $lastAvailableDate = (clone $today)->modify('+ 10 days');

        if ($date < $today) {
            throw new InvalidForecastDateException('Forecast date cannot be in past');
        }
        if ($date > $lastAvailableDate) {
            throw new InvalidForecastDateException('Forecast date cannot be in 10+ days');
        }
    }
}
