<?php

require_once('classes/Utility.class.php');
require_once('classes/Panel.class.php');

/**
 * Test input
 */
$panel_test_1 = new Panel('R8,U5,L5,D3
U7,R6,D4,L4');
assert($panel_test_1->process() === 6);

$panel_test_2 = new Panel('R75,D30,R83,U83,L12,D49,R71,U7,L72
U62,R66,U55,R34,D71,R55,D58,R83');
assert($panel_test_2->process() === 159);

$panel_test_3 = new Panel('R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51
U98,R91,D20,R16,D67,R40,U7,R15,U6,R7');
assert($panel_test_3->process() === 135);

/**
 * Real input
 */
$day3_input = file_get_contents('puzzle_input/day3.txt', 'r');
$panel = new Panel($day3_input);
$result = $panel->process();
Utility::log('Answer: ' . $result);
