<?php
class Submission {
    
    private $id;
    private $date;
    private $offer;

    public function __construct($id, $date)
    {
        $this->id = $id;
        $this->date = $date;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getDate() { return $this->date; }
    public function setDate($date) { $this->date = $date; }

    public function getOffer() { return $this->offer; }
    public function setOffer($offer) { $this->offer = $offer; }
}
?>