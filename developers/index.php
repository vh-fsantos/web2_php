<?php 
$page_title = "Elaboradores";

include_once("../common/facade.php");
include_once("../common/header.php");

$dao = $factory->getDeveloperDao();
$developers = $dao->findAll();

foreach ($developers as &$dev){
  echo $dev->getName() . "<br>";
}

?>