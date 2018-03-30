<?php

abstract class Room {

    protected $roomNumber;
    protected $numberOfBeds;
    protected $hasBathroom;
    protected $hasBalcony;
    protected $isOccupied = false;

    

    public function getRoomNo() {
        return $this->roomNumber;
    }

    public function getNumberOfBeds() {
        return $this->numberOfBeds;
    }

    public function getHasBathroom() {
        return $this->hasBathroom;
    }

    public function getHasBalcony() {
        return $this->hasBalcony;
    }

    public function getIsOccupied() {
        return $this->isOccupied;
    }

    public function setIsOccupied($isOccupied) {
        $this->isOccupied = $isOccupied;
    }
}

class Hotel {

    private static $instance;
    private $rooms = [];
    private $users;

    private function __construct() {
        $this->users = [];
    }

    public function registerUsers($user) {
        $this->users[] = $user;
    }

    public function getUsers() {
        return $this->users;
    }

    public function notifyUsers($message) {
        foreach ($this->users as $user) {
            if (count($this->getAvailableRooms($user->getRoomType())) > 0) {
                $user->notify($this, $message);
            }       
        }
    }

    static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Hotel();
        }
        return self::$instance;
        
    }

    public function setRooms($rooms) {
        $this->rooms = $rooms;
        $this->notifyUsers("There are available rooms");
    }

    public function getRooms() {
        return $this->rooms;
    }

    public function getAvailableRooms($numberOfBeds, $hasBathroom=false, $hasBalcony=false) {
        return array_filter($this->rooms, function($room) use ($numberOfBeds, $hasBathroom, $hasBalcony){
            return !$room->getIsOccupied() && 
                $room->getNumberOfBeds() === $numberOfBeds &&
                $room->getHasBathroom() === $hasBathroom &&
                $room->getHasBalcony() === $hasBalcony;
        });
        
    }

    public function checkIn($numberOfBeds, $hasBathroom, $hasBalcony) {
        $available = $this->getAvailableRooms($numberOfBeds, $hasBathroom, $hasBalcony);
        if (count($available) === 0) {
            echo "There is no available room of this type<br>";
        } else {
            $randomRoom = array_rand($available);
            $this->rooms[$randomRoom]->setIsOccupied(true);
            echo "Success! You checked in room number " . $this->rooms[$randomRoom]->getRoomNo();
            $this->notifyUsers("There are available rooms");
        }
        
    }

    public function checkOut($roomNumber) {
        $this->rooms[$roomNumber]->setIsOccupied(false);
    }


}

class User {

    protected $firstName;
    protected $lastName;
    protected $jmbg;
    protected $roomType;

    public function __construct($hotel, $firstName, $lastName, $jmbg, $roomType) {
        $hotel->registerUsers($this);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->jmbg = $jmbg;
        $this->roomType = $roomType;
    }

    public function notify($hotel, $message) {
        echo "Got message " . $message . " from " . $hotel->getName() . "<br>";
    }

    public function getRoomType() {
        return $this->roomType;
    }
}

class Room1 extends Room {
    
    public function __construct($roomNumber, $numberOfBeds, $hasBathroom=false, $hasBalcony=false) {
        
        $this->roomNumber = $roomNumber;
        $this->numberOfBeds = $numberOfBeds;
        $this->hasBathroom = $hasBathroom;
        $this->hasBalcony = $hasBalcony;
    }
}

class Room2 extends Room {
    
    public function __construct($roomNumber, $numberOfBeds, $hasBathroom=false, $hasBalcony=false) {
        
        $this->roomNumber = $roomNumber;
        $this->numberOfBeds = $numberOfBeds;
        $this->hasBathroom = $hasBathroom;
        $this->hasBalcony = $hasBalcony;
    }
}

class Room3 extends Room {
    
    public function __construct($roomNumber, $numberOfBeds, $hasBathroom=false, $hasBalcony=false) {
        
        $this->roomNumber = $roomNumber;
        $this->numberOfBeds = $numberOfBeds;
        $this->hasBathroom = $hasBathroom;
        $this->hasBalcony = $hasBalcony;
    }
}

$room1 = new Room1(23, 1);
$room2 = new Room2(42, 2, true, true);
$room3 = new Room3(12, 3);

/* var_dump($room1);
var_dump($room2);
var_dump($room3); 
var_dump($room1->getIsOccupied()); */

Hotel::getInstance()->setRooms([$room1->getRoomNo()=>$room1, $room2->getRoomNo()=>$room2, $room3->getRoomNo()=>$room3]);
$user1 = new User(Hotel::getInstance(), 'Pedja', 'Smigeljski', '1502', 2);
var_dump(Hotel::getInstance()->getUsers());


//var_dump(Hotel::getInstance()->getRooms());
/* var_dump(Hotel::getInstance()->getAvailableRooms(2, true, true));
Hotel::getInstance()->checkIn(2, true, true);
var_dump(Hotel::getInstance()->getAvailableRooms(2, true, true));
Hotel::getInstance()->checkOut(42);
var_dump(Hotel::getInstance()->getAvailableRooms(2, true, true)); */