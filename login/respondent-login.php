<?php 

include_once("../common/facade.php");

session_start();

$login = isset($_POST["respondentLogin"]) ? addslashes(trim($_POST["respondentLogin"])) : FALSE;
$password = isset($_POST["respondentPassword"]) ? md5(trim($_POST["respondentPassword"])) : FALSE;

if(!$login || !$password) 
{
    echo "login = " . $login . " / senha = " . $password . "<br>";
    echo "Você deve digitar sua senha e login!<br>"; 
    echo "<a href='/login'>Efetuar Login</a>";
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
        header("location: /index.php");
        exit;
    } 
    else
        $errors = TRUE;
}

if ($errors == TRUE)
{
    header("location: /index.php");
    exit;
}

?>