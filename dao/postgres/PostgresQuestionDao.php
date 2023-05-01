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
        $stmt->bindParam(":question_type", $question->getIsEssay());
        $stmt->bindParam(":image", $question->getImage());

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

    public function remove($question) {
        return $this->removeById($question->getId());
    }

    public function update($question) {

        $query = "UPDATE " . $this->table_name .
        " SET description = :description, question_type = :question_type, image = :image" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // bind parameters
        $stmt->bindParam(":description", $question->getDescription());
        $stmt->bindParam(":question_type", $question->getIsEssay());
        $stmt->bindParam(":image", $question->getImage());
        $stmt->bindParam(':id', $question->getId());

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

    public function findAll() {

        $questions = array();

        $query = "SELECT
                    id, description, question_type, image
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $questions[] = new Question($id,$description,$question_type,$image);
        }
        
        return $questions;
    }
}


?>
