<?php 

include_once("../common/facade.php");

$login = @$_POST["login"];
$password = @$_POST["password"];
$name = @$_POST["name"];
$email = @$_POST["email"];
$phone = @$_POST["phone"];

$respondet = new Respondent(null, $login, $password, $name, $email, $phone);
$dao = $factory->getRespondentDao();
$dao->create($respondet);

header("location: /respondents");
exit;

?>