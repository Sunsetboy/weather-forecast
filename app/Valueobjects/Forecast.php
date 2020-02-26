<?php

namespace App\Valueobjects;

use DateTime;

/**
 * A representation of temperature at certain moment in a certain town
 */
class Forecast
{
    /** @var Temperature */
    private $temperature;

    /** @var DateTime */
    private $datetime;

    /** @var string */
    private $town;

    /** @var DateTime */
    private $createTs;

    public function __construct(Temperature $temperature, DateTime $datetime, string $town)
    {
        $this->temperature = $temperature;
        $this->datetime = $datetime;
        $this->town = $town;
        $this->createTs = new DateTime();
    }

    /**
     * @return Temperature
     */
    public function getTemperature(): Temperature
    {
        return $this->temperature;
    }

    /**
     * @return DateTime
     */
    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @return DateTime
     */
    public function getCreateTs(): DateTime
    {
        return $this->createTs;
    }
}
