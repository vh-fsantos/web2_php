<?php 

include_once("../common/facade.php");

session_start();

$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
$password = isset($_POST["password"]) ? md5(trim($_POST["password"])) : FALSE;

if(!$login || !$password) 
{
    echo "login = " . $login . " / senha = " . $password . "<br>";
    echo "Você deve digitar sua senha e login!<br>"; 
    echo "<a href='login/'>Efetuar Login</a>";
    exit; 
}

$dao = $factory->getDeveloperDao();
$developer = $dao->findByLogin($login);

$errors = FALSE;

if ($developer)
{
    if(!strcmp($password, $developer->getPassword())) 
    { 
        $_SESSION["userId"]= $developer->getId(); 
        $_SESSION["username"] = stripslashes($developer->getName()); 
        $_SESSION["userType"]= "developer";
        $_SESSION["isAdmin"]= TRUE;
    } 
    else
        $errors = TRUE;
}

if ($errors == TRUE) 
{
    echo "DEU MERDA";
}

?>