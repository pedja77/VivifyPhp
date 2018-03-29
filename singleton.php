<?php

class Logger {

    private static $instance;

    private function __construct() {

    }

    static function getInstance() {
        if (self::$instance === NULL) {
            self::$instance = new Logger();
        }
        return self::$instance;
        
    }

    public function log($message) {
        echo $message;
    }
}

var_dump(Logger::getInstance());

Logger::getInstance()->log("Hello I'm singleton");