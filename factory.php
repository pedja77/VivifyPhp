<?php

interface Shape {
    public function draw();
}

class Circle implements Shape {

    public function draw() {
        echo "Drawing circle<br>";
    }
}

class Rectangle implements Shape {

    public function draw() {
        echo "Drawing rectangle<br>";
    }
}

class ShapeFactory {

    public function makeShape($type) {

        if ($type != 'circle' && $type != 'rectangle') {
            echo "Error<br>";
            return;
        }
        if ($type === "circle") {
            echo "Making new circle...<br>";
            return new Circle();
        }
        if ($type === 'rectangle') {
            echo "Making new rectangle...<br>";
            return new Rectangle();
        }
    }
}

$factory = new ShapeFactory();
$circle = $factory->makeShape('circle');
$rectangle = $factory->makeShape('rectangle');
$wrong = $factory->makeShape('wrong');

$circle->draw();
$rectangle->draw();
