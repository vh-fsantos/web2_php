<?php 

class Offer 
{
    private $id;
    private $date;
    private $quiz;
    private $respondent;
    private $submission;

    public function __construct($id, $date)
    {
        $this->id = $id;
        $this->date = $date;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getDate() { return $this->date; }
    public function setDate($date) { $this->date = $date; }

    public function getQuiz() { return $this->quiz; }
    public function setQuiz($quiz) { $this->quiz = $quiz; }

    public function getRespondent() { return $this->respondent; }
    public function setRespondent($respondent) { $this->respondent = $respondent; }

    public function getSubmission() { return $this->submission; }
    public function setSubmission($submission) { $this->submission = $submission; }
}

?>