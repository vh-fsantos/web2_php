<?php 

include_once("../common/facade.php");

$id = @$_POST["id"];
$login = @$_POST["login"];
$password = @$_POST["password"];
$name = @$_POST["name"];
$email = @$_POST["email"];
$phone = @$_POST["phone"];

$dao = $factory->getRespondentDao();
$respondent = $dao->findById($id);

if ($respondent !== null){
    $respondent->setLogin($login);
    $respondent->setPassword(md5($password));
    $respondent->setName($name);
    $respondent->setEmail($email);
    $respondent->setPhone($phone);
    $dao->update($respondent);
}

header("location: /respondents/list.php");

?>