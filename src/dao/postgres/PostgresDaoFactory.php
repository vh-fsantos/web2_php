<?php

include_once('../DaoFactory.php');

class PostgresDaofactory extends DaoFactory {

    private $host = "localhost";
    private $db_name = "PHP_questionnaires";
    private $port = "5432";
    private $username = "postgres";
    private $password = "ucs";
    public $conn;
  
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>
