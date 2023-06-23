<?php
require_once('../dao/DaoFactory.php');
require_once('PostgresDeveloperDao.php');
require_once('PostgresRespondentDao.php');
require_once('PostgresAlternativeDao.php');
require_once('PostgresQuizDao.php');
require_once('PostgresQuestionDao.php');
require_once('PostgresQuizQuestionDao.php');
require_once('PostgresOfferDao.php');
require_once('PostgresOfferAnswerDao.php');
require_once('PostgresAnswerDao.php');
require_once('PostgresSubmissionDao.php');

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

    public function getOfferDao() { return new PostgresOfferDao($this->getConnection()); }
    
    public function getOfferAnswerDao() { return new PostgresOfferAnswerDao($this->getConnection()); }
    
    public function getAnswerDao() { return new PostgresAnswerDao($this->getConnection()); }

    public function getSubmissionDao() { return new PostgresSubmissionDao($this->getConnection()); }
}

?>
