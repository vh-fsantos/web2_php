<?php

include_once('dao/DaoFactory.php');
include_once('dao/postgres/PostgresDeveloperDao.php');
include_once('dao/postgres/PostgresRespondentDao.php');

class PostgresDaofactory extends DaoFactory 
{
    private $host = "localhost";
    private $db_name = "PHP_questionnaires";
    private $port = "5432";
    private $username = "postgres";
    private $password = "EU141200";
    public $conn;
  
    public function getConnection()
    {
        $this->conn = null;
  
        try
        {
            $this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
        } 
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function getDeveloperDao() { return new PostgresDeveloperDao($this->getConnection()); }

    public function getRespondentDao() { return new PostgresRespondentDao($this->getConnection()); }
}

?>
