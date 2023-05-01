<?php

require_once('User.php');

class Respondent extends User 
{
    private $phone;
    private $offers;

    public function __construct($id, $login, $password, $name, $email, $phone, $offers){
        parent::__construct($id, $login, $password, $name, $email);
        $this->phone = $phone;
        $this->offers = $offers;
    }

    public function getPhone() { return $this->phone; }
    public function setPhone($phone) { $this->phone = $phone; }

    public function getOffers() { return $this->offers; }
    public function setOffers($offers) { $this->offers = $offers; }
}

?>