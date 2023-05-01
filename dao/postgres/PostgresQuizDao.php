<?php 

require_once("../dao/abstractions/QuizDao.php");
require_once("../dao/DAO.php");

class PostgresQuizDao extends DAO implements QuizDao {

    private $table_name = 'quiz';
    
    public function create($quiz) {

        $query = "INSERT INTO " . $this->table_name . 
            " (name, description, date_create, minimum_score, developer_id) VALUES" .
            " (:name, :description, NOW(), :minimum_score, :developer_id)";
    
        $stmt = $this->conn->prepare($query);
    
        // bind values 
        $stmt->bindParam(":name", $quiz->getName());
        $stmt->bindParam(":description", $quiz->getDescription());
        $stmt->bindParam(":minimum_score", $quiz->getMinimumScore());
        $stmt->bindParam(":developer_id", $quiz->getDeveloper()->getId());
    
        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return -1;
        }
    }

    public function removeById($id) {

        // delete all quiz questions for this quiz
        $query_quiz_question = "DELETE FROM quiz_question WHERE quiz_id = :quiz_id";
        $stmt_quiz_question = $this->conn->prepare($query_quiz_question);
        $stmt_quiz_question->bindParam(':quiz_id', $id);
        $stmt_quiz_question->execute();
    
        // delete the quiz
        $query_quiz = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt_quiz = $this->conn->prepare($query_quiz);
        $stmt_quiz->bindParam(':id', $id);
    
        if ($stmt_quiz->execute()) {
            return true;
        }
    
        return false;
    }

    public function remove($quiz) {
        return $this->removeById($quiz->getId());
    }

    public function update($quiz) {

        $query = "UPDATE " . $this->table_name . 
        " SET name = :name, description = :description, minimum_score = :minimum_score" .
        " WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        // bind parameters
        $stmt->bindParam(":name", $quiz->getName());
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
                    id, name, description, minimum_score, date_create
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
            $quiz = new Quiz($row['id'], $row['name'],$row['description'], $row['minimum_score'], $row['date_create']);
        } 
     
        return $quiz;
    }

    public function findAll() {

        $quizes = array();

        $query = "SELECT
                    id, name, description, minimum_score, date_create
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quizes[] = new Quiz($id, $name, $description,$minimum_score,$date_create);
        }
        
        return $quizes;
    }
}


?>