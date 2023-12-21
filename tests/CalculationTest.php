<?php

namespace Dmattern\Similar\Tests;

use Dmattern\Jaccard\Similar;
use PHPUnit\Framework\TestCase;

class CalculationTest extends TestCase
{
    public static function providesCalculationTestData(): array
    {
        return [
            'not the same' => ['a', 'b', ' ', 0],
            'the same' => ['a', 'a', ' ', 1],
            '1 of 2 parts matches in each' => ['a,b', 'b,c', ',', 1/3],
            '1 part matches from 1 side' => ['a b', 'b', ' ', .5],
        ];
    }

    /**
     * @param string $first
     * @param string $second
     * @param string $separator
     * @param float $result
     * @return void
     * @dataProvider providesCalculationTestData
     * @covers Similar::calculate()
     */
    public function testCalculation(
        string $first,
        string $second,
        string $separator,
        float $result,
    ): void {
        $this->assertEquals(
            $result,
            Similar::calculate($first, $second, $separator),
        );
    }

    /**
     * @return void
     * @covers Similar::calculate()
     */
    public function testEmptySeparatorFails(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Similar::calculate('a', 'b', '');
    }
}