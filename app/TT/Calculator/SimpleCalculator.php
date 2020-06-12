<?php

/**
 * Simple Calculator class.
 * 
 * PHP Version 7
 * 
 * @category Interface
 * @package  Calculator
 * @author   Yaro <i@yaro.info>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://yaro.info
 */
namespace TT\Calculator;

/**
 * Simple Calculator class.
 * 
 * PHP Version 7
 * 
 * @category Interface
 * @package  Calculator
 * @author   Yaro <i@yaro.info>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://yaro.info
 */
class SimpleCalculator extends Calculator implements CalculatorInterface
{
    /**
     * Returns a result of minus function by $value.
     *
     * @param int $value The value to minus.
     * 
     * @return int
     */
    public function minus(int $value) : int
    {
        return $this->result -= $value;
    }

    /**
     * Returns a result of add function by $value.
     *
     * @param int $value The value to add.
     * 
     * @return int
     */
    public function add(int $value) : int
    {
        return $this->result += $value;
    }

    /**
     * Returns a result of multiply function by $value.
     *
     * @param int $value The value to multiply.
     * 
     * @return int
     */
    public function multiply(int $value) : int
    {
        return $this->result *= $value;
    }

    /**
     * Returns a result of divide function by $value.
     *
     * @param int $value The value to divide.
     * 
     * @return int
     */
    public function divide(int $value) : int
    {
        return $this->result = round($this->result / $value);
    }

    /**
     * Returns a result of percent function by $value.
     *
     * @param int $value The value to percent.
     * 
     * @return int
     */
    public function percent(int $value) : int
    {
        return $this->result = round($value * $this->result / 100);
    }

}