<?php

class Panel
{
    private $wire_paths = [];
    private $wire_path_points = [];
    private $intersections = [];

    public function __construct($wire_paths) {
        $wire_paths = explode("\n", $wire_paths);
        $this->wire_paths = $wire_paths;
    }

    public function setWirePathPoint($path_index, $x, $y) {
        //Utility::log('Set Wire Path Point for path "' . $path_index . '" coords: ' . $x . ', ' . $y);
        $this->wire_path_points[$path_index][$x][$y] = 1;

        // detect collision with another path, ignoring origin point
        if (0 !== $x && 0 !== $y) {
            foreach ($this->wire_path_points as $index => $points) {
                if ($index != $path_index) {
                    if (!empty($this->wire_path_points[$index][$x][$y])) {
                        $this->setCollision($x, $y);
                    }
                }
            }
        }
    }

    public function setCollision($x, $y) {
        $this->intersections[abs($x) + abs($y)][] = [$x, $y];
    }

    public function process() {
        Utility::log($this->wire_paths);

        foreach ($this->wire_paths as $path_index => $path) {
            $this->setWirePathPoint($path_index, 0, 0);

            $path_steps = explode(',', $path);
            $this->plotPathPoints($path_index, $path_steps);

            //Utility::log($this->wire_path_points);
        }

        Utility::log($this->intersections);

        return min(array_keys($this->intersections));
    }

    public function plotPathPoints($path_index, $path_steps) {
        $current_x = 0;
        $current_y = 0;
        foreach ($path_steps as $path_step) {
            $instruction = substr($path_step, 0, 1);
            $argument = substr($path_step, 1);

            switch ($instruction) {
                case 'U':
                    for ($i = 0; $i < $argument; $i++) {
                        $current_y++;

                        $this->setWirePathPoint($path_index, $current_x, $current_y);
                    }
                    break;

                case 'D':
                    for ($i = 0; $i < $argument; $i++) {
                        $current_y--;

                        $this->setWirePathPoint($path_index, $current_x, $current_y);
                    }
                    break;

                case 'L':
                    for ($i = 0; $i < $argument; $i++) {
                        $current_x--;

                        $this->setWirePathPoint($path_index, $current_x, $current_y);
                    }
                    break;

                case 'R':
                    for ($i = 0; $i < $argument; $i++) {
                        $current_x++;

                        $this->setWirePathPoint($path_index, $current_x, $current_y);
                    }
                    break;
            }
        }
    }
}
