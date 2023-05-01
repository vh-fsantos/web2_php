<?php 
require_once("../dao/abstractions/DeveloperDao.php");
require_once("../dao/DAO.php");

class PostgresDeveloperDao extends DAO implements DeveloperDao
{
    private $table_name = 'developer';
    
    public function create($developer) 
    {
        $query = "INSERT INTO " . $this->table_name . 
        " (login, password, email, institution, is_admin, name, quizzes) VALUES" .
        " (:login, :password, :email, :institution, :is_admin, :name, :quizzes)";

        $stmt = $this->conn->prepare($query);
        $login = $developer->getLogin();
        $password = md5($developer->getPassword());
        $email = $developer->getEmail();
        $institution = $developer->getInstitution();
        $isAdmin = $developer->getIsAdmin() ? "true" : "false";
        $name = $developer->getName();    
        $quizzes = '{' . implode(',', $developer->getQuizzes()) . '}';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":institution", $institution);
        $stmt->bindParam(":is_admin", $isAdmin);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(':quizzes', $quizzes);

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

    public function remove($developer) 
    {
        return $this->removeById($developer->getId());
    }

    public function update($developer) 
    {
        $query = "UPDATE " . $this->table_name . 
        " SET login = :login, password = :password, email = :email, institution = :institution, is_admin = :is_admin, name = :name, quizzes = :quizzes" .
        " WHERE id = :id";

        $login = $developer->getLogin();
        $password = md5($developer->getPassword());
        $email = $developer->getEmail();
        $institution = $developer->getInstitution();
        $isAdmin = $developer->getIsAdmin() ? "true" : "false";
        $name = $developer->getName();
        $id = $developer->getId();
        $quizzes = '{' . implode(',', $developer->getQuizzes()) . '}';
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":institution", $institution);
        $stmt->bindParam(":is_admin", $isAdmin);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(':quizzes', $quizzes);
        $stmt->bindParam(':id', $id);

        if($stmt->execute())
            return true;

        return false;
    }

    public function findById($id) 
    {
        $developer = null;

        $query = "SELECT id, login, password, email, institution, is_admin, name, quizzes
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
            preg_match_all('/\d+/', $quizzes, $matches);
            $quizzesArray = array_map('strval', $matches[0]);
            $developer = new Developer($id, $login, $password, $name, $email, $institution, $is_admin, $quizzesArray);
        }
            
        return $developer;
    }

    public function findByLogin($login) 
    {
        $developer = null;

        $query = "SELECT id, login, password, email, institution, is_admin, name, quizzes
        FROM " . $this->table_name . " 
                WHERE
                    login = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $login);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            extract($row);
            preg_match_all('/\d+/', $quizzes, $matches);
            $quizzesArray = array_map('strval', $matches[0]);
            $developer = new Developer($id, $login, $password, $name, $email, $institution, $is_admin, $quizzesArray);
        } 
     
        return $developer;
    }

    public function findAll()
    {
        $developers = array();

        $query = "SELECT id, login, password, email, institution, is_admin, name, quizzes 
                  FROM " . $this->table_name . " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            preg_match_all('/\d+/', $quizzes, $matches);
            $quizzesArray = array_map('strval', $matches[0]);
            $developers[] = new Developer($id, $login, $password, $name, $email, $institution, $is_admin, $quizzesArray);
        }
        
        return $developers;
    }
}

?>