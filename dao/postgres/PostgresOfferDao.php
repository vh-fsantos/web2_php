<?php

require_once("../dao/abstractions/OfferDao.php");
require_once("../dao/DAO.php");
require_once("../model/Offer.php");

class PostgresOfferDao extends DAO implements OfferDao
{
    private $table_name = 'offer';
    
    public function create($offer) 
    {
        $query = "INSERT INTO " . $this->table_name . 
        " (date, quiz_id, respondent_id) VALUES" .
        " (:date, :quiz_id, :respondent_id)";

        $stmt = $this->conn->prepare($query);
        $date = $offer->getDate();
        $quiz_id = $offer->getQuiz()->getId();
        $respondent_id = $offer->getRespondent()->getId();
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":quiz_id", $quiz_id);
        $stmt->bindParam(":respondent_id", $respondent_id);

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

    public function remove($offer) 
    {
        return $this->removeById($offer->getId());
    }

    public function update($offer) 
    {
        $query = "UPDATE " . $this->table_name . 
        " SET date = :date, quiz_id = :quiz_id, respondent_id = :respondent_id" .
        " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $date = $offer->getDate();
        $quiz_id = $offer->getQuiz()->getId();
        $respondent_id = $offer->getRespondent()->getId();
        $id = $offer->getId();
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":quiz_id", $quiz_id);
        $stmt->bindParam(":respondent_id", $respondent_id);
        $stmt->bindParam(':id', $id);

        if($stmt->execute())
            return true;

        return false;
    }

    public function findById($id) 
    {
        $offer = null;

        $query = "SELECT id, date, quiz_id, respondent_id
              FROM " . $this->table_name . " 
              WHERE id = :id 
              LIMIT 1 OFFSET 0";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row)
        {
            extract($row);
            $offer = new Offer($id, $date);
            $offer->setQuiz(new Quiz($quiz_id, null, null, null, null));
            $offer->setRespondent(new Respondent($respondent_id, null, null, null, null, null));
        }
            
        return $offer;
    }

    public function findAll()
    {
        $offers = array();

        $query = "SELECT id, date, quiz_id, respondent_id 
                  FROM " . $this->table_name . " ORDER BY id ASC";
     
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $offer = new Offer($id, $date);
            $offer->setQuiz(new Quiz($quiz_id, null, null, null, null));
            $offer->setRespondent(new Respondent($respondent_id, null, null, null, null, null));
            $offers[] = $offer;
        }
        
        return $offers;
    }

    public function findAllWithSubmissionInfo()
    {
        $offers = array();

        $query = "SELECT o.id, o.date, o.quiz_id, o.respondent_id, s.id AS submission_id , s.date AS submission_date
                FROM " . $this->table_name . " o
                LEFT JOIN submission s ON o.id = s.offer_id
                ORDER BY o.id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $offer = new Offer($id, $date);
            $offer->setQuiz(new Quiz($quiz_id, null, null, null, null));
            $offer->setRespondent(new Respondent($respondent_id, null, null, null, null, null));

            if (!empty($submission_id)) {
                $submission = new Submission($submission_id, $submission_date, $offer->getId());
                $offer->setSubmission($submission);
            }

            $offers[] = $offer;
        }
        
        return $offers;
        
    }

    public function findAllWithSubmissionInfoAndFilterByDate(){
 
        $offers = array();

        // Get current date and time
        $current_date_time = date('Y-m-d H:i:s');

        $query = "SELECT o.id, o.date, o.quiz_id, o.respondent_id, s.id AS submission_id, s.date as submission_date 
                FROM " . $this->table_name . " o
                LEFT JOIN submission s ON o.id = s.offer_id
                WHERE o.date <= :current_date_time
                ORDER BY o.id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':current_date_time', $current_date_time);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $offer = new Offer($id, $date);
            $offer->setQuiz(new Quiz($quiz_id, null, null, null, null));
            $offer->setRespondent(new Respondent($respondent_id, null, null, null, null, null));

            if (!empty($submission_id)) {
                $submission = new Submission($submission_id, $submission_date, $offer->getId());
                $offer->setSubmission($submission);
            }

            $offers[] = $offer;
        }
        
        return $offers;


    }
}

?>