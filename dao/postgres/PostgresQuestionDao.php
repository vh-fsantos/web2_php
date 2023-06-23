<?php

require_once("../dao/abstractions/QuestionDao.php");
require_once("../dao/DAO.php");

class PostgresQuestionDao extends Dao implements QuestionDao {

    private $table_name = 'question';

    public function create($question) {

        $query = "INSERT INTO " . $this->table_name .
            " (description, question_type, image) VALUES" .
            " (:description, :question_type, :image)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":description", $question->getDescription());
        $stmt->bindParam(":question_type", $question->getQuestionType());
        $stmt->bindParam(":image", $question->getImage());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }
    }

    public function removeById($id) {

        // delete all quiz questions for this quiz
        $query_quiz_question = "DELETE FROM quiz_question WHERE question_id = :question_id";
        $stmt_quiz_question = $this->conn->prepare($query_quiz_question);
        $stmt_quiz_question->bindParam(':question_id', $id);
        $stmt_quiz_question->execute();
    
        // delete the quiz
        $query_question = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt_question = $this->conn->prepare($query_question);
        $stmt_question->bindParam(':id', $id);
    
        if ($stmt_question->execute()) {
            return true;
        }
    
        return false;
    }

    public function remove($question) {
        return $this->removeById($question->getId());
    }

    public function update($question) {

        $query = "UPDATE " . $this->table_name .
        " SET description = :description, question_type = :question_type, image = :image" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $question->getId());
        $stmt->bindParam(":description", $question->getDescription());
        $stmt->bindParam(":question_type", $question->getQuestionType());
        $stmt->bindParam(":image", $question->getImage());
        

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function findById($id) {

        $question = null;

        $query = "SELECT
                    id, description, question_type, image
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
            $question = new Question($row['id'],$row['description'], $row['question_type'], $row['image']);
        }

        return $question;
    }

    public function findAll($offset, $limit, $search) {

        $questions = array();

        $query = "SELECT
                    id, description, question_type, image
                FROM
                    " . $this->table_name . 
                    "";

        if($search !== '') {
            $query .=" WHERE description LIKE :search";
        }

        $query .= " ORDER BY id ASC";

        if (!is_null($limit) && !is_null($offset)) {
            $query .= " LIMIT :limit OFFSET :offset";
        }

     
        $stmt = $this->conn->prepare( $query );

        if (!empty($search)) {
            $searchTerm = '%' . $search . '%';
            $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        }


        if (!is_null($limit) && !is_null($offset)) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $questions[] = new Question($id,$description,$question_type,$image);
        }
        
        return $questions;
    }

    public function findAlternativesByQuestionId($question_id){
        $alternatives = array();
    
        $query = "SELECT
                    id, description, is_correct
                FROM
                    alternative
                WHERE
                    question_id = :question_id
                ORDER BY
                    id ASC";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':question_id', $question_id);
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $alternatives[] = new Alternative($id,$description,$is_correct);
        }
        
        return $alternatives;
    }

    public function findAllByQuizId($quiz_id){
        
        $questions = array();
    
        $query = "SELECT
                    q.id, q.description, q.question_type, q.image
                FROM
                    " . $this->table_name . " q
                    INNER JOIN quiz_question qq ON qq.question_id = q.id
                WHERE
                    qq.quiz_id = :quiz_id
                ORDER BY
                    qq.score ASC";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->bindValue(':quiz_id', $quiz_id);
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $alternatives = $this->findAlternativesByQuestionId($id);
            $question = new Question($id,$description,$question_type,$image);
            $question->setAlternatives($alternatives);
            
            $questions[] = $question;
        }
        
        return $questions;
    }

    public function findAllByQuizIdWithScores($quiz_id){
        
        $questions = array();

        $query = "SELECT q.id, q.description, q.question_type, q.image, qq.score
                FROM " . $this->table_name . " q
                INNER JOIN quiz_question qq ON qq.question_id = q.id
                WHERE qq.quiz_id = :quiz_id
                ORDER BY q.id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':quiz_id', $quiz_id);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $alternatives = $this->findAlternativesByQuestionId($id);
            $question = new Question($id, $description, $question_type, $image);
            $question->setAlternatives($alternatives);
            $question->setScore($score);

            $questions[] = $question;
        }

        return $questions;
    }


    public function countAll($search){

        $query = "SELECT id FROM " . $this->table_name . "
            WHERE description LIKE :search
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
