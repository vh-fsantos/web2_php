<?php

include_once "../common/facade.php";

$id = @$_POST["id"];
$description = @$_POST["description"];
$question_type = @$_POST["question_type"];
$image = @$_POST["image"];

//alternative
$alternatives = @$_POST["alternatives"];
$is_correct = @$_POST["is_correct"];


$dao = $factory->getQuestionDao();
$question = $dao->findById($id);

function saveAlternatives($alternatives, $is_correct, $question, $factory) {
  if (!empty($alternatives)) {
    foreach ($alternatives as $key => $description) {
      $newAlternative = new Alternative(null, $description, null);
      $newAlternative->setQuestion($question);
      if (!empty($is_correct) && in_array($key, $is_correct)) {
        $newAlternative->setIsCorrect(true);
      }else{
        $newAlternative->setIsCorrect(false);
      }
      $dao_alternative = $factory->getAlternativeDao();
      $dao_alternative->create($newAlternative);
    }
  }
}


if($question===null) {
    $question = new Question($id, $description, $question_type, $image);
    $idInserido = $dao->create($question);
    $question->setId($idInserido);

    saveAlternatives($alternatives, $is_correct, $question, $factory);

} else {
    $question->setId($id);
    $question->setDescription($description);
    $question->setQuestionType($question_type);
    $question->setImage($image);
    $dao->update($question);

    $dao_alternative = $factory->getAlternativeDao();
    $dao_alternative->removeByQuestionId(intval($question->getId()));

    saveAlternatives($alternatives, $is_correct, $question, $factory);
}


header("Location: list.php");

?>
