<?php 

include_once("../common/facade.php");

$login = @$_GET["login"];
$password = @$_GET["password"];
$name = @$_GET["name"];
$email = @$_GET["email"];
$institution = @$_GET["institution"];

$developer = new Developer(null, $login, $password, $name, $email, $institution, true);
$dao = $factory->getDeveloperDao();
$dao->create($developer);


exit;

?>