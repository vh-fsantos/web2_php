<?php

include_once("../common/facade.php");

$id = @$_POST["id"];
$quiz_id = @$_POST["quiz_id"];

$dao_answer = $factory->getAnswerDao();
$dao_submission = $factory->getSubmissionDao();
$dao_offer_answer = $factory->getOfferAnswerDao();

$dao_question = $factory->getQuestionDao();
$questions = $dao_question->findAllByQuizId($quiz_id);

$offer = new Offer($id, null);

$question_ids = array();
foreach ($questions as $question) {
  $question_ids[] = $question->getId();
}


// Loop over the received question IDs
foreach ($question_ids as $question_id) {
  var_dump($question_id);
  // Check if an answer was provided for this question
  if (isset($_POST['question_'.$question_id])) {

      // Get the ID of the selected alternative(s)
      $selected_alternatives = $_POST['question_'.$question_id];

      if (!is_array($selected_alternatives)) {
        
        $question = new Question($question_id, null, null, null);
        $answer = new Answer(null, $selected_alternatives, 1, null);
        $answer->setQuestion($question);

        $idInserido = $dao_answer->create($answer);

        $answer->setId($idInserido);

        $offer_answer = new OfferAnswer(null, null, null);

        
        $offer_answer->setOffer($offer);
        $offer_answer->setAnswer($answer);
        $dao_offer_answer->create($offer_answer);

      }else{
        foreach ($selected_alternatives as $alternative_id) {
            $question = new Question($question_id, null, null, null);
            $alternative = new Alternative($alternative_id, null, null);

            $answer = new Answer(null, null, 1, null);
            $answer->setQuestion($question);
            $answer->setAlternative($question);

            $idInserido = $dao_answer->create($answer);
            $answer->setId($idInserido);

            $offer_answer = new OfferAnswer(null, null, null);

            $offer_answer->setOffer($offer);
            $offer_answer->setAnswer($answer);
            $dao_offer_answer->create($offer_answer);
        }
      }

      // Create an Answer object for each selected alternative
      
  }
}


$submission = new Submission(null, null);
$submission->setOffer($offer);
$dao_submission->create($submission);

header("Location: list_respondents.php");



?>
