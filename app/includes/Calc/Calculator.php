<?php
/**
 * Calculator class with it's logic.
 *
 * Php Version 7.2
 *
 * @category Application
 * @package  Core
 * @author   Yaro <glodov@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/glodov/tt-calculator
 */
namespace TTCalendar\Calc;

/**
 * Calculator class with it's logic.
 *
 * @category Application
 * @package  Core
 * @author   Yaro <glodov@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/glodov/tt-calculator
 */
class Calculator
{
    public $result;
    public $input;
    public $error;
    protected $vars = [];

    /**
     * Math expression to calculate/evaluate.
     *
     * @param string $input The math expression.
     */
    public function __construct($input = '')
    {
        $this->calc($input);
    }

    /**
     * Make the magic math calculation.
     * Remember all definitions:
     *   var $x = 6
     *   $x * 2
     * Use E and Pi
     *   E * 5
     *   2 * Pi + 10
     * 
     * @param string $input The input expressions to evaluate.
     *
     * @return mixed         The result or FALSE on error
     *                       TRUE on defining variables.
     */
    public function calc($input = '')
    {
        // defining default values
        $this->result = false;
        $this->error  = false;
        $this->input  = trim($input);

        $input = $this->input($this->input);

        // handle error Divison by ZERO
        // try/catch does not work
        // phpcs:ignore
        set_error_handler(function ($no, $str, $file, $context) {
            $name = preg_quote(__FILE__, '/');
            $expr = "/^" . $name . "\(.+: eval\(\)\'d code$/";
            $eval = preg_match($expr, $file);
            if ($eval) {
                $this->error = $context;
            } else {
                throw new \Exception($str);
            }
        // phpcs:ignore
        });

        if ('' === $input) {
            $this->result = true;
            return true;
        }
        try {
            $input = preg_replace('/([a-z]+)/i', '\$$1', $input);
            extract($this->vars);
            $input = 'return ' . $input . ';';
            $this->result = eval($input);
        } catch (\ParseError $e) {
            $this->error = $e->getMessage();
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
        return $this->result;
    }

    /**
     * Input a string as an expression.
     * 
     * @param string $string The expression.
     * 
     * @return string        The formatted expression.
     */
    protected function input(string $string) : string
    {
        // definitions, limit to one small (low case) letters only
        // var a = 5     - TRUE
        // var b = 7.1   - TRUE
        // var x = a * b - TRUE
        // x + 100       - 135.5
        if (preg_match('/var\s+([a-z]{1})\s*=\s*(.+)/s', $string, $matches)) {
            $name  = $matches[1];
            $value = $matches[2];

            if (is_numeric($value)) {
                $value = $value == intval($value)
                         ? intval($value) 
                         : floatval($value);
            } else if (is_string($value)) {
                // defined as
                //   var x = a * b
                $var = clone $this;
                $value = $var->calc($value);
            }

            $this->define($name, $value);

            return '';
        }

        // remove spaces
        $string = preg_replace('/\s+/', '', $string);
        return $string;
    }

    /**
     * Define a variable or change the value of existent already.
     * 
     * @param string $name  The name of variable.
     * @param number $value The value.
     * 
     * @return bool         TRUE if existent, FALSE if new.
     */
    public function define(string $name, $value) : bool
    {
        $result = array_key_exists($name, $this->vars);
        $this->vars[$name] = $value;
        return $result;
    }

    /**
     * Magic function to return string view of current object.
     * 
     * @return string The object data.
     */
    public function __toString() : string
    {
        return sprintf(
            "Vars  } %s\n--\nInput  } %s\nResult } %s\nError! } %s",
            json_encode($this->vars, JSON_PRETTY_PRINT),
            $this->input,
            json_encode($this->result, JSON_PRETTY_PRINT),
            $this->error
        );
    }
}
