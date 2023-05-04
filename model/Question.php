<?php
class Question {
    
    private $id;
    private $description;
    private $questionType;
    private $image;
    private $alternatives;
    private $score;

    public function __construct($id, $description, $questionType, $image)
    {
        $this->id = $id;
        $this->description = $description;
        $this->questionType = $questionType;
        $this->image = $image;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getQuestionType() { return $this->questionType; }
    public function setQuestionType($questionType) { $this->questionType = $questionType; }

    public function getImage() { return $this->image; }
    public function setImage($image) { $this->image = $image; }

    public function getAlternatives() { return $this->alternatives; }
    public function setAlternatives($alternatives) { $this->alternatives = $alternatives; }

    public function getScore() { return $this->score; }
    public function setScore($score) { $this->score = $score; }

    
}
?>