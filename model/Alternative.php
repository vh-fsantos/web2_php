<?php
class Alternative {
    
    private $id;
    private $description;
    private $isCorrect;
    private $question;

    public function __construct($id, $description, $isCorrect)
    {
        $this->id = $id;
        $this->description = $description;
        $this->isCorrect = $isCorrect;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getIsCorrect() { return $this->isCorrect; }
    public function setIsCorrect($isCorrect) { $this->isCorrect = $isCorrect; }

    public function getQuestion() { return $this->question; }
    public function setQuestion($question) { $this->question = $question; }
}
?>