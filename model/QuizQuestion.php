<?php
class QuizQuestion {
    
    private $id;
    private $score;
    private $order;
    private $quiz;
    private $question;

    public function __construct( $id, $score, $order, $quiz, $question)
    {
        $this->id=$id;
        $this->score=$score;
        $this->order=$order;
        $this->quiz=$quiz;
        $this->question= $question;
    }

    public function getId() { return $this->id; }
    public function setId($id) {$this->id = $id;}

    public function getScore() { return $this->score; }
    public function setScore($score) {$this->score = $score;}

    public function getOrder() { return $this->order; }
    public function setOrder($order) {$this->order = $order;}

    public function getQuiz() { return $this->quiz; }
    public function setQuiz($quiz) {$this->quiz = $quiz;}

    public function getQuestion() { return $this->question; }
    public function setQuestion($question) {$this->question = $question;}
}
?>