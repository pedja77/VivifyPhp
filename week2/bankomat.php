<?php

// Example of state pattern 


abstract class AtmState {
    abstract public function insertCardAndPin ($card, $pin);
    abstract public function inputAmountAndConfirm($amount);
    abstract public function demandCheck();
}

class AtmReady extends AtmState {

    public function insertCardAndPin($card, $pin) {
        echo "Insert your card and type in your PIN.<BR>";
        return true;
    }

    public function inputAmountAndConfirm($amount) {
        echo "Vait for validation of card and PIN to input amount.<br>";
        return false;
    }

    public function demandCheck() {
        echo "Cannot print check yet.<br>";
    }
}

class AtmValidated extends AtmState {
    
    public function insertCardAndPin($card, $pin) {
        echo "Card is already inserted<br>";
        return false;
    }

    public function inputAmountAndConfirm($mount) {
        echo "Please input amount and confirm.<br>";
        return true;
    }

    public function demandCheck() {
        echo "Cannot print check yet.<br>";
        return false;
    }
}

class AtmPayout extends AtmState {

    public function insertCardAndPin($card, $pin) {
        echo "Card is already inserted<br>";
        return false;
    }

    public function inputAmountAndConfirm($amount) {
        echo "Amount is already confirmed.<br>";
        return false;
    }

    public function demandCheck() {
        echo "Here is your check.<br>";
        return true;
    }
}

class Atm {

    private $state;

    public function __construct() {
        $this->setState(new AtmReady());
    }

    public function setState(AtmState $state) {
        $this->state = $state;
    }

    public function insertCardAndPin($card, $pin) {
        if ($this->state->insertCardAndPin($card, $pin)) 
            $this->setState(new AtmValidated());
    }

    public function inputAmountAndConfirm($amount) {
        if ($this->state->inputAmountAndConfirm($amount))
            $this->setState(new AtmPayout());
    }

    public function demandCheck() {
        if ($this->state->demandCheck())
            $this->setState(new AtmReady());
    }

}


$atm = new Atm();
$atm->insertCardAndPin(1, 23);
$atm->insertCardAndPin(1, 23);
$atm->inputAmountAndConfirm(500);
$atm->demandCheck();