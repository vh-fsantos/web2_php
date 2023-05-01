<?php 

interface QuizQuestionDao {
    public function create($quiz_question);
    public function removeByProperty($property_value, $property);
    public function removeByQuestionId($quiz_question);
    public function removeByQuizId($quiz_question);
    public function removeById($quiz_question);
    public function update($quiz_question);
    public function findById($id);
    // public function findByQuestionId($questionId);
    // public function findByQuizId($quizId);
    public function findAll();
}

?>