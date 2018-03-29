<?php

interface Vehicle {
    public function inspect();
}

interface VehicleFactory {
    public function makeVehicle();
}

class Car implements Vehicle {
    public function inspect() {
        echo "Inspecting car...<br>";
    }
}

class Bike implements Vehicle {
    public function inspect() {
        echo "Inspecting bike...<br>";
    }
}

class CarFactory implements VehicleFactory {
    public function makeVehicle() {
        return new Car();
    }
}

class BikeFactory implements VehicleFactory {
    public function makeVehicle() {
        return new Bike();
    }
}

class InspectionService {
    private static $instance;

    private function __construct() {

    }

    static function getInstance() {
        if (self::$instance === NULL) {
            self::$instance = new InspectionService();
        }
        return self::$instance;
    }

    public function inspectVehicle($vehicle) {
        $vehicle->inspect();
    }
}

$carFactory = new CarFactory();
$bikeFactory = new BikeFactory();

$car = $carFactory->makeVehicle();
$bike = $bikeFactory->makeVehicle();

InspectionService::getInstance()->inspectVehicle($car);
InspectionService::getInstance()->inspectVehicle($bike);