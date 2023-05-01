<?php
require_once('../dao/DaoFactory.php');
require_once('PostgresDeveloperDao.php');
require_once('PostgresRespondentDao.php');
require_once('PostgresAlternativeDao.php');
require_once('PostgresQuizDao.php');
require_once('PostgresQuestionDao.php');
require_once('PostgresQuizQuestionDao.php');

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
   
    public function getQuizDao() { return new PostgresQuizDao($this->getConnection()); }
   
    public function getQuestionDao() { return new PostgresQuestionDao($this->getConnection()); }
    
    public function getQuizQuestionDao() { return new PostgresQuizQuestionDao($this->getConnection()); }

    public function getAlternativeDao() { return new PostgresAlternativeDao($this->getConnection()); }
}

?>
