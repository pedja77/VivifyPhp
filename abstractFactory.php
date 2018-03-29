<?php

interface Vehicle {
    public function drive();
}

class Car implements Vehicle {

    public function drive() {
        echo "Driving car...<br>";
    }
}

class Truck implements Vehicle {

    public function drive() {
        echo "Driving truck...<br>";
    }
}

interface VehicleFactory {
    public function makeVehicle();
}

class CarFactory implements VehicleFactory {

    public function makeVehicle() {
        return new Car();
    }
}

class TruckFactory implements VehicleFactory {

    public function makeVehicle() {
        return new Truck();
    }
}

$carFactory = new CarFactory();
$truckFactory = new TruckFactory();

$car = $carFactory->makeVehicle();
$car2 = $carFactory->makeVehicle();

$truck = $truckFactory->makeVehicle();
$truck2 = $truckFactory->makeVehicle();
$truck3 = $truckFactory->makeVehicle();

$vehicles = [$car, $car2, $truck, $truck2, $truck3];

foreach($vehicles as $vehicle) {
    $vehicle->drive();
}
