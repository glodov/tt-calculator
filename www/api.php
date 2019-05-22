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
use TTCalendar\Calc\ScienceCalculator;

require __DIR__ . '/../app/includes/init.php';

// check input data
// Method: GET, POST, PUT, DELETE
// Data

switch ($_SERVER['REQUEST_METHOD']) {
case 'POST':
    $input = file_get_contents("php://input");
    $calc = new ScienceCalculator($input);

    header("Content-Type: application/json");
    echo json_encode($calc);
    return;
}