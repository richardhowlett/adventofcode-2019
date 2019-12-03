<?php

class IntcodeComputer
{
    private $memory = [];
    private $instruction_pointer = 0;

    public function __construct($program) {
        if (!is_array($program)) {
            $program = explode(',', $program);
        }

        $this->initialise($program);

        //Utility::log('program: ' . print_r($this->program, true));
    }

    public function initialise($program) {
        $this->memory = $program;
        $this->instruction_pointer = 0;
    }

    public function getInstructionPointerAddress() {
        return $this->instruction_pointer;
    }

    public function setInstructionPointerAddress($instruction_pointer) {
        $this->instruction_pointer = $instruction_pointer;
    }

    public function getOffset($key) {
        return $this->memory[$key];
    }

    public function setOffset($key, $value) {
        $this->memory[$key] = $value;
    }

    public function process() {
        $instruction = $this->getOffset($this->getInstructionPointerAddress());

        //Utility::log('instruction_pointer: ' . $this->getInstructionPointerAddress());
        //Utility::log('instruction: ' . $instruction);

        switch ($instruction) {
            case 1:
                $input_address_1 = $this->getOffset($this->getInstructionPointerAddress() + 1);
                $input_address_2 = $this->getOffset($this->getInstructionPointerAddress() + 2);
                $output_address = $this->getOffset($this->getInstructionPointerAddress() + 3);

                //Utility::log('input_address_1: ' . $input_address_1);
                //Utility::log('input_address_2: ' . $input_address_2);
                //Utility::log('output_address: ' . $output_address);

                $this->setOffset($output_address, $this->getOffset($input_address_1) + $this->getOffset($input_address_2));

                $this->setInstructionPointerAddress($this->getInstructionPointerAddress() + 4);
                break;

            case 2:
                $input_address_1 = $this->getOffset($this->getInstructionPointerAddress() + 1);
                $input_address_2 = $this->getOffset($this->getInstructionPointerAddress() + 2);
                $output_address = $this->getOffset($this->getInstructionPointerAddress() + 3);

                //Utility::log('input_address_1: ' . $input_address_1);
                //Utility::log('input_address_2: ' . $input_address_2);
                //Utility::log('output_address: ' . $output_address);

                $this->setOffset($output_address, $this->getOffset($input_address_1) * $this->getOffset($input_address_2));

                $this->setInstructionPointerAddress($this->getInstructionPointerAddress() + 4);
                break;

            case 99:
                return $this->memory;

            default:
                throw new Exception('Invalid Intcode Program');
        }

        return $this->process();
    }

    public function getProgramString() {
        return implode(',', $this->memory);
    }
}
