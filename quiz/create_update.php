<?php

include_once "../common/facade.php";

$id = @$_POST["id"];
$name = @$_POST["name"];
$description = @$_POST["description"];
$minimun_score = @$_POST["minimun_score"];

$dao = $factory->getQuizDao();
$quiz = $dao->findById($id);
var_dump($name);

if($quiz===null) {
    $quiz = new Quiz($id, $name, $description, $minimun_score);
    var_dump($quiz);
    $idInserido = $dao->create($quiz);
    // se precisar o id novo...
} else {
    $quiz->setName($name);
    $quiz->setDescription($description);
    $quiz->setMinimunScore($minimun_score);
    $dao->update($quiz);
}


header("Location: index.php");

?>
