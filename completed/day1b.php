<?php

require_once('classes/Utility.class.php');
require_once('classes/Module.class.php');

/**
 * Test input
 */
$module_test_1 = new Module(12);
assert($module_test_1->getFuelRequirementIncludingFuel() === 2);

$module_test_2 = new Module(14);
assert($module_test_2->getFuelRequirementIncludingFuel() === 2);

$module_test_3 = new Module(1969);
assert($module_test_3->getFuelRequirementIncludingFuel() === 966);

$module_test_4 = new Module(100756);
assert($module_test_4->getFuelRequirementIncludingFuel() === 50346);

/**
 * Real input
 */
$day1a_input = fopen('puzzle_input/day1.txt', 'r');

$fuel_total = 0;
while (!feof($day1a_input)) {
    $module_weight = fgets($day1a_input);

    if (false !== $module_weight) {
        $module_weight = (int) $module_weight;

        $module = new Module($module_weight);
        $fuel = $module->getFuelRequirementIncludingFuel();

        //Utility::log('Module weight: ' . $module_weight . ', needs ' . $fuel . ' fuel');

        $fuel_total += $fuel;
    }
}

Utility::log('Answer: ' . $fuel_total);
