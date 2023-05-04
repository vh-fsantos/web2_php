<?php
require_once "../common/facade.php";

$id = @$_GET["id"];

$quiz = new Quiz($id, null, null, null, null);
$dao = $factory->getQuizDao();
$dao->removeById($id);

header("location: /quizzes/list.php");
exit;

?>