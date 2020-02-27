<?php


namespace Tests\Unit\Strategies;

use App\Strategies\Celsius2KelvinStrategy;
use Tests\TestCase;

class Celsius2KelvinStrategyTest extends TestCase
{

    private $strategy;

    public function setUp(): void
    {
        $this->strategy = new Celsius2KelvinStrategy();
    }

    /** @test
     * @dataProvider c2kProvider
     */
    public function test_convert($celsius, $kelvin)
    {
        $this->assertEquals($kelvin, $this->strategy->convert($celsius));
    }

    public function c2kProvider():array
    {
        return [
            [
                'celsius' => -273.15,
                'kelvin' => 0,
            ],
            [
                'celsius' => 0,
                'kelvin' => 273.15,
            ],
        ];
    }

    /** @test
     * @dataProvider k2cProvider
     */
    public function test_invert($kelvin, $celsius)
    {
        $this->assertEquals($celsius, $this->strategy->invert($kelvin));
    }

    public function k2cProvider():array
    {
        return [
            [
                'kelvin' => 0,
                'celsius' => -273.15,
            ],
            [
                'kelvin' => 273.15,
                'celsius' => 0,
            ],
        ];
    }
}
