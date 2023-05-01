<?php

include_once "../common/facade.php";
include_once "../common/common.php";

if (is_session_started() === FALSE) 
	session_start();

$id = @$_POST["id"];
$name = @$_POST["name"];
$description = @$_POST["description"];
$minimum_score = @$_POST["minimum_score"];
$question_ids = @$_POST["question_ids"];

$dao = $factory->getQuizDao();
$quiz = $dao->findById($id);

function addQuestionsToQuiz($question_ids, $quiz, $factory) {

    if (!empty($question_ids)) {
      
      foreach ($question_ids as $key => $question_id) {
  
        $question = new Question($question_id, null, null, null);
                
        $quiz_question = new QuizQuestion(null, 1, 1);
  
        $quiz_question->setQuestion($question);
        $quiz_question->setQuiz($quiz);
  
        $dao_quiz_question = $factory->getQuizQuestionDao();
        $dao_quiz_question->create($quiz_question);
      }
    }
  }

if($quiz===null) {
    $quiz = new Quiz($id, $name, $description, $minimum_score, null);
    var_dump($quiz);
    $developer = new Developer($_SESSION["userId"],null, null, null, null, null, null);
    $quiz->setDeveloper($developer);
    $idInserido = $dao->create($quiz);
    $quiz->setId($idInserido);
    addQuestionsToQuiz($question_ids, $quiz, $factory);
} else {
    $quiz->setId($id);
    $quiz->setName($name);
    $quiz->setDescription($description);
    $quiz->setMinimumScore($minimum_score);
    $dao->update($quiz);

    addQuestionsToQuiz($question_ids, $quiz, $factory);
}


header("Location: list.php");

?>
