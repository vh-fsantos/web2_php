<?php
class Quiz {
    
    private $id;
    private $description;
    private $dateCreate;
    private $minimunScore;

    public function __construct( $id, $description, $dateCreate, $minimunScore)
    {
        $this->id=$id;
        $this->description=$description;
        $this->dateCreate=$dateCreate;
        $this->minimunScore=$minimunScore;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getDescription() { return $this->description; }
    public function setDescription($description) {$this->description = $description;}

    public function getDateCreate() { return $this->dateCreate; }
    public function setDateCreate($dateCreate) {$this->dateCreate = $dateCreate;}

    public function getMinimunScore() { return $this->minimunScore; }
    public function setMinimunScore($minimunScore) {$this->minimunScore = $minimunScore;}
}
?>