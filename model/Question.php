<?php
class Question {
    
    private $id;
    private $description;
    private $isEssay;
    private $isMultipleChoice;
    private $isSingleChoice;
    private $image;

    public function __construct($id, $description, $isEssay, $isMultipleChoice, $isSingleChoice, $image)
    {
        $this->id = $id;
        $this->description = $description;
        $this->isEssay = $isEssay;
        $this->isMultipleChoice = $isMultipleChoice;
        $this->isSingleChoice = $isSingleChoice;
        $this->image = $image;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getIsEssay() { return $this->isEssay; }
    public function setIsEssay($isEssay) { $this->isEssay = $isEssay; }

    public function getIsMultipleChoice() { return $this->isMultipleChoice; }
    public function setIsMultipleChoice($isMultipleChoice) { $this->isMultipleChoice = $isMultipleChoice; }

    public function getIsSingleChoice() { return $this->isSingleChoice; }
    public function setIsSingleChoice($isSingleChoice) { $this->isSingleChoice = $isSingleChoice; }

    public function getImage() { return $this->image; }
    public function setImage($image) { $this->image = $image; }
}
?>