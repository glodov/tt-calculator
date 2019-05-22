<?php
/**
 * Science Calculator class with it's logic.
 *
 * Php Version 7.2
 *
 * @category Application
 * @package  Calculator
 * @author   Yaro <glodov@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/glodov/tt-calculator
 */
namespace TTCalendar\Calc;

/**
 * Calculator class with it's logic and predefined constants.
 *
 * @category Application
 * @package  Calculator
 * @author   Yaro <glodov@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/glodov/tt-calculator
 */
class ScienceCalculator extends Calculator
{
    /**
     * Math expression to calculate/evaluate.
     *
     * @param string $input The math expression.
     */
    public function __construct($input = '')
    {
        // predefined variables
        $this->define('E', M_E);
        $this->define('Pi', M_PI);
        
        parent::__construct($input);
    }
}
