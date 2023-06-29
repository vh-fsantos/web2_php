<?php 

include_once("../common/facade.php");

$id = @$_POST["id"];
$login = @$_POST["login"];
$password = @$_POST["password"];
$name = @$_POST["name"];
$email = @$_POST["email"];
$institution = @$_POST["institution"];

$dao = $factory->getDeveloperDao();
$developer = $dao->findById($id);

if ($developer !== null){
    $developer->setLogin($login);
    $developer->setPassword(md5($password));
    $developer->setName($name);
    $developer->setEmail($email);
    $developer->setInstitution($institution);
    $dao->update($developer);
}

header("location: /developers/list.php");

?>