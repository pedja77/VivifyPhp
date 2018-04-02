<?php

class User {

    protected $ownedProducts;
    protected $wishlist;
    protected $userName;
    protected $firstName;
    protected $lastName;

    public function __construct($username, $firstName, $lastName) {
        $this->username = $username;
        $this->fistName = $firstName;
        $this->lastName = $lastName;
        $this->ownedProducts = [];
        $this->wishList = [];
    }

    public function addProductToWishlist($product) {
        $this->wishlist[] = $product;
    }

    public function addProductToOwnedlist($product) {
        $this->ownedProducts[] = $product;
    }

    public function removeProductFromWishlist($product) {
        $index = array_search($product, $this->wishlist, true);
        unset($this->wishlist[$index]);
    }

    public function removeProductFromOwnedlist($product) {
        $index = array_search($product, $this->ownedProducts, true);
        unset($this->ownedProducts[$index]);
    }


    public function bidd($product, $offer) {
        //TODO
    }

    public function withdrawBidd($product) {
        // TODO
    }

    public function sellProduct($product, $user) {
        $this->removeProductFromOwnedlist($product);
        $user->addProductToOwnedlist($product);
    }

    public function getOwnedProducts() {
        return $this->ownedProducts;
    }

}

class Product {

    protected $productName;
    protected $startPrice;
    protected $bidders;

    public function __construct($productName, $startPrice) {
        $this->bidders = [];
        $this->productName = $productName;
        $this->startPrice = $startPrice;
    }

    public function notifyOwner() {
        // TODO
    }

    public function notifyBidders($bidders) {
        // TODO
    }
}

$testUser = new User('pedja', 'Predrag', 'Smigeljski');
$gurtna = new Product('gurtna', 100);
$mixer = new Product('mixer', 150);
$cinculator = new Product('cinculator', 140);

$testUser->addProductToOwnedlist($mixer);
$testUser->addProductToOwnedlist($cinculator);
$testUser->addProductToOwnedlist($gurtna);
var_dump($testUser->getOwnedProducts());
$testUser->removeProductFromOwnedlist($mixer);
var_dump($testUser->getOwnedProducts());