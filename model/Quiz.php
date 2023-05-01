<?php
class Quiz {
    
    private $id;
    private $name;
    private $description;
    private $minimumScore;
    private $dateCreate;
    private $developer;

    public function __construct($id, $name, $description, $minimumScore, $dateCreate)
    {
        $this->id=$id;
        $this->name=$name;
        $this->description=$description;
        $this->minimumScore=$minimumScore;
        $this->dateCreate=$dateCreate;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getName() { return $this->name; }
    public function setName($name) {$this->name = $name;}

    public function getDescription() { return $this->description; }
    public function setDescription($description) {$this->description = $description;}

    public function getDateCreate() { return $this->dateCreate; }
    public function setDateCreate($dateCreate) {$this->dateCreate = $dateCreate;}

    public function getMinimumScore() { return $this->minimumScore; }
    public function setMinimumScore($minimumScore) {$this->minimumScore = $minimumScore;}

    public function getDeveloper() { return $this->developer; }
    public function setDeveloper($developer) {$this->developer = $developer;}
}
?>