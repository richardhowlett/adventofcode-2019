<?php

require_once('classes/Utility.class.php');
require_once('classes/IntcodeComputer.class.php');

/**
 * Test input
 */
$intcode_program_test_1 = new IntcodeComputer([1,0,0,0,99]);
assert($intcode_program_test_1->process() === [2,0,0,0,99]);

$intcode_program_test_2 = new IntcodeComputer([2,3,0,3,99]);
assert($intcode_program_test_2->process() === [2,3,0,6,99]);

$intcode_program_test_3 = new IntcodeComputer([2,4,4,5,99,0]);
assert($intcode_program_test_3->process() === [2,4,4,5,99,9801]);

$intcode_program_test_4 = new IntcodeComputer([1,1,1,4,99,5,6,0,99]);
assert($intcode_program_test_4->process() === [30,1,1,4,2,5,6,0,99]);

/**
 * Real input
 */
$day2_input = file_get_contents('puzzle_input/day2.txt', 'r');

// modify the starting input
$day2_input = explode(',', $day2_input);
$day2_input[1] = 12;
$day2_input[2] = 2;

$intcode_program = new IntcodeComputer($day2_input);
$result = $intcode_program->process();
Utility::log('Answer: ' . $result[0]);
