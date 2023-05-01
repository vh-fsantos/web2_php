<?php 

require_once("../dao/abstractions/QuizDao.php");
require_once("../dao/DAO.php");

class PostgresQuizDao extends DAO implements QuizDao {

    private $table_name = 'quiz';
    
    public function create($quiz) {

        var_dump($quiz);

        $query = "INSERT INTO " . $this->table_name . 
            " (description, date_create, minimum_score) VALUES" .
            " (:description, NOW(), :minimum_score)";
    
        $stmt = $this->conn->prepare($query);
    
        // bind values 
        $stmt->bindParam(":description", $quiz->getDescription());
        $stmt->bindParam(":minimum_score", $quiz->getMinimumScore());
    
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

    public function remove($quiz) {
        return $this->removeById($quiz->getId());
    }

    public function update($quiz) {

        $query = "UPDATE " . $this->table_name . 
        " SET description = :description, minimum_score = :minimum_score" .
        " WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        // bind parameters
        $stmt->bindParam(":description", $quiz->getDescription());
        $stmt->bindParam(":minimum_score", $quiz->getMinimumScore());
        $stmt->bindParam(':id', $quiz->getId());
    
        // execute the query
        if($stmt->execute()){
            return true;
        }    
    
        return false;
    }

    public function findById($id) {
        
        $quiz = null;

        $query = "SELECT
                    id, description, minimum_score, date_create
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
            $quiz = new Quiz($row['id'],$row['description'], $row['minimum_score'], $row['date_create']);
        } 
     
        return $quiz;
    }

    public function findAll() {

        $quizes = array();

        $query = "SELECT
                    id, description, minimum_score, date_create
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quizes[] = new Quiz($id,$description,$minimum_score,$date_create);
        }
        
        return $quizes;
    }
}


?>