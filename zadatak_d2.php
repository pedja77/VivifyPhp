<?php
interface Loanable {
    public function loan();
    public  function returnFromLoan();
}

class ComputerShop {
    private $products;
    private $balance;

    public function __construct()
    {
        $this->products = [];
        $this->balance = 0;
    }

    public function getProducts() {
        return $this->products;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function sellProduct(Product $product) {
        if ($product->getNumberInStock() === 0) {
            echo 'There is no this product in stock';
            return;
        }

        if (!in_array($product, $this->products)) {
            echo 'We dont have this product in store';
            return;
        }

        $this->balance += $product->getPrice();
        $currentAmount = $product->getNumberInStock();
        $product->setNumberInStock($currentAmount - 1);

        echo 'Successfully sold ' . $product->getModel() . '<br>';
    }

    public function loanProduct(Product $product) {
        if (!($product instanceof Loanable)) {
            echo 'This product is not loanable <br>';
            return;
        }

        $product->loan();
        $charge = $product->getPrice() * 0.25;
        $this->balance += $charge;

        echo 'You have successfully loaned ' . $product->getModel() . '<br>';
    }
}

abstract class Product {
    protected $serialNumber;
    protected $manufacturer;
    protected $model;
    protected $price;
    protected $numberInStock = 0;

    public function __construct(
        $serialNumber,
        $manufacturer,
        $model,
        $price,
        $numberInStock
    )
    {
        $this->manufacturer = $manufacturer;
        $this->serialNumber = $serialNumber;
        $this->model = $model;
        $this->price = $price;
        $this->numberInStock = $numberInStock;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getNumberInStock() {
        return $this->numberInStock;
    }

    public function setNumberInStock($amount) {
        $this->numberInStock = $amount;
    }

    public function getModel() {
        return $this->model;
    }
}

class Ram extends Product implements Loanable {
    private $capacity;
    private $clock;

    public function __construct(
        $serialNumber,
        $manufacturer,
        $model,
        $price,
        $numberInStock,
        $capacity,
        $clock
    )
    {
        parent::__construct(
            $serialNumber,
            $manufacturer,
            $model,
            $price,
            $numberInStock);

        $this->capacity = $capacity;
        $this->clock = $clock;
    }

    public function loan() {
        $this->numberInStock -= 1;
    }

    public function returnFromLoan()
    {
        $this->numberInStock += 1;
    }
}

class Cpu extends Product {
    private $numberOfCores;
    private $frequency;

    public function __construct(
        $serialNumber,
        $manufacturer,
        $model,
        $price,
        $numberInStock,
        $numberOfCores,
        $frequency
    )
    {
        parent::__construct(
            $serialNumber,
            $manufacturer,
            $model,
            $price,
            $numberInStock);

        $this->numberOfCores = $numberOfCores;
        $this->frequency = $frequency;
    }
}

class Gpu extends Product {
    private $frequency;

    public function __construct(
        $serialNumber,
        $manufacturer,
        $model,
        $price,
        $numberInStock,
        $frequency
    )
    {
        parent::__construct(
            $serialNumber,
            $manufacturer,
            $model,
            $price,
            $numberInStock);

        $this->frequency = $frequency;
    }
}

$ram = new Ram(
    'AAAA',
    'Ram manufacturer',
    'Model',
    100,
    2,
    '4GB',
    '512Hz'
    );

$shop = new ComputerShop();
$shop->addProduct($ram);

$shop->sellProduct($ram);

$cpu = new Cpu(
    'AAA',
    'aaa',
    'model',
    10,
    1,
    1,
    '512'
    );

$shop->sellProduct($cpu);

echo 'Current balance is ' . $shop->getBalance();

echo 'Current ram no. in stock ' . $ram->getNumberInStock();
$shop->loanProduct($ram);
echo 'Current balance is ' . $shop->getBalance();
echo 'Current ram no. in stock ' . $ram->getNumberInStock();
$ram->returnFromLoan();
echo 'Current ram no. in stock ' . $ram->getNumberInStock();

echo 'Current balance is ' . $shop->getBalance();
$shop->loanProduct($cpu);
echo 'Current balance is ' . $shop->getBalance();

