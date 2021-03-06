<?php

namespace App\Valueobjects;

use App\Enums\TempScaleEnum;
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

    /**
     * @param TempScaleEnum $scale
     * @return array
     * @throws \Exception
     */
    public function toArray(TempScaleEnum $scale): array
    {
        $temperatures = [];
        foreach ($this->temperatures as $datetime => $temperature) {
            $temperatures[$datetime] = (int)round($temperature->getValue($scale));
        }

        return [
            'town' => $this->town,
            'created' => $this->createTs->format('Y-m-d H:i:s'),
            'temperatures' => $temperatures,
        ];
    }
}
