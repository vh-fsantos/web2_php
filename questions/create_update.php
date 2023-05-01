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
$dao_alternative = $factory->getAlternativeDao();
$question = $dao->findById($id);


if($question===null) {
    $question = new Question($id, $description, $question_type, $image);
    $idInserido = $dao->create($question);
    $question->setId($idInserido);
    // se precisar o id novo...
    if (!empty($alternatives)) {
  
        // Create an empty array to store the new alternatives
        $newAlternatives = array();
      
        // Loop through each alternative in the alternatives array
        foreach ($alternatives as $key => $description) {
            
      
          // Create a new alternative with the Alternative class
          $newAlternative = new Alternative(null, $description, null);

          $newAlternative->setQuestion($question);
      
          // If the is_correct array is not empty and the current key is in the is_correct array
          if (!empty($is_correct) && in_array($key, $is_correct)) {
            
            // Set the current alternative as correct
            $newAlternative->setIsCorrect(true);
          }else{
            $newAlternative->setIsCorrect(false);
          }

          //create new alternative

          $dao_alternative->create($newAlternative);
      
          // Add the new alternative to the array of new alternatives
          $newAlternatives[] = $newAlternative;
        }
      
        // Do something with the new alternatives array
        // For example, you could store it in a database or use it to create a new question object
      }


} else {
    $question->setName($name);
    $question->setDescription($description);
    $question->setQuestionType($question_type);
    $question->setImage($image);
    $dao->update($question);
}


header("Location: index.php");

?>
