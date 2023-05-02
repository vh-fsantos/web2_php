<?php 

require_once("../dao/abstractions/AnswerDao.php");
require_once("../dao/DAO.php");

class PostgresAnswerDao extends DAO implements AnswerDao {

    private $table_name = 'answer';
    
    public function create($answer) {


        $query = "INSERT INTO " . $this->table_name . 
            " (text, score, observation, question_id, alternative_id) VALUES" .
            " (:text, :score, :observation, :question_id, :alternative_id)";
    
        $stmt = $this->conn->prepare($query);
    
        // bind values 
        $stmt->bindParam(":text", $answer->getText());
        $stmt->bindParam(":score", $answer->getScore());
        $stmt->bindParam(":observation", $answer->getObservation());
        $stmt->bindParam(":question_id", $answer->getQuestion()->getId());

        // If the answer is not a text answer, the alternative_id will be set
        // If the answer is a text answer, the alternative_id will be null
        if ($answer->getAlternative() != null) {
            $stmt->bindParam(":alternative_id", $answer->getAlternative()->getId());
        }else{
            $stmt->bindValue(":alternative_id", null, PDO::PARAM_INT);
        }
    
        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
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

    public function remove($answer) {
        return $this->removeById($answer->getId());
    }

    public function findAll() {

        $answers = array();

        $query = "SELECT
                    id, text, score, observation
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $answers[] = new Answer($id, $text, $score, $observation);
        }
        
        return $answers;
    }
  
}


?>