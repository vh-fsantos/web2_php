<?php 

require_once("../dao/abstractions/OfferAnswerDao.php");
require_once("../dao/DAO.php");

class PostgresOfferAnswerDao extends DAO implements OfferAnswerDao {

    private $table_name = 'offer_answer';
    
    public function create($offer_answer) {

        $query = "INSERT INTO " . $this->table_name . 
            " (offer_id, answer_id) VALUES" .
            " (:offer_id, :answer_id)";
    
        $stmt = $this->conn->prepare($query);
    
        // bind values 
        $stmt->bindParam(":offer_id", $offer_answer->getOffer()->getId());
        $stmt->bindParam(":answer_id", $offer_answer->getAnswer()->getId());
    
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}


?>