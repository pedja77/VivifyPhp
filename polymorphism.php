<?php

/* class Car{
    public function drive() {
        echo "I'm driving... car.<br>";
    }
}


class Truck {
    public function drive() {
        echo "I'm driving... truck.<br>";
    }
} */

interface Vehicle {
    public function drive();
}

class Car implements Vehicle {
    public function drive() {
        echo "I'm driving... car.<br>";
    }
}

class Truck implements Vehicle{
    public function drive() {
        echo "I'm driving... truck.<br>";
    }
}

class Driver {
    public function driveVehicle(Vehicle $vehicle) {
        $vehicle->drive();
    }
}

$car = new Car();
$truck = new Truck();
$driver = new Driver();

$driver->driveVehicle($car);
$driver->driveVehicle($truck);