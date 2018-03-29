<?php

interface Lendable {
    public function lendProduct();
    public function returnProduct();
}

abstract class Product {

    protected $vendor;
    protected $serialNo;
    protected $model;
    protected $price;
    protected $qty = 0;

    public function __construct($serialNo, $vendor, $model, $price, $qty) {
        $this->vendor = $vendor;
        $this->serialNo = $serialNo;
        $this->model = $model;
        $this->price = $price;
        $this->qty = $qty;
    }

    public function getSerialNo() {
        return $this->serialNo;
    }

    public function getQty() {
        return $this->qty;
    }

    public function setQty($qty) {
        $this->qty += $qty;
    }

    public function getVendor() {
        return $this->vendor;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPrice() {
        return $this->price;
    }

    public function decrementQty() {
        if ($this->qty > 0) {
            $this->qty--;
        }
    }
}

class RAM extends Product {
    
    public $capacity;
    public $freq;

    public function __construct($vendor, $serialNo, $model, $price, $qty, $capacity, $freq) {
        parent::__construct($vendor, $serialNo, $model, $price, $qty);
        $this->capacity = $capacity;
        $this->freq = $freq;
    }
}

class CPU extends Product {
    
    public $freq;
    public $cores;

    public function __construct($vendor, $serialNo, $model, $price, $qty, $freq, $cores) {
        parent::__construct($vendor, $serialNo, $model, $price, $qty);
        $this->freq = $freq;
        $this->cores = $cores;
    }
}

class HDD extends Product implements Lendable {
    
    public $capacity;

    public function __construct($vendor, $serialNo, $model, $price, $qty, $capacity) {
        parent::__construct($vendor, $serialNo, $model, $price, $qty);
        $this->capacity = $capacity;
    }

    public function lendProduct() {
        return;
    }

    public function returnProduct() {
        return;
    }
}

class GPU extends Product {
    
    public $freq;

    public function __construct($vendor, $serialNo, $model, $price, $qty, $freq) {
        parent::__construct($vendor, $serialNo, $model, $price, $qty);
        $this->freq = $freq;
    }
}

class ComputerStore {

    public $products = [];
    public $ballance = 0;

    public function addProduct(Product $product) {
        if (in_array($product->getSerialNo(), array_keys($this->products))) {
            $this->products[$product->getSerialNo()]->setQty($product->getQty());
        } else {
            $this->products[$product->getSerialNo()] = $product;
        }
    }

    public function sellProduct(Product $product) {
        if (in_array($product->getSerialNo(), array_keys($this->products))) {
            $this->products[$product->getSerialNo()]->decrementQty();
            $this->ballance += $product->getQty() * $product->getPrice();
        } else {
            echo $product->getVendor() . " " . $product->getModel() . " out of stock.";
        }
    }

}

$store = new ComputerStore();
$store->addProduct(new GPU(123, 'Radeon', 'r7370', 100, 1, 1200));
$store->addProduct(new GPU(123, 'Radeon', 'r7370', 100, 3, 1200));
$store->addProduct(new HDD(125, 'WD', 'Caviar', 130, 1, '1TB'));

var_dump($store->products);
$store->sellProduct(new GPU(123, 'Radeon', 'r7370', 100, 1, 1200));
var_dump($store->products);
var_dump($store->ballance);
