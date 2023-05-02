<?php

require_once("../dao/abstractions/SubmissionDao.php");
require_once("../dao/DAO.php");

class PostgresSubmissionDao extends Dao implements SubmissionDao {

    private $table_name = 'submission';

    public function create($submission) {

        $query = "INSERT INTO " . $this->table_name .
            " (date, offer_id) VALUES" .
            " (NOW(), :offer_id)";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":offer_id", $submission->getOffer()->getId());

        if($stmt->execute()){
            return $this->conn->lastInsertId();;
        }else{
            return -1;
        }
    }

    public function removeById($id) {
    
        // delete the quiz
        $query_submission = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt_submission = $this->conn->prepare($query_submission);
        $stmt_submission->bindParam(':id', $id);
    
        if ($stmt_submission->execute()) {
            return true;
        }
    
        return false;
    }

    public function remove($submission) {
        return $this->removeById($submission->getId());
    }

    public function findById($id) {

        $submission = null;

        $query = "SELECT
                    id, date, offer_id
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
            $offer = new Offer($row['offer_id'], null);
            $submission = new Submission($row['id'],$row['date']);
            $submission->setOffer($offer);
        }

        return $submission;
    }

    public function findAll() {

        $submissions = array();

        $query = "SELECT
                    id, description, submission_type, image
                FROM
                    " . $this->table_name . 
                    " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $offer = new Offer($offer_id, null);
            $submission = new Submission($id,$date);
            $submission->setOffer($offer);
            $submissions[] = $submission;
        }
        
        return $submissions;
    }

}


?>
