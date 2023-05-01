<?php 

require_once("../dao/abstractions/AlternativeDao.php");
require_once("../dao/DAO.php");

class PostgresAlternativeDao extends DAO implements AlternativeDao {

    private $table_name = 'alternative';
    
    public function create($alternative) {

        var_dump($alternative);

        $query = "INSERT INTO " . $this->table_name . 
            " (description, is_correct, question_id) VALUES" .
            " (:description, :is_correct, :question_id)";
    
        $stmt = $this->conn->prepare($query);
    
        // bind values 
        $stmt->bindParam(":description", $alternative->getDescription());
        $isCorrect = $alternative->getIsCorrect();
        if (isset($isCorrect)) {
            $stmt->bindParam(":is_correct", $isCorrect, PDO::PARAM_BOOL);
        } else {
            $stmt->bindValue(":is_correct", null, PDO::PARAM_NULL);
        }
        $stmt->bindParam(":question_id", $alternative->getQuestion()->getId());
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function removeById($id) {
        $query = "DELETE FROM " . $this->table_name . 
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $id);

        // execute the query
        if($stmt->execute()){
            return true;
        }    

        return false;
    }

    public function remove($alternative) {
        return $this->removeById($alternative->getId());
    }

    public function update($alternative) {

        $query = "UPDATE " . $this->table_name . 
        " SET description = :description, is_correct = :is_correct, question_id = :question_id" .
        " WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        // bind parameters
        $stmt->bindParam(":description", $alternative->getDescription());
        $stmt->bindParam(":is_correct", $alternative->getIsCorrect());
        $stmt->bindParam(":question_id", $alternative->getQuestion()->getId());
        $stmt->bindParam(':id', $alternative->getId());
    
        // execute the query
        if($stmt->execute()){
            return true;
        }    
    
        return false;
    }

    public function findById($id) {
        
        $alternative = null;

        $query = "SELECT
                    id, description, is_correct
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $alternative = new Alternative($row['id'],$row['description'], $row['is_correct']);
        } 
     
        return $alternative;
    }

    public function findAll() {

        $alternativees = array();

        $query = "SELECT
                    id, description, is_correct
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $alternativees[] = new Alternative($id,$description,$is_correct);
        }
        
        return $alternativees;
    }

    public function findAllByQuestionId($question_id) {

            $alternatives = array();
    
            $query = "SELECT
                        id, description, is_correct
                    FROM
                        " . $this->table_name . 
                        " WHERE question_id = :question_id
                        ORDER BY id ASC";
        
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(":question_id", $question_id);
            $stmt->execute();
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $alternatives[] = new Alternative($id,$description,$is_correct);
            }
            
            return $alternatives;
    }
}


?>