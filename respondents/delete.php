<?php

include_once("../common/facade.php");

$id = @$_GET["id"];

$dao = $factory->getRespondentDao();
$dao->removeById($id);

header("Location: /respondents");
exit;

?>