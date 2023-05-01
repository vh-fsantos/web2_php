<?php 

include_once("../common/facade.php");

$login = @$_GET["login"];
$password = @$_GET["password"];
$name = @$_GET["name"];
$email = @$_GET["email"];
$phone = @$_GET["phone"];

$respondet = new Respondent(null, $login, $password, $name, $email, $phone);
$dao = $factory->getRespondentDao();
$dao->create($respondet);


exit;

?>