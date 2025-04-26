<?php

class Action1{
    public function execute(): void{
        echo "Action 1 performed";
    }
}

class Action2{
    public function execute(): void{
        echo "Action 2 performed";
    }
}

class Facade{
    private Action1 $action1;
    private Action2 $action2;

    public function __construct(){
        $this->action1 = new Action1();
        $this->action2 = new Action2();
    }

    public function perform_action(): void{
        $this->action1->execute();
        $this->action2->execute();
    }
}

/*

🎯 Problem: Build a Computer Startup Facade
You need to simulate the process of starting a computer.
A real computer startup involves multiple subsystems:

CPU (has a method freeze(), jump(address), execute())

Memory (has a method load(address, data))

HardDrive (has a method read(lba, size))

You should:

✅ Create classes for each subsystem (CPU, Memory, HardDrive).
✅ Create a Facade class (Computer) that simplifies starting the computer through one single method (e.g., startComputer()).

Inside startComputer(), the Facade should internally call the appropriate methods of CPU, Memory, and HardDrive in the correct order.

🧱 Requirements:
Subsystem Classes:

CPU

Memory

HardDrive

Facade Class:

Computer (provides startComputer() method)

Client:

Just needs to create a Computer object and call startComputer(). The client shouldn’t interact with CPU, Memory, or HardDrive directly.

*/

class CPU{

    public function freeze(){
        echo "Freezing CPU";
    }

    public function jump(string $address){
        echo "Jump to " . $address;
    }

    public function execute(){
        echo "Executing action";
    }

}

class Memory{

    public function load(string $address, string $data){
        echo "Loading " . $data . " to " . $address;
    }

}

class HardDrive{

    public function read(string $lba, string $size){
        echo "Read " . $lba . ": " . $size;
    }

}

class Computer{
    private CPU $cpu;
    private Memory $memory;
    private HardDrive $hard_drive;

    public function __construct(){
        $this->cpu = new CPU();
        $this->memory = new Memory();
        $this->hard_drive = new HardDrive();

    }

    public function startComputer(string $address, string $data, string $lba, string $size){
        $this->cpu->jump($address);
        $this->memory->load($address, $data);
        $this->hard_drive->read($lba, $size);
    }
}