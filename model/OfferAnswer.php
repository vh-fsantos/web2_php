<?php
class OfferAnswer {
    
    private $id;
    private $offer;
    private $answer;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getOffer() { return $this->offer; }
    public function setOffer($offer) { $this->offer = $offer; }

    public function getAnswer() { return $this->answer; }
    public function setAnswer($answer) { $this->answer = $answer; }
}
?>