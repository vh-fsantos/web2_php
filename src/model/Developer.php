<?php

include_once('User.php');

class Developer extends User {

    private $institution;

    public function getInstitution() { return $this->institution; }
    public function setInstitution($institution) { $this->institution = $institution; }
}

?>