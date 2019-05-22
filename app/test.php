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

$calc = new TTCalendar\Calc\ScienceCalculator;

print("--- Calculator tests ---\n\n");

$rows = [
    ['2 * Pi + 100', 2 * M_PI + 100],
    ['var a = 5', true],
    ['var b = 7.1', true],
    ['var x = a * b', true],
    ['x + 100', 5 * 7.1 + 100],
    ['(2 + 2) * 2', 8],
];

$result = false;
foreach ($rows as $row) {
    printf("-- %s\n", $row[0]);
    $result = $calc->calc($row[0]);
    if ($row[1] === $result) {
        printf(" > %s\n", json_encode($result));
    } else {
        printf("\e[31m%s\e[0m\n\n", $calc);
    }
}

print("\n\n--- CLI tests ---\n\n");

$rows = [
    ['5 * 7.1 + 100', '> ' . (5 * 7.1 + 100)],
    ['(2 + 2) * 2', '> 8'],
];

$result = false;
foreach ($rows as $row) {
    printf("-- %s\n", $row[0]);
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'calc.php';
    exec('php ' . $file . ' "' . $row[0] . '"', $output);
    $result = end($output);
    if ($row[1] === $result) {
        printf("%s\n", json_encode($result));
    } else {
        printf("\e[31m%s\e[0m\n\n", $calc);
    }
}

print("\n\n");
