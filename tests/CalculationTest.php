<?php

/**
 * CalculcationTest
 * 
 * PHP Version 7
 * 
 * @category QA
 * @package  Tests
 * @author   Yaro <i@yaro.info>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://yaro.info
 */
use PHPUnit\Framework\TestCase;

use TT\Calculator\CalculatorInterface;
use TT\Calculator\LoopCalculator;
use TT\Calculator\IncrementCalculator;
use TT\Calculator\SimpleCalculator;

// namespace Tests;
/**
 * CalculcationTest
 * 
 * @category QA
 * @package  Tests
 * @author   Yaro <i@yaro.info>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://yaro.info
 * 
 * @final
 */
final class CalculcationTest extends TestCase
{
    /**
     * Returns objects as a data provider
     *
     * @return array
     */
    public function classesProvider() : array
    {
        return [
            [new LoopCalculator],
            [new IncrementCalculator],
            [new SimpleCalculator],
        ];
    }

    /**
     * Returns calculations for tests
     *
     * @return array
     */
    public function calculationsProvider() : array
    {
        $loop = new LoopCalculator;
        $incr = new IncrementCalculator;
        $simp = new SimpleCalculator;

        return [
            [$loop, 1, 5, 'add', 6],
            [$loop, 1, 5, 'minus', -4],
            [$loop, 1, 5, 'multiply', 5],
            [$loop, 1, 5, 'divide', 0],
            [$loop, 1, 5, 'percent', 0],

            [$loop, 100, 15, 'add', 115],
            [$loop, 100, 15, 'minus', 85],
            [$loop, 100, 15, 'multiply', 1500],
            [$loop, 100, 15, 'divide', 7],
            [$loop, 100, 15, 'percent', 15],

            [$incr, 1, 5, 'add', 6],
            [$incr, 1, 5, 'minus', -4],
            [$incr, 1, 5, 'multiply', 5],
            [$incr, 1, 5, 'divide', 0],
            [$incr, 1, 5, 'percent', 0],

            [$incr, 100, 15, 'add', 115],
            [$incr, 100, 15, 'minus', 85],
            [$incr, 100, 15, 'multiply', 1500],
            [$incr, 100, 15, 'divide', 7],
            [$incr, 100, 15, 'percent', 15],

            [$simp, 1, 5, 'add', 6],
            [$simp, 1, 5, 'minus', -4],
            [$simp, 1, 5, 'multiply', 5],
            [$simp, 1, 5, 'divide', 0],
            [$simp, 1, 5, 'percent', 0],

            [$simp, 100, 15, 'add', 115],
            [$simp, 100, 15, 'minus', 85],
            [$simp, 100, 15, 'multiply', 1500],
            [$simp, 100, 15, 'divide', 7],
            [$simp, 100, 15, 'percent', 15],
        ];
    }

    /**
     * Test if calculator classes are instances of CalculatorInterface
     *
     * @param object $class The object to test.
     * 
     * @dataProvider classesProvider
     * 
     * @return void
     */
    public function atestInterfaces(object $class) : void
    {
        $this->assertInstanceOf(
            CalculatorInterface::class,
            $class
        );
    }

    /**
     * Test if calculator classes are instances of CalculatorInterface
     *
     * @param CalculatorInterface $calc     The calculator object.
     * @param int                 $a        The first input value ($a * b).
     * @param int                 $b        The second input value (a * $b).
     * @param string              $method   The method: [add|minus|multiply|divide|percent].
     * @param int                 $expected The expected result.
     * 
     * @dataProvider calculationsProvider
     * 
     * @return void
     */
    public function testCalculations(
        CalculatorInterface $calc, 
        int $a, 
        int $b, 
        string $method, 
        int $expected
    ) : void {
        $calc->set($a);
        $actual = call_user_func_array([$calc, $method], [$b]);

        $this->assertSame(
            $expected, 
            $actual, 
            get_class($calc) . " failed calculation in $method($a, $b)"
        );
        return;
    }
}