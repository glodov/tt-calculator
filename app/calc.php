<?php
/**
 * Basic functions and classes.
 *
 * Php Version 7.2
 *
 * @category Application
 * @package  Application
 * @author   Yaro <glodov@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/glodov/tt-calculator
 */

require __DIR__ . '/includes/init.php';

$input = isset($argv[1]) ? $argv[1] : false;
$calc = new TTCalendar\Calc\ScienceCalculator($input);

if (false !== $input) {
    printf("> %s\n", $calc->result);
    return;
}

do {

    $line = trim(fgets(STDIN));

    $calc->calc($line);
    printf("> %s\n", json_encode($calc->result));

} while ('' !== $line);

