<?php
class Quiz {
    
    private $id;
    private $description;
    private $dateCreate;
    private $minimumScore;

    public function __construct( $id, $description, $dateCreate, $minimumScore)
    {
        $this->id=$id;
        $this->description=$description;
        $this->dateCreate=$dateCreate;
        $this->minimumScore=$minimumScore;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getDescription() { return $this->description; }
    public function setDescription($description) {$this->description = $description;}

    public function getDateCreate() { return $this->dateCreate; }
    public function setDateCreate($dateCreate) {$this->dateCreate = $dateCreate;}

    public function getMinimumScore() { return $this->minimumScore; }
    public function setMinimumScore($minimumScore) {$this->minimumScore = $minimumScore;}
}
?>