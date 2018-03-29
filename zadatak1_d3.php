<?php

class MailService {

    private static $instance;

    private function __construct() {

    }

    static function getInstance() {
        if (self::$instance === NULL) {
            self::$instance = new MailService();
        }
        return self::$instance;
    }

    public function sendMail($mail) {
        echo "To: " . $mail->getTo() . "<br>";
        echo "Topic: " . $mail->getTopic() . "<br>";
        echo "Text: " . $mail->getText() . "<br>";
    }
}

class Mail {
    private $to;
    private $topic;
    private $text;

    public function __construct($to, $topic, $text) {
        $this->to = $to;
        $this->topic = $topic;
        $this->text = $text;
    }

    public function getTo() {
        return $this->to;
    }

    public function getTopic() {
        return $this->topic;
    }

    public function getText() {
        return $this->text;
    }
}

class MailFactory {

    public function makeMail($to, $topic, $text) {
        return new Mail($to, $topic, $text);
    }
}

$mailFactory = new MailFactory();
$mail = $mailFactory->makeMail('Me', 'Test', 'Vezbamo design patterne');
//var_dump(MailService::getInstance());
MailService::getInstance()->sendMail($mail);
