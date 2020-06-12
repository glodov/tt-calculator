<?php
/**
 * Basic functions and classes.
 *
 * Php Version 7.2
 *
 * @category Application
 * @package  Core
 * @author   Yaro <glodov@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/glodov/tt-calculator
 */

namespace TTCalendar;

/**
 * Autoload standard method.
 * 
 * @return void
 */
// phpcs:ignore
spl_autoload_register(function ($className) {
    if (class_exists($className)) {
        return true;
    }
    $file = preg_replace('/^TTCalendar\\\/', '', $className);
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    $file = __DIR__ . DIRECTORY_SEPARATOR . "$file.php";

    if (!file_exists($file)) {
        throw new \Exception("Error including file: $file", 1);
    }

    include $file;
// phpcs:ignore
});
