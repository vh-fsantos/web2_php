<?php
require_once "../common/facade.php";

$id = @$_GET["id"];

$question = new Question($id, null, null, null);
$dao = $factory->getQuestionDao();
$dao->removeById($id);

header("Location: /questions/list.php");
exit;

?>