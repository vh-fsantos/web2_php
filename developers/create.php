<?php 

include_once("../common/facade.php");

$login = @$_POST["login"];
$password = @$_POST["password"];
$name = @$_POST["name"];
$email = @$_POST["email"];
$institution = @$_POST["institution"];

$developer = new Developer(null, $login, $password, $name, $email, $institution, true);
$dao = $factory->getDeveloperDao();
$dao->create($developer);


exit;

?>