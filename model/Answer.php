<?php
class Answer {
    
    private $id;
    private $text;
    private $score;
    private $observation;
    private $question;
    private $alternative;

    public function __construct($id, $text, $score, $observation)
    {
        $this->id = $id;
        $this->text = $text;
        $this->score = $score;
        $this->observation = $observation;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getText() { return $this->text; }
    public function setText($text) { $this->text = $text; }

    public function getScore() { return $this->score; }
    public function setScore($score) { $this->score = $score; }

    public function getObservation() { return $this->observation; }
    public function setObservation($observation) { $this->observation = $observation; }

    public function getQuestion() { return $this->question; }
    public function setQuestion($question) { $this->question = $question; }

    public function getAlternative() { return $this->alternative; }
    public function setAlternative($alternative) { $this->alternative = $alternative; }
}
?>