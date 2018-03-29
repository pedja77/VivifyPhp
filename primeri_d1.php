<?php

// Static members
class Product {
    public static $count = 0;
    public $name;

    public function __construct($productName) {
        self::$count++;
        $this->name = $productName;
        echo "Produced so far: " . self::$count . "<br>";
    }
}

$milk = new Product("Milk");
$bread = new Product("Bread");

echo $milk->name . "<br>";
echo $bread->name . "<br>";
echo "Total number of created products: " . Product::$count . "<br>";
$juice = new Product("Juice");
echo "Access static member from bread object: " . $bread::$count . "<br>";
//echo "Access static member from milk object: " . $milk::$count . "<br>";
