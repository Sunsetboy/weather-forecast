<?php

namespace App\Valueobjects;

use DateTime;

/**
 * Forecast for a day and a town
 */
class Forecast
{
    /**
     * @var Temperature[]
     * Associative array with keys in format 'Y-m-d H:i:s'
     */
    private $temperatures;

    /** @var string */
    private $town;

    /** @var DateTime */
    private $createTs;

    public function __construct(array $temperatures, string $town)
    {
        $this->temperatures = $temperatures;
        $this->town = $town;
        $this->createTs = new DateTime();
    }

    /**
     * @return Temperature[]
     */
    public function getTemperatures(): array
    {
        return $this->temperatures;
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

    public function toArray(): array
    {
        return [
            'town' => $this->town,
            'created' => $this->createTs->format('Y-m-d H:i:s')
        ];
    }
}
