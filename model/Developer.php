<?php

require_once('User.php');

class Developer extends User 
{
    private $institution;
    private $isAdmin;
    private $quizzes;

    public function __construct($id, $login, $password, $name, $email, $institution, $isAdmin, $quizzes){
        parent::__construct($id, $login, $password, $name, $email);
        $this->institution = $institution;
        $this->isAdmin = $isAdmin;
        $this->quizzes = $quizzes;
    }

    public function getInstitution() { return $this->institution; }
    public function setInstitution($institution) { $this->institution = $institution; }

    public function getIsAdmin() { return $this->isAdmin; }
    public function setIsAdmin($isAdmin) { $this->isAdmin = $isAdmin; }

    public function getQuizzes() { return $this->quizzes; }
    public function setQuizzes($quizzes) { $this->quizzes = $quizzes; }
}

?>