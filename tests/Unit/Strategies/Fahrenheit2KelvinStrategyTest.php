<?php


namespace Tests\Unit\Strategies;

use App\Strategies\Fahrenheit2KelvinStrategy;
use Tests\TestCase;

class Fahrenheit2KelvinStrategyTest extends TestCase
{

    private $strategy;

    public function setUp(): void
    {
        $this->strategy = new Fahrenheit2KelvinStrategy();
    }

    /** @test
     * @dataProvider f2kProvider
     */
    public function test_convert($fahrenheit, $kelvin)
    {
        $this->assertEquals($kelvin, $this->strategy->convert($fahrenheit));
    }

    public function f2kProvider():array
    {
        return [
            [
                'fahrenheit' => -459.67,
                'kelvin' => 0,
            ],
            [
                'fahrenheit' => 0,
                'kelvin' => 255.37,
            ],
        ];
    }

    /** @test
     * @dataProvider k2fProvider
     */
    public function test_invert($kelvin, $fahrenheit)
    {
        $this->assertEquals($fahrenheit, $this->strategy->invert($kelvin));
    }

    public function k2fProvider():array
    {
        return [
            [
                'kelvin' => 0,
                'fahrenheit' => -459.67,
            ],
            [
                'kelvin' => 255.37,
                'fahrenheit' => 0,
            ],
        ];
    }
}
