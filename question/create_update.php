<?php

include_once "../common/facade.php";

$id = @$_POST["id"];
$name = @$_POST["name"];
$description = @$_POST["description"];
$minimum_score = @$_POST["minimum_score"];

$dao = $factory->getQuizDao();
$quiz = $dao->findById($id);

if($quiz===null) {
    $quiz = new Quiz($id, $name, $description, $minimum_score);
    $idInserido = $dao->create($quiz);
    // se precisar o id novo...
} else {
    $quiz->setName($name);
    $quiz->setDescription($description);
    $quiz->setMinimumScore($minimum_score);
    $dao->update($quiz);
}


header("Location: index.php");

?>
