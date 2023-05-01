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

$dao = $factory->getRespondentDao();
$respondent = $dao->findByLogin($login);

$errors = FALSE;

if ($respondent)
{
    if(!strcmp($password, $respondent->getPassword())) 
    { 
        $_SESSION["userId"]= $respondent->getId(); 
        $_SESSION["username"] = stripslashes($respondent->getName()); 
        $_SESSION["userType"]= "respondent";
        $_SESSION["isAdmin"]= FALSE;
    } 
    else
        $errors = TRUE;
}

if ($errors == TRUE) 
    echo "DEU MERDA";

?>