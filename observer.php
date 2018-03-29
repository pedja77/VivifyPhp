<?php

class Observable {

    private $observers;
    private $name;

    public function __construct($name) {

        $this->name = $name;
        $this->$observers = [];
    }

    public function getName() {
        return $this->name;
    }

    public function registerObservables($observer) {
        $this->observers[] = $observer;
    }

    public function notifyObservers($message) {
        foreach ($this->observers as $observer) {
            $observer->notify($this, $message);
        }
    }
}

class Observer {
    public function __construct($observable) {
        $observable->registerObserver($this);
    }

    public function notify($observable, $message) {
        echo "Got message " . $message . " from " . $observable->getName() . "<br>";
    }
}


$observable = new Observable('observable');
$observer = new Observer($observable);

$observable->notifyObservers('Hello observers');
$observable->notifyObservers('I am here');