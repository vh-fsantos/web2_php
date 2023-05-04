<?php

include_once("../common/facade.php");

$id = @$_GET["id"];

$dao = $factory->getOfferDao();
$dao->removeById($id);

header("Location: list.php");
exit;

?>