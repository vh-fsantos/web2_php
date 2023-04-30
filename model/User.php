<?php

class User {

    private $id;
    private $name;
    private $login;
    private $password;
    private $email;

    public function __construct($id, $login, $password, $name, $email)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getLogin() { return $this->login; }
    public function setLogin($login) { $this->login = $login; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }
}

?>