<?php 
require_once("../dao/abstractions/DeveloperDao.php");
require_once("../dao/DAO.php");

class PostgresDeveloperDao extends DAO implements DeveloperDao
{
    private $table_name = 'developer';
    
    public function create($developer) 
    {
        $query = "INSERT INTO " . $this->table_name . 
        " (login, password, email, institution, is_admin, name) VALUES" .
        " (:login, :password, :email, :institution, :is_admin, :name)";

        $stmt = $this->conn->prepare($query);
        $login = $developer->getLogin();
        $password = md5($developer->getPassword());
        $email = $developer->getEmail();
        $institution = $developer->getInstitution();
        $isAdmin = $developer->getIsAdmin() ? "true" : "false";
        $name = $developer->getName();    
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":institution", $institution);
        $stmt->bindParam(":is_admin", $isAdmin);
        $stmt->bindParam(":name", $name);

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
        " SET login = :login, password = :password, email = :email, institution = :institution, is_admin = :is_admin, name = :name" .
        " WHERE id = :id";

        $login = $developer->getLogin();
        $password = md5($developer->getPassword());
        $email = $developer->getEmail();
        $institution = $developer->getInstitution();
        $isAdmin = $developer->getIsAdmin() ? "true" : "false";
        $name = $developer->getName();
        $id = $developer->getId();
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":institution", $institution);
        $stmt->bindParam(":is_admin", $isAdmin);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(':id', $id);

        if($stmt->execute())
            return true;

        return false;
    }

    public function findById($id) 
    {
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
        {
            extract($row);
            $developer = new Developer($id, $login, $password, $name, $email, $institution, $is_admin);
        }
            
        return $developer;
    }

    public function findByLogin($login) 
    {
        $developer = null;

        $query = "SELECT id, login, password, email, institution, is_admin, name
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
            $developer = new Developer($id, $login, $password, $name, $email, $institution, $is_admin);
        } 
     
        return $developer;
    }

    public function findAll()
    {
        $developers = array();

        $query = "SELECT id, login, password, email, institution, is_admin, name 
                  FROM " . $this->table_name . " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $developers[] = new Developer($id, $login, $password, $name, $email, $institution, $is_admin);
        }
        
        return $developers;
    }


    public function countAll($search){

        $query = "SELECT id FROM " . $this->table_name . "
            WHERE name LIKE :search OR email LIKE :search
        ";
        
        $searchTerm = '%' . $search . '%';
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':search', $searchTerm);

        $stmt->execute();
        
        $num = $stmt->rowCount();
        
        return $num;                                            
    }  

    
}

?>