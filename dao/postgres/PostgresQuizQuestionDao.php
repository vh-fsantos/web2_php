<?php 

require_once("../dao/abstractions/QuizQuestionDao.php");
// require_once("../model/Quiz.php");
// require_once("../model/Question.php");
require_once("../dao/DAO.php");

class PostgresQuizQuestionDao extends Dao implements QuizQuestionDao {

    private $table_name = 'quiz_question';
    
    public function create($quiz_question) {


        $query = "INSERT INTO " . $this->table_name . 
            " (score, \"order\", quiz_id, question_id) VALUES" .
            " (:score, :order, :quiz_id, :question_id)";
    
        $stmt = $this->conn->prepare($query);
    
        // bind values 
        $stmt->bindParam(":score", $quiz_question->getScore());
        $stmt->bindParam(":order", $quiz_question->getOrder());
        $stmt->bindParam(":quiz_id", $quiz_question->getQuiz()->getId());
        $stmt->bindParam(":question_id", $quiz_question->getQuestion()->getId());
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function removeByProperty($property_value, $property) {
    
        $query = "DELETE FROM " . $this->table_name . 
                 " WHERE $property = :property_value";
    
        $stmt = $this->conn->prepare($query);
    
        // bind parameters
        $stmt->bindParam(':property_value', $property_value);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }    
    
        return false;
    }


    public function removeById($id) {
        return $this->removeByProperty($id, 'id');
    }

    public function removeByQuizId($quiz_id) {
        return $this->removeByProperty($quiz_id, 'quiz_id');
    }

    public function removeByQuestionId($question_id) {
        return $this->removeByProperty($question_id, 'question_id');
    }

    

    public function update($quiz_question) {

        $query = "UPDATE " . $this->table_name . 
        " SET \"order\" = :order, score = :score" .
        " WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        // bind parameters
        $stmt->bindParam(":order", $quiz_question->getOrder());
        $stmt->bindParam(":score", $quiz_question->getScore());
        $stmt->bindParam(':id', $quiz_question->getId());
    
        // execute the query
        if($stmt->execute()){
            return true;
        }    
    
        return false;
    }

    public function findAllByQuizId($quiz_id) {
        
        $quiz_question_list = [];

        $query = "SELECT
                    id, \"order\", score, quiz_id, question_id
                FROM
                    " . $this->table_name . "
                WHERE
                    quiz_id = ?";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $quiz_id);
        $stmt->execute();
     
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quiz = new Quiz($quiz_id, null, null, null, null);
            $question = new Question($question_id, null, null, null);

            $quiz_question = new QuizQuestion($id ,$order, $score);

            $quiz_question->setQuiz($quiz);
            $quiz_question->setQuestion($question);

            $quiz_question_list[] =  $quiz_question;
        }

        return $quiz_question_list;
    }

    public function findById($id) {
        
        $quiz_question = null;

        $query = "SELECT
                    id, \"order\", score, quiz_id, question_id
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
            
            extract($row);
            $quiz_question = new QuizQuestion($id ,$order, $score, $quiz_id, $question_id);
        }
     
        return $quiz_question;
    }

    public function findAll() {

        $quiz_question = array();

        $query = "SELECT
                    id, \"order\", score, quiz_id, question_id
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quiz_question[] =  new QuizQuestion($id, $order, $score, $quiz_id, $question_id);
        }
        
        return $quiz_question;
    }
}


?>