<?php 

$id = @$_GET["id"];
$login = @$_POST["login"];
$password = @$_POST["password"];
$name = @$_POST["name"];
$email = @$_POST["email"];
$institution = @$_POST["institution"];

$dao = $factory->getDeveloperDao();
$developer = $dao->findById($id);

if ($developer !== null){
    $developer->setLogin($login);
    $developer->setPassword($password);
    $developer->setName($name);
    $developer->setEmail($email);
    $developer->setInstitution($institution);
}

header("location: /developers/list.php");

?>