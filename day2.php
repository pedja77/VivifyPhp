<?php

// Interfaces

/* interface Convertible {
    public function openRoof();
    public function closeRoof();
}


class Car implements Convertible {
    public $isRoofOpen;

    public function openRoof() {
        echo "Opening roof<br>";
        $this->isRoofOpen = true;
    }

    public function closeRoof() {
        echo "Closing roof<br>";
        $this->isRoofOpen = false;
    }
}

$someCar = new Car();

$someCar->openRoof();
var_dump($someCar->isRoofOpen);

$someCar->closeRoof();
var_dump($someCar->isRoofOpen);

var_dump($someCar instanceof Convertible); */




// Abstract classes

abstract class Vehicle {
    public $numberOfWheels;
    protected $horsepower;
    abstract public function startEngine();
}

class Car extends Vehicle {
    public function startEngine() {
        return 'Vrooooom!';
    }
    public function getHorsepower() {
        return $this->horsepower;
    }
}

class FormulaOneCar extends Vehicle {
    public function startEngine() {
        return "Vroooooooooooooooooooom!!!!!";
    }
}
//$someVehicle = new Vehicle();
$someCar = new Car();
$someFormulaOneCar = new FormulaOneCar();
//echo 'Vehicle: ' . $someVehicle->startEngine();
echo 'Car: ' . $someCar->startEngine();
echo 'Formula One Car: ' . $someFormulaOneCar->startEngine();