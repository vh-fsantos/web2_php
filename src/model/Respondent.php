<?php

include_once('User.php');

class Respondent extends User {

    private $phoneNumber;

    public function getPhoneNumber() { return $this->phoneNumber; }
    public function setPhoneNumber($phoneNumber) { $this->phoneNumber = $phoneNumber; }
}

?>