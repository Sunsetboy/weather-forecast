<?php


namespace Tests\Unit\Enums;


use App\Enums\TempScaleEnum;
use Tests\TestCase;
use UnexpectedValueException;

class TempScaleEnumTest extends TestCase
{
    /**
     * @test
     */
    public function set_valid_value()
    {
        $celsius = new TempScaleEnum('celsius');
        $this->assertEquals('celsius', $celsius->getValue());
    }

    /**
     * @test
     */
    public function try_to_set_invalid_value()
    {
        $this->expectException(UnexpectedValueException::class);
        $meters = new TempScaleEnum('meters');
    }
}
