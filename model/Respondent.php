<?php

require_once('User.php');

class Respondent extends User 
{
    private $phone;

    public function __construct($id, $login, $password, $name, $email, $phone){
        parent::__construct($id, $login, $password, $name, $email);
        $this->phone = $phone;
    }

    public function getPhone() { return $this->phone; }
    public function setPhone($phone) { $this->phone = $phone; }
}

?>