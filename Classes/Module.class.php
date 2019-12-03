<?php

class Module
{
    private $mass;

    public function __construct($mass) {
        $this->mass = $mass;
    }

    public function getFuelRequirement() {
        $fuel = max(0, (int) floor($this->mass / 3) - 2);

        return $fuel;
    }

    public function getFuelRequirementIncludingFuel() {
        $fuel = $this->getFuelRequirement();

        if ($fuel > 0) {
            $module = new Module($fuel);
            return $fuel + $module->getFuelRequirementIncludingFuel();
        }

        return $fuel;
    }
}
