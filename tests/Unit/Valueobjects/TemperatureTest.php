<?php


namespace Tests\Unit\Valueobjects;


use App\Enums\TempScaleEnum;
use App\Exceptions\NegativeAbsoluteTemperatureException;
use App\Valueobjects\Temperature;
use Tests\TestCase;

class TemperatureTest extends TestCase
{

    /**
     * @test
     * @dataProvider celsius2celsiusProvider
     */
    public function set_up_in_celsius_and_get_in_celsius($inputTemp, $expectedOutput)
    {
        $inputScale = new TempScaleEnum('celsius');
        $outputScale = new TempScaleEnum('celsius');
        $temperature = Temperature::createFromScale($inputScale, $inputTemp);

        $this->assertEquals($expectedOutput, $temperature->getValue($outputScale));
    }

    public function celsius2celsiusProvider(): array
    {
        return [
            [
                'inputTemp' => 0,
                'expectedOutput' => 0,
            ],
            [
                'inputTemp' => 36.6,
                'expectedOutput' => 36.6,
            ],
            [
                'inputTemp' => -236,
                'expectedOutput' => -236,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider fahrenheit2fahrenheitProvider
     */
    public function set_up_in_fahrenheit_and_get_in_fahrenheit($inputTemp, $expectedOutput)
    {
        $inputScale = new TempScaleEnum('fahrenheit');
        $outputScale = new TempScaleEnum('fahrenheit');
        $temperature = Temperature::createFromScale($inputScale, $inputTemp);

        $this->assertEquals(round($expectedOutput), round($temperature->getValue($outputScale)));
    }

    public function fahrenheit2fahrenheitProvider(): array
    {
        return [
            [
                'inputTemp' => 0,
                'expectedOutput' => 0,
            ],
            [
                'inputTemp' => 36.6,
                'expectedOutput' => 36.6,
            ],
            [
                'inputTemp' => -236,
                'expectedOutput' => -236,
            ],
        ];
    }

    /**
     * @test
     * @dataProvider celsius2fahrenheitProvider
     */
    public function set_up_in_celsius_and_get_in_fahrenheit($inputTemp, $expectedOutput)
    {
        $inputScale = new TempScaleEnum('celsius');
        $outputScale = new TempScaleEnum('fahrenheit');
        $temperature = Temperature::createFromScale($inputScale, $inputTemp);

        $this->assertEquals(round($expectedOutput), round($temperature->getValue($outputScale)));
    }

    public function celsius2fahrenheitProvider(): array
    {
        return [
            [
                'inputTemp' => -50,
                'expectedOutput' => -58,
            ],
            [
                'inputTemp' => 0,
                'expectedOutput' => 32,
            ],
            [
                'inputTemp' => 8,
                'expectedOutput' => 46,
            ],
        ];
    }

    /**
     * @test
     */
    public function try_set_up_temperature_below_absolute_zero()
    {
        $this->expectException(NegativeAbsoluteTemperatureException::class);

        $inputScale = new TempScaleEnum('celsius');
        $temperature = Temperature::createFromScale($inputScale, -300);
    }
}
