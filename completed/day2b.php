<?php

require_once('classes/Utility.class.php');
require_once('classes/IntcodeComputer.class.php');

/**
 * Real input
 */
$day2_input = file_get_contents('puzzle_input/day2.txt', 'r');

// modify the starting input
$day2_input = explode(',', $day2_input);

$intcode_computer = new IntcodeComputer($day2_input);

for($i = 0; $i < 100; $i++) {
    for($j = 0; $j < 100; $j++) {
        $program = $day2_input;
        $program[1] = $i;
        $program[2] = $j;

        $intcode_computer->initialise($program);
        $result = $intcode_computer->process();

        if (19690720 === $result[0]) {
            Utility::log('noun: ' . $i);
            Utility::log('verb: ' . $j);
            Utility::log('Answer: ' . (100 * $i + $j));
        }
    }
}
