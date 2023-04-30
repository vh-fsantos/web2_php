<?php 

include_once("../abstractions/RespondentDao.php");
include_once("../DAO.php");

class PostgresRespondentDao extends DAO implements RespondentDao
{

    private $table_name = 'respondent';
    
    public function insert($respondent) {

        $query = "INSERT INTO " . $this->table_name . 
        " (login, password, email, institution, is_admin, name) VALUES" .
        " (:login, :password, :email, :institution, :is_admin, :name)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":login", $respondent->getLogin());
        $stmt->bindParam(":password", md5($respondent->getPassword()));
        $stmt->bindParam(":email", $respondent->getEmail());
        $stmt->bindParam(":institution", $respondent->getInstitution());
        $stmt->bindParam(":is_admin", $respondent->isAdmin());
        $stmt->bindParam(":name", $respondent->getName());

        if($stmt->execute())
            return true;

        return false;
    }

    public function removeById($id) {
        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if($stmt->execute())
            return true;

        return false;
    }

    public function remove($developer) {
        return $this->removeById($developer->getId());
    }

    public function update($developer) {

        $query = "UPDATE " . $this->table_name . 
        " SET login = :login, password = :password, email = :email, institution = :institution, is_admin = :is_admin, name = :name" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $developer->getLogin());
        $stmt->bindParam(":password", md5($developer->getPassword()));
        $stmt->bindParam(":email", $developer->getEmail());
        $stmt->bindParam(":institution", $developer->getInstitution());
        $stmt->bindParam(":is_admin", $developer->isAdmin());
        $stmt->bindParam(":name", $developer->getName());
        $stmt->bindParam(':id', $developer->getId());

        if($stmt->execute())
            return true;

        return false;
    }

    public function findById($id) {
        $developer = null;

        $query = "SELECT id, login, password, email, institution, is_admin, name 
              FROM " . $this->table_name . " 
              WHERE id = :id 
              LIMIT 1 OFFSET 0";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row)
            $developer = new Developer($row['id'], $row['login'], $row['password'], $row['name'], $row['email'], $row['institution'], $row['is_admin']);
     
        return $developer;
    }

    public function findByLogin($login) {

        $developer = null;

        $query = "SELECT
                    id, login, nome, senha
                FROM
                    " . $this->table_name . "
                WHERE
                    login = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $login);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $developer = new Developer($row['id'], $row['login'], $row['password'], $row['name'], $row['email'], $row['institution'], $row['is_admin']);
        } 
     
        return $developer;
    }

    public function findAll()
    {
        $developers = array();

        $query = "SELECT id, login, password, email, institution, is_admin, name FROM " . $this->table_name . " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $developers[] = new Developer($id, $login, $password, $name, $email, $institution, $isadmin);
        }
        
        return $developers;
    }
}

?>