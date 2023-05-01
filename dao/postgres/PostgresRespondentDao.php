<?php 

include_once("dao/abstractions/RespondentDao.php");
include_once("dao/DAO.php");

class PostgresRespondentDao extends DAO implements RespondentDao
{
    private $table_name = 'respondent';
    
    public function insert($respondent) 
    {
        $query = "INSERT INTO " . $this->table_name . 
        " (login, password, email, phone, name, offers) VALUES" .
        " (:login, :password, :email, :phone, :name, :offers)";

        $stmt = $this->conn->prepare($query);
        $login = $respondent->getLogin();
        $password = md5($respondent->getPassword());
        $email = $respondent->getEmail();
        $phone = $respondent->getPhone();
        $name = $respondent->getName();
        $offers = '{' . implode(',', $respondent->getOffers()) . '}';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(':offers', $offers);

        if($stmt->execute())
            return true;

        return false;
    }

    public function removeById($id) 
    {
        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute())
            return true;

        return false;
    }

    public function remove($respondent) 
    {
        return $this->removeById($respondent->getId());
    }

    public function update($respondent) 
    {
        $query = "UPDATE " . $this->table_name . 
        " SET login = :login, password = :password, email = :email, phone = :phone, name = :name, offers = :offers" .
        " WHERE id = :id";

        $login = $respondent->getLogin();
        $password = md5($respondent->getPassword());
        $email = $respondent->getEmail();
        $phone = $respondent->getPhone();
        $name = $respondent->getName();
        $id = $respondent->getId();
        $offers = '{' . implode(',', $respondent->getOffers()) . '}';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(':offers', $offers);
        $stmt->bindParam(':id', $id);

        if($stmt->execute())
            return true;

        return false;
    }

    public function findById($id) 
    {
        $respondent = null;

        $query = "SELECT id, login, password, email, phone, name, offers
              FROM " . $this->table_name . " 
              WHERE id = :id 
              LIMIT 1 OFFSET 0";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row)
        {
            extract($row);
            preg_match_all('/\d+/', $offers, $matches);
            $offersArray = array_map('strval', $matches[0]);
            $respondent = new Respondent($id, $login, $password, $name, $email, $phone, $offersArray);
        }

        return $respondent;
    }

    public function findByLogin($login) 
    {
        $respondent = null;

        $query = "SELECT
                    id, login, password, email, phone, name, offers
                FROM
                    " . $this->table_name . "
                WHERE
                    login = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $login);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) 
        {
            extract($row);
            preg_match_all('/\d+/', $offers, $matches);
            $offersArray = array_map('strval', $matches[0]);
            $respondent = new Respondent($id, $login, $password, $name, $email, $phone, $offersArray);
        } 
     
        return $respondent;
    }

    public function findAll()
    {
        $respondents = array();

        $query = "SELECT id, login, password, email, phone, name, offers
                FROM " . $this->table_name . " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            preg_match_all('/\d+/', $offers, $matches);
            $offersArray = array_map('strval', $matches[0]);
            $respondents[] = new Respondent($id, $login, $password, $name, $email, $phone, $offersArray);
        }
        
        return $respondents;
    }
}

?>